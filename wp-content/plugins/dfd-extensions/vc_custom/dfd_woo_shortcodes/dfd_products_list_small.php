<?php
if ( ! defined( 'ABSPATH' ) || !class_exists('WC_Widget_Products') ) { exit; }
/*
* Add-on Name: Blog posts
*/
class WPBakeryShortCode_Dfd_Products_List_Small extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_html__('WooCommerce products list small','dfd-native'),
		'base' => 'dfd_products_list_small',
		'class' => 'dfd_products_list_small dfd_shortcode',
		'icon' => 'dfd_products_list_small dfd_shortcode',
		'category' => esc_html__('Native','dfd-native'),
		'description' => esc_html__('Displays WooCommerce products','dfd-native'),
		'params' => array(
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'General options', 'dfd-native' ),
				'param_name'       => 'general_options_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
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
			),
			array(
				'type' => 'dfd_taxonomy_multicheck',
				'heading' => esc_html__('Categories','dfd-native'),
				'param_name' => 'post_categories',
				'taxonomy' => 'product_cat',
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-taxonomy-multicheck',
				'dependency' => array('element' => 'display', 'value' => 'categories'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of products which should be displayed','dfd-native').'</span></span>'.esc_html__('Products number','dfd-native'),
				'param_name' => 'posts_to_show',
				'value' => 3,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add border radius for product thumbnails','dfd-native').'</span></span>'.esc_html__('Thumb border radius', 'dfd-native'),
				'param_name' => 'thumb_radius',
				'value' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom dfd-number-wrap crum_vc',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Image dimentions', 'dfd-native' ),
				'param_name'       => 'image_size_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the product thumbnail width','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name' => 'image_width',
				'value' => 80,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom dfd-number-wrap crum_vc',
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the product thumbnail height','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name' => 'image_height',
				'value' => 80,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom dfd-number-wrap crum_vc',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Content elements', 'dfd-native' ),
				'param_name'       => 'enabled_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
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
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc',
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
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc',
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
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc',
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
				'edit_field_class' => 'vc_column vc_col-sm-3 crum_vc',
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/woocommerce-products-list-small',
				'video_link'		=> 'https://youtu.be/17gBSidGyGk',
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
						'font_size',
						'line_height',
						'letter_spacing',
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
						'font_size',
						'line_height',
						'letter_spacing',
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
						'font_size',
						'line_height',
						'letter_spacing',
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
