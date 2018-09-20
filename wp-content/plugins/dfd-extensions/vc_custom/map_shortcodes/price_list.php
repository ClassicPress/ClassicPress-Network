<?php

if ( !defined( 'ABSPATH' )) { exit; }

/*
* Add-on Name: DFD Price List
*/

class WPBakeryShortCode_Dfd_Price_List extends WPBakeryShortCode {}

vc_map (
	array (
		'name'					=> esc_html__('Pricing List', 'dfd-native'),
		'base'					=> 'dfd_price_list',
		'class'					=> 'dfd_price_list dfd_shortcode',
		'icon'					=> 'dfd_price_list dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'params'				=> array(
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width of the pricing list item according to the container width','dfd-native').'</span></span>'.esc_html__('Price List Size', 'dfd-native'),
				'param_name'		=> 'box_width',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-number-percent'
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name'		=> 'module_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles()
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'		=> 'el_class'
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/pricing-list',
				'video_link'		=> 'https://www.youtube.com/watch?v=JxUWteix4sg',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List content', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'value'				=> '%5B%7B%22title%22%3A%22Pricing%20list%20title%22%2C%22currency_symbol%22%3A%22%24%22%2C%22price%22%3A%2210%22%2C%22subtitle%22%3A%22Pricing%20list%20subtitle%20or%20some%20description%22%7D%2C%7B%22title%22%3A%22Pricing%20list%20title%22%2C%22currency_symbol%22%3A%22%24%22%2C%22price%22%3A%2210%22%2C%22subtitle%22%3A%22Pricing%20list%20subtitle%20or%20some%20description%22%7D%5D',
				'params'			=> array(
					array(
						'type'			=> 'attach_image',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select image from media library for your pricing list item','dfd-native').'</span></span>'.esc_html__('Image', 'dfd-native'),
						'param_name'	=> 'image_id',
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the title for your pricing list item','dfd-native').'</span></span>'.esc_html__('Title', 'dfd-native'),
						'param_name'	=> 'title',
					),
					array(
						'type'				=> 'textfield',
						'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you set any currency symbol you need','dfd-native').'</span></span>'.esc_html__('Currency symbol', 'dfd-native'),
						'param_name'		=> 'currency_symbol',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					),
					array(
						'type'				=> 'number',
						'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the price for your pricing list item','dfd-native').'</span></span>'.esc_html__('Price', 'dfd-native'),
						'param_name'		=> 'price',
						'min'				=> 0,
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					),
					array(
						'type'			=> 'textarea',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the subtitle for your pricing list item','dfd-native').'</span></span>'.esc_html__('Subtitle', 'dfd-native'),
						'param_name'	=> 'subtitle',
					),
				),
				'group'				=> esc_html__('Content', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the currency symbol position according to the price, it can be displayed either before or after the price','dfd-native').'</span></span>'.esc_html__('Currency symbol position', 'dfd-native'),
				'param_name'		=> 'symbol_under_price',
				'value'				=> '',
				'options'			=> array(
					esc_html__('Before','dfd-native')	=> '',
					esc_html__('After','dfd-native')	=> 'after',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the delimiter styles','dfd-native').'</span></span>'.esc_html__('Delimiter style', 'dfd-native'),
				'param_name'		=> 'delimeter_style',
				'value'				=> 'solid',
				'options'			=> array(
					esc_html__('None','dfd-native')	=> 'none',
					esc_html__('Solid','dfd-native')	=> 'solid',
					esc_html__('Dotted','dfd-native')	=> 'dotted',
					esc_html__('Dashed','dfd-native')	=> 'dashed',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-top-padding',
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter width', 'dfd-native'),
				'param_name'		=> 'delimeter_width',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'dependency'		=> array('element' => 'delimeter_style', 'value' => array('solid', 'dotted', 'dashed')),
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you set the color for the delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter Color', 'dfd-native'),
				'param_name'		=> 'color_delim',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'delimeter_style', 'value' => array('solid', 'dotted', 'dashed')),
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'			=> 'number',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the image. Max width is 100px','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name'	=> 'img_width',
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'			=> 'number',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the image. Max height is 100px','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name'	=> 'img_height',
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'			=> 'number',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the image','dfd-native').'</span></span>'.esc_html__('Image radius', 'dfd-native'),
				'param_name'	=> 'img_radius',
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to add the spacing between the pricing list content','dfd-native').'</span></span>'.esc_html__('Spacing between content', 'dfd-native'),
				'param_name'		=> 'spacing_content',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Settings', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'title_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'tag'				=> 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
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
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Subtitle Typography', 'dfd-native'),
				'param_name'		=> 'subtitle_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'subtitle_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'tag'				=> 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'subtitle_google_fonts',
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
				'param_name'		=> 'subtitle_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description'	=> esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'	=> esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'subtitle_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		)
	)
);
