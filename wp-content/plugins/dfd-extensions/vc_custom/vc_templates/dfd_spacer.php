<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $data_atts = $units = /*$screen_wide_resolution =*/ $screen_wide_spacer_size = $screen_normal_resolution = $screen_normal_spacer_size = $screen_tablet_resolution = $screen_tablet_spacer_size = $screen_mobile_resolution = $screen_mobile_spacer_size = '';

$atts = vc_map_get_attributes( 'dfd_spacer', $atts );
extract( $atts );

$data_atts .= ' data-units="'.esc_attr($units).'"';

$data_atts .= ' data-wide_size="'.esc_attr($screen_wide_spacer_size).'"';

$data_atts .= ' data-normal_resolution="'.esc_attr($screen_normal_resolution).'"';

$data_atts .= ' data-normal_size="'.esc_attr($screen_normal_spacer_size).'"';

$data_atts .= ' data-tablet_resolution="'.esc_attr($screen_tablet_resolution).'"';

$data_atts .= ' data-tablet_size="'.esc_attr($screen_tablet_spacer_size).'"';

$data_atts .= ' data-mobile_resolution="'.esc_attr($screen_mobile_resolution).'"';

$data_atts .= ' data-mobile_size="'.esc_attr($screen_mobile_spacer_size).'"';

$output .= '<div class="dfd-spacer-module" '.$data_atts.' style="height: '.esc_attr($screen_wide_spacer_size).'px;"></div>';

echo $output;