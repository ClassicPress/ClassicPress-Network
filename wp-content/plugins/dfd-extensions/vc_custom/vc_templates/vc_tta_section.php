<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Section
 */
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$this->resetVariables($atts, $content);
WPBakeryShortCode_VC_Tta_Section::$self_count ++;
WPBakeryShortCode_VC_Tta_Section::$section_info[] = $atts;
$isPageEditable = vc_is_page_editable();

$output = '';
$add_calss='';
if ($atts["add_icon"]) {
	$i_position = esc_attr($atts["i_position"]);
	$add_calss .= "i_position_" . $i_position;
}
$output .= '<div class="' . $add_calss . " " . esc_attr($this->getElementClasses()) . '"';
$output .= ' id="' . esc_attr($this->getTemplateVariable('tab_id')) . '"';
$output .= ' data-vc-content=".vc_tta-panel-body">';
$output .= '<div class="vc_tta-panel-heading">';
$output .= $this->getTemplateVariable('heading');
$output .= '</div>';
$output .= '<div class="vc_tta-panel-body">';
if ($isPageEditable) {
	$output .= '<div data-js-panel-body>'; // fix for fe - shortcodes container, not required in b.e.
}
$output .= $this->getTemplateVariable('content');
if ($isPageEditable) {
	$output .= '</div>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;