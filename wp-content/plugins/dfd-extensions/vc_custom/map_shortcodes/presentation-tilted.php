<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Gradation for Visual Composer
*/

class WPBakeryShortCode_Dfd_Presentation_Tilted extends WPBakeryShortCode {}

$repeater_params = array(
	array(
		'type'			=> 'dfd_radio_advanced',
		'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text', 'dfd-native').'</span></span>'.esc_html__('Icon to display', 'dfd-native'),
		'param_name'	=> 'icon_type',
		'value'			=> 'selector',
		'options'		=> array(
			esc_html__('Icon','dfd-native')		=> 'selector',
			esc_html__('Image','dfd-native')		=> 'custom',
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
		'value'			=> 'dfd-socicon-px-icon',
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
		'heading'		=> esc_html__('Upload Image', 'dfd-native'),
		'param_name'	=> 'icon_image_id',
		'description'	=> esc_html__('Upload the custom image.', 'dfd-native'),
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
	array(
		'type'				=> 'colorpicker',
		'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color is inherited from Theme Options > Styling Options > Main site color.','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
		'param_name'		=> 'icon_color',
		'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
	),
	array(
		'type'				=> 'colorpicker',
		'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the block background color. The default color is #f4f4f4','dfd-native').'</span></span>'.esc_html__('Block background', 'dfd-native'),
		'param_name'		=> 'block_background',
		'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
	),
	array(
		'type'			=> 'dfd_single_checkbox',
		'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('If you choose Dark background the text colors will be changed to make it more visible','dfd-native').'</span></span>'.esc_html__('Dark background', 'dfd-native'),
		'param_name'	=> 'dark_bg',
		'options'		=> array(
			'bg'			=> array(
				'yes'			=> esc_attr__('Yes', 'dfd-native'),
				'no'			=> esc_attr__('No', 'dfd-native'),
			),
		),
		'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
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

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/presentation_tilted/';
vc_map(
	array(
		'name'					=> esc_html__('Tilted info', 'dfd-native'),
		'base'					=> 'dfd_presentation_tilted',
		'class'					=> 'dfd_presentation_tilted dfd_shortcode',
		'icon'					=> 'dfd_presentation_tilted dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'description'			=> esc_html__('Present the information in tilted blocks', 'dfd-native'),
		'params'				=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_attr__('Left tilt','dfd-native'),
						'src'				=> $module_images.'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_attr__('Right tilt','dfd-native'),
						'src'				=> $module_images.'style-2.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Please, select width of the elements according to the width of the container','dfd-native').'</span></span>'.esc_html__('Element width', 'dfd-native'),
				'param_name'		=> 'columns_width',
				'value'				=> 'one-third-width-elements',
				'options'			=> array(
					esc_html__('Full width', 'dfd-native')		=> 'full-width-element',
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/tilted-info',
				'video_link' => 'https://www.youtube.com/watch?v=fZR1NotL8XI&feature=youtu.be',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List content', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'params'			=> $repeater_params,
				'value'				=> '%5B%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-play%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Shortcode%20title%22%2C%22block_subtitle%22%3A%22Shortcode%20subtitle%22%2C%22block_content%22%3A%22Tilted%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-play%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Shortcode%20title%22%2C%22block_subtitle%22%3A%22Shortcode%20subtitle%22%2C%22block_content%22%3A%22Tilted%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%2C%7B%22icon_type%22%3A%22selector%22%2C%22select_icon%22%3A%22dfd_icons%22%2C%22ic_dfd_icons%22%3A%22dfd-socicon-play%22%2C%22ic_fontawesome%22%3A%22fa%20fa-adjust%22%2C%22ic_openiconic%22%3A%22vc-oi%20vc-oi-dial%22%2C%22ic_typicons%22%3A%22typcn%20typcn-adjust-brightness%22%2C%22ic_entypo%22%3A%22entypo-icon%20entypo-icon-note%22%2C%22ic_linecons%22%3A%22vc_li%20vc_li-heart%22%2C%22block_title%22%3A%22Shortcode%20title%22%2C%22block_subtitle%22%3A%22Shortcode%20subtitle%22%2C%22block_content%22%3A%22Tilted%20content.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%7D%5D',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the size for the icon','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the block background','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name'		=> 'border_radius',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-top-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
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
