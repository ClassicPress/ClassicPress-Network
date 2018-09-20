<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */

$el_class = $css = $icon_hover_color = $border_radius_left_right = $border_radius = $separator_color = $border_radius_active_tab = $border_width_active_tab = '';
$underline_hover_color = $underline_color =  $underline_height = $icon_active_color = $border_hover_color = $border_width = $animation_data  = $an_class = '';
$title_options = $title_font_options = $use_google_fonts = $custom_fonts = $tab_text_transform = '';

$type = $this->getShortcode();
if (!function_exists("check_property")) {

	function check_property(&$property) {
		$result = (isset($property) && (!empty($property) || $property == 0));
		if (is_int($property) && $result) {
			return $property >= 0;
		}
		if ($result) {
			return true;
		}
		return false;
	}

}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

$this->setGlobalTtaInfo();

$this->enqueueTtaStyles();
$this->enqueueTtaScript();

$style = check_property($style) ? esc_attr($style) : "";
$border_radius_tab = esc_attr($border_radius);
$border_radius = check_property($border_radius) ? esc_attr($border_radius) . "px !important" : "";
$border_color_radius = check_property($border_color_radius) ? esc_attr($border_color_radius) . "" : "";
$color_content_area = check_property($color_content_area) ? esc_attr($color_content_area) : "";
$underline = isset($underline) && $underline == "on" ? "underline" : "";
$c_icon_position = isset($c_icon_position) ? "icon-position-" . $c_icon_position : "";
$tab_active_color_text = check_property($tab_active_color_text) ? esc_attr($tab_active_color_text) : "";
$tab_hover_text_color = check_property($tab_hover_text_color) ? esc_attr($tab_hover_text_color) : "";
$tab_text_color = check_property($tab_text_color) ? esc_attr($tab_text_color) : "";
$border_color_active = check_property($border_color_active) ? esc_attr($border_color_active) : "";
$font_size = check_property($font_size) ? esc_attr($font_size) : "";
$icon_color = check_property($icon_color) ? esc_attr($icon_color) : "";
$icon_size = $icon_size ? esc_attr($icon_size) : "15";
$module_animation = isset($module_animation) ? $module_animation : "";
$border_width = $border_width ? $border_width : 1;

/* * ************************
 * Appear Animation
 * *********************** */

if (!( $module_animation == '' )) {
	$an_class .= 'cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}
$show_separator_line = isset($show_separator_line) && $show_separator_line == "on" ? "show_separator" : "hide_separator";
$show_underline = isset($show_underline) && $show_underline == "on" ? "show_underline" : "hide_underline";
$gap = isset($gap) ? (int) $gap : 0;
$id = uniqid();
if ($style == "collapse"){
	$border_radius_left_right = $border_radius;
	$border_radius = "0px";
}
if ($style == "big_icon")
	$border_radius = "2px !important";
/* Add padding to content area if background color is exist */
$padding = "";
if ($color_content_area != "inherit" && $color_content_area != "") {
	$padding = "padding-left:20px;padding-right:20px;";
	if ($type == "vc_tta_tour")
		$padding .= "padding-top:20px;padding-bottom:20px;";
}
$separator_space = ($gap / 2);
if (!$separator_space) {
	if ($padding) {
		$separator_space = 7;
	} else {
		$separator_space = 0;
	}
}

// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter.=" " . $underline . " " . $type . " " . $show_separator_line . " " . $c_icon_position . " ". $show_underline." ".$style." ";

$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$output = '<div class="dfd_tabs_block '.$an_class.'" id="tabid_' . $id . '" '.$animation_data.'>';

$output .= '<div ' . $this->getWrapperAttributes() . '>';
$output .= $this->getTemplateVariable( 'title' );
$output .= '<div class="' . esc_attr( $css_class ) . '">';
$output .= $this->getTemplateVariable( 'tabs-list-top' );
$output .= $this->getTemplateVariable( 'tabs-list-left' );
$output .= '<div class="vc_tta-panels-container ' . $style . '">';
$output .= $this->getTemplateVariable( 'pagination-top' );
$output .= '<div class="vc_tta-panels">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable( 'pagination-bottom' );
$output .= '</div>';
$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-right' );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
$id = "#tabid_" . $id;
?>

<?php ob_start(); ?>

    /*------------------------------Tabs-------------------------------------*/
<?php if ($this->layout =="tabs") :
	
	$dfd_tabs_style = '';
	if(isset($border_radius_tab) && $border_radius_tab != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {border-radius: '.$border_radius_tab.'px;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-panels-container .vc_tta-panels .vc_active  .vc_tta-panel-heading a {border-radius: '.$border_radius_tab.'px !important;}';
	}
	if(isset($border_color_radius) && !empty($border_color_radius)) {
		if($style != 'empty') {
			$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {border-color: '.$border_color_radius.' !important;}';
		}
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-panels-container .vc_tta-panels .vc_active  .vc_tta-panel-heading a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li:after {border-color: '.$border_color_radius.' !important;}';
	}
	if(isset($font_size) && $font_size != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {font-size: '.$font_size.'px !important;}';
	}
	if(isset($tab_text_transform) && $tab_text_transform != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a {text-transform: '.esc_attr($tab_text_transform).';}';
		$dfd_tabs_style .= '@media (max-width: 768px){'.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {text-transform: '.esc_attr($tab_text_transform).';}}';
	}
	if(isset($title_font_options) && $title_font_options != '' || isset($custom_fonts) && $custom_fonts != '') {
		$title_options = _dfd_parse_text_shortcode_params($title_font_options, '', $use_google_fonts, $custom_fonts);
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a {'.esc_attr($title_options["style"]).'}';
		$dfd_tabs_style .= '@media (max-width: 768px){'.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {'.esc_attr($title_options["style"]).'}}';
	}
	if(isset($tab_text_color) && !empty($tab_text_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {color: '.$tab_text_color.' !important;}';
	}
	if(isset($border_width) && $border_width != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a {border-width: '.$border_width.'px;}';
		/*style for collapse*/
		if(is_rtl() ){
			$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li {margin-right: -'.$border_width.'px;}';
		} else {
			$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li {margin-left: -'.$border_width.'px;}';
		}
	}
	if(isset($tab_background) && !empty($tab_background)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab:not(.vc_active) a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a {background-color: '.$tab_background.' !important;}';
	}
	if(isset($border_hover_color) && !empty($border_hover_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab:not(.vc_active) a:hover, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a:hover {border-color: '.$border_hover_color.' !important;}';
	}
	if(isset($tab_hover_text_color) && !empty($tab_hover_text_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab:not(.vc_active) a:hover, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a:hover {color: '.$tab_hover_text_color.' !important;}';
	}
	if(isset($tab_hover_background) && !empty($tab_hover_background)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab:not(.vc_active) a:hover, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a:hover {background-color: '.$tab_hover_background.' !important;}';
	}
	if(isset($icon_size) && $icon_size != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a .vc_tta-icon {font-size: '.$icon_size.'px !important;}';
	}
	if(isset($icon_color) && !empty($icon_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a .vc_tta-icon {color: '.$icon_color.' !important;}';
	}
	if(isset($icon_hover_color) && !empty($icon_hover_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a:hover .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading a:hover .vc_tta-icon {color: '.$icon_hover_color.' !important;}';
	}
	if(isset($icon_active_color) && !empty($icon_active_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab.vc_active a .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading a .vc_tta-icon {color: '.$icon_active_color.' !important;}';
	}
	if(isset($tab_active_color_text) && !empty($tab_active_color_text)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading a {color: '.$tab_active_color_text.' !important;}';
	}
	if(isset($active_tab_background) && !empty($active_tab_background)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a:hover, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading a:hover {background-color: '.$active_tab_background.' !important;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a {background-color: '.$active_tab_background.';}';
	}
	if(isset($border_color_active) && !empty($border_color_active)) {
		if($style == 'empty') {
			$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading a {border-bottom-color: '.$border_color_active.' !important;}';
		}else{
			$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading a {border-color: '.$border_color_active.' !important;}';
		}
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active:before {border-color: '.$border_color_active.' !important;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a {border-color: '.$border_color_active.';}';
	}
	if(isset($padding) && $padding != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .vc_tta-panel .vc_tta-panel-body {'.$padding.'}';
	}
	if(isset($border_width_active_tab) && $border_width_active_tab != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active:before {border-bottom-width: '.$border_width_active_tab.'px;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading a {border-bottom-width: '.$border_width_active_tab.'px !important;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a {border-width: '.$border_width_active_tab.'px;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a {border-left-width: '.$border_width_active_tab.'px; border-top-width: '.$border_width_active_tab.'px; border-right-width: '.$border_width_active_tab.'px;}';
	}
	if(isset($underline_color) && !empty($underline_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li:after {border-color: '.$underline_color.';}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a {border-bottom-color: '.$underline_color.' !important;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a {border-bottom-color: '.$underline_color.';}';
	}
	if(isset($underline_height) && $underline_height != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li:after, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a {border-bottom-width: '.$underline_height.'px;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a {border-bottom-width: '.$underline_height.'px !important;}';
	}
	if(isset($underline_hover_color) && !empty($underline_hover_color)) {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li:hover:after {border-color: '.$underline_hover_color.';}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a:hover {border-bottom-color: '.$underline_hover_color.' !important;}';
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a:hover, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a:hover, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a:hover, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a:hover {border-bottom-color: '.$underline_hover_color.';}';
	}
	if(isset($border_radius_active_tab) && $border_radius_active_tab != '') {
		$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a, '.$id.'.dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title a {border-radius: '.$border_radius_active_tab.'px;}';
	}
	if(isset($border_radius_left_right) && $border_radius_left_right != '') {
		if(is_rtl()) {
			$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li:first-child a {border-top-right-radius: '.$border_radius_left_right.'; border-bottom-right-radius: '.$border_radius_left_right.';}';
			$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li:last-child a {border-top-left-radius: '.$border_radius_left_right.'; border-bottom-left-radius: '.$border_radius_left_right.';}';
		} else {
			$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li:first-child a {border-top-left-radius: '.$border_radius_left_right.'; border-bottom-left-radius: '.$border_radius_left_right.';}';
			$dfd_tabs_style .= $id.'.dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li:last-child a {border-top-right-radius: '.$border_radius_left_right.'; border-bottom-right-radius: '.$border_radius_left_right.';}';
		}
	}
	echo $dfd_tabs_style;
	
	endif;?>
	
    /*------------------------Accordion---------------------------------------*/
	<?php if ($this->layout =="accordion") :
		 
		switch ($style) {
			case "style-7":
				$border_width_active_tab = "";
				$border_radius_active_tab = "";
				$underline_height = "";
				break;
			case "style-8":
				$border_width = "";
				$border_radius = "";
				$border_radius_active_tab = "";
				break;
			case "style-9":
				$border_width = "";
				$border_radius = "";
				break;
			case "style-10":
				$border_width_active_tab = "";
				$border_width = "";
				$border_radius = "";
				break;

			default:
				break;
		}
	
		$accordion_styles = '';
		if(isset($border_color_radius) && !empty($border_color_radius)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-panel .vc_tta-panel-heading {border-color: '.$border_color_radius.' !important;}';
		}
		if(isset($border_hover_color) && !empty($border_hover_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block  .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover {border-color: '.$border_hover_color.' !important;}';
		}
		if(isset($border_width) && $border_width != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading {border-width: '.$border_width.'px;}';
		}
		if(isset($border_radius) && $border_radius != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion.style-7 .vc_tta-panel .vc_tta-panel-heading {border-radius: '.$border_radius.';}';
		}
		if(isset($font_size) && $font_size != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a, '.$id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text {font-size: '.$font_size.'px !important;}';
		}
		if(isset($color_content_area) && !empty($color_content_area)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-body {background-color: '.$color_content_area.' !important;}';
		}
		if(isset($tab_active_color_text) && !empty($tab_active_color_text)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a, '.$id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text {color: '.$tab_active_color_text.' !important;}';
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a i:before, '.$id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a i:after {border-color: '.$tab_active_color_text.' !important;}';
		}
		if(isset($tab_hover_text_color) && !empty($tab_hover_text_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading h4 a:hover, '.$id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text:hover {color: '.$tab_hover_text_color.' !important;}';
		}
		if(isset($tab_text_color) && !empty($tab_text_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading h4 a, '.$id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text {color: '.$tab_text_color.' !important;}';
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a i:before, '.$id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a i:after {border-color: '.$tab_text_color.' !important;}';
		}
		if(isset($underline_height) && $underline_height != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading {border-width: '.$underline_height.'px;}';
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion.style-9 .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading {border-bottom-width: '.$underline_height.'px;}';
		}
		if(isset($underline_color) && !empty($underline_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading {border-color: '.$underline_color.';}';
		}
		if(isset($tab_background) && !empty($tab_background)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading {background-color: '.$tab_background.' !important;}';
		}
		if(isset($border_width_active_tab) && $border_width_active_tab != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion.style-9 .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading {border-width: '.$border_width_active_tab.'px;}';
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading {border-width: '.$border_width_active_tab.'px !important;}';
		}
		if(isset($tab_hover_background) && !empty($tab_hover_background)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover {background-color: '.$tab_hover_background.' !important;}';
		}
		if(isset($underline_hover_color) && !empty($underline_hover_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover {border-color: '.$underline_hover_color.';}';
		}
		if(isset($active_tab_background) && !empty($active_tab_background)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading {background-color: '.$active_tab_background.' !important;}';
		}
		if(isset($border_color_active) && !empty($border_color_active)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading {border-color: '.$border_color_active.' !important;}';
		}
		if(isset($border_radius_active_tab) && $border_radius_active_tab != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading {border-radius: '.$border_radius_active_tab.'px;}';
		}
		if(isset($icon_hover_color) && !empty($icon_hover_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion  .vc_tta-panel:not(.vc_active) a:hover .vc_tta-icon {color: '.$icon_hover_color.' !important;}';
		}
		if(isset($icon_active_color) && !empty($icon_active_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a .vc_tta-icon {color: '.$icon_active_color.' !important;}';
		}
		if(isset($icon_size) && $icon_size != '') {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.i_position_left .hasIcon .vc_tta-title-text {padding-left: '.($icon_size + 35).'px;}';
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.i_position_right .hasIcon .vc_tta-title-text {padding-right: '.($icon_size + 35).'px;}';
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a .vc_tta-icon {font-size: '.$icon_size.'px !important;}';
		}
		if(isset($icon_color) && !empty($icon_color)) {
			$accordion_styles .= $id.'.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a .vc_tta-icon {color: '.$icon_color.' !important;}';
		}
		echo $accordion_styles;
		
	endif;?>
    /*----------------------------- Tour----------------------------------*/
	<?php 
	switch ($style) {
		case 'style-6':
			$border_radius_active_tab = "";
			$border_width_active_tab = "";
			break;
		case 'style-7':
			$border_radius = "";
			$border_width = "";
			$border_radius_active_tab = "";
			
			break;
		case 'style-8':
			$border_radius = "";
			$border_width = "";
			break;
		case 'style-9':
			$border_radius = "";
			$border_width = "";
			$border_width_active_tab = "";
			break;

		default:
			break;
	}
	
	$dfd_tour_styles = '';
	if(isset($font_size) && $font_size != '') {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a {font-size: '.$font_size.'px !important;}';
	}
	if(isset($icon_size) && $icon_size != '') {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a .vc_tta-icon {font-size: '.$icon_size.'px !important;}';
	}
	if(isset($icon_color) && !empty($icon_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a .vc_tta-icon {color: '.$icon_color.' !important;}';
	}
	if(isset($icon_hover_color) && !empty($icon_hover_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a:hover .vc_tta-icon {color: '.$icon_hover_color.' !important;}';
	}
	if(isset($icon_active_color) && !empty($icon_active_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a .vc_tta-icon, '.$id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panel.vc_active .vc_tta-panel-heading a .vc_tta-icon {color: '.$icon_active_color.' !important;}';
	}
	if(isset($tab_background) && !empty($tab_background)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {background-color: '.$tab_background.' !important;}';
	}
	if(isset($tab_text_color) && !empty($tab_text_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {color: '.$tab_text_color.' !important;}';
	}
	if(isset($tab_hover_background) && !empty($tab_hover_background)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover {background-color: '.$tab_hover_background.' !important;}';
	}
	if(isset($tab_hover_text_color) && !empty($tab_hover_text_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover {color: '.$tab_hover_text_color.' !important;}';
	}
	if(isset($active_tab_background) && !empty($active_tab_background)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {background-color: '.$active_tab_background.' !important;}';
	}
	if(isset($tab_active_color_text) && !empty($tab_active_color_text)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {color: '.$tab_active_color_text.' !important;}';
	}
	if(isset($border_color_active) && !empty($border_color_active)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {border-color: '.$border_color_active.' !important;}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-7 .vc_tta-tabs-container .vc_tta-tab:before {background: '.$border_color_active.' !important;}';
	}
	if(isset($border_width_active_tab) && $border_width_active_tab != '') {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {border-width: '.$border_width_active_tab.'px !important;}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-8 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {border-left-width: '.$border_width_active_tab.'px !important; border-top-width: '.$border_width_active_tab.'px !important; border-right-width: '.$border_width_active_tab.'px !important;}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-7 .vc_tta-tabs-container .vc_tta-tab:before {height: '.$border_width_active_tab.'px;}';
	}
	if(isset($border_radius_active_tab) && $border_radius_active_tab != '') {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a {border-radius: '.$border_radius_active_tab.'px !important;}';
	}
	if(isset($underline_color) && !empty($underline_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-7  .vc_tta-tab:after {background: '.$underline_color.';}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-8 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a, '.$id.'.dfd_tabs_block .dfd_tta_tour.style-9 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {border-bottom-color: '.$underline_color.';}';
	}
	if(isset($underline_height) && $underline_height != '') {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-7  .vc_tta-tab:after {height: '.$underline_height.'px;}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-8 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a, '.$id.'.dfd_tabs_block .dfd_tta_tour.style-9 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a {border-bottom-width: '.$underline_height.'px;}';
	}
	if(isset($underline_hover_color) && !empty($underline_hover_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-7 .vc_tta-tabs-container .vc_tta-tab:hover:after {background: '.$underline_hover_color.' !important;}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour.style-8 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover, '.$id.'.dfd_tabs_block .dfd_tta_tour.style-9 .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover {border-bottom-color: '.$underline_hover_color.';}';
	}
	if(isset($separator_space) && $separator_space != '') {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tabs:not(.big_icon) .vc_tta-panels-container:before {top: -'.$separator_space.'px !important;}';
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tabs:not(.big_icon) .vc_tta-panels-container:after {bottom: -'.$separator_space.'px !important;}';
	}
	if(isset($separator_color) && !empty($separator_color)) {
		$dfd_tour_styles .= $id.'.dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container:after {border-bottom-color: '.$separator_color.';}';
	}
	echo $dfd_tour_styles;
	
	$css = ob_get_clean();
?>

<script type="text/javascript">
	(function($){
		$('head').append('<style type="text/css"><?php echo esc_js($css); ?></style>');

		<?php if ($this->layout =="tabs") : ?>
			$(window).load(function(){
				$("<?php echo $id; ?>").dfd_tab();
				$("<?php echo $id; ?>").dfd_tour();
			});
			
		<?php endif;?>
		<?php if ($this->layout =="accordion") : ?>
				$("<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion.underline .vc_tta-title-text").each(function(){
					var accordion_text = $(this).text();
					$(this).text(" ");
					$(this).append("<div class='accordion_inner_text'>" + accordion_text + "</div>");
				});
				$("<?php echo $id; ?>").bind("DOMSubtreeModified", function() {
					$("<?php echo $id; ?> .vc_tta-accordion .vc_tta-panels .vc_tta-panel").each(function(){
						var $icon = $(this).find(".vc_tta-icon");
						if($icon[0]){
							$(this).find(".vc_tta-panel-title").addClass("hasIcon");
						}
					});
				});	
				$("<?php echo $id; ?> .vc_tta-accordion .vc_tta-panels .vc_tta-panel").each(function(){
					var $icon = $(this).find(".vc_tta-icon");
					if($icon[0]){
						$(this).find(".vc_tta-panel-title").addClass("hasIcon");
					}
				});
				$(document).ready(function(){
					$("<?php echo $id; ?>").dfd_Accordion();
				});
		<?php endif;?>
	})(jQuery);
</script>