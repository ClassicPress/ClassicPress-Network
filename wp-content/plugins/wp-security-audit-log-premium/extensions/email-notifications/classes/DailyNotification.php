<?php
/**
 * Class: Daily Notification Class
 *
 * Daily email notification class for plugin activity.
 *
 * @since 3.2.4
 * @package wsal/email-notifications
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WSAL_OPT_PREFIX' ) ) {
	exit( 'Invalid request' );
}

/**
 * Class WSAL_NP_DailyNotification
 *
 * Daily email notification class for plugin activity.
 *
 * @package wsal/email-notifications
 */
class WSAL_NP_DailyNotification {

	/**
	 * Instance of WpSecurityAuditLog.
	 *
	 * @var WpSecurityAuditLog
	 */
	public $wsal = null;

	/**
	 * Media Links.
	 *
	 * @var array
	 */
	private $media = array();

	/**
	 * Report Body.
	 *
	 * @var string
	 */
	private $report_body = '';

	/**
	 * Daily Report Events
	 *
	 * Events to be included in the daily report summary.
	 *
	 * @var array
	 */
	public static $daily_report_events = array( 1000, 1002, 1003, 2001, 2008, 2012, 2065, 4000, 4001, 4002, 4003, 4004, 4007, 4010, 4011, 5000, 5001, 5002, 5003, 5004, 6028, 6029, 6030, 7000, 7001, 7002, 7003, 7004, 7005 );

	/**
	 * Method: Constructor.
	 *
	 * @param WpSecurityAuditLog $wsal - Instance of WpSecurityAuditLog.
	 */
	public function __construct( WpSecurityAuditLog $wsal ) {
		$this->wsal = $wsal;
		$this->set_media();
	}

	/**
	 * Set Media Links.
	 */
	private function set_media() {
		$this->media['table-bg']          = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/table-bg.jpg';
		$this->media['box-shadow-up']     = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/box-shadow-up.png';
		$this->media['box-shadow-left']   = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/box-shadow-left.png';
		$this->media['logo']              = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/logo.png';
		$this->media['documentation']     = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/documentation.png';
		$this->media['get-support']       = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/get-support.png';
		$this->media['box-shadow-right']  = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/box-shadow-right.png';
		$this->media['box-shadow-bottom'] = trailingslashit( WSAL_BASE_URL ) . 'img/mails/daily-notification/box-shadow-bottom.png';
	}

	/**
	 * Returns report email body.
	 *
	 * @param boolean $test - Test report (Sends current date's report).
	 * @return stdClass
	 */
	public function get_report( $test = false ) {
		$date_format = $this->wsal->settings->GetDateFormat(); // Get date format.
		$today       = date( $date_format ); // Create today's date.
		$date_obj    = DateTime::createFromFormat( $date_format, $today ); // Create date object from the above date format.
		$date_obj->setTime( 0, 0 ); // Set time of the object to 00:00:00.
		$date_string = $date_obj->format( 'U' ); // Get the date in UNIX timestamp.

		if ( ! $test ) {
			$start = strtotime( '-1 day +1 second', $date_string ); // Get yesterday's starting timestamp.
			$end   = strtotime( '-1 second', $date_string ); // Get yesterday's ending timestamp.
		} else {
			// If test then set the start and end timestamps to today's date.
			$start = strtotime( '+1 second', $date_string );
			$end   = strtotime( '+1 day -1 second', $date_string );
		}

		$yesterday = date( $date_format, $start );
		$query     = new WSAL_Models_OccurrenceQuery();
		$site_id   = $this->wsal->settings->get_view_site_id();
		if ( $site_id ) {
			$query->addCondition( 'site_id = %s ', $site_id );
		}
		$query->addCondition( 'find_in_set(alert_id, %s) > 0 ', implode( ',', self::$daily_report_events ) );
		$query->addCondition( 'created_on >= %s', $start ); // From the hour 00:00:01.
		$query->addCondition( 'created_on <= %s', $end ); // To the hour 23:59:59.
		$query->addOrderBy( 'created_on', false );
		$total_events = $query->getAdapter()->Count( $query );
		$events       = $query->getAdapter()->Execute( $query );

		$home_url = home_url();
		$safe_url = str_replace( array( 'http://', 'https://' ), '', $home_url );

		// Report object.
		$report          = new stdClass();
		$report->subject = 'Activity Log Highlight from ' . $safe_url . ' on ' . $yesterday; // Email subject.
		$report->body    = $this->generate_report_body( $events, $yesterday, $total_events ); // Email body.
		return $report;
	}

	/**
	 * Generate Report Body.
	 *
	 * @param array   $events       - Array of events.
	 * @param string  $report_date  - Date of report.
	 * @param integer $total_events - Number of events.
	 * @return string
	 */
	private function generate_report_body( $events, $report_date, $total_events ) {
		$body  = $this->get_report_head();
		$body .= $this->get_report_body( $events, $report_date, $total_events );
		$body .= $this->get_report_footer();
		return $body;
	}

	/**
	 * Returns Report Head.
	 *
	 * @return string
	 */
	private function get_report_head() {
		return '<!doctype html><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /><title>WP Security Audit Log</title></head><body style="margin: 0; padding: 0">';
	}

	/**
	 * Returns Report Footer.
	 *
	 * @return string
	 */
	private function get_report_footer() {
		return '</body></html>';
	}

	/**
	 * Returns Report Body.
	 *
	 * @param array   $events       - Array of events.
	 * @param string  $report_date  - Date of report.
	 * @param integer $total_events - Number of events.
	 * @return string
	 */
	private function get_report_body( $events, $report_date, $total_events ) {
		$home_url = home_url();
		$safe_url = str_replace( array( 'http://', 'https://' ), '', $home_url );

		$number_of_logins         = 0;       // Number of logins.
		$login_events             = array(); // Login events.
		$failed_logins_wrong_pass = array(); // Failed logins wrong pass.
		$failed_logins_wrong_user = array(); // Failed logins wrong user.
		$password_changes         = array(); // Password changes.
		$forced_password_changes  = array(); // Forced password changes.
		$user_profile_changes     = array(); // User profile changes.
		$multisite_activity       = array(); // Multisite network activity.
		$plugin_activity          = array(); // Plugin activity.
		$posts_published          = array(); // Posts published.
		$posts_trashed            = array(); // Posts trashed.
		$posts_deleted            = array(); // Posts deleted.
		$posts_modified           = array(); // Posts modified.
		$files_added              = array(); // Files added.
		$files_modified           = array(); // Files modified.
		$files_deleted            = array(); // Files deleted.
		$plugin_events            = array( 5000, 5001, 5002, 5003, 5004 ); // Plugin events.
		$user_profile_events      = array( 4000, 4001, 4002, 4007 ); // Multisite events.
		$multisite_events         = array( 4010, 4011, 7000, 7001, 7002, 7003, 7004, 7005 ); // Multisite events.

		if ( ! empty( $events ) ) {
			foreach ( $events as $event ) {
				if ( 1000 === $event->alert_id ) {
					$number_of_logins++;
					$login_events[] = $event;
				} elseif ( 1002 === $event->alert_id ) {
					$failed_logins_wrong_pass[] = $event;
				} elseif ( 1003 === $event->alert_id ) {
					$failed_logins_wrong_user[] = $event;
				} elseif ( 4003 === $event->alert_id ) {
					$password_changes[] = $event;
				} elseif ( 4004 === $event->alert_id ) {
					$forced_password_changes[] = $event;
				} elseif ( in_array( $event->alert_id, $plugin_events, true ) ) {
					$plugin_activity[] = $event;
				} elseif ( 2001 === $event->alert_id ) {
					$posts_published[] = $event;
				} elseif ( 2012 === $event->alert_id ) {
					$posts_trashed[] = $event;
				} elseif ( 2008 === $event->alert_id ) {
					$posts_deleted[] = $event;
				} elseif ( 2065 === $event->alert_id ) {
					$posts_modified[] = $event;
				} elseif ( in_array( $event->alert_id, $user_profile_events, true ) ) {
					$user_profile_changes[] = $event;
				} elseif ( in_array( $event->alert_id, $multisite_events, true ) ) {
					$multisite_activity[] = $event;
				} elseif ( 6028 === $event->alert_id ) {
					$files_modified[] = $event;
				} elseif ( 6029 === $event->alert_id ) {
					$files_added[] = $event;
				} elseif ( 6030 === $event->alert_id ) {
					$files_deleted[] = $event;
				}
			}
		}

		$body  = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image: url(' . $this->media['table-bg'] . '); background-repeat: repeat-x; background-color: #ffffff; padding-top: 20px;">';
		$body .= '<tr><td align="center"><div style="width: 100%; max-width: 630px; margin: 0 auto;"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width: 630px; margin: 0 auto;"><tbody><tr><td colspan="3" height="11" style="background-image: url(' . $this->media['box-shadow-up'] . '); height: 20px; background-repeat: repeat-x;"></td></tr><tr><td width="13" style=" background-image: url(' . $this->media['box-shadow-left'] . ');background-repeat: repeat-y;"></td><td><table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width: 620px; margin: 0 auto; background: #ffffff;"><tbody><!-- Header Strat --><tr><td style="background-color: #ffffff;"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-top: 50px; padding-bottom: 43px; background-color: #eeede8;"><tbody><!-- Logo Strat --><tr><td style="text-align: center;"><a href="#" target="_blank" style="display: inline-block;"><img src="' . $this->media['logo'] . '" alt="WSAL Logo"></a></td></tr><!-- Logo End --><!-- Tag Line Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 20px; line-height: 28px; color: #3e3e3e; text-align: center; padding-top: 22px; padding-bottom: 5px; padding-right: 10px; padding-left: 10px;">Your daily WordPress activity log highlight</td></tr><!-- Tag Line Start --></tbody></table></td></tr><!-- Header End --><!-- Mailer Content Start --><tr><td style="background-color: #ffffff; padding-left: 40px; padding-right: 40px; padding-top: 34px;"><table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width: 620px; margin: 0 auto; background: #ffffff;"><!-- Hello Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Hello,</td></tr><!-- Title End --><!-- Desc Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 34px;">';
		$body .= sprintf( 'This email was sent from your <a href="%1$s" target="_blank" style="color: #404040; text-decoration: none; display: inline-block;">%2$s</a>. It is a summary generated by the <a href="https://wordpress.org/plugins/wp-security-audit-log" target="_blank" style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #149247; text-decoration: underline; display: inline-block;">WP Security Audit Log plugin</a> about what happened on %3$s.', $home_url, $safe_url, $report_date );
		$body .= '</td></tr><!-- Desc End -->';

		if ( empty( $events ) ) {
			$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 34px;">No events so far.</td></tr><!-- Desc End -->';
		}

		$body .= '</table></td></tr><!-- Hello End -->';

		if ( ! empty( $events ) ) {
			// User logins.
			if ( $number_of_logins && ! empty( $login_events ) ) {
				$body .= '<!-- User Logins Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">User Logins</td></tr><!-- Title End --><!-- Desc Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; text-align: left;">';
				/* Translators: Number of logins. */
				$body .= sprintf( __( 'There were %s logins on your site. Below is an overview of these logins:', 'wp-security-audit-log' ), $number_of_logins );
				$body .= '</td></tr><!-- Table Border Start --><tr><td style="padding-top: 20px; padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">';

				$user_logins = array();
				foreach ( $login_events  as $login_event ) {
					$username = $login_event->GetUsername();
					$ipaddr   = $login_event->GetSourceIP();

					if ( ! empty( $username ) && ! empty( $ipaddr ) ) {
						$user_logins[ $username ][] = $ipaddr;
					}
				}

				if ( ! empty( $user_logins ) ) {
					foreach ( $user_logins as $username => $ipaddrs ) {
						$ipaddr = array_unique( $ipaddrs );
						$ipaddr = implode( ',', $ipaddr );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						/* 1. Username 2. IP Address */
						$body .= sprintf( 'User %1$s from %2$s', '<span style="display: inline-block; color: #149247;">' . $username . '</span>', '<span style="display: inline-block; color: #149247;">' . $ipaddr . '</span>' );
						$body .= '</td></tr>';
					}
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- User Logins End -->';
			}

			// Failed user logins.
			if ( ! empty( $failed_logins_wrong_pass ) || ! empty( $failed_logins_wrong_user ) ) {
				$body .= '<!-- Failed Logins Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Failed Logins</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-top: 10px; padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">';

				if ( ! empty( $failed_logins_wrong_pass ) ) {
					$body .= '<tr><td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">There were failed logins due to a wrong password from the following IP addresses:';

					$previous_ips = array();
					foreach ( $failed_logins_wrong_pass as $event ) {
						$current_ip = $event->GetSourceIP();

						if ( ! in_array( $current_ip, $previous_ips, true ) ) {
							$body          .= '<span style="display: block; color: #149247;">' . $current_ip . '</span>';
							$previous_ips[] = $current_ip;
						}
					}

					$body .= '</td></tr>';
				}

				if ( ! empty( $failed_logins_wrong_user ) ) {
					$body .= '<tr><td style="border-bottom: 1px solid #b2b2ad; border-left: 1px solid #b2b2ad; border-right: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">There were failed logins due to a wrong username from the following IP addresses:';

					$previous_ips = array();
					foreach ( $failed_logins_wrong_user as $event ) {
						$current_ip = $event->GetSourceIP();

						if ( ! in_array( $current_ip, $previous_ips, true ) ) {
							$body          .= '<span style="display: block; color: #149247;">' . $current_ip . '</span>';
							$previous_ips[] = $current_ip;
						}
					}

					$body .= '</td></tr>';
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Failed Logins End -->';
			}

			// Password changes.
			if ( ! empty( $password_changes ) || ! empty( $forced_password_changes ) ) {
				$body .= '<!-- Password Changes Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Password Changes</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">';

				if ( ! empty( $password_changes ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;">These users changed their password:</td></tr>';

					foreach ( $password_changes as $event ) {
						$user_data = $event->GetMetaValue( 'TargetUserData', false );
						if ( ! $user_data ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= '<span style="display: inline-block; color: #149247;">' . $user_data->Username . '</span> from <span style="display: inline-block; color: #149247;">' . $event->GetSourceIP() . '</span>';
						$body .= '</td></tr>';
					}
				}

				if ( ! empty( $forced_password_changes ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px; padding-top: 20px;">These users had their password changed:</td></tr>';

					foreach ( $forced_password_changes as $event ) {
						$user_data = $event->GetMetaValue( 'TargetUserData', false );
						if ( ! $user_data ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border-top: 1px solid #b2b2ad; border-bottom: 1px solid #b2b2ad; border-left: 1px solid #b2b2ad; border-right: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= '<span style="display: inline-block; color: #149247;">' . $user_data->Username . '</span> — password changed by <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> from <span style="display: inline-block; color: #149247;">' . $event->GetSourceIP() . '</span>';
						$body .= '</td></tr>';
					}
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Password Changes End -->';
			}

			// User profile changes.
			if ( ! empty( $user_profile_changes ) ) {
				$body .= '<!-- User Profile Changes Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">User Profile Changes</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;">Below is a list of important user profile changes that happened on your website:</td></tr>';

				foreach ( $user_profile_changes as $event ) {
					if ( 4000 === $event->alert_id ) {
						$user_data = $event->GetMetaValue( 'NewUserData', false );
						if ( $user_data ) {
							$body .= '<tr>';
							$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
							$body .= 'User <span style="display: inline-block; color: #149247;">' . $user_data->Username . '</span> has registered on your website from <span style="display: inline-block; color: #149247;">' . $event->GetSourceIP() . '</span>';
							$body .= '</td>';
							$body .= '</tr>';
						}
					} elseif ( 4001 === $event->alert_id ) {
						$user_data = $event->GetMetaValue( 'NewUserData', false );
						if ( $user_data ) {
							$body .= '<tr>';
							$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
							$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has created the user <span style="display: inline-block; color: #149247;">' . $user_data->Username . '</span> with the role <span style="display: inline-block; color: #149247;">' . $user_data->Roles . '</span>';
							$body .= '</td>';
							$body .= '</tr>';
						}
					} elseif ( 4002 === $event->alert_id ) {
						$username = $event->GetMetaValue( 'TargetUsername', false );
						$userrole = $event->GetMetaValue( 'NewRole', false );
						if ( $username ) {
							$body .= '<tr>';
							$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
							$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has changed the role of the user <span style="display: inline-block; color: #149247;">' . $username . '</span> with the role <span style="display: inline-block; color: #149247;">' . $userrole . '</span>';
							$body .= '</td>';
							$body .= '</tr>';
						}
					} elseif ( 4007 === $event->alert_id ) {
						$user_data = $event->GetMetaValue( 'TargetUserData', false );
						if ( $user_data ) {
							$body .= '<tr>';
							$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
							$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has deleted the user <span style="display: inline-block; color: #149247;">' . $user_data->Username . '</span> with the role <span style="display: inline-block; color: #149247;">' . $user_data->Roles . '</span>';
							$body .= '</td>';
							$body .= '</tr>';
						}
					}
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- User Profile Changes End -->';
			}

			// Multisite activity.
			if ( ! empty( $multisite_activity ) ) {
				$body .= '<!-- Multisite Network Activity Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Multisite Network Activity</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;">Below is a list of important events that occured on your multisite network:</td></tr>';

				foreach ( $multisite_activity as $event ) {
					if ( 7000 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has added site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 7001 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has archived site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 7002 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has unarchived site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 7003 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has activated site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 7004 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has deactivated site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 7005 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> has deleted site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 4010 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );
						$username = $event->GetMetaValue( 'TargetUsername', false );
						$userrole = $event->GetMetaValue( 'TargetUserRole', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> added the user <span style="display: inline-block; color: #149247;">' . $username . '</span> to the site <span style="display: inline-block; color: #149247;">' . $sitename . '</span> with the role of <span style="display: inline-block; color: #149247;">' . $userrole . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					} elseif ( 4011 === $event->alert_id ) {
						$sitename = $event->GetMetaValue( 'SiteName', false );
						$username = $event->GetMetaValue( 'TargetUsername', false );

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> removed the user <span style="display: inline-block; color: #149247;">' . $username . '</span> from the site <span style="display: inline-block; color: #149247;">' . $sitename . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					}
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Multisite Network Activity End -->';
			}

			// Plugin activity.
			if ( ! empty( $plugin_activity ) ) {
				$body .= '<!-- Plugins Activity Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Plugins Activity</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;">Below is a list of plugin changes that happened on your website:</td></tr>';

				foreach ( $plugin_activity as $event ) {
					$plugin_data = false;
					if ( 5000 === $event->alert_id ) {
						$plugin_data = $event->GetMetaValue( 'Plugin', false );
					} else {
						$plugin_data = $event->GetMetaValue( 'PluginData', false );
					}

					if ( ! $plugin_data ) {
						continue;
					}

					$body .= '<tr>';
					$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
					if ( 5000 === $event->alert_id ) {
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> installed the plugin <span style="display: inline-block; color: #149247;">' . $plugin_data->Name . '</span>';
					} elseif ( 5001 === $event->alert_id ) {
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> activated the plugin <span style="display: inline-block; color: #149247;">' . $plugin_data->Name . '</span>';
					} elseif ( 5002 === $event->alert_id ) {
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> deactivated the plugin <span style="display: inline-block; color: #149247;">' . $plugin_data->Name . '</span>';
					} elseif ( 5003 === $event->alert_id ) {
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> uninstalled the plugin <span style="display: inline-block; color: #149247;">' . $plugin_data->Name . '</span>';
					} elseif ( 5004 === $event->alert_id ) {
						$body .= 'User <span style="display: inline-block; color: #149247;">' . $event->GetUsername() . '</span> upgraded the plugin <span style="display: inline-block; color: #149247;">' . $plugin_data->Name . '</span>';
					}
					$body .= '</td>';
					$body .= '</tr>';
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Plugins Activity End -->';
			}

			// Content changes.
			if (
				! empty( $posts_published )
				|| ! empty( $posts_trashed )
				|| ! empty( $posts_deleted )
				|| ! empty( $posts_modified )
			) {
				$body .= '<!-- Content Changes Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Content Changes</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">';

				if ( ! empty( $posts_published ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;">These posts were published:</td></tr>';

					foreach ( $posts_published as $post_event ) {
						$post_title = $post_event->GetMetaValue( 'PostTitle', false );
						if ( ! $post_title ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						if ( $this->wsal->IsMultisite() ) {
							$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . ' on site <span style="display: inline-block; color: #149247;">' . $safe_url . '</span>';
						} else {
							$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span>';
						}
						$body .= '</td>';
						$body .= '</tr>';
					}
				}

				if ( ! empty( $posts_trashed ) || ! empty( $posts_deleted ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px; padding-top: 20px;">These posts were moved to trash or permanently deleted:</td></tr>';

					if ( ! empty( $posts_trashed ) ) {
						foreach ( $posts_trashed as $post_event ) {
							$post_title = $post_event->GetMetaValue( 'PostTitle', false );
							if ( ! $post_title ) {
								continue;
							}

							$body .= '<tr>';
							$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
							if ( $this->wsal->IsMultisite() ) {
								/* Translators: 1. Post Title 2. Username 3. Site URL */
								$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> sent to trash by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span> on site <span style="display: inline-block; color: #149247;">' . $safe_url . '</span>';
							} else {
								/* Translators: 1. Post Title 2. Username */
								$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> sent to trash by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span>';
							}
							$body .= '</td>';
							$body .= '</tr>';
						}
					}

					if ( ! empty( $posts_deleted ) ) {
						foreach ( $posts_deleted as $post_event ) {
							$post_title = $post_event->GetMetaValue( 'PostTitle', false );
							if ( ! $post_title ) {
								continue;
							}

							$body .= '<tr>';
							$body .= '<td style="border-bottom: 1px solid #b2b2ad; border-left: 1px solid #b2b2ad; border-right: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
							if ( $this->wsal->IsMultisite() ) {
								/* Translators: 1. Post Title 2. Username 3. Site URL */
								$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> deleted permanently by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span> on site <span style="display: inline-block; color: #149247;">' . $safe_url . '</span>';
							} else {
								/* Translators: 1. Post Title 2. Username */
								$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> deleted permanently by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span>';
							}
							$body .= '</td>';
							$body .= '</tr>';
						}
					}
				}

				if ( ! empty( $posts_modified ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px; padding-top: 20px;">The content of these posts was changed:</td></tr>';

					foreach ( $posts_modified as $post_event ) {
						$post_title = $post_event->GetMetaValue( 'PostTitle', false );
						if ( ! $post_title ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						if ( $this->wsal->IsMultisite() ) {
							$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span> on site <span style="display: inline-block; color: #149247;">' . $safe_url . '</span>';
						} else {
							$body .= '<span style="display: inline-block; color: #149247;">' . $post_title . '</span> by <span style="display: inline-block; color: #149247;">' . $post_event->GetUsername() . '</span>';
						}
						$body .= '</td>';
						$body .= '</tr>';
					}
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Content Changes End -->';
			}

			// File changes.
			if ( ! empty( $files_added ) || ! empty( $files_modified ) || ! empty( $files_deleted ) ) {
				$body .= '<!-- Website File Changes Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Title Start --><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: left; padding-bottom: 13px;">Website File Changes</td></tr><!-- Title End --><!-- Desc Start --><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0">';

				if ( ! empty( $files_added ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;">These files were added to your site:</td></tr>';

					foreach ( $files_added as $file_event ) {
						$file_location = $file_event->GetMetaValue( 'FileLocation', false );
						if ( ! $file_location ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= '<span style="display: inline-block; color: #149247;">' . $file_location . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					}
				}

				if ( ! empty( $files_modified ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;padding-top: 20px;">These site files were modified:</td></tr>';

					foreach ( $files_modified as $file_event ) {
						$file_location = $file_event->GetMetaValue( 'FileLocation', false );
						if ( ! $file_location ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= '<span style="display: inline-block; color: #149247;">' . $file_location . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					}
				}

				if ( ! empty( $files_deleted ) ) {
					$body .= '<tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;padding-bottom: 20px;padding-top: 20px;">These files were deleted from your site:</td></tr>';

					foreach ( $files_deleted as $file_event ) {
						$file_location = $file_event->GetMetaValue( 'FileLocation', false );
						if ( ! $file_location ) {
							continue;
						}

						$body .= '<tr>';
						$body .= '<td style="border: 1px solid #b2b2ad; font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; padding-left: 24px; padding-right: 24px; padding-top: 10px; padding-bottom: 10px;">';
						$body .= '<span style="display: inline-block; color: #149247;">' . $file_location . '</span>';
						$body .= '</td>';
						$body .= '</tr>';
					}
				}

				$body .= '</table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Website File Changes End -->';
			}
		}

		// Total events.
		$body .= '<!-- Total Events Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0"><!-- Table Border Start --><tr><td style="padding-bottom: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040;">Yesterday the WP Security Audit Log plugin logged ' . $total_events . ' events in the WordPress activity log. <a href="' . add_query_arg( 'page', 'wsal-auditlog', admin_url( 'admin.php' ) ) . '" target="_blank" style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #149247;">Visit the activity log</a></td></tr></table></td></tr><!-- Table Border Start --><!-- Desc End --></table></td></tr><!-- Total Events End -->';

		// Close content table.
		$body .= '</table></td></tr><!-- Mailer Content End -->';

		// CTA.
		$body .= '<!-- Cta Start --><tr><td><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eeede8;"><tbody><tr><td style="padding-top: 44px; padding-bottom: 30px; margin: 0 auto; "><table width="100%" cellpadding="0" cellspacing="0" border="0"><tbody><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 20px; line-height: 28px; color: #404040; text-align: center; padding-bottom: 15px;">Help & Support</td></tr><tr><td style="text-align: center;"><table align="center" cellspacing="0" cellpadding="0" border="0" style="margin: 0 auto;"><tbody><tr><td style="text-align: center; padding-top: 20px; width: 285px; display: inline-block;"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;"><tbody><tr><td><img src="' . $this->media['documentation'] . '" alt="Documentation"></td></tr><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 16px; line-height: 26px; color: #404040; text-align: center; padding-bottom: 10px; padding-top: 7px;">Documentation</td></tr><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; text-align: center; padding-bottom: 15px;">Refer to our <a href="https://www.wpsecurityauditlog.com/support-documentation/" style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #149247; text-decoration: underline; display: inline-block;" target="_blank">knowledge base</a> for plugin documentation</td></tr></tbody></table></td><td style="text-align: center; padding-top: 20px; width: 285px; display: inline-block;"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0 auto;"><tbody><tr><td><img src="' . $this->media['get-support'] . '" alt="Get Support"></td></tr><tr><td style="font-family: Verdana, sans-serif; font-weight: bold; font-size: 16px; line-height: 26px; color: #404040; text-align: center; padding-bottom: 10px; padding-top: 7px;">Get Support</td></tr><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #404040; text-align: center; padding-bottom: 15px;">Need help? Email us on<a href="mailto:info@wpsecurityauditlog.com"  style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 16px; line-height: 28px; color: #149247; text-decoration: underline; display: inline-block;"> info@wpsecurityauditlog.com</a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr><!-- Cta End -->';

		$body .= '</tbody></table></td><td width="15" style="background-image: url(' . $this->media['box-shadow-right'] . ');     background-repeat: repeat-y;"></td></tr><tr><td colspan="3" height="17" style="background-image: url(' . $this->media['box-shadow-bottom'] . '); height: 17px; background-repeat: repeat-x;"></td></tr></tbody></table></div></td></tr><tr><td align="center" style="padding-left: 40px; padding-right: 40px;"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 520px; margin: 0 auto;"><tr><td style="text-align: center; padding-top: 35px; padding-bottom: 20px;"><a href="#" style="display: inline-block; text-decoration: none;"><img src="' . $this->media['logo'] . '"></a></td></tr><tr><td style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 14px; line-height: 28px; color: #404040; padding-bottom: 40px; text-align: center;">This email is generated by WP Security Audit Log. To disable this daily overview navigate to the <a href="' . add_query_arg( 'page', 'wsal-np-notifications', admin_url( 'admin.php' ) ) . '#tab-built-in" target="_blank" style="font-family: Verdana, sans-serif; font-weight: normal; font-size: 14px; line-height: 28px; color: #149247;">email notifications settings</a></td></tr></table></td></tr></table>';

		return $body;
	}
}
