<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $width
 * @var $css
 * @var $offset
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_Inner
 */
$output = $css_rules = $responsive_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$width = wpb_translateColumnWidthToSpan($width);
$width = str_replace('vc_col-xs-','', $width );
$width = str_replace('vc_col-sm-','', $width );
$width = str_replace('vc_col-md-','', $width );
$width = str_replace('vc_col-lg-','', $width );
$offset = str_replace('vc_col-xs-','dfd_col-mobile-', $offset );
$offset = str_replace('vc_col-sm-','dfd_col-tablet-', $offset );
$offset = str_replace('vc_col-md-','dfd_col-laptop-', $offset );
$offset = str_replace('vc_col-lg-','dfd_col-tabletop-', $offset );
$width = Dfd_Theme_Helpers::dfd_vc_columns_to_string($width);
$width = vc_column_offset_class_merge($offset, $width);

/*Shadow rules*/
$hover_class = uniqid('vc-column-hover-');
$el_class .= ' '.$hover_class;
if(strpos($col_inner_shadow, 'enable') == true) {
	$col_inner_shadow = Dfd_Box_Shadow_Param::box_shadow_css($col_inner_shadow);
	$css_rules .= '.'.esc_js($hover_class).' {'.esc_js($col_inner_shadow).'}';
}
if(strpos($col_inner_shadow_hover, 'enable') == true) {
	$col_inner_shadow_hover = Dfd_Box_Shadow_Param::box_shadow_css($col_inner_shadow_hover);
	$css_rules .= '.'.esc_js($hover_class).':hover {'.esc_js($col_inner_shadow_hover).' z-index: 1;}';
}
if(strpos($col_inner_shadow, 'enable') == true && strpos($col_inner_shadow_hover, 'enable') == false) {
	$css_rules .= '.'.esc_js($hover_class).':hover {box-shadow: none; z-index: 1;}';
}

/*BG on hover rules*/
if(isset($col_inner_hover_bg) && !empty($col_inner_hover_bg)) {
	$css_rules .= '.columns.'.esc_js($hover_class).':hover {background-color: '.esc_js($col_inner_hover_bg).' !important;}';
}

/*Border on hover rules*/
if(isset($col_inner_hover_border_color) && !empty($col_inner_hover_border_color)) {
	$css_rules .= '.columns.'.esc_js($hover_class).':hover {border-color: '.esc_js($col_inner_hover_border_color).' !important;}';
}
if(isset($col_inner_hover_border_style) && !empty($col_inner_hover_border_style)) {
	$css_rules .= '.columns.'.esc_js($hover_class).':hover {border-style: '.esc_js($col_inner_hover_border_style).' !important;}';
}
if(isset($col_inner_hover_border_radius) && !empty($col_inner_hover_border_radius)) {
	$js_rules .= '.columns.'.esc_js($hover_class).':hover {border-radius: '.esc_js($col_inner_hover_border_radius).'px !important;}';
}

/*Hover style*/
if(isset($col_inner_hover) && !empty($col_inner_hover)) {
	$el_class .= ' '.$col_inner_hover;
}

/*Resposive css rules*/
if(isset($dfd_column_responsive_enable) && $dfd_column_responsive_enable == 'dfd-column-responsive-enable' && isset($responsive_styles) && $responsive_styles != '') {
	$responsive_class .= uniqid('vc-column-responsive-');
	$css_rules .= Dfd_Resposive_Param::responsive_css($responsive_styles, '.columns.'.$responsive_class);
	$el_class .= ' '.$responsive_class;
}

$css_classes = array(
	$this->getExtraClass( $el_class ),
	'columns',
	$width,
	vc_shortcode_custom_css_class( $css ),
);

$wrapper_attributes = array();

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="wpb_wrapper">';
$output .= wpb_js_remove_wpautop( $content );
if($css_rules != '') {
	$output .= '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
}
$output .= '</div>' . $this->endBlockComment( '.wpb_wrapper' );
$output .= '</div>' . $this->endBlockComment( $this->getShortcode() );

echo $output;