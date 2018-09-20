<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$side_area_css = 'background-color: '.$vars['side_area_bg_color'].';'
				. 'background-position: '.$vars['side_area_bg_position'].';'
				. 'background-size: '.$vars['side_area_bg_size'].';'
				. 'background-repeat: '.$vars['side_area_bg_repeat'].';';

if(isset($vars['side_area_bg_image']['url']) && !empty($vars['side_area_bg_image']['url'])) {
	$side_area_css .= 'background-image: url('.$vars['side_area_bg_image']['url'].');';
}

$output .= '#side-area {'.$side_area_css.'}';