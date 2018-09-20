<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Simple Image Gallery for Visual Composer
*/

class WPBakeryShortCode_Dfd_Simple_Image_Gallery extends WPBakeryShortCode {}

vc_map(
	array(
		'name'					=> esc_html__('Simple Image Gallery', 'dfd-native'),
		'base'					=> 'dfd_simple_image_gallery',
		'class'					=> 'dfd_simple_image_gallery dfd_shortcode',
		'icon'					=> 'dfd_simple_image_gallery dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'admin_enqueue_js'		=> DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/custom-dependency.js',
		'front_enqueue_js'		=> DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/custom-dependency.js',
		'params'				=> array(
			array(
				'type'				=> 'radio_image_select',
				'heading'			=> esc_html__( 'Style', 'dfd-native' ),
				'param_name'		=> 'images_style',
				'simple_mode'		=> false,
				'options'			=> array(
					'fitRows'			=> array(
						'tooltip'			=> esc_attr__('Grid','dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/image_gallery/fitRows.png'
					),
					'masonry'			=> array(
						'tooltip'			=> esc_attr__('Masonry','dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/image_gallery/masonry.png'
					),
					'carousel'			=> array(
						'tooltip'			=> esc_attr__('Carousel','dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/image_gallery/carousel.png'
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-bottom-padding',
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'		=> 'el_class',
			),
			array(
				'type'				=> 'dropdown',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name'		=> 'module_animation',
				'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/image-layers',
				'video_link'		=> 'https://www.youtube.com/watch?v=cIDdfCqO2bE&feature=youtu.be',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Gallery images', 'dfd-native'),
				'param_name'		=> 'gallery_images_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
				'group'				=> esc_html__('Gallery', 'dfd-native'),
			),
			array(
				'type'				=> 'attach_images',
				'class'				=> '',
				'heading'			=> esc_html__('Images', 'dfd-native'),
				'param_name'		=> 'dfd_layer_image',
				'value'				=> '',
				'description'		=> esc_html__('Upload or select images from media gallery.', 'dfd-native'),
				'group'				=> esc_html__('Gallery', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content settings', 'dfd-native'),
				'param_name'		=> 'gallery_images_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This options allows you to define the offset between the images.','dfd-native').'</span></span>'.esc_html__('Items offset', 'dfd-native'),
				'param_name'		=> 'items_offset',
				'value'				=> 0,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable lightbox option for gallery images. The images will be opened in the lightbox in original size after click on image.','dfd-native').'</span></span>'. esc_html__('Enable lightbox','dfd-native'),
				'param_name'		=> 'lightbox',
				'value'				=> 'true',
				'options'			=> array(
					'true'	=> array(
							'label'		=> '',
							'on'		=> 'Yes',
							'off'		=> 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc no-top-margin',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the image width. This option is used for image resize action','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name'		=> 'image_width',
				'value'				=> 900,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the image height. This option is used for image resize action','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name'		=> 'image_height',
				'value'				=> 600,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'dependency'		=> array('element' => 'images_style','value' => array('fitRows', 'carousel')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the number of columns of the gallery','dfd-native').'</span></span>'.esc_html__('Columns','dfd-native'),
				'param_name'		=> 'isotope_columns',
				'value'				=> 3,
				'options'			=> array(
					esc_attr__('One','dfd-native')		=> 1,
					esc_attr__('Two','dfd-native')		=> 2,
					esc_attr__('Three','dfd-native')	=> 3,
					esc_attr__('Four','dfd-native')		=> 4,
					esc_attr__('Five','dfd-native')		=> 5,
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc add-border-top no-border-bottom',
				'dependency'		=> array('element' => 'images_style','value' => array('fitRows', 'masonry')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable hard image crop option. You will get the slides of equal size without saving image ration if you enable this option. You can also disable it and the images will keep the original aspect ratio in that case.','dfd-native').'</span></span>'. esc_html__('Crop images','dfd-native'),
				'param_name'		=> 'crop_images',
				'value'				=> 'true',
				'options'			=> array(
					'true'	=> array(
							'label'		=> '',
							'on'		=> 'Yes',
							'off'		=> 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc add-border-top',
				'dependency' => array('element' => 'images_style','value' => array('carousel')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable autoslideshow for the images carousel.','dfd-native').'</span></span>'. esc_html__('Autoplay','dfd-native'),
				'param_name'		=> 'autoplay',
				'value'				=> 'true',
				'options'			=> array(
					'true'	=> array(
							'label' => '',
							'on'	=> 'Yes',
							'off'	=> 'No',
						),
					),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc add-border-top',
				'dependency'		=> array('element' => 'images_style','value' => array('carousel')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Slides to show', 'dfd-native'),
				'param_name'		=> 'slides_to_show',
				'value'				=> 3,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'crop_images','value' => array('true')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Slides to scroll', 'dfd-native'),
				'param_name'		=> 'slides_to_scroll',
				'value'				=> 1,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'images_style','value' => array('carousel')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Please define the default image height. This option will be used for image resize. The displayed images height can vary depending on carousel settings and screen resolution.','dfd-native').'</span></span>'.esc_html__('Slideshow speed', 'dfd-native'),
				'param_name'		=> 'carousel_slideshow_speed',
				'value'				=> 3000,
				'edit_field_class'	=> 'vc_column vc_col-sm-4 crum_vc no-border-bottom',
				'dependency'		=> array('element' => 'autoplay', 'value' => array('true')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array (
				'type'				=> 'dfd_single_checkbox',
				'param_name'		=> 'use_dots',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the pagination dots for your portfolio carousel','dfd-native').'</span></span>'.esc_html__('Pagination', 'dfd-native'),
				'value'				=> 'off',
				'options'			=> array (
					'show'	=> array (
						'on'	=> esc_html__('Yes', 'dfd-native'),
						'off'	=> esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 crum_vc add-border-top',
				'dependency'		=> array('element' => 'images_style','value' => array('carousel')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
			array (
				'type'				=> 'radio_image_select',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 10 preset pagination styles','dfd-native').'</span></span>'.esc_html__('Pagination style', 'dfd-native'),
				'param_name'		=> 'dots_style',
				'simple_mode'		=> false,
				'value'				=>'dfdrounded',
				'options'			=> array (
					'dfdrounded'		=> array (
						'tooltip'			=> esc_attr__('Rounded', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_1.png'
					),
					'dfdfillrounded'	=> array (
						'tooltip'			=> esc_attr__('Filled rounded', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_2.png'
					),
					'dfdemptyrounded'	=> array (
						'tooltip'			=> esc_attr__('Transparent rounded', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_3.png'
					),
					'dfdfillsquare'		=> array (
						'tooltip'			=> esc_attr__('Filled square', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_7.png'
					),
					'dfdsquare'			=> array (
						'tooltip'			=> esc_attr__('Square', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_6.png'
					),
					'dfdemptysquare'	=> array (
						'tooltip'			=> esc_attr__('Transparent square', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_8.png'
					),
					'dfdline'			=> array (
						'tooltip'			=> esc_attr__('Line', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_4.png'
					),
					'dfdadvancesquare'	=> array (
						'tooltip'			=> esc_attr__('Advanced square', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_5.png'
					),
					'dfdroundedempty'	=> array (
						'tooltip'			=> esc_attr__('Rounded Empty', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_9.png'
					),
					'dfdroundedfilled'	=> array (
						'tooltip'			=> esc_attr__('Rounded Filled', 'dfd-native'),
						'src'				=> DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/carousel/dots/style_10.png'
					),
				),
				'dependency'		=> Array ('element' => 'use_dots', 'value' => array ('show')),
				'group'				=> esc_html__('Content', 'dfd-native'),
			),
		),
	)
);