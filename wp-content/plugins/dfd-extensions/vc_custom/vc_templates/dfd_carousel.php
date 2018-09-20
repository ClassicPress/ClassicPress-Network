<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(dfd_show_unsuport_nested_module_frontend("DFD Carousel")) return false;

$disabled_tags = array( 'vc_tab', 'vc_accordion_tab', 'info_list_item', 'ult_hotspot_items', 'info_circle_item', 'ultimate_icon_list_item', 'ult_ihover_item', 'dfd_service_item' );

/* General options */
$slider_type = $el_class = $arrows_bg =  $module_animation = $arrows_style = $dots_style = $animation_data = '';
$infinite_loop = $center_mode = $draggable = $touch_move = $rtl = $slides_to_show = $slides_to_scroll = $speed = $autoplay = $autoplay_speed = '';
/* Responsive options */
$screen_normal_resolution = $screen_normal_slides = $screen_tablet_resolution = $screen_tablet_slides = $screen_mobile_resolution = $screen_mobile_slides = '';
/* Navigation vars */
$arrows = $arrows_position = $arrow_style = $dots_color = $dots_color_unactive = $enable_counter = $arrows_always_show = $dots = '';
$atts = vc_map_get_attributes( 'dfd_carousel', $atts );
extract( $atts );

$enable_counter = "on";
$arrows_always_show = "on";

$uniqid = uniqid('dfd-carousel-');

$settings = $left_arrow_html = $right_arrow_html = $counter_html = $css_rules = '';
$el_class .= $arrow_use_navigation ? " show_navigation_number "  : " hide_navigatin_number ";

$settings .= 'arrows: false,';
$settings .= 'dotsClass: \'dfd-slick-dots\',';
$settings .= 'slidesToScroll: 1,';

if($autoplay == 'on') {
	$settings .= 'autoplay: true,';
	if($autoplay != '') {
		$settings .= 'autoplaySpeed: '.esc_js($autoplay_speed).',';
	}
}

if($slider_type != '')
	$el_class .= ' dfd-carousel-' . $slider_type;

if($arrows_position != '') {
	$el_class .= ' dfd-arrows_' . $arrows_position;
}

if($arrows_always_show == 'on') {
	$el_class .= ' dfd-keep-arrows';
}

if($dots_style != '') {
	$el_class .= ' ' . $dots_style;

	$arrow_style = Dfd_Theme_Slier_Helper::parse($atts);
	$el_class .= ' dfd-arrows-' . $arrows_style . ' dfd-arrows-enabled';
	
	$css_rules .= "#".$uniqid." a.dfd-slider-control:hover i{".$arrow_style["style-hover-icon"]."}";
	$css_rules .= "#".$uniqid." a.dfd-slider-control:hover{".$arrow_style["style-hover-bg"]."}";
	$css_rules .= "#".$uniqid." a.dfd-slider-control .count{".$arrow_style["style-navigation"]."}";
	
	$style_icon = 'style="'.$arrow_style["style-icon"].'"';
	$style_bg = 'style="'.$arrow_style["style-bg"].'"';
	$left_arrow_html .= '<i class="'.$arrow_style["icon_left"].'" '.$style_icon.'></i>';
	$right_arrow_html .= '<i class="'.$arrow_style["icon_right"].'" '.$style_icon.'></i>';	
}

if($module_animation != '') {
	$el_class .= ' cr-animate-gen';
	$animation_data .= 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

if($slider_type == 'vertical') {
	$settings .= 'vertical: true,';
}

if($dots == 'on' /* && $arrows_position != 'bottom_center'*/) {
	$settings .= 'dots: true,';
	$settings .=	'customPaging: function(slider, i) {
						return \'<span data-role="none" role="button" aria-required="false" tabindex="0"></span>\';
					},';
	$el_class .= ' dfd-dots-enabled';
} else {
	$settings .= 'dots: false,';
}

$infinite_loop = "on";
if($infinite_loop == 'on') {
	$settings .= 'infinite: true,';
} else {
	$settings .= 'infinite: false,';
}

if($center_mode == 'on' && $slider_type != 'vertical') {
	$settings .= 'centerMode: true,';
}

if($slides_to_show != '') {
	$settings .= 'slidesToShow: '.esc_js($slides_to_show).',';
}

if($speed != '') {
	$settings .= 'speed: '.esc_js($speed).',';
}

if($draggable == 'on') {
	$settings .= 'swipe: true,';
	$settings .= 'draggable: true,';
} else {
	$settings .= 'swipe: false,';
	$settings .= 'draggable: false,';

	if($touch_move == 'on') {
		$settings .= 'touchMove: true,';
	}
}

if($adaptive_height == 'on') {
	$settings .= 'adaptiveHeight: true,';
}

if($rtl == 'on') {
	$settings .= 'rtl: true,';
}

if($screen_normal_resolution == '') {
	$screen_normal_resolution == 1024;
}

if($screen_tablet_resolution == '') {
	$screen_tablet_resolution == 800;
}

if($screen_mobile_resolution == '') {
	$screen_mobile_resolution == 480;
}

if($screen_normal_slides != '' || $screen_tablet_slides != '' || $screen_mobile_slides != '') {
	$settings .= 'responsive: [';
	if($screen_normal_slides != '') {
		$settings .= '
				{
					breakpoint: '.esc_js($screen_normal_resolution).',
					settings: {
						slidesToShow: '.esc_js($screen_normal_slides).',
						slidesToScroll: 1,
					}
				},';
	}
	if($screen_tablet_slides != '') {
		$settings .= '
				{
					breakpoint: '.esc_js($screen_tablet_resolution).',
					settings: {
						slidesToShow: '.esc_js($screen_tablet_slides).',
						slidesToScroll: 1,
					}
				},';
	}
	if($screen_mobile_slides != '') {
		$settings .= '
				{
					breakpoint: '.esc_js($screen_mobile_resolution).',
					settings: {
						slidesToShow: '.esc_js($screen_mobile_slides).',
						slidesToScroll: 1,
					}
				},';
	}
	$settings .= ']';
}

if($enable_counter == 'on') {
	$counter_html .= '<span class="count"></span>';
}

if($arrows_bg != '' ) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-arrows-style_3 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_4 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_5 .dfd-slider-control {background: '.esc_js($arrows_bg).'}';
}

if($dots_color != '') {
	$css_rules .=	'#'.esc_js($uniqid).' .dfdrounded ul.dfd-slick-dots li.slick-active span:before, #'.esc_js($uniqid).' .dfdsquare ul.dfd-slick-dots li.slick-active span:before {background: '.esc_js($dots_color).'}'
					.'#'.esc_js($uniqid).' .dfdfillrounded ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdfillsquare ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).';border-color: '.esc_js($dots_color).';}'
					.'#'.esc_js($uniqid).' .dfdemptyrounded ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdemptysquare ul.dfd-slick-dots li.slick-active span {border-color: '.esc_js($dots_color).';}'
					.'#'.esc_js($uniqid).' .dfdline ul.dfd-slick-dots li.slick-active span:before {border-color: '.esc_js($dots_color).';}'
					.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).';}'
					.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li.slick-active span:before {background: '.esc_js($dots_color).';}'
					.'#'.esc_js($uniqid).' .dfdroundedempty  ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).'; border-color: '.esc_js($dots_color).';}'
					.'#'.esc_js($uniqid).' .dfdroundedfilled  ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).'; border-color: '.esc_js($dots_color).';}';
}
if($dots_color_unactive != '') {
	$css_rules .=	'#'.esc_js($uniqid).' .dfdrounded ul.dfd-slick-dots li:not(.slick-active) span:before, #'.esc_js($uniqid).' .dfdsquare ul.dfd-slick-dots li:not(.slick-active) span:before {background: '.esc_js($dots_color_unactive).'}'
					.'#'.esc_js($uniqid).' .dfdrounded ul.dfd-slick-dots li span,'.'#'.esc_js($uniqid).' .dfdrounded ul.dfd-slick-dots li.slick-active span:before {border-color: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdsquare ul.dfd-slick-dots li span,'.'#'.esc_js($uniqid).' .dfdsquare ul.dfd-slick-dots li.slick-active span:before {border-color: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdfillrounded ul.dfd-slick-dots li:not(.slick-active) span, #'.esc_js($uniqid).' .dfdfillsquare ul.dfd-slick-dots li:not(.slick-active) span {background: '.esc_js($dots_color_unactive).';border-color: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdemptyrounded ul.dfd-slick-dots li:not(.slick-active) span, #'.esc_js($uniqid).' .dfdemptysquare ul.dfd-slick-dots li:not(.slick-active) span {border-color: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdline ul.dfd-slick-dots li:not(.slick-active) span:before {border-color: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li:not(.slick-active) span {background: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li:not(.slick-active) span:before {background: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdroundedempty  ul.dfd-slick-dots li:not(.slick-active) span {background: '.esc_js($dots_color_unactive).'; border-color: '.esc_js($dots_color_unactive).';}'
					.'#'.esc_js($uniqid).' .dfdroundedempty  ul.dfd-slick-dots li:not(.slick-active) span:hover {background: transparent;}'
					.'#'.esc_js($uniqid).' .dfdroundedfilled  ul.dfd-slick-dots li:not(.slick-active) span {background: '.esc_js($dots_color_unactive).'; border-color: '.esc_js($dots_color_unactive).';}';
}

if($items_offset != '' && $slider_type != 'vertical') {
	$css_rules .= '#'.esc_js($uniqid).' > .dfd-carousel-module-wrapper > .dfd-carousel > .slick-list > .slick-track > .dfd-item-wrap > .cover {padding: '.esc_js($items_offset/2).'px;}';
}

echo '<div id="'.esc_attr($uniqid).'" class="dfd-carousel-wrapper">';
	echo '<div class="dfd-carousel-module-wrapper '.esc_attr($el_class).'" '.$animation_data.'>';
		echo '<div class="dfd-carousel">';
			if(method_exists('Dfd_Wrap_Shortcode','dfd_override_shortcodes')) {
				Dfd_Wrap_Shortcode::dfd_override_shortcodes($disabled_tags);
			}
			echo do_shortcode($content);
			if(method_exists('Dfd_Wrap_Shortcode','dfd_restore_shortcodes')) {
				Dfd_Wrap_Shortcode::dfd_restore_shortcodes();
			}
		echo '</div>';
		if($arrows == 'on') {
			echo '<a href="#" class="dfd-slider-control prev" '.$style_bg.' title="'.esc_attr__('Previous slide','dfd-native').'">'.$counter_html.$left_arrow_html.'</a>';
			echo '<a href="#" class="dfd-slider-control next" '.$style_bg.' title="'.esc_attr__('Next slide','dfd-native').'">'.$counter_html.$right_arrow_html.'</a>';
		}
	echo '</div>';
	
	?>
	<script type="text/javascript">
		(function($) {
			"use strict";
			<?php if($css_rules != '') { ?>
				$("head").append("<style><?php echo $css_rules ;?></style>");
			<?php } ?>
			var $carousel = $('#<?php echo esc_js($uniqid); ?>').find('.dfd-carousel');
			$(document).ready(function() {
				<?php if($arrows == 'on') {
					
					if($enable_counter == 'on') :  ?>
						var total_slides;
						$carousel.on('init reInit afterChange', function (event, slick, currentSlide) {
							var prev_slide_index, next_slide_index, current;
							var $prev_counter = $carousel.siblings('.dfd-slider-control.prev').find('.count');
							var $next_counter = $carousel.siblings('.dfd-slider-control.next').find('.count');
							total_slides = slick.slideCount;
							current = (currentSlide ? currentSlide : 0) + 1;
							prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
							next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
							$prev_counter.text(prev_slide_index + '/' + total_slides);
							$next_counter.text(next_slide_index + '/'+ total_slides);
						});
					<?php endif;
				} ?>
				$carousel.siblings('.dfd-slider-control.prev').click(function(e) {
					e.preventDefault();
					$carousel.slick("slickPrev");
				});
				$carousel.siblings('.dfd-slider-control.next').click(function(e) {
					e.preventDefault();
					$carousel.slick("slickNext");
				});
				$carousel.dfd_carousel_module({<?php echo $settings; ?>});
			});
		})(jQuery);
	</script>
<?php
echo '</div>';