<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Services for Visual Composer
*/

class WPBakeryShortCode_Dfd_Services extends WPBakeryShortCode {}

$repeater_params = array(
	array(
		'type'			=> 'dfd_radio_advanced',
		'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text', 'dfd-native').'</span></span>'.esc_html__('Icon to display', 'dfd-native'),
		'param_name'	=> 'icon_type',
		'value'			=> 'selector',
		'options'		=> array(
			esc_html__('Icon','dfd-native')	=> 'selector',
			esc_html__('Image','dfd-native')	=> 'custom',
			esc_html__('Text', 'dfd-native')	=> 'text',
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
		'value'			=> 'dfd-socicon-icon-social-buffer',
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
		'type'			=> 'attach_image',
		'heading'		=> esc_html__('Upload image', 'dfd-native'),
		'param_name'	=> 'icon_image_id',
		'description'	=> esc_html__('Upload the custom image from the media library', 'dfd-native'),
		'dependency'	=> array('element' => 'icon_type','value' => array('custom')),
	),
	array(
		'type'			=> 'textfield',
		'heading'		=> esc_html__('Text', 'dfd-native'),
		'param_name'	=> 'icon_text',
		'dependency'	=> array('element' => 'icon_type', 'value' => array('text')),
	),
	array(
		'type'			=> 'textfield',
		'heading'		=> esc_html__('Title', 'dfd-native'),
		'param_name'	=> 'block_title',
		'admin_label'	=> true,
	),
	array(
		'type'			=> 'textfield',
		'heading'		=> esc_html__('Subtitle', 'dfd-native'),
		'param_name'	=> 'block_subtitle',
		'admin_label'	=> true,
	),
	array(
		'type'			=> 'textarea',
		'heading'		=> esc_html__('Description','dfd-native'),
		'param_name'	=> 'block_content',
	),
);

if(method_exists('Dfd_Theme_Helpers', 'vc_icon_fonts')) {
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

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/services/';
vc_map(
	array(
		'name'					=> esc_html__('Services', 'dfd-native'),
		'base'					=> 'dfd_services',
		'class'					=> 'dfd_services dfd_shortcode',
		'icon'					=> 'dfd_services dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'description'			=> esc_html__('Text blocks connected together in one list.', 'dfd-native'),
		'params'				=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_attr__('Simple','dfd-native'),
						'src'				=> $module_images.'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_attr__('Backround','dfd-native'),
						'src'				=> $module_images.'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_attr__('Bordered','dfd-native'),
						'src'				=> $module_images.'style-3.png'
					),
					'style-4'			=> array(
						'tooltip'			=> esc_attr__('Overlay','dfd-native'),
						'src'				=> $module_images.'style-4.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Please, select width of the elements according to the width of the container','dfd-native').'</span></span>'.esc_html__('Element width', 'dfd-native'),
				'param_name'		=> 'columns_width',
				'value'				=> 'quarter-width-elements',
				'options'			=> array(
					esc_html__('Full width', 'dfd-native')		=> 'full-width-elements',
					esc_html__('Half size', 'dfd-native')		=> 'half-size-elements',
					esc_html__('Third size', 'dfd-native')		=> 'one-third-width-elements',
					esc_html__('Quarter size', 'dfd-native')	=> 'quarter-width-elements',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc',
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/services',
				'video_link' => 'https://www.youtube.com/watch?v=nXVIZHVuLzE&feature=youtu.be',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List content', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'params'			=> $repeater_params,
				'value'				=> '%5B%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-icon-social-buffer%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Services%20title%22%2C%22block_subtitle%22%3A%22Services%20subtitle%22%2C%22block_content%22%3A%22Services%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-icon-social-buffer%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Services%20title%22%2C%22block_subtitle%22%3A%22Services%20subtitle%22%2C%22block_content%22%3A%22Services%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-icon-social-buffer%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Services%20title%22%2C%22block_subtitle%22%3A%22Services%20subtitle%22%2C%22block_content%22%3A%22Services%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-icon-social-buffer%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Services%20title%22%2C%22block_subtitle%22%3A%22Services%20subtitle%22%2C%22block_content%22%3A%22Services%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%5D',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size_st1',
				'value'				=> 50,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size_st23',
				'value'				=> 35,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-top-padding',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the size for the icon you have set','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size_st4',
				'value'				=> 100,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-top-padding',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-4')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color for the styles Simple and Bordered is #3d3d3d. The default color for the style Background is #fff. The default color for the style Overlay is #ebebeb','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-top-padding',
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background size for the icon','dfd-native').'</span></span>'.esc_html__('Icon background size', 'dfd-native'),
				'param_name'		=> 'icon_bg_size',
				'value'				=> 80,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon background color. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Icon background color', 'dfd-native'),
				'param_name'		=> 'background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the border width','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name'		=> 'border_width',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default border color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name'		=> 'border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the icon\'s background','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name'		=> 'border_radius',
				'value'				=> 40,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-3')),
				'group'				=> esc_html__('Icon Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to select hover style for the service item','dfd-native').'</span></span>'.esc_html__('Hover style', 'dfd-native'),
				'param_name'		=> 'hover_style',
				'value'				=> 'sliding',
				'options'			=> array(
					esc_html__('Sliding', 'dfd-native')	=> 'sliding',
					esc_html__('Flip', 'dfd-native')		=> 'flip',
					esc_html__('Cubic', 'dfd-native')		=> 'cubic',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the direction for the hover animation','dfd-native').'</span></span>'.esc_html__('Hover direction', 'dfd-native'),
				'param_name'		=> 'hover_direction',
				'value'				=> 'left_to_right',
				'options'			=> array(
					'<i class="dfd-socicon-arrow-right"></i>'	=> 'left_to_right',
					'<i class="dfd-socicon-arrow-left"></i>'	=> 'right_to_left',
					'<i class="dfd-socicon-arrow-down"></i>'	=> 'top_to_bottom',
					'<i class="dfd-socicon-arrow-up"></i>'		=> 'bottom_to_top',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding crum_vc',
				'dependency'		=> array('element' => 'hover_style', 'not_empty' => true),
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the Front side of the service. The color is not set by default','dfd-native').'</span></span>'.esc_html__('Front background color', 'dfd-native'),
				'param_name'		=> 'front_bg_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'			=> 'dfd_single_checkbox',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Content colors will be changed to make it more visible if dark background color is set','dfd-native').'</span></span>'.esc_html__('Dark', 'dfd-native'),
				'param_name'	=> 'dark_bg_front',
				'options'		=> array(
					'bg_front'		=> array(
						'yes'			=> esc_attr__('Yes', 'dfd-native'),
						'no'			=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the hovered side of the service. The color is not set by default','dfd-native').'</span></span>'.esc_html__('Hover background color', 'dfd-native'),
				'param_name'		=> 'back_bg_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'			=> 'dfd_single_checkbox',
				'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Content colors will be changed to make it more visible if dark background color is set','dfd-native').'</span></span>'.esc_html__('Dark', 'dfd-native'),
				'param_name'	=> 'dark_bg_back',
				'options'		=> array(
					'bg_back'		=> array(
						'yes'			=> esc_attr__('Yes', 'dfd-native'),
						'no'			=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the left and right padding for the content','dfd-native').'</span></span>'.esc_html__('Left/right content paddings', 'dfd-native'),
				'param_name'		=> 'hor_content_offset',
				'value'				=> 50,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the top and bottom padding for the content','dfd-native').'</span></span>'.esc_html__('Top/bottom content paddings', 'dfd-native'),
				'param_name'		=> 'vertical_content_offset',
				'value'				=> 50,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the left and right offset for the item','dfd-native').'</span></span>'.esc_html__('Left/right items offset', 'dfd-native'),
				'param_name'		=> 'hor_offset',
				'value'				=> 20,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'hover_style', 'value' => array('flip', 'cubic')),
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter style','dfd-native').'</span></span>'.esc_html__('Delimeter style', 'dfd-native' ),
				'param_name'		=> 'connector_style',
				'value'				=> 'solid',
				'options'			=> array(
					esc_html__('Solid', 'dfd-native')	=> 'solid',
					esc_html__('Dashed', 'dfd-native')	=> 'dashed',
					esc_html__('Dotted', 'dfd-native')	=> 'dotted',
					esc_html__('Double', 'dfd-native')	=> 'double',
					esc_html__('None', 'dfd-native')	=> 'none',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-8 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'hover_style', 'value' => array('sliding')),
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter color. The default delimiter color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Delimeter color', 'dfd-native'),
				'param_name'		=> 'connector_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'connector_style', 'value' => array('solid', 'dashed', 'dotted', 'double')),
				'group'				=> esc_html__('Content style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_attr__('Typography', 'dfd-native'),
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
						'font_style'
					),
				),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
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
				'dependency' => array('element' => 'use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Subtitle Typography', 'dfd-native'),
				'param_name'		=> 'subtitle_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
						'font_style'
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
		),
	)
);