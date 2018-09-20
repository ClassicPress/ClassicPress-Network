<?php

if (!defined('ABSPATH')) {
	exit;
}
$output .= '.dfd-info-banner .description{'
				. 'font-family: ' . $vars['default_text-font-family'] . ';'
				. 'font-size: ' . $vars['default_text-font-size'] . ';'
				. 'font-style: ' . $vars['default_text-font-style'] . ';'
				. 'font-weight: ' . $vars['default_text-font-weight'] . ';'
				. 'letter-spacing: ' . $vars['default_text-letter-spacing'] . ';'
				. 'color: ' . $vars['default_text-color'] . ';'
		   . '}';
$output .= '.dfd-info-banner .feature-title:not(.no_hover):hover {'
				. 'color: ' . $vars['main_color_darken_5'] . ';'
		   . '}';
$output .= '.dfd-info-banner .number_block{'
				. 'background:' . $vars['default_button_background'] . ';'
				. 'color: ' . $vars['default_button-color'] . ';'
				. 'font-family: ' . $vars['default_button-font-family'] . ';'
		   . '}';