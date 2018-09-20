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

if(!class_exists('Dfd_portfolio_shortcode_metro')) {
	/**
	 * Portfolio item content generator for portfolio shortcode
	 *
	 *
	 * @class 		Dfd_portfolio_shortcode_metro extends Dfd_portfolio_shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio_shortcode_metro extends Dfd_portfolio_shortcode {
		
		/**
		 * Post content generator
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
			if(isset($this->loop_options['items']) && $this->loop_options['items'] == 'single') {
				$item_style = $this->prepare_item_style();
				if($item_style == 'wide' || $item_style == 'large') {
					$class .= ' dfd-side-image';
				}
			} else {
				$appear = DfdMetaBoxSettings::get($this->prefix.'_single_loop_apear');
				$class .= ' '.$appear;
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
			
			$atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $image_src['id'], $width, $height, $post_title);
				
			if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
				$thumb_class .= 'dfd-img-lazy-load';
				$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
				$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$atts.' />';
			} else {
				$img_html .= '<img src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$atts.' />';
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
			if(isset($this->loop_options['items']) && $this->loop_options['items'] == 'single') {
				return $this->get_custom_image_src();
			} else {
				return $this->get_loop_image_src();
			}
		}
		
		/**
		 * Generate portfolio thumb image source if loop option is selected.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_loop_image_src() {
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
				
				switch(DfdMetaBoxSettings::get($this->prefix.'_single_loop_apear')) {
					case 'dfd-side-image':
						$width = $width * 2;
						break;
					case 'dfd-featured':
						$height = $height * 2;
						break;
					case 'dfd-side-image dfd-featured':
						$width = $width * 2;
						$height = $height * 2;
						break;
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
		
		/**
		 * Generate portfolio thumb image source if single item is selected in shortcode options.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_custom_image_src() {
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
				
				switch($this->prepare_item_style()) {
					case 'wide':
						$width = $width * 2;
						break;
					case 'tall':
						$height = $height * 2;
						break;
					case 'large':
						$width = $width * 2;
						$height = $height * 2;
						break;
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
		
		/**
		 * Generate item style for correct metro layout display.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function prepare_item_style() {
			$item_size = 'default';
			$post_id = get_the_ID();
			if(isset($this->loop_options['items']) && $this->loop_options['items'] == 'single' && isset($this->loop_options['selected_items'][$post_id]) && !empty($this->loop_options['selected_items'][$post_id])) {
				$item_size = $this->loop_options['selected_items'][$post_id];
			}
			
			return $item_size;
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
			
			$columns = (int) $this->loop_options['columns'];
			
			if(!$columns) {
				$columns = 1;
			}
			
			$width = Dfd_Theme_Helpers::default_screen_width() / $columns;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			return $size;
		}
		
		/**
		 * Get option method.
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_option($option, $default) {
			$options = $this->loop_options;

			if(isset($options[$option])) {
				return $options[$option];
			}

			return $default;
		}
		
		/**
		 * Generate dynamic css rules. Disables parent class functionality
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_css() {
			
		}
	}
}