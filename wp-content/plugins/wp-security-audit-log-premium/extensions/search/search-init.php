<?php
/**
 * Extension: Search Filters
 *
 * Search filters extension for wsal.
 *
 * @since 1.0.0
 * @package Wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WSAL_SearchExtension search widget.
 *
 * @package search-wsal
 */
class WSAL_SearchExtension {

	/**
	 * Instance of WpSecurityAuditLog.
	 *
	 * @var object
	 */
	public $wsal;

	/**
	 * Instance of WSAL_AS_FilterManager.
	 *
	 * @var object
	 */
	public $filters;

	/**
	 * Instance of WSAL_Views_AuditLog.
	 *
	 * @var object
	 */
	public $viewNotice;

	/**
	 * Instance of WSAL_SearchExtension.
	 *
	 * @var object
	 */
	protected static $instance;

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

	const CLS_AUDIT_LOG = 'WSAL_Views_AuditLog';

	/**
	 * Method: Constructor
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
		add_action( 'wsal_init', array( $this, 'wsal_init' ) );
		add_filter( 'wsal_auditlog_query', array( $this, 'wsal_auditlog_query' ) );
		add_action( 'wsal_auditlog_before_view', array( $this, 'wsal_auditlog_before_view' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'admin_print_footer_scripts', array( $this, 'admin_print_footer_scripts' ) );
		add_action( 'wp_ajax_WsalAsWidgetAjax', array( $this, 'admin_ajax_widget' ) );
		add_action( 'wp_ajax_wsal_get_save_search', array( $this, 'get_save_search' ) );
		add_action( 'wp_ajax_wsal_delete_save_search', array( $this, 'delete_save_search' ) );
		self::$instance = $this;

		$this->_base_dir = WSAL_BASE_DIR . 'extensions/search';
		$this->_base_url = WSAL_BASE_URL . 'extensions/search';
	}

	/**
	 * WSAL_SearchExtension Returns the current plugin instance.
	 *
	 * @return object
	 */
	public static function GetInstance() {
		return self::$instance;
	}

	/**
	 * Triggered when the main plugin is loaded.
	 *
	 * @param WpSecurityAuditLog $wsal - Instance of WpSecurityAuditLog.
	 * @see WpSecurityAuditLog::load()
	 */
	public function wsal_init( WpSecurityAuditLog $wsal ) {
		// Keep a reference to plugin.
		$this->wsal = $wsal;

		// Register classes with autoloader.
		$wsal->autoloader->Register( 'WSAL_AS_', dirname( __FILE__ ) . '/classes' );

		// Load filters.
		$this->filters = new WSAL_AS_FilterManager( self::$instance );
	}

	/**
	 * Filter the query.
	 *
	 * @param object $query - Instance of WSAL_Models_OccurrenceQuery.
	 * @see WSAL_AuditLogListView::prepare_items()
	 */
	public function wsal_auditlog_query( $query ) {
		$modified = false;

		// Get search terms & filters.
		// @codingStandardsIgnoreStart
		$search_term      = ( isset( $_REQUEST['s'] ) && ! empty( $_REQUEST['s'] ) ) ? trim( sanitize_text_field( $_REQUEST['s'] ) ) : false;
		$search_filters   = ( isset( $_REQUEST['Filters'] ) && is_array( $_REQUEST['Filters'] ) ) ? array_map( 'sanitize_text_field', $_REQUEST['Filters'] ) : false;
		$search_save_name = ( isset( $_REQUEST['wsal-save-search-name'] ) && ! empty( $_REQUEST['wsal-save-search-name'] ) ) ? trim( sanitize_text_field( $_REQUEST['wsal-save-search-name'] ) ) : false;
		// @codingStandardsIgnoreEnd

		// Handle text search.
		if ( $search_term ) {
			// Handle free text search.
			$query->addSearchCondition( $search_term );
		} else {
			// fixes #4 (@see WP_List_Table::search_box).
			$_REQUEST['s'] = ' ';
		}

		// Handle filter search.
		$filters_arr = array();
		if ( ! empty( $search_filters ) && is_array( $search_filters ) ) {
			$modified = true;
			foreach ( $search_filters as $filter ) {
				$filter = explode( ':', $filter, 2 );
				if ( isset( $filter[1] ) ) {
					// Group the filter by type.
					$filters_arr[ $filter[0] ][] = $filter[1];
				}
			}
			foreach ( $filters_arr as $prefix => $value ) {
				$the_filter = $this->filters->FindFilterByPrefix( $prefix );
				$the_filter->ModifyQuery( $query, $prefix, $value );
			}
		}

		// Handle Save Search Request.
		if ( ! empty( $search_save_name ) ) {
			// Sanitize Search Name. Only spaces and alphanumeric characters are allowed.
			$save_search_name = preg_replace( '/[^a-z0-9_]+/i', '', $search_save_name );
			$save_search_name = substr( $save_search_name, 0, 12 );

			if ( ! empty( $save_search_name ) ) {
				// Initialize save array.
				$save_search_arr = array();
				$save_search_arr['name'] = $save_search_name;

				if ( $search_term ) {
					$save_search_arr['search_input'] = $search_term;
				}

				if ( ! empty( $search_filters ) && is_array( $search_filters ) ) {
					$save_search_arr['filters'] = $search_filters;
				}

				// Get saved array from db.
				$save_search = $this->wsal->GetGlobalOption( 'save_search', array() );

				// Append current search with saved searches array.
				$save_search[ $save_search_name ] = $save_search_arr;
				$this->wsal->SetGlobalOption( 'save_search', $save_search );
			}
		}

		// Keep track of what we're doing.
		if ( $modified ) {
			$this->wsal->alerts->Trigger(
				0003, array(
					'Message' => 'User searched in AuditLog.',
				// 'Query SQL' => $query->GetSql(),
				// 'Query Args' => $query->GetArgs(),
				)
			);
		}
		return $query;
	}

	/**
	 * Search Box View
	 *
	 * @param WSAL_AuditLogListView $listview – List view object.
	 */
	public function wsal_auditlog_before_view( WSAL_AuditLogListView $listview ) {
		$listview->search_box( __( 'Search', 'wp-security-audit-log' ), 'wsal-as-search' );
		?>

		<input type="hidden" id="wsal-admin-url" value="<?php echo esc_attr( admin_url( 'admin-ajax.php' ) ); ?>" />
		<!-- WP Admin Ajax URL -->

		<?php
		// @codingStandardsIgnoreStart
		$search_filters = ( isset( $_REQUEST['Filters'] ) && is_array( $_REQUEST['Filters'] ) ) ? array_map( 'sanitize_text_field', $_REQUEST['Filters'] ) : false;
		// @codingStandardsIgnoreEnd

		if ( ! empty( $search_filters ) && is_array( $search_filters ) ) {
			?>
			<script type="text/javascript">
				jQuery(document).ready( function() {
					window.WsalAs.Attach( function() {
						WsalAs.list.html( '' );
						<?php foreach ( $search_filters as $filter ) { ?>
							WsalAs.AddFilter(<?php echo json_encode( $filter ); ?>);
						<?php } ?>
					});
				});
			</script><?php
		}
	}

	/**
	 * Enqueue Search CSS & Scripts.
	 */
	public function admin_enqueue_scripts() {
		if ( $this->IsAuditLogPage() ) {
			$plugins_url = $this->_base_url . '/resources/';
			wp_enqueue_style(
				'auditlog-as',
				$plugins_url . 'auditlog.css',
				array(),
				filemtime( plugin_dir_path( __FILE__ ) . '/resources/auditlog.css' )
			);

			wp_enqueue_style( 'wsal-datepick-css', $plugins_url . 'jquery.datepick/smoothness.datepick.css' );
			wp_enqueue_script( 'wsal-datepick-plugin-js', $plugins_url . 'jquery.datepick/jquery.plugin.min.js', array( 'jquery' ) );
			wp_enqueue_script( 'wsal-datepick-js', $plugins_url . 'jquery.datepick/jquery.datepick.min.js', array( 'jquery' ) );

			foreach ( $this->filters->GetWidgets() as $widgets ) {
				$widgets[0]->StaHeader();
				foreach ( $widgets as $widget ) {
					$widget->DynHeader();
				}
			}

			$date_format = $this->GetDateFormat();
			?>
			<script type="text/javascript">
				var dateFormat = "<?php echo $date_format; ?>";

				function wsal_CreateDatePicker($, $input, date) {
					$input.val(''); // clear
					var WsalDatePick_onSelect = function(date){
						date = date || new Date();
						var v = $.datepick.formatDate(dateFormat, date[0]);
						$input.val(v);
						$(this).change();
					};
					$input.datepick({
						dateFormat: dateFormat,
						selectDefaultDate: true,
						rangeSelect: false,
						multiSelect: 0,
						onSelect: WsalDatePick_onSelect
					}).datepick('setDate', date);
				}

				function checkDate(value) {
					if (dateFormat == 'mm-dd-yyyy' || dateFormat == 'dd-mm-yyyy') {
						// regular expression to match date format mm-dd-yyyy or dd-mm-yyyy
						re = /^(\d{1,2})-(\d{1,2})-(\d{4})$/;
					} else {
						// regular expression to match date format yyyy-mm-dd
						re = /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
					}

					if(value != '' && !value.match(re)) {
						return false;
					}
					return true;
				}
			</script><?php
		}
	}

	/**
	 * Enqueue Search Scripts in Admin Footer.
	 */
	public function admin_footer() {
		if ( $this->IsAuditLogPage() ) {
			// Autocomplete script.
			wp_enqueue_script(
				'typeahead-bundle',
				$this->_base_url . '/resources/typeahead.bundle.min.js',
				array( 'jquery' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/resources/typeahead.bundle.min.js' ),
				false
			);

			// WSAL search script.
			wp_register_script(
				'auditlog-as',
				$this->_base_url . '/resources/auditlog.js',
				array( 'typeahead-bundle', 'auditlog' ),
				filemtime( plugin_dir_path( __FILE__ ) . '/resources/auditlog.js' ),
				false
			);

			// Translations array to be passed to the search script.
			$translation_arr = array(
				'search'          => __( 'Search', 'wp-security-audit-log' ),
				'search_tooltip'  => __( '- Use the free-text search to search for text in the event\'s message.<br>- To search for a particular Event ID, user, IP address, Post ID or Type or use date ranges, use the filters.', 'wp-security-audit-log' ),
				'clear_search'    => __( 'Clear Search Results', 'wp-security-audit-log' ),
				'nothing'         => __( 'Nothing found!', 'wp-security-audit-log' ),
				'search_load'     => __( 'Load', 'wp-security-audit-log' ),
				'search_loading'  => __( 'Loading...', 'wp-security-audit-log' ),
				'search_run'      => __( 'Load & Run', 'wp-security-audit-log' ),
				'search_delete'   => __( 'Delete', 'wp-security-audit-log' ),
				'search_deleting' => __( 'Deleting...', 'wp-security-audit-log' ),
				'search_deleted'  => __( 'Deleted', 'wp-security-audit-log' ),
				'btn_load'        => __( 'Load Search & Filters', 'wp-security-audit-log' ),
				'invalid_ip'      => __( '* Invalid IP', 'wp-security-audit-log' ),
				'remove'          => __( 'Remove', 'wp-security-audit-log' ),
			);
			wp_localize_script( 'auditlog-as', 'translation_string', $translation_arr );

			// Enqueue script.
			wp_enqueue_script( 'auditlog-as' );
		}
	}

	/**
	 * Print filters individual scripts.
	 */
	public function admin_print_footer_scripts() {
		if ( $this->IsAuditLogPage() ) {
			foreach ( $this->filters->GetWidgets() as $widgets ) {
				$widgets[0]->StaFooter();
				foreach ( $widgets as $widget ) {
					$widget->DynFooter();
				}
			}
		}
	}

	/**
	 * Admin ajax handler.
	 *
	 * @throws Exception - Exception if widget is not found.
	 */
	public function admin_ajax_widget() {
		try {
			if ( ! isset( $_REQUEST['filter'] ) ) {
				throw new Exception( 'Parameter "filter" is required.' );
			}
			if ( ! isset( $_REQUEST['widget'] ) ) {
				throw new Exception( 'Parameter "widget" is required.' );
			}
			if ( ! $this->wsal ) {
				throw new Exception( 'Ajax handler "' . __FUNCTION__ . '" was called too early.' );
			}

			$widget = $this->filters->FindWidget( $_REQUEST['filter'], $_REQUEST['widget'] );

			if ( ! $widget ) {
				throw new Exception( __( 'Widget could not be found.', 'wp-security-audit-log' ) );
			}

			$widget->HandleAjax();
			die;
		} catch ( Exception $ex ) {
			die(
				json_encode(
					(object) array(
						'mesg' => $ex->getMessage(),
						'line' => $ex->getLine(),
						'file' => basename( $ex->getFile() ),
					)
				)
			);
		}
	}

	/**
	 * Check if current page is audit log's page.
	 */
	protected function IsAuditLogPage() {
		return $this->wsal != null                                 // Is wsal set up?
			&& ! ! ( $view = $this->wsal->views->GetActiveView() ) // Is there an active view?
			&& get_class( $view ) === self::CLS_AUDIT_LOG;         // Is the view AuditLog?
	}

	/**
	 * Date Format from WordPress General Settings.
	 * Used in the form help text.
	 */
	public function GetDateFormat() {
		$date_format = $this->wsal->settings->GetDateFormat();
		$search      = array( 'Y', 'm', 'd' );
		$replace     = array( 'yyyy', 'mm', 'dd' );
		return str_replace( $search, $replace, $date_format );
	}

	/**
	 * Method: Function to handle ajax request for
	 * getting saved searches.
	 *
	 * @since 1.1.7
	 */
	public function get_save_search() {
		$post_data = $_POST;
		if ( isset( $post_data['nonce'] )
			&& wp_verify_nonce( $post_data['nonce'], 'load-saved-search-action' ) ) {

			// Get search results.
			$results = $this->wsal->GetGlobalOption( 'save_search', array() );
			$search_results = array();

			if ( ! empty( $results ) && is_array( $results ) ) {
				// Convert saved searches array into simple associative array for JS.
				foreach ( $results as $result ) {
					$search_results[] = $result;
				}

				$response = array(
					'search_results' => $search_results,
					'success'   => true,
					'message'   => __( 'Saved searches found.', 'wp-security-audit-log' ),
				);
				$response = json_encode( $response );
				echo $response;
			} else {
				// No saved search is present.
				$response = array(
					'success'   => false,
					'message'   => __( 'No saved search found.', 'wp-security-audit-log' ),
				);
				$response = json_encode( $response );
				echo $response;
			}
		} else {
			// Nonce verification failed.
			$response = array(
				'success'   => false,
				'message'   => __( 'Nonce verification failed.', 'wp-security-audit-log' ),
			);
			$response = json_encode( $response );
			echo $response;
		}
		die();
	}

	/**
	 * Method: Function to handle ajax request for
	 * deleting saved search.
	 *
	 * @since 1.1.7
	 */
	public function delete_save_search() {
		$post_data = $_POST;
		if ( isset( $post_data['nonce'] )
			&& wp_verify_nonce( $post_data['nonce'], 'load-saved-search-action' ) ) {

			// Get name to be deleted.
			$delete_name = ( isset( $post_data['name'] ) ) ? $post_data['name'] : false;

			if ( empty( $delete_name ) ) {
				$response = array(
					'success'   => true,
					'message'   => __( 'Search name not specified.', 'wp-security-audit-log' ),
				);
				$response = json_encode( $response );
				echo $response;
				die();
			}

			// Get search results.
			$results = $this->wsal->GetGlobalOption( 'save_search', array() );

			if ( ! empty( $results ) && is_array( $results ) ) {

				if ( array_key_exists( $delete_name, $results ) ) {
					// If the array key exits in saved searches array then unset it.
					unset( $results[ $delete_name ] );
					$this->wsal->SetGlobalOption( 'save_search', $results );

					$response = array(
						'success'   => true,
						'message'   => __( 'Saved search deleted.', 'wp-security-audit-log' ),
					);
					$response = json_encode( $response );
					echo $response;
				} else {
					// Search not found.
					$response = array(
						'success'   => true,
						'message'   => __( 'Saved search not found.', 'wp-security-audit-log' ),
					);
					$response = json_encode( $response );
					echo $response;
				}
			} else {
				// No saved search is present.
				$response = array(
					'success'   => true,
					'message'   => __( 'No saved search found.', 'wp-security-audit-log' ),
				);
				$response = json_encode( $response );
				echo $response;

			}
		} else {
			// Nonce verification failed.
			$response = array(
				'success'   => false,
				'message'   => __( 'Nonce verification failed.', 'wp-security-audit-log' ),
			);
			$response = json_encode( $response );
			echo $response;
		}
		die();
	}
}
