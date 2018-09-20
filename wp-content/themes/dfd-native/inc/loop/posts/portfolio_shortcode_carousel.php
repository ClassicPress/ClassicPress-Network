<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio_shortcode');

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

if(!class_exists('Dfd_portfolio_shortcode_carousel')) {
	/**
	 * Portfolio item content generator for portfolio shortcode
	 *
	 *
	 * @class 		Dfd_portfolio_shortcode_carousel extends Dfd_portfolio_shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio_shortcode_carousel extends Dfd_portfolio_shortcode {
		
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_html() {
			$this->media_html();
		}
		
		/**
		 * Generate thumb html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_simple_thumb() {
			global $dfd_native;
			
			$img_html = $thumb_class = '';
			
			$image_src = $this->get_image_src();
			
			$img_url = $image_src['url'];
			
			$width = $image_src['width'];
			
			$height = $image_src['height'];
			
			$post_title = get_the_title();
			
			$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $image_src['id'], $width, $height, $post_title);
				
			if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
				$thumb_class .= 'dfd-img-lazy-load';
				$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
				$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$img_atts.' />';
			} else {
				$img_html .= '<img src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$img_atts.' />';
			}

			echo '<div class="entry-thumb '.esc_attr($thumb_class).'">';
				if($this->loop_options[$this->prefix.'_show_top_cat'] == 'on') {
					get_template_part('templates/entry-meta/mini', 'category-'.$this->prefix);
				}
				echo '<span class="thumb-wrap">'
						. $img_html
					. '</span>';
				$this->entry_hover();
			echo '</div>';
		}
		
		/**
		 * Generate portfolio thumb image source.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_image_src() {
			$width = 600;
			$height = 300;
			$thumb = '';
			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_src = wp_get_attachment_image_src($thumb, 'full');
				$img_url = $img_src[0];
				
				$image_size = $this->get_thumb_size();
				
				$width = $image_size[0];
				$height = $image_size[1];
				
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
		
		/**
		 * Generate portfolio thumb image size.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_thumb_size($ratio = 1) {
			$size = array();

			$ratio = (float) $this->loop_options[$this->prefix.'_image_ratio'];
			
			if(!$ratio) {
				$ratio = 2.5;
			}
			
			$columns = (int) $this->loop_options[$this->prefix.'_columns'];
			
			if(!$columns) {
				$columns = 1;
			}
			
			$width = Dfd_Theme_Helpers::default_screen_width() / $columns * 1.5;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			return $size;
		}
	}
}