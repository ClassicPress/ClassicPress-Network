<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
class WPBakeryShortCode_Dfd_Single_Product extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/woo_single/';

vc_map(
	array(
		'name' => esc_html__('WooCommerce single product','dfd-native'),
		'base' => 'dfd_single_product',
		'class' => 'dfd_single_product dfd_shortcode',
		'icon' => 'dfd_single_product dfd_shortcode',
		'category' => esc_html__('Native','dfd-native'),
		'description' => esc_html__('Displays WooCommerce single product','dfd-native'),
		'params' => array(
			array(
				'type'        => 'radio_image_select',
				'heading'     => esc_html__( 'Style', 'dfd-native' ),
				'description' => '',
				'param_name'  => 'post_content_style',
				'simple_mode' => false,
				'options'     => array(
					'full' => array(
						'tooltip' => esc_attr__('Simple','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/woo_single/style-1.png'
					),
					'full_front' => array(
						'tooltip' => esc_attr__('Hovered','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/woo_single/style-2.png'
					),
				),
			),
			array(
				'heading'		=> esc_html__('Info Style', 'dfd-native'),
				'type'			=> 'radio_image_select',
				'param_name'	=> 'content_position',
				'simple_mode'	=> false,
				'value'			=> 'center-center',
				'options'		=> array(
					'center-top'		=> array(
						'tooltip'		=> esc_html__('Center top', 'dfd-native'),
						'src'			=> $module_images . 'style_8.png'
					),
					'center-center'		=> array(
						'tooltip'		=> esc_html__('Centered', 'dfd-native'),
						'src'			=> $module_images . 'style_7.png'
					),
					'center-bottom'		=> array(
						'tooltip'		=> esc_html__('Center bottom', 'dfd-native'),
						'src'			=> $module_images . 'style_9.png'
					),
					'left-top'		=> array(
						'tooltip'		=> esc_html__('Left top', 'dfd-native'),
						'src'			=> $module_images . 'style_1.png'
					),
					'left-center'		=> array(
						'tooltip'		=> esc_html__('Left center', 'dfd-native'),
						'src'			=> $module_images . 'style_2.png'
					),
					'left-bottom'		=> array(
						'tooltip'		=> esc_html__('Left bottom', 'dfd-native'),
						'src'			=> $module_images . 'style_3.png'
					),
					'right-top'		=> array(
						'tooltip'		=> esc_html__('Right top', 'dfd-native'),
						'src'			=> $module_images . 'style_4.png'
					),
					'right-center'		=> array(
						'tooltip'		=> esc_html__('Right center', 'dfd-native'),
						'src'			=> $module_images . 'style_5.png'
					),
					'right-bottom'		=> array(
						'tooltip'		=> esc_html__('Right bottom', 'dfd-native'),
						'src'			=> $module_images . 'style_6.png'
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
				'class'       => '',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__( 'Animation', 'dfd-native' ),
				'param_name'  => 'module_animation',
				'value'       => Dfd_Theme_Helpers::dfd_module_animation_styles(),
				'description' => '',
			),
			array(
				'type'        => 'textfield',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__( 'Custom CSS Class', 'dfd-native' ),
				'param_name'  => 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/woocommerce-single-product',
				'video_link'		=> 'https://www.youtube.com/watch?v=_RpPbX-ySNs&feature=youtu.be',
			),
			array(
				'type'		  => 'radio_image_post_select',
				'heading'	  => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the single product which should be displayed','dfd-native').'</span></span>'.esc_html__('Product to display','dfd-native'),
				'param_name'  => 'single_custom_post_item',
				'value'		  => '',
				'post_type'	  => 'product',
				'css'		  => array(
					'width'				=> '50px',
					'height'			=> '50px',
					'background-repeat' => 'repeat',
					'background-size'	=> 'cover' 
				),
				'show_default' => false,
				'group'        => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image type. You can choose the image from the media library or use the featured image of the product','dfd-native').'</span></span>'.esc_html__('Image type','dfd-native'),
				'param_name' => 'image_type',
				'value' => 'featured_image',
				'options' => array(
					esc_attr__('Product thumb','dfd-native') => 'featured_image',
					esc_attr__('Custom image','dfd-native') => 'media_library',
				),
				'group'        => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'attach_image',
				'heading' =>  '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image from the media library','dfd-native').'</span></span>'.esc_html__('Image','dfd-native'),
				'param_name' => 'custom_image',
				'group'        => esc_attr__( 'Content', 'dfd-native' ),
				'dependency' => array('element' => 'image_type','value' => array('media_library')),
			),
			array(
				'type'				=> 'number',
				'class'				=> '',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the product thumbnail','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name'		=> 'post_image_width',
				'value'				=> 600,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the product thumbnail','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name' => 'post_image_height',
				'value' => 600,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Content elements', 'dfd-native' ),
				'param_name'       => 'enabled_elements_heading',
				'group'            => esc_attr__( 'Content', 'dfd-native' ),
				'class'            => '',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Title','dfd-native'),
				'param_name' => 'post_show_title',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Subtitle','dfd-native'),
				'param_name' => 'post_show_subtitle',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
//			array(
//				'type' => 'dfd_single_checkbox',
//				'class' => '',
//				'heading' => esc_html__('Enable category','dfd-native'),
//				'param_name' => 'post_show_top_cat',
//				'value' => 'on',
//				'options' => array(
//					'on' => array(
//							'label' => '',
//							'on' => 'Yes',
//							'off' => 'No',
//						),
//					),
//				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
//				'group'      => esc_attr__( 'Content', 'dfd-native' ),
//				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
//			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Price','dfd-native'),
				'param_name' => 'post_show_price',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Rating','dfd-native'),
				'param_name' => 'post_show_rating',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
//			array(
//				'type' => 'dfd_single_checkbox',
//				'class' => '',
//				'heading' => esc_html__('Enable description','dfd-native'),
//				'param_name' => 'post_show_content',
//				'value' => 'on',
//				'options' => array(
//					'on' => array(
//							'label' => '',
//							'on' => 'Yes',
//							'off' => 'No',
//						),
//					),
//				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
//				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
//				'group'      => esc_attr__( 'Content', 'dfd-native' ),
//			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Add to cart button','dfd-native'),
				'param_name' => 'post_show_add_to_cart',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Lightbox','dfd-native'),
				'param_name' => 'post_show_lightbox',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
//			array(
//				'type' => 'dfd_single_checkbox',
//				'class' => '',
//				'heading' => esc_html__('Enable Wishlist button','dfd-native'),
//				'param_name' => 'post_show_wishlist',
//				'value' => 'on',
//				'options' => array(
//					'on' => array(
//							'label' => '',
//							'on' => 'Yes',
//							'off' => 'No',
//						),
//					),
//				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
//				'group'      => esc_attr__( 'Content', 'dfd-native' ),
//			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('OnSale badge','dfd-native'),
				'param_name' => 'post_show_sale',
				'value' => 'off',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
//			array(
//				'type' => 'dfd_single_checkbox',
//				'class' => '',
//				'heading' => esc_html__('Enable OutOfStock badge','dfd-native'),
//				'param_name' => 'post_show_stock',
//				'value' => 'on',
//				'options' => array(
//					'on' => array(
//							'label' => '',
//							'on' => 'Yes',
//							'off' => 'No',
//						),
//					),
//				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
//				'group'      => esc_attr__( 'Content', 'dfd-native' ),
//			),
			array(
				'type' => 'dfd_radio_advanced',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the product info','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name' => 'post_content_alignment',
				'value' => 'text-center',
				'options' => array(
					esc_attr__('Left','dfd-native') => 'text-left',
					esc_attr__('Center','dfd-native') => 'text-center',
					esc_attr__('Right','dfd-native') => 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the offset around the content. This option can be useful for side aligned elements.','dfd-native').'</span></span>'.esc_html__('Content offset', 'dfd-native'),
				'param_name' => 'content_padding',
				'min' => 0,
				'max' => 50,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
				'dependency' => array(
					'element' => 'post_content_style',
					'value'   => 'full',
				),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background color. The default value is #000 with the opacity 80%','dfd-native').'</span></span>'. esc_html__('Mask background', 'dfd-native'),
				'param_name'		=> 'mask_background',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
				'dependency' => array(
					'element' => 'post_content_style',
					'value'   => 'full_front',
				),
			),
			array(
				'type'				=> 'dfd_param_border',
				'heading'			=> esc_html__('Border around the product','dfd-native'),
				'param_name'		=> 'single_product_border',
				'simple'			=> false,
				'enable_radius'		=> false,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
				'value'				=> 'border_style:default',
				'dependency' => array(
					'element' => 'post_content_style',
					'value'   => 'full',
				),
				'group'				=> esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Title', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'title_t_heading',
				'group'            => esc_attr__( 'Typography', 'dfd-native' ),
				'class'            => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'title_font_options',
				'settings'   => array(
					'fields' => array(
						'tag' => 'h3',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'title_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'description' => '',
				'group'       => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_custom_fonts',
				'value'      => '',
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'dependency' => array(
					'element' => 'title_google_fonts',
					'value'   => 'yes',
				),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Subtitle', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'subtitle_t_heading',
				'group'            => esc_attr__( 'Typography', 'dfd-native' ),
				'class'            => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'subtitle_font_options',
				'settings'   => array(
					'fields' => array(
						'tag' => 'h4',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'subtitle_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'description' => '',
				'group'       => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'subtitle_custom_fonts',
				'value'      => '',
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'dependency' => array(
					'element' => 'subtitle_google_fonts',
					'value'   => 'yes',
				),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Price Typography', 'dfd-native' ),
				'param_name'       => 'price_t_heading',
				'group'            => esc_attr__( 'Typography', 'dfd-native' ),
				'class'            => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'price_font_options',
				'settings'   => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'price_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'description' => '',
				'group'       => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'price_custom_fonts',
				'value'      => '',
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'dependency' => array(
					'element' => 'price_google_fonts',
					'value'   => 'yes',
				),
			),
		),
	)
);