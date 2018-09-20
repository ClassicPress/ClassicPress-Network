<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Countdown Line
*/
class WPBakeryShortCode_Dfd_Countdown extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/countdown/';
vc_map(
	array(
		'name'				=> esc_html__('Countdown', 'dfd-native'),
		'base'				=> 'dfd_countdown',
		'class'				=> 'dfd_countdown dfd_shortcode',
		'icon'				=> 'dfd_countdown dfd_shortcode',
		'category'			=> esc_html__('Native', 'dfd-native'),
		'description'		=> esc_html__('Display animated countdown block', 'dfd-native'),
		'params'			=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Simple','dfd-native'),
						'src'				=> $module_images . 'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Bordered','dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('Bordered number','dfd-native'),
						'src'				=> $module_images . 'style-3.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_datetimepicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Date and time format (yyyy/mm/dd hh:mm:ss)','dfd-native').'</span></span>'.esc_html__('Target time for countdown', 'dfd-native'),
				'param_name'		=> 'datetime',
				'admin_label'		=> true,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the alignment for the countdown','dfd-native').'</span></span>'.esc_html__('Countdown alignment', 'dfd-native'),
				'param_name'		=> 'count_alignment',
				'value'				=> 'text-center',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'checkbox',
				'heading'			=> esc_html__('Select time units to display in countdown timer', 'dfd-native'),
				'param_name'		=> 'countdown_opts',
				'value'				=> array(
					esc_html__('Years','dfd-native')	=> 'syear',
					esc_html__('Months','dfd-native')	=> 'smonth',
					esc_html__('Days','dfd-native')	=> 'sday',
					esc_html__('Hours','dfd-native')	=> 'shr',
					esc_html__('Minutes','dfd-native') => 'smin',
					esc_html__('Seconds','dfd-native') => 'ssec',
				),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Example : or / etc','dfd-native').'</span></span>'.esc_html__('Delimeter value', 'dfd-native'),
				'param_name'		=> 'delimeter_val',
				'value'				=> ':',
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/countdown',
				'video_link'		=> 'https://www.youtube.com/watch?v=5TkCpKTsubc',
			),
			array(
				'type'				=> 'dfd_param_border',
				'param_name'		=> 'main_border',
				'simple'			=> false,
				'unit'				=> 'px',
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12',
				'value'				=> 'border_style:solid|border_width:1|border_radius:10',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color. The background color is not set by default','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'bg_count_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Number', 'dfd-native'),
				'param_name'		=> 'nfh',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the number. The default size for the simple style is 45px. The default size for the bordered and bordered number styles is 35px','dfd-native').'</span></span>'.esc_html__('Font size', 'dfd-native'),
				'param_name'		=> 'number_font_size',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the number. The default color is inherited from Theme Options > Typography/Fonts > Headings typography > Content title big Typography','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'number_font_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc  no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Delimiter', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the delimiter. The default color is inherited from Theme Options > Typography/Fonts > Headings typography > Content title big Typography','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'font_options',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Time Units', 'dfd-native' ),
				'param_name'		=> 'tut',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the time units. The default size for the simple style is inherited from Theme Options > Typography/Fonts > Text typography > Default text Typography. The default size for the bordered and bordered number styles is 13px','dfd-native').'</span></span>'.esc_html__('Font size', 'dfd-native'),
				'param_name'		=> 'time_units_font_size',
				'min'				=> 1,
				'max'				=> 10,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the time units. The default color is inherited from Theme Options > Typography/Fonts > Text typography > Default text Typography','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'time_units_font_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
		),
	)
);