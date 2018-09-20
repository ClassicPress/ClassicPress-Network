<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $sort_panel_html = $data_atts = $css_rules = '';

$uniqid = uniqid('dfd-portfolio-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

get_template_part('inc/loop/posts/portfolio_shortcode_carousel');

$options = array(
	'portfolio_style' => 'carousel_skew',
	'portfolio_columns' => 3,
	'portfolio_image_ratio' => 2.5,
	'portfolio_show_top_cat' => 'off',
	'portfolio_hover_enable' => 'on',
	'portfolio_hover_appear_effect' => 'dfd-fade-out',
	'portfolio_hover_image_effect' => 'panr',
	'portfolio_hover_mask_border' => 'off',
	'portfolio_hover_mask_bordered_style' => 'offset',
	'portfolio_hover_mask_bordered_size' => 10,
	'portfolio_hover_main_decoration_link' => 'inside',
	'portfolio_hover_main_decoration' => 'none',
	'portfolio_hover_show_title' => 'on',
	'portfolio_hover_show_subtitle' => 'on',
	'portfolio_hover_plus_position' => 'dfd-middle',
	'portfolio_hover_buttons_inside' => '',
	'portfolio_hover_buttons_external' => '',
	'portfolio_hover_buttons_lightbox' => '',
);

$portfolio_atts = array_merge($options, $atts);

$post = new Dfd_portfolio_shortcode_carousel($portfolio_atts);

extract( $atts );

if(!isset($portfolio_columns) || $portfolio_columns == '') {
	$portfolio_columns = 3;
}

$sticky = get_option('sticky_posts');

$args = array(
	'post_type' => 'portfolio',
	'posts_per_page' => $posts_to_show,
	'ignore_sticky_posts' => 1,
	'post__not_in' => $sticky,
);

if (!empty($portfolio_categories)) {
	$portfolio_categories_array = explode(',', $portfolio_categories);
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'portfolio_category',
			'field' => 'slug',
			'terms' => $portfolio_categories_array,
		)
	);
}

if(isset($module_animation) && $module_animation != '') {
	$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".cover"';
}

if(!isset($portfolio_style) || $portfolio_style == '') {
	$portfolio_style = 'carousel_skew';
}

$el_class .= ' layout-'.$portfolio_style;

if(isset($items_offset) && $items_offset != '') {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module {margin: -'. esc_js((int)$items_offset/2) .'px;}';
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio > .cover {padding: '. esc_js((int)$items_offset/2) .'px;}';
}

if(isset($portfolio_rounded) && $portfolio_rounded != '') {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio > .cover .entry-thumb {border-radius: '. esc_js((int)$portfolio_rounded) .'px;}';
}

$el_class .= ' dfd-carousel-wrap';
$data_atts .= ' data-slides="'.esc_attr($portfolio_columns).'"';
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
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio h3.entry-title {'.$title_css['style'].'}';
}

if(isset($subtitle_css['style']) && !empty($subtitle_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio .entry-subtitle {'.$subtitle_css['style'].'}';
}

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio h3.entry-title {'.$title_css['style'].'}';
}

if(isset($portfolio_hover_mask_border) && $portfolio_hover_mask_border == 'on') {
	if($portfolio_hover_mask_bordered_style == 'simple-border') {
		$offset = (int)$portfolio_hover_mask_bordered_size + 20;
		$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco {'
						. 'display: block;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-top,'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-bottom{'
						. 'height: '.(int)$portfolio_hover_mask_bordered_size.'px;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-left,'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-right {'
						. 'width: '.(int)$portfolio_hover_mask_bordered_size.'px;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax .entry-thumb .entry-hover:before {'
						. 'display: none;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax .cover .entry-thumb .thumb-wrap:before {'
						. 'display: block;'
					. '}';
	} elseif($portfolio_hover_mask_bordered_style == 'offset') {
		$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover:before {'
						. 'top: '.(int)$portfolio_hover_mask_bordered_size .'px; bottom: '.(int)$portfolio_hover_mask_bordered_size .'px;'
						. 'left: '.(int)$portfolio_hover_mask_bordered_size .'px; right: '.(int)$portfolio_hover_mask_bordered_size .'px;'
					. '}'
					. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax .entry-thumb .entry-hover:before {'
						. '-webkit-transform: scale(1);'
						. '-moz-transform: scale(1);'
						. '-o-transform: scale(1);'
						. 'transform: scale(1);'
					. '}';
	}
} else {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax .entry-thumb .entry-hover:before {'
					. 'display: none;'
				. '}'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax .cover .entry-thumb .thumb-wrap:before {'
					. 'display: block;'
				. '}';
}

if(isset($portfolio_hover_mask_color) && $portfolio_hover_mask_color != '') {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .title-wrap h3.entry-title,'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-buttons-wrap {color: '.esc_js($portfolio_hover_mask_color).';}';
	
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .title-wrap.square-behind-heading:before { border-color: '.Dfd_Theme_Helpers::dfd_hex2rgb($portfolio_hover_mask_color, .1).';}';
	
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb:hover .entry-hover .dfd-dots-link span { background: '.esc_js($portfolio_hover_mask_color).' !important;}';
}
	
if(isset($portfolio_hover_buttons_bg) && $portfolio_hover_buttons_bg != '') {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module article.dfd-portfolio .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after {background: '.$portfolio_hover_buttons_bg.';}';
}

if(isset($portfolio_hover_mask_background_opacity) && $portfolio_hover_mask_background_opacity != '') {
	$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover:before,'
			 . '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				. 'opacity: '. (int)$portfolio_hover_mask_background_opacity/100 .' !important;'
			 . '}';
}

if(isset($portfolio_hover_mask_background_style) && $portfolio_hover_mask_background_style != '') {
	switch($portfolio_hover_mask_background_style) {
		case 'gradient':
			if(isset($portfolio_hover_mask_bg_start_color) && $portfolio_hover_mask_bg_start_color != '' && isset($portfolio_hover_mask_bg_end_color) && $portfolio_hover_mask_bg_end_color != '') {
				$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover:before,'
						 . '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
							. 'background: -webkit-linear-gradient(left, '.esc_js($portfolio_hover_mask_bg_start_color).','.esc_js($portfolio_hover_mask_bg_end_color).') !important;'
							. 'background: -moz-linear-gradient(left, '.esc_js($portfolio_hover_mask_bg_start_color).','.esc_js($portfolio_hover_mask_bg_end_color).') !important;'
							. 'background: -o-linear-gradient(left, '.esc_js($portfolio_hover_mask_bg_start_color).','.esc_js($portfolio_hover_mask_bg_end_color).') !important;'
							. 'background: -ms-linear-gradient(left, '.esc_js($portfolio_hover_mask_bg_start_color).','.esc_js($portfolio_hover_mask_bg_end_color).') !important;'
							. 'background: linear-gradient(left, '.esc_js($portfolio_hover_mask_bg_start_color).','.esc_js($portfolio_hover_mask_bg_end_color).') !important;'
						 . '}';
			}
			break;
		case 'simple-color':
		default:
			if(isset($portfolio_hover_mask_background) && $portfolio_hover_mask_background != '') {
				$css_rules .= '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover:before,'
						 . '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
							. 'background: '. esc_js($portfolio_hover_mask_background) .' !important;'
						 . '}';
			}
			break;
	}
}

$wp_query = new WP_Query($args);

echo '<div id="'.esc_attr($uniqid).'" class="dfd-portfolio-module-wrapper-carousel_skew">';
	echo $sort_panel_html;
	echo '<div class="dfd-portfolio-module '.esc_attr($el_class).'" '.$data_atts.'>';

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