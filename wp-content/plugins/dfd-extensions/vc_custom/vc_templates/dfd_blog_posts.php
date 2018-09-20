<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $sort_panel_html = $data_atts = $css_rules = '';

$uniqid = uniqid('dfd-blog-posts-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

get_template_part('inc/loop/posts/post_shortcode');

$options = array(
	'post_content_style' => 'full',
	'post_style' => 'carousel',
	'post_columns' => 3,
	'post_show_image' => 'on',
	'post_show_top_cat' => 'on',
	'post_show_meta' => 'on',
	'post_show_meta_date' => 'on',
	'post_show_meta_category' => 'on',
	'post_show_meta_comments' => 'on',
	'post_show_meta_likes' => 'on',
	'post_show_title' => 'on',
	'post_show_image' => 'on',
	'post_show_content' => 'on',
	'post_show_author_box' => 'on',
	'post_content_alignment' => 'text-left',
);

$post_atts = array_merge($options, $atts);

extract( $atts );

if(!isset($columns) || $columns == '') {
	$columns = 3;
}

$sticky = get_option('sticky_posts');

$args = array(
	'posts_per_page' => $posts_to_show,
	'ignore_sticky_posts' => 1,
	'post__not_in' => $sticky,
);

if (!empty($post_categories)) {
	$post_categories_array = explode(',', $post_categories);
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => $post_categories_array,
		)
	);
}

$el_class .= ' content-'.$post_content_style;

if(isset($module_animation) && $module_animation != '') {
	$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".cover"';
}

if(isset($post_content_style)) {
	if(substr_count($post_content_style, 'full') > 0) {
		if(isset($post_tiled) && $post_tiled == 'on') {
			$el_class .= ' posts-tiled';
		}
		if($post_content_style == 'full') {
			if(isset($thumb_rounded) && $thumb_rounded != '') {
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module.content-full:not(.posts-tiled) article.post > .cover > .entry-thumb {border-radius: '. esc_js($thumb_rounded) .'px;}'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.content-full.posts-tiled article.post > .cover {border-radius: '. esc_js($thumb_rounded) .'px;}'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.content-full.posts-tiled article.post > .cover > .entry-thumb {border-top-left-radius: '. esc_js($thumb_rounded) .'px;border-top-right-radius: '. esc_js($thumb_rounded) .'px;}'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.layout-masonry.content-full article.post.format-quote > .cover,'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.layout-masonry.content-full article.post.format-link > .cover,'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.layout-masonry.content-full article.post.format-audio > .cover,'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.layout-metro.content-full article.post.format-quote > .cover,'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.layout-metro.content-full article.post.format-link > .cover,'
							. '#'.esc_js($uniqid).' > .dfd-posts-module.layout-metro.content-full article.post.format-audio > .cover {border-radius: '. esc_js($thumb_rounded) .'px;}';
			}
		}
		if($post_content_style == 'full_front') {
			if(isset($post_style) && $post_style == 'masonry') {
				$post_style = 'fitRows';
				$post_atts['post_style'] = 'fitRows';
			}
			if(isset($thumb_rounded) && $thumb_rounded != '') {
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module.content-full_front article.post > .cover .entry-thumb {border-radius: '. esc_js($thumb_rounded) .'px;}';
			}
			if(isset($items_offset) && $items_offset != '') {
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module.content-full_front article.post > .cover .content-wrap {'
									. 'left: '. esc_js((int)$items_offset/2) .'px;'
									. 'right: '. esc_js((int)$items_offset/2) .'px;'
									. 'bottom: '. esc_js((int)$items_offset/2) .'px;'
								. '}';
			}
		}
		if(!isset($post_style) || $post_style == '') {
			$post_style = 'fitRows';
		}
		$el_class .= ' layout-'.$post_style;
		if(isset($items_offset) && $items_offset != '') {
			$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module {margin: -'. esc_js((int)$items_offset/2) .'px;}';
		}
		if($post_style == 'carousel') {
			$el_class .= ' dfd-carousel-wrap';
			$data_atts .= ' data-slides="'.esc_attr($columns).'"';
			$data_atts .= ' data-scroll="1"';
			if(isset($enabled_autoslideshow) && $enabled_autoslideshow != '') {
				$data_atts .= ' data-autoplay="'.esc_attr($enabled_autoslideshow).'"';
			}
			if(isset($carousel_slideshow_speed) && $carousel_slideshow_speed != '') {
				$data_atts .= ' data-speed="'.esc_attr($carousel_slideshow_speed).'"';
			}
			if(isset($use_dots) && $use_dots == 'show') {
				$data_atts .= ' data-dots="true"';
				$data_atts .= ' data-infinite="true"';
				$el_class .= ' text-center'; 
				if(isset($dots_style) && $dots_style != '') {
					$el_class .= ' above ' . $dots_style; 
				}
			}
			if(isset($items_offset) && $items_offset != '') {
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module article.post > .cover {padding: '. esc_js((int)$items_offset/2) .'px;}';
			}
		} else {
			if(isset($show_sort_panel) && $show_sort_panel == 'on') {
				if(!isset($sort_panel_alignment) || $sort_panel_alignment == '') {
					$sort_panel_alignment = 'text-left';
				}
				$categories = get_terms('category');
				$sort_panel_html .= '<div class="clearfix">';
					$sort_panel_html .= '<div class="sort-panel '.esc_attr($sort_panel_alignment).'">';
						$sort_panel_html .= '<ul class="filter">';
							$sort_panel_html .= '<li class="active"><a data-filter=".post" href="#">'. esc_html__('All', 'dfd-native') .'</a></li>';
							foreach ($categories as $category) {
								$sort_panel_html .= '<li><a data-filter=".post[data-category~=\'' . strtolower(preg_replace('/\s+/', '-', $category->slug)) . '\']" href="#">' . $category->name . '</a></li>';
							}
						$sort_panel_html .= '</ul>';
					$sort_panel_html .= '</div>';
				$sort_panel_html .= '</div>';
			}
			$el_class .= ' isotope-columns-'.esc_attr($columns);
			$data_atts .= ' data-enable-isotope="1"';
			$data_atts .= ' data-layout-type="'.esc_attr($post_style).'"';
			$data_atts .= ' data-columns="'.esc_attr($columns).'"';
			if(isset($items_offset) && $items_offset != '') {
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module article.post {padding: '. esc_js((int)$items_offset/2) .'px;}';
			}
		}
	} elseif($post_content_style == 'tiny' && isset($thumb_rounded) && $thumb_rounded != '') {
		$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module.content-tiny article.post > .cover .entry-thumb img, #'.esc_js($uniqid).' > .dfd-posts-module.content-tiny article.post > .cover > .entry-thumb {border-radius: '. esc_js($thumb_rounded) .'px;}';
	} elseif($post_content_style == 'list' && isset($post_delimiter_style) && $post_delimiter_style != '') {
		$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module.content-list article.post:not(:last-child) > .cover {border-bottom-style: '. esc_js($post_delimiter_style) .';}';
	}
}

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-posts-module article.post h3.entry-title {'.$title_css['style'].'}';
}

$wp_query = new WP_Query($args);

$post = new Dfd_post_shortcode($post_atts);

echo '<div id="'.esc_attr($uniqid).'" class="dfd-posts-module-wrap">';
	echo $sort_panel_html;
	echo '<div class="dfd-posts-module '.esc_attr($el_class).'" '.$data_atts.'>';

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