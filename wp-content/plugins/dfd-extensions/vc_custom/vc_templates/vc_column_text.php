<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $el_class = $css_animation = $item_animation = '';

extract( shortcode_atts( array(
	'item_animation' => '',
	'el_class' => '',
	'css_animation' => '',
	'css' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$animate = $animation_data = '';

if ( ! ( $item_animation == '' ) ) {
	$animate        .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type = "' . $item_animation . '" ';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$css_class .= $animate;
$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '" '.$animation_data.'>';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content, true );
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_text_column' );

echo $output;