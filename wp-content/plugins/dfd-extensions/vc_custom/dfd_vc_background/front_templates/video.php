<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$data_atts = $video_atts = $controller_css = '';
$sound_control_class = 'dfd-socicon-unmute';
 if(isset($dfd_in_viewport) && !empty($dfd_in_viewport))
	 $data_atts .= ' data-viewport="1"';

$uniqid = uniqid('dfd_video_bg_');
if(isset($dfd_video_variant) && !empty($dfd_video_variant)) {
	if(isset($dfd_video_poster) && !empty($dfd_video_poster)) {
		$poster_src = wp_get_attachment_image_src($dfd_video_poster,'full');
		$poster_url = $poster_src[0];
	} else {
		$poster_url = Dfd_Theme_Helpers::default_noimage_url();
	}
	if($dfd_video_variant == 'self-hosted' && (isset($dfd_video_url_mp4) || isset($dfd_video_url_mp4))) {
		
		$video_atts .= 'poster="'. $poster_url .'"';

		if(isset($dfd_video_opts) && !empty($dfd_video_opts)) {
			if(substr_count($dfd_video_opts, 'loop') == 1) {
				$video_atts .= ' loop="true" ';
			}
			if(substr_count($dfd_video_opts, 'muted') == 1) {
				$video_atts .= ' muted="true" ';
				$sound_control_class = 'dfd-socicon-mute';
			}
		}

		//wp_enqueue_script('dfd_zencdn_video_js');

		$output .= '<div class="dfd-row-bg-wrap dfd-video-bg" id="wrapper-'.esc_attr($uniqid).'" '.$data_atts.'>';
		$output .= '<video id="'.esc_attr($uniqid).'" class="video-js vjs-default-skin dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs" 
			   preload="auto"
			   width="100%"
			   height="100%"
			   autoplay="autoplay"
			   '.$video_atts.'
			   data-setup="{}">';

			if (!empty($dfd_video_url_mp4)):
				$output .= '<source src="'.esc_url($dfd_video_url_mp4).'" type="video/mp4">';
			endif;
			if (!empty($dfd_video_url_webm)):
				$output .= '<source src="'.esc_url($dfd_video_url_webm).'" type="video/webm">';
			endif;
		$output .= '</video>';

		$output .= '</div>';

		if(isset($dfd_enable_controls) && !empty($dfd_enable_controls)) {
			if(isset($dfd_controls_color) && !empty($dfd_controls_color))
				$controller_css .= ' style="color:'.esc_attr($dfd_controls_color).';"';
			$output .= '<a href="#" class="dfd-sound-controller mobile-hide '.esc_attr($sound_control_class).'" '. $controller_css .'></a>';
			$output .= '<a href="#" class="dfd-video-controller mobile-hide dfd-socicon-ic_pause_48px" '. $controller_css .'></a>';
		}
	} elseif($dfd_video_variant == 'youtube' || $dfd_video_variant == 'vimeo') {

		$loop = false;
		if(isset($dfd_video_opts) && !empty($dfd_video_opts)) {
			if(substr_count($dfd_video_opts, 'loop') == 1) {
				$loop = true;
			}
			if(substr_count($dfd_video_opts, 'muted') == 1) {
				$muted = true;
				$data_atts .= ' data-muted="1"';
			}
		} else {
			$data_atts .= ' data-muted="0"';
		}

		if($dfd_video_variant == 'youtube' && isset($dfd_youtube_video_id) && !empty($dfd_youtube_video_id)) {
			$extra_url_prop = '';
			if(substr_count($dfd_youtube_video_id, '?') > 0) {
				$dfd_youtube_video_id = substr($dfd_youtube_video_id,(stripos($dfd_youtube_video_id,'?v=')+3));
			}
			if(substr_count($dfd_youtube_video_id, '&') > 0) {
				$dfd_youtube_video_id = substr($dfd_youtube_video_id, 0, stripos($dfd_youtube_video_id,'&'));
			}
			if($loop) 
				$extra_url_prop .= '&amp;loop=1&amp;playlist='.$dfd_youtube_video_id;
			$output .= '<div id="wrapper-'.esc_attr($uniqid).'" class="dfd-row-bg-wrap dfd-video-bg dfd-youtube-bg">
							<div class="video-js dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs"><iframe id="'.esc_attr($uniqid).'" '.$data_atts.' width="100%" height="100%" src="https://www.youtube.com/embed/'.esc_attr($dfd_youtube_video_id).'?wmode=opaque'.esc_attr($extra_url_prop).'&amp;enablejsapi=1&amp;showinfo=0&amp;controls=0&amp;rel=0" frameborder="0" class="dfd-bg-frame" allowfullscreen allow="autoplay; encrypted-media"></iframe></div>
						</div>';
		}

		if($dfd_video_variant == 'vimeo' && isset($dfd_vimeo_video_id) && !empty($dfd_vimeo_video_id)) {
			$extra_url_prop = '';
			if(substr_count($dfd_vimeo_video_id, 'vimeo.com/') > 0) {
				$dfd_vimeo_video_id = substr($dfd_vimeo_video_id,(stripos($dfd_vimeo_video_id, 'vimeo.com/')+10));
			}
			if(substr_count($dfd_vimeo_video_id, '&') > 0) {
				$dfd_vimeo_video_id = substr($dfd_vimeo_video_id, 0, stripos($dfd_vimeo_video_id,'&'));
			}
			if($loop) 
				$extra_url_prop .= '&amp;loop=1';
			$output .= '<div id="wrapper-'.esc_attr($uniqid).'" class="dfd-row-bg-wrap dfd-video-bg dfd-vimeo-bg">
							<div class="video-js dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs"><iframe id="'.esc_attr($uniqid).'" '.$data_atts.' src="https://player.vimeo.com/video/'.esc_attr($dfd_vimeo_video_id).'?api=1&amp;portrait=0&amp;rel=0'.esc_attr($extra_url_prop).'" width="100%" height="100%" frameborder="0" class="dfd-bg-frame"></iframe></div>
						</div>';
		}
	}
	if($poster_url != '') {
		$css_rules .= '#wrapper-'.esc_js($uniqid).' {background-image: url(\"'.esc_js($poster_url).'\");}';
	}
}