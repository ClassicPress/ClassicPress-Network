<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

if(class_exists('WooCommerce') && isset($dfd_native['custom_login_page']) && $dfd_native['custom_login_page'] == 'on') {
	
	$title_color = '#222222';
	if(isset($dfd_native['login_page_color_scheme']) && $dfd_native['login_page_color_scheme'] == 'dark') {
		$title_color = '#ffffff';
	}
	
	if(isset($dfd_native['login_page_bg_color']) && $dfd_native['login_page_bg_color'] != '') {
		$output .= '.woocommerce-account.woocommerce-lost-password:not(.logged-in) #layout.no-title, .woocommerce-account:not(.logged-in) #layout.no-title {background-color:'.esc_attr($dfd_native['login_page_bg_color']).';}';
	}
	
	if(isset($dfd_native['login_page_bg_image']['url']) && $dfd_native['login_page_bg_image']['url'] != '') {
		$background_size = (isset($dfd_native['login_page_bg_image_size']) && $dfd_native['login_page_bg_image_size'] != '') ? $dfd_native['login_page_bg_image_size'] : 'initial';
		$output .= '.woocommerce-account.woocommerce-lost-password:not(.logged-in) #layout.no-title, .woocommerce-account:not(.logged-in) #layout.no-title, .woocommerce-account:not(.logged-in) #layout.dfd-default-template {background-image:url('.esc_attr($dfd_native['login_page_bg_image']['url']).');background-size: '.esc_attr($background_size).';background-position: center center;background-repeat: no-repeat;}';
	}
	
	$output .=   '.woocommerce-account form.login p.lost_password {color: '.esc_attr($title_color).';}'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #layout.no-title .woocommerce > h2,'
				.'.woocommerce-account:not(.logged-in) #layout.no-title .woocommerce > h2,'
				.'.woocommerce-account .dfd-content-wrap > .woocommerce > h2 {'
					.'color: '.esc_attr($title_color).';'
				.'}'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #header-container,'
				.'.woocommerce-account:not(.logged-in) #header-container,'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #stuning-header,'
				.'.woocommerce-account:not(.logged-in) #stuning-header,'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #footer-wrap,'
				.'.woocommerce-account:not(.logged-in) #footer-wrap,'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #footer-wrap,'
				.'.woocommerce-account:not(.logged-in) #footer-wrap,'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) .body-back-to-top,'
				.'.woocommerce-account:not(.logged-in) .body-back-to-top,'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #lang_sel_footer,'
				.'.woocommerce-account:not(.logged-in) #lang_sel_footer {'
					.'display: none;'
				.'}'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #layout.no-title,'
				.'.woocommerce-account:not(.logged-in) #layout.no-title,'
				.'.woocommerce-account:not(.logged-in) #layout.dfd-default-template {'
					.'position: fixed;'
					.'width: 100%;'
					.'height: 100%;'
					.'padding: 0;'
				.'}'
				.'.woocommerce-account.woocommerce-lost-password:not(.logged-in) #layout.no-title > .row,'
				.'.woocommerce-account:not(.logged-in) #layout.no-title > .row,'
				.'.woocommerce-account:not(.logged-in) #layout.dfd-default-template > .row {'
						.'position: absolute;'
						.'top: 50%;'
						.'left: 50%;'
						.'-webkit-transform: translate(-50%, -50%);'
						.'-moz-transform: translate(-50%, -50%);'
						.'-o-transform: translate(-50%, -50%);'
						.'transform: translate(-50%, -50%);'
				.'}';
}

$output .=	 '.woocommerce-account form.login .form-row input[type="submit"],'
			.'.woocommerce-account form.woocommerce-ResetPassword .form-row input[type="submit"] {'
				.'background: '.$vars['third_site_color'].';'
			. '}';

$output .=	 '.woocommerce-account form.login .form-row input[type="submit"]:hover,'
			.'.woocommerce-account form.woocommerce-ResetPassword .form-row input[type="submit"]:hover {'
				.'background: '.$vars['third_color_darken_5'].';'
			. '}';