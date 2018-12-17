<?php

class Language_Pack {
	const BUILD_DIR         = '/tmp/cp-translations/build';
	const OUTPUT_DIR        = '/tmp/cp-translations/output';
	const PACKAGE_THRESHOLD = 95;
	const VERSION           = '1.0.0';

	/**
	 * Initialize the commands
	 *
	 * @return void
	 */
	public function __construct() {
		WP_CLI::add_command( 'glotpress language-pack-endpoint', array( $this, 'generate' ) );
	}

	/**
	 * Generates a language pack.
	 *
	 * ## OPTIONS
	 *
	 * <slug>
	 * : Slug of the project.
	 *
	 * [--locale]
	 * : Locale the language pack is for.
	 *
	 * [--locale-slug]
	 * : Slug of the locale. Default: 'default'.
	 */
	public function generate( $args, $assoc_args ) {
		$slug = $args[0];

		$args = wp_parse_args(
			$assoc_args,
			[
				'locale'      => false,
				'locale-slug' => 'default',
			]
		);

		$this->generate_pack( $slug, $args );
	}

	/**
	 * Generates a language pack.
	 *
	 * Examples:
	 *   wp glotpress language-pack generate nothing-much
	 *   wp @translate wporg-translate language-pack generate nothing-much --locale=de
	 *
	 * @param string $slug Slug of the project.
	 * @param array  $args Extra arguments.
	 */
	private function generate_pack( $slug, $args ) {
		$gp_project = GP::$project->by_path( "$slug" );
		if ( ! $gp_project ) {
			WP_CLI::error( 'Invalid project slug.' );
		}

		$translation_sets = GP::$translation_set->by_project_id( $gp_project->id );
		if ( ! $translation_sets ) {
			WP_CLI::error( 'No translation sets available.' );
		}

		/**
		 * Filters the arguments passed to the WP-CLI command.
		 *
		 * @param array  $args CLI arguments.
		 * @param string $slug Slug of the theme.
		 */
		$args = apply_filters( 'wporg_translate_language_pack_plugin_args', $args, $slug );

		if ( $args['locale'] ) {
			$translation_sets = wp_list_filter(
				$translation_sets,
				[
					'locale' => $args['locale'],
					'slug'   => $args['locale-slug'],
				]
			);
		}

		if ( ! $translation_sets ) {
			WP_CLI::error( 'No translation sets available.' );
		}

		$data                   = new stdClass();
		$data->domain           = $slug;
		$data->translation_sets = $translation_sets;
		$data->gp_project       = $gp_project;
		$this->build_language_packs( $data );
	}

	/**
	 * Builds a PO file for translations.
	 *
	 * @param GP_Project         $gp_project The GlotPress project.
	 * @param GP_Locale          $gp_locale  The GlotPress locale.
	 * @param GP_Translation_Set $set        The translation set.
	 * @param string             $dest       Destination file name.
	 * @return string|WP_Error Last updated date on success, WP_Error on failure.
	 */
	private function build_po_file( $gp_project, $gp_locale, $set, $dest ) {
		$entries = GP::$translation->for_export( $gp_project, $set, [ 'status' => 'current' ] );
		if ( ! $entries ) {
			return new WP_Error( 'no_translations', 'No current translations available.' );
		}

		$format     = gp_array_get( GP::$formats, 'po' );
		$po_content = $format->print_exported_file( $gp_project, $gp_locale, $set, $entries );

		// Get last updated.
		preg_match( '/^"PO-Revision-Date: (.*)\+\d+\\\n/m', $po_content, $match );
		if ( empty( $match[1] ) ) {
			return new WP_Error( 'invalid_format', 'Date could not be parsed.' );
		}

		file_put_contents( $dest, $po_content );

		return $match[1];
	}

	/**
	 * Executes a command via exec().
	 *
	 * @param string $command The escaped command to execute.
	 *
	 * @return true|WP_Error True on success, WP_Error on failure.
	 */
	private function execute_command( $command ) {
		exec( $command, $output, $return_var );

		if ( $return_var ) {
			return new WP_Error( $return_var, 'Error while executing the command.', $output );
		}

		return true;
	}

	/**
	 * Builds a language pack.
	 *
	 * @param object $data The data of a language pack.
	 */
	private function build_language_packs( $data ) {
		$endpoint       = array();

		foreach ( $data->translation_sets as $set ) {
			// Get WP locale.
			$gp_locale = GP_Locales::by_slug( $set->locale );
			if ( ! isset( $gp_locale->wp_locale ) ) {
				continue;
			}

			// Change wp_locale until GlotPress returns the correct wp_locale for variants.
			$wp_locale = $gp_locale->wp_locale;
			if ( 'default' !== $set->slug ) {
				$wp_locale = $wp_locale;
			}

			// Check if percent translated is above threshold.
			$percent_translated = $set->percent_translated();
			if ( $percent_translated < self::PACKAGE_THRESHOLD ) {
				WP_CLI::log( "Skip {$wp_locale}, translations below threshold ({$percent_translated}%)." );
				continue;
			}

			$export_directory = self::BUILD_DIR . "/{$data->domain}/export/{$wp_locale}";
			$build_directory  = self::BUILD_DIR . "/{$data->domain}";
			$filename         = "{$data->domain}-{$wp_locale}";
			$po_file          = "{$export_directory}/{$filename}.po";
			$mo_file          = "{$export_directory}/{$filename}.mo";
			$zip_file         = "{$export_directory}/{$filename}.zip";
			$build_zip_file   = "{$build_directory}/{$wp_locale}.zip";

			// Create folders
			if ( !file_exists( $export_directory ) ) {
				WP_CLI::warning( 'Folder for ' . $export_directory . ' missing and created' );
				mkdir( $export_directory, 0777, true );
			}

			if ( !file_exists( $build_directory ) ) {
				WP_CLI::warning( 'Folder for ' . $build_directory . ' missing and created' );
				mkdir( $build_directory, 0777, true );
			}

			// Create PO file.
			$last_modified = $this->build_po_file( $data->gp_project, $gp_locale, $set, $po_file );

			if ( is_wp_error( $last_modified ) ) {
				WP_CLI::warning( sprintf( "PO generation for {$wp_locale} failed: %s", $last_modified->get_error_message() ) );

				continue;
			}

			// Create MO file.
			$result = $this->execute_command(
				sprintf(
					'msgfmt %s -o %s 2>&1',
					escapeshellarg( $po_file ),
					escapeshellarg( $mo_file )
				)
			);

			if ( is_wp_error( $result ) ) {
				WP_CLI::error_multi_line( $result->get_error_data() );
				WP_CLI::warning( "MO generation for {$wp_locale} failed." );

				continue;
			}

			// Create ZIP file.
			// TODO install the real `zip` and use it instead
			$result = $this->execute_command(
				sprintf(
					'zip-hack -9 -j %s %s %s 2>&1',
					escapeshellarg( $zip_file ),
					escapeshellarg( $po_file ),
					escapeshellarg( $mo_file )
				)
			);

			if ( is_wp_error( $result ) ) {
				WP_CLI::error_multi_line( $result->get_error_data() );
				WP_CLI::warning( "ZIP generation for {$wp_locale} failed." );

				continue;
			}

			// Create build directories.
			$result = $this->execute_command(
				sprintf(
					'mkdir -p %s 2>&1',
					escapeshellarg( $build_directory )
				)
			);

			if ( is_wp_error( $result ) ) {
				WP_CLI::error_multi_line( $result->get_error_data() );
				WP_CLI::warning( "Creating build directories for {$wp_locale} failed." );

				continue;
			}

			// Move ZIP file to build directory.
			$result = $this->execute_command(
				sprintf(
					'mv %s %s 2>&1',
					escapeshellarg( $zip_file ),
					escapeshellarg( $build_zip_file )
				)
			);

			if ( is_wp_error( $result ) ) {
				WP_CLI::error_multi_line( $result->get_error_data() );
				WP_CLI::warning( "Moving ZIP file for {$wp_locale} failed." );

				continue;
			}

			$endpoint['translations'][] = array(
				'language'     => $wp_locale,
				'version'      => self::VERSION,
				'package'      => 'https://api-v1.classicpress.net/translations/' . $data->domain . '/' . self::VERSION . '/' . $wp_locale . '.zip',
				'english_name' => $gp_locale->english_name,
				'native_name'  => $gp_locale->native_name,
				'iso'          => array( $gp_locale->lang_code_iso_639_1, $gp_locale->lang_code_iso_639_2, $gp_locale->lang_code_iso_639_3 ),
				'updated'      => $last_modified,
				'strings'      => array( 'continue' => 'Continue' ),
			);

			WP_CLI::success( "Language pack for {$wp_locale} generated." );
		}

		$output_dir = self::OUTPUT_DIR . "/{$data->domain}/" . self::VERSION;
		if ( ! file_exists( $output_dir ) ) {
			mkdir( $output_dir, 0755, true );
		}

		file_put_contents( $output_dir . '/translations.json', json_encode( $endpoint ) );

		$files = glob( self::BUILD_DIR . "/{$data->domain}/*.zip" );
		foreach ( $files as $file ) {
			if ( is_file( $file ) ) {
				rename( $file, $output_dir . '/' . basename( $file ) );
			}
		}
	}
}

new Language_Pack();
