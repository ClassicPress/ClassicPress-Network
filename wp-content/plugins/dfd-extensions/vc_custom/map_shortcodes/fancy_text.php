<?php

if (!defined('ABSPATH')) {
	exit;
}

class WPBakeryShortCode_Dfd_Animated_Text extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_html__('Animated text', 'dfd-native'),
		'base' => 'dfd_animated_text',
		'class' => 'dfd_animated_text dfd_shortcode',
		'icon' => 'dfd_animated_text dfd_shortcode',
		'controls' => 'full',
		'show_settings_on_create' => true,
		'description' => esc_html__('Animated text with changing or typing effect', 'dfd-native'),
		'category' => esc_html__('Native', 'dfd-native'),
		'params' => array(
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Style', 'dfd-native'),
				'param_name' => 'main_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type' => 'radio_image_select',
				'heading' => '',
				'param_name' => 'style',
				'admin_label' => true,
				'simple_mode' => false,
				'options' => array(
					'chaffle' => array(
						'tooltip' => esc_attr__('Shuffle', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/animated_text/chaffle.png'
					),
					'typed' => array(
						'tooltip' => esc_attr__('Typing', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/animated_text/typed.png'
					),
					'changethewords' => array(
						'tooltip' => esc_attr__('Words changing', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/animated_text/changethewords.png'
					),
				),
				'value'=> "chaffle"
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the text horizontally','dfd-native').'</span></span>'.esc_html__('Text alignment', 'dfd-native'),
				'param_name'		=> 'alignment',
				'admin_label'		=> true,
				'value'				=> 'text-left',
				'options' => array(
					esc_attr__('Left', 'dfd-native')	=> 'text-left',
					esc_attr__('Center', 'dfd-native') => 'text-center',
					esc_attr__('Right', 'dfd-native')	=> 'text-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the spped of the text animation','dfd-native').'</span></span>'.esc_html__('Typing speed', 'dfd-native'),
				'param_name' => 'type_speed',
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-second crum_vc',
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the animation for the words appearing','dfd-native').'</span></span>'.esc_html__('Words animation in', 'dfd-native'),
				'param_name' => 'onchange_animation',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'style', 'value' => array('changethewords')),
				'value' => Dfd_Theme_Helpers::animation_lists_in(),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the animation for the words disappearing','dfd-native').'</span></span>'.esc_html__('Words animation out', 'dfd-native'),
				'param_name' => 'afterchange_animation',
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'style', 'value' => array('changethewords')),
				'value' => Dfd_Theme_Helpers::animation_lists_out(),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the loop for the animated text','dfd-native').'</span></span>'.esc_html__('Loop', 'dfd-native'),
				'param_name' => 'loop',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'dependency' => array('element' => 'style', 'value' => array('typed')),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the cursor for the animated text','dfd-native').'</span></span>'.esc_html__('Cursor', 'dfd-native'),
				'param_name' => 'cursor',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'label' => '',
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'dependency' => array('element' => 'style', 'value' => array('typed')),
				'edit_field_class' => 'vc_column vc_col-sm-6',
			),
			/*array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Extra settings', 'dfd-native'),
				'param_name' => 'extra_heading',
				'class' => '',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),*/
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
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/animated-text',
				'video_link'		=> 'https://www.youtube.com/watch?v=Zxq9NViXRqg&feature=youtu.be',
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Content settings', 'dfd-native'),
				'param_name' => 'content_heading',
				'class' => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Will be displayed before animated text','dfd-native').'</span></span>'.esc_attr__('Prefix', 'dfd-native'),
				'param_name'		=> 'prefix',
				'value'				=> esc_attr__('Animated text', 'dfd-native'),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('Animated text string', 'dfd-native'),
				'param_name'		=> 'text_fields',
				'params'			=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Single string', 'dfd-native'),
						'admin_label'	=> true,
						'param_name'	=> 'text_field',
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('String color', 'dfd-native'),
						'param_name'	=> 'text_field_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('String background', 'dfd-native'),
						'param_name'	=> 'text_field_background',
						'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					),
				),
				'value'				=> "%5B%7B%22text_field%22%3A%22awesome%22%2C%22text_field_color%22%3A%22%231e73be%22%7D%2C%7B%22text_field%22%3A%22amazing%22%2C%22text_field_color%22%3A%22%231e73be%22%7D%5D",
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Will be displayed after animated text','dfd-native').'</span></span>'.esc_attr__('Postfix', 'dfd-native'),
				'param_name'		=> 'postfix',
				'value'				=> esc_attr__('demonstration', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Color settings', 'dfd-native'),
				'param_name' => 'colors_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_html__('Content', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'prefix_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the prefix. The default color is inherited from Theme Options > Typography/Fonts > Headings typography > H2','dfd-native').'</span></span>'.esc_html__('Prefix color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'group' => esc_attr__('Content', 'dfd-native'),
			),
			array(
				'type' => 'colorpicker',
				'param_name' => 'postfix_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the postfix. The default color is inherited from Theme Options > Typography/Fonts > Headings typography > H2','dfd-native').'</span></span>'.esc_html__('Postfix color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_attr__('Content', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Animated string typography settings', 'dfd-native'),
				'param_name' => 'typography_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'title_font_options',
				'settings' => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style'
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name' => 'title_google_fonts',
				'options' => array(
					'show' => array(
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'title_custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'title_google_fonts', 'value' => 'show'),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Prefix and Postfix Typography settings', 'dfd-native'),
				'param_name' => 'typography_add_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'pref_post_font_options',
				'settings' => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style'
					),
				),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name' => 'pref_post_google_fonts',
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
				'param_name' => 'pref_post_custom_fonts',
				'settings' => array(
					'fields' => array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array('element' => 'pref_post_google_fonts', 'value' => 'show'),
				'group' => esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Animated string typography responsive settings', 'dfd-native'),
				'param_name'		=> 'title_responsive',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group'				=> esc_html__('Responsive', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Prefix and Postfix typography responsive settings', 'dfd-native'),
				'param_name'		=> 'pref_post_responsive',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group'				=> esc_html__('Responsive', 'dfd-native'),
			),
		)
	)
);