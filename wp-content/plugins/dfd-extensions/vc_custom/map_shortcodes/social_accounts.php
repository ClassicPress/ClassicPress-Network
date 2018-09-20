<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Social Accounts for Visual Composer
*/
class WPBakeryShortCode_Dfd_Social_Accounts extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/social_accounts/';
vc_map(
	array(
	   'name'			=> esc_html__('Social accounts','dfd-native'),
	   'base'			=> 'dfd_social_accounts',
	   'class'			=> 'dfd_soc_icons dfd_shortcode',
	   'icon'			=> 'dfd_soc_icons dfd_shortcode',
	   'category'		=> esc_html__('Native','dfd-native'),
	   'description'	=> esc_html__('Displays social accounts', 'dfd-native'),
	   'params'			=> array(
			array(
				'heading'			=> esc_html__( 'Style', 'dfd-native' ),
				'type'				=> 'radio_image_select',
				'param_name'		=> 'main_style',
				'simple_mode'		=> false,
				'value'				=> 'style-1',
				'options'			=> array(
					'style-1'	=> array(
						'tooltip'	=> esc_html__('Sliding icon', 'dfd-native'),
						'src'		=> $module_images.'style-1.png'
					),
					'style-2'	=> array(
						'tooltip'	=> esc_html__('Sliding background', 'dfd-native'),
						'src'		=> $module_images.'style-2.png'
					),
					'style-3'	=> array(
						'tooltip'	=> esc_html__('Fade', 'dfd-native'),
						'src'		=> $module_images.'style-3.png'
					),
					'style-4'	=> array(
						'tooltip'	=> esc_html__('Appear out', 'dfd-native'),
						'src'		=> $module_images.'style-4.png'
					),
					'style-5'	=> array(
						'tooltip'	=> esc_html__('General shadow', 'dfd-native'),
						'src'		=> $module_images.'style-5.png'
					),
					'style-6'	=> array(
						'tooltip'	=> esc_html__('Round to square', 'dfd-native'),
						'src'		=> $module_images.'style-6.png'
					),
					'style-7'	=> array(
						'tooltip'	=> esc_html__('Animated cube', 'dfd-native'),
						'src'		=> $module_images.'style-7.png'
					),
					'style-8'	=> array(
						'tooltip'	=> esc_html__('Long shadow', 'dfd-native'),
						'src'		=> $module_images.'style-8.png'
					),
				),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the horizontal alignment for the social icons','dfd-native').'</span></span>'.esc_html__('Icon alignment', 'dfd-native'),
				'param_name'		=> 'info_alignment',
				'value'				=> 'text-center',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'text-left',
					esc_html__('Center', 'dfd-native') => 'text-center',
					esc_html__('Right', 'dfd-native')	=> 'text-right'
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-top-margin crum_vc',
			),
		   array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
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
				'doc_link' => '//nativewptheme.net/support/visual-composer/social-accounts-module',
				'video_link' => 'https://www.youtube.com/watch?v=61zQeWvIldo&feature=youtu.be',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('Social networks', 'dfd-native'),
				'param_name'		=> 'dfd_social_networks',
				'value'				=> '%5B%7B%22dfd_social_networks_sel%22%3A%22dfd-socicon-deviantart%22%2C%22soc_url%22%3A%22url%3A%2523%7C%7C%7C%22%7D%2C%7B%22dfd_social_networks_sel%22%3A%22dfd-socicon-digg%22%2C%22soc_url%22%3A%22url%3A%2523%7C%7C%7C%22%7D%2C%7B%22dfd_social_networks_sel%22%3A%22dfd-socicon-dribbble%22%2C%22soc_url%22%3A%22url%3A%2523%7C%7C%7C%22%7D%5D',
				'params'			=> array(
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Social network', 'dfd-native'),
						'param_name'	=> 'dfd_social_networks_sel',
						'value'			=> array(
							esc_html__('Deviantart', 'dfd-native')			=> 'dfd-socicon-deviantart',
							esc_html__('Digg', 'dfd-native')				=> 'dfd-socicon-digg',
							esc_html__('Dribbble', 'dfd-native')			=> 'dfd-socicon-dribbble',
							esc_html__('Dropbox', 'dfd-native')				=> 'dfd-socicon-dropbox',
							esc_html__('Evernote', 'dfd-native')			=> 'dfd-socicon-evernote',
							esc_html__('Facebook', 'dfd-native')			=> 'dfd-socicon-facebook',
							esc_html__('Flickr', 'dfd-native')				=> 'dfd-socicon-flickr',
							esc_html__('Google +', 'dfd-native')			=> 'dfd-socicon-google-plus',
							esc_html__('Instagram', 'dfd-native')			=> 'dfd-socicon-instagram',
							esc_html__('LastFM', 'dfd-native')				=> 'dfd-socicon-lastfm',
							esc_html__('LinkedIN', 'dfd-native')			=> 'dfd-socicon-linkedin',
							esc_html__('Picasa', 'dfd-native')				=> 'dfd-socicon-picasa',
							esc_html__('Pinterest', 'dfd-native')			=> 'dfd-socicon-pinterest',
							esc_html__('RSS', 'dfd-native')					=> 'dfd-socicon-rss',
							esc_html__('Tumblr', 'dfd-native')				=> 'dfd-socicon-tumblr',
							esc_html__('Twitter', 'dfd-native')				=> 'dfd-socicon-twitter',
							esc_html__('Vimeo', 'dfd-native')				=> 'dfd-socicon-vimeo',
							esc_html__('WordPress', 'dfd-native')			=> 'dfd-socicon-wordpress',
							esc_html__('YouTube', 'dfd-native')				=> 'dfd-socicon-youtube',
							esc_html__('500px', 'dfd-native')				=> 'dfd-socicon-px-icon',
							esc_html__('ViewBug', 'dfd-native')				=> 'dfd-socicon-vb',
							esc_html__('Xing', 'dfd-native')				=> 'dfd-socicon-b_Xing-icon_bl',
							esc_html__('Spotify', 'dfd-native')				=> 'dfd-socicon-spotify',
							esc_html__('Houzz', 'dfd-native')				=> 'dfd-socicon-houzz-dark-icon',
							esc_html__('Skype', 'dfd-native')				=> 'dfd-socicon-skype',
							esc_html__('Slideshare', 'dfd-native')			=> 'dfd-socicon-slideshare',
							esc_html__('Bandcamp', 'dfd-native')			=> 'dfd-socicon-bandcamp-logo',
							esc_html__('Soundcloud', 'dfd-native')			=> 'dfd-socicon-soundcloud',
							esc_html__('Meerkat', 'dfd-native')				=> 'dfd-socicon-Meerkat-color',
							esc_html__('Periscope', 'dfd-native')			=> 'dfd-socicon-periscope',
							esc_html__('Snapchat', 'dfd-native')			=> 'dfd-socicon-snapchat',
							esc_html__('The City', 'dfd-native')			=> 'dfd-socicon-the-city',
							esc_html__('Behance', 'dfd-native')				=> 'dfd-socicon-behance',
							esc_html__('Microsoft Pinpoint', 'dfd-native')	=> 'dfd-socicon-pinpoint',
							esc_html__('Viadeo', 'dfd-native')				=> 'dfd-socicon-viadeo',
							esc_html__('TripAdvisor', 'dfd-native')			=> 'dfd-socicon-tripadvisor',
							esc_html__('VKontakte', 'dfd-native')			=> 'dfd-socicon-vkontakte',
							esc_html__('Odnoklassniki', 'dfd-native')		=> 'dfd-socicon-ok',
						),
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc no-border-bottom',
					),
					array(
						'type'				=> 'vc_link',
						'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the URL for your social account','dfd-native').'</span></span>'.esc_html__('URL', 'dfd-native'),
						'param_name'		=> 'soc_url',
						'value'				=> 'url:%23|||',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding crum_vc',
					),
				),
				'group'				=> esc_html__('Social networks', 'dfd-native')
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the size fo the icon. The default icon size is 20px','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
				'param_name'		=> 'icon_font_size',
				'min'				=> 10,
				'max'				=> 40,
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the icon. The default icon color is #28262b. The default icon color for the style Animated Cube is #fff','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
				'param_name'		=> 'icon_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-7')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the icon. The background color is not set by default except the Animated Cube style, the background color depends on the social network','dfd-native').'</span></span>'.esc_html__('Icon background color', 'dfd-native'),
				'param_name'		=> 'icon_background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-7')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the border radius for the icons','dfd-native').'</span></span>'.esc_html__('Border radius', 'dfd-native'),
				'param_name'		=> 'border_radius',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-8')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the space between the social icons','dfd-native').'</span></span>'.esc_html__('Space between icons', 'dfd-native'),
				'param_name'		=> 'icon_margin',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 dfd-number-wrap crum_vc',
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the border for the social icon. The border is set around single social icon','dfd-native').'</span></span>'.esc_html__('Border', 'dfd-native'),
				'param_name'		=> 'icon_border',
				'options'			=> array(
					'ic_border'			=> array(
						'on'				=> esc_html__('Yes', 'dfd-native'),
						'off'				=> esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'main_style', 'value' => array( 'style-1', 'style-2', 'style-3', 'style-4')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the border width','dfd-native').'</span></span>'.esc_html__('Border width', 'dfd-native'),
				'param_name'		=> 'border_width',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
				'dependency'		=> array('element' => 'icon_border', 'value' => array('ic_border')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the border. The default border color is #e7e7e7','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
				'param_name'		=> 'border_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'icon_border', 'value' => array('ic_border')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the sliding animation direction','dfd-native').'</span></span>'.esc_html__('Sliding direction', 'dfd-native'),
				'param_name'		=> 'sliding_direction',
				'value'				=> 'left_to_right',
				'options'			=> array(
					'<i class="dfd-socicon-arrow-right"></i>'	=> 'left_to_right',
					'<i class="dfd-socicon-arrow-left"></i>'	=> 'right_to_left',
					'<i class="dfd-socicon-arrow-down"></i>'	=> 'top_to_bottom',
					'<i class="dfd-socicon-arrow-up"></i>'		=> 'bottom_to_top'
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-7')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
				
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable the settings for the custom hover colors','dfd-native').'</span></span>'.esc_html__('Customizable hover colors', 'dfd-native'),
				'param_name'		=> 'customizable_hover_colors',
				'options'			=> array(
					'custom_hover'		=> array(
						'on'				=> esc_html__('Yes', 'dfd-native'),
						'off'				=> esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-7')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable the colored social icons. The color of the icon depends on social network color','dfd-native').'</span></span>'.esc_html__('Colored icon', 'dfd-native'),
				'param_name'		=> 'standard_icon_color',
				'options'			=> array(
					'standard_color'	=> array(
						'on'				=> esc_html__('Yes', 'dfd-native'),
						'off'				=> esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
				'dependency'		=> array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon hover color. The default color is #fff','dfd-native').'</span></span>'.esc_html__('Icon hover color', 'dfd-native'),
				'param_name'		=> 'icon_hover_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'customizable_hover_colors', 'value' => array('custom_hover')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the icon background hover color. The default background color depends on the social network','dfd-native').'</span></span>'.esc_html__('Icon background hover color', 'dfd-native'),
				'param_name'		=> 'icon_hover_background_color',
				'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc',
				'dependency'		=> array('element' => 'customizable_hover_colors', 'value' => array('custom_hover')),
				'group'				=> esc_html__('Styles', 'dfd-native'),
			),
		),
	)
);