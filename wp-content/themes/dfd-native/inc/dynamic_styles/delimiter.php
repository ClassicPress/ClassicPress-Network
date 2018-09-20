<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .= '.dfd-delimier-wrapper .line{'
				. 'border-bottom-color: '.$vars['secondary_site_color'].';'
			. '}';
$output .= '.dfd-delimier-wrapper .delim-center .center-arrow{'
				. 'border-color: '.$vars['secondary_site_color'].';'
			. '}';
$output .= '.dfd-delimier-wrapper.dfd-delimiter-with-text .delim-center span:after, .dfd-delimier-wrapper.dfd-delimiter-with-text .delim-center span:before{'
				. 'border-bottom-color: '.$vars['secondary_site_color'].';'
			. '}';
$output .= '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover{'
				. 'background-color: '.$vars['main_site_color'].';'
			. '}';
