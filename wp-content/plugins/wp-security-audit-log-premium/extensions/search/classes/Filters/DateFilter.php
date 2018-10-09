<?php
/**
 * Class: Date Filter
 *
 * Date filter for search extension.
 *
 * @package wsal
 * @subpackage search
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WSAL_AS_Filters_DateFilter
 *
 * @package search-wsal
 */
class WSAL_AS_Filters_DateFilter extends WSAL_AS_Filters_AbstractFilter {

	/**
	 * Method: Get Name.
	 */
	public function GetName() {
		return __( 'Date', 'wp-security-audit-log' );
	}

	/**
	 * Method: Returns true if this filter has suggestions for this query.
	 *
	 * @param string $query - Part of query to check.
	 */
	public function IsApplicable( $query ) {
		return false;
	}

	/**
	 * Method: Get Prefixes.
	 */
	public function GetPrefixes() {
		return array(
			'from',
			'to',
			'on',
		);
	}

	/**
	 * Method: Get Widgets.
	 */
	public function GetWidgets() {
		return array(
			new WSAL_AS_Filters_DateWidget( $this, 'from', esc_html__( 'Older than', 'wp-security-audit-log' ) ),
			new WSAL_AS_Filters_DateWidget( $this, 'to', esc_html__( 'Earlier than', 'wp-security-audit-log' ) ),
			new WSAL_AS_Filters_DateWidget( $this, 'on', esc_html__( 'On this day', 'wp-security-audit-log' ) ),
		);
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
		$date_format = WpSecurityAuditLog::GetInstance()->settings->GetDateFormat();
		$date        = DateTime::createFromFormat( $date_format, $value[0] );
		$date->setTime( 0, 0 ); // Reset time to 00:00:00.
		$date_string = $date->format( 'U' );

		switch ( $prefix ) {
			case 'from':
				$query->addCondition( 'created_on >= %s', $date_string );
				break;
			case 'to':
				$query->addCondition( 'created_on <= %s', strtotime( '+1 day -1 minute', $date_string ) );
				break;
			case 'on':
				/**
				 * We need to create a date range for events on a particular
				 * date.
				 *   1. From the hour 00:00:01
				 *   2. To the hour 23:59:59
				 */
				$query->addCondition( 'created_on >= %s', strtotime( '-1 day +1 day +1 second', $date_string ) ); // From the hour 00:00:01.
				$query->addCondition( 'created_on <= %s', strtotime( '+1 day -1 second', $date_string ) ); // To the hour 23:59:59.
				break;
			default:
				throw new Exception( 'Unsupported filter "' . $prefix . '".' );
		}
	}
}
