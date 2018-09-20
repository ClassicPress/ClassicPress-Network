<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'crum_portfolio_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function crum_portfolio_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'portfolio_';
	
	$appear_effects = Dfd_Theme_Helpers::dfd_module_animation_styles('metaboxes');
	
	$appear_effects[0]['name'] = esc_html__('Theme default', 'dfd-native');
	
	$meta_boxes[] = array(
		'id'         => 'dfd-options_group',
		'title'      => esc_html__('Single Portfolio item options', 'dfd-native'),
		'pages'      => array('portfolio'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Advanced settings','dfd-native'),
				'desc' => '',
				'id' => $prefix . 'portfolio_advanced_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Portfolio item style on Portfolio page template', 'dfd-native'),
				'tooltip_text' => esc_html__('Choose the item style for the portfolio\'s featured image, available only for Portfolio layout style > Metro. Standard allows you to show standard thumbnail size on portfolio page template. Wide allows you to show wide thumbnail on portfolio page template. Tall allows you to show tall thumbnail on portfolio page template. Large allows you to show large thumbnail on portfolio page template. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix . 'single_loop_apear',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/portfolio-inside-featured.png',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '' ),
					array( 'name' => esc_html__('Standard', 'dfd-native'), 'value' => 'dfd-standard' ),
					array( 'name' => esc_html__('Wide', 'dfd-native'), 'value' => 'dfd-side-image' ),
					array( 'name' => esc_html__('Tall', 'dfd-native'), 'value' => 'dfd-featured' ),
					array( 'name' => esc_html__('Large', 'dfd-native'), 'value' => 'dfd-side-image dfd-featured' ),
				),
				'std' => 'dfd-standard'
			),
			array(
				'name' => esc_html__('Media style','dfd-native'),
				'tooltip_text' => esc_html__('Carousel allows you to show the big image and the gallery carousel under it. Grid allows you to show regularly spaced horizontal and vertical images.  Masonry allows you to show images one after another, first in the horizontal direction, then vertically. Video allows you to set video on the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => $prefix . 'single_style',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/portfolio-inside-style.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Carousel','dfd-native'), 'value' => 'carousel', ),
					array( 'name' => esc_attr__('Grid','dfd-native'), 'value' => 'fitRows', ),
					array( 'name' => esc_attr__('Masonry','dfd-native'), 'value' => 'masonry', ),
					array( 'name' => esc_attr__('Video','dfd-native'), 'value' => 'video', ),
				),
				'std'  => '',
			),
			array(
                'name' => esc_html__('Reduce image size', 'dfd-native'),
				'tooltip_text' => esc_html__('This option allows you to crop the images if the option is enabled. The images will be set in original size if the option is disabled', 'dfd-native'),
                'desc' => '',
                'id'   => $prefix . 'single_reduce_image_size',
                'type' => 'checkbox',
				'dep_option'    => $prefix .'single_style',
				'dep_values'    => 'masonry',
            ),
			array(
				'name' => esc_html__('Number of columns','dfd-native'),
				'tooltip_text' => esc_html__('Set the number of columns to show', 'dfd-native'),
				'desc' => '',
				'id' => $prefix . 'single_columns',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('One','dfd-native'), 'value' => '1', ),
					array( 'name' => esc_attr__('Two','dfd-native'), 'value' => '2', ),
					array( 'name' => esc_attr__('Three','dfd-native'), 'value' => '3', ),
					array( 'name' => esc_attr__('Four','dfd-native'), 'value' => '4', ),
					array( 'name' => esc_attr__('Five','dfd-native'), 'value' => '5', ),
				),
				'dep_option'    => $prefix . 'single_style',
				'dep_values'    => 'masonry,fitRows',
				'std'  => '',
			),
			array(
				'name'	=> esc_html__('Video source', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to choose the video source.', 'dfd-native'),
				'id'	=> $prefix .'single_video_src',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/video.png',
				'options' => array(
					array( 'name' => esc_html__('Youtube', 'dfd-native'), 'value' => 'youtube' ),
					array( 'name' => esc_html__('Vimeo', 'dfd-native'), 'value' => 'vimeo' ),
					array( 'name' => esc_html__('MP4', 'dfd-native'), 'value' => 'mp4' ),
                    array( 'name' => esc_html__('WebM', 'dfd-native'), 'value' => 'webm' ),
				),
				'std' => 'youtube',
				'dep_option'    => $prefix .'single_style',
				'dep_values'    => 'video',
			),
            array(
                'name' => esc_html__('YouTube video URL', 'dfd-native'),
                'desc'	=> '',
                'tooltip_text'	=> esc_html__('Look at the URL of the video, and at the end of it, you should see a combination of numbers and letters after an equal sign (=).', 'dfd-native'),
                'id'	=> $prefix .'youtube_video_url',
                'type'	=> 'text',
				'dep_option'    => $prefix .'single_video_src',
				'dep_values'    => 'youtube',
            ),
            array(
                'name' =>  esc_html__('Vimeo video URL', 'dfd-native'),
                'tooltip_text'	=> esc_html__('Copy the numeric code that appears at the end of the video URL.', 'dfd-native'),
                'id'	=> $prefix .'vimeo_video_url',
                'type'	=> 'text',
				'dep_option'    => $prefix .'single_video_src',
				'dep_values'    => 'vimeo',
            ),
            array(
                'name' =>  esc_html__('Self hosted video file in mp4 format', 'dfd-native'),
                'desc'	=> '',
                'id'	=> $prefix .'mp4_video_url',
                'type'	=> 'file',
				'dep_option'    => $prefix .'single_video_src',
				'dep_values'    => 'mp4',
            ),
            array(
                'name' =>  esc_html__('Self hosted video file in webM format', 'dfd-native'),
                'desc'	=> '',
                'id'	=> $prefix .'webm_video_url',
                'type'	=> 'file',
				'dep_option'    => $prefix .'single_video_src',
				'dep_values'    => 'webm',
            ),
			array(
				'name' => esc_html__('Images offset', 'dfd-native'),
				'desc' => '',
				'id' => $prefix .'single_gallery_offset',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => '',
				'dep_option'    => $prefix .'single_style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'name'	=> esc_html__('Visual Composer content position', 'dfd-native'),
				'tooltip_text' => esc_html__('This option defines the Visual Composer content position inside portfolio item. It can be displayed over or under gallery', 'dfd-native'),
				'id'	=> $prefix .'single_vc_content',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_attr__('Top', 'dfd-native'), 'value' => 'top', ),
					array( 'name' => esc_attr__('Bottom', 'dfd-native'), 'value' => 'bottom', ),
				),
			),
			array(
				'name' => esc_html__('Description settings','dfd-native'),
				'desc' => '',
				'id' => $prefix . 'portfolio_description_heading',
				'type' => 'title',
			),
			array(
				'id'          => $prefix . 'single_description',
				'type'        => 'group',
	            'name' => '',
				'options'     => array(
					'group_title'   => false,
					'add_button'    => esc_html__( 'Add field', 'dfd-native' ),
					'remove_button' => '',
					'sortable'      => true,
				),
				'fields'      => array(
					array(
					'name' => esc_html__('Item content','dfd-native'),
					'tooltip_text' => esc_html__('Description allows you to add the section title and the section content. Short Info allows you to add section title without the section content. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
					'id' => $prefix . 'single_content_style',
					'type' => 'radio_inline_triple',
					'options' => array(
						array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => ' ', ),
						array( 'name' => esc_attr__('Description','dfd-native'), 'value' => 'description', ),
						array( 'name' => esc_attr__('Short info','dfd-native'), 'value' => 'info', ),
					),
					'std'  => 'description',
				),
					array(
						'name' => esc_html__('Section title','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the section title.', 'dfd-native'),
						'id'   => $prefix . 'single_title',
						'type' => 'text',
					),
					array(
						'name' => esc_html__('Section content','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the description to the section content.', 'dfd-native'),
						'id'   => $prefix . 'single_content',
						'type' => 'textarea',
						'dep_values'    => ' ,description',
					),
					array(
						'name' => esc_html__('Info title','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the title for the clients info.', 'dfd-native'),
						'id'   => $prefix . 'single_info_title_1',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Info text','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the content to the clients info.', 'dfd-native'),
						'id'   => $prefix . 'single_info_text_1',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Info title','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the title for the clients info.', 'dfd-native'),
						'id'   => $prefix . 'single_info_title_2',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Info text','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the content to the clients info.', 'dfd-native'),
						'id'   => $prefix . 'single_info_text_2',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Link title','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the title for the link.', 'dfd-native'),
						'id'   => $prefix . 'single_link_title',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Link text','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the text of the link.', 'dfd-native'),
						'id'   => $prefix . 'single_link_text',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Link URL','dfd-native'),
						'tooltip_text' => esc_html__('Here you can add the link.', 'dfd-native'),
						'id'   => $prefix . 'single_link_url',
						'type' => 'text',
						'class' => 'three columns',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Button text','dfd-native'),
						'tooltip_text' => esc_html__('Set the button text in this field.', 'dfd-native'),
						'id'   => $prefix . 'single_button_text',
						'type' => 'text',
						'dep_values'    => 'info',
					),
					array(
						'name' => esc_html__('Button URL','dfd-native'),
						'tooltip_text' => esc_html__('Allows you to add the URL for the button.', 'dfd-native'),
						'id'   => $prefix . 'single_button_url',
						'type' => 'text',
						'dep_values'    => 'info',
					),
				),
			),
			array(
				'name'	=> esc_html__('Description position', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to add the description to the right, to the left or to the button according to the media content. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_description_position',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/portfolio-inside-content.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_attr__('Left', 'dfd-native'), 'value' => 'left', ),
                    array( 'name' => esc_attr__('Right', 'dfd-native'), 'value' => 'right', ),
					array( 'name' => esc_attr__('Bottom', 'dfd-native'), 'value' => 'bottom', ),
				),
				'std' => 'bottom'
			),
			array(
                'name' => esc_html__('Additional link url','dfd-native'),
				'tooltip_text' => esc_html__('Allows you to add the external link which will be shown on hover on the portfolio page template.', 'dfd-native'),
                'id'   => $prefix . 'single_external_link_url',
                'type' => 'text',
            ),
			array(
				'name' => esc_html__('Layout settings','dfd-native'),
				'desc' => '',
				'id' => 'single_portfolio_layout_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Pagination to previous and next portfolio style', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to show or hide the pagination inside the portfolio item. If you choose Fixed the pagination will be shown to the left and right at the bottom of the page. If you choose Top the pagination will be set above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_pagination_style',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_attr__('Disable', 'dfd-native'), 'value' => 'off', ),
					array( 'name' => esc_attr__('Fixed', 'dfd-native'), 'value' => 'fixed', ),
					array( 'name' => esc_attr__('Top', 'dfd-native'), 'value' => 'top', ),
				),
			),
			array(
				'name' => esc_html__('Content settings','dfd-native'),
				'desc' => '',
				'id' => 'single_portfolio_content_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Categories', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to show or hide category name above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_top_tags',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Title', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to show or hide title of the portfolio above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_title',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Meta', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Publication date, category, comments counter, likes of portfolio item.', 'dfd-native'),
				'id'	=> $prefix .'single_show_meta',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Date', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide date of the portfolio creation above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_meta_date',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Category in meta', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide category in meta above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_meta_category',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Comments count', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide Comments count above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_meta_comments',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Likes', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide likes above the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_meta_likes',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Portfolio tags in meta under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide portfolio tags in meta under the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_bottom_tags',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Likes in meta under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide portfolio likes in meta under the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_bottom_likes',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Author info under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide Author info under the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_author',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name' => esc_html__('Share settings','dfd-native'),
				'desc' => '',
				'id' => 'single_portfolio_share_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Share in meta under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide Share under the portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_bottom_share',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Side share', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the side share on portfolio item. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'single_show_fixed_share',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'dfd-portfolio_settings_box',
		'title'      => esc_html__('Portfolio page options', 'dfd-native'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-portfolio.php',
		),
		'fields'     => array(
			array(
				'name' => esc_html__('Layout settings','dfd-native'),
				'desc' => '',
				'id' => $prefix .'layout_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Categories and tags dropdown', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show categories, tags and author drop-down sorter before portfolio items.', 'dfd-native'),
				'id'	=> $prefix .'cat_tag',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name' => esc_html__('Portfolio layout style','dfd-native'),
				'desc' => '',
				'tooltip_text'	=> esc_html__('Here you can choose layout style for the single portfolio item. Side image style allows you to show the featured image on the right or left side. Grid allows you to show regularly spaced horizontal and vertical elements. Masonry allows you to show elements one after another, first in the horizontal direction, then vertically. Justified Grid allows you to show elements one after another, first in the vertical direction, then horizontally. Metro allows you to show thumbnails images according to Portfolio item style set on the inner portfolio page in Single portfolio options -> Advanced settings -> Portfolio item style on Portfolio page template. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => $prefix .'style',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/portfolio-layout.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Side image','dfd-native'), 'value' => 'side-image', ),
					array( 'name' => esc_attr__('Grid','dfd-native'), 'value' => 'fitRows', ),
					array( 'name' => esc_attr__('Masonry','dfd-native'), 'value' => 'masonry', ),
					array( 'name' => esc_attr__('Justified Grid','dfd-native'), 'value' => 'justified', ),
					array( 'name' => esc_attr__('Metro','dfd-native'), 'value' => 'metro', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Portfolio side image layout style','dfd-native'),
				'desc' => '',
				'tooltip_text'	=> esc_html__('Left image allows you to show the featured images to the left and the content to the right. Right image allows you to show the featured images to the right and the content to the left. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => $prefix .'style_side',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/side-image-portfolio.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Left image','dfd-native'), 'value' => 'left-image', ),
					array( 'name' => esc_attr__('Right image','dfd-native'), 'value' => 'right-image', ),
					array( 'name' => esc_attr__('Mixed','dfd-native'), 'value' => 'mixed-image', ),
				),
				'dep_option'    => $prefix .'style',
				'dep_values'    => 'side-image',
				'std'  => 'mixed-image',
			),
			array(
				'name' => esc_html__('Portfolio content style','dfd-native'),
				'desc' => '',
				'tooltip_text'	=> esc_html__('Here you can choose the content style. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect.', 'dfd-native'),
				'id' => $prefix .'content_style',
				'image'	=> get_template_directory_uri().'/assets/admin/img/portfolio-tiled.png',
				'type' => 'radio_image',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Simple','dfd-native'), 'value' => 'standard', ),
					array( 'name' => esc_attr__('Tiled','dfd-native'), 'value' => 'tiled', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Number of columns','dfd-native'),
				'tooltip_text' => esc_html__('Set the number of columns to show', 'dfd-native'),
				'desc' => '',
				'id' => $prefix .'columns',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('One','dfd-native'), 'value' => '1', ),
					array( 'name' => esc_attr__('Two','dfd-native'), 'value' => '2', ),
					array( 'name' => esc_attr__('Three','dfd-native'), 'value' => '3', ),
					array( 'name' => esc_attr__('Four','dfd-native'), 'value' => '4', ),
					array( 'name' => esc_attr__('Five','dfd-native'), 'value' => '5', ),
				),
				'dep_option'    => $prefix .'style',
				'dep_values'    => 'masonry,fitRows,metro',
				'std'  => '3',
			),
			array(
				'name'	=> esc_html__('Sort panel', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Enable or disable the category sorter above the portfolio items', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix .'sort_panel',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'style',
				'dep_values'    => 'masonry,fitRows,metro',
			),
			array(
				'name'	=> esc_html__('Sort panel alignment', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix .'sort_panel_align',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Left', 'dfd-native'), 'value' => 'text-left', ),
                    array( 'name' => esc_attr__('Right', 'dfd-native'), 'value' => 'text-right', ),
                    array( 'name' => esc_attr__('Center', 'dfd-native'), 'value' => 'text-center', ),
				),
				'dep_option'    => $prefix .'sort_panel',
				'dep_values'    => 'on',
			),
			array(
				'name' => esc_html__('Portfolio item content settings','dfd-native'),
				'desc' => '',
				'id' => $prefix .'content_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Content position', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to set the content position according to the portfolio thumbnails', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix .'content_position',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/portfolio-content-position.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Under media', 'dfd-native'), 'value' => 'bottom', ),
                    array( 'name' => esc_attr__('In front of the media', 'dfd-native'), 'value' => 'front', ),
				),
				'dep_option'    => $prefix .'style',
				'dep_values'    => 'masonry,fitRows',
			),
			array(
				'name'	=> esc_html__('Content vertical alignment', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Set the vertical alignment for the portfolio\'s content. This option works for Metro and Justified grid styles', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix .'content_valign',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Top', 'dfd-native'), 'value' => 'top', ),
                    array( 'name' => esc_attr__('Middle', 'dfd-native'), 'value' => 'middle', ),
                    array( 'name' => esc_attr__('Bottom', 'dfd-native'), 'value' => 'bottom', ),
				),
			),
			array(
				'name'	=> esc_html__('Content alignment', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to set the horizontal alignment for the portfolio\'s content', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix .'content_alignment',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_attr__('Center', 'dfd-native'), 'value' => 'text-center', ),
                    array( 'name' => esc_attr__('Left', 'dfd-native'), 'value' => 'text-left', ),
					array( 'name' => esc_attr__('Right', 'dfd-native'), 'value' => 'text-right', ),
				),
			),
			array(
				'name'	=> esc_html__('Top category', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the category name on the top right side of the featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_top_cat',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Title', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the title under the portfolio item featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_title',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Subtitle', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the subtitle under the portfolio item featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_subtitle',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Meta', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the information about the portfolio item (date of creation, category, likes, count) under the featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_meta',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Date', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the date of portfolio item creation under the featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_meta_date',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Category', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the portfolio item category tag under the featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_meta_category',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Comments count', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the number of portfolio item comments under the featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_meta_comments',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Likes', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows to show or hide the amount of likes on the portfolio items. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_meta_likes',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix .'show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Description', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the short description from the Excerpt field under the featured image. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'show_content',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name' => esc_html__('Advanced settings','dfd-native'),
				'desc' => '',
				'id' => $prefix .'advanced_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__('Works per page', 'dfd-native'),
				'desc' => '',
				'tooltip_text'	=> esc_html__('Set the number of portfolio items to display on one page.', 'dfd-native'),
				'id' => $prefix .'posts_per_page',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name'	=> esc_html__('VC Content position', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Choose the position of elements added with the Visual Composer plugin.', 'dfd-native'),
				'id'	=> $prefix .'vc_content_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Over content', 'dfd-native'), 'value' => 'top', ),
					array( 'name' => esc_attr__('Under content', 'dfd-native'), 'value' => 'bottom', ),
				),
			),
			array(
				'name' => esc_html__('Items offset', 'dfd-native'),
				'desc' => '',
				'id' => $prefix .'items_offset',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => '20',
				'dep_option'    => $prefix .'style',
				'dep_values'    => 'masonry,fitRows,side-image',
			),
			array(
                'name' => esc_html__('Portfolio Category','dfd-native'),
                'desc'	=> esc_html__('Select portfolio categories which will be displayed','dfd-native'),
                'id'	=> $prefix .'custom_categories',
                'taxonomy' => $prefix .'category',
                'type' => 'taxonomy_multicheck',
            ),
			array(
				'name'	=> esc_html__('Items appear effect', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows you to set the unique appear effect for the portfolio items. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix .'appear_effect',
				'type'	=> 'select',
				'options' => $appear_effects,
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd-portfolio_hover_settings_box',
		'title'      => esc_html__('Portfolio hover options', 'dfd-native'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-portfolio.php',
		),
		'fields'     => array(
			array(
				'name' => esc_html__('Main hover settings','dfd-native'),
				'desc' => '',
				'id' => 'portfolio_hover_base_heading',
				'type' => 'title',
			),
			array(
                'name' => esc_html__('Portfolio hover', 'dfd-native'),
                'desc' => '',
				'tooltip_text'	=> esc_html__('Allows to show or hide the effect on the mousehover over the portfolio item.', 'dfd-native'),
                'id'   => $prefix . 'hover_enable',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
            ),
			array(
				'name'	=> esc_html__('Hover decoration effect', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Choose the decoration effect you\'d like to have on the portfolio item mousehover.', 'dfd-native'),
				'id'	=> $prefix . 'hover_appear_effect',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_html__('3d parallax', 'dfd-native'), 'value' => 'dfd-3d-parallax', ),
                    array( 'name' => esc_html__('Fade out', 'dfd-native'), 'value' => 'dfd-fade-out', ),
                    array( 'name' => esc_html__('Fade out offset', 'dfd-native'), 'value' => 'dfd-fade-offset', ),
                    array( 'name' => esc_html__('From left to right', 'dfd-native'), 'value' => 'dfd-left-to-right', ),
					array( 'name' => esc_html__('From right to left', 'dfd-native'), 'value' => 'dfd-right-to-left', ),
					array( 'name' => esc_html__('From top to bottom', 'dfd-native'), 'value' => 'dfd-top-to-bottom', ),
					array( 'name' => esc_html__('From bottom to top', 'dfd-native'), 'value' => 'dfd-bottom-to-top', ),
					array( 'name' => esc_html__('Following the mouse', 'dfd-native'), 'value' => 'portfolio-hover-style-1', ),
				),
			),
			array(
				'name'	=> esc_html__('Image animation', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_image_effect',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_html__('Image parallax', 'dfd-native'), 'value' => 'panr', ),
					array( 'name' => esc_html__('Grow', 'dfd-native'), 'value' => 'dfd-image-scale', ),
					array( 'name' => esc_html__('Grow with rotation', 'dfd-native'), 'value' => 'dfd-image-scale-rotate', ),
					array( 'name' => esc_html__('Shift left', 'dfd-native'), 'value' => 'dfd-image-shift-left', ),
					array( 'name' => esc_html__('Shift right', 'dfd-native'), 'value' => 'dfd-image-shift-right', ),
					array( 'name' => esc_html__('Shift top', 'dfd-native'), 'value' => 'dfd-image-shift-top', ),
					array( 'name' => esc_html__('Shift bottom', 'dfd-native'), 'value' => 'dfd-image-shift-bottom', ),
					array( 'name' => esc_html__('Blur', 'dfd-native'), 'value' => 'dfd-image-blur', ),
				),
				'dep_option'    => $prefix . 'hover_appear_effect',
				'dep_values'    => 'dfd-fade-out,dfd-fade-offset,dfd-left-to-right,dfd-right-to-left,dfd-top-to-bottom,dfd-bottom-to-top',
			),
			array(
				'name' => esc_html__('Hover mask settings','dfd-native'),
				'desc' => '',
				'id' => 'portfolio_hover_mask_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Hover frame decoration', 'dfd-native'),
				'id'	=> $prefix . 'hover_mask_border',
				'tooltip_text'	=> esc_html__('Allows to show or hide the custom frame decoration which will be visible on portfolio item hover. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Hover frame style', 'dfd-native'),
				'id'	=> $prefix . 'hover_mask_bordered_style',
				'tooltip_text'	=> esc_html__('Allows to choose the frame decoration position according to the featured image.', 'dfd-native'),
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/hover-frame.png',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Simple', 'dfd-native'), 'value' => 'simple-border', ),
                    array( 'name' => esc_html__('Offset', 'dfd-native'), 'value' => 'offset', ),
				),
				'dep_option'    => $prefix . 'hover_mask_border',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Hover mask frame size', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows to set the custom size of the hover mask frame. Please, pay attention, it should be set in px. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix . 'hover_mask_bordered_size',
				'type'	=> 'text',
				'dep_option'    => $prefix . 'hover_mask_border',
				'dep_values'    => 'on',
            ),
			array(
				'name' => esc_html__('Hover decoration settings','dfd-native'),
				'desc' => '',
				'id' => 'portfolio_hover_deco_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Main hover decoration', 'dfd-native'),
				'desc'	=> '',
				'tooltip_text'	=> esc_html__('Allows to set the decoration which will be displayed on hover. Heading allows to show the portfolio title/subtitle which is possible to link to the portfolio page itself, external link or open the image in lightbox (can be set in Decoration link). If Plus is chosen, this icon will be displayed as hover decoration. Plus is possible to link to the portfolio page itself, external link or open the image in lightbox (can be set in Decoration link). If Dots are chosen, three dots will be displayed as hover decoration. Dots are possible to link to the portfolio page itself, external link or open the image in lightbox (can be set in Decoration link). Buttons allow to show inside link, external link and lightbox buttons on hover. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix . 'hover_main_decoration',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/hover-decoration.png',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_html__('None', 'dfd-native'), 'value' => 'none', ),
                    array( 'name' => esc_html__('Heading', 'dfd-native'), 'value' => 'heading', ),
					array( 'name' => esc_html__('Plus', 'dfd-native'), 'value' => 'plus', ),
					array( 'name' => esc_html__('Dots', 'dfd-native'), 'value' => 'dots', ),
					array( 'name' => esc_html__('Buttons', 'dfd-native'), 'value' => 'buttons', ),
				),
			),
			array(
				'name'	=> esc_html__('Decoration link', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_main_decoration_link',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_html__('Inside', 'dfd-native'), 'value' => 'inside', ),
                    array( 'name' => esc_html__('External link', 'dfd-native'), 'value' => 'external', ),
                    array( 'name' => esc_html__('Lightbox', 'dfd-native'), 'value' => 'lightbox', ),
				),
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => ',none,heading,plus,dots',
			),
			array(
				'name'	=> esc_html__('Title', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_show_title',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => 'heading',
			),
			array(
				'name'	=> esc_html__('Subtitle', 'dfd-native'),
				'desc'	=> esc_html__('This field requirest Page subtitle options to be specified for portfolio items to show subtitle correctly','dfd-native'),
				'id'	=> $prefix . 'hover_show_subtitle',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => 'heading',
			),
			array(
				'name'	=> esc_html__('Plus style', 'dfd-native'),
				'desc'	=> '',
				'id'	=> $prefix . 'hover_plus_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Big plus in the middle of the thumb', 'dfd-native'), 'value' => 'dfd-middle', ),
					array( 'name' => esc_html__('Small plus in the middle of the thumb', 'dfd-native'), 'value' => 'dfd-middle dfd-plus-bordered', ),
                    array( 'name' => esc_html__('Following the mouse', 'dfd-native'), 'value' => 'dfd-cursor-plus', ),
				),
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => 'plus',
			),
			array(
				'id'	=> $prefix . 'hover_buttons_inside',
                'name' => esc_html__('Link inside the portfolio item', 'dfd-native'),
                'std' => 'on',
				'type' => 'checkbox',
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => 'buttons',
            ),
			array(
				'id'	=> $prefix . 'hover_buttons_external',
                'name' => esc_html__('Portfolio item external link', 'dfd-native'),
                'std' => 'on',
				'type' => 'checkbox',
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => 'buttons',
            ),
			array(
				'id'	=> $prefix . 'hover_buttons_lightbox',
                'name' => esc_html__('Lightbox', 'dfd-native'),
                'std' => 'on',
				'type' => 'checkbox',
				'dep_option'    => $prefix . 'hover_main_decoration',
				'dep_values'    => 'buttons',
            ),
		),
	);

	return $meta_boxes;
}


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function cr_portfolio_add_custom_box() {

    $screens = array( 'portfolio' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'crumina_portfolio_gallery',
            esc_html__( 'Images gallery', 'dfd-native' ),
            'cr_portfolio_inner_custom_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'cr_portfolio_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function cr_portfolio_inner_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'cr_portfolio_inner_custom_box', 'cr_portfolio_inner_custom_box_nonce' );


    ?>

    <div id="my_product_images_container">
        <ul class="my_product_images">
            <?php
            if ( metadata_exists( 'post', $post->ID, '_my_product_image_gallery' ) ) {
                $my_product_image_gallery = get_post_meta( $post->ID, '_my_product_image_gallery', true );
            } else {
                // Backwards compat
                $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
                $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                $my_product_image_gallery = implode( ',', $attachment_ids );
            }

            $attachments = array_filter( explode( ',', $my_product_image_gallery ) );

            if ( $attachments )
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'dfd-native' ) . '">' . esc_html__( 'Delete', 'dfd-native' ) . '</a></li>
								</ul>
							</li>';
                }
            ?>
        </ul>

        <input type="hidden" id="my_product_image_gallery" name="my_product_image_gallery" value="<?php echo esc_attr( $my_product_image_gallery ); ?>" />

    </div>
    <p class="add_my_product_images hide-if-no-js">
        <a class="button" href="#" title=""
			data-title="<?php esc_attr_e( 'Add Images to Portfolio Gallery', 'dfd-native' ); ?>"
			data-button-text="<?php esc_attr_e( 'Add to gallery', 'dfd-native' ); ?>"
			data-delete-text="<?php esc_html_e( 'Delete', 'dfd-native' ); ?>"><?php esc_html_e( 'Add gallery images', 'dfd-native' ); ?></a>
    </p>
	<?php
	wp_enqueue_script('dfd_portfolio_metaboxes_gallery');			
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function cr_portfolio_save_postdata( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['cr_portfolio_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['cr_portfolio_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'cr_portfolio_inner_custom_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = $_POST['my_product_image_gallery'];

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_product_image_gallery', $mydata );
}
add_action( 'save_post', 'cr_portfolio_save_postdata' );


