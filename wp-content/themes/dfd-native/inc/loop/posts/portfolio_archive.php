<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio');

/**
 * DFD core portfolio item for archive page
 *
 * Generate portfolio item content inside portfolio archive loop
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio_archive')) {
	/**
	 * Portfolio item content generator
	 *
	 *
	 * @class 		Dfd_portfolio_archive extends Dfd_portfolio
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_portfolio_archive extends Dfd_portfolio {
		
		/** @var string Portfolio item prefix. */
		public $prefix = 'portfolio_archive';
	}
}