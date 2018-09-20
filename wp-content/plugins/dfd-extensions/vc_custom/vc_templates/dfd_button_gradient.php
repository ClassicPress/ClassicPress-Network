<?php
$main_style = $module_animation = $data_animation = $el_class = $button_size = $button_text = $tooltip_text = $alignment = $tooltip_alignment = $buttom_link_src = $button_class = '';
$select_icon = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = $ic_linecons = $icon_size = $title_font_options = $title_google_fonts = '';
$title_custom_fonts = $output = $link_css = $buttom_link_attr = $icon_html = $button_text_html = $ic_dfd_icons = $padding_left = $padding_right = '';
$text_color = $hover_text_color = $ic_color = $hover_ic_color = '';
// Gradient
$direction_gradient = $background_from = $background_to = $hover_background_from = $hover_background_to = '';
$border = $border_width = $border_color_from = $border_color_to = '';

$tooltip_color = $tooltip_background = '';
$box_shadow = $hover_box_shadow = '';
$border_css = '';


$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract( $atts );

$uniqid = uniqid('dfd-button-gradient').'-'.rand(1,9999);

if(!empty($module_animation)) {
	$data_animation .= ' data-animate="1"  data-animate-type="'.esc_attr($module_animation).'" ';
}

if(isset($hover_style) && $hover_style != '') {
	$button_class .= ' '.$hover_style;
}

if(isset($click_animation) && $click_animation == 'yes') {
	$el_class .= ' dfd-button-click-animated';
}

if(isset($main_style) && !empty($main_style)) {
	$el_class .= ' '.$main_style;
}
if(isset($button_size) && !empty($button_size)) {
	$el_class .= ' '.$button_size;
}
if(isset($alignment) && !empty($alignment)) {
	$el_class .= ' '.$alignment;
}

if(isset($buttom_link_src) && !empty($buttom_link_src)) {
	$buttom_link_src = vc_build_link($buttom_link_src);

	if(isset($buttom_link_src['url']) && !empty($buttom_link_src['url'])) {
		$buttom_link_attr .= 'href="'.esc_attr($buttom_link_src['url']).'" ';
	}else{
		$buttom_link_attr .= 'href="#" ';
	}
	if(isset($buttom_link_src['title']) && !empty($buttom_link_src['title'])) {
		$buttom_link_attr .= 'title="'.esc_attr($buttom_link_src['title']).'" ';
	}
	if(isset($buttom_link_src['target']) && !empty($buttom_link_src['target'])) {
		$buttom_link_attr .= 'target="'.esc_attr(preg_replace('/\s+/', '', $buttom_link_src['target'])).'" ';
	}
	if(isset($buttom_link_src['rel']) && !empty($buttom_link_src['rel'])) {
		$buttom_link_attr .= 'rel="'.esc_attr($buttom_link_src['rel']).'"';
	}
} else {
	$buttom_link_attr .= 'href="#" ';
}

if($select_icon != '') {
	$atts['icon_type'] = 'selector';
	$icon_html = dfd_icon_render($atts);
	if($icon_html && $icon_html != '') {
		$el_class .= ' with-icon';
		$icon_html = '<span class="icon-wrap">'. $icon_html .'</span>';
	}
}

if(isset($button_text) && !empty($button_text)) {
	$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts );
	$button_text_html = '<span class="dfd-button-text-main" '.$title_font_options['style'].'>'.esc_html($button_text).'</span>';
}

if(isset($padding_left) && strcmp($padding_left, '') !== 0) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover {padding-left: '.esc_js($padding_left).'px;}';
}
if(isset($padding_right) && strcmp($padding_right, '') !== 0) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover {padding-right: '.esc_js($padding_right).'px;}';
}


/* Text */
if(isset($text_color) && !empty($text_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:not(:hover),'
			. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.front .dfd-button-text-main,'
			. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link:not(:hover) .featured-icon {color: '.esc_js($text_color).';}';
}
if(isset($hover_text_color) && !empty($hover_text_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover,'
				. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-3d-rotate .dfd-button-inner-cover.back .dfd-button-text-main,'
				. '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link:hover .featured-icon  {color: '.esc_js($hover_text_color).';}';
}
/* Icon */
if(isset($ic_color) && !empty($ic_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:not(:hover) .dfd-button-inner-cover .featured-icon {color: '.esc_js($ic_color).';}';
}
if(isset($hover_ic_color) && !empty($hover_ic_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover .dfd-button-inner-cover .featured-icon {color: '.esc_js($hover_ic_color).';}';
}

/* Background gradient */
if(isset($background_from) && !empty($background_from) && isset($background_to) && !empty($background_to)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover:before,'
				.'#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-fade .dfd-button-inner-cover:before {background: linear-gradient('.esc_js($direction_gradient).', '.esc_js($background_from).', '.esc_js($background_to).');}';
}
if(isset($hover_background_from) && !empty($hover_background_from) && isset($hover_background_to) && !empty($hover_background_to)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover:after {background: linear-gradient('.esc_js($direction_gradient).', '.esc_js($hover_background_from).', '.esc_js($hover_background_to).');}';
	$link_css .= '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link.dfd-fade .dfd-button-inner-cover {background: transparent;}';
}

/* Border gradient */
if(isset($border_color_from) && !empty($border_color_from) && isset($border_color_to) && !empty($border_color_to) && isset($border_width) && !empty($border_width) ) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover .dfd-button-border {border-width: '.esc_js($border_width).'px; border-style: solid;}';
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover, #'.esc_js($uniqid).' .dfd-button-link {border-radius: 0;}';
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-inner-cover .dfd-button-border {border-image: linear-gradient('.esc_js($direction_gradient).', '.esc_js($border_color_from).', '.esc_js($border_color_to).'); border-image-slice:1;}';
}

/* Tooltip */
if(isset($tooltip_color) && !empty($tooltip_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-tooltip {color: '.esc_js($tooltip_color).';}';
}
if(isset($tooltip_background) && !empty($tooltip_background)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link .dfd-button-tooltip {background: '.esc_js($tooltip_background).';}';
}
if(isset($click_animation_color) && !empty($click_animation_color)) {
	$link_css .= '#'.esc_js($uniqid).'.dfd-button-gradient-module-wrap .dfd-button-link .ripple-obj {fill: '.esc_js($click_animation_color).';}';
}

/* Shadow */
if(substr_count($box_shadow, 'disable') == 0) {
	$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:not(:hover) {'.esc_attr($box_shadow).'}';
}
if(substr_count($hover_box_shadow, 'disable') == 0) {
	$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
	$link_css .= '#'.esc_js($uniqid).' .dfd-button-link:hover {'.esc_attr($hover_box_shadow).'}';
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-button-gradient-module-wrap">';

	$output .= '<div class="dfd-button-module '.esc_attr($el_class).'" '.$data_animation.'>';
		$output .= '<a '.$buttom_link_attr.' class="dfd-button-link '.esc_attr($button_class).'">';
		
			if(isset($hover_style) && $hover_style == 'dfd-3d-rotate') {
				$output .= '<span class="dfd-button-inner-rotator">';
				$output .= '<span class="dfd-button-inner-cover front">';
				$output .= $icon_html;
				$output .= $button_text_html;
				$output .= '<span class="dfd-button-border"></span>';
				$output .= '</span>';
				$output .= '<span class="dfd-button-inner-cover back">';
				$output .= $icon_html;
				$output .= $button_text_html;
				$output .= '<span class="dfd-button-border"></span>';
				$output .= '</span>';
				$output .= '</span>';
			} else {
				$output .= '<span class="dfd-button-inner-cover">';
				$output .= $icon_html;
				$output .= $button_text_html;
				$output .= '<span class="dfd-button-border"></span>';
				$output .= '</span>';
			}

			if(isset($tooltip_text) && !empty($tooltip_text)) {
				$output .= '<span class="dfd-button-tooltip '.esc_attr($tooltip_alignment).'">'.esc_html($tooltip_text).'</span>';
			}
		$output .= '</a>';
	$output .= '</div>';

		if($link_css != '') {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}
$output .= '</div>';

echo $output;


