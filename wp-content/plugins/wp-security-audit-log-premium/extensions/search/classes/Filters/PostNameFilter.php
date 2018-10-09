<?php
/**
 * Filter: Post Name Filter
 *
 * Post Name filter for search.
 *
 * @since 3.2.3
 * @package wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WSAL_AS_Filters_PostNameFilter' ) ) :

	/**
	 * WSAL_AS_Filters_PostNameFilter.
	 *
	 * Post name filter class.
	 */
	class WSAL_AS_Filters_PostNameFilter extends WSAL_AS_Filters_AbstractFilter {

		/**
		 * Method: Get Name.
		 */
		public function GetName() {
			return esc_html__( 'Post Name' );
		}

		/**
		 * Method: Get Prefixes.
		 */
		public function GetPrefixes() {
			return array(
				'postname',
			);
		}

		/**
		 * Method: Returns true if this filter has suggestions for this query.
		 *
		 * @param string $query - Part of query to check.
		 */
		public function IsApplicable( $query ) {
			return true;
		}

		/**
		 * Method: Get Widgets.
		 */
		public function GetWidgets() {
			return array( new WSAL_AS_Filters_PostNameWidget( $this, 'postname', esc_html__( 'Post Name', 'wp-security-audit-log' ) ) );
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

			// Post name search condition.
			$sql   = "( EXISTS(SELECT 1 FROM $table_meta as meta WHERE meta.occurrence_id = $table_occ.id AND meta.name='PostTitle' AND (meta.value LIKE %s) > 0) )";
			$value = array_map( array( $this, 'add_string_wildcards' ), $value );

			// Check prefix.
			switch ( $prefix ) {
				case 'postname':
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
		 * Modify post name values to include MySQL wildcards.
		 *
		 * @param string $search_value – Searched post name.
		 * @return string
		 */
		private function add_string_wildcards( $search_value ) {
			return '%' . $search_value . '%';
		}
	}

endif;
