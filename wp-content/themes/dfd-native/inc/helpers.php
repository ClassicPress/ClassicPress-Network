<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('DfdMetaBoxSettings')) {
	/**
	 * Metaboxes and options values
	 *
	 *
	 * @class 		DfdMetaBoxSettings
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class DfdMetaBoxSettings {
		/**
		 * Returns metabox option.
		 *
		 * @param $name
		 *
		 * @return string|bool
		 */
		public static function get($name) {
			global $post;

			if (isset($post) && !empty($post->ID) && !is_archive() && !is_search() && !is_404()) {
				return get_post_meta($post->ID, $name, true);
			}

			return false;
		}
		/**
		 * Checks if metabox value is defined then checks if param value is defined from theme options.
		 *
		 * @param $name
		 * @param $default
		 *
		 * @return string|bool
		 */
		public static function compared($name, $default = '') {
			global $dfd_native;

			$value = self::get($name);
			if($value || $value != '') {
				return $value;
			} elseif(!$value && isset($dfd_native[$name]) && !empty($dfd_native[$name])) {
				return $dfd_native[$name];
			} else {
				return $default;
			}
		}
	}
}
if(!class_exists('Dfd_Theme_Helpers')) {
	/**
	 * Theme core helpers class
	 *
	 *
	 * @class 		Dfd_Theme_Helpers
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class Dfd_Theme_Helpers {
		/**
		 * Returns array of supported social networks.
		 *
		 * @return array
		 */
		public static function social_networks () {
			return array(
				/*
				'foursquare'         => array('name'=>'Foursquare','icon'=>'soc_icon-foursquare_2'),
				'livejournal'        => array('name'=>'Livejournal','icon'=>'soc_icon-livejournal'),
				'mail'               => array('name'=>'Mail','icon'=>'dfd-added-font-icon-vb'),
				*/
				'facebook'           => array('name'=>'Facebook','icon'=>'dfd-socicon-facebook'),
				'youtube'            => array('name'=>'Youtube','icon'=>'dfd-socicon-youtube'),
				'google'             => array('name'=>'Google+','icon'=>'dfd-socicon-google-plus'),
				'twitter'            => array('name'=>'Twitter','icon'=>'dfd-socicon-twitter'),
				'vimeo'              => array('name'=>'Vimeo','icon'=>'dfd-socicon-vimeo'),
				'skype'              => array('name'=>'Skype','icon'=>'dfd-socicon-skype'),
				'instagram'          => array('name'=>'Instagram','icon'=>'dfd-socicon-instagram'),
				'linkedin'           => array('name'=>'LinkedIN','icon'=>'dfd-socicon-linkedin'),
				'picasa'             => array('name'=>'Picasa','icon'=>'dfd-socicon-picasa'),
				'dropbox'            => array('name'=>'Dropbox','icon'=>'dfd-socicon-dropbox'),
				'pinterest'          => array('name'=>'Pinterest','icon'=>'dfd-socicon-pinterest'),
				'deviantart'         => array('name'=>'Deviantart','icon'=>'dfd-socicon-deviantart'),
				'digg'               => array('name'=>'Digg','icon'=>'dfd-socicon-digg'),
				'dribbble'           => array('name'=>'Dribbble','icon'=>'dfd-socicon-dribbble'),
				'evernote'           => array('name'=>'Evernote','icon'=>'dfd-socicon-evernote'),
				'flickr'             => array('name'=>'Flickr','icon'=>'dfd-socicon-flickr'),
				'last_fm'            => array('name'=>'Last FM','icon'=>'dfd-socicon-lastfm'),
				'rss'                => array('name'=>'RSS','icon'=>'dfd-socicon-rss'),
				'tumblr'             => array('name'=>'Tumblr','icon'=>'dfd-socicon-tumblr'),
				'wordpress'          => array('name'=>'WordPress','icon'=>'dfd-socicon-wordpress'),
				'px_500'             => array('name'=>'500 px','icon'=>'dfd-socicon-px-icon'),
				'viewbug'            => array('name'=>'ViewBug','icon'=>'dfd-socicon-vb'),
				'xing'               => array('name'=>'Xing','icon'=>'dfd-socicon-b_Xing-icon_bl'),
				'spotify'            => array('name'=>'Spotify','icon'=>'dfd-socicon-spotify'),
				'houzz'              => array('name'=>'Houzz','icon'=>'dfd-socicon-houzz-dark-icon'),
				'slideshare'         => array('name'=>'Slideshare','icon'=>'dfd-socicon-slideshare'),
				'bandcamp'           => array('name'=>'Bandcamp','icon'=>'dfd-socicon-bandcamp-logo'),
				'soundcloud'         => array('name'=>'Soundcloud','icon'=>'dfd-socicon-soundcloud'),
				'meerkat'            => array('name'=>'Meerkat','icon'=>'dfd-socicon-Meerkat-color'),
				'periscope'          => array('name'=>'Periscope','icon'=>'dfd-socicon-periscope'),
				'snapchat'           => array('name'=>'Snapchat','icon'=>'dfd-socicon-snapchat'),
				'thecity'            => array('name'=>'The City','icon'=>'dfd-socicon-the-city'),
				'behance'            => array('name'=>'Behance','icon'=>'dfd-socicon-behance'),
				'microsoft_pinpoint' => array('name'=>'Microsoft Pinpoint','icon'=>'dfd-socicon-pinpoint'),
				'viadeo'             => array('name'=>'Viadeo','icon'=>'dfd-socicon-viadeo'),
				'vkontakte'          => array('name'=>'VKontakte','icon'=>'dfd-socicon-vkontakte'),
				'ok'				 => array('name'=>'Odnoklassniki','icon'=>'dfd-socicon-ok'),
				'email'				 => array('name'=>'Email','icon'=>'dfd-socicon-mail'),
			);
		}
		/**
		 * Generates social networks param for VC.
		 *
		 * @param $soc_networks
		 *
		 * @return array
		 */
		public static function generate_soc_networks( $soc_networks ) {

			$vc_map_socnetworks = array();

			foreach ( $soc_networks as $key => $value ) {
				$vc_map_socnetworks[] = array(
					"type"       => "textfield",
					"heading"    => $value['name'],
					"param_name" => $key,
					"group"      => esc_html__( 'Soc accounts', 'dfd-native' ),
				);
			}

			return $vc_map_socnetworks;
		}
		/**
		 * Returns animations list.
		 *
		 * @return array
		 */
		public static function animation_lists() {
			return array(
				esc_attr__('Bounce','dfd-native') => 'bounce',
				esc_attr__('Flash','dfd-native') => 'flash',
				esc_attr__('Pulse','dfd-native') => 'pulse',
				esc_attr__('Rubber Band','dfd-native') => 'rubberBand',
				esc_attr__('Shake','dfd-native') => 'shake',
				esc_attr__('Swing','dfd-native') => 'swing',
				esc_attr__('Tada','dfd-native') => 'tada',
				esc_attr__('Wobble','dfd-native') => 'wobble',
				esc_attr__('Jello','dfd-native') => 'jello',
				esc_attr__('BounceIn','dfd-native') => 'bounceIn',
				esc_attr__('BounceInDown','dfd-native') => 'bounceInDown',
				esc_attr__('BounceInLeft','dfd-native') => 'bounceInLeft',
				esc_attr__('BounceInRight','dfd-native') => 'bounceInRight',
				esc_attr__('BounceInUp','dfd-native') => 'bounceInUp',
				esc_attr__('FadeIn','dfd-native') => 'fadeIn',
				esc_attr__('FadeInDown','dfd-native') => 'fadeInDown',
				esc_attr__('FadeInDownBig','dfd-native') => 'fadeInDownBig',
				esc_attr__('FadeInLeft','dfd-native') => 'fadeInLeft',
				esc_attr__('FadeInLeftBig','dfd-native') => 'fadeInLeftBig',
				esc_attr__('FadeInRight','dfd-native') => 'fadeInRight',
				esc_attr__('FadeInRightBig','dfd-native') => 'fadeInRightBig',
				esc_attr__('FadeInUp','dfd-native') => 'fadeInUp',
				esc_attr__('FadeInUpBig','dfd-native') => 'fadeInUpBig',
				esc_attr__('Flip','dfd-native') => 'flip',
				esc_attr__('FlipInX','dfd-native') => 'flipInX',
				esc_attr__('FlipInY','dfd-native') => 'flipInY',
				esc_attr__('LightSpeedIn','dfd-native') => 'lightSpeedIn',
				esc_attr__('RotateIn','dfd-native') => 'rotateIn',
				esc_attr__('RotateInDownLeft','dfd-native') => 'rotateInDownLeft',
				esc_attr__('RotateInDownRight','dfd-native') => 'rotateInDownRight',
				esc_attr__('RotateInUpLeft','dfd-native') => 'rotateInUpLeft',
				esc_attr__('RotateInUpRight','dfd-native') => 'rotateInUpRight',
				esc_attr__('SlideInUp','dfd-native') => 'slideInUp',
				esc_attr__('SlideInDown','dfd-native') => 'slideInDown',
				esc_attr__('SlideInLeft','dfd-native') => 'slideInLeft',
				esc_attr__('SlideInRight','dfd-native') => 'slideInRight',
				esc_attr__('ZoomIn','dfd-native') => 'zoomIn',
				esc_attr__('ZoomInDown','dfd-native') => 'zoomInDown',
				esc_attr__('ZoomInLeft','dfd-native') => 'zoomInLeft',
				esc_attr__('ZoomInRight','dfd-native') => 'zoomInRight',
				esc_attr__('ZoomInUp','dfd-native') => 'zoomInUp',
				esc_attr__('Hinge','dfd-native') => 'hinge',
				esc_attr__('RollIn','dfd-native') => 'rollIn',
			);
		}
		/**
		 * Returns animations list.
		 *
		 * @return array
		 */
		public static function animation_lists_in() {
			return array(
				esc_html__('BounceIn','dfd-native') => 'bounceIn',
				esc_html__('BounceInDown','dfd-native') => 'bounceInDown',
				esc_html__('BounceInLeft','dfd-native') => 'bounceInLeft',
				esc_html__('BounceInRight','dfd-native') => 'bounceInRight',
				esc_html__('BounceInUp','dfd-native') => 'bounceInUp',
				esc_html__('FadeIn','dfd-native') => 'fadeIn',
				esc_html__('FadeInDown','dfd-native') => 'fadeInDown',
				esc_html__('FadeInDownBig','dfd-native') => 'fadeInDownBig',
				esc_html__('FadeInLeft','dfd-native') => 'fadeInLeft',
				esc_html__('FadeInLeftBig','dfd-native') => 'fadeInLeftBig',
				esc_html__('FadeInRight','dfd-native') => 'fadeInRight',
				esc_html__('FadeInRightBig','dfd-native') => 'fadeInRightBig',
				esc_html__('FadeInUp','dfd-native') => 'fadeInUp',
				esc_html__('FadeInUpBig','dfd-native') => 'fadeInUpBig',
				esc_html__('LightSpeedIn','dfd-native') => 'lightSpeedIn',
				esc_html__('RotateIn','dfd-native') => 'rotateIn',
				esc_html__('RotateInDownLeft','dfd-native') => 'rotateInDownLeft',
				esc_html__('RotateInDownRight','dfd-native') => 'rotateInDownRight',
				esc_html__('RotateInUpLeft','dfd-native') => 'rotateInUpLeft',
				esc_html__('RotateInUpRight','dfd-native') => 'rotateInUpRight',
				esc_html__('RollIn','dfd-native') => 'rollIn',
				esc_html__('ZoomIn','dfd-native') => 'zoomIn',
				esc_html__('ZoomInDown','dfd-native') => 'zoomInDown',
				esc_html__('ZoomInLeft','dfd-native') => 'zoomInLeft',
				esc_html__('ZoomInRight','dfd-native') => 'zoomInRight',
				esc_html__('ZoomInUp','dfd-native') => 'zoomInUp',
				esc_html__('SlideInDown','dfd-native') => 'slideInDown',
				esc_html__('SlideInLeft','dfd-native') => 'slideInLeft',
				esc_html__('SlideInRight','dfd-native') => 'slideInRight',
				esc_html__('SlideInUp','dfd-native') => 'slideInUp',
			);
		}
		/**
		 * Returns animations list.
		 *
		 * @return array
		 */
		public static function animation_lists_out() {
			return array(
				esc_html__('BounceOut','dfd-native') => 'bounceOut',
				esc_html__('BounceOutDown','dfd-native') => 'bounceOutDown',
				esc_html__('BounceOutLeft','dfd-native') => 'bounceOutLeft',
				esc_html__('BounceOutRight','dfd-native') => 'bounceOutRight',
				esc_html__('BounceOutUp','dfd-native') => 'bounceOutUp',
				esc_html__('FadeOut','dfd-native') => 'fadeOut',
				esc_html__('FadeOutDown','dfd-native') => 'fadeOutDown',
				esc_html__('FadeOutDownBig','dfd-native') => 'fadeOutDownBig',
				esc_html__('FadeOutLeft','dfd-native') => 'fadeOutLeft',
				esc_html__('FadeOutLeftBig','dfd-native') => 'fadeOutLeftBig',
				esc_html__('FadeOutRight','dfd-native') => 'fadeOutRight',
				esc_html__('FadeOutRightBig','dfd-native') => 'fadeOutRightBig',
				esc_html__('FadeOutUp','dfd-native') => 'fadeOutUp',
				esc_html__('FadeOutUpBig','dfd-native') => 'fadeOutUpBig',
				esc_html__('LightSpeedOut','dfd-native') => 'lightSpeedOut',
				esc_html__('RotateOut','dfd-native') => 'rotateOut',
				esc_html__('RotateOutDownLeft','dfd-native') => 'rotateOutDownLeft',
				esc_html__('RotateOutDownRight','dfd-native') => 'rotateOutDownRight',
				esc_html__('RotateOutUpLeft','dfd-native') => 'rotateOutUpLeft',
				esc_html__('RotateOutUpRight','dfd-native') => 'rotateOutUpRight',
				esc_html__('RollOut','dfd-native') => 'rollOut',
				esc_html__('ZoomOut','dfd-native') => 'zoomOut',
				esc_html__('ZoomOutDown','dfd-native') => 'zoomOutDown',
				esc_html__('ZoomOutLeft','dfd-native') => 'zoomOutLeft',
				esc_html__('ZoomOutRight','dfd-native') => 'zoomOutRight',
				esc_html__('ZoomOutUp','dfd-native') => 'zoomOutUp',
				esc_html__('SlideOutDown','dfd-native') => 'slideOutDown',
				esc_html__('SlideOutLeft','dfd-native') => 'slideOutLeft',
				esc_html__('SlideOutRight','dfd-native') => 'slideOutRight',
				esc_html__('SlideOutUp','dfd-native') => 'slideOutUp',
			);
		}
		/**
		 * Returns Google Maps styles array.
		 *
		 * @param bool $simple
		 *
		 * @return array
		 */
		public static function dfd_google_map_custom_styles($simple = false, $path = '') {
			$options = array(
				'subtle-grayscale'   => array(
					esc_attr__( 'Subtle Grayscale', 'dfd-native' ),
					"[{'featureType':'landscape','stylers':[{'saturation':-100},{'lightness':65},{'visibility':'on'}]},{'featureType':'poi','stylers':[{'saturation':-100},{'lightness':51},{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'road.arterial','stylers':[{'saturation':-100},{'lightness':30},{'visibility':'on'}]},{'featureType':'road.local','stylers':[{'saturation':-100},{'lightness':40},{'visibility':'on'}]},{'featureType':'transit','stylers':[{'saturation':-100},{'visibility':'simplified'}]},{'featureType':'administrative.province','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':-25},{'saturation':-100}]},{'featureType':'water','elementType':'geometry','stylers':[{'hue':'#ffff00'},{'lightness':-25},{'saturation':-97}]}]"
				),
				'calm-grayscale'     => array(
					esc_attr__( 'Calm detailed grayscale', 'dfd-native' ),
					"[{'featureType':'all','elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#333333'},{'lightness':40}]},{'featureType':'all','elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#ffffff'},{'lightness':16}]},{'featureType':'all','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#fefefe'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#fefefe'},{'lightness':17},{'weight':1.2}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'lightness':20},{'color':'#ececec'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'on'},{'color':'#f0f0ef'}]},{'featureType':'landscape.man_made','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#f0f0ef'}]},{'featureType':'landscape.man_made','elementType':'geometry.stroke','stylers':[{'visibility':'on'},{'color':'#d4d4d4'}]},{'featureType':'landscape.natural','elementType':'all','stylers':[{'visibility':'on'},{'color':'#ececec'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'lightness':21},{'visibility':'off'}]},{'featureType':'poi','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#d4d4d4'}]},{'featureType':'poi','elementType':'labels.text.fill','stylers':[{'color':'#303030'}]},{'featureType':'poi','elementType':'labels.icon','stylers':[{'saturation':'-100'}]},{'featureType':'poi.attraction','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.business','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.government','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.medical','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.park','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#dedede'},{'lightness':21}]},{'featureType':'poi.place_of_worship','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.school','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'poi.school','elementType':'geometry.stroke','stylers':[{'lightness':'-61'},{'gamma':'0.00'},{'visibility':'off'}]},{'featureType':'poi.sports_complex','elementType':'all','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffffff'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#ffffff'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#ffffff'},{'lightness':16}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#f2f2f2'},{'lightness':19}]},{'featureType':'water','elementType':'geometry','stylers':[{'color':'#dadada'},{'lightness':17}]}]"
				),
				'pnk2'               => array(
					esc_attr__( 'PNK2', 'dfd-native' ),
					"[{'featureType':'all','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'landscape','elementType':'all','stylers':[{'color':'#f2f2f2'}]},{'featureType':'poi','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'all','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','elementType':'all','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'color':'#b6e3f5'},{'visibility':'on'}]}]"
				),
				'pale-dawn'          => array(
					esc_attr__( 'Pale Dawn', 'dfd-native' ),
					"[{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#acbcc9'}]},{'featureType':'landscape','stylers':[{'color':'#f2e5d4'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'color':'#c5c6c6'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#e4d7c6'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#fbfaf7'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#c5dac6'}]},{'featureType':'administrative','stylers':[{'visibility':'on'},{'lightness':33}]},{'featureType':'road'},{'featureType':'poi.park','elementType':'labels','stylers':[{'visibility':'on'},{'lightness':20}]},{},{'featureType':'road','stylers':[{'lightness':20}]}]"
				),
				'blue-water'         => array(
					esc_attr__( 'Blue water', 'dfd-native' ),
					"[{'featureType':'water','stylers':[{'color':'#46bcec'},{'visibility':'on'}]},{'featureType':'landscape','stylers':[{'color':'#f2f2f2'}]},{'featureType':'road','stylers':[{'saturation':-100},{'lightness':45}]},{'featureType':'road.highway','stylers':[{'visibility':'simplified'}]},{'featureType':'road.arterial','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'administrative','elementType':'labels.text.fill','stylers':[{'color':'#444444'}]},{'featureType':'transit','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'off'}]}]"
				),
				'shades-of-grey'     => array(
					esc_attr__( 'Shades of Grey', 'dfd-native' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':17}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':29},{'weight':0.2}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':18}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':16}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':21}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#000000'},{'lightness':16}]},{'elementType':'labels.text.fill','stylers':[{'saturation':36},{'color':'#000000'},{'lightness':40}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#000000'},{'lightness':19}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'},{'lightness':20}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#000000'},{'lightness':17},{'weight':1.2}]}]"
				),
				'midnight-commander' => array(
					esc_attr__( 'Midnight Commander', 'dfd-native' ),
					"[{'featureType':'water','stylers':[{'color':'#021019'}]},{'featureType':'landscape','stylers':[{'color':'#08304b'}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#0c4152'},{'lightness':5}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#0b434f'},{'lightness':25}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'road.arterial','elementType':'geometry.stroke','stylers':[{'color':'#0b3d51'},{'lightness':16}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'color':'#000000'}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'elementType':'labels.text.stroke','stylers':[{'color':'#000000'},{'lightness':13}]},{'featureType':'transit','stylers':[{'color':'#146474'}]},{'featureType':'administrative','elementType':'geometry.fill','stylers':[{'color':'#000000'}]},{'featureType':'administrative','elementType':'geometry.stroke','stylers':[{'color':'#144b53'},{'lightness':14},{'weight':1.4}]}]"
				),
				'retro'              => array(
					esc_attr__( 'Retro', 'dfd-native' ),
					"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'water','stylers':[{'color':'#84afa3'},{'lightness':52}]},{'stylers':[{'saturation':-17},{'gamma':0.36}]},{'featureType':'transit.line','elementType':'geometry','stylers':[{'color':'#3f518c'}]}]"
				),
				'light-monochrome'   => array(
					esc_attr__( 'Light Monochrome', 'dfd-native' ),
					"[{'featureType':'water','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':-78},{'lightness':67},{'visibility':'simplified'}]},{'featureType':'landscape','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'simplified'}]},{'featureType':'road','elementType':'geometry','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'simplified'}]},{'featureType':'poi','elementType':'all','stylers':[{'hue':'#ffffff'},{'saturation':-100},{'lightness':100},{'visibility':'off'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'hue':'#e9ebed'},{'saturation':-90},{'lightness':-8},{'visibility':'simplified'}]},{'featureType':'transit','elementType':'all','stylers':[{'hue':'#e9ebed'},{'saturation':10},{'lightness':69},{'visibility':'on'}]},{'featureType':'administrative.locality','elementType':'all','stylers':[{'hue':'#2c2e33'},{'saturation':7},{'lightness':19},{'visibility':'on'}]},{'featureType':'road','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':31},{'visibility':'on'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'hue':'#bbc0c4'},{'saturation':-93},{'lightness':-2},{'visibility':'simplified'}]}]"
				),
				'paper'              => array(
					esc_attr__( 'Paper', 'dfd-native' ),
					"[{'featureType':'administrative','stylers':[{'visibility':'off'}]},{'featureType':'poi','stylers':[{'visibility':'simplified'}]},{'featureType':'road','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'simplified'}]},{'featureType':'transit','stylers':[{'visibility':'simplified'}]},{'featureType':'landscape','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','stylers':[{'visibility':'off'}]},{'featureType':'road.local','stylers':[{'visibility':'on'}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'visibility':'on'}]},{'featureType':'road.arterial','stylers':[{'visibility':'off'}]},{'featureType':'water','stylers':[{'color':'#5f94ff'},{'lightness':26},{'gamma':5.86}]},{},{'featureType':'road.highway','stylers':[{'weight':0.6},{'saturation':-85},{'lightness':61}]},{'featureType':'road'},{},{'featureType':'landscape','stylers':[{'hue':'#0066ff'},{'saturation':74},{'lightness':100}]}]"
				),
				'gowalla'            => array(
					esc_attr__( 'Gowalla', 'dfd-native' ),
					"[{'featureType':'road','elementType':'labels','stylers':[{'visibility':'simplified'},{'lightness':20}]},{'featureType':'administrative.land_parcel','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'transit','elementType':'all','stylers':[{'visibility':'off'}]},{'featureType':'road.local','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'road.local','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'road.highway','elementType':'labels','stylers':[{'visibility':'simplified'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'water','elementType':'all','stylers':[{'hue':'#a1cdfc'},{'saturation':30},{'lightness':49}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'hue':'#f49935'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'hue':'#fad959'}]}]"
				),
				'greyscale'          => array(
					esc_attr__( 'Greyscale', 'dfd-native' ),
					"[{'featureType':'all','stylers':[{'saturation':-100},{'gamma':0.5}]}]"
				),
				'apple-maps-esque'   => array(
					esc_attr__( 'Apple Maps-esque', 'dfd-native' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#a2daf2'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'color':'#f7f1df'}]},{'featureType':'landscape.natural','elementType':'geometry','stylers':[{'color':'#d0e3b4'}]},{'featureType':'landscape.natural.terrain','elementType':'geometry','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#bde6ab'}]},{'featureType':'poi','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.medical','elementType':'geometry','stylers':[{'color':'#fbd3da'}]},{'featureType':'poi.business','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'road.highway','elementType':'geometry.fill','stylers':[{'color':'#ffe15f'}]},{'featureType':'road.highway','elementType':'geometry.stroke','stylers':[{'color':'#efd151'}]},{'featureType':'road.arterial','elementType':'geometry.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'road.local','elementType':'geometry.fill','stylers':[{'color':'black'}]},{'featureType':'transit.station.airport','elementType':'geometry.fill','stylers':[{'color':'#cfb2db'}]}]"
				),
				'subtle'             => array(
					esc_attr__( 'Subtle', 'dfd-native' ),
					"[{'featureType':'poi','stylers':[{'visibility':'off'}]},{'stylers':[{'saturation':-70},{'lightness':37},{'gamma':1.15}]},{'elementType':'labels','stylers':[{'gamma':0.26},{'visibility':'off'}]},{'featureType':'road','stylers':[{'lightness':0},{'saturation':0},{'hue':'#ffffff'},{'gamma':0}]},{'featureType':'road','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'road.arterial','elementType':'geometry','stylers':[{'lightness':20}]},{'featureType':'road.highway','elementType':'geometry','stylers':[{'lightness':50},{'saturation':0},{'hue':'#ffffff'}]},{'featureType':'administrative.province','stylers':[{'visibility':'on'},{'lightness':-50}]},{'featureType':'administrative.province','elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'administrative.province','elementType':'labels.text','stylers':[{'lightness':20}]}]"
				),
				'neutral-blue'       => array(
					esc_attr__( 'Neutral Blue', 'dfd-native' ),
					"[{'featureType':'water','elementType':'geometry','stylers':[{'color':'#193341'}]},{'featureType':'landscape','elementType':'geometry','stylers':[{'color':'#2c5a71'}]},{'featureType':'road','elementType':'geometry','stylers':[{'color':'#29768a'},{'lightness':-37}]},{'featureType':'poi','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'featureType':'transit','elementType':'geometry','stylers':[{'color':'#406d80'}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'on'},{'color':'#3e606f'},{'weight':2},{'gamma':0.84}]},{'elementType':'labels.text.fill','stylers':[{'color':'#ffffff'}]},{'featureType':'administrative','elementType':'geometry','stylers':[{'weight':0.6},{'color':'#1a3541'}]},{'elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry','stylers':[{'color':'#2c5a71'}]}]"
				),
				'flat-map'           => array(
					esc_attr__( 'Flat Map', 'dfd-native' ),
					"[{'stylers':[{'visibility':'off'}]},{'featureType':'road','stylers':[{'visibility':'on'},{'color':'#ffffff'}]},{'featureType':'road.arterial','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'road.highway','stylers':[{'visibility':'on'},{'color':'#fee379'}]},{'featureType':'landscape','stylers':[{'visibility':'on'},{'color':'#f3f4f4'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'color':'#7fc8ed'}]},{},{'featureType':'road','elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'poi.park','elementType':'geometry.fill','stylers':[{'visibility':'on'},{'color':'#83cead'}]},{'elementType':'labels','stylers':[{'visibility':'off'}]},{'featureType':'landscape.man_made','elementType':'geometry','stylers':[{'weight':0.9},{'visibility':'off'}]}]"
				),
				'shift-worker'       => array(
					esc_attr__( 'Shift Worker', 'dfd-native' ),
					"[{'stylers':[{'saturation':-100},{'gamma':1}]},{'elementType':'labels.text.stroke','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.business','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.text','stylers':[{'visibility':'off'}]},{'featureType':'poi.place_of_worship','elementType':'labels.icon','stylers':[{'visibility':'off'}]},{'featureType':'road','elementType':'geometry','stylers':[{'visibility':'simplified'}]},{'featureType':'water','stylers':[{'visibility':'on'},{'saturation':50},{'gamma':0},{'hue':'#50a5d1'}]},{'featureType':'administrative.neighborhood','elementType':'labels.text.fill','stylers':[{'color':'#333333'}]},{'featureType':'road.local','elementType':'labels.text','stylers':[{'weight':0.5},{'color':'#333333'}]},{'featureType':'transit.station','elementType':'labels.icon','stylers':[{'gamma':1},{'saturation':50}]}]"
				),
				'becomeadinosaur'       => array(
					esc_attr__( 'Become a Dinosaur', 'dfd-native' ),
					'[{"elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"color":"#f5f5f2"},{"visibility":"on"}]},{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"color":"#ffffff"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.park","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#71c8d4"}]},{"featureType":"landscape","stylers":[{"color":"#e5e8e7"}]},{"featureType":"poi.park","stylers":[{"color":"#8ba129"}]},{"featureType":"road","stylers":[{"color":"#ffffff"}]},{"featureType":"poi.sports_complex","elementType":"geometry","stylers":[{"color":"#c7c7c7"},{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#a0d3d3"}]},{"featureType":"poi.park","stylers":[{"color":"#91b65d"}]},{"featureType":"poi.park","stylers":[{"gamma":1.51}]},{"featureType":"road.local","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.government","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","stylers":[{"visibility":"simplified"}]},{"featureType":"road"},{"featureType":"road"},{},{"featureType":"road.highway"}]'
				),
				'avocado-world'       => array(
					esc_attr__( 'Avocado World', 'dfd-native' ),
					'[{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]'
				),
				'nature'       => array(
					esc_attr__( 'Nature', 'dfd-native' ),
					'[{"featureType":"landscape","stylers":[{"hue":"#FFA800"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#53FF00"},{"saturation":-73},{"lightness":40},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FBFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#00FFFD"},{"saturation":0},{"lightness":30},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00BFFF"},{"saturation":6},{"lightness":8},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#679714"},{"saturation":33.4},{"lightness":-25.4},{"gamma":1}]}]'
				),
			);
			
			if(empty($path)) {
				$path = get_template_directory_uri() .'/';
			}
			
			if($simple) {
				$return_array = array();
				foreach($options as $key => $val) {
					$return_array[$key] = array(
						'tooltip'	=> $val[0],
						'src'		=> $path . 'vc_custom/admin/img/gmap/' . $key . '.png'
					);
				}
				
				return $return_array;
			}
			
			return $options;
		}
		/**
		 * Returns Google Maps style array.
		 *
		 * @param $map_style
		 *
		 * @return string
		 */
		public static function dfd_get_map_style( $map_style ) {
			$opts = self::dfd_google_map_custom_styles();

			if ( empty( $map_style ) ) {
				return false;
			}
			if ( ! isset( $opts[ $map_style ] ) ) {
				return false;
			}
			if ( ! isset( $opts[ $map_style ][1] ) ) {
				return false;
			}

			return $opts[ $map_style ][1];
		}
		/**
		 * Generates VC shortcode param values for image picker.
		 *
		 * @param $admin_path
		 * @param $front_path
		 * @param bool $simple
		 * @param bool $tooltips
		 *
		 * @return array
		 */
		public static function dfd_build_shortcode_style_param($dir_path, $dir_url, $admin_path, $front_path, $simple = true, $tooltips = false) {
			$images_dir = $dir_path.'/vc_custom/admin/img/'.$admin_path;

			$options_array = array();

			if(is_dir($images_dir)) {
				$dir_content = scandir($images_dir);
				if(!empty($dir_content) && is_array($dir_content)) {
					foreach($dir_content as $item) {
						$tooltip_text = '';
						if(substr_count($item, '.png') == 1) {
							$val = substr($item, 0, -4);
							$front_file = $dir_path.'/vc_custom/templates/'.$front_path.$val.'.php';
							if(file_exists($front_file)) {
								if($simple) {
									$options_array[$val] = $dir_url . '/vc_custom/admin/img/' . $admin_path . $item;
								} else {
									if($tooltips && isset($tooltips[$val]))
										$tooltip_text = $tooltips[$val];

									if($tooltip_text == '') {
										$tooltip_text = $val;
									}

									$options_array[$val] = array(
										'tooltip' => $tooltip_text,
										'src' => $dir_url . '/vc_custom/admin/img/' . $admin_path . $item
									);
								}
							}
						}
					}
				}
			}

			return $options_array;
		}
		/**
		 * Generates image html by ID.
		 *
		 * @param string $id
		 * @param string $w
		 * @param string $h
		 *
		 * @return string
		 */
		public static function generate_images_html($id = '', $w = '', $h = '') {
			$html = $image_url = '';
			
			if($id != '') {
				$image_src = wp_get_attachment_image_src($id,'full');
				
				if($w && $h) {
					$image_url = dfd_aq_resize($image_src[0], $w, $h, true, true, true);
				} elseif(isset($image_src[1]) && isset($image_src[2])) {
					$w = $image_src[1];
					$h = $image_src[2];
				}
				
				$atts = self::get_image_attrs($image_src[0], $id, $w, $h);
				
				if(!$image_url || $image_url == '') {
					$image_url = $image_src[0];
				}
			
				$html .= '<img src="'.esc_url($image_url).'" width="'.esc_attr(floor($w)).'" height="'.esc_attr(floor($h)).'" '.$atts.' />';
			}
			
			return $html;
		}
		/**
		 * Generates image attributes from metadata by attachment ID.
		 *
		 * @param string $src
		 * @param string $id
		 * @param string $w
		 * @param string $h
		 *
		 * @return string
		 */
		public static function get_image_attrs($src = '', $id = '', $w = '', $h = '', $default_alt = '') {
			if(empty($default_alt)) {
				$default_alt = esc_attr__('Image', 'dfd-native');
			}

			$image_meta = wp_get_attachment_metadata( $id );
			$attr = array();
			$atts_str = '';
			
//			if(!empty($w) && !empty($h)) {
//				$size_array = array( absint( $w ), absint( $h ) );
//				$srcset = wp_calculate_image_srcset( $size_array, $src, $image_meta, $id );
//				$sizes = wp_calculate_image_sizes( $size_array, $src, $image_meta, $id );
//
//				if ( $srcset && ( $sizes || ! empty( $attr['sizes'] ) ) ) {
//					$attr['srcset'] = $srcset;
//
//					if ( empty( $attr['sizes'] ) ) {
//						$attr['sizes'] = $sizes;
//					}
//				} else {
//					$attr['srcset'] = $src.' '.absint($w).'w';
//					$attr['sizes'] = '(max-width: '.$w.'px) 100vw, '.$w.'px';
//				}
//			}
			
			$alt = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) );
			
			if(empty($alt)) {
				$alt = $default_alt;
			}
			
			$attr['alt'] = $alt;
			
			foreach($attr as $name => $val) {
				$atts_str .= $name.'="'.$val.'" ';
			}
			
			return $atts_str;
		}
		/**
		 * Returns available sidebar configurations.
		 *
		 * @return array
		 */
		public static function dfd_page_layouts() {
			return array(
				'1col-fixed' => array(
					'title' => esc_html__('No sidebars','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/sidebars.png'
				),
				'2c-l-fixed' => array(
					'title' => esc_html__('Sidebar on left','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/sidebars.png'
				),
				'2c-r-fixed' => array(
					'title' => esc_html__('Sidebar on right','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/sidebars.png'
				),
				'3c-fixed' => array(
					'title' => esc_html__('Both sidebars','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/sidebars.png'
				),
			);
		}
		/**
		 * Returns available layout width values array.
		 *
		 * @return array
		 */
		public static function dfd_layout_width() {
			return array(
				'' => array(
					'title' => esc_html__('Boxed','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-width.png'
				),
				'full-width' => array(
					'title' => esc_html__('Full width','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-width.png'
				),
			);
		}
		/**
		 * Returns array of available blog layout styles.
		 *
		 * @return array
		 */
		public static function dfd_blog_layouts_style() {
			return array(
				'side-image' => array(
					'title' => esc_html__('Side image','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-style.png'
				),
				'masonry' => array(
					'title' => esc_html__('Masonry','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-style.png'
				),
				'fitRows' => array(
					'title' => esc_html__('Grid','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-style.png'
				),
				'metro' => array(
					'title' => esc_html__('Metro','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-style.png'
				),
				'full-content' => array(
					'title' => esc_html__('Full content','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/layout-style.png'
				),
			);
		}
		/**
		 * Returns array of available single portfolio layout styles.
		 *
		 * @return array
		 */
		public static function dfd_portfolio_single_layout_style() {
			return array(
				'carousel' => array(
					'title' => esc_html__('Carousel','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-inside-style.png'
				),
				'fitRows' => array(
					'title' => esc_html__('Grid','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-inside-style.png'
				),
				'masonry' => array(
					'title' => esc_html__('Masonry','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-inside-style.png'
				),
				'video' => array(
					'title' => esc_html__('Video','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-inside-style.png'
				),
			);
		}
		/**
		 * Returns array of available portfolio layout styles.
		 *
		 * @return array
		 */
		public static function dfd_portfolio_layout_style() {
			return array(
				'side-image' => array(
					'title' => esc_html__('Side image','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
				),
				'fitRows' => array(
					'title' => esc_html__('Grid','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
				),
				'masonry' => array(
					'title' => esc_html__('Masonry','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
				),
				'justified' => array(
					'title' => esc_html__('Justified grid','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
				),
				'metro' => array(
					'title' => esc_html__('Metro','dfd-native'),
					'img' => get_template_directory_uri().'/assets/admin/img/portfolio-layout.png'
				),
			);
		}
		/**
		 * Returns array of available header styles.
		 *
		 * @return array
		 */
		public static function dfd_headers_type() {
			$result = array (
					'1' => esc_html__('Header 1', 'dfd-native'),
					'2' => esc_html__('Header 2', 'dfd-native'),
					'3' => esc_html__('Header 3', 'dfd-native'),
					'4' => esc_html__('Header 4', 'dfd-native'),
					'5' => esc_html__('Header 5', 'dfd-native'),
					'6' => esc_html__('Header 6', 'dfd-native'),
					'7' => esc_html__('Header 7', 'dfd-native'),
					'8' => esc_html__('Header 8', 'dfd-native'),
					'9' => esc_html__('Header 9', 'dfd-native'),
					'10' => esc_html__('Header 10', 'dfd-native'),
					'11' => esc_html__('Header 11', 'dfd-native'),
					'12' => esc_html__('Header 12', 'dfd-native'),
					'13' => esc_html__('Header 13', 'dfd-native'),
					'14' => esc_html__('Header 14', 'dfd-native'),
					'none' => esc_html__('Disable header', 'dfd-native'),
			);
			if (has_filter('dfd_headers_type')) {
				$result = apply_filters('dfd_headers_type', $result);
			}
			return $result;
		}

		/**
		 * Returns array of available header logo positions.
		 *
		 * @return array
		 */
		public static function dfd_logo_position() {
			return array(
				'left' =>esc_html__('Left','dfd-native'),
				'right' => esc_html__('Right','dfd-native'),
				'top-left' => esc_html__('Top left','dfd-native'),
				'top-center' => esc_html__('Top center','dfd-native'),
				'top-right' => esc_html__('Top right','dfd-native'),
				'bottom-left' => esc_html__('Bottom left','dfd-native'),
				'bottom-center' => esc_html__('Bottom center','dfd-native'),
				'bottom-right' => esc_html__('Bottom right','dfd-native'),
			);
		}
		/**
		 * Returns array of available header menu positions.
		 *
		 * @return array
		 */
		public static function dfd_menu_position() {
			return array(
				'top' => esc_html__('Top','dfd-native'),
				'bottom' => esc_html__('Bottom','dfd-native'),
			);
		}
		/**
		 * Returns array of alignment options.
		 *
		 * @return array
		 */
		public static function dfd_alignment_options() {
			return array(
				'text-left' => esc_html__('Left', 'dfd-native'),
				'text-right' => esc_html__('Right', 'dfd-native'),
				'text-center' => esc_html__('Center', 'dfd-native'),
			);
		}
		/**
		 * Returns array of header layouts.
		 *
		 * @return array
		 */
		public static function dfd_header_layouts() {
			return array(
				'boxed' => esc_html__('On', 'dfd-native'),
				'fullwidth' => esc_html__('Off', 'dfd-native'),
			);
		}
		/**
		 * Returns array of header animations.
		 *
		 * @return array
		 */
		public static function dfd_sticky_header_animations() {
			return array(
				'simple' => esc_html__('Simple', 'dfd-native'),
				'slide-up' => esc_html__('Slide up', 'dfd-native'),
				'fade' => esc_html__('Fade', 'dfd-native'),
			);
		}
		/**
		 * Returns array of social icons hover styles.
		 *
		 * @return array
		 */
		public static function dfd_soc_icons_hover_style() {
			return array(
				'1' => esc_html__('Square top to bottom', 'dfd-native'),
				'2' => esc_html__('Circle colored style', 'dfd-native'),
				'3' => esc_html__('Square colored style', 'dfd-native'),
				'4' => esc_html__('Flying line', 'dfd-native'),
				'5' => esc_html__('Square black and white', 'dfd-native'),
				'6' => esc_html__('Circle black and white', 'dfd-native'),
				'7' => esc_html__('Circle icons with border 3px', 'dfd-native'),
				'8' => esc_html__('Square icons with border 3px', 'dfd-native'),
				'9' => esc_html__('Square icon on a dark background', 'dfd-native'),
				'10' => esc_html__('Circle icon on a light background', 'dfd-native'),
				'11' => esc_html__('Square icon on a light background', 'dfd-native'),
				'12' => esc_html__('Circle icons with border', 'dfd-native'),
				'13' => esc_html__('Square icons with border', 'dfd-native'),
				'14' => esc_html__('Change color', 'dfd-native'),
				'15' => esc_html__('In general border', 'dfd-native'),
				'16' => esc_html__('Retro Disco Style', 'dfd-native'),
				'17' => esc_html__('Circle from the center', 'dfd-native'),
				'18' => esc_html__('The circle in the center', 'dfd-native'),
				'19' => esc_html__('Round icons on gray background', 'dfd-native'),
				'20' => esc_html__('Square icon on a gray background', 'dfd-native'),
				'21' => esc_html__('Circle fade', 'dfd-native'),
				'22' => esc_html__('Square background from left to right', 'dfd-native'),
				'23' => esc_html__('Circle icon on a dark background', 'dfd-native'),
				'24' => esc_html__('Square icon scale background', 'dfd-native'),
				'25' => esc_html__('Circle icon scale background', 'dfd-native'),
				'26' => esc_html__('Square icon on a light background', 'dfd-native'),
			);
		}
		/**
		 * Returns values for background position option.
		 *
		 * @return array
		 */
		public static function dfd_get_bgposition() {
			return array(
				'' => esc_html__('Default', 'dfd-native'),
				'left top' => esc_html__('left top', 'dfd-native'),
				'left center' => esc_html__('left center','dfd-native'),
				'left bottom' => esc_html__('left bottom','dfd-native'),
				'right top' => esc_html__('right top','dfd-native'),
				'right center' => esc_html__('right center','dfd-native'),
				'right bottom' => esc_html__('right bottom','dfd-native'),
				'center top' => esc_html__('center top','dfd-native'),
				'center center' => esc_html__('center center','dfd-native'),
				'center bottom' => esc_html__('center bottom','dfd-native')
			);
		}
		/**
		 * Returns values for background position option readable for Redux config.
		 *
		 * @return array
		 */
		public static function dfd_get_bgposition_redux() {
			$a = self::dfd_get_bgposition();
			$o = array();

			foreach($a as $value => $name) {
				$o[] = array(
					'name' => $name,
					'value' => $value,
				);
			}

			return $o;
		}
		/**
		 * Returns array of available site preloader animations.
		 *
		 * @return array
		 */
		public static function dfd_preloader_animation_style() {
			return  array(
				'1' => esc_html__('CSS animation 1', 'dfd-native'),
				'2' => esc_html__('CSS animation 2', 'dfd-native'),
				'3' => esc_html__('CSS animation 3', 'dfd-native'),
				'4' => esc_html__('CSS animation 4', 'dfd-native'),
				'5' => esc_html__('CSS animation 5', 'dfd-native'),
				'6' => esc_html__('CSS animation 6', 'dfd-native'),
			);
		}
		/**
		 * Returns array of available site preloader animations for metaboxes.
		 *
		 * @return array
		 */
		public static function dfd_preloader_animation_style_cmb() {
			$a = self::dfd_preloader_animation_style();
			$o = array();
			$o[] = array(
				'name' => esc_html__('Theme default', 'dfd-native'),
				'value' => '',
			);

			foreach($a as $value => $name) {
				$o[] = array(
					'name' => $name,
					'value' => $value,
				);
			}

			return $o;
		}
		/**
		 * Returns array of available appear effects.
		 *
		 * @return array
		 */
		public static function dfd_module_animation_styles($return_value = 'shortcodes') {
			$animations = array(
			   esc_html__( 'No Animation', 'dfd-native' )       => '',
			   esc_html__( 'Fade In', 'dfd-native' )            => 'transition.fadeIn',
			   esc_html__( 'Flip Horizontally', 'dfd-native' )  => 'transition.flipXIn',
			   esc_html__( 'Flip Vertically', 'dfd-native' )    => 'transition.flipYIn',
			   esc_html__( 'Shrink', 'dfd-native' )			 => 'transition.shrinkIn',
			   esc_html__( 'Expand', 'dfd-native' )			 => 'transition.expandIn',
			   esc_html__( 'Grow', 'dfd-native' )				 => 'transition.grow',
			   esc_html__( 'Slide Up', 'dfd-native' )			=> 'transition.slideUpBigIn',
			   esc_html__( 'Slide Down', 'dfd-native' )		=> 'transition.slideDownBigIn',
			   esc_html__( 'Slide Right', 'dfd-native' )		=> 'transition.slideLeftBigIn',
			   esc_html__( 'Slide Left', 'dfd-native' )		=> 'transition.slideRightBigIn',
			   esc_html__( 'Perspective Up', 'dfd-native' )    => 'transition.perspectiveUpIn',
			   esc_html__( 'Perspective Down', 'dfd-native' )  => 'transition.perspectiveDownIn',
			   esc_html__( 'Perspective Right', 'dfd-native' ) => 'transition.perspectiveLeftIn',
			   esc_html__( 'Perspective Left', 'dfd-native' )	=> 'transition.perspectiveRightIn',
			);
			$animations_options = $animations_metaboxes = array();
			foreach($animations as $k => $v) {
				$metabox_array = array();
				$metabox_array['name'] = $k;
				$metabox_array['value'] = $v;
				$animations_metaboxes[] = $metabox_array;
				$animations_options[$v] = $k;
			}
			switch($return_value) {
				case 'options':
					return $animations_options;
					break;
				case 'metaboxes':
					return $animations_metaboxes;
					break;
				case 'shortcodes':
				default:
					return $animations;
			}
		}
		/**
		 * Returns array of values for background size option.
		 *
		 * @return array
		 */
		public static function dfd_get_bgsize($return_value = 'options') {
			$animations = array(
			   esc_html__( 'Initial', 'dfd-native' )           => 'initial',
			   esc_html__( 'Contain', 'dfd-native' )           => 'contain',
			   esc_html__( 'Cover', 'dfd-native' )				=> 'cover',
			);
			$animations_options = $animations_metaboxes = array();
			$animations_metaboxes[] = array(
				'name' => esc_html__('Inherit from theme options', 'dfd-native'),
				'value' => '',
			);
			foreach($animations as $k => $v) {
				$metabox_array = array();
				$metabox_array['name'] = $k;
				$metabox_array['value'] = $v;
				$animations_metaboxes[] = $metabox_array;
				$animations_options[$v] = $k;
			}
			switch($return_value) {
				case 'metaboxes':
					return $animations_metaboxes;
					break;
				case 'shortcodes':
					return $animations;
					break;
				case 'options':
				default:
					return $animations_options;
			}
		}
		/**
		 * Converts color to rgb(a).
		 *
		 * @param $hex
		 * @param float $opacity
		 *
		 * @return string
		 */
		public static function dfd_hex2rgb($hex,$opacity=1) {
			$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

			return $rgba;
		}
		/**
		 * Lightens or darkens HEX color. Values from -100 to 100 are accepted
		 *
		 * @param $hex
		 * @param $steps
		 *
		 * @return string
		 */
		public static function adjustBrightness($hex, $steps) {
			// Steps should be between -255 and 255. Negative = darker, positive = lighter
			$steps = $steps * 2.55;
			$steps = max(-255, min(255, $steps));

			// Normalize into a six character long hex string
			$hex = str_replace('#', '', $hex);
			if (strlen($hex) == 3) {
				$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
			}

			// Split into three parts: R, G and B
			$color_parts = str_split($hex, 2);
			$return = '#';

			foreach ($color_parts as $color) {
				$color   = hexdec($color); // Convert to decimal
				$color   = max(0,min(255,$color + $steps)); // Adjust color
				$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
			}

			return $return;
		}
		/**
		 * Returns array of available animations for header 7.
		 *
		 * @return array
		 */
		public static function dfd_header_seventh_appear_effects() {
			return array(
				'default' => esc_html__('Scale', 'dfd-native'),
				'fade-out' => esc_html__('Fade out', 'dfd-native'),
				'scale-slide-up' => esc_html__('Scale and slide up', 'dfd-native'),
				'scale-slide-down' => esc_html__('Scale and slide down', 'dfd-native'),
				'scale-slide-left' => esc_html__('Scale and slide left', 'dfd-native'),
				'scale-slide-right' => esc_html__('Scale and slide right', 'dfd-native'),
				'scale-rotate' => esc_html__('Scale with rotation', 'dfd-native'),
			);
		}
		/**
		 * Returns array o available delimiter styles
		 *
		 * @return array
		 */
		public static function dfd_vc_delimiter_styles() {
			return array(
				esc_html__('None', 'dfd-native') => '',
				esc_html__('Default', 'dfd-native') => 1,
				esc_html__('With shadow above', 'dfd-native') => 2,
				esc_html__('With shadow below', 'dfd-native') => 3,
				esc_html__('Color triangle', 'dfd-native') => 4,
				esc_html__('Transparent triangle bottom', 'dfd-native') => 5,
				esc_html__('Transparent triangle top', 'dfd-native') => 6,
				esc_html__('Transparent triangle both top and bottom', 'dfd-native') => 7,
				esc_html__('Fade top', 'dfd-native') => 8,
				esc_html__('Fade bottom', 'dfd-native') => 9,
				esc_html__('Fade both top and bottom', 'dfd-native') => 10,
				esc_html__('Boxed border', 'dfd-native') => 11,
				esc_html__('Vertical line at the bottom', 'dfd-native') => 12,
			);
		}
		/**
		 * Generates column class for flickr widget.
		 *
		 * @param int $str
		 * @param bool $reversal
		 *
		 * @return string
		 */
		public function column_class_maker($count = 1) {
			if($count % 3 == 0) {
				return 'third-size';
			} elseif($count % 2 == 0) {
				return 'half-size';
			} else {
				return 'full-width';
			}
		}
		/**
		 * Generates column class for theme grid.
		 *
		 * @param int $str
		 * @param bool $reversal
		 *
		 * @return string
		 */
		public static function dfd_num_to_string_full( $str = 1, $reversal = false){
			$arr = array( 1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', );

			if( isset($arr[$str]) && !$reversal ) {
				return $arr[$str];
			}elseif( isset($arr[$str]) && $reversal && 0 != 12 - $str ) {
				return $arr[12 - $str];
			} else {
				return 'twelve';
			}
		}
		/**
		 * Generates column class for theme grid. This is a simple variant of Dfd_Theme_Helpers::dfd_num_to_string_full()
		 *
		 * @param int $str
		 *
		 * @return string
		 */
		public static function dfd_num_to_string( $str = 1){
			$arr = array(1 => 'twelve', 'six', 'four', 'three');

			if( isset($arr[$str]) ) {
				return $arr[$str];
			} else {
				return 'twelve';
			}
		}
		/**
		 * Generates param group for Redux header settings
		 *
		 * @param int $style
		 *
		 * @return array
		 */
		public static function dfd_build_header_options($style = 1) {
			$logo = 'logo';
			if((int)$style % 2 == 0) {
				$logo .= '_white';
			}
			return array(
				array(
					'id' => 'info_image_'.$style,
					'type' => 'info',
					'class' => 'dfd-no-bg',
					'desc' => '<div class="description-image"><img src="'.  get_template_directory_uri().'/assets/img/headers/header-'.$style.'.png" alt="'.esc_attr('Header style ','dfd-native') . $style . esc_attr(' preview','dfd-native').'" /></div>'
				),
				array(
					'id' => 'header_sticky_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Header animation', 'dfd-native'),
					'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Header animation','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the header animation on scroll','dfd-native')
					)
				),
				array(
					'id' => 'info_elements_'.$style,
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Top panel content elements', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'header_top_panel_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Header top panel', 'dfd-native'),
					'options' => array('on' => esc_html__('On','dfd-native'), 'off' => esc_html__('Off','dfd-native')),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Header top panel','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the header top panel where the address information, login and social icons can be set','dfd-native')
					)
				),
				array(
					'id' => 'header_login_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Login form', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'required' => array(
						'header_top_panel_'.$style, "=", 'on',
					),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Login form','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the login form in the top panel','dfd-native')
					)
				),
				array(
					'id' => 'head_show_header_soc_icons_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Social icons', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'required' => array( 'header_top_panel_'.$style, "=", 'on' ),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Social icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the social icon in the top panel, the social icons can be added in Social accounts section in theme options','dfd-native')
					)
				),
				array(
					'id' => 'info_top_panle_color_'.$style,
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Top panel color settings', 'dfd-native').'</h3>',
					'required' => array( 'header_top_panel_'.$style, "=", 'on' ),
				),
				array(
					'id' => 'header_top_panel_background_color_'.$style,
					'type' => 'color',
					'title' => esc_html__('Background color', 'dfd-native'),
					'default' => '',
					'validate' => 'color',
					'required' => array( 'header_top_panel_'.$style, "=", 'on' ),
					'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header top panel','dfd-native')
					)
				),
				array(
					'id' => 'header_top_panel_color_'.$style,
					'type' => 'color',
					'title' => esc_html__('Text color', 'dfd-native'),
					'default' => '',
					'validate' => 'color',
					'required' => array( 'header_top_panel_'.$style, "=", 'on' ),
					'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header top panel','dfd-native')
					)
				),
				array(
					'id' => 'info_main_section_elements_'.$style,
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Main section content elements', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'show_search_form_header_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Search form in header', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Search form','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the search form in header','dfd-native')
					)
				),
				array(
					'id' => 'show_lang_sel_header_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Language switcher in header', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Language switcher','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the language switcher in header','dfd-native')
					)
				),
				array(
					'id' => 'show_cart_header_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Shopping cart button in header', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'off',
					'hint' => array(
						'title'   => esc_attr__('Shopping cart','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the shopping cart button in header. Note, this option is available if Woocommerce plugin is installed','dfd-native')
					)
				),
				array(
					'id' => 'show_wishlist_header_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Wishlist button', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'off',
					'hint' => array(
						'title'   => esc_attr__('Wishlist button','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable the Wishlist button header. Note, this option is available if YITH WooCommerce Wishlist plugin is installed','dfd-native')
					)
				),
				array(
					'id' => 'show_menu_icons_header_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Menu icons', 'dfd-native'),
					'desc' => esc_html__('Please make sure that icons are defined for the top level navigation menu items in','dfd-native') . ' <a href="'.esc_url(admin_url()).'/nav-menus.php">'.esc_html__('Appearance -> Menus','dfd-native').'</a> ' . esc_html__('if you enable this option','dfd-native'),
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'on',
					'hint' => array(
						'title'   => esc_attr__('Menu icons','dfd-native'),
						'content' => esc_attr__('This option allows you to enable or disable icons in primary navigation.','dfd-native')
					)
				),
				array(
					'id' => 'info_main_panel_color_'.$style,
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Main section color settings', 'dfd-native').'</h3>'
				),
				array(
					'id' => 'header_background_color_'.$style,
					'type' => 'color',
					'title' => esc_html__('Header background color', 'dfd-native'),
					'default' => '',
					'validate' => 'color',
					'hint' => array(
						'title'   => esc_attr__('Background color','dfd-native'),
						'content' => esc_attr__('Choose the background color for the header main section','dfd-native')
					)
				),
				array(
					'id' => 'header_border_color_'.$style,
					'type' => 'color',
					'title' => esc_html__('Header border color', 'dfd-native'),
					'default' => '',
					'validate' => 'color',
					'hint' => array(
						'title'   => esc_attr__('Border color','dfd-native'),
						'content' => esc_attr__('Choose the border color for the header','dfd-native')
					)
				),
				array(
					'id' => 'header_text_color_'.$style,
					'type' => 'color',
					'title' => esc_html__('Header text color', 'dfd-native'),
					'default' => '',
					'validate' => 'color',
					'hint' => array(
						'title'   => esc_attr__('Text color','dfd-native'),
						'content' => esc_attr__('Choose the text color for the elements set in header','dfd-native')
					)
				),
				array(
					'id' => 'info_main_panel_logos_'.$style,
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Header style ', 'dfd-native') . $style . esc_html__(' custom logos','dfd-native') .'</h3>'
				),
				array(
					'id' => 'logo_header_'.$style,
					'type' => 'media',
					'title' => esc_html__('Header logotype image', 'dfd-native'),
					'default' => array(
							'url'		=> get_template_directory_uri() . '/assets/img/'.$logo.'.png',
							'width'		=> 77,
							'height'	=> 38,
					),
					'hint' => array(
						'title'   => esc_attr__('Header logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for the current header style','dfd-native')
					)
				),
				array(
					'id' => 'retina_logo_header_'.$style,
					'type' => 'media',
					'title' => esc_html__('Header logotype image for retina', 'dfd-native'),
					'default' => array(
							'url' => get_template_directory_uri() . '/assets/img/'.$logo.'_retina.png'
					),
					'hint' => array(
						'title'   => esc_attr__('Header retina logotype','dfd-native'),
						'content' => esc_attr__('Select the image from the media library which will be set as logotype image for retina for the current header style','dfd-native')
					)
				),
				array(
					'id' => 'info_main_panel_banner_'.$style,
					'type' => 'info',
					'desc' => '<h3 class="description">'.esc_html__('Header style ', 'dfd-native') . $style . esc_html__(' banner settings','dfd-native') .'</h3>'
				),
				array(
					'id' => 'show_banner_header_'.$style,
					'type' => 'button_set',
					'title' => esc_html__('Banner', 'dfd-native'),
					'desc' => '',
					'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
					'default' => 'off',
					'hint' => array(
						'title'   => esc_attr__('Banner','dfd-native'),
						'content' => esc_attr__('This option allows you to add the banner with the custom link which will be set above the header','dfd-native')
					)
				),
				array(
					'id' => 'banner_image_url_'.$style,
					'type' => 'media',
					'title' => esc_html__('Banner image URL', 'dfd-native'),
					'desc' => esc_html__('Select or upload the image for banner in header', 'dfd-native'),
					'required' => array(
						array('show_banner_header_'.$style, '=', 'on'),
					),
					'default' => array(
							'url' => get_template_directory_uri() . '/assets/img/banner.jpg'
					),
					'hint' => array(
						'title'   => esc_attr__('Banner image URL','dfd-native'),
						'content' => esc_attr__('Add the custom image link or upload from image from the media library','dfd-native')
					)
				),
				array(
					'id' => 'banner_url_'.$style,
					'type' => 'text',
					'title' => esc_html__('Banner URL', 'dfd-native'),
					'desc' => '',
					'validate' => 'url',
					'required' => array(
						array('show_banner_header_'.$style, '=', 'on'),
					),
					'default' => 'http://nativewptheme.net',
					'hint' => array(
						'title'   => esc_attr__('Banner URL','dfd-native'),
						'content' => esc_attr__('This option allows you to add the link to your banner','dfd-native')
					)
				),
				array(
					'id' => 'header_content_alignment_'.$style,
					'type' => 'select',
					'title' => esc_html__('Header content alignment', 'dfd-native'),
					'options' => array(
						'alignleft' => esc_html__('Left', 'dfd-native'),
						'alignright' => esc_html__('Right', 'dfd-native'),
						'aligncenter' => esc_html__('Center', 'dfd-native'),
					),
					'required' => array(
						array('show_banner_header_'.$style, '=', 'on'),
					),
					'default' => 'alignleft',
					'hint' => array(
						'title'   => esc_attr__('Header content alignment','dfd-native'),
						'content' => esc_attr__('This option allows you to choose horizontal alignment for the header content','dfd-native')
					)
				),
			);
		}
		/**
		 * Single post views counter
		 *
		 * @param int $post_ID
		 *
		 * @return string
		 */
		public static function dfd_posts_view_counter($post_ID) {
			if(!$post_ID) {
				return false;
			}

			$meta_id = 'dfd_views_counter';

			$reset = get_post_meta($post_ID, 'blog_single_reset_counter', true);

			if(!$reset) {
				$count = get_post_meta($post_ID, $meta_id, true);
			} else {
				$count = '';
				update_post_meta($post_ID, 'blog_single_reset_counter', false);
			}

			if($count == ''){
				$count = 0;
				delete_post_meta($post_ID, $meta_id);
				add_post_meta($post_ID, $meta_id, '0');

				return $count . ' '.esc_html__('View','dfd-native');

			} else {
				$count++;
				update_post_meta($post_ID, $meta_id, $count);

				if($count == '1'){
					return $count . ' '.esc_html__('View','dfd-native');
				} else {
					return $count . ' '.esc_html__('Views','dfd-native');
				}
			}
		}
		/**
		 * Defines the default screen resolution. This resolution is used to get post/portfolio/gallery thumbnails dimentions on blog/portfolio/gallery pages. The default resolution is 1920 but it can be changed from Theme options
		 *
		 * @return string|int
		 */
		public static function default_screen_width() {
			global $dfd_native;
			
			$screen_width = 1920;
			
			if(isset($dfd_native['default_screen_width']) && !empty($dfd_native['default_screen_width'])) {
				$screen_width = (int)$dfd_native['default_screen_width'];
			}
			
			return $screen_width;
		}
		/**
		 * Returns post format icon to be shown in case if post thumbnail is not defined.
		 *
		 * @param int $post_id
		 *
		 * @return string post format icon html
		 */
		public static function prev_next_post_format_icon($post_id) {
			$post_type_icon = '';
			if (has_post_format('video', $post_id)) {
				$post_type_icon = '<i class="dfd-socicon-icon-play"></i>';
			} elseif (has_post_format('audio', $post_id)) {
				$post_type_icon = '<i class="dfd-socicon-Microphone"></i>';
			} elseif (has_post_format('gallery', $post_id)) {
				$post_type_icon = '<i class="dfd-socicon-editor-images-pictures-photos-collection-glyph"></i>';	
			} elseif (has_post_format('quote', $post_id)) {
				$post_type_icon = '<i class="dfd-socicon-75"></i>';	
			} elseif (has_post_format('link', $post_id)) {
				$post_type_icon = '<i class="dfd-socicon-link5"></i>';	
			} else {
				$post_type_icon = '<i class="dfd-socicon-paper"></i>';
			}
			return $post_type_icon;
		}
		/**
		 * Generates pagination html depending on page metaboxestheme options settings.
		 *
		 * @return string pagination html
		 */
		public static function dfd_pagination() {
			global $wp_query, $portfolio_pagination_type;

			if($wp_query->max_num_pages > 1) {
				if (strcmp($portfolio_pagination_type, '1') === 0) {
					self::dfd_ajax_pagination();
				} elseif(strcmp($portfolio_pagination_type, '2') === 0) {
					self::dfd_lazy_load_pagination();
				} else {
					self::dfd_default_pagination();
				}
			}
		}
		/**
		 * Generates default pagination html.
		 *
		 * @return string pagination html
		 */
		public static function dfd_default_pagination() {
			global $wp_query, $dfd_pagination_style;
			
			$page = get_query_var('paged');
			$paged = ($page > 1) ? $page : 1;

			$prev_link = '<span>'.esc_html__('Prev','dfd-native').'</span><i class="dfd-socicon-arrow-left-01"></i>';
			$next_link = '<span>'.esc_html__('Next','dfd-native').'</span><i class="dfd-socicon-arrow-right-01"></i>';
			if($paged > 1) {
				$prev_link = '<a href="'.esc_url(get_previous_posts_page_link()).'">'.$prev_link.'</a>';
			}
			$prev_link = '<div class="dfd-prev-page">'.$prev_link.'</div>';
			
			$next_link_url = get_next_posts_page_link($wp_query->max_num_pages);
			if($next_link_url) {
 				$next_link = '<a href="'.esc_url($next_link_url).'">'.$next_link.'</a>';
			}
			$next_link = '<div class="dfd-next-page">'.$next_link.'</div>';
			
			if(empty($dfd_pagination_style)) {
				$dfd_pagination_style = '1';
			}
			
			$big = 9999999999;
			
			$pagination_class = 'dfd-pagination-style-'.$dfd_pagination_style;

			$paginate_links = get_the_posts_pagination(array(
				'mid_size'           => 5,
				'prev_next'			 => false,
				'type'				 => 'list',
				'prev_text'          => '',
				'next_text'          => '',
				'screen_reader_text' => '',
			));
			
			if ( $paginate_links ) {
				echo '<nav class="page-nav text-center">';
					echo '<div class="dfd-pagination '.esc_attr($pagination_class).'">';
						echo wp_kses( $prev_link , array(
									'a' => array(
										'href' => array(),
										'title' => array(),
										'target' => array(),
										'rel' => array()
									),
									'div' => array(
										'class' => array()
									),
									'span' => array(),
									'i' => array(
										'class' => array()
									),
								));
						echo ($dfd_pagination_style != '5') ? $paginate_links : '';
						echo wp_kses( $next_link , array(
									'a' => array(
										'href' => array(),
										'title' => array(),
										'target' => array(),
										'rel' => array()
									),
									'div' => array(
										'class' => array()
									),
									'span' => array(),
									'i' => array(
										'class' => array()
									),
								));
					echo '</div><!--// end .pagination -->';
				echo '</nav>';
			}
		}
		
		/**
		 * Generates ajax pagination html with Load more button and localizes required script.
		 *
		 * @return string pagination html
		 */
		public static function dfd_ajax_pagination() {
			global $wp_query;
			
			$max_num_pages = $wp_query->max_num_pages;
			$page = get_query_var('paged');
			$paged = ($page > 1) ? $page : 1;

			wp_localize_script(
				'ajax-pagination',
				'dfd_pagination_data',
				array(
					'startPage' => $paged,
					'maxPages' => $max_num_pages,
					'nextLink' => next_posts($max_num_pages, false),
					'container' => '.dfd-content-wrap.dfd-post, .dfd-content-wrap.dfd-portfolio, .dfd-content-wrap.dfd-gallery, .dfd-content-wrap.dfd-post_archive, .dfd-content-wrap.dfd-portfolio_archive, .dfd-content-wrap.dfd-gallery_archive',
				)
			);

			wp_enqueue_script('ajax-pagination');

			echo '<nav class="page-nav text-center">';
				echo '<div class="dfd-pagination ajax-pagination">'
						. '<a id="ajax-pagination-load-more" class="button" href="#" data-loaded="'.esc_attr__('Everything is loaded', 'dfd-native').'"><span>'.esc_html__('Load more', 'dfd-native').'</span><i class="dfd-socicon-refresh"></i></a>'
					. '</div><!--// end .pagination -->';
			echo '</nav>';
		}
		
		/**
		 * Generates lazy load ajax pagination html and locailzes required scripts.
		 *
		 * @return string pagination html
		 */
		public static function dfd_lazy_load_pagination() {
			global $wp_query, $dfd_native;
			
			$max_num_pages = $wp_query->max_num_pages;
			$page = get_query_var('paged');
			$paged = ($page > 1) ? $page : 1;

			wp_localize_script(
				'dfd-lazy-load',
				'dfd_pagination_data',
				array(
					'startPage' => $paged,
					'maxPages' => $max_num_pages,
					'nextLink' => next_posts($max_num_pages, false),
					'container' => '.dfd-content-wrap.dfd-post, .dfd-content-wrap.dfd-portfolio, .dfd-content-wrap.dfd-gallery, .dfd-content-wrap.dfd-post_archive, .dfd-content-wrap.dfd-portfolio_archive, .dfd-content-wrap.dfd-gallery_archive',
				)
			);

			wp_enqueue_script('dfd-lazy-load');

			$lazy_load_pagination_image_html = $class = '';

			if(isset($dfd_native['lazy_load_pagination_image']['url']) && !empty($dfd_native['lazy_load_pagination_image']['url'])) {
				if(substr_count($dfd_native['lazy_load_pagination_image']['url'], get_template_directory_uri()) > 0) {
					$class = 'default';
				}
				$lazy_load_pagination_image_html .= '<img src="'. esc_url($dfd_native['lazy_load_pagination_image']['url']).'" alt="Lazy load image" />';
			}

			echo '<nav class="page-nav text-center">';
				echo '<div class="dfd-pagination dfd-lazy-load-pop-up '.esc_attr($class).'" data-loaded="'.esc_attr__('Everything is loaded', 'dfd-native').'">'.$lazy_load_pagination_image_html.'</div><!--// end .pagination -->';
			echo '</nav>';
		}
		/**
		 * Returns array of available sidebars.
		 *
		 * @param string $empty_text
		 *
		 * @return array
		 */
		public static function sidebars_option($empty_text = 'Select sidebar') {
			$sidebars_options = array();
			if(function_exists('smk_get_all_sidebars')) {
				$the_sidebars = smk_get_all_sidebars();
			} else {
				$the_sidebars = false;
			}
			if($the_sidebars &&  is_array($the_sidebars) ){
				$select_str = $empty_text;
				$the_sidebars = array_merge( array( $select_str => '' ), $the_sidebars );
				foreach($the_sidebars as $k => $v) {
					$result = array();
					$result['name'] = $k;
					$result['value'] = $v;
					$sidebars_options[] = $result;
				}
			}
			
			return $sidebars_options;
		}
		/**
		 * Returns gallery post html.
		 *
		 * @param string $prefix
		 * @param array $size
		 * @param string $att
		 * @param bool $small
		 *
		 * @return string
		 */
		public static function get_post_gallery_images($prefix, $size = array(1200, 750, true, true, true), $att = 'full', $small = false) {
			$postid = get_the_ID();
			$gallery_id = uniqid('gallery-');
			$gallery_html = $lighbox_links_html = '';
			if (metadata_exists('post', $postid, '_'.$prefix.'_image_gallery')) {
				$image_gallery = get_post_meta($postid, '_'.$prefix.'_image_gallery', true);
			} else {
				// Backwards compat
				$attachment_ids = get_posts('post_parent=' . $postid . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
				$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
				$image_gallery = implode(',', $attachment_ids);
			}

			$attachments = array_filter(explode(',', $image_gallery));
			
			if($attachments && !empty($attachments) && is_array($attachments)) {
				foreach($attachments as $key => $id) {
					$image_src = wp_get_attachment_image_src($id, $att);
					$alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);
					$meta_extra = get_post($id);
					
					if(empty($alt_text)) {
						$alt_text = get_the_title();
					}

					$description = '';
					if(isset($meta_extra->post_content) && $meta_extra->post_content != '') {
						$description .= $meta_extra->post_content;
					}
					
					$main_image = $image_src[0];

					if($size) {
						$main_image = dfd_aq_resize($image_src[0], $size[0], $size[1], $size[2], $size[3], $size[4]);
					}

					if(!$main_image) {
						$main_image = $image_src[0];
					}
					
					$thumb_src = wp_get_attachment_image_src($id, 'thumbnail');
					$thumb_data = '';
					
					if (!empty($thumb_src[0])) {
						$thumb_data .= 'data-thumb="'.esc_url($thumb_src[0]).'"';
					}

					$gallery_html .= '<article class="gallery-item">';
						if(!$small) {
							$gallery_html .= '<a data-rel="prettyPhoto['. esc_attr($gallery_id) .']" '. $thumb_data .' class="dfd-lightbox-link" href="'. esc_url($image_src[0]) .'" title="'.esc_attr($description).'">';
						}
								$gallery_html .=  '<span><img src="'.esc_url($main_image).'" alt="'.esc_attr($alt_text).'" /></span>';
						if(!$small) {
							$gallery_html .=  '</a>';
						}
					$gallery_html .=  '</article>';
				}
			}
			
			return $gallery_html;
		}
		/**
		 * Returns grid column class
		 *
		 * @param int $str
		 *
		 * @return string
		 */
		public static function dfd_vc_columns_to_string ($str = 1) {
			$arr = array(1 => 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve');

			if( isset($arr[$str]) )	{
				return $arr[$str];
			} else {
				return 'six';
			}
		}
		/**
		 * Returns class of WooCommerce shop archive page
		 *
		 * @return string
		 */
		public static function build_shop_archive_class() {
			global $dfd_native;

			$page_class = 'dfd-shop-archive dfd-shop-columns-3';

			if(isset($dfd_native['shop_category_columns']) && $dfd_native['shop_category_columns'] != '') {
				$page_class = 'dfd-shop-archive dfd-shop-columns-'.$dfd_native['shop_category_columns'];
			}

			if(isset($dfd_native['woo_category_content_alignment']) && $dfd_native['woo_category_content_alignment'] != '') {
				$page_class .= ' '.$dfd_native['woo_category_content_alignment'];
			}

			if(isset($dfd_native['woo_products_loop_style']) && $dfd_native['woo_products_loop_style'] != '') {
				$page_class .= ' dfd-products-'.$dfd_native['woo_products_loop_style'];
			}
			
			return $page_class;
		}
		/**
		 * Returns data-attributes of WooCommerce shop archive page
		 *
		 * @return string
		 */
		public static function build_shop_archive_data_atts() {
			global $dfd_native;
			
			$data_atts = '';
			
			if(isset($dfd_native['woo_category_item_appear_effect']) && $dfd_native['woo_category_item_appear_effect'] != '') {
				$data_atts = 'data-animate="1" data-animate-type="'.esc_attr($dfd_native['woo_category_item_appear_effect']).'" data-animate-item="li.product"';
			}
			
			return $data_atts;
		}
		/**
		 * Returns array of pre-defined Visual Composer icon packages
		 *
		 * @return array
		 */
		public static function vc_icon_fonts() {
			return array(
				'fontawesome'	=> esc_html__('Awesome','dfd-native'),
				'openiconic'	=> esc_html__('Open Iconic','dfd-native'),
				'typicons'		=> esc_html__('Typicons','dfd-native'),
				'entypo'		=> esc_html__('Entypo','dfd-native'),
				'linecons'		=> esc_html__('Linecons','dfd-native'),
			);
		}
		/**
		 * Returns array which generates icon manager options section
		 *
		 * @return array
		 */
		public static function build_icon_manager_options_section() {
			$_icon_manager_fields = array();
	
			$_icon_manager_fields[] = array (
				'type' => 'icon_manager',
				'id' => 'icon_param',
				'validate'=>'icon_load',
				'title' => esc_html__('Font-icon list:', 'dfd-native'),
				'subtitle' => esc_html__('Upload .zip archive with font-icon files.','dfd-native').'<br>(<a target="_blank" href="https://icomoon.io/app/#/select">'.esc_html__('Create you font-icon package', 'dfd-native').'</a>)',
				'desc' => '<span style="color:#F09191">'.esc_html__('Note:','dfd-native').'</span> '.esc_html__('Supports zip archives generated on','dfd-native').' <b>https://icomoon.io</b> '.esc_html__('website only', 'dfd-native'),
				'placeholder' => array (
						'title' => esc_html__('This is a title', 'dfd-native'),
						'description' => esc_html__('Description Here', 'dfd-native'),
						'url' => esc_html__('Give us a link!', 'dfd-native'),
				),
			);

			if(method_exists('Dfd_Theme_Helpers','vc_icon_fonts')) {
				$default_vc_icons = self::vc_icon_fonts();
				if(!empty($default_vc_icons) && is_array($default_vc_icons)) {
						$_icon_manager_fields[] = array(
							'id' => 'info_msc',
							'type' => 'info',
							'desc' => '<h3 class="description">'.esc_html__('Default icon packages for Visual Composer', 'dfd-native').'</h3>'
						);
					foreach($default_vc_icons as $name => $title) {
						$_icon_manager_fields[] = array(
								'id' => $name,
								'type' => 'button_set',
								'title' => $title,
								'options' => array('on' => esc_html__('On', 'dfd-native'), 'off' => esc_html__('Off', 'dfd-native')),
								'default' => 'off'
							);
					}
				}
			}
			
			return $_icon_manager_fields;
		}
		/**
		 * Returns list of Visual Composer icon packages
		 *
		 * @param bool $none
		 *
		 * @return array
		 */
		public static function build_vc_icons_fonts_list($none = true) {
			global $dfd_native;
			
			$default_vc_icons = self::vc_icon_fonts();
			$font_values = array();
			
			if($none) {
				$title = esc_html__('None', 'dfd-native');
				$font_values[$title] = '';
			}
			
			$prebuilt = esc_html__('Standard', 'dfd-native');
			$font_values[$prebuilt] = 'dfd_icons';
			
			if(!empty($default_vc_icons) && is_array($default_vc_icons)) {
				foreach($default_vc_icons as $name => $title) {
					if(!isset($dfd_native[$name]) || $dfd_native[$name] == 'on') {
						$font_values[$title] = $name;
					}
				}
			}
			
			return $font_values;
		}
		/**
		 * Generates Visual Composer icon manager param section
		 *
		 * @param string $font
		 * @param string $group
		 * @param array $params
		 * @param string $prefix
		 * @param string $dep_param
		 *
		 * @return array
		 */
		public static function build_vc_icons_param($font = '', $group = '', $params = array(), $prefix = 'ic_', $dep_param = 'select_icon') {
			global $dfd_native;
			
			$param_fields = false;
			
			if(!isset($dfd_native[$font]) || $dfd_native[$font] == 'on') {
			
				$icons_for_fonts = array(
					'fontawesome'	=> 'fa fa-adjust',
					'openiconic'	=> 'vc-oi vc-oi-dial',
					'typicons'		=> 'typcn typcn-adjust-brightness',
					'entypo'		=> 'entypo-icon entypo-icon-note',
					'linecons'		=> 'vc_li vc_li-heart',
				);

				$param_fields = array(
					'type'				=> 'iconpicker',
					'heading'			=> esc_html__('Select Icon ', 'dfd-native'),
					'param_name'		=> $prefix.$font,
					'value'				=> $icons_for_fonts[$font],
					'settings'			=> array(
						'emptyIcon'			=> false,
						'type'				=> $font,
						'iconsPerPage'		=> 4000,
					),
					'dependency'		=> array('element' => $dep_param, 'value' => $font),
				);

				if($group != '') {
					$param_fields['group'] = $group;
				}
			
				$param_fields = array_merge($param_fields, $params);
			}
			
			return $param_fields;
		}
		/**
		 * Returns blog section pop-up link for audio or video post for lightbox media preview
		 *
		 * @param string $format
		 *
		 * @return string
		 */
		public static function build_blog_popup_link($format) {
			$avail_types = array('audio', 'video');
			if(isset($format) && in_array($format, $avail_types)) {
				$method = 'build_blog_popup_'.$format.'_link';
				if(method_exists('Dfd_Theme_Helpers', $method)) {
					return self::$method();
				}
			}
		}
		/**
		 * Returns blog section pop-up link for audio post
		 *
		 *
		 * @return string
		 */
		public static function build_blog_popup_audio_link() {
			$audio_url = '';
			
			$post_id = get_the_ID();
			
			if(get_post_meta($post_id, 'post_custom_post_audio_url', true)) {
				$audio_url = get_post_meta($post_id, 'post_custom_post_audio_url', true);
			} elseif(get_post_meta($post_id, 'post_self_hosted_audio', true)) {
				$audio_url = get_post_meta($post_id, 'post_self_hosted_audio', true);
			}
			
			return $audio_url;
		}
		/**
		 * Returns blog section pop-up link for video post
		 *
		 *
		 * @return string
		 */
		public static function build_blog_popup_video_link() {
			$post_id = get_the_ID();
			$video_src = get_post_meta($post_id, 'post_single_video_src', true);
			switch($video_src) {
				case 'youtube':
					$video_url = get_post_meta($post_id, 'post_youtube_video_url', true);
					if(substr_count($video_url, '?') > 0) {
						$video_url = substr($video_url,(stripos($video_url,'?v=')+3));
					}
					if(substr_count($video_url, '&') > 0) {
						$video_url = substr($video_url, 0, stripos($video_url,'&'));
					}
					$video_url = 'http://youtube.com/watch?v='.$video_url.'&amp;width=1200&amp;height=675';
					break;
				case 'vimeo':
					$video_url = get_post_meta($post_id, 'post_vimeo_video_url', true);
					if(substr_count($video_url, 'vimeo.com/') > 0) {
						$video_url = substr($video_url,(stripos($video_url, 'vimeo.com/')+10));
					}
					if(substr_count($video_url, '&') > 0) {
						$video_url = substr($video_url, 0, stripos($video_url,'&'));
					}
					$video_url = 'http://vimeo.com/'.$video_url.'&amp;width=1200&amp;height=675';
					break;
				default:
					$video_url = '';
					break;
			}
			
			return $video_url;
		}
		/**
		 * Audio post song metabox field value
		 *
		 * @return string
		 */
		public static function build_blog_popup_audio_title() {
			return DfdMetaBoxSettings::get('post_audio_song');
		}
		/**
		 * Audio post song author metabox field value
		 *
		 * @return string
		 */
		public static function build_blog_popup_audio_subtitle() {
			return DfdMetaBoxSettings::get('post_audio_author');
		}
		/**
		 * Returns image url for audio post lightbox
		 *
		 * @return string
		 */
		public static function build_blog_popup_audio_image() {
			$url = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
			if(has_post_thumbnail()) {
				$thumb = get_post_thumbnail_id();
				$thumb_src = wp_get_attachment_image_src($thumb, 'full');
				$url = dfd_aq_resize($thumb_src[0], 500, 350, true, true, true);
			}
			
			return $url;
		}
		/**
		 * Returns delimiter VC param options array
		 *
		 * @return array
		 */
		public static function vc_delimiter_get_params() {
			return array(
				'delimiter_style' => '',
				'delimiter_width' => '',
				'delimiter_height' => '',
				'delimiter_color' => '',
			);
		}
		/**
		 * Returns margin VC param options array
		 *
		 * @return array
		 */
		public static function vc_margin_get_params() {
			return array(
				'margin-top' => '',
				'margin-bottom' => '',
				'margin-left' => '',
				'margin-right' => '',
			);
		}
		/**
		 * Returns border VC param options array
		 *
		 * @return array
		 */
		public static function vc_border_get_params() {
			return array(
				'border_style' => '',
				'border_width' => '',
				'border_top_width' => '',
				'border_bottom_width' => '',
				'border_left_width' => '',
				'border_right_width' => '',
				'border_radius' => '',
				'border_color' => '',
			);
		}
		/**
		 * Returns box-shadow VC param options array
		 *
		 * @return array
		 */
		public static function vc_box_shadow_get_params() {
			return array(
				'box_shadow_enable' => 'disable',
				'shadow_horizontal' => '0',
				'shadow_vertical' => '15',
				'shadow_blur' => '50',
				'shadow_spread' => '0',
				'box_shadow_color' => 'rgba(0,0,0,.35)',
			);
		}
		/**
		 * Returns gradient VC param options array
		 *
		 * @return array
		 */
		public static function vc_gradient_get_params() {
			return array(
				'gradient_style' => '',
				'gradient_custom_direction' => '',
				'gradient_value' => '',
				'gradient_css' => '',
			);
		}
		/**
		 * Returns responsive VC param options array
		 *
		 * @return array
		 */
		public static function vc_responsive_get_params() {
			return array(
				'margin_top_desktop' => '',
				'margin_bottom_desktop' => '',
				'margin_left_desktop' => '',
				'margin_right_desktop' => '',
				'padding_top_desktop' => '',
				'padding_bottom_desktop' => '',
				'padding_left_desktop' => '',
				'padding_right_desktop' => '',
				'border_top_desktop' => '',
				'border_bottom_desktop' => '',
				'border_left_desktop' => '',
				'border_right_desktop' => '',
				'margin_top_tablet' => '',
				'margin_bottom_tablet' => '',
				'margin_left_tablet' => '',
				'margin_right_tablet' => '',
				'padding_top_tablet' => '',
				'padding_bottom_tablet' => '',
				'padding_left_tablet' => '',
				'padding_right_tablet' => '',
				'border_top_tablet' => '',
				'border_bottom_tablet' => '',
				'border_left_tablet' => '',
				'border_right_tablet' => '',
				'margin_top_mobile' => '',
				'margin_bottom_mobile' => '',
				'margin_left_mobile' => '',
				'margin_right_mobile' => '',
				'padding_top_mobile' => '',
				'padding_bottom_mobile' => '',
				'padding_left_mobile' => '',
				'padding_right_mobile' => '',
				'border_top_mobile' => '',
				'border_bottom_mobile' => '',
				'border_left_mobile' => '',
				'border_right_mobile' => '',
			);
		}
		/**
		 * Returns responsive typography VC param options array
		 *
		 * @return array
		 */
		public static function vc_responsive_text_get_params() {
			return array(
				'font_size_desktop' => '',
				'line_height_desktop' => '',
				'letter_spacing_desktop' => '',
				'font_size_tablet' => '',
				'line_height_tablet' => '',
				'letter_spacing_tablet' => '',
				'font_size_mobile' => '',
				'line_height_mobile' => '',
				'letter_spacing_mobile' => '',
			);
		}
		/**
		 * Parses custom VC params values
		 *
		 * @param mixed $value
		 * @param string $method
		 *
		 * @return string
		 */
		public static function vc_param_parse_value($value, $method = '') {
			if($method != '' && method_exists('Dfd_Theme_Helpers', $method)) {
				$params = self::$method();
			
				$values = vc_parse_multi_attribute($value, $params);
			}
			
			return $values;
		}
		/**
		 * Generates subfooter columns html
		 *
		 * @param int $i
		 * @param string $columns_class
		 *
		 * @return string
		 */
		public static function build_subfooter_column($i = 1, $columns_class = 'twelve') {
			global $dfd_native;
			
			$html = '';
			
			if(isset($dfd_native['subfooter_column_'.$i.'_content']) && !empty($dfd_native['subfooter_column_'.$i.'_content'])) {
				
				if(isset($dfd_native['subfooter_column_'.$i.'_content_align']) && $dfd_native['subfooter_column_'.$i.'_content_align'] != '') {
					$columns_class .= ' '.$dfd_native['subfooter_column_'.$i.'_content_align'];
				}
				
				switch($dfd_native['subfooter_column_'.$i.'_content']) {
					case 'copyright':
						if(isset($dfd_native['copyright_subfooter_'.$i]) && !empty($dfd_native['copyright_subfooter_'.$i])) {
							$html .= '<div class="'.esc_attr($columns_class).' columns">';
								$html .= '<div class="subfooter-copyright dfd-vertical-aligned">';
									$html .= wp_kses($dfd_native['copyright_subfooter_'.$i],array(
										'span' => array(
											'class' => array(),
										),
										'i' => array(
											'class' => array(),
										),
										'img' => array(
											'src' => array(),
											'class' => array(),
											'alt' => array(),
											'style' => array(),
										),
										'strong' => array(),
										'em' => array(),
										'br' => array(),
										'a' => array(
											'href' => array(),
											'class' => array(),
											'mailto' => array(),
											'callto' => array(),
											'target' => array()
										)
									));
								$html .= '</div>';
							$html .= '</div>';
						}
						break;
					case 'logo':
						if(isset($dfd_native['logo_subfooter_'.$i]['url']) && !empty($dfd_native['logo_subfooter_'.$i]['url'])) {
							$html .= '<div class="'.esc_attr($columns_class).' columns">';
								$html .= '<a href="'.esc_url(get_home_url('/')).'" class="dfd-vertical-aligned dfd-subfooter-logo-wrap" title="'.esc_attr__('Home','dfd-native').'">';
									$html .= '<img src="'.esc_url($dfd_native['logo_subfooter_'.$i]['url']).'" alt="'.esc_attr__('Subfooter logo','dfd-native').'" />';
								$html .= '</a>';
							$html .= '</div>';
						}
						break;
					case 'soc_icons':
						$html .= '<div class="'.esc_attr($columns_class).' columns">';
							$html .= '<div class="widget dfd-vertical-aligned soc-icons">';
								ob_start();
								Dfd_Theme_Helpers::dfd_social_networks(true);
								$html .= ob_get_clean();
							$html .= '</div>';
						$html .= '</div>';
						break;
				}
			}
			
			return $html;
		}
		/**
		 * Generates WooCommerce archive produucts page thumbnails html
		 *
		 * @return string
		 */
		public static function dfd_woo_product_thumbs() {
			global $post, $product, $dfd_native;
	
			$lightbox_html = $image_src = $thumbnail_id = $preview_thumb_id = $preview_thumb_src = $second_image_src = '';

			$attachment_ids = array();
			if(method_exists($product, 'get_gallery_image_ids')) {
				$attachment_ids = $product->get_gallery_image_ids();
			} elseif(method_exists($product, 'get_gallery_attachment_ids')) {
				$attachment_ids = $product->get_gallery_attachment_ids();
			}
			
			/* Thumb */
			if ( has_post_thumbnail() ) {
				$thumbnail_id = get_post_thumbnail_id( $post->ID );
				$preview_thumb_id = $thumbnail_id;
				array_unshift($attachment_ids, $thumbnail_id);
				array_unique($attachment_ids);
			}

			$unique_id = uniqid('product_slider_');
			
			if(function_exists('wc_get_image_size')) {
				$image_size = wc_get_image_size('shop_catalog');
			} else {
				$image_dimentions = dfd_woocommerce_image_size_options();
				$image_size = $image_dimentions['catalog'];
			}
			
			echo '<div id="'. esc_attr($unique_id) .'" class="woo-entry-thumb">';
				if(!empty($attachment_ids)) {

					$i = 0;
					
					foreach ( $attachment_ids as $attachment_id ) {
						$image_url = wp_get_attachment_image_src( $attachment_id, 'large' );
						$image_src = dfd_aq_resize($image_url[0], $image_size['width'], $image_size['height'], $image_size['crop'], true, true);

						if(!$image_src) {
							$image_src = $image_url[0];
						}

						if($attachment_id != $thumbnail_id) {
							$data_thumb = '';
							$thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
							if(isset($thumb_url[0])) {
								$data_thumb = 'data-thumb="'.esc_url($thumb_url[0]).'"';
							}

							$lightbox_html .= '<a href="'.esc_url($image_src).'" '. $data_thumb .' data-rel="prettyPhoto[product-gallery-'. esc_attr($post->ID) .']"></a>';
						}
						
						if($i == 0) {
							$preview_thumb_src = $image_src;
						}
						
						if($i == 1) {
							$second_image_src = $image_src;
						}
							
						$i++;
					}
				}
				
				if(!$preview_thumb_src || $preview_thumb_src == '') {
					$preview_thumb_src = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
				}

				if(!$second_image_src || $second_image_src == '') {
					$second_image_src = get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
				}

				echo '<div class="preview-thumb">';
					echo '<img src="'. esc_url($preview_thumb_src) .'" alt="" />';
				echo '</div>';
					
				echo '<div class="woo-entry-thumb-carousel">';
					$image = '<img src="'.esc_url($second_image_src).'" alt="" />';
					
					if(!isset($dfd_native['woocommerce_catalogue_mode']) || $dfd_native['woocommerce_catalogue_mode'] != '1') {
						$image = '<a href="'.esc_url(get_permalink()).'" title="">'.$image.'</a>';
					}

					$tmpl = '<div>%s</div>';
					echo apply_filters(
						'woocommerce_single_product_image_thumbnail_html', 
						sprintf( $tmpl, 
							$image
						),
						$post->ID
					);

				echo '</div>';

			echo '</div>';

			if($lightbox_html != '') {
				echo '<div class="hide">'. $lightbox_html .'</div>';
			}
		}
		/**
		 * Generates WooCommerce archive page buttons section html
		 *
		 * @return string
		 */
		public static function dfd_woocommerce_loop_button_wrap() {
			global $dfd_native;
			
			$catalogue_mode = (isset($dfd_native['woocommerce_catalogue_mode']) && $dfd_native['woocommerce_catalogue_mode']);

			echo '<div class="buttons-wrap">';
				echo '<div>';

					if(!$catalogue_mode && function_exists('woocommerce_template_loop_add_to_cart')) {
						woocommerce_template_loop_add_to_cart();
					}
					if(has_post_thumbnail()) {
						$thumb_data = '';
						$thumb_id = get_post_thumbnail_id();
						$thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail');
						if(isset($thumb_url[0])) {
							$thumb_data = 'data-thumb="'.esc_url($thumb_url[0]).'"';
						}
						echo '<a href="'. esc_url(wp_get_attachment_url($thumb_id)) .'" '. $thumb_data .' title="" class="dfd-prod-lightbox" data-rel="prettyPhoto[product-gallery-'. esc_attr(get_the_ID()) .']">';
							echo '<i class="dfd-socicon-eye-open"></i>';
						echo '</a>';
					}
				echo '</div>';
			echo '</div>';
		}
		/**
		 * Returns url of NO IMAGE pre-defined image
		 *
		 * @param string $size
		 *
		 * @return string
		 */
		public static function default_noimage_url($size = "") {
			switch ($size) {
				case "rect_small_140":
					return get_template_directory_uri() . '/assets/images/no_image_resized_675-450-140x140.jpg';
					break;
				case "rect_med_300":
					return get_template_directory_uri() . '/assets/images/no_image_resized_675-450-300x300.jpg';
					break;
				default:
					return get_template_directory_uri() . '/assets/images/no_image_resized_675-450.jpg';
					break;
			}
		}
		/**
		 * Generates page layout HTML markup
		 *
		 * @param string $page
		 * @param bool $open
		 *
		 * @return string
		 */
		public static function set_layout($page, $open = true) {
			global $dfd_native;
			$page = isset($dfd_native[$page . '_layout']) && !empty($dfd_native[$page . '_layout']) ? $dfd_native[$page . '_layout'] : '1col-fixed';

			switch($page) {
				case '2c-l-fixed':
					$dfd_layout = 'sidebar-left';
					$dfd_width = 'nine';
					break;
				case '2c-r-fixed':
					$dfd_layout = 'sidebar-right';
					$dfd_width = 'nine';
					break;
				case '3c-fixed':
					$dfd_layout = 'sidebar-both';
					$dfd_width = 'six';
					break;
				case '1col-fixed':
				default:
					$dfd_layout = 'no-sidebars';
					$dfd_width = 'twelve';
			}

			if ($open) {

				// Open content wrapper


				echo '<div class="blog-section ' . esc_attr($dfd_layout) . '">';
				echo '<section id="main-content" role="main" class="' . $dfd_width . ' columns">';


			} else {

				// Close content wrapper

				echo ' </section>';

				if (($page == "2c-l-fixed") || ($page == "3c-fixed")) {
					get_template_part('templates/sidebar', 'left');
					echo ' </div>';
				}
				if (($page == "2c-r-fixed") || ($page == "3c-fixed") || ($page == "3c-r-fixed") ) {
					get_template_part('templates/sidebar', 'right');
				}
				echo '</div>';
			}
		}
		/**
		 * Returns array for portfolio and gallery hover 
		 *
		 * @param string $post_type
		 *
		 * @return bool|array
		 */
		public static function build_folio_gallery_hover_params($post_type = 'portfolio') {
			if($post_type != 'portfolio' && $post_type != 'gallery') {
				return false;
			}
			return array(
				array(
					'type'             => 'dfd_heading_param',
					'text'             => esc_html__( 'Main hover settings', 'dfd-native' ),
					'param_name'       => 'hover_main_heading',
					'group'            => esc_attr__( 'Hover', 'dfd-native' ),
					'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
				),
				array(
					'type'        => 'dfd_single_checkbox',
					'heading'     => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the hover effect for the gallery items','dfd-native').'</span></span>'.esc_html__( 'Hover', 'dfd-native' ),
					'param_name'  => $post_type.'_hover_enable',
					'value' => 'on',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'group'       => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to select the hover effect for the mask appearing','dfd-native').'</span></span>'.esc_html__('Mask appear effect','dfd-native'),
					'param_name' => $post_type.'_hover_appear_effect',
					'value' => array(
						esc_attr__('Fade out','dfd-native') => 'dfd-fade-out',
						esc_attr__('Fade out offset','dfd-native') => 'dfd-fade-offset',
						esc_attr__('Left to right','dfd-native') => 'dfd-left-to-right',
						esc_attr__('Right to left','dfd-native') => 'dfd-right-to-left',
						esc_attr__('Top to bottom','dfd-native') => 'dfd-top-to-bottom',
						esc_attr__('Bottom to top','dfd-native') => 'dfd-bottom-to-top',
						esc_attr__('Following the mouse','dfd-native') => 'portfolio-hover-style-1',
					),
					'dependency' => array('element' => $post_type.'_hover_enable','value' => array('on')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image behavior on hover','dfd-native').'</span></span>'.esc_html__('Image hover effect','dfd-native'),
					'param_name' => $post_type.'_hover_image_effect',
					'value' => array(
						esc_attr__('None','dfd-native') => 'none',
						esc_attr__('Image parallax','dfd-native') => 'panr',
						esc_attr__('Grow','dfd-native') => 'dfd-image-scale',
						esc_attr__('Grow with rotation','dfd-native') => 'dfd-image-scale-rotate',
						esc_attr__('Shift left','dfd-native') => 'dfd-image-shift-left',
						esc_attr__('Shift right','dfd-native') => 'dfd-image-shift-right',
						esc_attr__('Shift top','dfd-native') => 'dfd-image-shift-top',
						esc_attr__('Shift bottom','dfd-native') => 'dfd-image-shift-bottom',
						esc_attr__('Blur','dfd-native') => 'dfd-image-blur',
					),
					'dependency' => array(
						'element'	=> $post_type.'_hover_appear_effect',
						'value'		=> array(
							'dfd-fade-out','dfd-fade-offset','dfd-left-to-right','dfd-right-to-left','dfd-top-to-bottom','dfd-bottom-to-top'
							)
						),
					'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type'             => 'dfd_heading_param',
					'text'             => esc_html__( 'Hover mask settings', 'dfd-native' ),
					'param_name'       => 'hover_deco_heading',
					'dependency' => array('element' => $post_type.'_hover_enable','value' => array('on')),
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group'            => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'colorpicker',
					'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the content text. The default value is inherited from Theme Options > Gallery Options > Gallery hover style options > Text color','dfd-native').'</span></span>'. esc_html__('Mask content color', 'dfd-native'),
					'param_name' => $post_type.'_hover_mask_color',
					'dependency' => array('element' => $post_type.'_hover_enable','value' => array('on')),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'group' => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type'			=> 'dfd_radio_advanced',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background style, you can choose simple color or gradient. The default value is inherited from Theme Options > Gallery Options > Gallery hover style options > Hover mask background style','dfd-native').'</span></span>'. esc_html__('Hover mask background style','dfd-native'),
					'param_name'	=> $post_type.'_hover_mask_background_style',
					'value'			=> 'simple-color',
					'options'		=> array(
						esc_html__('Simple color','dfd-native')	=> 'simple-color',
						esc_html__('Gradient','dfd-native')		=> 'gradient',
					),
					'dependency'	=> array('element' => $post_type.'_hover_enable','value' => array('on')),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'group'			=> esc_html__( 'Hover', 'dfd-native' ),
				),
				array (
					'type' => 'colorpicker',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the mask background color. The default value is inherited from Theme Options > Gallery Options > Gallery hover style options > Hover mask background color','dfd-native').'</span></span>'. esc_html__('Mask background', 'dfd-native'),
					'param_name' => $post_type.'_hover_mask_background',
					'group' => esc_attr__( 'Hover', 'dfd-native' ),
					'edit_field_class' => 'vc_column vc_col-sm-12 dfd-hide-alpha',
					'dependency' => array('element' => $post_type.'_hover_mask_background_style','value' => array('simple-color')),
				),
				array (
					'type' => 'colorpicker',
					'param_name' => $post_type.'_hover_mask_bg_start_color',
					'heading' =>  '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the start color for the mask background gradient. The default value is inherited from Theme Options > Gallery Options > Gallery hover style options > Background gradient','dfd-native').'</span></span>'. esc_html__('Start color', 'dfd-native'),
					'edit_field_class' => 'vc_column vc_col-sm-6 dfd-hide-alpha',
					'group' => esc_attr__( 'Hover', 'dfd-native' ),
					'dependency' => array('element' => $post_type.'_hover_mask_background_style','value' => array('gradient')),
				),
				array (
					'type' => 'colorpicker',
					'param_name' => $post_type.'_hover_mask_bg_end_color',
					'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the end color for the mask background gradient. The default value is inherited from Theme Options > Gallery Options > Gallery hover style options > Background gradient','dfd-native').'</span></span>'.  esc_html__('End color', 'dfd-native'),
					'edit_field_class' => 'vc_column vc_col-sm-6 dfd-hide-alpha',
					'group' => esc_attr__( 'Hover', 'dfd-native' ),
					'dependency' => array('element' => $post_type.'_hover_mask_background_style','value' => array('gradient')),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover mask background opacity. The default value is inherited from Theme Options > Gallery Options > Gallery hover style options > Background opacity','dfd-native').'</span></span>'. esc_html__('Hover mask background opacity','dfd-native'),
					'min' => 1,
					'max' => 100,
					'param_name' => $post_type.'_hover_mask_background_opacity',
					'dependency' => array('element' => $post_type.'_hover_enable','value' => array('on')),
					'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-percent crum_vc',
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the frame decoration on hover','dfd-native').'</span></span>'. esc_html__('Hover mask frame decoration','dfd-native'),
					'param_name' => $post_type.'_hover_mask_border',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'dependency' => array('element' => $post_type.'_hover_enable','value' => array('on')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the style for the frame decoration on hover','dfd-native').'</span></span>'. esc_html__('Hover mask frame style','dfd-native'),
					'param_name' => $post_type.'_hover_mask_bordered_style',
					'value'	=> 'simple-border',
					'options' => array(
						esc_attr__('Simple','dfd-native') => 'simple-border',
						esc_attr__('Offset','dfd-native') => 'offset',
					),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					'dependency' => array('element' => $post_type.'_hover_mask_border','value' => array('on')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the size for the frame decoration on hover','dfd-native').'</span></span>'. esc_html__('Hover mask frame size','dfd-native'),
					'param_name' => $post_type.'_hover_mask_bordered_size',
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom dfd-number-wrap crum_vc',
					'dependency' => array('element' => $post_type.'_hover_mask_border','value' => array('on')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type'             => 'dfd_heading_param',
					'text'             => esc_html__( 'Hover decoration settings', 'dfd-native' ),
					'param_name'       => 'hover_elements_heading',
					'group'            => esc_attr__( 'Hover', 'dfd-native' ),
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'dependency' => array('element' => $post_type.'_hover_mask_border','value' => array('on')),
				),
				array(
					'type'			=> 'dfd_radio_advanced',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the behavior for the decoration link', 'dfd-native') . '</span></span>' .esc_html__('Decoration link','dfd-native'),
					'param_name'	=> $post_type.'_hover_main_decoration_link',
					'value'			=> 'inside',
					'options'		=> array(
						esc_attr__('Inside','dfd-native')			=> 'inside',
						esc_attr__('External link','dfd-native')	=> 'external',
						esc_attr__('Lightbox','dfd-native')		=> 'lightbox',
					),
					'dependency'	=> array('element' => $post_type.'_hover_main_decoration', 'value_not_equal_to' => array('buttons')),
					'group'			=> esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type'			=> 'dfd_radio_advanced',
					'heading'		=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('This option allows you to choose the main decoration style', 'dfd-native') . '</span></span>' .esc_html__('Main decoration','dfd-native'),
					'param_name'	=> $post_type.'_hover_main_decoration',
					'value'			=> 'heading',
					'options'		=> array(
						esc_attr__('Heading','dfd-native') => 'heading',
						esc_attr__('Plus','dfd-native')	=> 'plus',
						esc_attr__('Dots','dfd-native')	=> 'dots',
						esc_attr__('Buttons','dfd-native') => 'buttons',
						esc_attr__('None','dfd-native')	=> 'none',
					),
					'dependency'	=> array('element' => $post_type.'_hover_enable','value' => array('on')),
					'group'			=> esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => esc_html__('Title','dfd-native'),
					'param_name' => $post_type.'_hover_show_title',
					'value' => 'on',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					'dependency' => array('element' => $post_type.'_hover_main_decoration','value' => array('heading')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => esc_html__('Subtitle','dfd-native'),
					'param_name' => $post_type.'_hover_show_subtitle',
					'value' => 'on',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					'dependency' => array('element' => $post_type.'_hover_main_decoration','value' => array('heading')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Plus style','dfd-native'),
					'param_name' => $post_type.'_hover_plus_position',
					'value' => array(
						esc_attr__('Big plus in the middle of the thumb','dfd-native') => 'dfd-middle',
						esc_attr__('Small plus in the middle of the thumb','dfd-native') => 'dfd-middle dfd-plus-bordered',
						esc_attr__('Following the mouse','dfd-native') => 'dfd-cursor-plus',
					),
					'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
					'dependency' => array('element' => $post_type.'_hover_main_decoration','value' => array('plus')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => esc_html__('Link inside gallery item','dfd-native'),
					'param_name' => $post_type.'_hover_buttons_inside',
					'value' => 'on',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'dependency' => array('element' => $post_type.'_hover_main_decoration','value' => array('buttons')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => esc_html__('Gallery item external link','dfd-native'),
					'param_name' => $post_type.'_hover_buttons_external',
					'value' => 'on',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'dependency' => array('element' => $post_type.'_hover_main_decoration','value' => array('buttons')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				),
				array(
					'type' => 'dfd_single_checkbox',
					'heading' => esc_html__('Lightbox','dfd-native'),
					'param_name' => $post_type.'_hover_buttons_lightbox',
					'value' => 'on',
					'options' => array(
						'on' => array(
							'label' => '',
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'dependency' => array('element' => $post_type.'_hover_main_decoration','value' => array('buttons')),
					'group'      => esc_attr__( 'Hover', 'dfd-native' ),
				)
			);
		}
		/**
		 * Returns xml request result
		 *
		 * @param string $xml_url
		 *
		 * @return bool|string
		 */
		public static function tie_curl_subscribers_text_counter( $xml_url ) {
			$data_buf = wp_remote_get($xml_url, array('sslverify' => false));
			if (!is_wp_error($data_buf) && isset($data_buf['body'])) {
				return $data_buf['body'];
			}
			return false;
		}
		/**
		 * Returns the number of rss subscribers
		 *
		 * @param string $fb_id
		 *
		 * @return string
		 */
		public static function tie_rss_count( $fb_id ) {
			$feedburner['rss_count'] = get_option( 'rss_count');
			return $feedburner;
		}
		/**
		 * Returns the number of rss subscribers
		 *
		 * @param string $fb_id
		 *
		 * @return string
		 */
		public static function dfd_tweet_followers_count() {
			global $dfd_native;
			if(!class_exists('DFDTwitter')) {
				return;
			}
			$twitter_username = isset($dfd_native['username']) ? $dfd_native['username'] : '';

			$r['page_url'] = 'http://www.twitter.com/'.$twitter_username;

			try {
				$twitter = new DFDTwitter();
				$r['followers_count'] = $twitter->getFollowersCount();
			} catch (Exception $e) {
				$r['followers_count'] = 0;
			}

			return $r;
		}
		/**
		 * Returns the number of facebook fans
		 *
		 * @param string $page_id
		 *
		 * @return string
		 */
		public static function dfd_facebook_fans( $page_id, $app_id, $token ){
			global $dfd_native;
			$cachetime = (isset($dfd_native['cachetime']) && $dfd_native['cachetime']) ? ((int) $dfd_native['cachetime'] * 60) : (60 * 60 * 1);
		
			$api_url = 'https://graph.facebook.com';
			if(empty($page_id)) {
				$page_id = '100007429063653';
			}
			if(empty($app_id)) {
				$app_id = '1305760362801157';
			}
			if(empty($token)) {
				$token = '3d0ddfafdfc886fa8075d4a5992c25b7';
			}
			$url = sprintf(
				'%s/oauth/access_token?client_id=%s&client_secret=%s&grant_type=client_credentials',
				$api_url,
				sanitize_text_field( $app_id ),
				sanitize_text_field( $token )
			);
			
			$access_token = wp_remote_get( $url, array( 'timeout' => 60 ) );
			
			if ( is_wp_error( $access_token ) || ( isset( $access_token['response']['code'] ) && 200 != $access_token['response']['code'] ) ) {
				return get_transient( 'facebook_fans_cache') ? get_transient( 'facebook_fans_cache') : 0;
			} else {
				$access_token = json_decode($access_token['body'], true);
				if(!isset($access_token['access_token'])) {
					return get_transient( 'facebook_fans_cache') ? get_transient( 'facebook_fans_cache') : 0;
				} else {
					$access_token = sanitize_text_field( $access_token['access_token'] );
				}
			}
			
			$url = sprintf(
				'%s%s/friends?fields=fan_count&summery=true&access_token=%s',
				$api_url . '/v2.8/',
				sanitize_text_field( $page_id ),
				$access_token
			);

			$connection = wp_remote_get( $url, array( 'timeout' => 60 ) );

			if ( is_wp_error( $connection ) || ( isset( $connection['response']['code'] ) && 200 != $connection['response']['code'] ) ) {
				return get_transient( 'facebook_fans_cache') ? get_transient( 'facebook_fans_cache') : 0;
			} else {
				$_data = json_decode( $connection['body'], true );

				if ( isset( $_data['summary']['total_count'] ) ) {
					$count = intval( $_data['summary']['total_count'] );

					$fans = $count;
				} else {
					return get_transient( 'facebook_fans_cache') ? get_transient( 'facebook_fans_cache') : 0;
				}
			}
			
			set_transient( 'facebook_fans_cache', $fans, $cachetime );
			return $fans;
		}
		/**
		 * Returns the number of rss subscribers
		 *
		 * @param string $page_id
		 *
		 * @return string
		 */
		public static function get_google_plus_circles($page_id) {
			global $dfd_native, $wp_filesystem;
			if(!$page_id || empty($page_id)) {
				return esc_html__('No valid G+ ID given','dfd-native');
			}

			$circled = esc_html__('No data found','dfd-native');

			$google_api_key = 'AIzaSyBcVwc05rajri1UMe5y_uWksWzuOKgj1U0';
			
			if(isset($dfd_native['custom_google_api_key']) && !empty($dfd_native['custom_google_api_key'])) {
				$google_api_key = $dfd_native['custom_google_api_key'];
			}
			
			$data = @self::tie_curl_subscribers_text_counter("https://www.googleapis.com/plus/v1/people/$page_id?key=$google_api_key");
			$data = json_decode($data, true);

			if(isset($data['circledByCount']) && !empty($data['circledByCount'])) {
				$circled = $data['circledByCount'];
			}

			return $circled;
		}
		/**
		 * Returns the number of youtube subscribers
		 *
		 * @param string $channel_link
		 * @param string $api_key
		 *
		 * @return string
		 */
		public static function dfd_youtube_subs( $channel_link, $api_key ){
			$youtube_link = @parse_url($channel_link);
			$subs = 0;
			global $dfd_native;
			$cachetime = (isset($dfd_native['cachetime']) && $dfd_native['cachetime']) ? ((int) $dfd_native['cachetime'] * 60) : (60 * 60 * 1);

			if ( false === ( $subs = get_transient( 'youtube_subs_cache' ) ) ) {
				if( $youtube_link['host'] == 'www.youtube.com' || $youtube_link['host']  == 'youtube.com' ){
					try {
						$youtube_name = substr(@parse_url($channel_link, PHP_URL_PATH), 9);
						$json = @self::tie_curl_subscribers_text_counter("https://www.googleapis.com/youtube/v3/channels?part=statistics&id=".$youtube_name."&key=".$api_key);
						$data = json_decode($json, true);

						$subs = intval($data['items'][0]['statistics']['subscriberCount']);
					} catch (Exception $e) {
						$subs = 0;
					}

					set_transient( 'youtube_subs_cache', $subs, $cachetime );
				}
			}

			return $subs;
		}
		/**
		 * Returns the number of vimeo followers
		 *
		 * @param string $page_link
		 *
		 * @return string
		 */
		public static function dfd_vimeo_count( $page_link ) {
			$face_link = @parse_url($page_link);

			if( $face_link['host'] == 'www.vimeo.com' || $face_link['host']  == 'vimeo.com' ){
				try {
					$page_name = substr(@parse_url($page_link, PHP_URL_PATH), 10);
					@$data = @json_decode(self::tie_curl_subscribers_text_counter( 'http://vimeo.com/api/v2/channel/' . $page_name  .'/info.json'));

					$vimeo = $data->total_subscribers;
				} catch (Exception $e) {
					$vimeo = 0;
				}

				if( !empty($vimeo) && get_option( 'vimeo_count') != $vimeo ) {
					update_option( 'vimeo_count' , $vimeo );
				}

				if( $vimeo == 0 && get_option( 'vimeo_count') ) {
					$vimeo = get_option( 'vimeo_count');
				} elseif( $vimeo == 0 && !get_option( 'vimeo_count') ) {
					$vimeo = 0;
				}

				return $vimeo;
			}

		}
		/**
		 * Returns the number of dribbble
		 *
		 * @param string $page_link
		 *
		 * @return string
		 */
		public static function dfd_dribbble_count( $page_link ) {
			$face_link = @parse_url($page_link);

			if( $face_link['host'] == 'www.dribbble.com' || $face_link['host']  == 'dribbble.com' ){
				try {
					$page_name = substr(@parse_url($page_link, PHP_URL_PATH), 1);
					@$data = @json_decode(self::tie_curl_subscribers_text_counter( 'http://api.dribbble.com/' . $page_name));

					$dribbble = $data->followers_count;
				} catch (Exception $e) {
					$dribbble = 0;
				}

				if( !empty($dribbble) && get_option( 'dribbble_count') != $dribbble ) {
					update_option( 'dribbble_count' , $dribbble );
				}
				if( $dribbble == 0 && get_option( 'dribbble_count') ) {
					$dribbble = get_option( 'dribbble_count');
				} elseif( $dribbble == 0 && !get_option( 'dribbble_count') ) {
					$dribbble = 0;
				}

				return $dribbble;
			}
		}
		/**
		 * Returns the login form
		 *
		 * @param string $redirect
		 *
		 * @return string
		 */
		public static function dfd_login_form($redirect) {
			$args = array(
				'redirect' => $redirect, //Your url here
				'form_id' => 'loginform-custom',
				'label_username' => '',
				'label_password' => '',
			);

			echo '<h3 class="login_form_title">'.esc_html__('Sign in', 'dfd-native').'</h3>';

			if (class_exists('dfd_login_widget')) {
				$args = array(
					'label_log_in' => esc_html__('Sign in', 'dfd-native'),
					'label_lost_password' => esc_html__('Forgot password', 'dfd-native').'?',
				);

				$dfd_login_widget = new dfd_login_widget();

				$dfd_login_widget->wp_login_form($args);
			} else {
				wp_login_form($args);
			}
		}
		/**
		 * Returns social icons html
		 *
		 * @param bool $only_show_in_header
		 *
		 * @return string
		 */
		public static function dfd_social_networks($only_show_in_header = false){
			global $dfd_native;
			$social_networks = array(
				"de"=>"Devianart",
				"dg"=>"Digg",
				"dr"=>"Dribbble",
				"db"=>"Dropbox",
				"en"=>"Evernote",
				"fb"=>"Facebook",
				"flk"=>"Flickr",
				"gp"=>"Google +",
				"in"=>"Instagram",
				"lf"=>"Last FM",
				"li"=>"LinkedIN",
				"pi"=>"Picasa",
				"pt"=>"Pinterest",
				"rss"=>"RSS",
				"tu"=>"Tumblr",
				"tw"=>"Twitter",
				"vi"=>"Vimeo",
				"wp"=>"WordPress",
				"yt"=>"YouTube",
				"500px"=>"500px",
				"vb"=>"Viewbug",
				"xn"=>"Xing",
				"sp"=>"Spotify",
				"hz"=>"Houzz",
				"sk"=>"Skype",
				"ss"=>"Slideshare",
				"bd"=>"Bandcamp",
				"sd"=>"Soundcloud",
				"mk"=>"Meerkat",
				"ps"=>"Periscope",
				"sc"=>"Snapchat",
				"tc"=>"Thechurch",
				"bh"=>"Behance",
				"pp"=>"Pinpoint",
				"vd"=>"Viadeo",
				"ta"=>"Tripadvisor",
				"vk"=>"VKontakte",
				"ok"=>"Odnoklassniki",
			);
			$social_icons = array(
				"de" => "dfd-socicon-deviantart",
				"dg" => "dfd-socicon-digg",
				"dr" => "dfd-socicon-dribbble",
				"db" => "dfd-socicon-dropbox",
				"en" => "dfd-socicon-evernote",
				"fb" => "dfd-socicon-facebook",
				"flk" => "dfd-socicon-flickr",
				"gp" => "dfd-socicon-google",
				"in" => "dfd-socicon-instagram",
				"lf" => "dfd-socicon-lastfm",
				"li" => "dfd-socicon-linkedin",
				"pi" => "dfd-socicon-picasa",
				"pt" => "dfd-socicon-pinterest",
				"rss" => "dfd-socicon-rss",
				"tu" => "dfd-socicon-tumblr",
				"tw" => "dfd-socicon-twitter",
				"vi" => "dfd-socicon-vimeo",
				"wp" => "dfd-socicon-wordpress",
				"yt" => "dfd-socicon-youtube",
				"500px" => "dfd-socicon-px-icon",
				"vb" => "dfd-socicon-vb",
				"xn" => "dfd-socicon-b_Xing-icon_bl",
				"sp" => "dfd-socicon-spotify",
				"hz" => "dfd-socicon-houzz-dark-icon",
				"sk" => "dfd-socicon-skype",
				"ss" => "dfd-socicon-slideshare",
				"bd" => "dfd-socicon-bandcamp-logo",
				"sd" => "dfd-socicon-soundcloud",
				"mk" => "dfd-socicon-Meerkat-color",
				"ps" => "dfd-socicon-periscope",
				"sc" => "dfd-socicon-snapchat",
				"tc" => "dfd-socicon-the-city",
				"bh" => "dfd-socicon-behance",
				"pp" => "dfd-socicon-pinpoint",
				"vd" => "dfd-socicon-viadeo",
				"ta" => "dfd-socicon-tripadvisor",
				"vk" => "dfd-socicon-vkontakte",
				"ok" => "dfd-socicon-ok",
			);

			if ($only_show_in_header){
				foreach($social_networks as $short=>$original) {

					$icon = $social_icons[$short];

					if (isset($dfd_native[$short.'_link']) && $dfd_native[$short.'_link']) {
						$link = $dfd_native[$short.'_link'];
					} else {
						$link = false;
					}
				
					if ( $link && $link!='http://' ) {
						echo '<a href="'.esc_url($link) .'" class="'.esc_attr($short) . ' ' . esc_attr($icon) . '" title="'.esc_attr($original).'" target="_blank"></a>';
					}
				}

			} else {
				foreach($social_networks as $short=>$original){
					if (isset($dfd_native[$short.'_link']) && $dfd_native[$short.'_link']) {
						$link = $dfd_native[$short.'_link'];
					} else {
						$link = false;
					}
					$icon = $social_icons[$short];
					if( $link  !='' && $link  !='http://' ) {
						echo '<a href="'.esc_url($link) .'" class="'.esc_attr($icon).'" title="'.esc_attr($original).'" target="_blank"></a>';
					}
				}
			}
		}
		/**
		 * Post Like. Social Share
		 * @param integer $post_id Post ID
		 * @return string Post like code
		 */
		public static function getPostLikeLink($post_id=null) {
			if (!$post_id) {
				global $post;

				$post_id = $post->ID;
			}

			$vote_count = intval(get_post_meta($post_id, "_votes_count", true));
			
			$output = '';

			if(self::hasAlreadyVoted($post_id)) {
				$output .= '<span class="post-like"><i class="dfd-socicon-icon-ios7-heart"></i>'
								.'<span title="'.esc_html__('I like this article', 'dfd-native').'" class="like alreadyvoted">'
								.'<span class="count">'.esc_html($vote_count) .'</span>&nbsp;'
								.'<span class="dfd-meta-hide">'.esc_html__('Likes','dfd-native').'</span>'
							.'</span></span>';
			} else {
				$output .=	'<a class="post-like" href="#" data-post_id="'.esc_attr($post_id).'">'
								.'<i class="dfd-socicon-icon-ios7-heart"></i>'
								.'<span class="count">'.esc_html($vote_count) .'</span>&nbsp;'
								.'<span class="dfd-meta-hide">'.esc_html__('Likes','dfd-native').'</span>'
							.'</a>';
			}

			return $output;
		}
		/**
		 * Check if user already voted
		 * @param integer $post_id Post ID
		 * 
		 */
		public static function hasAlreadyVoted($post_id) {
			$timebeforerevote = 60*60;

			// Retrieve post votes IPs
			$meta_IP = get_post_meta($post_id, "_voted_IP");
			$voted_IP = (isset($meta_IP[0])) ? $meta_IP[0] : '';

			if(!is_array($voted_IP)) {
				$voted_IP = array();
			}

			// Retrieve current user IP
			$ip = $_SERVER['REMOTE_ADDR'];

			// If user has already voted
			if(in_array($ip, array_keys($voted_IP))) {
				$time = $voted_IP[$ip];
				$now = time();

				// Compare between current time and vote time
				if(round(($now - $time) / 60) > $timebeforerevote) {
					return false;
				}

				return true;
			}

			return false;
		}
		/**
		 * Check if user already voted
		 * @param integer $post_id Post ID
		 * 
		 */
		public static function author_contact_methods() {
			$contactmethods = array();
			$contactmethods['dfd_author_info'] = 'Author Info';
			$contactmethods['twitter'] = 'Twitter';
			$contactmethods['googleplus'] = 'Google Plus';
			$contactmethods['linkedin'] = 'Linked In';
			$contactmethods['youtube'] = 'YouTube';
			$contactmethods['vimeo'] = 'Vimeo';
			$contactmethods['lastfm'] = 'LastFM';
			$contactmethods['tumblr'] = 'Tumblr';
			$contactmethods['skype'] = 'Skype';
			$contactmethods['cr_facebook'] = 'Facebook';
			$contactmethods['deviantart'] = 'Deviantart';
			$contactmethods['vkontakte'] = 'Vkontakte';
			$contactmethods['picasa'] = 'Picasa';
			$contactmethods['pinterest'] = 'Pinterest';
			$contactmethods['wordpress'] = 'WordPress';
			$contactmethods['instagram'] = 'Instagram';
			$contactmethods['dropbox'] = 'Dropbox';
			$contactmethods['rss'] = 'RSS';

			return $contactmethods;
		}
		/*
		 * Pagination links
		 */
		public static function dfd_link_pages() {
			wp_link_pages(array(
				'before'			=> '<div class="dfd-single-inside-paginated-wrap"><nav class="dfd-single-nav-links">',
				'after'				=> '</nav></div>',
				'link_before'      => '<span>',
				'link_after'       => '</span>',
			));
		}
		
		/**
		 * Runs the WP_Filesystem get_contents method
		 * 
		 * @param string $url Name of the file to read.
		 * @return string|bool The function returns the read data or false on failure.
		 */
		public static function fileGetContents($url, $use_include_path = false, $context = '') {
			global $wp_filesystem;
			
			$data = '';
			
			if (empty($wp_filesystem)) {
				require_once (ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			if(
				!empty($wp_filesystem) && !(is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code())
				||
				(isset($context) && !empty($context))
			) {
				$data = $wp_filesystem->get_contents($url);
			}
			
			return $data;
		}
		public static function wp_filesystemInclude() {
			global $wp_filesystem;

			if (empty($wp_filesystem)) {
				require_once (ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			if (
					   !empty($wp_filesystem) && !(is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code())
			) {
				return true;
			}
			return false;
		}

		/**
		 * Runs the WP_Filesystem get_contents method
		 * 
		 * @param string $file     Remote path to the file where to write the data.
		 * @param string $contents The data to write.
		 * @param int    $mode     Optional. The file permissions as octal number, usually 0644.
		 * @return bool False upon failure, true otherwise.
		 */
		public static function filePutContents($file, $contents, $mode = false) {
			global $wp_filesystem;
			
			$data = '';
			
			if (empty($wp_filesystem)) {
				require_once (ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			if( !empty($wp_filesystem) && !(is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()) ) {
				$data = $wp_filesystem->put_contents(
						$file,
						$contents,
						$mode
					);
			}
			
			return $data;
		}
		
		/**
		 * Changes filesystem permissions
		 *
		 * @access public
		 *
		 * @param string $file      Path to the file.
		 * @param int    $mode      Optional. The permissions as octal number, usually 0644 for files,
		 *                          0755 for dirs. Default false.
		 * @param bool   $recursive Optional. If set True changes file group recursively. Default false.
		 * @return bool Returns true on success or false on failure.
		 */
		public static function chmod($file, $mode = false, $recursive = false) {
			global $wp_filesystem;
			
			$data = '';
			
			if (empty($wp_filesystem)) {
				require_once (ABSPATH . '/wp-admin/includes/file.php');
				WP_Filesystem();
			}
			if( !empty($wp_filesystem) && !(is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()) ) {
				$data = $wp_filesystem->chmod($file, $mode, $recursive);
			}
			
			return $data;
		}
		
		/*
		 * Custom post types edit
		 * 
		 * @param string $tax
		 * @param string $type
		 * @param string $name
		 * 
		 * @return bool Returns true on success or false on failure.
		 */
		public static function custom_post_types($tax, $type, $args = array(), $name = 'shortcode') {
			$callback = 'register_'.$name;
			if(false !== $tax) {
				return $callback($tax, $type, $args);
			} else {
				return $callback($type, $args);
			}
		}
		/**
		 * Check is Header Plugin exist
		 * @return boolean
		 */
		public static function isHeaderBuilderPluginActive() {
			global $dfd_native;
			if(isset($dfd_native["is_header_builder_enabled"]) && $dfd_native["is_header_builder_enabled"]=="on"){
				return true;
			}
			return false;
//			$reseult = false;
//			if(is_plugin_active("dfd-header-builder/dfd_header_builder.php")){
//				$reseult = true;
//			}
//			return true;
		}
	}
}

if (!class_exists('Dfd_Theme_Slier_Helper')) {
	/**
	 * Carousel builder helper
	 *
	 *
	 * @class 		Dfd_Theme_Slier_Helper
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class Dfd_Theme_Slier_Helper {
		
		/**
		 *Generates carousel arrow navigation style option
		 *
		 * @param type $name id needed icon
		 *
 		 * @return array Array width two elements {left} and {right}
		 */
		public static function getIcon($name) {
			$arrows_icon_config = array(
					"arrow_style_1"=>array(
							"left"=>"dfd-socicon-arrow-left-01",
							"right"=>"dfd-socicon-arrow-right-01",
					),
					"arrow_style_2"=>array(
							"left"=>"dfd-socicon-arrow-left",
							"right"=>"dfd-socicon-arrow-right",
					),
					"arrow_style_3"=>array(
							"left"=>"dfd-socicon-arrow-pointing-to-left",
							"right"=>"dfd-socicon-arrow-pointing-to-right",
					),
					"arrow_style_4"=>array(
							"left"=>"dfd-socicon-left-arrow",
							"right"=>"dfd-socicon-arrowhead-pointing-to-the-right",
					),
					"arrow_style_5"=>array(
							"left"=>"dfd-socicon-angle-pointing-to-left",
							"right"=>"dfd-socicon-angle-arrow-pointing-to-right",
					),
			);
			if(array_key_exists($name, $arrows_icon_config)){
				return $arrows_icon_config[$name];
			}
			///default icon
			return array(
				"left"=>"dfd-socicon-arrow-left-01",
				"right"=>"dfd-socicon-arrow-right-01",
			);
		}
		/**
		 * css parser for carousel in VC shortcodes
		 *
		 * @param type $atts
		 *
 		 * @return array Array
		 */
		public static function parse(&$atts){
			
			$style_icon = $style_hover_icon = $style_bg = $padding_top =  $style_navigation = $style_hover_bg = "";
			$kx = 3;
			$pading_kx =0.8;
			
			$options = array(
				"arrow_icon"=>'',
				"arrow_use_shadow_on_hover"=>'',
				"arrow_icon_color"=>'',
				"arrow_icon_hover_color"=>'',
				"arrow_icon_size"=>'',
				"arrow_bg_border_radius"=>'',
				"arrow_bg_border_width"=>'1',
				"arrow_bg_color"=>'',
				"arrow_hover_bg_color"=>'',
				"arrow_bg_border_color"=>'',
				"arrow_use_navigation"=>'show',
				"arrow_navigation_text_color"=>'',
				"arrow_hover_bg_border_color"=>'',
			);
			extract( shortcode_atts( $options, $atts ) );
			
			if(!empty($arrow_icon_color)){
				$style_icon.="color:".esc_attr($arrow_icon_color).";";
			}
			if(!empty($arrow_icon_size)){
				$style_icon.="font-size:".(int)$arrow_icon_size."px;";
				$style_bg.="width:".((int)$arrow_icon_size*$kx)."px;";
				$style_bg.="height:".((int)$arrow_icon_size*$kx)."px;";
				$padding_top.=$arrow_use_navigation=="show" ? "padding-top:".((int)$arrow_icon_size/$pading_kx)."px;" : "padding-top:25px;";
			}else{
				$padding_top.=$arrow_use_navigation=="show" ? "padding-top:".(12/$pading_kx)."px;" : "";
			}
			if(!empty($arrow_icon_hover_color)){
				$style_hover_icon.="color:".esc_attr($arrow_icon_hover_color)." !important;";
			}
			if(!empty($arrow_bg_border_radius)){
				$style_bg.="border-radius:".esc_attr($arrow_bg_border_radius)."px;";
			}
			$set_border = false;
			if(!empty($arrow_bg_border_width)){
				$set_border = true;
				$style_bg.="border-style:solid;";
				$style_bg.="border-width:".esc_attr($arrow_bg_border_width)."px;";
			}
			if(!empty($arrow_bg_color)){
				
				$style_bg.="background-color:".esc_attr($arrow_bg_color).";";
			}
			if(!empty($arrow_bg_border_color)){
				$style_bg.="border-style:solid;";
				$style_bg.=!$set_border ? "border-width:1px;" : "";
				$style_bg.="border-color:".esc_attr($arrow_bg_border_color).";";
			}
			if(!empty($arrow_hover_bg_color)){
				$style_hover_bg.="background-color:".esc_attr($arrow_hover_bg_color)." !important;";
			}
			if(!empty($arrow_hover_bg_border_color)){
				$style_bg.="border-style:solid";
				$style_hover_bg.=!$set_border ? "border-width:1px;" : "";
				$style_hover_bg.="border-color:".esc_attr($arrow_hover_bg_border_color)." !important;";
			}
			if($arrow_use_shadow_on_hover=="show"){
				$style_hover_bg .= "box-shadow: 7.5px 12.99px 30px 0px rgba(34, 35, 40, 0.137);";
			}
			if($arrow_use_navigation!="show"){
				$style_navigation .= "display:none;";
			}
			if($arrow_navigation_text_color){
				$style_navigation.="color:".esc_attr($arrow_navigation_text_color).";";
			}
			
			$arrow_icon = self::getIcon($arrow_icon);
			
			$result = array(
				"style-icon"=>$style_icon,
				"style-hover-icon"=>$style_hover_icon,
				"style-bg"=>$style_bg,
				"style-hover-bg"=>$style_hover_bg,
				"style-navigation"=>$style_navigation,
				"padding_top"=>$padding_top,
				"icon"=>$arrow_icon,
				"icon_left"=>$arrow_icon["left"],
				"icon_right"=>$arrow_icon["right"],
				"arrow_icon_color"=>$arrow_icon_color,
				"arrow_icon_hover_color"=>$arrow_icon_hover_color,
				"arrow_icon_size"=>$arrow_icon_size,
				"arrow_bg_border_radius"=>$arrow_bg_border_radius,
				"arrow_bg_border_width"=>$arrow_bg_border_width,
				"arrow_bg_color"=>$arrow_bg_color,
				"arrow_hover_bg_color"=>$arrow_hover_bg_color,
				"arrow_bg_border_color"=>$arrow_bg_border_color,
				"arrow_hover_bg_border_color"=>$arrow_hover_bg_border_color,
			);
			return $result;
		}
		/**
		 * Backend params parser for carousel in VC shortcodes
		 *
		 * @param array $dependency
		 *
 		 * @return array Array
		 */
		public static function build_paarms($dependency=array(), $path="") {
			if(empty($path)) {
				$path = get_template_directory_uri() .'/';
			}
			$module_images = $path . 'vc_custom/admin/img/carousel/arrows_icons/';
			$dep = array(
					'element' => isset($dependency["element"]) ? $dependency["element"] : "",
					'value' => isset($dependency["value"]) ? $dependency["value"] : "",
				);
			if(empty($dependency)){
				$dep = array();
			} 
			return array (
					array (
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the arrow icon for the navigation','dfd-native').'</span></span>'.esc_html__('Arrow Icon', 'dfd-native'),
						'description' => '',
						'type' => 'radio_image_select',
						'param_name' => 'arrow_icon',
						'simple_mode' => false,
						'value'=>'arrow_style_1',
						'options' => array (
							'arrow_style_1' => array (
								'tooltip' => esc_attr__('Style 1', 'dfd-native'),
								'src' => $module_images . 'Arrows_01.png'
							),
							'arrow_style_2' => array (
								'tooltip' => esc_attr__('Style 2', 'dfd-native'),
								'src' => $module_images . 'Arrows_02.png'
							),
							'arrow_style_3' => array (
								'tooltip' => esc_attr__('Style 3', 'dfd-native'),
								'src' => $module_images . 'Arrows_03.png'
							),
							'arrow_style_4' => array (
								'tooltip' => esc_attr__('Style 4', 'dfd-native'),
								'src' => $module_images . 'Arrows_04.png'
							),
							'arrow_style_5' => array (
								'tooltip' => esc_attr__('Style 5', 'dfd-native'),
								'src' => $module_images . 'Arrows_05.png'
							),
						),
						'dependency' =>$dep,
						'edit_field_class' => 'no-border-bottom vc_column vc_col-sm-12',
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'dfd_heading_param',
						'text' => esc_html__('Arrow Icon Style', 'dfd-native'),
						'param_name' => 'arrow_thumb_t_heading',
						'class' => 'ult-param-heading',
						'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose icon color. The default color is #343434','dfd-native').'</span></span>'.esc_html__('Icon color', 'dfd-native'),
						'param_name' => 'arrow_icon_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc ',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose icon hover color. The default color is #9a9a9a','dfd-native').'</span></span>'.esc_html__('Icon hover color', 'dfd-native'),
						'param_name' => 'arrow_icon_hover_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the size of the icon. The default font size is 10','dfd-native').'</span></span>'.esc_html__('Icon size', 'dfd-native'),
						'param_name' => 'arrow_icon_size',
						'edit_field_class' => 'no-border-bottom vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'dfd_heading_param',
						'text' => esc_html__('Arrow Background Style', 'dfd-native'),
						'param_name' => 'arrow_thumb_t_heading',
						'class' => 'ult-param-heading',
						'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set border radius for the icon\'s background','dfd-native').'</span></span>'.esc_html__('Background border radius', 'dfd-native'),
						'param_name' => 'arrow_bg_border_radius',
						'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'number',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set border width for the icon\'s background','dfd-native').'</span></span>'.esc_html__('Background border width', 'dfd-native'),
						'param_name' => 'arrow_bg_border_width',
						'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the icon\'s background color','dfd-native').'</span></span>'.esc_html__('Background color', 'dfd-native'),
						'param_name' => 'arrow_bg_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the icon\'s hover background color','dfd-native').'</span></span>'.esc_html__('Hover background color', 'dfd-native'),
						'param_name' => 'arrow_hover_bg_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the border color','dfd-native').'</span></span>'.esc_html__('Border color', 'dfd-native'),
						'param_name' => 'arrow_bg_border_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the hover border color','dfd-native').'</span></span>'.esc_html__('Hover  border color', 'dfd-native'),
						'param_name' => 'arrow_hover_bg_border_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array(
						'type' => 'dfd_single_checkbox',
						'param_name' => 'arrow_use_shadow_on_hover',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show the shadow for the arrow','dfd-native').'</span></span>'.esc_html__('Shadow on hover', 'dfd-native'),
						'value' => array(esc_html__('Yes', 'dfd-native') => ''),
						'options' => array(
							'show' => array(
								'on' => esc_html__('Yes', 'dfd-native'),
								'off' => esc_html__('No', 'dfd-native'),
							),
						),
						'dependency' =>$dep,
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array(
						'type' => 'dfd_single_checkbox',
						'param_name' => 'arrow_use_navigation',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show navigation numbers above the arrows','dfd-native').'</span></span>'.esc_html__('Navigation Numbers', 'dfd-native'),
						'value' => array(esc_html__('Yes', 'dfd-native') => 'show'),
						'dependency' =>$dep,
						'options' => array(
							'show' => array(
								'on' => esc_html__('Yes', 'dfd-native'),
								'off' => esc_html__('No', 'dfd-native'),
							),
						),
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
					array (
						'type' => 'colorpicker',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the numbers. The default color is #c3c3c3','dfd-native').'</span></span>'.esc_html__('Numbers color', 'dfd-native'),
						'param_name' => 'arrow_navigation_text_color',
						'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
						'dependency' => array(
							'element' => 'arrow_use_navigation',
							'value' => 'show',
						),
						'group' => esc_html__('Navigation Style', 'dfd-native'),
					),
			);
		}
	}
}

/* Shortcode wrapper, added for VC nested shortcodes and maybe for somethng else in the future :) */
if(!class_exists('Dfd_Wrap_Shortcode')) {
	/**
	 * Shortcode wrapper for nested shortcodes
	 *
	 *
	 * @class 		Dfd_Wrap_Shortcode
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class Dfd_Wrap_Shortcode {
		
		/** @var array Shortcodes list. */
		public static $_shortcode_tags;
		
		/**
		 * Overwrite shortcode
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public static function dfd_override_shortcodes($disabled_tags = array()) {
			global $shortcode_tags;

			self::$_shortcode_tags = $shortcode_tags;

			foreach ( $shortcode_tags as $tag => $cb ) {
				if ( in_array( $tag, $disabled_tags ) ) {
					continue;
				}

				$shortcode_tags[ $tag ] = 'dfd_wrap_shortcode_in_div';
			}
		}
		
		/**
		 * Restore shortcode
		 *
		 *
		 * @since 1.0
		 * @access public
		 */
		public static function dfd_restore_shortcodes() {
			global $shortcode_tags;

			if ( isset( self::$_shortcode_tags ) ) {
				$shortcode_tags = self::$_shortcode_tags;
			}
		}
	}
		
	if(!function_exists('dfd_wrap_shortcode_in_div')) {
		/**
		 * Shortcodes wrapper
		 *
		 */
		function dfd_wrap_shortcode_in_div( $attr, $content = null, $tag ) {
			$_shortcode_tags = Dfd_Wrap_Shortcode::$_shortcode_tags;

			return '<div class="dfd-item-wrap"><div class="cover">' . call_user_func( $_shortcode_tags[ $tag ], $attr, $content, $tag ) . '</div></div>';
		}
	}
}

if (!class_exists("dfd_hide_unsuport_module_frontend")) {
	/**
	 * Hides unsupported nested shortcodes on frontend editor
	 *
	 *
	 * @class 		dfd_hide_unsuport_module_frontend
	 * @version		1.0
	 * @category	Class
	 * @author 		DFD
	 */
	class dfd_hide_unsuport_module_frontend {

		/** @var string Shortcode name. */
		private $name;

		/**
		 * 
		 * @param string $name css class to hide element
		 */
		function __construct($name) {
			if (vc_is_inline()) {
				$this->name = $name;
				add_action("admin_enqueue_scripts", array ($this, "addScript"));
			}
		}

		public function addScript() {
			echo '<style type="text/css">
					
						.' . $this->name . '_o{
							display:none !important;
						}
				</style>';
		}

	}

}

if(!function_exists('dfd_show_unsuport_nested_module_frontend')) {
	/**
	 * 
	 * @param string $name Name of shortcode
	 */
	function dfd_show_unsuport_nested_module_frontend($name=""){
		if(vc_is_inline()){
			$text = sprintf(esc_html__("Module %s is not supported by frontend editor",'dfd-native'), $name);
			echo "<div class='dfd_unsuport_frontend_module'><div class='cell'>".$text."</div></div>";
			return true;
		}else{
			return false;
		}

	}
}