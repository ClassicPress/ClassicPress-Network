<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .=".dfd_gmap .gmap-infowindows-style{"
		   . "background-color:".$vars["main_site_color"].";"
		   . "}";
$output .=".dfd_gmap  .gmap-infowindows-style > div:nth-child(3) div > div{"
		   . "background-color:".$vars["main_site_color"]." !important;"
		   . "}";
$output .=".dfd_gmap .aligned .gm-style-iw div div{"
		   . "font-family:".$vars["default_text-font-family"].";"
		   . 'letter-spacing: '.$vars['default_text-letter-spacing'].';'
		   . "}";
$output .=".dfd_gmap .aligned .gm-style-iw div div .map-content{"
		   . "font-family:".$vars["default_text-font-family"]." !important;"
		   . 'letter-spacing: '.$vars['default_text-letter-spacing'].';'
		   . "}";
$output .=".dfd_gmap .aligned .gm-style-iw div div .map-title{"
		   . "font-family:".$vars["h6-font-family"].";"
		   . "}";
