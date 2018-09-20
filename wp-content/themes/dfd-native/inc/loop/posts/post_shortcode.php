<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/post');

/**
 * DFD core post item for blog posts shortcode
 *
 * Generate post item content for blog posts shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_post_shortcode')) {
	/**
	 * Post item content generator
	 *
	 *
	 * @class 		Dfd_post_shortcode extends Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_post_shortcode extends Dfd_post {
		
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_html() {
			$style = $this->loop_options[$this->prefix.'_content_style'];
			switch($style) {
				case 'full':
				case 'full_front':
					$this->media_html();
					$this->meta_html();
					$this->title_html();
					$this->content_html();
					$this->author_html();
					break;
				case 'tiny':
					$this->media_html();
					echo '<div class="content-wrap">';
						$this->title_html();
						$this->meta_html();
					echo '</div>';
					break;
				case 'list':
					$this->title_html();
					$this->meta_html();
					break;
			}
		}
		
		/**
		 * Generate thmb image dimentions
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_thumb_size($ratio = 1.6) {
			$size = array();
			
			$item_appear = DfdMetaBoxSettings::get('post_single_loop_apear');
			
			$layout_style = $this->loop_options[$this->prefix.'_style'];
			
			$columns = (int) $this->loop_options[$this->prefix.'_columns'];
			
			if($this->loop_options[$this->prefix.'_content_style'] == 'tiny') {
				return array(120, 120);
			} elseif(
				$this->loop_options[$this->prefix.'_content_style'] == 'full_front' &&
				isset($this->loop_options[$this->prefix.'_image_width']) &&
				$this->loop_options[$this->prefix.'_image_width'] != '' &&
				isset($this->loop_options[$this->prefix.'_image_height']) &&
				$this->loop_options[$this->prefix.'_image_height'] != ''
			) {
				if($item_appear == 'dfd-side-image' && $layout_style == 'shortcode_metro') {
					return array($this->loop_options[$this->prefix.'_image_width'] * 2, $this->loop_options[$this->prefix.'_image_height'] * 2);
				}
				return array($this->loop_options[$this->prefix.'_image_width'], $this->loop_options[$this->prefix.'_image_height']);
				
			}
			
			if(!$columns) {
				$columns = 1;
			}
			
			$width = Dfd_Theme_Helpers::default_screen_width() / $columns;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			if($layout_style == 'masonry' && $item_appear == 'dfd-featured') {
				$size[1] = $size[0] * 1.3;
			}
			
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
	}
}