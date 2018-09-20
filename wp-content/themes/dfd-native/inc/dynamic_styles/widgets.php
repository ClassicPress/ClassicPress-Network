<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .=  '.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range,'
			.'.widget.widget_calendar .calendar_wrap #wp-calendar tbody tr td a:hover:before {'
				.'background: '.$vars['main_site_color'].';'
			.'}';

$output .=  '.widget_dfd_login_widget .login-lost-password a:hover {'
				.'color: '.$vars['main_site_color'].';'
			.'}';

$output .= '.widget_dfd_login_widget .login-logout .button, .widget_dfd_login_widget .login-submit .button {background: '.$vars['third_site_color'].';}';

$output .= '.widget_dfd_login_widget .login-logout .button:hover, .widget_dfd_login_widget .login-submit .button:hover {background: '.$vars['third_color_darken_5'].';}';

/*BBpress Recent replies*/
$output .= '.widget_display_replies li a {color: '.$vars['widget_comment_title-color'].';}';