<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$el_class = $output = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$output .= '<div class="dfd-side-by-side-slider '.esc_attr($el_class).'">';
$output .= do_shortcode($content);
$output .= '</div>';

print $output;

