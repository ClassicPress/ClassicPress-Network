<?php

if (!defined('ABSPATH')) {
	exit;
}
if (!class_exists('Redux_Validation_icon_load')) {

	class Redux_Validation_icon_load {
		/* @var $parent ReduxFramework */

		public $field;
		public $paramValue;
		public $parent;
		public $value;
		public $current;
		public $attachment_id_file;
		/* @var $inst ReduxFramework_extension_custom_font */
		private $inst;
		public static $valid_helper;
		public $count;

		/**
		 * Field Constructor.
		 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
		 *
		 */
		function __construct($parent, $field, &$value, $current) {
			$this->parent = $parent;
			$this->field = $field;
			$this->current = $current;
			$this->paramValue = $value;
			$import = false;
			IconConfig::initSettings($this);

			if (is_array($value)) {
				if (isset($value["select"]) && trim($value["select"]) != "") {
					$this->addSelectIcon($value["select"]);
				}
				if (isset($value["delete"]) && trim($value["delete"]) != "") {
					$del_val = json_decode($value["delete"]);
					if (is_array($del_val)) {
						foreach ($del_val as $key => $v) {
							$proccesed_value = $this->remove_zipped_font($v);
						}
					}
					$field_id = $field["id"];
					if (isset($parent->options[$field_id])) {
//						unset($value);
						$this->value = $proccesed_value;
					}
//					return;
				}
				if (isset($value["id"]) && trim($value["id"]) != "") {
					$this->add_zipped_font();
				} else {
					/* Import Options */
//					if (isset($value[0]) && is_string($value[0])) {
//						$this->paramValue = $value[0];
//						$this->import();
//						$import = true;
//					}
				}
			} else {
				/* Import demo Data */
				if (is_string($value) && $value != "") {
					$this->import();
					$import = true;
				}
			}
			if ((!isset($value) || $value == '' || empty($value) || empty($value["id"])) && !$import) {
				if(isset($field["id"])){
					$field_id = $field["id"];
					if (isset($parent->options[$field_id])) {
	//					if (isset($parent->options[$field_id][0]["icons"])) {
	//						$this->value = $parent->options[$field_id][0]["icons"];
	//						return;
	//					}
						if (isset($parent->options[$field_id][0])) {
							$this->value = $parent->options[$field_id][0];
						}
					}
				}
				return;
			}

			if (!empty($this->error)) {
				$field_id = isset($field["id"]) ? $field["id"] : "";
				if (isset($parent->options[$field_id])) {
					$this->value = $parent->options[$field_id][0];
				}
			}
		}

		public function addSelectIcon($val) {
			$field_id = $this->field["id"];
			$sel = json_decode($val, true);
			$cur = json_decode($this->current, true);
			foreach ($sel["ToActive"] as $key => $value) {
				if (isset($cur[$value])) {
					$cur[$value]["active"] = true;
				}
			}
			foreach ($sel["ToInActive"] as $key => $value) {
				if (isset($cur[$value])) {
					$cur[$value]["active"] = false;
				}
			}
			$this->parent->options[$field_id][0] = json_encode($cur);
		}

		function remove_zipped_font($del_val) {
			//get the file path of the zip file
			$font = $del_val;
			$list = $this->load_iconfont_list();
			$delete = isset($list[$font]) ? $list[$font] : false;
			if ($delete) {
				$this->delete_folder($delete['include']);
				return $this->remove_font($font);
			}
			$this->field["msg"] = "Was not able to remove Font";
			$this->error = $this->field;
			return false;
		}

		public function remove_font($font) {

			$field_id = $this->field["id"];
			if (isset($this->parent->options[$field_id])) {
				$prev_options = $this->parent->options[$field_id][0];
				$prev_options = json_decode($prev_options, true);
				if (array_key_exists($font, $prev_options)) {
					unset($prev_options[$font]);
				}
				if (is_array($prev_options) && !empty($prev_options)) {
					$prev_options = json_encode($prev_options);
				} else {
					$prev_options = "";
				}
				$this->value = $prev_options;
				$this->parent->options[$field_id][0] = $prev_options;
				return $prev_options;
			}
		}

		public function load_iconfont_list() {
			$field_id = $this->field["id"];
			$options = $this->parent->options[$field_id][0];
			$options = json_decode($options, true);
			$extra_fonts = $options;
			if (empty($extra_fonts))
				$extra_fonts = array ();
			$font_configs = $extra_fonts;

			$upload_dir = wp_upload_dir();
			$path = trailingslashit($upload_dir['basedir']);
			$url = trailingslashit($upload_dir['baseurl']);
			foreach ($font_configs as $key => $config) {
				if (empty($config['full_path'])) {
					$font_configs[$key]['include'] = $path . $font_configs[$key]['include'];
					$font_configs[$key]['folder'] = $url . $font_configs[$key]['folder'];
				}
			}
			return $font_configs;
		}

		function import() {
			$this->value = "";
			$this->current = "";
			if (!is_string($this->paramValue)) {
				return false;
			}
			$icons = json_decode($this->paramValue, true);
			if (is_array($icons)) {
				foreach ($icons as $icon_name => $icon_value) {
					$id = isset($icon_value["attachment_id"]) ? (int) $icon_value["attachment_id"] : false;
					if ($id === false) {
						continue;
					}
					if (is_string($this->paramValue)) {
						$this->paramValue = array ();
						$this->paramValue["id"] = $id;
					} else {
						if (is_array($this->paramValue)) {
							$this->paramValue["id"] = $id;
						}
					}
					$this->add_zipped_font();
				}
			}
		}

		function add_zipped_font() {

//			$cap = apply_filters('dfd_file_upload_capability', 'update_plugins');
//			if (!current_user_can($cap)) {
//				$this->field["msg"] = "Using this feature is reserved for Super Admins. You unfortunately don't have the necessary permissions.";
//				$this->error = $this->field;
//				return false;
//			}
			//get the file path of the zip file
			$attachment = $this->paramValue["id"];
			$this->attachment_id_file = $attachment;
			$path = realpath(get_attached_file($attachment));
			try {
				$unzipped = $this->zip_flatten($path, array ('\.eot', '\.svg', '\.ttf', '\.woff', '\.json', '\.css'));
			} catch (Exception $exc) {
				$this->field["msg"] = $exc->getMessage();
				$this->error = $this->field;
				return false;
			}

//			// if we were able to unzip the file and save it to our temp folder extract the svg file
			if ($unzipped) {
				$this->create_config();
			}
			//if we got no name for the font dont add it and delete the temp folder
			if (!isset($this->font_name)) {
				return false;
			}
			if ($this->font_name == 'unknown') {
				$this->delete_folder($this->paths['tempdir']);
				$this->field["msg"] = "Was not able to retrieve the Font name from your Uploaded Folder";
				$this->error = $this->field;
				return false;
			}
		}

		//extract the zip file to a flat folder and remove the files that are not needed
		function zip_flatten($zipfile, $filter) {
//			@ini_set('memory_limit', apply_filters('admin_memory_limit', WP_MAX_MEMORY_LIMIT));
			if (is_dir($this->paths['tempdir'])) {
				$this->delete_folder($this->paths['tempdir']);
				$tempdir = $this->dfd_backend_create_folder($this->paths['tempdir'], false);
			} else {
				$tempdir = $this->dfd_backend_create_folder($this->paths['tempdir'], false);
			}
			//$fontdir = dfd_backend_create_folder($this->paths['fontdir'], false);
			if (!$tempdir) {
				$this->field["msg"] = 'Wasn\'t able to create temp folder';
				$this->error = $this->field;
				return false;
			}
			$zip = new ZipArchive;
			if ($zip->open($zipfile)) {
				for ($i = 0; $i < $zip->numFiles; $i++) {
					$entry = $zip->getNameIndex($i);
					if (!empty($filter)) {
						$delete = true;
						$matches = array ();
						foreach ($filter as $regex) {
							preg_match("!" . $regex . "!", $entry, $matches);
							if (!empty($matches)) {
								$delete = false;
								break;
							}
						}
					}
					if (substr($entry, -1) == '/' || !empty($delete))
						continue; // skip directories and non matching files
					$fp = $zip->getStream($entry);
					$ofp = fopen($this->paths['tempdir'] . '/' . basename($entry), 'w');
					if (!$fp) {
						$this->field["msg"] = 'Unable to extract the file.';
						$this->error = $this->field;
						return false;
					}
					while (!feof($fp))
						fwrite($ofp, fread($fp, 8192));
					fclose($fp);
					fclose($ofp);
				}
				try {
					@$zip->close();
				} catch (Exception $exc) {
					$this->field["msg"] = $exc->getMessage();
					$this->error = $this->field;
					return false;
				}
			} else {
				$this->field["msg"] = 'Wasn\'t able to work with Zip Archive';
				$this->error = $this->field;
				return false;
			}
			return true;
		}

//iterate over xml file and extract the glyphs for the font
		function create_config() {
			$this->json_file = $this->find_json();
			$this->svg_file = $this->find_svg();
			if (empty($this->json_file) || empty($this->svg_file)) {
				if (!is_array($this->field)) {
					$this->field = array ();
				}
				if (!isset($this->field["mag"])) {
					$this->field["mag"] = "";
				}
				$this->delete_folder($this->paths['tempdir']);
				$this->field["msg"] = 'selection.json or SVG file not found. Was not able to create the necessary config files';
				$this->error = $this->field;
				return false;
			}
			//$response 	= wp_remote_get( $this->paths['tempurl'].$this->svg_file );
			$response = wp_remote_fopen(trailingslashit($this->paths['tempurl']) . $this->svg_file);
			//if wordpress wasnt able to get the file which is unlikely try to fetch it old school
			$json = file_get_contents(trailingslashit($this->paths['tempdir']) . $this->json_file);
			if (empty($response))
				$response = file_get_contents(trailingslashit($this->paths['tempdir']) . $this->svg_file);
			if (!is_wp_error($json) && !empty($json)) {
				$xml = simplexml_load_string($response);
				if (!is_object($xml->defs->font)) {
					$this->field["msg"] = 'Incorect file. Maybe file no contents icon';
					$this->error = $this->field;
					return false;
				}
				$font_attr = $xml->defs->font->attributes();
				$glyphs = $xml->defs->font->children();
				$this->font_name = (string) $font_attr['id'];
				$unicodes = array ();
				foreach ($glyphs as $item => $glyph) {
					if ($item == 'glyph') {
						$attributes = $glyph->attributes();
						$unicode = (string) $attributes['unicode'];
						array_push($unicodes, $unicode);
					}
				}
				$font_folder = trailingslashit($this->paths['fontdir']) . $this->font_name;
//				if (is_dir($font_folder)) {
//					$this->delete_folder($this->paths['tempdir']);
//					$this->field["msg"] = "It seems that the font with the same name is already exists! Please upload the font with different name.";
//					$this->error = $this->field;
//					return false;
//				}
				$file_contents = json_decode($json);
				if (!isset($file_contents->IcoMoonType)) {
					$this->delete_folder($this->paths['tempdir']);
					$this->field["msg"] = 'Uploaded font is not from IcoMoon. Please upload fonts created with the IcoMoon App Only.';
					$this->error = $this->field;
					return false;
				}
				$icons = $file_contents->icons;
				unset($unicodes[0]);
				$n = 1;
				foreach ($icons as $icon) {
					$icon_name = $icon->properties->name;
					$tags = implode(",", $icon->icon->tags);
					$this->json_config[$this->font_name][$icon_name] = array (
							"class" => str_replace(' ', '', $icon_name),
							"tags" => $tags,
							"unicode" => $unicodes[$n]
					);
					$n++;
				}
				if (!empty($this->json_config) && $this->font_name != 'unknown') {
					$this->write_config();
					$this->re_write_css();
					$this->rename_files();
					$this->rename_folder();
					$this->add_font();
				}
			}
			return false;
		}

//finds the json file we need to create the config
		function find_json() {
			$files = scandir($this->paths['tempdir']);
			foreach ($files as $file) {
				if (strpos(strtolower($file), '.json') !== false && $file[0] != '.') {
					return $file;
				}
			}
		}

		//finds the svg file we need to create the config
		function find_svg() {
			$files = scandir($this->paths['tempdir']);
			foreach ($files as $file) {
				if (strpos(strtolower($file), '.svg') !== false && $file[0] != '.') {
					return $file;
				}
			}
		}

//delete a folder
		function delete_folder($new_name) {
			//delete folder and contents if they already exist
			if (is_dir($new_name)) {
				$objects = scandir($new_name);
				foreach ($objects as $object) {
					if ($object != "." && $object != "..") {
						unlink($new_name . "/" . $object);
					}
				}
				reset($objects);
				rmdir($new_name);
			}
		}

//writes the php config file for the font
		function write_config() {
			$charmap = $this->paths['tempdir'] . '/' . $this->paths['config'];
			$handle = @fopen($charmap, 'w');
			if ($handle) {
				fwrite($handle, '<?php $icons = array();');
				foreach ($this->json_config[$this->font_name] as $icon => $info) {
					if (!empty($info)) {
						$delimiter = "'";
						fwrite($handle, "\r\n" . '$icons[\'' . $this->font_name . '\'][' . $delimiter . $icon . $delimiter . '] = array("class"=>' . $delimiter . $info["class"] . $delimiter . ',"tags"=>' . $delimiter . $info["tags"] . $delimiter . ',"unicode"=>' . $delimiter . $info["unicode"] . $delimiter . ');');
					} else {
						$this->delete_folder($this->paths['tempdir']);
						$this->field["msg"] = 'Was not able to write a config file';
						$this->error = $this->field;
						return false;
					}
				}
				fclose($handle);
			} else {
				$this->delete_folder($this->paths['tempdir']);
				$this->field["msg"] = 'Was not able to write a config file';
				$this->error = $this->field;
				return false;
			}
		}

		function re_write_css() {
			$style = $this->paths['tempdir'] . '/style.css';
			$file = @file_get_contents($style);
			if ($file) {
				$str = str_replace('fonts/', '', $file);
				$str = str_replace('icon-', $this->font_name . '-', $str);
				$str = str_replace('.icon {', '[class^="' . $this->font_name . '-"], [class*=" ' . $this->font_name . '-"] {', $str);

				/* remove comments */
				$str = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $str);

				/* remove tabs, spaces, newlines, etc. */
				$str = str_replace(array ("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $str);

				@file_put_contents($style, $str);
			} else {
				$this->field["msg"] = 'Unable to write css. Upload icons downloaded only from icomoon';
				$this->error = $this->field;
				return false;
			}
		}

		function rename_files() {
			$extensions = array ('eot', 'svg', 'ttf', 'woff', 'css');
			$folder = trailingslashit($this->paths['tempdir']);
			foreach (glob($folder . '*') as $file) {
				$path_parts = pathinfo($file);
				if (strpos($path_parts['filename'], '.dev') === false && in_array($path_parts['extension'], $extensions)) {
					if ($path_parts['filename'] !== $this->font_name)
						rename($file, trailingslashit($path_parts['dirname']) . $this->font_name . '.' . $path_parts['extension']);
				}
			}
		}

		//rename the temp folder and all its font files
		function rename_folder() {
			$new_name = trailingslashit($this->paths['fontdir']) . $this->font_name;
			//delete folder and contents if they already exist
			$this->delete_folder($new_name);
			if (rename($this->paths['tempdir'], $new_name)) {
				return true;
			} else {
				$this->delete_folder($this->paths['tempdir']);
				$this->field["msg"] = "Unable to add this font. Please try again.";
				$this->error = $this->field;
				return false;
			}
		}

		function add_font() {
			$fonts = (isset($this->current) && !empty($this->current) ) ? $this->current : $this->paramValue;
			$fonts = $fonts != "" && !is_array($fonts) ? json_decode($fonts, true) : array ();
			if (empty($fonts) && !is_array($this->paramValue)) {
				$fonts = json_decode($this->paramValue, true);
			}
			if (empty($fonts) || !is_array($fonts))
				$fonts = array ();
			$fonts[$this->font_name] = array (
					'include' => trailingslashit($this->paths['fonts']) . $this->font_name,
					'folder' => trailingslashit($this->paths['fonts']) . $this->font_name,
					'style' => $this->font_name . '/' . $this->font_name . '.css',
					'config' => $this->paths['config'],
					'attachment_id' => $this->attachment_id_file,
					'active' => true
			);

//			unset($this->value);
			$this->value = json_encode($fonts, JSON_HEX_QUOT);
//			$this->value["icons"] = json_encode($fonts,JSON_HEX_QUOT);
//			$this->value = json_encode($fonts,JSON_UNESCAPED_SLASHES );
//			update_option('dfd_fonts', $fonts);
		}

		function dfd_backend_create_folder(&$folder, $addindex = true) {
			if (is_dir($folder) && $addindex == false)
				return true;
			$created = wp_mkdir_p(trailingslashit($folder));
			@chmod($folder, 0777);
			if ($addindex == false)
				return $created;
			$index_file = trailingslashit($folder) . 'index.php';
			if (file_exists($index_file))
				return $created;

			$handle = @fopen($index_file, 'w');
			if ($handle) {
				fwrite($handle, "<?php\r\necho 'Sorry, browsing the directory is not allowed!';\r\n?>");
				fclose($handle);
			}
			return $created;
		}

	}

}