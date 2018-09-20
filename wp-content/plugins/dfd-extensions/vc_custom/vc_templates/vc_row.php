<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $el_class = $full_width = $full_height = $content_placement = $columns_placement = $row_effect = $row_sort_panel = $bg_check = $force_equal_height_columns = $align_content_vertically = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $data_attr = $one_page_title = $row_id = $row_prebuilt_classes = $overlay_html = $uniq_class = $row_custom_css = $css_rules = $responsive_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

/*Resposive css rules*/
if(isset($dfd_row_responsive_enable) && $dfd_row_responsive_enable == 'dfd-row-responsive-enable' && isset($responsive_styles) && $responsive_styles != '') {
	$responsive_class .= uniqid('vc-row-responsive-');
	$row_custom_css .= Dfd_Resposive_Param::responsive_css($responsive_styles, '.vc-row-wrapper.'.$responsive_class);
	$el_class .= ' '.$responsive_class;
}

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

$el_class = $this->getExtraClass($el_class);
if  ($dfd_row_config) {
	$el_class .= ' '.$dfd_row_config;
}

if  ($bg_check == 'row-background-dark') {
	$el_class .= ' dfd-background-dark';
}

if  ($row_effect != '') {
	$el_class .= ' '.$row_effect;
}

if  (strcmp($force_equal_height_columns, 'main_row') === 0) {
	$el_class .= ' equal-height-columns';

	if  ($mobile_destroy_equal_heights == 'yes') {
		$el_class .= ' mobile-destroy-equal-heights';
		if(isset($mobile_destroy_equal_heights_resolution) && $mobile_destroy_equal_heights_resolution != '') {
			$destroy_equal_heights = uniqid('vc-row-destroy-equal-heights-');
			$el_class .= ' '.$destroy_equal_heights;
			$data_attr .= ' data-resolution="'.esc_attr($mobile_destroy_equal_heights_resolution).'"';
			$row_custom_css .= '@media (min-width: 800px) and (max-width: '.$mobile_destroy_equal_heights_resolution.'px) {'
									. '.'.$destroy_equal_heights.'.aligh-content-verticaly.mobile-destroy-equal-heights .dfd-vertical-aligned {'
										. 'top: 0;'
										. '-webkit-transform: translateY(0);'
										. '-moz-transform: translateY(0);'
										. '-o-transform: translateY(0); transform: translateY(0);'
									. '}'
									. '.'.$destroy_equal_heights.'.vc-row-wrapper.equal-height-columns > .fp-tableCell > .fp-scrollable > .fp-scroller > .row > .columns,'
									. '.'.$destroy_equal_heights.'.vc-row-wrapper.equal-height-columns > .fp-tableCell > .fp-scrollable > .row > .columns,'
									. '.'.$destroy_equal_heights.'.vc-row-wrapper.equal-height-columns > .fp-tableCell > .row > .columns {'
										. 'height: auto;'
									. '}'
								. '}';
		}
	}

	if  ($align_content_vertically == 'yes') {
		$el_class .= ' aligh-content-verticaly';
	}
}

if  (isset($dfd_row_parallax) && !empty($dfd_row_parallax) && $dfd_row_parallax == 'dfd-row-parallax') {
	$el_class .= ' '.$dfd_row_parallax;
}

if ( ! empty( $full_height ) ) {
	$el_class .= ' dfd-row-full-height';
	if ( ! empty( $content_placement ) ) {
		$el_class .= ' dfd-row-content-' . $content_placement;
	}
	if ( ! empty( $columns_placement ) ) {
		$el_class .= ' dfd-row-content-' . $columns_placement;
	}
}

if  (isset($row_parallax_sense) && !empty($row_parallax_sense)) {
	$data_attr .= ' data-parallax_sense="'.esc_attr($row_parallax_sense).'"';
}

if  (isset($row_parallax_limit) && !empty($row_parallax_limit)) {
	$data_attr .= ' data-parallax_limit="'.esc_attr($row_parallax_limit).'"';
}

if  (isset($one_page_title) && !empty($one_page_title)) {
	$data_attr .= ' data-tooltip="'.esc_attr($one_page_title).'"';
}

if  (isset($anchor) && !empty($anchor)) {
	$row_id .= 'id="'.esc_attr($anchor).'"';
	$data_attr .= ' data-anchor="section-'.esc_attr($anchor).'"';
}

if  (isset($row_prebuilt_classes) && !empty($row_prebuilt_classes)) {
	$el_class .= ' '.$row_prebuilt_classes;
}

if($dfd_enable_overlay) {
	if(isset($dfd_overlay_color) && !empty($dfd_overlay_color)) {
		$overlay_html .= 'background-color: '.esc_attr($dfd_overlay_color).';';
	}
	if(isset($dfd_overlay_pattern) && !empty($dfd_overlay_pattern)) {
		$overlay_html .= 'background-image: url('.DFD_EXTENSIONS_PLUGIN_URL.'vc_custom/dfd_vc_background/patterns/'.esc_attr($dfd_overlay_pattern).');';
	}
	if(isset($dfd_overlay_pattern_opacity) && !empty($dfd_overlay_pattern_opacity)) {
		$overlay_html .= 'opacity: '.esc_attr($dfd_overlay_pattern_opacity/100).';';
	}
	if(isset($dfd_overlay_pattern_size) && !empty($dfd_overlay_pattern_size)) {
		$overlay_html .= 'background-size: '.esc_attr($dfd_overlay_pattern_size).'px;';
	}
	if(!empty($overlay_html))
		$overlay_html = '<div class="dfd-row-bg-overlay" style="'.$overlay_html.'"></div>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row vc-row-wrapper ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts ) );

if($row_custom_paddings == 'yes' && $row_columns_paddings != '') {
	$uniq_class = uniqid('vc-row-custom-paddings-');
	$css_class .= ' '.  $uniq_class;
	
	$row_custom_css .= '.'. $uniq_class .'.vc-row-wrapper .row {margin: 0 -'.(int)$row_columns_paddings / 2 .'px !important;}';
	$row_custom_css .= '.'. $uniq_class .'.vc-row-wrapper .row .columns {padding: 0 '.(int)$row_columns_paddings / 2 .'px !important;}';
	
}

$custom_styles = !empty($extra_css_styles) ? 'style="'.esc_attr($extra_css_styles).'"' : '';

$output .= '<div '.$row_id.' class="'.esc_attr($css_class).'" '.$data_attr.'>';

if(isset($dfd_bg_style) && !empty($dfd_bg_style)) {
	$file = DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/dfd_vc_background/front_templates/' . $dfd_bg_style . '.php';
	if(file_exists($file)) {
		include($file);
	}
}

$output .= '<div class="wpb_row row" '.$custom_styles.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

$output .= $overlay_html;

if(!isset($css_rules)) {
	$css_rules = $row_custom_css;
} else {
	$css_rules .= $row_custom_css;
}
	
if($css_rules != '') {
	$output .= '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
}

$output .= '</div>'.$this->endBlockComment('row');

echo $output;