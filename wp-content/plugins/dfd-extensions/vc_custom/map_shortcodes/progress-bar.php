<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Progressbar Line
*/

class WPBakeryShortCode_Dfd_Progressbar extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/progressbar/';
vc_map(
	array(
		'name'        => esc_html__( 'Progress bar', 'dfd-native' ),
		'base'        => 'dfd_progressbar',
		'class'       => 'dfd_progressbar dfd_shortcode',
		'icon'        => 'dfd_progressbar dfd_shortcode',
		'category'    => esc_html__( 'Native', 'dfd-native' ),
		'description' => esc_html__( 'Display animated progress bar', 'dfd-native' ),
		'params'      => array(
			array(
				'heading'		=> esc_html__( 'Style', 'dfd-native' ),
				'type'			=> 'radio_image_select',
				'param_name'	=> 'main_layout',
				'simple_mode'	=> false,
				'options'		=> array(
					'layout-1'	=> array(
						'tooltip'	=> esc_html__('Simple','dfd-native'),
						'src'		=> $module_images . 'layout-1.png'
					),
					'layout-2'	=> array(
						'tooltip'	=> esc_html__('Underlined','dfd-native'),
						'src'		=> $module_images . 'layout-2.png'
					),
					'layout-3'	=> array(
						'tooltip'	=> esc_html__('Info inside','dfd-native'),
						'src'		=> $module_images . 'layout-3.png'
					),
				),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the progress value','dfd-native').'</span></span>'.esc_html__('Progress value', 'dfd-native'),
				'param_name'		=> 'percent',
				'value'				=> 100,
				'min'				=> '10',
				'max'				=> '100',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the icon for the progress bar','dfd-native').'</span></span>'.esc_html__('Icon', 'dfd-native'),
				'param_name'		=> 'enable_icon',
				'options'			=> array(
					'icon'				=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon library','dfd-native').'</span></span>'.esc_html__('Icon library', 'dfd-native'),
				'param_name'		=> 'select_icon',
				'value'				=> 'dfd_icons',
				'options'			=> Dfd_Theme_Helpers::build_vc_icons_fonts_list(false),
				'dependency'		=> array('element' => 'enable_icon', 'value' => 'icon',),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'iconpicker',
				'heading'			=> esc_html__('Select Icon', 'dfd-native'),
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
				'type'				=> 'number',
				'heading'			=> esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_size',
				'value'				=> 14,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'enable_icon', 'value' => 'icon',),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'class'				=> 'crum_vc',
				'heading'			=> esc_html__('Color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'value'				=> '#28262b',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'enable_icon', 'value' => 'icon',),
				'group'				=> esc_html__('Icon', 'dfd-native'),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> esc_html__('Title', 'dfd-native'),
				'param_name'		=> 'title',
				'value'				=> esc_html__('Loading', 'dfd-native'),
				'admin_label'		=> true,
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'		=> 'extra_features_elements_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/progress-bar',
				'video_link'		=> 'https://youtu.be/DsBz1LYmkWQ',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('General styles', 'dfd-native'),
				'param_name'		=> 'general_styles',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the progress bar height','dfd-native').'</span></span>'.esc_html__('Progress line height', 'dfd-native'),
				'param_name'		=> 'height_progress_line_style_1',//style-3
				'value'				=> 9,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_layout', 'value'   => array('layout-1')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the progress bar height','dfd-native').'</span></span>'.esc_html__('Progress line height', 'dfd-native'),
				'param_name'		=> 'height_progress_line_style_2',//style-3
				'value'				=> 5,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_layout', 'value'   => array('layout-2')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the progress bar height','dfd-native').'</span></span>'.esc_html__('Progress line height', 'dfd-native'),
				'param_name'		=> 'height_progress_line',//style-3
				'value'				=> 33,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_layout', 'value'   => array('layout-3')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the percents to the left','dfd-native').'</span></span>'.esc_html__('Percents near the title', 'dfd-native'),
				'param_name'		=> 'title_percents_left',
				'options'			=> array(
					'percents_left'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_layout', 'value'   => array('layout-1', 'layout-2')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the progress animation','dfd-native').'</span></span>'.esc_html__('Progress animation', 'dfd-native'),
				'param_name'		=> 'animate_progress',
				'options'			=> array(
					'anim_progress'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the slanting lines decoration on progress line','dfd-native').'</span></span>'.esc_html__('Slanting lines decoration', 'dfd-native'),
				'param_name'		=> 'slanting_lines_decoration',
				'options'			=> array(
					'lines_decoration'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the animation for the slanting lines','dfd-native').'</span></span>'.esc_html__( 'Lines animation', 'dfd-native' ),
				'param_name'		=> 'animate_lines',
				'options'			=> array(
					'anim_lines'		=> array(
						'on'				=> esc_attr__('Yes', 'dfd-native'),
						'off'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc',
				'dependency'		=> array('element' => 'slanting_lines_decoration', 'value'   => array('lines_decoration')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the position for the progress bar text','dfd-native').'</span></span>'.esc_html__('Title position', 'dfd-native'),
				'param_name'		=> 'text_position',
				'value'				=> 'top',
				'options'			=> array(
					esc_html__('Top', 'dfd-native')		=> 'top',
					esc_html__('Bottom', 'dfd-native')		=> 'bottom',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'main_layout', 'value'   => array('layout-1', 'layout-2')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the position for the progress bar title and percents','dfd-native').'</span></span>'.esc_html__('Title & percents position', 'dfd-native'),
				'param_name'		=> 'title_percent_position',
				'value'				=> array(
					esc_html__('Title left, percents at the end of progress line', 'dfd-native')		=> 'percents-center',
					esc_html__('Title and percents on the left', 'dfd-native')							=> 'percents-left',
					esc_html__('Title left, percents right', 'dfd-native')								=> 'percents-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-3')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Back line', 'dfd-native'),
				'param_name'		=> 'back_line',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the back line. The default color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Back line background', 'dfd-native'),
				'param_name'		=> 'back_line_background',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_border',
				'param_name'		=> 'back_line_border',
				'simple'			=> false,
				'unit'				=> 'px',
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
				'value'				=> 'border-style:none;|border-width:1px;|border-radius:0px;|border-color:#1b1b1b;',
				'dependency'		=> array('element' => 'main_layout', 'value' => array('layout-1', 'layout-3')),
				'group'				=> esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Progress line', 'dfd-native'),
				'param_name'		=> 'progress_line',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background style, you can choose simple color or gradient','dfd-native').'</span></span>'. esc_html__( 'Background style', 'dfd-native' ),
				'param_name'		=> 'background_style',
				'value'				=> 'solid_background',
				'options'			=> array(
					esc_html__( 'Solid', 'dfd-native' )		=> 'solid_background',
					esc_html__( 'Gradient', 'dfd-native' )	=> 'gradient_background',
				),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the progress line. The default color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Background', 'dfd-native'),
				'param_name'		=> 'progress_background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'background_style', 'value' => array('solid_background')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_gradient',
				'param_name'		=> 'progress_background_gradient',
				'dependency'		=> array('element' => 'background_style','value' => array('gradient_background')),
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Title Typography', 'dfd-native' ),
				'param_name'		=> 'content_t_heading',
				'class'				=> 'ult-param-heading',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'			=> 'dfd_font_container',
				'param_name'	=> 'font_options',
				'settings'		=> array(
					'fields'	=> array(
						'tag'	=> 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color'
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency'		=> array('element' => 'title', 'not_empty' => true),
				'group'			=> esc_html__( 'Typography', 'dfd-native' ),
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
				'dependency'		=> array('element' => 'font_options', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'use_google_fonts', 'value'   => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Number Typography', 'dfd-native' ),
				'param_name'		=> 'nfh',
				'class'				=> 'ult-param-heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'dependency'		=> array('element' => 'percent', 'not_empty' => true),
				'group'				=> esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'			=> 'dfd_font_container',
				'param_name'	=> 'number_font_options',
				'settings'		=> array(
					'fields'	=> array(
						'tag'	=> 'div',
						'font_size',
						'letter_spacing',
						'line_height',
						'color'
					),
				),
				'dependency'		=> array('element' => 'percent', 'not_empty' => true),
				'group'			=> esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'use_number_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'font_options', 'not_empty' => true),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'number_custom_fonts',
				'settings'			=> array(
					'fields'		=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'use_number_google_fonts', 'value'   => 'yes'),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);