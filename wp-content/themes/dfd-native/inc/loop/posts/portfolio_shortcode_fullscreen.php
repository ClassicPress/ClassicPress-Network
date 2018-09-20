<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/portfolio_shortcode');


/**
 * DFD core portfolio loop item
 *
 * Generate portfolio item content for portfolio fullscreen shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_portfolio_shortcode_fullscreen')) {
	/**
	 * Portfolio item content generator
	 *
	 *
	 * @class 		Dfd_portfolio_shortcode_fullscreen extends Dfd_portfolio_shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_portfolio_shortcode_fullscreen extends Dfd_portfolio_shortcode {
		
		/**
		 * Post content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			$class = get_post_class();
			$class = implode(' ', $class);
			$class .= ' dfd-'.$this->prefix;
			$class .= ' swiper-slide';
			$class .= ' '.$this->get_option($this->prefix.'_content_alignment', 'text-left');
//			$class .= ' '.$this->build_hover_class();
			
			$data_atts = $this->build_article_data_atts();

			echo '<article class="'.esc_attr($class).'" '.$data_atts.'>';
				echo '<div class="cover panr">';
						$this->post_html();
				echo '</div>';
			echo '</article>';
		}
		
		/**
		 * Generate title html for entry hover decoration.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function title_html() {
			$title = get_the_title();
			$index = strpos($title, ' ');
			if($index) {
				$title_text = substr($title, 0, $index) . '<br>' . substr($title, $index + 1);
			} else {
				$title_text = $title;
			}
			if($this->get_option($this->prefix.'_show_title', 'on') == 'on') {
				echo '<h3 class="entry-title"><a href="'.esc_url(get_permalink()).'" title="'. esc_html(get_the_title()) .'"><span>'. wp_kses($title_text, array('br' => array())) .'</span></a></h3>';
			}
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
			
			$thumb_class = $image_html = '';
			$image_src = $this->get_image_src();
			
			$img_url = $image_src['url'];
			
			$width = $image_src['width'];
			
			$height = $image_src['height'];
			
			$small_img_url = $image_src['url_small'];
			
			$post_title = get_the_title();
			
			$atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $image_src['id'], $width, $height, $post_title);
			
			if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
				$thumb_class .= 'dfd-img-lazy-load';
				$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
				$image_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" data-src-small="'. esc_url($small_img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$atts.' />';
			} else {
				$image_html .= '<img src="'. esc_url($img_url) .'" data-src="'. esc_url($img_url) .'" data-src-small="'. esc_url($small_img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$atts.' />';
			}
			
			
			echo '<div class="entry-thumb '.esc_attr($thumb_class).'">';
				if($this->loop_options[$this->prefix.'_show_top_cat'] == 'on') {
					get_template_part('templates/entry-meta/mini', 'category-'.$this->prefix);
				}
				echo '<span class="thumb-wrap">'
						. $image_html
					. '</span>';
				echo '<span class="hide"><img src="'.esc_url($small_img_url).'" alt="'.esc_attr__('Small image', 'dfd-native').'" /></span>';
				$this->entry_hover();
				echo '<a href="'.esc_url(get_permalink()).'" title="'.esc_attr($post_title).'" class="dfd-portfolio-fullscreen-link"></a>';
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
			$width = 1200;
			$height = 648;
			$thumb = '';
			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_src = wp_get_attachment_image_src($thumb, 'full');
				$img_url = $img_src[0];
				
				$ratio = 1.85;
				
				$image_size = $this->get_thumb_size($ratio);
				
				$width = $image_size[0];
				$height = $image_size[1];
				
				$img_url = dfd_aq_resize($img_url, $width, $height, true, true, true);
				$img_url_small = dfd_aq_resize($img_url, 60, 25, true, true, true);
				if(!$img_url) {
					$img_url = $img_src[0];
				}
				if(!$img_url_small) {
					$img_url_small = $img_src[0];
				}
				
			} else {
				$img_url = Dfd_Theme_Helpers::default_noimage_url();
				$img_url_small = Dfd_Theme_Helpers::default_noimage_url();
			}
			
			$return = array(
				'id' => $thumb,
				'url' => $img_url,
				'width' => $width,
				'height' => $height,
				'url_small' => $img_url_small,
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
		public function get_thumb_size($ratio = 1.85) {
			$size = array();
			
			$columns = (int) $this->loop_options[$this->prefix.'_columns'];
			
			if(empty($columns)) {
				$columns = 1;
			}
			
			$width = Dfd_Theme_Helpers::default_screen_width() / $columns;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			return $size;
		}
	}
}