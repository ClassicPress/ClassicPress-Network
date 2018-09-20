<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Portfolio module
*/
class WPBakeryShortCode_Dfd_Portfolio_Fullscreen extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_attr__('Full Screen Portfolio','dfd-native'),
		'base' => 'dfd_portfolio_fullscreen',
		'class' => 'dfd_portfolio_fullscreen dfd_shortcode',
		'icon' => 'dfd_portfolio_fullscreen dfd_shortcode',
		'category' => esc_html__('Native','dfd-native'),
		'description' => esc_html__('Full screen Portfolio','dfd-native'),
		'params' => array(
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Portfolio items settings', 'dfd-native' ),
				'param_name'       => 'loop_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type' => 'radio_image_select',
				'heading' => esc_html__('Style','dfd-native'),
				'param_name' => 'portfolio_style',
				'simple_mode' => false,
				'options' => array(
					'horizontal' => array(
						'tooltip' => esc_html__('Horizontal','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/portfolio_fullscreen/horizontal.png'
					),
					'vertical' => array(
						'tooltip' => esc_html__('Vertical','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/portfolio_fullscreen/vertical.png'
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of items you would like to display','dfd-native').'</span></span>'.esc_html__('Items to show', 'dfd-native'),
				'param_name' => 'items_to_show',
				'value' => 5,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			),
			array(
				'type' => 'dfd_taxonomy_multicheck',
				'heading' => esc_html__('Categories','dfd-native'),
				'param_name' => 'portfolio_categories',
				'taxonomy' => 'portfolio_category',
				'dependency' => array('element' => 'items','value_not_equal_to' => array('single')),
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-taxonomy-multicheck no-border-bottom',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'        => 'dropdown',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name'  => 'module_animation',
				'value'       => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'        => 'textfield',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'  => 'el_class',
			),
			array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => 'http://nativewptheme.net/support/visual-composer/full-screen-portfolio/',
				'video_link' => 'https://youtu.be/Aq0900Y0EYc',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Content elements', 'dfd-native' ),
				'param_name'       => 'enabled_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Title','dfd-native'),
				'param_name' => 'portfolio_show_title',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Subtitle','dfd-native'),
				'param_name' => 'portfolio_show_subtitle',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the blur effect for background image','dfd-native').'</span></span>'.esc_html__('Blur','dfd-native'),
				'param_name' => 'portfolio_blur_bg_image',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' =>  '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the portfolio info','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name' => 'portfolio_content_alignment',
				'value' => 'text-left',
				'options' => array(
					esc_html__('Left','dfd-native')	=> 'text-left',
					esc_html__('Center','dfd-native')	=> 'text-center',
					esc_html__('Right','dfd-native')	=> 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'group'      => esc_html__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Images mask settings', 'dfd-native' ),
				'param_name'       => 'hover_main_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the mask overlay color of the large image behind the main carousel','dfd-native').'</span></span>'.esc_html__('Background image mask color', 'dfd-native'),
				'param_name'		=> 'bg_mask_color',
				'value'				=> 'rgba(0,0,0,.6)',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'				=> esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the mask overlay color of carousel images','dfd-native').'</span></span>'.esc_html__('Carousel image mask color', 'dfd-native'),
				'param_name'		=> 'carousel_mask_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
				'group'				=> esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Navigation settings', 'dfd-native' ),
				'param_name'       => 'arrows_settings_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Style', 'dfd-native' ),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'arrows_color',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Navigation arrows color. The default color is white','dfd-native').'</span></span>'.esc_html__('Color', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'arrows_hover_color',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Navigation arows color on hover. The default color is white','dfd-native').'</span></span>'.esc_html__('Hover color', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Navigation arrows backgound. The default background color is transparent','dfd-native').'</span></span>'.esc_html__('Background color', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
				'dependency'		=> array('element' => 'portfolio_style', 'value' => array('horizontal')),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'hover_background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Navigation arows background on hover. The default backgroud color is inherited from Theme Options > Styling Options > Main site color','dfd-native').'</span></span>'.esc_html__('Hover Background', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Style', 'dfd-native'),
				'dependency'		=> array('element' => 'portfolio_style', 'value' => array('horizontal')),
			),
			array(
				'type'				=> 'dfd_param_border',
				'heading'			=> esc_html__('Idle Border', 'dfd-native'),
				'param_name'		=> 'border',
				'simple'			=> false,
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
				'value'				=> 'border_style:default',
				'group'				=> esc_html__('Style', 'dfd-native'),
				'dependency'		=> array('element' => 'portfolio_style', 'value' => array('horizontal')),
			),
			array(
				'type'				=> 'dfd_param_border',
				'heading'			=> esc_html__('Border on hover', 'dfd-native'),
				'param_name'		=> 'hover_border',
				'simple'			=> false,
				'enable_radius'		=> true,
				'value'				=> 'border_style:default',
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Style', 'dfd-native'),
				'dependency'		=> array('element' => 'portfolio_style', 'value' => array('horizontal')),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Title', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'title_t_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'dfd_font_container',
				'param_name' => 'title_font_options',
				'settings'   => array(
					'fields' => array(
						'font_size',
						'line_height',
						'letter_spacing',
						'color',
						'font_style',
					),
				),
				'value' => 'font_size:55|line_height:50|letter_spacing:-3',
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'title_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'group'       => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_custom_fonts',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'dependency' => array(
					'element' => 'title_google_fonts',
					'value'   => 'yes',
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Subtitle', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'subtitle_t_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'            => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'subtitle_font_options',
				'settings'   => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'  => 'subtitle_google_fonts',
				'value' => 'off',
				'options' => array(
					'yes' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'group'       => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'subtitle_custom_fonts',
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'dependency' => array(
					'element' => 'subtitle_google_fonts',
					'value'   => 'yes',
				),
				'group'      => esc_html__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'				=> 'dfd_param_responsive_text',
				'heading'			=> esc_html__('Title responsive settings', 'dfd-native'),
				'param_name'		=> 'title_responsive',
				'value'				=> 'font_size_desktop:35|line_height_desktop:32|letter_spacing_desktop:-1.5|font_size_tablet:28|line_height_tablet:28|letter_spacing_tablet:-1|font_size_mobile:23|line_height_mobile:23|letter_spacing_mobile:-.5',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding no-border-bottom',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);