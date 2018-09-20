<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
class WPBakeryShortCode_Dfd_Products_Category extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/simple_banner/';

vc_map(
	array(
		'name' => esc_html__('WooCommerce products category','dfd-native'),
		'base' => 'dfd_products_category',
		'class' => 'dfd_products_category dfd_shortcode',
		'icon' => 'dfd_products_category dfd_shortcode',
		'category' => esc_html__('Native','dfd-native'),
		'description' => esc_html__('Displays WooCommerce products category','dfd-native'),
		'params' => array(
			array(
				'heading'		=> esc_html__('Style', 'dfd-native'),
				'type'			=> 'radio_image_select',
				'param_name'	=> 'content_style',
				'simple_mode'	=> false,
				'value'			=> 'style-1',
				'options'		=> array(
					'style-1'		=> array(
						'tooltip'		=> esc_html__('Left top', 'dfd-native'),
						'src'			=> $module_images . 'style_01.png'
					),
					'style-2'		=> array(
						'tooltip'		=> esc_html__('Left center', 'dfd-native'),
						'src'			=> $module_images . 'style_02.png'
					),
					'style-3'		=> array(
						'tooltip'		=> esc_html__('Left bottom', 'dfd-native'),
						'src'			=> $module_images . 'style_03.png'
					),
					'style-4'		=> array(
						'tooltip'		=> esc_html__('Right top', 'dfd-native'),
						'src'			=> $module_images . 'style_04.png'
					),
					'style-5'		=> array(
						'tooltip'		=> esc_html__('Right center', 'dfd-native'),
						'src'			=> $module_images . 'style_05.png'
					),
					'style-6'		=> array(
						'tooltip'		=> esc_html__('Right bottom', 'dfd-native'),
						'src'			=> $module_images . 'style_06.png'
					),
					'style-7'		=> array(
						'tooltip'		=> esc_html__('Centered', 'dfd-native'),
						'src'			=> $module_images . 'style_07.png'
					),
				),
			),
			array(
				'type' => 'radio_image_shop_category',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select category to display','dfd-native').'</span></span>'.esc_html__('Category to display','dfd-native'),
				'param_name' => 'category_id',
				'value' => '',
				'css' => array(
					'width' => '50px',
					'height' => '50px',
					'background-repeat' => 'repeat',
					'background-size' => 'cover' 
				),
				'show_default' => false,
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content', 'dfd-native'),
				'param_name'		=> 'content_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide the category title on the products category thumbnail','dfd-native').'</span></span>'.esc_html__('Category name','dfd-native'),
				'param_name' => 'show_category',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd-native'),
						'no'  => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'number',
				'class'				=> '',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the category title\' border radius','dfd-native').'</span></span>'.esc_html__('Category title border radius', 'dfd-native'),
				'param_name'		=> 'category_rounded',
				'min'				=> 0,
				'max'				=> 30,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'show_category','value' => array('yes')),
			),
			array(
				'type'				=> 'textarea',
				'heading'			=> esc_html__('Category title', 'dfd-native'),
				'param_name'		=> 'title_text',
				'value'				=> esc_html__('Category title','dfd-native'),
				'admin_label'		=> true,
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Category subtitle', 'dfd-native'),
				'param_name'		=> 'subtitle',
				'value'				=> esc_html__('Category subtitle','dfd-native'),
				'admin_label'		=> true,
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to display custom image as a products category thumbnail. The image from Products -> Categories is displayed by default, this option will override the default category image','dfd-native').'</span></span>'.esc_html__('Custom image','dfd-native'),
				'param_name' => 'enable_custom_image',
				'value' => 'no',
				'options' => array(
					'yes' => array(
						'yes' => esc_attr__('Yes', 'dfd-native'),
						'no'  => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image from the media library','dfd-native').'</span></span>'.esc_html__('Custom image','dfd-native'),
				'param_name'		=> 'custom_image',
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'enable_custom_image','value' => array('yes')),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Image size', 'dfd-native'),
				'param_name'		=> 'size_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'class'				=> '',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the category thumbnail','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name'		=> 'post_image_width',
				'value'				=> 600,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'class'				=> '',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the category thumbnail','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name'		=> 'post_image_height',
				'value'				=> 600,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Color settings', 'dfd-native'),
				'param_name'		=> 'background_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background color. The default value is #000 with the opacity 80%','dfd-native').'</span></span>'.esc_html__('Mask background', 'dfd-native'),
				'param_name'		=> 'mask_background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the category name. The default value is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Category name background', 'dfd-native'),
				'param_name'		=> 'category_background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Box shadow settings', 'dfd-native'),
				'param_name'		=> 'border_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the thumbnail','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
				'param_name'		=> 'box_shadow',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the thumbnail on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover', 'dfd-native'),
				'param_name'		=> 'hover_box_shadow',
				'group'				=> esc_html__('Style', 'dfd-native'),
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
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/woocommerce-products-category',
				'video_link' => 'https://www.youtube.com/watch?v=X0HcYmsMG4g&feature=youtu.be',
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
						'tag'		=> 'h3',
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
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'title_google_fonts',
				'value'		  => 'off',
				'options'	  => array(
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
						'font_family_description' => esc_html__( 'Select font family', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style', 'dfd-native' ),
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
						'tag'		=> 'div',
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
				'heading'     => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
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
		),
	)
);
