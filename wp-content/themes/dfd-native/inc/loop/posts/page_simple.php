<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/page');

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

if(!class_exists('Dfd_page_simple')) {
	/**
	 * Page content generator
	 *
	 *
	 * @class 		Dfd_page_simple extends Dfd_page
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_page_simple extends Dfd_page {
		
	}
}