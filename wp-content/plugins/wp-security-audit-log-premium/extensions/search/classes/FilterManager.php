<?php
/**
 * Class: Filter Manager
 *
 * Filter Manager for search extension.
 *
 * @since 1.0.0
 * @package wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WSAL_AS_FilterManager
 *
 * @package search-wsal
 */
class WSAL_AS_FilterManager {

	/**
	 * Array of filters - WSAL_AS_Filters_AbstractFilter[]
	 *
	 * @var array
	 */
	protected $filters = array();

	/**
	 * Widget cache.
	 *
	 * @var WSAL_AS_Filters_AbstractWidget[]
	 */
	protected $widgets = null;

	/**
	 * Instance of WSAL_SearchExtension.
	 *
	 * @var object
	 */
	protected $_plugin;

	/**
	 * Method: Constructor.
	 *
	 * @param object $plugin - Instance of WSAL_SearchExtension.
	 * @since 1.0.0
	 */
	public function __construct( WSAL_SearchExtension $plugin ) {
		$this->_plugin = $plugin;

		// Load filters.
		foreach ( glob( dirname( __FILE__ ) . '/Filters/*.php' ) as $file ) {
			$this->AddFromFile( $file );
		}

		add_action( 'wsal_audit_log_column_header', array( $this, 'display_filters' ), 10, 1 );
		add_action( 'wsal_search_filters_list', array( $this, 'display_search_filters_list' ), 10, 1 );
	}

	/**
	 * Add new filter from file inside autoloader path.
	 *
	 * @param string $file Path to file.
	 */
	public function AddFromFile( $file ) {
		$this->AddFromClass( $this->_plugin->wsal->GetClassFileClassName( $file ) );
	}

	/**
	 * Add new filter given class name.
	 *
	 * @param string $class Class name.
	 */
	public function AddFromClass( $class ) {
		if ( is_subclass_of( $class, 'WSAL_AS_Filters_AbstractFilter' ) ) {
			$this->AddInstance( new $class( $this->_plugin ) );
		}
	}

	/**
	 * Add newly created filter to list.
	 *
	 * @param WSAL_AS_Filters_AbstractFilter $filter The new view.
	 */
	public function AddInstance( WSAL_AS_Filters_AbstractFilter $filter ) {
		$this->filters[] = $filter;
		// Reset widget cache.
		if ( $this->widgets == null ) {
			$this->widgets = null;
		}
	}

	/**
	 * Get filters.
	 *
	 * @return WSAL_AS_Filters_AbstractFilter[]
	 */
	public function GetFilters() {
		return $this->filters;
	}

	/**
	 * Gets widgets grouped in arrays with widget class as key.
	 *
	 * @return WSAL_AS_Filters_AbstractWidget[][]
	 */
	public function GetWidgets() {
		if ( $this->widgets == null ) {
			$this->widgets = array();
			foreach ( $this->filters as $filter ) {
				foreach ( $filter->GetWidgets() as $widget ) {
					$class = get_class( $widget );
					if ( ! isset( $this->widgets[ $class ] ) ) {
						$this->widgets[ $class ] = array();
					}
					$this->widgets[ $class ][] = $widget;
				}
			}
		}
		return $this->widgets;
	}

	/**
	 * Find widget given filter and widget name.
	 *
	 * @param string $filter_name - Filter name.
	 * @param string $widget_name - Widget name.
	 * @return WSAL_AS_Filters_AbstractWidget|null
	 */
	public function FindWidget( $filter_name, $widget_name ) {
		foreach ( $this->filters as $filter ) {
			if ( $filter->GetSafeName() == $filter_name ) {
				foreach ( $filter->GetWidgets() as $widget ) {
					if ( $widget->GetSafeName() == $widget_name ) {
						return $widget;
					}
				}
			}
		}
		return null;
	}

	/**
	 * Find a filter given a supported prefix.
	 *
	 * @param string $prefix Filter prefix.
	 * @return WSAL_AS_Filters_AbstractFilter|null
	 */
	public function FindFilterByPrefix( $prefix ) {
		foreach ( $this->filters as $filter ) {
			if ( in_array( $prefix, $filter->GetPrefixes() ) ) {
				return $filter;
			}
		}
		return null;
	}

	/**
	 * Display column filters.
	 *
	 * @param string $column_key – Column key.
	 * @return string
	 * @since 3.2.3
	 */
	public function display_filters( $column_key ) {
		if ( 'code' === $column_key || 'data' === $column_key ) {
			return;
		}

		// Sorting filter icon.
		echo '<a href="javascript:;" id="wsal-search-filter-' . esc_attr( $column_key ) . '" class="wsal-search-filter dashicons dashicons-filter"></a>';

		// Filter container.
		echo '<div id="wsal-filter-container-' . esc_attr( $column_key ) . '" class="wsal-filter-container">';

		// Close filter button.
		echo '<span data-container-id="wsal-filter-container-' . esc_attr( $column_key ) . '" class="dashicons dashicons-no-alt wsal-filter-container-close"></span>';

		switch ( $column_key ) {
			case 'type':
				// Add event code filter widget.
				$filter = $this->FindFilterByPrefix( 'event' );

				// If filter is found, then add to container.
				if ( $filter ) {
					$filter->Render();
				}
				echo '<p class="description">';
				echo wp_kses( __( 'Refer to the <a href="https://www.wpsecurityauditlog.com/support-documentation/list-wordpress-audit-trail-alerts/" target="_blank">list of Event IDs</a> for reference.', 'wp-security-audit-log' ), $this->_plugin->wsal->allowed_html_tags );
				echo '</p>';
				break;

			case 'crtd':
				// Add date filter widget.
				$date = $this->FindFilterByPrefix( 'from' );

				// If from date filter is found, then add to container.
				if ( $date ) {
					$date->Render();
				}
				break;

			case 'user':
				// Add username filter widget.
				$username = $this->FindFilterByPrefix( 'username' );

				// If username filter is found, then add to container.
				if ( $username ) {
					$username->Render();
				}

				// Add firstname filter widget.
				$firstname = $this->FindFilterByPrefix( 'firstname' );

				// If firstname filter is found, then add to container.
				if ( $firstname ) {
					$firstname->Render();
				}

				// Add lastname filter widget.
				$lastname = $this->FindFilterByPrefix( 'lastname' );

				// If lastname filter is found, then add to container.
				if ( $lastname ) {
					$lastname->Render();
				}

				// Add userrole filter widget.
				$userrole = $this->FindFilterByPrefix( 'userrole' );

				// If userrole filter is found, then add to container.
				if ( $userrole ) {
					$userrole->Render();
				}
				break;

			case 'mesg':
				// Add post_status filter widget.
				$post_status = $this->FindFilterByPrefix( 'poststatus' );

				// If post_status filter is found, then add to container.
				if ( $post_status ) {
					$post_status->Render();
				}

				// Add post_type filter widget.
				$post_type = $this->FindFilterByPrefix( 'posttype' );

				// If post_type filter is found, then add to container.
				if ( $post_type ) {
					$post_type->Render();
				}

				// Add post_id filter widget.
				$post_id = $this->FindFilterByPrefix( 'postid' );

				// If post_id filter is found, then add to container.
				if ( $post_id ) {
					$post_id->Render();
				}

				// Add post_name filter widget.
				$post_name = $this->FindFilterByPrefix( 'postname' );

				// If post_name filter is found, then add to container.
				if ( $post_name ) {
					$post_name->Render();
				}
				break;

			case 'scip':
				// Add ip filter widget.
				$ip = $this->FindFilterByPrefix( 'ip' );

				// If ip filter is found, then add to container.
				if ( $ip ) {
					$ip->Render();
				}
				break;

			default:
				break;
		}

		echo '</div>';
	}

	/**
	 * Display list of search filters, load, and save search
	 * buttons and their pop-ups.
	 *
	 * @param string $nav_position – Table navigation position.
	 */
	public function display_search_filters_list( $nav_position ) {
		if ( empty( $nav_position ) ) {
			return;
		}

		if ( 'top' === $nav_position ) :
			$saved_search = $this->_plugin->wsal->GetGlobalOption( 'save_search', array() );
			?>
			<div class="wsal-as-filter-list no-filters"></div>
			<!-- Filters List -->

			<div class="load-search-container">
				<button type="button" id="load-search-btn" class="button-secondary" <?php echo empty( $saved_search ) ? 'disabled' : false; ?>>
					<?php esc_html_e( 'Load Search & Filters', 'wp-security-audit-log' ); ?>
				</button>
				<div class="wsal-load-popup" style="display:none">
					<a class="close" href="javascript;" title="<?php esc_attr_e( 'Remove', 'wp-security-audit-log' ); ?>">&times;</a>
					<div class="wsal-load-result-list"></div>
				</div>
				<?php wp_nonce_field( 'load-saved-search-action', 'load_saved_search_field' ); ?>
			</div>
			<!-- Load Search & Filters Container -->

			<div class="save-search-container">
				<a href="javascript:;" id="save-search-btn" class="button">
					<?php esc_html_e( 'Save Search & Filters', 'wp-security-audit-log' ); ?>
				</a>
				<div class="wsal-save-popup" style="display: none;">
					<input name="wsal-save-search-name" id="wsal-save-search-name" placeholder="Search Save Name" />
					<span id="wsal-save-search-error"><?php esc_html_e( '* Invalid Name', 'wp-security-audit-log' ); ?></span>
					<p class="description">
						<?php esc_html_e( 'Name can only be 12 characters long and only letters, numbers and underscore are allowed.', 'wp-security-audit-log' ); ?>
					</p>
					<p class="description">
						<button type="submit" id="wsal-save-search-btn" class="button-primary"><?php esc_html_e( 'Save', 'wp-security-audit-log' ); ?></button>
					</p>
				</div>
			</div>
			<!-- Save Search & Filters Container -->
			<?php
		endif;
	}
}
