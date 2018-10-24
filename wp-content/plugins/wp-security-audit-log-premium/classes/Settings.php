<?php
/**
 * Class: WSAL Settings.
 *
 * WSAL settings class.
 *
 * @package Wsal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This class is the actual controller of the Settings Page.
 *
 * @package Wsal
 */
class WSAL_Settings {

	/**
	 * Instance of the main plugin.
	 *
	 * @var WpSecurityAuditLog
	 */
	protected $_plugin;

	const OPT_DEV_DATA_INSPECTOR = 'd';
	const OPT_DEV_PHP_ERRORS     = 'p';
	const OPT_DEV_REQUEST_LOG    = 'r';
	const OPT_DEV_BACKTRACE_LOG  = 'b';

	const ERROR_CODE_INVALID_IP = 901;

	/**
	 * Dev Options.
	 *
	 * @var array
	 */
	protected $_devoption = null;

	/**
	 * Pruning Date.
	 *
	 * @var string
	 */
	protected $_pruning = 0;

	/**
	 * IDs of disabled alerts.
	 *
	 * @var array
	 */
	protected $_disabled = null;

	/**
	 * Allowed Plugin Viewers.
	 *
	 * @var array
	 */
	protected $_viewers = null;

	/**
	 * Allowed Plugin Editors.
	 *
	 * @var array
	 */
	protected $_editors = null;

	/**
	 * Alerts per page.
	 *
	 * @var int
	 */
	protected $_perpage = null;

	/**
	 * Users excluded from monitoring.
	 *
	 * @var array
	 */
	protected $_excluded_users = array();

	/**
	 * Roles excluded from monitoring.
	 *
	 * @var array
	 */
	protected $_excluded_roles = array();

	/**
	 * Custom fields excluded from monitoring.
	 *
	 * @var array
	 */
	protected $_excluded_custom = array();

	/**
	 * Custom Post Types excluded from monitoring.
	 *
	 * @var array
	 */
	protected $_post_types = array();

	/**
	 * IP excluded from monitoring.
	 *
	 * @var array
	 */
	protected $_excluded_ip = array();

	/**
	 * URLs excluded from monitoring.
	 *
	 * @var array
	 * @since 3.2.2
	 */
	protected $excluded_urls = array();

	/**
	 * Alerts enabled in Geek mode.
	 *
	 * @var array
	 */
	public $geek_alerts = array( 1004, 1005, 1006, 1007, 2023, 2024, 2053, 2054, 2055, 2062, 2100, 2106, 2111, 2112, 2124, 2125, 2094, 2095, 2043, 2071, 2082, 2083, 2085, 2089, 4014, 4015, 4016, 5010, 5011, 5012, 5019, 5025, 5013, 5014, 5015, 5016, 5017, 5018, 6001, 6002, 6007, 6008, 6010, 6011, 6012, 6013, 6014, 6015, 6016, 6017, 6018, 6023, 6024, 6025 );

	/**
	 * Method: Constructor.
	 *
	 * @param WpSecurityAuditLog $plugin - Instance of WpSecurityAuditLog.
	 */
	public function __construct( WpSecurityAuditLog $plugin ) {
		$this->_plugin = $plugin;

		add_action( 'deactivated_plugin', array( $this, 'reset_stealth_mode' ), 10, 1 );
	}

	/**
	 * Enable Basic Mode.
	 */
	public function set_basic_mode() {
		// Disable alerts of geek mode.
		$this->SetDisabledAlerts( $this->geek_alerts );
	}

	/**
	 * Enable Geek Mode.
	 */
	public function set_geek_mode() {
		// Disable alerts of geek mode.
		$this->SetDisabledAlerts( array() );
	}

	/**
	 * Return array of developer options to be enabled by default.
	 *
	 * @return array
	 */
	public function GetDefaultDevOptions() {
		return array();
	}

	/**
	 * Returns whether a developer option is enabled or not.
	 *
	 * @param string $option - See self::OPT_DEV_* constants.
	 * @return boolean - If option is enabled or not.
	 */
	public function IsDevOptionEnabled( $option ) {
		if ( is_null( $this->_devoption ) ) {
			$this->_devoption = $this->_plugin->GetGlobalOption(
				'dev-options',
				implode( ',', $this->GetDefaultDevOptions() )
			);
			$this->_devoption = explode( ',', $this->_devoption );
		}
		return in_array( $option, $this->_devoption );
	}

	/**
	 * Check whether any developer option has been enabled or not.
	 *
	 * @return boolean
	 */
	public function IsAnyDevOptionEnabled() {
		return ! ! $this->_plugin->GetGlobalOption( 'dev-options', null );
	}

	/**
	 * Sets whether a developer option is enabled or not.
	 *
	 * @param string  $option - See self::OPT_DEV_* constants.
	 * @param boolean $enabled - If option should be enabled or not.
	 */
	public function SetDevOptionEnabled( $option, $enabled ) {
		// Make sure options have been loaded.
		$this->IsDevOptionEnabled( '' );
		// Remove option if it exists.
		while ( ($p = array_search( $option, $this->_devoption )) !== false ) {
			unset( $this->_devoption[ $p ] );
		}
		// Add option if callee wants it enabled.
		if ( $enabled ) {
			$this->_devoption[] = $option;
		}
		// Commit option.
		$this->_plugin->SetGlobalOption(
			'dev-options',
			implode( ',', $this->_devoption )
		);
	}

	/**
	 * Remove all enabled developer options.
	 */
	public function ClearDevOptions() {
		$this->_devoption = array();
		$this->_plugin->SetGlobalOption( 'dev-options', '' );
	}

	/**
	 * Check whether to enable data inspector or not.
	 *
	 * @return boolean
	 */
	public function IsDataInspectorEnabled() {
		return $this->IsDevOptionEnabled( self::OPT_DEV_DATA_INSPECTOR );
	}

	/**
	 * Check whether to enable PHP error logging or not.
	 *
	 * @return boolean
	 */
	public function IsPhpErrorLoggingEnabled() {
		return $this->IsDevOptionEnabled( self::OPT_DEV_PHP_ERRORS );
	}

	/**
	 * Check whether to log requests to file or not.
	 *
	 * @return boolean
	 */
	public function IsRequestLoggingEnabled() {
		return $this->IsDevOptionEnabled( self::OPT_DEV_REQUEST_LOG );
	}

	/**
	 * Check whether to store debug backtrace for PHP alerts or not.
	 *
	 * @return boolean
	 */
	public function IsBacktraceLoggingEnabled() {
		return $this->IsDevOptionEnabled( self::OPT_DEV_BACKTRACE_LOG );
	}

	/**
	 * Check whether dashboard widgets are enabled or not.
	 *
	 * @return boolean
	 */
	public function IsWidgetsEnabled() {
		return ! $this->_plugin->GetGlobalOption( 'disable-widgets' );
	}

	/**
	 * Check whether dashboard widgets are enabled or not.
	 *
	 * @param boolean $newvalue - True if enabled.
	 */
	public function SetWidgetsEnabled( $newvalue ) {
		$this->_plugin->SetGlobalOption( 'disable-widgets', ! $newvalue );
	}

	/**
	 * Check whether admin bar notifications are enabled or not.
	 *
	 * @since 3.2.4
	 *
	 * @return boolean
	 */
	public function is_admin_bar_notif() {
		return ! $this->_plugin->GetGlobalOption( 'disable-admin-bar-notif' );
	}

	/**
	 * Set admin bar notifications.
	 *
	 * @since 3.2.4
	 *
	 * @param boolean $newvalue - True if enabled.
	 */
	public function set_admin_bar_notif( $newvalue ) {
		$this->_plugin->SetGlobalOption( 'disable-admin-bar-notif', ! $newvalue );
	}

	/**
	 * Check whether alerts in audit log view refresh automatically or not.
	 *
	 * @return boolean
	 */
	public function IsRefreshAlertsEnabled() {
		return ! $this->_plugin->GetGlobalOption( 'disable-refresh' );
	}

	/**
	 * Check whether alerts in audit log view refresh automatically or not.
	 *
	 * @param boolean $newvalue - True if enabled.
	 */
	public function SetRefreshAlertsEnabled( $newvalue ) {
		$this->_plugin->SetGlobalOption( 'disable-refresh', ! $newvalue );
	}

	/**
	 * Maximum number of alerts to show in dashboard widget.
	 *
	 * @return int
	 */
	public function GetDashboardWidgetMaxAlerts() {
		return 5;
	}

	/**
	 * The maximum number of alerts allowable.
	 *
	 * @return int
	 */
	public function GetMaxAllowedAlerts() {
		return 5000;
	}

	/**
	 * The default pruning date.
	 *
	 * @return string
	 */
	public function GetDefaultPruningDate() {
		return '6 months';
	}

	/**
	 * The current pruning date.
	 *
	 * @return string
	 */
	public function GetPruningDate() {
		if ( ! $this->_pruning ) {
			$this->_pruning = $this->_plugin->GetGlobalOption( 'pruning-date' );
			if ( ! strtotime( $this->_pruning ) ) {
				$this->_pruning = $this->GetDefaultPruningDate();
			}
		}
		return $this->_pruning;
	}

	/**
	 * Set the new pruning date.
	 *
	 * @param string $newvalue - The new pruning date.
	 */
	public function SetPruningDate( $newvalue ) {
		if ( strtotime( $newvalue ) ) {
			$this->_plugin->SetGlobalOption( 'pruning-date', $newvalue );
			$this->_pruning = $newvalue;
		}
	}

	/**
	 * Return current pruning unit.
	 *
	 * @return string
	 */
	public function get_pruning_unit() {
		return $this->_plugin->GetGlobalOption( 'pruning-unit', 'months' );
	}

	/**
	 * Set current pruning unit.
	 *
	 * @param string $newvalue – New value of pruning unit.
	 */
	public function set_pruning_unit( $newvalue ) {
		$this->_plugin->SetGlobalOption( 'pruning-unit', $newvalue );
	}

	/**
	 * Maximum number of alerts to keep.
	 *
	 * @return integer
	 */
	public function GetPruningLimit() {
		$val = (int) $this->_plugin->GetGlobalOption( 'pruning-limit' );
		return $val ? $val : $this->GetMaxAllowedAlerts();
	}

	/**
	 * Set pruning alerts limit.
	 *
	 * @param integer $newvalue - The new maximum number of alerts.
	 */
	public function SetPruningLimit( $newvalue ) {
		$newvalue = max( /*min(*/ (int) $newvalue/*, $this->GetMaxAllowedAlerts())*/, 1 );
		$this->_plugin->SetGlobalOption( 'pruning-limit', $newvalue );
	}

	public function SetPruningDateEnabled( $enabled ) {
		$this->_plugin->SetGlobalOption( 'pruning-date-e', $enabled );
	}

	public function SetPruningLimitEnabled( $enabled ) {
		$this->_plugin->SetGlobalOption( 'pruning-limit-e', $enabled );
	}

	public function IsPruningDateEnabled() {
		return $this->_plugin->GetGlobalOption( 'pruning-date-e' );
	}

	public function IsPruningLimitEnabled() {
		return $this->_plugin->GetGlobalOption( 'pruning-limit-e' );
	}

	public function IsRestrictAdmins() {
		return $this->_plugin->GetGlobalOption( 'restrict-admins', false );
	}

	/**
	 * Sandbox functionality is now in an external plugin.
	 *
	 * @deprecated
	 */
	public function IsSandboxPageEnabled() {
		// $plugins = $this->_plugin->licensing->plugins();
		// return isset($plugins['wsal-sandbox-extensionphp']);
		return esc_html__( 'This function is deprecated', 'wp-security-audit-log' );
	}

	public function SetRestrictAdmins( $enable ) {
		$this->_plugin->SetGlobalOption( 'restrict-admins', (bool) $enable );
	}

	/**
	 * Method: Set Login Page Notification.
	 *
	 * @param bool $enable - Enable/Disable.
	 */
	public function set_login_page_notification( $enable ) {
		$this->_plugin->SetGlobalOption( 'login_page_notification', $enable );
	}

	/**
	 * Method: Check if Login Page Notification is set.
	 *
	 * @return bool - True if set, false if not.
	 */
	public function is_login_page_notification() {
		return $this->_plugin->GetGlobalOption( 'login_page_notification', false );
	}

	/**
	 * Method: Set Login Page Notification Text.
	 *
	 * @param string $text - Login Page Notification Text.
	 */
	public function set_login_page_notification_text( $text ) {
		$text = wp_kses( $text, $this->_plugin->allowed_html_tags );
		$this->_plugin->SetGlobalOption( 'login_page_notification_text', $text );
	}

	/**
	 * Method: Return Login Page Notification Text.
	 *
	 * @return string|bool - Text if set, false if not.
	 */
	public function get_login_page_notification_text() {
		return $this->_plugin->GetGlobalOption( 'login_page_notification_text', false );
	}

	public function GetDefaultDisabledAlerts() {
		return array( 0000, 0001, 0002, 0003, 0004, 0005 );
	}

	/**
	 * Return IDs of disabled alerts.
	 *
	 * @return array
	 */
	public function GetDisabledAlerts() {
		if ( ! $this->_disabled ) {
			$this->_disabled = implode( ',', $this->GetDefaultDisabledAlerts() );
			$this->_disabled = $this->_plugin->GetGlobalOption( 'disabled-alerts', $this->_disabled );
			$this->_disabled = ( '' == $this->_disabled ) ? array() : explode( ',', $this->_disabled );
			$this->_disabled = array_map( 'intval', $this->_disabled );
		}
		return $this->_disabled;
	}

	/**
	 * Method: Set Disabled Alerts.
	 *
	 * @param array $types IDs alerts to disable.
	 */
	public function SetDisabledAlerts( $types ) {
		$this->_disabled = array_unique( array_map( 'intval', $types ) );
		$this->_plugin->SetGlobalOption( 'disabled-alerts', implode( ',', $this->_disabled ) );
	}

	public function IsIncognito() {
		return $this->_plugin->GetGlobalOption( 'hide-plugin' );
	}

	public function SetIncognito( $enabled ) {
		return $this->_plugin->SetGlobalOption( 'hide-plugin', $enabled );
	}

	/**
	 * Checking if the data will be removed.
	 */
	public function IsDeleteData() {
		return $this->_plugin->GetGlobalOption( 'delete-data' );
	}

	public function SetDeleteData( $enabled ) {
		return $this->_plugin->SetGlobalOption( 'delete-data', $enabled );
	}

	/**
	 * Set Plugin Viewers.
	 *
	 * @param array $users_or_roles – Users/Roles.
	 */
	public function SetAllowedPluginViewers( $users_or_roles ) {
		$this->_viewers = $users_or_roles;
		$this->_plugin->SetGlobalOption( 'plugin-viewers', implode( ',', $this->_viewers ) );
	}

	/**
	 * Get Plugin Viewers.
	 */
	public function GetAllowedPluginViewers() {
		if ( is_null( $this->_viewers ) ) {
			$this->_viewers = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'plugin-viewers' ) ) ) );
		}
		return $this->_viewers;
	}

	/**
	 * Set Plugin Editors.
	 *
	 * @param array $users_or_roles – Users/Roles.
	 */
	public function SetAllowedPluginEditors( $users_or_roles ) {
		$this->_editors = $users_or_roles;
		$this->_plugin->SetGlobalOption( 'plugin-editors', implode( ',', $this->_editors ) );
	}

	/**
	 * Get Plugin Editors.
	 */
	public function GetAllowedPluginEditors() {
		if ( is_null( $this->_editors ) ) {
			$this->_editors = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'plugin-editors' ) ) ) );
		}
		return $this->_editors;
	}

	/**
	 * Set restrict plugin setting.
	 *
	 * @param string $setting – Setting.
	 * @since 3.2.3
	 */
	public function set_restrict_plugin_setting( $setting ) {
		$this->_plugin->SetGlobalOption( 'restrict-plugin-settings', $setting );
	}

	/**
	 * Get restrict plugin setting.
	 *
	 * @since 3.2.3
	 */
	public function get_restrict_plugin_setting() {
		$default_value = 'only_admins';
		if ( $this->IsRestrictAdmins() ) {
			$default_value = 'only_me';
		}
		return $this->_plugin->GetGlobalOption( 'restrict-plugin-settings', $default_value );
	}

	public function SetViewPerPage( $newvalue ) {
		$this->_perpage = max( $newvalue, 1 );
		$this->_plugin->SetGlobalOption( 'items-per-page', $this->_perpage );
	}

	public function GetViewPerPage() {
		if ( is_null( $this->_perpage ) ) {
			$this->_perpage = (int) $this->_plugin->GetGlobalOption( 'items-per-page', 10 );
		}
		return $this->_perpage;
	}

	/**
	 * Check if current user can perform an action.
	 *
	 * @param string $action Type of action, either 'view' or 'edit'.
	 * @return boolean If user has access or not.
	 */
	public function CurrentUserCan( $action ) {
		return $this->UserCan( wp_get_current_user(), $action );
	}

	/**
	 * Get list of superadmin usernames.
	 *
	 * @return array
	 */
	protected function GetSuperAdmins() {
		return $this->_plugin->IsMultisite() ? get_super_admins() : array();
	}

	/**
	 * List of admin usernames.
	 *
	 * @return string[]
	 */
	protected function GetAdmins() {
		if ( $this->_plugin->IsMultisite() ) {
			/**
			 * Get list of admins.
			 *
			 * @see https://gist.github.com/1508426/65785a15b8638d43a9905effb59e4d97319ef8f8
			 */
			global $wpdb;
			$cap = $wpdb->prefix . 'capabilities';
			$sql = "SELECT DISTINCT $wpdb->users.user_login"
				. " FROM $wpdb->users"
				. " INNER JOIN $wpdb->usermeta ON ($wpdb->users.ID = $wpdb->usermeta.user_id )"
				. " WHERE $wpdb->usermeta.meta_key = '$cap'"
				. " AND CAST($wpdb->usermeta.meta_value AS CHAR) LIKE  '%\"administrator\"%'";
			return $wpdb->get_col( $sql );
		} else {
			$result = array();
			$query = 'role=administrator&fields[]=user_login';
			foreach ( get_users( $query ) as $user ) {
				$result[] = $user->user_login;
			}
			return $result;
		}
	}

	/**
	 * Returns access tokens for a particular action.
	 *
	 * @param string $action - Type of action.
	 * @throws Exception - Unknown action exception.
	 * @return string[] List of tokens (usernames, roles etc).
	 */
	public function GetAccessTokens( $action ) {
		$allowed = array();
		switch ( $action ) {
			case 'view':
				$allowed = $this->GetAllowedPluginViewers();
				$allowed = array_merge( $allowed, $this->GetAllowedPluginEditors() );
				if ( ! $this->IsRestrictAdmins() ) {
					$allowed = array_merge( $allowed, $this->GetSuperAdmins() );
					$allowed = array_merge( $allowed, $this->GetAdmins() );
				}
				break;
			case 'edit':
				$allowed = $this->GetAllowedPluginEditors();
				if ( ! $this->IsRestrictAdmins() ) {
					$allowed = array_merge( $allowed, $this->_plugin->IsMultisite() ? $this->GetSuperAdmins() : $this->GetAdmins() );
				}
				break;
			default:
				throw new Exception( 'Unknown action "' . $action . '".' );
		}
		if ( ! $this->IsRestrictAdmins() ) {
			if ( is_multisite() ) {
				$allowed = array_merge( $allowed, get_super_admins() );
			} else {
				$allowed[] = 'administrator';
			}
		}
		return array_unique( $allowed );
	}

	/**
	 * Check if user can perform an action.
	 *
	 * @param integer|WP_user $user - User object to check.
	 * @param string          $action - Type of action, either 'view' or 'edit'.
	 * @return boolean If user has access or not.
	 */
	public function UserCan( $user, $action ) {
		if ( is_int( $user ) ) {
			$user = get_userdata( $user );
		}
		$allowed = $this->GetAccessTokens( $action );
		$check = array_merge( $user->roles, array( $user->user_login ) );
		foreach ( $check as $item ) {
			if ( in_array( $item, $allowed ) ) {
				return true;
			}
		}
		return false;
	}

	public function GetCurrentUserRoles( $base_roles = null ) {
		if ( null == $base_roles ) {
			$base_roles = wp_get_current_user()->roles;
		}
		if ( function_exists( 'is_super_admin' ) && is_super_admin() ) {
			$base_roles[] = 'superadmin';
		}
		return $base_roles;
	}

	public function IsLoginSuperAdmin( $username ) {
		$user_id = username_exists( $username );
		if ( function_exists( 'is_super_admin' ) && is_super_admin( $user_id ) ) {
			return true;
		} else {
			return false;
		}
	}

	public function GetLicenses() {
		return $this->_plugin->GetGlobalOption( 'licenses' );
	}

	public function GetLicense( $name ) {
		$data = $this->GetLicenses();
		$name = sanitize_key( basename( $name ) );
		return isset( $data[ $name ] ) ? $data[ $name ] : array();
	}

	public function SetLicenses( $data ) {
		$this->_plugin->SetGlobalOption( 'licenses', $data );
	}

	public function GetLicenseKey( $name ) {
		$data = $this->GetLicense( $name );
		return isset( $data['key'] ) ? $data['key'] : '';
	}

	public function GetLicenseStatus( $name ) {
		$data = $this->GetLicense( $name );
		return isset( $data['sts'] ) ? $data['sts'] : '';
	}

	public function GetLicenseErrors( $name ) {
		$data = $this->GetLicense( $name );
		return isset( $data['err'] ) ? $data['err'] : '';
	}

	public function SetLicenseKey( $name, $key ) {
		$data = $this->GetLicenses();
		if ( ! isset( $data[ $name ] ) ) {
			$data[ $name ] = array();
		}
		$data[ $name ]['key'] = $key;
		$this->SetLicenses( $data );
	}

	public function SetLicenseStatus( $name, $status ) {
		$data = $this->GetLicenses();
		if ( ! isset( $data[ $name ] ) ) {
			$data[ $name ] = array();
		}
		$data[ $name ]['sts'] = $status;
		$this->SetLicenses( $data );
	}

	public function SetLicenseErrors( $name, $errors ) {
		$data = $this->GetLicenses();
		if ( ! isset( $data[ $name ] ) ) {
			$data[ $name ] = array();
		}
		$data[ $name ]['err'] = $errors;
		$this->SetLicenses( $data );
	}

	public function ClearLicenses() {
		$this->SetLicenses( array() );
	}

	public function IsMainIPFromProxy() {
		return $this->_plugin->GetGlobalOption( 'use-proxy-ip' );
	}

	public function SetMainIPFromProxy( $enabled ) {
		return $this->_plugin->SetGlobalOption( 'use-proxy-ip', $enabled );
	}

	public function IsInternalIPsFiltered() {
		return $this->_plugin->GetGlobalOption( 'filter-internal-ip' );
	}

	public function SetInternalIPsFiltering( $enabled ) {
		return $this->_plugin->SetGlobalOption( 'filter-internal-ip', $enabled );
	}

	public function GetMainClientIP() {
		$result = null;
		if ( $this->IsMainIPFromProxy() ) {
			// TODO: The algorithm below just gets the first IP in the list...we might want to make this more intelligent somehow.
			$result = $this->GetClientIPs();
			$result = reset( $result );
			$result = isset( $result[0] ) ? $result[0] : null;
		} elseif ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
			$result = $this->NormalizeIP( $_SERVER['REMOTE_ADDR'] );
			if ( ! $this->ValidateIP( $result ) ) {
				$result = 'Error ' . self::ERROR_CODE_INVALID_IP . ': Invalid IP Address';
			}
		}
		return $result;
	}

	public function GetClientIPs() {
		$ips = array();
		foreach ( array( 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR' ) as $key ) {
			if ( isset( $_SERVER[ $key ] ) ) {
				$ips[ $key ] = array();
				foreach ( explode( ',', $_SERVER[ $key ] ) as $ip ) {
					if ( $this->ValidateIP( $ip = $this->NormalizeIP( $ip ) ) ) {
						$ips[ $key ][] = $ip;
					}
				}
			}
		}
		return $ips;
	}

	protected function NormalizeIP( $ip ) {
		$ip = trim( $ip );
		if ( strpos( $ip, ':' ) !== false && substr_count( $ip, '.' ) == 3 && strpos( $ip, '[' ) === false ) {
			// IPv4 with a port (eg: 11.22.33.44:80).
			$ip = explode( ':', $ip );
			$ip = $ip[0];
		} else {
			// IPv6 with a port (eg: [::1]:80).
			$ip = explode( ']', $ip );
			$ip = ltrim( $ip[0], '[' );
		}
		return $ip;
	}

	protected function ValidateIP( $ip ) {
		$opts = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
		if ( $this->IsInternalIPsFiltered() ) {
			$opts = $opts | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
		}
		$filtered_ip = filter_var( $ip, FILTER_VALIDATE_IP, $opts );
		if ( ! $filtered_ip || empty( $filtered_ip ) ) {
			// Regex IPV4.
			if ( preg_match( '/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/', $ip ) ) {
				return $ip;
			} // Regex IPV6.
			elseif ( preg_match( '/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/', $ip ) ) {
				return $ip;
			}
			return false;
		} else {
			return $filtered_ip;
		}
	}

	/**
	 * Users excluded from monitoring.
	 */
	public function SetExcludedMonitoringUsers( $users ) {
		$this->_excluded_users = $users;
		$this->_plugin->SetGlobalOption( 'excluded-users', esc_html( implode( ',', $this->_excluded_users ) ) );
	}

	public function GetExcludedMonitoringUsers() {
		if ( empty( $this->_excluded_users ) ) {
			$this->_excluded_users = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'excluded-users' ) ) ) );
		}
		return $this->_excluded_users;
	}

	/**
	 * Set Custom Post Types excluded from monitoring.
	 *
	 * @param array $post_types - Array of post types to exclude.
	 * @since 2.6.7
	 */
	public function set_excluded_post_types( $post_types ) {
		$this->_post_types = $post_types;
		$this->_plugin->SetGlobalOption( 'custom-post-types', esc_html( implode( ',', $this->_post_types ) ) );
	}

	/**
	 * Get Custom Post Types excluded from monitoring.
	 *
	 * @since 2.6.7
	 */
	public function get_excluded_post_types() {
		if ( empty( $this->_post_types ) ) {
			$this->_post_types = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'custom-post-types' ) ) ) );
		}
		return $this->_post_types;
	}

	/**
	 * Set URLs excluded from monitoring.
	 *
	 * @param array $urls - Array of URLs.
	 * @since 3.2.2
	 */
	public function set_excluded_urls( $urls ) {
		$urls = array_map( 'untrailingslashit', $urls );
		$urls = array_unique( $urls );
		$this->excluded_urls = $urls;
		$this->_plugin->SetGlobalOption( 'excluded-urls', esc_html( implode( ',', $this->excluded_urls ) ) );
	}

	/**
	 * Get URLs excluded from monitoring.
	 *
	 * @since 3.2.2
	 */
	public function get_excluded_urls() {
		if ( empty( $this->excluded_urls ) ) {
			$this->excluded_urls = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'excluded-urls' ) ) ) );
		}
		return $this->excluded_urls;
	}

	/**
	 * Set roles excluded from monitoring.
	 *
	 * @param array $roles - Array of roles.
	 */
	public function SetExcludedMonitoringRoles( $roles ) {
		$this->_excluded_roles = $roles;
		$this->_plugin->SetGlobalOption( 'excluded-roles', esc_html( implode( ',', $this->_excluded_roles ) ) );
	}

	/**
	 * Get roles excluded from monitoring.
	 */
	public function GetExcludedMonitoringRoles() {
		if ( empty( $this->_excluded_roles ) ) {
			$this->_excluded_roles = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'excluded-roles' ) ) ) );
		}
		return $this->_excluded_roles;
	}

	/**
	 * Custom fields excluded from monitoring.
	 */
	public function SetExcludedMonitoringCustom( $custom ) {
		$this->_excluded_custom = $custom;
		$this->_plugin->SetGlobalOption( 'excluded-custom', esc_html( implode( ',', $this->_excluded_custom ) ) );
	}

	public function GetExcludedMonitoringCustom() {
		if ( empty( $this->_excluded_custom ) ) {
			$this->_excluded_custom = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'excluded-custom' ) ) ) );
			asort( $this->_excluded_custom );
		}
		return $this->_excluded_custom;
	}

	/**
	 * IP excluded from monitoring.
	 */
	public function SetExcludedMonitoringIP( $ip ) {
		$this->_excluded_ip = $ip;
		$this->_plugin->SetGlobalOption( 'excluded-ip', esc_html( implode( ',', $this->_excluded_ip ) ) );
	}

	public function GetExcludedMonitoringIP() {
		if ( empty( $this->_excluded_ip ) ) {
			$this->_excluded_ip = array_unique( array_filter( explode( ',', $this->_plugin->GetGlobalOption( 'excluded-ip' ) ) ) );
		}
		return $this->_excluded_ip;
	}

	/**
	 * Datetime used in the Alerts.
	 */
	public function GetDatetimeFormat( $line_break = true ) {
		if ( $line_break ) {
			$date_time_format = $this->GetDateFormat() . '<\b\r>' . $this->GetTimeFormat();
		} else {
			$date_time_format = $this->GetDateFormat() . ' ' . $this->GetTimeFormat();
		}

		$wp_time_format = get_option( 'time_format' );
		if ( stripos( $wp_time_format, 'A' ) !== false ) {
			$date_time_format .= '.$$$&\n\b\s\p;A';
		} else {
			$date_time_format .= '.$$$';
		}
		return $date_time_format;
	}

	/**
	 * Date Format from WordPress General Settings.
	 */
	public function GetDateFormat() {
		$wp_date_format = get_option( 'date_format' );
		$search         = array( 'F', 'M', 'n', 'j', ' ', '/', 'y', 'S', ',', 'l', 'D' );
		$replace        = array( 'm', 'm', 'm', 'd', '-', '-', 'Y', '', '', '', '' );
		$date_format    = str_replace( $search, $replace, $wp_date_format );
		return $date_format;
	}

	/**
	 * Time Format from WordPress General Settings.
	 */
	public function GetTimeFormat() {
		$wp_time_format = get_option( 'time_format' );
		$search = array( 'a', 'A', 'T', ' ' );
		$replace = array( '', '', '', '' );
		$time_format = str_replace( $search, $replace, $wp_time_format );
		return $time_format;
	}

	/**
	 * Alerts Timestamp.
	 *
	 * Server's timezone or WordPress' timezone.
	 */
	public function GetTimezone() {
		return $this->_plugin->GetGlobalOption( 'timezone', 'wp' );
	}

	public function SetTimezone( $newvalue ) {
		return $this->_plugin->SetGlobalOption( 'timezone', $newvalue );
	}

	/**
	 * Get type of username to display.
	 */
	public function get_type_username() {
		return $this->_plugin->GetGlobalOption( 'type_username', 'display_name' );
	}

	/**
	 * Set type of username to display
	 *
	 * @param string $newvalue - New value variable.
	 * @since 2.6.5
	 */
	public function set_type_username( $newvalue ) {
		return $this->_plugin->SetGlobalOption( 'type_username', $newvalue );
	}

	public function GetAdapterConfig( $name_field, $default_value = false ) {
		return $this->_plugin->GetGlobalOption( $name_field, $default_value );
	}

	public function SetAdapterConfig( $name_field, $newvalue ) {
		return $this->_plugin->SetGlobalOption( $name_field, trim( $newvalue ) );
	}

	public function GetColumns() {
		$columns = array(
			'alert_code' => '1',
			'type'       => '1',
			'date'       => '1',
			'username'   => '1',
			'source_ip'  => '1',
			'message'    => '1',
		);
		if ( $this->_plugin->IsMultisite() ) {
			$columns = array_slice( $columns, 0, 5, true ) + array(
				'site' => '1',
			) + array_slice( $columns, 5, null, true );
		}
		$selected = $this->GetColumnsSelected();
		if ( ! empty( $selected ) ) {
			$columns = array(
				'alert_code' => '0',
				'type'       => '0',
				'date'       => '0',
				'username'   => '0',
				'source_ip'  => '0',
				'message'    => '0',
			);
			if ( $this->_plugin->IsMultisite() ) {
				$columns = array_slice( $columns, 0, 5, true ) + array(
					'site' => '0',
				) + array_slice( $columns, 5, null, true );
			}
			$selected = (array) json_decode( $selected );
			$columns = array_merge( $columns, $selected );
			return $columns;
		} else {
			return $columns;
		}
	}

	public function GetColumnsSelected() {
		return $this->_plugin->GetGlobalOption( 'columns' );
	}

	public function SetColumns( $columns ) {
		return $this->_plugin->SetGlobalOption( 'columns', json_encode( $columns ) );
	}

	public function IsWPBackend() {
		return $this->_plugin->GetGlobalOption( 'wp-backend' );
	}

	public function SetWPBackend( $enabled ) {
		return $this->_plugin->SetGlobalOption( 'wp-backend', $enabled );
	}

	/**
	 * Set use email setting.
	 *
	 * @param string $use – Setting value.
	 */
	public function set_use_email( $use ) {
		return $this->_plugin->SetGlobalOption( 'use-email', $use );
	}

	/**
	 * Get use email setting.
	 *
	 * @return string
	 */
	public function get_use_email() {
		return $this->_plugin->GetGlobalOption( 'use-email', 'default_email' );
	}

	public function SetFromEmail( $email_address ) {
		return $this->_plugin->SetGlobalOption( 'from-email', trim( $email_address ) );
	}

	public function GetFromEmail() {
		return $this->_plugin->GetGlobalOption( 'from-email' );
	}

	public function SetDisplayName( $display_name ) {
		return $this->_plugin->SetGlobalOption( 'display-name', trim( $display_name ) );
	}

	public function GetDisplayName() {
		return $this->_plugin->GetGlobalOption( 'display-name' );
	}

	public function Set404LogLimit( $value ) {
		return $this->_plugin->SetGlobalOption( 'log-404-limit', abs( $value ) );
	}

	public function Get404LogLimit() {
		return $this->_plugin->GetGlobalOption( 'log-404-limit', 99 );
	}

	/**
	 * Sets the 404 log limit for visitor.
	 *
	 * @param  int $value - 404 log limit.
	 * @since  2.6.3
	 */
	public function SetVisitor404LogLimit( $value ) {
		return $this->_plugin->SetGlobalOption( 'log-visitor-404-limit', abs( $value ) );
	}

	/**
	 * Get the 404 log limit for visitor.
	 *
	 * @since  2.6.3
	 */
	public function GetVisitor404LogLimit() {
		return $this->_plugin->GetGlobalOption( 'log-visitor-404-limit', 99 );
	}

	/**
	 * Sets the log limit for failed login attempts.
	 *
	 * @param  int $value - Failed login limit.
	 * @since  2.6.3
	 */
	public function set_failed_login_limit( $value ) {
		if ( ! empty( $value ) ) {
			return $this->_plugin->SetGlobalOption( 'log-failed-login-limit', abs( $value ) );
		} else {
			return $this->_plugin->SetGlobalOption( 'log-failed-login-limit', -1 );
		}
	}

	/**
	 * Get the log limit for failed login attempts.
	 *
	 * @since  2.6.3
	 */
	public function get_failed_login_limit() {
		return $this->_plugin->GetGlobalOption( 'log-failed-login-limit', 10 );
	}

	/**
	 * Sets the log limit for failed login attempts for visitor.
	 *
	 * @param  int $value - Failed login limit.
	 * @since  2.6.3
	 */
	public function set_visitor_failed_login_limit( $value ) {
		if ( ! empty( $value ) ) {
			return $this->_plugin->SetGlobalOption( 'log-visitor-failed-login-limit', abs( $value ) );
		} else {
			return $this->_plugin->SetGlobalOption( 'log-visitor-failed-login-limit', -1 );
		}
	}

	/**
	 * Get the log limit for failed login attempts for visitor.
	 *
	 * @since  2.6.3
	 */
	public function get_visitor_failed_login_limit() {
		return $this->_plugin->GetGlobalOption( 'log-visitor-failed-login-limit', 10 );
	}

	public function IsArchivingEnabled() {
		return $this->_plugin->GetGlobalOption( 'archiving-e' );
	}

	/**
	 * Switch to Archive DB if is enabled.
	 */
	public function SwitchToArchiveDB() {
		if ( $this->IsArchivingEnabled() ) {
			$archive_type       = $this->_plugin->GetGlobalOption( 'archive-type' );
			$archive_user       = $this->_plugin->GetGlobalOption( 'archive-user' );
			$password           = $this->_plugin->GetGlobalOption( 'archive-password' );
			$archive_name       = $this->_plugin->GetGlobalOption( 'archive-name' );
			$archive_hostname   = $this->_plugin->GetGlobalOption( 'archive-hostname' );
			$archive_baseprefix = $this->_plugin->GetGlobalOption( 'archive-base-prefix' );
			$archive_ssl        = $this->_plugin->GetGlobalOption( 'archive-ssl', false );
			$archive_cc         = $this->_plugin->GetGlobalOption( 'archive-client-certificate', false );
			$archive_ssl_ca     = $this->_plugin->GetGlobalOption( 'archive-ssl-ca', false );
			$archive_ssl_cert   = $this->_plugin->GetGlobalOption( 'archive-ssl-cert', false );
			$archive_ssl_key    = $this->_plugin->GetGlobalOption( 'archive-ssl-key', false );
			$config             = WSAL_Connector_ConnectorFactory::GetConfigArray( $archive_type, $archive_user, $password, $archive_name, $archive_hostname, $archive_baseprefix, $archive_ssl, $archive_cc, $archive_ssl_ca, $archive_ssl_cert, $archive_ssl_key );
			$this->_plugin->getConnector( $config )->getAdapter( 'Occurrence' );
		}
	}

	/**
	 * Generate index.php file for each wsal sub-directory
	 * present in the uploads directory.
	 *
	 * @since 3.1.2
	 */
	public function generate_index_files() {
		// Get uploads directory.
		$uploads_dir      = wp_upload_dir();
		$wsal_uploads_dir = trailingslashit( $uploads_dir['basedir'] . '/wp-security-audit-log/' );

		// If the directory exists then generate index.php file for every sub-directory.
		if ( ! empty( $wsal_uploads_dir ) && is_dir( $wsal_uploads_dir ) ) {
			// Generate index.php for the main directory.
			if ( ! file_exists( $wsal_uploads_dir . '/index.php' ) ) {
				// Generate index.php file.
				$this->create_index_file( $wsal_uploads_dir );
			}

			// Generate .htaccess for the main directory.
			if ( ! file_exists( $wsal_uploads_dir . '/.htaccess' ) ) {
				// Generate .htaccess file.
				$this->create_htaccess_file( $wsal_uploads_dir );
			}

			// Fetch all files in the uploads directory.
			$sub_directories = glob( $wsal_uploads_dir . '*' );
			foreach ( $sub_directories as $sub_dir ) {
				// index.php file.
				if ( is_dir( $sub_dir ) && ! file_exists( $sub_dir . '/index.php' ) ) {
					// Generate index.php file.
					$this->create_index_file( $sub_dir . '/' );
				}

				// .htaccess file.
				if ( is_dir( $sub_dir ) && ! file_exists( $sub_dir . '/.htaccess' ) ) {
					// Check for failed-logins, users, visitors and don't create file in it.
					if ( strpos( $sub_dir, 'failed-logins' )
						|| strpos( $sub_dir, 'users' )
						|| strpos( $sub_dir, 'visitors' ) ) {
						continue;
					}
					// Generate .htaccess file.
					$this->create_htaccess_file( $sub_dir . '/' );
				}
			}
		}
	}

	/**
	 * Create an index.php file, if none exists, in order to
	 * avoid directory listing in the specified directory.
	 *
	 * @param string $dir_path - Directory Path.
	 * @return bool
	 * @since 3.1.2
	 */
	final public function create_index_file( $dir_path ) {
		// Check if index.php file exists.
		$dir_path = trailingslashit( $dir_path );
		$result = 0;
		if ( ! is_file( $dir_path . 'index.php' ) ) {
			$result = @file_put_contents( $dir_path . 'index.php', '<?php // Silence is golden' );
		}
		return ($result > 0);
	}

	/**
	 * Create an .htaccess file, if none exists, in order to
	 * block access to directory listing in the specified directory.
	 *
	 * @param string $dir_path - Directory Path.
	 * @return bool
	 * @since 3.1.2
	 */
	final public function create_htaccess_file( $dir_path ) {
		// Check if .htaccess file exists.
		$dir_path = trailingslashit( $dir_path );
		$result = 0;
		if ( ! is_file( $dir_path . '.htaccess' ) ) {
			$result = @file_put_contents( $dir_path . '.htaccess', 'Deny from all' );
		}
		return ($result > 0);
	}

	/**
	 * Method: Get Token Type.
	 *
	 * @param string $token - Token type.
	 * @since 3.2.3
	 */
	public function get_token_type( $token ) {
		// Get users.
		$users = array();
		foreach ( get_users( 'blog_id=0&fields[]=user_login' ) as $obj ) {
			$users[] = $obj->user_login;
		}

		// Get user roles.
		$roles = array_keys( get_editable_roles() );

		// Get custom post types.
		$post_types = get_post_types( array(), 'names', 'and' );

		// Check if the token matched users.
		if ( in_array( $token, $users ) ) {
			return 'user';
		}

		// Check if the token matched user roles.
		if ( in_array( $token, $roles ) ) {
			return 'role';
		}

		// Check if the token matched post types.
		if ( in_array( $token, $post_types ) ) {
			return 'cpts';
		}

		// Check if the token matches a URL.
		if ( ( false !== strpos( $token, home_url() ) ) && filter_var( $token, FILTER_VALIDATE_URL ) ) {
			return 'urls';
		}

		// Check if the token matches an IP address.
		if (
			filter_var( $token, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) // Validate IPv4.
			|| filter_var( $token, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 ) // Validate IPv6.
		) {
			return 'ip';
		}

		return 'other';
	}

	/**
	 * Set MainWP Child Stealth Mode
	 *
	 * Set the plugin in stealth mode for MainWP child sites.
	 *
	 * Following steps are taken in stealth mode:
	 *   1. Freemius connection is skipped.
	 *   2. Freemius notices are removed.
	 *   3. WSAL's incognito mode is set.
	 *   4. Other site admins are restricted.
	 *   5. The current user is set as the sole editor of WSAL.
	 *   6. Stealth mode option is saved.
	 *
	 * @since 3.2.3.3
	 */
	public function set_mainwp_child_stealth_mode() {
		if (
			'yes' !== $this->_plugin->GetGlobalOption( 'mwp-child-stealth-mode', 'no' ) // MainWP Child Stealth Mode is not already active.
			&& is_plugin_active( 'mainwp-child/mainwp-child.php' ) // And if MainWP Child plugin is installed & active.
		) {
			// Check if freemius state is anonymous.
			if ( ! wsal_freemius()->is_premium() && 'anonymous' === get_site_option( 'wsal_freemius_state', 'anonymous' ) ) {
				// Update freemius state to skipped.
				update_site_option( 'wsal_freemius_state', 'skipped' );

				if ( ! $this->_plugin->IsMultisite() ) {
					wsal_freemius()->skip_connection(); // Opt out.
				} else {
					wsal_freemius()->skip_connection( null, true ); // Opt out for all websites.
				}

				// Connect account notice.
				FS_Admin_Notices::instance( 'wp-security-audit-log' )->remove_sticky( 'connect_account' );
			}

			if ( ! wsal_freemius()->is_premium() ) {
				// Remove Freemius trial promotion notice.
				FS_Admin_Notices::instance( 'wp-security-audit-log' )->remove_sticky( 'trial_promotion' );
			}

			$this->SetIncognito( '1' ); // Incognito mode to hide WSAL on plugins page.
			$this->SetRestrictAdmins( true ); // Restrict other admins.
			$editors   = array();
			$editors[] = wp_get_current_user()->user_login; // Set the current user as the editor of WSAL.
			$this->SetAllowedPluginEditors( $editors ); // Save the editors.
			$this->_plugin->SetGlobalOption( 'mwp-child-stealth-mode', 'yes' ); // Save stealth mode option.
		}
	}

	/**
	 * Deactivate MainWP Child Stealth Mode.
	 *
	 * @since 3.2.3.3
	 */
	public function deactivate_mainwp_child_stealth_mode() {
		$this->SetIncognito( '0' ); // Disable incognito mode to hide WSAL on plugins page.
		$this->SetRestrictAdmins( false ); // Give access to other admins.
		$this->SetAllowedPluginEditors( array() ); // Empty the editors.
		$this->_plugin->SetGlobalOption( 'mwp-child-stealth-mode', 'no' ); // Disable stealth mode option.
	}

	/**
	 * Reset Stealth Mode on MainWP Child plugin deactivation.
	 *
	 * @param string $plugin — Plugin.
	 */
	public function reset_stealth_mode( $plugin ) {
		if ( 'mainwp-child/mainwp-child.php' !== $plugin ) {
			return;
		}

		if ( 'yes' === $this->_plugin->GetGlobalOption( 'mwp-child-stealth-mode', 'no' ) ) {
			$this->deactivate_mainwp_child_stealth_mode();
		}
	}

	/**
	 * Check and return if stealth mode is active.
	 *
	 * @return boolean
	 */
	public function is_stealth_mode() {
		$stealth_mode = $this->_plugin->GetGlobalOption( 'mwp-child-stealth-mode', 'no' );
		if ( 'yes' === $stealth_mode ) {
			return true;
		}
		return false;
	}

	/**
	 * Method: Meta data formater.
	 *
	 * @param string  $name      - Name of the data.
	 * @param mix     $value     - Value of the data.
	 * @param integer $occ_id    - Event occurrence ID.
	 * @param mixed   $highlight - Highlight format.
	 * @return string
	 */
	public function meta_formatter( $name, $value, $occ_id, $highlight ) {
		if ( $highlight && 'daily-report' === $highlight ) {
			$highlight_start_tag = '<span style="color: #149247;">';
			$highlight_end_tag   = '</span>';
		} else {
			$highlight_start_tag = '<strong>';
			$highlight_end_tag   = '</strong>';
		}

		switch ( true ) {
			case '%Message%' == $name:
				return esc_html( $value );

			case '%PromoMessage%' == $name:
				return '<p class="promo-alert">' . $value . '</p>';

			case '%PromoLink%' == $name:
			case '%CommentLink%' == $name:
			case '%CommentMsg%' == $name:
				return $value;

			case '%MetaLink%' == $name:
				if ( ! empty( $value ) ) {
					return "<a href=\"#\" data-disable-custom-nonce='" . wp_create_nonce( 'disable-custom-nonce' . $value ) . "' onclick=\"WsalDisableCustom(this, '" . $value . "');\"> Exclude Custom Field from the Monitoring</a>";
				} else {
					return '';
				}

			case '%RevisionLink%' === $name:
				$check_value = (string) $value;
				if ( 'NULL' !== $check_value ) {
					return ' Click <a target="_blank" href="' . esc_url( $value ) . '">here</a> to see the content changes.';
				} else {
					return false;
				}

			case '%EditorLinkPost%' == $name:
				return ' View the <a target="_blank" href="' . esc_url( $value ) . '">post</a>';

			case '%EditorLinkPage%' == $name:
				return ' View the <a target="_blank" href="' . esc_url( $value ) . '">page</a>';

			case '%CategoryLink%' == $name:
				return ' View the <a target="_blank" href="' . esc_url( $value ) . '">category</a>';

			case '%TagLink%' == $name:
				return ' View the <a target="_blank" href="' . esc_url( $value ) . '">tag</a>';

			case '%EditorLinkForum%' == $name:
				return ' View the <a target="_blank" href="' . esc_url( $value ) . '">forum</a>';

			case '%EditorLinkTopic%' == $name:
				return ' View the <a target="_blank" href="' . esc_url( $value ) . '">topic</a>';

			case in_array( $name, array( '%MetaValue%', '%MetaValueOld%', '%MetaValueNew%' ) ):
				return $highlight_start_tag . (
					strlen( $value ) > 50 ? ( esc_html( substr( $value, 0, 50 ) ) . '&hellip;' ) : esc_html( $value )
				) . $highlight_end_tag;

			case '%ClientIP%' == $name:
				if ( is_string( $value ) ) {
					return $highlight_start_tag . str_replace( array( '"', '[', ']' ), '', $value ) . $highlight_end_tag;
				} else {
					return '<i>unknown</i>';
				}

			case '%LinkFile%' === $name:
				if ( 'NULL' != $value ) {
					$site_id = $this->get_view_site_id(); // Site id for multisite.
					return '<a href="javascript:;" onclick="download_404_log( this )" data-log-file="' . esc_attr( $value ) . '" data-site-id="' . esc_attr( $site_id ) . '" data-nonce-404="' . esc_attr( wp_create_nonce( 'wsal-download-404-log-' . $value ) ) . '" title="' . esc_html__( 'Download the log file', 'wp-security-audit-log' ) . '">' . esc_html__( 'Download the log file', 'wp-security-audit-log' ) . '</a>';
				} else {
					return 'Click <a href="' . esc_url( add_query_arg( 'page', 'wsal-togglealerts', admin_url( 'admin.php' ) ) ) . '">here</a> to log such requests to file';
				}

			case '%URL%' === $name:
				return ' or <a href="javascript:;" data-exclude-url="' . esc_url( $value ) . '" data-exclude-url-nonce="' . wp_create_nonce( 'wsal-exclude-url-' . $value ) . '" onclick="wsal_exclude_url( this )">exclude this URL</a> from being reported.';

			case '%LogFileLink%' === $name: // Failed login file link.
				return '';

			case '%Attempts%' === $name: // Failed login attempts.
				$check_value = (int) $value;
				if ( 0 === $check_value ) {
					return '';
				} else {
					return $value;
				}

			case '%LogFileText%' === $name: // Failed login file text.
				return '<a href="javascript:;" onclick="download_failed_login_log( this )" data-download-nonce="' . esc_attr( wp_create_nonce( 'wsal-download-failed-logins' ) ) . '" title="' . esc_html__( 'Download the log file.', 'wp-security-audit-log' ) . '">' . esc_html__( 'Download the log file.', 'wp-security-audit-log' ) . '</a>';

			case strncmp( $value, 'http://', 7 ) === 0:
			case strncmp( $value, 'https://', 7 ) === 0:
				return '<a href="' . esc_html( $value ) . '" title="' . esc_html( $value ) . '" target="_blank">' . esc_html( $value ) . '</a>';

			case '%PostStatus%' === $name:
				if ( ! empty( $value ) && 'publish' === $value ) {
					return $highlight_start_tag . esc_html__( 'published', 'wp-security-audit-log' ) . $highlight_end_tag;
				} else {
					return $highlight_start_tag . esc_html( $value ) . $highlight_end_tag;
				}

			case '%multisite_text%' === $name:
				if ( $this->_plugin->IsMultisite() && $value ) {
					$site_info = get_blog_details( $value, true );
					if ( $site_info ) {
						return ' on site <a href="' . esc_url( $site_info->siteurl ) . '">' . esc_html( $site_info->blogname ) . '</a>';
					}
					return;
				}
				return;

			case '%ReportText%' === $name:
				return;

			case '%ChangeText%' === $name:
				if ( $occ_id ) {
					$url_args = array(
						'action'     => 'AjaxInspector',
						'occurrence' => $occ_id,
						'TB_iframe'  => 'true',
						'width'      => 600,
						'height'     => 550,
					);
					$url      = add_query_arg( $url_args, admin_url( 'admin-ajax.php' ) );
					return ' View the changes in <a class="thickbox"  title="' . __( 'Alert Data Inspector', 'wp-security-audit-log' ) . '"'
					. ' href="' . $url . '">data inspector.</a>';
				} else {
					return;
				}

			case '%ScanError%' === $name:
				if ( 'NULL' === $value ) {
					return false;
				}
				/* translators: Mailto link for support. */
				return ' with errors. ' . sprintf( __( 'Contact us on %s for assistance', 'wp-security-audit-log' ), '<a href="mailto:support@wpsecurityauditlog.com" target="_blank">support@wpsecurityauditlog.com</a>' );

			case '%TableNames%' === $name:
				$value = str_replace( ',', ', ', $value );
				return $highlight_start_tag . esc_html( $value ) . $highlight_end_tag;

			default:
				return $highlight_start_tag . esc_html( $value ) . $highlight_end_tag;
		}
	}

	/**
	 * Method: Get view site id.
	 *
	 * @since 3.2.4
	 *
	 * @return int
	 */
	public function get_view_site_id() {
		switch ( true ) {
			// Non-multisite.
			case ! $this->_plugin->IsMultisite():
				return 0;
			// Multisite + main site view.
			case $this->is_main_blog() && ! $this->is_specific_view():
				return 0;
			// Multisite + switched site view.
			case $this->is_main_blog() && $this->is_specific_view():
				return $this->get_specific_view();
			// Multisite + local site view.
			default:
				return get_current_blog_id();
		}
	}

	/**
	 * Method: Check if the blog is main blog.
	 *
	 * @since 3.2.4
	 *
	 * @return bool
	 */
	protected function is_main_blog() {
		return get_current_blog_id() === 1;
	}

	/**
	 * Method: Check if it is a specific view.
	 *
	 * @since 3.2.4
	 *
	 * @return bool
	 */
	protected function is_specific_view() {
		// Filter $_GET array for security.
		$get_array = filter_input_array( INPUT_GET );

		return isset( $get_array['wsal-cbid'] ) && '0' != $get_array['wsal-cbid'];
	}

	/**
	 * Method: Get a specific view.
	 *
	 * @since 3.2.4
	 *
	 * @return int
	 */
	protected function get_specific_view() {
		// Filter $_GET array for security.
		$get_array = filter_input_array( INPUT_GET );

		return isset( $get_array['wsal-cbid'] ) ? (int) $get_array['wsal-cbid'] : 0;
	}
}
