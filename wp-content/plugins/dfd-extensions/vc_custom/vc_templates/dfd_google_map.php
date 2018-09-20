<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

ob_start();

$size = $img_link_target = $zoom = $touch_on_mobile = $enable_zoom = $marker_image = $map_markers = $el_class = $map_style = $module_animation = $block_html = $css_rules = $tooltip_bg_color = $tooltip_text_color = '';
$x_pan = $y_pan =  "";
$atts = vc_map_get_attributes('dfd_google_map', $atts);
extract($atts);

wp_enqueue_script('gmaps');
wp_enqueue_script('dfd_gmap');

if ($size == '') {
	$size = 450;
}

$unique_id = uniqid("map_");
$location_list = (array) vc_param_group_parse_atts($location_list);

$explodedByBr = explode('\n', $map_markers);

/**
 * Marker image
 */
$marker_def_image_src = $marker_image_src = 'http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png';
if (!empty($marker_image)) {
	$marker_image_src = wp_get_attachment_image_src($marker_image, 'full');
	$marker_image_src = $marker_image_src[0];
}
/**
 * Styles
 */
if (isset($map_style)) {
	$styleVal = Dfd_Theme_Helpers::dfd_get_map_style($map_style);
} else {
	$styleVal = false;
}
/**
 * Enable zoom
 */
if (!isset($enable_zoom) || $enable_zoom != 'true') {
	$enable_zoom = 'false';
}

/**
 * Touch on mobile
 */
$touch_on_mobile = $touch_on_mobile == "show" ? "true" : "false";


/**
 * Animation
 */
$animate = $animation_data = '';

if (!( $module_animation == '' )) {
	$animate = ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

/**
 * Tooltip text color
 */
if (isset($tooltip_text_color) && $tooltip_text_color != ''){
	$css_rules .= '#' . esc_js($unique_id) . ' .aligned .gm-style-iw div div{color: ' . esc_attr($tooltip_text_color) . ';}';
	$css_rules .= '#' . esc_js($unique_id) . ' .aligned .gm-style-iw div .map-title{color: ' . esc_attr($tooltip_text_color) . ';}';
	$css_rules .= '#' . esc_js($unique_id) . ' .aligned .gm-style-iw div .map-content{color: ' . esc_attr($tooltip_text_color) . ';}';
	$css_rules .= '#' . esc_js($unique_id) . ' .gm-style-iw + div:before, #' . esc_js($unique_id) . ' .gm-style-iw + div:after{background: ' . esc_attr($tooltip_text_color) . ';}';
}
/**
 * Tooltip bg color
 */
if (isset($tooltip_bg_color) && $tooltip_bg_color != '') {
	$css_rules .= '#' . esc_js($unique_id) . ' .gmap-infowindows-style{background-color: ' . esc_attr($tooltip_bg_color) . ';}';
	$css_rules .= '#' . esc_js($unique_id) . ' .gmap-infowindows-style > div:nth-child(3) div > div {background-color: ' . esc_attr($tooltip_bg_color) . ' !important;}';
	$css_rules .= '#' . esc_js($unique_id) . ' .gm-style-iw div div{background-color: ' . esc_attr($tooltip_bg_color) . ';}';
}

/**
 * Typography
 */
$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'widget-title', $title_google_fonts, $title_custom_fonts);
$css_rules .= '#' . esc_js($unique_id) . ' .gm-style-iw div div{' . esc_attr($title_options["style"]) . '}';
$css_rules .= '#' . esc_js($unique_id) . ' .gm-style-iw div div .map-title{' . esc_attr($title_options["style"]) . '}';


$infobox_alignment = (isset($infobox_alignment) && !empty($infobox_alignment)) ? $infobox_alignment : 'left-aligned';

/**
 * User Map Pan
 */
$x_pan  = $x_pan ? (int)$x_pan : 0;
$y_pan  = $y_pan ? (int)$y_pan : 0;
?>

<div class="map_wrapper <?php echo esc_attr($el_class);?>" >
	<div  id="<?php echo $unique_id; ?>" <?php echo $animation_data;?> class="dfd_gmap <?php echo esc_attr($animate);?>" style="height: <?php echo esc_attr($size)?>px">
	</div>	
</div>

<script>

	(function($){
		$(document).ready(function(){
			$("head").append("<style> <?php echo $css_rules; ?></style>");
			var options = {
			id:"<?php echo $unique_id; ?>",
			zoom : <?php echo (int)$zoom;?>,
			x_pan : <?php echo (int)$x_pan;?>,
			y_pan : <?php echo (int)$y_pan;?>,
			enable_zoom : <?php echo $enable_zoom;?>,
			disableTouchOnMobile : <?php echo $touch_on_mobile;?>,
			auto_pan:"<?php echo count($location_list) == 1 ? "" : $auto_pan; ?>",
<?php
if ($styleVal)
	echo "styles:" . $styleVal . ",";
?>

			location:
					[
<?php foreach ($location_list as $key => $list) { ?>
						{
						show_tooltip:"<?php echo isset($list["show_tooltip"]) ? $list["show_tooltip"] : ""; ?>",
								tooltip_show_setting:"<?php echo isset($list["tooltip_show_setting"]) ? $list["tooltip_show_setting"] : ""; ?>",
								marker_location:"<?php echo isset($list["marker_location"]) ? esc_js($list["marker_location"]) : ""; ?>",
								<?php 
								$content = "";
								$content .= isset($list["title_marker_content"]) ? "<h6 class='map-title'>".esc_js($list["title_marker_content"])."</h6>" : "";
								$content .= isset($list["marker_content"]) ? "<span class='map-content'>".html_entity_decode(esc_js($list["marker_content"]))."</span>" : "";
								$content .= isset($list["marker_content"]) ||  isset($list["title_marker_content"]) ? "<span class='map-content-separator'></span>" : "";
								if(isset($list["location_list2"])){
									$sub_location_lists = (array) vc_param_group_parse_atts($list["location_list2"]);
									foreach ($sub_location_lists as $sub_key => $sub_list) {
										$content .= isset($sub_list["title_marker_content2"]) ? "<h6 class='map-title'>".esc_js($sub_list["title_marker_content2"])."</h6>" : "";
										$content .= isset($sub_list["marker_content2"]) ? "<span class='map-content'>".html_entity_decode(esc_js($sub_list["marker_content2"]))."</span>" : "";
										$content .= isset($sub_list["marker_content2"]) ||  isset($sub_list["title_marker_content2"]) ? "<span class='map-content-separator'></span>" : "";
									}
								}
								
								?>
								marker_content:"<?php echo $content; ?>",
								is_last:"<?php echo (count($location_list)-1) == $key ? "true": "" ; ?>",
								marker_image:"<?php
	$marker_result_image = "";
	if (!empty($list["marker_image"])) {
		$marker_image_src = wp_get_attachment_image_src($list["marker_image"], 'full');
		$marker_result_image = $marker_image_src[0] ? $marker_image_src[0] : $marker_def_image_src;
	}
	echo $marker_result_image ? $marker_result_image : $marker_def_image_src;
	?>",
								hover_marker_image:"<?php
	if (!empty($list["hover_marker_image"])) {
		$hover_marker_image_src = wp_get_attachment_image_src($list["hover_marker_image"], 'full');
		echo $hover_marker_image_src[0];
	}
	?>"
						},
<?php } ?>

					],
			};
			$("#<?php echo $unique_id; ?>").dfd_gmap(options);
		}

		);
	})(jQuery);

</script>

<?php
$contents = ob_get_contents();
return $contents;
ob_end_clean();
?>
