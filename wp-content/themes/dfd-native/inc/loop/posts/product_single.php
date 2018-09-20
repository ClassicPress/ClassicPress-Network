<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * DFD core WooCommerce single product item
 *
 * Generate WooCommerce single product item content
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_product_single')) {
	/**
	 * Single product item content generator
	 *
	 *
	 * @class 		Dfd_product_single
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_product_single {
		
		/**
		 * Product content generator. This method actually enqueues the WooCommerce content-single-product template
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			wc_get_template_part( 'content', 'single-product' );
		}
	}
}
