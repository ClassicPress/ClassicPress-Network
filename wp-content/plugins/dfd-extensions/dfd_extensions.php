<?php
/*
Plugin Name: DFD Theme Extensions
Plugin URI: http://nativewptheme.net
Description: DFD theme extensions plugin. Contains DFD custom shortcodes for Visual Composer, custom post types and custom shortcodes
Version: 1.3.8
Author: DFD
Author URI: http://dfd.name
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('DFD_EXTENSIONS_PLUGIN_URL',plugins_url().'/dfd-extensions/');
define('DFD_EXTENSIONS_PLUGIN_PATH',plugin_dir_path(__FILE__));

class Dfd_Theme_extensions {
	/**
	 * Core singleton class
	 * @var self - pattern realization
	 */
	private static $_instance;
	
	/**
	 * Get the instane of Dfd_Theme_extensions
	 *
	 * @return self
	 */
	public static function getInstance() {
		if ( ! ( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		$theme = wp_get_theme()->get( 'Name' );
		if(substr_count($theme, 'DFD Native') > 0) {
			$this->addTwitter();
			$this->extensionsLoader();
			$this->loadRedux();
			$this->addActions();
			$this->addShortcodes();
			add_action('plugins_loaded', array($this, 'pluginsLoaded',), 10);
			add_action('init', array($this, 'init',), 10);
			add_action('after_setup_theme', array($this, 'addVcCustomElements'));
			register_activation_hook( __FILE__, array($this,'activationHook',) );
		} else {
			add_action('admin_notices', array($this, '_admin_notice__error'));
		}
	}
	
	/**
	 * Cloning disabled
	 */
	public function __clone() {
	}

	/**
	 * Serialization disabled
	 */
	public function __sleep() {
	}

	/**
	 * De-serialization disabled
	 */
	public function __wakeup() {
	}
	
	/**
	 * Callback function WP plugin_loaded action hook. Loads locale
	 *
	 * @access public
	 */
	public function pluginsLoaded() {
		// Setup locale
		do_action( 'dfd_plugins_loaded' );
//		load_plugin_textdomain( 'dfd-extensions', false, DFD_EXTENSIONS_PLUGIN_PATH.'lang/' );
	}
	
	/**
	 * Enables to add hooks in activation process.
	 *
	 */
	public function activationHook(  ) {
		do_action( 'dfd_activation_hook' );
	}
	
	/**
	 * Callback function for WP init action hook. Loads required objects.
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function init() {
		
	}
	
	/*
	 * Register custom post types and taxonomies
	 */
	public function addTwitter() {
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'inc/twitteroauth.php');
	}
	
	/*
	 * Register custom post types and taxonomies
	 */
	public function addActions() {
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'inc/actions.php');
	}
	
	/*
	 * Register custom post types and taxonomies
	 */
	public function addPostTypes() {
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'post_types/post-type.php');
	}
	
	/*
	 * Add custom tiny mce shortcodes
	 */
	public function addShortcodes() {
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'shortcodes/tooltip-shortcode.php');
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'shortcodes/tinymce-shortcodes.php');
	}
	
	/*
	 * Add custom VC elements
	 */
	public function addVcCustomElements() {
		$this->addPostTypes();
		if ( class_exists( 'Vc_Manager', false ) ) {
			require_once(DFD_EXTENSIONS_PLUGIN_PATH.'vc_custom/dfd_vc_addons.php');
		}
	}
	
	/*
	 * Add Redux extensions
	 */
	public function extensionsLoader() {
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'redux_extensions/extensions_loader.php');
	}
	
	/*
	 * Load Redux Core
	 */
	public function loadRedux() {
		require_once(DFD_EXTENSIONS_PLUGIN_PATH.'redux_framework/ReduxCore/framework.php');
	}
	
	/*
	 * Admin notice text
	 */
	public function _admin_notice__error() {
		echo '<div class="notice notice-error is-dismissible">';
			echo '<p>'. esc_html__( 'DFD Theme Extensions is enabled but not effective. It requires DFD Native theme in order to work.', 'dfd-native' ) .'</p>';
		echo '</div>';
	}
}

$Dfd_Theme_extensions = new Dfd_Theme_extensions();