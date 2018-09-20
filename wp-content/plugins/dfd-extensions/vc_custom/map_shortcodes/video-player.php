<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Clients Videoplayer
*/

class WPBakeryShortCode_Dfd_Videoplayer extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/videoplayer/';
$dependency_on_style2 = array( "dependency" => array('element' => 'main_style', 'value' => array('style-2')));
vc_map(
	array(
		'name'        => esc_html__('Video Player', 'dfd-native'),
		'base'        => 'dfd_videoplayer',
		'class'       => 'dfd_videoplayer dfd_shortcode',
		'icon'       => 'dfd_videoplayer dfd_shortcode',
		'category'    => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Present the video on the page as a background or popup', 'dfd-native'),
		'params'      => array_merge(
			array(
				array(
					'heading'		=> esc_html__('Style', 'dfd-native'),
					'type'			=> 'radio_image_select',
					'param_name'	=> 'main_style',
					'simple_mode'	=> false,
					'options'		=> array(
						'style-1'		=> array(
							'tooltip'		=> esc_html__('Background', 'dfd-native'),
							'src'			=> $module_images . 'style-1.png'
						),
						'style-2'		=> array(
							'tooltip'		=> esc_html__('Simple', 'dfd-native'),
							'src'			=> $module_images . 'style-2.png'
						),
					),
				),
				array(
					'type'			=> 'number',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border radius for the video thumbnail','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
					'param_name'	=> 'gen_border_radius',
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-1')),
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				),
				array(
					'type'			=> 'dfd_radio_advanced',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the visibility options for shadow','dfd-native').'</span></span>'.esc_html__('Shadow visibility', 'dfd-native'),
					'param_name'	=> 'shadow',
					'value'			=> 'disable',
					'options'		=> array(
						esc_html__('Disable', 'dfd-native')	=> 'disable',
						esc_html__('Permanent', 'dfd-native')  => 'permanent',
						esc_html__('On hover', 'dfd-native')	=> 'on-hover'
					),
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-1')), 
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				),
				array(
					'type'				=> 'dfd_box_shadow_param',
					'heading'			=> '',
					'param_name'		=> 'video_box_shadow',
					'value'				=> 'box_shadow_enable:enable|shadow_horizontal:0|shadow_vertical:25|shadow_blur:70|shadow_spread:0|box_shadow_color:rgba(0%2C0%2C0%2C0.5)',
					'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc dfd-shadow-button-hide',
					'dependency'		=> array('element' => 'shadow', 'value' => array('permanent', 'on-hover')),
				),
				array_merge(
					array(
						'type'			=> 'dropdown',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the full screen video','dfd-native').'</span></span>'.esc_html__('Full screen video', 'dfd-native').' '.esc_html__('animation', 'dfd-native'),
						'param_name'	=> 'video_animation',
						'value'			=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
					),
					$dependency_on_style2
				),
				array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
					'param_name'	=> 'module_animation',
					'value'			=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
					'param_name'	=> 'el_class',
				),
				array(
					'type'			=> 'dfd_video_link_param',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
					'param_name'	=> 'tutorials',
					'doc_link'		=> '//nativewptheme.net/support/visual-composer/video-player',
					'video_link'	=> 'https://youtu.be/sa83MxePjjA',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Title', 'dfd-native'),
					'param_name'	=> 'title',
					'value'			=> esc_html__('Title', 'dfd-native'),
					'admin_label'	=> true,
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-2')),
					'group'			=> esc_html__('Content', 'dfd-native'),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Subtitle', 'dfd-native'),
					'param_name'	=> 'subtitle',
					'value'			=> esc_html__('Subtitle', 'dfd-native'),
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-2')),
					'group'			=> esc_html__('Content', 'dfd-native'),
				),
				array(
					'type'			=> 'dfd_radio_advanced',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('','dfd-native').'</span></span>'.esc_html__('Video options', 'dfd-native'),
					'param_name'	=> 'video_options',
					'value'			=> 'default',
					'options'		=> array(
						esc_html__('YouTube/Vimeo', 'dfd-native')	=> 'default',
						esc_html__('Self Hosted', 'dfd-native')  => 'selfhosted',
					),
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-1')), 
					'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
					'group'			=> esc_html__('Content', 'dfd-native'),
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload or select video thumbnail image from media gallery','dfd-native').'</span></span>'.esc_html__('Thumbnail Image', 'dfd-native'),
					'param_name'	=> 'video_thumb',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-1')), 
					'group'			=> esc_html__('Content', 'dfd-native'),
				),
				array(
					'type'			=> 'number',
					'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the video thumbnail','dfd-native').'</span></span>'.esc_html__('Thumbnail width', 'dfd-native'),
					'param_name'	=> 'content_width',
					'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
					'dependency'	=> array('element' => 'main_style', 'value' => array('style-1')), 
					'group'			=> esc_html__('Content', 'dfd-native'),

				),
				array(
					'type'			=> 'textfield',
					'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the link to the video','dfd-native').'</span></span>'.esc_html__('Video link', 'dfd-native'),
					'param_name'	=> 'video_link',
					'value'			=> 'https://www.youtube.com/watch?v=OZpGlQWAbrs&feature=youtu.be',
					'group'			=> esc_html__('Content', 'dfd-native'),
				),
				array_merge(
					array(
						'type'				=> 'dfd_heading_param',
						'text'				=> esc_html__('General Styles', 'dfd-native'),
						'param_name'		=> 'etc_h',
						'class'				=> 'ult-param-heading',
						'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'			=> 'dfd_radio_advanced',
						'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the video button','dfd-native').'</span></span>'.esc_html__('Button alignment', 'dfd-native'),
						'param_name'	=> 'button_align',
						'value'			=> 'text-center',
						'options'		=> array(
							esc_html__('Left', 'dfd-native')   => 'text-left',
							esc_html__('Center', 'dfd-native') => 'text-center',
							esc_html__('Right', 'dfd-native')  => 'text-right'
						),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
						'group'			=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'dfd_single_checkbox',
						'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the full width button according to the row/column width','dfd-native').'</span></span>'.esc_html__('Full width button', 'dfd-native'),
						'param_name'		=> 'full_width_background',
						'options'			=> array(
							'full_width'		=> array(
								'on'			=> esc_attr__('Yes', 'dfd-native'),
								'off'			=> esc_attr__('No', 'dfd-native'),
							),
						),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'colorpicker',
						'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the video module. The color is not set by default','dfd-native').'</span></span>'.esc_html__('Background color', 'dfd-native'),
						'param_name'		=> 'main_background',
						'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6 no-border-bottom',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'colorpicker',
						'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background hover color for the video module. The color is not set by default','dfd-native').'</span></span>'.esc_html__('Background color on hover', 'dfd-native'),
						'param_name'		=> 'main_background_hover',
						'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6 no-border-bottom',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'dfd_heading_param',
						'text'				=> esc_html__('Border', 'dfd-native'),
						'param_name'		=> 'gen_border_heading',
						'class'				=> 'ult-param-heading',
						'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'dfd_param_border',
						'param_name'		=> 'main_border',
						'simple'			=> false,
						'unit'				=> 'px',
						'enable_radius'		=> true,
						'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
						'value'				=> 'border_style:solid|border_width:1|border_radius:33',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'dfd_heading_param',
						'text'				=> esc_html__('Border on hover', 'dfd-native'),
						'param_name'		=> 'gen_border_hover_heading',
						'class'				=> 'ult-param-heading',
						'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array_merge(
					array(
						'type'				=> 'dfd_param_border',
						'param_name'		=> 'main_border_hover',
						'simple'			=> false,
						'unit'				=> 'px',
						'enable_radius'		=> true,
						'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
						'value'				=> 'border_style:solid|border_width:1|border_radius:33',
						'group'				=> esc_html__('Style', 'dfd-native'),
					),
					$dependency_on_style2
				),
				array(
					'type'				=> 'dfd_heading_param',
					'text'				=> esc_html__('Icon Style', 'dfd-native'),
					'param_name'		=> 'ic_t_h',
					'class'				=> 'ult-param-heading',
					'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',									
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color is #fff','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
					'param_name'		=> 'icon_color',
					'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6',
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon hover color. The default color is #fff','dfd-native').'</span></span>'.esc_html__('Icon hover color', 'dfd-native'),
					'param_name'		=> 'icon_hover_color',
					'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6',
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon background color. The default color for the style Background is #000 with opacity 50%. The default color for the style Simple is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Icon background', 'dfd-native'),
					'param_name'		=> 'icon_background',
					'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6',
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'colorpicker',
					'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon background color. The default color for the style Background is #000 with opacity 50%. The default color for the style Simple is inherited from Theme Options > Styling Options > Main site color darker for 7%','dfd-native').'</span></span>'.esc_html__('Icon hover background', 'dfd-native'),
					'param_name'		=> 'icon_hover_background',
					'edit_field_class'	=> 'vc_column crum_vc vc_col-sm-6',
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'number',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background size for the icon. The default value for style "Background" is 80px. The default value for style "Simple" 66px','dfd-native').'</span></span>'.esc_html__('Icon background size', 'dfd-native'),
					'param_name'		=> 'icon_bg_size',
					'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-border-bottom',
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'number',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the size for the icon. The default value for the style "Background" is 32px. The default value for the style "Simple" is 25px','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
					'param_name'		=> 'icon_font_size',
					'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-border-bottom',
					'dependency'		=> array('element' => 'icon_bg_size', 'not_empty' => true),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'number',
					'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to move the icon on "x" axis. The icon is placed in the middle, but it may seem to be side aligned due to icon shape ','dfd-native').'</span></span>'.esc_html__('Horizontal offset', 'dfd-native'),
					'param_name'		=> 'icon_x_offset',
					'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-border-bottom',
					'dependency'		=> array('element' => 'icon_bg_size', 'not_empty' => true),
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_heading_param',
					'text'				=> esc_html__('Border for the icon', 'dfd-native'),
					'param_name'		=> 'border_st_heading',
					'class'				=> 'ult-param-heading',
					'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',									
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_param_border',
					'param_name'		=> 'icon_border',
					'simple'			=> false,
					'unit'				=> 'px',
					'enable_radius'		=> true,
					'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
					'value'				=> 'border_style:none',
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_heading_param',
					'text'				=> esc_html__('Border for the icon on hover', 'dfd-native'),
					'param_name'		=> 'border_st_heading_hov',
					'class'				=> 'ult-param-heading',
					'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',									
					'group'				=> esc_html__('Style', 'dfd-native'),
				),
				array(
					'type'				=> 'dfd_param_border',
					'param_name'		=> 'icon_hover_border',
					'simple'			=> false,
					'unit'				=> 'px',
					'enable_radius'		=> true,
					'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
					'value'				=> 'border_style:none',
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
							'tag' => 'div',
							'font_size',
							'letter_spacing',
							'line_height',
							'color',
							'font_style'
						),
					),
					'edit_field_class'	=> 'vc_column vc_col-sm-12',
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
						'fields'		=> array(
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
							'font_size',
							'letter_spacing',
							'color',
							'font_style'
						),
					),
					'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
					'group'				=> esc_html__('Typography', 'dfd-native'),
				),
			)
		)
	)
);