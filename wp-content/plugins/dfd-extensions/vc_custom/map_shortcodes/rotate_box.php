<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Rotate Box for Visual Composer
*/
class WPBakeryShortCode_Dfd_Rotate_Box extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/rotate_box/';
vc_map(
	array(
		'name'					=> esc_html__('Rotate Box', 'dfd-native'),
		'base'					=> 'dfd_rotate_box',
		'class'					=> 'dfd_rotate_box dfd_shortcode',
		'icon'					=> 'dfd_rotate_box dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'params'				=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'to-left'			=> array(
						'tooltip'			=> esc_attr__('Rotate left','dfd-native'),
						'src'				=> $module_images.'style-1.png'
					),
					'to-right'			=> array(
						'tooltip'			=> esc_attr__('Rotate right','dfd-native'),
						'src'				=> $module_images.'style-2.png'
					),
					'to-bottom'			=> array(
						'tooltip'			=> esc_attr__('Rotate bottom','dfd-native'),
						'src'				=> $module_images.'style-3.png'
					),
					'to-top'			=> array(
						'tooltip'			=> esc_attr__('Rotate top','dfd-native'),
						'src'				=> $module_images.'style-4.png'
					),
				),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the height for the rotate item. The default value is 300px','dfd-native').'</span></span>'.esc_html__('Rotate item height', 'dfd-native'),
				'param_name'		=> 'height_block',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap',
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your rotate item','dfd-native').'</span></span>'.esc_html__('Link', 'dfd-native'),
				'param_name'		=> 'link_box',
				'value'				=> '',
				'options'			=> array(
					'link_b'			=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native')
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
			),
			array(
				'type'				=> 'vc_link',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page','dfd-native').'</span></span>'.esc_html__('Add link', 'dfd-native'),
				'param_name'		=> 'link',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'link_box', 'value' => 'link_b'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'		=> 'extra_features_elements_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/rotate-box',
				'video_link'		=> 'https://www.youtube.com/watch?v=T9A44JfPUsw',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Front Side', 'dfd-native' ),
				'param_name'		=> 'extra_features_elements_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the front side. You can choose color or image','dfd-native').'</span></span>'.esc_html__('Background style', 'dfd-native'),
				'param_name'		=> 'bg_style',
				'value'				=> 'color',
				'options'			=> array(
					esc_html__('Image', 'dfd-native')	=> 'image',
					esc_html__('Color', 'dfd-native')	=> 'color',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Upload Image', 'dfd-native'),
				'param_name'		=> 'icon_image_id',
				'dependency'		=> array('element' => 'bg_style', 'value' => 'image'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the front side. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'mask_background',
				'dependency'		=> array('element' => 'bg_style', 'value' => 'color'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'			=> 'textarea',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Type the title for the rotate item. It will be seen on the front side','dfd-native').'</span></span>'.esc_html__('Title', 'dfd-native'),
				'param_name'	=> 'title_first',
				'value'			=> 'Rotate box title',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Type the subtitle for the rotate item. It will be seen on the front side','dfd-native').'</span></span>'.esc_html__('Subtitle', 'dfd-native'),
				'param_name'	=> 'subtitle_first',
				'value'			=> 'Rotate box subtitle',
				'group'				=> esc_html__('Content', 'dfd-native'),
			), 
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the content on the front side','dfd-native').'</span></span>'.esc_html__('Horizontal alignment', 'dfd-native'),
				'param_name'		=> 'h_alignment',
				'value'				=> 'horizontal-center',
				'options'			=> array(
					esc_html__('Left', 'dfd-native') => 'horizontal-left',
					esc_html__('Center', 'dfd-native') => 'horizontal-center',
					esc_html__('Right', 'dfd-native') => 'horizontal-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the vertical alignment for the content on the front side','dfd-native').'</span></span>'.esc_html__('Vertical alignment', 'dfd-native'),
				'param_name'		=> 'v_alignment',
				'value'				=> 'vertical-center',
				'options'			=> array(
					esc_html__('Top', 'dfd-native') => 'vertical-top',
					esc_html__('Center', 'dfd-native') => 'vertical-center',
					esc_html__('Bottom', 'dfd-native') => 'vertical-bottom',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the top/bottom offset for the content on the front side of the rotate box. The default offset value is 50px','dfd-native').'</span></span>'.esc_html__('Front side top/bottom offset', 'dfd-native'),
				'param_name'		=> 'front_content_vertical_offset',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the left/right offset for the content on the front side of the rotate box. The default offset value is 50px','dfd-native').'</span></span>'.esc_html__('Front side left/right offset', 'dfd-native'),
				'param_name'		=> 'front_content_horizontal_offset',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__('Back Side', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 ',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'			=> 'dfd_radio_advanced',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style for the back side. You can choose color or image','dfd-native').'</span></span>'.esc_html__('Background style', 'dfd-native'),
				'param_name'	=> 'bg_style_reverse',
				'value'			=> 'color',
				'options'		=> array(
					esc_html__('Image', 'dfd-native')	=> 'image',
					esc_html__('Color', 'dfd-native')	=> 'color',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Upload Image', 'dfd-native'),
				'param_name'		=> 'image_id_reverse',
				'dependency'		=> array('element' => 'bg_style_reverse', 'value' => 'image'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the back side. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'mask_bg_reverse',
				'dependency'		=> array('element' => 'bg_style_reverse', 'value' => 'color'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'			=> 'textarea',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Type the description for your rotate item. It will be seen on the back side','dfd-native').'</span></span>'.esc_html__('Description', 'dfd-native'),
				'param_name'	=> 'desc_reverse',
				'value'			=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque velit mi, facilisis id nunc sed, vehicula molestie felis.',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the top/bottom offset for the content on the back side of the rotate box. The default offset value is 50px','dfd-native').'</span></span>'.esc_html__('Back side top/bottom offset', 'dfd-native'),
				'param_name'		=> 'back_content_vertical_offset',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the left/right offset for the content on the back side of the rotate box. The default offset value is 50px','dfd-native').'</span></span>'.esc_html__('Back side left/right offset', 'dfd-native'),
				'param_name'		=> 'back_content_horizontal_offset',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to add the number or short text at rotate item', 'dfd-native') . '</span></span>' .esc_html__('Additional info', 'dfd-native'),
				'param_name'		=> 'block_number',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the additional information you would like to show on the rotate item','dfd-native').'</span></span>'.esc_html__('Info', 'dfd-native'),
				'param_name'		=> 'number_text',
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'dependency'		=> array('element' => 'block_number', 'value' => array('yes')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the horizontal alignment for the additional information','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'number_alignment',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right'
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'block_number', 'value' => array('yes')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the position for the additional information. It can be set at the top or at the bottom of the rotate item','dfd-native').'</span></span>'.esc_html__('Position', 'dfd-native'),
				'param_name'		=> 'number_position',
				'value'				=> 'number-after-content',
				'options'			=> array(
					esc_html__('Top', 'dfd-native')	=> 'number-before-content',
					esc_html__('Bottom', 'dfd-native')	=> 'number-after-content',
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'dependency'		=> array('element' => 'block_number', 'value' => array('yes')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_attr__('Typography', 'dfd-native'),
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
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Description Typography', 'dfd-native'),
				'param_name'		=> 'desc_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'desc_font_options',
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
				'param_name'		=> 'desc_google_fonts',
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
				'param_name'		=> 'desc_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description'	=> esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'	=> esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'desc_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Info Typography', 'dfd-native'),
				'param_name'		=> 'number_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Font size', 'dfd-native'),
				'param_name'		=> 'number_font_size',
				'edit_field_class'	=> 'vc_col-sm-12 vc_column crum_vc dfd-number-wrap',
				'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'number_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'letter_spacing',
						'color',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'number_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'number_text', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'number_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description'	=> esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'	=> esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'number_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);
