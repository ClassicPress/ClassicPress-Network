<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $main_style = $align = $module_animation = $el_class = $link_content = $animation_data = $link_css = $uniqid = $link_src = $link_attr = $link_html = '';
$text_color = $text_hover_color = $front_background = $back_background = $font_options = $use_google_fonts = $custom_fonts = $line_color = $line_hover_color = '';

$atts = vc_map_get_attributes( 'dfd_link_style', $atts );
extract( $atts );

$uniqid = uniqid('dfd-link-style-') .'-'.rand(1,9999);

if (!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type="'.esc_attr($module_animation).'" ';
}

$el_class .= ' '.$main_style.' '.$align;

if(isset($text_color) && !empty($text_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-link-element .front {color: '.esc_js($text_color).';}';
}
if(isset($text_hover_color) && !empty($text_hover_color)) {
	$link_css	.= '#'.esc_js($uniqid).'.style-1 .dfd-link-element:hover .front,'
				. '#'.esc_js($uniqid).'.style-2 .dfd-link-element .back,'
				. '#'.esc_js($uniqid).'.style-3 .dfd-link-element:hover .front,'
				. '#'.esc_js($uniqid).'.style-4 .dfd-link-element .back,'
				. '#'.esc_js($uniqid).'.style-5 .dfd-link-element:hover .front,'
				. '#'.esc_js($uniqid).'.style-6 .dfd-link-element:hover .front,'
				. '#'.esc_js($uniqid).'.style-7 .dfd-link-element .back,'
				. '#'.esc_js($uniqid).'.style-8 .dfd-link-element .back,'
				. '#'.esc_js($uniqid).'.style-9 .dfd-link-element:hover .front,'
				. '#'.esc_js($uniqid).'.style-10 .dfd-link-element:hover .front,'
				. '#'.esc_js($uniqid).'.style-11 .dfd-link-element:hover .front {color: '.esc_js($text_hover_color).';}';
}
if(isset($front_background) && !empty($front_background)) {
	$link_css	.= '#'.esc_js($uniqid).'.style-2 .dfd-link-element .front,'
				. '#'.esc_js($uniqid).'.style-7 .dfd-link-element .front {background: '.esc_js($front_background).';}';
}
if(isset($back_background) && !empty($back_background)) {
	$link_css	.= '#'.esc_js($uniqid).'.style-2 .dfd-link-element .back,'
				. '#'.esc_js($uniqid).'.style-7 .dfd-link-element .back {background: '.esc_js($back_background).';}';
}
if(isset($line_color) && !empty($line_color)) {
	$link_css	.= '#'.esc_js($uniqid).'.style-3 .dfd-link-element .front:before,'
				. '#'.esc_js($uniqid).'.style-5 .dfd-link-element .front:before,'
				. '#'.esc_js($uniqid).'.style-5 .dfd-link-element .front:after,'
				. '#'.esc_js($uniqid).'.style-8 .dfd-link-element .front:before,'
				. '#'.esc_js($uniqid).'.style-9 .dfd-link-element .front:before,'
				. '#'.esc_js($uniqid).'.style-9 .dfd-link-element .front:after,'
				. '#'.esc_js($uniqid).'.style-10 .dfd-link-element:before,'
				. '#'.esc_js($uniqid).'.style-10 .dfd-link-element:after {background: '.esc_js($line_color).';}';
	
	$link_css	.= '#'.esc_js($uniqid).'.style-6 .dfd-link-element .front:after {border-color: '.esc_js($line_color).';}';
	
	$link_css	.= '#'.esc_js($uniqid).'.style-6 .dfd-link-element:hover .front:after {border-color: transparent;}';
}
if(isset($line_hover_color) && !empty($line_hover_color)) {
	$link_css	.= '#'.esc_js($uniqid).'.style-5 .dfd-link-element:hover .front:before,'
				. '#'.esc_js($uniqid).'.style-5 .dfd-link-element:hover .front:after,'
				. '#'.esc_js($uniqid).'.style-9 .dfd-link-element:hover .front:before,'
				. '#'.esc_js($uniqid).'.style-9 .dfd-link-element:hover .front:after,'
				. '#'.esc_js($uniqid).'.style-10 .dfd-link-element:hover:before,'
				. '#'.esc_js($uniqid).'.style-10 .dfd-link-element:hover:after,'
				. '#'.esc_js($uniqid).'.style-11 .dfd-link-element:hover .front:before,'
				. '#'.esc_js($uniqid).'.style-11 .dfd-link-element:hover .front:after {background: '.esc_js($line_hover_color).';}';
			
	$link_css	.= '#'.esc_js($uniqid).'.style-6 .dfd-link-element:hover .front:before,'
				. '#'.esc_js($uniqid).'.style-8 .dfd-link-element .back {border-color: '.esc_js($line_hover_color).';}';
}

if(isset($link_src) && !empty($link_src) && isset($link_content) && !empty($link_content)) {
	$link_src = vc_build_link($link_src);
	
	if(isset($link_src['url']) && !empty($link_src['url'])) {
		$link_attr .= 'href="'.esc_url($link_src['url']).'" ';
	}else{
		$link_attr .= 'href="#" ';
	}
	if(isset($link_src['title']) && !empty($link_src['title'])) {
		$link_attr .= 'title="'.esc_attr($link_src['title']).'" ';
	}
	if(isset($link_src['target']) && !empty($link_src['target'])) {
		$link_attr .= 'target="'.esc_attr(preg_replace('/\s+/', '', $link_src['target'])).'" ';
	}
	if(isset($link_src['rel']) && !empty($link_src['rel'])) {
		$link_attr .= 'rel="'.esc_attr($link_src['rel']).'"';
	}
	
	$font_options = _dfd_parse_text_shortcode_params($font_options, '', $use_google_fonts, $custom_fonts);
	
	$link_html = '<a '.$link_attr.' class="dfd-link-element"><span class="front" >'.esc_html($link_content).'</span><span class="back">'.esc_html($link_content).'</span></a>';
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-link-style-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
	$output .= '<'.$font_options['tag'].' class="link-container" '.$font_options['style'].'>';
		$output .= $link_html;
	$output .= '</'.$font_options['tag'].'>';

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}
	
$output .= '</div>';

echo $output;