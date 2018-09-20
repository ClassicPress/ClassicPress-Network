<?php

if (!defined('ABSPATH'))
	exit;

abstract class DfdHeaderBuilder_Form_FormGenerator {

	/**
	 *
	 * @var DfdHeaderBuilder_ReduxOptions 
	 */
	protected $_redux_options;
	protected $_collection;
	protected $_active_preset;

	function __construct() {
		$this->_redux_options = DfdHeaderBuilder_ReduxOptions::instance();
		$this->setCollection();

		$coll = $this->getViewCollection();
		$coll->setView($this->getName());
		$coll->populate();
		$this->_active_preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$this->_active_preset->setActivesPresets();
	}

	/**
	 * 
	 * @return DfdHeaderBuilder_Preset
	 */
	public function getActivePreset() {
		return $this->_active_preset;
	}

	abstract function getName();

	public function buildHiddenelem() {
		$this->init_mobile_menu();
		$side_area = new DfdHeaderBuilder_SideAreaBg();
		$side_area->render();
		$inner_page = new DfdHeaderBuilder_InnerPageBg();
		$inner_page->render();
		$serch_bg = new DfdHeaderBuilder_SearchFormBg();
		$serch_bg->render();
	}

	/**
	 * 
	 * @return DfdHeaderBuilder_ReduxOptions
	 */
	public function getReduxOptions() {
		return $this->_redux_options;
	}

	/**
	 * 
	 * @return DfdHeader_ViewCollection
	 */
	public function getViewCollection() {
		return $this->_collection;
	}

	public function setCollection() {
		$this->_collection = DfdHeader_ViewCollection::instance();
	}

	public function buildMainLayout() {
		$name = $this->getName();
		$count = $this->GetCountActivePanels();
		if ($count == 1) {
			$name .=" one_el";
		}
		echo '<div  class="header-builder-wrraper ' . $name . '" style="display: none;">';
			echo '<div id="" class="header">';
				$this->topPanelHtml();
				$this->midPanelHtml();
				$this->buttomPanelHtml();
			echo '</div>';
		echo '</div>';
	}

	public function getPanelClass($name) {
		$preset = $this->getActivePreset();
		$value = $preset->getSettingByName($name);
		$class = "";
		if (is_object($value)) {
			if ($value->value == "on" || ($value->value == "" && $value->def == "on")) {
				$class = "absolute";
			}
		}

		return $class;
	}

	public function GetCountActivePanels() {
		$result = 0;
		$view = DfdHeader_ViewCollection::instance()->getView();
		$act = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset()->getActivesPresets();
		foreach ($act as $key => $value) {
			if ($value == 1) {
				$result++;
			}
		}
		return (int) $result;
	}

	public function topPanelHtml() {
		$preset = $this->getActivePreset();
		$is_side = DfdHeaderBuilder_ReduxOptions::instance()->isSideHeader();
		$isShow = $preset->isShow("show_top_panel_builder");
		
		if(!$isShow && !$is_side)  {
			return false;
		}
		$is_last = $preset->isLast("show_top_panel_builder");
		$class = $is_last ? " header-wrap" : "";
		
		$class .= $isShow ? " show" : " ";
		
		
		$class .= " " . $this->getPanelClass("set_top_panel_abstract_builder");
		
		echo '<div class="header-top-panel ' . $class . '">';
		echo '<div class="row">';
		echo '<div class="twelve columns header-info-panel">';
		echo '<div class="col-wrraper">';
		echo '<div class="left-col">';
		$this->getViewCollection()->get_top_left();
		echo '</div>';
		echo '<div class="right-col">';
		$this->getViewCollection()->get_top_right();
		echo '</div>';
		echo '<div class="center-col">';
		$this->getViewCollection()->get_top_center();
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	public function midPanelHtml() {
		$preset = $this->getActivePreset();
		$is_side = DfdHeaderBuilder_ReduxOptions::instance()->isSideHeader();
		$isShow = $preset->isShow("show_mid_panel_builder");
		if(!$isShow && !$is_side)  {
			return false;
		}
		$is_last = $preset->isLast("show_mid_panel_builder");
		$class = $is_last ? " header-wrap" : "";
		
		
		$class .= $isShow ? " show" : " ";
		
		$class .= " " . $this->getPanelClass("set_mid_panel_abstract_builder");
		echo '<div class="logo-wrap header-top-logo-panel header-mid-panel ' . $class . '">';
		echo '<div class="row">';
		echo '<div class="columns twelve">';
		echo '<div class="col-wrraper">';
		echo '<div class="left-col">';
		$this->getViewCollection()->get_mid_left();
		echo '</div>';
		echo '<div class="right-col">';
		$this->getViewCollection()->get_mid_right();
		echo '</div>';
		echo '<div class="center-col">';
		$this->getViewCollection()->get_mid_center();
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	public function buttomPanelHtml() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$is_side = DfdHeaderBuilder_ReduxOptions::instance()->isSideHeader();
		$isShow = $preset->isShow("show_bot_panel_builder");
		if(!$isShow && !$is_side)  {
//			return false;
		}

		$is_last = $preset->isLast("show_bot_panel_builder");
		$class = $is_last ? " header-wrap " : "";
		
		$class .= $isShow ? " show" : " ";
		
		$class .= " " . $this->getPanelClass("set_bot_panel_abstract_builder");

		echo '<div class="header-bottom-panel ' . $class . '">';
		echo '<div class="row">';
		echo '<div class="twelve columns">';
		echo '<div class="col-wrraper">';
		echo '<div class="left-col">';
		$this->getViewCollection()->get_bot_left();
		echo '</div>';
		echo '<div class="right-col">';
		$this->getViewCollection()->get_bot_right();
		echo '</div>';
		echo '<div class="center-col">';
		$this->getViewCollection()->get_bot_center();
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}

	public function build_header_class() {
		$options = DfdHeaderBuilder_ReduxOptions::instance();
		$header_class = ' dfd-header-builder ';

		$header_class .= ' header-layout-' . $options->getHeaderLayout();

		if ($options->isSideAreaEnabled()) {
			$header_class .= ' side-area-enabled';
		}

		$header_class .= ' ' . $options->get_header_animation();

//		if ($this->show_element('header_sticky')) {
		if ($options->isStickyHeaderEnabled()) {
			$header_class .= ' dfd-enable-headroom';
		}
		if ($options->isSideHeader()) {
			$header_class .=' side-header';
		}
		
		if (!$options->isSideHeader()) {
			$header_class .=" dfd-enable-mega-menu ";
		}
		
		if ($options->getOverlayContent()) {
			$header_class .=" dfd-header-layout-fixed ";
		}
				
		$header_class .=" page_" . $options->get_layout_width();
		$header_class .=" " . $options->getHeaderStyle();
		$header_class .=" " . $options->getTextAlign();

		$header_class .=" " . $options->getSideBarAlign();
		$header_class .=" " . $options->getHeaderBgPosition();
		$header_class .=" " . $options->getHeaderBgSize();
		$header_class .=" " . $options->getHeaderBgRepeat();
		

		return $header_class;
	}

	private function init_mobile_menu() {
		global $dfd_native;
		echo '<div id="sidr" style="left: -260px;" class="sidr left">';
		echo '<div class="sidr-inner"><a href="#sidr-close" class="dl-trigger dfd-sidr-close dfd-socicon-cross-24"></a></div>';
		echo '<div class="sidr-widgets">';
		if (isset($dfd_native['soc_icons_mobile_header']) && $dfd_native['soc_icons_mobile_header'] == 'on') {
			echo '<div class="widget soc-icons" style="display: none;">';
			echo Dfd_Theme_Helpers::dfd_social_networks(true);
			echo '</div>';
		}
		if (
				   isset($dfd_native['lang_sel_mobile_header']) && $dfd_native['lang_sel_mobile_header'] == 'on' || isset($dfd_native['cart_button_mobile_header']) && $dfd_native['cart_button_mobile_header'] == 'on' || isset($dfd_native['serach_button_mobile_header']) && $dfd_native['serach_button_mobile_header'] == 'on'
		) {
			echo '<div class="sidr-buttons-container" style="display: none;">';
			if (isset($dfd_native['lang_sel_mobile_header']) && $dfd_native['lang_sel_mobile_header'] == 'on') {
				$lang = new DfdHeaderBuilder_LangSel();
				$lang->render();
			}
			if (isset($dfd_native['cart_button_mobile_header']) && $dfd_native['cart_button_mobile_header'] == 'on' && class_exists('WooCommerce') && function_exists('dfd_woocommerce_total_cart')) {
				$cart = new DfdHeaderBuilder_Cart();
				$cart->setSimple(true);
				$cart->render();
			}
			if (isset($dfd_native['serach_button_mobile_header']) && $dfd_native['serach_button_mobile_header'] == 'on') {
				echo '<div class="form-search-wrap">';
				echo '<a href="#" class="header-search-switcher dfd-socicon-Search"></a>';
				echo '</div>';
			}
			echo '</div>';
		}
		echo '</div>';
		echo '</div>';
		echo '<a href="#sidr-close" class="dl-trigger dfd-sidr-close"></a>';
	}

}

class DfdHeaderBuilder_ReduxOptions {

	function __construct() {
		
	}

	/**
	 *
	 * @var DfdHeaderBuilder_ReduxOptions $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Get options from  Header main options -> Boxed header layout
	 * @global type $dfd_native
	 * @return string
	 */
	public function getHeaderLayout() {
		global $dfd_native;

		if (isset($dfd_native['header_layout']) && !empty($dfd_native['header_layout'])) {
			return $dfd_native['header_layout'];
		} else {
			return 'fullwidth';
		}
	}

	function get_layout_width() {
		switch (true) {
				case is_404(): $page = '404';
					break;
				case is_search(): $page = 'search';
					break;
				case is_single(): $page = 'single';
					break;
				case is_archive(): $page = 'archive';
					break;
				case is_page(): $page = 'pages';
					break;
				default:
					$page = 'pages';
			}
		$layout_width = DfdMetaBoxSettings::get('dfd_layout_width');

		if (!$layout_width || empty($layout_width)) {
			global $dfd_native;
			$layout_width = isset($dfd_native[$page . '_layout_width']) ? $dfd_native[$page . '_layout_width'] : 'boxed';
		}

		return $layout_width;
	}

	public function isTopPanelEnabled() {
		$top_panel_enabled = DfdMetaBoxSettings::get('dfd_headers_show_top_inner_page');

		if ($top_panel_enabled == 'on') {
			return true;
		}

		return false;
	}

	public function isSideAreaEnabled() {
		global $dfd_native;

		$enable_sidearea = false;

		if (!isset($dfd_native['side_area_enable']) || $dfd_native['side_area_enable'] != 'off') {
			$sidearea = DfdMetaBoxSettings::get('dfd_headers_show_side_area');

			if ($sidearea == 'on') {
				$enable_sidearea = true;
			}
		}
		return true;
		return $enable_sidearea;
	}

	public function geTopPanelPageId() {
		global $dfd_native;

		$top_inner_page_id = '';

		if (isset($dfd_native['top_panel_inner_page_select'])) {
			$top_inner_page_id = intval($dfd_native['top_panel_inner_page_select']);
		}

		return $top_inner_page_id;
	}

	public function get_header_animation() {
		global $dfd_native;
		$available = Dfd_Theme_Helpers::dfd_sticky_header_animations();

		$enable_sticky_header = (!isset($dfd_native['enable_sticky_header']) || strcmp($dfd_native['enable_sticky_header'], 'off') !== 0);

		if (!$enable_sticky_header)
			return 'sticky-header-disabled';

		$sticky_header_classes = 'sticky-header-enabled';

		$sticky_header_animation = isset($dfd_native['sticky_header_animation']) ? $dfd_native['sticky_header_animation'] : 'simple';

		if (empty($sticky_header_animation) || !isset($available[$sticky_header_animation])) {
			$available_keys = array_keys($available);
			$sticky_header_animation = array_shift($available_keys);
		}

		$sticky_header_classes .= ' ' . $sticky_header_animation;

		return $sticky_header_classes;
	}

	public function isSideHeader() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$style = $preset->getGlobalSettingByName("style_header_builder");
		if (!is_object($style)) {
			return false;
		}
		if ($style->value == "side") {
			return true;
		}
		return false;
	}
	
	public function getHeaderStyle() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$style = $preset->getGlobalSettingByName("style_header_builder");
		if (!is_object($style)) {
			return false;
		}
		return $style->value;
	}

	public function isStickyHeaderEnabled() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$stiky = $preset->getGlobalSettingByName("header_sticky_builder");
		if (!is_object($stiky)) {
			return false;
		}
		if ($stiky->value == "on" || ($stiky->value == "" && $stiky->def == "on")) {
			return true;
		}
		return false;
	}

	public function getTextAlign() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$align = $preset->getGlobalSettingByName("header_content_alignment_builder");
		if (!is_object($align)) {
			return "";
		}
		$value = $align->value;
		$result = "";
		switch ($value) {
			case "alignleft":
				$result = "text-left";
				break;
			case "aligncenter":
				$result = "text-center";
				break;
			case "alignright":
				$result = "text-right";
				break;
		}
		return $result;
	}

	public function getOverlayContent() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		return $preset->getOverlayContent();
	}

	public function getSideBarAlign() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$align = $preset->getGlobalSettingByName("header_alignment_builder");
		if (!is_object($align)) {
			return "";
		}
		$value = $align->value;
		return $value;
	}

	public function getHeaderBgPosition() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$pos = $preset->getGlobalSettingByName("header_bg_position_builder");
		if (!is_object($pos)) {
			return "";
		}
		$value = "header_bg_position_" . $pos->value;
		return $value;
	}

	public function getHeaderBgSize() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$size = $preset->getGlobalSettingByName("header_bg_size_builder");
		if (!is_object($size)) {
			return "";
		}
		$value = "header_bg_size_" . $size->value;
		return $value;
	}

	public function getHeaderBgRepeat() {
		$preset = DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
		$size = $preset->getGlobalSettingByName("header_bg_repeat_builder");
		if (!is_object($size)) {
			return "";
		}
		$value = "header_bg_repeat_" . $size->value;
		return $value;
	}

}
