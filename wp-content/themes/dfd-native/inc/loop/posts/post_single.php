<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part('inc/loop/posts/post');

/**
 * DFD core single post item
 *
 * Generate post item content inside loop for gallery page template
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_post_single')) {
	/**
	 * Single post item content generator
	 *
	 *
	 * @class 		Dfd_post_single extends Dfd_post
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_post_single extends Dfd_post {
		
		/** @var string Post item prefix. */
		public $prefix = 'post_single';
		
		/**
		 * Single post content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			$post_content = '';
			$class = get_post_class();
			$class = implode(' ', $class);
			$class .= ' '.$this->prefix;
			
			$data_atts = $this->build_article_data_atts();

			$this->single_pagination_html();
			echo '<article class="'.esc_attr($class).'" '.$data_atts.'>';
				$this->single_categories_html();
				$this->title_html();
				$this->meta_html();
				ob_start();
				$this->post_html();
				$post_content .= ob_get_clean();
				if(!empty($post_content)) {
					echo '<div class="cover">'. $post_content .'</div>';
				}
				$this->after_content_html();
				$this->single_fixed_share_html();
				Dfd_Theme_Helpers::dfd_link_pages();
			echo '</article>';
			$this->single_bottom_html();
			$this->single_author_html();
			$this->single_related_posts_html();
		}
		
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_html() {
			$this->media_html();
			$this->content_html();
		}
		
		/**
		 * Generate meta html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function media_html() {
			if (has_post_format('video')) {
				get_template_part('templates/post', 'video');
			} elseif (has_post_format('gallery')) {
				get_template_part('templates/post', 'gallery');
			} elseif(!has_post_format('audio') && !has_post_format('link') && !has_post_format('quote') && ($this->get_option($this->prefix.'_show_featured_image', 'off') == 'on' || !class_exists('Dfd_Theme_extensions'))) {
				get_template_part('templates/post', 'thumb');
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
			if(has_post_format('quote')) {
				get_template_part('templates/post', 'quote');
			} elseif(has_post_format('link')) {
				get_template_part('templates/post', 'link');
			} elseif(has_post_format('audio')) {
				get_template_part('templates/post', 'audio');
			} else {
				echo '<div class="entry-content">';
					the_content();
				echo '</div>';
			}
		}
		
		/**
		 * Generate post content html for post formats width special content sections such as gallery , quote, link and video post.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function after_content_html() {
			if((has_post_format('quote') || has_post_format('audio') || has_post_format('link')) && get_the_content() != '') {
				echo '<div class="entry-content">';
					the_content();
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
			return DfdMetaBoxSettings::compared($option, $default);
		}
		
		/**
		 * Generate post categories html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_categories_html() {
			$post_type = get_post_type();
			if($this->get_option($this->prefix.'_show_top_tags', 'off') != 'off') {
				get_template_part('templates/entry-meta/mini',$post_type.'-categories');
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
			if($this->get_option($this->prefix.'_show_title', 'off') == 'on') {
				echo '<h3 class="entry-title">'. esc_html(get_the_title()) .'</h3>';
			}
		}
		
		/**
		 * Generate meta html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function meta_html() {
			if($this->get_option($this->prefix.'_show_meta', 'off') == 'on') {
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
		 * Generate fixed share for single post item.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_fixed_share_html() {
			if($this->get_option($this->prefix.'_show_fixed_share', 'on') != 'off') {
				get_template_part('templates/entry-meta/mini','share-fixed');
			}
		}
		
		/**
		 * Generate single posts pagination html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_pagination_html() {
			$pagination_style = $this->get_option($this->prefix.'_pagination_style', 'top');
			if($pagination_style != 'off') {
				echo '<div class="dfd-single-pagination mobile-hide '.esc_attr($pagination_style).'">';
					get_template_part('templates/inside-pagination');
					if($pagination_style != 'fixed') {
						get_template_part('templates/entry-meta/blog-top-link');
					}
				echo '</div>';
			}
		}
		
		/**
		 * Generate content under single post item html. Contains tags, share and like button html
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_bottom_html() {
			$post_type = get_post_type();
			if($this->get_option($this->prefix.'_show_bottom_tags', 'on') != 'off' || $this->get_option($this->prefix.'_show_bottom_share', 'fixed') != 'off' || $this->get_option($this->prefix.'_show_bottom_likes', 'fixed') != 'off') {
				echo '<div class="dfd-single-item-bottom">';
					if($this->get_option($this->prefix.'_show_bottom_tags', 'on') != 'off') {
						get_template_part('templates/entry-meta/mini',$post_type.'-tags');
					}
					if($this->get_option($this->prefix.'_show_bottom_share', 'fixed') != 'off') {
						echo '<div class="dfd-blog-share-wrap">';
							get_template_part('templates/entry-meta/mini', 'share-inner');
						echo '</div>';
					}
					if($this->get_option($this->prefix.'_show_bottom_likes', 'fixed') != 'off') {
						get_template_part('templates/entry-meta/mini', 'like');
					}
				echo '</div>';
			}
		}
		
		/**
		 * Generate post author title html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_author_html() {
			if($this->get_option($this->prefix.'_show_author', 'on') != 'off') {
				get_template_part('templates/author','box');
			}
		}
		
		/**
		 * Generate related posts html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function single_related_posts_html() {
			if($this->get_option($this->prefix.'_show_related_posts', 'on') != 'off') {
				$post_id = get_the_ID();
				$tags = wp_get_post_tags($post_id);

				if(isset($tags[0]->slug) && $tags[0]->slug != '') {
					get_template_part('inc/loop/posts/post_custom');
					
					$sidebars = isset($this->loop_options['sidebars']) ? $this->loop_options['sidebars'] : 0;
					
					$options = array(
						'post_style' => 'carousel',
						'post_show_top_cat' => 'off',
						'post_columns' => 3,
						'post_show_meta' => 'on',
						'post_show_meta_date' => 'on',
						'post_show_meta_category' => 'on',
						'post_show_meta_comments' => 'on',
						'post_show_meta_likes' => 'on',
						'post_show_title' => 'on',
						'post_show_image' => 'on',
						'post_show_content' => 'off',
						'post_show_author_box' => 'off',
						'post_content_alignment' => 'text-left',
						'sidebars' => $sidebars,
						'layout_width' => 1920
					);
					
					$post = new Dfd_post_custom($options);

					$wp_query = new WP_Query(array(
						'post_tyle' => 'post',
						'posts_per_page' => -1,
						'post__not_in' => array($post_id),
						'tag' => $tags[0]->slug
					));
					
					if(isset($wp_query->posts) && count($wp_query->posts) > 0) {
						echo '<div class="row">';
							echo '<div class="dfd-related-posts-wrap">';
								echo '<h3 class="entry-title">'.esc_html__('Related posts', 'dfd-native').'</h3>';
								echo '<div class="dfd-carousel-wrap" data-slides="3" data-scroll="1" data-autoplay="1" data-dots="0" data-speed="2000" data-infinite="0">';
									while ($wp_query->have_posts()) : $wp_query->the_post();
										$post->post();
									endwhile;
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}

					wp_reset_postdata();
				}
			}
		}
	}
}