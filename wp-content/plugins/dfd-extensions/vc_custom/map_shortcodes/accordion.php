<?php
if (!defined('ABSPATH')) {exit;}
/*
 * Add-on Name: Announcement Line
 */
VcShortcodeAutoloader::getInstance()->includeClass('WPBakeryShortCode_VC_Tta_Accordion');

class WPBakeryShortCode_dfd_accordion extends WPBakeryShortCode_VC_Tta_Accordion {
	public function getFileName() {
		return 'dfd_tta_global';
	}
}

$module_images_accordion = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/accordion/';

vc_map(
	array (
		'name'			=> esc_html__('DFD Accordion', 'dfd-native'),
		'base'			=> 'dfd_accordion',
		'class'			=> 'dfd_accordion dfd_shortcode',
		'icon'			=> 'dfd_accordion dfd_shortcode',
		'is_container'	=> true,
		'show_settings_on_create' => true,
		'as_parent' => array (
				'only' => 'vc_tta_section',
		),
		'category'		=> esc_html__('Native', 'dfd-native'),
		'description'	=> esc_html__('Collapsible content panels', 'dfd-native'),
		'params'		=> array (
			array (
				'type'			=> 'radio_image_select',
				'heading'		=> esc_html__('Style', 'dfd-native'),
				'param_name'	=> 'style',
				'simple_mode'	=> false,
				'options'		=> array (
					'style-7'		=> array (
						'tooltip'		=> esc_attr__('With background', 'dfd-native'),
						'src'			=> $module_images_accordion . 'style-7.png'
					),
					'style-8'		=> array (
						'tooltip'		=> esc_attr__('With underline', 'dfd-native'),
						'src'			=> $module_images_accordion . 'style-8.png'
					),
					'style-9'		=> array (
						'tooltip'		=> esc_attr__('With border', 'dfd-native'),
						'src'			=> $module_images_accordion . 'style-9.png'
					),
					'style-10'		=> array (
						'tooltip'		=> esc_attr__('With shadow', 'dfd-native'),
						'src'			=> $module_images_accordion . 'style-10.png'
					),
				),
				"value" => "style-7",
			),
			array (
				'type'				=> 'checkbox',
				'heading'			=> esc_html__('Allow collapse all?', 'dfd-native'),
				'param_name'		=> 'collapsible_all',
				'edit_field_class'	=> 'vc_ui-panel',
				'description'		=> esc_html__('Allow collapse all accordion sections.', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> esc_html__('Border radius', 'dfd-native'),
				'param_name'		=> 'border_radius',
				'value'				=> '21',
				'min'				=> 1,
				'max'				=> 10,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the tabs','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name'		=> 'border_radius_active_tab',
				'value'				=> '21',
//						'min' => 1,
//						'max' => 10,
//						'suffix' => 'px',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-9', 'style-10')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for inactive tabs. The background is not set by default','dfd-native').'</span></span>'.esc_html__('Background color', 'dfd-native'),
				'param_name'		=> 'tab_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				"heading"			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover background color for inactive tabs. The background is not set by default','dfd-native').'</span></span>'.esc_html__('Hover background color', 'dfd-native'),
				'param_name'		=> 'tab_hover_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the active tab. The default background color for style With Background is inherited from Theme Options > Styling Options > Second site color. The color for the styles With Border and With Shadow is not set by default','dfd-native').'</span></span>'.esc_html__('Active tab background color', 'dfd-native'),
				'param_name'		=> 'active_tab_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7', 'style-9', 'style-10')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name'		=> 'border_color_radius',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border hover color. The default border hover color is inherited from Theme Options > Styling Options > Second site color','dfd-native').'</span></span>'.esc_html__('Border hover color', 'dfd-native'),
				'param_name'		=> 'border_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the border width for the tabs','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name'		=> 'border_width_active_tab',
				'value'				=> '2',
				'min'				=> 1,
				'max'				=> 10,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-8', 'style-9')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline color for the active tab. For the style with border it will be set as border color for the active tab. The default underline color for the style With Underline is inherited from Theme Options > Styling Options > Main site color. The default underline (border) color for the styles With background and With Border is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__('Active tab underline color', 'dfd-native'),
				'param_name'		=> 'border_color_active',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7', 'style-8', 'style-9')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the border width','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name'		=> 'border_width',
				'value'				=> '1',
				'min'				=> 1,
				'max'				=> 10,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'dependency'		=> array ('element' => 'style', 'value' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the underline for inactive tab. Note: the last tab does not have the underline.','dfd-native').'</span></span>'.esc_html__('Underline on inactive tab', 'dfd-native'),
				'param_name'		=> 'show_underline',
				'value'				=> 'on',
				'options'			=> array (
					'on' => array (
						'on'	=> 'Yes',
						'off'	=> 'No',
					),
				),
				'weight'			=> 400,
				'dependency'		=> array ('element' => 'style', 'value_not_equal_to' => array ('style-7')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the underline height','dfd-native').'</span></span>'.esc_html__('Underline height for inactive element', 'dfd-native'),
				'param_name'		=> 'underline_height',
				'value'				=> '1',
//				'min'				=> 1,
//				'max'				=> 10,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'dependency'		=> array ('element' => 'show_underline', 'value' => array ('on')),
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline color for the inactive tabs. The default underline color is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__("Underline color", 'dfd-native'),
				'param_name'		=> "underline_color",
				'dependency'		=> array ('element' => 'show_underline', 'value' => array ('on')),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the underline hover color for the inactive tabs. The default underline hover color is inherited from Theme Options > Styling Options > Second site color.','dfd-native').'</span></span>'.esc_html__('Underline hover color', 'dfd-native'),
				'param_name'		=> 'underline_hover_color',
				'dependency'		=> array ('element' => 'show_underline', 'value' => array ('on')),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable the automatical tabs rotation, choose the periodicity of tabs rotation in seconds','dfd-native').'</span></span>'.esc_html__('Autorotate', 'dfd-native'),
				'param_name'		=> 'autoplay',
				'value'				=> 'none',
				'options'			=> array (
					esc_html__('None', 'dfd-native')	=> 'none',
					esc_html__('1', 'dfd-native')		=> '1',
					esc_html__('2', 'dfd-native')		=> '2',
					esc_html__('3', 'dfd-native')		=> '3',
					esc_html__('4', 'dfd-native')		=> '4',
					esc_html__('5', 'dfd-native')		=> '5',
					esc_html__('10', 'dfd-native')		=> '10',
					esc_html__('20', 'dfd-native')		=> '20',
					esc_html__('30', 'dfd-native')		=> '30',
					esc_html__('40', 'dfd-native')		=> '40',
					esc_html__('50', 'dfd-native')		=> '50',
					esc_html__('60', 'dfd-native')		=> '60',
				),
//				'std' => 'none',
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			// Control Icons END
			array (
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the number of the section which should be active on page load. Note: to have all sections closed on initial load enter non-existing number','dfd-native').'</span></span>'.esc_html__('Active section', 'dfd-native'),
				'param_name'		=> 'active_section',
				'value'				=> 1,
				'group'				=> esc_html__('Tabs Style', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the font size for the tab\'s title','dfd-native').'</span></span>'.esc_html__('Font size', 'dfd-native'),
				'param_name'		=> 'font_size',
				'value'				=> '11',
				'min'				=> 1,
				'max'				=> 100,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Title Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the title. The default color is #28262b','dfd-native').'</span></span>'.esc_html__('Title color', 'dfd-native'),
				'param_name'		=> 'tab_text_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Title Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover color for the title. The default color is inheried from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Title hover color', 'dfd-native'),
				'param_name'		=> 'tab_hover_text_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Title Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the active tab title. The default color is #28262b','dfd-native').'</span></span>'.esc_html__('Active tab title color', 'dfd-native'),
				'param_name'		=> 'tab_active_color_text',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Title Style', 'dfd-native'),
			),
			array (
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select accordion section title alignment','dfd-native').'</span></span>'.esc_html__('Title alignment', 'dfd-native'),
				'param_name'		=> 'c_align',
				'value'				=> 'left',
				'options'			=> array (
						esc_html__('Left', 'dfd-native')	=> 'left',
						esc_html__('Center', 'dfd-native') => 'center',
						esc_html__('Right', 'dfd-native')	=> 'right',
				),
				'group'				=> esc_html__('Title Style', 'dfd-native'),
			),
			array (
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select accordion navigation icon','dfd-native').'</span></span>'.esc_html__('Icon', 'dfd-native'),
				'param_name'		=> 'c_icon',
				'edit_field_class'	=> 'vc_ui-panel',
				'value' => array (
						esc_html__('None', 'dfd-native')		=> '',
						esc_html__('Chevron', 'dfd-native')	=> 'chevron',
						esc_html__('Plus', 'dfd-native')		=> 'plus',
						esc_html__('Triangle', 'dfd-native')	=> 'triangle',
				),
//				'std' => 'plus',
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
				// Control Icons
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon hover color. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Icon hover color', 'dfd-native'),
				'param_name'		=> 'icon_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array (
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the active tab icon color. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Active tab icon color', 'dfd-native'),
				'param_name'		=> 'icon_active_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array (
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'value'				=> '15',
//				'min'				=> 1,
//				'max'				=> 100,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array (
				'type'				=> 'css_editor',
				'heading'			=> esc_html__('CSS box', 'dfd-native'),
				'param_name'		=> 'css',
				'group'				=> esc_html__('Design Options', 'dfd-native'),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array (
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name'		=> 'module_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array (
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'		=> 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/dfd-accordion',
				'video_link'		=> 'https://www.youtube.com/watch?v=Map_MgMvhSA&feature=youtu.be',
			),
		),
		'js_view' => 'VcBackendTtaAccordionView',
		'custom_markup' => '
			<div class="vc_tta-container" data-vc-action="collapseAll">
				<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
					<div class="vc_tta-panels vc_clearfix {{container-class}}">
					{{ content }}
						<div class="vc_tta-panel vc_tta-section-append">
							<div class="vc_tta-panel-heading">
								<h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
								   <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
										<span class="vc_tta-title-text">' . esc_html__('Add Section', 'dfd-native') . '</span>
										<i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
									</a>
								</h4>
							</div>
						</div>
					</div>
				</div>
			</div>',
		'default_content' => '[vc_tta_section title="' . sprintf('%s %d', esc_html__('Section', 'dfd-native'), 1) . '"][/vc_tta_section][vc_tta_section title="' . sprintf('%s %d', esc_html__('Section', 'dfd-native'), 2) . '"][/vc_tta_section]',
	)
);