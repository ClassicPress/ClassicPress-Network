<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Icons List for Visual Composer
*/

class WPBakeryShortCode_Dfd_Icon_List extends WPBakeryShortCode {}

$repeater_params = array(
	array(
		'type'			=> 'dfd_radio_advanced',
		'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use an existing font icon, choose dot style to have dotted list or choose without icon to have simple list','dfd-native').'</span></span>'.esc_html__('Icon to display', 'dfd-native'),
		'param_name'	=> 'icon_type',
		'value'			=> 'selector',
		'options'		=> array(
			esc_html__('With Icon','dfd-native')		=> 'selector',
			esc_html__('Dot', 'dfd-native')	=> 'without',
			esc_html__('Without icon', 'dfd-native')	=> 'not-icon',
		),
	),
	array(
		'type'			=> 'dfd_radio_advanced',
		'heading'		=> esc_html__('Icon library', 'dfd-native'),
		'param_name'	=> 'select_icon',
		'value'			=> 'dfd_icons',
		'options'		=> Dfd_Theme_Helpers::build_vc_icons_fonts_list(false),
		'dependency'	=> array('element' => 'icon_type', 'value' => 'selector',),
	),
	array(
		'type'			=> 'iconpicker',
		'heading'		=> esc_html__('Select Icon ', 'dfd-native'),
		'param_name'	=> 'ic_dfd_icons',
		'value'			=> 'dfd-socicon-arrow-right',
		'settings'		=> array(
			'emptyIcon'		=> false,
			'type'			=> 'dfd_icons',
			'iconsPerPage'	=> 4000,
		),
		'dependency'	=> array('element' => 'select_icon', 'value' => 'dfd_icons',),
	),
);

$extra_params = array(
	array(
		'type'			=> 'textarea',
		'heading'		=> esc_html__('Content', 'dfd-native'),
		'param_name'	=> 'text_content',
		'admin_label'	=> true,
		'description'	=> esc_html__('Add the content which should be displayed near the icon.', 'dfd-native'),
	),
	array(
		'type'				=> 'dfd_single_checkbox',
		'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your icon item','dfd-native').'</span></span>'.esc_html__('Link', 'dfd-native'),
		'param_name'		=> 'link_box',
		'value'				=> '',
		'options'			=> array(
			'link_b'			=> array(
				'yes'				=> esc_attr__('Yes', 'dfd-native'),
				'no'				=> esc_attr__('No', 'dfd-native')
			),
		),
		'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
	),
	array(
		'type'				=> 'vc_link',
		'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page','dfd-native').'</span></span>'.esc_html__('Add link', 'dfd-native'),
		'param_name'		=> 'link',
		'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
		'dependency'		=> array('element' => 'link_box', 'value' => 'link_b'),
	),
);

if(method_exists('Dfd_Theme_Helpers','vc_icon_fonts')) {
	$icon_fonts = Dfd_Theme_Helpers::vc_icon_fonts();
	if(!empty($icon_fonts) && is_array($icon_fonts)) {
		foreach($icon_fonts as $k => $v) {
			$font_param = Dfd_Theme_Helpers::build_vc_icons_param($k, '', array());
			if($font_param) {
				$repeater_params[] = $font_param;
			}
		}
	}
}

$repeater_params = array_merge($repeater_params, $extra_params);

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/icon_list/';
vc_map(
	array(
		'name'					=> esc_html__('Icon list', 'dfd-native'),
		'base'					=> 'dfd_icon_list',
		'class'					=> 'dfd_icon_list dfd_shortcode',
		'icon'					=> 'dfd_icon_list dfd_shortcode',
		'category'				=> esc_html__('Native','dfd-native'),
		'description'			=> esc_html__('Show the list with custom icons','dfd-native'),
		'params'				=> array(
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
						'tooltip'			=> esc_html__('Divided','dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('With short delimiter','dfd-native'),
						'src'				=> $module_images . 'style-3.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option you allows you to align the icon horizontally','dfd-native').'</span></span>'.esc_html__('Icon alignment', 'dfd-native'),
				'param_name'		=> 'icon_align',
				'value'				=> 'icon-left',
				'options'			=> array(
					esc_html__('Left align','dfd-native')	=> 'icon-left',
					esc_html__('Justify','dfd-native')		=> 'icon-center',
					esc_html__('Right align','dfd-native') => 'icon-right',
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/icon-list',
				'video_link'		=> 'https://youtu.be/6RsiZCnOZAc',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List content', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'params'			=> $repeater_params,
				'value'				=> '%5B%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-arrow-right%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22text_content%22%3A%22Enter%20Icon%20list%20content%20here%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-arrow-right%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22text_content%22%3A%22Enter%20Icon%20list%20content%20here%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-arrow-right%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22text_content%22%3A%22Enter%20Icon%20list%20content%20here%22%7D%5D',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Icon style', 'dfd-native'),
				'param_name'		=> 'icon_t_decoration',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the size of the icon. Default icon size is 16px','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'min'				=> 12,
				'max'				=> 30,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native')
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the icon. Default icon color is #c3c3c3','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the icon. The background color by default is not set','dfd-native').'</span></span>'.esc_html__('Icon background', 'dfd-native'),
				'param_name'		=> 'icon_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background size for the icon','dfd-native').'</span></span>'.esc_html__('Background size', 'dfd-native'),
				'param_name'		=> 'background_size',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array( 'element' => 'icon_background', 'not_empty' => true ),
				'group'				=> esc_html__('Styles', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_param_border',
				'param_name'		=> 'icon_border',
				'simple'			=> false,
				'unit'				=> 'px',
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
				'value'				=> 'border_style:none',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Offset settings', 'dfd-native'),
				'param_name'		=> 'offset_t_decoration',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the offset between the icon and the content','dfd-native').'</span></span>'.esc_html__('Right offset', 'dfd-native'),
				'param_name'		=> 'icon_margin',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the offset between the list items','dfd-native').'</span></span>'.esc_html__('Bottom offset', 'dfd-native'),
				'param_name'		=> 'icon_bottom_spase',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native')
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Delimiter styles', 'dfd-native'),
				'param_name'		=> 'delimiter_t_decoration',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array( 'element' => 'main_style', 'value' => array( 'style-2', 'style-3') ),
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the style for the icon list delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter Style', 'dfd-native'),
				'param_name'		=> 'del_style',
				'value'				=> 'solid',
				'options'			=> array(
					esc_html__('Solid','dfd-native')	=> 'solid',
					esc_html__('Dotted','dfd-native')	=> 'dotted',
					esc_html__('Dashed','dfd-native')	=> 'dashed',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
				'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3') ),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter height', 'dfd-native'),
				'param_name'		=> 'del_height',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array( 'element' => 'main_style', 'value' => array( 'style-2', 'style-3') ),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter color. The delimiter color is not set by default','dfd-native').'</span></span>'.esc_html__('Delimiter color', 'dfd-native'),
				'param_name'		=> 'del_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array( 'element' => 'main_style', 'value'   => array( 'style-2', 'style-3') ),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'			=> array(
						'tag'				=> 'div',
						'font_size',
						'letter_spacing',
						'color',
						'font_style',
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'use_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
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
				'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		)
	)
);