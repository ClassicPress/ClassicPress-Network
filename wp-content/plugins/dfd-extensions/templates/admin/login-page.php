<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;
	
$before_login_page_css = $login_page_css = $login_page_js = '';

$title_color = '#222222';
$label_input_color = '#c3c3c3';
$input_bg = '#f2f2f2';
$input_border = '#dddddd';

if(isset($dfd_native['login_page_logo_image']['url']) && $dfd_native['login_page_logo_image']['url']) {
	$custom_logo = $dfd_native['login_page_logo_image']['url'];
} elseif(isset($dfd_native['custom_logo_image']['url']) && $dfd_native['custom_logo_image']['url']) {
	$custom_logo = $dfd_native['custom_logo_image']['url'];
} else {
	$custom_logo = get_template_directory_uri() .'/assets/img/logo.png';
}
		
$login_page_css .= 'body.login{background:#fff;}
		body.login:not(.interim-login) #login {position: relative; top: 50%; margin: 0 auto; padding: 0 20px; -webkit-transform: translateY(-50%); -moz-transform: translateY(-50%); -o-transform: translateY(-50%); transform: translateY(-50%); width: auto; max-width: 380px; z-index: 1;}';			

if(isset($dfd_native['custom_login_page']) && $dfd_native['custom_login_page'] == 'on') {
	
	$third_color = '#34db83';
	$third_hover_color = '#22c971';
	if(isset($dfd_native['third_site_color']) && !empty($dfd_native['third_site_color'])) {
		$third_color = $dfd_native['third_site_color'];
		$third_hover_color = Dfd_Theme_Helpers::adjustBrightness($dfd_native['third_site_color'], -7);
	}
	
	if(isset($dfd_native['login_page_color_scheme']) && $dfd_native['login_page_color_scheme'] == 'dark') {
		$title_color = '#ffffff';
	}
	if(isset($dfd_native['custom_login_page_logo']) && $dfd_native['custom_login_page_logo'] == 'off') {
		$login_page_css .= '.login h1 a, body.login a.logo {display: none !important;}';
	}
	if(isset($dfd_native['login_page_bg_color']) && $dfd_native['login_page_bg_color'] != '') {
		$login_page_css .= 'body.login{background-color:'.esc_attr($dfd_native['login_page_bg_color']).';}';
	}
	if(isset($dfd_native['login_page_bg_image']['url']) && $dfd_native['login_page_bg_image']['url'] != '') {
		$background_size = (isset($dfd_native['login_page_bg_image_size']) && $dfd_native['login_page_bg_image_size'] != '') ? $dfd_native['login_page_bg_image_size'] : 'initial';
		$login_page_css .= 'body.login{background-image:url('.esc_attr($dfd_native['login_page_bg_image']['url']).');background-size: '.esc_attr($background_size).';background-position: center center;background-repeat: no-repeat;}';
	}


	if(isset($dfd_native['login_page_select_bg_variant']) && $dfd_native['login_page_select_bg_variant'] == 'video') {
		$js_html_video = $dfd_vimeo_video_id = $dfd_video_class = $frame_html = '';

		$uniqid = uniqid('dfd_video_bg_');

		if($dfd_native['login_page_select_bg_video_variant'] == 'self_host') {
			if(isset($dfd_native['login_video_bg_url_mp4']) || isset($dfd_native['login_video_bg_url_webm'])) {
				$frame_html .= '<video id="'.esc_attr($uniqid).'" class="video-js vjs-default-skin dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs" controls="" preload="auto" width="100%" height="100%" autoplay="true" loop="true" muted="true" data-setup="{}">';
					if (!empty($dfd_native['login_video_bg_url_mp4'])):
						$frame_html .= '<source src="'.esc_url($dfd_native['login_video_bg_url_mp4']).'" type="video/mp4">';
					endif;
					if (!empty($dfd_native['login_video_bg_url_webm'])):
						$frame_html .= '<source src="'.esc_url($dfd_native['login_video_bg_url_webm']).'" type="video/webm">';
					endif;
				$frame_html .= '</video>';
			}
		}elseif($dfd_native['login_page_select_bg_video_variant'] == 'youtube' && isset($dfd_native['login_video_bg_youtube']) && $dfd_native['login_video_bg_youtube'] != '') {
			$dfd_video_class = ' dfd-youtube-bg';
			$frame_html = '<div class="video-js dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs"><iframe id="'.esc_attr($uniqid).'" data-muted="1" width="100%" height="100%" src="https://www.youtube.com/embed/'.esc_attr($dfd_native['login_video_bg_youtube']).'?wmode=opaque&amp;autoplay=1&amp;loop=1&amp;playlist='.$dfd_native['login_video_bg_youtube'].'&amp;enablejsapi=1&amp;showinfo=0&amp;controls=0&amp;rel=0" frameborder="0" class="dfd-bg-frame" allowfullscreen allow="autoplay; encrypted-media"></iframe></div>';
		}elseif($dfd_native['login_page_select_bg_video_variant'] == 'vimeo' && isset($dfd_native['login_video_bg_vimeo']) && $dfd_native['login_video_bg_vimeo'] != '') {
			$dfd_video_class = ' dfd-vimeo-bg';
			$frame_html = '<div class="video-js dfd_vc_hidden-md dfd_vc_hidden-sm dfd_vc_hidden-xs"><iframe id="'.esc_attr($uniqid).'" src="https://player.vimeo.com/video/'.esc_attr($dfd_native['login_video_bg_vimeo']).'?api=1&amp;portrait=0&amp;rel=0&amp;autoplay=1&amp;valuenow=0&amp;loop=1" width="100%" height="100%" frameborder="0" class="dfd-bg-frame"></iframe></div>';
		}

		$js_html_video .=	'<div id="wrapper-'.esc_attr($uniqid).'" class="dfd-row-bg-wrap dfd-video-bg'.esc_attr($dfd_video_class).'">'
								.$frame_html
							.'</div>';

		$login_page_js .=	"<script type=\"text/javascript\">
								(function($) {
									\"use strict\";
									var initVideoBg = function() {
										var dfdVideoBgInit = function() {
											$('.dfd-video-bg video, .dfd-video-bg .dfd-bg-frame').each(function() {
												var self = $(this),
													ratio = 1.778,
													pWidth = self.parent().width(),
													pHeight = self.parent().height(),
													selfWidth,
													selfHeight;
												var setSizes = function() {
													if(pWidth / ratio < pHeight) {
														selfWidth = Math.ceil(pHeight * ratio);
														selfHeight = pHeight;
														self.css({
															'width': selfWidth,
															'height': selfHeight
														});
													} else {
														selfWidth = pWidth;
														selfHeight = Math.ceil(pWidth / ratio);
														self.css({
															'width': selfWidth,
															'height': selfHeight
														});
													}
												};
												self.parents('.dfd-video-bg').siblings('.dfd-video-controller').on('click', function(e) {
													e.preventDefault();
													if($(this).hasClass('dfd-icon-play')) {
														self[0].play();
														$(this).removeClass('dfd-icon-play').addClass('dfd-icon-pause');
													} else {
														self[0].pause();
														$(this).removeClass('dfd-icon-pause').addClass('dfd-icon-play');
													}
												});
												self.parents('.dfd-video-bg').siblings('.dfd-sound-controller').on('click', function(e) {
													e.preventDefault();
													if($(this).hasClass('dfd-socicon-unmute')) {
														self.prop('muted',false);
														$(this).removeClass('dfd-socicon-unmute').addClass('dfd-socicon-mute');
													} else {
														self.prop('muted',true);
														$(this).removeClass('dfd-socicon-mute').addClass('dfd-socicon-unmute');
													}
												});
												setSizes();
												$(window).on('resize', setSizes);
											});
										};

										dfdVideoBgInit();

										if($('.dfd-youtube-bg').length > 0) {
											var tag = document.createElement('script');
											tag.src = '//www.youtube.com/iframe_api';
											var firstScriptTag = document.getElementsByTagName('script')[0];
											firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
											var players = {};
											window.onYouTubeIframeAPIReady = function() {
												$('.dfd-youtube-bg iframe').each(function() {
													var self = $(this),
														id = self.attr('id');
													if(self.data('muted') && self.data('muted') == '1') {
														players[id] = new YT.Player(id, {
															events: {
																'onReady': onPlayerReady
															}
														});
													}
												});
											};
										}
										function onPlayerReady(e) {
											e.target.mute();
										}
									};

									$(document).ready(function() {
										$('body.login').append('".$js_html_video."');
										initVideoBg();
									});
								})(jQuery);
							</script>";

		$login_page_css .= 'body.login .dfd-row-bg-wrap {position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; z-index: -1;}';
		$login_page_css .= 'body.login .dfd-row-bg-wrap > video {position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); -moz-transform: translate(-50%, -50%); -o-transform: translate(-50%, -50%); transform: translate(-50%, -50%); height: auto;}';
		$login_page_css .= 'body.login .dfd-row-bg-wrap > div {position: relative; width: 100%; max-width: 100%; height: 100%;}';
		$login_page_css .= 'body.login .dfd-row-bg-wrap > div .dfd-bg-frame {position: absolute; top: 50%; left: 50%; -webkit-transform: translate(-50%,-50%); transform: translate(-50%,-50%);}';
	}


	$login_page_css .= '#login p.login-title {position: absolute; left: 40px; bottom: 100%; margin-bottom: 30px; font-family: "Montserrat"; font-weight: 700; font-size: 25px; letter-spacing:-2px; line-height: 1; color: '.esc_attr($title_color).';}';
	$login_page_css .= 'body.login.login-action-lostpassword #login form p.submit {width: 100%; padding-top: 10px;}';
	$login_page_css .= 'body.login.login-action-lostpassword form p.submit:before {display: none;}';
	$login_page_css .= 'body.login.login-action-lostpassword form p.submit input[type="submit"] {padding-left: 12px;}';
	$login_page_css .= 'body.login form {margin: 0; padding: 20px; padding-bottom: 25px; background: #ffffff; border-radius: 10px; -webkit-box-shadow: 0px 15px 40px 5px rgba(0,0,0,.1); box-shadow: 0px 15px 40px 5px rgba(0,0,0,.1);}';
	$login_page_css .= 'body.login form label {font-family: "Montserrat"; text-transform: uppercase; font-size: 10px; letter-spacing: 1px; padding-left: 20px; color: '.esc_attr($label_input_color).';}';
	$login_page_css .= 'body.login form .forgetmenot {width: 50%; line-height: 43px;}';
	$login_page_css .= 'body.login form .forgetmenot label {display: block; font-family: "Open Sans"; text-transform: none; color: #797979; letter-spacing: 0; font-size: 13px; line-height: inherit; padding-left: 0;}';
	$login_page_css .= 'body > .logo {display: block; text-indent: 9999em; position: relative; top: 50px; overflow: hidden; margin: 0 auto; color: transparent; z-index: 1; max-width: 380px;}';
	$login_page_css .= 'body.login form input[type="text"], body.login form input[type="password"], body.login form input[type="email"] {padding: 6px 20px; background: '.esc_attr($input_bg).'; color: #222222; border-color: '.esc_attr($input_border).'; border-radius: 22px; margin: 7px 6px 16px 0; -webkit-box-shadow: none; box-shadow: none;}';
	$login_page_css .= 'body.login form input[type="text"], body.login #login_error, body.login .message {font-family: "Open Sans"; font-size: 13px;}';
	$login_page_css .= 'body.login form input[type="text"] {padding: 12px 20px;}';
	$login_page_css .= 'body.login form input[type="password"], body.login form input[type="email"] {margin-bottom: 26px;}';
	$login_page_css .= 'body.login form p.submit {float: left; height: 43px; width: 50%; position: relative;}';
	$login_page_css .= 'body.login form p.submit input[type="submit"] {border: none; font-family: "Montserrat"; font-weight: 400; text-transform: uppercase; color: #fff; text-shadow: none; box-shadow: none; background: '.esc_attr($third_color).'; border-radius: 22px; height: inherit; letter-spacing: 1px; font-size: 11px; width: 100%; padding-left: 30px; -webkit-transition: all .3s ease; -moz-transition: all .3s ease; transition: all .3s ease}';
	$login_page_css .= 'body.login form p.submit input[type="submit"]:hover {background: '.esc_attr($third_hover_color).';}';
	$login_page_css .= 'body.login-action-register form p.submit input[type="submit"] {padding-left: 12px;}';
	$login_page_css .= 'body.login-action-register #login form#registerform p.submit {padding-bottom: 0;}';
	$login_page_css .= 'body.login.login-action-register form p.submit:before {left: 40px;}';
	$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"] {position: relative; width: 18px; height: 18px; background: transparent; border-color: transparent; -webkit-box-shadow: none; box-shadow: none;}';
	$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"]:before {content: ""; display: block; width: 16px; height: 16px; position: absolute; left: 50%; top: 50%; margin-top: -9px; margin-left: -9px; background: '.esc_attr($input_bg).'; border: 1px solid #e7e7e7; -webkit-transition: background .3s ease, border-color .3s ease; -moz-transition: background .3s ease, border-color .3s ease; transition: background .3s ease, border-color .3s ease;}';
	$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"]:checked:before {background: '.esc_attr($third_color).'; border-color: '.esc_attr($third_color).';}';
	$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"]:checked:after {-webkit-transform: translate(-50%,-50%) scale(1); -moz-transform: translate(-50%,-50%) scale(1); -o-transform: translate(-50%,-50%) scale(1); transform: translate(-50%,-50%) scale(1);}';
	$login_page_css .= 'body.login form .forgetmenot label input[type="checkbox"]:after {content: "\ea3d"; font-family: "dfd-socicons-font"; font-size: 10px; display: block; position: absolute; top: 50%; left: 50%; color: #fff; -webkit-transform: translate(-50%,-50%) scale(0); -moz-transform: translate(-50%,-50%) scale(0); -o-transform: translate(-50%,-50%) scale(0); transform: translate(-50%,-50%) scale(0); -webkit-transition: -webkit-transform .3s ease; -moz-transition: -moz-transform .3s ease; transition: transform .3s ease;}';
	$login_page_css .= 'body.login #nav, body.login #backtoblog {font-family: "Montserrat"; font-size: 12px; font-style: normal; font-weight: 700; text-transform: none; line-height: 1; letter-spacing: -.4px; color: '.esc_attr($title_color).'; padding: 0 20px; -webkit-transition: color .3s ease; -moz-transition: color .3s ease; transition: color .3s ease}';
	$login_page_css .= 'body.login #nav a, body.login #backtoblog a {-webkit-transition: color .3s ease; -moz-transition: color .3s ease; transition: color .3s ease}';
	$login_page_css .= 'body.login #nav > a, body.login #backtoblog > a {color: inherit;}';
	$login_page_css .= 'body.login form p.submit label {line-height: 43px; position: absolute; color: #ffffff; left: 50px; padding: 0; font-size: 12px;}';
	/*if error & message*/
	$login_page_css .= '.interim-login.login .message {width: 100%; margin-left: -20px;}';
	$login_page_css .= 'body.login #login_error, body.login .message {border-left-width: 0; margin: 0 -20px; border-top: 1px solid #dddddd; -webkit-box-shadow: none; box-shadow: none; overflow: hidden; padding: 20px 20px 0; position: relative; margin-top: 68px;}';
	$login_page_css .= 'body.login #login_error strong {font-family: "Montserrat"; color: #e96c6c; font-size: 11px;}';
	/*420*/
	$login_page_css .= '@media only screen and (max-width: 420px) {'
							. 'body > .logo, body.login form p.submit label {display: none;}'
							. 'body.login form p.submit input[type="submit"] {padding-left: 12px;}'
						. '}';
	/*340*/
	$login_page_css .= '@media only screen and (max-width: 340px) {'
							. 'body.login form .forgetmenot {width: 100%; margin-bottom: 20px !important; text-align: center;}'
							. 'body.login form p.submit {width: 100%;}'
						. '}';
	$login_page_js .=	'<script type="text/javascript">
							(function($) {
								var $link = "<link href=\"https://fonts.googleapis.com/css?family=Montserrat:400,700\" rel=\"stylesheet\">";
								$link = $link + "<link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\">";
								$(document).ready(function() {
									$("head").append($link);

									var $self = $("body.login #login");
									var $error = $self.find("#login_error");
									var $errorClone = $error.clone()
									var $message = $self.find(".message");
									var $messageClone = $message.clone()
									var $appendIconHtml = $self.find("#loginform p.submit").append("<label for=\"wp-submit\" class=\"dfd-socicon-04_In_alt\"></label>");
									if($error) {
										$self.find("form#loginform").append($errorClone);
										$error.remove();
									}
									if($message) {
										$self.find("form#loginform").append($messageClone);
										$message.remove();
									}
									$appendIconHtml;

									$("#loginform").prepend("<p class=\"login-title\">'.esc_html__('Log in on', 'dfd-native').' <span>'.esc_html__('site', 'dfd-native').'</span></p>");
									if($("#login > h1 > a")) {
										var $logo = $("#login > h1 > a"),
											$logoClone = $logo.clone(),
											$logoCloneApImg = $logoClone.append("<img src=\"'. esc_url($custom_logo) .'\" alt=\"\" />");
										$logoClone.prependTo("body").addClass("logo");
										$logo.remove();
									}
								});
							})(jQuery);
						</script>';
}

$login_page_css .= '.logo img {display: block; margin: 0 auto;}';
$login_page_css .= '.login h1 a { background-repeat: no-repeat; background-image:url('. esc_url($custom_logo) .') !important; height: auto !important; min-height: 42px !important; width: 206px !important; background-size: contain !important; background-position: center;}';

$login_page_css = '<style type="text/css">'.$login_page_css.'</style>';

echo $before_login_page_css;
echo $login_page_css;
echo $login_page_js;