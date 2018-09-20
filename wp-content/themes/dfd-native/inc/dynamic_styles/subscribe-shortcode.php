<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .= '.dfd-subscribe-wrap .submit {background: '.$vars['main_site_color'].';}';

$output .= '.dfd-subscribe-wrap .submit {border-color: '.$vars['main_site_color'].';}';

$output .= '.dfd-subscribe-wrap input[type="text"] {'
				.'font-family: '.$vars['default_text-font-family'].';'
				.'color: '.$vars['default_text-color'].';'
			.'}';
$output .= '.dfd-subscribe-wrap ::-webkit-input-placeholder {font-family: '.$vars['default_text-font-family'].';}';
$output .= '.dfd-subscribe-wrap :-moz-placeholder {font-family: '.$vars['default_text-font-family'].';}';
$output .= '.dfd-subscribe-wrap ::-moz-placeholder {font-family: '.$vars['default_text-font-family'].';}';
$output .= '.dfd-subscribe-wrap :-ms-input-placeholder {font-family: '.$vars['default_text-font-family'].';}';