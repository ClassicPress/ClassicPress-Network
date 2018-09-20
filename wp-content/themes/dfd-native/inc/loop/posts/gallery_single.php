<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio_single');

/**
 * DFD core gallery single item
 *
 * Generate gallery single item content
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_gallery_single')) {
	/**
	 * Gallery single item content generator
	 *
	 *
	 * @class 		Dfd_gallery_single extends Dfd_portfolio_single
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_gallery_single extends Dfd_portfolio_single {
		
		/** @var string Post item prefix. */
		public $prefix = 'gallery_single';
		
		/**
		 * Generate media content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function media_html() {
			$gallery_style = $this->get_option($this->prefix.'_style','carousel');
			
			echo '<div class="entry-thumb media-'.esc_attr($gallery_style).'"">';
				echo '<div class="media-section">';
					get_template_part('templates/gallery/gallery', $gallery_style);
				echo '</div>';
			echo '</div>';
		}
		
		/**
		 * Generate gallery content html. Disables the functionality of parent class
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function content_html() {
		}
		
		/**
		 * Generate gallery category html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function category_html() {
			if($this->get_option($this->prefix.'_show_meta_category', 'on') == 'on') {
				echo '<span>'.esc_html__('in','dfd-native').'</span>';
				get_template_part('templates/entry-meta/mini', 'category-gallery-simple');
			}
		}
		
		/**
		 * Generate single gallery pagination html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_pagination_html() {
			$pagination_style = $this->get_option($this->prefix.'_pagination_style', 'fixed');
			if($pagination_style != 'off') {
				echo '<div class="dfd-single-pagination mobile-hide '.esc_attr($pagination_style).'">';
					get_template_part('templates/inside-pagination');
					if($pagination_style != 'fixed') {
						get_template_part('templates/entry-meta/gallery-top-link');
					}
				echo '</div>';
			}
		}
	}
}