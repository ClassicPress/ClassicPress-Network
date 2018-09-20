<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Piecharts Line
*/

class WPBakeryShortCode_Dfd_Piecharts extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/piecharts/';
vc_map(
	array(
		'name'					=> esc_html__('Pie Chart', 'dfd-native'),
		'base'					=> 'dfd_piecharts',
		'class'					=> 'dfd_piecharts dfd_shortcode',
		'icon'					=> 'dfd_piecharts dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'description'			=> esc_html__('Display animated pie chart', 'dfd-native'),
		'params'				=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Simple', 'dfd-native'),
						'src'				=> $module_images . 'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Icon inside', 'dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('Icon near title', 'dfd-native'),
						'src'				=> $module_images . 'style-3.png'
					),
					'style-4'			=> array(
						'tooltip'			=> esc_html__('Number near title', 'dfd-native'),
						'src'				=> $module_images . 'style-4.png'
					),
				),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number you would like to display in pie chart','dfd-native').'</span></span>'.esc_html__('Number', 'dfd-native'),
				'param_name'		=> 'percent',
				'value'				=> 75,
				'min'				=> '10',
				'max'				=> '100',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the measuring units you\'d like to display in the pie chart','dfd-native').'</span></span>'.esc_html__('Measuring unit', 'dfd-native'),
				'param_name'		=> 'unit',
				'value'				=> esc_html__('%', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the size of the pie chart circle','dfd-native').'</span></span>'.esc_html__('Circle size', 'dfd-native'),
				'param_name'		=> 'size',
				'value'				=> 160,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the circle animation','dfd-native').'</span></span>'.esc_html__('Circle animation', 'dfd-native'),
				'param_name'		=> 'animation_off',
				'value'				=> 'disable_animation',
				'options'			=> array(
					'disable_animation'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the direction for the animation','dfd-native').'</span></span>'.esc_html__('Anticlockwise ', 'dfd-native'),
				'param_name'		=> 'clock_wise',
				'options'			=> array(
					'counterclock'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/pie-charts',
				'video_link' => 'https://www.youtube.com/watch?v=RNX3lvSgBTg&feature=youtu.be',
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Title', 'dfd-native'),
				'param_name'		=> 'title',
				'value'				=> esc_html__('Shortcode heading', 'dfd-native'),
				'admin_label'		=> true,
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Subtitle', 'dfd-native'),
				'param_name'		=> 'subtitle',
				'value'				=> esc_html__('Shortcode subheading', 'dfd-native'),
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-12',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text', 'dfd-native').'</span></span>'.esc_html__('Icon to display', 'dfd-native'),
				'param_name'		=> 'icon_type',
				'value'				=> 'selector',
				'options'			=> array(
					esc_html__('Icon','dfd-native')	=> 'selector',
					esc_html__('Image','dfd-native')	=> 'custom',
					esc_html__('Text', 'dfd-native')	=> 'text',
				),
				'dependency'		=> array('element' => 'main_style', 'value'	=> array( 'style-2', 'style-3', 'style-4')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> esc_html__('Icon library', 'dfd-native'),
				'param_name'		=> 'select_icon',
				'value'				=> 'dfd_icons',
				'options'			=> Dfd_Theme_Helpers::build_vc_icons_fonts_list(false),
				'dependency'		=> array('element' => 'icon_type', 'value' => 'selector',),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'iconpicker',
				'heading'			=> esc_html__('Select Icon', 'dfd-native'),
				'param_name'		=> 'ic_dfd_icons',
				'value'				=> 'dfd-socicon-px-icon',
				'settings'				=> array(
					'emptyIcon'				=> false,
					'type'					=> 'dfd_icons',
					'iconsPerPage'			=> 4000,
				),
				'dependency'		=> array('element' => 'select_icon', 'value' => 'dfd_icons',),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			Dfd_Theme_Helpers::build_vc_icons_param('fontawesome', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('openiconic', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('typicons', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('entypo', esc_html__('Content', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('linecons', esc_html__('Content', 'dfd-native'), array()),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from the media library','dfd-native').'</span></span>'.esc_html__('Upload Image', 'dfd-native'),
				'param_name'		=> 'icon_image_id',
				'description'		=> esc_html__('Upload the custom image.', 'dfd-native'),
				'dependency'		=> array('element' => 'icon_type','value' => array('custom')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Text', 'dfd-native'),
				'param_name'		=> 'icon_text',
				'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the size for the icon (image)','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'icon_type', 'value'   => array('custom', 'selector')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the icon. For the Number Near Icon style the default color is #000.  For the other styles the default color is #d9d9d9','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				'dependency'		=> array('element' => 'icon_type', 'value' => array('selector')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'text_icon_font_options',
				'settings'			=> array(
					'fields'		=> array(
						'font_size',
						'letter_spacing',
						'color',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'text_icon_use_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'text_icon_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'text_icon_use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Circle gradient', 'dfd-native'),
				'param_name'		=> 'f_s_h',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the pie chart circle. The default value is #3498db','dfd-native').'</span></span>'. esc_html__('Start color', 'dfd-native' ),
				'param_name'		=> 'fill_color_start',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the pie chart circle. The default value is #3498db','dfd-native').'</span></span>'.esc_html__('End color', 'dfd-native' ),
				'param_name'		=> 'fill_color_end',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the pie chart circle','dfd-native').'</span></span>'.esc_html__('Width', 'dfd-native'),
				'param_name'		=> 'fill_width',
				'value'				=> 7,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Border style', 'dfd-native'),
				'param_name'		=> 'b_s_h',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'bg_border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the border','dfd-native').'</span></span>'.esc_html__('Width', 'dfd-native'),
				'param_name'		=> 'bg_width',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Number Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'percent', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'letter_spacing',
						'color'
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'percent', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
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
						'tag'				=> 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
					),
				),
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		)
	)
);