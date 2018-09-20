<?php

if (!defined('ABSPATH')) {
	exit;
}
$output .= '.wpcf7 form.dfd_contact_form input[type="submit"]{'
		   . 'font-family: '.$vars['default_button-font-family'].' !important;'
		   . '}';
$output .= '.cssload-spin-box2:after{'
		   . 'background-color:' . $vars['default_button_background'] . ';'
		   . '}';
$output .= '.dfd_contact_form  .wpcf7-submit:hover+.cssload-spin-box2:after{'
		   . 'background:' . $vars["default_button_hover_bg"] . ';'
		   . '}';

$output .= '.wpcf7 form.dfd_contact_form.preset2.hover_style_input2_underline_hover p:not(.last) span.wpcf7-form-control-wrap:before{'
		   . 'border-bottom-color:' . $vars["main_site_color"] . ';'
		   . '}';

$output .= '.wpcf7 form.dfd_contact_form.preset3.hover_style_input2_underline_hover span.wpcf7-form-control-wrap:before{'
		   . 'border-bottom-color:' . $vars["main_site_color"] . ';'
		   . '}';
/**
 * Error text font family
 */
$output .= '.wpcf7 form.dfd_contact_form .wpcf7-response-output.wpcf7-display-none.wpcf7-validation-errors span{'
		   . 'font-family:' . $vars["content_subtitle-font-family"] . ';'
		   . '}';
/**
 * Input text font family
 */
$output .= '.wpcf7 form.dfd_contact_form p:not(.form_button) input, .wpcf7 form.dfd_contact_form p:not(.form_button) textarea, .wpcf7 form:not(.dfd_contact_form) p:not(.form_button) input, .wpcf7 form:not(.dfd_contact_form) p:not(.form_button) textarea{'
		   . 'font-family:' . $vars["content_subtitle-font-family"] . ';'
		   . 'font-size: 13px;'
		   . 'line-height: 13px;'
		   . '}';
/**
 * Preset 1 Input border color
 */
$output .= '.wpcf7 form.dfd_contact_form.preset1 p:not(.form_button) input, .wpcf7 form.dfd_contact_form.preset1 p:not(.form_button) textarea, '
		   . '.wpcf7 form.dfd_contact_form.preset2 p:not(.form_button) input, .wpcf7 form.dfd_contact_form.preset2 p:not(.form_button) textarea, '
		   . '.wpcf7 form.dfd_contact_form.preset1 p:not(.form_button) span .dk-select .dk-selected{'
		   . 'border-color:' . $vars["secondary_site_color_darken_6"] . ';'
		   . '}';
/**
 * Preset 1 background color
 */
$output .= '.wpcf7 form.dfd_contact_form.preset1 span input, .wpcf7 form.dfd_contact_form.preset1 span textarea, .wpcf7 form.dfd_contact_form.preset1 .dk-select .dk-selected{'
		   . 'background-color:' . $vars["secondary_site_color_light_4"] . ';'
		   . '}';
/**
 * background color
 */
$output .= '.dfd_contact_form *::-moz-placeholder{'
		   . 'color:' . $vars['secondary_site_color_darken_50'] . ';'
		   . '} ';
$output .= '.dfd_contact_form :-ms-input-placeholder{'
		   . 'color:' . $vars['secondary_site_color_darken_50'] . ';'
		   . '} ';
$output .= '.wpcf7 form.dfd_contact_form ::-webkit-input-placeholder{'
		   . 'color:' . $vars['secondary_site_color_darken_50'] . ';'
		   . '} ';


/**
 * Preset2 border color
 */
$output .= '.wpcf7 form.dfd_contact_form.preset2 .dfd-half-size{'
		   . ' border-right-color:' . $vars['secondary_site_color'] . ';'
		   . '} ';

/**
 * Preset2 border color
 */
$output .= '.wpcf7 form.dfd_contact_form.preset2 .border-bottom{'
		   . ' border-bottom-color:' . $vars['secondary_site_color'] . ';'
		   . '} ';
/**
 * Preset2 border color
 */
$output .= '.wpcf7 form.dfd_contact_form.preset2 .border-right{'
		   . ' border-right-color:' . $vars['secondary_site_color'] . ';'
		   . '} ';
/**
 * Preset2 border color
 */
$output .= '.wpcf7 form.dfd_contact_form .dfd-contact-form-style-1 .wpcf7-form-control-wrap{'
		   . 'border-bottom-color:' . $vars['secondary_site_color'] . ';'
		   . '}';
/**
 * Preset 3 border color
 */
$output .= '.wpcf7 form.dfd_contact_form .dfd-contact-form-style-1 .right-border, .wpcf7 form.dfd_contact_form .dfd-contact-form-style-1 .top-border, .wpcf7 form.dfd_contact_form .dfd-contact-form-style-1 .left-border{'

		   . 'border-color:' . $vars['secondary_site_color'] . ';'
		   . '}';
$output .= '.wpcf7 form.dfd_contact_form.preset2 .dfd-half-size{'
		   . ' border-right-color:' . $vars['secondary_site_color'] . ';'
		   . '} ';
$output .= '.wpcf7 form:not(.dfd_contact_form) span.label_text, .wpcf7 form:not(.dfd_contact_form) label.label_text, .wpcf7 form.dfd_contact_form .label_text label:first-child{'
			. 'font-family: '.$vars['content_title_small-font-family'].' !important;'
		   		. 'font-size: '.$vars['content_title_small-font-size'].';'
				. 'font-style: '.$vars['content_title_small-font-style'].';'
				. 'font-weight: '.$vars['content_title_small-font-weight'].';'
				. 'text-transform: '.$vars['content_title_small-text-transform'].';'
				. 'line-height: '.$vars['content_title_small-line-height'].';'
				. 'letter-spacing: '.$vars['content_title_small-letter-spacing'].';'
				. 'color: '.$vars['content_title_small-color'].';'
		   . '}';
/* Placeholder styles*/
$output .= '.wpcf7 form.dfd_contact_form :-ms-input-placeholder{'
		   . 'font-family: ' . $vars['default_text-font-family'] . ' !important;'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px !important;'
		   . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'line-height: ' . $vars['default_text-line-height'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . 'color: ' . $vars['default_text-color'] . ';'
		   . '}';
$output .= '.wpcf7 form.dfd_contact_form ::-webkit-input-placeholder, .wpcf7 form:not(.dfd_contact_form) ::-webkit-input-placeholder{'
		   . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px;'
		   . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . 'color: ' . $vars['default_text-color'] . ';'
		   . '}';
$output .= 'wpcf7 form.dfd_contact_form :-moz-placeholder{'
		   . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px;'
		   . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . 'color: ' . $vars['default_text-color'] . ';'
		   . '}';
$output .= '.wpcf7 form.dfd_contact_form ::-moz-placeholder{'
		   . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px;'
		   . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . 'color: ' . $vars['default_text-color'] . ';'
		   . '}';
$output .= '.wpcf7 form.dfd_contact_form *::-moz-placeholder{'
		   . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px;'
		   . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . '}';
/* DropDown style*/
$output .= '.wpcf7 form.dfd_contact_form span .dk-select .dk-selected{'
		   . 'color:' . $vars['default_text-color'] . ';'
		    . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px;'
		    . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
		   . '} ';
/*checkbox font*/
	$output .= '.wpcf7 form.dfd_contact_form .checkbox .c_value label{'
			   . 'color:' . $vars['default_text-color'] . ';'
		    . 'font-family: ' . $vars['default_text-font-family'] . ';'
		   . 'font-size: ' . ((int)$vars['default_text-font-size']-1) . 'px;'
		    . 'font-style: ' . $vars['default_text-font-style'] . ';'
		   . 'font-weight: ' . $vars['default_text-font-weight'] . ';'
		   . 'text-transform: ' . $vars['default_text-text-transform'] . ';'
		   . 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
			   . '}';
