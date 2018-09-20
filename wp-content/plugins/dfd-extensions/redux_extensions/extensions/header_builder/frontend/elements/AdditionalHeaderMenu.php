<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilder_AdditionalHeaderMenu extends DfdHeaderBuilderElementAbstract {

	protected $template = "additional_header_menu";
	protected $menu = "";

	public function __construct() {
		ob_start();
		wp_nav_menu(array (
				'theme_location' => 'additional_header_menu',
				'depth' => 1,
				'fallback_cb' => 'false',
				'menu_class' => 'dfd-additional-header-menu dfd-header-links',
				'walker' => new crum_clean_walker()
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
		echo $this->menu;
	}

}
