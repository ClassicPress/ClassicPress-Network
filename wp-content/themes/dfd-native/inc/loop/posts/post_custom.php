<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/post');

/**
 * DFD core post loop item
 *
 * Generate post item content inside loop for blog page template
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_post_custom')) {
	/**
	 * Post item content generator
	 *
	 *
	 * @class 		Dfd_post_custom extends Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_post_custom extends Dfd_post {
		
	}
}