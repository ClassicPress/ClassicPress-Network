<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$mobile_css = '';

/***********************
 * Button "Back to Top"  
 **********************/
if (isset($dfd_native['btt_switch']) && strcmp($dfd_native['btt_switch'], 'off') === 0) {
	// Background hover
	$output .= '.body-back-to-top:hover:after,'
			. '.body-back-to-top.active:before,'
			. '.body-back-to-top.active:after {background: '.$vars['main_site_color'].';}';
} else {
	// Background hover
	$output .= '.body-back-to-top:hover:after,'
			. '.body-back-to-top.active:before,'
			. '.body-back-to-top.active:after {background: '.$vars['btt_button_hover_bg'].';}';
	// Background
	$output .= '.body-back-to-top:after {background: '.$vars['btt_button_background'].';}';
	// Border
	$output .= '.body-back-to-top:after {'
		. 'border-width: '.$vars['btt_button_border_width'].'px;'
		. 'border-style: '.$vars['btt_button_border_style'].';'
		. 'border-radius: '.$vars['btt_button_border_radius'].'%;'
		. '}';
	$output .= '.body-back-to-top {border-radius: '.$vars['btt_button_border_radius'].'%;}';
	$output .= '.body-back-to-top:after {border-color: '.$vars['btt_button_border'].';}';
	// Border hover
	$output .= '.body-back-to-top:hover:after {border-color: '.$vars['btt_button_hover_border'].';}';
	// Icon
	$output .= '.body-back-to-top > i {'
		. 'text-shadow: 0px 0px '.$vars['btt_button_icon'].', 0px 55px '.$vars['btt_button_icon'].';'
		. 'font-size: '.$vars['btt_button_icon_size'].'px;'
		. '}';
	// Icon hover
	$output .= '.body-back-to-top:hover i {text-shadow: 0px -55px '.$vars['btt_button_hover_icon'].', 0px 0px '.$vars['btt_button_hover_icon'].';}';
	// Button size
	$output .= '.body-back-to-top {'
		. 'width: '.$vars['btt_button_size'].'px;'
		. 'height: '.$vars['btt_button_size'].'px;'
		. 'line-height: '.$vars['btt_button_size'].'px;'
		. '}';
	// Button shadow on hover
	if(isset($dfd_native['btt_disable_shadow']) && strcmp($dfd_native['btt_disable_shadow'], 'off') === 0) {
		$output .= '.body-back-to-top:hover:after {box-shadow: none;}';
	}

	/* Show on mobile */ 
	// Button size
	$mobile_css .= '.body-back-to-top.btt-mobile-show {'
		. 'width: '.$vars['btt_button_mobile_size'].'px;'
		. 'height: '.$vars['btt_button_mobile_size'].'px;'
		. 'line-height: '.$vars['btt_button_mobile_size'].'px;'
		. '}';
	// Icon size
	$mobile_css .= '.body-back-to-top > i {font-size: '.$vars['btt_button_icon_mobile_size'].'px;}';
	$output .= '@media only screen and (max-width: 799px) {'.$mobile_css.';}';
}