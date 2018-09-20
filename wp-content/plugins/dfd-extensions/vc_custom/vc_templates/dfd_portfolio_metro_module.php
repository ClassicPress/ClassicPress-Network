<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $sort_panel_html = $data_atts = $css_rules = '';

$custom_items = $post_ids = array();

$uniqid = uniqid('dfd-portfolio-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

get_template_part('inc/loop/posts/portfolio_shortcode_metro');

$options = array(
	'items' => 'loop',
	'selected_items' => '',
	'columns' => '3',
	'portfolio_show_top_cat' => 'on',
	'portfolio_show_meta' => 'off',
	'portfolio_show_meta_date' => 'on',
	'portfolio_show_meta_category' => 'on',
	'portfolio_show_meta_comments' => 'on',
	'portfolio_show_meta_likes' => 'on',
	'portfolio_show_title' => 'on',
	'portfolio_show_subtitle' => 'on',
	'portfolio_show_image' => 'on',
	'portfolio_show_content' => 'on',
	'portfolio_show_author_box' => 'on',
	'portfolio_content_style' => '',
	'portfolio_content_alignment' => 'text-left',
	'portfolio_show_subtitle' => 'on',
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

extract($atts);

if(isset($items) && $items == 'single' && isset($selected_items) && !empty($selected_items) && function_exists('vc_param_group_parse_atts')) {
	$selected_items = (array)vc_param_group_parse_atts($selected_items);
	foreach($selected_items as $k => $item) {
		if(isset($item['post_id'])) {
			$post_ids[] = $item['post_id'];
			$custom_items[$item['post_id']] = (isset($item['post_size']) && !empty($item['post_size'])) ? $item['post_size'] : 'default';
		}
	}
}

$portfolio_atts['selected_items'] = $custom_items;

$post = new Dfd_portfolio_shortcode_metro($portfolio_atts);

if(!isset($columns) || $columns == '') {
	$columns = 3;
}

if($items == 'single' && isset($post_ids) && !empty($post_ids)) {
	$args = array(
		'post_type' => 'portfolio',
		'posts_per_page' => -1,
		'post__in' => $post_ids
	);
} else {
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
}

if(isset($module_animation) && $module_animation != '') {
	$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".cover"';
}

$el_class .= ' layout-metro';

$el_class .= ' featured-images-bg content-front content-valign-bottom';

if(isset($show_sort_panel) && $show_sort_panel == 'on') {
	if(!isset($sort_panel_alignment) || $sort_panel_alignment == '') {
		$sort_panel_alignment = 'text-left';
	}
	$categories = get_terms('portfolio_category');
	$sort_panel_html .= '<div class="clearfix">';
		$sort_panel_html .= '<div class="sort-panel '.esc_attr($sort_panel_alignment).'">';
			$sort_panel_html .= '<ul class="filter">';
				$sort_panel_html .= '<li class="active"><a data-filter=".dfd-portfolio" href="#">'. esc_html__('All', 'dfd-native') .'</a></li>';
				foreach ($categories as $category) {
					$sort_panel_html .= '<li><a data-filter=".dfd-portfolio[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
				}
			$sort_panel_html .= '</ul>';
		$sort_panel_html .= '</div>';
	$sort_panel_html .= '</div>';
}
$el_class .= ' isotope-columns-'.esc_attr($columns);
$data_atts .= ' data-enable-isotope="1"';
$data_atts .= ' data-layout-type="metro"';
$data_atts .= ' data-columns="'.esc_attr($columns).'"';

if(isset($portfolio_content_style) && !empty($portfolio_content_style)) {
	$el_class .= ' posts-'.$portfolio_content_style;
}

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

$subtitle_css = _dfd_parse_text_shortcode_params($subtitle_font_options, '', $subtitle_google_fonts, $subtitle_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio h3.entry-title {'.$title_css['style'].'}';
}

if(isset($subtitle_css['style']) && !empty($subtitle_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-portfolio-module article.dfd-portfolio .entry-subtitle {'.$subtitle_css['style'].'}';
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
					. '#'. $uniqid  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco .line.line-left,'
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
					. '#'. $uniqid  .' > .dfd-portfolio-module .dfd-portfolio.dfd-3d-parallax .entry-thumb .entry-hover:before {'
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
				. '#'. esc_js($uniqid)  .' > .dfd-portfolio-module .dfd-portfolio .entry-thumb .entry-hover .dfd-hover-buttons-wrap {color: '.$portfolio_hover_mask_color.';}';
	
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

echo '<div id="'.esc_attr($uniqid).'">';
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