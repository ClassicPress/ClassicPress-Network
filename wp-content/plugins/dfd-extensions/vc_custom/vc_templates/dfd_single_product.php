<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

get_template_part('inc/loop/posts/product_single_shortcode');

new Dfd_Product_Single_Shortcode($atts);