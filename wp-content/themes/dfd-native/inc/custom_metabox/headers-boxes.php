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

add_filter( 'cmb_meta_boxes', 'stunnig_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function stunnig_headers_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'stunnig_headers_';
	
	$meta_boxes[] = array(
		'id'         => 'dfd-header_img_metabox',
		'title'      => esc_html__('Custom Header Options', 'dfd-native'),
		'pages'      => array('page','post','portfolio','product','gallery'),
		'context'    => 'normal',
		'hide_on'	 => array(
			'key' => 'page-template',
			'value' => array(
				'tmp-one-page-scroll.php',
				'tmp-side-by-side.php'
			),
		),
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Custom header settings','dfd-native'),
				'desc' => '',
				'id' => 'stun_header_element_heading',
				'type' => 'title',
			),
			array(
				'name'	=> esc_html__('Custom header', 'dfd-native'),
				'tooltip_text' => esc_html__('If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'dfd_stun_header',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_attr__('Enable', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_attr__('Disable', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name' => esc_html__('Background settings','dfd-native'),
				'desc' => '',
				'id' => 'stun_header_bg_element_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__('Background element style','dfd-native'),
				'tooltip_text' => esc_html__('If you choose \'Image\' background element style the single image will be shown in custom header. If \'Gallery\' background element style is selected, several images will be displayed as a slideshow.', 'dfd-native'),
				'id' => $prefix . 'bg_element',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/background-element.png',
				'options' => array(
					array('name' => esc_html__('Image','dfd-native'), 'value' => 'image'),
					array('name' => esc_html__('Gallery','dfd-native'), 'value' => 'gallery'),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Background image','dfd-native'),
				'tooltip_text' => esc_html__('Select image pattern for custom header background', 'dfd-native'),
				'id'   => $prefix . 'bg_img',
				'type' => 'file',
				'save_id' => false, // save ID using true
				'std'  => '',
				'dep_option'    => 'stunnig_headers_bg_element',
				'dep_values'    => 'image',
			),
			array(
				'id'          => 'stunning_header_bg_image_gallery',
				'type'        => 'group',
				'name'		  => esc_html__( 'Please upload images you want to be shown', 'dfd-native' ),
				'options'     => array(
					'group_title'   => false, //__( 'Images', 'dfd-native' ), // {#} gets replaced by row number
					'add_button'    => esc_html__( 'Add one more', 'dfd-native' ),
					'remove_button' => '',
					'sortable'      => true,
				),
				'fields'      => array(
					array(
						'name' => esc_html__('Image','dfd-native'),
						'id'   => 'image',
						'type' => 'file',
					),
				),
				'dep_option'    => 'stunnig_headers_bg_element',
				'dep_values'    => 'gallery',
			),
			array(
				'name' => esc_html__('Background image position','dfd-native'),
				'tooltip_text' => esc_html__('The background position sets the starting position of a background image.', 'dfd-native'),
				'id' => $prefix . 'bg_img_position',
				'type' => 'select',
				'options' => Dfd_Theme_Helpers::dfd_get_bgposition_redux(),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Background size','dfd-native'),
				'tooltip_text' => esc_html__('Adjust the background image displaying.', 'dfd-native'),
				'id' => 'stun_header_bg_size',
				'type' => 'radio_inline_triple',
				'options' => Dfd_Theme_Helpers::dfd_get_bgsize('metaboxes'),
				'std'  => '',
			),
			array(
				'name'	=> esc_html__('Background attachment style', 'dfd-native'),
				'tooltip_text'	=> esc_html__('When scroll background style is enabled, the background image scrolls with the content. When fixed background style is enabled, the background image is fixed and content scrolls over it. When initial background style is enabled, the background image and content will be fixed.', 'dfd-native'),
				'id'	=> $prefix . 'fixed',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Initial', 'dfd-native'), 'value' => 'initial', ),
					array( 'name' => esc_html__('Scroll', 'dfd-native'), 'value' => 'scroll', ),
					array( 'name' => esc_html__('Fixed', 'dfd-native'), 'value' => 'fixed', ),
				),
			),
			array(
				'name'	=> esc_html__('Background repeat', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to repeat or do not repeat the image set on the background.', 'dfd-native'),
				'id'	=> $prefix . 'repeat',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('No repeat', 'dfd-native'), 'value' => 'no-repeat', ),
					array( 'name' => esc_html__('Repeat-X', 'dfd-native'), 'value' => 'repeat-x', ),
					array( 'name' => esc_html__('Repeat-Y', 'dfd-native'), 'value' => 'repeat-y', ),
					array( 'name' => esc_html__('Repeat', 'dfd-native'), 'value' => 'repeat', ),
				),
			),
			array(
				'name' => esc_html__('Background color','dfd-native'),
				'tooltip_text' => esc_html__('The background color will be shown if the image is not set for the custom header.', 'dfd-native'),
				'id'   => $prefix . 'bg_color',
				'type' => 'colorpicker',
				'save_id' => false, // save ID using true
				'std'  => '',
			),
			array(
				'name'	=> esc_html__('Background color scheme style', 'dfd-native'),
				'tooltip_text'	=> esc_html__('According to the color scheme you choose the text colors will be changed to make it more readable. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> $prefix . 'bgcheck',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Light', 'dfd-native'), 'value' => 'dfd-background-initial', ),
					array( 'name' => esc_html__('Dark', 'dfd-native'), 'value' => 'dfd-background-dark', ),
				),
			),
			array(
				'name' => esc_html__('Custom header video settings','dfd-native'),
				'desc' => '',
				'id' => 'stun_header_bg_video_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__('Custom header video','dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to set video background for the custom header.', 'dfd-native'),
				'desc' => '',
				'id' => 'dfd_stun_video_enable',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Disable', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Enable', 'dfd-native'), 'value' => 'enable', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Custom header video source','dfd-native'),
				'desc' => '',
				'id' => 'dfd_stun_video_style',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_html__('None', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Self-hosted video', 'dfd-native'), 'value' => 'self-hosted', ),
					array( 'name' => esc_html__('oEmbed Youtube video', 'dfd-native'), 'value' => 'youtube', ),
					array( 'name' => esc_html__('oEmbed Vimeo video', 'dfd-native'), 'value' => 'vimeo', ),
				),
				'std'  => '',
				'dep_option'    => 'dfd_stun_video_enable',
				'dep_values'    => 'enable',
			),
			array(
				'name' => esc_html__('Custom header background video style','dfd-native'),
				'desc' => '',
				'id' => 'dfd_stun_video_type',
				'type' => 'select',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Background', 'dfd-native'), 'value' => 'background-video', ),
					array( 'name' => esc_html__('Full screen video', 'dfd-native'), 'value' => 'full-screen-video', ),
				),
				'std'  => 'background-video',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'youtube,vimeo',
			),
			array(
				'name'	=> esc_html__('Youtube video URL', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Look at the URL of that page, and at the end of it, you should see a combination of numbers and letters after an equal sign (=).', 'dfd-native'),
				'id'	=> 'dfd_stun_bg_youtube_id',
				'type'	=> 'text',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'youtube',
			),
			array(
				'name'	=> esc_html__('Vimeo video URL', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Copy the numeric code that appears at the end of its URL at the top of your browser window', 'dfd-native'),
				'id'	=> 'dfd_stun_bg_vimeo_id',
				'type'	=> 'text',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'vimeo',
			),
			array(
				'name'  =>  esc_html__('Self hosted video file in mp4 format', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'dfd_stun_header_self_hosted_mp4',
				'type'	=> 'file',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'self-hosted',
			),
			array(
				'name' =>  esc_html__('Self hosted video file in webM format', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'dfd_stun_header_self_hosted_webm',
				'type'	=> 'file',
				'dep_option'    => 'dfd_stun_video_style',
				'dep_values'    => 'self-hosted',
			),
			array(
				'name'	=> esc_html__('Loop video', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'dfd_stun_header_video_loop',
				'type'	=> 'checkbox',
				'std' => 'on',
				'dep_option'    => 'dfd_stun_video_enable',
				'dep_values'    => 'enable',
			),
			array(
				'name'	=> esc_html__('Mute video', 'dfd-native'),
				'desc'	=> '',
				'id'	=> 'dfd_stun_header_video_mute',
				'type'	=> 'checkbox',
				'std' => 'on',
				'dep_option'    => 'dfd_stun_video_enable',
				'dep_values'    => 'enable',
			),
			array(
				'name' => esc_html__('Content settings','dfd-native'),
				'id' => 'stun_header_effects_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__('Custom header parallax effect','dfd-native'),
				'tooltip_text'	=> esc_html__('If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => 'enable_stun_parallax',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'dfd-enable-parallax', ),
					array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Title','dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the page title in custom header. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => 'enable_stun_header_title',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Subtitle','dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the page subtitle in custom header. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => 'enable_stun_header_subtitle',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
				'std'  => '',
			),
			array(
				'name'	=> esc_html__('Page subtitle', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Enter page subtitle text to be displayed in custom header.', 'dfd-native'),
				'id'	=> $prefix . 'subtitle',
				'type'	=> 'text',
			),
			array(
				'name' => esc_html__('Breadcrumbs','dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to show or hide the navigation links in custom header. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => 'stun_header_breadcrumbs',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Full window height', 'dfd-native'),
				'tooltip_text' => esc_html__('Sets full window height for custom header', 'dfd-native'),
				'id'   => 'stunning_header_full_height',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('On', 'dfd-native'), 'value' => 'on', ),
					array( 'name' => esc_html__('Off', 'dfd-native'), 'value' => 'off', ),
				),
			),
			array(
				'name'	=> esc_html__('Custom header height in px', 'dfd-native'),
				'tooltip_text'	=> esc_html__('Allows you to set the custom header height', 'dfd-native'),
				'id'	=> $prefix . 'custom_height',
				'type'	=> 'text',
				'dep_option'    => 'stunning_header_full_height',
				'dep_values'    => ',off',
			),
			array(
				'name' => esc_html__('Text alignment','dfd-native'),
				'tooltip_text'	=> esc_html__('Choose the text position in custom header. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id' => $prefix . 'text_alignment',
				'type' => 'radio_inline_triple',
				'options' => array(
					array( 'name' => esc_html__('Theme default', 'dfd-native'), 'value' => '', ),
					array( 'name' => esc_html__('Center', 'dfd-native'), 'value' => 'text-center', ),
					array( 'name' => esc_html__('Left', 'dfd-native'), 'value' => 'text-left', ),
					array( 'name' => esc_html__('Right', 'dfd-native'), 'value' => 'text-right', ),
				),
				'std'  => '',
			),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
