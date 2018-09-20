<?php

if (!defined('ABSPATH')) {
	exit;
}

class WPBakeryShortCode_Dfd_Simple_Advertisement extends WPBakeryShortCode {
	
}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/simple_banner/';
vc_map(
	array(
		'name' => esc_html__('Simple Advertisement', 'dfd-native'),
		'base' => 'dfd_simple_advertisement',
		"icon" => 'dfd_simple_advertisement dfd_shortcode',
		"class" => 'dfd_simple_advertisement dfd_shortcode',
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Advertisement as box with information', 'dfd-native'),
		'params' => array(
			array(
				'heading' => esc_html__('Style', 'dfd-native'),
				'type' => 'radio_image_select',
				'param_name' => 'style',
				'simple_mode' => false,
				'options' => array(
					'style-1' => array(
						'tooltip' => esc_html__('Left top', 'dfd-native'),
						'src' => $module_images . 'style_01.png'
					),
					'style-2' => array(
						'tooltip' => esc_html__('Left center', 'dfd-native'),
						'src' => $module_images . 'style_02.png'
					),
					'style-3' => array(
						'tooltip' => esc_html__('Left bottom', 'dfd-native'),
						'src' => $module_images . 'style_03.png'
					),
					'style-4' => array(
						'tooltip' => esc_html__('Right top', 'dfd-native'),
						'src' => $module_images . 'style_04.png'
					),
					'style-5' => array(
						'tooltip' => esc_html__('Right center', 'dfd-native'),
						'src' => $module_images . 'style_05.png'
					),
					'style-6' => array(
						'tooltip' => esc_html__('Right bottom', 'dfd-native'),
						'src' => $module_images . 'style_06.png'
					),
					'style-7' => array(
						'tooltip' => esc_html__('Centered', 'dfd-native'),
						'src' => $module_images . 'style_07.png'
					),
				),
					'value'=> 'style-1'
			),
			array(
				'type' => 'attach_image',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Image', 'dfd-native'),
				'param_name' => 'image',
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the image width','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name' => 'img_width',
				'min' => 0,
				'std' => '400',
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-top-padding',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the image height','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name' => 'img_height',
				'min' => 0,
				'std' => '350',
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-top-padding',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Title', 'dfd-native'),
				'param_name' => 'title',
				'admin_label' => true,
				'value'=> esc_html__('Title', 'dfd-native'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Subtitle', 'dfd-native'),
				'param_name' => 'subtitle',
				'value'=>esc_html__('Subtitle', 'dfd-native'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('info', 'dfd-native'),
				'param_name' => 'info',
				'value'=>esc_html__('info', 'dfd-native'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the info background color. The default background color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Info background', 'dfd-native') . ' ' . esc_html__('color', 'dfd-native'),
				'param_name' => 'info_block_background_color',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Style', 'dfd'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border radius for the info. The default value is 4px','dfd-native').'</span></span>'.esc_html__('Info border radius', 'dfd-native'),
				'param_name' => 'info_block_border_radius',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-top-padding',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the left/right offset for the info. The default value is 10px','dfd-native').'</span></span>'.esc_html__('Left/right offset', 'dfd-native'),
				'param_name' => 'info_block_left_right_padding',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'			=> 'dfd_radio_advanced',
				'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the visibility options for shadow','dfd').'</span></span>'.esc_html__('Shadow visibility', 'dfd'),
				'param_name'	=> 'shadow',
				'value'			=> 'disable',
				'options'		=> array(
					esc_html__('Disable', 'dfd')	=> 'disable',
					esc_html__('Permanent', 'dfd')  => 'permanent',
					esc_html__('On hover', 'dfd')	=> 'on-hover'
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_attr__('Style', 'dfd'),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '',
				'param_name'		=> 'sa_box_shadow',
				'value'				=> 'box_shadow_enable:enable|shadow_horizontal:0|shadow_vertical:25|shadow_blur:70|shadow_spread:0|box_shadow_color:rgba(0%2C0%2C0%2C0.5)',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-shadow-button-hide',
				'dependency'		=> array('element' => 'shadow', 'value' => array('permanent', 'on-hover')),
				'group' => esc_attr__('Style', 'dfd'),
			),
			array(
				'type' => 'vc_link',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd-native').'</span></span>'.esc_html__('Add link', 'dfd-native'),
				'param_name' => 'link',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			/* ----------------------------- */
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Main hover settings', 'dfd-native'),
				'param_name' => 'hover_main_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the hover for the advertisement','dfd-native').'</span></span>'.esc_html__('Hover', 'dfd-native'),
				'param_name' => 'portfolio_hover_enable',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to select the hover effect for the mask appearing','dfd-native').'</span></span>'.esc_html__('Mask appear effect', 'dfd-native'),
				'param_name' => 'portfolio_hover_appear_effect',
				'value' => array(
					esc_attr__('Fade out', 'dfd-native') => 'dfd-fade-out',
					esc_attr__('Left to right', 'dfd-native') => 'dfd-left-to-right',
					esc_attr__('Right to left', 'dfd-native') => 'dfd-right-to-left',
					esc_attr__('Top to bottom', 'dfd-native') => 'dfd-top-to-bottom',
					esc_attr__('Bottom to top', 'dfd-native') => 'dfd-bottom-to-top',
					esc_attr__('Following the mouse', 'dfd-native') => 'portfolio-hover-style-1',
				),
				'dependency' => array('element' => 'portfolio_hover_enable', 'value' => array('on')),
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image behavior on hover','dfd-native').'</span></span>'.esc_html__('Image hover effect', 'dfd-native'),
				'param_name' => 'image_effect',
				'std' => '',
				'value' => array(
					esc_attr__('Image parallax', 'dfd-native') => 'panr',
					esc_attr__('Grow', 'dfd-native') => 'dfd-image-scale',
					esc_attr__('Grow with rotation', 'dfd-native') => 'dfd-image-scale-rotate',
					esc_attr__('Shift left', 'dfd-native') => 'dfd-image-shift-left',
					esc_attr__('Shift right', 'dfd-native') => 'dfd-image-shift-right',
					esc_attr__('Shift top', 'dfd-native') => 'dfd-image-shift-top',
					esc_attr__('Shift bottom', 'dfd-native') => 'dfd-image-shift-bottom',
					esc_attr__('Blur', 'dfd-native') => 'dfd-image-blur',
				),
				'dependency' => array(
					'element' => 'portfolio_hover_appear_effect',
					'value' => array(
						'dfd-fade-out', 'dfd-fade-offset', 'dfd-left-to-right', 'dfd-right-to-left', 'dfd-top-to-bottom', 'dfd-bottom-to-top'
					)
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Hover mask settings', 'dfd-native'),
				'param_name' => 'hover_deco_heading',
				'dependency' => array('element' => 'portfolio_hover_enable', 'value' => array('on')),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background style, you can choose simple color or gradient','dfd-native').'</span></span>'.esc_html__('Hover mask background style', 'dfd-native'),
				'param_name' => 'portfolio_hover_mask_background_style',
				'options' => array(
					esc_attr__('Simple color', 'dfd-native') => 'simple-color',
					esc_attr__('Gradient', 'dfd-native') => 'gradient',
				),
				'value'		=> 'simple-color',
				'dependency' => array('element' => 'portfolio_hover_enable', 'value' => array('on')),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover mask background opacity','dfd-native').'</span></span>'. esc_html__('Hover mask background opacity', 'dfd-native'),
				'value' => 50,
				'min' => 1,
				'max' => 100,
				'param_name' => 'portfolio_hover_mask_background_opacity',
				'dependency' => array('element' => 'portfolio_hover_enable', 'value' => array('on')),
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-percent crum_vc',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background color. The default value is rgba(0,0,0,0.7)','dfd-native').'</span></span>'.esc_html__('Mask background', 'dfd-native'),
				'param_name' => 'portfolio_hover_mask_background',
				'dependency' => array('element' => 'portfolio_hover_mask_background_style', 'value' => array('simple-color')),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'portfolio_hover_mask_bg_start_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the mask background gradient. The default value is rgba(0,0,0,0.7)','dfd-native').'</span></span>'.esc_html__('Start color', 'dfd-native'),
				'dependency' => array('element' => 'portfolio_hover_mask_background_style', 'value' => array('gradient')),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'group' => esc_attr__('Hover', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'portfolio_hover_mask_bg_end_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the mask background gradient. The default value is rgba(0,0,0,0.7)','dfd-native').'</span></span>'.esc_html__('End color', 'dfd-native'),
				'dependency' => array('element' => 'portfolio_hover_mask_background_style', 'value' => array('gradient')),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_attr__('Hover', 'dfd-native'),
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/simple-advertisement',
				'video_link' => 'https://youtu.be/p1ruuk38e0s',
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Title', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'title_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'title_font_options',
				'settings' => array(
					'fields' => array(
						'tag' => 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts_title',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_title',
				'value' => 'font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_title',
					'value' => 'show',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Subtitle', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'subtitle_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'subtitle_font_options',
				'settings' => array(
					'fields' => array(
						'tag' => 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts_subtitle',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_subtitle',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_subtitle',
					'value' => 'show',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Info block', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'content_t_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'info_font_options',
				'settings' => array(
					'fields' => array(
						'tag' => 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text transform for the info. The default value is Uppercase','dfd-native').'</span></span>'.esc_html__('Text transform', 'dfd-native'),
				'param_name' => 'info_text_transform',
				'value' => 'uppercase',
				'options' => array(
					esc_html__('Uppercase', 'dfd-native')	=> 'uppercase',
					esc_html__('Capitalize', 'dfd-native')	=> 'capitalize',
					esc_html__('Lowercase', 'dfd-native')	=> 'lowercase',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts_info',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'value' => 'show',
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_info',
				'value' => 'font_family:Montserrat%3Aregular%2C700|font_style:400%20regular%3A400%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_info',
					'value' => 'show',
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_param_responsive_text',
				'heading' => esc_html__('Title responsive settings', 'dfd-native'),
				'param_name' => 'title_responsive',
				'edit_field_class' => 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group' => esc_attr__('Responsive', 'dfd-native'),
			),
		),
	)
);
