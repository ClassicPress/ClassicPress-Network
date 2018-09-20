<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$uniqid = $output = $main_style = $el_class = $title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $font_options = '';
$module_animation = $animation_data = $icon_type = $select_icon = $ic_dfd_icons = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = $ic_linecons = '';
$icon_image_id = $icon_text = $icon_size = $icon_color = $title = $subtitle = $main_content = $read_more = $link = $readmore_show = $more_show = $readmore_style = '';
$readmore_text = $title_html = $subtitle_html = $content_html = $title_options = $read_more_html = $icon_html = $bg_content = $bg_decoration_html = '';
$bg_font_options = $use_bg_google_fonts = $bg_custom_fonts = $bg_typ_options = $link_title = $link_rel = $link_target = '';

$atts = vc_map_get_attributes('dfd_presentation_bg_decoration', $atts);
extract($atts);

$uniqid = uniqid('dfd-presen-bg-decor-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'"';
}
if(isset($readmore_show) && strcmp($readmore_show, 'show') == 0) {
	$el_class .= ' show-readmore '.esc_attr($readmore_style);
}
if (isset($more_show) && strcmp($more_show, 'hover') == 0) {
	$el_class .= ' more-hover';
}

if(isset($bg_content) && !empty($bg_content)) {
	$bg_typ_options = _dfd_parse_text_shortcode_params($bg_font_options, 'dfd-content-title-big', $use_bg_google_fonts, $bg_custom_fonts);
	$bg_decoration_html = '<span class="bg-decoration '.$bg_typ_options['class'].'" '.$bg_typ_options['style'].'>'.esc_html($bg_content).'</span>';
}
if(isset($title) && !empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	if(isset($link) && strcmp($read_more, 'title') == 0) {
		$link = vc_build_link($link);
		$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
		$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$title_html .= '<'.$title_options['tag'].' class="info-box-title '.$title_options['class'].'" '.$title_options['style'].'><a href="'.esc_url($link['url']).'" '.$link_title.' '.$link_target.' '.$link_rel.'>'.esc_html($title).'</a></'.$title_options['tag'].'>';
	}else{
		$title_html .= '<'.$title_options['tag'].' class="info-box-title '.$title_options['class'].'" '.$title_options['style'].'>'.esc_html($title ).'</'.$title_options['tag'].'>';
	}
}
if(isset($subtitle) && !empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html = '<'.$subtitle_options['tag'].' class="'.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($subtitle).'</'.$subtitle_options['tag'].'>';
}
if(isset($main_content) && !empty($main_content)) {
	$content_font_options = _dfd_parse_text_shortcode_params($font_options);
	$content_html = '<div class="description" '.$content_font_options['style'].'>'.wp_kses($main_content, array('br' => array())).'</div>';
}
$icon_html = dfd_icon_render($atts);
$read_more_html = dfd_module_read_more($atts);

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-presen-bg-decor-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
	$output .= $bg_decoration_html;
	$output .= '<div class="head-wrap">';
		$output .= '<div class="icon-wrap">';
			$output .= $icon_html;
		$output .= '</div>';
		$output .= '<div class="title-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
		$output .= '</div>';
	$output .= '</div>';
	$output .= $content_html;
	$output .= $read_more_html;
	
	if(isset($link) && strcmp($read_more, 'box') == 0) {
		$link = vc_build_link( $link );
		$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
		$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$output .= '<a href="'.esc_url($link['url']).'" class="full-box-link" '.$link_title.' '.$link_target.' '.$link_rel.'></a>';
	}
$output .= '</div>';

echo $output;