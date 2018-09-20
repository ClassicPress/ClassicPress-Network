<?php

if (!defined('ABSPATH')) {
	exit;
}
/**
 * Tabs
 */
$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li:not(.vc_active) a:hover .vc_tta-icon{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) a:hover .vc_tta-icon{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
//L2
$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a:hover{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading a:hover{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
//L1
$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a{"
		   . "border-color:" . $vars["secondary_site_color"] . ";"
		   . "}";
//L3
$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a{"
		   . "background: " . $vars["secondary_site_color"] . ";"
		   . "}";
$output .= '.wpb-js-composer .dfd_tabs_block .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active > a {'
				.'border-bottom-color: transparent;'
		   .'}';
$output .= '.dfd_tabs_block .empty_rounded.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active > a {'
				.'border-bottom-color: '.$vars['secondary_site_color'].';'
		   .'}';
$output .=".dfd_tabs_block .dfd_tta_tabs.classic .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a:hover{"
		   . "background: " . $vars["secondary_site_color"] . ";"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//L5
$output .=".dfd_tabs_block .dfd_tta_tabs.collapse .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a:hover{"
		   . "background: " . $vars["secondary_site_color"] . ";"
		   . "}";
//L6
$output .=".dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li:after{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//L7
$output .=".dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-tabs-container .vc_tta-tabs-list li:before{"
		   . "border-color: " . $vars["main_site_color"] . ";"
		   . "}";
//L8
$output .=".dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//L9
$output .=".dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a{"
		   . "border: 2px solid " . $vars["secondary_site_color"] . ";"
		   . "}";
//L10
$output .=".dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";

$output .=".dfd_tabs_block .dfd_tta_tabs .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title a{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active .vc_tta-panel-heading a{"
		   . "border-bottom-color:". $vars["main_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tabs.empty .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a,"
			.".dfd_tabs_block .dfd_tta_tabs.empty_rounded .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a,"
			.".dfd_tabs_block .dfd_tta_tabs.empty_shadow .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading a{"
		   .	 "border-bottom-color:". $vars["secondary_site_color"] . ";"
		   . "}";
/**
 * Accordion
 */
//L11
$output .=".dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
///L12
$output .=".dfd_tabs_block .vc_tta-accordion .style-7 .vc_tta-panel.vc_active .vc_tta-panel-heading{"
		   . "background-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l13
$output .=".dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a:hover{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
//l14
$output .=".dfd_tabs_block .vc_tta-accordion .style-8 .vc_tta-panel.vc_active .vc_tta-panel-heading{"
		   . "border-bottom-color: " . $vars["main_site_color"] . ";"
		   . "}";
//l15
$output .=".dfd_tabs_block .vc_tta-accordion .style-9 .vc_tta-panel.vc_active .vc_tta-panel-heading{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l16
$output .=".dfd_tabs_block .vc_tta-accordion .style-8 .vc_tta-panel .vc_tta-panel-heading{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l17
$output .=".dfd_tabs_block .vc_tta-accordion .style-9 .vc_tta-panel .vc_tta-panel-heading{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .vc_tta-accordion .style-10 .vc_tta-panel .vc_tta-panel-heading{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l45
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l44
$output .=".dfd_tabs_block  .vc_tta-panels-container .vc_tta-panels .vc_active.vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title a{"
		   . "background: " . $vars["secondary_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a .vc_tta-icon{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
//l43
$output .=".dfd_tabs_block  .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels .vc_tta-panel:not(vc.active) .vc_tta-panel-heading .vc_tta-panel-title a:hover{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";

/**
 * Tour
 */
//l19
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a{"
		   . "background: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l20
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a:hover{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover .vc_tta-icon{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
//l21
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l22
$output .=".dfd_tabs_block .dfd_tta_tour.style-7 .vc_tta-tabs-container .vc_tta-tab:after{"
		   . "background: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l23
$output .=".dfd_tabs_block .dfd_tta_tour.style-7 .vc_tta-tabs-container .vc_tta-tab:before{"
		   . "background: " . $vars["main_site_color"] . ";"
		   . "}";
//l24
$output .=".dfd_tabs_block .dfd_tta_tour.style-8 .vc_tta-tabs-container .vc_tta-tab a{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l25
$output .=".dfd_tabs_block .dfd_tta_tour.style-8 .vc_tta-tabs-container .vc_tta-tab.vc_active a{"
		   . "border-color: transparent;"
		   . "border-color: " . $vars["secondary_site_color"] . " !important;"
		   . "}";
//l26
$output .=	".dfd_tabs_block .dfd_tta_tour.style-9 .vc_tta-tabs-container .vc_tta-tab a{"
				. "border-bottom-color: " . $vars["secondary_site_color"] . ";"
			. "}";
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title a{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title a:hover{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";
$output .=".dfd_tabs_block .dfd_tta_tour .vc_tta-panels-container .vc_tta-panels div.vc_tta-panel:not(.vc_active) .vc_tta-panel-heading .vc_tta-panel-title a:hover .vc_tta-icon{"
		   . "color: " . $vars["main_site_color"] . ";"
		   . "}";

/**
 * Pagination
 */
//l27
$output .=".dfdrounded ul.dfd-slick-dots li span, .dfdrounded ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li a, .dfdsquare ul.dfd-slick-dots li span, .dfdsquare ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li a{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l28
$output .=".dfdrounded ul.dfd-slick-dots li span:hover, .dfdrounded ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li a:hover, .dfdsquare ul.dfd-slick-dots li span:hover, .dfdsquare ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li a:hover{"
		   . "border-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "}";
//l29
$output .=".dfdrounded ul.dfd-slick-dots li.slick-active span:before, .dfdrounded ul.dfd-slick-dots li.slick-active a:before, .dfdrounded ul.dfd-slick-dots li.vc_active span:before, .dfdrounded ul.dfd-slick-dots li.vc_active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li.slick-active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li.slick-active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li.vc_active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdrounded li.vc_active a:before, .dfdsquare ul.dfd-slick-dots li.slick-active span:before, .dfdsquare ul.dfd-slick-dots li.slick-active a:before, .dfdsquare ul.dfd-slick-dots li.vc_active span:before, .dfdsquare ul.dfd-slick-dots li.vc_active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li.slick-active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li.slick-active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li.vc_active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdsquare li.vc_active a:before{"
		   . "background: " . $vars["main_site_color"] . ";"
		   . "}";
//l30
$output .=".dfdfillrounded ul.dfd-slick-dots li span, .dfdfillrounded ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li a, .dfdfillsquare ul.dfd-slick-dots li span, .dfdfillsquare ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li a{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "background-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l31
$output .=".dfdfillrounded ul.dfd-slick-dots li span:hover, .dfdfillrounded ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li a:hover, .dfdfillsquare ul.dfd-slick-dots li span:hover, .dfdfillsquare ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li a:hover{"
		   . "border-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "background-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "}";
//l32
$output .=".dfdfillrounded ul.dfd-slick-dots li.slick-active span, .dfdfillrounded ul.dfd-slick-dots li.slick-active a, .dfdfillrounded ul.dfd-slick-dots li.vc_active span, .dfdfillrounded ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillrounded li.vc_active a, .dfdfillsquare ul.dfd-slick-dots li.slick-active span, .dfdfillsquare ul.dfd-slick-dots li.slick-active a, .dfdfillsquare ul.dfd-slick-dots li.vc_active span, .dfdfillsquare ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdfillsquare li.vc_active a{"
		   . "border-color: " . $vars["main_site_color"] . ";"
		   . "background: " . $vars["main_site_color"] . ";"
		   . "}";
//l33
$output .=".dfdemptyrounded ul.dfd-slick-dots li span, .dfdemptyrounded ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li a, .dfdemptysquare ul.dfd-slick-dots li span, .dfdemptysquare ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li a{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l34
$output .=".dfdemptyrounded ul.dfd-slick-dots li span:hover, .dfdemptyrounded ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li a:hover, .dfdemptysquare ul.dfd-slick-dots li span:hover, .dfdemptysquare ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li a:hover{"
		   . "border-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "}";
//l35
$output .=".dfdemptyrounded ul.dfd-slick-dots li.slick-active span, .dfdemptyrounded ul.dfd-slick-dots li.slick-active a, .dfdemptyrounded ul.dfd-slick-dots li.vc_active span, .dfdemptyrounded ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptyrounded li.vc_active a, .dfdemptysquare ul.dfd-slick-dots li.slick-active span, .dfdemptysquare ul.dfd-slick-dots li.slick-active a, .dfdemptysquare ul.dfd-slick-dots li.vc_active span, .dfdemptysquare ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdemptysquare li.vc_active a{"
		   . "border-color: " . $vars["main_site_color"] . ";"
		   . "}";
//l36
$output .=".dfdline ul.dfd-slick-dots li span:before, .dfdline ul.dfd-slick-dots li a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li a:before{"
		   . "border-bottom-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l37
$output .=".dfdline ul.dfd-slick-dots li span:hover:before, .dfdline ul.dfd-slick-dots li a:hover:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li span:hover:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li a:hover:before{"
		   . "border-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "}";
//l38
$output .=".dfdline ul.dfd-slick-dots li.slick-active span:before, .dfdline ul.dfd-slick-dots li.slick-active a:before, .dfdline ul.dfd-slick-dots li.vc_active span:before, .dfdline ul.dfd-slick-dots li.vc_active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li.slick-active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li.slick-active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li.vc_active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdline li.vc_active a:before{"
		   . "border-color: " . $vars["main_site_color"] . ";"
		   . "}";
//l39
$output .=".dfdadvancesquare ul.dfd-slick-dots li span, .dfdadvancesquare ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li a{"
		   . "background-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l40
$output .=".dfdadvancesquare ul.dfd-slick-dots li span:hover, .dfdadvancesquare ul.dfd-slick-dots li a:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li span:hover, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li a:hover{"
		   . "background-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "border-color: " . $vars["secondary_site_color_darken_12"] . ";"
		   . "}";
//l41
$output .=".dfdadvancesquare ul.dfd-slick-dots li.slick-active span, .dfdadvancesquare ul.dfd-slick-dots li.slick-active a, .dfdadvancesquare ul.dfd-slick-dots li.vc_active span, .dfdadvancesquare ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.vc_active a{"
		   . "background: " . $vars["main_site_color"] . ";"
		   . "}";
//l42
$output .=".dfdadvancesquare ul.dfd-slick-dots li.slick-active span:before, .dfdadvancesquare ul.dfd-slick-dots li.slick-active a:before, .dfdadvancesquare ul.dfd-slick-dots li.vc_active span:before, .dfdadvancesquare ul.dfd-slick-dots li.vc_active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.slick-active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.slick-active a:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.vc_active span:before, ul.vc_general.vc_pagination.vc_pagination-style-dfdadvancesquare li.vc_active a:before{"
		   . "background: " . $vars["main_site_color"] . ";"
		   . "}";
//l43
$output .=".dfdroundedempty ul.dfd-slick-dots li span, .dfdroundedempty ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li a{"
		   . "background-color: " . $vars["secondary_site_color"] . ";"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l44
$output .=".dfdroundedempty ul.dfd-slick-dots li.slick-active span, .dfdroundedempty ul.dfd-slick-dots li.slick-active a, .dfdroundedempty ul.dfd-slick-dots li.vc_active span, .dfdroundedempty ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li.vc_active a{"
		   . "background-color: " . $vars["main_site_color"] . ";"
		   . "border-color: " . $vars["main_site_color"] . ";"
		   . "}";
//l45
$output .=".dfdroundedempty ul.dfd-slick-dots li:not(.slick-active) span:hover,"
        . ".dfdroundedempty ul.dfd-slick-dots li:not(.slick-active) a:hover,"
        . "ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li:not(.vc_active) span:hover,"
        . "ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedempty li:not(.vc_active) a:hover{"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "background: transparent !important;"
		   . "}";
//l46
$output .=".dfdroundedfilled ul.dfd-slick-dots li span, .dfdroundedfilled ul.dfd-slick-dots li a, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li span, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li a{"
		   . "background-color: " . $vars["secondary_site_color"] . ";"
		   . "border-color: " . $vars["secondary_site_color"] . ";"
		   . "}";
//l47
$output .=".dfdroundedfilled ul.dfd-slick-dots li.slick-active span, .dfdroundedfilled ul.dfd-slick-dots li.slick-active a, .dfdroundedfilled ul.dfd-slick-dots li.vc_active span, .dfdroundedfilled ul.dfd-slick-dots li.vc_active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li.slick-active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li.slick-active a, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li.vc_active span, ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li.vc_active a{"
		   . "background-color: " . $vars["main_site_color"] . ";"
		   . "border-color: " . $vars["main_site_color"] . ";"
		   . "}";
//l48
$output .=".dfdroundedfilled ul.dfd-slick-dots li:not(.slick-active) span:hover, .dfdroundedfilled ul.dfd-slick-dots li:not(.slick-active) a:hover,"
        . "ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li:not(.vc_active) span:hover,"
        . "ul.vc_general.vc_pagination.vc_pagination-style-dfdroundedfilled li:not(.vc_active) a:hover{"
		   . "border-color: " . $vars["secondary_site_color_darken_50"] . ";"
		   . "background-color: " . $vars["secondary_site_color_darken_50"] . ";"
                   . "}";
