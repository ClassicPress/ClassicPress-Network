<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$output = $after_output = $responsive_class = $row_custom_css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

/*Resposive css rules*/
if(isset($dfd_row_responsive_enable) && $dfd_row_responsive_enable == 'dfd-row-responsive-enable' && isset($responsive_styles) && $responsive_styles != '') {
	$responsive_class .= uniqid('vc-row-responsive-');
	$row_custom_css .= Dfd_Resposive_Param::responsive_css($responsive_styles, '.vc-row-wrapper.'.$responsive_class);
	$el_class .= ' '.$responsive_class;
}

$css_classes = array(
	'vc-row-wrapper',
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if(isset($bg_check) && $bg_check == 'row-background-dark') {
	$css_classes[] = 'dfd-background-dark';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= '<div class="row wpb_row">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
if($row_custom_css != '') {
	$output .= '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$row_custom_css.'</style>")'
				. '})(jQuery);'
			. '</script>';
}
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo $output;