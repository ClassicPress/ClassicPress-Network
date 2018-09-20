<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeader_CSSGenerator {

	/**
	 *
	 * @var DfdHeaderBuilder_Preset 
	 */
	protected $preset;

	/**
	 * 
	 * @param DfdHeaderBuilder_Preset $preset
	 */
	public function setpreset(DfdHeaderBuilder_Preset $preset) {
		$this->preset = $preset;
	}

	/**
	 * 
	 * @return DfdHeaderBuilder_Preset
	 */
	public function getPreset() {
		return $this->preset;
	}

	public function generateCSs() {
		$result = "";
		$preset = $this->getPreset();
		if ($preset == "") {
			$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
			if ($preset instanceof DfdHeaderBuilder_Preset) {
				$this->setpreset($preset);
			}
		}
		if ($preset) {

			$desktopSettings = $preset->getGlobalSettings();
			$css = new DfdHeader_CssSettingCreator($desktopSettings);
			$result.= $css->getGlobalCss();

			$desktopSettings = $preset->getDesktopSettings();
			$css = new DfdHeader_CssSettingCreator($desktopSettings, "desktop");
			$result.= $css->getCss();

			$desktopSettings = $preset->getTabletSettings();
			$css = new DfdHeader_CssSettingCreator($desktopSettings, "tablet");
			$result.= $css->getCss();

			$desktopSettings = $preset->getMobileSettings();
			$css = new DfdHeader_CssSettingCreator($desktopSettings, "mobile");
			$result.= $css->getCss();
		}

		return $result;
	}

	function __construct() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		if ($preset instanceof DfdHeaderBuilder_Preset) {
			$this->setpreset($preset);
		}
	}

	public function build() {
		$css = $this->generateCSs();
		return $css;
	}

}

class DfdHeader_CssSettingCreator {

	protected $settings;
	protected $classview;
	protected $view;
	protected $main_css_not_small;
	protected $side_header_css;
	protected $main_css;

	function __construct($settings, $view = "") {
		$this->view = $view;
		$this->settings = $settings;

		if ($view) {
			$view = "." . $view;
		}
		$this->classview = $view;
		$this->css = "#header-container.dfd-header-builder .header-builder-wrraper" . $this->classview . "";
		$this->main_css = "#header-container.dfd-header-builder .header-builder-wrraper" . $this->classview . " .header";
		$this->main_css_not_small = "#header-container.dfd-header-builder:not(.small) .header-builder-wrraper" . $this->classview . " .header";
		$this->main_css_not_wrapp = "#header-container.dfd-header-builder .header-builder-wrraper" . $this->classview . " .header > div:not(.header-wrap)";
		$this->side_header_css = "#header-container.dfd-header-builder.side-header .desktop";
	}

	public function getColor($id, $settings = "") {
		$color = "";
		if (empty($settings)) {
			$settings = $this->settings;
		}
		if (!empty($settings)) {
			foreach ($settings as $key => $setting) {
				if ($setting->id == $id && $setting->type == "colorpicker" && is_string($setting->value)) {
					$decoded_color_obj = json_decode($setting->value);
					if ($decoded_color_obj->is_transparent == "true") {
						$color = "transparent";
					} else {
						if ($decoded_color_obj->color == "") {
							$color = $setting->def;
						} else {
							$color = $decoded_color_obj->color;
						}
					}
					return $color;
				}
			}
		}
		return "";
	}

	public function getImage($name) {
		$logo_sett = DfdHeader_ViewCollection::instance()->getPreset()->getGlobalSettingByName($name);
		$img = $logo_val_sett = "";
		if (is_object($logo_sett)) {
			if(is_string($logo_sett->value)){
				$logo_val_sett = json_decode($logo_sett->value);
			}
			if (is_object($logo_val_sett)) {
				$img_id = $logo_val_sett->id;
				$img = wp_get_attachment_image_src($img_id, "full");
			}
		}
		if ($img && is_array($img) && isset($img[0])) {
			$img = $img[0];
			return esc_url($img);
		}
		return "";
	}

	public function getGlobalCss() {
		$main_css = $this->main_css;
		$css = "";
		$height = 0;

		$header_top_background_color_build = $this->getColor("header_top_background_color_build");
		$header_mid_background_color_build = $this->getColor("header_mid_background_color_build");
		$header_bot_background_color_build = $this->getColor("header_bot_background_color_build");

		$header_top_text_color_build = $this->getColor("header_top_text_color_build");
		$header_mid_text_color_build = $this->getColor("header_mid_text_color_build");
		$header_bot_text_color_build = $this->getColor("header_bot_text_color_build");

		$header_border_color_build = $this->getColor("header_border_color_build");

		$header_side_background_color_builder = $this->getColor("header_side_background_color_builder");

		$bg_image_side_header_builder = $this->getImage("bg_image_side_header_builder");

//		$css.=$this->main_css_not_small . " .header-top-panel,";
//		$css.=$this->main_css_not_small . " .dfd-header-banner-wrap,";
//		$css.=$this->main_css_not_small . " .login-header .dfd-header-links,";
//		$css.=$this->main_css_not_small . " .login-header .logo-wrap.header-top-logo-panel,";
//		$css.=$this->main_css_not_small . " .header-wrap .dfd-header-buttons-wrap > *,";
//		$css.=$this->main_css_not_small . " {border-color:" . $header_border_color_build . "}";
//
//
//		$css.=$this->main_css_not_wrapp . " .dfd-header-delimiter:before{background:" . $header_border_color_build . ";}";
//		$css.=$this->main_css_not_small . " .dfd-header-delimiter:before{background:" . $header_border_color_build . ";}";
//
//		$css.=$this->main_css_not_small . " .header-mid-panel{border-color:" . $header_border_color_build . ";}";
//
//		$css.=$this->main_css_not_small . " .header-bottom-panel{border-color:" . $header_border_color_build . ";}";

		$css.=$this->side_header_css . "{background-color:" . $header_side_background_color_builder . "}";

		if ($bg_image_side_header_builder) {
			$css.=$this->side_header_css . "{background-image:url(" . $bg_image_side_header_builder . ")}";
		}
		if (empty($this->settings)) {
			return $css;
		}
		foreach ($this->settings as $key => $setting) {
			switch ($setting->id) {
				case "top_header_height_builder":
					$val = "";
					$head = $main_css . " .header-top-panel{";
					if ($setting->value) {
						$val.="height:" . $setting->value . "px;"
								   . "line-height:" . $setting->value . "px;";
						$head.=$val . "} ";
						DfdHeader_CssSetting::instance()->setHeight("top_panel_height", $setting->value);
					}

					if ($val) {
						$css.=$head;
						$css.=".header_wrap #header-container.dfd-header-builder.small .header-builder-wrraper{"
								   . "-webkit-transform: translateY(-" . $setting->value . "px);
									-moz-transform: translateY(-" . $setting->value . "px);
									-o-transform: translateY(-" . $setting->value . "px);
									transform: translateY(-" . $setting->value . "px);"
								   . "}";
					}
					break;
				case "mid_header_height_builder":
					$val = "";
					$head = $main_css . " .header-mid-panel{";
					if ($setting->value) {
						$val.="height:" . $setting->value . "px;"
								   . "line-height:" . $setting->value . "px;";
						$head.=$val . "} ";
						DfdHeader_CssSetting::instance()->setHeight("mid_panel_height", $setting->value);
					}
					if ($val) {
						$css.=$head;
					}
					break;
				case "bot_header_height_builder":
					$val = "";
					$head = $main_css . " .header-bottom-panel{";
					if ($setting->value) {
						$val.="height:" . $setting->value . "px;"
								   . "line-height:" . $setting->value . "px;";
						$head.=$val . "} ";
						DfdHeader_CssSetting::instance()->setHeight("bot_panel_height", $setting->value);
					}
					if ($val) {
						$css.=$head;
					}
					break;
				case "bot_header_height_builder":
					$val = "";
					$head = $main_css . " .header-bottom-panel{";
					if ($setting->value) {
						$val.="height:" . $setting->value . "px;"
								   . "line-height:" . $setting->value . "px;";
						$head.=$val . "} ";
						DfdHeader_CssSetting::instance()->setHeight("bot_panel_height", $setting->value);
					}
					if ($val) {
						$css.=$head;
					}
					break;
				case "header_side_bar_width_builder":
					$head = $val = "";
					$value = $setting->value;
					if (empty($value)) {
						$value = 300;
					}
					$width = 1101;
					$head = "#header-container.dfd-header-builder.side-header .desktop{"
							   . "width:" . $value . "px;}";
					$head .="@media only screen and (min-width: " . $width . "px){"
							   . ".header_wrap.dfd-header-builder.side-header.left ~ #main-wrap{"
							   . "padding-left:" . $value . "px;"
							   . "}"
							   . "}";
					$head .="@media only screen and (min-width: " . $width . "px){"
							   . ".header_wrap.dfd-header-builder.side-header.right ~ #main-wrap{"
							   . "padding-right:" . $value . "px;"
							   . "}"
							   . "}";
					$css.=$head;
					break;
			}
		}
		return $css;
	}

	public function getCss() {
		$main_css = $this->main_css;
		$css = "";
		$height = 0;
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		DfdHeader_ViewCollection::instance()->setView($this->view);
		$preset->setActivesPresets();
//		$global_setting = $preset->getGlobalSettings();
		$global_setting = $preset->getAllCurentViewSetting();
		$header_top_background_color_build = $this->getColor("header_top_background_color_build", $global_setting);
		$header_mid_background_color_build = $this->getColor("header_mid_background_color_build", $global_setting);
		$header_bot_background_color_build = $this->getColor("header_bot_background_color_build", $global_setting);

		$header_top_text_color_build = $this->getColor("header_top_text_color_build", $global_setting);
		$header_mid_text_color_build = $this->getColor("header_mid_text_color_build", $global_setting);
		$header_bot_text_color_build = $this->getColor("header_bot_text_color_build", $global_setting);

		$header_border_color_build = $this->getColor("header_border_color_build", $global_setting);

		$header_side_background_color_builder = $this->getColor("header_side_background_color_builder", $global_setting);


		$aval_views = array (
				".header-top-panel" => array (
						"position" => "top",
						"name" => "show_top_panel_builder"
				),
				".header-mid-panel" => array (
						"position" => "mid",
						"name" => "show_mid_panel_builder"
				),
				".header-bottom-panel" => array (
						"position" => "bot",
						"name" => "show_bot_panel_builder"
				),
		);
		foreach ($aval_views as $panel_type => $panel_type_set) {

			$position = $panel_type_set["position"];
			$name = $panel_type_set["name"];
			$text_color_name = "header_{$position}_text_color_build";
			$background_color_name = "header_{$position}_background_color_build";
			$background_color = ${$background_color_name};
			$text_color = ${$text_color_name};
			$css_head = $this->main_css;
			if ($preset->isLast($name)) {
				$css_head = $this->main_css_not_small;
			}

			$css.=$css_head . " " . $panel_type . " .top-inner-page > span > span{background: " . $text_color . ";}";
			$css.=$css_head . " " . $panel_type . " .dfd-click-menu-activation-button a .icon-wrap{background:" . $text_color . ";}";
			$css.=$css_head . " " . $panel_type . " a.mobile-menu .icon-wrap{background:" . $text_color . ";}";
			$css.=$css_head . " " . $panel_type . " {background:" . $background_color . "; color:" . $text_color . ";}";
			$css.=$css_head . " " . $panel_type . " .dfd-header-banner-wrap,";
			$css.=$css_head . " " . $panel_type . " .logo-wrap.header-top-logo-panel,";
			$css.=$css_head . " " . $panel_type . " .header-wrap{background:" . $background_color . ";}";
			$css.=$css_head . " " . $panel_type . " .logo-wrap.header-top-logo-panel,";
			$css.=$css_head . " " . $panel_type . "  .row > .columns{color:" . $text_color . "}";
		}
		$css.=$this->main_css_not_small . " .header-top-panel,";
		$css.=$this->main_css_not_small . " .dfd-header-banner-wrap,";
		$css.=$this->main_css_not_small . " .login-header .dfd-header-links,";
		$css.=$this->main_css_not_small . " .login-header .logo-wrap.header-top-logo-panel,";
		$css.=$this->main_css_not_small . " .header-wrap .dfd-header-buttons-wrap > *,";
		$css.=$this->main_css_not_small . " {border-color:" . $header_border_color_build . "}";


		$css.=$this->main_css_not_wrapp . " .dfd-header-delimiter:before{background:" . $header_border_color_build . ";}";
		$css.=$this->main_css_not_small . " .dfd-header-delimiter:before{background:" . $header_border_color_build . ";}";

		$css.=$this->main_css_not_small . " .header-mid-panel{border-color:" . $header_border_color_build . ";}";

		$css.=$this->main_css_not_small . " .header-bottom-panel{border-color:" . $header_border_color_build . ";}";

		if (empty($this->settings)) {
			return $css;
		}
		$is_side = DfdHeaderBuilder_ReduxOptions::instance()->isSideHeader();
		foreach ($this->settings as $key => $setting) {
			if (is_object($setting)) {
				switch ($setting->id) {
					case "show_top_panel_builder":
						$panel_options = DfdHeader_CssSetting::instance()->prepareValues($main_css, $setting, $is_side, $height, ".header-top-panel", "top_panel_height");

						$height = $panel_options["height"];
						if ($panel_options["val"]) {
							$css.=$this->css . "{"
									   . "-webkit-transform: translateY(0px) !important;
									-moz-transform: translateY(0px) !important;
									-o-transform: translateY(0px) !important;
									transform: translateY(0px) !important;"
									   . "}";
							$css.=$panel_options["head"];
						}
						break;
					case "show_mid_panel_builder":
						$panel_options = DfdHeader_CssSetting::instance()->prepareValues($main_css, $setting, $is_side, $height, ".header-mid-panel", "mid_panel_height");

						$height = $panel_options["height"];
						if ($panel_options["val"]) {
							$css.=$panel_options["head"];
						}
						break;
					case "show_bot_panel_builder":
						$panel_options = DfdHeader_CssSetting::instance()->prepareValues($main_css, $setting, $is_side, $height, ".header-bottom-panel", "bot_panel_height");

						$height = $panel_options["height"];
						if ($panel_options["val"]) {
							$css.=$panel_options["head"];
						}
						break;
				}
			}
		}
		$header_style = DfdHeaderBuilder_ReduxOptions::instance()->getHeaderStyle();
		if($header_style == "boxed"){
			$height +=25;
		}
		$css.="#menu-fixer{display:none}";
		if ($height) {
			$css.=" .menu-fixer" . $this->classview . "{"
					   . "height: " . $height . "px;
					  max-height: " . $height . "px;}";
		}

		return $css;
	}

}

class DfdHeader_CssSetting {

	protected $height;

	function __construct() {
		$this->height = array (
				"top_panel_height" => 0,
				"mid_panel_height" => 0,
				"bot_panel_height" => 0,
		);
	}

	public function prepareValues($main_css, $setting, $is_side, $height, $class = "", $panel_height = "") {
		$view = DfdHeader_ViewCollection::instance()->getView();

		$head = $main_css . " " . $class . "{";
		$val = "";
		if ($setting->value == "" && $setting->def == "off" && (!$is_side || $view != "desktop")) {
			$val.="display:none";
		}
		if ($setting->value == "off" && (!$is_side || $view != "desktop")) {
			$val.="display:none";
		}
		if (($setting->value == "on" || ($setting->value == "" && $setting->def == "on")) && (!$is_side || $view != "desktop") ) {
			$height +=$this->getHeight($panel_height);
		}
		$head.=$val . "}";
		return array (
				"head" => $head,
				"val" => $val,
				"height" => $height,
		);
	}

	public function setHeight($name, $val) {
		$this->height[$name] = $val;
	}

	public function getHeight($name) {
		if (!empty($name)) {
			return $this->height[$name];
		}
		return "";
	}

	/**
	 *
	 * @var DfdHeader_CssSetting $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
