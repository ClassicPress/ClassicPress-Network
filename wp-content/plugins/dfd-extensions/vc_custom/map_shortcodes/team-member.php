<?php

if (!defined('ABSPATH')) {
	exit;
}
/*
 * Add-on Name: Team member
 */

class WPBakeryShortCode_Dfd_New_Team_Member extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/team_member/';

vc_map(
	array(
		'name' => esc_html__('Team member', 'dfd-native'),
		'base' => 'dfd_new_team_member',
		'class' => 'dfd_team_member dfd_shortcode',
		'icon' => 'dfd_team_member dfd_shortcode',
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Info about your team', 'dfd-native'),
		'params' => array_merge(
			array(
				array(
					'heading' => esc_html__('Style', 'dfd-native'),
					'type' => 'radio_image_select',
					'param_name' => 'main_layout',
					'simple_mode' => false,
					'options' => array(
						'layout-11' => array(
							'tooltip' => esc_attr__('Classic', 'dfd-native'),
							'src' => $module_images . 'layout-11.png'
						),
						'layout-12' => array(
							'tooltip' => esc_attr__('Top title', 'dfd-native'),
							'src' => $module_images . 'layout-12.png'
						),
						'layout-13' => array(
							'tooltip' => esc_attr__('Bottom content', 'dfd-native'),
							'src' => $module_images . 'layout-13.png'
						),
						'layout-14' => array(
							'tooltip' => esc_attr__('Left content', 'dfd-native'),
							'src' => $module_images . 'layout-14.png'
						),
						'layout-15' => array(
							'tooltip' => esc_attr__('Right content', 'dfd-native'),
							'src' => $module_images . 'layout-15.png'
						),
						'layout-16' => array(
							'tooltip' => esc_attr__('Title bottom', 'dfd-native'),
							'src' => $module_images . 'layout-16.png'
						),
						'layout-17' => array(
							'tooltip' => esc_attr__('Title on image', 'dfd-native'),
							'src' => $module_images . 'layout-17.png'
						),
						'layout-18' => array(
							'tooltip' => esc_attr__('Hovered content', 'dfd-native'),
							'src' => $module_images . 'layout-18.png'
						),
						'layout-19' => array(
							'tooltip' => esc_attr__('Hovered title & content', 'dfd-native'),
							'src' => $module_images . 'layout-19.png'
						),
					),
					'value'=> 'layout-11'
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
					'doc_link' => '//nativewptheme.net/support/visual-composer/team-member',
					'video_link' => 'https://youtu.be/MGGuwp76v5U',
				),
				array(
					'type' => 'attach_image',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select image from the media library.','dfd-native').'</span></span>'.esc_html__('Image', 'dfd-native'),
					'param_name' => 'team_member_photo',
					'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the testimonial thumbnail','dfd-native').'</span></span>'.esc_html__('Width', 'dfd-native'),
					'param_name' => 'team_member_img_width',
					'min' => 0,
					'std' => '400',
					'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding dfd-number-wrap crum_vc',
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the testimonial thumbnail','dfd-native').'</span></span>'.esc_html__('Height', 'dfd-native'),
					'param_name' => 'team_member_img_height',
					'min' => 0,
					'std' => '400',
					'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding dfd-number-wrap crum_vc',
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'textfield',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the name of your team member','dfd-native').'</span></span>'.esc_html__('Title', 'dfd-native'),
					'param_name' => 'team_member_name',
					'admin_label' => true,
					'value'=> esc_html__('Title', 'dfd-native'),
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'textfield',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the position for your team member','dfd-native').'</span></span>'.esc_html__('Subtitle', 'dfd-native'),
					'param_name' => 'team_member_job_position',
					'value'=> esc_html__('Subtitle', 'dfd-native'),
					'admin_label' => true,
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'textarea',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('The main information about your team member','dfd-native').'</span></span>'.esc_html__('Description', 'dfd-native'),
					'param_name' => 'team_member_description',
					'value'=> esc_html__('Description', 'dfd-native'),
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'param_name' => 'enable_custom_link',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the custom link or choose the existing page for the team member','dfd-native').'</span></span>'.esc_html__('Team member custom link', 'dfd-native'),
					'options' => array(
						'show' => array(
							'on' => esc_html__('Yes', 'dfd-native'),
							'off' => esc_html__('No', 'dfd-native'),
						),
					),
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select where the link should be applied','dfd-native').'</span></span>'.esc_html__('Apply link to', 'dfd-native'),
					'param_name' => 'apply_link_to',
					'value'=> 'image-link',
					'options' => array(
						esc_html__('Team member image', 'dfd-native') => 'image-link',
						esc_html__('Title', 'dfd-native') => 'title-link',
					),
					'dependency' => array('element' => 'enable_custom_link', 'not_empty' => true),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					'group' => esc_html__('Member info', 'dfd-native'),
				),
				array(
					'type' => 'vc_link',
					'heading' => esc_html__('Custom link url', 'dfd-native'),
					'param_name' => 'custtom_link_url',
					'dependency' => array('element' => 'enable_custom_link', 'not_empty' => true),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					'group' => esc_html__('Member info', 'dfd-native'),
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
					'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
					'group' => esc_html__('Typography', 'dfd-native'),
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
					'text' => esc_html__('Icon style', 'dfd-native'),
					'param_name' => 'icon_style',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
					'param_name' => 'icon_size',
					'value'=> 15,
					'min' => 0,
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom dfd-number-wrap crum_vc',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the color for the icon you have set for the content. The default icon color is #000','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
					'param_name' => 'icon_color',
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Text alignment', 'dfd-native'),
					'param_name' => 'thumb_t_heading',
					'class' => 'ult-param-heading',
					'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the text horizontally','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
					'param_name' => 'align',
					'edit_field_class' => 'no-top-margin no-border-bottom vc_column vc_col-sm-12',
					'options' => array(
						esc_html__('inherit', 'dfd-native') => '',
						esc_html__('Left', 'dfd-native') => 'left',
						esc_html__('Center', 'dfd-native') => 'center',
						esc_html__('Right', 'dfd-native') => 'right',
					),
					'value' => '',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Image options', 'dfd-native'),
					'param_name' => 'thumb_t_heading',
					'class' => 'ult-param-heading ',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the team member\'s thumbnail','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
					'param_name' => 'thumb_radius',
					'min' => 0,
					'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the team member\'s thumbnail','dfd-native').'</span></span>'.esc_html__('Shadow', 'dfd-native'),
					'param_name' => 'shadow',
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'options' => array(
						'show' => array(
							'on' => esc_html__('Yes', 'dfd-native'),
							'off' => esc_html__('No', 'dfd-native'),
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set when the shadow will be visible','dfd-native').'</span></span>'.esc_html__('Shadow visibility', 'dfd-native'),
					'param_name' => 'shadow_style',
					'options' => array(
						esc_html__('Permanent', 'dfd-native') => 'permanent',
						esc_html__('On hover', 'dfd-native') => 'hover',
					),
					'value'	=> 'permanent',
					'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
					'dependency' => array(
						'element' => 'shadow',
						'value' => array('show')
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_heading_param',
					'text' => esc_html__('Overlay', 'dfd-native') . ' ' . esc_html__('Color', 'dfd-native'),
					'param_name' => 'subtitle_h_heading',
					'class' => 'ult-param-heading',
					'dependency' => array(
						'element' => 'main_layout',
						'value' => array(
							'layout-13',
							'layout-17',
							'layout-18',
							'layout-19',
						),
					),
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the gradient overlay on the team member image','dfd-native').'</span></span>'.esc_html__('Overlay', 'dfd-native'),
					'param_name' => 'show_overlay',
					'value' => 'show',
					'edit_field_class' => 'vc_column vc_col-sm-12',
					'options' => array(
						'show' => array(
							'on' => esc_html__('Yes', 'dfd-native'),
							'off' => esc_html__('No', 'dfd-native'),
						),
					),
					'dependency' => array(
						'element' => 'main_layout',
						'value' => array(
							'layout-13',
							'layout-17',
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the gradient overlay. The default value is transparent','dfd-native').'</span></span>'.esc_html__('Start', 'dfd-native') . ' ' . esc_html__('color', 'dfd-native'),
					'param_name' => 'gradient_color1',
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency' => array(
						'element' => 'show_overlay',
						'value' => array(
							'show',
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the gradient overlay. The default value is #000 with opacity 50%','dfd-native').'</span></span>'.esc_html__('End', 'dfd-native') . ' ' . esc_html__('color', 'dfd-native'),
					'param_name' => 'gradient_color2',
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency' => array(
						'element' => 'show_overlay',
						'value' => array(
							'show',
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the overlay visible without hovering the team member\'s thumbnail','dfd-native').'</span></span>'.esc_html__('Overlay on image without hover', 'dfd-native'),
					'param_name' => 'show_overlay2',
					'value' => 'show',
					'edit_field_class' => 'vc_column vc_col-sm-12',
					'options' => array(
						'show' => array(
							'on' => esc_html__('Yes', 'dfd-native'),
							'off' => esc_html__('No', 'dfd-native'),
						),
					),
					'dependency' => array(
						'element' => 'main_layout',
						'value' => array(
							'layout-18',
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the gradient overlay. The default value is #000 with opacity 60%','dfd-native').'</span></span>'.esc_html__('Start', 'dfd-native') . ' ' . esc_html__('color', 'dfd-native'),
					'param_name' => 'gradient_color21',
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency' => array(
						'element' => 'main_layout',
						'value' => array(
							'layout-18',
							'layout-19',
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the gradient overlay. The default value is #000 with opacity 60%','dfd-native').'</span></span>'.esc_html__('End', 'dfd-native') . ' ' . esc_html__('color', 'dfd-native'),
					'param_name' => 'gradient_color22',
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					'dependency' => array(
						'element' => 'main_layout',
						'value' => array(
							'layout-18',
							'layout-19',
						),
					),
					'group' => esc_html__('Style', 'dfd-native'),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'param_name' => 'open_soc_custom_link',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to open link in a new tab or in current browser window','dfd-native').'</span></span>'.esc_html__('Open link', 'dfd-native'),
					'value'	=> 'new_tab',
					'options' => array(
						esc_html__('In a new tab', 'dfd-native') => 'new_tab',
						esc_html__('Current window', 'dfd-native') => 'this_page',
					),
					'group' => esc_html__('Soc accounts', 'dfd-native'),
				),
			), Dfd_Theme_Helpers::generate_soc_networks(Dfd_Theme_Helpers::social_networks())
		)
	)
);
