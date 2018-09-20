<?php

if (!defined('ABSPATH')) {
	exit;
}

$html = $left_image_html = $right_image = $left_image = $right_image_html = $data_atts = $pointer_html = $css_rules = '';

$uniqid = uniqid('dfd-slide-parallax-');

$atts = vc_map_get_attributes('dfd_slide_parallax', $atts);
extract($atts);

wp_enqueue_script('dfd_slide_parallax');

$direction = (isset($direction) && $direction != '') ? $direction : 'horizontal';

$el_class .= ' dfd-slide-parallax-' . $direction;
$data_atts .= ' data-direction="' . esc_attr($direction) . '" ';

if (isset($delim_width) && $delim_width != '') {
	$prop = ($direction == 'horizontal') ? array ('width', 'margin-left') : array ('height', 'margin-top');
	$css_rules .= esc_js($prop[0]) . ': ' . esc_js($delim_width) . 'px;';
	$css_rules .= esc_js($prop[1]) . ': -' . esc_js($delim_width / 2) . 'px;';
}

if (isset($delim_bg) && $delim_bg != '')
	$css_rules .= 'background: ' . esc_js($delim_bg) . ';';

if (isset($module_animation) && !empty($module_animation)) {
	$el_class .= ' cr-animate-gen';
	$data_atts .= ' data-animate-item=".images-wrap" data-animate-type="' . esc_attr($module_animation) . '" ';
}

if (isset($image_first) && !empty($image_first)) {
	$left_image = Dfd_Theme_Helpers::generate_images_html($image_first, $image_width, $image_height);
} else {
	$left_image = "<img src='" . Dfd_Theme_Helpers::default_noimage_url() . "' alt='' />";
}
$left_image_html .= '<div class="image-wrap image-left">';
$left_image_html .= $left_image;
$left_image_html .= '</div>';

if (isset($image_second) && !empty($image_second)) {
	$right_image .= Dfd_Theme_Helpers::generate_images_html($image_second, $image_width, $image_height);
} else {
	$right_image .= "<img src='" . Dfd_Theme_Helpers::default_noimage_url() . "' alt=''>";
}
$right_image_html .= '<div class="image-wrap image-right">';
$right_image_html .= $right_image;
$right_image_html .= '</div>';

if (isset($marker) && !empty($marker)) {
	$pointer_html .= Dfd_Theme_Helpers::generate_images_html($marker, false, false);
} else {
	$img_src = DFD_EXTENSIONS_PLUGIN_URL . "vc_custom/assets/images/pipka2.png";
	$pointer_html .='<img src="' . $img_src . '" height="27" width="27" alt="marker">';
}
$html .= '<div class="dfd-slide-parallax-wrap ' . esc_attr($el_class) . '" ' . $data_atts . '>';

$html .= '<div id="' . esc_attr($uniqid) . '" class="images-wrap dfd-slide-parallax-image-wrapper">';

if ($left_image_html == '' || $left_image_html == '') {
	$html .= '<h2 class="widget-title">' . esc_html__('The images are required for this shortcode. Please upload or select images from media library in shortcode settings', 'dfd-native') . '</h2>';
} else {
	$html .= '<div>';
		$html .= $left_image_html . $right_image_html;

		$html .= '<div class="handler">';
			$html .= '<span class="pointer">';
				$html .= $pointer_html;
			$html .= '</span>';
		$html .= '</div>';
	$html .= '</div>';
}

$html .= '</div>';

if ($css_rules != '') {
	$html .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>#' . esc_js($uniqid) . ' .handler {' . $css_rules . '}</style>");'
					. '})(jQuery);'
				. '</script>';
}

$html .= '</div>';

echo $html;
