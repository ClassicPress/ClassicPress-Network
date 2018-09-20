<?php
$parent_tag = vc_post_param('parent_tag', '');
$include_icon_params = ( 'vc_tta_pageable' !== $parent_tag );

$filename = DFD_EXTENSIONS_PLUGIN_PATH.'inc/vc-icon-element.php';
if (is_file($filename)) {
	require_once $filename;
} else {
	return false;
}
if ($include_icon_params) {

	$icon_params = array(
		array(
			'type'			=> 'dfd_single_checkbox',
			'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable to add icon next to section title','dfd-native').'</span></span>'.esc_html__('Icon', 'dfd-native'),
			'param_name'	=> 'add_icon',
			'options'		=> array(
				'true' => array(
					'yes'	=> esc_attr__('Yes', 'dfd-native'),
					'no'	=> esc_attr__('No', 'dfd-native'),
				),
			),
		),
		array(
			'type'			=> 'dfd_radio_advanced',
			'heading'		=> esc_html__('Icon position', 'dfd-native'),
			'param_name'	=> 'i_position',
			'value'			=> 'left',
			'options'		=> array(
				esc_html__('Before title', 'dfd-native')	=> 'left',
				esc_html__('After title', 'dfd-native')	=> 'right',
			),
			'dependency'	=> array('element' => 'add_icon', 'value' => 'true'),
		),
	);
	$icon_params = array_merge($icon_params, (array) vc_map_integrate_shortcode(vc_icon_element_params_override(), 'i_', '', array(
			// we need only type, icon_fontawesome, icon_.., NOT color and etc
			'include_only_regex' => '/^(type|icon_\w*)/',
			), array(
			'element' => 'add_icon',
			'value' => 'true',
	)));
} else {
	$icon_params = array();
}

$params = array_merge(
	array(
		array(
			'type'			=> 'textfield',
			'param_name'	=> 'title',
			'heading'		=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter section title. Note: you can leave it empty.','dfd-native').'</span></span>'.esc_html__('Title', 'dfd-native'),
		),
		array(
			'type'			=> 'el_id',
			'heading'		=> esc_html__('Section ID', 'dfd-native'),
			'param_name'	=> 'tab_id',
			'settings'		=> array(
				'auto_generate' => true,
			),
			'description'	=> esc_html__('Enter section ID. Note: make sure it is unique and valid according to','dfd-native').' <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">'.esc_html__('w3c specification','dfd-native').'</a>',
		),
	),
	$icon_params, array(
		array(
			'type' => 'textfield',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
			'param_name' => 'el_class',
		),
	)
);

vc_map(array(
	'name' => esc_html__('Section', 'dfd-native'),
	'base' => 'vc_tta_section',
	'icon' => 'dfd_tta_section dfd_shortcode',
	'class' => 'dfd_tta_section dfd_shortcode',
	'allowed_container_element' => 'vc_row',
	'is_container' => true,
	'show_settings_on_create' => false,
	'as_child' => array(
		'only' => 'vc_tta_tour,vc_tta_tabs,vc_tta_accordion',
	),
	'category' => esc_html__('Content', 'dfd-native'),
	'description' => esc_html__('Section for Tabs, Tours, Accordions.', 'dfd-native'),
	'params' => $params,
	'js_view' => 'VcBackendTtaSectionView',
	'custom_markup' => '
		<div class="vc_tta-panel-heading">
		    <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left"><a href="javascript:;" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-accordion data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">{{ section_title }}</span><i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i></a></h4>
		</div>
		<div class="vc_tta-panel-body">
			{{ editor_controls }}
			<div class="{{ container-class }}">
			{{ content }}
			</div>
		</div>',
	'default_content' => '',
));
