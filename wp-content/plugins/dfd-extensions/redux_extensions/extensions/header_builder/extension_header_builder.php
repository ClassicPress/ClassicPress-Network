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
if (!class_exists('ReduxFramework_extension_header_builder')) {


	/**
	 * Main ReduxFramework custom_field extension class
	 *
	 * @since       3.1.6
	 */
	class ReduxFramework_extension_header_builder /* extends ReduxFramework */ {

		// Protected vars
		protected $parent;
		public $extension_url;
		public $extension_dir;
		/* @var $theInstance ReduxFramework_extension_header_builder */
		public static $theInstance;

		/**
		 * Array of values
		 * @var array 
		 */

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
			$this->field_name = "header_builder";

			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}

			add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/header_builder', array (&$this, 'overload_field_path')); // Adds the local field
//			add_filter("redux/validate/{$this->parent->args['opt_name']}/before_validation", array (&$this, "valid"));
//			add_filter("redux/validate/{$this->parent->args['opt_name']}/class/font_load", array (&$this, $this->validate_class));
//			add_filter("redux/{$this->parent->args['opt_name']}/field/typography/custom_fonts", array ($this, "add_custom_font"));
			add_action("init", array ($this, "addPresetOptionToMetabox"));
			add_action("wp_head", array ($this, "addCssToHead"));
		}

		public function addPresetOptionToMetabox() {


//			if (Dfd_Theme_Helpers::isHeaderBuilderPluginActive()) {
			require_once $this->extension_dir . "frontend/DfdHeaderBuilderBoot.php";
			DfdHeaderBuilderBoot::instance()->boot();
			DfdHeaderBuilder_PresetCollection::instance()->localizeScripts();
			add_filter('dfd_headers_type', array ($this, 'dfd_headers_type'), 10, 1);
//			}
		}

		public function addCssToHead() {
			require_once $this->extension_dir . "frontend/DfdHeaderBuilderBoot.php";
			DfdHeaderBuilderBoot::instance()->boot();

			$path = $this->extension_url . "frontend/css/header-styles.css";

			wp_enqueue_style("dfd_header_builder_front", $path);
			$header = $this->get_header_style();
			DfdHeaderBuilder_PresetCollection::instance()->setActivepreset($header);

			$css = new DfdHeader_CSSGenerator();
			$css = $css->build();
			wp_add_inline_style('dfd_header_builder_front', $css);
		}

		public function dfd_headers_type($array) {
			require_once $this->extension_dir . "frontend/DfdHeaderBuilderBoot.php";
			DfdHeaderBuilderBoot::instance()->boot();
			$presets = DfdHeaderBuilder_PresetCollection::instance()->getAll();
			if (empty($presets)) {
				return false;
			}
			if (Dfd_Theme_Helpers::isHeaderBuilderPluginActive()) {

				$position = count($array) - 1;
				$prefix = esc_html__('Constructed', 'dfd-native');
				$insert = array ();
				foreach ($presets as $key => $preset) {
					/* @var $preset DfdHeaderBuilder_Preset */
					$obj = array ();
					$name = $preset->getName() . ' (' . $prefix . ')';
					$id = $preset->getId();
					$insert[$id] = $name;
				}

				$this->array_insert($array, $position, $insert);
			}

			return $array;
		}

		private function get_header_style() {
			global $dfd_native;

			$headers_avail = array_keys(Dfd_Theme_Helpers::dfd_headers_type());

			$selected_header = DfdMetaBoxSettings::get('dfd_headers_header_style');
			if ($selected_header && in_array($selected_header, $headers_avail)) {
				return $selected_header;
			}

			$layouts = array ('pages', 'archive', 'single', 'search', '404',);

			switch (true) {
				case is_404(): $layout = '404';
					break;
				case is_search(): $layout = 'search';
					break;
				case is_single(): $layout = 'single';
					break;
				case is_archive(): $layout = 'archive';
					break;
				case is_page(): $layout = 'pages';
					break;
				default:
					$layout = 'pages';
			}

			if (!isset($dfd_native["{$layout}_head_type"]) || !$dfd_native["{$layout}_head_type"] || !in_array($dfd_native["{$layout}_head_type"], $headers_avail)) {
				return '1';
			}

			return $dfd_native["{$layout}_head_type"];
		}

		/**
		 * @param array      $array
		 * @param int|string $position
		 * @param mixed      $insert
		 */
		function array_insert(&$array, $position, $insert) {
			$first_array = array_splice($array, 0, $position);
			$array = array_merge($first_array, $insert, $array);
		}

//		public function enqueue() {
//			
//			
//		}
		/**
		 * 
		 * @return self
		 */
		public static function getInstance() {
			return self::$theInstance;
		}

		private function includeClases() {
//			$components_dir = dirname(__FILE__) . "/components/";
//			require_once $components_dir . "ttf_info" . ".php";
//			require_once $components_dir . "custom_font_validator" . ".php";
//			require_once $components_dir . "mimetype" . ".php";
		}

		// Forces the use of the embeded field path vs what the core typically would use    
		public function overload_field_path($field) {
			return dirname(__FILE__) . '/' . $this->field_name . '/field_' . $this->field_name . '.php';
		}

	}

	// class
} // if
