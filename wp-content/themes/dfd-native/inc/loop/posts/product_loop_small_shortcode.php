<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/product_loop_shortcode');

/**
 * DFD core WooCommerce product loop item
 *
 * Generate WooCommerce product item content inside loop for WooCommerce prodcts list small shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_Product_Loop_Small_Shortcode')) {
	/**
	 * Product item content generator
	 *
	 *
	 * @class 		Dfd_Product_Loop_Small_Shortcode extends Dfd_Product_Loop_Shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_Product_Loop_Small_Shortcode extends Dfd_Product_Loop_Shortcode {
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_content() {
			$html = '';
			
			$class = $this->build_class();

			$html .= $this->thumb_section_html();
			$html .= $this->build_content_html();
			
			if($html != '') {
				echo '<div class="'.esc_attr($class).'">'.$html.'</div>';
			}
		}
		
		/**
		 * Generate product class.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_class() {
			$class = '';
			
			$extra_class = 'dfd-loop-product-small-item';
			
			$class = get_post_class($extra_class);
			$class = implode(' ', $class);
			
			return $class;
		}
		
		/**
		 * Generate thumb section html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function thumb_section_html() {
			$thumb_html = '';
			$thumb_html .= $this->thumb();
			if($thumb_html != '') {
				$thumb_html = $thumb_html;
			}
			return $thumb_html;
		}
		
		/**
		 * Generate content section html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_content_html() {
			$content = '';
			$content .= $this->title_html();
			$content .= $this->subtitle();
			$content .= $this->price();
			$content .= $this->rating();
			if($content != '') {
				$content = '<div class="woo-title-wrap">'.$content.'</div>';
			}
			return $content;
		}
		
		/**
		 * Generate thumb html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function thumb() {
			$thumb_html = $img_atts = '';
			
			$thumb_class = $width = $height = '';
			
			if(has_post_thumbnail()) {
				$thumb_id = get_post_thumbnail_id();
				if(isset($this->args['image_width']) && $this->args['image_width'] != '' && isset($this->args['image_height']) && $this->args['image_height'] != '') {
					$img_src = wp_get_attachment_image_src($thumb_id, 'full');
					$img_url = dfd_aq_resize($img_src[0], $this->args['image_width'], $this->args['image_height'], true. true, true);
					
					$width = $this->args['image_width'];
					$height = $this->args['image_height'];
					
					if(!$img_url) {
						$img_url = $img_src[0];
					}
				} else {
					$img_src = wp_get_attachment_image_src($thumb_id, 'thumbnail');
					
					$img_url = $img_src[0];
					$width = $img_src[1];
					$height = $img_src[2];
				}
				
				global $dfd_native;
				
				$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $thumb_id, $width, $height, esc_attr__('Product image','dfd-native'));

				if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
					$thumb_class .= ' dfd-img-lazy-load ';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
					$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_url).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$img_atts.' />';
				} else {
					$img_html = '<img src="'.esc_url($img_url).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$img_atts.' />';
				}
			} else {
				$img_url = Dfd_Theme_Helpers::default_noimage_url();
				$img_html = '<img src="'.esc_url($img_url).'" '.$img_atts.' />';
			}
			
			$thumb_html .= '<div class="thumb-wrap '.esc_attr($thumb_class).'">'.$img_html.'</div>';
			
			return $thumb_html;
		}
		
		/**
		 * Return default settings array.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function defaults() {
			return array(
				'image_width' => '',
				'image_height' => '',
				'post_show_title' => 'on',
				'post_show_subtitle' => 'on',
				'post_show_price' => 'on',
				'post_show_rating' => 'on',
			);
		}
	}
}