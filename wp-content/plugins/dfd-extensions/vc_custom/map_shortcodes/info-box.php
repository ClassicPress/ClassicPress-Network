<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info box
*/

class WPBakeryShortCode_Dfd_Info_Box extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/info_box/';
vc_map(
	array(
		'name'					=> esc_html__('Info box', 'dfd-native'),
		'base'					=> 'dfd_info_box',
		"icon"					=> 'dfd_info_box dfd_shortcode',
		"class"					=> 'dfd_info_box dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'description'			=> esc_html__('Box with short information', 'dfd-native'),
		'params'				=> array(
			array(
				'heading'			=> esc_html__('Style', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'style-1'			=> array(
						'tooltip'			=> esc_html__('Simple', 'dfd-native'),
						'src'				=> $module_images.'style-1.png'
					),
					'style-2'			=> array(
						'tooltip'			=> esc_html__('Colored icon', 'dfd-native'),
						'src'				=> $module_images.'style-2.png'
					),
					'style-3'			=> array(
						'tooltip'			=> esc_html__('Bordered', 'dfd-native'),
						'src'				=> $module_images.'style-3.png'
					),
					'style-4'			=> array(
						'tooltip'			=> esc_html__('Framed', 'dfd-native'),
						'src'				=> $module_images.'style-4.png'
					),
					'style-5'			=> array(
						'tooltip'			=> esc_html__('Background', 'dfd-native'),
						'src'				=> $module_images.'style-5.png'
					),
				),
			),
			array(
				'heading'			=> esc_html__('Icon position', 'dfd-native'),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_layout',
				'simple_mode'		=> false,
				'options'			=> array(
					'layout-1'			=> array(
						'tooltip'			=> esc_attr__('Top', 'dfd-native'),
						'src'				=> $module_images.'layout-1.png'
					),
					'layout-2'			=> array(
						'tooltip'			=> esc_attr__('Left', 'dfd-native'),
						'src'				=> $module_images.'layout-2.png'
					),
					'layout-3'			=> array(
						'tooltip'			=> esc_attr__('Near the title', 'dfd-native'),
						'src'				=> $module_images.'layout-3.png'
					),
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1','style-2','style-3', 'style-4')),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show the content only when you hover over the element','dfd-native').'</span></span>'.esc_html__('Content only on hover', 'dfd-native'),
				'param_name'		=> 'content_only_hover',
				'options'			=> array(
					'only_hover'		=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the info box','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'content_alignment',
				'value'				=> 'text-center',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Center', 'dfd-native')	=> 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right'
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-1')),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the icon','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'content_two_alignment',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Right', 'dfd-native')	=> 'text-right'
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-2', 'layout-3')),
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/info-box',
				'video_link'		=> 'https://youtu.be/EaP4cyYUaAI',
			),
			array(
				'type'				=> 'textarea',
				'heading'			=> esc_html__('Title', 'dfd-native'),
				'param_name'		=> 'title',
				'value'				=> esc_html__('Shortcode title', 'dfd-native'),
				'admin_label'		=> true,
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Subtitle', 'dfd-native'),
				'param_name'		=> 'subtitle',
				'value'				=> esc_html__('Subtitle', 'dfd-native'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textarea',
				'heading'			=> esc_html__('Content', 'dfd-native'),
				'param_name'		=> 'main_content',
				'value'				=> esc_html__('Info box content. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mollis ex eu blandit scelerisque.', 'dfd-native'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select where the link should be applied','dfd-native').'</span></span>'.esc_html__('Apply link to', 'dfd-native'),
				'param_name'		=> 'read_more',
				'value'				=> 'none',
				'options'			=> array(
					esc_html__('No Link', 'dfd-native')		=> 'none',
					esc_html__('Complete Box', 'dfd-native')	=> 'box',
					esc_html__('Box Title', 'dfd-native')		=> 'title',
					esc_html__('Read More', 'dfd-native')		=> 'more',
				),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'vc_link',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add a custom link or select existing page. You can remove existing link as well','dfd-native').'</span></span>'.esc_html__('Link URL', 'dfd-native'),
				'param_name'		=> 'link',
				'dependency'		=> array('element' => 'read_more', 'value' => array('box','title','more')),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the Read more','dfd-native').'</span></span>'.esc_html__('Read more button', 'dfd-native'),
				'param_name'		=> 'readmore_show',
				'options'			=> array(
					'show'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_col-sm-6 vc_column crum_vc',
				'dependency'		=> array('element' => 'read_more', 'value' => array('box','title','more')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the visibility options for the Read more button','dfd-native').'</span></span>'.esc_html__('Button visibility', 'dfd-native'),
				'param_name'		=> 'more_show',
				'value'				=> 'permanent',
				'options'			=> array(
					esc_html__('Permanent', 'dfd-native')		=> 'permanent',
					esc_html__('Show on hover', 'dfd-native')	=> 'hover',
				),
				'dependency'		=> array('element' => 'readmore_show', 'value' => 'show'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 7 preset read more styles','dfd-native').'</span></span>'.esc_html__('Read more style', 'dfd-native'),
				'param_name'		=> 'readmore_style',
				'value'				=> 'read-more-1',
				'options'			=> array(
					esc_html__('Bordered', 'dfd-native')		=> 'read-more-1',
					esc_html__('Shadow', 'dfd-native')			=> 'read-more-2',
					esc_html__('Plus', 'dfd-native')			=> 'read-more-3',
					esc_html__('Arrow & text', 'dfd-native')	=> 'read-more-4',
					esc_html__('Arrow', 'dfd-native')			=> 'read-more-5',
					esc_html__('Dots', 'dfd-native')			=> 'read-more-6',
					esc_html__('Button', 'dfd-native')			=> 'read-more-7',
					esc_html__('Simple', 'dfd-native')			=> 'read-more-8',

				),
				'dependency'		=> array('element' => 'readmore_show', 'value'   => 'show'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Read more text', 'dfd-native'),
				'param_name'		=> 'readmore_text',
				'value'				=> esc_html__('More info', 'dfd-native'),
				'dependency'		=> array('element' => 'readmore_style', 'value'   => array('read-more-1', 'read-more-2', 'read-more-4', 'read-more-7', 'read-more-8')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to set the number in a circled background on the icon', 'dfd-native') . '</span></span>' .esc_html__('Number at icon', 'dfd-native'),
				'param_name'		=> 'icon_number',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2','style-3', 'style-4')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Enter the number you\'d like to show', 'dfd-native') . '</span></span>' .esc_html__('Number', 'dfd-native'),
				'param_name'		=> 'icon_number_text',
				'edit_field_class'	=> 'vc_col-sm-4 vc_column crum_vc',
				'dependency'		=> array('element' => 'icon_number', 'value' => 'yes'),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the color for the number. The default value is #fff', 'dfd-native') . '</span></span>' .esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'number_color',
				'edit_field_class'	=> 'vc_col-sm-4 vc_column crum_vc',
				'dependency'		=> array('element' => 'icon_number', 'value' => 'yes'),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Choose the background color for the number. The default value is #f6547e', 'dfd-native') . '</span></span>' .esc_html__('Background Color', 'dfd-native'),
				'param_name'		=> 'number_bg_color',
				'edit_field_class'	=> 'vc_col-sm-4 vc_column crum_vc',
				'dependency'		=> array('element' => 'icon_number', 'value' => 'yes'),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Use the existing icon font, upload custom image or add the text', 'dfd-native').'</span></span>'.esc_html__('Icon to display', 'dfd-native'),
				'param_name'		=> 'icon_type',
				'value'				=> 'selector',
				'options'			=> array(
					esc_html__('Icon', 'dfd-native')	=> 'selector',
					esc_html__('Image', 'dfd-native')	=> 'custom',
					esc_html__('Text', 'dfd-native')	=> 'text',
				),
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
				'heading'			=> esc_html__('Select Icon', 'dfd-native'),
				'param_name'		=> 'ic_dfd_icons',
				'value'				=> 'dfd-socicon-paper',
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
				'heading'			=> esc_html__('Upload image', 'dfd-native'),
				'param_name'		=> 'icon_image_id',
				'admin_label'		=> true,
				'description'		=> esc_html__('Upload the custom image from media library', 'dfd-native'),
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
				'min'				=> 12,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'icon_type', 'value' => array('custom', 'selector')),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon color. The default color for the style Simple is #bfbfbf. The default color for the style Colored icon is #fff. The default color for the style Bordered is inherited from Theme Options > Styling Options > Main site color. The default color for the style Framed is #3d3d3d. The default color for the style Background is #ebebeb','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
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
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background size for the icon. The default value is 100px','dfd-native').'</span></span>'.esc_html__('Icon background size', 'dfd-native'),
				'param_name'		=> 'icon_bg_size',
				'min'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2','style-3', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the icon\'s background','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name'		=> 'border_radius',
				'min'				=> 0,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-top-padding',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2','style-3', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border radius for the icon\'s background on hover','dfd-native').'</span></span>'.esc_html__('Hover border radius', 'dfd-native'),
				'param_name'		=> 'hover_border_radius',
				'min'				=> 0,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2','style-3', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the icon\'s background. The default color for the style Colored icon is inherited from Theme Options > Styling options > Main site color. The default color for the style Framed is #e7e7e7','dfd-native').'</span></span>'. esc_html__('Background color', 'dfd-native'),
				'param_name'		=> 'background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the icon\'s background on hover','dfd-native').'</span></span>'. esc_html__('Background color on hover', 'dfd-native'),
				'param_name'		=> 'hover_background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-2', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color. The default value is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name'		=> 'border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color on hover. The default value is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border color on hover', 'dfd-native'),
				'param_name'		=> 'hover_border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the border','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name'		=> 'border_width',
				'min'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-3', 'style-4')),
				'group'				=> esc_html__('Icon style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title Typography', 'dfd-native'),
				'param_name'		=> 'title_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
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
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Subtitle Typography', 'dfd-native'),
				'param_name'		=> 'subtitle_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'subtitle', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content Typography', 'dfd-native'),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'main_content', 'not_empty' => true),
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
				'dependency'		=> array('element' => 'main_content', 'not_empty' => true),
				'group'				=> esc_attr__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Title responsive settings', 'dfd-native'),
				'param_name'		=> 'title_responsive',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group'				=> esc_html__('Responsive', 'dfd-native'),
			),
		),
	)
);