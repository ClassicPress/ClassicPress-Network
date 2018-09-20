<?php

if (!defined('ABSPATH')) {
	exit;
}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/letter_effects/';

class WPBakeryShortCode_Dfd_Letter_Effects extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_html__('Animated Letters', 'dfd-native'),
		'base' => 'dfd_letter_effects',
		'class' => 'dfd_letter_effects dfd_shortcode',
		'icon' => 'dfd_letter_effects dfd_shortcode',
		'controls' => 'full',
		'show_settings_on_create' => true,
		'description' => esc_html__('Animated letters with different appear effects', 'dfd-native'),
		'category' => esc_html__('Native', 'dfd-native'),
		'params' => array(
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Style', 'dfd-native'),
				'param_name' => 'main_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type' => 'radio_image_select',
				'heading' => '', //esc_html__( 'Animation tyle', 'dfd-native' ),
				'param_name' => 'style',
				'simple_mode' => false,
				'options' => array(
					'style-1' => array(
						'tooltip' => esc_attr__('Jump up', 'dfd-native'),
						'src' => $module_images . 'style-1.png'
					),
					'style-2' => array(
						'tooltip' => esc_attr__('Fade away', 'dfd-native'),
						'src' => $module_images . 'style-2.png'
					),
					'style-3' => array(
						'tooltip' => esc_attr__('Slide left ', 'dfd-native'),
						'src' => $module_images . 'style-3.png'
					),
					'style-4' => array(
						'tooltip' => esc_attr__('Jump down', 'dfd-native'),
						'src' => $module_images . 'style-4.png'
					),
					'style-5' => array(
						'tooltip' => esc_attr__('Letter\'s flip', 'dfd-native'),
						'src' => $module_images . 'style-5.png'
					),
					'style-6' => array(
						'tooltip' => esc_attr__('Word\'s flip', 'dfd-native'),
						'src' => $module_images . 'style-6.png'
					),
					'style-7' => array(
						'tooltip' => esc_attr__('Vertical flip', 'dfd-native'),
						'src' => $module_images . 'style-7.png'
					),
					'style-8' => array(
						'tooltip' => esc_attr__('Colored Slide', 'dfd-native'),
						'src' => $module_images . 'style-8.png'
					),
				),
				'value'=> "style-1"
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=>  '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the words horizontally','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'alignment',
				'value'				=> 'title-centered',
				'options' => array(
					esc_attr__('Left', 'dfd-native')	=> 'title-left',
					esc_attr__('Center', 'dfd-native') => 'title-centered',
					esc_attr__('Right', 'dfd-native')	=> 'title-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12',
				'dependency'	=> array('element' => 'style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4'))
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the words horizontally','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'exception_alignment',
				'value'				=> 'title-centered',
				'options' => array(
					esc_attr__('Left', 'dfd-native')	=> 'title-left',
					esc_attr__('Center', 'dfd-native') => 'title-centered',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12',
				'dependency'	=> array('element' => 'style', 'value' => array('style-5', 'style-6', 'style-7'))
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the element', 'dfd-native') . '</span></span>' . esc_html__('Animation', 'dfd-native'),
				'param_name' => 'module_animation',
				'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/animated-letters',
				'video_link'		=> 'https://www.youtube.com/watch?v=Fq2bFb1zAWU&feature=youtu.be',
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Content settings', 'dfd-native'),
				'param_name' => 'content_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('Animated text string', 'dfd-native'),
				'param_name'		=> 'text_fields',
				'params'			=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Single string', 'dfd-native'),
						'admin_label'	=> true,
						'param_name'	=> 'text_field',
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('String color', 'dfd-native'),
						'param_name'	=> 'text_field_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					),
				),
				'value'				=> "%5B%7B%22text_field%22%3A%22awesome%22%2C%22text_field_color%22%3A%22%231e73be%22%7D%2C%7B%22text_field%22%3A%22amazing%22%2C%22text_field_color%22%3A%22%231e73be%22%7D%5D",
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Color settings', 'dfd-native'),
				'param_name' => 'colors_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'style', 'value' => 'style-8'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the slide. The default color is #e24b1e','dfd-native').'</span></span>'.esc_html__('Slide color', 'dfd-native'),
				'param_name'		=> 'effect_bg',
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'style', 'value' => 'style-8'),
				'group'				=> esc_html__('Content','dfd-native')
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Typography settings', 'dfd-native'),
				'param_name' => 'typography_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'title_font_options',
				'settings' => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style'
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name' => 'title_google_fonts',
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'title_custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'title_google_fonts', 'value' => 'show'),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Title responsive settings', 'dfd-native'),
				'value'				=> 'font_size_tablet:40|line_height_tablet:45|font_size_mobile:30|line_height_mobile:38',
				'param_name'		=> 'title_responsive',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group'				=> esc_html__('Responsive', 'dfd-native'),
			),
		)
	)
);