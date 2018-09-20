<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Animate Heading for Visual Composer
*/

class WPBakeryShortCode_Dfd_Animate_Heading extends WPBakeryShortCode {}

vc_map(
	array(
		'name'					=> esc_html__('Animated Heading', 'dfd-native'),
		'base'					=> 'dfd_animate_heading',
		'class'					=> 'dfd_animated_heading dfd_shortcode',
		'icon'					=> 'dfd_animated_heading dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'description'			=> esc_html__('Allows you to present animated headings', 'dfd-native'),
		'params'				=> array(
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the alignment for the heading','dfd-native').'</span></span>'.esc_html__('Heading alignment', 'dfd-native'),
				'param_name'		=> 'heading_alignment',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the direction for the line appear effect for the module','dfd-native').'</span></span>'.esc_html__('Line appear effect', 'dfd-native'),
				'param_name'		=> 'line_appearance',
				'value'				=> 'left-to-right',
				'options'			=> array(
					'<i class="dfd-socicon-arrow-right"></i>'	=> 'left-to-right',
					'<i class="dfd-socicon-arrow-left"></i>'	=> 'right-to-left',
					'<i class="dfd-socicon-arrow-down"></i>'	=> 'top-to-bottom',
					'<i class="dfd-socicon-arrow-up"></i>'		=> 'bottom-to-top'
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-top-padding',
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
			'doc_link'			=> '//nativewptheme.net/support/visual-composer/animated-heading',
			'video_link'		=> 'https://www.youtube.com/watch?v=PNtACSWEmhA&feature=youtu.be',
			),
			array(
				'type'				=> 'textarea',
				'heading'			=> esc_html__('Title', 'dfd-native'),
				'param_name'		=> 'title',
				'value'				=> esc_html__('Animated header example', 'dfd-native'),
				'admin_label'		=> true,
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Subtitle', 'dfd-native'),
				'param_name'		=> 'subtitle',
				'value'				=> esc_html__('Animated subheading example', 'dfd-native'),
				'admin_label'		=> true,
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the top and bottom offset for the title and the subtitle','dfd-native').'</span></span>'.esc_html__('Top / Bottom offset', 'dfd-native'),
				'param_name'		=> 'top_bottom_offset',
				'value'				=> 10,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the left and right offset for the title and the subtitle','dfd-native').'</span></span>'.esc_html__('Left / Right offset', 'dfd-native'),
				'param_name'		=> 'left_right_offset',
				'value'				=> 12,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-top-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the title','dfd-native').'</span></span>'.esc_html__('Title Background Color', 'dfd-native'),
				'param_name'		=> 'title_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the title\'s background','dfd-native').'</span></span>'.esc_html__('Title border radius', 'dfd-native'),
				'param_name'		=> 'title_border_radius',
				'value'				=> 0,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the subtitle','dfd-native').'</span></span>'.esc_html__('Subtitle Background Color', 'dfd-native'),
				'param_name'		=> 'subtitle_background',
				'value'				=> '#303030',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the subtitle\'s background','dfd-native').'</span></span>'.esc_html__('Subtitle border radius', 'dfd-native'),
				'param_name'		=> 'subtitle_border_radius',
				'value'				=> 0,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'			=> 'dfd_single_checkbox',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to align the background according to the longest part. This option is available only if both title and the subtitle are set.','dfd-native').'</span></span>'.esc_html__('Background align', 'dfd-native'),
				'param_name'	=> 'full_width',
				'options'		=> array(
					'full'			=> array(
						'yes'			=> esc_attr__('Yes', 'dfd-native'),
						'no'			=> esc_attr__('No', 'dfd-native'),
					),
				),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'title_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'tag'				=> 'h3',
						'font_size',
						'letter_spacing',
//						'line_height',
						'color',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
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
//						'line_height',
						'color',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
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
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Title responsive settings', 'dfd-native'),
				'param_name'		=> 'title_responsive',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom no-responsive-line-height',
				'group'				=> esc_html__('Responsive', 'dfd-native'),
			),
		),
	)
);