<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {
    if ( ! class_exists( 'cmb_Meta_Box' ) )
        require_once get_template_directory().'/inc/lib/metabox/init.php';
}
require_once(get_template_directory() . '/inc/custom_metabox/one-page.php');
require_once(get_template_directory() . '/inc/custom_metabox/post-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/portfolio-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/product-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/gallery-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/headers-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/features-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/custom-headers.php');
require_once(get_template_directory() . '/inc/custom_metabox/custom-sidebar.php');
require_once(get_template_directory() . '/inc/custom_metabox/page-boxes.php');
require_once(get_template_directory() . '/inc/custom_metabox/preloader-options.php');