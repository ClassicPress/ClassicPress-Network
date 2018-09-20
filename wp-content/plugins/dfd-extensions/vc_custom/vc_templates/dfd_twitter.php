<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;
$output = $text_alignment = $el_class = $module_animation = $data_atts = $unique_id = $link_css = $slides_to_show = $slides_to_scroll = $auto_slideshow = '';
$enable_dots = $dots_style = $tweets = $font_options = $use_google_fonts = $custom_fonts = $main_style =  $author_info = $subtitle_html = '';
$title_html = $author_t_font_options = $author_t_use_google_fonts = $author_t_custom_fonts = $author_st_font_options = $author_st_use_google_fonts = '';
$author_st_custom_fonts = $icon_size = $icon_color = $text_alignment_3 = $icon_info = '';

$atts = vc_map_get_attributes('dfd_twitter', $atts);
extract($atts);

$unique_id = uniqid('dfd-twitter-').'-'.rand(1,9999);

$el_class .= ' '.esc_attr($main_style);

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$data_atts = 'data-animate-type = "'.esc_attr($module_animation).'" ';
}

if(empty($slides_to_show)) {
	$slides_to_show = 1;
}
$data_atts .= ' data-slide="'.esc_attr($slides_to_show).'"';

if(empty($slides_to_scroll)) {
	$slides_to_scroll = 1;
}
$data_atts .= ' data-scroll="'.esc_attr($slides_to_scroll).'"';

if(empty($slideshow_speed)) {
	$slideshow_speed = 3000;
}
$data_atts .= ' data-speed="'.esc_attr($slideshow_speed).'"';

if(isset($auto_slideshow) && strcmp($auto_slideshow, 'auto_slid') === 0) {
	$data_atts .= ' data-autoplay="1"';
}

if(isset($enable_dots) && strcmp($enable_dots, 'dots') === 0) {
	$data_atts .= ' data-dots="1"';
	$el_class .= ' dots-enable';
} else {
	$el_class .= ' dots-disable';
}

if(isset($dots_style) && !empty($dots_style)) {
	$el_class .= ' '.esc_attr($dots_style);
}
if(isset($main_style) && strcmp($main_style, 'style-3') !== 0) {
	if(isset($text_alignment) && strcmp($text_alignment, '') !== 0) {
		$el_class .= ' '.esc_attr($text_alignment);
	}
}else{
	if(isset($text_alignment_3) && !empty($text_alignment_3)) {
		$el_class .= ' '.esc_attr($text_alignment_3);
	}
}

if(isset($icon_size) && !empty($icon_size)) {
	$link_css .= '#'.esc_attr($unique_id).' .icon-wrap {font-size: '.esc_attr($icon_size).'px;}';
	$link_css .= '#'.esc_attr($unique_id).'.style-2.dots-disable {padding-bottom: '.(esc_attr($icon_size) + 15).'px;}';
}
if(isset($icon_color) && !empty($icon_color)) {
	$link_css .= '#'.esc_attr($unique_id).' .icon-wrap {color: '.esc_attr($icon_color).';}';
}

$author_t_font_options = _dfd_parse_text_shortcode_params($author_t_font_options, 'author-title dfd-content-title-big', $author_t_use_google_fonts, $author_t_custom_fonts);

$author_st_font_options = _dfd_parse_text_shortcode_params($author_st_font_options, 'author-subtitle quote-author', $author_st_use_google_fonts, $author_st_custom_fonts);

$font_options = _dfd_parse_text_shortcode_params($font_options, $use_google_fonts, $custom_fonts);

if(isset($dfd_native['username']) && !empty($dfd_native['username'])) {
	$author_subtitle = $dfd_native['username'];
	$subtitle_html = '<'.$author_st_font_options['tag'].' class="'.$author_st_font_options['class'].'" '. $author_st_font_options['style'] . '>@'.esc_html($author_subtitle).'</'.$author_st_font_options['tag'].'>';
}

if(!class_exists('DFDTwitter')) {
	return;
}
// Get the tweets from Twitter.
//require_once DFD_EXTENSIONS_PLUGIN_PATH.'inc/lib/twitteroauth.php';
$twitter = new DFDTwitter();
$tweets = $twitter->getTweets();

$output .= '<div id="'.esc_attr($unique_id).'" class="dfd-twitter dfd-twitter-module '.esc_attr($el_class).'" '.$data_atts.'>';
	if(!$twitter->hasError()) {
		if(!empty($tweets)) {
			
			$author_title = $tweets[0]['name'];
			$title_html = '<'.$author_t_font_options['tag'].' class="'.$author_t_font_options['class'].'" '. $author_t_font_options['style'] . '>'.esc_html($author_title).'</'.$author_t_font_options['tag'].'>';
			
			if(isset($icon_info) && $icon_info == 'enable_icon' || isset($author_info) && strcmp($author_info, 'enable_info') == 0) {
				$output .= '<div class="tweets-author">';
					if(isset($icon_info) && $icon_info == 'enable_icon') {
						$output .= '<div class="icon-wrap"><i class="dfd-socicon-twitter"></i></div>';
					}

					if(isset($author_info) && strcmp($author_info, 'enable_info') == 0) {
						$output .= '<div class="title-wrap">';
							$output .= $title_html;
							$output .= $subtitle_html;
						$output .= '</div>';
					}else{
						$link_css .= '#'.esc_attr($unique_id).'.style-2 .tweet-item:before {display: none; padding-top: 0;}';
					}
				$output .= '</div>';
			}else{
				$link_css .= '#'.esc_attr($unique_id).' .tweet-item:before {display: none; padding-top: 0;}';
			}
				
			$output .= '<div class="tweet-container">';
				foreach($tweets as $tweet) {
					$output .= '<div class="tweet-item">';
						$output .= '<div class="tweet '.esc_attr($text_alignment).'">';
							$output .= '<'.$font_options['tag'].' class="tweet-content" ' . $font_options['style'] . '>';
								$output .= wp_kses( $tweet['text'] , array(
									'a' => array(
										'href' => array(),
										'title' => array(),
										'target' => array(),
										'rel' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
								));
							$output .= '</'.$font_options['tag'].'>';
							$output .= '<div class="date entry-meta">';
								$output .= '<i class="dfd-socicon-clock"></i>';
								$output .= date('d F Y', $tweet['time']);//human_time_diff($t['time'], current_time('timestamp'));
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				}
			$output .= '</div>';
		}
	} else {
		$output .= '<p class="text-bold text-center">';
			$output .= $twitter->getError()->message;
		$output .= '</p>';
	}

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$link_css.'</style>");'
					. '})(jQuery);'
				. '</script>';
	}

$output .= '</div>';

echo $output;