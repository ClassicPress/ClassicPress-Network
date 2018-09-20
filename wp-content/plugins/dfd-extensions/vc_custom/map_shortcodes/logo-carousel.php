<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Client Logo for Visual Composer
*/

class WPBakeryShortCode_Dfd_Logo_Carousel extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/logo-carousel/';
vc_map(
	array(
		'name'					=> esc_html__('Image Carousel', 'dfd-native'),
		'base'					=> 'dfd_logo_carousel',
		'class'					=> 'dfd_logo_carousel dfd_shortcode',
		'icon'					=> 'dfd_logo_carousel dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'params'				=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_attr__('Opacity','dfd-native'),
						'src'				=> $module_images.'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_attr__('Greyscale','dfd-native'),
						'src'				=> $module_images.'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_attr__('Rotate','dfd-native'),
						'src'				=> $module_images.'style-3.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to display images set in carousel or in columns','dfd-native').'</span></span>'.esc_html__('Display on the screen', 'dfd-native'),
				'param_name'		=> 'enable_slides',
				'value'				=> 'column',
				'options'			=> array(
						esc_html__('Columns', 'dfd-native') => 'column',
						esc_html__('Slideshow', 'dfd-native') => 'slides',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12',
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/image-carousel',
				'video_link' => 'https://www.youtube.com/watch?v=_epKpY9EOV8&feature=youtu.be',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List content', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'value'				=> '%5B%7B%22description%22%3A%22Image%20short%20description%20which%20will%20be%20visible%20on%20the%20back%20side.%20%22%7D%2C%7B%22description%22%3A%22Image%20short%20description%20which%20will%20be%20visible%20on%20the%20back%20side.%20%22%7D%2C%7B%22description%22%3A%22Image%20short%20description%20which%20will%20be%20visible%20on%20the%20back%20side.%20%22%7D%5D',
				'params'			=> array(
					array(
						'type'			=> 'attach_image',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Upload Image', 'dfd-native'),
						'param_name'	=> 'icon_image_id',
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add some information for the image. This option is available only for the Rotate style','dfd-native').'</span></span>'.esc_html__('Description', 'dfd-native'),
						'param_name'	=> 'description',
						'dependency'	=> array('element' => 'main_style', 'value' => array('style-3'))
					), 
					array(
						'type'			=> 'dfd_single_checkbox',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your image','dfd-native').'</span></span>'.esc_html__('Link', 'dfd-native'),
						'param_name'	=> 'link_box',
						'options'		=> array(
							'link_b'		=> array(
								'yes'			=> esc_attr__('Yes', 'dfd-native'),
								'no'			=> esc_attr__('No', 'dfd-native')
							),
						),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					),
					array(
						'type'			=> 'vc_link',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page','dfd-native').'</span></span>'.esc_html__('Add link', 'dfd-native'),
						'param_name'	=> 'link',
						'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
						'dependency'	=> array('element' => 'link_box', 'value' => 'link_b'),
					),
				),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to show','dfd-native').'</span></span>'.esc_html__('Number of slides to display', 'dfd-native'),
				'param_name'		=> 'slides_to_show',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to scroll','dfd-native').'</span></span>'.esc_html__('Number of slides to scroll', 'dfd-native'),
				'param_name'		=> 'slides_to_scroll',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding',
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd-native').'</span></span>'.esc_html__('Slideshow speed', 'dfd-native'),
				'param_name'		=> 'slideshow_speed',
				'value'				=> 3000,
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
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
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
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
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'slides'),
				'group'				=> esc_html__('Sliding', 'dfd-native'),
			),
			array(
				'type' => 'radio_image_select',
				'heading' => esc_html__('Pagination style', 'dfd-native'),
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
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the number of columns you would like to display','dfd-native').'</span></span>'.esc_html__('Columns', 'dfd-native'),
				'param_name'		=> 'columns',
				'value'				=> 'default',
				'options'			=> array(
					esc_html__('Auto', 'dfd-native')		=> 'default',
					esc_html__('1', 'dfd-native')		=> 1,
					esc_html__('2', 'dfd-native')		=> 2,
					esc_html__('3', 'dfd-native')		=> 3,
					esc_html__('4', 'dfd-native')		=> 4,
					esc_html__('5', 'dfd-native')		=> 5,
					esc_html__('6', 'dfd-native')		=> 6,
				),
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'column'),
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the delimiter between the images','dfd-native').'</span></span>'.esc_html__('Delimiter', 'dfd-native'),
				'param_name'		=> 'enable_delimiter',
				'options'			=> array(
					'on'			=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'enable_slides', 'value' => 'column'),
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the mask background. The default mask color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'mask_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the border radius for the image. The border radius is not set by default', 'dfd-native') . '</span></span>' .esc_html__('Border radius', 'dfd-native'),
				'param_name' => 'thumb_radius',
				'min' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the image\'s opacity for the idle. The default opacity is 50%','dfd-native').'</span></span>'.esc_html__('Opacity', 'dfd-native'),
				'param_name'		=> 'opacity_before',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-percent crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1')),
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the image\'s opacity for the hover. The opacity is not set by default','dfd-native').'</span></span>'.esc_html__('Opacity on hover', 'dfd-native'),
				'param_name'		=> 'opacity_after',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1')),
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Description Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'title_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'tag'				=> 'div',
						'letter_spacing',
						'font_size',
						'line_height',
						'color',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
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
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
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
				'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
		),
	)
);