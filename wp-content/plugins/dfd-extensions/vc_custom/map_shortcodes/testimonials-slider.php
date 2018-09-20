<?php

if (!defined('ABSPATH')) {
	exit;
}

class WPBakeryShortCode_Dfd_Testimonials_Slider extends WPBakeryShortCode {
	
}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/testimonials_slider/';

vc_map(
	array(
		'name' => esc_html__('Testimonials slider', 'dfd-native'),
		'base' => 'dfd_testimonials_slider',
		'icon' => 'dfd_testimonials_slider dfd_shortcode',
		'class' => 'dfd_testimonials_slider dfd_shortcode',
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Display slider of your clients testimonials', 'dfd-native'),
		'params' => array_merge(array(
			array(
				'heading' => esc_html__('Style', 'dfd-native'),
				'type' => 'radio_image_select',
				'param_name' => 'main_layout',
				'simple_mode' => false,
				'options' => array(
					'layout-1' => array(
						'tooltip' => esc_attr__('Simple', 'dfd-native'),
						'src' => $module_images . 'testimonials_01.png'
					),
					'layout-2' => array(
						'tooltip' => esc_attr__('Centered', 'dfd-native'),
						'src' => $module_images . 'testimonials_02.png'
					),
					'layout-3' => array(
						'tooltip' => esc_attr__('Full width', 'dfd-native'),
						'src' => $module_images . 'testimonials_03.png'
					),
				),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the author image above or below the testimonial','dfd-native').'</span></span>'.esc_html__('Image position', 'dfd-native'),
				'param_name' => 'style',
				'value' => 'above',
				'options' => array(
					esc_html__('Above content', 'dfd-native') => 'above',
					esc_html__('Below content', 'dfd-native') => 'below',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the content horizontally','dfd-native').'</span></span>'.esc_html__('Content alignment', 'dfd-native'),
				'param_name' => 'align',
				'value' => 'center',
				'options' => array(
					esc_html__('Left', 'dfd-native') => 'left',
					esc_html__('Center', 'dfd-native') => 'center',
					esc_html__('Right', 'dfd-native') => 'right',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'title_subtitle_nowrap',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the title and the subtitle in one line, first title then subtitle','dfd-native').'</span></span>'.esc_html__('One line title', 'dfd-native'),
				'options' => array(
					'nowrap' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__('Testimonials', 'dfd-native'),
				'param_name' => 'testimonials',
				'params' => array(
					array(
						"type" => "attach_image",
						"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the testimonial author image','dfd-native').'</span></span>'.esc_html__('Author image', 'dfd-native'),
						"param_name" => 'client_photo',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Title', 'dfd-native'),
						'param_name' => 'title',
						'admin_label' => true,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Subtitle', 'dfd-native'),
						'param_name' => 'subtitle',
						'admin_label' => true,
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('Testimonial', 'dfd-native'),
						'param_name' => 'testimonial_text',
					),
				),
				'value'=>"%5B%7B%22title%22%3A%22TITLE%22%2C%22subtitle%22%3A%22SUBTITLE%22%2C%22testimonial_text%22%3A%22Please%20add%20some%20review%20text%20in%20admin%20panel%22%7D%5D",
				'group' => esc_html__('Slides', 'dfd-native')
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/testimonials-slider',
				'video_link' => 'https://youtu.be/JJg7v2tnzqw',
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the dragging of the carousel\'s slides','dfd-native').'</span></span>'.esc_html__('Draggable effect', 'dfd-native'),
				'param_name' => 'draggable',
				'value' => 'true',
				'options' => array(
					'true' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_html__('Slider settings', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the carousel','dfd-native').'</span></span>'.esc_html__('Autoplay‏', 'dfd-native'),
				'param_name' => 'autoplay',
				'value' => 'show',
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
				'group' => esc_html__('Slider settings', 'dfd-native')
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the autoplay','dfd-native').'</span></span>'.esc_html__('Autoplay Speed', 'dfd-native'),
				'param_name' => 'autoplay_speed',
				'dependency' => array('element' => 'autoplay', 'value' => array('show')),
				'value' => '5000',
				'min' => '1000',
				'max' => '10000',
				'step' => '200',
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-ml-second crum_vc',
				'group' => esc_html__('Slider settings', 'dfd-native')
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Author thumbnail', 'dfd-native'),
				'param_name' => 'thumb_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show the shadow for the testimonial image','dfd-native').'</span></span>'.esc_html__('Shadow', 'dfd-native'),
				'param_name' => 'shadow',
				'value' => 'show',
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the size for the author\'s image','dfd-native').'</span></span>'.esc_html__('Image size', 'dfd-native'),
				'param_name' => 'thumb_size',
				'min' => 80,
				'edit_field_class' => 'no-border-bottom vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the border radius for the author\'s image','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name' => 'thumb_radius',
				'min' => 0,
				'edit_field_class' => 'no-border-bottom vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
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
				'param_name' => 'use_google_fonts',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'value' => array(esc_html__('Yes', 'dfd-native') => ''),
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
				'param_name' => 'custom_fonts',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font styling.', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts',
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
				'value' => array(esc_html__('Yes', 'dfd-native') => ''),
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
						'font_style_description' => esc_html__('Select font styling.', 'dfd-native'),
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
				'text' => esc_html__('Content', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'content_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'font_options',
				'settings' => array(
					'fields' => array(
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
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Testimonial background', 'dfd-native'),
				'param_name' => 'bg_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the background color for the testimonial','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name' => 'bg_testim_block_color',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify the border radius for the testimonial','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name' => 'bg_radius',
				'min' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show the triangle pointer to the testimonial image (shows only if content background color is selected).','dfd-native').'</span></span>'.esc_html__('Triangle pointer', 'dfd-native'),
				'param_name' => 'show_triangle',
				'value' => array(esc_html__('Yes', 'dfd-native') => 'show'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_attr__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts_testimonial',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'value' => array(esc_html__('Yes', 'dfd-native') => ''),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_dots',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the pagination for the slider.','dfd-native').'</span></span>'.esc_html__('Pagination', 'dfd-native'),
				'value' => array(esc_html__('Yes', 'dfd-native') => 'show'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array(
				'type' => 'radio_image_select',
				'heading' => esc_html__('Pagination style', 'dfd-native'),
				'param_name' => 'dots_style',
				'simple_mode' => false,
				'value' => 'dfdrounded',
				'options' => array(
					'dfdrounded' => array(
						'tooltip' => esc_attr__('Rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_1.png'
					),
					'dfdfillrounded' => array(
						'tooltip' => esc_attr__('Filled rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_2.png'
					),
					'dfdemptyrounded' => array(
						'tooltip' => esc_attr__('Transparent rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_3.png'
					),
					'dfdfillsquare' => array(
						'tooltip' => esc_attr__('Filled square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
					),
					'dfdsquare' => array(
						'tooltip' => esc_attr__('Square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_6.png'
					),
					'dfdemptysquare' => array(
						'tooltip' => esc_attr__('Transparent square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_8.png'
					),
					'dfdline' => array(
						'tooltip' => esc_attr__('Line', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_4.png'
					),
					'dfdadvancesquare' => array(
						'tooltip' => esc_attr__('Advanced square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_5.png'
					),
					'dfdroundedempty' => array(
						'tooltip' => esc_attr__('Rounded Empty', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_9.png'
					),
					'dfdroundedfilled' => array(
						'tooltip' => esc_attr__('Rounded Filled', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_10.png'
					),
				),
				'dependency' => Array('element' => 'use_dots', 'value' => array('show')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_testimonial',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_testimonial',
					'value' => 'show',
				),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
				array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_nav',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the pagination for the slider.','dfd-native').'</span></span>'.esc_html__('Use Navigation', 'dfd-native'),
				'value' => array(esc_html__('Yes', 'dfd-native') => 'show'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'main_layout',
					'value' => array("layout-1", "layout-2")
				),
				'group' => esc_html__('Navigation Style', 'dfd-native'),
			),
			), Dfd_Theme_Slier_Helper::build_paarms(array(
				"element" => "use_nav",
				'value' => array("show")
			), DFD_EXTENSIONS_PLUGIN_URL)
		)
	)
);
