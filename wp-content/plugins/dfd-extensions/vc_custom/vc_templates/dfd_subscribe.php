<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $el_class = $module_animation = $animation_data = $unique_id = $border_radius = $link_css = $subscribe_module_placeholder = $subscribe_module_feed_name = '';
$main_style = $field_alignment = $field_text_color = $field_bg_color = $field_border_width = $field_border_color = $button_element = $button_text = '';
$button_element_color = $button_background = $button_element_hover_color = $button_hover_background = $full_width_style = $placeholder_field_text_color = '';

$atts = vc_map_get_attributes( 'dfd_subscribe', $atts );
extract( $atts );

$unique_id = uniqid('dfd-subscribe-').'-'.rand(0,9999);

$el_class .= ' '.esc_attr($main_style).' '.esc_attr($field_alignment).' ';

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
}

if(isset($full_width_style) && strcmp($full_width_style, 'full_width') === 0) {
	$el_class .= ' full-width-style ';
}

if(isset($border_radius) && !empty($border_radius) || strcmp($border_radius, '0') ===0) {
	$link_css .= '#'.esc_js($unique_id).' input.text, #'.esc_js($unique_id).' .submit {border-radius: '.esc_attr($border_radius).'px;}';
}
if(isset($field_text_color) && !empty($field_text_color)) {
	$link_css .= '#'.esc_js($unique_id).' input.text {color: '.esc_attr($field_text_color).';}';
}
if(isset($field_bg_color) && !empty($field_bg_color)) {
	$link_css .= '#'.esc_js($unique_id).' input.text {background: '.esc_attr($field_bg_color).';}';
}
if(isset($field_border_width) && $field_border_width != '') {
	$link_css .= '#'.esc_js($unique_id).' input.text {border-width: '.esc_attr($field_border_width).'px;}';
}
if(isset($field_border_color) && !empty($field_border_color)) {
	$link_css .= '#'.esc_js($unique_id).' input.text {border-color: '.esc_attr($field_border_color).';}';
}
if(isset($button_element_color) && !empty($button_element_color)) {
	$link_css .= '#'.esc_js($unique_id).' .submit {color: '.esc_attr($button_element_color).';}';
}
if(isset($button_background) && !empty($button_background)) {
	$link_css .= '#'.esc_js($unique_id).' .submit {background: '.esc_attr($button_background).';}';
}
if(isset($button_element_hover_color) && !empty($button_element_hover_color)) {
	$link_css .= '#'.esc_js($unique_id).' .submit:hover {color: '.esc_attr($button_element_hover_color).';}';
}
if(isset($button_hover_background) && !empty($button_hover_background)) {
	$link_css .= '#'.esc_js($unique_id).' .submit:hover {background: '.esc_attr($button_hover_background).'; -webkit-box-shadow: none; box-shadow: none;}';
}
if(isset($placeholder_field_text_color) && !empty($placeholder_field_text_color)) {
	$link_css .= '#'.esc_js($unique_id).' ::-webkit-input-placeholder {color: '.esc_attr($placeholder_field_text_color).';}';
	$link_css .= '#'.esc_js($unique_id).' :-moz-placeholder {color: '.esc_attr($placeholder_field_text_color).';}';
	$link_css .= '#'.esc_js($unique_id).' ::-moz-placeholder {color: '.esc_attr($placeholder_field_text_color).';}';
	$link_css .= '#'.esc_js($unique_id).' :-ms-input-placeholder {color: '.esc_attr($placeholder_field_text_color).';}';
}

if(isset($button_text) && !empty($button_text)) {
	$button_info = esc_attr($button_text);
}

$output .= '<div id="'.esc_js($unique_id).'" class="dfd-subscribe-wrap '. esc_attr($el_class).'" '.$animation_data.'>';
	if($subscribe_module_feed_name == '') :
		$output .= '<div class="dfd-widget-list-content burner-error">'.esc_html__('Please fill in the Feedburner Feed Name parameter', 'dfd-native').'</div>';
	endif;
	$output .= '<div class="form-container">';
		$output .= '<form action="//feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri='. $subscribe_module_feed_name.'\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">';
			$output .= '<table>';
				$output .= '<tr>';
					$output .= '<td class="cell-text">';
						$output .= '<input class="text" type="text" name="email" id="'.uniqid('subsmail_').'" placeholder="'. esc_attr($subscribe_module_placeholder).'" />';
					$output .= '</td>';
					$output .= '<td class="cell-submit">';
						$output .= '<button type="submit" class="submit">'.$button_info.'</button>';
					$output .= '</td>';
				$output .= '</tr>';
			$output .= '</table>';
			$output .= '<input type="hidden" value="'.esc_attr($subscribe_module_feed_name).'" name="uri"/>';
			$output .= '<input type="hidden" name="loc" value="en_US"/>';
		$output .= '</form>';
	$output .= '</div>';

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$link_css.'</style>");'
					. '})(jQuery);'
				. '</script>';
	}
	
$output .= '</div>';

echo $output;