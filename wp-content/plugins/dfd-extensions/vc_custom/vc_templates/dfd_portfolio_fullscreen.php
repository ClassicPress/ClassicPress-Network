<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $sort_panel_html = $bg_wrapper_class = $data_atts = $css_rules = '';

$custom_items = $post_ids = array();

$uniqid = uniqid('dfd-portfolio-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

get_template_part('inc/loop/posts/portfolio_shortcode_fullscreen');

$options = array(
	'portfolio_columns' => '1',
	'portfolio_show_top_cat' => 'off',
	'portfolio_show_meta' => 'off',
	'portfolio_show_meta_date' => 'on',
	'portfolio_show_meta_category' => 'on',
	'portfolio_show_meta_comments' => 'on',
	'portfolio_show_meta_likes' => 'on',
	'portfolio_show_title' => 'on',
	'portfolio_show_subtitle' => 'on',
	'portfolio_show_image' => 'on',
	'portfolio_show_content' => 'off',
	'portfolio_show_author_box' => 'off',
	'portfolio_content_alignment' => 'text-left',
	'portfolio_show_subtitle' => 'on',
	'portfolio_hover_enable' => 'off',
);

$portfolio_atts = array_merge($options, $atts);

extract($atts);

$post = new Dfd_portfolio_shortcode_fullscreen($portfolio_atts);

$sticky = get_option('sticky_posts');

if(!isset($items_to_show) || empty($items_to_show)) {
	$items_to_show = 5;
}

$args = array(
	'post_type' => 'portfolio',
	'posts_per_page' => $items_to_show,
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

if(empty($portfolio_style)) {
	$portfolio_style = 'vertical';
}

if(isset($portfolio_blur_bg_image) && $portfolio_blur_bg_image == 'on') {
	$bg_wrapper_class .= ' dfd-blur-bg-image';
}

$data_atts .= ' data-direction="'.esc_attr($portfolio_style).'"';

$el_class .= ' layout-fullscreen dfd-direction-'.$portfolio_style;

$el_class .= ' featured-images-bg content-front content-valign-bottom';

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

$subtitle_css = _dfd_parse_text_shortcode_params($subtitle_font_options, '', $subtitle_google_fonts, $subtitle_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper article.dfd-portfolio h3.entry-title {'.$title_css['style'].'}';
}

if(isset($subtitle_css['style']) && !empty($subtitle_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper article.dfd-portfolio .entry-subtitle {'.$subtitle_css['style'].'}';
}

if(isset($bg_mask_color) && !empty($bg_mask_color)) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-background-fade-wrapper:before {background: '.$bg_mask_color.';}';
}

if(isset($carousel_mask_color) && !empty($carousel_mask_color)) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .dfd-portfolio-module.layout-fullscreen article.dfd-portfolio > .cover .entry-thumb .dfd-portfolio-fullscreen-link {background: '.$carousel_mask_color.';}';
}

if(isset($arrows_color) && !empty($arrows_color)) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-navigation-wrap,'
				. '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .dfd-portfolio-module.layout-fullscreen .swiper-container .dfd-swiper-pagination .dfd-swiper-pagination-bullet {color: '.$arrows_color.';}';
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .dfd-portfolio-module.layout-fullscreen .swiper-container .dfd-swiper-pagination .dfd-swiper-pagination-bullet.dfd-swiper-pagination-bullet-active:before {background: '.Dfd_Theme_Helpers::dfd_hex2rgb($arrows_color, .2).';}';
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .dfd-portfolio-module.layout-fullscreen .swiper-container .dfd-swiper-pagination .dfd-swiper-pagination-bullet.dfd-swiper-pagination-bullet-active.dfd-swiper-pagination-bullet-active-activated {color: '.Dfd_Theme_Helpers::dfd_hex2rgb($arrows_color, .4).';}';
}

if(isset($arrows_hover_color) && !empty($arrows_hover_color)) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-navigation-wrap .dfd-swiper-nav:hover {color: '.$arrows_hover_color.';}';
}

if(isset($background) && !empty($background)) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-navigation-wrap .dfd-swiper-nav {background: '.$background.';}';
}

if(isset($hover_background) && !empty($hover_background)) {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-navigation-wrap .dfd-swiper-nav:hover {background: '.$hover_background.';}';
}

if(isset($border) && !empty($border)) {
	$border_css = Dfd_Border_Param::border_css($border);
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-navigation-wrap .dfd-swiper-nav {'.$border_css.';}';
}

if(isset($hover_border) && !empty($hover_border)) {
	$border_hover_css = Dfd_Border_Param::border_css($hover_border);
	$css_rules .= '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .swiper-navigation-wrap .dfd-swiper-nav:hover {'.$border_hover_css.';}';
}

if(isset($title_responsive) && $title_responsive != '') {
	$css_rules .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#'.esc_js($uniqid).'.dfd-portfolio-fullscreen-module-wrapper .dfd-portfolio-module.layout-fullscreen article.dfd-portfolio > .cover h3.entry-title');
}

$wp_query = new WP_Query($args);

echo '<div id="'.esc_attr($uniqid).'" class="dfd-portfolio-fullscreen-module-wrapper">';
	
	echo '<div class="dfd-portfolio-module '.esc_attr($el_class).'" '.$data_atts.'>';
	
		echo '<div class="swiper-container">';
		
			echo '<div class="swiper-wrapper">';

				while ($wp_query->have_posts()) : $wp_query->the_post();
					$post->post();
				endwhile;

			echo '</div>';
			
			echo '<div class="swiper-pagination dfd-swiper-pagination"></div>';
			
		echo '</div>';

		echo '<div class="swiper-navigation-wrap">'
				. '<a href="#" class="dfd-swiper-nav dfd-content-title-small dfd-swiper-prev" title="'.esc_attr__('Previous slide','dfd').'">'
					. '<i class="dfd-socicon-arrow-left"></i>'
					. '<span class="counter"></span>'
				. '</a>'
				. '<a href="#" class="dfd-swiper-nav dfd-content-title-small dfd-swiper-next" title="'.esc_attr__('Next slide','dfd').'">'
					. '<i class="dfd-socicon-arrow-right"></i>'
					. '<span class="counter"></span>'
				. '</a>'
			. '</div>';
		
	echo '</div>';
	
	echo '<div class="swiper-background-fade-wrapper '.esc_attr($bg_wrapper_class).'"></div>';
	
	if($css_rules != '') {
		echo '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
	}
	
echo '</div>';

wp_reset_postdata();