<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Twitter module
*/

class WPBakeryShortCode_Dfd_Twitter extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/twitter/';
vc_map(
	array(
		'name'					=> esc_html__('Twitter','dfd-native'),
		'base'					=> 'dfd_twitter',
		'class'					=> 'dfd_twitter dfd_shortcode',
		'icon'					=> 'dfd_twitter dfd_shortcode',
		'category'				=> esc_html__('Native','dfd-native'),
		'description'			=> esc_html__('Displays recent tweets carousel', 'dfd-native'),
		'params'				=> array(
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Please make sure that you have all necessary options filled in Twitter options section of ', 'dfd-native').'<a href="'.admin_url('admin.php?page=native').'" target="_blank">'.esc_html__('Theme options panel', 'dfd-native').'</a> '.esc_html__(' before using this module.', 'dfd-native'),
				'param_name'		=> 'main_heading_typograpy',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Top icon','dfd-native'),
						'src'				=> $module_images . 'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Bottom icon','dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('Top aside icon','dfd-native'),
						'src'				=> $module_images . 'style-3.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide the author\'s information','dfd-native').'</span></span>'.esc_html__('Author info', 'dfd-native'),
				'param_name'		=> 'author_info',
				'value'				=> 'enable_info',
				'options'			=> array(
					'enable_info'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-3',
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide the icon','dfd-native').'</span></span>'.esc_html__('Enable icon', 'dfd-native'),
				'param_name'		=> 'icon_info',
				'value'				=> 'enable_icon',
				'options'			=> array(
					'enable_icon'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-3',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the tweet horizontally','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name'		=> 'text_alignment',
				'value'				=> '',
				'options'			=> array(
					esc_html__('Left','dfd-native')				=> 'text-left',
					esc_html__('Center','dfd-native')				=> '',
					esc_html__('Right','dfd-native')				=> 'text-right'
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2')),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the tweet horizontally','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name'		=> 'text_alignment_3',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left','dfd-native')				=> 'text-left',
					esc_html__('Right','dfd-native')				=> 'text-right'
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name'		=> 'module_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'		=> 'el_class',
			),
			array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/twitter-feed',
				'video_link' => 'https://www.youtube.com/watch?v=0XeTMK9qHrQ&feature=youtu.be',
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to show','dfd-native').'</span></span>'.esc_html__('Number of slides to display', 'dfd-native'),
				'param_name'		=> 'slides_to_show',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to scroll','dfd-native').'</span></span>'.esc_html__('Number of slides to scroll', 'dfd-native'),
				'param_name'		=> 'slides_to_scroll',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd-native').'</span></span>'.esc_html__('Slideshow speed', 'dfd-native'),
				'param_name'		=> 'slideshow_speed',
				'value'				=> 3000,
				'group'				=> esc_html__('Sliding', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the slider','dfd-native').'</span></span>'.esc_html__('Auto slideshow', 'dfd-native'),
				'param_name'		=> 'auto_slideshow',
				'options'			=> array(
					'auto_slid'			=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the dots navigation','dfd-native').'</span></span>'.esc_html__('Dots navigation', 'dfd-native'),
				'param_name'		=> 'enable_dots',
				'options'			=> array(
					'dots'				=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type' => 'radio_image_select',
				'heading' => esc_html__('Pagination style', 'dfd-native'),
				'description' => '',
				'param_name' => 'dots_style',
				'simple_mode' => false,
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
						'tooltip' => esc_attr__('Square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
					),
					'dfdsquare' => array(
						'tooltip' => esc_attr__('Filled square', 'dfd-native'),
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
				'dependency'		=> array('element' => 'enable_dots', 'value' => array('dots')),
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Author Title Typography', 'dfd-native'),
				'param_name'		=> 'author_t_heading',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array('element' => 'author_info', 'value' => 'enable_info'),
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'author_t_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style',
					),
				),
				'dependency'		=> array('element' => 'author_info', 'value' => 'enable_info'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'author_t_use_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'author_info', 'value' => 'enable_info'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'author_t_custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'author_t_use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Author Subtitle Typography', 'dfd-native'),
				'param_name'		=> 'author_st_heading',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array('element' => 'author_info', 'value' => 'enable_info'),
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'author_st_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style',
					),
				),
				'dependency'		=> array('element' => 'author_info', 'value' => 'enable_info'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'author_st_use_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'author_info', 'value' => 'enable_info'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'author_st_custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'author_st_use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style',
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'use_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Icon Decoration', 'dfd-native'),
				'param_name'		=> 'icon_t_decoration',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array('element' => 'icon_info', 'value' => 'enable_icon'),
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'value'				=> 25,
				'dependency'		=> array('element' => 'icon_info', 'value' => 'enable_icon'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'value'				=> '#3498db',
				'dependency'		=> array('element' => 'icon_info', 'value' => 'enable_icon'),
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Link Decoration', 'dfd-native'),
				'param_name'		=> 'link_t_decoration',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the font size for the link','dfd-native').'</span></span>'.esc_html__('Font size', 'dfd-native'),
				'param_name'		=> 'link_size',
				'min'				=> 5,
				'max'				=> 50,
				'value'				=> 14,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);