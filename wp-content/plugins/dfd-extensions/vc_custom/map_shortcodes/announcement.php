<?php
/*
* Add-on Name: Announcement Line
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

class WPBakeryShortCode_Dfd_Announcement extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/announcement/';

vc_map(
	array(
		'name'        => esc_html__('Announcement', 'dfd-native'),
		'base'        => 'dfd_announcement',
		'class'       => 'dfd_announcement dfd_shortcode',
		'icon'        => 'dfd_announcement dfd_shortcode',
		'category'    => esc_html__( 'Native', 'dfd-native' ),
		'description' => esc_html__('Displays announcement with icon', 'dfd-native'),
		'params'      => array(
			array(
				'type'				=> 'radio_image_select',
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Simple','dfd-native'),
						'src'				=> $module_images . 'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Separated','dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the announcement alignment. This option is not available for Full width element','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
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
			'doc_link'			=> '//nativewptheme.net/support/visual-composer/announcement',
			'video_link'		=> 'https://www.youtube.com/watch?v=3el_GKi08lo&feature=youtu.be',
			),
			array(
				'type'				=> 'textarea',
				'heading'			=> esc_html__('Content', 'dfd-native'),
				'param_name'		=> 'content_announcement',
				'value'				=> esc_html__('You can add an Announcement content here.', 'dfd-native'),
				'admin_label'		=> true,
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon library','dfd-native').'</span></span>'.esc_html__('Icon library', 'dfd-native'),
				'param_name'		=> 'select_icon',
				'value'				=> 'dfd_icons',
				'options'			=> Dfd_Theme_Helpers::build_vc_icons_fonts_list(false),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'iconpicker',
				'heading'			=> esc_html__('Select Icon ', 'dfd-native'),
				'param_name'		=> 'ic_dfd_icons',
				'value'				=> 'dfd-socicon-icon-compose',
				'settings'			=> array(
					'emptyIcon'			=> false,
					'type'				=> 'dfd_icons',
					'iconsPerPage'		=> 4000,
				),
				'edit_field_class'	=> 'no-border-bottom vc_col-sm-12',
				'dependency'		=> array('element' => 'select_icon', 'value' => 'dfd_icons',),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			Dfd_Theme_Helpers::build_vc_icons_param('fontawesome', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('openiconic', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('typicons', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('entypo', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('linecons', esc_html__('Content', 'dfd-native'), array()),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('General styles', 'dfd-native'),
				'param_name'		=> 'general_styles',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the announcement. Default color is rgba(0,0,0,.05)','dfd-native').'</span></span>'.esc_html__('Background color', 'dfd-native'),
				'param_name'		=> 'background_fild',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the full width background for the announcement according to the row/column width','dfd-native').'</span></span>'.esc_html__('Full width element', 'dfd-native'),
				'param_name'		=> 'full_width_background',
				'options'			=> array(
					'show'			=> array(
						'on'			=> esc_attr__('Yes', 'dfd-native'),
						'off'			=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_border',
				'param_name'		=> 'main_border',
				'simple'			=> false,
				'unit'				=> 'px',
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12',
				'value'				=> 'border-style:none;|border-width:1px;|border-radius:0px;|border-color:transparent;',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Icon style', 'dfd-native'),
				'param_name'		=> 'general_styles',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'value'				=> 14,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the color for the icon. Default color is #464646','dfd-native').'</span></span>'.esc_html__( 'Color', 'dfd-native' ),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Default icon background is inherited from Theme Options > Styling options > Main site color','dfd-native').'</span></span>'.esc_html__('Icon background', 'dfd-native'),
				'param_name'		=> 'icon_bg',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => 'style-2'),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'content_announcement', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'		=> array(
						'font_size',
						'letter_spacing',
						'color',
						'font_style',
					),
				),
				'dependency'		=> array('element' => 'content_announcement', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'content_announcement', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'use_google_fonts', 'value'   => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);