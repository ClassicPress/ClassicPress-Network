<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * DFD core loop builder
 *
 * Generate content loop for layout types
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_Loop_Builder')) {
	/**
	 * Content loop generator
	 *
	 *
	 * @class 		Dfd_Loop_Builder
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_Loop_Builder {
		
		/** @var bool Single item identifier. */
		private $is_single = false;
		
		/** @var bool Archive page identifier. */
		private $is_archive = false;
		
		/** @var string Post type. */
		private $post_type = '';
		
		/** @var string Layout width. */
		private $layout_width = '';
		
		/** @var string Sidebars count. */
		private $sidebars = '';
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access private
		 */
		function __construct($page = 'loop', $post_type = 'post', $sidebars_count = 0, $layout_width = '') {
			$this->is_single = is_single();
			
			$this->is_archive = is_archive();
			
			$this->post_type = $post_type;
			
			$this->sidebars = $sidebars_count;
			
			$this->layout_width = $layout_width;
			
			$this->init($page);
			
//			if($this->post_type != 'shop' && $this->post_type != 'shop_single') {
				add_action('dfd_head_custom_css', array($this, 'build_css'));
//			}
		}
		
		/**
		 * Generate required loop depending on accepted params
		 *
		 * @since 1.0
		 * @access public
		 */
		function init($page) {
			$method = 'build_'.$page.'_html';
			if(method_exists($this, $method)) {
				$this->$method();
			}
		}
		
		/**
		 * Generate required loop depending on accepted params
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_content_item() {
			get_template_part('inc/loop/posts/'.$this->post_type);
			$class = 'Dfd_'.$this->post_type;
			$options = $this->build_options($this->get_loop_content_params());
			$options['sidebars'] = $this->sidebars;
			$options['layout_width'] = $this->layout_width_value();
			if(class_exists($class)) {
				$post = new $class($options);
				return $post;
			}
			return false;
		}
		
		/**
		 * Create post object depending on page template
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_loop_html() {
			$class = $this->build_container_class();
			$data_atts = $this->build_container_data_atts();
			echo '<div class="'.esc_attr($class).'" '.$data_atts.'>';
				if(!have_posts()) {
					get_template_part('inc/loop/posts/nothing');
					if(class_exists('Dfd_nothing')) {
						new Dfd_nothing();
					}
				} else {
					$post = $this->build_content_item();
					while (have_posts()) : the_post();
						if(method_exists($post, 'post')) {
							if(!post_password_required(get_the_ID())){
								$post->post();
							} else {
								echo '<article class="' . esc_attr(join( ' ', get_post_class() )) . '">';
									echo '<div class="cover">';
										echo '<div class="entry-content">';
											echo get_the_password_form();
										echo '</div>';
									echo '</div>';
								echo '</article>';
							}
						}
					endwhile;
				}
			echo '</div>';
			$this->pagination_html();
		}
		
		/**
		 * Create loop for blog, portfolio or gallery page templates.
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_custom_html() {
			if(!post_password_required(get_the_ID())){
				global $wp_query;

				$orig_query = $wp_query;
				
				$custom_query = $this->build_query();
				$post = $this->build_content_item();
				$class = $this->build_container_class();
				$data_atts = $this->build_container_data_atts();

				$this->sort_panel();
				echo '<div class="'.esc_attr($class).'" '.$data_atts.'>';
					while ($custom_query->have_posts()) : $custom_query->the_post();
						$post->post();
					endwhile;
				echo '</div>';
				
				$wp_query = $custom_query;
				
				$this->pagination_html();
				
				$wp_query = $orig_query;
				
				wp_reset_postdata();
			
			} else {
				echo '<article class="' . esc_attr(join( ' ', get_post_class() )) . '">';
					echo '<div class="cover">';
						echo '<div class="entry-content">';
							echo get_the_password_form();
						echo '</div>';
					echo '</div>';
				echo '</article>';
			}
		}
		
		/**
		 * Generate WooCommerce shop archive page loop. This method actually enqueues shop archive template
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_shop_html() {
			get_template_part('templates/woocommerce/shop', 'archive');
		}
		
		/**
		 * Generate default and for page builder page content.
		 * Uses the_content() wp core function
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_content_html() {
			if(!have_posts()) {
				get_template_part('inc/loop/posts/nothing');
				if(class_exists('Dfd_nothing')) {
					new Dfd_nothing();
				}
			} else {
				while (have_posts()) : the_post();
					if(!post_password_required(get_the_ID())){
						the_content();
//						$this->pagination_html();
						Dfd_Theme_Helpers::dfd_link_pages();
					} else {
						echo '<article class="' . esc_attr(join( ' ', get_post_class() )) . '">';
							echo '<div class="cover">';
								echo '<div class="entry-content">';
									echo get_the_password_form();
								echo '</div>';
							echo '</div>';
						echo '</article>';
					}
				endwhile;
			}
		}
		
		/**
		 * Generate search result loop
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_search_html() {
			$class = $data_atts = '';
			if(have_posts()) {
				$class = $this->build_container_class();
				$data_atts = $this->build_container_data_atts();
			}
			echo '<div class="'.esc_attr($class).'" '.$data_atts.'>';
				if(!have_posts()) {
					get_template_part('inc/loop/posts/nothing');
					if(class_exists('Dfd_nothing')) {
						new Dfd_nothing();
					}
				} else {
					$avail_post_types = array('post', 'portfolio', 'gallery');
					$posts = array();
					foreach($avail_post_types as $type) {
						get_template_part('inc/loop/posts/'.$type);
						$this->post_type = $type;
						$options = $this->build_options($this->get_loop_content_params());
						$options['sidebars'] = $this->sidebars;
						$options['layout_width'] = $this->layout_width_value();
						$class = 'Dfd_'.$type;
						if(class_exists($class)) {
							$posts[$type] = new $class($options);
						}
					}
					
					while (have_posts()) : the_post();
						if(!post_password_required(get_the_ID())){
							$post_type = get_post_type();
							if(isset($posts[$post_type]) && method_exists($posts[$post_type], 'post')) {
								$posts[$post_type]->post();
							} else {
								if(isset($posts['post'])) {
									$posts['post']->post();
								}
							}
						}
					endwhile;
				}
			echo '</div>';
			$this->pagination_html();
		}
		
		/**
		 * Get option method. Call DfdMetaBoxSettings::compared().
		 *
		 * @since 1.0
		 * @access public
		 */
		function get_option($opt_name, $default) {
			return DfdMetaBoxSettings::compared($opt_name, $default);
		}
		
		/**
		 * Generate query args for custom loop
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_query_args() {
			$paged = $this->check_paged();
			
			$options = $this->build_options($this->get_query_params());
			
			$args = array();
			
			if(!isset($options[$this->post_type.'_posts_per_page']) || empty($options[$this->post_type.'_posts_per_page'])) {
				$options[$this->post_type.'_posts_per_page'] = '8';
			}
			
			$args['post_type'] = $this->post_type;
			
			$args['posts_per_page'] = $options[$this->post_type.'_posts_per_page'];
			
			$args['paged'] = $paged;
			
			if(isset($options[$this->post_type.'_custom_categories']) && !empty($options[$this->post_type.'_custom_categories'])) {
				$taxonomy = 'category';
				if($this->post_type != 'post') {
					$taxonomy = $this->post_type.'_category';
				}
				$args['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy,
						'field' => 'term_taxonomy_id',
						'terms' => $options[$this->post_type.'_custom_categories'],
					)
				);
			}
			
			return $args;
		}
		
		/**
		 * Generate custom query for posts, portfolio and gallery page templates
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_query() {
			$args = $this->build_query_args();
			
			return new WP_Query($args);
		}
		
		/**
		 * Generate pagination html
		 *
		 * @since 1.0
		 * @access public
		 */
		function pagination_html() {
			echo Dfd_Theme_Helpers::dfd_pagination();
		}
		
		/**
		 * Check pagination
		 *
		 * @since 1.0
		 * @access public
		 */
		function check_paged() {
			if (is_front_page()) {
				$page = get_query_var('page');
				$paged = ($page) ? $page : 1;
			} else {
				$page = get_query_var('paged');
				$paged = ($page) ? $page : 1;
			}
			return $paged;
		}
		
		/**
		 * Generate sort panel
		 *
		 * @since 1.0
		 * @access public
		 */
		function sort_panel() {
			$enabled_styles = array('masonry','fitRows','metro');
			if(in_array($this->get_option($this->post_type.'_style', 'masonry'), $enabled_styles) && $this->get_option($this->post_type.'_sort_panel', 'off') == 'on') {
				$class = $this->get_option($this->post_type.'_sort_panel_align', 'text-left');
				$taxonomy = 'category';
				if($this->post_type != 'post') {
					$taxonomy = $this->post_type.'_category';
				}
				$categories = get_terms($taxonomy);
				echo '<div class="clearfix sort-panel-wrap">';
					echo '<div class="sort-panel '.esc_attr($class).'">';
						echo '<ul class="filter">';
							echo '<li class="active"><a data-filter=".'.esc_attr($this->post_type).'" href="#">'. esc_html__('All', 'dfd-native') .'</a></li>';
							foreach ($categories as $category) {
								echo '<li><a data-filter=".'.esc_attr($this->post_type).'[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . esc_html($category->name) . '</a></li>';
							}
						echo '</ul>';
					echo '</div>';
				echo '</div>';
			}
		}
		
		/**
		 * Generate dynamic css rules.
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_css() {
			$offset = $this->get_option($this->post_type.'_items_offset', 0);
			
			if($offset == '' && !class_exists('Dfd_Theme_extensions') && !is_single()) {
				$offset = 20;
			}
			
			$style = $this->get_option($this->post_type.'_style', 'masonry');
			
			$disabled_offset_styles = array('metro', 'justified');
			
			$units = 'px';
			if(substr_count($offset, '%') > 0) {
				$units = '%';
			}
			
			if(($this->post_type == 'portfolio' || $this->post_type == 'gallery' || $this->post_type == 'portfolio_archive' || $this->post_type == 'gallery_archive') && in_array($style, $disabled_offset_styles)) {
				$offset = '';
			}
			
			if($offset != '') {
				echo '#main-content .dfd-content-wrap {margin: '. -(int)$offset / 2 .$units.';} #main-content .dfd-content-wrap > article {padding: '. (int)$offset / 2 .$units.';}';
				echo '@media only screen and (min-width: 1101px) {'
						. '#layout.dfd-portfolio-loop > .row.full-width > .blog-section.no-sidebars,'
						. '#layout.dfd-gallery-loop > .row.full-width > .blog-section.no-sidebars {padding: 0 '. (int)$offset .$units.';}'
						. '#layout.dfd-portfolio-loop > .row.full-width > .blog-section.no-sidebars > #main-content > .dfd-content-wrap:first-child,'
						. '#layout.dfd-gallery-loop > .row.full-width > .blog-section.no-sidebars > #main-content > .dfd-content-wrap:first-child {border-top: '. (int)$offset .$units.' solid transparent; border-bottom: '. (int)$offset / 2 .$units.' solid transparent;}'
						. '#layout.dfd-portfolio-loop > .row.full-width #right-sidebar,'
						. '#layout.dfd-gallery-loop > .row.full-width  #right-sidebar {padding-top: '. (int)$offset / 2 .$units.';padding-bottom: '. (int)$offset / 2 .$units.';}'
						. '#layout.dfd-portfolio-loop > .row.full-width > .blog-section.no-sidebars .sort-panel,'
						. '#layout.dfd-gallery-loop > .row.full-width > .blog-section.no-sidebars .sort-panel {margin-left: -'. (int)$offset .$units.';margin-right: -'. (int)$offset .$units.';}'
					. '}'
					. '#layout .dfd-content-wrap.layout-side-image,'
					. '#layout > .row.full-width .dfd-content-wrap.layout-side-image {margin-left: 0;margin-right: 0;}';
			}
		}
		
		/**
		 * Generate container class
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_container_class() {
			$class = 'dfd-content-wrap dfd-'.esc_attr($this->post_type);
			
			$style = $this->get_option($this->post_type.'_style', 'masonry');
			
			if(!class_exists('Dfd_Theme_extensions') && !DfdMetaBoxSettings::get($this->post_type.'_style')) {
				$style = 'full-content';
			}
			
			if(!$this->is_single) {
				$posts = array('post','portfolio','gallery','post_archive','portfolio_archive','gallery_archive');
				if(in_array($this->post_type, $posts)) {
					$class .= ' posts-'.$this->get_option($this->post_type.'_content_style', 'tiled');
					$class .= ' layout-'.$style;
					$galleries = array('portfolio', 'portfolio_archive','gallery','gallery_archive');
					if(in_array($this->post_type, $galleries)) {
						$content_position = $this->get_option($this->post_type.'_content_position', 'bottom');
						$class .= ' content-'.$content_position;
						if($content_position == 'front') {
							$class .= ' content-valign-'.$this->get_option($this->post_type.'_content_valign', 'bottom');
						}

						if($style == 'justified' || $style == 'metro') {
							$class .= ' featured-images-bg content-front';
							$class .= ' content-valign-'.$this->get_option($this->post_type.'_content_valign', 'bottom');
						}
					}

					if($style == 'side-image') {
						$class .= ' '.$this->get_option($this->post_type.'_style_side','mixed-image');
					}
				}
			}
			
			$class .= ' isotope-columns-'.esc_attr($this->get_option($this->post_type.'_columns', '3'));
			
			return $class;
		}
		
		/**
		 * Generate container data attribules
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_container_data_atts() {
			$data_atts = '';
			
			$avail_formats = array('post','portfolio','gallery','post_archive','portfolio_archive','gallery_archive');
			
			if(in_array($this->post_type, $avail_formats)) {
				$style = $this->get_option($this->post_type.'_style', 'masonry');
				
				if(!class_exists('Dfd_Theme_extensions') && $this->get_option($this->post_type.'_style', '') == '') {
					$style = 'full-content';
				}

				if($style == 'masonry' || $style == 'fitRows' || /*$style == 'justified' ||*/ $style == 'metro') {
					$data_atts .= ' data-enable-isotope="1"';
					$data_atts .= ' data-layout-type="'.esc_attr($style).'"';

					$data_atts .= ' data-columns="'.esc_attr($this->get_option($this->post_type.'_columns', '3')).'"';
				}

				$animation = $this->get_option($this->post_type.'_appear_effect', '');

				if($animation != '') {
					$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($animation).'" data-animate-item="article"';
				}
			}
			
			return $data_atts;
		}
		
		/**
		 * Parse options array.
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_options($options) {
			foreach($options as $k => $v) {
				$options[$k] = DfdMetaBoxSettings::compared($k, $v);
			}
			
			return $options;
		}
		
		/**
		 * Define the layout width for image cropping depending on layout width.
		 *
		 * @since 1.0.3
		 * @access public
		 */
		function layout_width_value() {
			if($this->layout_width == 'full-width') {
				return Dfd_Theme_Helpers::default_screen_width();
			} else {
				return 1280;
			}
		}
		
		/**
		 * Get query params
		 *
		 * @since 1.0
		 * @access public
		 */
		function get_query_params() {
			return array(
				$this->post_type.'_custom_categories' => '',
				$this->post_type.'_posts_per_page' => '8',
				$this->post_type.'_cat_tag' => '',
			);
		}
		
		/**
		 * Get loop content params. Returns array which is passed to post object.
		 *
		 * @since 1.0
		 * @access public
		 */
		function get_loop_content_params() {
			$args = array(
				$this->post_type.'_style' => 'masonry',
				$this->post_type.'_style_side' => 'left-image',
				$this->post_type.'_columns' => 3,
				$this->post_type.'_show_top_cat' => 'on',
				$this->post_type.'_show_meta' => 'on',
				$this->post_type.'_show_meta_date' => 'on',
				$this->post_type.'_show_meta_category' => 'on',
				$this->post_type.'_show_meta_comments' => 'on',
				$this->post_type.'_show_meta_likes' => 'on',
				$this->post_type.'_show_title' => 'on',
				$this->post_type.'_show_image' => 'on',
				$this->post_type.'_show_content' => 'on',
				$this->post_type.'_show_author_box' => 'on',
				//$this->post_type.'_title_position' => 'bottom',
				$this->post_type.'_content_alignment' => 'text-left',
			);
			$hovers = array('portfolio', 'gallery', 'portfolio_archive', 'gallery_archive');
			if(in_array($this->post_type, $hovers)) {
				$args[$this->post_type.'_content_position'] = 'bottom';
				$args[$this->post_type.'_show_subtitle'] = 'on';
				$args[$this->post_type.'_hover_enable'] = 'on';
				$args[$this->post_type.'_hover_appear_effect'] = 'dfd-fade-out';
				$args[$this->post_type.'_hover_image_effect'] = 'panr';
				$args[$this->post_type.'_hover_main_decoration'] = 'none';
				$args[$this->post_type.'_hover_title_decoration'] = 'title-deco-none';
				$args[$this->post_type.'_hover_show_title'] = 'on';
				$args[$this->post_type.'_hover_show_subtitle'] = 'on';
				$args[$this->post_type.'_hover_plus_position'] = 'dfd-middle';
//				$args[$this->post_type.'_hover_plus_bordered'] = '';
				$args[$this->post_type.'_hover_mask_border'] = 'off';
				$args[$this->post_type.'_hover_mask_bordered_style'] = 'offset';
				$args[$this->post_type.'_hover_mask_bordered_size'] = 10;
				$args[$this->post_type.'_hover_main_decoration_link'] = 'inside';
				$args[$this->post_type.'_hover_buttons_inside'] = '';
				$args[$this->post_type.'_hover_buttons_external'] = '';
				$args[$this->post_type.'_hover_buttons_lightbox'] = '';
				/*
				$args[$this->post_type.''] = '';
				*/
			}
			if(!class_exists('Dfd_Theme_extensions')) {
				$args[$this->post_type.'_style'] = 'full-content';
			}
			return $args;
		}
	}
}