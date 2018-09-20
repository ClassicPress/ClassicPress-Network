<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (isset($dfd_native['enable_lightbox_share']) && strcmp($dfd_native['enable_lightbox_share'],'off') === 0){
    $output .= 'div.dfd-custom-theme .pp_social { display: none !important; } ';
}

if (isset($dfd_native['enable_lightbox_arrows']) && strcmp($dfd_native['enable_lightbox_arrows'],'off') === 0){
    $output .= 'div.dfd-custom-theme a.pp_next, div.dfd-custom-theme a.pp_previous { display: none !important; } ';
}

if (isset($dfd_native['enable_zoom_button']) && strcmp($dfd_native['enable_zoom_button'],'off') === 0){
    $output .= 'div.dfd-custom-theme a.pp_expand, div.dfd-custom-theme a.pp_contract { display: none !important; } ';
}

$output .= 'div.dfd-custom-theme .pp_content_container .pp_details .ppt,'
	. 'div.dfd-custom-theme .pp_content_container .pp_details .pp_description,'
	. 'div.dfd-custom-theme a.pp_next > i,'
	. 'div.dfd-custom-theme a.pp_previous > i,'
	. 'div.dfd-custom-theme a.pp_next > span.count,'
	. 'div.dfd-custom-theme a.pp_previous > span.count,'
	. 'div.dfd-custom-theme .pp_close,'
	. 'div.dfd-custom-theme a.pp_expand,'
	. 'div.dfd-custom-theme a.pp_contract,'
	. 'div.dfd-custom-theme .pp_nav .pp_play,'
	. 'div.dfd-custom-theme .pp_nav .pp_pause,'
	. 'div.dfd-custom-theme .pp_social .dfd-share-title > i,'
	. 'div.dfd-custom-theme a.pp_next > i > span.count,'
	. 'div.dfd-custom-theme a.pp_previous > i > span.count,'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .audioplayer .audioplayer-volume .audioplayer-volume-button > a:before,'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .audioplayer .audioplayer-time.audioplayer-time-duration,'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .audioplayer .audioplayer-time.audioplayer-time-current,'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .audioplayer .audioplayer-playpause > a:after,'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .pp_audio_container h3.entry-title {'
		. 'color: '.$vars['lightbox_elements_color'].';'
	. '}'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .pp_audio_container .entry-subtitle {'
		. 'color: '.Dfd_Theme_Helpers::dfd_hex2rgb($vars['lightbox_elements_color'], .4).';'
	. '}'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .audioplayer .audioplayer-bar {'
		. 'background: '.Dfd_Theme_Helpers::dfd_hex2rgb($vars['lightbox_elements_color'], .1).';'
	. '}'
	. '.audioplayer .audioplayer-bar .audioplayer-bar-played:before {'
		. 'background: '.$vars['lightbox_elements_color'].';'
	. '}'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .pp_audio_container .audioplayer .audioplayer-playpause > a:hover:before {'
		. 'background: '.Dfd_Theme_Helpers::dfd_hex2rgb($vars['lightbox_elements_color'], .1).';'
	. '}'
	. 'div.dfd-custom-theme a.pp_next > i:hover,'
	. 'div.dfd-custom-theme a.pp_previous > i:hover,'
	. 'div.dfd-custom-theme.dfd-audio-box .pp_fade #pp_full_res .pp_audio_container .audioplayer .audioplayer-playpause > a:not(:hover):before {'
		. 'border-color: '.Dfd_Theme_Helpers::dfd_hex2rgb($vars['lightbox_elements_color'], .1).';'
	. '}';

if (isset($dfd_native['lightbox_overlay_style']) && strcmp($dfd_native['lightbox_overlay_style'],'simple') === 0 && isset($dfd_native['lightbox_overley_bg_color']) && $dfd_native['lightbox_overley_bg_color']){
    $output .= 'div.pp_overlay, .dfd-fullscreen-video-container:before { background: '.esc_attr($vars['lightbox_overley_bg_color']).' !important; } ';
}

if (
	isset($dfd_native['lightbox_overlay_style']) &&
	strcmp($dfd_native['lightbox_overlay_style'],'gradient') === 0 &&
	isset($dfd_native['lightbox_overley_color_gradient']) &&
	$dfd_native['lightbox_overley_color_gradient']
){
    $output .= 'div.pp_overlay, .dfd-fullscreen-video-container:before {'
		. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_native['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_native['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_native['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_native['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: -o-linear-gradient(left, '.esc_attr($dfd_native['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_native['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_native['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_native['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: linear-gradient(left, '.esc_attr($dfd_native['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_native['lightbox_overley_color_gradient']['to']).') !important;'
		. '} ';
	
	if (isset($dfd_native['lightbox_overley_bg_opacity']) && $dfd_native['lightbox_overley_bg_opacity']){
		$output .= 'div.pp_overlay, .dfd-fullscreen-video-container:before  { opacity: '.esc_attr($dfd_native['lightbox_overley_bg_opacity']/100).' !important; } ';
	}
}
