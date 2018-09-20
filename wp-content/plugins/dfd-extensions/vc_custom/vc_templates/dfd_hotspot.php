<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $el_class = $data_atts = $css_rules = '';

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract( $atts );

if(isset($image) && !empty($image)) {
	global $dfd_native;
	
	$uniqid = uniqid('dfd-hotspot-module');
	
	if(isset($dfd_native['dev_mode']) && $dfd_native['dev_mode'] == 'on') {
		wp_enqueue_script('dfd-hotspot');
	}
	
	/*Data attributes*/
	if(!empty($module_animation)) {
		$data_atts .= ' data-animate="1"  data-animate-type="'.esc_attr($module_animation).'" ';
	}
	
	if(!empty($hotspot_data)) {
		$data_atts .= ' data-hotspot-content="'.esc_attr($hotspot_data).'" ';
	}
	
	if(!empty($hotspot_action)) {
		$el_class .= ' dfd-action-'.$hotspot_action;
		$data_atts .= ' data-action="'.esc_attr($hotspot_action).'" ';
	}
	
	/*Marker*/
	if(isset($marker_style) && $marker_style == 'custom_image' && isset($marker_image) && !empty($marker_image)) {
		$data_atts .= ' data-hotspot-class="HotspotPlugin_Hotspot dfdHotspotImageMarker" ';
		$marker_img_src = wp_get_attachment_image_src($marker_image, 'full');
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot.dfdHotspotImageMarker {'
							. 'width: '.esc_js($marker_img_src[1]).'px;'
							. 'height: '.esc_js($marker_img_src[2]).'px;'
							. 'margin-left: -'.esc_js($marker_img_src[1] / 2).'px;'
							. 'margin-top: -'.esc_js($marker_img_src[2] / 2).'px;'
							. 'background-image: url('.esc_url($marker_img_src[0]).');'
					. '}';
	}
	
	/*Shortcode class*/
	if(isset($tooltip_position) && !empty($tooltip_position)) {
		$el_class .= ' '.$tooltip_position;
	}
	
	if(isset($tooltip_content_align) && !empty($tooltip_content_align)) {
		$el_class .= ' '.$tooltip_content_align;
	}
	
	/*Shortcode dynamic css*/
	if(isset($tooltip_width) && $tooltip_width != '') {
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div { min-width: '.esc_js($tooltip_width).'px;}';
	}
	
	if(isset($tooltip_background) && $tooltip_background != '') {
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div { background: '.esc_js($tooltip_background).';}';
	}
	
	if(isset($marker_background) && $marker_background != '') {
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot:not(.dfdHotspotImageMarker):before { background: '.esc_js($marker_background).';}';
	}
	
	if(isset($marker_deco_background) && $marker_deco_background != '') {
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot:not(.dfdHotspotImageMarker):after { background: '.esc_js($marker_deco_background).';}';
	}
	
	$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);
	if(isset($title_css['style']) && !empty($title_css['style'])) {
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div > .Hotspot_Title {'.esc_js($title_css['style']).'}';
	}
	
	$content_css = _dfd_parse_text_shortcode_params($content_font_options, '', $content_google_fonts, $content_custom_fonts, true);
	if(isset($content_css['style']) && !empty($content_css['style'])) {
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div > .Hotspot_Message {'.esc_js($content_css['style']).'}';
	}
	
	if($border != '') {
		$border_css = Dfd_Border_Param::border_css($border);
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div {'.esc_js($border_css).'}';
	}
	
	if(substr_count($box_shadow, 'disable') == 0) {
		$box_shadow_css = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
		$css_rules .= '#'.esc_js($uniqid).' .dfd-hotspot-shortcode .HotspotPlugin_Hotspot > div {'.esc_js($box_shadow_css).'}';
	}
	
	$img_src = wp_get_attachment_image_src($image, 'full');
	
	$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src[0], $image, $img_src[1], $img_src[2], esc_attr__('Hotspot image','dfd-native'));
	
	global $dfd_native;

	if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
		$el_class .= ' dfd-img-lazy-load';
		$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_src[1] $img_src[2]'%2F%3E";
		$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_attr($img_src[0]).'" width="'.esc_attr($img_src[1]).'" height="'.esc_attr($img_src[2]).'" '.$img_atts.' />';
	} else {
		$img_html = '<img src="'.esc_attr($img_src[0]).'" width="'.esc_attr($img_src[1]).'" height="'.esc_attr($img_src[2]).'" '.$img_atts.' />';
	}
	
	$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-hotspot-shortcode-wrapper">';
		$output .= '<div class="dfd-hotspot-shortcode" '.$data_atts.'>';
			$output .= '<div class="dfd-hotspot-image-cover '.esc_attr($el_class).'">';
				$output .= $img_html;
			$output .= '</div>';
		$output .= '</div>';
		
		if($css_rules != '') {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$css_rules.'</style>")'
						. '})(jQuery);'
					. '</script>';
		}
		
	$output .= '</div>';
}

echo $output;