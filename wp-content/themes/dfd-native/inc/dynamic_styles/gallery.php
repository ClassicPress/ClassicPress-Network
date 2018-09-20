<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


/*Heading typography*/
$output .=	'.dfd-gallery .entry-thumb .entry-hover .title-wrap h3.entry-title,'
			. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap h3.entry-title,'
			. '.dfd-content-wrap article.dfd-gallery .entry-meta + h3.entry-title,'
			. '.dfd-content-wrap article.dfd-gallery_archive .entry-meta + h3.entry-title {'
				. 'font-family: '.$vars['gallery_title-font-family'].';'
				. 'font-size: '.$vars['gallery_title-font-size'].';'
				. 'font-style: '.$vars['gallery_title-font-style'].';'
				. 'font-weight: '.$vars['gallery_title-font-weight'].';'
				. 'text-transform: '.$vars['gallery_title-text-transform'].';'
				. 'line-height: '.$vars['gallery_title-line-height'].';'
				. 'letter-spacing: '.$vars['gallery_title-letter-spacing'].';'
				. 'color: '.$vars['gallery_title-color'].';'
			. '}';

$output .=	'.dfd-gallery .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
			. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
			. '.dfd-content-wrap article.dfd-gallery > .cover .entry-subtitle.dfd-content-subtitle,'
			. '.dfd-content-wrap article.dfd-gallery_archive > .cover .entry-subtitle.dfd-content-subtitle {'
				. 'font-family: '.$vars['gallery_subtitle-font-family'].';'
				. 'font-size: '.$vars['gallery_subtitle-font-size'].';'
				. 'font-style: '.$vars['gallery_subtitle-font-style'].';'
				. 'font-weight: '.$vars['gallery_subtitle-font-weight'].';'
				. 'text-transform: '.$vars['gallery_subtitle-text-transform'].';'
				. 'line-height: '.$vars['gallery_subtitle-line-height'].';'
				. 'letter-spacing: '.$vars['gallery_subtitle-letter-spacing'].';'
				. 'color: '.$vars['gallery_subtitle-color'].';'
			. '}';

/*Heading color*/
$output .= '.dfd-gallery .entry-thumb .entry-hover .title-wrap h3.entry-title,'
		. '.dfd-gallery .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap h3.entry-title,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
		. '.dfd-gallery .entry-thumb .entry-hover .dfd-hover-buttons-wrap,'
		. '.dfd-gallery_archive  .entry-thumb .entry-hover .dfd-hover-buttons-wrap { color: '.$vars['gallery_hover_text_color'].';}';

/*Heading line decoration color*/
$output .= '.dfd-gallery .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
		. '.dfd-gallery .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
		. '.dfd-gallery .entry-thumb .entry-hover .title-wrap.square-behind-heading:before,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .title-wrap.square-behind-heading:before { border-color: '.Dfd_Theme_Helpers::dfd_hex2rgb($vars['gallery_hover_text_color'], .1).';}';

/*Icons hover bg*/
$output .= 'article.dfd-gallery .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after,'
		. 'article.dfd-gallery_archive .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after {background: '.$vars['gallery_hover_buttons_bg'].';}';

/*Plus and dots deco background*/
$output .= '.dfd-gallery .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
		. '.dfd-gallery .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
		. '.dfd-gallery .entry-thumb:hover .entry-hover .dfd-dots-link span,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
		. '.dfd-gallery_archive .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
		. '.dfd-gallery_archive .entry-thumb:hover .entry-hover .dfd-dots-link span { background: '.$vars['gallery_hover_text_color'].' !important;}';

/*Frame line decoration color*/
$output .= 'article.dfd-gallery .entry-thumb .entry-hover .dfd-hover-frame-deco .line,'
		. 'article.dfd-gallery_archive .entry-thumb .entry-hover .dfd-hover-frame-deco .line { background: '.$vars['gallery_hover_mask_bordered_bg'].' !important;}';

/*Hover mask*/
if(isset($dfd_native['gallery_hover_bg_opacity']) && !empty($dfd_native['gallery_hover_bg_opacity'])) {
	$output .= '.dfd-gallery .entry-thumb .entry-hover:before,'
			 . '.dfd-gallery_archive .entry-thumb .entry-hover:before,'
			 . '.dfd-gallery.dfd-3d-parallax:hover .cover .thumb-wrap:before,'
			 . '.dfd-gallery_archive.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				. 'opacity: '. $dfd_native['gallery_hover_bg_opacity']/100 .' !important;'
			 . '}';
}

if(
	isset($dfd_native['gallery_hover_mask_style']) &&
	strcmp($dfd_native['gallery_hover_mask_style'],'simple') === 0
) {
	if(isset($dfd_native['gallery_hover_bg']) && $dfd_native['gallery_hover_bg']) {
		$output .= '.dfd-gallery .entry-thumb .entry-hover:before,'
				 . '.dfd-gallery_archive .entry-thumb .entry-hover:before,'
				 . '.dfd-gallery.dfd-3d-parallax:hover .cover .thumb-wrap:before,'
				 . '.dfd-gallery_archive.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
					. ' background: '. $dfd_native['gallery_hover_bg'] .' !important;'
				 . '}';
	}
}

if (
	isset($dfd_native['gallery_hover_mask_style']) &&
	strcmp($dfd_native['gallery_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_native['gallery_hover_bg_gradient']) &&
	$dfd_native['gallery_hover_bg_gradient']
){
    $output .= '.dfd-gallery .entry-thumb .entry-hover:before,'
			 . '.dfd-gallery .entry-thumb .entry-hover:before,'
			 . '.dfd-gallery.dfd-3d-parallax:hover .cover .thumb-wrap:before,'
			 . '.dfd-gallery_archive.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_native['gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_native['gallery_hover_bg_gradient']['to']).') !important;'
				. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_native['gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_native['gallery_hover_bg_gradient']['to']).') !important;'
				. 'background: -o-linear-gradient(left, '.esc_attr($dfd_native['gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_native['gallery_hover_bg_gradient']['to']).') !important;'
				. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_native['gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_native['gallery_hover_bg_gradient']['to']).') !important;'
				. 'background: linear-gradient(left, '.esc_attr($dfd_native['gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_native['gallery_hover_bg_gradient']['to']).') !important;'
			 . '} ';
}