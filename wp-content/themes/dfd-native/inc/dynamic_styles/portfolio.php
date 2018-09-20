<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*Heading typography*/
$output .=	'.dfd-portfolio .entry-thumb .entry-hover .title-wrap h3.entry-title,'
			. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap h3.entry-title,'
			. '.dfd-content-wrap article.dfd-portfolio h3.entry-title,'
			. '.dfd-content-wrap article.dfd-portfolio_archive h3.entry-title {'
				. 'font-family: '.$vars['portfolio_title-font-family'].';'
				. 'font-size: '.$vars['portfolio_title-font-size'].';'
				. 'font-style: '.$vars['portfolio_title-font-style'].';'
				. 'font-weight: '.$vars['portfolio_title-font-weight'].';'
				. 'text-transform: '.$vars['portfolio_title-text-transform'].';'
				. 'line-height: '.$vars['portfolio_title-line-height'].';'
				. 'letter-spacing: '.$vars['portfolio_title-letter-spacing'].';'
				. 'color: '.$vars['portfolio_title-color'].';'
			. '}';

/*Subheading typography*/
$output .=	'.dfd-portfolio .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
			. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
			. '.dfd-content-wrap article.dfd-portfolio > .cover .entry-subtitle.dfd-content-subtitle,'
			. '.dfd-content-wrap article.dfd-portfolio_archive > .cover .entry-subtitle.dfd-content-subtitle {'
				. 'font-family: '.$vars['portfolio_subtitle-font-family'].';'
				. 'font-size: '.$vars['portfolio_subtitle-font-size'].';'
				. 'font-style: '.$vars['portfolio_subtitle-font-style'].';'
				. 'font-weight: '.$vars['portfolio_subtitle-font-weight'].';'
				. 'text-transform: '.$vars['portfolio_subtitle-text-transform'].';'
				. 'line-height: '.$vars['portfolio_subtitle-line-height'].';'
				. 'letter-spacing: '.$vars['portfolio_subtitle-letter-spacing'].';'
				. 'color: '.$vars['portfolio_subtitle-color'].';'
			. '}';

/*Description heading typography*/
$output .=	'#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .cover .dfd-portfolio-description .dfd-content-title-big {'
				. 'font-family: '.$vars['portfolio_description_title-font-family'].';'
				. 'font-size: '.$vars['portfolio_description_title-font-size'].';'
				. 'font-style: '.$vars['portfolio_description_title-font-style'].';'
				. 'font-weight: '.$vars['portfolio_description_title-font-weight'].';'
				. 'text-transform: '.$vars['portfolio_description_title-text-transform'].';'
				. 'line-height: '.$vars['portfolio_description_title-line-height'].';'
				. 'letter-spacing: '.$vars['portfolio_description_title-letter-spacing'].';'
				. 'color: '.$vars['portfolio_description_title-color'].';'
			. '}';

/*Hover color*/
$output .= '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > div > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > div > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > div > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > div > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > div > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > div > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > div > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > div > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > div > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > div > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > div > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > div > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > div > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > div > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > p > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > div > a,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > div > p > a,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .cover .dfd-portfolio-description a:not(.button),'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .cover .dfd-portfolio-description a:not(.button) {color: '.$vars['main_site_color'].';}';

$output .= '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-folio .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.portfolio .entry-content > .columns > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-portfolio_single > article.gallery_single .entry-content > .columns > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.portfolio .entry-content > .columns > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > p > ul > li:before,'
		. '#layout.single-gallery .dfd-content-wrap.dfd-gallery_single > article.gallery_single .entry-content > .columns > ul > li:before {background: '.$vars['main_site_color'].';}';

/*Heading color*/
$output .= '.dfd-portfolio .entry-thumb .entry-hover .title-wrap h3.entry-title,'
		. '.dfd-portfolio .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap h3.entry-title,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
		. '.dfd-portfolio .entry-thumb .entry-hover .dfd-hover-buttons-wrap,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .dfd-hover-buttons-wrap { color: '.$vars['portfolio_hover_text_color'].';}';

/*Heading line decoration color*/
$output .= '.dfd-portfolio .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
		. '.dfd-portfolio .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
		. '.dfd-portfolio .entry-thumb .entry-hover .title-wrap.square-behind-heading:before,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .title-wrap.square-behind-heading:before { border-color: '.Dfd_Theme_Helpers::dfd_hex2rgb($vars['portfolio_hover_text_color'], .1).';}';

/*Icons hover bg*/
$output .= 'article.dfd-portfolio .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after,'
		. 'article.dfd-portfolio_archive .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after {background: '.$vars['portfolio_hover_buttons_bg'].';}';

/*Plus and dots deco background*/
$output .= '.dfd-portfolio .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
		. '.dfd-portfolio .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
		. '.dfd-portfolio .entry-thumb:hover .entry-hover .dfd-dots-link span,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
		. '.dfd-portfolio_archive .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
		. '.dfd-portfolio_archive .entry-thumb:hover .entry-hover .dfd-dots-link span { background: '.$vars['portfolio_hover_text_color'].' !important;}';

/*Frame line decoration color*/
$output .= 'article.dfd-portfolio .entry-thumb .entry-hover .dfd-hover-frame-deco .line,'
		. 'article.dfd-portfolio_archive .entry-thumb .entry-hover .dfd-hover-frame-deco .line { background: '.$vars['portfolio_hover_mask_bordered_bg'].' !important;}';

/*Hover mask*/
if(isset($dfd_native['portfolio_hover_bg_opacity']) && !empty($dfd_native['portfolio_hover_bg_opacity'])) {
	$output .= '.dfd-portfolio .entry-thumb .entry-hover:before,'
			 . '.dfd-portfolio_archive .entry-thumb .entry-hover:before,'
			 . '.dfd-portfolio.dfd-3d-parallax:hover .cover .thumb-wrap:before,'
			 . '.dfd-portfolio_archive.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				. 'opacity: '. $dfd_native['portfolio_hover_bg_opacity']/100 .' !important;'
			 . '}';
}

if(
	isset($dfd_native['portfolio_hover_mask_style']) &&
	strcmp($dfd_native['portfolio_hover_mask_style'],'simple') === 0
) {
	if(isset($dfd_native['portfolio_hover_bg']) && $dfd_native['portfolio_hover_bg']) {
		$output .= '.dfd-portfolio .entry-thumb .entry-hover:before,'
				 . '.dfd-portfolio_archive .entry-thumb .entry-hover:before,'
				 . '.dfd-portfolio.dfd-3d-parallax:hover .cover .thumb-wrap:before,'
				 . '.dfd-portfolio_archive.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
					. ' background: '. $dfd_native['portfolio_hover_bg'] .' !important;'
				 . '}';
	}
}

if (
	isset($dfd_native['portfolio_hover_mask_style']) &&
	strcmp($dfd_native['portfolio_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_native['portfolio_hover_bg_gradient']) &&
	$dfd_native['portfolio_hover_bg_gradient']
){
    $output .= '.dfd-portfolio .entry-thumb .entry-hover:before,'
			 . '.dfd-portfolio .entry-thumb .entry-hover:before,'
			 . '.dfd-portfolio.dfd-3d-parallax:hover .cover .thumb-wrap:before,'
			 . '.dfd-portfolio_archive.dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_native['portfolio_hover_bg_gradient']['from']).','.esc_attr($dfd_native['portfolio_hover_bg_gradient']['to']).') !important;'
				. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_native['portfolio_hover_bg_gradient']['from']).','.esc_attr($dfd_native['portfolio_hover_bg_gradient']['to']).') !important;'
				. 'background: -o-linear-gradient(left, '.esc_attr($dfd_native['portfolio_hover_bg_gradient']['from']).','.esc_attr($dfd_native['portfolio_hover_bg_gradient']['to']).') !important;'
				. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_native['portfolio_hover_bg_gradient']['from']).','.esc_attr($dfd_native['portfolio_hover_bg_gradient']['to']).') !important;'
				. 'background: linear-gradient(left, '.esc_attr($dfd_native['portfolio_hover_bg_gradient']['from']).','.esc_attr($dfd_native['portfolio_hover_bg_gradient']['to']).') !important;'
			 . '} ';
}