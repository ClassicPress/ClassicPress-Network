<?php
/*
Plugin Name: Multisite User Sync
Plugin URI: https://shamimbiplob.wordpress.com/contact-us/
Description: Multisite User Sync will automatically synchronise users to all sites in multisite. If new user/site created it will also add to all site/users.
Version: 1.2
Author: Shamim
Author URI: https://shamimbiplob.wordpress.com/contact-us/
License: GPLv2 or later

Note: will no longer sync roles to all sites.
*/

register_activation_hook( __FILE__, 'mus_plugin_activate' );

function mus_plugin_activate() {
	global $wpdb;

	if ( ! is_multisite() ) {
		return;
	}
	// Query all blogs from multi-site install
	$blogids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->base_prefix}blogs" );
	$users = get_users( array( 'blog_id' => get_current_blog_id(), 'fields' => 'all_with_meta' ) );

	remove_action( 'set_user_role', 'mus_add_new_user_role_to_all_sites', 10, 3 );
	foreach ( $users as $user ) {
		foreach ( $blogids as $blogid ) {
			add_user_to_blog( $blogid, $user->ID, get_blog_option( $blogid, 'default_role', 'subscriber' ) );	
		}
	}
	add_action( 'set_user_role', 'mus_add_new_user_role_to_all_sites', 10, 3 );
}
/**
 * Create a new site
 * Loop through all users and add them to the new blog
 *
 * @param  INT $blog_id - New blog ID
 *
 * @return void
 */
add_action( 'wpmu_new_blog', 'mus_add_all_users_to_new_site' );
function mus_add_all_users_to_new_site( $blog_id ) {
	global $wpdb;

	// Query all blogs from multi-site install
	$blogids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->base_prefix}blogs LIMIT 2" );

	remove_action( 'set_user_role', 'mus_add_new_user_role_to_all_sites', 10, 3 );
	foreach ( $blogids as $blogid ) {
		if ( $blogid == $blog_id ) {
			continue;
		}
		$users = get_users( array( 'blog_id' => $blogid, 'fields' => 'all_with_meta' ) );

		foreach ( $users as $user ) {
			add_user_to_blog( $blogid, $user->ID, get_blog_option( $blogid, 'default_role', 'subscriber' ) );	
		}
		break;
	}
	add_action( 'set_user_role', 'mus_add_new_user_role_to_all_sites', 10, 3 );
}
