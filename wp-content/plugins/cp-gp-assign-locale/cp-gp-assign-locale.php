<?php
/**
 * Plugin name: ClassicPress Assign Locale To Users
 * Description: Add the locale to an user and unlock review permission based on the capabilities
 * Version:     1.0
 * Author:      ClassicPress.net
 * Author URI:  http://classicpress.net
 * License:     GPLv2 or later
 */

function cp_gp_assign_locale_profile() {
	global $cp_gp_assign_locale_profile;

	if ( ! isset( $cp_gp_assign_locale_profile ) ) {
		include_once 'cp-gp-assign-locale-profile.php';
		$cp_gp_assign_locale_profile = new CP_GP_Assign_Locale_Profile();
	}

	return $cp_gp_assign_locale_profile;
}

add_action( 'plugins_loaded', 'cp_gp_assign_locale_profile' );
