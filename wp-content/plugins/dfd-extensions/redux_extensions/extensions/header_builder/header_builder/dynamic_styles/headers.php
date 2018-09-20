<?php

if (!defined('ABSPATH')) {
	exit;
}

/* base typography */
$output .= '.calculate_width,'
		   . '.calulate_login_width,'
		   . '.calulate_wishlist_width,'
		   . '.container div,'
		   . '.container ul,'
		   . '.container li,'
		   . '.container ol,'
		   . '.container p,'
		   . '.container pre,'
		   . '.container td,'
		   . '.container th,'
		   . '.login-header p.login-remember label {'
		   . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . $vars['default_text-font-size'] . ';'
		   . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'line-height: ' . $vars['default_text-line-height'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . 'color: ' . $vars['default_text-color'] . ';'
		   . '}';
/**
 * Colors
 */
$output .='.header_builder_app .header_builder_wrapper #dfd_header_t_preview .c_el .template{'
//		   . 'color: ' . $vars['header_text_color_5'] . ';'
		   . '}';

/* Header top panel */
$output .= ' .t_wrap  .login-header .dfd-header-links,'
		   . '.t_wrap .dfd-header-links'
		   . '{'
		   . 'font-family: ' . $vars['header_links-font-family'] . ';'
		   . 'font-size: ' . esc_attr($vars['header_links-font-size']) . ';'
		   . 'font-style: ' . esc_attr($vars['header_links-font-style']) . ';'
		   . 'font-weight: ' . esc_attr($vars['header_links-font-weight']) . ';'
		   . 'text-transform: ' . esc_attr($vars['header_links-text-transform']) . ';'
		   . 'line-height: ' . esc_attr($vars['header_links-line-height']) . ';'
		   . 'letter-spacing: ' . esc_attr($vars['header_links-letter-spacing']) . ';'
//		   . 'color: ' . esc_attr($vars['header_links-color']) . ';'
		   . '}';
$output .= '.container .dfd-header-top-info, .calculate_top_info_width {'
				. 'font-family: '.$vars['top_info-font-family'].';'
				. 'font-size: '.$vars['top_info-font-size'].';'
				. 'font-style: '.$vars['top_info-font-style'].';'
				. 'font-weight: '.$vars['top_info-font-weight'].';'
				. 'text-transform: '.$vars['top_info-text-transform'].';'
				. 'line-height: '.$vars['top_info-line-height'].';'
				. 'letter-spacing: '.$vars['top_info-letter-spacing'].';'
//				. 'color: '.$vars['top_info-color'].';'
			. '}';
$output.='.header_builder_app  .Button .template{'
		   . 'max-height:'.$vars["default_button-line-height"].';'
		   . '}';
$output.='.header_builder_app  .button_builder{'
		   . 'font-family:'.$vars["default_button-font-family"].';'
		   . 'font-weight:'.$vars["default_button-font-weight"].';'
		   . 'font-style:'.$vars["default_button-font-style"].';'
		   . 'font-size:'.$vars["default_button-font-size"].';'
		   . 'text-transform:'.$vars["default_button-text-transform"].';'
		   . 'letter-spacing:'.$vars["default_button-letter-spacing"].';'
		   . 'color:'.$vars["default_button-color"].' !important;'
		   . 'background-color:'.$vars["default_button_background"].';'
		   . 'border-color:'.$vars["default_button_border"].';'
		   . 'border-width:'.$vars["default_button_border_width"].'px;'
		   . 'border-style:'.$vars["default_button_border_style"].';'
		   . 'border-radius:'.$vars["default_button_border_radius"].'px;'
		   . 'padding-left:'.$vars["default_button_padding_left"].'px;'
		   . 'padding-right:'.$vars["default_button_padding_right"].'px;'
		   . 'max-height:'.$vars["default_button-line-height"].';'
		   . '}';
$output.='.header_builder_app  .button_builder:hover{'
		   . 'color:'.$vars["default_button_hover_color"].' !important;'
		   . 'background-color:'.$vars["default_button_hover_bg"].';'
		   . 'border-color:'.$vars["default_button_hover_border"].';'
		   . '}';


	
	