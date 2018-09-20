<?php

if (!defined('ABSPATH')) {
	exit;
}
/*
 * Add-on Name: Clients Testimonials
 */

class WPBakeryShortCode_Dfd_New_Testimonials extends WPBakeryShortCode {
	
}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/testimonials/';
vc_map(
	array(
		'name' => esc_html__('Testimonial', 'dfd-native'),
		'base' => 'dfd_new_testimonials',
		'class' => 'dfd_testimonials dfd_shortcode',
		'icon' => 'dfd_testimonials dfd_shortcode',
		'category' => esc_html__('Native', 'dfd-native'),
		'description' => esc_html__('Display client testimonial', 'dfd-native'),
		'params' => array(
			array(
				'heading' => esc_html__('Style', 'dfd-native'),
				'type' => 'radio_image_select',
				'param_name' => 'main_layout',
				'simple_mode' => false,
				'options' => array(
					'layout-11' => array(
						'tooltip' => esc_attr__('Bottom info', 'dfd-native'),
						'src' => $module_images . 'testimonials_03.png'
					),
					'layout-12' => array(
						'tooltip' => esc_attr__('Top info', 'dfd-native'),
						'src' => $module_images . 'testimonials_05.png'
					),
					'layout-13' => array(
						'tooltip' => esc_attr__('Top image', 'dfd-native'),
						'src' => $module_images . 'testimonials_07.png'
					),
					'layout-14' => array(
						'tooltip' => esc_attr__('Bottom image', 'dfd-native'),
						'src' => $module_images . 'testimonials_09.png'
					),
					'layout-15' => array(
						'tooltip' => esc_attr__('Right image', 'dfd-native'),
						'src' => $module_images . 'testimonials_11.png'
					),
					'layout-16' => array(
						'tooltip' => esc_attr__('Left image', 'dfd-native'),
						'src' => $module_images . 'testimonials_18.png'
					),
					'layout-17' => array(
						'tooltip' => esc_attr__('Bottom right info', 'dfd-native'),
						'src' => $module_images . 'testimonials_19.png'
					),
					'layout-18' => array(
						'tooltip' => esc_attr__('Bottom left info', 'dfd-native'),
						'src' => $module_images . 'testimonials_21.png'
					),
					'layout-19' => array(
						'tooltip' => esc_attr__('Top right image', 'dfd-native'),
						'src' => $module_images . 'testimonials_23.png'
					),
					'layout-20' => array(
						'tooltip' => esc_attr__('Top left image', 'dfd-native'),
						'src' => $module_images . 'testimonials_24.png'
					),
				),
				'value'=> 'layout-11'
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name' => 'module_animation',
				'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
			),
			array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/testimonial',
				'video_link' => 'https://youtu.be/wWAcC_s4hqY',
			),
			array(
				'type' => 'attach_image',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the testimonial author image','dfd-native').'</span></span>'.esc_attr__('Author Image', 'dfd-native'),
				'param_name' => 'image',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Title', 'dfd-native'),
				'param_name' => 'author',
				'admin_label' => true,
				'value'	=> esc_attr__("Title",'dfd-native'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Subtitle', 'dfd-native'),
				'param_name' => 'subtitle',
				'value'	=> esc_attr__("Subtitle",'dfd-native'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'title_subtitle_nowrap',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the title and the subtitle in one line, first title then subtitle','dfd-native').'</span></span>'.esc_html__('One line title', 'dfd-native'),
				'options' => array(
					'nowrap' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Testimonial', 'dfd-native'),
				'param_name' => 'description',
				'value'	=> esc_html__('Please add some review text. Lorem ipsum dolor sit amet, cu simul nominavi epicurei ius. Mea ea quas corpora inciderint. Quo ei latine mediocrem, quodsi conceptam pro in. Ubique apeirian praesent usu ea.', 'dfd-native'),
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Author thumbnail', 'dfd-native'),
				'param_name' => 'thumb_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Set the border radius for the testimonial author\'s image', 'dfd-native') . '</span></span>' .esc_html__('Border radius', 'dfd-native'),
				'param_name' => 'thumb_radius',
				'min' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the border. The default value is not set','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name' => 'thumb_border_width',
				'min' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the border. The default value is not set','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name' => 'thumb_color',
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the size for the testimonial author\'s image','dfd-native').'</span></span>'. esc_html__('Image size', 'dfd-native'),
				'param_name' => 'thumb_size',
				'min' => 90,
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'hide_shadow',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show the shadow for the testimonial image','dfd-native').'</span></span>'.esc_html__('Shadow', 'dfd-native'),
				'value' => 'show',
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Testimonial background', 'dfd-native'),
				'param_name' => 'bg_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the testimonial. The default value is not set','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'param_name' => 'bg_block_color',
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the testimonial\'s background','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name' => 'bg_radius',
				'min' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-4 dfd-number-wrap crum_vc no-border-bottom',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'show_triangle',
				'value' => 'show',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show the triangle pointer to the testimonial image (shows only if content background color is selected)','dfd-native').'</span></span>'.esc_html__('Triangle pointer', 'dfd-native'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-4',
				'group' => esc_html__('Style', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Testimonial', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'content_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'content_font_options',
				'settings' => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style',
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts_testimonial',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_testimonial',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array(
					'element' => 'use_google_fonts_testimonial',
					'value' => 'show',
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Title', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'title_t_heading',
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'title_font_options',
				'settings' => array(
					'fields' => array(
						'tag' => 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array(
					'element' => 'use_google_fonts',
					'value' => 'show',
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Subtitle', 'dfd-native') . ' ' . esc_attr__('Typography', 'dfd-native'),
				'param_name' => 'subtitle_t_heading',
				'group' => esc_html__('Typography', 'dfd-native'),
				'class' => 'ult-param-heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'subtitle_font_options',
				'settings' => array(
					'fields' => array(
						'tag' => 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_google_fonts_subtitle',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'custom_fonts_subtitle',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array(
					'element' => 'use_google_fonts_subtitle',
					'value' => 'show',
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_param_responsive_text',
				'heading' => esc_html__('Testimonial content responsive settings', 'dfd-native'),
				'param_name' => 'title_responsive',
				'edit_field_class' => 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group' => esc_html__('Responsive', 'dfd-native'),
			),
		),
	)
);
