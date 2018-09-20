<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * DFD core WooCommerce single product shortcode item
 *
 * Generate WooCommerce product item content for WooCommerce single prodcts shortcode
 *
 * @author      dfd
 * @package     dfd_native theme
 * @version     1.0
 *
 */

if(!class_exists('Dfd_Product_Single_Shortcode')) {
	/**
	 * Product item content generator
	 *
	 *
	 * @class 		Dfd_Product_Single_Shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 * @access		public
	 */
	class Dfd_Product_Single_Shortcode {
		
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
			
			$this->product = $this->get_product();
			
			$this->id = uniqid('dfd-product-');
			
			$this->post();
			
			add_action('dfd_head_custom_css', array($this, 'build_css'));
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
			if(isset($this->args['single_custom_post_item']) && $this->args['single_custom_post_item'] != '') {
				$query = new WP_Query( array(
					'post_type' => 'product',
					'post__in' => array($this->args['single_custom_post_item'])
				));
				if($query->have_posts()):
					while ( $query->have_posts() ) : $query->the_post();
						$this->post_content();
					endwhile;
					wp_reset_postdata();
				endif;
			}
			
		}
		
		/**
		 * Generate post html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function post_content() {
			$html = $heading_html = $buttons_html = '';
			
			$class = $this->build_class();
			$data_atts = $this->build_data_atts();

			$heading_html .= $this->title_html();
			$heading_html .= $this->subtitle();
			$heading_html .= $this->price();
			$heading_html .= $this->rating();
//			$heading_html .= $this->category();
			
			$buttons_html .= $this->add_to_cart_button();
			$buttons_html .= $this->lightbox();
			
			if($heading_html != '' || $buttons_html != '') {
				$html .= '<div class="woo-title-wrap">';
					$html .= $heading_html;
					if($buttons_html != '') {
						$html .= '<div class="buttons-wrap">'
									. '<div>'
										. $buttons_html
									. '</div>'
								. '</div>';
					}
				$html .= '</div>';
			}
			
			$html .= $this->thumb();

			if($html != '') {
				echo '<div id="'.esc_attr($this->id).'" class="woocommerce products" '.$data_atts.'>'
						. '<div class="'.esc_attr($class).'">'
							. '<div class="product-wrap">'.$html.'</div>'
						. '</div>'
					. '</div>';
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
			
			if(isset($this->args['single_custom_post_item']) && $this->args['single_custom_post_item'] != '') {
				$extra_class = 'dfd-single-product-module';
				if(isset($this->args['content_position']) && $this->args['content_position'] != '') {
					$extra_class .= ' content-'.$this->args['content_position'];
				}
				if(isset($this->args['post_content_style']) && $this->args['post_content_style'] != '') {
					$extra_class .= ' '.$this->args['post_content_style'];
				}
				if(isset($this->args['post_content_alignment']) && $this->args['post_content_alignment'] != '') {
					$extra_class .= ' '.$this->args['post_content_alignment'];
				}
				if(isset($this->args['el_class']) && $this->args['el_class'] != '') {
					$extra_class .= ' '.$this->args['el_class'];
				}
				$class = get_post_class($extra_class, $this->args['single_custom_post_item']);
				$class = implode(' ', $class);
			}
			
			return $class;
		}
		
		/**
		 * Generate product data attributes.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_data_atts() {
			$atts = '';
			
			if(isset($this->args['module_animation']) && $this->args['module_animation'] != '') {
				$atts .= 'data-animate="1" data-animate-type="'.esc_attr($this->args['module_animation']).'"';
			}
			
			return $atts;
		}
		
		/**
		 * Generate thumb html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function thumb() {
			global $dfd_native;
			$thumb_html = $thumb_class = $image_html = $id = '';
			$w = 600;
			$h = 600;
			if(isset($this->args['single_custom_post_item']) && $this->args['single_custom_post_item'] != '') {
				
				if(isset($this->args['post_image_width']) && $this->args['post_image_width'] != '') {
					$w = $this->args['post_image_width'];
				}
				if(isset($this->args['post_image_height']) && $this->args['post_image_height'] != '') {
					$h = $this->args['post_image_height'];
				}
				
				if(isset($this->args['image_type']) && $this->args['image_type'] == 'media_library' && isset($this->args['custom_image']) && $this->args['custom_image'] != '') {
					$img_src = wp_get_attachment_image_src($this->args['custom_image'], 'full');
				} else {
					if(has_post_thumbnail($this->args['single_custom_post_item'])) {
						$thumb = get_post_thumbnail_id($this->args['single_custom_post_item']);
						$img_src = wp_get_attachment_image_src($thumb, 'full');
					}
				}
				
				if(isset($img_src[0]) && $img_src[0] != '') {
					$id = $img_src[0];
					$img_url = dfd_aq_resize($id, $w, $h ,true, true, true);
					if(!$img_url) {
						$img_url = $img_src[0];
					}
				} else {
					$img_url = Dfd_Theme_Helpers::default_noimage_url();
				}
				
				$title = $this->title();
				
				$atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $id, $w, $h, $title);
				
				if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
					$thumb_class .= 'dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $w $h'%2F%3E";
					$image_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" '.$atts.' />';
				} else {
					$image_html .= '<img src="'. esc_url($img_url) .'" '.$atts.' />';
				}
				
				$thumb_html .= '<div class="entry-thumb woo-cover '.esc_attr($thumb_class).'">';
					$thumb_html .= $this->sale();
//					$thumb_html .= $this->stock();
//					$thumb_html .= $this->wishlist();
					$thumb_html .= '<a href="'.esc_url(get_permalink()).'" title="">'.$image_html.'</a>';
				$thumb_html .= '</div>';
			}
			return $thumb_html;
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
				$title_options = _dfd_parse_text_shortcode_params( $this->args['title_font_options'], 'entry-title', $this->args['title_google_fonts'], $this->args['title_custom_fonts']);
				$title_html .= '<'.$title_options['tag'].' class="product_title ' .$title_options['class'].'" ' . $title_options['style'] . '><a href="'.esc_url(get_permalink()).'" title="'.esc_attr($title).'">'.esc_html($title).'</a></'.$title_options['tag'].'>';
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
			if(isset($this->args['post_show_subtitle']) && $this->args['post_show_subtitle'] == 'on' && isset($this->args['single_custom_post_item']) && $this->args['single_custom_post_item'] != '') {
				$subtitle = get_post_meta($this->args['single_custom_post_item'], 'dfd_product_product_subtitle', true);
				if($subtitle && $subtitle != '') {
					$subtitle_options = _dfd_parse_text_shortcode_params( $this->args['subtitle_font_options'], 'dfd-woocommerce-subtitle', $this->args['subtitle_google_fonts'], $this->args['subtitle_custom_fonts']);
					$subtitle_html .= '<'.$subtitle_options['tag'].' class="dfd-woocommerce-subtitle ' .$subtitle_options['class'].'" ' . $subtitle_options['style'] . '><span>'.esc_html($subtitle).'</span></'.$subtitle_options['tag'].'>';
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
			if(is_object($this->product) && method_exists($this->product, 'get_rating_html') && isset($this->args['post_show_rating']) && $this->args['post_show_rating'] == 'on') {
				if(function_exists('wc_get_rating_html') && method_exists($this->product, 'get_average_rating')) {
					$rating_html .= wc_get_rating_html( $this->product->get_average_rating() );
				} elseif(method_exists($this->product, 'get_rating_html')) {
					$rating_html .= $this->product->get_rating_html();
				}
				if($rating_html != '') {
					$rating_html = '<div class="dfd-rating-wrap"><div class="inline-block">'.$rating_html.'</div></div>';
				}
			}
			return $rating_html;
		}
		
		/**
		 * Generate product category html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function category() {
			$category_html = '';
			if(isset($this->args['single_custom_post_item']) && $this->args['single_custom_post_item'] != '' && isset($this->args['post_show_top_cat']) && $this->args['post_show_top_cat'] == 'on') {
				$product_terms = wp_get_object_terms($this->args['single_custom_post_item'], 'product_cat');
				if (isset($product_terms[0]) && !empty($product_terms[0]) && !is_wp_error($product_terms)) {
					
					$category_html .= '<span class="byline category">';
						$category_html .= '<a href="'. esc_url(get_term_link($product_terms[0]->slug, 'product_cat')) .'" class="fn">';
							$category_html .= '<span class="cat-name">'. $product_terms[0]->name .'</span>';
						$category_html .= '</a>';
					$category_html .= '</span>';
				}
			}
			return $category_html;
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
				$price_options = _dfd_parse_text_shortcode_params( $this->args['price_font_options'], '', $this->args['price_google_fonts'], $this->args['subtitle_custom_fonts']);
				$price_html .= '<div class="dfd-single-price-wrap">'
								. '<span class="price"' . $price_options['style'] . '>'.$this->product->get_price_html().'</span>'
							. '</div>';
			}
			return $price_html;
		}
		
		/**
		 * Generate description html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function description() {
			$excerpt = '';
			if(isset($this->args['post_show_content']) && $this->args['post_show_content'] == 'on' && isset($this->product->post->post_excerpt) && $this->product->post->post_excerpt != '') {
				$excerpt .= '<div class="entry-content"><p>'.$this->product->post->post_excerpt.'</p></div>';
			}
			return $excerpt;
		}
		
		/**
		 * Generate in/out of stock badge html html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function stock() {
			if(is_object($this->product) && method_exists($this->product, 'is_in_stock') && !$this->product->is_in_stock() && isset($this->args['post_show_stock']) && $this->args['post_show_stock'] == 'on') {
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
			if(is_object($this->product) && method_exists($this->product, 'is_in_stock') && $this->product->is_on_sale() && isset($this->args['post_show_sale']) && $this->args['post_show_sale'] == 'on') {
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
			if(isset($this->args['post_show_add_to_cart']) && $this->args['post_show_add_to_cart'] == 'on') {
				if(function_exists('woocommerce_template_loop_add_to_cart')) {
					ob_start();
					woocommerce_template_loop_add_to_cart();
					return ob_get_clean();
				}
			}
		}
		
		/**
		 * Generate lightbox html.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function lightbox() {
			$lightbox_html = $lightbox_links = '';
			
			if(isset($this->args['post_show_lightbox']) && $this->args['post_show_lightbox'] == 'on' && has_post_thumbnail()) {
				$thumb_data = '';
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail');
				if(isset($thumb_url[0])) {
					$thumb_data = 'data-thumb="'.esc_url($thumb_url[0]).'"';
				}
				$lightbox_html .= '<a href="'. esc_url(wp_get_attachment_url($thumb_id)) .'" '. $thumb_data .' title="" class="dfd-prod-lightbox" data-rel="prettyPhoto[product-gallery-'. esc_attr(get_the_ID()) .']">';
					$lightbox_html .= '<i class="dfd-socicon-eye-open"></i>';
				$lightbox_html .= '</a>';
				
				if(isset($this->product) && is_object($this->product) && method_exists($this->product, 'get_gallery_image_ids')) {
					$attachment_ids = $this->product->get_gallery_image_ids();
					
					foreach ( $attachment_ids as $attachment_id ) {
						$data_thumb = '';
						
						$preview_thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
						
						if(isset($preview_thumb_url[0])) {
							$data_thumb = 'data-thumb="'.esc_url($preview_thumb_url[0]).'"';
						}

						$lightbox_links .= '<a href="'.esc_url(wp_get_attachment_url($attachment_id)).'" '. $data_thumb .' data-rel="prettyPhoto[product-gallery-'. esc_attr(get_the_ID()) .']"></a>';
					}
				}
				
				if($lightbox_links != '') {
					$lightbox_html .= '<div class="hide">'.$lightbox_links.'</div>';
					
				}
			}
			
			return $lightbox_html;
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
		 * Generate dynamic css rules.
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public function build_css() {
			$css_rules = '';
			if(!isset($this->args['post_content_style']) || $this->args['post_content_style'] != 'full_front') {
				if(isset($this->args['single_product_border']) && $this->args['single_product_border'] != '') {
					$css_rules = '#'.esc_js($this->id).' .dfd-single-product-module {'.Dfd_Border_Param::border_css($this->args['single_product_border']).'}';
				}
				if(isset($this->args['content_padding']) && $this->args['content_padding'] != '') {
					$css_rules = '#'.esc_js($this->id).'.woocommerce.products .dfd-single-product-module .woo-title-wrap {padding: '.esc_js($this->args['content_padding']).'px;}';
				}
			} else {
				if(isset($this->args['mask_background']) && $this->args['mask_background'] != '') {
					$css_rules .= '#'.esc_js($this->id).'.woocommerce.products .dfd-single-product-module.full_front .product-wrap .entry-thumb > a:before {background: '.esc_js($this->args['mask_background']).';}';;
				}
			}
			
			$title_options = _dfd_parse_text_shortcode_params( $this->args['title_font_options'], '', 'no', false);

			if(isset($title_options['color']) && $title_options['color'] != '') {
				$css_rules .= '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .woo-title-wrap .price,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .button,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .add_to_cart_button,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .added_to_cart,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .button:before,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .dfd-prod-lightbox {color: '.$title_options['color'].';}';
				$css_rules .= '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .button + .dfd-prod-lightbox:after {background: '.$title_options['color'].';opacity: .1;}';
				$css_rules .= '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .button:hover,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .add_to_cart_button:hover,'
							. '#'.$this->id.'.woocommerce.products .dfd-single-product-module .product-wrap .buttons-wrap .added_to_cart:hover {color: '.Dfd_Theme_Helpers::dfd_hex2rgb($title_options['color'], .7).';}';
			}
			
			echo esc_js($css_rules);
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
				'content_position' => 'center-center',
				'post_content_style' => 'style-1',
				'module_animation' => '',
				'el_class' => '',
				'single_custom_post_item' => '',
				'image_type' => 'featured_image',
				'custom_image' => '',
				'post_image_width' => 600,
				'post_image_height' => 600,
				'post_show_title' => 'on',
				'post_show_subtitle' => 'on',
				'post_show_top_cat' => 'on',
				'post_show_price' => 'on',
				'post_show_rating' => 'on',
				'post_show_content' => 'on',
				'post_show_add_to_cart' => 'on',
				'post_show_lightbox' => 'on',
				'post_show_wishlist' => 'on',
				'post_show_sale' => 'on',
				'post_show_stock' => 'on',
				'post_content_alignment' => 'text-center',
				'content_padding' => '',
				'mask_background' => 'rgba(0,0,0,.8)',
				'single_product_border' => '',
				'title_font_options' => '',
				'title_google_fonts' => 'off',
				'title_custom_fonts' => '',
				'subtitle_font_options' => '',
				'subtitle_google_fonts' => 'off',
				'subtitle_custom_fonts' => '',
				'price_font_options' => '',
				'price_google_fonts' => 'off',
				'price_custom_fonts' => '',
			);
		}
	}
}