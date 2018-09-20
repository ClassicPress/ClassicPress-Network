<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } 

$icon_type = $icon_image_id = $modal_box_title = $modal_box_content = $el_class = $modal_box_size = $modal_box_width = '';
$overlay_bg = $overlay_opacity = $header_bg = $content_bg = $color_background = $image_background = $modal_border = $modal_radius =  $modal_border_width = $modal_border_color = '';
$title_font_options = $use_google_fonts = $custom_fonts = $content_font_options = $content_google_fonts = $content_custom_fonts = '';
$output = $title_html = $img_src = $link_css = $module_animation = $animation_data = $dark_bg = '';
$modal_desc = $modal_image = $modal_img_src = $time_output = $display_options = $img_src = $data_img = $modal_tb_padding = $modal_lr_padding = '';
// button
$button_text = $button_alignment = $padding_left = $padding_right = $text_color = $text_hover_color = $background = $hover_background = '';
$border = $hover_border = $box_shadow = $hover_box_shadow = $button_font_options = $button_google_fonts = $button_custom_fonts = $button_animation = $button_text_html = $button_style = $animation_data_button = '';
$unique_class = '';

$atts = vc_map_get_attributes('dfd_modal_box', $atts);
extract($atts);

$output_uid = uniqid('dfd-modal-display').'-'.rand(1,9999);
$uniqid_box = uniqid('dfd-modal-box').'-'.rand(1,9999);
$uniqid_btn = uniqid('dfd-modal-btn').'-'.rand(1,9999);


if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-item="'.esc_attr($uniqid_box).'" data-animate-type = "' . esc_attr($module_animation) . '" ';
}


/******************
 * Size Modal Box
******************/
if (isset($modal_box_width) && ! empty($modal_box_width)) {
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap  {width: '.esc_js($modal_box_width).'px; }';
}


if(function_exists('wpb_js_remove_wpautop')) {
	$shortcode = wpb_js_remove_wpautop($content, true);
} else {
	$shortcode = do_shortcode($content);
}

//Paddings
if(isset($modal_tb_padding) && $modal_tb_padding != '') {
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {padding-top: '.esc_js($modal_tb_padding).'px; padding-bottom: '.esc_js($modal_tb_padding).'px; }';
}
if(isset($modal_lr_padding) && $modal_lr_padding != '') {
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {padding-left: '.esc_js($modal_lr_padding).'px; padding-right: '.esc_js($modal_lr_padding).'px; }';
}

// Background
if(isset($overlay_bg) && $overlay_bg !== '') {
	$link_css .= '#'.esc_js($uniqid_box).'.dfd-modal-box-overlay {background: '.esc_js($overlay_bg).'; }';
}

if(isset($dark_bg) && !empty($dark_bg)){
	$el_class .= ' dfd-background-dark';
}
if(isset($content_bg) && $content_bg == 'color-background' && isset($color_background) && !empty($color_background)){
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {background: '.esc_js($color_background).'; }';
}

if(isset($content_bg) && $content_bg == 'image-background' && isset($image_background) && !empty($image_background)){
	$img_src = wp_get_attachment_image_src($image_background, 'full');
	if(!$img_url) {
		$img_url = $img_src[0];
	}
	$data_img = 'with-image';
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-modal-box-shortcode {background-image: url('.esc_js($img_url).'); }';
}

/********************
 *  Border settings
 *******************/
if(isset($modal_border) && !empty($modal_border) || isset($modal_border_width) && !empty($modal_border_width) || isset($modal_border_color) && !empty($modal_border_color)){
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap {border-style: '.esc_js($modal_border).'; border-width: '.esc_js($modal_border_width).'px; border-color: '.esc_js($modal_border_color).';}';
	$link_css .= '#'.esc_js($uniqid_box).' .dfd-modal-box-cover .dfd-modal-box-wrap .dfd-socicon-cross-24 {top: -'.esc_js($modal_border_width).'px; padding-left: '.(esc_js($modal_border_width) + 20).'px;}';
}

/********************
 *  Button settings
 *******************/
// Animation
if(!($button_animation == '')) {
	$animation_data_button = ' data-animate="1" data-animate-type = "' . esc_attr($button_animation) . '" ';
}

//Alignment
if(isset($button_alignment) && $button_alignment != '') {
	$button_style .= ''.$button_alignment;
}

// Text
if(isset($button_text) && !empty($button_text)) {
	$button_font_options = _dfd_parse_text_shortcode_params($button_font_options, '', $button_google_fonts, $button_custom_fonts);
	$button_text_html = '<span class="dfd-button-text" >'.esc_html($button_text).'</span>';
}

// Text color
if(isset($text_color) && !empty($text_color)) {
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:not(:hover) {color: '.esc_js($text_color).';}';
}
if(isset($text_hover_color) && !empty($text_hover_color)) {
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover {color: '.esc_js($text_hover_color).';}';
}

// Background
if(isset($background) && !empty($background)) {
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:not(:hover) {background: '.esc_js($background).';}';
}
if(isset($hover_background) && !empty($hover_background)) {
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover {background: '.esc_js($hover_background).';}';
}

//Paddings
if(isset($padding_left) && $padding_left != '') {
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap {padding-left: '.esc_js($padding_left).'px;}';
}
if(isset($padding_right) && $padding_right != '') {
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap {padding-right: '.esc_js($padding_right).'px;}';
}

//Border
if(isset($border) && $border != '') {
	$border_css = Dfd_Border_Param::border_css($border);
	if(substr_count($border_css,'border-radius:') > 0) {
		$border_radius = substr($border_css,stripos($border_css,'border-radius:'));
		if($border_radius != '')
			$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap {'.$border_radius.'}';
	}
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:not(:hover) .dfd-btn-border {'.$border_css.'}';	
}
if(isset($hover_border) && $hover_border != '') {
	$hover_border_css = Dfd_Border_Param::border_css($hover_border);
	if(substr_count($hover_border_css,'border-radius:') > 0) {
		$hover_border_radius = substr($hover_border_css,stripos($hover_border_css,'border-radius:'));
		if($hover_border_radius != '')
			$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover {'.$hover_border_radius.'}';
	}
	$link_css .= '#'.esc_js($uniqid_btn).'.dfd-btn-open-modal-box .dfd-btn-wrap:hover .dfd-btn-border {'.$hover_border_css.'}';	
}

//Shadow
if(substr_count($box_shadow, 'disable') == 0) {
	$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
	$link_css .= '#'.esc_js($uniqid_btn).' .dfd-btn-wrap:not(:hover) {'.esc_attr($box_shadow).'}';
}
if(substr_count($hover_box_shadow, 'disable') == 0) {
	$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
	$link_css .= '#'.esc_js($uniqid_btn).' .dfd-btn-wrap:hover {'.esc_attr($hover_box_shadow).'}';
}


/***************
 * HTML
***************/
	if(isset($display_options)) {
		if($display_options == "show_scroll") {
			$output .= '<div id="'.esc_attr($output_uid).'" class="output-display call-on-waypoint"></div>'; // for output on the scrolls
		}
		if ($display_options == "on_click") {
			$output .= '<div id="'.  esc_js($uniqid_btn).'" class="dfd-btn-open-modal-box '.esc_attr($button_style).'" '.$animation_data_button.'>';
				$output .= '<div class="dfd-btn-wrap button" '.$button_font_options['style'].'>';
					$output .= $button_text_html;
					$output .= '<span class="dfd-btn-border"></span>';
				$output	.= '</div>';
			$output .= '</div>';
			
			$unique_class .= ''.$uniqid_btn;
		} else {
			$unique_class .= ''.$uniqid_box;
		}
	}

	
	$output .= '<div id="'.esc_attr($uniqid_box).'" class="dfd-modal-box-overlay '.esc_attr($unique_class).'">';
		$output .= '<div class="dfd-modal-box-cover '.esc_attr($el_class).' '.esc_attr($unique_class).'" '.$animation_data.'>';
			$output .= '<div class="dfd-modal-box-wrap">'; 
			$output .= '<i class="dfd-socicon-cross-24"></i>';
				$output .= '<div class="dfd-modal-box-shortcode '.esc_attr($data_img).'">';
					$output .= $shortcode;
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';
	
	
if(!empty($link_css)) {
	$output .=	'<script type="text/javascript">
					(function($) {
						$("head").append("<style>'. esc_js($link_css) .'</style>");
					})(jQuery);
				</script>';
};
?>

	<script type="text/javascript">
		(function($) {
			"use strict";
			$(document).ready(function() {
				$('.dfd-modal-box-overlay').appendTo(document.body);
				function setcookie(a,b,c) {
					if(c){
						var d = new Date();
						d.setTime(d.getTime()+c);
					}
					if(a && b) {
						document.cookie = a+'='+b+(c ? '; expires='+d.toUTCString() : '');
					} else {
						return false;
					}
				}
				function getcookie(a) {
					var b = new RegExp(a+'=([^;]){1,}');
					var c = b.exec(document.cookie);
					if(c) {
						c = c[0].split('=');
					} else {
						return false;
					}
					return c[1] ? c[1] : false;
				}
				
				var overlay_id = $('#<?php echo esc_js($uniqid_box); ?>.dfd-modal-box-overlay');
				var box_id = $('#<?php echo esc_js($uniqid_box); ?> .dfd-modal-box-cover');
				var uniqclass_overlay = '.dfd-modal-box-overlay.<?php echo esc_attr($unique_class);?>';
				var uniqclass_box = '.dfd-modal-box-cover.<?php echo esc_attr($unique_class);?>';
				
				
				var modalBoxResponsive = function() {
					var windowHeight = $(window).height();
					var modalHeight = $('.dfd-modal-box-wrap.open-modal').height();
					if (modalHeight > windowHeight) {
						box_id.addClass('scroll-show');
						$('.dfd-modal-box-wrap.open-modal').addClass('height-resize');
					} else if (modalHeight < windowHeight) {
						box_id.removeClass('scroll-show');
						$('.dfd-modal-box-wrap.open-modal').removeClass('height-resize');
					}
				}
				
				<?php if ($display_options == 'show_scroll') { ?>
					if(!getcookie('Modal-box-scroll')) {
						setcookie('Modal-box-scroll',true);
						$('#<?php echo esc_js($output_uid); ?>').on('on-waypoin', function () {
							if ( !overlay_id.hasClass('one-animation') ){
								overlay_id.addClass('one-animation');
								overlay_id.css({'visibility':'visible', 'opacity': '1'}, 500);
							}
							if ( !box_id.hasClass('one-animation') ){
								box_id.addClass('one-animation');
								var $anim = box_id.data('animate-type');
								setTimeout(function(){
									box_id.find('.dfd-modal-box-wrap').addClass('open-modal');
									box_id.css('visibility','visible').velocity($anim,{display:'auto'});
									modalBoxResponsive();
								}, 500);
							}
						});
					}
				<?php }; ?>
				<?php if ($display_options == 'set_timeout') { ?>	
					if(!getcookie('Modal-box-timeout')) {
						setcookie('Modal-box-timeout',true);
						setTimeout(function(){
							overlay_id.css({'visibility':'visible', 'opacity': '1'}, 500);
							var $animation = $('.dfd-modal-box-cover').data('animate-type');
							setTimeout(function(){
								box_id.find('.dfd-modal-box-wrap').addClass('open-modal');
								box_id.css({'visibility': 'visible'}).velocity($animation,{display:'auto'});
								modalBoxResponsive();
							}, 500);
						}, <?php echo esc_js($time_output); ?>);
					}	
				<?php }; ?>
				<?php if ($display_options == 'on_click') { ?>
					$(document).on('click', '#<?php echo esc_js($uniqid_btn);?> .dfd-btn-wrap', function(){
						$(uniqclass_overlay).css({'visibility':'visible', 'opacity': '1'}, 500);
						var $anim = $(uniqclass_box).data('animate-type');
						setTimeout(function(){
							box_id.find('.dfd-modal-box-wrap').addClass('open-modal');
							$(uniqclass_box).css('visibility','visible').velocity($anim,{display:'auto'});
							modalBoxResponsive();
						}, 500);
					});
				<?php }; ?>	
				$(document).on('click', uniqclass_box, function(){
					box_id.find('.dfd-modal-box-wrap').removeClass('open-modal');
					$(uniqclass_box).velocity('reverse', 500).css({'visibility': 'hidden'});
					setTimeout(function(){
						$(uniqclass_overlay).css({'visibility': 'hidden', 'opacity': '0'}, 500);
					}, 500);
				}); 
				$(document).on('click', '.dfd-modal-box-shortcode', function(event){
					event.stopPropagation();
				});
				$(window).on('resize', modalBoxResponsive);
			});	
		})(jQuery);
	</script>

<?php
echo $output;