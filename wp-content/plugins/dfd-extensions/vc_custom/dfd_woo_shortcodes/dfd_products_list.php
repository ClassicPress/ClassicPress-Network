<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
class WPBakeryShortCode_Dfd_Products_List extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_html__('WooCommerce products list','dfd-native'),
		'base' => 'dfd_products_list',
		'class' => 'dfd_products_list dfd_shortcode',
		'icon' => 'dfd_products_list dfd_shortcode',
		'category' => esc_html__('Native','dfd-native'),
		'description' => esc_html__('Displays WooCommerce products','dfd-native'),
		'params' => array(
			array(
				'type'        => 'radio_image_select',
				'heading'     => esc_html__( 'Style', 'dfd-native' ),
				'param_name'  => 'post_content_style',
				'simple_mode' => false,
				'options'     => array(
					'style-1' => array(
						'tooltip' => esc_attr__('Button over image','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/shop_loop/style-1.png'
					),
					'style-2' => array(
						'tooltip' => esc_attr__('Button under image','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/shop_loop/style-2.png'
					),
					'style-3' => array(
						'tooltip' => esc_attr__('With overlay','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/shop_loop/style-3.png'
					),
					'style-4' => array(
						'tooltip' => esc_attr__('Button over image','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/shop_loop/style-1.png'
					),
				),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'        => 'dropdown',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name'  => 'module_animation',
				'value'       => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'        => 'textfield',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'  => 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/woocommerce-product-list',
				'video_link'		=> 'https://youtu.be/1W9TPKSzAck',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Products settings', 'dfd-native' ),
				'param_name'       => 'loop_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose what products should be displayed','dfd-native').'</span></span>'.esc_html__('Display', 'dfd-native'),
				'param_name' => 'display',
				'value' => 'all',
				'options' => array(
					esc_attr__('All','dfd-native') => 'all',
					esc_attr__('Recent','dfd-native') => 'recent',
					esc_attr__('Featured','dfd-native') => 'featured',
					esc_attr__('On sale','dfd-native') => 'on_sale',
					esc_attr__('Top rated','dfd-native') => 'top_rated',
					esc_attr__('Top sales','dfd-native') => 'top_sales',
					esc_attr__('Categories','dfd-native') => 'categories',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_taxonomy_multicheck',
				'heading' => esc_html__('Categories','dfd-native'),
				'param_name' => 'post_categories',
				'taxonomy' => 'product_cat',
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-taxonomy-multicheck',
				'dependency' => array('element' => 'display', 'value' => 'categories'),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of products which should be displayed','dfd-native').'</span></span>'.esc_html__('Products number','dfd-native'),
				'param_name' => 'posts_to_show',
				'value' => 3,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the product items','dfd-native').'</span></span>'.esc_html__('Items offset', 'dfd-native'),
				'param_name' => 'items_offset',
				'value' => 20,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-border-bottom dfd-number-wrap crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add border radius for product thumbnails','dfd-native').'</span></span>'.esc_html__('Thumb border radius', 'dfd-native'),
				'param_name' => 'thumb_radius',
				'value' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-border-bottom dfd-number-wrap crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the number of columns for the product items','dfd-native').'</span></span>'.esc_html__('Number of columns', 'dfd-native'),
				'param_name' => 'columns',
				'value' => 3,
				'options' => array(
					esc_attr__('One','dfd-native') => 1,
					esc_attr__('Two','dfd-native') => 2,
					esc_attr__('Three','dfd-native') => 3,
					esc_attr__('Four','dfd-native') => 4
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to switch the products list to carousel mode. The products used to show up in grid mode by default but you can make them to show up as carousel by switching this option on.','dfd-native').'</span></span>'.esc_html__('Carousel mode','dfd-native'),
				'param_name' => 'carousel_mode',
				'value' => 'off',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Content elements', 'dfd-native' ),
				'param_name'       => 'enabled_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
				'group'            => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Title','dfd-native'),
				'param_name' => 'post_show_title',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Subtitle','dfd-native'),
				'param_name' => 'post_show_subtitle',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Price','dfd-native'),
				'param_name' => 'post_show_price',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Rating','dfd-native'),
				'param_name' => 'post_show_rating',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Cart button','dfd-native'),
				'param_name' => 'post_show_add_to_cart',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Wishlist button','dfd-native'),
				'param_name' => 'post_show_wishlist',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the product info','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name' => 'post_content_alignment',
				'value' => 'text-center',
				'options' => array(
					esc_attr__('Left','dfd-native') => 'text-left',
					esc_attr__('Center','dfd-native') => 'text-center',
					esc_attr__('Right','dfd-native') => 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Box shadow settings', 'dfd-native'),
				'param_name'		=> 'border_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'carousel_mode', 'value_not_equal_to' => array('on')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the thumbnail','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
				'param_name'		=> 'box_shadow',
				'dependency'		=> array('element' => 'carousel_mode', 'value_not_equal_to' => array('on')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the thumbnail on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd-native'),
				'param_name'		=> 'hover_box_shadow',
				'dependency'		=> array('element' => 'carousel_mode', 'value_not_equal_to' => array('on')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_dots',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the pagination dots for your blog posts carousel','dfd-native').'</span></span>'.esc_html__('Pagination', 'dfd-native'),
				'value' => 'show',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'dependency' => array('element' => 'carousel_mode','value' => array('on')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array (
				'type' => 'radio_image_select',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 10 preset pagination styles','dfd-native').'</span></span>'.esc_html__('Pagination style', 'dfd-native'),
				'param_name' => 'dots_style',
				'simple_mode' => false,
				'value'=>'dfdroundedempty',
				'options' => array (
					'dfdrounded' => array (
						'tooltip' => esc_attr__('Rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_1.png'
					),
					'dfdfillrounded' => array (
						'tooltip' => esc_attr__('Filled rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_2.png'
					),
					'dfdemptyrounded' => array (
						'tooltip' => esc_attr__('Transparent rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_3.png'
					),
					'dfdfillsquare' => array (
						'tooltip' => esc_attr__('Filled square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
					),
					'dfdsquare' => array (
						'tooltip' => esc_attr__('Square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_6.png'
					),
					'dfdemptysquare' => array (
						'tooltip' => esc_attr__('Transparent square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_8.png'
					),
					'dfdline' => array (
						'tooltip' => esc_attr__('Line', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_4.png'
					),
					'dfdadvancesquare' => array (
						'tooltip' => esc_attr__('Advanced square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_5.png'
					),
					'dfdroundedempty' => array (
						'tooltip' => esc_attr__('Rounded Empty', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_9.png'
					),
					'dfdroundedfilled' => array (
						'tooltip' => esc_attr__('Rounded Filled', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_10.png'
					),
				),
				'dependency' => Array ('element' => 'use_dots', 'value' => array ('show')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Title', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'title_t_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'title_font_options',
				'settings'   => array(
					'fields'	=> array(
//						'tag'		=> 'div',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__( 'Custom font family', 'dfd-native' ),
				'param_name'  => 'title_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group'       => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_custom_fonts',
				'settings'   => array(
					'fields'	=> array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array('element' => 'title_google_fonts', 'value'   => 'yes'),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Subtitle', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'subtitle_t_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'subtitle_font_options',
				'settings'   => array(
					'fields'	=> array(
//						'tag'		=> 'div',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__( 'Custom font family', 'dfd-native' ),
				'param_name'  => 'subtitle_google_fonts',
				'value'		  => 'off',
				'options'	  => array(
					'yes'		=> array(
							'on'	=> 'Yes',
							'off'	=> 'No',
						),
					),
				'group'       => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'subtitle_custom_fonts',
				'settings'   => array(
					'fields'	=> array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array('element' => 'subtitle_google_fonts', 'value'   => 'yes'),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Price', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'price_t_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'price_font_options',
				'settings'   => array(
					'fields'	=> array(
//						'tag'		=> 'div',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__( 'Custom font family', 'dfd-native' ),
				'param_name'  => 'price_google_fonts',
				'value'		  => 'off',
				'options'	  => array(
					'yes'		=> array(
							'on'	=> 'Yes',
							'off'	=> 'No',
						),
					),
				'group'       => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'price_custom_fonts',
				'settings'   => array(
					'fields'	=> array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array('element' => 'price_google_fonts', 'value'   => 'yes'),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
		),
	)
);
