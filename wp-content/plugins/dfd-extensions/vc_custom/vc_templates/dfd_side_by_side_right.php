<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$output .= '<div class="ms-right '.esc_attr($el_class).'">';
$output .= do_shortcode($content);
$output .= '</div>';

print $output;

