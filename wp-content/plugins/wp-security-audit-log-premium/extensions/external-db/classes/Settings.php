<?php
/**
 * View: Settings
 *
 * External DB settings view.
 *
 * @since 1.0.0
 * @package Wsal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_Ext_Plugin' ) ) {
	exit( esc_html__( 'You are not allowed to view this page.', 'wp-security-audit-log' ) );
}

/**
 * Class WSAL_Ext_Settings for the plugin view.
 *
 * @package Wsal
 */
class WSAL_Ext_Settings extends WSAL_AbstractView {

	const QUERY_LIMIT = 100;

	/**
	 * Extension directory path.
	 *
	 * @var string
	 */
	public $_base_dir;

	/**
	 * Extension directory url.
	 *
	 * @var string
	 */
	public $_base_url;

	/**
	 * Method: Constructor
	 *
	 * @param WpSecurityAuditLog $plugin - Instance of WpSecurityAuditLog.
	 * @since  1.0.0
	 */
	public function __construct( WpSecurityAuditLog $plugin ) {
		// Call to parent class.
		parent::__construct( $plugin );

		// Ajax events for external tables of WSAL.
		add_action( 'wp_ajax_wsal_empty_buffer', array( $this, 'empty_temp_buffer' ), 10 );
		add_action( 'wp_ajax_wsal_test_connection', array( $this, 'test_external_db_connection' ), 10 );

		// Ajax events for meta tables of WSAL.
		add_action( 'wp_ajax_MigrateOccurrence', array( $this, 'MigrateOccurrence' ) );
		add_action( 'wp_ajax_MigrateMeta', array( $this, 'MigrateMeta' ) );
		add_action( 'wp_ajax_MigrateBackOccurrence', array( $this, 'MigrateBackOccurrence' ) );
		add_action( 'wp_ajax_MigrateBackMeta', array( $this, 'MigrateBackMeta' ) );

		// Ajax events for mirror and archive events.
		add_action( 'wp_ajax_MirroringNow', array( $this, 'MirroringNow' ) );
		add_action( 'wp_ajax_ArchivingNow', array( $this, 'ArchivingNow' ) );

		// Set the paths.
		$this->_base_dir = WSAL_BASE_DIR . 'extensions/external-db';
		$this->_base_url = WSAL_BASE_URL . 'extensions/external-db';
	}

	/**
	 * Method: Get View Title.
	 */
	public function GetTitle() {
		return __( 'External Database Configuration', 'wp-security-audit-log' );
	}

	/**
	 * Method: Get View Icon.
	 */
	public function GetIcon() {
		return 'dashicons-admin-generic';
	}

	/**
	 * Method: Get View Name.
	 */
	public function GetName() {
		return __( 'DB & Integrations', 'wp-security-audit-log' );
	}

	/**
	 * Method: Get View Weight.
	 */
	public function GetWeight() {
		return 11;
	}

	/**
	 * Method: Get View Header.
	 */
	public function Header() {
		wp_enqueue_style(
			'wsal-jq-timepick-css',
			$this->_base_url . '/js/jquery.timeentry/jquery.timeentry.css',
			array(),
			'2.0.0'
		);

		wp_enqueue_style(
			'wsal-external-css',
			$this->_base_url . '/css/styles.css',
			array(),
			filemtime( $this->_base_dir . '/css/styles.css' )
		);

		wp_enqueue_script(
			'wsal-jq-plugin-js',
			$this->_base_url . '/js/jquery.timeentry/jquery.plugin.min.js',
			array( 'jquery' ),
			'1.0.1',
			false
		);

		wp_enqueue_script(
			'wsal-jq-timepick-js',
			$this->_base_url . '/js/jquery.timeentry/jquery.timeentry.min.js',
			array( 'jquery' ),
			'2.0.1',
			false
		);
	}

	/**
	 * Method: Get View Footer.
	 */
	public function Footer() {
		?>
		<script type="text/javascript">
			var query_limit = <?php echo self::QUERY_LIMIT; ?>;
			var is_24_hours = <?php echo json_encode( $this->_plugin->wsalCommonClass->IsTime24Hours() ); ?>;

			jQuery(document).ready(function() {
				var archivingConfig = <?php echo json_encode( $this->_plugin->wsalCommonClass->IsArchivingEnabled() ); ?>;
				var archiving_status = jQuery('#archiving_status');
				var archivingTxtNot = jQuery('#archiving_status_text');

				function wsalArchivingStatus(checkbox, label){
					if (checkbox.prop('checked')) {
						label.text('On');
						jQuery('#ArchiveName').prop('required', true);
						jQuery('#ArchiveUser').prop('required', true);
						jQuery('#ArchiveHostname').prop('required', true);
					} else {
						label.text('Off');
						jQuery('#ArchiveName').prop('required', false);
						jQuery('#ArchiveUser').prop('required', false);
						jQuery('#ArchiveHostname').prop('required', false);
					}
				}
				// Set On.
				if ( archivingConfig ) {
					archiving_status.prop('checked', true);
				}
				wsalArchivingStatus(archiving_status, archivingTxtNot);

				archiving_status.on('change', function() {
					wsalArchivingStatus(archiving_status, archivingTxtNot);
				});

				var mirroringConfig = <?php echo json_encode( $this->_plugin->wsalCommonClass->IsMirroringEnabled() ); ?>;
				var mirroring_status = jQuery('#mirroring_status');
				var mirroringTxtNot = jQuery('#mirroring_status_text');

				function wsalMirroringStatus(checkbox, label){
					if (checkbox.prop('checked')) {
						label.text('On');
					} else {
						label.text('Off');
					}
				}
				// Set On
				if (mirroringConfig) {
					mirroring_status.prop('checked', true);
				}
				wsalMirroringStatus(mirroring_status, mirroringTxtNot);

				mirroring_status.on('change', function() {
					wsalMirroringStatus(mirroring_status, mirroringTxtNot);
				});

				// Show/Hide Mirroring type
				var checked = jQuery('input:radio[name=MirroringType]:checked').val();
				jQuery("#" + checked).show();
				setRequired(checked);

				jQuery('input:radio[name=MirroringType]').click(function() {
					var selected = jQuery(this).val();
					jQuery("tbody.desc").hide();
					jQuery("#" + selected).show(200);
					setRequired(selected);
				});

				function setRequired(mirroring_type){
					if (mirroring_type == "database") {
						jQuery('#MirrorName').prop('required', true);
						jQuery('#MirrorUser').prop('required', true);
						jQuery('#MirrorHostname').prop('required', true);
						jQuery('#Papertrail').prop('required', false);
					} else if (mirroring_type == "papertrail") {
						jQuery('#MirrorName').prop('required', false);
						jQuery('#MirrorUser').prop('required', false);
						jQuery('#MirrorHostname').prop('required', false);
						jQuery('#Papertrail').prop('required', true);
					} else {
						jQuery('#MirrorName').prop('required', false);
						jQuery('#MirrorUser').prop('required', false);
						jQuery('#MirrorHostname').prop('required', false);
						jQuery('#Papertrail').prop('required', false);
					}
				}
			});
		</script><?php

		// Extension script file.
		wp_enqueue_script(
			'wsal-external-js',
			$this->_base_url . '/js/wsal-external.js',
			array( 'jquery' ),
			filemtime( $this->_base_dir . '/js/wsal-external.js' ),
			true
		);
	}

	/**
	 * Method: Save form data.
	 */
	protected function Save() {
		// Get global $_POST array.
		$post_array = filter_input_array( INPUT_POST );

		$external_db_nonce = isset( $post_array['wsal_external_db'] ) ? sanitize_text_field( $post_array['wsal_external_db'] ) : false;
		$archive_db_nonce  = isset( $post_array['wsal_archive_db'] ) ? sanitize_text_field( $post_array['wsal_archive_db'] ) : false;
		$mirror_db_nonce   = isset( $post_array['wsal_mirror_db'] ) ? sanitize_text_field( $post_array['wsal_mirror_db'] ) : false;

		if ( ! empty( $external_db_nonce ) && wp_verify_nonce( $external_db_nonce, 'external-db-form' ) ) {
			// Use buffer.
			$adapter_use_buffer = isset( $post_array['AdapterUseBuffer'] ) ? sanitize_text_field( $post_array['AdapterUseBuffer'] ) : false;
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-use-buffer', $adapter_use_buffer );
		} elseif ( ! empty( $archive_db_nonce ) && wp_verify_nonce( $archive_db_nonce, 'archive-db-form' ) ) {
			// Save Archiving.
			$this->_plugin->wsalCommonClass->SetArchivingEnabled( isset( $post_array['SetArchiving'] ) );
			$this->_plugin->wsalCommonClass->SetArchivingStop( isset( $post_array['StopArchiving'] ) );

			if ( isset( $post_array['RunArchiving'] ) ) {
				$this->_plugin->wsalCommonClass->SetArchivingRunEvery( sanitize_text_field( $post_array['RunArchiving'] ) );

				// Reset old archiving cron job.
				wp_clear_scheduled_hook( 'run_archiving' );
			}

			$this->_plugin->wsalCommonClass->SetArchivingDateEnabled( 'date' === $post_array['ArchiveBy'] );
			if ( 'date' === $post_array['ArchiveBy'] ) {
				$archive_date = isset( $post_array['ArchivingDate'] ) ? (int) sanitize_text_field( $post_array['ArchivingDate'] ) : false;
				$archive_type = isset( $post_array['DateType'] ) ? sanitize_text_field( $post_array['DateType'] ) : false;
				$this->_plugin->wsalCommonClass->SetArchivingDate( $archive_date );
				$this->_plugin->wsalCommonClass->SetArchivingDateType( $archive_type );
			}

			// Get pruning date.
			$pruning_date = isset( $post_array['PruningDate'] ) ? (int) sanitize_text_field( $post_array['PruningDate'] ) : '';
			$pruning_unit = isset( $post_array['pruning-unit'] ) ? sanitize_text_field( $post_array['pruning-unit'] ) : false;
			$this->check_period_collision( $archive_date, $archive_type, $pruning_date, $pruning_unit );
			$pruning_date = ( ! empty( $pruning_date ) ) ? $pruning_date . ' ' . $pruning_unit : '';

			$this->_plugin->settings->SetPruningDateEnabled( isset( $post_array['PruneBy'] ) ? 'date' === $post_array['PruneBy'] : '' );
			$this->_plugin->settings->SetPruningDate( $pruning_date );
			$this->_plugin->settings->set_pruning_unit( $pruning_unit );
		} elseif ( ! empty( $mirror_db_nonce ) && wp_verify_nonce( $mirror_db_nonce, 'mirror-db-form' ) ) {
			/* Save Mirroring */
			$this->_plugin->wsalCommonClass->SetMirroringEnabled( isset( $post_array['SetMirroring'] ) );
			$this->_plugin->wsalCommonClass->SetMirroringStop( isset( $post_array['StopMirroring'] ) );
			if ( isset( $post_array['RunMirroring'] ) ) {
				$this->_plugin->wsalCommonClass->SetMirroringRunEvery( sanitize_text_field( $post_array['RunMirroring'] ) );
				// Reset old mirroring cron job.
				wp_clear_scheduled_hook( 'run_mirroring' );
			}
		}

		// Save External Adapter config.
		if (
			! empty( $post_array['AdapterUser'] )
			&& ! empty( $post_array['AdapterName'] )
			&& ! empty( $post_array['AdapterHostname'] )
			&& ! empty( $post_array['AdapterPassword'] )
			&& wp_verify_nonce( $external_db_nonce, 'external-db-form' )
		) {
			$adapter_type        = trim( $post_array['AdapterType'] );
			$adapter_user        = trim( $post_array['AdapterUser'] );
			$adapter_name        = trim( $post_array['AdapterName'] );
			$adapter_hostname    = trim( $post_array['AdapterHostname'] );
			$adapter_base_prefix = isset( $post_array['AdapterBasePrefix'] ) ? trim( $post_array['AdapterBasePrefix'] ) : false;
			$adapter_url_prefix  = isset( $post_array['AdapterUrlBasePrefix'] ) ? trim( $post_array['AdapterUrlBasePrefix'] ) : false;
			$password            = $this->_plugin->wsalCommonClass->EncryptPassword( trim( $post_array['AdapterPassword'] ) );
			$adapter_ssl         = isset( $post_array['AdapterSSL'] ) ? trim( $post_array['AdapterSSL'] ) : false;
			$adapter_cc          = isset( $post_array['AdapterClientCertificate'] ) ? trim( $post_array['AdapterClientCertificate'] ) : false;
			$adapter_ssl_ca      = isset( $post_array['AdapterSSL_CA'] ) ? trim( $post_array['AdapterSSL_CA'] ) : false;
			$adapter_ssl_cert    = isset( $post_array['AdapterSSL_Cert'] ) ? trim( $post_array['AdapterSSL_Cert'] ) : false;
			$adapter_ssl_key     = isset( $post_array['AdapterSSL_Key'] ) ? trim( $post_array['AdapterSSL_Key'] ) : false;

			// Check for URL base prefix.
			if ( 'on' === $adapter_url_prefix ) {
				$adapter_base_prefix = $this->get_url_base_prefix();
			}

			WSAL_Connector_ConnectorFactory::CheckConfig( $adapter_type, $adapter_user, $password, $adapter_name, $adapter_hostname, $adapter_base_prefix, $adapter_ssl, $adapter_cc, $adapter_ssl_ca, $adapter_ssl_cert, $adapter_ssl_key );

			/* Setting External Adapter DB config */
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-type', $adapter_type );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-user', $adapter_user );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-password', $password );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-name', $adapter_name );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-hostname', $adapter_hostname );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-base-prefix', $adapter_base_prefix );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-url-base-prefix', $adapter_url_prefix );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-ssl', $adapter_ssl );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-client-certificate', $adapter_cc );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-ssl-ca', $adapter_ssl_ca );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-ssl-cert', $adapter_ssl_cert );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'adapter-ssl-key', $adapter_ssl_key );

			$plugin = new WpSecurityAuditLog();
			$config = WSAL_Connector_ConnectorFactory::GetConfigArray( $adapter_type, $adapter_user, $password, $adapter_name, $adapter_hostname, $adapter_base_prefix, $adapter_ssl, $adapter_cc, $adapter_ssl_ca, $adapter_ssl_cert, $adapter_ssl_key );

			// Create tables in the database.
			$plugin->getConnector( $config )->installAll( true );
		} elseif (
			isset( $post_array['Archiving'] )
			&& wp_verify_nonce( $archive_db_nonce, 'archive-db-form' )
			&& ! empty( $post_array['ArchiveUser'] )
			&& ! empty( $post_array['ArchiveName'] )
			&& ! empty( $post_array['ArchiveHostname'] )
			&& ! empty( $post_array['ArchivePassword'] )
		) {
			$archive_type        = trim( $post_array['ArchiveType'] );
			$archive_user        = trim( $post_array['ArchiveUser'] );
			$archive_name        = trim( $post_array['ArchiveName'] );
			$archive_hostname    = trim( $post_array['ArchiveHostname'] );
			$archive_base_prefix = isset( $post_array['ArchiveBasePrefix'] ) ? trim( $post_array['ArchiveBasePrefix'] ) : false;
			$archive_url_prefix  = isset( $post_array['ArchiveUrlBasePrefix'] ) ? trim( $post_array['ArchiveUrlBasePrefix'] ) : false;
			$password            = $this->_plugin->wsalCommonClass->EncryptPassword( trim( $post_array['ArchivePassword'] ) );
			$archive_ssl         = isset( $post_array['ArchiveSSL'] ) ? trim( $post_array['ArchiveSSL'] ) : false;
			$archive_cc          = isset( $post_array['ArchiveClientCertificate'] ) ? trim( $post_array['ArchiveClientCertificate'] ) : false;
			$archive_ssl_ca      = isset( $post_array['ArchiveSSL_CA'] ) ? trim( $post_array['ArchiveSSL_CA'] ) : false;
			$archive_ssl_cert    = isset( $post_array['ArchiveSSL_Cert'] ) ? trim( $post_array['ArchiveSSL_Cert'] ) : false;
			$archive_ssl_key     = isset( $post_array['ArchiveSSL_Key'] ) ? trim( $post_array['ArchiveSSL_Key'] ) : false;

			// Check for URL base prefix.
			if ( 'on' === $archive_url_prefix ) {
				$archive_base_prefix = $this->get_url_base_prefix( 'archive' );
			}

			// Check archive DB connection.
			$archive_connection = WSAL_Connector_ConnectorFactory::CheckConfig( $archive_type, $archive_user, $password, $archive_name, $archive_hostname, $archive_base_prefix, $archive_ssl, $archive_cc, $archive_ssl_ca, $archive_ssl_cert, $archive_ssl_key );

			// If connection is stable, then enable archiving.
			if ( $archive_connection ) {
				$this->_plugin->wsalCommonClass->SetArchivingEnabled( true );
				$this->show_retention_notice();
			}

			/* Setting Archive DB config */
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-type', $archive_type );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-user', $archive_user );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-password', $password );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-name', $archive_name );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-hostname', $archive_hostname );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-base-prefix', $archive_base_prefix );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-url-base-prefix', $archive_url_prefix );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-ssl', $archive_ssl );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-client-certificate', $archive_cc );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-ssl-ca', $archive_ssl_ca );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-ssl-cert', $archive_ssl_cert );
			$this->_plugin->wsalCommonClass->AddGlobalOption( 'archive-ssl-key', $archive_ssl_key );

			$plugin = new WpSecurityAuditLog();
			$config = WSAL_Connector_ConnectorFactory::GetConfigArray( $archive_type, $archive_user, $password, $archive_name, $archive_hostname, $archive_base_prefix, $archive_ssl, $archive_cc, $archive_ssl_ca, $archive_ssl_cert, $archive_ssl_key );
			$plugin->getConnector( $config )->installAll( true );
		} elseif (
			isset( $post_array['Mirroring'] )
			&& wp_verify_nonce( $mirror_db_nonce, 'mirror-db-form' )
		) {
			// Mirror type.
			$mirroring_type = isset( $post_array['MirroringType'] ) ? sanitize_text_field( $post_array['MirroringType'] ) : false;

			if (
				! empty( $mirroring_type )
				&& 'database' === $mirroring_type
				&& ! empty( $post_array['MirrorUser'] )
				&& ! empty( $post_array['MirrorName'] )
				&& ! empty( $post_array['MirrorHostname'] )
				&& ! empty( $post_array['MirrorPassword'] )
			) {
				$mirror_type        = trim( $post_array['MirrorType'] );
				$mirror_user        = trim( $post_array['MirrorUser'] );
				$mirror_name        = trim( $post_array['MirrorName'] );
				$mirror_hostname    = trim( $post_array['MirrorHostname'] );
				$mirror_base_prefix = isset( $post_array['MirrorBasePrefix'] ) ? trim( $post_array['MirrorBasePrefix'] ) : false;
				$mirror_url_prefix  = isset( $post_array['MirrorUrlBasePrefix'] ) ? trim( $post_array['MirrorUrlBasePrefix'] ) : false;
				$password           = $this->_plugin->wsalCommonClass->EncryptPassword( trim( $post_array['MirrorPassword'] ) );
				$mirror_ssl         = isset( $post_array['MirrorSSL'] ) ? trim( $post_array['MirrorSSL'] ) : false;
				$mirror_cc          = isset( $post_array['MirrorClientCertificate'] ) ? trim( $post_array['MirrorClientCertificate'] ) : false;
				$mirror_ssl_ca      = isset( $post_array['MirrorSSL_CA'] ) ? trim( $post_array['MirrorSSL_CA'] ) : false;
				$mirror_ssl_cert    = isset( $post_array['MirrorSSL_Cert'] ) ? trim( $post_array['MirrorSSL_Cert'] ) : false;
				$mirror_ssl_key     = isset( $post_array['MirrorSSL_Key'] ) ? trim( $post_array['MirrorSSL_Key'] ) : false;

				// Check for URL base prefix.
				if ( 'on' === $mirror_url_prefix ) {
					$mirror_base_prefix = $this->get_url_base_prefix( 'mirror' );
				}

				// Check if the config is working.
				WSAL_Connector_ConnectorFactory::CheckConfig( $mirror_type, $mirror_user, $password, $mirror_name, $mirror_hostname, $mirror_base_prefix, $mirror_ssl, $mirror_cc, $mirror_ssl_ca, $mirror_ssl_cert, $mirror_ssl_key );

				/* Setting Archive DB config */
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-type', $mirror_type );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-user', $mirror_user );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-password', $password );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-name', $mirror_name );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-hostname', $mirror_hostname );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-base-prefix', $mirror_base_prefix );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-url-base-prefix', $mirror_url_prefix );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-ssl', $mirror_ssl );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-client-certificate', $mirror_cc );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-ssl-ca', $mirror_ssl_ca );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-ssl-cert', $mirror_ssl_cert );
				$this->_plugin->wsalCommonClass->AddGlobalOption( 'mirror-ssl-key', $mirror_ssl_key );

				$this->_plugin->wsalCommonClass->SetMirroringType( $mirroring_type );

				$plugin = new WpSecurityAuditLog();
				$config = WSAL_Connector_ConnectorFactory::GetConfigArray( $mirror_type, $mirror_user, $password, $mirror_name, $mirror_hostname, $mirror_base_prefix, $mirror_ssl, $mirror_cc, $mirror_ssl_ca, $mirror_ssl_cert, $mirror_ssl_key );
				$plugin->getConnector( $config )->installAll( true );

			} elseif (
				! empty( $mirroring_type )
				&& 'papertrail' === $mirroring_type
				&& ! empty( $post_array['Papertrail'] )
			) {
				$this->_plugin->wsalCommonClass->SetMirroringType( $mirroring_type );
				$papertrail = trim( sanitize_text_field( $post_array['Papertrail'] ) );
				$this->_plugin->wsalCommonClass->SetPapertrailDestination( $papertrail );
				$this->_plugin->wsalCommonClass->SetPapertrailColorization( isset( $post_array['Colorization'] ) );
			} elseif ( ! empty( $mirroring_type ) && 'syslog' === $mirroring_type ) {
				$this->_plugin->wsalCommonClass->SetMirroringType( $mirroring_type );
			}
		}
	}

	/**
	 * Method: Return URL based prefix for DB.
	 *
	 * @param string $name - Name of the DB type.
	 * @return string - URL based prefix.
	 */
	public function get_url_base_prefix( $name = '' ) {
		// Get home URL.
		$home_url  = get_home_url();
		$protocols = array( 'http://', 'https://' ); // URL protocols.
		$home_url  = str_replace( $protocols, '', $home_url ); // Replace URL protocols.
		$home_url  = str_replace( array( '.', '-' ), '_', $home_url ); // Replace `.` with `_` in the URL.

		// Concat name of the DB type at the end.
		if ( ! empty( $name ) ) {
			$home_url .= '_';
			$home_url .= $name;
			$home_url .= '_';
		} else {
			$home_url .= '_';
		}

		// Return the prefix.
		return $home_url;
	}

	/**
	 * Checks if the necessary tables are available.
	 *
	 * @return bool true|false
	 */
	protected function CheckIfTableExist() {
		return $this->_plugin->wsalCommonClass->IsInstalled();
	}

	/**
	 * Checks if there is the adapter setting.
	 *
	 * @return bool true|false
	 */
	protected function CheckSetting() {
		$config = $this->_plugin->settings->GetAdapterConfig( 'adapter-type' );
		if ( ! empty( $config ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Method: Ajax request handler to empty temporary
	 * events buffer.
	 */
	public function empty_temp_buffer() {
		if ( ! $this->_plugin->settings->CurrentUserCan( 'edit' ) ) {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Access Denied.', 'wp-security-audit-log' ),
			) );
			exit();
		}

		$nonce = filter_input( INPUT_POST, 'nonce', FILTER_SANITIZE_STRING );
		if ( wp_verify_nonce( $nonce, 'wsal-empty-buffer' ) ) {
			// Call to log temporary alerts and then empty the buffer.
			$response = $this->_plugin->alerts->log_temp_alerts();

			if ( true === $response ) {
				echo wp_json_encode( array(
					'success' => true,
					'message' => esc_html__( 'Events successfully sent to database.', 'wp-security-audit-log' ),
				) );
			} else {
				echo wp_json_encode( array(
					'success' => false,
					'message' => esc_html__( 'An error occurred while sending events to database.', 'wp-security-audit-log' ),
				) );
			}
		} else {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Nonce verification failed.', 'wp-security-audit-log' ),
			) );
		}
		exit();
	}

	/**
	 * Migrate to external database (Metadata table)
	 */
	public function MigrateMeta() {
		$limit    = self::QUERY_LIMIT;
		$index    = intval( $_POST['index'] );
		$response = $this->_plugin->wsalCommonClass->MigrateMeta( $index, $limit );
		echo json_encode( $response );
		exit;
	}

	/**
	 * Migrate to external database (Occurrences table)
	 */
	public function MigrateOccurrence() {
		$limit    = self::QUERY_LIMIT;
		$index    = intval( $_POST['index'] );
		$response = $this->_plugin->wsalCommonClass->MigrateOccurrence( $index, $limit );
		echo json_encode( $response );
		exit;
	}

	/**
	 * Migrate back to WP database (Metadata table)
	 */
	public function MigrateBackMeta() {
		$limit    = self::QUERY_LIMIT;
		$index    = intval( $_POST['index'] );
		$response = $this->_plugin->wsalCommonClass->MigrateBackMeta( $index, $limit );
		echo json_encode( $response );
		exit;
	}

	/**
	 * Migrate back to WP database (Occurrences table)
	 */
	public function MigrateBackOccurrence() {
		$limit    = self::QUERY_LIMIT;
		$index    = intval( $_POST['index'] );
		$response = $this->_plugin->wsalCommonClass->MigrateBackOccurrence( $index, $limit );
		echo json_encode( $response );
		exit;
	}

	/**
	 * Mirroring alerts Now.
	 */
	public function MirroringNow() {
		$this->_plugin->wsalCommonClass->mirroring_alerts();
		exit;
	}

	/**
	 * Archiving alerts Now.
	 */
	public function ArchivingNow() {
		$this->_plugin->wsalCommonClass->archiving_alerts();
		exit;
	}

	/**
	 * Method: Render view.
	 */
	public function Render() {
		if ( ! $this->_plugin->settings->CurrentUserCan( 'edit' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'wp-security-audit-log' ) );
		}

		// Get $_POST global array.
		$post_array = filter_input_array( INPUT_POST );

		if ( isset( $post_array['submit'] ) ) :
			try {
				$this->Save();
				?>
				<div class="updated">
					<p><?php esc_html_e( 'Settings have been saved.', 'wp-security-audit-log' ); ?></p>
				</div>
				<?php
			} catch ( Exception $ex ) {
				?>
				<div class="error"><p><?php esc_html_e( 'Error: ', 'wp-security-audit-log' ); ?><?php echo $ex->getMessage(); ?></p></div>
				<?php
			}
		else :
			?>
			<div id="ajax-response" class="notice hidden">
				<img src="<?php echo esc_url( $this->_base_url ); ?>/css/default.gif">
				<p>
					<?php esc_html_e( 'Please do not close this window while migrating alerts.', 'wp-security-audit-log' ); ?>
					<span id="ajax-response-counter"></span>
				</p>
			</div>
			<?php
		endif;
		?>
		<div id="wsal-external-db">
			<h2 id="wsal-tabs" class="nav-tab-wrapper">
				<a href="#external" class="nav-tab"><?php esc_html_e( 'External Database', 'wp-security-audit-log' ); ?></a>
				<a href="#mirroring" class="nav-tab"><?php esc_html_e( 'Mirroring', 'wp-security-audit-log' ); ?></a>
				<a href="#archiving" class="nav-tab"><?php esc_html_e( 'Archiving', 'wp-security-audit-log' ); ?></a>
			</h2>
			<div class="nav-tabs">
				<table class="form-table wsal-tab" id="external">
					<form method="post" autocomplete="off">
						<input type="hidden" name="page" value="<?php echo filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING ); ?>" />
						<?php wp_nonce_field( 'external-db-form', 'wsal_external_db' ); ?>
						<tbody class="widefat">
							<tr>
								<td colspan="2"><?php esc_html_e( 'Configure the database connection details below to store the WordPress audit log in an external database and not in the WordPress database.', 'wp-security-audit-log' ); ?></td>
							</tr>
							<!-- Adapter Database Configuration -->
							<?php $this->get_database_fields( 'adapter' ); ?>
							<tr>
								<th><label for="Current"><?php esc_html_e( 'Current Connection Details', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<?php $adapter_name     = $this->_plugin->settings->GetAdapterConfig( 'adapter-name' ); ?>
									<?php $adapter_hostname = $this->_plugin->settings->GetAdapterConfig( 'adapter-hostname' ); ?>
									<span class="current-connection"><?php esc_html_e( 'Currently Connected to database', 'wp-security-audit-log' ); ?>
									<strong><?php echo ( ! empty( $adapter_name ) ? esc_html( $adapter_name ) : 'Default' ); ?></strong>
									on server <strong><?php echo ( ! empty( $adapter_hostname ) ? esc_html( $adapter_hostname ) : 'Current' ); ?></strong></span>
								</td>
							</tr>
						</tbody>
						<tbody>
							<tr>
								<td colspan="2">
									<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save & Test Changes', 'wp-security-audit-log' ); ?>" />
									<input type="hidden" id="adapter-test-nonce" value="<?php echo esc_attr( wp_create_nonce( 'wsal-adapter-test' ) ); ?>" />
									<input type="button" data-connection="adapter" id="adapter-test" class="button button-primary" value="<?php esc_attr_e( 'Test Connection', 'wp-security-audit-log' ); ?>" />
								</td>
							</tr>
							<?php
							if ( $this->CheckIfTableExist() && $this->CheckSetting() ) {
								$disabled = '';
							} else {
								$disabled = 'disabled';
							}
							?>
							<tr>
								<td colspan="2">
									<input type="button" name="wsal-migrate" id="wsal-migrate" class="button button-primary" value="Migrate Events from WordPress Database" <?php echo esc_attr( $disabled ); ?> />
									<span class="description">
										<?php esc_html_e( 'Migrate existing WordPress Security Events from the WordPress database to the new external database.', 'wp-security-audit-log' ); ?>
									</span>
								</td>
							</tr>
							<?php
							if ( ! $this->CheckSetting() ) {
								$disabled = 'disabled';
							} else {
								$disabled = '';
							}
							?>
							<tr>
								<td colspan="2">
									<input type="button" name="wsal-migrate-back" id="wsal-migrate-back" class="button button-primary" value="Switch to WordPress Database" <?php echo esc_attr( $disabled ); ?> />
									<span class="description">
										<?php esc_html_e( 'Remove the external database and start using the WordPress database again. In the process the events will be automatically migrated to the WordPress database.', 'wp-security-audit-log' ); ?>
									</span>
								</td>
							</tr>
						</tbody>
					</form>
				</table>
				<!-- Tab External Database -->
				<table class="form-table wsal-tab" id="mirroring">
					<form method="post" autocomplete="off">
						<input type="hidden" name="Mirroring" value="1" />
						<?php wp_nonce_field( 'mirror-db-form', 'wsal_mirror_db' ); ?>
						<tbody class="widefat">
							<tr>
								<td colspan="2">
									<?php esc_html_e( 'When you enable this option the WordPress audit trail will be mirrored to the configured database / data source.', 'wp-security-audit-log' ); ?><br />
									<?php esc_html_e( 'By mirroring the audit trail you ensure that you always have a backup copy of the audit trail and also ensure that the audit trail is not tampered with in the unfortunate event of an attack.', 'wp-security-audit-log' ); ?>
								</td>
							</tr>
							<tr>
								<th><label for="Mirroring"><?php esc_html_e( 'Enable Mirroring', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<fieldset>
										<label for="Mirroring">
											<span class="f-container">
												<span class="f-left">
													<input type="checkbox" name="SetMirroring" value="1" class="switch" id="mirroring_status" />
													<label for="mirroring_status"></label>
												</span>
												<span class="f-right f-text"><span id="mirroring_status_text"></span></span>
											</span>
										</label>
									</fieldset>
								</td>
							</tr>
							<tr>
								<th><label for="options"><?php esc_html_e( 'Mirroring options', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<?php $type = $this->_plugin->wsalCommonClass->GetMirroringType(); ?>
									<fieldset>
										<p>
											<input id="mirroring_db" type="radio" name="MirroringType" value="database" <?php echo ( 'database' == $type ) ? 'checked="checked"' : false; ?> />
											<label for="mirroring_db"><?php esc_html_e( 'Database', 'wp-security-audit-log' ); ?></label>
											<?php
											if ( 'database' == $type ) {
												esc_html_e( '(Configured and working)', 'wp-security-audit-log' );
											}
											?>
										</p>
										<p>
											<input id="mirroring_papertrail" type="radio" name="MirroringType" value="papertrail" <?php echo ( 'papertrail' == $type ) ? 'checked="checked"' : false; ?> />
											<label for="mirroring_papertrail"><?php esc_html_e( 'Papertrail', 'wp-security-audit-log' ); ?></label>
											<?php
											if ( 'papertrail' == $type ) {
												esc_html_e( '(Configured and working)', 'wp-security-audit-log' );
											}
											?>
										</p>
										<p>
											<input id="mirroring_syslog" type="radio" name="MirroringType" value="syslog" <?php echo ( 'syslog' == $type ) ? 'checked="checked"' : false; ?> />
											<label for="mirroring_syslog"><?php esc_html_e( 'SysLog', 'wp-security-audit-log' ); ?></label>
											<?php
											if ( 'syslog' == $type ) {
												esc_html_e( '(Configured and working)', 'wp-security-audit-log' );
											}
											?>
										</p>
									</fieldset>
								</td>
						</tbody>
						<tbody id="database" class="widefat desc" style="display:none">
							<!-- Mirroring Database Configuration -->
							<?php $this->get_database_fields( 'mirror' ); ?>
						</tbody>
						<tbody id="papertrail" class="widefat desc" style="display:none">
							<!-- Papertrail Configuration -->
							<tr>
								<td colspan="2">
									<?php esc_html_e( 'Configure the below options to mirror the WordPress audit trail to Papertrail.', 'wp-security-audit-log' ); ?>
								</td>
							</tr>
							<tr>
								<th><label for="Papertrail"><?php esc_html_e( 'Destination', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<fieldset>
										<?php $destination = $this->_plugin->wsalCommonClass->GetPapertrailDestination(); ?>
										<input type="text" id="Papertrail" name="Papertrail" value="<?php echo $destination; ?>" style="display: block; width: 250px;" />
										<span class="description">
											<?php esc_html_e( 'Specify your destination. You can find your Papertrail Destination in the', 'wp-security-audit-log' ); ?>
											&nbsp;<a href="https://papertrailapp.com/account/destinations" target="_blank">Log Destinations</a>&nbsp;
											<?php esc_html_e( 'section of your Papertrail account page. ', 'wp-security-audit-log' ); ?><br />
											<?php esc_html_e( 'It should have the following format:', 'wp-security-audit-log' ); ?>
											&nbsp;<strong>logs4.papertrailapp.com:54321</strong>
										</span>
									</fieldset>
								</td>
							</tr>
							<tr>
								<th><label for="Colorization"><?php esc_html_e( 'Colorization', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<fieldset>
										<label for="Colorization">
											<input type="checkbox" name="Colorization" value="1" id="Colorization"
											<?php
											if ( $this->_plugin->wsalCommonClass->IsPapertrailColorizationEnabled() ) {
												echo ' checked="checked"';
											}
											?>
											/> <?php esc_html_e( 'Enable', 'wp-security-audit-log' ); ?>
										</label>
									</fieldset>
								</td>
							</tr>
						</tbody>
						<tbody id="syslog" class="widefat desc" style="display:none">
							<!-- SysLog Nothing to config -->
						</tbody>
						<tbody class="widefat">
							<?php $this->get_schedule_fields( 'mirroring' ); ?>
						</tbody>
						<tbody>
							<?php
							if ( ! $this->_plugin->wsalCommonClass->IsMirroringEnabled() ) {
								$disabled = 'disabled';
							} else {
								$disabled = '';
							}
							?>
							<tr>
								<td colspan="2">
									<input type="submit" name="submit" class="button button-primary" value="Save Changes" />
									<input type="hidden" id="mirror-test-nonce" value="<?php echo esc_attr( wp_create_nonce( 'wsal-mirror-test' ) ); ?>" />
									<input type="button" data-connection="mirror" id="mirror-test" class="button button-primary" value="<?php esc_attr_e( 'Test Connection', 'wp-security-audit-log' ); ?>" />
									<input type="button" id="wsal-mirroring" class="button button-primary" value="<?php esc_attr_e( 'Execute Mirroring Now', 'wp-security-audit-log' ); ?>" <?php echo esc_attr( $disabled ); ?> />
								</td>
							</tr>
						</tbody>
					</form>
				</table>
				<!-- Tab Mirroring -->
				<table class="form-table wsal-tab" id="archiving">
					<form method="post" autocomplete="off">
						<input type="hidden" name="Archiving" value="1" />
						<?php wp_nonce_field( 'archive-db-form', 'wsal_archive_db' ); ?>
						<tbody class="widefat">
							<tr>
								<td colspan="2">
									<?php esc_html_e( 'When you enable archiving you can archive a number of events from the main database to the archiving database.', 'wp-security-audit-log' ); ?><br />
									<?php esc_html_e( 'This means that there will be less events in the main database, therefore tasks such as searching will be much faster and the database will be easier to manage.', 'wp-security-audit-log' ); ?>
								</td>
							</tr>
							<tr>
								<th><label for="Archiving"><?php esc_html_e( 'Enable Archiving', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<fieldset>
										<label for="Archiving">
											<span class="f-container">
												<span class="f-left">
													<input type="checkbox" name="SetArchiving" value="1" class="switch" id="archiving_status"/>
													<label for="archiving_status"></label>
												</span>
												<span class="f-right f-text"><span id="archiving_status_text"></span></span>
											</span>
										</label>
									</fieldset>
								</td>
							</tr>
							<tr>
								<th><label for="options"><?php esc_html_e( 'Archiving options', 'wp-security-audit-log' ); ?></label></th>
								<td>
									<fieldset>
										<?php
										$nbld      = $this->_plugin->wsalCommonClass->IsArchivingDateEnabled();
										$date_type = strtolower( $this->_plugin->wsalCommonClass->GetArchivingDateType() );

										// If date type is weeks then update the date.
										if ( 'weeks' === $date_type ) {
											$this->_plugin->wsalCommonClass->SetArchivingDate( '1' );
											$this->_plugin->wsalCommonClass->SetArchivingDateType( 'years' );
											$date_type = 'years';
										}

										// Update archiving options if it is enabled by limit.
										if ( $this->_plugin->wsalCommonClass->IsArchivingLimitEnabled() ) {
											// Set date type archiving option to true.
											$this->_plugin->wsalCommonClass->SetArchivingDateEnabled( true );
											$this->_plugin->wsalCommonClass->SetArchivingDate( '6' );
											$this->_plugin->wsalCommonClass->SetArchivingDateType( 'months' );

											// Set limit archiving option to false.
											$this->_plugin->wsalCommonClass->SetArchivingLimitEnabled( false );
										}
										?>
										<label for="ArchivingDate">
											<?php esc_html_e( 'Archive events older than', 'wp-security-audit-log' ); ?>
											<input type="hidden" name="ArchiveBy" value="date" />
											<input type="number" id="ArchivingDate" name="ArchivingDate" value="<?php echo esc_attr( $this->_plugin->wsalCommonClass->GetArchivingDate() ); ?>" />
											<select name="DateType" class="age-type">
												<option value="months" <?php echo ( 'months' === $date_type ) ? 'selected="selected"' : false; ?>>
													<?php esc_html_e( 'months', 'wp-security-audit-log' ); ?>
												</option>
												<option value="years" <?php echo ( 'years' === $date_type ) ? 'selected="selected"' : false; ?>>
													<?php esc_html_e( 'years', 'wp-security-audit-log' ); ?>
												</option>
											</select>
										</label>
									</fieldset>
									<span class="description">
										<?php esc_html_e( 'The configured archiving options will override the Security Events Pruning settings configured in the plugin’s settings.', 'wp-security-audit-log' ); ?>
									</span>
								</td>
							</tr>
							<!-- Archive Database Configuration -->
							<?php $this->get_database_fields( 'archive' ); ?>
						</tbody>
						<tbody class="widefat">
							<?php $this->get_schedule_fields( 'archiving' ); ?>
						</tbody>
						<tbody>
							<?php
							if ( ! $this->_plugin->wsalCommonClass->IsArchivingEnabled() ) {
								$disabled = 'disabled';
							} else {
								$disabled = '';
							}
							?>
							<tr>
								<td colspan="2">
									<input type="submit" name="submit" class="button button-primary" value="Save Changes" />
									<input type="hidden" id="archive-test-nonce" value="<?php echo esc_attr( wp_create_nonce( 'wsal-archive-test' ) ); ?>" />
									<input type="button" data-connection="archive" id="archive-test" class="button button-primary" value="<?php esc_attr_e( 'Test Connection', 'wp-security-audit-log' ); ?>" />
									<input type="button" id="wsal-archiving" class="button button-primary" value="<?php esc_attr_e( 'Execute Archiving Now', 'wp-security-audit-log' ); ?>" <?php echo esc_attr( $disabled ); ?> />
								</td>
							</tr>
						</tbody>
					</form>
				</table>
				<!-- Tab Archiving -->
			</div>
		</div>
		<?php
	}

	/**
	 * Common function for the Database fields.
	 *
	 * @param string $name - Name of DB Type.
	 */
	private function get_database_fields( $name ) {
		$label_name  = ucfirst( $name );
		$option_name = strtolower( $name );

		// $_POST array arguments.
		$post_array_args = array(
			$label_name . 'Name'     => FILTER_SANITIZE_STRING,
			$label_name . 'User'     => FILTER_SANITIZE_STRING,
			$label_name . 'Hostname' => FILTER_SANITIZE_STRING,
			$label_name . 'SSL_CA'   => FILTER_SANITIZE_STRING,
			$label_name . 'SSL_Cert' => FILTER_SANITIZE_STRING,
			$label_name . 'SSL_Key'  => FILTER_SANITIZE_STRING,
		);

		// Get $_POST array.
		$post_array = filter_input_array( INPUT_POST, $post_array_args );
		?>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>Type"><?php esc_html_e( 'Database Type', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<?php $type = strtolower( $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-type' ) ); ?>
					<select name="<?php echo esc_attr( $label_name ); ?>Type" id="<?php echo esc_attr( $label_name ); ?>Type">
						<option value="MySQL" <?php echo ( 'mysql' === $type ) ? 'selected="selected"' : false; ?>>
							<?php esc_html_e( 'DB MySQL', 'wp-security-audit-log' ); ?>
						</option>
					</select>
					<br/>
					<span class="description">
						<?php esc_html_e( 'At the moment only MySQL server is support. Support for other different SQL sever types will be available in the future.', 'wp-security-audit-log' ); ?>
					</span>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>Name"><?php esc_html_e( 'Database Name', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<?php
					$name = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-name' );
					if ( empty( $name ) && isset( $post_array[ $label_name . 'Name' ] ) ) {
						$name = $post_array[ $label_name . 'Name' ];
					}
					?>
					<input type="text" id="<?php echo esc_attr( $label_name ); ?>Name" name="<?php echo esc_attr( $label_name ); ?>Name" value="<?php echo esc_attr( $name ); ?>" style="display: block; width: 250px;" />
					<span class="description">
						<?php esc_html_e( 'Specify the name of the database where you will store the WordPress Audit Log.', 'wp-security-audit-log' ); ?>
					</span>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>User"><?php esc_html_e( 'Database User', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<?php
					$user = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-user' );
					if ( empty( $user ) && isset( $post_array[ $label_name . 'User' ] ) ) {
						$user = $post_array[ $label_name . 'User' ];
					}
					?>
					<input type="text" id="A<?php echo esc_attr( $label_name ); ?>User" name="<?php echo esc_attr( $label_name ); ?>User" value="<?php echo esc_attr( $user ); ?>" style="display: block; width: 250px;" />
					<span class="description">
						<?php esc_html_e( 'Specify the username to be used to connect to the database.', 'wp-security-audit-log' ); ?>
					</span>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>Password"><?php esc_html_e( 'Database Password', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<input type="password" id="<?php echo esc_attr( $label_name ); ?>Password" name="<?php echo esc_attr( $label_name ); ?>Password" style="display: block; width: 250px;" />
					<span class="description">
						<?php esc_html_e( 'Specify the password each time you want to submit new changes. For security reasons, the plugin does not store the password in this form.', 'wp-security-audit-log' ); ?>
					</span>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>Hostname"><?php esc_html_e( 'Database Hostname', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<?php
					$hostname = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-hostname' );
					if ( empty( $hostname ) && isset( $post_array[ $label_name . 'Hostname' ] ) ) {
						$hostname = $post_array[ $label_name . 'Hostname' ];
					}
					?>
					<input type="text" id="<?php echo esc_attr( $label_name ); ?>Hostname" name="<?php echo esc_attr( $label_name ); ?>Hostname" value="<?php echo esc_attr( $hostname ); ?>" style="display: block; width: 250px;" />
					<span class="description">
						<?php esc_html_e( 'Specify the hostname or IP address of the database server.', 'wp-security-audit-log' ); ?>
					</span>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>BasePrefix"><?php esc_html_e( 'Database Base prefix', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<?php
					$base_prefix = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-base-prefix' );
					$url_base_prefix = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-url-base-prefix', false );
					if ( empty( $base_prefix ) ) {
						$base_prefix = $this->_plugin->wsalCommonClass->GetOptionByName( 'adapter-base-prefix' );
						if ( empty( $base_prefix ) ) {
							$base_prefix = $GLOBALS['wpdb']->base_prefix;
						}
					}
					?>
					<input type="text" id="<?php echo esc_attr( $label_name ); ?>BasePrefix" name="<?php echo esc_attr( $label_name ); ?>BasePrefix" value="<?php echo esc_attr( $base_prefix ); ?>" style="display: block; width: 250px;" />
					<span class="description">
						<?php esc_html_e( 'Specify a prefix for the database tables of the audit log. Ideally this prefix should be different from the one you use for WordPress so it is not guessable.', 'wp-security-audit-log' ); ?>
					</span>
					<br />
					<input type="checkbox" id="<?php echo esc_attr( $label_name ); ?>UrlBasePrefix" name="<?php echo esc_attr( $label_name ); ?>UrlBasePrefix" <?php checked( $url_base_prefix, 'on' ); ?> />
					<label for="<?php echo esc_attr( $label_name ); ?>UrlBasePrefix"><?php esc_html_e( 'Use website URL as table prefix', 'wp-security-audit-log' ); ?></label>
				</fieldset>
			</td>
		</tr>
		<?php if ( 'adapter' === $option_name ) : ?>
			<tr>
				<th><label for="<?php echo esc_attr( $label_name ); ?>UseBuffer"><?php esc_html_e( 'Use Buffer', 'wp-security-audit-log' ); ?></label></th>
				<td>
					<fieldset>
						<?php
						$checked     = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-use-buffer' );
						$checked     = ! empty( $checked ) ? $checked : false;
						$temp_alerts = get_option( 'wsal_temp_alerts', array() );
						?>
						<label for="<?php echo esc_attr( $label_name ); ?>UseBuffer">
							<input type="checkbox" id="<?php echo esc_attr( $label_name ); ?>UseBuffer" name="<?php echo esc_attr( $label_name ); ?>UseBuffer" value="1" <?php checked( $checked ); ?> />
							<?php esc_html_e( 'Send the events through the buffer so if the connection to the external database is slow the performance of the website is not affected.', 'wp-security-audit-log' ); ?>
						</label>
						<span class="description">
							<?php esc_html_e( 'When the buffer is enabled events are sent to the database every 10 minutes, so the audit log is not updated in real time. Use the button below to clear the buffer and send the events now.', 'wp-security-audit-log' ); ?>
						</span>
						<br />
						<input type="button" class="button" id="wsal-empty-buffer" data-empty-buffer-nonce="<?php echo esc_attr( wp_create_nonce( 'wsal-empty-buffer' ) ); ?>" value="<?php esc_attr_e( 'Send Events to Database', 'wp-security-audit-log' ); ?>" <?php echo ( ! $checked || empty( $temp_alerts ) ) ? 'disabled' : false; ?> />
					</fieldset>
				</td>
			</tr>
		<?php endif; ?>
		<?php if ( 'archive' === $option_name && $this->_plugin->settings->IsArchivingEnabled() ) : ?>
			<tr>
				<th><label for="delete1"><?php esc_html_e( 'Audit Log Retention', 'wp-security-audit-log' ); ?></label></th>
				<td>
					<fieldset>
						<?php $nbld = ! $this->_plugin->settings->IsPruningDateEnabled(); ?>
						<label for="delete0">
							<input type="radio" id="delete0" name="PruneBy" value="" <?php checked( $nbld ); ?> />
							<?php echo esc_html__( 'None', 'wp-security-audit-log' ); ?>
						</label>
					</fieldset>
					<fieldset id="prune_by_date">
						<?php
						// Purning enabled option.
						$nbld = $this->_plugin->settings->IsPruningDateEnabled();

						// Find and replace ` months` in the string.
						$pruning_date = str_replace( ' months', '', $this->_plugin->settings->GetPruningDate() );
						$pruning_date = str_replace( ' years', '', $pruning_date );
						$pruning_unit = $this->_plugin->settings->get_pruning_unit();
						?>
						<label for="delete1">
							<input type="radio" id="delete1" name="PruneBy" value="date" <?php checked( $nbld ); ?> />
							<?php echo esc_html__( 'Delete events older than', 'wp-security-audit-log' ); ?>
						</label>
						<input type="text" id="PruningDate" name="PruningDate"
							value="<?php echo esc_attr( $pruning_date ); ?>"
							onfocus="jQuery('#delete1').attr('checked', true);"
						/>
						<select name="pruning-unit" id="pruning-unit">
							<option value="months" <?php echo ( 'months' === $pruning_unit ) ? 'selected' : false; ?>><?php esc_html_e( 'Months', 'wp-security-audit-log' ); ?></option>
							<option value="years" <?php echo ( 'years' === $pruning_unit ) ? 'selected' : false; ?>><?php esc_html_e( 'Years', 'wp-security-audit-log' ); ?></option>
						</select>
					</fieldset>
					<p class="description">
						<?php
						$next = wp_next_scheduled( 'wsal_cleanup' );
						echo esc_html__( 'Next Scheduled Cleanup is in ', 'wp-security-audit-log' );
						echo esc_html( human_time_diff( current_time( 'timestamp' ), $next ) );
						echo '<!-- ' . esc_html( date( 'dMy H:i:s', $next ) ) . ' --> ';
						echo sprintf(
							/* translators: Events Purning Link */
							esc_html__( '(or %s)', 'wp-security-audit-log' ),
							'<a href="' . esc_url( add_query_arg( 'action', 'AjaxRunCleanup', admin_url( 'admin-ajax.php' ) ) ) . '">' . esc_html__( 'Run Manually', 'wp-security-audit-log' ) . '</a>'
						);
						?>
					</p>
				</td>
			</tr>
		<?php endif; ?>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>SSL"><?php esc_html_e( 'SSL', 'wp-security-audit-log' ); ?></label></th>
			<td>
				<fieldset>
					<?php $checked = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-ssl', 0 ); ?>
					<label for="<?php echo esc_attr( $label_name ); ?>SSL">
						<input type="checkbox" id="<?php echo esc_attr( $label_name ); ?>SSL" name="<?php echo esc_attr( $label_name ); ?>SSL" value="1" <?php checked( $checked ); ?> />
						<?php esc_html_e( 'Enable to use SSL to connect with the MySQL server.', 'wp-security-audit-log' ); ?>
					</label>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="<?php echo esc_attr( $label_name ); ?>ClientCertificate"><?php esc_html_e( 'Client Certificate', 'wp-security-audit-log' ); ?></label></th>
			<td id="<?php echo esc_attr( $label_name ); ?>SSLCertificate">
				<fieldset>
					<?php $checked = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-client-certificate', 0 ); ?>
					<label for="<?php echo esc_attr( $label_name ); ?>ClientCertificate">
						<input type="checkbox" id="<?php echo esc_attr( $label_name ); ?>ClientCertificate" name="<?php echo esc_attr( $label_name ); ?>ClientCertificate" value="1" <?php checked( $checked ); ?> />
						<?php esc_html_e( 'Enable to use client certificates to connect with the MySQL server.', 'wp-security-audit-log' ); ?>
					</label>
				</fieldset>
				<fieldset>
					<?php
					$ssl_ca = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-ssl-ca', false );
					if ( empty( $ssl_ca ) && isset( $post_array[ $label_name . 'SSL_CA' ] ) ) {
						$ssl_ca = $post_array[ $label_name . 'SSL_CA' ];
					}
					?>
					<input
						type="text"
						id="<?php echo esc_attr( $label_name ); ?>SSL_CA"
						name="<?php echo esc_attr( $label_name ); ?>SSL_CA"
						placeholder="<?php esc_attr_e( 'CA SSL Certificate (--ssl-ca)', 'wp-security-audit-log' ); ?>"
						value="<?php echo esc_attr( $ssl_ca ); ?>"
						style="display: block; width: 250px; margin-top: 10px;"
					/>
				</fieldset>
				<fieldset>
					<?php
					$ssl_cert = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-ssl-cert', false );
					if ( empty( $ssl_cert ) && isset( $post_array[ $label_name . 'SSL_Cert' ] ) ) {
						$ssl_cert = $post_array[ $label_name . 'SSL_Cert' ];
					}
					?>
					<input
						type="text"
						id="<?php echo esc_attr( $label_name ); ?>SSL_Cert"
						name="<?php echo esc_attr( $label_name ); ?>SSL_Cert"
						placeholder="<?php esc_attr_e( 'Server SSL Certificate (--ssl-cert)', 'wp-security-audit-log' ); ?>"
						value="<?php echo esc_attr( $ssl_cert ); ?>"
						style="display: block; width: 250px; margin-top: 10px;"
					/>
				</fieldset>
				<fieldset>
					<?php
					$ssl_key = $this->_plugin->wsalCommonClass->GetOptionByName( $option_name . '-ssl-key', false );
					if ( empty( $ssl_key ) && isset( $post_array[ $label_name . 'SSL_Key' ] ) ) {
						$ssl_key = $post_array[ $label_name . 'SSL_Key' ];
					}
					?>
					<input
						type="text"
						id="<?php echo esc_attr( $label_name ); ?>SSL_Key"
						name="<?php echo esc_attr( $label_name ); ?>SSL_Key"
						placeholder="<?php esc_attr_e( 'Client Certificate (--ssl-key)', 'wp-security-audit-log' ); ?>"
						value="<?php echo esc_attr( $ssl_key ); ?>"
						style="display: block; width: 250px; margin-top: 10px;"
					/>
					<span class="description">
						<?php esc_html_e( 'Please specify the path of the SSL certificates and client certificates to use. The web server user should have the permission to read these files otherwise the connection cannot be setup. The path should be relative to the root of the website.', 'wp-security-audit-log' ); ?>
					</span>
				</fieldset>
			</td>
		</tr>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				// Enable/disable login notification textarea.
				function wsal_update_<?php echo esc_attr( $label_name ); ?>( checkbox, input ) {
					if ( checkbox.prop( 'checked' ) ) {
						input.prop( 'disabled', 'disabled' );
					} else {
						input.removeProp( 'disabled' );
					}
				}

				// Login page notification settings.
				var <?php echo esc_attr( $label_name ); ?>UrlBasePrefix = jQuery( '#<?php echo esc_attr( $label_name ); ?>UrlBasePrefix' );
				var <?php echo esc_attr( $label_name ); ?>BasePrefix = jQuery( '#<?php echo esc_attr( $label_name ); ?>BasePrefix' );
				wsal_update_<?php echo esc_attr( $label_name ); ?>( <?php echo esc_attr( $label_name ); ?>UrlBasePrefix, <?php echo esc_attr( $label_name ); ?>BasePrefix );

				// Check the change event on checkbox.
				<?php echo esc_attr( $label_name ); ?>UrlBasePrefix.on( 'change', function() {
					wsal_update_<?php echo esc_attr( $label_name ); ?>( <?php echo esc_attr( $label_name ); ?>UrlBasePrefix, <?php echo esc_attr( $label_name ); ?>BasePrefix );
				} );
			});
			// Enable/disable SSL/Client certificates option.
			var <?php echo esc_attr( $option_name ); ?>SSL = jQuery( '#<?php echo esc_attr( $label_name ); ?>SSL' );
			wsal<?php echo esc_attr( $label_name ); ?>Toggle( <?php echo esc_attr( $option_name ); ?>SSL, jQuery( '#<?php echo esc_attr( $label_name ); ?>SSLCertificate' ) ); // Disable CC settings.

			// Update CC settings when SSL enable option change.
			<?php echo esc_attr( $option_name ); ?>SSL.on( 'change', function() {
				wsal<?php echo esc_attr( $label_name ); ?>Toggle( <?php echo esc_attr( $option_name ); ?>SSL, jQuery( '#<?php echo esc_attr( $label_name ); ?>SSLCertificate' ) );
			} );

			/**
			 * Disable client certificate settings.
			 */
			function wsal<?php echo esc_attr( $label_name ); ?>Toggle( checkbox, cert_settings ) {
				if ( checkbox.is(':checked') ) {
					cert_settings.find('fieldset').removeAttr('disabled');
				} else {
					cert_settings.find('fieldset').attr('disabled','disabled');
				}
			}
		</script><?php
	}

	/**
	 * Common function to schedule cron job.
	 *
	 * @param string $name - Name of DB Type.
	 */
	private function get_schedule_fields( $name ) {
		$label_name  = ucfirst( $name );
		$option_name = strtolower( $name );
		$configName  = 'Is' . $label_name . 'Stop';
		?>
		<tr>
			<th><label for="Run<?php echo esc_attr( $label_name ); ?>">Run <?php echo esc_html( $option_name ); ?> process every</label></th>
			<td>
				<fieldset>
					<?php
					$name  = 'Get' . $label_name . 'RunEvery';
					$every = strtolower( $this->_plugin->wsalCommonClass->$name() );
					?>
					<select name="Run<?php echo esc_attr( $label_name ); ?>" id="Run<?php echo esc_attr( $label_name ); ?>">
						<option value="tenminutes" <?php echo ( 'tenminutes' == $every ) ? 'selected="selected"' : false; ?>>
							<?php esc_html_e( '10 minutes', 'wp-security-audit-log' ); ?>
						</option>
						<option value="thirtyminutes" <?php echo ( 'thirtyminutes' == $every ) ? 'selected="selected"' : false; ?>>
							<?php esc_html_e( '30 minutes', 'wp-security-audit-log' ); ?>
						</option>
						<option value="fortyfiveminutes" <?php echo ( 'fortyfiveminutes' == $every ) ? 'selected="selected"' : false; ?>>
							<?php esc_html_e( '45 minutes', 'wp-security-audit-log' ); ?>
						</option>
						<option value="hourly" <?php echo ( 'hourly' == $every ) ? 'selected="selected"' : false; ?>>
							<?php esc_html_e( '1 hour', 'wp-security-audit-log' ); ?>
						</option>
					</select>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th><label for="Stop<?php echo esc_attr( $label_name ); ?>">Stop <?php echo esc_html( $label_name ); ?></label></th>
			<td>
				<fieldset>
					<label for="Stop<?php echo esc_attr( $label_name ); ?>" class="no-margin">
						<span class="f-container">
							<span class="f-left">
								<input type="checkbox" name="Stop<?php echo esc_attr( $label_name ); ?>" value="1" class="switch" id="<?php echo esc_attr( $option_name ); ?>_stop"/>
								<label for="<?php echo esc_attr( $option_name ); ?>_stop" class="no-margin orange"></label>
							</span>
						</span>
					</label>
					<span class="description">Current status: <strong><span id="<?php echo esc_attr( $option_name ); ?>_stop_text"></span></strong></span>
				</fieldset>
			</td>
		</tr>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				var <?php echo esc_attr( $option_name ); ?>Stop   = <?php echo json_encode( $this->_plugin->wsalCommonClass->$configName() ); ?>;
				var <?php echo esc_attr( $option_name ); ?>_stop  = jQuery('#<?php echo esc_attr( $option_name ); ?>_stop');
				var <?php echo esc_attr( $option_name ); ?>TxtNot = jQuery('#<?php echo esc_attr( $option_name ); ?>_stop_text');

				function wsal<?php echo esc_attr( $label_name ); ?>Stop(checkbox, label){
					if (checkbox.prop('checked')) {
						label.text('Stopped');
					} else {
						label.text('Running');
					}
				}
				// Set On
				if (<?php echo esc_attr( $option_name ); ?>Stop) {
					<?php echo esc_attr( $option_name ); ?>_stop.prop('checked', true);
				}
				wsal<?php echo esc_attr( $label_name ); ?>Stop(<?php echo esc_attr( $option_name ); ?>_stop, <?php echo esc_attr( $option_name ); ?>TxtNot);

				<?php echo esc_attr( $option_name ); ?>_stop.on('change', function() {
					wsal<?php echo esc_attr( $label_name ); ?>Stop(<?php echo esc_attr( $option_name ); ?>_stop, <?php echo esc_attr( $option_name ); ?>TxtNot);
				});
			});
		</script><?php
	}

	/**
	 * Check to see if archive and retention time periods are colliding
	 * with each other.
	 *
	 * @param string $archive_date – Archive date.
	 * @param string $archive_type – Archive date type.
	 * @param string $pruning_date – Pruning/Retention date.
	 * @param string $pruning_type – Pruning/Retention date type.
	 * @since 3.2.3
	 */
	private function check_period_collision( $archive_date, $archive_type = 'months', $pruning_date, $pruning_type = 'months' ) {
		// Check the paramters.
		if ( empty( $archive_date ) || empty( $archive_type ) || empty( $pruning_date ) || empty( $pruning_type ) ) {
			return false;
		}

		// Show popup.
		$show_popup = false;

		if ( 'months' === $archive_type ) {
			if ( 'months' === $pruning_type ) {
				if ( $pruning_date < $archive_date ) {
					$show_popup = true;
				}
			} elseif ( 'years' === $pruning_type ) {
				if ( $archive_date > ( 12 * (int) $pruning_date ) ) { // Convert pruning date to months.
					$show_popup = true;
				}
			}
		} elseif ( 'years' === $archive_type ) {
			if ( 'months' === $pruning_type ) {
				if ( $pruning_date < ( 12 * (int) $archive_date ) ) { // Convert archive date to months.
					$show_popup = true;
				}
			} elseif ( 'years' === $archive_type ) {
				if ( $pruning_date < $archive_date ) {
					$show_popup = true;
				}
			}
		}

		if ( $show_popup ) :
			// Remodal styles.
			wp_enqueue_style( 'wsal-remodal', $this->_plugin->GetBaseUrl() . '/css/remodal.css', array(), '1.1.1' );
			wp_enqueue_style( 'wsal-remodal-theme', $this->_plugin->GetBaseUrl() . '/css/remodal-default-theme.css', array(), '1.1.1' );

			// Remodal script.
			wp_enqueue_script(
				'wsal-remodal-js',
				$this->_plugin->GetBaseUrl() . '/js/remodal.min.js',
				array(),
				'1.1.1',
				true
			);
			?>
			<div class="remodal" data-remodal-id="wsal-pruning-collision" style="display: none;">
				<h3><?php esc_html_e( 'Attention!', 'wp-security-audit-log' ); ?></h3>
				<p class="description">
					<?php
					/* translators: %1$s: Alerts Pruning Period, %2$s: Alerts Archiving Period */
					echo sprintf( esc_html__( 'The activity log retention setting is configured to delete events older than %1$s. This period should be longer than the configured %2$s archiving period otherwise events will be deleted and not archived.', 'wp-security-audit-log' ), esc_html( $pruning_date . ' ' . $pruning_type ), esc_html( $archive_date . ' ' . $archive_type ) );
					?>
				</p>
			</div>
			<script type="text/javascript">
				jQuery( document ).ready( function() {
					var options = {hashTracking: false};
					var pruningModal = jQuery( '[data-remodal-id="wsal-pruning-collision"]' );
					var modalInstance = pruningModal.remodal( options );
					modalInstance.open();
					pruningModal.removeAttr( 'style' );
				});
			</script><?php
		endif;
	}

	/**
	 * Ajax request handler to test external DB connections.
	 *
	 * @since 3.2.3
	 */
	public function test_external_db_connection() {
		// Check request permissions.
		if ( ! $this->_plugin->settings->CurrentUserCan( 'edit' ) ) {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Access Denied.', 'wp-security-audit-log' ),
			) );
			exit();
		}

		$nonce   = filter_input( INPUT_POST, 'nonce', FILTER_SANITIZE_STRING );
		$db_type = filter_input( INPUT_POST, 'connectionType', FILTER_SANITIZE_STRING );

		if ( ! empty( $db_type ) && ! empty( $nonce ) && wp_verify_nonce( $nonce, 'wsal-' . $db_type . '-test' ) ) {
			// Check DB type.
			if ( 'mirror' === $db_type && 'papertrail' === $this->_plugin->GetGlobalOption( 'mirroring-type', false ) ) {
				// Get papertrail configs.
				$config      = $this->_plugin->wsalCommonClass->GetPapertrailDestination();
				$destination = array_combine( array( 'hostname', 'port' ), explode( ':', $config ) );

				$sock = socket_create( AF_INET, SOCK_DGRAM, SOL_UDP );
				if ( socket_connect( $sock, $destination['hostname'], $destination['port'] ) ) {
					echo wp_json_encode( array(
						'success' => true,
						'message' => esc_html__( 'Successfully connected to database.', 'wp-security-audit-log' ),
					) );
				} else {
					echo wp_json_encode( array(
						'success' => false,
						'message' => socket_strerror( socket_last_error( $sock ) ),
					) );
				}
				socket_close( $sock );
			} else {
				// Get DB configs.
				$adapter_type     = $this->_plugin->GetGlobalOption( $db_type . '-type' );
				$adapter_user     = $this->_plugin->GetGlobalOption( $db_type . '-user' );
				$adapter_pass     = $this->_plugin->GetGlobalOption( $db_type . '-password' );
				$adapter_name     = $this->_plugin->GetGlobalOption( $db_type . '-name' );
				$adapter_host     = $this->_plugin->GetGlobalOption( $db_type . '-hostname' );
				$adapter_prefix   = $this->_plugin->GetGlobalOption( $db_type . '-base-prefix' );
				$adapter_ssl      = $this->_plugin->GetGlobalOption( $db_type . '-ssl' );
				$adapter_cc       = $this->_plugin->GetGlobalOption( $db_type . '-client-certificate' );
				$adapter_ssl_ca   = $this->_plugin->GetGlobalOption( $db_type . '-ssl-ca' );
				$adapter_ssl_cert = $this->_plugin->GetGlobalOption( $db_type . '-ssl-cert' );
				$adapter_ssl_key  = $this->_plugin->GetGlobalOption( $db_type . '-ssl-key' );

				try {
					WSAL_Connector_ConnectorFactory::CheckConfig( $adapter_type, $adapter_user, $adapter_pass, $adapter_name, $adapter_host, $adapter_prefix, $adapter_ssl, $adapter_cc, $adapter_ssl_ca, $adapter_ssl_cert, $adapter_ssl_key );

					echo wp_json_encode( array(
						'success' => true,
						'message' => esc_html__( 'Successfully connected to database.', 'wp-security-audit-log' ),
					) );
				} catch ( Exception $ex ) {
					echo wp_json_encode( array(
						'success' => false,
						'message' => $ex->getMessage(),
					) );
				}
			}
		} else {
			echo wp_json_encode( array(
				'success' => false,
				'message' => esc_html__( 'Nonce verification failed.', 'wp-security-audit-log' ),
			) );
		}
		exit();
	}

	/**
	 * Popup to notify the user that retention setting
	 * has been moved to archive db settings.
	 *
	 * @since 3.2.3
	 */
	private function show_retention_notice() {
		// Remodal styles.
		wp_enqueue_style( 'wsal-remodal', $this->_plugin->GetBaseUrl() . '/css/remodal.css', array(), '1.1.1' );
		wp_enqueue_style( 'wsal-remodal-theme', $this->_plugin->GetBaseUrl() . '/css/remodal-default-theme.css', array(), '1.1.1' );

		// Remodal script.
		wp_enqueue_script(
			'wsal-remodal-js',
			$this->_plugin->GetBaseUrl() . '/js/remodal.min.js',
			array(),
			'1.1.1',
			true
		);
		?>
		<div class="remodal" data-remodal-id="wsal-retention-notice" style="display: none;">
			<h3><?php esc_html_e( 'Attention!', 'wp-security-audit-log' ); ?></h3>
			<p class="description">
				<?php esc_html_e( 'The Audit Log retention settings have been moved to the Archiving settings and now the plugin is configured to keep all data. You can re-configure the retention settings from this settings page. Note that the retention settings also apply to the archived events.', 'wp-security-audit-log' ); ?>
			</p>
			<button data-remodal-action="confirm" class="remodal-confirm"><?php esc_html_e( 'OK', 'wp-security-audit-log' ); ?></button>
		</div>
		<script type="text/javascript">
			jQuery( document ).ready( function() {
				var options = {hashTracking: false};
				var pruningModal = jQuery( '[data-remodal-id="wsal-retention-notice"]' );
				var modalInstance = pruningModal.remodal( options );
				modalInstance.open();
				pruningModal.removeAttr( 'style' );
			});
		</script><?php
	}
}
