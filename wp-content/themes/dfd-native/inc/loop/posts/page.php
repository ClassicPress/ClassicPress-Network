<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * DFD core page content
 *
 * Generate page content. Uses the_content() WP core function
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_page')) {
	/**
	 * Page content generator
	 *
	 *
	 * @class 		Dfd_page
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_page {
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function __construct() {
			
		}
		
		/**
		 * Page content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function post() {
			the_content();
			Dfd_Theme_Helpers::dfd_link_pages();
//			echo Dfd_Theme_Helpers::dfd_pagination();
		}
	}
}