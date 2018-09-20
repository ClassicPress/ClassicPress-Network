<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .= '.dfd-short-info-block-wrap .dfd-short-info-block-item .icon-decoration:before,'
		. '.dfd-gradation-wrap .dfd-gradation-item .icon-decoration:before {border-color: '.$vars['main_site_color'].';}';

$output .= '.dfd-short-info-block-wrap .dfd-short-info-block-item .icon-decoration:before,'
		. '.dfd-gradation-wrap .dfd-gradation-item:hover .icon-decoration:before {background: '.$vars['main_site_color'].';}';