<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (!function_exists('dfd_kadabra_use_default_gallery_style_filter')) {
	/*
	 * Disable the default gallery styles to enable custom ones
	 */
	function dfd_kadabra_use_default_gallery_style_filter($existing_code) {
		return false; //return $existing_code;
	}
}

add_filter('wp_title', 'dfd_title_filter_function', 10, 2);

if (!function_exists('dfd_title_filter_function')) {
	/**
	 * Page title filtering
	 *
	 * @param array $title
	 *
	 * @return string
	 */
	function dfd_title_filter_function($title) {
		$before_title = get_bloginfo('name');
		$title = $before_title . $title;
		return $title;
	}
}

add_filter( 'login_errors', 'dfd_login_error_filter');

if(!function_exists('dfd_login_error_filter')) {
	/*
	 * Login error filter. Returns the "Invalid username or password" no matter which one was incorrect. The security trick ;)
	 *
	 * @return string
	 */
	function dfd_login_error_filter($error) {
		return '<strong>'.esc_html__('ERROR','dfd-native').':</strong> '.esc_html__('Invalid username or password!', 'dfd-native');
	}
}

add_filter( 'vc_google_fonts_get_fonts_filter', 'dfd_vc_extend_google_fonts' );

if(!function_exists('dfd_vc_extend_google_fonts')) {
	/**
	 * Add Extended Google fonts list to standart Visual composer list of fonts.
	 *
	 * @return array|mixed|object
	 */
	function dfd_vc_extend_google_fonts() {

		$google_fonts = new Vc_Google_Fonts();

		$new_fonts = '"font_family":"Open Sans","font_styles":"300,300italic,regular,italic,600,600italic,700,700italic,800,800italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic"},{"font_family":"Roboto","font_styles":"100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Oswald","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Lato","font_styles":"100,100italic,300,300italic,regular,italic,700,700italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Droid Sans","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"PT Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Source Sans Pro","font_styles":"200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900,900italic","font_types":"200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Roboto Condensed","font_styles":"300,300italic,regular,italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Open Sans Condensed","font_styles":"300,300italic,700","font_types":"300 light regular:300:normal,300 light italic:300:italic,700 bold regular:700:normal"},{"font_family":"Droid Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Ubuntu","font_styles":"300,300italic,regular,italic,500,500italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Raleway","font_styles":"100,200,300,regular,500,600,700,800,900","font_types":"100 light regular:100:normal,200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal,900 bold regular:900:normal"},{"font_family":"Montserrat","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"PT Sans Narrow","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Roboto Slab","font_styles":"100,300,regular,700","font_types":"100 light regular:100:normal,300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Arimo","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Yanone Kaffeesatz","font_styles":"200,300,regular,700","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Lobster","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bitter","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Lora","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Dosis","font_styles":"200,300,regular,500,600,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal"},{"font_family":"Oxygen","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Arvo","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Merriweather","font_styles":"300,300italic,regular,italic,700,700italic,900,900italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Titillium Web","font_styles":"200,200italic,300,300italic,regular,italic,600,600italic,700,700italic,900","font_types":"200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal"},{"font_family":"Noto Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"PT Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Francois One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Indie Flower","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Shadows Into Light","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cabin","font_styles":"regular,italic,500,500italic,600,600italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Fjalla One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Abel","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Play","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Nunito","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Inconsolata","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Playfair Display","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Ubuntu Condensed","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Signika","font_styles":"300,regular,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Libre Baskerville","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Gloria Hallelujah","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Poiret One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Muli","font_styles":"300,300italic,regular,italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic"},{"font_family":"Rokkitt","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Anton","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cuprum","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Varela Round","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Archivo Narrow","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Maven Pro","font_styles":"regular,500,700,900","font_types":"400 regular:400:normal,500 bold regular:500:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Josefin Sans","font_styles":"100,100italic,300,300italic,regular,italic,600,600italic,700,700italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Pacifico","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bree Serif","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Merriweather Sans","font_styles":"300,300italic,regular,italic,700,700italic,800,800italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic"},{"font_family":"Asap","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Vollkorn","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Karla","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Droid Sans Mono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dancing Script","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Quicksand","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Crafty Girls","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Hammersmith One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ubuntu Mono","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"News Cycle","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Cabin Condensed","font_styles":"regular,500,600,700","font_types":"400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Pathway Gothic One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"PT Sans Caption","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Noto Serif","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Exo","font_styles":"100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Alegreya","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Questrial","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Coming Soon","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Quattrocento Sans","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Special Elite","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nobile","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Monda","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Pontano Sans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ropa Sans","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Gudea","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Changa One","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Armata","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Noticia Text","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Istok Web","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Kreon","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Old Standard TT","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Courgette","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Paytone One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Philosopher","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Orbitron","font_styles":"regular,500,700,900","font_types":"400 regular:400:normal,500 bold regular:500:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Bubblegum Sans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rambla","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Crete Round","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Josefin Slab","font_styles":"100,100italic,300,300italic,regular,italic,600,600italic,700,700italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Playball","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chewy","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Exo 2","font_styles":"100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,200 light regular:200:normal,200 light italic:200:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Crimson Text","font_styles":"regular,italic,600,600italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Squada One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Permanent Marker","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Voltaire","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Montserrat Alternates","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Cinzel","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Rock Salt","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sanchez","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Lobster Two","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Bangers","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Patua One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Source Code Pro","font_styles":"200,300,regular,500,600,700,900","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Cantarell","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Luckiest Guy","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Shadows Into Light Two","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lusitana","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Righteous","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Limelight","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Varela","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Passion One","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Audiowide","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Economica","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Amatic SC","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Lemon","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sintony","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Tinos","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Marck Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"BenchNine","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Amaranth","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Architects Daughter","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Black Ops One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fredoka One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Reenie Beanie","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Comfortaa","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"EB Garamond","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Yellowtail","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Carrois Gothic","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Unkempt","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Antic Slab","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Calligraffitti","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Satisfy","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bevan","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Glegoo","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Marvel","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Cardo","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Quattrocento","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Handlee","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Molengo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Vidaloka","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Didact Gothic","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Pinyon Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Niconne","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Waiting for the Sunrise","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Enriqueta","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Sorts Mill Goudy","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Actor","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cherry Cream Soda","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Allerta","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Oleo Script","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Patrick Hand","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Playfair Display SC","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Covered By Your Grace","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Contrail One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gentium Book Basic","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Fugaz One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Coda","font_styles":"regular,800","font_types":"400 regular:400:normal,800 bold regular:800:normal"},{"font_family":"Archivo Black","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alfa Slab One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Carme","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Jockey One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Domine","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Viga","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Tangerine","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Doppio One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Syncopate","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Sansita One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Signika Negative","font_styles":"300,regular,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Kaushan Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Jura","font_styles":"300,regular,500,600","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal"},{"font_family":"Chivo","font_styles":"regular,italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Rancho","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Berkshire Swash","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Candal","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Michroma","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Marmelad","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fauna One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Copse","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kameron","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Goudy Bookletter 1911","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Scada","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Sigmar One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gochi Hand","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Neuton","font_styles":"200,300,regular,italic,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,800 bold regular:800:normal"},{"font_family":"Aldrich","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lily Script One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Walter Turncoat","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"ABeeZee","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Damion","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Just Another Hand","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Square","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Abril Fatface","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Great Vibes","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nixie One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cutive","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Schoolbell","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Electrolize","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Neucha","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Strait","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alegreya Sans","font_styles":"100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,800,800italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Just Me Again Down Here","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Telex","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Belleza","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Russo One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nothing You Could Do","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bad Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Spinnaker","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ruda","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Julius Sans One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Judson","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Rochester","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Tienne","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Aclonica","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Coustard","font_styles":"regular,900","font_types":"400 regular:400:normal,900 bold regular:900:normal"},{"font_family":"Rosario","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Poller One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Allerta Stencil","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Racing Sans One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Prata","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mako","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cantata One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Homemade Apple","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Overlock","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Share","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Gentium Basic","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Volkhov","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"PT Serif Caption","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Duru Sans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sacramento","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Boogaloo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Six Caps","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cookie","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Arapey","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Orienta","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Days One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Radley","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Spirax","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fontdiner Swanky","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Iceland","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Frijole","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Denk One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alegreya Sans SC","font_styles":"100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,800,800italic,900,900italic","font_types":"100 light regular:100:normal,100 light italic:100:italic,300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic,800 bold regular:800:normal,800 bold italic:800:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Inder","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Arbutus Slab","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Advent Pro","font_styles":"100,200,300,regular,500,600,700","font_types":"100 light regular:100:normal,200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Caudex","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Alice","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Puritan","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Tauri","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alex Brush","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Griffy","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alef","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Love Ya Like A Sister","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Trocchi","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Convergence","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fredericka the Great","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"The Girl Next Door","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cabin Sketch","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Merienda One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Homenaje","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Leckerli One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Parisienne","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Anaheim","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Quantico","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Alike","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Crushed","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Slackey","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Average Sans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Petit Formal Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lekton","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Kavoon","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Basic","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gruppo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Give You Glory","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fanwood Text","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Yesteryear","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Metrophobic","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Anonymous Pro","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Cousine","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Ultra","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Tenor Sans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Pompiere","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Adamina","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lustria","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Forum","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kranky","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gafata","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Allura","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Brawler","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Delius","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Magra","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Acme","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell English","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Loved by the King","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chau Philomene One","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Metamorphous","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kotta One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bentham","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Coda Caption","font_styles":"800","font_types":"800 bold regular:800:normal"},{"font_family":"Cinzel Decorative","font_styles":"regular,700,900","font_types":"400 regular:400:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Short Stack","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lilita One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ovo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"La Belle Aurore","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Podkova","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Oranienbaum","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Grand Hotel","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Shanti","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Imprima","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Codystar","font_styles":"300,regular","font_types":"300 light regular:300:normal,400 regular:400:normal"},{"font_family":"Corben","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Allan","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Sancreek","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Headland One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Carrois Gothic SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Andika","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kristi","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Marcellus SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Englebert","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Montez","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Averia Sans Libre","font_styles":"300,300italic,regular,italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Quando","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Wendy One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sue Ellen Francisco","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell DW Pica","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Annie Use Your Telescope","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alegreya SC","font_styles":"regular,italic,700,700italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Prosto One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Carter One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Patrick Hand SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cantora One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Wire One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Capriola","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mountains of Christmas","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Kelly Slab","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Federo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mouse Memoirs","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Salsa","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Over the Rainbow","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Antic","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Andada","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Merienda","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Rammetto One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dawning of a New Day","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Delius Swash Caps","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Megrim","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Stardos Stencil","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Skranji","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Maiden Orange","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"GFS Didot","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Baumans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gilda Display","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Monoton","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"UnifrakturMaguntia","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Tulpen One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Happy Monkey","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Shojumaru","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Yeseva One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Press Start 2P","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Port Lligat Slab","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kite One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"VT323","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bowlby One SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rufina","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Cedarville Cursive","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Poly","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Freckle Face","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Share Tech","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Geo","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Italianno","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Marcellus","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chelsea Market","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Wallpoet","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Expletus Sans","font_styles":"regular,italic,500,500italic,600,600italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,600 bold regular:600:normal,600 bold italic:600:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Revalia","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Oregano","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Graduate","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rationale","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Arizonia","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell English SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Finger Paint","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell DW Pica SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Vibur","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Norican","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Mono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ceviche One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Meddon","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bowlby One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Miltonian Tattoo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Average","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Galindo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sunshiney","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell Double Pica","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Simonetta","font_styles":"regular,italic,900,900italic","font_types":"400 regular:400:normal,400 italic:400:italic,900 bold regular:900:normal,900 bold italic:900:italic"},{"font_family":"Sniglet","font_styles":"regular,800","font_types":"400 regular:400:normal,800 bold regular:800:normal"},{"font_family":"Mate SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Redressed","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"PT Mono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell French Canon","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Vast Shadow","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Clicker Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Voces","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Delius Unicase","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Unna","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Holtwood One SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Hanuman","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Concert One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dorsa","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sofia","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Zeyada","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Round","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Numans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fenix","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sofadi One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Inika","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"UnifrakturCook","font_styles":"700","font_types":"700 bold regular:700:normal"},{"font_family":"Londrina Solid","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mr De Haviland","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell Great Primer SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Quintessential","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell French Canon SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ruslan Display","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cutive Mono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gabriela","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Snippet","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fjord One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"MedievalSharp","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Buda","font_styles":"300","font_types":"300 light regular:300:normal"},{"font_family":"Euphoria Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Henny Penny","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Linden Hill","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"IM Fell Great Primer","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Belgrano","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Amethysta","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Artifika","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Oleo Script Swash Caps","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Julee","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Qwigley","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Swanky and Moo Moo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gravitas One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Donegal One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Unica One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Flamenco","font_styles":"300,regular","font_types":"300 light regular:300:normal,400 regular:400:normal"},{"font_family":"Petrona","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Engagement","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Life Savers","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Knewave","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Balthazar","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Goblin One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Monofett","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mystery Quest","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Habibi","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Irish Grover","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"League Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Overlock SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Astloch","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Aladin","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sail","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Slim","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Paprika","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Junge","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cambo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Oldenburg","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Buenard","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Mate","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Kenia","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bilbo Swash Caps","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Prociono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Geostar Fill","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Alike Angular","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Trade Winds","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dynalight","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"IM Fell Double Pica SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Flat","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Smythe","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bigshot One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ledger","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rouge Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Medula One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Iceberg","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mr Dafoe","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Modern Antiqua","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Cagliostro","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Seaweed Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Khmer","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Jacques Francois","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lancelot","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Oval","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Suwannaphum","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Asset","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Smokum","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Passero One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Esteban","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Amarante","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Creepster","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rye","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Milonga","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Keania One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Geostar","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Port Lligat Sans","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Atomic Age","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Stoke","font_styles":"300,regular","font_types":"300 light regular:300:normal,400 regular:400:normal"},{"font_family":"Federant","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rosarivo","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Aubrey","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Miltonian","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nova Cut","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Offside","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Condiment","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Lovers Quarrel","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Hind","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Cherry Swash","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Trochut","font_styles":"regular,italic,700","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal"},{"font_family":"Supermercado One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ek Mukta","font_styles":"200,300,regular,500,600,700,800","font_types":"200 light regular:200:normal,300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal"},{"font_family":"Stint Ultra Condensed","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Galdeano","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Molle","font_styles":"italic","font_types":"400 italic:400:italic"},{"font_family":"Sonsie One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ruluko","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Raleway Dots","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Text Me One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Caesar Dressing","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Share Tech Mono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chango","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rum Raisin","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fondamento","font_styles":"regular,italic","font_types":"400 regular:400:normal,400 italic:400:italic"},{"font_family":"Bilbo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Monsieur La Doulaise","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Della Respira","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"GFS Neohellenic","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Seymour One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Aguafina Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Pirata One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Miniver","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fira Sans","font_styles":"300,300italic,regular,italic,500,500italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,500 bold regular:500:normal,500 bold italic:500:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Ruthie","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ranchers","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Averia Libre","font_styles":"300,300italic,regular,italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Stint Ultra Expanded","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Titan One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"McLaren","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Jolly Lodger","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Krona One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Snowburst One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Londrina Outline","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Oxygen Mono","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Devonshire","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Montaga","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Montserrat Subrayada","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Ribeye Marrow","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Akronim","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fresca","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nokora","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Trykker","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Jacques Francois Shadow","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Averia Serif Libre","font_styles":"300,300italic,regular,italic,700,700italic","font_types":"300 light regular:300:normal,300 light italic:300:italic,400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Joti One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Original Surfer","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mrs Saint Delafield","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Autour One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Londrina Shadow","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Nosifer","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Asul","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Freehand","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Teko","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Italiana","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Wellfleet","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Marko One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Antic Didone","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kalam","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Elsie Swash Caps","font_styles":"regular,900","font_types":"400 regular:400:normal,900 bold regular:900:normal"},{"font_family":"Piedra","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Germania One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chela One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Eagle Lake","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Gorditas","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Glass Antiqua","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Emblema One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Stalemate","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Spicy Rice","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Romanesco","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dangrek","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Odor Mean Chey","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Croissant One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ewert","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Almendra","font_styles":"regular,italic,700,700italic","font_types":"400 regular:400:normal,400 italic:400:italic,700 bold regular:700:normal,700 bold italic:700:italic"},{"font_family":"Sarina","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kdam Thmor","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Elsie","font_styles":"regular,900","font_types":"400 regular:400:normal,900 bold regular:900:normal"},{"font_family":"Butterfly Kids","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Princess Sofia","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Battambang","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Mrs Sheppards","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Moulpali","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Angkor","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Peralta","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Emilys Candy","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Diplomata","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Kantumruy","font_styles":"300,regular,700","font_types":"300 light regular:300:normal,400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Londrina Sketch","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Herr Von Muellerhoff","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bubbler One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bigelow Rules","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sevillana","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Eater","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Combo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Margarine","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ribeye","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Faster One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Purple Purse","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chicle","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Felipa","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Sirin Stencil","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"New Rocker","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Source Serif Pro","font_styles":"regular,600,700","font_types":"400 regular:400:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Risque","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Mr Bedfort","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Miss Fajardose","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Dr Sugiyama","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Underdog","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Meie Script","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rajdhani","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Macondo Swash Caps","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Vampiro One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Content","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Rubik One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bokor","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fascinate","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Metal Mania","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Moul","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Taprom","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Koulen","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Uncial Antiqua","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Diplomata SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Butcherman","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Averia Gruesa Libre","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Unlock","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Stalinist One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Arbutus","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Ruge Boogie","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Jim Nightshade","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Flavors","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Macondo","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Preahvihear","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fira Mono","font_styles":"regular,700","font_types":"400 regular:400:normal,700 bold regular:700:normal"},{"font_family":"Almendra SC","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Erica One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Metal","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fasthand","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bayon","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Karma","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Vesper Libre","font_styles":"regular,500,700,900","font_types":"400 regular:400:normal,500 bold regular:500:normal,700 bold regular:700:normal,900 bold regular:900:normal"},{"font_family":"Khand","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Siemreap","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Bonbon","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Hanalei","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fascinate Inline","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Fruktur","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Almendra Display","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Chenla","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Hanalei Fill","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Plaster","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Rubik Mono One","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Slabo 27px","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Slabo 13px","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Halant","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Warnes","font_styles":"regular","font_types":"400 regular:400:normal"},{"font_family":"Laila","font_styles":"300,regular,500,600,700","font_types":"300 light regular:300:normal,400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal"},{"font_family":"Sarpanch","font_styles":"regular,500,600,700,800,900","font_types":"400 regular:400:normal,500 bold regular:500:normal,600 bold regular:600:normal,700 bold regular:700:normal,800 bold regular:800:normal,900 bold regular:900:normal"},{"font_family":"Rozha One","font_styles":"regular","font_types":"400 regular:400:normal"}]';

		return json_decode( str_replace( '}]', ',', $google_fonts->fonts_list ) . $new_fonts );

	}
}

add_action('init', 'dfd_start_session');

if(!function_exists('dfd_start_session')) {
	/**
	 * Force session start
	 *
	 * @return true
	 */
	function dfd_start_session() {
		if(session_id() == '' || (function_exists('session_status') && session_status() == PHP_SESSION_NONE)) {
			@session_start();
		}
	}
}

//add_action( 'init', 'dfd_native_add_editor_styles' );

function dfd_native_add_editor_styles() {
	add_editor_style( 'mce-editor-style.css' );
}

add_action('wp_head', 'dfd_feed_link', -2);

if(!function_exists('dfd_feed_link')) {
	/**
	 * Add the RSS feed link in the <head> if there's posts
	 */
	function dfd_feed_link() {
		$count = wp_count_posts('post'); if ($count->publish > 0) {
			echo "\n\t<link rel=\"alternate\" type=\"application/rss+xml\" title=\"". get_bloginfo('name') ." Feed\" href=\"". esc_url(home_url('/')) ."feed/\">\n";
		}
	}
}

add_action('login_head', 'dfd_add_favicon_log_pages');
add_action('admin_head', 'dfd_add_favicon_log_pages');

if ( !function_exists('dfd_add_favicon_log_pages') ) {
	/*
	 * Add favicon on login page & admin page
	 */
	function dfd_add_favicon_log_pages() {
		global $dfd_native;
		if(isset($dfd_native['custom_favicon']['url']) && $dfd_native['custom_favicon']['url']) :
			echo '<link rel="shortcut icon" type="image/png" href="'.esc_url($dfd_native['custom_favicon']['url']).'" />';
		endif;
	}
}

add_filter('login_headerurl','dfd_home_link');

if(!function_exists('dfd_home_link')) {
	/**
	 * Home url
	 */
	function dfd_home_link() {
		return site_url();
	}
}

add_filter('login_headertitle', 'dfd_change_title_on_logo');

if(!function_exists('dfd_change_title_on_logo')) {
	/**
	 * For page title filter
	 */
	function dfd_change_title_on_logo() {
		return get_bloginfo( 'name' );
	}
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'dfd_custom_bbp_breadcrumb');

if(!function_exists('dfd_custom_bbp_breadcrumb')) {
	/**
	 * BBPress breadcrumbs filter
	 */
	function dfd_custom_bbp_breadcrumb() {
		$args['before'] = '<nav id="crumbs"><span>';
		$args['after'] = '</span></nav>';
		$args['sep'] = '<span class="del"></span>';
		$args['pad_sep'] = 0;
		$args['sep_before'] = '</span>';
		$args['sep_after'] = '<span>';
		$args['current_before'] = '';
		$args['current_after'] = '';
		$args['home_text'] = esc_html__('Home', 'dfd-native');

		return $args;
	}
}

add_filter('woocommerce_breadcrumb_defaults', 'dfd_custom_woocommerce_breadcrumb_defaults');

if(!function_exists('dfd_custom_woocommerce_breadcrumb_defaults')) {
	/**
	 * WooCommerce breadcrumbs filter
	 */
	function dfd_custom_woocommerce_breadcrumb_defaults($args=array()) {
		$args['delimiter'] = '<span class="del"></span>';
		$args['wrap_before'] = '<nav id="crumbs">';
		$args['wrap_after'] = '</nav>';
		$args['before'] = '<span>';
		$args['after'] = '</span>';

		return $args;
	}
}

/*
 * Seo additions
 */

add_action( 'wp_head', 'dfd_add_google_plus_meta' );

if(!function_exists('dfd_add_google_plus_meta')) {
	/**
	 * Add Google+ meta tags to header
	 *
	 * @uses	get_the_ID()  Get post ID
	 * @uses	setup_postdata()  setup postdata to get the excerpt
	 * @uses	wp_get_attachment_image_src()  Get thumbnail src
	 * @uses	get_post_thumbnail_id  Get thumbnail ID
	 * @uses	the_title()  Display the post title
	 *
	 * @author c.bavota
	 */
	function dfd_add_google_plus_meta() {

		if( is_single() ) {

			global $post;

			$post_id = get_the_ID();
			setup_postdata( $post );

			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
			?>

			<!-- Google+ meta tags -->
			<meta itemprop="name" content="<?php esc_attr( the_title() ); ?>">
			<meta itemprop="description" content="<?php echo esc_attr( get_the_excerpt() ); ?>">
			<?php echo (empty( $thumbnail ) && isset($thumbnail[0])) ? '' : '<meta itemprop="image" content="' . esc_url( $thumbnail[0] ) . '">' . "\n"; ?>

			<!-- eof Google+ meta tags -->
		<?php

		}

	}
}

if(!function_exists('dfd_search_filter')) {
	/**
	 * Search result filter
	 */
	function dfd_search_filter($query) {
		if (!is_admin() && $query->is_main_query() && $query->is_search) {
			$query->set('post_type', array('post', 'portfolio', 'gallery'));
		}
	}
}

add_action('template_redirect', 'dfd_template_redirect');

if(!function_exists('dfd_template_redirect')) {
	/**
	 * Define some global vars for metabox elements where context is being lost in main query
	 */
	function dfd_template_redirect() {
		global $portfolio_pagination_type, $dfd_pagination_style, $dfd_left_sidebar, $dfd_right_sidebar;
		
		$dfd_left_sidebar = DfdMetaBoxSettings::get('crum_sidebars_sidebar_1');
		$dfd_right_sidebar = DfdMetaBoxSettings::get('crum_sidebars_sidebar_2');
		$portfolio_pagination_type = DfdMetaBoxSettings::get('dfd_pagination_type');
		$dfd_pagination_style = DfdMetaBoxSettings::compared('dfd_pagination_style', '');
		
		$post_type = get_post_type();
		if(is_search() || (is_archive() && in_array($post_type, array('post','portfolio','gallery')))) {
			$portfolio_pagination_type = DfdMetaBoxSettings::compared('dfd_pagination_type', 'default');
		}
	}
}

add_filter('get_search_form', 'dfd_search_form');

if(!function_exists('dfd_search_form')) {
	/* 
	 *  Search form
	 */
	function dfd_search_form($form) {
		ob_start();
		get_template_part('templates/searchform');
		$form = ob_get_clean();

		return $form;
	}
}

add_action('wp_ajax_nopriv_post-like', 'dfd_post_like');
add_action('wp_ajax_post-like', 'dfd_post_like');

if(!function_exists('dfd_post_like')) {
	/* 
	 *  Post like action
	 */
	function dfd_post_like() {
		// Check for nonce security
		$nonce = $_POST['nonce'];

		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Busted!');
		}

		if(isset($_POST['post_like'])) {
			// Retrieve user IP address
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];

			// Get voters'IPs for the current post
			$meta_IP = get_post_meta($post_id, "_voted_IP");
			$voted_IP = (isset($meta_IP[0]))?$meta_IP[0]:false;

			if(!is_array($voted_IP)) {
				$voted_IP = array();
			}

			// Get votes count for the current post
			$meta_count = get_post_meta($post_id, "_votes_count", true);

			// Use has already voted ?
			if(!Dfd_Theme_Helpers::hasAlreadyVoted($post_id)) {
				$voted_IP[$ip] = time();

				// Save IP and increase votes count
				update_post_meta($post_id, "_voted_IP", $voted_IP);
				update_post_meta($post_id, "_votes_count", ++$meta_count);

				// Display count (ie jQuery return value)
				echo esc_html($meta_count);
			} else {
				echo "already";
			}
		}
		exit;
	}
}

if(!function_exists('dfd_kadabra_excerpt_length')) {
	/*
	 * Custom excerpt length
	 */
	function dfd_kadabra_excerpt_length( $length ) {
		return 30;
	}
}

if(!function_exists('dfd_kadabra_posts_link_attributes_1')) {
	/*
	 * post link attribute
	 */
	function dfd_kadabra_posts_link_attributes_1() {
		return 'class="older"';
	}
}

if(!function_exists('dfd_kadabra_posts_link_attributes_2')) {
	/*
	 * post link attribute
	 */
	function dfd_kadabra_posts_link_attributes_2() {
		return 'class="newer"';
	}
}

if(!function_exists('dfd_kadabra_prettyadd')) {
	/*
	 * Add prettyPhoto support
	 */
	function dfd_kadabra_prettyadd ($content) {
		$content = preg_replace("/<a/","<a data-rel=\"prettyPhoto[slides]\"",$content,1);
		return $content;
	}
}

if (!function_exists('post_like_scripts')) {
	/**
	 * Post Like scripts
	 */
	function post_like_scripts() {
		wp_register_script('like_post', get_template_directory_uri().'/assets/js/post-like.js', array('jquery'), null, true );
		wp_localize_script('like_post', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
		wp_enqueue_script('like_post');
	}
}

add_filter( 'wbc_importer_description', 'dfd_wbc_importer_description_text', 10 );

if ( !function_exists( 'dfd_wbc_importer_description_text' ) ) {

	/**
	 * Filter for changing importer description info in options panel
	 * when not setting in Redux config file.
	 *
	 * @param [string] $description description above demos
	 *
	 * @return [string] return.
	 */

	function dfd_wbc_importer_description_text( $description ) {

		$description .= '<p>'. esc_html__( 'Note! In a case of installing any of the layouts, the layout page will be installed only. To get all the demo pages, including, blog, portfolio, etc, select "Home" layout which can be found in the list. The pages such as "About us", "Our team" etc are included in the "Pages" layout.', 'dfd-native' ) .'</p>';
		$description .= '<p>'. esc_html__( 'Images are for demo purpose only.', 'dfd-native' ) .'</p>';
		$description .= '<p>'.esc_html__('Please pay attention that demo installation will install the theme options for the demo you want to install. Please backup all of your customizations before running demo importer.','dfd-native').'</p>';

		return $description;
	}
}

add_action( 'wbc_importer_after_content_import', 'dfd_wbc_extended', 10, 2 );

if ( !function_exists( 'dfd_wbc_extended' ) ) {
	/* 
	 *  WBC demo installer extender
	 */
	function dfd_wbc_extended( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/

		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'01_first'			=> 'creative-freedom.zip',
				'02_second'			=> 'duotone1.zip',
				'13_thirteenth'		=> 'nice-and-clean-header.zip',
				'16_sixteenth'		=> 'main-sixteenth.zip',
				'17_seventeenth'	=> 'hotel.zip',
				'19_ninteenth'		=> 'ninteenth.zip',
				'20_twentieth'		=> 'bakery.zip',
				'22_twenty_second'	=> 'twenty-second.zip',
				'23_twenty_third'	=> 'gym.zip',
				'25_twenty_fifth'	=> 'lawyer.zip',
				'28_shop-first'		=> 'creative-freedom.zip',
				'34_thirty_fourth'	=> 'thirty-fourth.zip',
				'36_thirty_sixth'	=> 'thirty_sixth.zip',
				'37_thirty_seventh'	=> 'thirty_seventh.zip',
				'38_thirty_eighth'	=> 'thirty-eighth.zip',
				'39_thirty_ninth'	=> 'thirty-ninth.zip',
				'40_fortieth'		=> 'building.zip',
				'41_forty_first'	=> 'forty-first.zip',
				'41_shop_second'	=> 'shop-second.zip',
				'rtl_demo'			=> 'lawyer.zip',
			);

			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/

		// If it's demo1 - demo6
		$wbc_menu_array = array(
			'01_first',
			'02_second',
			'03_third',
			'04_fourth',
			'05_fifth',
			'06_sixth',
			'07_seventh',
			'08_eighth',
			'09_ninth',
			'10_tenth',
			'11_eleventh',
			'12_twelfth',
			'13_thirteenth',
			'14_fourteenth',
			'15_fifteenth',
			'16_sixteenth',
			'17_seventeenth',
			'18_eighteenth',
			'19_ninteenth',
			'20_twentieth',
			'21_twenty_first',
			'22_twenty_second',
			'23_twenty_third',
			'24_twenty_fourth',
			'25_twenty_fifth',
			'coming_soon_twenty_sixth',
			'coming_soon_twenty_seventh',
			'coming_soon_twenty_eighth',
			'coming_soon_twenty_ninth',
			'coming_soon_thirtieth',
			'coming_soon_thirty_first',
			'coming_soon_thirty_second',
			'coming_soon_thirty_third',
			'28_shop-first',
			'26_home',
			'27_pages',
			'34_thirty_fourth',
			'35_thirty_fifth',
			'36_thirty_sixth',
			'37_thirty_seventh',
			'38_thirty_eighth',
			'39_thirty_ninth',
			'40_fortieth',
			'41_forty_first',
			'41_shop_second',
			'42_shop_third',
			'rtl_demo',
			'shortcodes',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Primary navigation', 'nav_menu' );

			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'theme-primary' => $top_menu->term_id,
						'theme-footer'  => $top_menu->term_id
					)
				);
			}

		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'01_first'					=> 'First',
			'02_second'					=> 'Second',
			'03_third'					=> 'Third',
			'04_fourth'					=> 'Fourth',
			'05_fifth'					=> 'Fifth',
			'06_sixth'					=> 'Sixth',
			'07_seventh'				=> 'Seventh',
			'08_eighth'					=> 'eighth',
			'09_ninth'					=> 'ninth',
			'10_tenth'					=> 'Tenth',
			'11_eleventh'				=> 'Eleventh',
			'12_twelfth'				=> 'Church',
			'13_thirteenth'				=> 'Thirteenth',
			'14_fourteenth'				=> 'Fourteenth',
			'15_fifteenth'				=> 'Restaurant',
			'16_sixteenth'				=> 'sixteenth',
			'17_seventeenth'			=> 'seventeenth',
			'18_eighteenth'				=> 'eighteenth',
			'19_ninteenth'				=> 'Ninteenth',
			'20_twentieth'				=> 'twentieth',
			'21_twenty_first'			=> 'Twenty first',
			'22_twenty_second'			=> 'Twenty second',
			'23_twenty_third'			=> 'twenty_third',
			'24_twenty_fourth'			=> 'Twenty fourth',
			'25_twenty_fifth'			=> 'twenty-fifth',
			'coming_soon_twenty_sixth'	=> 'Twenty sixth',
			'coming_soon_twenty_seventh'=> 'Twenty seventh',
			'coming_soon_twenty_eighth'	=> 'Twenty eighth',
			'coming_soon_twenty_ninth'	=> 'Twenty ninth',
			'coming_soon_thirtieth'		=> 'Thirtieth',
			'coming_soon_thirty_first'	=> 'Thirty first',
			'coming_soon_thirty_second'	=> 'Thirty second',
			'coming_soon_thirty_third'	=> 'Thirty third',
			'28_shop-first'				=> 'Shop-first',
			'26_home'					=> 'Recently added posts',
			'27_pages'					=> 'About me 1',
			'34_thirty_fourth'			=> 'Thirty fourth',
			'35_thirty_fifth'			=> 'Thirty fifth',
			'36_thirty_sixth'			=> 'Thirty sixth',
			'37_thirty_seventh'			=> 'Thirty seventh',
			'38_thirty_eighth'			=> 'Thirty eighth',
			'39_thirty_ninth'			=> 'Thirty ninth',
			'40_fortieth'				=> 'Building',
			'41_forty_first'			=> 'forty first',
			'41_shop_second'			=> 'Shop second',
			'42_shop_third'				=> 'Shop third',
			'rtl_demo'					=> 'twenty-fifth',
			'shortcodes'				=> 'Portfolio',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
	}
}

add_action('vc_build_admin_page', 'dfd_hide_vc_elements');
add_action('vc_load_shortcode', 'dfd_hide_vc_elements');

if(!function_exists('dfd_hide_vc_elements')) {
	/*
	 * Disables default Visual Composer shortcodes
	 */
	function dfd_hide_vc_elements() {
		global $dfd_native;

		if(function_exists( 'vc_remove_element' ) && !isset($dfd_native['enable_default_modules']) || $dfd_native['enable_default_modules'] != 'on') {
			/* Default modules */
			vc_remove_element('vc_wp_search');
			vc_remove_element('vc_wp_meta');
			vc_remove_element('vc_wp_recentcomments');
			vc_remove_element('vc_wp_calendar');
			vc_remove_element('vc_wp_pages');
			vc_remove_element('vc_wp_tagcloud');
			vc_remove_element('vc_wp_custommenu');
			vc_remove_element('vc_wp_text');
			vc_remove_element('vc_wp_posts');
			vc_remove_element('vc_wp_links');
			vc_remove_element('vc_wp_categories');
			vc_remove_element('vc_wp_archives');
			vc_remove_element('vc_wp_rss');
			vc_remove_element('vc_gallery');
			vc_remove_element('vc_teaser_grid');
			vc_remove_element('vc_button');
			vc_remove_element('vc_cta_button');
			vc_remove_element('vc_posts_grid');
			vc_remove_element('vc_images_carousel');
			vc_remove_element('vc_separator');
			vc_remove_element('vc_text_separator');
			vc_remove_element('vc_message');
			vc_remove_element('vc_facebook');
			vc_remove_element('vc_tweetmeme');
			vc_remove_element('vc_googleplus');
			vc_remove_element('vc_pinterest');
			vc_remove_element('vc_toggle');
			vc_remove_element('vc_posts_slider');
			vc_remove_element('vc_button2');
			vc_remove_element('vc_cta_button2');
			vc_remove_element('vc_gmaps');
			vc_remove_element('vc_flickr');
			vc_remove_element('vc_progress_bar');
			vc_remove_element('vc_pie');
			vc_remove_element('vc_empty_space');
			vc_remove_element('vc_custom_heading');
			vc_remove_element('vc_basic_grid');
			vc_remove_element('vc_media_grid');
			vc_remove_element('vc_masonry_grid');
			vc_remove_element('vc_masonry_media_grid');
			vc_remove_element('vc_icon');
			vc_remove_element('vc_btn');
			vc_remove_element('vc_cta');
			vc_remove_element('vc_line_chart');
			vc_remove_element('vc_round_chart');
			vc_remove_element('vc_single_image');
			vc_remove_element('vc_video');
			vc_remove_element('vc_tta_tabs');
			vc_remove_element('vc_tta_tour');
			vc_remove_element('vc_tta_accordion');
			if ( class_exists('WooCommerce') ) {
				vc_remove_element( 'woocommerce_cart' );
				vc_remove_element( 'woocommerce_checkout' );
				vc_remove_element( 'woocommerce_order_tracking' );
				vc_remove_element( 'woocommerce_my_account' );
				vc_remove_element( 'product' );
				vc_remove_element( 'products' );
				vc_remove_element( 'add_to_cart' );
				vc_remove_element( 'add_to_cart_url' );
				vc_remove_element( 'product_page' );
				vc_remove_element( 'product_categories' );
				vc_remove_element( 'product_attribute' );
				vc_remove_element( 'product_category' );
				vc_remove_element( 'recent_products' );
				vc_remove_element( 'featured_products' );
				vc_remove_element( 'sale_products' );
				vc_remove_element( 'best_selling_products' );
				vc_remove_element( 'top_rated_products' );
			}
		}
	}
}

add_action('switch_theme', 'dfd_generate_dynamic_styles' );
add_action('redux/options/'.DFD_THEME_SETTINGS_NAME.'/saved', 'dfd_generate_dynamic_styles' );

if(!function_exists('dfd_generate_dynamic_styles')) {
	/*
	 * Dynamic styles generator. Writes styles to uploads/redux/options.css file
	 */
	function dfd_generate_dynamic_styles() {
		global $dfd_native;
		
		if(isset($dfd_native['enqueue_styles_file']) && $dfd_native['enqueue_styles_file'] == 'on') {
			/** Save on different directory if on multisite **/
			$aq_uploads_dir = ReduxFramework::$_upload_dir;

			/** Capture CSS output **/
			if(file_exists(get_template_directory().'/inc/styles.php')) {
				ob_start();
				require get_template_directory().'/inc/styles.php';
				$css = ob_get_clean();

				/** Write to options.css file **/
				global $wp_filesystem;
				if (empty($wp_filesystem)) {
					require_once (ABSPATH . '/wp-admin/includes/file.php');
					WP_Filesystem();
				}
				if( !empty($wp_filesystem) && !(is_wp_error($wp_filesystem->errors) && $wp_filesystem->errors->get_error_code()) ) {
					$wp_filesystem->put_contents(
						$aq_uploads_dir . 'options.css',
						$css,
						FS_CHMOD_FILE
					);
				}
			}
		}
	}
}

add_action('redux/'.DFD_THEME_SETTINGS_NAME.'/panel/after', 'dfd_generate_htaccess_expire_headers', 10, 3 );

if(!function_exists('dfd_generate_htaccess_expire_headers')) {
	/*
	 * Add expire headers for file types to .htaccess
	 */
	function dfd_generate_htaccess_expire_headers($new_values, $changed_values) {
		if(isset($changed_values['dfd_htaccess_rewrite'])) {
			$rules = '';
			$path = get_home_path();
			$file = $path.'/.htaccess';

			if($changed_values['dfd_htaccess_rewrite'] == 'off') {
				ob_start();
				get_template_part('templates/admin/htaccess','headers');
				$rules = ob_get_clean();
			}

			if((!file_exists($file) && is_writable($path)) || is_writable($file)) {
				insert_with_markers($file, DFD_THEME_SETTINGS_NAME, $rules);
			}
		}
	}
}

//add_filter('script_loader_tag', 'dfd_add_async_script_attr', 10, 2);

if(!function_exists('dfd_add_async_script_attr')) {
	function dfd_add_async_script_attr($tag, $handle) {
		if ( 'dfd_js_plugins' !== $handle && 'dfd_main' != $handle && 'dfd.onepagescroll' != $handle && 'dfd-multislider' != $handle ) {
			return $tag;
		}
		return str_replace( ' src', ' async="async" src', $tag );
	}
}

if(!defined('ENVATO_HOSTED_SITE') || !ENVATO_HOSTED_SITE) {
	add_action( 'admin_notices', 'dfd_customization_services_notice' );
}

if(!function_exists('dfd_customization_services_notice')) {
	function dfd_customization_services_notice() {
		
		if (get_user_meta(get_current_user_id(), 'customization_dismissed_notice', true)) {
			return;
		}
		
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e( 'Great news! We are offering the customization services now.', 'dfd-native' ); ?></strong></p>
			<p>
				<strong>
					<a href="http://nativewptheme.net/support/" title="<?php esc_attr_e('Support center','dfd-native') ?>" target="_blank"><?php esc_html_e('Support center', 'dfd-native') ?></a>
					&nbsp;|&nbsp;
					<a href="http://dfd.name/services/" title="<?php esc_attr_e('Customization services','dfd-native') ?>" target="_blank"><?php esc_html_e('Customization services', 'dfd-native') ?></a>
					&nbsp;|&nbsp;
					<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'customization-dismiss', 'dismiss_admin_notices' ), 'customization-dismiss-' . get_current_user_id() ) ); ?>" title="<?php esc_attr_e('Dismiss this notice','dfd-native') ?>" target="_parent"><?php esc_html_e('Dismiss this notice', 'dfd-native') ?></a>
				</strong>
			</p>
		</div>
		<?php
	}
}

add_action('admin_head', 'dismissCustomization');
if (!function_exists('dismissCustomization')) {

	function dismissCustomization() {
		if (isset($_GET['customization-dismiss']) && check_admin_referer('customization-dismiss-' . get_current_user_id())) {
			update_user_meta(get_current_user_id(), 'customization_dismissed_notice', 1);
		}
	}

}

add_action('switch_theme', 'update_dismiss_customization');
if (!function_exists('update_dismiss_customization')) {

	function update_dismiss_customization() {
		delete_metadata('user', null, 'customization_dismissed_notice', null, true);
	}

}