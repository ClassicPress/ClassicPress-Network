<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$html = $css = $slide_bg_check = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(isset($slide_bg_check) && strcmp($slide_bg_check, 'column-background-dark') === 0) {
	$el_class .= ' dfd-background-dark';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$html .= '<div class="ms-section '.esc_attr($css_class).'">';
$html .= do_shortcode($content);
$html .= '</div>';
print $html;

