<?php
/**
 * Class: Post ID Filter
 *
 * Filter for Post IDs.
 *
 * @since 3.2.3
 * @package wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_AS_Filters_PostIDFilter' ) ) {
	/**
	 * WSAL_AS_Filters_PostIDFilter.
	 *
	 * Post type filter class.
	 */
	class WSAL_AS_Filters_PostIDFilter extends WSAL_AS_Filters_AbstractFilter {

		/**
		 * Method: Get Name.
		 */
		public function GetName() {
			return __( 'Post ID', 'wp-security-audit-log' );
		}

		/**
		 * Method: Returns true if this filter has suggestions for this query.
		 *
		 * @param string $query - Part of query to check.
		 */
		public function IsApplicable( $query ) {
			if ( ! is_int( $query ) ) {
				return false;
			}
			return true;
		}

		/**
		 * Method: Get Prefixes.
		 */
		public function GetPrefixes() {
			return array(
				'postid',
			);
		}

		/**
		 * Method: Get Widgets.
		 */
		public function GetWidgets() {
			return array( new WSAL_AS_Filters_PostIDWidget( $this, 'postid', esc_html__( 'Post ID', 'wp-security-audit-log' ) ) );
		}

		/**
		 * Allow this filter to change the DB query according to the search value.
		 *
		 * @param WSAL_DB_Query $query  - Database query for selecting occurrenes.
		 * @param string        $prefix - The filter name (filter string prefix).
		 * @param string        $value  - The filter value (filter string suffix).
		 * @throws Exception            - Unsupported filter throw.
		 */
		public function ModifyQuery( $query, $prefix, $value ) {
			// Get DB connection array.
			$connection = WpSecurityAuditLog::GetInstance()->getConnector()->getAdapter( 'Occurrence' )->get_connection();
			$connection->set_charset( $connection->dbh, 'utf8mb4', 'utf8mb4_general_ci' );

			// Tables.
			$meta       = new WSAL_Adapters_MySQL_Meta( $connection );
			$table_meta = $meta->GetTable(); // Metadata.
			$occurrence = new WSAL_Adapters_MySQL_Occurrence( $connection );
			$table_occ  = $occurrence->GetTable(); // Occurrences.

			// Post id search condition.
			$sql = "( EXISTS(SELECT 1 FROM $table_meta as meta WHERE meta.occurrence_id = $table_occ.id AND meta.name='PostID' AND find_in_set(meta.value, %s) > 0) )";

			// Check prefix.
			switch ( $prefix ) {
				case 'postid':
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
	}
}
