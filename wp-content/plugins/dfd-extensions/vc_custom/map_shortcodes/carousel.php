<?php

if (!defined('ABSPATH')) {
	exit;
}
/*
  Shortcode: Carousel
 */

class WPBakeryShortCode_dfd_carousel extends WPBakeryShortCodesContainer {
	
}

new dfd_hide_unsuport_module_frontend("dfd_carousel");
vc_map(
	array(
		'name' => esc_html__('Carousel', 'dfd-native'),
		'base' => 'dfd_carousel',
		'icon' => 'dfd_carousel dfd_shortcode',
		'class' => 'dfd_carousel dfd_shortcode',
		'as_parent' => array('except' => array('dfd_carousel')),
		'content_element' => true,
		'controls' => 'full',
		'show_settings_on_create' => true,
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => 'Allows you to show different elements in carousel',
		'params' => array_merge(array(
			array(
				'type' => 'radio_image_select',
				'heading' => esc_html__('Style', 'dfd-native'),
				'param_name' => 'slider_type',
				'simple_mode' => false,
				'options' => array(
					'horizontal' => array(
						'tooltip' => esc_attr__('Horizontal', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/horizontal.png'
					),
					'vertical' => array(
						'tooltip' => esc_attr__('Vertical', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/vertical.png'
					),
				),
				'group' => esc_attr__('General', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the active element in the center','dfd-native').'</span></span>'.esc_html__('Center mode', 'dfd-native'),
				'param_name' => 'center_mode',
				'value' => '',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency' => Array('element' => 'slider_type', 'value' => array('horizontal')),
				'group' => esc_html__('General', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),
						array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option will adapt the carousel according to the content size. Option is available when you set one slide to show','dfd-native').'</span></span>'.esc_html__('Adaptive height', 'dfd-native'),
				'param_name' => 'adaptive_height',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the dragging of the carousel\'s slides','dfd-native').'</span></span>'.esc_html__('Draggable Effect', 'dfd-native'),
				'param_name' => 'draggable',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the carousel sliding by swiping on touch devices','dfd-native').'</span></span>'.esc_html__('Touch Move', 'dfd-native'),
				'param_name' => 'touch_move',
				// 'admin_label' => true,
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => Array('element' => 'draggable', 'value' => array('on')),
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name' => 'module_animation',
				'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/carousel',
				'video_link'		=> 'https://www.youtube.com/watch?v=cDLT7i3SjxY&feature=youtu.be',
				'group' => esc_html__('General', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Slideshow settings', 'dfd-native'),
				'param_name' => 'slides_heading',
				'class' => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_attr__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides you would like to display','dfd-native').'</span></span>'.esc_html__('Slides to show', 'dfd-native'),
				'param_name' => 'slides_to_show',
				'value' => '1',
				'min' => '1',
				'max' => '25',
				'step' => '1',
				'edit_field_class' => 'vc_column vc_col-sm-4 no-border-bottom crum_vc',
				'group' => esc_html__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd-native').'</span></span>'.esc_html__('Slideshow speed', 'dfd-native'),
				'param_name' => 'speed',
				'value' => '300',
				'min' => '100',
				'max' => '10000',
				'step' => '100',
				'edit_field_class' => 'vc_column vc_col-sm-4 no-border-bottom crum_vc dfd-number-ml-second',
				'group' => esc_html__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the carousel items','dfd-native').'</span></span>'. esc_html__('Items offset', 'dfd-native'),
				'param_name' => 'items_offset',
				'value' => '20',
				'min' => '0',
				'max' => '100',
				'step' => '1',
				'dependency' => Array('element' => 'slider_type', 'value' => array('horizontal')),
				'edit_field_class' => 'vc_column vc_col-sm-4 no-border-bottom crum_vc dfd-number-wrap',
				'group' => esc_html__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Auto slideshow settings', 'dfd-native'),
				'param_name' => 'autoslides_heading',
				'class' => '',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the carousel','dfd-native').'</span></span>'.esc_html__('Autoplay', 'dfd-native'),
				'param_name' => 'autoplay',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'group' => esc_html__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the autoplay','dfd-native').'</span></span>'.esc_html__('Autoplay Speed', 'dfd-native'),
				'param_name' => 'autoplay_speed',
				'value' => '5000',
				'min' => '100',
				'max' => '10000',
				'step' => '10',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-ml-second',
				'dependency' => Array('element' => 'autoplay', 'value' => array('on')),
				'group' => esc_html__('Slideshow', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Medium desktop', 'dfd-native'),
				'param_name' => 'sizing_normal',
				'class' => '',
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the screen resolution for the medium desktops','dfd-native').'</span></span>'.esc_html__('Screen resolution', 'dfd-native'),
				'param_name' => 'screen_normal_resolution',
				'value' => 1024,
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap'
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to show for the medium desktops','dfd-native').'</span></span>'.esc_html__('Number of slides', 'dfd-native'),
				'value' => '1',
				'param_name' => 'screen_normal_slides',
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc'
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Tablets', 'dfd-native'),
				'param_name' => 'sizing_tablet',
				'class' => '',
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the screen resolution for the tablets','dfd-native').'</span></span>'.esc_html__('Screen resolution', 'dfd-native'),
				'param_name' => 'screen_tablet_resolution',
				'value' => 800,
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap'
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to show for the tablets','dfd-native').'</span></span>'.esc_html__('Number of slides', 'dfd-native'),
				'value' => '1',
				'param_name' => 'screen_tablet_slides',
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc'
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Mobile phones', 'dfd-native'),
				'param_name' => 'sizing_mobile',
				'class' => '',
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the screen resolution for the mobile phones','dfd-native').'</span></span>'.esc_html__('Screen resolution', 'dfd-native'),
				'param_name' => 'screen_mobile_resolution',
				'value' => 480,
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap'
			),
			array(
				'type' => 'number',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of slides to show for the mobile phones','dfd-native').'</span></span>'.esc_html__('Number of slides', 'dfd-native'),
				'value' => '1',
				'param_name' => 'screen_mobile_slides',
				'group' => esc_html__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc'
			),
			
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the pagination dots for your carousel','dfd-native').'</span></span>'.esc_html__('Dots Pagination', 'dfd-native'),
				'param_name' => 'dots',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
//				'dependency' => Array('element' => 'arrows_position', 'value' => array('aside', 'aside_offset', 'top_left', 'top_center', 'top_right', 'bottom_left', 'bottom_right')),
				 'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array(
				'type' => 'radio_image_select',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 10 preset pagination styles','dfd-native').'</span></span>'.esc_html__('Pagination style', 'dfd-native'),
				'param_name' => 'dots_style',
				'simple_mode' => false,
				'options' => array(
					'dfdrounded' => array(
						'tooltip' => esc_attr__('Rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_1.png'
					),
					'dfdfillrounded' => array(
						'tooltip' => esc_attr__('Filled rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_2.png'
					),
					'dfdemptyrounded' => array(
						'tooltip' => esc_attr__('Transparent rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_3.png'
					),
					'dfdfillsquare' => array(
						'tooltip' => esc_attr__('Square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
					),
					'dfdsquare' => array(
						'tooltip' => esc_attr__('Filled square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_6.png'
					),
					'dfdemptysquare' => array(
						'tooltip' => esc_attr__('Transparent square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_8.png'
					),
					'dfdline' => array(
						'tooltip' => esc_attr__('Line', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_4.png'
					),
					'dfdadvancesquare' => array(
						'tooltip' => esc_attr__('Advanced square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_5.png'
					),
					'dfdroundedempty' => array(
						'tooltip' => esc_attr__('Rounded Empty', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_9.png'
					),
					'dfdroundedfilled' => array(
						'tooltip' => esc_attr__('Rounded Filled', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_10.png'
					),
				),
				'dependency' => Array('element' => 'dots', 'value' => array('on')),
				 'group' => esc_html__('Pagination', 'dfd-native'),
			),
				array(
				'type' => 'colorpicker',
				'class' => '',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc ',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose color for the active dot. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Active dot color', 'dfd-native'),
				'param_name' => 'dots_color',
				'value' => '',
				'dependency' => Array('element' => 'dots', 'value' => array('on')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc ',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose color for the active dot. The default color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__('UnActive dot color', 'dfd-native'),
				'param_name' => 'dots_color_unactive',
				'value' => '',
				'dependency' => Array('element' => 'dots', 'value' => array('on')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
				array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the carousel navigation','dfd-native').'</span></span>'.esc_html__('Navigation', 'dfd-native'),
				'param_name' => 'arrows',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => esc_attr__('Yes', 'dfd-native'),
						'off' => esc_attr__('No', 'dfd-native'),
					),
				),
				 'group' => esc_html__('Navigation Style', 'dfd-native'),
			),
			array(
				'type' => 'radio_image_select',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the navigation arrows position','dfd-native').'</span></span>'.esc_html__('Arrows position', 'dfd-native'),
				'param_name' => 'arrows_position',
				'simple_mode' => false,
				'value'=>'aside_offset',
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'options' => array(
					'aside' => array(
						'tooltip' => esc_attr__('Aside', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/arrows_position/aside.png'
					),
					'aside_offset' => array(
						'tooltip' => esc_attr__('Aside with offset', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/arrows_position/aside_offset.png'
					),
					'top_center' => array(
						'tooltip' => esc_attr__('Top center', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/arrows_position/top_center.png'
					),
					'bottom_center' => array(
						'tooltip' => esc_attr__('Bottom center', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/arrows_position/bottom_center.png'
					),
				),
				'dependency' => Array('element' => 'arrows', 'value' => array('on')),
				 'group' => esc_html__('Navigation Style', 'dfd-native'),
			),
			
		), Dfd_Theme_Slier_Helper::build_paarms(array(
				"element" => "arrows",
				'value' => array("on")
			), DFD_EXTENSIONS_PLUGIN_URL)),
		'js_view' => 'VcColumnView'
	)
); // vc_map
if (is_rtl() && function_exists('vc_add_param')) {
	vc_add_param('dfd_carousel', array(
		'type' => 'dfd_single_checkbox',
		'class' => '',
		'heading' => esc_html__('RTL Mode', 'dfd-native'),
		'param_name' => 'rtl',
		'value' => '',
		'options' => array(
			'on' => array(
				'label' => '',
				'on' => esc_attr__('Yes', 'dfd-native'),
				'off' => esc_attr__('No', 'dfd-native'),
			),
		),
		'dependency' => array('element' => 'slider_type', 'value' => array('horizontal')),
		'edit_field_class' => 'vc_column vc_col-sm-4',
		'group' => esc_html__('General', 'dfd-native'),
	));
}