<?php

if (!defined('ABSPATH')) {
	exit;
}
/*
 * Add-on Name: Announcement Line
 */
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Tabs');

class WPBakeryShortCode_dfd_tta_tabs extends WPBakeryShortCode_VC_Tta_Tabs {

	public function getFileName() {
		return 'dfd_tta_global';
	}

}

$module_images_accordion = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/tabs/';

vc_map(array(
	'name' => esc_html__('DFD Tabs', 'dfd-native'),
	'base' => 'dfd_tta_tabs',
	'icon' => 'dfd_tabs dfd_shortcode',
	'class' => 'dfd_tabs dfd_shortcode',
	'is_container' => true,
	'show_settings_on_create' => true,
	'as_parent' => array(
		'only' => 'vc_tta_section',
	),
	'category' => esc_html__('Native', 'dfd-native'),
	'description' => esc_html__('Tabbed content', 'dfd-native'),
	'params' => array(
		array(
			'type' => 'radio_image_select',
			'heading' => esc_html__('Style', 'dfd-native'),
			'param_name' => 'style',
			'simple_mode' => false,
			'options' => array(
				'classic' => array(
					'tooltip' => esc_attr__('Classic', 'dfd-native'),
					'src' => $module_images_accordion . 'classic.png'
				),
				'collapse' => array(
					'tooltip' => esc_attr__('General Background', 'dfd-native'),
					'src' => $module_images_accordion . 'collapse.png'
				),
				'empty' => array(
					'tooltip' => esc_attr__('Underline', 'dfd-native'),
					'src' => $module_images_accordion . 'empty.png'
				),
				'empty_rounded' => array(
					'tooltip' => esc_attr__('Active tab border', 'dfd-native'),
					'src' => $module_images_accordion . 'empty_rounded.png'
				),
				'empty_shadow' => array(
					'tooltip' => esc_attr__('Active tab background', 'dfd-native'),
					'src' => $module_images_accordion . 'empty_shadow.png'
				),
			),
			"value" => "classic",
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the tabs','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
			'param_name' => 'border_radius',
			'value' => '21',
			'weight' => 450,
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse")),
			'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc dfd-number-wrap',
			'group' => 'Tabs Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the active tab','dfd-native').'</span></span>'.esc_html__('Active tab border radius', 'dfd-native'),
			'param_name' => 'border_radius_active_tab',
			'value' => '21',
			'dependency' => Array('element' => 'style', 'value' => array("empty_rounded", "empty_shadow")),
			'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc no-top-padding',
			'group' => "Tabs Style",
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Position', 'dfd-native'),
			'param_name' => 'tab_position',
			'value' => array(
				__('Top', 'dfd-native') => 'top',
				__('Bottom', 'dfd-native') => 'bottom',
			),
			'description' => esc_html__('Select tabs navigation position.', 'dfd-native'),
			'edit_field_class' => 'dfd_vc_hide',
			'group' => ''
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for inactive tabs. The background is not set by default','dfd-native').'</span></span>'.esc_html__("Background color", 'dfd-native'),
			"param_name" => "tab_background",
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse")),
			'edit_field_class' => 'vc_column vc_col-sm-6',
			'group' => 'Tabs Style',
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover background color for inactive tabs. The background is not set by default','dfd-native').'</span></span>'.esc_html__("Hover background color", 'dfd-native'),
			"param_name" => "tab_hover_background",
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tabs Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
			"param_name" => "border_color_radius",
			'weight' => 400,
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tabs Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border hover color. The default border hover color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__("Border hover color", 'dfd-native'),
			"param_name" => "border_hover_color",
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => "Tabs Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color for the active tab. For the style Underline it will be set as underline color for the active tab. The default underline color for the style Underline is inherited from Theme Options > Styling Options > Main site color. The default border color for others styles is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Active tab border color", 'dfd-native'),
			"param_name" => "border_color_active",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse", "empty", "empty_rounded")),
			'group' => "Tabs Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the active tab. The default background color for styles Classic and General Background is inherited from Theme Options > Styling Options > Second site color. The color for the styles Active Tab Border and Active Tab Background is not set by default','dfd-native').'</span></span>'.esc_html__("Active tab background color", 'dfd-native'),
			"param_name" => "active_tab_background",
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse", "empty_rounded", "empty_shadow")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Tabs Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border width for the active tab','dfd-native').'</span></span>'.esc_html__('Active tab border width', 'dfd-native'),
			'param_name' => 'border_width_active_tab',
			'value' => '2',
			'min' => 1,
			'max' => 10,
			'dependency' => Array('element' => 'style', 'value' => array("empty", "empty_rounded")),
			'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
			'group' => "Tabs Style",
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border width for the tabs','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
			'param_name' => 'border_width',
			'value' => '1',
			'min' => 1,
			'max' => 10,
			'dependency' => Array('element' => 'style', 'value' => array("classic", "collapse")),
			'edit_field_class' => 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
			'group' => "Tabs Style",
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the tab\'s title','dfd-native').'</span></span>'.esc_html__('Font size', 'dfd-native'),
			'param_name' => 'font_size',
			'value' => "11",
			'min' => 1,
			'max' => 100,
			'weight' => 450,
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
			'group' => 'Title Style'
		),
		array(
			'type' => 'dropdown',
			'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the text transform for the tab\'s title. The default value is Uppercase','dfd-native').'</span></span>'.esc_html__('Text transform', 'dfd-native'),
			'param_name' => 'tab_text_transform',
			'value' => array(
				esc_html__('Uppercase', 'dfd-native')	=> 'uppercase',
				esc_html__('Capitalize', 'dfd-native')	=> 'capitalize',
				esc_html__('Lowercase', 'dfd-native')	=> 'lowercase',
			),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding',
			'group' => 'Title Style'
		),
		array(
			'type'				=> 'dfd_font_container',
			'param_name'		=> 'title_font_options',
			'settings'			=> array(
				'fields'		=> array(
					'line_height',
					'letter_spacing',
					'font_style'
				),
			),
			'group' => 'Title Style'
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
			'group' => 'Title Style'
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
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the title. The default color is #1b1b1b','dfd-native').'</span></span>'.esc_html__("Title color", 'dfd-native'),
			"param_name" => "tab_text_color",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the title. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__("Title hover color", 'dfd-native'),
			"param_name" => "tab_hover_text_color",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Title Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the active tab title. The default color is #1b1b1b','dfd-native').'</span></span>'.esc_html__("Active tab title color", 'dfd-native'),
			"param_name" => "tab_active_color_text",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Title Style'
		),
		array(
			'type' => 'dfd_radio_advanced',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Select tabs section title alignment.', 'dfd-native') . '</span></span>' . esc_html__('Alignment', 'dfd-native'),
			'param_name' => 'alignment',
			'options' => array(
				__('Left', 'dfd-native') => 'left',
				__('Center', 'dfd-native') => 'center',
				__('Right', 'dfd-native') => 'right',
			),
			'value' => 'center',
			'group' => 'Title Style'
		),
		array(
			'type' => 'dfd_single_checkbox',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the underline for inactive tab','dfd-native').'</span></span>'.esc_html__('Underline on inactive tab', 'dfd-native'),
			'param_name' => 'show_underline',
			'value' => 'on',
			'options' => array(
				'on' => array(
					'on' => 'Yes',
					'off' => 'No',
				),
			),
			'weight' => 400,
			'dependency' => Array('element' => 'style', 'value' => array("empty", "empty_rounded", "empty_shadow")),
			'group' => 'Tabs Style'
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
			'group' => "Tabs Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline color for the inactive tabs. The default underline color is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Underline color", 'dfd-native'),
			"param_name" => "underline_color",
			'dependency' => Array('element' => 'show_underline', 'value' => array("on")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => "Tabs Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline hover color for the inactive tabs. The default underline hover color is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Underline hover color", 'dfd-native'),
			"param_name" => "underline_hover_color",
			'dependency' => Array('element' => 'show_underline', 'value' => array("on")),
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => "Tabs Style",
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color is #28262b','dfd-native').'</span></span>'.esc_html__("Icon color", 'dfd-native'),
			"param_name" => "icon_color",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group' => 'Icon Style'
		),
		array(
			"type" => "colorpicker",
			"heading" =>'<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon hover color. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'. esc_html__("Icon hover color", 'dfd-native'),
			"param_name" => "icon_hover_color",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-padding',
			'group' => 'Icon Style'
		),
		array(
			"type" => "colorpicker",
			"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color for the active tab. The default color is #28262b','dfd-native').'</span></span>'.esc_html__("Active tab icon color", 'dfd-native'),
			"param_name" => "icon_active_color",
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
			'group' => 'Icon Style'
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
			'param_name' => 'icon_size',
			'value' => '15',
			'min' => 1,
			'max' => 100,
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
			'group' => 'Icon Style'
		),
		array(
			'type' => 'dfd_radio_advanced',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enable the automatical tabs rotation, choose the periodicity of tabs rotation in seconds.', 'dfd-native') . '</span></span>' . esc_html__('Autorotate', 'dfd-native'),
			'param_name' => 'autoplay',
			'options' => array(
				__('None', 'dfd-native') => 'none',
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
			'group' => 'Tabs Style'
		),
		array(
			'type' => 'textfield',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the number of the section which should be active on page load. Note: to have all sections closed on initial load enter non-existing number.', 'dfd-native') . '</span></span>' . esc_html__('Active section', 'dfd-native'),
			'param_name' => 'active_section',
			'value' => 1,
			'group' => 'Tabs Style'
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__('CSS box', 'dfd-native'),
			'param_name' => 'css',
			'group' => esc_html__('Design Options', 'dfd-native'),
		),
		array(
			'type'             => 'dfd_heading_param',
			'text'             => esc_html__( 'Extra features', 'dfd-native' ),
			'param_name'       => 'extra_features_elements_heading',
			'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
		),
		array(
			'type' => 'dropdown',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the appear effect for the element', 'dfd-native') . '</span></span>' . esc_html__('Animation', 'dfd-native'),
			'param_name' => 'module_animation',
			'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
		),
		array(
			'type' => 'textfield',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Add the unique class name for the element which can be used for custom CSS codes', 'dfd-native') . '</span></span>' . esc_html__('Custom CSS Class', 'dfd-native'),
			'param_name' => 'el_class',
		),
		array(
			'type' => 'dfd_video_link_param',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
			'param_name' => 'tutorials',
			'doc_link' => '//nativewptheme.net/support/visual-composer/dfd-tabs',
			'video_link' => 'https://youtu.be/OVQlKFxFEyQ',
		),
	),
	'js_view' => 'VcBackendTtaTabsView',
	'custom_markup' => '
<div class="vc_tta-container" data-vc-action="collapse">
<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
<div class="vc_tta-tabs-container">'
	. '<ul class="vc_tta-tabs-list">'
	. '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
	. '</ul>
</div>
<div class="vc_tta-panels vc_clearfix {{container-class}}">
{{ content }}
</div>
</div>
</div>',
	'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', esc_html__('Tab', 'dfd-native'), 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', esc_html__('Tab', 'dfd-native'), 2) . '"][/vc_tta_section]
',
	'admin_enqueue_js' => array(
		vc_asset_url('lib/vc_tabs/vc-tabs.min.js'),
	),
	'front_enqueue_js' => get_template_directory_uri() .'/assets/js/tabsModelextended.js'
));
