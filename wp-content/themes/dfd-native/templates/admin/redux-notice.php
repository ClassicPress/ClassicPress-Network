<?php
if(!defined('ABSPATH')) {
	exit;
}

add_action('admin_notices','dfd_redux_admin_notice__error');

if(!function_exists('dfd_redux_admin_notice__error')) {
	function dfd_redux_admin_notice__error() {
		echo '<div class="notice notice-error is-dismissible">';
			echo '<p>'. esc_html__( 'Attention! Redux Framework is enqueued from third-party plugin. It might and most obviously will affect theme functionality.', 'dfd-native' ) .'</p>';
		echo '</div>';
	}
}