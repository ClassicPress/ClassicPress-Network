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

add_filter( 'cmb_meta_boxes', 'cmb_post_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_post_metaboxes( array $meta_boxes ) {

	$prefix = 'blog_';
	
	$appear_effects = Dfd_Theme_Helpers::dfd_module_animation_styles('metaboxes');
	
	$appear_effects[0]['name'] = esc_html__('Theme default', 'dfd-native');
	
	$meta_boxes[] = array(
		'id'         => 'dfd-single_post_settings',
		'title'      => esc_html__('Single post settings', 'dfd-native'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Advanced settings','dfd-native'),
				'desc' => '',
				'id' => 'single_post_advanced_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Post style on Blog posts page template', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to select the style for single posts on blog page. If you choose theme default the displaying will correspond to the theme options settings. If "Standard" is selected, the post thumbnail image is displayed with descriptions below. When "Featured" is selected, the featured images of the posts are set as a background of the single posts with description inside. If "Side Image" is selected, the featued images are set aside from the description section.','dfd-native'),
				'id'	=> 'post_single_loop_apear',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/post-style.png',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '' ),
					array( 'name' => esc_html__('Standard', 'dfd-native'), 'value' => 'dfd-standard' ),
					array( 'name' => esc_html__('Featured', 'dfd-native'), 'value' => 'dfd-featured' ),
                    array( 'name' => esc_html__('Side image', 'dfd-native'), 'value' => 'dfd-side-image' ),
				),
				'std' => 'dfd-standard'
			),
			array(
				'name'	=> esc_html__('Side Image configuration', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to select whether the featured image is displayed from the right or left sides.','dfd-native'),
				'id'	=> 'post_single_content_position',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/side_image.png',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '' ),
					array( 'name' => esc_html__('Left image', 'dfd-native'), 'value' => 'dfd-left-image' ),
					array( 'name' => esc_html__('Right image', 'dfd-native'), 'value' => 'dfd-right-image' ),
				),
				'std' => 'dfd-left-image',
				'dep_option'    => 'post_single_loop_apear',
				'dep_values'    => 'dfd-side-image',
			),
			array(
				'id'	=> 'blog_single_reset_counter',
                'name' => esc_html__('Reset views counter', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to reset the conter of the reviews for the blog post.','dfd-native'),
				'type' => 'checkbox',
            ),
			array(
				'name' => esc_html__('Layout settings','dfd-native'),
				'desc' => '',
				'id' => 'single_post_layout_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Pagination to previous and next posts style', 'dfd-native'),
				'tooltip_text'	=> esc_html('Allows you to select the inner pagination style for blog post. If you choose theme default the displaying will correspond to the theme options settings. If \'Fixed\' is selected, the next/prev pagination arrows will be displayed on scroll. When \'Top\' is selected the next/prev pagination arrows are displayed on top of the blog post.', 'dfd-native'),
				'id'	=> 'post_single_pagination_style',
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
				'id' => 'single_post_content_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Category', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the category of blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_top_tags',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Title', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the title of blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_title',
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
				'tooltip_text'	=> esc_html__('Allows you to show or hide publication date, category, comments counter, likes on blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_meta',
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
				'id'	=> 'post_single_show_meta_date',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Category in meta', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_single_show_meta_category',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Comments count', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_single_show_meta_comments',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Likes', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_single_show_meta_likes',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_single_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Featured image', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_single_show_featured_image',
				'tooltip_text'	=> esc_html__('Allows you to show or hide the featured image for standard posts. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Post tags in meta under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide tags in meta on blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_bottom_tags',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Likes in meta under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide likes in meta on blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_bottom_likes',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Author info under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide author info on blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_author',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Related posts', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the related posts on blog post. The posts relate to each other by the first tag. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_related_posts',
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
				'id' => 'single_post_share_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Share, meta and author info in custom header', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to enable or disable author info, meta and share in custom header', 'dfd-native'),
				'id'	=> 'post_single_stun_header_meta',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Share in meta under content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the share in meta on blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_bottom_share',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Side share', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the side share on blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_single_show_fixed_share',
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
		'id'         => 'dfd-post_video_custom_fields',
		'title'      => esc_html__('Video Post settings', 'dfd-native'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Video post settings','dfd-native'),
				'desc' => '',
				'id' => 'video_post_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Video source', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_single_video_src',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/video.png',
				'options' => array(
					array( 'name' => esc_html__('Youtube', 'dfd-native'), 'value' => 'youtube' ),
					array( 'name' => esc_html__('Vimeo', 'dfd-native'), 'value' => 'vimeo' ),
					array( 'name' => esc_html__('MP4', 'dfd-native'), 'value' => 'mp4' ),
                    array( 'name' => esc_html__('WebM', 'dfd-native'), 'value' => 'webm' ),
				),
				'std' => 'youtube'
			),
            array(
                'name' => esc_html__('YouTube video ID', 'dfd-native'),
                'desc'	=> '',
                'tooltip_text'	=> esc_html__('Look at the URL of the video, and at the end of it, you should see a combination of numbers and letters after an equal sign (=).', 'dfd-native'),
                'id'	=> 'post_youtube_video_url',
                'type'	=> 'text',
				'dep_option'    => 'post_single_video_src',
				'dep_values'    => 'youtube',
            ),
            array(
                'name' =>  esc_html__('Vimeo video ID', 'dfd-native'),
                'tooltip_text'	=> esc_html__('Copy the numeric code that appears at the end of the video URL.', 'dfd-native'),
                'id'	=> 'post_vimeo_video_url',
                'type'	=> 'text',
				'dep_option'    => 'post_single_video_src',
				'dep_values'    => 'vimeo',
            ),
            array(
                'name' =>  esc_html__('Self hosted video file in mp4 format', 'dfd-native'),
                'desc'	=> '',
                'id'	=> 'post_self_hosted_mp4',
                'type'	=> 'file',
				'dep_option'    => 'post_single_video_src',
				'dep_values'    => 'mp4',
            ),
            array(
                'name' =>  esc_html__('Self hosted video file in webM format', 'dfd-native'),
                'desc'	=> '',
                'id'	=> 'post_self_hosted_webm',
                'type'	=> 'file',
				'dep_option'    => 'post_single_video_src',
				'dep_values'    => 'webm',
            ),
		),
	);

        
	$meta_boxes[] = array(
		'id'         => 'dfd-post_audio_custom_fields',
		'title'      => esc_html__('Audio Post settings', 'dfd-native'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Audio post settings','dfd-native'),
				'desc' => '',
				'id' => 'audio_post_heading',
				'type' => 'title',
			),
			array(
				'name' =>  esc_html__('Audio composition name', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_audio_song',
				'type'	=> 'text'
			),
			array(
				'name' =>  esc_html__('Audio composition author', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_audio_author',
				'type'	=> 'text'
			),
			array(
				'name' =>  esc_html__('External audio link url', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_custom_post_audio_url',
				'type'	=> 'text'
			),
			array(
				'name' =>  esc_html__('Self hosted audio file in mp3 format', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_self_hosted_audio',
				'type'	=> 'file'
			),
			array(
				'name' =>  esc_html__('Shared audio code', 'dfd-native'),
                'tooltip_text'	=> esc_html__('Click Share and select an icon, or copy and paste the player link.', 'dfd-native'),
				'id'	=> 'post_soundcloud_audio',
				'type'	=> 'textarea_code'
			),
			array(
				'name'	=> esc_html__('Featured image of the post on the blog page', 'dfd-native'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the image.', 'dfd-native'),
				'id'	=> 'post_audio_show_thumb',
				'type'	=> 'radio_inline',
				'options' => array(
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
				),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'dfd-post_quote_custom_fields',
		'title'      => esc_html__('Quote Post settings', 'dfd-native'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Quote post settings','dfd-native'),
				'desc' => '',
				'id' => 'quote_post_heading',
				'type' => 'title',
			),
			array(
				'name' =>  esc_html__('Quote text', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_quote_text',
				'type'	=> 'textarea'
			),
			array(
				'name' =>  esc_html__('Quote author name', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_custom_author_name',
				'type'	=> 'text'
			),
			array(
                'name' => esc_html__('Quote background','dfd-native'),
                'tooltip_text' => esc_html__('The quote text will become white for this option. Please disable Featured post option if you want the default quote post to be displayed','dfd-native'),
                'id'   => 'quote_post_bg',
                'type' => 'colorpicker',
                'save_id' => false,
                'std'  => '',
				'dep_option'    => 'post_single_loop_apear',
				'dep_values'    => 'dfd-featured',
            ),
			array(
                'name' => esc_html__('Quote hover background','dfd-native'),
                'tooltip_text' => esc_html__('The quote text will become white for this option. Please disable Featured post option if you want the default quote post to be displayed','dfd-native'),
                'id'   => 'quote_post_hover_bg',
                'type' => 'colorpicker',
                'save_id' => false,
                'std'  => '',
				'dep_option'    => 'post_single_loop_apear',
				'dep_values'    => 'dfd-featured',
            ),
			array(
				'name'	=> esc_html__('Featured image of the post on the blog page', 'dfd-native'),
                'tooltip_text'	=> esc_html__('Allows you to show or hide the image.', 'dfd-native'),
				'id'	=> 'post_quote_show_thumb',
				'type'	=> 'radio_inline',
				'options' => array(
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
				),
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'dfd-post_link_custom_fields',
		'title'      => esc_html__('Link Post settings', 'dfd-native'),
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Link post settings','dfd-native'),
				'desc' => '',
				'id' => 'link_post_heading',
				'type' => 'title',
			),
			array(
				'name' =>  esc_html__('Link text', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_link_text',
				'type'	=> 'textarea'
			),
			array(
				'name' =>  esc_html__('URL', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_format_link_url',
				'type'	=> 'text'
			),
		),
	);
	$meta_boxes[] = array(
		'id'         => 'dfd-blog_settings_box',
		'title'      => esc_html__('Blog page options', 'dfd-native'),
		'pages'      => array('page'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array(
			'key' => 'page-template',
			'value' => 'tmp-blog.php',
		),
		'fields'     => array(
			array(
				'name' => esc_html__('Layout settings','dfd-native'),
				'desc' => '',
				'id' => 'post_layout_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Categories and tags dropdown', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show categories, tags and author drop-down sorter before post items. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_cat_tag',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name' => esc_html__('Blog layout style','dfd-native'),
				'tooltip_text'	=> esc_html__('Here you can choose layout style for the whole blog page.', 'dfd-native'),
				'id' => 'post_style',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/layout-style.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Side image','dfd-native'), 'value' => 'side-image', ),
					array( 'name' => esc_attr__('Masonry','dfd-native'), 'value' => 'masonry', ),
					array( 'name' => esc_attr__('Grid','dfd-native'), 'value' => 'fitRows', ),
					array( 'name' => esc_attr__('Metro','dfd-native'), 'value' => 'metro', ),
					array( 'name' => esc_attr__('Full content','dfd-native'), 'value' => 'full-content', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Blog side image layout style','dfd-native'),
				'desc' => '',
				'id' => 'post_style_side',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/side.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Left image','dfd-native'), 'value' => 'left-image', ),
					array( 'name' => esc_attr__('Right image','dfd-native'), 'value' => 'right-image', ),
					array( 'name' => esc_attr__('Mixed','dfd-native'), 'value' => 'mixed-image', ),
				),
				'dep_option'    => 'post_style',
				'dep_values'    => 'side-image',
				'std'  => 'mixed-image',
			),
			array(
				'name' => esc_html__('Blog content style','dfd-native'),
				'tooltip_text'	=> esc_html__('Here you can choose layout style for the single blog post. Simple style allows you to have transparent background without hover effect. Tiled style allows you to have white background with shadow hover effect.', 'dfd-native'),
				'id' => 'post_content_style',
				'image'	=> get_template_directory_uri().'/assets/admin/img/tiled.png',
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
				'desc' => '',
				'id' => 'post_columns',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_attr__('Theme default','dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('One column','dfd-native'), 'value' => '1', ),
					array( 'name' => esc_attr__('Two columns','dfd-native'), 'value' => '2', ),
					array( 'name' => esc_attr__('Three columns','dfd-native'), 'value' => '3', ),
					array( 'name' => esc_attr__('Four columns','dfd-native'), 'value' => '4', ),
					array( 'name' => esc_attr__('Five columns','dfd-native'), 'value' => '5', ),
				),
				'dep_option'    => 'post_style',
				'dep_values'    => 'masonry,fitRows,metro',
				'std'  => '3',
			),
			array(
				'name'	=> esc_html__('Sort panel', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to enable or disable post categories sorter above blog post items.', 'dfd-native'),
				'id'	=> 'post_sort_panel',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Disable', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_style',
				'dep_values'    => 'masonry,fitRows,justified,metro',
			),
			array(
				'name'	=> esc_html__('Sort panel alignment', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'post_sort_panel_align',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Left', 'dfd-native'), 'value' => 'text-left', ),
                    array( 'name' => esc_attr__('Right', 'dfd-native'), 'value' => 'text-right', ),
                    array( 'name' => esc_attr__('Center', 'dfd-native'), 'value' => 'text-center', ),
				),
				'dep_option'    => 'post_sort_panel',
				'dep_values'    => 'on',
			),
			array(
				'name' => esc_html__('Content settings','dfd-native'),
				'desc' => '',
				'id' => 'post_content_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Media content', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide featured image of the single blog post.', 'dfd-native'),
				'id'	=> 'post_show_image',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_style',
				'dep_values'    => 'masonry,fitRows,justified,metro',
			),
			array(
				'name'	=> esc_html__('Category', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the category of the blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_top_cat',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Title', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the title of the blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_title',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Meta', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide publication date, category, comments counter, likes of the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_meta',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Date', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the date of the single blog post creation. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_meta_date',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Category in meta', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the category in meta of the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_meta_category',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Comments count', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the comments count of the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_meta_comments',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Likes', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the likes count of the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_meta_likes',
				'type'	=> 'radio_inline',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Show', 'dfd-native'), 'value' => 'on', ),
                    array( 'name' => esc_html__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
				'dep_option'    => 'post_show_meta',
				'dep_values'    => 'on',
			),
			array(
				'name'	=> esc_html__('Description', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide excerpt of the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_content',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Show', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_attr__('Hide', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Content alignment', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Choose the description, title, meta position of the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_content_alignment',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_attr__('Center', 'dfd-native'), 'value' => 'text-center', ),
                    array( 'name' => esc_attr__('Left', 'dfd-native'), 'value' => 'text-left', ),
					array( 'name' => esc_attr__('Right', 'dfd-native'), 'value' => 'text-right', ),
				),
			),
			array(
				'name'	=> esc_html__('Author box under post', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide Author information under the single blog post. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_show_author_box',
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
				'id' => 'post_advanced_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__('Works per page', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to enter the number of items to be displayed on blog page.', 'dfd-native'),
				'id' => 'post_posts_per_page',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name'	=> esc_html__('VC Content position', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Display the Visual Composer content above or below the post items. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_vc_content_position',
				'type'	=> 'select',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Above content', 'dfd-native'), 'value' => 'top', ),
					array( 'name' => esc_attr__('Below content', 'dfd-native'), 'value' => 'bottom', ),
				),
			),
			array(
				'name' => esc_html__('Items offset in px', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to add space between single posts.', 'dfd-native'),
				'id' => 'post_items_offset',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => '20'
			),
			array(
                'name' => esc_html__('Blog Category','dfd-native'),
                'desc'	=> '',
                'id'	=> 'post_custom_categories',
                'taxonomy' => 'category',
                'type' => 'taxonomy_multicheck',
            ),
			array(
				'name'	=> esc_html__('Items appear effect', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to set the unique appear effect for the blog post items.If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'post_appear_effect',
				'type'	=> 'select',
				'options' => $appear_effects,
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function dfd_post_add_custom_box() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'dfd_post_gallery',
            esc_html__( 'Images gallery', 'dfd-native' ),
            'dfd_post_inner_custom_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'dfd_post_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function dfd_post_inner_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'dfd_post_inner_custom_box', 'dfd_post_inner_custom_box_nonce' );


    ?>

    <div id="my_post_images_container">
        <ul class="my_post_images">
            <?php
            if ( metadata_exists( 'post', $post->ID, '_my_post_image_gallery' ) ) {
                $my_post_image_gallery = get_post_meta( $post->ID, '_my_post_image_gallery', true );
            } else {
                // Backwards compat
                $attachment_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
                $attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id() ) );
                $my_post_image_gallery = implode( ',', $attachment_ids );
            }

            $attachments = array_filter( explode( ',', $my_post_image_gallery ) );

            if ( $attachments ) {
                foreach ( $attachments as $attachment_id ) {
                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__( 'Delete image', 'dfd-native' ) . '">' . esc_html__( 'Delete', 'dfd-native' ) . '</a></li>
								</ul>
							</li>';
                }
			} ?>
        </ul>

        <input type="hidden" id="my_post_image_gallery" name="my_post_image_gallery" value="<?php echo esc_attr( $my_post_image_gallery ); ?>" />

    </div>
    <p class="add_my_post_images hide-if-no-js">
        <a class="button" href="#" title=""
			data-title="<?php esc_attr_e( 'Add Images to post Gallery', 'dfd-native' ); ?>"
			data-button-text="<?php esc_attr_e( 'Add to gallery', 'dfd-native' ); ?>"
			data-delete-text="<?php esc_html_e( 'Delete', 'dfd-native' ); ?>"><?php esc_html_e( 'Add gallery images', 'dfd-native' ); ?></a>
    </p>
	<?php
	wp_enqueue_script('dfd_post_metaboxes_gallery'); 
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function dfd_post_save_postdata( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['dfd_post_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['dfd_post_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'dfd_post_inner_custom_box' ) )
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
    $mydata = $_POST['my_post_image_gallery'];

    // Update the meta field in the database.
    update_post_meta( $post_id, '_my_post_image_gallery', $mydata );
}
add_action( 'save_post', 'dfd_post_save_postdata' );