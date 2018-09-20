<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $font_color = $el_class = $width = $offset = $sort_panel_group = $column_responsive_mobile_classes = $css_rules = $responsive_class = $mobile_css_rules = '';
$cus_bg_position = $cus_bg_repeat = $col_shadow_css = $col_shadow_hover_css = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = str_replace('vc_col-xs-','', $width );
$width = str_replace('vc_col-sm-','', $width );
$width = str_replace('vc_col-md-','', $width );
$width = str_replace('vc_col-lg-','', $width );
$offset = str_replace('vc_col-xs-','dfd_col-mobile-', $offset );
$offset = str_replace('vc_col-sm-','dfd_col-tablet-', $offset );
$offset = str_replace('vc_col-md-','dfd_col-laptop-', $offset );
$offset = str_replace('vc_col-lg-','dfd_col-tabletop-', $offset );
$offset = str_replace('vc_hidden-xs','dfd_vc_hidden-xs', $offset );
$offset = str_replace('vc_hidden-sm','dfd_vc_hidden-sm', $offset );
$offset = str_replace('vc_hidden-md','dfd_vc_hidden-md', $offset );
$offset = str_replace('vc_hidden-lg','dfd_vc_hidden-lg', $offset );
$width = Dfd_Theme_Helpers::dfd_vc_columns_to_string($width);
$width = vc_column_offset_class_merge($offset, $width);

$el_class .= ' columns';

$dfd_extra_class = uniqid('vc-column-extra-class-');
$el_class .= ' '.$dfd_extra_class;

/*Resposive css rules*/
if(isset($dfd_column_responsive_enable) && $dfd_column_responsive_enable == 'dfd-column-responsive-enable' && isset($responsive_styles) && $responsive_styles != '') {
	$css_rules .= Dfd_Resposive_Param::responsive_css($responsive_styles, '.columns.'.$dfd_extra_class);
}

if  (isset($column_prebuilt_classes) && !empty($column_prebuilt_classes)) {
	$el_class .= ' '.$column_prebuilt_classes;
}

if  (isset($column_responsive_mobile_classes) && !empty($column_responsive_mobile_classes)) {
	$column_responsive_mobile_classes = str_replace(',',' ', $column_responsive_mobile_classes );
	$el_class .= ' '.$column_responsive_mobile_classes;
}

if  (isset($column_responsive_mobile_resolutions) && !empty($column_responsive_mobile_resolutions)) {
	$column_responsive_mobile_resolutions = str_replace(',',' ', $column_responsive_mobile_resolutions );
	$el_class .= ' '.$column_responsive_mobile_resolutions;
}

if  (isset($column_bg_check) && strcmp($column_bg_check, 'column-background-dark') === 0) {
	$el_class .= ' dfd-background-dark';
}

if  (isset($column_parallax) && !empty($column_parallax)) {
	$el_class .= ' '.$column_parallax;
}

/*BG image position & BG image repeat*/
if(isset($cus_bg_position) && !empty($cus_bg_position) && $cus_bg_position != 'Default') {
	$css_rules .= '.columns.'.esc_js($dfd_extra_class).' {background-position: '.esc_js($cus_bg_position).' !important;}';
}
if(isset($cus_bg_repeat) && !empty($cus_bg_repeat)) {
	$css_rules .= '.columns.'.esc_js($dfd_extra_class).' {background-repeat: '.esc_js($cus_bg_repeat).' !important;}';
}

/*Shadow rules*/
if(strpos($col_shadow, ':enable') == true) {
	$col_shadow_css = Dfd_Box_Shadow_Param::box_shadow_css($col_shadow);
	$css_rules .= '.'.esc_js($dfd_extra_class).' {'.esc_js($col_shadow_css).'}';
}
if(strpos($col_shadow_hover, ':enable') == true) {
	$col_shadow_hover_css = Dfd_Box_Shadow_Param::box_shadow_css($col_shadow_hover);
	$css_rules .= '.'.esc_js($dfd_extra_class).':hover {'.esc_js($col_shadow_hover_css).' z-index: 1;}';
}
if( (strpos($col_shadow, ':enable') == true) && (strpos($col_shadow_hover, ':enable') == false) ) {
	$css_rules .= '.'.esc_js($dfd_extra_class).':hover {box-shadow: none; z-index: 1;}';
}

/*BG on hover rules*/
if(isset($col_hover_bg) && !empty($col_hover_bg)) {
	$css_rules .= '.columns.'.esc_js($dfd_extra_class).':hover {background-color: '.esc_js($col_hover_bg).' !important;}';
}

/*Border on hover rules*/
if(isset($col_hover_border_color) && !empty($col_hover_border_color)) {
	$css_rules .= '.columns.'.esc_js($dfd_extra_class).':hover {border-color: '.esc_js($col_hover_border_color).' !important;}';
}
if(isset($col_hover_border_style) && !empty($col_hover_border_style)) {
	$css_rules .= '.columns.'.esc_js($dfd_extra_class).':hover {border-style: '.esc_js($col_hover_border_style).' !important;}';
}
if(isset($col_hover_border_radius) && !empty($col_hover_border_radius)) {
	$css_rules .= '.columns.'.esc_js($dfd_extra_class).':hover {border-radius: '.esc_js($col_hover_border_radius).'px !important;}';
}

/*Hover style*/
if(isset($col_hover) && !empty($col_hover)) {
	$el_class .= ' '.$col_hover;
}
if(!empty($mobile_column_bg_image)) {
	$mobile_bg_image_src = wp_get_attachment_image_src($mobile_column_bg_image, 'full');
	if(!empty($mobile_bg_image_src[0])) {
		$mobile_css_rules .= 'background-image: url('.esc_url($mobile_bg_image_src[0]).') !important;';
	}
}

if(!empty($mobile_column_bg_size)) {
	$mobile_css_rules .= 'background-size: '.esc_attr($mobile_column_bg_size).' !important;';
}

if(!empty($mobile_column_bg_position) && $mobile_column_bg_position != 'Default') {
	$mobile_css_rules .= 'background-position: '.esc_attr($mobile_column_bg_position).' !important;';
}

if(!empty($mobile_column_bg_repeat)) {
	$mobile_css_rules .= 'background-repeat: '.esc_attr($mobile_column_bg_repeat).' !important;';
}

if($mobile_css_rules != '') {
	$css_rules .= '@media (max-width: 799px) {.columns.'.esc_js($dfd_extra_class).'{'.str_replace('\n', '', esc_js($mobile_css_rules)).'}}';
}

$data_attr = '';

if  (isset($column_parallax_sense) && !empty($column_parallax_sense)) {
	$data_attr .= ' data-parallax_sense="'.esc_attr($column_parallax_sense).'"';
}

if  (isset($column_parallax_limit) && !empty($column_parallax_limit)) {
	$data_attr .= ' data-parallax_limit="'.esc_attr($column_parallax_limit).'"';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="'.$css_class.'" '.$data_attr.'>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
if($css_rules != '') {
	$output .= '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
}
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;