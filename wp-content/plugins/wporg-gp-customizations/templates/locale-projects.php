<?php
gp_title( sprintf( __( 'Projects translated to %s &lt; GlotPress' ),  esc_html( $locale->english_name ) ) );

$breadcrumb   = array();
$breadcrumb[] = gp_link_get( '/', __( 'Locales' ) );
$breadcrumb[] = gp_link_get( gp_url_join( '/locale', $locale_slug, $set_slug ), esc_html( $locale->english_name ) );
$breadcrumb[] = esc_html( $project->name );
gp_breadcrumb( $breadcrumb );
gp_tmpl_header();
?>

<div class="locale-header">
	<p class="locale-intro">Translate WordPress, core projects, plugins, and themes into your language. Select your project below to get started.</p>

	<div class="locale-box">
		<ul class="name">
			<li class="english"><?php echo $locale->english_name; ?></li>
			<li class="native"><?php echo $locale->native_name; ?></li>
			<li class="code">
				<?php
				echo $locale->wp_locale;

				if ( count( $variants ) > 1 ) {
					?>
					<select id="variant-selector" name="variant">
						<?php
						foreach ( $variants as $variant ) {
							$selected =
							printf(
								'<option name="%s" data-project-url="%s"%s>%s</option>',
								$variant,
								esc_url( gp_url_join( '/locale', $locale_slug, $variant, $project->slug ) ),
								( $set_slug == $variant ) ? ' selected="selected"' : '',
								ucfirst( $variant )
							);
						}
						?>
					</select>
					<?php
				}
				?>
			</li>
			<?php if ( $locale_glossary ) : ?>
				<li class="locale-glossary">
					<a href="<?php echo esc_url( gp_url_join( gp_url( '/locale' ), $locale_slug, $set_slug, 'glossary' ) ); ?>" class="glossary-link"><?php _e( 'Locale Glossary', 'glotpress' ); ?></a>
				</li>
			<?php elseif ( $can_create_locale_glossary ) : ?>
				<li class="locale-glossary">
					<a href="<?php echo esc_url( gp_url_join( gp_url( '/locale' ), $locale_slug, $set_slug, 'glossary' ) ); ?>" class="glossary-link"><?php _e( 'Create Locale Glossary', 'glotpress' ); ?></a>
				</li>
			<?php endif; ?>
		</ul>
		<div class="contributors">
			<?php
			$contributors = sprintf(
				'<span class="dashicons dashicons-admin-users"></span><br />%s',
				isset( $contributors_count[ $locale->slug ] ) ? $contributors_count[ $locale->slug ] : 0
			);
			echo gp_link_get( 'https://make.wordpress.org/polyglots/teams/?locale=' . $locale->wp_locale, $contributors );
			?>
		</div>
	</div>
</div>

<div class="filter-header">
	<ul class="filter-header-links">
		<?php
		foreach ( $top_level_projects as $top_level_project ) {
			printf(
				'<li><a href="%s"%s>%s</a></li>',
				esc_url( gp_url_join( '/locale', $locale_slug, $set_slug, $top_level_project->slug ) ),
				( $top_level_project->path == $project_path ) ? ' class="current"' : '',
				$top_level_project->name
			);
		}
		?>
	</ul>
	<div class="search-form">
		<form>
			<label class="screen-reader-text" for="projects-filter"><?php esc_attr_e( 'Search projects...' ); ?></label>
			<input placeholder="<?php esc_attr_e( 'Search projects...' ); ?>" type="search" id="projects-filter" name="s" value="<?php if ( !empty( $search ) ) { echo esc_attr( $search ); } ?>" class="filter-search">
			<input type="submit" value="<?php esc_attr_e( 'Search' ); ?>" class="screen-reader-text" />
		</form>
	</div>
</div>
<div class="sort-bar">
	<form id="sort-filter" action="" method="GET">
		<input type="hidden" name="page" value="1">
		<select id="filter" name="filter">
			<?php
				$sorts = array();
				if ( is_user_logged_in() && in_array( $project->slug, array( 'waiting', 'wp-themes', 'wp-plugins' ) ) ) {
					$sorts['special'] = 'Untranslated Favorites, Remaining Strings (Most first)';
					$sorts['favorites'] = 'My Favorites';
				}
				$sorts['strings-remaining'] = 'Remaining Strings (Most first)';
				$sorts['strings-remaining-asc'] = 'Remaining Strings (Least first)';
				$sorts['strings-waiting-and-fuzzy'] = 'Waiting + Fuzzy (Most first)';
				$sorts['strings-waiting-and-fuzzy-asc'] = 'Waiting + Fuzzy (Least first)';
				$sorts['percent-completed'] = 'Percent Completed (Most first)';
				$sorts['percent-completed-asc'] = 'Percent Completed (Least first)';

				foreach ( $sorts as $value => $text ) {
					printf( '<option value="%s" %s>%s</option>', esc_attr( $value ), ( $value == $filter ? 'selected="selected"' : '' ), esc_attr( $text ) );
				}
			?>
		</select>
	</form>
</div>
<script>
	var filterForm  = document.getElementById( 'sort-filter' );
	var filterSelect = document.getElementById( 'filter' );
	filterSelect.addEventListener( 'change', function() {
		filterForm.submit()
	} );
</script>

<div id="projects" class="projects">
	<?php
	foreach ( $sub_projects as $sub_project ) {
		$percent_complete = $waiting = $sub_projects_count = $fuzzy = $remaining = 0;
		if ( isset( $project_status[ $sub_project->id ] ) ) {
			$status = $project_status[ $sub_project->id ];
			$percent_complete = $status->percent_complete;
			$waiting = $status->waiting_count;
			$fuzzy = $status->fuzzy_count;
			$remaining = $status->all_count - $status->current_count;
			$sub_projects_count = $status->sub_projects_count;
		}

		// Link directly to the Waiting strings if we're in the Waiting view, otherwise link to the project overview
		if ( 'waiting' == $project->slug ) {
			// TODO: Since we're matching parent projects, we can't link to them as they have no direct translation sets.
			//$project_url = gp_url_join( '/projects', $sub_project->path, $locale_slug, $set_slug ) . '?filters[status]=waiting_or_fuzzy';
			$project_url = gp_url_join( '/locale', $locale_slug, $set_slug, $sub_project->path );

			$project_name = $sub_project->name;
			$parent_project_id = $sub_project->parent_project_id;
			while ( $parent_project_id ) {
				$parent_project = GP::$project->get( $parent_project_id );
				$parent_project_id = $parent_project->parent_project_id;
				$project_name = "{$parent_project->name} - {$project_name}";
			}

		} else {
			$project_url = gp_url_join( '/locale', $locale_slug, $set_slug, $sub_project->path );
			$project_name = $sub_project->name;
		}

		$project_icon = '';
		if ( isset( $project_icons[ $sub_project->id ] ) ) {
			$project_icon = $project_icons[ $sub_project->id ];
		}

		$classes = 'project-' . sanitize_title_with_dashes( str_replace( '/', '-', $project->path ) );
		$classes .= ' project-' . sanitize_title_with_dashes( str_replace( '/', '-', $sub_project->path ) );
		$classes .= ' percent-' . $percent_complete;
		?>
		<div class="project <?php echo $classes; ?>">
			<div class="project-top">
				<div class="project-icon">
					<?php echo gp_link_get( $project_url, $project_icon ) ?>
				</div>

				<div class="project-name">
					<h4>
						<?php echo gp_link_get( $project_url, $project_name ) ?>
					</h4>
				</div>
				<div class="project-description">
					<p><?php
						$description = wp_strip_all_tags( $sub_project->description );
						$description = str_replace( array( 'WordPress.org Plugin Page', 'WordPress.org Theme Page' ), '', $description );
						echo wp_trim_words( $description, 30 );
					?></p>
				</div>
			</div>

			<div class="project-status">
				<div class="project-status-sub-projects">
					<span class="project-status-title">Projects</span>
					<span class="project-status-value"><?php echo number_format_i18n( $sub_projects_count ); ?></span>
				</div>
				<div class="project-status-waiting">
					<span class="project-status-title">Waiting/Fuzzy</span>
					<span class="project-status-value"><?php echo number_format_i18n( $waiting + $fuzzy ); ?></span>
				</div>
				<div class="project-status-remaining">
					<span class="project-status-title">Remaining</span>
					<span class="project-status-value"><?php echo number_format_i18n( $remaining ); ?></span>
				</div>
				<div class="project-status-progress">
					<span class="project-status-title">Progress</span>
					<span class="project-status-value"><?php echo number_format_i18n( $percent_complete ); ?>%</span>
				</div>
			</div>

			<div class="percent">
				<div class="percent-complete" style="width:<?php echo $percent_complete; ?>%;"></div>
			</div>

			<div class="project-bottom">
				<?php echo gp_link_get( $project_url, 'Translate Project', [ 'class' => 'button contribute-button' ] ); ?>
			</div>
		</div>
		<?php
	}
	if ( ! $sub_projects ) {
		if ( 'waiting' === $project->slug ) {
			echo '<div class="no-projects-found">No projects with strings awaiting approval!</div>';
		} else {
			echo '<div class="no-projects-found">No projects found.</div>';
		}
	}
	?>
</div>
<?php
	if ( isset( $pages ) && $pages['pages'] > 1 ) {
		echo gp_pagination( $pages['page'], $pages['per_page'], $pages['results'] );
	}
?>

<script>
	jQuery( document ).ready( function( $ ) {
		// Don't filter if there's an existing search term, or if we're paginated
		// Fall back to a full page reload for those cases.
		var live_filtering_enabled = ( ! $( '#projects-filter' ).val() && ! $( '.paging' ).length );
		$rows = $( '#projects' ).find( '.project' );
		$( '#projects-filter' ).on( 'input keyup', function() {
			if ( ! live_filtering_enabled ) {
				return;
			}

			var words = this.value.toLowerCase().split( ' ' );

			if ( '' === this.value.trim() ) {
				$rows.show();
			} else {
				$rows.hide();
				$rows.filter( function( i, v ) {
					var $t = $(this).find( '.project-top' );
					for ( var d = 0; d < words.length; ++d ) {
						if ( $t.text().toLowerCase().indexOf( words[d] ) != -1 ) {
							return true;
						}
					}
					return false;
				}).show();
			}
		});

		$( '#variant-selector' ).on( 'change', function( event ) {
			event.preventDefault();

			var $optionSelected = $( 'option:selected', this ),
				projectUrl = $optionSelected.data( 'projectUrl' );

			if ( projectUrl.length ) {
				window.location = projectUrl;
			}
		});
	});
</script>

<?php gp_tmpl_footer();
