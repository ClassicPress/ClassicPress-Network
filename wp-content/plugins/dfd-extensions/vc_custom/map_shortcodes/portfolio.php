<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Portfolio module
*/
class WPBakeryShortCode_Dfd_Portfolio_Module extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_attr__('Portfolio module','dfd-native'),
		'base' => 'dfd_portfolio_module',
		'class' => 'dfd_portfolio dfd_shortcode',
		'icon' => 'dfd_portfolio dfd_shortcode',
		'category' => esc_attr__('Native','dfd-native'),
		'admin_enqueue_js' => DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/custom-dependency.js',
		'front_enqueue_js' => DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/custom-dependency.js',
		'description' => esc_attr__('Displays Portfolio items','dfd-native'),
		'params' => array(
			array(
				'type'        => 'radio_image_select',
				'heading'     => esc_html__( 'Style', 'dfd-native' ),
				'param_name'  => 'portfolio_style',
				'simple_mode' => false,
				'options'     => array(
					'carousel' => array(
						'tooltip' => esc_attr__('Carousel','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/portfolio_gallery/carousel.png'
					),
					'fitRows' => array(
						'tooltip' => esc_attr__('Grid','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/portfolio_gallery/fitRows.png'
					),
					'masonry' => array(
						'tooltip' => esc_attr__('Masonry','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/portfolio_gallery/masonry.png'
					),
					'justified' => array(
						'tooltip' => esc_attr__('Justified grid','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/portfolio_gallery/justified.png'
					),
				),
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
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/portfolio-module',
				'video_link' => 'https://www.youtube.com/watch?v=xWQrIPskTds&feature=youtu.be',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__( 'Portfolio items settings', 'dfd-native' ),
				'param_name'		=> 'loop_elements_heading',
				'group'				=> esc_attr__( 'Content', 'dfd-native' ),
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_taxonomy_multicheck',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the categories you would like to display','dfd-native').'</span></span>'.esc_html__('Categories','dfd-native'),
				'param_name' => 'portfolio_categories',
				'taxonomy' => 'portfolio_category',
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-taxonomy-multicheck',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of items you would like to display','dfd-native').'</span></span>'.esc_html__('Portfolios to show', 'dfd-native'),
				'param_name' => 'posts_to_show',
				'value' => 6,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				'dependency' => array('element' => 'items','value_not_equal_to' => array('single')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the portfolio items','dfd-native').'</span></span>'.esc_html__('Items offset', 'dfd-native'),
				'param_name' => 'items_offset',
				'value' => 20,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'portfolio_style','value' => array('carousel','fitRows','masonry')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the width of the portfolio thumbnail image','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name' => 'image_width',
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'portfolio_style','value' => array('carousel','fitRows')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the height of the portfolio thumbnail image','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name' => 'image_height',
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'portfolio_style','value' => array('carousel','fitRows')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Layout settings', 'dfd-native' ),
				'param_name'       => 'layout_settings_heading',
				'group'			   => esc_attr__( 'Content', 'dfd-native' ),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the number of columns for the portfolio items','dfd-native').'</span></span>'.esc_html__('Number of columns', 'dfd-native'),
				'param_name' => 'columns',
				'value' => 3,
				'options' => array(
					esc_html__('One','dfd-native') => 1,
					esc_html__('Two','dfd-native') => 2,
					esc_html__('Three','dfd-native') => 3,
					esc_html__('Four','dfd-native') => 4,
					esc_html__('Five','dfd-native') => 5,
				),
				'dependency' => array('element' => 'portfolio_style','value_not_equal_to' => array('justified')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the slider','dfd-native').'</span></span>'.esc_html__('Auto slideshow','dfd-native'),
				'param_name' => 'enabled_autoslideshow',
				'value' => 'true',
				'options' => array(
					'true' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_style','value' => array('carousel')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' =>  '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd-native').'</span></span>'.esc_html__('Slideshow speed', 'dfd-native'),
				'param_name' => 'carousel_slideshow_speed',
				'value' => 5000,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-ml-second',
				'dependency' => array('element' => 'enabled_autoslideshow','value' => array('true')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Content elements', 'dfd-native' ),
				'param_name'       => 'enabled_elements_heading',
				'group'            => esc_attr__( 'Content', 'dfd-native' ),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Sort Panel','dfd-native'),
				'param_name' => 'show_sort_panel',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_style','value' => array('masonry','fitRows')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Category','dfd-native'),
				'param_name' => 'portfolio_show_top_cat',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Title','dfd-native'),
				'param_name' => 'portfolio_show_title',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Subtitle','dfd-native'),
				'param_name' => 'portfolio_show_subtitle',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Meta','dfd-native'),
				'param_name' => 'portfolio_show_meta',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Date in portfolio meta','dfd-native'),
				'param_name' => 'portfolio_show_meta_date',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Category in portfolio meta','dfd-native'),
				'param_name' => 'portfolio_show_meta_category',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Comments counter in portfolio meta','dfd-native'),
				'param_name' => 'portfolio_show_meta_comments',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Likes in portfolio meta','dfd-native'),
				'param_name' => 'portfolio_show_meta_likes',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'class' => '',
				'heading' => esc_html__('Excerpt','dfd-native'),
				'param_name' => 'portfolio_show_content',
				'options' => array(
					'on' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the sort panel horizontally','dfd-native').'</span></span>'.esc_html__('Sort panel alignment','dfd-native'),
				'param_name' => 'sort_panel_alignment',
				'value' => 'text-center',
				'options' => array(
					esc_attr__('Center','dfd-native') => 'text-center',
					esc_attr__('Left','dfd-native') => 'text-left',
					esc_attr__('Right','dfd-native') => 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'show_sort_panel','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the displaying of the portfolio info content. You can set the content under or infront of the portfolio items','dfd-native').'</span></span>'.esc_html__('Content position','dfd-native'),
				'param_name' => 'portfolio_content_position',
				'value' => 'bottom',
				'options' => array(
					esc_attr__('Bottom','dfd-native') => 'bottom',
					esc_attr__('Front','dfd-native') => 'front',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_style','value' => array('carousel','fitRows','masonry')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the vertical alignment for the portfolio info','dfd-native').'</span></span>'.esc_html__('Content vertical alignment','dfd-native'),
				'param_name' => 'portfolio_content_valign',
				'value' => 'bottom',
				'options' => array(
					esc_attr__('Bottom','dfd-native') => 'bottom',
					esc_attr__('Middle','dfd-native') => 'middle',
					esc_attr__('Top','dfd-native') => 'top',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency' => array('element' => 'portfolio_content_position','value' => array('front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the portfolio info','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name' => 'portfolio_content_alignment',
				'value' => 'text-left',
				'options' => array(
					esc_attr__('Left','dfd-native') => 'text-left',
					esc_attr__('Center','dfd-native') => 'text-center',
					esc_attr__('Right','dfd-native') => 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Main hover settings', 'dfd-native' ),
				'param_name'       => 'hover_main_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type'        => 'dfd_single_checkbox',
				'heading'     => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the hover effect for the portfolio items','dfd-native').'</span></span>'.esc_html__( 'Hover', 'dfd-native' ),
				'param_name'  => 'portfolio_hover_enable',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'group'       => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' =>  '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the content hover style. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect.','dfd-native').'</span></span>'.esc_html__('Content style','dfd-native'),
				'param_name' => 'portfolio_content_style',
				'value' => 'standard',
				'options' => array(
					esc_attr__('Simple','dfd-native') => 'standard',
					esc_attr__('Tiled','dfd-native') => 'tiled',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_style','value' => array('fitRows','masonry','justified')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to select the hover effect for the mask appearing','dfd-native').'</span></span>'.esc_html__('Mask appear effect','dfd-native'),
				'param_name' => 'portfolio_hover_appear_effect',
				'value' => array(
					esc_attr__('Fade out','dfd-native') => 'dfd-fade-out',
					esc_attr__('Fade out offset','dfd-native') => 'dfd-fade-offset',
					esc_attr__('From left to right','dfd-native') => 'dfd-left-to-right',
					esc_attr__('From right to left','dfd-native') => 'dfd-right-to-left',
					esc_attr__('From top to bottom','dfd-native') => 'dfd-top-to-bottom',
					esc_attr__('From bottom to top','dfd-native') => 'dfd-bottom-to-top',
					esc_attr__('Following the mouse','dfd-native') => 'portfolio-hover-style-1',
					esc_attr__('3d parallax','dfd-native') => 'dfd-3d-parallax',
				),
				'dependency' => array('element' => 'portfolio_hover_enable','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image behavior on hover','dfd-native').'</span></span>'.esc_html__('Image hover effect','dfd-native'),
				'param_name' => 'portfolio_hover_image_effect',
				'value' => array(
					esc_attr__('Image parallax','dfd-native') => 'panr',
					esc_attr__('Grow','dfd-native') => 'dfd-image-scale',
					esc_attr__('Grow with rotation','dfd-native') => 'dfd-image-scale-rotate',
					esc_attr__('Shift left','dfd-native') => 'dfd-image-shift-left',
					esc_attr__('Shift right','dfd-native') => 'dfd-image-shift-right',
					esc_attr__('Shift top','dfd-native') => 'dfd-image-shift-top',
					esc_attr__('Shift bottom','dfd-native') => 'dfd-image-shift-bottom',
					esc_attr__('Blur','dfd-native') => 'dfd-image-blur',
				),
				'dependency' => array(
					'element' => 'portfolio_hover_appear_effect',
					'value' => array(
						'dfd-fade-out','dfd-fade-offset','dfd-left-to-right','dfd-right-to-left','dfd-top-to-bottom','dfd-bottom-to-top'
						)
					),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Hover mask settings', 'dfd-native' ),
				'param_name'       => 'hover_deco_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'            => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the content text. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Text color','dfd-native').'</span></span>'.esc_html__('Mask content color', 'dfd-native'),
				'param_name' => 'portfolio_hover_mask_color',
				'dependency' => array('element' => 'portfolio_hover_enable','value' => array('on')),
				'group' => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background style, you can choose simple color or gradient. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Hover mask background style','dfd-native').'</span></span>'.esc_html__('Hover mask background style','dfd-native'),
				'param_name' => 'portfolio_hover_mask_background_style',
				'value' => 'simple-color',
				'options' => array(
					esc_attr__('Simple color','dfd-native') => 'simple-color',
					esc_attr__('Gradient','dfd-native') => 'gradient',
				),
				'dependency' => array('element' => 'portfolio_hover_enable','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array (
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background color. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Hover mask background color','dfd-native').'</span></span>'. esc_html__('Mask background', 'dfd-native'),
				'param_name' => 'portfolio_hover_mask_background',
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-hide-alpha',
				'dependency' => array('element' => 'portfolio_hover_mask_background_style','value' => array('simple-color')),
				'group' => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'portfolio_hover_mask_bg_start_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the mask background gradient. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Background gradient','dfd-native').'</span></span>'.esc_html__('Start color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-hide-alpha',
				'dependency' => array('element' => 'portfolio_hover_mask_background_style','value' => array('gradient')),
				'group' => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'portfolio_hover_mask_bg_end_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the mask background gradient. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Background gradient','dfd-native').'</span></span>'.esc_html__('End color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6 dfd-hide-alpha',
				'dependency' => array('element' => 'portfolio_hover_mask_background_style','value' => array('gradient')),
				'group' => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover mask background opacity. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Background opacity','dfd-native').'</span></span>'. esc_html__('Hover mask background opacity','dfd-native'),
				'min' => 1,
				'max' => 100,
				'param_name' => 'portfolio_hover_mask_background_opacity',
				'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc dfd-number-percent',
				'dependency' => array('element' => 'portfolio_hover_enable','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the frame decoration on hover','dfd-native').'</span></span>'. esc_html__('Hover mask frame decoration','dfd-native'),
				'param_name' => 'portfolio_hover_mask_border',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class'=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array('element' => 'portfolio_hover_enable','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the style for the frame decoration on hover','dfd-native').'</span></span>'. esc_html__('Hover mask frame style','dfd-native'),
				'param_name' => 'portfolio_hover_mask_bordered_style',
				'value' => 'simple-border',
				'options' => array(
					esc_attr__('Simple','dfd-native') => 'simple-border',
					esc_attr__('Offset','dfd-native') => 'offset',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_hover_mask_border','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the size for the frame decoration on hover','dfd-native').'</span></span>'. esc_html__('Hover mask frame size','dfd-native'),
				'param_name' => 'portfolio_hover_mask_bordered_size',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'portfolio_hover_mask_border','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Hover decoration settings', 'dfd-native' ),
				'param_name'       => 'hover_elements_heading',
				'group'            => esc_attr__( 'Hover', 'dfd-native' ),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the behavior for the decoration link', 'dfd-native') . '</span></span>' .esc_html__('Decoration link','dfd-native'),
				'param_name' => 'portfolio_hover_main_decoration_link',
				'value' => 'inside',
				'options' => array(
					esc_attr__('Inside','dfd-native') => 'inside',
					esc_attr__('External link','dfd-native') => 'external',
					esc_attr__('Lightbox','dfd-native') => 'lightbox',
				),
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value_not_equal_to' => array('buttons')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the main decoration style', 'dfd-native') . '</span></span>' .esc_html__('Main decoration','dfd-native'),
				'param_name' => 'portfolio_hover_main_decoration',
				'value' => 'heading',
				'options' => array(
					esc_attr__('Heading','dfd-native') => 'heading',
					esc_attr__('Plus','dfd-native') => 'plus',
					esc_attr__('Dots','dfd-native') => 'dots',
					esc_attr__('Buttons','dfd-native') => 'buttons',
					esc_attr__('None','dfd-native') => 'none',
				),
				'dependency' => array('element' => 'portfolio_hover_enable','value' => array('on')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Title','dfd-native'),
				'param_name' => 'portfolio_hover_show_title',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class'=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('heading')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Subtitle','dfd-native'),
				'param_name' => 'portfolio_hover_show_subtitle',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class'=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('heading')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Plus style','dfd-native'),
				'param_name' => 'portfolio_hover_plus_position',
				'value' => array(
					esc_attr__('Big plus in the middle of the thumb','dfd-native') => 'dfd-middle',
					esc_attr__('Small plus in the middle of the thumb','dfd-native') => 'dfd-middle dfd-plus-bordered',
					esc_attr__('Following the mouse','dfd-native') => 'dfd-cursor-plus',
				),
				'edit_field_class'=> 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('plus')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Link inside portfolio item','dfd-native'),
				'param_name' => 'portfolio_hover_buttons_inside',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class'=> 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('buttons')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Portfolio item external link','dfd-native'),
				'param_name' => 'portfolio_hover_buttons_external',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class'=> 'vc_column vc_col-sm-6',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('buttons')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Lightbox','dfd-native'),
				'param_name' => 'portfolio_hover_buttons_lightbox',
				'value' => 'on',
				'options' => array(
					'on' => array(
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class'=> 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('buttons')),
				'group'      => esc_attr__( 'Hover', 'dfd-native' ),
			),
			array (
				'type' => 'colorpicker',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the buttons background color. The default value is inherited from Theme Options > Portfolio Options > Portfolio hover style options > Buttons background','dfd-native').'</span></span>'. esc_html__('Buttons background', 'dfd-native'),
				'param_name' => 'portfolio_hover_buttons_bg',
				'group' => esc_attr__( 'Hover', 'dfd-native' ),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency' => array('element' => 'portfolio_hover_main_decoration','value' => array('buttons')),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_dots',
				'heading' => esc_html__('Pagination', 'dfd-native'),
				'value' => 'show',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'dependency' => array('element' => 'portfolio_style','value' => array('carousel')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array (
				'type' => 'radio_image_select',
				'heading' => esc_html__('Pagination style', 'dfd-native'),
				'param_name' => 'dots_style',
				'simple_mode' => false,
				'value'=>'dfdrounded',
				'options' => array (
					'dfdrounded' => array (
						'tooltip' => esc_attr__('Rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_1.png'
					),
					'dfdfillrounded' => array (
						'tooltip' => esc_attr__('Filled rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_2.png'
					),
					'dfdemptyrounded' => array (
						'tooltip' => esc_attr__('Transparent rounded', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_3.png'
					),
					'dfdfillsquare' => array (
						'tooltip' => esc_attr__('Filled square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
					),
					'dfdsquare' => array (
						'tooltip' => esc_attr__('Square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_6.png'
					),
					'dfdemptysquare' => array (
						'tooltip' => esc_attr__('Transparent square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_8.png'
					),
					'dfdline' => array (
						'tooltip' => esc_attr__('Line', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_4.png'
					),
					'dfdadvancesquare' => array (
						'tooltip' => esc_attr__('Advanced square', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_5.png'
					),
					'dfdroundedempty' => array (
						'tooltip' => esc_attr__('Rounded Empty', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_9.png'
					),
					'dfdroundedfilled' => array (
						'tooltip' => esc_attr__('Rounded Filled', 'dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_10.png'
					),
				),
				'dependency' => Array ('element' => 'use_dots', 'value' => array ('show')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Title', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'title_t_heading',
				'group'            => esc_attr__( 'Typography', 'dfd-native' ),
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'       => 'dfd_font_container',
				'heading'    => '',
				'param_name' => 'title_font_options',
				'settings'   => array(
					'fields' => array(
						'font_size',
						'letter_spacing',
						'line_height',
						'color',
						'font_style'
					),
				),
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
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
				'group'       => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'title_custom_fonts',
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
				'settings'   => array(
					'fields' => array(
						'font_family_description' => esc_html__( 'Select font family.', 'dfd-native' ),
						'font_style_description'  => esc_html__( 'Select font style.', 'dfd-native' ),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
				'dependency' => array(
					'element' => 'title_google_fonts',
					'value'   => 'yes',
				),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Subtitle', 'dfd-native' ) . ' ' . esc_attr__( 'Typography', 'dfd-native' ),
				'param_name'       => 'subtitle_t_heading',
				'group'            => esc_attr__( 'Typography', 'dfd-native' ),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
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
				'group'       => esc_attr__( 'Typography', 'dfd-native' ),
			),
			array(
				'type'       => 'google_fonts',
				'param_name' => 'subtitle_custom_fonts',
				'group'      => esc_attr__( 'Typography', 'dfd-native' ),
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
			),
		),
	)
);