<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Client Logo for Visual Composer
*/

class WPBakeryShortCode_Dfd_Client_Logo extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/client_logo/';
vc_map(
	array(
		'name'					=> esc_html__('Client Logos', 'dfd-native'),
		'base'					=> 'dfd_client_logo',
		'class'					=> 'dfd_client_logo dfd_shortcode',
		'icon'					=> 'dfd_client_logo dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
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
						'tooltip'			=> esc_attr__('Slide up','dfd-native'),
						'src'				=> $module_images.'style-2.png'
					),
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/clients-logos',
				'video_link'		=> 'https://www.youtube.com/watch?v=NU7LgIuQOc8&feature=youtu.be',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List content', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'value'				=> '%5B%7B%22block_title%22%3A%22Client%20title%22%2C%22block_subtitle%22%3A%22Client%20subtitle%22%2C%22block_content%22%3A%22Client%20description.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%2C%22link_box%22%3A%22link_b%22%7D%2C%7B%22block_title%22%3A%22Client%20title%22%2C%22block_subtitle%22%3A%22Client%20subtitle%22%2C%22block_content%22%3A%22Client%20description.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%2C%22link_box%22%3A%22link_b%22%7D%2C%7B%22block_title%22%3A%22Client%20title%22%2C%22block_subtitle%22%3A%22Client%20subtitle%22%2C%22block_content%22%3A%22Client%20description.%20Lorem%20ipsum%20dolor%20sit%20amet%2C%20consectetur%20adipiscing%20elit.%20Quisque%20mollis%20ex%20eu%20blandit%20scelerisque.%22%2C%22link_box%22%3A%22link_b%22%7D%5D',
				'params'			=> array(
					array(
						'type'			=> 'attach_image',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Upload Image', 'dfd-native'),
						'param_name'	=> 'icon_image_id',
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'dfd-native'),
						'param_name'	=> 'block_title',
						'value'			=> esc_html__('Client title', 'dfd-native'),
						'admin_label'	=> true,
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Subtitle', 'dfd-native'),
						'param_name'	=> 'block_subtitle',
						'value'			=> esc_html__('Client subtitle', 'dfd-native'),
						'admin_label'	=> true,
					),
					array(
						'type'			=> 'textarea',
						'heading'		=> esc_html__('Description','dfd-native'),
						'param_name'	=> 'block_content',
						'value'			=> esc_html__('Client description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mollis ex eu blandit scelerisque.', 'dfd-native'),
					),
					array(
						'type'			=> 'dfd_single_checkbox',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the link to your client\'s logo','dfd-native').'</span></span>'.esc_html__('Link', 'dfd-native'),
						'param_name'	=> 'link_box',
						'value'			=> 'link_b',
						'options'		=> array(
							'link_b'		=> array(
								'yes'			=> esc_attr__('Yes', 'dfd-native'),
								'no'			=> esc_attr__('No', 'dfd-native')
							),
						),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					),
					array(
						'type'			=> 'vc_link',
						'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd-native').'</span></span>'.esc_html__('Add link', 'dfd-native'),
						'param_name'	=> 'link',
						'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc no-border-bottom',
						'dependency'	=> array('element' => 'link_box', 'value' => 'link_b'),
					),
				),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the number of columns you would like to show your logos','dfd-native').'</span></span>'.esc_html__('Columns', 'dfd-native'),
				'param_name'		=> 'columns',
				'value'				=> 'default',
				'options'			=> array(
					esc_html__('Auto', 'dfd-native')		=> 'default',
					esc_html__('1', 'dfd-native')		=> 1,
					esc_html__('2', 'dfd-native')		=> 2,
					esc_html__('3', 'dfd-native')		=> 3,
					esc_html__('4', 'dfd-native')		=> 4,
					esc_html__('5', 'dfd-native')		=> 5,
					esc_html__('6', 'dfd-native')		=> 6,
				),
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the delimiter between the logos','dfd-native').'</span></span>'.esc_html__('Delimiter', 'dfd-native'),
				'param_name'		=> 'enable_delimiter',
				'value'				=> '',
				'options'			=> array(
					'on'			=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the general border for the clients\' logos. The border will be set around all logos','dfd-native').'</span></span>'.esc_html__('General border', 'dfd-native'),
				'param_name'		=> 'enable_main_border',
				'value'				=> '',
				'options'			=> array(
					'on'			=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('The default title color is inherited from Theme Options > Typography/Fonts > Headings typography > Content title big Typography. The default subtitle color is #b5b5b5. The default content color is inherited from Theme Options > Typography/Fonts > Text typography > Default text Typography','dfd-native').'</span></span>'.esc_html__('Content color', 'dfd-native'),
				'param_name'		=> 'mask_content_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the mask background. The default mask color is #fff','dfd-native').'</span></span>'.esc_html__('Mask background', 'dfd-native'),
				'param_name'		=> 'mask_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'group'				=> esc_html__('Settings', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow on hover for the client logo','dfd-native').'</span></span>'.esc_html__('Shadow', 'dfd-native'),
				'param_name'		=> 'disable_shadow',
				'value'				=> 'shadow',
				'options'			=> array(
					'shadow'			=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency'	=> array('element' => 'main_style', 'value' => array('style-1', 'style-2')),
				'group'				=> esc_html__('Settings', 'dfd-native'),
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
				'text'				=> esc_html__('Description Typography', 'dfd-native'),
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