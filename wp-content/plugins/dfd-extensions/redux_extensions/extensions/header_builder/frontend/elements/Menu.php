<?php
if (!defined('ABSPATH'))
	exit;
class DfdHeaderBuilder_Menu extends DfdHeaderBuilderElementAbstract {

	protected $option_name = "header_login";
	protected $template = "main_menu";
	protected $menu = "";

	public function __construct() {
		ob_start();
		wp_nav_menu(array (
				'theme_location' => 'primary_navigation',
				'menu_class' => 'nav-menu menu-primary-navigation menu-clonable-for-mobiles main_menu',
				'fallback_cb' => 'top_menu_fallback',
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
		global $dfd_native;

		if (isset($dfd_native['menu_alignment']) && !empty($dfd_native['menu_alignment'])) {
			$menu_class = ' ' . $dfd_native['menu_alignment'];
		} else {
			$menu_class = ' text-right';
		}
		echo '<nav class="mega-menu ' . esc_attr($menu_class) . '" id="main_mega_menu">';
		echo $this->menu;
		echo '</nav>';
	}

}
