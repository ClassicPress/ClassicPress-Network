<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;

// Don't duplicate me!
if (!class_exists('ReduxFramework_extension_icon_manager')) {


	/**
	 * Main ReduxFramework custom_field extension class
	 *
	 * @since       3.1.6
	 */
	class ReduxFramework_extension_icon_manager /* extends ReduxFramework */ {

		public $validate_class = "icon_load";

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

			$this->field_name = 'icon_param';

			$this->includeClases();

			IconConfig::initSettings($this);

			IconConfig::setDefaults($this, $parent);

			if (empty($this->extension_dir)) {
				$this->extension_dir = trailingslashit(str_replace('\\', '/', dirname(__FILE__)));
				$this->extension_url = site_url(str_replace(trailingslashit(str_replace('\\', '/', ABSPATH)), '', $this->extension_dir));
			}
//			if (is_admin()) {
			add_filter('redux/' . $this->parent->args['opt_name'] . '/field/class/icon_manager', array (&$this, 'overload_field_path')); // Adds the local field
			add_filter("redux/validate/{$this->parent->args['opt_name']}/before_validation", array (&$this, "valid"));
			add_filter("redux/validate/{$this->parent->args['opt_name']}/class/icon_load", array ($this, $this->validate_class));
			add_action("redux/options/{$this->parent->args['opt_name']}/import", array (&$this, 'import'));
			if (function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('icon_manager', array ($this, 'icon_manager'));
			}
			add_action('init', array ($this, 'addCssToHead'));
		}
		
		public function addCssToHead() {
			$fonts = array ();

			if (isset($this->parent->options[$this->field_name][0]) && $this->parent->options[$this->field_name][0] != "" && is_string($this->parent->options[$this->field_name][0])) {
				$fonts = json_decode($this->parent->options[$this->field_name][0], true);
			}
			$def = IconConfig::getDefaults();
			if (is_array($fonts)) {
				$fonts = array_merge($fonts, $def);
			} else {
				$fonts = $def;
			}
			if (count($fonts) > 0) {
				foreach ($fonts as $font => $info) {
					if (isset($info["active"]) && $info["active"] == true) {
						if (isset($info->style) && strpos($info->style, 'http://') !== false) {
							wp_enqueue_style('dfd-' . $font, $info["style"]);
						} else {
							if (isset($info["is_default"])) {
								$path = trailingslashit(DFD_EXTENSIONS_PLUGIN_URL) . $info["main"];
							} else {
								$path = $this->paths['fonturl'];
							}
							$path = trailingslashit($path) . $info["style"];
							$local_path = trailingslashit($this->paths['fontdir']) . $info["style"];
							if (is_file($local_path) || isset($info["is_default"])) {
								wp_enqueue_style('dfd-' . $font, $path);
							}
						}
					}
				}
			}
		}

		public function import($name) {
			$components_dir = dirname(__FILE__) . "/validator/";
			require_once  $components_dir . "icon_load" . ".php";
			$parent  = $this->parent;
			if(isset($this->parent->options[$this->field_name][0])){
				$value = $this->parent->options[$this->field_name][0];
				$val = array();
				$val = $value;
				$field = $this->field_name;
				new Redux_Validation_icon_load( $parent, $field, $val, $current="");
			}
			return true;
		}
		function icon_manager($settings, $value) {
			$font_manager = self::get_font_manager(true);
			$output = '<div class="my_param_block">'
					   . '<input name="' . esc_attr($settings['param_name']) . '"
					  class="wpb_vc_param_value wpb-textinput ' . esc_attr($settings['param_name']) . ' 
					  ' . esc_attr($settings['type']) . '_field" type="hidden" 
					  value="' . esc_attr($value) . '" />'
					   . '</div>';
			$output .= '<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".preview-icon").html("<i class=\'' . esc_js($value) . '\'></i>");
					jQuery("li[data-icons=\'' . esc_js($value) . '\']").addClass("selected");
				});
				jQuery(".icons-list li").click(function() {
                    jQuery(this).attr("class","selected").siblings().removeAttr("class");
                    var icon = jQuery(this).attr("data-icons-tag");
                    icon += " "+jQuery(this).attr("data-icons");
                    jQuery("input[name=\'' . esc_js($settings['param_name']) . '\']").val(icon);
                    jQuery(".preview-icon").html("<i class=\'"+icon+"\'></i>");
                });
				</script>';
			$output .= $font_manager;
			return $output;
		}

		public static function getIconOptions() {
			$fonts = array ();
			$ins = ReduxFrameworkInstances::get_instance();
			$ins = $ins->get_all_instances();
			if (!empty($ins)) {
				$redux_options = array_shift($ins);
				if (is_object($redux_options)) {
					if (isset($redux_options->options["icon_param"][0])) {
						$fonts = $redux_options->options["icon_param"][0];
						if(is_string($fonts)) {
							$fonts = json_decode($fonts, true);
						}
					}
				}
			}
			return $fonts;
		}

		public static function get_font_manager($remote = false) {
			$fonts = self::getIconOptions();
			if(empty($fonts)) {
				$fonts = array();
			}
			$def = IconConfig::getDefaults();
			$fonts = array_merge($fonts, $def);
			$output = '<div class="preview-icon"><i class=""></i></div><input class="search-icon" type="text" placeholder="Search for a suitable icon." />';
			$output .= '<div id="dfd_icon_search">';
			$output .= '<ul class="icons-list dfd_icon">';
			foreach ($fonts as $font => $info) {
				if (!isset($info["active"]) || $info["active"] == false) {
					continue;
				}
				$icon_set = array ();
				$icons = array ();
				if (isset($info["is_default"])) {
					$upload_dir['basedir'] = DFD_EXTENSIONS_PLUGIN_PATH;
				} else {
					$upload_dir = wp_upload_dir();
				}
				$path = trailingslashit($upload_dir['basedir']);
				$file = $path . $info['include'] . '/' . $info['config'];
				include($file);
				if (!empty($icons)) {
					$icon_set = array_merge($icon_set, $icons);
				}
				if (isset($info["is_default"]))
					$set_name = esc_html__('Default Icons', 'dfd-native');
				else
					$set_name = ucfirst($font);
				if (!empty($icon_set)) {
					$output .= '<p><strong>' . $set_name . '</strong></p>';
					$output .= '<li title="no-icon" class="no-icon" data-icons="none" data-icons-tag="none,blank" style="cursor: pointer;"></li>';
					$font = esc_attr($font);
					foreach ($icon_set as $icons) {
						foreach ($icons as $icon) {
							$icon_class = esc_attr($icon['class']);
							$output .= '<li title="' . $icon_class . '" data-icons="' . $font . '-' . $icon_class . '" data-icons-tag="' . esc_attr($icon['tags']) . '">';
							if (isset($info["is_default"]) && $info["is_default"]) {
								$output .= '<i class="' . esc_attr($icon['class']) . '"></i><label class="icon">' . $icon['class'];
							} else {
								$output .= '<i class="' . $font . '-' . $icon_class . '"></i><label class="icon">' . $icon_class;
							}
							//$output .= '<i class="' . $icon_class . ' '.$font.'-'.$icon_class.'"></i><label class="icon">';
							$output .= $icon_class . '</label></li>';
						}
					}
				}
			}
			$output . '</ul>';
			$output .= '<script type="text/javascript">
					jQuery(document).ready(function(){
						setTimeout(function() {
							jQuery(".search-icon").focus();
						}, 1000);
						jQuery(".search-icon").keyup(function(){
							// Retrieve the input field text and reset the count to zero
							var filter = jQuery(this).val(), count = 0;
							// Loop through the icon list
							jQuery(".icons-list li").each(function(){
								// If the list item does not contain the text phrase fade it out
								if (jQuery(this).attr("data-icons-tag").search(new RegExp(filter, "i")) < 0) {
									jQuery(this).fadeOut();
								} else {
									jQuery(this).show();
									count++;
								}
							});
						});
					});
			</script>';
			$output .= '</div>';
			return $output;
		}

		/**
		 * 
		 * @return self
		 */
		public static function getInstance() {
			return self::$theInstance;
		}

		public function valid($ar1, $arr2 = "") {
			$this->validaion_values = isset($ar1[$this->field_name]) ? $ar1[$this->field_name] : '';
			return $ar1;
		}

		public function icon_load($arr1 = "", $arr2 = "") {
			$dir = Redux_Helpers::cleanFilePath(dirname(__FILE__));
			$dir.="/validator/{$this->validate_class}.php";
			return $dir;
		}

		private function includeClases() {
			$components_dir = dirname(__FILE__) . "/config/";
			require_once $components_dir . "icon_config" . ".php";
		}

		// Forces the use of the embeded field path vs what the core typically would use    
		public function overload_field_path($field) {

			return dirname(__FILE__) . '/icon_manager/field_icon_manager.php';
		}

	}

	// class
} // if
