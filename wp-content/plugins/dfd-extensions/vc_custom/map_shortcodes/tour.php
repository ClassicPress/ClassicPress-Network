<?php

if (!defined('ABSPATH')) {
	exit;
}
/*
 * Add-on Name: Announcement Line
 */
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Tour');

class WPBakeryShortCode_dfd_tta_tour extends WPBakeryShortCode_VC_Tta_Tour {

	public function getFileName() {
		return 'dfd_tta_global';
	}

}

$module_images_accordion = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/tour/';

vc_map(array(
	'name' => esc_html__('DFD Tour', 'dfd-native'),
	'base' => 'dfd_tta_tour',
	'icon' => 'dfd_tta_tour dfd_shortcode',
	'class' => 'dfd_tta_tour dfd_shortcode',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'vc_tta_section',
	),
	'category' => esc_html__('Native', 'dfd-native'),
	'description' => esc_html__('Vertical tabbed content', 'dfd-native'),
	'params' => array(
		array(
			'type' => 'radio_image_select',
			'heading' => esc_html__('Style', 'dfd-native'),
			'param_name' => 'style',
			'simple_mode' => false,
			'options' => array(
				'style-6' => array(
					'tooltip' => esc_attr__('Classic', 'dfd-native'),
					'src' => $module_images_accordion . 'style-6.png'
				),
				'style-7' => array(
					'tooltip' => esc_attr__('Underline', 'dfd-native'),
					'src' => $module_images_accordion . 'style-7.png'
				),
				'style-8' => array(
					'tooltip' => esc_attr__('Active tour border', 'dfd-native'),
					'src' => $module_images_accordion . 'style-8.png'
				),
				'style-9' => array(
					'tooltip' => esc_attr__('Active tour background', 'dfd-native'),
					'src' => $module_images_accordion . 'style-9.png'
				),
			),
			"value" => "style-6",
		),
		array(
			'type' => 'dfd_radio_advanced',
			'param_name' => 'tab_position',
			'options' => array(
				esc_html__('Left', 'dfd-native') => 'left',
				esc_html__('Right', 'dfd-native') => 'right',
			),
			'value' => 'left',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select tour sections position.','dfd-native').'</span></span>'.esc_html__('Position', 'dfd-native'),
			'group' => 'Tour Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for inactive tours. The background is not set by default','dfd-native').'</span></span>'.esc_html__("Background color", 'dfd-native'),
			"param_name" => "tab_background",
			'dependency' => Array('element' => 'style', 'value' => array("style-6")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tour Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background hover color for inactive tours. The background is not set by default','dfd-native').'</span></span>'.esc_html__("Hover background color", 'dfd-native'),
			"param_name" => "tab_hover_background",
			'dependency' => Array('element' => 'style', 'value' => array("style-6")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tour Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the active tour. The default background color for style Classic is inherited from Theme Options > Styling Options > Second site color. The color for the styles Active Tour Border and Active Tour Border is not set by default','dfd-native').'</span></span>'.esc_html__("Active tour background color", 'dfd-native'),
			"param_name" => "active_tab_background",
			'dependency' => Array('element' => 'style', 'value' => array("style-6", "style-8", "style-9")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tour Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__("Border Color", 'dfd-native'),
			"param_name" => "border_color_radius",
			'dependency' => Array('element' => 'style', 'value' => array("style-6")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tour Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the active tour','dfd-native').'</span></span>'.esc_html__('Active tour border radius', 'dfd-native'),
			'param_name' => 'border_radius_active_tab',
			'value' => '21',
			'dependency' => Array('element' => 'style', 'value' => array("style-8", "style-9")),
			'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
			'group' => "Tour Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border hover color. The default border hover color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__("Border hover color", 'dfd-native'),
			"param_name" => "border_hover_color",
			'dependency' => Array('element' => 'style', 'value' => array("style-6")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => "Tour Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color for the active tour. For the style Underline it will be set as underline color for the active tour. The default underline color for the style Underline is inherited from Theme Options > Styling Options > Main site color. The default border color for others styles is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Active tour border color", 'dfd-native'),
			"param_name" => "border_color_active",
			'dependency' => Array('element' => 'style', 'value' => array("style-6", "style-7", "style-8")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tour Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border width for the active tour','dfd-native').'</span></span>'.esc_html__('Active tour border width', 'dfd-native'),
			'param_name' => 'border_width_active_tab',
			'value' => '2',
			'min' => 1,
			'max' => 10,
			'dependency' => Array('element' => 'style', 'value' => array("style-7", "style-8")),
			'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
			'group' => "Tour Style",
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border width for the tours','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
			'param_name' => 'border_width',
			'value' => '1',
			'min' => 1,
			'max' => 10,
			'dependency' => Array('element' => 'style', 'value' => array("style-6")),
			'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
			'group' => "Tour Style",
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the tours','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
			'param_name' => 'border_radius',
			'edit_field_class' => 'vc_column vc_col-sm-6',
			'value' => '21',
			'min' => 1,
			'max' => 10,
			'dependency' => Array('element' => 'style', 'value' => array("style-6")),
			'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
			'group' => 'Tour Style'
		),
		array(
			'type' => 'dfd_single_checkbox',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the underline for inactive tour','dfd-native').'</span></span>'.esc_html__('Underline on inactive tour', 'dfd-native'),
			'param_name' => 'show_underline',
			'value' => 'on',
			'options' => array(
				'on' => array(
					'on' => 'Yes',
					'off' => 'No',
				),
			),
			'dependency' => Array('element' => 'style', 'value' => array("style-7", "style-8", "style-9")),
			'weight' => 400,
			'group' => 'Tour Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the underline height','dfd-native').'</span></span>'.esc_html__('Underline height', 'dfd-native'),
			'param_name' => 'underline_height',
			'value' => '1',
			'min' => 1,
			'max' => 10,
			'dependency' => Array('element' => 'show_underline', 'value' => array("on")),
			'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
			'group' => "Tour Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline color for the inactive tours. The default underline color is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Underline color", 'dfd-native'),
			"param_name" => "underline_color",
			'dependency' => Array('element' => 'show_underline', 'value' => array("on")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => "Tour Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline hover color for the inactive tours. The default underline hover color is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Underline hover color", 'dfd-native'),
			"param_name" => "underline_hover_color",
			'dependency' => Array('element' => 'show_underline', 'value' => array("on")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => "Tour Style",
		),
		array(
			'type' => 'textfield',
			'param_name' => 'active_section',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of the section which should be active on page load. Note: to have all sections closed on initial load enter non-existing number.','dfd-native').'</span></span>'.esc_html__('Active section', 'dfd-native'),
			'value' => 1,
			'group' => 'Tour Style'
		),
		array(
			'type' => 'dfd_radio_advanced',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the width for the tour setcions.','dfd-native').'</span></span>'.esc_html__('Section width', 'dfd-native'),
			'param_name' => 'controls_size',
			'options' => array(
				esc_html__('Medium', 'dfd-native') => 'md',
				esc_html__('Auto', 'dfd-native') => '',
				esc_html__('Extra large', 'dfd-native') => 'xl',
				esc_html__('Large', 'dfd-native') => 'lg',
				esc_html__('Small', 'dfd-native') => 'sm',
				esc_html__('Extra small', 'dfd-native') => 'xs',
			),
			'value' => 'md',
			'group' => 'Tour Style'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Spacing', 'dfd-native'),
			'param_name' => 'spacing',
			'value' => array(
				esc_html__('None', 'dfd-native') => '',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'description' => esc_html__('Select tour spacing.', 'dfd-native'),
			'std' => '5',
			'edit_field_class' => 'dfd_vc_hide',
			'group' => 'Tour Style'
		),
		array(
			'type' => 'dfd_radio_advanced',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom "><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select tour section title alignment.','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
			'param_name' => 'alignment',
			'options' => array(
				esc_html__('Left', 'dfd-native') => 'left',
				esc_html__('Center', 'dfd-native') => 'center',
				esc_html__('Right', 'dfd-native') => 'right',
			),
			'value' => 'center',
			'edit_field_class' => 'vc_column crum_vc vc_col-sm-6 no-top-padding',
			'group' => 'Title Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the tour\'s title','dfd-native').'</span></span>'.esc_html__('Font size', 'dfd-native'),
			'param_name' => 'font_size',
			'value' => '11',
			'min' => 1,
			'max' => 100,
			'edit_field_class' => 'dfd-number-wrap vc_column crum_vc vc_col-sm-6 no-top-padding',	
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the title. The default color is #28262b','dfd-native').'</span></span>'.esc_html__("Title color", 'dfd-native'),
			"param_name" => "tab_text_color",
			'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the active tour title. The default color is #28262b','dfd-native').'</span></span>'.esc_html__("Active tour title color", 'dfd-native'),
			"param_name" => "tab_active_color_text",
			'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the title. The default color is inheried from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__("Title hover color", 'dfd-native'),
			"param_name" => "tab_hover_text_color",
			'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color is #28262b','dfd-native').'</span></span>'. esc_html__("Icon color", 'dfd-native'),
			"param_name" => "icon_color",
			'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-top-padding',
			'group' => 'Icon Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon hover color. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__("Icon hover color", 'dfd-native'),
			"param_name" => "icon_hover_color",
			'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-top-padding',
			'group' => 'Icon Style'
		),
		array(
			"type" => "colorpicker",
			"heading" =>'<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color for the active tour. The default color is #28262b','dfd-native').'</span></span>'. esc_html__("Active tour icon color", 'dfd-native'),
			"param_name" => "icon_active_color",
			'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-top-padding',
			'group' => 'Icon Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
			'param_name' => 'icon_size',
			'value' => '15',
			'min' => 1,
			'max' => 100,
			'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
			'group' => 'Icon Style'
		),
		array(
			'type' => 'dropdown',
			'param_name' => 'gap',
			'value' => array(
				'20px' => '20',
				esc_html__('None', 'dfd-native') => '',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'heading' => esc_html__('Gap', 'dfd-native'),
			'description' => esc_html__('Select tour gap.', 'dfd-native'),
			'edit_field_class' => 'dfd_vc_hide vc_column vc_col-sm-6',
			'group' => ''
		),
		array(
			'type' => 'dfd_single_checkbox',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the separator line under tour\'s content','dfd-native').'</span></span>'.esc_html__('Separator line under content', 'dfd-native'),
			'param_name' => 'show_separator_line',
			'options' => array(
				'on' => array(
					'on' => 'Yes',
					'off' => 'No',
				),
			),
			'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
			'group' => 'Content Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the separator line color. The default color is #28262b with opacity 20%','dfd-native').'</span></span>'.esc_html__("Separator color", 'dfd-native'),
			"param_name" => "separator_color",
			'dependency' => array('element' => 'show_separator_line', 'value' => array("on")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding no-border-bottom',
			'group' => 'Content Style'
		),
		array(
			'type' => 'dfd_single_checkbox',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the pagination dots for your tours','dfd-native').'</span></span>'.esc_html__('Pagination', 'dfd-native'),
			'param_name' => 'use_pagination',
			'options' => array(
				'on' => array(
					'on' => 'Yes',
					'off' => 'No',
				),
			),
			'weight' => 400,
			'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding no-border-bottom',
			'group' => 'Content Style'
		),
		array(
			'type' => 'radio_image_select',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 10 preset pagination styles','dfd-native').'</span></span>'.esc_html__('Pagination style', 'dfd-native'),
			'param_name' => 'pagination_style',
			'simple_mode' => false,
			'options' => array(
				'dfdrounded-' => array(
					'tooltip' => esc_attr__('Rounded', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_1.png'
				),
				'dfdfillrounded-' => array(
					'tooltip' => esc_attr__('Filled rounded', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_2.png'
				),
				'dfdemptyrounded-' => array(
					'tooltip' => esc_attr__('Transparent rounded', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_3.png'
				),
				'dfdfillsquare-' => array(
					'tooltip' => esc_attr__('Filled square', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
				),
				'dfdsquare-' => array(
					'tooltip' => esc_attr__('Square', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_6.png'
				),
				'dfdemptysquare-' => array(
					'tooltip' => esc_attr__('Transparent square', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_8.png'
				),
				'dfdline-' => array(
					'tooltip' => esc_attr__('Line', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_4.png'
				),
				'dfdadvancesquare-' => array(
					'tooltip' => esc_attr__('Advanced square', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_5.png'
				),
				'dfdroundedempty-' => array(
					'tooltip' => esc_attr__('Rounded Empty', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_9.png'
				),
				'dfdroundedfilled-' => array(
					'tooltip' => esc_attr__('Rounded Filled', 'dfd-native'),
					'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_10.png'
				),
			),
			'dependency' => Array('element' => 'use_pagination', 'value' => array('on')),
			'group' => 'Content Style'
		),
		array(
			'type' => 'dfd_radio_advanced',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable the automatical tours rotation, choose the periodicity of tours rotation in seconds.','dfd-native').'</span></span>'.esc_html__('Autorotate', 'dfd-native'),
			'param_name' => 'autoplay',
			'options' => array(
				esc_html__('None', 'dfd-native') => 'none',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'10' => '10',
				'20' => '20',
				'30' => '30',
				'40' => '40',
				'50' => '50',
				'60' => '60',
			),
			'value' => 'none',
			'group' => 'Tour Style'
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
			'doc_link' => '//nativewptheme.net/support/visual-composer/dfd-tours',
			'video_link' => 'https://www.youtube.com/watch?v=lOqNXYc1scQ&feature=youtu.be',
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'dfd-native'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'dfd-native'),
		),
	),
	'js_view' => 'VcBackendTtaTourView',
	'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-left vc_tta-controls-align-left">
<div class="vc_tta-tabs-container">'
	. '<ul class="vc_tta-tabs-list">'
	. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}"><a href="javascript:;" data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}" data-vc-tabs>{{ section_title }}</a></li>'
	. '</ul>
</div>
<div class="vc_tta-panels {{container-class}}">
{{ content }}
</div>
</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', esc_html__('Section', 'dfd-native'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', esc_html__('Section', 'dfd-native'), 2) . '"][/vc_tta_section]
',
	'admin_enqueue_js' => array(
		vc_asset_url('lib/vc_tabs/vc-tabs.min.js')
	),
	'front_enqueue_js' => get_template_directory_uri() .'/assets/js/tabsModelextended.js'
));
