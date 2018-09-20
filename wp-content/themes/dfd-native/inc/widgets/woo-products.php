<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once(get_template_directory().'/inc/widgets/widget.php');

class dfd_woo_products extends SB_WP_Widget {
	protected $widget_base_id = 'dfd_woo_products';
	protected $widget_name = 'Custom: WooCommerce products';

	protected $options;

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		$this->options = array(
			array(
				'title', 'text', '',
				'label'		=> esc_html__('Title', 'dfd-native'),
				'input'		=> 'text',
				'filters'	=> 'widget_title',
				'on_update'	=> 'esc_attr'
			),
			array(
				'product_number', 'text', 3,
				'label'		=> esc_html__('Number of products', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'display', 'text', '',
				'label'		=> esc_html__('Products to display', 'dfd-native'),
				'input'		=> 'custom_select',
				'values'	=>	array(
					'all'			=> esc_html__('All', 'dfd-native'),
					'recent'		=> esc_html__('Recent', 'dfd-native'),
					'featured'		=> esc_html__('Featured', 'dfd-native'),
					'on_sale'		=> esc_html__('On sale', 'dfd-native'),
					'top_rated'		=> esc_html__('Top rated', 'dfd-native'),
					'top_sales'		=> esc_html__('Top sales', 'dfd-native')
				),
				'on_update'	=> 'esc_attr'
			),
			array(
				'post_show_title', 'text', '',
				'label'		=> esc_html__('Disable title', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'post_show_subtitle', 'text', '',
				'label'		=> esc_html__('Disable subtitle', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'post_show_price', 'text', '',
				'label'		=> esc_html__('Disable price', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'post_show_rating', 'text', '',
				'label'		=> esc_html__('Disable rating', 'dfd-native'),
				'input'		=> 'checkbox'
			),
			array(
				'image_width', 'text', 80,
				'label'		=> esc_html__('Thumbnail width', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'image_height', 'text', 100,
				'label'		=> esc_html__('Thumbnail height', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
			array(
				'thumb_radius', 'text', '',
				'label'		=> esc_html__('Thumbnail border radius', 'dfd-native'),
				'input'		=> 'number',
				'on_update'	=> 'esc_attr'
			),
		);

		parent::__construct();
	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		$link_css = '';

		extract( $args );
		$this->setInstances($instance, 'filter');

		echo wp_kses( $before_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );

		$title = $this->getInstance('title');

		echo (!empty($title)) ? $before_title . $title . $after_title : '';

		$product_number = $this->getInstance('product_number');
		$display = $this->getInstance('display');
		$post_show_title = $this->getInstance('post_show_title');
		$post_show_subtitle = $this->getInstance('post_show_subtitle');
		$post_show_price = $this->getInstance('post_show_price');
		$post_show_rating = $this->getInstance('post_show_rating');
		$thumb_radius = $this->getInstance('thumb_radius');

		$atts = array();
		$atts['image_width'] = $this->getInstance('image_width');
		$atts['image_height'] = $this->getInstance('image_height');
		if(isset($post_show_title) && $post_show_title == '') {
			$atts['post_show_title'] = 'on';
		}else{
			$atts['post_show_title'] = '';
		}
		if(isset($post_show_subtitle) && $post_show_subtitle == '') {
			$atts['post_show_subtitle'] = 'on';
		}else{
			$atts['post_show_subtitle'] = '';
		}
		if(isset($post_show_price) && $post_show_price == '') {
			$atts['post_show_price'] = 'on';
		}else{
			$atts['post_show_price'] = '';
		}
		if(isset($post_show_rating) && $post_show_rating == '') {
			$atts['post_show_rating'] = 'on';
		}else{
			$atts['post_show_rating'] = '';
		}

		if(isset($args['widget_id']) && !empty($args['widget_id'])) {
			$id = $args['widget_id'];
		}else{
			$id = 'widget_'.$this->widget_base_id;
		}
		/*style*/
		if(isset($thumb_radius) && $thumb_radius != '') {
			$link_css .= '#'.esc_js($id).' .thumb-wrap {border-radius: '.esc_js($thumb_radius).'px;}';
		}

		/*Product item object inited*/
		get_template_part('inc/loop/posts/product_loop_small_shortcode');

		$product = new Dfd_Product_Loop_Small_Shortcode($atts);

		/*Loop settings*/
		$sticky = get_option('sticky_posts');

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $product_number,
			'ignore_sticky_posts' => 1,
			'post__not_in' => $sticky,
		);

		if(!isset($display) || $display == '') {
			$display = 'all';
		}

		switch($display) {
			case 'recent':
				$args['meta_query'] = WC()->query->get_meta_query();
				break;
			case 'featured':
				if(function_exists('wc_get_product_visibility_term_ids')) {
					$product_visibility_term_ids = wc_get_product_visibility_term_ids();
					$args['tax_query'][] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['featured'],
					);
				} else {
					$args['meta_query'] = array(
						array(
							'key' 		=> '_visibility',
							'value' 	  => array('catalog', 'visible'),
							'compare'	=> 'IN'
						),
						array(
							'key' 		=> '_featured',
							'value' 	  => 'yes'
						)
					);
				}
				break;
			case 'on_sale':
				global $woocommerce;
				if(function_exists('wc_get_product_ids_on_sale')) {
					$sale_product_ids = wc_get_product_ids_on_sale();
				} else {
					$sale_product_ids = woocommerce_get_product_ids_on_sale();
				}
				$meta_query = array();
				$meta_query[] = $woocommerce->query->visibility_meta_query();
				$meta_query[] = $woocommerce->query->stock_status_meta_query();
				$args['meta_query'] = $meta_query;
				$args['post__in'] = $sale_product_ids;
				break;
			case 'top_rated':
				$args['no_found_rows'] = 1;
				$args['meta_key'] = '_wc_average_rating';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				$args['meta_query'] = WC()->query->get_meta_query();
				$args['tax_query'] = WC()->query->get_tax_query();
				break;
			case 'top_sales':
				$args['meta_key'] = 'total_sales';
				$args['orderby'] = 'meta_value_num';
				$args['meta_query'] = array(
						array(
							'key' 		=> '_visibility',
							'value' 	=> array( 'catalog', 'visible' ),
							'compare' 	=> 'IN'
						)
					);
				break;
			case 'categories':
				if (!empty($post_categories)) {
					$post_categories_array = explode(',', $post_categories);
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'product_cat',
							'field' => 'slug',
							'terms' => $post_categories_array,
						)
					);
				}
				break;
		}

		$wp_query = new WP_Query($args);

		echo '<div class="woocommerce widget">';
			echo '<div class="dfd-shop-loop-small-shortcode">';
				echo '<div class="dfd-product-small-list products">';
					while ($wp_query->have_posts()) : $wp_query->the_post();
						$product->post();
					endwhile;
				echo '</div>';
			echo '</div>';
		echo '</div>';

		if(!empty($link_css)) : ?>
			<script>
				(function($) {
					$('head').append('<style><?php echo esc_js($link_css); ?></style>');
				})(jQuery);
			</script>
		<?php endif;

		wp_reset_postdata();

		echo wp_kses( $after_widget, array(
				'div' => array('id' => array(), 'class' => array()),
				'section' => array('id' => array(), 'class' => array())
			) );
	}
}