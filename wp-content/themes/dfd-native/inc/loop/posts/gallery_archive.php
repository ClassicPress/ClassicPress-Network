<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/gallery');

/**
 * DFD core gallery archive item
 *
 * Generate gallery item content inside gallery achive page
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio_archive')) {
	/**
	 * Gallery item content generator
	 *
	 *
	 * @class 		Dfd_gallery_archive extends Dfd_gallery
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_gallery_archive extends Dfd_gallery {
		
		/** @var string Post item prefix. */
		public $prefix = 'gallery_archive';
	}
}