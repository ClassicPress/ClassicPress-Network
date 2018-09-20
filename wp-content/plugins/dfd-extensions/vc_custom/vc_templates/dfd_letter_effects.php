<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

$style = $alignment = $exception_alignment = $el_class = $text_fields = $module_animation = $animation_data = $title_font_options = $title_google_fonts = '';
$title_custom_fonts = $letters_html = $alignment_title = $effect_bg = $html = $animated_text = $css_rules = '';

$atts = vc_map_get_attributes( 'dfd_letter_effects', $atts );
extract( $atts );

wp_enqueue_script('dfd-fancy-text');

$uniqid = uniqid('dfd-letter-effect-');

if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

if(isset($effect_bg) && ! empty ($effect_bg)){
	$css_rules .= '#' . esc_js($uniqid) . '.effect-bg {background: '.esc_js($effect_bg).'}';
}

if(isset($alignment) && $alignment != '' && $style != 'style-8' && $style != 'style-7' && $style != 'style-6' && $style != 'style-5') {
	$alignment_title .= ' '.$alignment;
} 

if(isset($style) && $style == 'style-5' || isset($style) && $style == 'style-6' || isset($style) && $style == 'style-7') {
	$alignment_title .=  ' '.$exception_alignment;
} 

if(isset($style) && $style == 'style-8') {
	$alignment_title .= ' title-centered';
} 

$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts, true );

if(isset($title_font_options['style']) && $title_font_options['style'] != '') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-letter-effect-wrap .dfd-letter-effect-block .dfd-letters-slideshow .dfd-letter-effect .title {'.esc_js($title_font_options['style']).'}';
}

if(isset($title_responsive) && $title_responsive != '') {
	$css_rules .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#' . esc_js($uniqid) . ' .title');
}

/* Animated text */
if(!empty($text_fields)) {
	$text_fields = (array) vc_param_group_parse_atts($text_fields);
	$slide_current = 'dfd-slide--current';
	foreach($text_fields as $field) {
		$letters_html = '';
		$single_field_css = '';
		if(isset($field['text_field_color'])) {
			$single_field_css = 'color: '.esc_attr($field['text_field_color']).';';
		}
		if(isset($field['text_field'])) {
			$letters_html .= strip_tags($field['text_field'],'<br><br/>');
		}
		if(isset($letters_html) && !empty($letters_html)) {
			$animated_text .= '<div class="dfd-letter-effect dfd-slide '.esc_attr($slide_current).'" ><h2 class="title '.  esc_attr($alignment_title).'" style="'.esc_attr($single_field_css).'" data-bg-color="'.$effect_bg.'">' . $letters_html . '</h2></div>';
		}
		$slide_current = '';
	}
}

if($animated_text != '' && !empty($animated_text)) {
	
	$animated_text = '<div class="dfd-letters-slideshow" data-effect="'.$style.'" data-id="'.esc_attr($uniqid).'">' . $animated_text . '</div>';
	
	$html .= '<div class="dfd-letter-effect-wrap" id="'.esc_attr($uniqid).'">';

		$html .= '<div class="dfd-letter-effect-block content  '.esc_attr($el_class).'" ' . $animation_data . '>';

				$html .= $animated_text ;

		$html .= '</div>';

		if($css_rules != '') {
			$html .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$css_rules.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}

	$html .= '</div>';
}

echo $html;