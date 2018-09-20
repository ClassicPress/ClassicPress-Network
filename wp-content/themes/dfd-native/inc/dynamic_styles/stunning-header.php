<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output .= 'h1.dfd-page-title {'
				. 'font-family: '.$vars['stunning_header_title-font-family'].';'
				. 'font-size: '.esc_attr($vars['stunning_header_title-font-size']).';'
				. 'font-style: '.esc_attr($vars['stunning_header_title-font-style']).';'
				. 'font-weight: '.esc_attr($vars['stunning_header_title-font-weight']).';'
				. 'text-transform: '.esc_attr($vars['stunning_header_title-text-transform']).';'
				. 'line-height: '.esc_attr($vars['stunning_header_title-line-height']).';'
				. 'letter-spacing: '.esc_attr($vars['stunning_header_title-letter-spacing']).';'
				. 'color: '.esc_attr($vars['stunning_header_title-color']).';'
			. '}';

$output .= 'h2.dfd-page-subtitle {'
				. 'font-family: '.$vars['stunning_header_subtitle-font-family'].';'
				. 'font-size: '.esc_attr($vars['stunning_header_subtitle-font-size']).';'
				. 'font-style: '.esc_attr($vars['stunning_header_subtitle-font-style']).';'
				. 'font-weight: '.esc_attr($vars['stunning_header_subtitle-font-weight']).';'
				. 'text-transform: '.esc_attr($vars['stunning_header_subtitle-text-transform']).';'
				. 'line-height: '.esc_attr($vars['stunning_header_subtitle-line-height']).';'
				. 'letter-spacing: '.esc_attr($vars['stunning_header_subtitle-letter-spacing']).';'
				. 'color: '.esc_attr($vars['stunning_header_subtitle-color']).';'
			. '}';

$output .= '.breadcrumbs,'
		. '#bbpress-forums #crumbs {'
				. 'font-family: '.$vars['stunning_header_breadcrumbs-font-family'].';'
				. 'font-size: '.esc_attr($vars['stunning_header_breadcrumbs-font-size']).';'
				. 'font-style: '.esc_attr($vars['stunning_header_breadcrumbs-font-style']).';'
				. 'font-weight: '.esc_attr($vars['stunning_header_breadcrumbs-font-weight']).';'
				. 'text-transform: '.esc_attr($vars['stunning_header_breadcrumbs-text-transform']).';'
				. 'line-height: '.esc_attr($vars['stunning_header_breadcrumbs-line-height']).';'
				. 'letter-spacing: '.esc_attr($vars['stunning_header_breadcrumbs-letter-spacing']).';'
				. 'color: '.esc_attr($vars['stunning_header_breadcrumbs-color']).';'
			. '}';

$output .= 'div.page-title-inner .breadcrumbs > nav > span:before {background: '.esc_attr($vars['stunning_header_breadcrumbs-color']).'}';

$st_h_responsive_letter_spacing = 0;
if(isset($vars['stunning_header_title-letter-spacing']) && !empty($vars['stunning_header_title-letter-spacing'])) {
	$st_h_responsive_letter_spacing = (float)$vars['stunning_header_title-letter-spacing'] / (int)$vars['stunning_header_title-font-size'].'em';
}

$output .= '@media only screen and (max-width: 1280px) {'
			. '.page-title-inner:not(.full-height) h1.dfd-page-title {'
				. 'letter-spacing: '.esc_attr($st_h_responsive_letter_spacing).';'
			. '}'
		. '}';

unset($st_h_responsive_letter_spacing);

if((int)$vars['stunning_header_title-font-size'] > 30) {
	$st_h_responsive_line_height = 1.2;
	if(substr_count($vars['stunning_header_title-line-height'],'px') > 0) {
		$st_h_responsive_line_height = (int)$vars['stunning_header_title-line-height'] /(int)$vars['stunning_header_title-font-size'];
	}
	
	$output .= '@media only screen and (max-width: 1280px) and (min-width: 1025px) {'
					. '.page-title-inner:not(.full-height) h1.dfd-page-title {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_title-font-size'] * .85).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	$output .= '@media only screen and (max-width: 1024px) and (min-width: 800px) {'
					. '.page-title-inner:not(.full-height) h1.dfd-page-title {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_title-font-size'] * .7).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	$output .= '@media only screen and (max-width: 799px) and (min-width: 460px) {'
					. '.page-title-inner:not(.full-height) h1.dfd-page-title {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_title-font-size'] * .65).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	$output .= '@media only screen and (max-width: 459px) {'
					. '.page-title-inner:not(.full-height) h1.dfd-page-title {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_title-font-size'] * .6).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	unset($st_h_responsive_line_height);
}

$st_sh_responsive_letter_spacing = 0;
if(isset($vars['stunning_header_subtitle-letter-spacing']) && !empty($vars['stunning_header_subtitle-letter-spacing'])) {
	$st_sh_responsive_letter_spacing = (float)$vars['stunning_header_subtitle-letter-spacing'] / (int)$vars['stunning_header_subtitle-font-size'].'em';
}

$output .= '@media only screen and (max-width: 1280px) {'
			. '.page-title-inner:not(.full-height) h2.dfd-page-subtitle {'
				. 'letter-spacing: '.esc_attr($st_sh_responsive_letter_spacing).';'
			. '}'
		. '}';

unset($st_sh_responsive_letter_spacing);

if((int)$vars['stunning_header_subtitle-font-size'] > 16) {
	$st_h_responsive_line_height = 1.2;
	if(substr_count($vars['stunning_header_subtitle-line-height'],'px') > 0) {
		$st_h_responsive_line_height = (int)$vars['stunning_header_subtitle-line-height'] /(int)$vars['stunning_header_subtitle-font-size'];
	}
	
	$output .= '@media only screen and (max-width: 1280px) and (min-width: 1025px) {'
					. '.page-title-inner:not(.full-height) h2.dfd-page-subtitle {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_subtitle-font-size'] * .85).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	$output .= '@media only screen and (max-width: 1024px) and (min-width: 800px) {'
					. '.page-title-inner:not(.full-height) h2.dfd-page-subtitle {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_subtitle-font-size'] * .7).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	$output .= '@media only screen and (max-width: 799px) and (min-width: 460px) {'
					. '.page-title-inner:not(.full-height) h2.dfd-page-subtitle {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_subtitle-font-size'] * .65).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	$output .= '@media only screen and (max-width: 459px) {'
					. '.page-title-inner:not(.full-height) h2.dfd-page-subtitle {'
						. 'font-size: '.esc_attr((int)$vars['stunning_header_subtitle-font-size'] * .6).'px;'
						. 'line-height: '.esc_attr($st_h_responsive_line_height).';'
					. '}'
			. '}';
	
	unset($st_h_responsive_line_height);
}