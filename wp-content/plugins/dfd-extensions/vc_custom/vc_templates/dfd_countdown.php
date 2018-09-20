<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;
$main_style = $datetime = $countdown_opts = $el_class = $module_animation = $animation_data = $font_options = $time_units_font_size = $output = $time_units_font_color = '';
$number_style = $count_frmt = $uniq_id = $delimeter_val = $dot_html = $time_units_font_color = $time_units_font_size = $link_css = $bg_count_color = $main_border = '';
$number_font_size = $number_font_color = $height_square_style2 = $height_square_style3 = $thumb_line_height = $thumb_size = $calculation_line_height = $main_border_css = '';
$count_alignment = '';

$atts = vc_map_get_attributes( 'dfd_countdown', $atts );
extract( $atts );

$uniq_id = uniqid('countdown-').'-'.rand(1,9999);

if(!($module_animation == '')) {
	$el_class       .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
}

if(isset($count_alignment) && !empty($count_alignment)) {
	$el_class       .= ' '.$count_alignment;
}

$datetime = str_replace("/", ".", $datetime);
$unix_number = strtotime($datetime);
$echo_date = date("Y/m/d H:i:s", $unix_number);

$countdown_opt = explode( ',', $countdown_opts );

if(isset($delimeter_val) && !empty($delimeter_val)) {
	$dot_html = '<span class="dot">'.esc_html($delimeter_val).'</span>';
}

if(isset($font_options) && !empty($font_options)) {
	$link_css .= '#'.esc_js($uniq_id).' .dot {color: '.esc_attr($font_options).';}';
}
if(isset($time_units_font_color) && !empty($time_units_font_color)) {
	$link_css .= '#'.esc_js($uniq_id).' .period {color: '.esc_attr($time_units_font_color).';}';
}
if(isset($time_units_font_size) && !empty($time_units_font_size)) {
	$link_css .= '#'.esc_js($uniq_id).' .period {font-size: '.esc_attr($time_units_font_size).'px;}';
}
if(isset($bg_count_color) && !empty($bg_count_color)) {
	$link_css .= '.style-2 #'.esc_js($uniq_id).' .number-wrap:before, .style-3 #'.esc_js($uniq_id).' .number-container:before {background: '.esc_attr($bg_count_color).';}';
}
if($main_border != '') {
	$main_border_css = Dfd_Border_Param::border_css($main_border);
	if(substr_count($main_border_css,'border-radius:') > 0) {
		$border_radius = substr($main_border_css,stripos($main_border_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '.style-2 #'.esc_js($uniq_id).' .number-wrap:before, .style-3 #'.esc_js($uniq_id).' .number-container:before {' . $border_radius . '}';
		}
	}
	$link_css .= '.style-2 #'.esc_js($uniq_id).' .number-wrap:before, .style-3 #'.esc_js($uniq_id).' .number-container:before {' . $main_border_css . '}';
}
if(isset($number_font_size) && !empty($number_font_size)) {
	$link_css .= '#'.esc_js($uniq_id).' .number-wrap .number, #'.esc_js($uniq_id).' .dot {font-size: '.esc_attr($number_font_size).'px;}';
	$thumb_size = esc_attr($number_font_size) * 2;
	$link_css .= '.style-3 #'.esc_js($uniq_id).' .number, .style-2 #'.esc_js($uniq_id).' .number-wrap {min-width: '.esc_attr($thumb_size).'px; height: '.esc_attr($thumb_size).'px;}';
	$link_css .= '.style-3 #'.esc_js($uniq_id).' .number, .style-3 #'.esc_js($uniq_id).' .dot {line-height: '.$thumb_size.'px;}';
}
if(isset($number_font_color) && !empty($number_font_color)) {
	$link_css .= '#'.esc_js($uniq_id).' .number-wrap .number {color: '.esc_attr($number_font_color).';}';
}

if (is_array($countdown_opt)) {
	$syear = $smonth = $sday = $shr = $smin = $ssec = '';
	foreach ($countdown_opt as $opt) {
		if('syear' === $opt) {
			$syear = 'syear';
		}
		if('smonth' === $opt) {
			$smonth = 'smonth';
		}
		if('sday' === $opt) {
			$sday = 'sday';
		}
		if('shr' === $opt) {
			$shr = 'shr';
		}
		if('smin' === $opt) {
			$smin = 'smin';
		}
		if('ssec' === $opt) {
			$ssec = 'ssec';
		}
	}
	if ('syear' === $syear) {
		$count_frmt .= '<span class="number-wrap">';
			$count_frmt .= '<span class="number-container"><span class="number">%-Y</span></span>';
			$count_frmt .= '<span class="period">'.esc_html__('Years', 'dfd-native').'</span>';
		$count_frmt .= '</span>';
		$count_frmt .= $dot_html;
	}
	if('smonth' === $smonth && 'syear' === $syear) {
		if ('smonth' === $smonth) {
			$count_frmt .= '<span class="number-wrap">';
				$count_frmt .= '<span class="number-container"><span class="number">%-z</span></span>';
				$count_frmt .= '<span class="period">'.esc_html__('Months', 'dfd-native').'</span>';
			$count_frmt .= '</span>';
			$count_frmt .= $dot_html;
		}
	} elseif('smonth' === $smonth && '' === $syear) {
		if ('smonth' === $smonth) {
			$count_frmt .= '<span class="number-wrap">';
				$count_frmt .= '<span class="number-container"><span class="number">%-m</span></span>';
				$count_frmt .= '<span class="period">'.esc_html__('Months', 'dfd-native').'</span>';
			$count_frmt .= '</span>';
			$count_frmt .= $dot_html;
		}
	}
	if ('sday' === $sday && 'smonth' === $smonth) {
		$count_frmt .= '<span class="number-wrap">';
			$count_frmt .= '<span class="number-container"><span class="number">%-n</span></span>';
			$count_frmt .= '<span class="period">'.esc_html__('Days', 'dfd-native').'</span>';
		$count_frmt .= '</span>';
		$count_frmt .= $dot_html;
	} elseif('sday' === $sday && '' === $smonth) {
		$count_frmt .= '<span class="number-wrap">';
			$count_frmt .= '<span class="number-container"><span class="number">%-D</span></span>';
			$count_frmt .= '<span class="period">'.esc_html__('Days', 'dfd-native').'</span>';
		$count_frmt .= '</span>';
		$count_frmt .= $dot_html;
	}
	if ('shr' === $shr) {
		$count_frmt .= '<span class="number-wrap">';
			$count_frmt .= '<span class="number-container"><span class="number">%-H</span></span>';
			$count_frmt .= '<span class="period">'.esc_html__('Hours', 'dfd-native').'</span>';
		$count_frmt .= '</span>';
		$count_frmt .= $dot_html;
	}
	if ('smin' === $smin) {
		$count_frmt .= '<span class="number-wrap">';
			$count_frmt .= '<span class="number-container"><span class="number">%-M</span></span>';
			$count_frmt .= '<span class="period">'.esc_html__('Minutes', 'dfd-native').'</span>';
		$count_frmt .= '</span>';
		$count_frmt .= $dot_html;
	}
	if ('ssec' === $ssec) {
		$count_frmt .= '<span class="number-wrap">';
			$count_frmt .= '<span class="number-container"><span class="number">%-S</span></span>';
			$count_frmt .= '<span class="period">'.esc_html__('Seconds', 'dfd-native').'</span>';
		$count_frmt .= '</span>';
		$count_frmt .= $dot_html;
	}
}

$output .= '<div class="dfd-countdown ' . esc_attr($main_style) . ' '.esc_attr($el_class).'" ' . $animation_data . '>';
	if($datetime != ''){
		$output .= '<div id="'.esc_attr($uniq_id).'" class="dfd-countdown-wrap" data-date="'.esc_attr($echo_date).'" data-finish-text="'.esc_attr__('Event already pass','dfd-native').'">';
			$output .= '<div class="hide dfd-countdown-html">'.wp_kses($count_frmt, array('span' => array('class' => array()))).'</div>';
		$output .= '</div>';
	}
	
	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}
	
$output .='</div>';

echo $output;