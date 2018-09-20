<?php

if (!defined('ABSPATH'))
	exit;

class DfdHeader_Adaptor {

	private $element;
	protected $fullwidth = "";
	protected $head_html;
	protected $footer_html = "";

	function __construct($element) {
		if (!is_object($element)) {
			return false;
		}
		$this->element = $element;
		$type = $this->element->type;

		if (isset($element->isfullwidth)) {
			$this->fullwidth = $element->isfullwidth ? "fullwidth" : "";
		}
		$this->head_html = "<div class='el " . $type . " " . $this->fullwidth . "'>";
		$this->footer_html = "</div>";

		switch ($type) {
			case "menu":
				$this->buildMenu();
				break;
			case "second_menu":
				$this->buildSecondMenu();
				break;
			case "third_menu":
				$this->buildThirdMenu();
				break;
			case "additional_menu":
				$this->buildAdditionalMenu();
				break;
			case "wishlist":
				$this->buildWishList();
				break;
			case "buttonel":
				$this->buildButton();
				break;
			case "cart":
				$this->buildCart();
				break;
			case "search":
				$this->buildSearch();
				break;
			case "logo":
				$this->buildLogo();
				break;
			case "language":
				$this->buildLang();
				break;
			case "socicon":
				$this->buildSocIcon();
				break;
			case "login":
				$this->buildLogin();
				break;
			case "info":
				$this->buildInfo();
				break;
			case "inner_page":
				$this->buildInnerPage();
				break;
			case "mobile_menu":
				$this->buildMobileMenu();
				break;
			case "side_area":
				$this->buildSiderArea();
				break;
			case "delimiter":
				$this->buildDelimier();
				break;
			case "text":
				$this->buildText();
				break;
			case "spacer":
				$this->buildSpacer();
				break;
			case "telephone":
				$this->buildTelephone();
				break;

			default:
				break;
		}
	}

	public function buildButton() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Button();
		$obj->render();
		echo $this->footer_html;
	}
	public function buildAdditionalMenu() {
		echo $this->head_html;
		$obj = DfdHeaderBuilder_AdditionalHeaderMenu::instance();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildInnerPage() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_InnerPageButton();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildSpacer() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Spacer();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildTelephone() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Telephone();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildDelimier() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Delimiter();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildSiderArea() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_SideArea();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildMobileMenu() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_MobileMenu();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildSocIcon() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_SocialIcons();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildLang() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_LangSel();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildSearch() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_SearchButton();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildCart() {
		$obj = new DfdHeaderBuilder_Cart();
		if ($obj->isActive()) {
			echo $this->head_html;
			$obj->render();
			echo $this->footer_html;
		}
	}

	public function buildWishList() {
		$obj = new DfdHeaderBuilder_WishList();
		if ($obj->isActive()) {
			echo $this->head_html;
			$obj->render();
			echo $this->footer_html;
		}
	}

	public function buildMenu() {
		echo $this->head_html;
		$obj = DfdHeaderBuilder_Menu::instance();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildSecondMenu() {
		echo $this->head_html;
		$obj = DfdHeaderBuilder_SecondMenu::instance();
		$obj->render();
		echo $this->footer_html;
	}
	public function buildThirdMenu() {
		echo $this->head_html;
		$obj = DfdHeaderBuilder_ThirdMenu::instance();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildLogin() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Login();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildInfo() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_TopInfo();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildLogo() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Logo();
		$obj->render();
		echo $this->footer_html;
	}

	public function buildText() {
		echo $this->head_html;
		$obj = new DfdHeaderBuilder_Text();
		$obj->render();
		echo $this->footer_html;
	}

}

class DfdHeader_ViewCollection {

	protected $top_left = array ();
	protected $top_center = array ();
	protected $top_right = array ();
	protected $mid_left = array ();
	protected $mid_center = array ();
	protected $mid_right = array ();
	protected $bot_left = array ();
	protected $bot_center = array ();
	protected $bot_right = array ();
	protected $view = "";

	public function setView($name) {
		switch ($name) {
			case "desktop":
				$this->view = "desktop";
				break;
			case "tablet":
				$this->view = "tablet";
				break;
			case "mobile":
				$this->view = "mobile";
				break;
		}
	}

	public function getView() {
		return $this->view;
	}

	public function build($array_elements) {
		echo "<div class='wrapper_el'>";
		if (is_array($array_elements) && !empty($array_elements)) {
			foreach ($array_elements as $key => $element) {

				new DfdHeader_Adaptor($element);
			}
		}
		echo "</div>";
	}

	function get_top_left() {
		$this->build($this->top_left);
	}

	function get_top_center() {
		$this->build($this->top_center);
	}

	function get_top_right() {
		$this->build($this->top_right);
	}

	function get_mid_left() {
		$this->build($this->mid_left);
	}

	function get_mid_center() {
		$this->build($this->mid_center);
	}

	function get_mid_right() {
		$this->build($this->mid_right);
	}

	function get_bot_left() {
		$this->build($this->bot_left);
	}

	function get_bot_center() {
		$this->build($this->bot_center);
	}

	function get_bot_right() {
		$this->build($this->bot_right);
	}

	function __construct() {
		
	}

	/**
	 * 
	 * @return DfdHeaderBuilder_Preset
	 */
	public function getPreset() {

		return DfdHeaderBuilder_PresetCollection::instance()->getActivePreset();
	}

	public function populate() {
		$preset = $this->getPreset();

		$view = $this->getView();
		$preset_values = array ();
		switch ($view) {
			case "desktop":
				$preset_values = $preset->getDesktop();
				break;
			case "tablet":
				$preset_values = $preset->getTablet();
				break;
			case "mobile":
				$preset_values = $preset->getMobile();
				break;
		}
		if (empty($preset_values)) {
			return false;
		}
		foreach ($preset_values as $row_key => $row_values) {
			$pos_row = "";
			switch ($row_key) {

				case 0:
					$pos_row = "top";
					break;
				case 1:
					$pos_row = "mid";
					break;
				case 2:
					$pos_row = "bot";
					break;
			}
			if (is_array($row_values) && !empty($row_values)) {
				foreach ($row_values as $col_key => $col_values) {
					$pos_col = "";
					switch ($col_key) {

						case 0:
							$pos_col = "left";
							break;
						case 1:
							$pos_col = "center";
							break;
						case 2:
							$pos_col = "right";
							break;
					}
					$pos = $pos_row . "_" . $pos_col;
					$this->{$pos} = $col_values;
				}
			}
		}
	}

	/**
	 *
	 * @var DfdHeader_ViewCollection $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
