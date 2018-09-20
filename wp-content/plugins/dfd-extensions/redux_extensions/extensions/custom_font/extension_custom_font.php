<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_extension_custom_font')) {


	/**
	 * Main ReduxFramework custom_field extension class
	 *
	 * @since       3.1.6
	 */
	class ReduxFramework_extension_custom_font /* extends ReduxFramework */ {

		// Protected vars
		protected $parent;
		public $extension_url;
		public $extension_dir;
		public $upload_dir;
		public $upload_dir_url;
		/* @var $theInstance ReduxFramework_extension_custom_font */
		public static $theInstance;
		public $validate_class = "font_load";

		/**
		 * Array of values
		 * @var array 
		 */
		public $validaion_values;
		public $errors = array ();

		/**
		 * Class Constructor. Defines the args for the extions class
		 *
		 * @since       1.0.0
		 * @access      public
		 * @param       array $sections Panel sections.
		 * @param       array $args Class constructor arguments.
		 * @param       array $extra_tabs Extra panel tabs.
		 * @return      void
		 */
		public function __construct($parent) {

			$this->parent = $parent;
			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}
			$upl_dir = wp_upload_dir();
			$dir = $upl_dir["basedir"];
			$dir_url = $upl_dir["baseurl"];
			$this->upload_dir = $dir . "/fonts/";
			$this->upload_dir_url = $dir_url . "/fonts/";

			$this->field_name = 'custom_font';

			self::$theInstance = $this;

			$this->includeClases();

			add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/' . $this->field_name, array (&$this, 'overload_field_path')); // Adds the local field
			add_filter("redux/validate/{$this->parent->args['opt_name']}/before_validation", array (&$this, "valid"));
			add_filter("redux/validate/{$this->parent->args['opt_name']}/class/font_load", array (&$this, $this->validate_class));
			$this->parent->outputCSS .= Custom_Font_Validator::generateFrontFontFace();
			add_filter("redux/{$this->parent->args['opt_name']}/field/typography/custom_fonts", array ($this, "add_custom_font"));
			add_action("redux/options/{$this->parent->args['opt_name']}/import", array (&$this, 'import'));
		}

		public function import($name) {
			$components_dir = dirname(__FILE__) . "/validator/";
			require_once $components_dir . "font_load" . ".php";
			$parent = $this->parent;
			$name = $this->field_name;
			$list = isset($this->parent->options[$name]) ? $this->parent->options[$name] : array();
			foreach ($list as $font_key => $font) {
				$id = isset($font["attachment_id"]) ? $font["attachment_id"] : "";
				$field = array("id"=>$id);
				new Redux_Validation_font_load($parent, $field, $font, $current = "");
			}
			return true;
		}

		public function add_custom_font() {
//			print_r($this->parent->options);
			$fonts_arr = array ();
			if (isset($this->parent->options[$this->field_name])) {
				$fonts_arr = $this->parent->options[$this->field_name];
			}
			$local_fonts = Custom_Font_Validator::instance()->getLocalFonts();
			$fonts_result = array ();
//			print_r($local_fonts);
			if (empty($fonts_arr) || empty($local_fonts)) {
				return array ();
			}
			foreach ($fonts_arr as $font_key => $font_value) {
				$id = $font_value["attachment_id"];
				if (!empty($local_fonts) && !is_string($local_fonts)) {
					foreach ($local_fonts as $local_fonts_key => $local_fonts_value) {
						if ($local_fonts_value["id"] == $id) {
							$fonts_result[$local_fonts_key] = $local_fonts_key;
							break;
						}
					}
				}
			}
			unset($fonts_arr);
			unset($local_fonts);
//			print_r($fonts_result);
			$result = "";
			if (!empty($fonts_result)) {
				$result = array (
						"Custom fonts" => $fonts_result
				);
			}

			$result = empty($result) ? array () : $result;
			return $result;
		}

		public function getParent() {
			return $this->parent;
		}

		public function valid($ar1, $arr2 = "") {
			$this->validaion_values = isset($ar1[$this->field_name]) ? $ar1[$this->field_name] : '';
			return $ar1;
		}

		public function font_load($arr1 = "", $arr2 = "") {
			$dir = Redux_Helpers::cleanFilePath(dirname(__FILE__));
			$dir.="/validator/{$this->validate_class}.php";
//			print_r($dir);
			return $dir;
		}

		/**
		 * 
		 * @return self
		 */
		public static function getInstance() {
			return self::$theInstance;
		}

		private function includeClases() {
			$components_dir = dirname(__FILE__) . "/components/";
			require_once $components_dir . "ttf_info" . ".php";
			require_once $components_dir . "custom_font_validator" . ".php";
			require_once $components_dir . "mimetype" . ".php";
		}

		// Forces the use of the embeded field path vs what the core typically would use    
		public function overload_field_path($field) {

			return dirname(__FILE__) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
		}

	}

	// class
} // if
