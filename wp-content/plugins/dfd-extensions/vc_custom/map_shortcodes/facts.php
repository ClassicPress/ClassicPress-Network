<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Facts Line
*/
class WPBakeryShortCode_Dfd_Facts extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/facts/';

vc_map(
	array(
		'name'				=> esc_html__('Facts', 'dfd-native'),
		'base'				=> 'dfd_facts',
		'class'				=> 'dfd_facts dfd_shortcode',
		'icon'				=> 'dfd_facts dfd_shortcode',
		'category'			=> esc_html__('Native', 'dfd-native'),
		'description'		=> esc_html__('Display facts with numbers and icon', 'dfd-native'),
		'params' => array(
			array(
				'heading'			=> esc_html__( 'Style', 'dfd-native' ),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Standard','dfd-native'),
						'src'				=> $module_images . 'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Top icon','dfd-native'),
						'src'				=> $module_images . 'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('Bottom icon','dfd-native'),
						'src'				=> $module_images . 'style-3.png'
					),
					'style-4'			=> array(
						'tooltip'			=> esc_html__('Title with icon','dfd-native'),
						'src'				=> $module_images . 'style-4.png'
					),
					'style-5'			=> array(
						'tooltip'			=> esc_html__('Number with icon','dfd-native'),
						'src'				=> $module_images . 'style-5.png'
					),
					'style-6'			=> array(
						'tooltip'			=> esc_html__('Side number','dfd-native'),
						'src'				=> $module_images . 'style-6.png'
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content', 'dfd-native'),
				'param_name'		=> 'content_t',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Number', 'dfd-native'),
				'param_name'		=> 'number',
				'value'				=> 888,
				'edit_field_class'	=> 'vc_column vc_col-sm-3',
				'admin_label'		=> true,
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Title', 'dfd-native'),
				'param_name'		=> 'title',
				'value'				=> esc_html__('Fact heading', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-9',
				'admin_label'		=> true,
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Subtitle', 'dfd-native'),
				'param_name'		=> 'subtitle',
				'value'				=> esc_html__('Fact subtitle', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the animation for the number. You can also set the number without animation','dfd-native').'</span></span>'.esc_html__('Numbers animation', 'dfd-native'),
				'param_name'		=> 'transition',
				'value'				=> 'counter',
				'options'			=> array(
					esc_html__( 'Count', 'dfd-native' )	=> 'counter',
					esc_html__( 'Odometr', 'dfd-native' )	=> 'odometer',
					esc_html__( 'Without', 'dfd-native' )	=> 'disable-animation',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the content horizontally','dfd-native').'</span></span>'.esc_html__('Content alignment', 'dfd-native'),
				'param_name'		=> 'content_alignment',
				'value'				=> 'text-center',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right',
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5')),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the content horizontally','dfd-native').'</span></span>'.esc_html__('Content alignment', 'dfd-native'),
				'param_name'		=> 'content_alignment2',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Right', 'dfd-native')	=> 'text-right',
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-6')),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/facts-module',
				'video_link'		=> 'https://youtu.be/xTYKo__ixuw',
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the icon to the fact','dfd-native').'</span></span>'.esc_html__('Icon', 'dfd-native'),
				'param_name'		=> 'show_icon',
				'options'			=> array(
					'enable_icon'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text', 'dfd-native').'</span></span>'.esc_html__('Icon to display', 'dfd-native'),
				'param_name'		=> 'icon_type',
				'value'				=> 'selector',
				'options'				=> array(
					esc_html__('Icon', 'dfd-native')	=> 'selector',
					esc_html__('Image', 'dfd-native')	=> 'custom',
					esc_html__('Text', 'dfd-native')	=> 'text',
				),
				'dependency'		=> array('element' => 'show_icon', 'value' => array('enable_icon')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon library','dfd-native').'</span></span>'.esc_html__('Icon library', 'dfd-native'),
				'param_name'		=> 'select_icon',
				'value'				=> 'dfd_icons',
				'options'			=> Dfd_Theme_Helpers::build_vc_icons_fonts_list(false),
				'dependency'		=> array('element' => 'icon_type', 'value' => array('selector')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'iconpicker',
				'heading'			=> esc_html__('Select Icon ', 'dfd-native'),
				'param_name'		=> 'ic_dfd_icons',
				'value'				=> 'dfd-socicon-px-icon',
				'settings'			=> array(
					'emptyIcon'			=> false,
					'type'				=> 'dfd_icons',
					'iconsPerPage'		=> 4000,
				),
				'dependency'		=> array('element' => 'select_icon', 'value' => 'dfd_icons',),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			Dfd_Theme_Helpers::build_vc_icons_param('fontawesome', esc_html__('Icon', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('openiconic', esc_html__('Icon', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('typicons', esc_html__('Icon', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('entypo', esc_html__('Icon', 'dfd-native'), array()),
			Dfd_Theme_Helpers::build_vc_icons_param('linecons', esc_html__('Icon', 'dfd-native'), array()),
			array(
				'type'				=> 'attach_image',
				'class'				=> '',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image or choose from media library','dfd-native').'</span></span>'.esc_html__('Upload Image', 'dfd-native'),
				'param_name'		=> 'icon_image_id',
				'dependency'		=> array('element' => 'icon_type', 'value' => array('custom')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Text', 'dfd-native'),
				'param_name'		=> 'icon_text',
				'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the size for the icon (image)','dfd-native').'</span></span>'.esc_html__('Size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'icon_type', 'value'   => array('custom', 'selector')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color is #e5e5e5','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'icon_type', 'value' => array('selector')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'text_icon_font_options',
				'settings'			=> array(
					'fields'		=> array(
						'font_size',
						'letter_spacing',
						'color',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'text_icon_use_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'icon_type', 'value' => array('text')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'text_icon_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'text_icon_use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Number Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'number', 'not_empty' => true),
				'group'				=> esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'color',
					),
				),
				'dependency'		=> array('element' => 'number', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Letter spacing', 'dfd-native'),
				'param_name'		=> 'number_letter_spacing',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'number', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'title_font_options',
				'settings'			=> array(
					'fields'		=> array(
						'tag'			=> 'div',
						'font_size',
						'line_height',
						'color',
						'letter_spacing',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'group'      => esc_html__('Typography', 'dfd-native'),
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
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'use_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Subtitle Typography', 'dfd-native'),
				'param_name'		=> 'subtitle_t_heading',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
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
						'line_height',
						'color',
						'letter_spacing',
						'font_style'
					),
				),
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'subtitle_google_fonts',
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
				'param_name'		=> 'subtitle_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description'	=> esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'	=> esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'subtitle_google_fonts', 'value' => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_param_responsive_text',
				'heading' => esc_html__('Number responsive settings', 'dfd-native'),
				'param_name' => 'number_responsive',
				'description' => '',//esc_html__('Allows you to use custom Google font.', 'dfd-native'),
				'group' => esc_attr__('Responsive', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
			),
		),
	)
);
