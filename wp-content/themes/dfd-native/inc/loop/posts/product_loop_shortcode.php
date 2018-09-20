<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * DFD core WooCommerce product loop item
 *
 * Generate WooCommerce product item content inside loop for WooCommerce prodcts list shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_Product_Loop_Shortcode')) {
	/**
	 * Product item content generator
	 *
	 *
	 * @class 		Dfd_Product_Loop_Shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_Product_Loop_Shortcode {
		
		/** @var array Options accepted from loop class. */
		public $args = array();
		
		/** @var object Global product item object. */
		public $product = NULL;
		
		/** @var string ID. */
		public $id = '';
		
		/**
		 * Constructor.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		function __construct($args = array()) {
			$defaults = $this->defaults();
			
			$this->args = array_merge($defaults, $args);
		}
		
		/**
		 * Product getter
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function get_product() {
			if(isset($this->args['single_custom_post_item']) && $this->args['single_custom_post_item'] != '' && function_exists('wc_get_product')) {
				return wc_get_product($this->args['single_custom_post_item']);
			}
			return false;
		}
		
		/**
		 * Post content generator
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post() {
			global $product;
			
			$this->id = uniqid('dfd-product-');
			
			$this->product = $product;
			$this->post_content();
		}
		
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
				echo '<li id="'.esc_attr($this->id).'" class="'.esc_attr($class).'"><div class="prod-wrap">'.$html.'</div></li>';
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
			
			$extra_class = 'dfd-loop-product-module';
			
			if(isset($this->args['carousel_mode']) && $this->args['carousel_mode'] == 'on') {
				$extra_class .= ' swiper-slide';
			}
			
			$class = get_post_class($extra_class, $this->args['single_custom_post_item']);
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
			$thumb_html .= $this->wishlist();
			$thumb_html .= $this->sale();
			$thumb_html .= $this->stock();
			if(!isset($this->args['post_content_style']) || empty($this->args['post_content_style']) || $this->args['post_content_style'] == 'style-1' || $this->args['post_content_style'] == 'style-4') {
				$thumb_html .= $this->add_to_cart_button();
			}
			if($thumb_html != '') {
				$thumb_html = '<div class="woo-cover">'.$thumb_html.'</div>';
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
			if(isset($this->args['post_content_style']) && !empty($this->args['post_content_style']) && $this->args['post_content_style'] != 'style-1' && $this->args['post_content_style'] != 'style-4') {
				$content .= $this->add_to_cart_button();
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
			ob_start();
			
			Dfd_Theme_Helpers::dfd_woo_product_thumbs();
			
			return ob_get_clean();
		}
		
		/**
		 * Generate title.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function title() {
			$title = '';
			if(isset($this->args['post_show_title']) && $this->args['post_show_title'] == 'on') {
				$title .= get_the_title();
			}
			return $title;
		}
		
		/**
		 * Generate title html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function title_html() {
			$title_html = '';
			$title = $this->title();
			if($title != '') {
				$title_html .= '<h3 class="dfd-shop-loop-title"><a href="'.esc_url(get_permalink()).'" title="'.esc_attr($title).'">'.esc_html($title).'</a></h3>';
			}
			return $title_html;
		}
		
		/**
		 * Generate subtitle html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function subtitle() {
			$subtitle_html = '';
			if(isset($this->args['post_show_subtitle']) && $this->args['post_show_subtitle'] == 'on') {
				$subtitle = DfdMetaBoxSettings::get('dfd_product_product_subtitle');
				if($subtitle && $subtitle != '') {
					$subtitle_html .= '<h4 class="dfd-woocommerce-subtitle">'.esc_html($subtitle).'</h4>';
				}
			}
			return $subtitle_html;
		}
		
		/**
		 * Generate product rating html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function rating() {
			$rating_html = '';
			if(is_object($this->product) && isset($this->args['post_show_rating']) && $this->args['post_show_rating'] == 'on') {
				if(function_exists('wc_get_rating_html') && method_exists($this->product, 'get_average_rating')) {
					$rating_html .= wc_get_rating_html( $this->product->get_average_rating() );
				} elseif(method_exists($this->product, 'get_rating_html')) {
					$rating_html .= $this->product->get_rating_html();
				}
				if(!empty($rating_html)) {
					$rating_html = '<div class="dfd-rating-wrap"><div class="inline-block">'.$rating_html.'</div></div>';
				}
			}
			return $rating_html;
		}
		
		/**
		 * Generate price html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function price() {
			$price_html = '';
			if(is_object($this->product) && method_exists($this->product, 'get_price_html') && isset($this->args['post_show_price']) && $this->args['post_show_price'] == 'on') {
				$price_html .= '<span class="price">'.$this->product->get_price_html().'</span>';
			}
			return $price_html;
		}
		
		/**
		 * Generate in/out of stock badge html html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function stock() {
			if(is_object($this->product) && method_exists($this->product, 'is_in_stock') && !$this->product->is_in_stock()) {
				return '<span class="dfd-out-stock">'. esc_html__('Out Of Stock!', 'dfd-native') .'</span>';
			}
			return false;
		}
		
		/**
		 * Generate on-sale badge html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function sale() {
			if(is_object($this->product) && method_exists($this->product, 'is_in_stock') && $this->product->is_on_sale()) {
				return '<span class="onsale">'.apply_filters('woocommerce_show_product_loop_sale_flash', esc_html__('Sale', 'dfd-native')).'</span>';
			}
			return false;
		}
		
		/**
		 * Generate add to cart button html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function add_to_cart_button() {
			$buttons_html = '';
			if(method_exists('Dfd_Theme_Helpers','dfd_woocommerce_loop_button_wrap') && isset($this->args['post_show_add_to_cart']) && $this->args['post_show_add_to_cart'] == 'on') {
				ob_start();
				Dfd_Theme_Helpers::dfd_woocommerce_loop_button_wrap();
				$buttons_html .= ob_get_clean();
			}
			return $buttons_html;
		}
		
		/**
		 * Generate add to wishlist button html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function wishlist() {
			if(isset($this->args['post_show_wishlist']) && $this->args['post_show_wishlist'] == 'on') {
				ob_start();

				wc_get_template('loop/share.php');

				return ob_get_clean();
			}
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
				'post_content_style' => 'style-1',
				'module_animation' => '',
				'carousel_mode' => 'off',
				'single_custom_post_item' => '',
				'post_show_title' => 'on',
				'post_show_subtitle' => 'on',
				'post_show_price' => 'on',
				'post_show_rating' => 'on',
				'post_show_content' => 'on',
				'post_show_add_to_cart' => 'on',
				'post_show_wishlist' => 'on',
				'post_content_alignment' => 'text-left',
				'title_font_options' => '',
				'title_google_fonts' => 'off',
				'title_custom_fonts' => '',
			);
		}
	}
}