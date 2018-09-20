<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * DFD core post loop item
 *
 * Generate post item content inside loop for blog page template
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_post')) {
	/**
	 * Post item content generator
	 *
	 *
	 * @class 		Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_post {
		
		/** @var string Post item prefix. */
		public $prefix = 'post';
		
		/** @var array Options accepted from loop class. */
		public $loop_options = array();
		
		/** @var bool Single item identifier. */
		public $is_single = false;
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function __construct($options) {
			$this->loop_options = $options;
			
			add_action('dfd_head_custom_css', array($this, 'build_css'));
		}

		/**
		 * Post content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			$css = $cover_data_atts = '';
			$class = get_post_class();
			$class = implode(' ', $class);
			$class .= ' '.$this->prefix;
			$class .= ' '.$this->get_option($this->prefix.'_content_alignment', 'text-left');
			if($this->get_option($this->prefix.'_show_top_cat', 'on') != 'on') {
				$class .= ' disable-category';
			}
			$appear = get_post_meta(get_the_ID(),'post_single_loop_apear',true);
			$class .= ' '.$appear;
			$class .= ' '.get_post_meta(get_the_ID(),'post_single_content_position',true);
			//$class .= ' title-'.$this->get_option($this->prefix.'_title_position', 'bottom');
			if(has_post_format('quote') && $appear == 'dfd-featured' && ($this->loop_options[$this->prefix.'_style'] == 'metro' || $this->loop_options[$this->prefix.'_style'] == 'masonry')) {
				$bg = get_post_meta(get_the_ID(),'quote_post_bg',true);
				if($bg && $bg != '') {
					$css .= 'style="background:'.esc_attr($bg).';"';
				}
				$hover_bg = get_post_meta(get_the_ID(),'quote_post_hover_bg',true);
				if($hover_bg && $hover_bg != '') {
					$cover_data_atts .= ' data-init-hover="1" data-prop="background" data-hover-val="'.esc_attr($hover_bg).'" ';
				}
			}
			
			$data_atts = $this->build_article_data_atts();

			echo '<article class="'.esc_attr($class).'" '.$data_atts.'>';
				echo '<div class="cover" '.$css.' '.$cover_data_atts.'>';
					$this->post_html();
				echo '</div>';
				echo '<div class="dfd-shadow-box hide"></div>';
			echo '</article>';
		}
		
		/**
		 * Generate terms for post type and build terms data attribules for isotope sorting.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function terms_generator($taxonomy, $prefix = 'category') {
			$terms = get_the_terms(get_the_ID(), $taxonomy);
			$article_tags_classes = '';
			
			if($terms && is_array($terms)) {
				$article_tags_classes .= 'data-'.$prefix.'="';
				foreach ($terms as $term) {
					$article_tags_classes .= ' ' . strtolower(preg_replace('/\s+/'	, '-', $term->slug)) . ' ';
				}
				$article_tags_classes .= '"';
			}
			return $article_tags_classes;
		}
		
		/**
		 * Generate categories data attribute for isotope sorting.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_categories_data() {
			$taxonomy = 'category';
			if($this->prefix != 'post') {
				$taxonomy = $this->prefix.'_category';
			}
			
			return $this->terms_generator($taxonomy, 'category');
		}
		
		/**
		 * Generate tags data attribute for isotope sorting.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_tags_data() {
			$taxonomy = 'post_tag';
			if($this->prefix != 'post') {
				$taxonomy = $this->prefix.'_tags';
			}
			
			return $this->terms_generator($taxonomy, 'tag');
		}
		
		/**
		 * Generate author data attribute for isotope sorting.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_author_data() {
			$author = get_the_author();
			
			return 'data-author="' . strtolower(preg_replace('/\s+/'	, '-', $author)) . '"';
		}
		
		/**
		 * Combine categories, tags and author data attributes.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_article_data_atts() {
			return $this->build_categories_data() . ' ' . $this->build_tags_data() . ' '. $this->build_author_data();;
		}
		
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_html() {
			if($this->get_option($this->prefix.'_style', 'full-content') != 'full-content') {
				$this->media_html();
			}
			$this->meta_html();
			$this->title_html();
			$this->content_html();
			$this->author_html();
		}
		
		/**
		 * Generate meta html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function meta_html() {
			if($this->get_option($this->prefix.'_show_meta', 'on') == 'on') {
				echo '<div class="entry-meta">';
					echo '<div class="inline-block">';
						$this->date_html();
						$this->category_html();
						$this->comments_html();
						$this->likes_html();
					echo '</div>';
				echo '</div>';
			}
		}
		
		/**
		 * Generate date html for meta.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function date_html() {
			if($this->get_option($this->prefix.'_show_meta_date', 'on') == 'on') {
				get_template_part('templates/entry-meta/mini', 'date');
			}
		}
		
		/**
		 * Generate category html for meta.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function category_html() {
			if($this->get_option($this->prefix.'_show_meta_category', 'on') == 'on') {
				echo '<span class="before-category">'.esc_html__('in','dfd-native').'</span>';
				get_template_part('templates/entry-meta/mini', 'category');
			}
		}
		
		/**
		 * Generate comments count html for meta.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function comments_html() {
			if($this->get_option($this->prefix.'_show_meta_comments', 'on') == 'on') {
				get_template_part('templates/entry-meta/mini', 'comments');
			}
		}
		
		/**
		 * Generate like button html for meta.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function likes_html() {
			if($this->get_option($this->prefix.'_show_meta_likes', 'on') == 'on') {
				get_template_part('templates/entry-meta/mini', 'like');
			}
		}
		
		/**
		 * Generate title html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function title_html() {
			$full_content_styles = array('masonry', 'metro');
			
			$current_style = isset($this->loop_options[$this->prefix.'_style']) ? $this->loop_options[$this->prefix.'_style'] : '';
			
			if(!has_post_format('quote') && !has_post_format('link') && !has_post_format('audio') && $this->get_option($this->prefix.'_show_title', 'on') == 'on' || !in_array($current_style, $full_content_styles)) {
				echo '<h3 class="entry-title"><a href="' . esc_url(get_permalink()) .'">'. esc_html(get_the_title()) .'</a></h3>';
			}
		}
		
		/**
		 * Generate media content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function media_html() {
			$full_content_styles = array('masonry', 'metro');
			
			$current_style = isset($this->loop_options[$this->prefix.'_style']) ? $this->loop_options[$this->prefix.'_style'] : '';
			
			if($this->get_option($this->prefix.'_show_image', 'on') == 'on') {
				if(in_array($current_style, $full_content_styles)){
					$side_image_thumb = false;
					
					$post_id = get_the_id();

					if($current_style == 'metro' && get_post_meta($post_id,'post_single_loop_apear',true) == 'dfd-side-image') {
						$side_image_thumb = true;
					}

					if(
						has_post_format('link')
						|| (has_post_format('audio') && get_post_meta($post_id,'post_audio_show_thumb',true) != 'on')
						|| (has_post_format('quote') && get_post_meta($post_id,'post_quote_show_thumb',true) != 'on')
					){
						return;
					}


					if (has_post_format('gallery') && !$side_image_thumb) {
						get_template_part('templates/post', 'gallery');
					} else {
						$this->get_simple_thumb();
					}
				} else {
					$this->get_simple_thumb();
				}
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
			
			$img_html = $img_url = $thumb = '';
			$width = 675;
			$height = 450;
			if (has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$img_src = wp_get_attachment_image_src($thumb, 'full');
				$img_url = $img_src[0];
				$ratio = 1.6;
				if(
					($this->loop_options[$this->prefix.'_style'] == 'masonry' || $this->loop_options[$this->prefix.'_style'] == 'metro')
					&&
					!empty($img_src[1])
					&&
					!empty($img_src[2])
				) {
					$ratio = $img_src[1] / $img_src[2];
				}
				$image_size = $this->get_thumb_size($ratio);
				$width = $image_size[0];
				$height = $image_size[1];
				$img_url = dfd_aq_resize($img_url, $width * 1.2, $height * 1.2, true, true, true);
				if(!$img_url) {
					$img_url = $img_src[0];
				}
				
			} else {
				$img_url = Dfd_Theme_Helpers::default_noimage_url();
			}
			$format_icons = array(
				'audio' => 'dfd-socicon-microphone-black-shape',
				'video' => 'dfd-socicon-icon-play',
			);
			
			$post_link = get_permalink();
			
			$post_title = get_the_title();
			
			$post_format = get_post_format();
			
			$atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $thumb, $width, $height, $post_title);
			
			if($img_url != '') {
				if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
					$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$atts.' />';
				} else {
					$img_html .= '<img src="'. esc_url($img_url) .'" data-src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" height="'.esc_attr(floor($height)).'" '.$atts.' />';
				}
				echo '<div class="entry-thumb dfd-img-lazy-load">';
					if($post_format == 'audio' || $post_format == 'video') {
						$data_atts = '';
						$popup_link = $post_link;
						if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_link') && Dfd_Theme_Helpers::build_blog_popup_link($post_format)) {
							$popup_link = Dfd_Theme_Helpers::build_blog_popup_link($post_format);
							$data_atts = 'data-rel="prettyPhoto"';
							if($post_format == 'audio') {
								if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_audio_title')) {
									$data_atts .= ' data-audio-title="'.esc_attr(Dfd_Theme_Helpers::build_blog_popup_audio_title()).'"';
								}
								if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_audio_subtitle')) {
									$data_atts .= ' data-audio-subtitle="'.esc_attr(Dfd_Theme_Helpers::build_blog_popup_audio_subtitle()).'"';
								}
								if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_audio_image')) {
									$data_atts .= ' data-audio-thumb="'.esc_attr(Dfd_Theme_Helpers::build_blog_popup_audio_image()).'"';
								}
							}
						}
						echo '<a href="'.esc_url($popup_link).'" '.$data_atts.' class="dfd-post-format-icon '.esc_attr($format_icons[$post_format]).'" target="_blank" title="'. esc_attr($post_title) .'"></a>';
					}
					get_template_part('templates/entry-meta/mini', 'category-highlighted');
					echo '<a href="'.esc_url($post_link).'" title="'.esc_attr($post_title).'">'
							. $img_html
						. '</a>';
				echo '</div>';
			}
		}
		
		/**
		 * Generate post content html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function content_html() {
			if(($this->prefix == 'post' || $this->prefix == 'post_archive') && $this->get_option($this->prefix.'_style', 'full-content') == 'full-content') {
				$post_format = get_post_format();
				$media_html = $content_html = '';
				$media_posts = array('quote', 'link', 'audio', 'video');
				echo '<div class="entry-content">';
					if(in_array($post_format, $media_posts)) {
						ob_start();
						get_template_part('templates/post', $post_format);
						$media_html .= ob_get_clean();
						if($post_format == 'audio') {
							$data_atts = '';
							$popup_link = get_permalink();
							if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_link') && Dfd_Theme_Helpers::build_blog_popup_link($post_format)) {
								$popup_link = Dfd_Theme_Helpers::build_blog_popup_link($post_format);
								$data_atts = 'data-rel="prettyPhoto"';

								if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_audio_title')) {
									$data_atts .= ' data-audio-title="'.esc_attr(Dfd_Theme_Helpers::build_blog_popup_audio_title()).'"';
								}
								if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_audio_subtitle')) {
									$data_atts .= ' data-audio-subtitle="'.esc_attr(Dfd_Theme_Helpers::build_blog_popup_audio_subtitle()).'"';
								}
								if(method_exists('Dfd_Theme_Helpers', 'build_blog_popup_audio_image')) {
									$data_atts .= ' data-audio-thumb="'.esc_attr(Dfd_Theme_Helpers::build_blog_popup_audio_image()).'"';
								}
							}
							$media_html = '<a href="'.esc_url($popup_link).'" '.$data_atts.' class="dfd-post-format-icon dfd-socicon-microphone-black-shape" target="_blank" title="'. esc_attr(get_the_title()) .'"></a>'.$media_html;
						}
						if($media_html != '') {
							echo '<div class="dfd-media-wrapper format-'.esc_attr($post_format).'">';
								echo '<div class="cover">'. $media_html .'</div>';
							echo '</div>';
						}
						unset($media_html);
					}
					ob_start();
					the_content();
					$content_html .= ob_get_clean();
					if($content_html != '') {
						echo '<div class="dfd-content-after-media">'. $content_html .'</div>';
					}
					unset($content_html);
				echo '</div>';
			} else {
				$full_content_styles = array('masonry', 'metro');

				$current_style = isset($this->loop_options[$this->prefix.'_style']) ? $this->loop_options[$this->prefix.'_style'] : '';

				if(in_array($current_style, $full_content_styles)){
					if(has_post_format('quote')) {
						get_template_part('templates/post', 'quote');
					} elseif(has_post_format('link')) {
						get_template_part('templates/post', 'link');
					} elseif(has_post_format('audio')) {
						get_template_part('templates/post', 'audio');
						$this->get_excerpt();
					} else {
						$this->get_excerpt();
					}
				} else {
					$this->get_excerpt();
				}
			}
		}
		
		/**
		 * Generate excerpt.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_excerpt() {
			if($this->get_option($this->prefix.'_show_content', 'on') == 'on') {
				$excerpt = get_the_excerpt();
				if(!empty($excerpt)) {
					echo '<div class="entry-content">';
						if(has_post_format('audio')) {
							get_template_part('templates/entry-meta/mini', 'category-highlighted');
						}
						echo '<p>'. $excerpt .'</p>';
					echo '</div>';
				}
			}
		}
		
		/**
		 * Generate post author html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function author_html() {
			if($this->get_option($this->prefix.'_show_author_box', 'on') == 'on') {
				echo '<div class="author-section">';
					get_template_part('templates/entry-meta/mini', 'author-img');
				echo '</div>';
			}
		}
		
		/**
		 * Get option method. Call DfdMetaBoxSettings::compared().
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_option($option, $default) {
			$options = $this->loop_options;

			if(isset($options[$option]) && !empty($options[$option])) {
				return $options[$option];
			}

			return $default;
		}
		
		/**
		 * Generate thmb image dimentions
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_thumb_size($ratio = 1.6) {
			$size = array();
			
			$layout_style = $this->loop_options[$this->prefix.'_style'];
			
			if($layout_style == 'side-image') {
				if((int)$this->loop_options['sidebars'] === 2) {
					return array(900, 900);
				}
				return array(900, 600);
			}
			
			$columns = (int) $this->loop_options[$this->prefix.'_columns'] + (int)$this->loop_options['sidebars'];
			
			if(empty($columns)) {
				$columns = 1;
			}
			
			$width = $this->loop_options['layout_width'] / $columns;
			
			$height = $width / $ratio;
			
			$size[0] = $width;
			
			$size[1] = $height;
			
			$item_appear = get_post_meta(get_the_ID(),'post_single_loop_apear',true);
			
			if($layout_style == 'metro') {
				if(($item_appear == 'dfd-featured' || $item_appear == 'dfd-side-image')) {
					$size[1] = $size[0] * 1.3;
				} else {
					$size[1] = $size[0] / 1.5;
				}
			} elseif($layout_style == 'masonry' && $item_appear == 'dfd-featured') {
				$size[1] = $size[0] * 1.3;
			}
			
			return $size;
		}
		
		/**
		 * Generate dynamic css rules. Not used in original class but used in child classes
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_css() {
			
		}
	}
}