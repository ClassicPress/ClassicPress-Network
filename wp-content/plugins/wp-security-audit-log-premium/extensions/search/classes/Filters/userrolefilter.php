<?php
/**
 * Filter: User Role Filter
 *
 * User Role filter for search.
 *
 * @since 3.1
 * @package wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_AS_Filters_UserRoleFilter' ) ) :

	/**
	 * WSAL_AS_Filters_UserRoleFilter.
	 *
	 * User Role filter class.
	 *
	 * @since 3.1
	 */
	class WSAL_AS_Filters_UserRoleFilter extends WSAL_AS_Filters_AbstractFilter {

		/**
		 * Instance of WpSecurityAuditLog.
		 *
		 * @var WpSecurityAuditLog
		 */
		public $wsal;

		/**
		 * Method: Constructor.
		 *
		 * @param object $search_wsal – Instance of main plugin.
		 * @since 3.1.0
		 */
		public function __construct( $search_wsal ) {
			$this->wsal = $search_wsal->wsal;
		}

		/**
		 * Method: Get Name.
		 */
		public function GetName() {
			return esc_html__( 'User Role', 'wp-security-audit-log' );
		}

		/**
		 * Method: Get Prefixes.
		 */
		public function GetPrefixes() {
			return array(
				'userrole',
			);
		}

		/**
		 * Method: Returns true if this filter has suggestions for this query.
		 *
		 * @param string $query - Part of query to check.
		 */
		public function IsApplicable( $query ) {
			// Get WP user roles.
			$wp_user_roles = $this->get_wp_user_roles();
			$user_roles    = array();
			foreach ( $wp_user_roles as $role => $details ) {
				$user_roles[ $role ] = translate_user_role( $details['name'] );
			}

			// Search for the post status in query from available post statuses.
			$key = array_search( $query, $user_roles );

			if ( ! empty( $key ) ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Method: Get Widgets.
		 */
		public function GetWidgets() {
			// Intialize single select widget class.
			$widget = new WSAL_AS_Filters_UserRoleWidget( $this, 'userrole', esc_html__( 'User Role', 'wp-security-audit-log' ) );

			// Get WP user roles.
			$wp_user_roles = $this->get_wp_user_roles();
			$user_roles    = array();
			foreach ( $wp_user_roles as $role => $details ) {
				$user_roles[ $role ] = translate_user_role( $details['name'] );
			}

			// Add select options to widget.
			foreach ( $user_roles as $key => $role ) {
				$widget->Add( $role, $key );
			}
			return array( $widget );
		}

		/**
		 * Allow this filter to change the DB query according to the search value.
		 *
		 * @param WSAL_DB_Query $query - Database query for selecting occurrenes.
		 * @param string        $prefix - The filter name (filter string prefix).
		 * @param string        $value - The filter value (filter string suffix).
		 * @throws Exception - Unsupported filter throw.
		 */
		public function ModifyQuery( $query, $prefix, $value ) {
			// Get DB connection array.
			$connection = $this->wsal->getConnector()->getAdapter( 'Occurrence' )->get_connection();
			$connection->set_charset( $connection->dbh, 'utf8mb4', 'utf8mb4_general_ci' );

			// Tables.
			$meta       = new WSAL_Adapters_MySQL_Meta( $connection );
			$table_meta = $meta->GetTable(); // Metadata.
			$occurrence = new WSAL_Adapters_MySQL_Occurrence( $connection );
			$table_occ  = $occurrence->GetTable(); // Occurrences.

			// User role search condition.
			$sql = "( EXISTS(SELECT 1 FROM $table_meta as meta WHERE meta.occurrence_id = $table_occ.id AND meta.name='CurrentUserRoles' AND replace(replace(replace(meta.value, ']', ''), '[', ''), '\\'', '') REGEXP %s) )";

			switch ( $prefix ) {
				case 'userrole':
					$query->addORCondition(
						array(
							$sql => $value,
						)
					);
					break;
				default:
					throw new Exception( 'Unsupported filter "' . $prefix . '".' );
			}
		}

		/**
		 * Method: Get WP User roles.
		 *
		 * @return array
		 */
		private function get_wp_user_roles() {
			$wp_user_roles = '';
			// Check if function `wp_roles` exists.
			if ( function_exists( 'wp_roles' ) ) {
				// Get WP user roles.
				$wp_user_roles = wp_roles()->roles;
			} else { // WP Version is below 4.3.0
				// Get global wp roles variable.
				global $wp_roles;

				// If it is not set then initiate WP_Roles class object.
				if ( ! isset( $wp_roles ) ) {
					$new_wp_roles = new WP_Roles(); // Don't override the original global variable.
				}

				// Get WP user roles.
				$wp_user_roles = $new_wp_roles->roles;
			}
			return $wp_user_roles;
		}
	}

endif;
