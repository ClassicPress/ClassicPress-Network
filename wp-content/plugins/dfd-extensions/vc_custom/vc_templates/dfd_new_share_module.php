<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $enable_facebook_share = $enable_twitter_share = $enable_google_plus_share = $enable_linkedin_share = $enable_pinterest_share = $link_text = '';
$el_class = $share_html = $module_animation = $animate = $animation_data = $main_style = $general_border_style = $general_border_width = $link_css = '';
$general_border_color = $single_border_radius = $single_border_style = $single_border_width = $single_border_color = $single_background_color = $style_six = '';
$single_style = $single_font_size = $single_diameter = $icon_style = $single_share_height = $hover_class = $hover_attr = $single_color = $enable_digg_share = '';
$share_uppercouse = $style_class = $line_height_style = $line_height = $content_alignment = $element_alignment = $general_class = $top_bottom_spacer = '';
$element_vertical_alignment = $left_right_spacer = '';

$data_link = get_page_link();
$data_title = $blog_title = get_bloginfo('name');

$unique_id = uniqid('dfd_share_');

$atts = vc_map_get_attributes('dfd_new_share_module', $atts);
extract($atts);
$site_url = get_page_link();
//$site_url = site_url();
$data_media = Dfd_Theme_Helpers::default_noimage_url();
if(has_post_thumbnail()) {
	$thumb_id = get_post_thumbnail_id();
	$img_src = wp_get_attachment_image_src($thumb_id, 'full');
	if($img_src && isset($img_src[0])) {
		$data_media = $img_src[0];
	}
}
$share_data = array (
		'facebook' => array (
				"text" => esc_html__('Facebook', 'dfd-native'),
				"icon" => 'dfd-socicon-facebook',
				"link" => 'https://www.facebook.com/sharer/sharer.php?u=' . $site_url,
		),
		'twitter' => array (
				"text" => esc_html__('Twitter', 'dfd-native'),
				"icon" => 'dfd-socicon-twitter',
				"link" => 'https://twitter.com/intent/tweet?text=' . $site_url,
		),
		'googleplus' => array (
				"text" => esc_html__('Google plus', 'dfd-native'),
				"icon" => 'dfd-socicon-google-plus',
				"link" => 'https://plus.google.com/share?url=' . $site_url,
		),
		'linkedin' => array (
				"text" => esc_html__('LinkedIN', 'dfd-native'),
				"icon" => 'dfd-socicon-linkedin',
				"link" => 'http://www.linkedin.com/shareArticle?mini=true&amp;url=' . $site_url,
		),
		'pinterest' => array (
				"text" => esc_html__('Pinterest', 'dfd-native'),
				"icon" => 'dfd-socicon-pinterest',
				"link" => 'http://pinterest.com/pin/create/button/?url=' . $site_url .'&amp;media='. esc_url($data_media),
		),
		'digg' => array (
				"text" => esc_html__('Digg', 'dfd-native'),
				"icon" => 'dfd-socicon-digg',
				"link" => '',
		),
);
/**
 * Animation
 */
if (!($module_animation == '')) {
	$animate .= ' cr-animate-gen';
	$animation_data .= 'data-animate-item = ".module-entry-share-links-list > li > div" data-animate-type = "' . $module_animation . '" ';
}

if (isset($main_style) && strcmp($main_style, 'style-1') === 0) {
	if (isset($general_border_style) && !empty($general_border_style)) {
		$style_class = 'general-border';
		$line_height = 62 - $general_border_width * 2;
		$line_height_style = 'line-height: ' . $line_height . 'px;';
		$general_border_style = esc_attr($general_border_style);
		if (isset($general_border_width) && !empty($general_border_width)) {
			$general_border_width = esc_attr($general_border_width);
		}
		if (isset($general_border_color) && !empty($general_border_color)) {
			$general_border_color = esc_attr($general_border_color);
		}
	}
	if ($general_border_style) {
		$link_css .= '.dfd-new-share-module.style-1 #' . esc_attr($unique_id) . ' ul li a {border-top-style: ' . $general_border_style . '; border-top-width: ' . $general_border_width . 'px; border-top-color: ' . $general_border_color . '; border-bottom-style: ' . $general_border_style . '; border-bottom-width: ' . $general_border_width . 'px; border-bottom-color: ' . $general_border_color . '; ' . esc_attr($line_height_style) . ';}';
		$link_css .= '.dfd-new-share-module.style-1 #' . esc_attr($unique_id) . ' ul li:first-child a {border-left-style: ' . $general_border_style . '; border-left-width: ' . $general_border_width . 'px; border-left-color: ' . $general_border_color . ';}';
		$link_css .= '.dfd-new-share-module.style-1 #' . esc_attr($unique_id) . ' ul li:last-child a {border-right-style: ' . $general_border_style . '; border-right-width: ' . $general_border_width . 'px; border-right-color: ' . $general_border_color . ';}';
		$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-1 #' . esc_attr($unique_id) . ' ul li a {border-left-width: ' . $general_border_width . 'px; border-right-width: ' . $general_border_width . 'px; border-bottom-width: 0; border-bottom-color: inherit; border-left-color: ' . $general_border_color . '; border-right-color: ' . $general_border_color . '; border-top-width: 0; border-left-style: ' . $general_border_style . '; border-right-style: ' . $general_border_style . '; border-bottom-style: solid;}}';
		$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-1 #' . esc_attr($unique_id) . ' ul li:first-child a {border-top-width: ' . $general_border_width . 'px;}}';
		$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-1 #' . esc_attr($unique_id) . ' ul li:last-child a {border-bottom-width: ' . $general_border_width . 'px; border-bottom-color: ' . $general_border_color . '; border-bottom-style: ' . $general_border_style . ';}}';
	}
}

$single_style .= 'style="';
if (isset($main_style) && strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-4') === 0 || strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
	if (isset($single_border_radius) && !empty($single_border_radius)) {
		$single_style .= 'border-radius: ' . esc_attr($single_border_radius) . 'px; ';
	}
}
if (isset($main_style) && strcmp($main_style, 'style-5') === 0 || strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
	if (isset($single_font_size) && !empty($single_font_size)) {
		$single_style .= 'font-size: ' . esc_attr($single_font_size) . 'px; ';
	}
}
if (isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-2') === 0 || strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-4') === 0) {
	if (isset($single_share_height) && !empty($single_share_height)) {
		$single_style .= 'height: ' . esc_attr($single_share_height) . 'px; line-height: ' . esc_attr($single_share_height) . 'px; ';
	}
}
if ($share_uppercouse === 'yes') {
	$single_style .= 'text-transform: uppercase;';
}
$single_style .= '"';

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$link_css .= '.dfd-new-share-module #' . esc_attr($unique_id) . ' ul li a .front-share {'.$title_css['style'].'}';
}

if(isset($title_responsive) && $title_responsive != '') {
	$link_css .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '.dfd-new-share-module #' . esc_attr($unique_id) . ' ul li a .front-share');
}

if (isset($main_style) && strcmp($main_style, 'style-6') === 0) {
	if (isset($single_border_style) && !empty($single_border_style)) {
		$style_six .= 'border-style: ' . esc_attr($single_border_style) . ';';
		if($single_border_style != 'none') {
			if (isset($single_border_width) && !empty($single_border_width)) {
				$style_six .= 'border-width: ' . esc_attr($single_border_width) . 'px;';
			}
			if (isset($single_border_color) && !empty($single_border_color)) {
				$style_six .= 'border-color: ' . esc_attr($single_border_color) . ';';
			}
		}
	}
	if (isset($single_background_color) && !empty($single_background_color)) {
		$single_background_color = 'background: ' . esc_attr($single_background_color) . ';';
	}
	if (isset($single_color) && !empty($single_color)) {
		$single_color = 'color: ' . esc_attr($single_color) . ';';
	}
	if ($single_border_style || $single_background_color || $single_color) {
		$link_css .= '.dfd-new-share-module.style-6 #' . esc_attr($unique_id) . ' ul li a {' . $style_six . $single_background_color . $single_color . '}';
	}
}

$icon_style .= 'style="';
if (isset($main_style) && strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
	if (isset($single_diameter) && !empty($single_diameter)) {
		$icon_style .= 'width: ' . esc_attr($single_diameter) . 'px; height: ' . esc_attr($single_diameter) . 'px; line-height: ' . esc_attr($single_diameter) . 'px;';
	}
}
$icon_style .= '"';

if (isset($main_style) && strcmp($main_style, 'style-5') === 0) {
	$hover_class = 'chaffle';
	$hover_attr = 'data-lang="en"';
}
if (isset($top_bottom_spacer) && !empty($top_bottom_spacer)) {
	$link_css .= '.dfd-new-share-module.style-8.vertical #' . esc_attr($unique_id) . ' ul li:first-child a .front-share {padding-top: ' . esc_attr($top_bottom_spacer) . 'px;}';
	$link_css .= '.dfd-new-share-module.style-8.vertical #' . esc_attr($unique_id) . ' ul li:last-child a .front-share {padding-bottom: ' . esc_attr($top_bottom_spacer) . 'px;}';
	$link_css .= '@media only screen and (min-width: 799px) {.dfd-new-share-module.style-8.horizontal #' . esc_attr($unique_id) . ' ul li a .front-share {padding: ' . esc_attr($top_bottom_spacer) . 'px 0;}}';
	$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-8.horizontal #' . esc_attr($unique_id) . ' ul li:first-child a .front-share {padding-top: ' . esc_attr($top_bottom_spacer) . 'px;}}';
	$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-8.horizontal #' . esc_attr($unique_id) . ' ul li:last-child a .front-share {padding-bottom: ' . esc_attr($top_bottom_spacer) . 'px;}}';
}
if (isset($left_right_spacer) && !empty($left_right_spacer)) {
	$link_css .= '.dfd-new-share-module.style-8.vertical #' . esc_attr($unique_id) . ' ul li a .front-share {padding-left: ' . esc_attr($left_right_spacer) . 'px; padding-right: ' . esc_attr($left_right_spacer) . 'px;}';
}
if (isset($main_style) && strcmp($main_style, 'style-5') === 0 || strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
	$general_class .= ' ' . esc_attr($element_alignment) . ' ';
} elseif (isset($main_style) && strcmp($main_style, 'style-8') === 0 && strcmp($position_elements, 'vertical') === 0) {
	$general_class .= ' ' . esc_attr($element_vertical_alignment) . ' ';
} else {
	$general_class .= 'text-center ';
}
$general_class .= $main_style . ' ' . $position_elements . ' ' . $style_class . ' ' . $el_class . ' ' . $animate;
ob_start();
/**
 * Template
 */
echo '<div class="dfd-shar-module-cover">';

	if($link_css != '') {
		echo '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$link_css.'</style>");'
				. '})(jQuery);'
			. '</script>';
	}
	
	echo '<div class="dfd-new-share-module clearfix ' . esc_attr($general_class) . '" ' . $animation_data . '>';
		echo '<div class="module module-entry-share" id="' . esc_attr($unique_id) . '">';
			echo '<ul class="module-entry-share-links-list dfd-share-buttons" data-directory="' . DFD_EXTENSIONS_PLUGIN_URL . '">';

			foreach ($share_data as $key => $value) {
				$social_network = 'enable_' . $key . '_share';
				switch ($main_style) {
					case 'style-1':
					case 'style-2':
					case 'style-3':
					case 'style-4':
					case 'style-6':
					case 'style-7':
						$link_text = '<span class="dfd-share-icon '.$value["icon"].'"></span><span class="front-share ' . esc_attr($hover_class) . '" ' . $hover_attr . '>' . $value["text"] . '</span>';
						break;
					default:
						$link_text = '<span class="front-share ' . esc_attr($hover_class) . '" ' . $hover_attr . '>' . $value["text"] . '</span>';

						break;
				}

				if ($$social_network) {
					echo '<li>';
						echo '<div><a class="popup module-entry-share-link-' . esc_attr($key) . ' feature-title" data-text="some text" data-title="' . esc_attr($data_title) . '" data-url="' . esc_url($data_link) . '" data-media="" href="' . esc_url($value["link"]) . '"  ' . $single_style . '>' . $link_text . '</a></div>';
					echo '</li>';
				}
			}
			echo '</ul>';
		echo '</div>';

	echo '</div>';

echo '</div>';
$output .= ob_get_clean();

echo $output;
