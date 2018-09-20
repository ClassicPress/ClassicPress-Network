<?php
if (!defined('ABSPATH')) {
	exit;
}
$output .= '.has-tooltip{'
		   . 'border-bottom-color:'.$vars['content_title_small-color'].';'
		   . '}';
$output .= '.has-popover{'
		   . 'color:'.$vars['default_text-color'].';'
		   . '}';
$output .= '.has-tooltip{'
		   . 'color:'.$vars['default_text-color_darken_10'].';'
		   . '}';
$output .= '.popover-bg{'
		   . 'color:'.$vars['default_text-color_darken_10'].';'
		   . 'background-color:'.$vars['secondary_site_color'].';'
		   . '}';
$output .= '.has-popover:hover, .has-tooltip:hover{'
		   . 'color:'.$vars['main_site_color'].';'
		   . 'border-bottom-color:'.$vars['main_site_color'].';'
		   . '}';
