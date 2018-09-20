<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Blog posts
*/
class WPBakeryShortCode_Dfd_Blog_Posts extends WPBakeryShortCode {}

vc_map(
	array(
		'name' => esc_html__('Blog posts','dfd-native'),
		'base' => 'dfd_blog_posts',
		'class' => 'dfd_blog_posts dfd_shortcode',
		'icon' => 'dfd_blog_posts dfd_shortcode',
		'category' => esc_html__('Native','dfd-native'),
		'admin_enqueue_js' => DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/custom-dependency.js',
		'front_enqueue_js' => DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/admin/js/custom-dependency.js',
		'description' => esc_html__('Displays blog posts','dfd-native'),
		'params' => array(
			array(
				'type'        => 'radio_image_select',
				'heading'     => esc_html__( 'Style', 'dfd-native' ),
				'param_name'  => 'post_content_style',
				'simple_mode' => false,
				'options'     => array(
					'full' => array(
						'tooltip' => esc_attr__('Standard','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-full.png'
					),
					'full_front' => array(
						'tooltip' => esc_attr__('Dark overlay','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-full_front.png'
					),
					'tiny' => array(
						'tooltip' => esc_attr__('Tiny posts','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-tiny.png'
					),
					'list' => array(
						'tooltip' => esc_attr__('News list','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-list.png'
					),
				),
			),
			array(
				'type'        => 'radio_image_select',
				'heading'     => esc_html__( 'Content style', 'dfd-native' ),
				'param_name'  => 'post_style',
				'simple_mode' => false,
				'options'     => array(
					'fitRows' => array(
						'tooltip' => esc_attr__('Grid','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-fitRows.png'
					),
					'masonry' => array(
						'tooltip' => esc_attr__('Masonry','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-masonry.png'
					),
					'shortcode_metro' => array(
						'tooltip' => esc_attr__('Metro','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-masonry.png'
					),
					'carousel' => array(
						'tooltip' => esc_attr__('Carousel','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/blog_posts/news-carousel.png'
					),
				),
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Posts settings', 'dfd-native' ),
				'param_name'       => 'loop_elements_heading',
				'class'            => '',
				'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				'group'            => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_taxonomy_multicheck',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the categories you would like to display','dfd-native').'</span></span>'.esc_html__('Categories','dfd-native'),
				'param_name' => 'post_categories',
				'taxonomy' => 'category',
				'dependency' => array('element' => 'items','value_not_equal_to' => array('single')),
				'edit_field_class' => 'vc_column vc_col-sm-12 dfd-taxonomy-multicheck',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the number of items you would like to display','dfd-native').'</span></span>'.esc_html__('Posts to show', 'dfd-native'),
				'param_name' => 'posts_to_show',
				'value' => 3,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
//				'dependency' => array('element' => 'items','value_not_equal_to' => array('single')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the blog post items','dfd-native').'</span></span>'.esc_html__('Items offset', 'dfd-native'),
				'param_name' => 'items_offset',
				'value' => 20,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the width for the post thumbnail','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
				'param_name' => 'post_image_width',
				'value' => 600,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'post_content_style','value' => array('full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the height for the post thumbnail','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
				'param_name' => 'post_image_height',
				'value' => 600,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'post_content_style','value' => array('full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Layout settings', 'dfd-native' ),
				'param_name'       => 'layout_settings_heading',
				'dependency' => array('element' => 'post_content_style', 'value' => array('full', 'full_front','tiny')),
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group'			   => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the number of columns for the blog post items','dfd-native').'</span></span>'.esc_html__('Number of columns', 'dfd-native'),
				'param_name' => 'columns',
				'value' => 3,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the autoplay for the slider','dfd-native').'</span></span>'. esc_html__('Auto slideshow','dfd-native'),
				'param_name' => 'enabled_autoslideshow',
				'value' => 'true',
				'options' => array(
					'true' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'dependency' => array('element' => 'post_style','value' => array('carousel')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' =>  '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the speed for the slideshow','dfd-native').'</span></span>'.esc_html__('Slideshow speed', 'dfd-native'),
				'param_name' => 'carousel_slideshow_speed',
				'value' => 5000,
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				'dependency' => array('element' => 'enabled_autoslideshow','value' => array('true')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the blog post\'s thumbnail','dfd-native').'</span></span>'.esc_html__('Thumb border radius', 'dfd-native'),
				'param_name' => 'thumb_rounded',
				'value' => 6,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
				'dependency' => array('element' => 'post_content_style','value' => array('full','full_front', 'tiny')),
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
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_style','value' => array('masonry','fitRows','shortcode_metro')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Media','dfd-native'),
				'param_name' => 'post_show_image',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_style','value' => array('fitRows','carousel')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Category','dfd-native'),
				'param_name' => 'post_show_top_cat',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Title','dfd-native'),
				'param_name' => 'post_show_title',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Meta','dfd-native'),
				'param_name' => 'post_show_meta',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Date in post meta','dfd-native'),
				'param_name' => 'post_show_meta_date',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Category in post meta','dfd-native'),
				'param_name' => 'post_show_meta_category',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Comments counter in post meta','dfd-native'),
				'param_name' => 'post_show_meta_comments',
				'value' => '',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Likes in post meta','dfd-native'),
				'param_name' => 'post_show_meta_likes',
				'value' => '',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_show_meta','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Excerpt','dfd-native'),
				'param_name' => 'post_show_content',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Author info','dfd-native'),
				'param_name' => 'post_show_author_box',
				'value' => 'on',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_single_checkbox',
				'heading' => esc_html__('Tiled posts style','dfd-native'),
				'param_name' => 'post_tiled',
				'value' => '',
				'options' => array(
					'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
				'dependency' => array('element' => 'post_content_style','value' => array('full', 'full_front')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the sort panel horizontally','dfd-native').'</span></span>'.esc_html__('Sort panel alignment','dfd-native'),
				'param_name' => 'sort_panel_alignment',
				'value'	=> 'text-center',
				'options' => array(
					esc_attr__('Left','dfd-native') => 'text-left',
					esc_attr__('Center','dfd-native') => 'text-center',
					esc_attr__('Right','dfd-native') => 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				'dependency' => array('element' => 'show_sort_panel','value' => array('on')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the horizontal alignment for the blog post info','dfd-native').'</span></span>'.esc_html__('Content alignment','dfd-native'),
				'param_name' => 'post_content_alignment',
				'value'	=> 'text-left',
				'options' => array(
					esc_attr__('Left','dfd-native') => 'text-left',
					esc_attr__('Center','dfd-native') => 'text-center',
					esc_attr__('Right','dfd-native') => 'text-right'
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				'dependency' => array('element' => 'post_content_style','value' => array('full','full_front','list')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array(
				'type' => 'dfd_radio_advanced',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the style for the blog post\'s delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter style','dfd-native'),
				'param_name' => 'post_delimiter_style',
				'value'	=> 'solid',
				'options' => array(
					esc_attr__('Solid','dfd-native') => 'solid',
					esc_attr__('Dashed','dfd-native') => 'dashed',
					esc_attr__('Dotted','dfd-native') => 'dotted',
					esc_attr__('None','dfd-native') => 'none',
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
				'dependency' => array('element' => 'post_content_style','value' => array('list')),
				'group'      => esc_attr__( 'Content', 'dfd-native' ),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'param_name' => 'use_dots',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the pagination dots for your blog posts carousel','dfd-native').'</span></span>'.esc_html__('Pagination', 'dfd-native'),
				'value' => 'show',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'dependency' => array('element' => 'post_style','value' => array('carousel')),
				'group' => esc_html__('Pagination', 'dfd-native'),
			),
			array (
				'type' => 'radio_image_select',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose one of the 10 preset pagination styles','dfd-native').'</span></span>'.esc_html__('Pagination style', 'dfd-native'),
				'param_name' => 'dots_style',
				'simple_mode' => false,
				'value'=>'dfdroundedempty',
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
				'param_name' => 'title_font_options',
				'settings'   => array(
					'fields' => array(
						//'tag' => 'div',
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
							'label' => '',
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
				'dependency' => array(
					'element' => 'title_google_fonts',
					'value'   => 'yes',
				),
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
			'type'				=> 'dfd_video_link_param',
			'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
			'param_name'		=> 'tutorials',
			'doc_link'			=> '//nativewptheme.net/support/visual-composer/blog-posts',
			'video_link'		=> 'https://www.youtube.com/watch?v=q-sl5LbT428&feature=youtu.be',
			),
		),
	)
);
