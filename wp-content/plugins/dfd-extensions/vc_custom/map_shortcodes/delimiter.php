<?php

if (!defined('ABSPATH')) {
	exit;
}

class WPBakeryShortCode_Dfd_Delimiter extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/delimiter/';

vc_map(
	array (
		'name' => esc_html__('Delimiter', 'dfd-native'),
		'base' => 'dfd_delimiter',
		'class' => 'dfd_delimiter dfd_shortcode',
		'controls' => 'full',
		'show_settings_on_create' => true,
		'icon' => 'dfd_delimiter dfd_shortcode',
		'description' => esc_html__('Delimiter line allows to separate the content', 'dfd-native'),
		'category' => esc_html__('Native', 'dfd-native'),
		'params' => array (
			array (
				'heading' => esc_html__('Style', 'dfd-native'),
				'type' => 'radio_image_select',
				'param_name' => 'delimiter_style',
				'simple_mode' => false,
				'options' => array (
					'dfd-delimiter-with-arrow' => array (
						'tooltip' => esc_attr__('To top', 'dfd-native'),
						'src' => $module_images . 'style-1.png'
					),
					'dfd-delimiter-with-line' => array (
						'tooltip' => esc_attr__('Standard', 'dfd-native'),
						'src' => $module_images . 'style-2.png'
					),
					'dfd-delimiter-with-icon' => array (
						'tooltip' => esc_attr__('With icon', 'dfd-native'),
						'src' => $module_images . 'style-3.png'
					),
					'dfd-delimiter-with-text' => array (
						'tooltip' => esc_attr__('With text', 'dfd-native'),
						'src' => $module_images . 'style-4.png'
					),
					'dfd-delimiter-with-image' => array (
						'tooltip' => esc_attr__('Image delimiter', 'dfd-native'),
						'src' => $module_images . 'style-5.png'
					),
				),
				"value"=>"dfd-delimiter-with-arrow"
			),
			array (
				'type' => 'textfield',
				'heading' => esc_html__('Delimiter text', 'dfd-native'),
				'param_name' => 'text_delimiter',
				'value' => 'Delimiter text',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-text")),
			),
			array (
				'type' => 'attach_image',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image or choose from the media library. Notice: The image will be shown in its origin size.','dfd-native').'</span></span>'.esc_html__('Image', 'dfd-native'),
				'param_name' => 'image',
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-image")),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'text_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter text color. The default value is inherited from Theme Options > Typography/Fonts > Headings typography > Content title small Typography','dfd-native').'</span></span>'.esc_html__('Text color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-text")),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'text_bg_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter text background color. The default background color is transparent','dfd-native').'</span></span>'.esc_html__('Text background color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-text")),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'icon_color',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the delimiter icon. The default color is #1b1b1b','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow", "dfd-delimiter-with-icon")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'icon_hover_color',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the delimiter icon. The default hover color for the to top style is #fff. The default hover color for the with icon style is #1b1b1b','dfd-native').'</span></span>'.esc_html__('Icon hover color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow", "dfd-delimiter-with-icon")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'content_bg_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the icon. The background color by default is not set','dfd-native').'</span></span>'.esc_html__('Icon background color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'content_bg_hover_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background hover color for the icon. The default background hover color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Icon background hover color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the icon size. The minimum value is 10px','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name' => 'icon_size',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow", "dfd-delimiter-with-icon")),
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'value'=> 10,
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'delim_circle_line_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the circle border color for the icon. The default border color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__('Circle border color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-4',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow")),
				'group'	=> esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'delim_hover_circle_line_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the circle border hover color for the icon. The default border hover color is transparent','dfd-native').'</span></span>'.esc_html__('Circle border hover color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-4',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-arrow")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter height', 'dfd-native'),
				'param_name' => 'delimiter_height',
				'edit_field_class' => 'vc_column vc_col-sm-3 dfd-number-wrap crum_vc',
				'value'=>"1",
				'dependency' => array ('element' => 'delimiter_style', 'value_not_equal_to' => array ("dfd-delimiter-with-image")),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set','dfd-native').'</span></span>'.esc_html__('Image repeating', 'dfd-native'),
				'param_name' => 'repeat_image',
				'value' => 'show',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-image")),
			),
			array (
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the image horizontally','dfd-native').'</span></span>'.esc_html__('Image alignment', 'dfd-native'),
				'param_name' => 'align_image',
				'value' => 'left',
				'options' => array (
					esc_html__('left', 'dfd-native') => 'left',
					esc_html__('center', 'dfd-native') => 'center',
					esc_html__('right', 'dfd-native') => 'right',
				),
				'dependency' => array ('element' => 'repeat_image', 'value_not_equal_to' => "show"),
			),
			array (
				'type' => 'dfd_radio_advanced',
				'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the delimiter\'s styles','dfd-native').'</span></span>'. esc_html__('Delimiter style', 'dfd-native'),
				'param_name' => 'delimiter_border_style',
				'value' => 'solid',
				'options' => array (
					esc_attr__('Solid', 'dfd-native') => 'solid',
					esc_attr__('Dashed', 'dfd-native') => 'dashed',
					esc_attr__('Dotted', 'dfd-native') => 'dotted',
					esc_attr__('Double', 'dfd-native') => 'double',
					esc_attr__('Inset', 'dfd-native') => 'inset',
					esc_attr__('Outset', 'dfd-native') => 'outset',
				),
				'edit_field_class' => 'vc_column vc_col-sm-9 crum_vc',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ('dfd-delimiter-with-arrow', 'dfd-delimiter-with-line', 'dfd-delimiter-with-icon', 'dfd-delimiter-with-text')),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'delim_line_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimter color. The default color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'. esc_html__('Delimiter color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-12',
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-line", "dfd-delimiter-with-arrow", "dfd-delimiter-with-icon", "dfd-delimiter-with-text")),
			),
			array (
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'title_font_options',
				'settings' => array (
					'fields' => array (
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style'
					),
				),
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-text")),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name' => 'use_google_fonts',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-text")),
				'group' => esc_attr__('Typography', 'dfd-native'),
			),
			array (
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts',
				'value' => '',
				'group' => esc_attr__('Typography', 'dfd-native'),
				'settings' => array (
					'fields' => array (
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array ('element' => 'use_google_fonts', 'value' => 'show'),
			),
			array(
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Delimiter text responsive settings', 'dfd-native'),
				'param_name'		=> 'delimiter_text_responsive',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'dependency'		=> array ('element' => 'delimiter_style', 'value' => array('dfd-delimiter-with-text')),
				'group'				=> esc_html__('Responsive', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set cusom icon for the delimiter','dfd-native').'</span></span>'.esc_html__('Custom icon', 'dfd-native'),
				'param_name' => 'show_icon',
				'options' => array (
					'enable_icon' => array (
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency' => array ('element' => 'delimiter_style', 'value' => array ("dfd-delimiter-with-icon", "dfd-delimiter-with-arrow")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => esc_html__('Icon library', 'dfd-native'),
				'param_name' => 'select_icon',
				'value' => 'dfd_icons',
				'options' => Dfd_Theme_Helpers::build_vc_icons_fonts_list(false),
				'dependency' => array ('element' => 'show_icon', 'value' => array ("enable_icon")),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			array (
				'type' => 'iconpicker',
				'heading' => esc_html__('Select Icon ', 'dfd-native'),
				'param_name' => 'ic_dfd_icons',
				'settings' => array (
						'emptyIcon' => false,
						'type' => 'dfd_icons',
						'iconsPerPage' => 400,
				),
				'dependency' => array ('element' => 'select_icon', 'value' => 'dfd_icons',),
				'group' => esc_html__('Icon', 'dfd-native'),
			),
			Dfd_Theme_Helpers::build_vc_icons_param('fontawesome', esc_html__('Icon', 'dfd-native'), array ()),
			Dfd_Theme_Helpers::build_vc_icons_param('openiconic', esc_html__('Icon', 'dfd-native'), array ()),
			Dfd_Theme_Helpers::build_vc_icons_param('typicons', esc_html__('Icon', 'dfd-native'), array ()),
			Dfd_Theme_Helpers::build_vc_icons_param('entypo', esc_html__('Icon', 'dfd-native'), array ()),
			Dfd_Theme_Helpers::build_vc_icons_param('linecons', esc_html__('Icon', 'dfd-native'), array ()),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array (
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name' => 'module_animation',
				'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array (
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/delimiters',
				'video_link'		=> 'https://www.youtube.com/watch?v=QU2a4_JXggk',
			),
		)
	)
);