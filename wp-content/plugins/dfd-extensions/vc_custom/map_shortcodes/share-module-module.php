<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Add-on Name: Share Module
 */

class WPBakeryShortCode_Dfd_New_Share_Module extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/share_module/';
vc_map(
	array(
		'name' => esc_html__('Share us', 'dfd-native'),
		'base' => 'dfd_new_share_module',
		'class' => 'dfd_share_module dfd_shortcode',
		'icon' => 'dfd_share_module dfd_shortcode',
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Displays social share', 'dfd-native'),
		'params' => array(
			array(
				'heading' => esc_html__('Style', 'dfd-native'),
				'type' => 'radio_image_select',
				'param_name' => 'main_style',
				'simple_mode'		=> false,
				'options' => array(
					'style-1'	=> array(
						'tooltip'	=> esc_attr__('Standard','dfd-native'),
						'src'		=> $module_images . 'share-21.png'
					),
					'style-2'	=> array(
						'tooltip'	=> esc_attr__('Standard colored','dfd-native'),
						'src'		=> $module_images . 'share-22.png'
					),
					'style-3'	=> array(
						'tooltip'	=> esc_attr__('Separated','dfd-native'),
						'src'		=> $module_images . 'share-23.png'
					),
					'style-4'	=> array(
						'tooltip'	=> esc_attr__('Separated colored','dfd-native'),
						'src'		=> $module_images . 'share-24.png'
					),
					'style-5'	=> array(
						'tooltip'	=> esc_attr__('Text','dfd-native'),
						'src'		=> $module_images . 'share-25.png'
					),
					'style-6'	=> array(
						'tooltip'	=> esc_attr__('Circle','dfd-native'),
						'src'		=> $module_images . 'share-27.png'
					),
					'style-7'	=> array(
						'tooltip'	=> esc_attr__('Circle colored','dfd-native'),
						'src'		=> $module_images . 'share-26.png'
					),
					'style-8'	=> array(
						'tooltip'	=> esc_attr__('Background change','dfd-native'),
						'src'		=> $module_images . 'share-28.png'
					),

				),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Facebook', 'dfd-native'),
				'param_name' => 'enable_facebook_share',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_html__('Social Networks', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Twitter', 'dfd-native'),
				'param_name' => 'enable_twitter_share',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_html__('Social Networks', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Google Plus', 'dfd-native'),
				'param_name' => 'enable_googleplus_share',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_html__('Social Networks', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Linked-IN', 'dfd-native'),
				'param_name' => 'enable_linkedin_share',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_html__('Social Networks', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Pinterest', 'dfd-native'),
				'param_name' => 'enable_pinterest_share',
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_html__('Social Networks', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the share','dfd-native').'</span></span>'.esc_html__('Block height', 'dfd-native'),
				'param_name' => 'single_share_height',
				'min' => 20,
				'max' => 500,
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4')),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the style for the general border','dfd-native').'</span></span>'.esc_html__('General border style', 'dfd-native'),
				'param_name' => 'general_border_style',
				'value' => array(
					esc_html__('None', 'dfd-native') => '',
					esc_html__('Solid', 'dfd-native') => 'solid',
					esc_html__('Dashed', 'dfd-native') => 'dashed',
					esc_html__('Dotted', 'dfd-native') => 'dotted',
					esc_html__('Double', 'dfd-native') => 'double',
					esc_html__('Inset', 'dfd-native') => 'inset',
					esc_html__('Outset', 'dfd-native') => 'outset',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-1')),
			),
			array(
				'type' => 'number',
				'heading' => esc_html__('General border width', 'dfd-native'),
				'param_name' => 'general_border_width',
				'value' => '1',
				'min' => 0,
				'max' => 10,
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'general_border_style', 'not_empty' => true),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('General Border Color', 'dfd-native'),
				'param_name' => 'general_border_color',
				'value' => '#cdcdcd',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'general_border_style', 'not_empty' => true),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the share. The border radius is not set by default','dfd-native').'</span></span>'.esc_html__('Border Radius', 'dfd-native'),
				'param_name' => 'single_border_radius',
				'min' => 0,
				'max' => 100,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding dfd-number-wrap crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-3', 'style-4', 'style-6', 'style-7')),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the social networks\' titles','dfd-native').'</span></span>'.esc_html__('Font Size', 'dfd-native'),
				'param_name' => 'single_font_size',
				'min' => 5,
				'max' => 70,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding dfd-number-wrap crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-5', 'style-6', 'style-7', 'style-8')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => esc_html__('Position of the elements', 'dfd-native'),
				'param_name' => 'position_elements',
				'value'		=> 'horizontal',
				'options' => array(
					esc_html__('Horizontal', 'dfd-native')	=> 'horizontal',
					esc_html__('Vertical', 'dfd-native') => 'vertical',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-8')),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the top and bottom spacer','dfd-native').'</span></span>'.esc_html__('Top and bottom spacer', 'dfd-native'),
				'param_name' => 'top_bottom_spacer',
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-8')),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the left and right spacer','dfd-native').'</span></span>'.esc_html__('Left and right spacer', 'dfd-native'),
				'param_name' => 'left_right_spacer',
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'position_elements', 'value' => array('vertical')),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the diameter for the share. The default size is 70px','dfd-native').'</span></span>'.esc_html__('Share Diameter', 'dfd-native'),
				'param_name' => 'single_diameter',
				'min' => 10,
				'max' => 500,
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-6', 'style-7')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => esc_html__('Border Style', 'dfd-native'),
				'param_name' => 'single_border_style',
				'value'		=> 'solid',
				'options' => array(
					esc_html__('Solid', 'dfd-native') => 'solid',
					esc_html__('Dashed', 'dfd-native') => 'dashed',
					esc_html__('Dotted', 'dfd-native') => 'dotted',
					esc_html__('Double', 'dfd-native') => 'double',
					esc_html__('Inset', 'dfd-native') => 'inset',
					esc_html__('Outset', 'dfd-native') => 'outset',
					esc_html__('None', 'dfd-native') => 'none',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-6')),
			),
			array(
				'type' => 'number',
				'heading' => esc_html__('Border width', 'dfd-native'),
				'param_name' => 'single_border_width',
				'value' => '1',
				'min' => 0,
				'max' => 10,
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'single_border_style', 'value_not_equal_to' => 'none'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Border color', 'dfd-native'),
				'param_name' => 'single_border_color',
				'value' => '#cdcdcd',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'single_border_style', 'value_not_equal_to' => 'none'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Background color', 'dfd-native'),
				'param_name' => 'single_background_color',
				'value' => 'transparent',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-6')),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Color', 'dfd-native'),
				'param_name' => 'single_color',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'main_style', 'value' => array('style-6')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the share','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name' => 'element_vertical_alignment',
				'value'	 => 'text-center',
				'options' => array(
					esc_html__('Left', 'dfd-native') => 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_html__('Style decoration', 'dfd-native'),
				'dependency' => array('element' => 'position_elements', 'value' => array('vertical')),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the social networks\' titles','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name' => 'element_alignment',
				'value'	 => 'text-center',
				'options' => array(
					esc_html__('Left', 'dfd-native') => 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
				'dependency' => array('element' => 'main_style', 'value' => array('style-5', 'style-6', 'style-7')),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name' => 'module_animation',
				'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
			),
			array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/share-us',
				'video_link' => 'https://www.youtube.com/watch?v=NkJBJvKLlbc&feature=youtu.be',
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'title_font_options',
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
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the uppercase for the social network name','dfd-native').'</span></span>'.esc_html__('Uppercase', 'dfd-native'),
				'param_name' => 'share_uppercouse',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
				'edit_field_class'	=> 'vc_col-sm-3',
				'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-8')),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'title_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class'	=> 'vc_col-sm-9',
				'group'       => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_custom_fonts',
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
				'edit_field_class'	=> 'vc_col-sm-12 no-top-margin',
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_param_responsive_text',
				'heading' => esc_html__('Responsive settings', 'dfd-native'),
				'param_name' => 'title_responsive',
				'group' => esc_attr__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
			),
		),
	)
);