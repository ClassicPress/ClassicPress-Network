<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$style = $alignment = $type_speed = $onchange_animation = $afterchange_animation = $el_class = $module_animation = '';
$prefix = $postfix = $text_fields = '';
$title_font_options = $title_google_fonts = $title_custom_fonts = '';
$prefix_color = $postfix_color = $animated_text_color = '';

$atts = vc_map_get_attributes( 'dfd_animated_text', $atts );
extract( $atts );

if(!isset($style) || $style == '') {
	$style = 'typed';
}

$html = $animated_text = $css_rules = $js_rules = $js_atts = $data_atts = '';

$uniqid = uniqid('dfd-animated-text-');

if(!empty($module_animation)) {
	$el_class .= ' cr-animate-gen';
	$data_atts .= ' data-animate-type="'.esc_attr($module_animation).'" ';
}

if($alignment != '') {
	$el_class .= ' '.$alignment;
}

$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts, true );

if(isset($title_font_options['style']) && $title_font_options['style'] != '') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-text span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-me {'.esc_js($title_font_options['style']).'}';
}

$pref_post_font_options = _dfd_parse_text_shortcode_params( $pref_post_font_options, '', $pref_post_google_fonts, $pref_post_custom_fonts, true );

if(isset($pref_post_font_options['style']) && $pref_post_font_options['style'] != '') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span {'.esc_js($pref_post_font_options['style']).'}';
}

if($prefix_color != '') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-anim-prefix {color: '.esc_js($prefix_color).'}';
}

if($postfix_color != '') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-anim-postfix {color: '.esc_js($postfix_color).'}';
}

if($animated_text_color != '') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-text span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-me span {color: '.esc_js($animated_text_color).'}';
}

if(isset($title_responsive) && $title_responsive != '') {
	$css_rules .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-text span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span.dfd-animate-me');
}
if(isset($pref_post_responsive) && $pref_post_responsive != '') {
	$css_rules .= Dfd_Resposive_Text_Param::responsive_css($pref_post_responsive, '#' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span, #' . esc_js($uniqid) . '.dfd-animated-text-wrap .dfd-animated-text-block span');
}

if($type_speed == '') {
	$type_speed = 10;
}

switch($style) {
	case 'typed':
		global $dfd_native;
		
		if(isset($dfd_native['dev_mode']) && $dfd_native['dev_mode'] == 'on' && defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) {
			wp_enqueue_script('dfd-typed');
		}
		
		$data_atts .= ' data-speed="'.esc_attr($type_speed).'"';
		
		if($cursor == 'on') {
			$data_atts .= ' data-cursor="1"';
		}

		if($loop == 'on') {
			$data_atts .= ' data-loop="1"';
		}
		break;
	case 'chaffle':
		$data_atts .= ' data-speed="'.esc_attr($type_speed * 1000).'"';
		break;
	case 'changethewords':
		$data_atts .= ' data-speed="'.esc_attr($type_speed * 1000).'"';
		$data_atts .= ' data-onchange="'. esc_attr($onchange_animation) .'"';
		$data_atts .= ' data-afterchange="'. esc_js($afterchange_animation) .'"';
		break;
}

/* Animated text */
if(!empty($text_fields)) {
	$text_fields = (array) vc_param_group_parse_atts($text_fields);
	$i = 1;
	foreach($text_fields as $field) {
		$single_field_css = '';
		if(isset($field['text_field_color'])) {
			$single_field_css .= 'color: '.esc_attr($field['text_field_color']).';';
		}
		if(isset($field['text_field_background'])) {
			$single_field_css .= 'background: '.esc_attr($field['text_field_background']).'; padding: 0 10px .1em;';
		}
		if(isset($field['text_field'])) {
			$animated_text .= '<span class="dfd-animated-text-string '.esc_attr($style).'" data-remove-hover="true" data-lang="en" data-load="onload" data-speed="'.esc_attr($type_speed * 10).'" data-id="'.esc_attr($i).'" style="'.$single_field_css.'">' . strip_tags($field['text_field'],'<br></br>') . '</span>';
		}
		$i++;
	}
	$animated_text = '<span class="dfd-animate-text">' . $animated_text . '</span>';

	if($style == 'typed') {
		$animated_text .= '<span class="dfd-animate-me"></span>';
	}
}

$el_class .= ' style-'.$style;

$html .= '<div class="dfd-animated-text-wrap" id="'.esc_attr($uniqid).'">';

	$html .= '<div class="dfd-animated-text-block '.esc_attr($el_class).'" '.$data_atts.'>';
		if($prefix != '') {
			$html .= '<span class="dfd-anim-prefix">'.strip_tags($prefix,'<br></br>').'</span>';
		}

			$html .= $animated_text;

		if($postfix != '') {
			$html .= '<span class="dfd-anim-postfix">'.strip_tags($postfix,'<br></br>').'</span>';
		}

	$html .= '</div>';

	if($css_rules != '') {
		$html .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$css_rules.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}

$html .= '</div>';

echo $html;