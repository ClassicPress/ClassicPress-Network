<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeaderBuilder_PresetCollection {

	protected $active_preset_id = "";
	protected $active_preset = "";

	function __construct() {
		global $dfd_native;
		$presets = DfdHeaderBuilder_DefaultPresets::instance()->getAll();
		$this->createFromArray($presets);
		
		$assets_folder = get_template_directory_uri() . '/assets/';
		
	}
	public function localizeScripts() {
		global $dfd_native;
		$presets = DfdHeaderBuilder_DefaultPresets::instance()->getAll();
		wp_localize_script("jquery", "dfd_header_b_DefaultPresets", $presets);
		$img = isset($dfd_native["custom_logo_image"]["url"]) ? $dfd_native["custom_logo_image"]["url"] : "";
		$img_retina = isset($dfd_native["custom_retina_logo_image"]["url"]) ? $dfd_native["custom_retina_logo_image"]["url"] : "";

		$settings = array (
				"logo_url" => $img,
				"retina_url" => $img_retina,
		);
		wp_localize_script("jquery", "dfd_header_b_local_settings", $settings);
	}
	private $_presets = array ();

	public function getAll() {
		return $this->_presets;
	}

	public function createFromArray($array) {
		if (is_array($array) && !empty($array)) {
			foreach ($array as $key => $preset_arr) {
				$this->add($preset_arr);
			}
		}
		return $this;
	}

	/**
	 * 
	 * @param stdClass $obj
	 */
	public function add($obj) {
		if (empty($obj)) {
			return false;
		}
		$preset = new DfdHeaderBuilder_Preset($obj);
		array_push($this->_presets, $preset);
	}

	/**
	 * 
	 * @param type $name
	 * @return DfdHeaderBuilder_Preset
	 */
	public function hasId($id) {
		foreach ($this->_presets as $key => $preset) {
			/* @var $preset DfdHeaderBuilder_Preset */
			if ($preset->getId() == $id) {
				return true;
			}
		}
		return false;
	}

	public function setActivepreset($preset_id) {
		$this->active_preset_id = $preset_id;
	}

	/**
	 * 
	 * @return string|\DfdHeaderBuilder_Preset
	 */
	public function getActivePreset() {
		if ($this->active_preset) {
			return $this->active_preset;
		}
		foreach ($this->_presets as $key => $preset) {
			/* @var $preset DfdHeaderBuilder_Preset */
			if ($preset->getId() == $this->active_preset_id) {
				$this->active_preset = $preset;
				return $preset;
			}
		}

		return "";
	}

	/**
	 *
	 * @var DfdHeaderBuilder_PresetCollection $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}

class DfdHeaderBuilder_Preset {

	/**
	 *
	 * @var stdClass 
	 */
	private $obj;
	private $_arr_actives_presets;

	/**
	 * 
	 * @param Array $obj
	 */
	function __construct($obj) {
		$this->obj = $obj;
//		$this->setLastPanel();
	}

	public function getName() {
		return $this->obj->name;
	}

	public function getId() {
		return $this->obj->id;
	}

	public function getPresetValues() {
		return $this->obj->presetValues;
	}

	public function getDesktop() {
		return $this->obj->presetValues->desktop;
	}

	public function getMobile() {
		return $this->obj->presetValues->mobile;
	}

	public function getTablet() {
		return $this->obj->presetValues->tablet;
	}

	public function getAllSetttings() {
		return $this->obj->settings;
	}

	public function getDesktopSettings() {
		return $this->obj->settings->desktop;
	}

	public function getTabletSettings() {
		return $this->obj->settings->tablet;
	}

	public function getMobileSettings() {
		return $this->obj->settings->mobile;
	}

	public function getGlobalSettings() {
		return $this->obj->settings->globals;
	}

	public function getOverlayContent() {
		return isset($this->obj->overlayContent) ? $this->obj->overlayContent : false;
	}

	public function getGlobalSettingByName($name) {
		$settings = $this->getGlobalSettings();
		$result = "";
		if (!empty($settings)) {
			foreach ($settings as $key => $setting) {
				if ($setting->id == $name) {
					$result = $setting;
					break;
				}
			}
		}

		return $result;
	}
	public function getAllCurentViewSetting() {
		$result = $settings = "";
		$view = DfdHeader_ViewCollection::instance()->getView();
		$view = ucfirst($view);
		$method = 'get' . $view . 'Settings';
		if (method_exists($this, $method)) {
			$settings = $this->$method();
			if (!empty($settings)) {
				return  $settings;
			}
		}

		return $result;
	}
	public function getSettingByName($name) {
		$result = $settings = "";
		$view = DfdHeader_ViewCollection::instance()->getView();
		$view = ucfirst($view);
		$method = 'get' . $view . 'Settings';
		if (method_exists($this, $method)) {
			$settings = $this->$method();
			if (!empty($settings)) {
				foreach ($settings as $key => $setting) {
					if (is_object($setting)) {
						if ($setting->id == $name) {
							$result = $setting;
							break;
						}
					}
				}
			}
		}

		return $result;
	}

	protected function _isShow($obj) {
		$value = "";
		$show = true;
		if (!is_object($obj)) {
			return "";
		}
		if ($obj->value == "") {
			$value = $obj->def;
		} else {
			$value = $obj->value;
		}
		if ($value != "on") {
			$show = false;
		}
		return $show;
	}

	public function setActivesPresets() {
		$top = $this->getSettingByName("show_top_panel_builder");
		$mid = $this->getSettingByName("show_mid_panel_builder");
		$bot = $this->getSettingByName("show_bot_panel_builder");
		$top = $this->_isShow($top);
		$mid = $this->_isShow($mid);
		$bot = $this->_isShow($bot);
		$this->_arr_actives_presets = array (
				"show_top_panel_builder" => $top,
				"show_mid_panel_builder" => $mid,
				"show_bot_panel_builder" => $bot,
		);
		$view = DfdHeader_ViewCollection::instance()->getView();
		return "";
	}
	public function isShow($name) {
		$obj = $this->getSettingByName($name);
		$obj = $this->_isShow($obj);
		return $obj;
	}
	public function getActivesPresets() {
		return $this->_arr_actives_presets;
	}

	public function isLast($name) {
		$return = false;
		$style = $this->getGlobalSettingByName("style_header_builder");
		if (is_object($style)) {
			$style = $style->value;
		} else {
			$style = "";
		}

		$view = DfdHeader_ViewCollection::instance()->getView();
		$last_active = "";
		$result = $this->getActivesPresets();
		foreach ($result as $key => $value) {
			if ($value == true) {
				$last_active = $key;
			}
		}
		if ($name == $last_active) {
			if ($style == "side" && $view == "desktop") {
				$return = false;
			} else {
				$return = true;
			}
		}
		return $return;
	}

	public function setLastPanel() {
		
	}

}

class DfdHeaderBuilder_Settings {

	function __construct() {
		
	}

}
