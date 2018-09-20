<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/post');

/**
 * DFD core post item for archive page
 *
 * Generate post item content inside loop for posts archive page
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_post_archive')) {
	/**
	 * Post item content generator for posts archive page
	 *
	 *
	 * @class 		Dfd_post_archive extends Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_post_archive extends Dfd_post {
		/** @var string Post item prefix. */
		public $prefix = 'post_archive';
	}
}