<?php
/**
 * Scripts and stylesheets
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (!function_exists('dfd_themes_scripts')) {
	/**
	 * Enqueue front scripts and styles
	 * @global obj $woocommerce
	 */
	function dfd_themes_scripts() {
		global $dfd_native;
		/*
		 * Css styles
		 */
		wp_register_style('dfd_site_style', get_template_directory_uri() . '/assets/css/app.css', false, null);
		
		wp_register_style('dfd_mobile_responsive', get_template_directory_uri() . '/assets/css/mobile-responsive.css', false, null);
		
		wp_enqueue_style('dfd_site_style');
		
		/**
		 * Check if WooCommerce is active
		 * */
		if (class_exists('WooCommerce')) {
			$woocommerce_css_file = get_template_directory_uri() . '/assets/css/woocommerce.css';
			
			wp_register_style('dfd_wocommerce_style', $woocommerce_css_file, false, null);
			wp_enqueue_style('dfd_wocommerce_style');
		}
		
		/**
		 * mobile responsive
		 */
		if (!isset($dfd_native['mobile_responsive']) || $dfd_native['mobile_responsive'] != '0') {
			wp_enqueue_style('dfd_mobile_responsive');
		}
		
		if(class_exists('ReduxFramework') && isset(ReduxFramework::$_upload_url) && isset(ReduxFramework::$_upload_dir) && file_exists(ReduxFramework::$_upload_dir . 'options.css') && isset($dfd_native['enqueue_styles_file']) && $dfd_native['enqueue_styles_file'] == 'on') {
			wp_enqueue_style('dfd_theme_options', ReduxFramework::$_upload_url . 'options.css', false, null);
		}
		
		if(!class_exists('Dfd_Theme_extensions')) {
			$font_url = add_query_arg( 'family', urlencode( 'Open Sans:300,300italic,400,400italic,600,600italic,700italic,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
			wp_enqueue_style('dfd_defalt_fonts', $font_url, false, null);
			wp_enqueue_style('dfd_default_icons', get_template_directory_uri() . '/assets/fonts/dfd_icon_set.css', false, null);
		}
		
		wp_enqueue_style( 'main-style', get_stylesheet_uri(), false, null );
		
		if(function_exists('dfd_custom_page_style')){
			dfd_custom_page_style();
		}
		
		/* RTL support */
		if(is_rtl()) {
			wp_enqueue_style('dfd_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false, null);
		}
		
		/*
		 * JS register
		 */
		
		$google_api_key = 'AIzaSyCEc0PM7rpun59m20yBBtRsl62I6eEsKl4';
		if(isset($dfd_native['custom_google_api_key']) && !empty($dfd_native['custom_google_api_key'])) {
			$google_api_key = $dfd_native['custom_google_api_key'];
		}
		
		wp_register_script('gmaps', '//maps.googleapis.com/maps/api/js?key='.$google_api_key, array('jquery'), null, false, true);
		
		wp_register_script('gmap3', get_template_directory_uri() . '/assets/js/gmap3.min.js', array('jquery'), null, true, true);
		wp_register_script('dfd_gmap', get_template_directory_uri() . '/assets/js/dfd_gmap.js', array('jquery'), null, true, true);
		
		wp_register_script('dfd_woocommerce_scripts', get_template_directory_uri() . '/assets/js/woocommerce.js', array('jquery'), null, true);

		// Video Player
		wp_register_script('dfd_zencdn_video_js', get_template_directory_uri() . '/assets/js/video-js.js', array('jquery'), null);
		
		// Facebook Widget
		wp_register_script('dfd_facebook_widget_script', get_template_directory_uri().'/assets/js/widget-facebook.js', array('jquery'), null, true);

		// keyframe
		
		// ajax pagination
		wp_register_script('ajax-pagination', get_template_directory_uri().'/assets/js/ajax-pagination.js', array('jquery'), null, true);
		wp_register_script('dfd-lazy-load', get_template_directory_uri().'/assets/js/ajax-lazy-load.js', array('jquery'), null, true);
		
		//slick slider
		
		wp_register_script('dfd-particleground', get_template_directory_uri().'/assets/js/jquery.particleground.min.js', array('jquery'), null, true);
		wp_register_script('dfd-particleground-old', get_template_directory_uri().'/assets/js/jquery.particleground.old.min.js', array('jquery'), null, true);
		
		wp_register_script('dfd-canvas-bg-first', get_template_directory_uri().'/assets/js/dfd_canvas_bg_style_1.js', array('jquery'), null, true);
		
		wp_register_script('dfd-canvas-bg-third', get_template_directory_uri().'/assets/js/dfd_canvas_bg_style_3.js', array('jquery'), null, true);
		
		wp_register_script('dfd-jparallax', get_template_directory_uri().'/assets/js/jquery.parallax.js', array('jquery'), null, false);
		
//		wp_register_script('dfd-sly', get_template_directory_uri().'/assets/js/sly.min.js', array('jquery'), null, false);
		
//		wp_register_script('dfd-jpcqarallax', get_template_directory_uri().'/assets/js/jquery.parallax.js', array('jquery'), null, false);
		
		/*
		 * JS enquene
		 */
		if(!isset($dfd_native['dev_mode']) || $dfd_native['dev_mode'] != 'on' || !defined('DFD_DEBUG_MODE') || !DFD_DEBUG_MODE) {
			if (strcmp(DfdMetaBoxSettings::compared('site_preloader_enabled', 'off'),'1')===0) {
				wp_register_script('dfd_queryloader2', get_template_directory_uri() . '/assets/js/jquery.queryloader2.min.js', array('jquery'), '2', false, true);
				wp_enqueue_script('dfd_queryloader2');
			}
			wp_register_script('dfd_js_plugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), null, true);
			wp_localize_script('dfd_js_plugins', 'ajax_var', array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('ajax-nonce')
			));
			wp_enqueue_script('dfd_js_plugins');
			
			wp_register_script('dfd.onepagescroll', get_template_directory_uri().'/assets/js/jquery.fullPage.min.js', array('jquery'), null, true);
			wp_register_script('dfd-multislider', get_template_directory_uri().'/assets/js/jquery.multiscroll.min.js', array('jquery'), null, true);
			
		} else {
			wp_register_script('dfd_foundation', get_template_directory_uri() . '/assets/js/foundation.js', array('jquery'), null, true);
			wp_register_script('keyframes', get_template_directory_uri().'/assets/js/jquery.keyframes.min.js', array('jquery'), null, true);
			wp_register_script('dfd_effects', get_template_directory_uri() . '/assets/js/animation.js', array('jquery'), null, true);
			wp_register_script('mmenu', get_template_directory_uri().'/assets/js/jquery.sidr.js', array('jquery'), null, true);
			wp_register_script('slick', get_template_directory_uri().'/assets/js/jquery.slick.min.js', array('jquery'), null, true);
			wp_register_script('dfd_scrollTo', get_template_directory_uri().'/assets/js/jquery.scrollTo.js', array('jquery'), null, true);
			wp_register_script('jquery.easing', get_template_directory_uri().'/assets/js/jquery.easing.js', array('jquery'), null, true);
			wp_register_script('dfd-folio-hover', get_template_directory_uri().'/assets/js/jquery.hoverdir.js', array('jquery'), null, true);
			wp_register_script('dfd-chaffle', get_template_directory_uri().'/assets/js/jquery.chaffle.js', array('jquery'), null, true);
			wp_register_script('prettyphoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.js', array('jquery'), null, true, true);
			wp_register_script('custom-share', get_template_directory_uri() . '/assets/js/share.js', array('jquery'), null, true);
			wp_register_script('vertical_js', get_template_directory_uri() . '/assets/js/vertical.js', array('jquery'), null, true);
			wp_register_script('dropkick', get_template_directory_uri() . '/assets/js/jquery.dropkick-min.js', array('jquery'), null, true);
			wp_register_script('isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'), null, true);
			wp_register_script('justified', get_template_directory_uri() . '/assets/js/justifiedGallery.js', array('jquery'), null, true);
			wp_register_script('dfd-3d-hover', get_template_directory_uri() . '/assets/js/jquery.hover3d.js', array('jquery'), null, true);
			wp_register_script('dfd-sticky-kit', get_template_directory_uri() . '/assets/js/sticky-kit.js', array('jquery'), null, true);
			wp_register_script('dfd-tween-max', get_template_directory_uri().'/assets/js/TweenMax.min.js', array('jquery'), null, true);
			wp_register_script('dfd-mousestop', get_template_directory_uri().'/assets/js/mousestop.js', array('jquery'), null, true);
			wp_register_script('dfd-images-loaded', get_template_directory_uri().'/assets/js/imagesloaded.pkgd.js', array('jquery'), null, true);
			wp_register_script('dfd-fancy-text', get_template_directory_uri().'/assets/js/fancy-text.js', array('jquery'), null, true);
			wp_register_script('dfd-svg-loaded', get_template_directory_uri().'/assets/js/svgLoader.js', array('jquery'), null, true);
			wp_register_script('dfd-hotspot', get_template_directory_uri().'/assets/js/jquery.hotspot.js', array('jquery'), null, true);
			wp_register_script('dfd-multislider', get_template_directory_uri().'/assets/js/jquery.multiscroll.js', array('jquery'), null, true);
			wp_register_script('dfd_main', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), null, true);
			wp_localize_script('dfd_main', 'ajax_var', array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('ajax-nonce')
			));
			
			wp_register_script('smooth-scroll', get_template_directory_uri() . '/assets/js/jquery.smoothscroll.js', array('jquery'), null, true);
			
			wp_register_script('dfd_slide_parallax', get_template_directory_uri() . '/assets/js/jquery.slide_parallax.js', array('jquery'), null, true);
			
			wp_register_script('dfd-typed', get_template_directory_uri().'/assets/js/typed.js', array('jquery'), null, false);
			
			wp_register_script('dfd-swiper', get_template_directory_uri().'/assets/js/swiper.js', array('jquery'), null, false);
			
			wp_register_script('dfd.onepagescroll', get_template_directory_uri().'/assets/js/jquery.fullPage.js', array('jquery'), null, true);
			
			wp_register_script('js-audio', get_template_directory_uri().'/assets/js/audioplayer.js', array('jquery'), null, true);
			
			wp_register_script('mega_menu', get_template_directory_uri().'/assets/js/jquery.mega-menu.js', array('jquery'), null, true);
			
			wp_register_script('mega_menu_run', get_template_directory_uri().'/assets/js/jquery.mega-menu.run.js', array('jquery'), null, true);
			
			wp_register_script('countdown-js',get_template_directory_uri().'/assets/js/jquery.countdown.min.js',array('jquery'));
			
			wp_register_script( 'odometer-js', get_template_directory_uri() . '/assets/js/odometer.min.js', array( 'jquery' ), false, true );
			
			wp_register_script( 'piechart-js', get_template_directory_uri() . '/assets/js/circle-progress.js', array( 'jquery' ), false, true );
			
			if (strcmp(DfdMetaBoxSettings::compared('site_preloader_enabled', 'off'),'1')===0) {
				wp_register_script('dfd_queryloader2', get_template_directory_uri() . '/assets/js/jquery.queryloader2.js', array('jquery'), '2', false, true);
				wp_enqueue_script('dfd_queryloader2');
			}
			
			wp_enqueue_script('dfd_foundation');
			wp_enqueue_script('keyframes');
			wp_enqueue_script('dfd-chaffle');
			wp_enqueue_script('js-audio');

			wp_enqueue_script('dfd_effects');
			wp_enqueue_script('isotope');
			wp_enqueue_script('justified');
			wp_enqueue_script('dfd-3d-hover');
			wp_enqueue_script('dfd-sticky-kit');
			wp_enqueue_script('dfd-tween-max');
			wp_enqueue_script('dfd-mousestop');
			wp_enqueue_script('dfd-images-loaded');
			wp_enqueue_script('dfd-svg-loaded');

			wp_enqueue_script('slick');
			wp_enqueue_script('dfd_scrollTo');
			wp_enqueue_script('jquery.easing');
			wp_enqueue_script('custom-share');
			wp_enqueue_script('vertical_js');
			wp_enqueue_script('dropkick');
			wp_enqueue_script('prettyphoto');

			wp_enqueue_script('dfd-swiper');

			wp_enqueue_script('mmenu');

			wp_enqueue_script('dfd-folio-hover');

			wp_enqueue_script('dfd-panr', get_template_directory_uri().'/assets/js/jquery.panr.js', array('jquery'), null, true);
			
			wp_enqueue_script('mega_menu');
			
			wp_enqueue_script('mega_menu_run');
		
			wp_enqueue_script('smooth-scroll');
			
			wp_enqueue_script('countdown-js');
			wp_enqueue_script( 'odometer-js');
			wp_enqueue_script( 'piechart-js' );
			
			wp_enqueue_script('dfd_main');
		}
		
		if (class_exists('WooCommerce')) {
			wp_enqueue_script('dfd_woocommerce_scripts');
		}
		
		# Load script/styles for page templates
		if (is_page()) {
			$curr_page_template = basename(get_page_template());

			if($curr_page_template == 'tmp-one-page-scroll.php') {
				wp_enqueue_script('dfd.onepagescroll');
			}

			if($curr_page_template == 'tmp-side-by-side.php') {
				wp_enqueue_script('dfd-multislider');
			}
		}
		if(function_exists('dfd_print_head_js')){
			dfd_print_head_js();
		}
	}
}

if (!function_exists('dfd_themes_admin_css')) {
	/**
	 * Enqueue admin scripts and styles
	 */
	function dfd_themes_admin_scripts($hook) {
		wp_register_style('dfd-admin-style', get_template_directory_uri() . '/assets/css/admin-panel.css');
		wp_enqueue_style('dfd-admin-style');
		
		wp_register_script('dfd_post_metaboxes_gallery', get_template_directory_uri().'/assets/admin/js/posts-gallery.js', array( 'jquery' ), false, true);
		wp_register_script('dfd_portfolio_metaboxes_gallery', get_template_directory_uri().'/assets/admin/js/portfolio-gallery.js', array( 'jquery' ), false, true);
		wp_register_script('dfd_gallery_metaboxes_gallery', get_template_directory_uri().'/assets/admin/js/gallery-gallery.js', array( 'jquery' ), false, true);
		
		wp_enqueue_script('dfd_admin_script', get_template_directory_uri().'/assets/admin/js/admin-scripts.js', array('jquery'), false, true);
		
		if(class_exists( 'Vc_Manager', false )) {
			global $dfd_native;

			$min = '.min';
			
			if(isset($dfd_native['dev_mode']) && $dfd_native['dev_mode'] == 'on' && defined('DFD_DEBUG_MODE') && DFD_DEBUG_MODE) {
				$min = '';
			}
			
			if(wp_script_is( 'vc-frontend-editor-min-js', 'enqueued' )) {
				wp_enqueue_script('vc-inline-editor',get_template_directory_uri().'/assets/admin/js/vc-inline-editor'.$min.'.js',array('vc-frontend-editor-min-js'),'1.5',true);
			} elseif(wp_script_is( 'vc_inline_custom_view_js', 'enqueued' )) {
				wp_enqueue_script('vc-inline-editor',get_template_directory_uri().'/assets/admin/js/vc-inline-editor.min.js',array('vc_inline_custom_view_js'),'1.5',true);
			}

			if($hook == "post.php" || $hook == "post-new.php" || $hook == "edit.php"){
				wp_enqueue_script('dfd_vc_admin_scripts', get_template_directory_uri().'/assets/admin/js/vc_admin_scripts.js', array('jquery'), false, true);
			}
			
			if(function_exists('dfd_admin_custom_css')) {
				dfd_admin_custom_css();
			}
		}
		
		if(class_exists('cmb_Meta_Box') && function_exists('dfd_metaboxes_enctype')) {
			dfd_metaboxes_enctype();
		}
	}
}

if(!function_exists('dfd_admin_custom_css')) {
	function dfd_admin_custom_css() {
		global $dfd_native;
		
		if(isset($dfd_native['custom_admin_css']) && !empty($dfd_native['custom_admin_css']) && function_exists('wp_add_inline_style')) {
			wp_add_inline_style('dfd-admin-style', $dfd_native['custom_admin_css']);
		}
	}
}

if(!function_exists('dfd_metaboxes_enctype')) {
	function dfd_metaboxes_enctype() {
		global $pagenow;
		
		$js = '';
		
		if ( in_array( $pagenow, array( 'page.php', 'page-new.php', 'post.php', 'post-new.php' ) ) ) {
			$js .= dfd_metaboxes_enctype_js();
		}
		
		if ( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ) ) ) {
			$js .= dfd_metaboxes_enctype_js('your-profile');
		}
		
		if(function_exists('wp_add_inline_script')) {
			wp_add_inline_script('dfd_admin_script', $js);
		}
	}
}

if(!function_exists('dfd_metaboxes_enctype_js')) {
	function dfd_metaboxes_enctype_js($id = 'post') {
		return 'jQuery(document).ready(function(){
					jQuery("#'. esc_js($id) .'").attr("enctype", "multipart/form-data");
					jQuery("#'. esc_js($id) .'").attr("encoding", "multipart/form-data");
				});';
	}
}

if (!function_exists('dfd_custom_page_style')) {
	function dfd_custom_page_style() {
		global $dfd_native;
		$css_rules = '';

		$p_bg_color = DfdMetaboxSettings::get('crum_page_custom_bg_color');
		$p_bg_image = DfdMetaboxSettings::get('crum_page_custom_bg_image');
		$p_bg_fixed = DfdMetaboxSettings::get('crum_page_custom_bg_fixed');
		$p_bg_repeat = DfdMetaboxSettings::get('crum_page_custom_bg_repeat');
		$p_bg_size = DfdMetaboxSettings::get('crum_page_custom_bg_size');
		
		if ((strcmp($p_bg_color,'#')!==0) && !empty($p_bg_color)) {
			$css_rules .= 'background-color: '. esc_attr($p_bg_color) .' !important;';
		} elseif(!class_exists('Dfd_Theme_Extensions')) {
			$css_rules .= 'background-color: #f4f4f4 !important;';
		}
		if(!empty($p_bg_image)) {
			$css_rules .= 'background-image: url('. esc_url($p_bg_image) .') !important;';
			$css_rules .= 'background-position: center 0 !important;';
		}
		if(!empty($p_bg_repeat)) {
			$css_rules .= 'background-repeat: '. esc_attr($p_bg_repeat) .' !important;';
		}
		if ($p_bg_size) {
			$css_rules .= 'background-size: '. esc_attr($p_bg_size) .' !important;';
		}
		
		ob_start();
		if((function_exists('is_customize_preview') && is_customize_preview()) || !class_exists('ReduxFramework') || !isset(ReduxFramework::$_upload_url) || !isset(ReduxFramework::$_upload_dir) || !file_exists(ReduxFramework::$_upload_dir . 'options.css') || !isset($dfd_native['enqueue_styles_file']) || $dfd_native['enqueue_styles_file'] == 'off') {
			require get_template_directory().'/inc/styles.php';
		}
		if($css_rules != '') {
			if($p_bg_fixed) {
				echo 'body:before {'
						. 'content: "";'
						. 'display: block;'
						. 'position: fixed;'
						. 'top: 0;'
						. 'bottom: 0;'
						. 'left: 0;'
						. 'right: 0;'
						. $css_rules
						. '-webkit-transform:translate3d(0, 0, 0);'
					. '}';
			} else {
				echo 'body {'.$css_rules.'}';
			}
		}
		$output = ob_get_clean();
		if(function_exists('wp_add_inline_style')) {
			wp_add_inline_style('main-style', $output);
		}
	}
}

if (!function_exists('dfd_print_head_js')) {
	function dfd_print_head_js() {
		$output = '';
		
//		$output .= "
//				(function($) {
//					'use strict';
//					var head = document.head || document.getElementsByTagName('head')[0],
//						style = document.createElement('style');
//
//					style.id = 'dfd-dynamic-head-css';
//
//					head.appendChild(style);
//
//					var styleElem = document.getElementById('dfd-dynamic-head-css');
//
//					var MutationObserver = window.MutationObserver || window.WebKitMutationObserver,
//						eventListenerSupported = window.addEventListener,
//						callback = function(el) {
//							if(el.hasClass('dfd-dynamic-styles-container') && el.text() != '') {
//								setTimeout(function() {
//									if (styleElem.styleSheet){
//										styleElem.styleSheet.cssText = el.text();
//									} else {
//										styleElem.appendChild(document.createTextNode(el.text()));
//									}
//									el.remove();
//								},0);
//							}
//						};
//
//					if( MutationObserver ){
//						var obs = new MutationObserver(function(mutations){
//							mutations.forEach(function(mutation) {
//								callback($(mutation.target));
//							});
//						});
//						obs.observe( $('html')[0], { childList:true, subtree: true });
//					} else if( eventListenerSupported ){
//						$('html')[0].addEventListener('DOMNodeInserted', function(ev){callback($(ev.relatedNode));}, false);
//					}
//				})(jQuery);
//			";
		
		global $dfd_native;
		
		if(isset($dfd_native['head_custom_js']) && !empty($dfd_native['head_custom_js'])) {
			$output .= $dfd_native['head_custom_js'];
		}
		
		if(function_exists('wp_add_inline_script')) {
			wp_add_inline_script('jquery-migrate', $output);
		}
	}
}
