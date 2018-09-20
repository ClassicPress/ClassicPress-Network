<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $sort_panel_html = $data_atts = $css_rules = '';

$uniqid = uniqid('dfd-gallery-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

get_template_part('inc/loop/posts/gallery_shortcode_carousel');

$options = array(
	'gallery_style' => 'carousel_skew',
	'gallery_columns' => 3,
	'gallery_image_ratio' => 2.5,
	'gallery_show_top_cat' => 'off',
	'gallery_hover_enable' => 'on',
	'gallery_hover_appear_effect' => 'dfd-fade-out',
	'gallery_hover_image_effect' => 'panr',
	'gallery_hover_mask_border' => 'off',
	'gallery_hover_mask_bordered_style' => 'offset',
	'gallery_hover_mask_bordered_size' => 10,
	'gallery_hover_main_decoration_link' => 'inside',
	'gallery_hover_main_decoration' => 'none',
	'gallery_hover_show_title' => 'on',
	'gallery_hover_show_subtitle' => 'on',
	'gallery_hover_plus_position' => 'dfd-middle',
	'gallery_hover_buttons_inside' => '',
	'gallery_hover_buttons_external' => '',
	'gallery_hover_buttons_lightbox' => '',
);

$gallery_atts = array_merge($options, $atts);

$post = new Dfd_gallery_shortcode_carousel($gallery_atts);

extract( $atts );

if(!isset($gallery_columns) || $gallery_columns == '') {
	$gallery_columns = 3;
}

$sticky = get_option('sticky_posts');

$args = array(
	'post_type' => 'gallery',
	'posts_per_page' => $posts_to_show,
	'ignore_sticky_posts' => 1,
	'post__not_in' => $sticky,
);

if (!empty($gallery_categories)) {
	$gallery_categories_array = explode(',', $gallery_categories);
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'gallery_category',
			'field' => 'slug',
			'terms' => $gallery_categories_array,
		)
	);
}

if(isset($module_animation) && $module_animation != '') {
	$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".cover"';
}

if(!isset($gallery_style) || $gallery_style == '') {
	$gallery_style = 'carousel_skew';
}

$el_class .= ' layout-'.$gallery_style;

if(isset($items_offset) && $items_offset != '') {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-gallery-module {margin: -'. esc_js((int)$items_offset/2) .'px;}';
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-gallery-module article.dfd-gallery > .cover {padding: '. esc_js((int)$items_offset/2) .'px;}';
}

if(isset($gallery_rounded) && $gallery_rounded != '') {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-gallery-module article.dfd-gallery > .cover .entry-thumb {border-radius: '. esc_js((int)$gallery_rounded) .'px;}';
}

$el_class .= ' dfd-carousel-wrap';
$data_atts .= ' data-slides="'.esc_attr($gallery_columns).'"';
$data_atts .= ' data-scroll="1"';
$data_atts .= ' data-infinite="true"';
$data_atts .= ' data-center-mode="true"';
if(isset($enabled_autoslideshow) && $enabled_autoslideshow != '') {
	$data_atts .= ' data-autoplay="'.esc_attr($enabled_autoslideshow).'"';
}
if(isset($carousel_slideshow_speed) && $carousel_slideshow_speed != '') {
	$data_atts .= ' data-speed="'.esc_attr($carousel_slideshow_speed).'"';
}
if(isset($use_dots) && $use_dots == 'show') {
	$data_atts .= ' data-dots="true"';
	$el_class .= ' text-center'; 
	if(isset($dots_style) && $dots_style != '') {
		$el_class .= ' above ' . $dots_style; 
	}
}

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

$subtitle_css = _dfd_parse_text_shortcode_params($subtitle_font_options, '', $subtitle_google_fonts, $subtitle_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-gallery-module article.dfd-gallery h3.entry-title {'.$title_css['style'].'}';
}

if(isset($subtitle_css['style']) && !empty($subtitle_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-gallery-module article.dfd-gallery .entry-subtitle {'.$subtitle_css['style'].'}';
}

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-gallery-module article.dfd-gallery h3.entry-title {'.$title_css['style'].'}';
}

if(isset($gallery_hover_mask_border) && $gallery_hover_mask_border == 'on') {
	if($gallery_hover_mask_bordered_style == 'simple-border') {
		$offset = (int)$gallery_hover_mask_bordered_size + 20;
		$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .dfd-hover-frame-deco {'
						. 'display: block;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-top,'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-bottom{'
						. 'height: '.(int)$gallery_hover_mask_bordered_size.'px;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-left,'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-right {'
						. 'width: '.(int)$gallery_hover_mask_bordered_size.'px;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax .entry-thumb .entry-hover:before {'
						. 'display: none;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax .cover .entry-thumb .thumb-wrap:before {'
						. 'display: block;'
					. '}';
	} elseif($gallery_hover_mask_bordered_style == 'offset') {
		$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover:before {'
						. 'top: '.(int)$gallery_hover_mask_bordered_size .'px; bottom: '.(int)$gallery_hover_mask_bordered_size .'px;'
						. 'left: '.(int)$gallery_hover_mask_bordered_size .'px; right: '.(int)$gallery_hover_mask_bordered_size .'px;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax .entry-thumb .entry-hover:before {'
						. '-webkit-transform: scale(1);'
						. '-moz-transform: scale(1);'
						. '-o-transform: scale(1);'
						. 'transform: scale(1);'
					. '}';
	}
} else {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax .entry-thumb .entry-hover:before {'
					. 'display: none;'
				. '}'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax .cover .entry-thumb .thumb-wrap:before {'
					. 'display: block;'
				. '}';
}

if(isset($gallery_hover_mask_color) && $gallery_hover_mask_color != '') {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .title-wrap h3.entry-title,'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .dfd-hover-buttons-wrap {color: '.esc_js($gallery_hover_mask_color).';}';
	
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .title-wrap.square-behind-heading:before { border-color: '.Dfd_Theme_Helpers::dfd_hex2rgb($gallery_hover_mask_color, .1).';}';
	
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
				. '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb:hover .entry-hover .dfd-dots-link span { background: '.esc_js($gallery_hover_mask_color).' !important;}';
}

if(isset($gallery_hover_buttons_bg) && $gallery_hover_buttons_bg != '') {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module article.dfd-gallery .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after {background: '.$gallery_hover_buttons_bg.';}';
}

if(isset($gallery_hover_mask_background_opacity) && $gallery_hover_mask_background_opacity != '') {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover:before,'
			 . '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				. 'opacity: '. (int)$gallery_hover_mask_background_opacity/100 .' !important;'
			 . '}';
}

if(isset($gallery_hover_mask_background_style) && $gallery_hover_mask_background_style != '') {
	switch($gallery_hover_mask_background_style) {
		case 'gradient':
			if(isset($gallery_hover_mask_bg_start_color) && $gallery_hover_mask_bg_start_color != '' && isset($gallery_hover_mask_bg_end_color) && $gallery_hover_mask_bg_end_color != '') {
				$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover:before,'
						 . '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
							. 'background: -webkit-linear-gradient(left, '.esc_js($gallery_hover_mask_bg_start_color).','.esc_js($gallery_hover_mask_bg_end_color).') !important;'
							. 'background: -moz-linear-gradient(left, '.esc_js($gallery_hover_mask_bg_start_color).','.esc_js($gallery_hover_mask_bg_end_color).') !important;'
							. 'background: -o-linear-gradient(left, '.esc_js($gallery_hover_mask_bg_start_color).','.esc_js($gallery_hover_mask_bg_end_color).') !important;'
							. 'background: -ms-linear-gradient(left, '.esc_js($gallery_hover_mask_bg_start_color).','.esc_js($gallery_hover_mask_bg_end_color).') !important;'
							. 'background: linear-gradient(left, '.esc_js($gallery_hover_mask_bg_start_color).','.esc_js($gallery_hover_mask_bg_end_color).') !important;'
						 . '}';
			}
			break;
		case 'simple-color':
		default:
			if(isset($gallery_hover_mask_background) && $gallery_hover_mask_background != '') {
				$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery .entry-thumb .entry-hover:before,'
						 . '#'. esc_js($uniqid)  .' > .dfd-gallery-module .dfd-gallery.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
							. 'background: '. esc_js($gallery_hover_mask_background) .' !important;'
						 . '}';
			}
			break;
	}
}

$wp_query = new WP_Query($args);

echo '<div id="'.esc_attr($uniqid).'" class="dfd-gallery-module-wrapper-carousel_skew">';
	echo $sort_panel_html;
	echo '<div class="dfd-gallery-module '.esc_attr($el_class).'" '.$data_atts.'>';

	while ($wp_query->have_posts()) : $wp_query->the_post();
		$post->post();
	endwhile;

	echo '</div>';
	
	if($css_rules != '') {
		echo '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
	}
	
echo '</div>';

wp_reset_postdata();