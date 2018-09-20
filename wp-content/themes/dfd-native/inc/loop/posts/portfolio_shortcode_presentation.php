<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio_shortcode_metro');

/**
 * DFD core portfolio shortcode item
 *
 * Generate portfolio item content inside portfolio shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio_presentation_shortcode')) {
	/**
	 * Portfolio item content generator for portfolio shortcode
	 *
	 *
	 * @class 		Dfd_portfolio_presentation_shortcode extends Dfd_portfolio_shortcode_metro
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio_presentation_shortcode extends Dfd_portfolio_shortcode_metro {
		
		/** @var int Iteration counter. */
		public $counter = 1;
		
		/**
		 * Portfolio item content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			$css = '';
			$class = get_post_class();
			$class = implode(' ', $class);
			$class .= ' dfd-'.$this->prefix;
			$class .= ' '.$this->get_option($this->prefix.'_content_alignment', 'text-left');
			if(
				$this->get_option($this->prefix.'_style','featured-left') == 'featured-left' && $this->counter == 1 ||
				$this->get_option($this->prefix.'_style','featured-left') == 'featured-right' && $this->counter == 3
			) {
				$class .= ' dfd-side-image';
			}
			$class .= ' '.$this->build_hover_class();
			
			$data_atts = $this->build_article_data_atts();

			echo '<article class="'.esc_attr($class).'" '.$data_atts.'>';
				echo '<div class="cover" '.$css.'>';
					$this->post_html();
				echo '</div>';
				echo '<div class="dfd-shadow-box hide"></div>';
			echo '</article>';
		}
		
		/**
		 * Generate portfolio thumb image source.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_image_src() {
			$featured = false;
			if(
				$this->get_option($this->prefix.'_style','featured-left') == 'featured-left' && $this->counter == 1 ||
				$this->get_option($this->prefix.'_style','featured-left') == 'featured-right' && $this->counter == 3
			) {
				$featured = true;
			}
			$this->counter++;
			return $this->get_single_image_src($featured);
		}
		
		/**
		 * Generate portfolio thumb image source.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_single_image_src($featured = false) {
			$width = 600;
			$height = 600;
			$thumb = '';
			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_src = wp_get_attachment_image_src($thumb, 'full');
				$img_url = $img_src[0];
				
				$ratio = 1;
				
				$image_size = $this->get_thumb_size($ratio);
				
				$width = $image_size[0];
				$height = $image_size[1];
				
				if($featured) {
					$width = $width * 2;
					$height = $height * 2;
				}
				
				$img_url = dfd_aq_resize($img_url, $width * 1.2, $height * 1.2, true, true, true);
				if(!$img_url) {
					$img_url = $img_src[0];
				}
				
			} else {
				$img_url = Dfd_Theme_Helpers::default_noimage_url();
			}
			
			$return = array(
				'id' => $thumb,
				'url' => $img_url,
				'width' => $width,
				'height' => $height,
			);
			
			return $return;
		}
	}
}