<?php
/*
* Add-on Name: Link Style
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

class WPBakeryShortCode_Dfd_Link_Style extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/link_style/';

vc_map(
	array(
		'name'        => esc_html__('Styled link', 'dfd-native'),
		'base'        => 'dfd_link_style',
		'class'       => 'dfd_link_style dfd_shortcode',
		'icon'        => 'dfd_link_style dfd_shortcode',
		'category'    => esc_html__( 'Native', 'dfd-native' ),
		'description' => esc_html__( 'Display links with animation', 'dfd-native' ),
		'params'      => array(
			array(
				'type'				=> 'radio_image_select',
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Brackets','dfd-native'),
						'src'				=> $module_images . 'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Cubic','dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('Bottom line','dfd-native'),
						'src'				=> $module_images . 'style-3.png'
					),
					'style-4'			=> array(
						'tooltip'			=> esc_html__('Text transform','dfd-native'),
						'src'				=> $module_images . 'style-4.png'
					),
					'style-5'			=> array(
						'tooltip'			=> esc_html__('Top line','dfd-native'),
						'src'				=> $module_images . 'style-5.png'
					),
					'style-6'			=> array(
						'tooltip'			=> esc_html__('Moving frame','dfd-native'),
						'src'				=> $module_images . 'style-6.png'
					),
					'style-7'			=> array(
						'tooltip'			=> esc_html__('Slide text','dfd-native'),
						'src'				=> $module_images . 'style-7.png'
					),
					'style-8'			=> array(
						'tooltip'			=> esc_html__('Slide line','dfd-native'),
						'src'				=> $module_images . 'style-8.png'
					),
					'style-9'			=> array(
						'tooltip'			=> esc_html__('Lines animation','dfd-native'),
						'src'				=> $module_images . 'style-9.png'
					),
					'style-10'			=> array(
						'tooltip'			=> esc_html__('X animation','dfd-native'),
						'src'				=> $module_images . 'style-10.png'
					),
					'style-11'			=> array(
						'tooltip'			=> esc_html__('Top & bottom lines','dfd-native'),
						'src'				=> $module_images . 'style-11.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the link','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'align',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')   => 'text-left',
					esc_html__('Center', 'dfd-native') => 'text-center',
					esc_html__('Right', 'dfd-native')  => 'text-right',
				),
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
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/styled-links',
				'video_link'		=> 'https://www.youtube.com/watch?v=xra5Rvj5WCw&feature=youtu.be',
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Link text', 'dfd-native'),
				'param_name'		=> 'link_content',
				'value'				=> esc_html__('Link example', 'dfd-native'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'vc_link',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well.','dfd-native').'</span></span>'.esc_html__('Link url', 'dfd-native'),
				'param_name'		=> 'link_src',
				'value'				=> 'url:%23|||',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the text. Default color is #28262b. For the styles Cubic and Slide text the default color is #fff','dfd-native').'</span></span>'.esc_html__('Text color', 'dfd-native'),
				'param_name'		=> 'text_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the text. Default color is inherited from Theme Options > Styling Options > Main site color. For the styles Cubic and Slide text the default color is #fff','dfd-native').'</span></span>'.esc_html__('Text hover color', 'dfd-native'),
				'param_name'		=> 'text_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-top-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color. Default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'front_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-7')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background hover color. Default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Hover background', 'dfd-native'),
				'param_name'		=> 'back_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-7')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. Default color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name'		=> 'line_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3', 'style-5', 'style-6', 'style-8', 'style-9', 'style-10')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border hover color. Default color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border hover color', 'dfd-native'),
				'param_name'		=> 'line_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-5', 'style-6', 'style-8', 'style-9', 'style-10', 'style-11')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'		=> array(
						'tag'			=> 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'link_content', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'link_content', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);