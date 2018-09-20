<?php

if (!defined('ABSPATH')) {
	exit;
}

/* header 1 - 6 colours */
$aval_views = array (".header-top-panel", ".header-mid-panel", ".header-bottom-panel");
//foreach ($aval_views as $aval_views_key => $aval_views_val) {
//	$pos="";
//	switch ($aval_views_val) {
//		case ".header-top-panel":
//			$pos = "top";
//			break;
//		case ".header-mid-panel":
//			$pos = "mid";
//			break;
//		case "header-bottom-panel":
//			$pos = "bot";
//			break;
//
//		default:
//			break;
//	}
//	$s = "header_".$pos."_text_color_build";
//	$text_color = $vars[$s];
//	 $v = '#header-container.dfd-header-builder  .header '.$aval_views_val.' .top-inner-page > span > span {background: ' . $text_color . ';}';
//	$v .= '#header-container.dfd-header-builder .header '.$aval_views_val.' .dfd-click-menu-activation-button a .icon-wrap {background: ' . $vars['header_'.$pos.'_text_color_build'] . ';}';
//	$v .= '#header-container.dfd-header-builder .header '.$aval_views_val.' {background: ' . $vars['header_'.$pos.'_background_color_build'] . ';color: ' . $vars['header_'.$pos.'_text_color_build'] . ';}';
//	$v .= '#header-container.dfd-header-builder .header '.$aval_views_val.' .dfd-header-banner-wrap,'
//			   . '#header-container.dfd-header-builder .header '.$aval_views_val.' .logo-wrap.header-top-logo-panel,'
//			   . '#header-container.dfd-header-builder .header '.$aval_views_val.' .header-wrap {background: ' . $vars['header_'.$pos.'_background_color_build'] . ';}';
//	$v .= '#header-container.dfd-header-builder .header '.$aval_views_val.' .logo-wrap.header-top-logo-panel,'
//			   . '#header-container.dfd-header-builder:not(.small) .header '.$aval_views_val.' .header-wrap > .row > .columns {color: ' . $vars['header_'.$pos.'_text_color_build'] . ';}';
//}




/* * *******************************
 * OPTION header_border_color
 * ******************************* */
//$output .= '#header-container.dfd-header-builder .header .header-top-panel,'
//		   . '#header-container.dfd-header-builder .header .dfd-header-banner-wrap,'
//		   . '#header-container.dfd-header-builder .header .login-header .dfd-header-links, '
//		   . '#header-container.dfd-header-builder .header .logo-wrap.header-top-logo-panel,'
//		   . '#header-container.dfd-header-builder .header .header-wrap .dfd-header-buttons-wrap > *,'
//		   . '#header-container.dfd-header-builder .header {border-color: ' . $vars['header_border_color_' . $i] . ';}';
///**
// * Delimiter Color
// */
//$output .='#header-container.dfd-header-builder .dfd-header-delimiter:before{'
//		   . 'background: ' . $vars['header_border_color_' . $i] . ';'
//		   . '}';
//
//
//$output .='#header-container.dfd-header-builder .header-bottom-panel{'
//		   . 'border-color: ' . $vars['header_border_color_' . $i] . ';'
//		   . '}';

/* Stuning header*/
$output .='#header-container.dfd-header-builder.small .header .header-wrap  .top-inner-page > span > span{background: ' . $vars['fixed_header_text_color'] . ';}';
$output .='#header-container.dfd-header-builder.small  .header .header-wrap .header-bottom-panel .twelve.columns {color: ' . $vars['fixed_header_text_color'] . ';}';
$output .= ' #header-container.small .header .header-wrap .dfd-top-row .dl-menuwrapper a .icon-wrap,'
		   . ' #header-container.small .header .header-wrap .dfd-top-row .dfd-click-menu-activation-button a .icon-wrap,'
		   . ' #header-container.small .header .header-wrap .header-wrap .dl-menuwrapper a .icon-wrap,'
		   . ' #header-container.small .header .header-wrap .header-wrap .dfd-click-menu-activation-button a .icon-wrap {'
		   . 'background: ' . $vars['fixed_header_text_color'] . ';}';
/* Stunnig header Border Color */
$output .= '#header-container.dfd-header-builder.small .header-wrap .dfd-header-delimiter:before {'
		   . 'background: ' . $vars['fixed_header_border_color'] . ';'
		   . '}';
/**/
$output .= '#header-container.dfd-header-builder .header .mega-menu > ul > li div.sub-nav:after,'
			. '#header-container.dfd-header-builder .header .mega-menu > ul > li ul.submenu-languages:after,'
			. '#header-container.dfd-header-builder .header .mega-menu > ul > li div.sub-nav > ul ul:after,'
			. '#header-container.dfd-header-builder.side-header .header .columns .soc-icons-wrap .widget.soc-icons:after {border-right: 7px solid '.$vars['menu_dropdown_background'].'}';