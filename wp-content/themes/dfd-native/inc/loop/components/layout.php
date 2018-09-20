<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * DFD core layout constructor
 *
 * Generates the layout html, sidebars configuration, layout width etc.
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */
if(!class_exists('Dfd_Layout_Builder')) {
	/**
	 * Layout markup html generator
	 *
	 *
	 * @class 		Dfd_Layout_Builder
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		private
	 */
	class Dfd_Layout_Builder {
		
		/** @var string Current page type. */
		private $page_type = '';
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access private
		 */
		function __construct($args) {
			$this->page_type = $this->get_page_type();
			
			$defaults = array(
				'loop' => 'loop',
				'page' => 'page',
				'class' => 'no-ttile',
			);
			
			$args = wp_parse_args($args, $defaults);
			
			$this->build_layout($args['loop'], $args['page'], $args['class']);
		}
		
		/**
		 * Get the layout width option value
		 *
		 * @since 1.0
		 * @access public
		 */
		function get_layout_width($page) {
			$layout_width = DfdMetaBoxSettings::get('dfd_layout_width');
			
			if(!$layout_width || empty($layout_width)) {
				global $dfd_native;
				$layout_width = isset($dfd_native[$page.'_layout_width']) ? $dfd_native[$page.'_layout_width'] : 'boxed';
			}
			
			return $layout_width;
		}
		
		/**
		 * Check if custom header is enabled for current page
		 *
		 * @since 1.0
		 * @access public
		 */
		function get_stunning_header($page) {
			$stun_header_enabled = DfdMetaBoxSettings::get('dfd_stun_header');
			if(!$stun_header_enabled || empty($stun_header_enabled)) {
				global $dfd_native;
				$stun_header_enabled = isset($dfd_native[$page.'_stun_header']) ? $dfd_native[$page.'_stun_header'] : 'on';
			}
			
			if($stun_header_enabled == 'on') {
				get_template_part('templates/header/stunning-header');
			}
		}
		
		/**
		 * Get the default page type to load default settings if no specific options were defined for current page from theme options or page metaboxes
		 *
		 * @since 1.0
		 * @access public
		 */
		function get_page_type() {
			$page_type = 'pages';
			
			if(is_404()) {
				$page_type = '404';
			}
			
			if(is_search()) {
				$page_type = 'search';
			}
			
			if(is_single()) {
				$page_type = 'single';
			}
			
			if(is_archive()) {
				$page_type = 'archive';
			}
			
			return $page_type;
		}
		
		/**
		 * Generate sidebars configuration and 
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_sidebar_config($loop, $page, $layout_width) {
			$item_sidebars = DfdMetaBoxSettings::get('dfd_sidebars_configuration');
			
			if(!$item_sidebars || empty($item_sidebars)) {
				global $dfd_native;
				$item_sidebars = isset($dfd_native[$page.'_sidebars_configuration']) ? $dfd_native[$page.'_sidebars_configuration'] : '';
				if(!class_exists('Dfd_Theme_Extensions')) {
					$item_sidebars = '2c-r-fixed';
				}
			}
			
			$default = $this->page_type;
			
			$sidebars_count = 0;
			
			$this->top_dropdowns($page);
			
			if($item_sidebars && !empty($item_sidebars)) {
				switch($item_sidebars) {
					case '2c-l-fixed':
						$dfd_layout = 'sidebar-left';
						$dfd_width = 'nine';
						break;
					case '2c-r-fixed':
						$dfd_layout = 'sidebar-right';
						$dfd_width = 'nine';
						break;
					case '3c-fixed':
						$dfd_layout = 'sidebar-both';
						$dfd_width = 'six';
						break;
					case '1col-fixed':
					default:
						$dfd_layout = 'no-sidebars';
						$dfd_width = 'twelve';
				}
				$sidebars_count = (int) substr($item_sidebars, 0, 1) - 1;
				echo '<div class="blog-section ' . esc_attr($dfd_layout) . '">';
				echo '<section id="main-content" role="main" class="' . esc_attr($dfd_width) . ' columns">';
			} else {
				Dfd_Theme_Helpers::set_layout($default, true);
			}
			
			get_template_part('inc/loop/components/loop');
			new Dfd_Loop_Builder($loop, $page, $sidebars_count, $layout_width);

			if($page != 'product_single' && $page != 'shop') {
				comments_template();
			}
			
			if(!empty($item_sidebars) && $item_sidebars) {
				echo ' </section>';

				if (($item_sidebars == "2c-l-fixed") || ($item_sidebars == "3c-fixed")) {
					get_template_part('templates/sidebar', 'left');
					echo ' </div>';
				}
				if (($item_sidebars == "2c-r-fixed") || ($item_sidebars == "3c-fixed") || ($item_sidebars == "3c-r-fixed") ) {
					get_template_part('templates/sidebar', 'right');
				}
				echo '</div>';
			} else {
				Dfd_Theme_Helpers::set_layout($default, false);
			}
		}
		
		/**
		 * Generate layout and insert sidebars config
		 *
		 * @since 1.0
		 * @access public
		 */
		function build_layout($loop, $page, $class) {
			$layout_width = $data_atts = '';
			
			$page_type = $this->page_type;
			
			$class .= ' '.$page_type;
			
			if($page_type == 'pages' || $page_type == 'single' || $page_type == 'archive' || $page_type == '404') {
				$layout_width .= $this->get_layout_width($page);
			}

			$this->get_stunning_header($page);
			
			$vc_content_position = DfdMetaBoxSettings::compared($page.'_vc_content_position', '');
			
			$lazy_load_offset = DfdMetaBoxSettings::get('reduce_lazy_load_offset', '');
			
			if($lazy_load_offset && $lazy_load_offset == 'on') {
				$data_atts .= 'data-lazy-load-offset="1"';
			}
			
			echo '<section id="layout" class="'.esc_attr($class).'" '.$data_atts.'>';

				if($vc_content_position == 'top') {
					$this->add_composer_content($page);
				}
			
				echo '<div class="row '.esc_attr($layout_width).'">';

					$this->build_sidebar_config($loop, $page, $layout_width);

				echo '</div>';

				if($vc_content_position != 'top') {
					$this->add_composer_content($page);
				}
			
			echo '</section>';
		}
		
		/**
		 * Generate Visual Composer content for pages where posts, portfolio or gallery content is displayed
		 *
		 * @since 1.0
		 * @access public
		 */
		function add_composer_content($page = 'page') {
			$avail_templates = array('post', 'portfolio', 'gallery');
			if(in_array($page, $avail_templates) && $this->page_type != 'search') {
				if(have_posts()) {
					echo '<div class="dfd-content-wrap dfd-vc-content-wrap">';
					while (have_posts()) : the_post();
						$content = get_the_content();
						if(substr_count($content, 'post-password-form') == 0) {
							the_content();
//							Dfd_Theme_Helpers::dfd_link_pages();
							echo Dfd_Theme_Helpers::dfd_pagination();
						}
						unset($content);
					endwhile;
					echo '</div>';
				}
			}
		}
		
		/**
		 * Generate categories, tags and authors dropdown sorters
		 *
		 * @since 1.0
		 * @access public
		 */
		function top_dropdowns($page) {
			if(DfdMetaBoxSettings::compared($page.'_cat_tag', 'off') == 'on' && !is_single() && !is_search()) {
				get_template_part('templates/'.$page, 'top');
			}
		}
	}
}