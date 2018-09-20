<?php
if (!defined('ABSPATH')) {
	exit;
}

$style = $align = $testimonials = $title_font_options = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = $title_subtitle_nowrap = '';
$controls_html = $use_nav = $thumbs_html = $content_html = $title_html = $subtitle_html = $delimiter_html = $content_style = $quote_color = $quote_size = $quote_style = '';
$quote_hide = $icon_html = $image_style = $line_width = $line_border = $line_color = $delimiter_style = $line_hide = $thumb_size = $shadow = '';
$autoplay = $autoplay_speed = $draggable = $rtl = $infinite_loop = $nav_style = $bg_testim_block_color = $bg_radius = $show_triangle = '';
$el_class = $output = $module_animation = $dots_style = $link_css = $thumb_radius = $main_layout = $column = $use_google_fonts_subtitle = $custom_fonts_subtitle = $use_google_fonts_testimonial = $custom_fonts_testimonial = '';
$_autoplay = isset($atts["autoplay"]) ? $atts["autoplay"] == "show" ? "true" : "false" : "true";

$shadow = "show";
$use_dots = "show";
$use_nav = "show";
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$uniqid = uniqid('testimonial-slider');

if (!isset($main_layout) || $main_layout == '') {
	$main_layout = 'layout-1';
}

if (!isset($style) || $style == '') {
	$style = 'above';
}

if (!isset($align) || $align == '') {
	$align = 'center';
}

if (!isset($autoplay) || $autoplay == '') {
	$autoplay = 'false';
}

if (!isset($autoplay_speed) || $autoplay_speed == '') {
	$autoplay_speed = '5000';
}

if (!isset($draggable) || $draggable == '') {
	$draggable = 'false';
}

$use_dots = $use_dots == "show" ? true : false;

if (!isset($thumb_size) || $thumb_size == '') {
	$thumb_size = '90';
}
if($show_triangle == "show"){
	$show_triangle = true;
}else{
	$show_triangle = false;
}

$no_image = DFD_EXTENSIONS_PLUGIN_URL .'assets/img/no-user.png';

$el_class .= ' ' . $style . ' ';
$el_class .= ' align-' . $align;

if(isset($title_subtitle_nowrap) && $title_subtitle_nowrap == 'nowrap') {
	$el_class .= ' title-subtitle-nowrap';
}

/* * ************************
 * Appear Animation
 * *********************** */

$animation_data = '';

if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

if ($dots_style != '')
	$el_class .= ' ' . $dots_style . ' ';
/* * ************************
 * Typography options
 * *********************** */
$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle', $use_google_fonts_subtitle, $custom_fonts_subtitle);
$testimonial_text_options = _dfd_parse_text_shortcode_params($font_options, 'dfd-testimonial-content', $use_google_fonts_testimonial, $custom_fonts_testimonial);

/* * ************************
 * Delimiter HTML.
 * *********************** */

if ($line_width || $line_border || $line_color) {
	$delimiter_style .= 'style="';
	if ($line_width !="") {
		$delimiter_style .= 'width:' . $line_width . 'px;';
	}
	if ($line_border!="") {
		$delimiter_style .= 'border-width:' . $line_border . 'px;';
	}
	if ($line_color) {
		$delimiter_style .= 'border-color:' . $line_color;
	}
	$delimiter_style .= '"';
}

$show_triangle = $show_triangle ? "show_triangle" : "";
/* * ************************
 * Quote HTML.
 * *********************** */

if ($quote_color || $quote_size) {
	$quote_style .= 'style="';
	if (!empty($quote_color)) {
		$quote_style .= 'color:' . $quote_color . ';';
	}
	if (!empty($quote_size)) {
		$quote_style .= 'font-size:' . $quote_size . 'px';
	}
	$quote_style .= '"';
}

if ('1' !== $quote_hide) {
	$icon_html .= '<span class="icon-wrap"><i class="navicon-quote-right" ' . $quote_style . '></i></span>';
}

/* * ************************
 * parse array of items.
 * *********************** */

if (function_exists('vc_param_group_parse_atts')) {
	$testimonials = (array) vc_param_group_parse_atts($testimonials);
}

/* * ************************
 * Testimonials thumbs.
 * *********************** */

if (!empty($thumb_radius) || $thumb_radius !="") {
	$image_style .= 'style="border-radius:' . $thumb_radius . 'px;"';
}
if (!empty($shadow)) {
	$shadow = 'enable-shadow';
}

$right_style = '';
$rtl = 'false';
$style_width_thumb_below = '';
$nav_style = ' width: ' . ( ( intval($thumb_size) + 29) * 3 ) . 'px;';


if (strcmp($style, 'below') === 0) {
	$nav_style = ' width: ' . ( ( intval($thumb_size) + 55 + 20 ) * 3 ) . 'px;';
	$style_width_thumb_below = 'style="width: ' . (intval($thumb_size) + 55) . 'px;"';
}
/*
 * styles
 */
$slider_options_config = array ();
$slider_options_config["draggable"] = $draggable;
$slider_options_config["variableWidth"] = "false";
$slider_options_config["centered_content"] = "false";
$slider_options_config["centered_thumb"] = "false";
$slider_options_config["centerPadding"] = "";
switch ($main_layout) {
	case "layout-1":
		if($use_nav == "show"){
			$column = "ten";
		}else{
			$column = "twelve"; 
		}

		break;
	case "layout-2":
		$slider_options_config["draggable"] = "false";
		$slider_options_config["variableWidth"] = "true";
		$slider_options_config["centered_content"] = "false";
		$slider_options_config["centered_thumb"] = "true";
		if($use_nav == "show"){
			$column = "ten";
		}else{
			$column = "twelve"; 
		}
		break;
	case "layout-3":
		$column = "twelve";
		if (count($testimonials) > 1) {
			$column = "four";
			$slider_options_config["centered_content"] = "true";
			$slider_options_config["centered_thumb"] = "true";
			$slider_options_config["centerPadding"] = "0px";
		}
		break;

	default:
		if($use_nav == "show"){
			$column = "ten";
		}else{
			$column = "twelve"; 
		}
		break;
}

$images_lazy_load = false;

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$images_lazy_load = true;
	$el_class .= ' dfd-img-lazy-load ';
	$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $thumb_size $thumb_size'%2F%3E";
}

/*
 * Images
 */
foreach ($testimonials as $testimonial) {
	$thumb = '';
	$testimonial_title = isset($testimonial['title']) ? $testimonial['title'] : "";
	if (isset($testimonial['client_photo'])) {
		$thumb = $testimonial['client_photo'];
		$image_src = wp_get_attachment_image_src($testimonial['client_photo'], 'full');
		$image_url = dfd_aq_resize($image_src[0], $thumb_size * 1.5, $thumb_size * 1.5, true, true, true);
		if(!$image_url) {
			$image_url = $image_src[0];
		}
	} else {
		$image_url = $no_image;
	}
	
	$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_url, $thumb, $thumb_size, $thumb_size, $testimonial_title);
	
	$thumbs_html .= '<a class="thumb" ' . $style_width_thumb_below . '>';
	if($images_lazy_load) {
		$thumbs_html .= '<img src="'.$loading_img_src.'" data-src="' . $image_url . '" width="' . esc_attr(floor($thumb_size)) . '" height="' . esc_attr(floor($thumb_size)) . '" '.$img_atts.' ' . $image_style . '/>';
	} else {
		$thumbs_html .= '<img src="' . $image_url . '" width="' . esc_attr(floor($thumb_size)) . '" height="' . esc_attr(floor($thumb_size)) . '" '.$img_atts.' ' . $image_style . '/>';
	}
	if ('below' === $style) {

		$thumbs_html .='<div class="below-title">';
		if (isset($testimonial['title'])) {
			$thumbs_html .= '<' . $title_options['tag'] . ' class="testimonial-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html($testimonial['title']) . '</' . $title_options['tag'] . '>';
		}
		if (isset($testimonial['subtitle'])) {
			$thumbs_html .= '<' . $subtitle_options['tag'] . ' class="testimonial-subtitle ' . $subtitle_options['class'] . '"  ' . $subtitle_options['style'] . '>' . esc_html($testimonial['subtitle']) . '</' . $subtitle_options['tag'] . '>';
		}
		$thumbs_html .= '</div>';
	}
	$thumbs_html .= '</a>';
}

$controls_html .= '<div class="testimonials-thumbs-wrap ' . $shadow . '" style="' . $nav_style . '"  ' . $right_style . '>';
$controls_html .= '<div class="testimonials-thumbs-slider">';
$controls_html .= $thumbs_html;
$controls_html .= '</div>';
$controls_html .= '</div>';

/* * ************************
 * background content.
 * *********************** */
$content_bg = "";
$has_bg = "";
if (!empty($bg_radius) || $bg_radius!="" ||  !empty($bg_testim_block_color) || $bg_testim_block_color!="") {
	$content_bg .= 'style="';
	if ($bg_radius!="") {
		$content_bg .= ' border-radius:' . esc_attr($bg_radius) . 'px; ';
	}
	if ($bg_testim_block_color !="") {
		$has_bg = "has_bg";
		$link_css .= '#'.esc_js($uniqid).'.dfd-testimonial-slider .testimonials-slider .content-wrap-bg,'
					. '#'.esc_js($uniqid).'.dfd-testimonial-slider .testimonials-slider .content-wrap-bg .triangle:before {background-color:' . esc_js($bg_testim_block_color) . ';}';
	}
	$content_bg .= '"';
}
/* * ************************
 * Content.
 * *********************** */
$content_html .= '<div class="testimonials-content-wrap" ' . $right_style . '>';
if (count($testimonials) > 1) {
	
	if($use_nav == "show"){
		$arrow_style = Dfd_Theme_Slier_Helper::parse($atts);
		$link_css .= "#" . $uniqid . " .slick-arrow-b:hover .icon-arrow{" . $arrow_style["style-hover-icon"] . "}";
		$link_css .= "#" . $uniqid . " .slick-arrow-b:hover{" . $arrow_style["style-hover-bg"] . "}";
		$link_css .= "#" . $uniqid . " .slick-arrow-b .t_stats{" . $arrow_style["style-navigation"] . "}";
		$link_css .= "#" . $uniqid . ".below  {" . $arrow_style["padding_top"] . "}";
		$style_icon = 'style="' . $arrow_style["style-icon"] . '"';
		$style_bg = 'style="' . $arrow_style["style-bg"] . '"';
			$content_html .='<div class="navigation_arrows">'
					   . '<span class="slick-arrow-b slick-prev " ' . $style_bg . '><span class="icon-arrow ' . $arrow_style["icon_left"] . '" ' . $style_icon . '></span></span>'
					   . '<span class="slick-arrow-b slick-next " ' . $style_bg . '><span class="icon-arrow ' . $arrow_style["icon_right"] . '" ' . $style_icon . '></span></span>'
					   . '</div>';
	}

}
if (!empty($quote_size)) {
	$content_style .= 'style="min-height:' . $quote_size . 'px"';
}
$content_html .= '<div class="testimonials-slider">';
$counter = 0;
foreach ($testimonials as $single_testimonial) {
	/*
	 * add default text if all content is empty
	 */
	$is_empty_all = true;
	if (isset($single_testimonial['testimonial_text']) && trim($single_testimonial['testimonial_text']) != "") {
		$is_empty_all = false;
	}
	if (isset($single_testimonial['title']) && trim($single_testimonial['title']) != "") {
		$is_empty_all = false;
	}
	if (isset($single_testimonial['subtitle']) && trim($single_testimonial['subtitle']) != "") {
		$is_empty_all = false;
	}
	if ($is_empty_all) {
		$single_testimonial['testimonial_text'] = esc_html__("Enter text here", 'dfd-native');
	}

	$content_html .= '<div class="testimonials-content">';
	$content_html .= '<div class="text-wrap" ' . $content_style . '>';
	$content_html .= '<div class="content-wrap-bg" ' . $content_bg . '><span class="triangle hide"></span></div>';

	if (isset($single_testimonial['testimonial_text']) && !empty($single_testimonial['testimonial_text'])) {
		$content_html .= '<div class="testimonial-text ' . $testimonial_text_options['class'] . '" ' . $testimonial_text_options['style'] . '>' . strip_tags($single_testimonial['testimonial_text'], "<br><br/>") . '</div>';
	}
	$content_html .= '</div>';
	if ('above' === $style) {


		if (isset($single_testimonial['title'])) {
			$content_html .= '<' . $title_options['tag'] . ' class="testim-slider-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html($single_testimonial['title']) . '</' . $title_options['tag'] . '>';
		}
		if (isset($single_testimonial['subtitle'])) {
			$content_html .= '<' . $subtitle_options['tag'] . ' class="testim-slider-subtitle ' . $subtitle_options['class'] . '"  ' . $subtitle_options['style'] . '>' . esc_html($single_testimonial['subtitle']) . '</' . $subtitle_options['tag'] . '>';
		}
	}


	$content_html .= '</div>';
	$counter++;
}
$content_html .= '</div>';
$content_html .= '</div>';

/* * ************************
 * Module
 * *********************** */


if ('center' === $align) {
	$centered_slider = 'true';
} else {
	$centered_slider = 'false';
}
if ('' !== trim($draggable)) {
	$draggable = 'true';
	$cls_draggable = " draggable ";
} else {
	$cls_draggable = "";
	$draggable = "false";
}
if (( 'center' === $align ) && ( $counter > 2 )) {
	$start_from = absint($counter / 2);
} else {
	$start_from = '0';
}

$output .= '<div id="' . esc_attr($uniqid) . '" class="dfd-testimonial-slider  ' . $show_triangle . ' ' . $el_class . ' ' . $main_layout . ' ' . $has_bg . ' ' . $cls_draggable . '"
				data-autoplay="' . $_autoplay . '"
				data-centered="' . $centered_slider . '"
				data-autoplay_speed="' . $autoplay_speed . '"
				data-draggable="' . $draggable . '"
				data-start_slide="' . $start_from . '"
				data-rtl="' . $rtl . '"
				' . $animation_data . '
				>';
if($link_css != '') {
	$output .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$link_css.'</style>");'
					. '})(jQuery);'
				. '</script>';
}
$output .= '<div class="wrap_testimonials ' . $column . '">';
if ('above' === $style) {
	$output .= $controls_html;
	$output .= $content_html;
} else {
	$output .= $content_html;
	$output .= $controls_html;
}
$output .= '</div>';

ob_start();
?>
<script type="text/javascript">
	(function($){
		"use strict";
		var $carousel = $('#<?php echo esc_js($uniqid); ?>');
		$(document).ready(function(){
			var use_dots_conttent = <?php echo $style == "above" ? $use_dots ? "true" : "false" : "false" ?>;
			var use_dots_thumb = <?php echo $style == "above" ? "false" : !$use_dots ? "false" : "true" ?>;
			var options = {
			};
			options.obj = $carousel;
			try {
				var dfd_T_S = new dfd_testimnials_slider(options);

				$carousel.find('.testimonials-slider').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: true,
					dotsClass: 'dfd-slick-dots',
					customPaging: function(slider, i){
						return '<span data-role="none" role="button" aria-required="false" tabindex="0"></span>';
					},
					appendArrows: $carousel.find(".testimonials-content-wrap"),
					dots: use_dots_conttent,
					fade: false,
					asNavFor: $carousel.find('.testimonials-thumbs-slider'),
					centerPadding: '<?php echo $slider_options_config["centerPadding"]; ?>',

					centerMode: <?php echo $slider_options_config["centered_content"]; ?>,
					autoplay: $carousel.data('autoplay'),
					autoplaySpeed: $carousel.data('autoplay_speed'),
					draggable: $carousel.data('draggable'),
					infinite: true,
					rtl: $carousel.data('rtl'),
					initialSlide: 0

				});
				$carousel.find('.testimonials-thumbs-slider').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					asNavFor: $carousel.find('.testimonials-slider'),
					dots: use_dots_thumb,
					arrows: false,
					dotsClass: 'dfd-slick-dots',
					customPaging: function(slider, i){
						return '<span data-role="none" role="button" aria-required="false" tabindex="0"></span>';
					},
					centerPadding: '<?php echo $slider_options_config["centerPadding"]; ?>',
					variableWidth: <?php echo $slider_options_config["variableWidth"]; ?>,
					draggable: <?php echo $slider_options_config["draggable"]; ?>,
					centerMode: <?php echo $slider_options_config["centered_thumb"]; ?>,
					initialSlide: 0,
					focusOnSelect: true,
					rtl: $carousel.data('rtl')
				});
				var s = $carousel.find('.testimonials-thumbs-slider').slick("getSlick");
				dfd_T_S.init(s);

				$carousel.on('afterChange', function(event, slick, currentSlide, nextSlide){
					dfd_T_S.init(slick);
				});
			} catch(err) {
				console.log(err);
			}
		});
	})(jQuery);
</script>
<?php
$output .= ob_get_clean();
$output .= '</div>';
echo $output;
