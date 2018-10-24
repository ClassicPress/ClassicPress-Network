<?php
/**
 * Class: Alert Filter
 *
 * Filter for alert codes.
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
 * Class WSAL_AS_Filters_AlertFilter
 */
class WSAL_AS_Filters_AlertFilter extends WSAL_AS_Filters_AbstractFilter {

	/**
	 * Method: Get Name.
	 */
	public function GetName() {
		return __( 'Event ID', 'wp-security-audit-log' );
	}

	/**
	 * Method: Returns true if this filter has suggestions for this query.
	 *
	 * @param string $query - Part of query to check.
	 */
	public function IsApplicable( $query ) {
		return strtolower( substr( trim( $query ), 0, 5 ) ) == 'event';
	}

	/**
	 * Method: Get Prefixes.
	 */
	public function GetPrefixes() {
		return array(
			'event',
		);
	}

	/**
	 * Method: Get Widgets.
	 */
	public function GetWidgets() {
		return array( new WSAL_AS_Filters_AlertWidget( $this, 'event', esc_html__( 'Event ID', 'wp-security-audit-log' ) ) );
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
		switch ( $prefix ) {
			case 'event':
				$query->addORCondition(
					array(
						'alert_id = %s' => $value,
					)
				);
				break;
			default:
				throw new Exception( 'Unsupported filter "' . $prefix . '".' );
		}
	}
}
