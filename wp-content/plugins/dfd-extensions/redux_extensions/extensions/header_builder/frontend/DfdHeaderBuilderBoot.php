<?php
if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilderBoot {

	protected $path;

	function __construct() {
		$this->path = DFD_EXTENSIONS_PLUGIN_PATH . "/redux_extensions/extensions/header_builder/frontend/";
		$this->boot();
		$this->setPresets();
	}

	/**
	 *
	 * @var DfdHeaderBuilderBoot $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function init() {
		$this->LoadFormGenerator();
	}

	public function boot() {

		$templates = array (
				"ElementAbstract",
				"components/Preset/Preset",
				"components/Preset/ViewCollection",
				"components/Preset/DefaultPresets",
				"components/Form/FormGenerator",
				"components/Form/DesktopForm",
				"components/Form/TabletForm",
				"components/Form/MobileForm",
				"components/Css/CssGenerator",
				"elements/AdditionalHeaderMenu",
				"elements/Cart",
				"elements/Button",
				"elements/Delimiter",
				"elements/Login",
				"elements/Logo",
				"elements/LangSel",
				"elements/Menu",
				"elements/SecondMenu",
				"elements/ThirdMenu",
				"elements/MobileMenu",
				"elements/InnerPageButton",
				"elements/InnerPageBg",
				"elements/SearchButton",
				"elements/SearchFormBg",
				"elements/SocialIcon",
				"elements/Spacer",
				"elements/SideArea",
				"elements/SideAreaBg",
				"elements/Text",
				"elements/TopInfo",
				"elements/Telephone",
				"elements/WishList",
		);
		$this->load($templates);
	}

	/**
	 * 
	 * @global WP_Filesystem_Base $wp_filesystem
	 * @param type $templates
	 */
	public function load($templates) {
		require_once(ABSPATH . 'wp-admin/includes/file.php');
//		WP_Filesystem();
//		global $wp_filesystem;
		foreach ($templates as $key => $path) {
			$path = $this->path . $path . ".php";
			if (is_file($path)) {
				require_once $path;
			}
		}
	}

	public function setPresets() {
		global $dfd_native;
		$builder_values = array ();
		if (isset($dfd_native["header_builder"])) {
			$json = $dfd_native["header_builder"];
			if (is_string($json) && $json) {
				$builder_values = json_decode($json);
			}
		}
		DfdHeaderBuilder_PresetCollection::instance()->createFromArray($builder_values);
	}

	public function LoadFormGenerator() {
		$desktop = new DfdHeaderBuilder_Form_Desktop();
		$class = $desktop->build_header_class();
		echo '<div class="header_wrap '.$class.'">';
			echo '<div id="header-container" class="' . $class . '">';
				$desktop->buildMainLayout();
				$tablet = new DfdHeaderBuilder_Form_Tablet();
				$tablet->buildMainLayout();
				$mobile = new DfdHeaderBuilder_Form_Mobile();
				$mobile->buildMainLayout();
			echo "</div>";
		echo "</div>";
		$desktop->buildHiddenelem();
	}

}
