<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilder_SecondMenu extends DfdHeaderBuilderElementAbstract {

	protected $template = "right_top_menu";
	protected $menu = "";

	public function __construct() {
		ob_start();
		wp_nav_menu(array (
				'theme_location' => 'second_builder_navigation',
				'menu_class' => 'nav-menu menu-top-right-navigation menu-clonable-for-mobiles dfd-header-responsive-hide second_menu',
				'fallback_cb' => 'top_menu_fallback'
		));
		$this->menu = ob_get_clean();
	}

	/**
	 *
	 * @var DfdHeaderBuilderElementAbstract $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function render() {
		echo '<nav class="mega-menu clearfix" id="top_right_mega_menu">';
		echo $this->menu;
		echo '</nav>';
	}

}
