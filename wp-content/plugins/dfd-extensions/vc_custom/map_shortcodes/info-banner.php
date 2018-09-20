<?php

if (!defined('ABSPATH')) {exit;}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/info_banner/';

class WPBakeryShortCode_Dfd_Info_Banner extends WPBakeryShortCode {}

vc_map(
	array (
		'name' => esc_html__('Info banner', 'dfd-native'),
		'base' => 'dfd_info_banner',
		'class' => 'dfd_info_banner dfd_shortcode',
		'icon' => 'dfd_info_banner dfd_shortcode',
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Allows you to add image banners with content', 'dfd-native'),
		'params' => array_merge(
			array(
				array(
					'heading' => esc_html__('Style', 'dfd-native'),
					'type' => 'radio_image_select',
					'param_name' => 'style',
					'class' => 'info-banner-param-clear',
					'simple_mode' => false,
					'options' => array(
						'style-21' => array(
							'tooltip' => esc_attr__('Classic', 'dfd-native'),
							'src' => $module_images . 'Info-banner_01.png'
						),
						'style-22' => array(
							'tooltip' => esc_attr__('Top title', 'dfd-native'),
							'src' => $module_images . 'Info-banner_02.png'
						),
						'style-23' => array(
							'tooltip' => esc_attr__('Bottom content', 'dfd-native'),
							'src' => $module_images . 'Info-banner_03.png'
						),
						'style-24' => array(
							'tooltip' => esc_attr__('Centered title', 'dfd-native'),
							'src' => $module_images . 'Info-banner_04.png'
						),
						'style-25' => array(
							'tooltip' => esc_attr__('Content on image', 'dfd-native'),
							'src' => $module_images . 'Info-banner_05.png'
						),
						'style-26' => array(
							'tooltip' => esc_attr__('Right content', 'dfd-native'),
							'src' => $module_images . 'Info-banner_06.png'
						),
						'style-27' => array(
							'tooltip' => esc_attr__('Left content', 'dfd-native'),
							'src' => $module_images . 'Info-banner_07.png'
						),
						'style-28' => array(
							'tooltip' => esc_attr__('Hovered title bottom', 'dfd-native'),
							'src' => $module_images . 'Info-banner_08.png'
						),
						'style-29' => array(
							'tooltip' => esc_attr__('Hovered title center', 'dfd-native'),
							'src' => $module_images . 'Info-banner_09.png'
						),
						'style-30' => array(
							'tooltip' => esc_attr__('Hovered content', 'dfd-native'),
							'src' => $module_images . 'Info-banner_10.png'
						),
						'style-31' => array(
							'tooltip' => esc_attr__('Hover Image changing', 'dfd-native'),
							'src' => $module_images . 'Info-banner_11.png'
						),
					),
					'value' => 'style-21'
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to set the horizontal alignment for the banner\'s content', 'dfd-native') . '</span></span>' .esc_html__('Content alignment', 'dfd-native'),
					'param_name' => 'content_alignment',
					'value' => 'text-center',
					'options' => array(
						esc_attr__('Left', 'dfd-native') => 'text-left',
						esc_attr__('Center', 'dfd-native') => 'text-center',
						esc_attr__('Right', 'dfd-native') => 'text-right',
					),
					'dependency' => array(
						'element' => 'style',
						'value' => array('style-21', 'style-22', 'style-23', 'style-24', 'style-25', 'style-28', 'style-29', 'style-30', 'style-31'),
					),
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
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Add the unique class name for the element which can be used for custom CSS codes', 'dfd-native') . '</span></span>' . esc_html__('Custom CSS Class', 'dfd-native'),
					'param_name' => 'el_class',
				),
				array(
					'type'				=> 'dfd_video_link_param',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
					'param_name'		=> 'tutorials',
					'doc_link'			=> '//nativewptheme.net/support/visual-composer/info-banner',
					'video_link'		=> 'https://youtu.be/o-p5eQF154M',
				),
				array(
					'type' => 'attach_image',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select image from media library','dfd-native').'</span></span>'.esc_html__('Image', 'dfd-native'),
					'param_name' => 'image',
					'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => esc_html__('Image width', 'dfd-native'),
					'param_name' => 'img_width',
					'min' => 0,
					'value' => '400',
					'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-top-padding',
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => esc_html__('Image height', 'dfd-native'),
					'param_name' => 'img_height',
					'min' => 0,
					'value' => '350',
					'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-top-padding',
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'attach_image',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select image from media library','dfd-native').'</span></span>'.esc_html__('Image on hover', 'dfd-native'),
					'param_name' => 'image_hover',
					'edit_field_class' => 'vc_col-sm-12 crum_vc',
					'dependency' => array('element' => 'style', 'value' => array('style-31')),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Title', 'dfd-native'),
					'param_name' => 'title',
					'value' => esc_html__('Title', 'dfd-native'),
					'admin_label' => true,
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Subtitle', 'dfd-native'),
					'param_name' => 'subtitle',
					'value' => esc_html__('Subtitle', 'dfd-native'),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__('Content', 'dfd-native'),
					'param_name' => 'banner_content',
					'value' => esc_html__('Content', 'dfd-native'),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select where the link should be applied','dfd-native').'</span></span>'.esc_html__('Apply link to', 'dfd-native'),
					'param_name' => 'read_more',
					'value' => '',
					'options' => array(
						esc_html__('No Link', 'dfd-native') => '',
						esc_html__('Complete Box', 'dfd-native') => 'box',
						esc_html__('Box Title', 'dfd-native') => 'title',
						esc_html__('Read More', 'dfd-native') => 'more',
					),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'vc_link',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd-native').'</span></span>'.esc_html__('Add link', 'dfd-native'),
					'param_name' => 'link',
					'edit_field_class' => 'vc_col-sm-6 crum_vc',
					'dependency' => array('element' => 'read_more', 'value' => array('box', 'title', 'more')),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the Read more','dfd-native').'</span></span>'.esc_html__('Read more', 'dfd-native'),
					'param_name' => 'readmore_show',
					'options' => array(
						'show' => array(
							'yes' => esc_attr__('Yes', 'dfd-native'),
							'no' => esc_attr__('No', 'dfd-native'),
						),
					),
					'edit_field_class' => 'vc_col-sm-6 crum_vc',
					'dependency' => array('element' => 'read_more', 'value' => array('box', 'title', 'more')),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_radio_advanced',
					'heading'			=> esc_html__('Button visibility', 'dfd-native'),
					'param_name'		=> 'more_show',
					'edit_field_class'	=> 'vc_column vc_col-sm-12',
					'value'				=> 'permanent',
					'options'			=> array(
						esc_html__('Permanent', 'dfd-native')		=> 'permanent',
						esc_html__('Show on hover', 'dfd-native')	=> 'hover',
					),
					'dependency'		=> array('element' => 'readmore_show', 'value' => array('show')),
					'group'				=> esc_html__('Content', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_radio_advanced',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 7 preset read more styles','dfd-native').'</span></span>'.esc_html__('Read more style', 'dfd-native'),
					'param_name'		=> 'readmore_style',
					'value'				=> 'read-more-1',
					'options'			=> array(
						esc_html__('Bordered', 'dfd-native')		=> 'read-more-1',
						esc_html__('Shadow', 'dfd-native')			=> 'read-more-2',
						esc_html__('Plus', 'dfd-native')			=> 'read-more-3',
						esc_html__('Arrow & text', 'dfd-native')	=> 'read-more-4',
						esc_html__('Arrow', 'dfd-native')			=> 'read-more-5',
						esc_html__('Dots', 'dfd-native')			=> 'read-more-6',
						esc_html__('Button', 'dfd-native')			=> 'read-more-7',
						esc_html__('Simple', 'dfd-native')			=> 'read-more-8',

					),
					'edit_field_class'	=> 'vc_column vc_col-sm-12',
					'dependency'		=> array('element' => 'readmore_show', 'value' => 'show'),
					'group'				=> esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__('Read more text', 'dfd-native'),
					'param_name' => 'readmore_text',
					'value' => esc_html__('Read More', 'dfd-native'),
					'dependency' => array('element' => 'readmore_style', 'value' => array('read-more-1', 'read-more-2', 'read-more-4', 'read-more-7', 'read-more-8')),
					'group' => esc_html__('Content', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Image', 'dfd-native') . ' ' . esc_html__('effect', 'dfd-native'),
					'param_name' => 'image_effect_heading',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the hover effect for the image', 'dfd-native') . '</span></span>' .esc_html__('Image effect', 'dfd-native'),
					'param_name' => 'image_effect',
					'value' => '',
					'options' => array(
						esc_attr__('None', 'dfd-native') => '',
						esc_attr__('Image parallax', 'dfd-native') => 'panr',
						esc_attr__('Blur', 'dfd-native') => 'dfd-image-blur',
						esc_attr__('Grow', 'dfd-native') => 'dfd-image-scale',
						esc_attr__('Grow with rotation', 'dfd-native') => 'dfd-image-scale-rotate',
					),
					'edit_field_class' => 'vc_column vc_col-sm-9 no-border-bottom',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the border radius for the banner\'s image', 'dfd-native') . '</span></span>' .esc_html__('Border radius', 'dfd-native'),
					'param_name' => 'thumb_radius',
					'min' => 0,
					'edit_field_class' => 'vc_column vc_col-sm-3 no-border-bottom dfd-number-wrap crum_vc',
					'dependency' => array('element' => 'image_effect', 'value' => array('')),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Number at image', 'dfd-native'),
					'param_name' => 'n_ef',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the number in a circled background on the image', 'dfd-native') . '</span></span>' .esc_html__('Number at image', 'dfd-native'),
					'param_name' => 'show_number_block',
					'edit_field_class' => 'vc_column vc_col-sm-12',
					'options' => array(
						'show' => array(
							'on' => esc_html__('Yes', 'dfd-native'),
							'off' => esc_html__('No', 'dfd-native'),
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'number',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the number you\'d like to show', 'dfd-native') . '</span></span>' .esc_html__('Number', 'dfd-native'),
					'param_name'		=> 'n_b_number',
					'max'				=> 99,
					'value'				=> '1',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'dependency' => array('element' => 'show_number_block', 'value' => array('show')),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'number',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Specify the font size for the number shown on info banner', 'dfd-native') . '</span></span>' .esc_html__('Number font size', 'dfd-native'),
					'param_name'		=> 'n_b_number_size',
					'value'				=> '14',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
					'dependency' => array('element' => 'show_number_block', 'value' => array('show')),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the background color for the number', 'dfd-native') . '</span></span>' .esc_html__('Background', 'dfd-native') . ' ' . esc_html__('color', 'dfd-native'),
					'param_name'		=> 'n_b_background_color',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency'		=> array('element' => 'show_number_block', 'value' => array('show')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the color for the number', 'dfd-native') . '</span></span>' .esc_html__('Number', 'dfd-native') . ' ' . esc_html__('Color', 'dfd-native'),
					'param_name'		=> 'n_b_text_color',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency'		=> array('element' => 'show_number_block', 'value' => array('show')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Overlay', 'dfd-native') . ' ' . esc_html__('gradient', 'dfd-native'),
					'param_name' => 'subtitle_h_heading',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'dependency' => array('element' => 'style', 'value_not_equal_to' => array('style-31', 'style-21', 'style-22', 'style-26', 'style-27')),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> esc_html__('Start', 'dfd-native') . ' ' . esc_html__('Color', 'dfd-native'),
					'param_name'		=> 'gradient_color1',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency'		=> array('element' => 'style', 'value_not_equal_to' => array('style-31', 'style-21', 'style-22', 'style-26', 'style-27')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> esc_html__('End', 'dfd-native') . ' ' . esc_html__('Color', 'dfd-native'),
					'param_name'		=> 'gradient_color2',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency'		=> array('element' => 'style', 'value_not_equal_to' => array('style-31', 'style-21', 'style-22', 'style-26', 'style-27')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_heading_param',
					'text'				=> esc_html__('Shadow', 'dfd-native'),
					'param_name'		=> 'shadow_heading',
					'class'				=> 'ult-param-heading',
					'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'dependency'		=> array('element' => 'image_effect', 'value' => array('')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_single_checkbox',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the shadow to the info banner','dfd-native').'</span></span>'.esc_html__('Shadow', 'dfd-native'),
					'param_name'		=> 'shadow',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
					'options'			=> array(
						'show'				=> array(
							'on'	=> esc_html__('Yes', 'dfd-native'),
							'off'	=> esc_html__('No', 'dfd-native'),
						),
					),
					'dependency'		=> array('element' => 'image_effect', 'value' => array('')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_radio_advanced',
					'heading'			=> esc_html__('Shadow visibility', 'dfd-native'),
					'param_name'		=> 'shadow_style',
					'value'				=> 'permanent',
					'options'			=> array(
						esc_html__('Permanent', 'dfd-native')	=> 'permanent',
						esc_html__('On hover', 'dfd-native')	=> 'hover',
					),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
					'dependency'		=> array('element' => 'shadow', 'value' => array('show')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_box_shadow_param',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the color and size of the shadow for the banner','dfd-native').'</span></span>'.esc_html__('Box Shadow settings', 'dfd-native'),
					'param_name'		=> 'box_shadow',
					'value'				=> 'enable',
					'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
					'dependency'		=> array('element' => 'shadow_style', 'value' => array('permanent')),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_box_shadow_param',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the color and size of the shadow for the banner on hover','dfd-native').'</span></span>'.esc_html__('Box Shadow on Hover settings', 'dfd-native'),
					'param_name'		=> 'hover_box_shadow',
					'value'				=> 'enable',
					'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
					'dependency'		=> array('element' => 'shadow_style', 'value' => array('hover')),
					'group'				=> esc_html__('Style', 'dfd-native'),
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
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Allows you to use custom Google font', 'dfd-native') . '</span></span>' . esc_html__('Custom font family', 'dfd-native'),
					'param_name' => 'use_google_fonts',
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
							'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
					'dependency' => array('element' => 'use_google_fonts', 'value' => 'show'),
					'group' => esc_attr__('Typography', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Subtitle', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
					'param_name' => 'subtitle_t_heading',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper no-border-bottom vc_column vc_col-sm-12',
					'group' => esc_html__('Typography', 'dfd-native'),
				),
				array(
					'type' => 'dfd_font_container',
					'heading' => '',
					'edit_field_class' => 'no-border-bottom vc_column vc_col-sm-12',
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
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Content', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
					'param_name' => 'content_t_heading',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper no-border-bottom vc_column vc_col-sm-12',
					'group' => esc_attr__('Typography', 'dfd-native'),
				),
				array(
					'type' => 'dfd_font_container',
					'heading' => '',
					'param_name' => 'font_options',
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
			),
			array()
		),
	)
);
