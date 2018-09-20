<?php

if (!defined('ABSPATH')) {
	exit;
}

class Custom_Font_Validator {

	public static $count = array ();
	public $local_fonts;

	function __construct() {
		$this->local_fonts = self::font_list_file();
	}

	/**
	 *
	 * @var Custom_Font_Validator $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public static function validate(&$arr) {
		$arr = self::removeDublicate($arr);
		foreach ($arr as $key => $value) {
			$format = self::checkFormat($value["attachment_id"]);
			if (!$format) {
				unset($arr[$key]);
			}
		}
	}

	public static function removeDublicate($arr) {
		$result_array = array ();
		for ($i = 0; $i < count($arr); $i++) {
//			$result_array[] = $arr[$i];
			$id = $arr[$i]["attachment_id"];
			if (!array_key_exists($id, $result_array)) {
				$result_array[$id] = $arr[$i];
			}
		}
		return $result_array;
	}

	public static function CountCheck($id) {
		if (!isset(Custom_Font_Validator::$count[$id]))
			Custom_Font_Validator::$count[$id] = 0;
		$result = Custom_Font_Validator::$count[$id] ++;
		return $result;
	}

	public static function checkFormat($id) {
		if (isset($id) && !empty($id)) {
			$attach = get_attached_file($id);
			$mime = new MIMETypes();
			$mime_type = $mime->getMimeType($attach);
			unset($mime);
			/* Checek for zip mime type and skip another */
			if (!preg_match("/application\/zip/i", $mime_type)) {
				return false;
			}
		} else {
			return false;
		}
		return true;
	}

	public static function addDefaultFontToArray(&$arr, $values) {
		$res_array = "";
		if (!isset($arr) || empty($arr))
			return $values;
		foreach ($values as $key => $value) {
			foreach ($arr as $def_key => $def_value) {
				if ($value["attachment_id"] == $def_value["attachment_id"]) {
//					$res_array[$def_key] = $def_value;
					unset($arr[$def_key]);
				}
				if (!self::checkIfFontExist($def_value["attachment_id"])) {
					unset($arr[$def_key]);
				}
			}
		}
//		print_r($res_array);
		$res_array = array_merge($values, $arr);
		return $res_array;
	}

	public static function generateDefaultArray($arr) {

		$array = "";
		$result_array = "";
		if (isset($arr["default_values"])) {
			if (!empty($arr["default_values"])) {
				foreach ($arr["default_values"] as $key => $value) {
					$array[] = array (
							"sort" => 1,
							"attachment_id" => $value,
							"thumb" => "/wp-includes/images/media/archive.png",
							"image" => "",
							"height" => "",
							"width" => "",
					);
				}
			}
		}
		return $array;
	}

	/**
	 * 
	 * @return boolean
	 */
	public static function getMainExtensition() {
		$inst = ReduxFramework_extension_custom_font::getInstance();
		if (!isset($inst)) {
			return false;
		}
		return $inst;
	}

	public static function checkIfFontExist($id) {
		if (file_exists(self::getMainExtensition()->upload_dir . $id)) {
			return true;
		}
		return false;
	}

	/**
	 * get all fonts from a folder
	 * @return type
	 */
	public static function font_list_file($folder = "") {
		$fonts = "";
		$dir = self::getMainExtensition()->upload_dir;
		if (!is_dir($dir))
			return false;
		$font_list = scandir($dir);
		foreach ($font_list as $folder_name) { ///ex 732334
			if ($folder_name != '.' && $folder_name != '..') {
				$sub_dir = self::getMainExtensition()->upload_dir . $folder_name;
				$sub_font_list = scandir($sub_dir);
				foreach ($sub_font_list as $sub_folder_name) { //ex icomoon
					if ($sub_folder_name != '.' && $sub_folder_name != '..') {
						$sub_dir_lv3 = self::getMainExtensition()->upload_dir . $folder_name . "/" . $sub_folder_name;
						$sub_font_list_lv3 = scandir($sub_dir_lv3);
						$values = array ();
						if (is_array($fonts)) {
							$font_name = self::urlToName($sub_folder_name);
							if (array_key_exists($font_name, $fonts)) {
								self::remove_folder($dir . $folder_name);
							}
						}
						foreach ($sub_font_list_lv3 as $sub_folder_name_lv3) { ///icomoon.ttf
							if ($sub_folder_name_lv3 != '.' && $sub_folder_name_lv3 != '..') {
								if (!is_dir($sub_folder_name_lv3)) {
									$font_name = self::urlToName($sub_folder_name);
									$values = array_merge($values, array ($sub_folder_name_lv3));
										if(is_string($fonts)){
											$fonts = array();
										}
										$fonts[$font_name] = array (
												"name" => $sub_folder_name,
												"id" => $folder_name,
												"values" => $values,
										);

								}
							}
						}
					}
				}
			}
		}
		$fonts = $fonts ? $fonts : array ();
		return $fonts;
	}

	public function normalizeFolderFontByOne($value) {
		$local_fonts = $this->getLocalFonts();
		$arr2 = array ();
		foreach ($local_fonts as $key => $local_fonts_value) {
			$arr2[] = $local_fonts_value['id'];
		}
		if (!in_array($value['attachment_id'], $arr2)) {
			$path = self::getMainExtensition()->upload_dir . $value['attachment_id'];
			self::remove_folder($path);
			return true;
//			print_r($path);
		}
		return false;
	}

	public function normalizeFolderFont($values) {
		$local_fonts = $this->getLocalFonts();
		$arr1 = array ();
		$arr2 = array ();
		$id_to_remove = "";
//		print_r($values);
		if (!empty($values)) {
			foreach ($values as $value) {
				$arr1[] = $value['attachment_id'];
			}
		}
		if (empty($local_fonts) || is_string($local_fonts))
			return false;
		foreach ($local_fonts as $key => $value) {
			$arr2[] = $value['id'];
		}
		$result = array_diff($arr2, $arr1);
		$result2 = array_diff($arr1, $arr2);

		if (!empty($result)) {
			foreach ($result as $folder_id) {
				$path = self::getMainExtensition()->upload_dir . $folder_id;
				self::remove_folder($path);
			}
		}
//		return $result + $result2;
	}

	public function getLocalFonts() {
		return $this->local_fonts;
	}

	public function hasFont($font_name) {
//		print_r($this->local_fonts);
		$font_name = self::normalizeFontName($font_name);
//		echo "name= " . $font_name;
//		die();
		if (!empty($this->local_fonts)) {
			foreach ($this->local_fonts as $local_name_font => $local_name_font_value) {
				if ($local_name_font == $font_name) {
					return true;
				}
			}
		}
		return false;
	}

//
//	public function getFontByName($font_name) {
//		
//	}

	public static function font_list() {
		$fonts = array();
		$inst = self::instance();
		$local_fonts = $inst->getLocalFonts();
		if (empty($local_fonts) || is_string($local_fonts))
			return false;
		foreach ($local_fonts as $font_name => $font_options) {
			$fonts[$font_name] = array (
					"name" => $font_options["name"],
					"id" => $font_options["id"],
			);
		}
		$fonts = $fonts ? $fonts : array ();
		return $fonts;
	}

	public static function generateFrontFontFace() {
		$inst = self::instance();
		$local_fonts = $inst->getLocalFonts();
		$css = "";
		if (empty($local_fonts) || is_string($local_fonts))
			return $css;
		foreach ($local_fonts as $key_font => $value_font) {
			$css .=" " . self::fontface_css_creator($value_font["name"], $value_font["id"]);
		}
		return $css;
	}

	/**
	 * fontface CSS code creator
	 * @param type $folder_name
	 * @return string
	 */
	public static function fontface_css_creator($folder_name, $folder_id = "") {
		$path = self::getMainExtensition()->upload_dir . $folder_id . "/" . $folder_name;
		$font_name = self::urlToName($folder_name);

		// remove the HTTP/HTTPS for SSL compatibility
		$fixed_enabled = str_replace(array ('http:', 'https:', 'HTTP:', 'HTTPS:'), '', self::getMainExtensition()->upload_dir_url);
		$font_baseurl = $fixed_enabled . $folder_id . "/" . $folder_name . '/';

		// get files name
		$file_list = @scandir($path);
		$css = "";
		if ($file_list) {
			$file_name = self::stringToFilename($file_list[2], true);
			$css = "
@font-face {
	font-family: '" . $font_name . "';
	src: url('" . $font_baseurl . $file_name . ".eot');
	src: url('" . $font_baseurl . $file_name . ".eot?#iefix') format('embedded-opentype'),
		 url('" . $font_baseurl . $file_name . ".woff') format('woff'),
		 url('" . $font_baseurl . $file_name . ".ttf') format('truetype'),
		 url('" . $font_baseurl . $file_name . ".svg#" . $file_name . "') format('svg');
}
	";
		}


		return $css;
	}

// get filename without extension
	public static function stringToFilename($string, $raw_name = false) {
		$pos = strrpos($string, '.');
		$name = substr($string, 0, $pos);
		if (!$raw_name) {
			$name = ucwords(str_replace('_', ' ', $name));
		}
		return $name;
	}

	public function normalizeFontName($font_name) {
		return ucwords(str_replace('_', ' ', $font_name));
	}

	/**
	 *  normalize a url string
	 * @param type $string
	 * @return type
	 */
	public static function urlToName($string) {
		$string = ucwords(str_replace('_', ' ', $string));
		return $string;
	}

	/**
	 * 
	 * @param type $tmp_folder
	 * @param type $new_folder
	 * @return boolean
	 */
	public static function copy_zip_fontfiles($tmp_folder, $new_folder) {
		// create
		$new_folder = self::normalizeFileName($new_folder);
		mkdir($new_folder, 0777, true);
		if (!file_exists($tmp_folder) || !file_exists($new_folder)) {
			return false;
		}

		$file_list = scandir($tmp_folder);
		foreach ($file_list as $file) {
			$ext = strtolower(self::stringToExt($file));
			if ($ext == '.ttf' || $ext == '.otf' || $ext == '.woff' || $ext == '.eot' || $ext == '.svg') {
				if (!copy($tmp_folder . '/' . $file, $new_folder . '/' . $file)) {
					return false;
					break;
				}
			}
		}
		self::remove_folder($tmp_folder);

		return true;
	}

	public static function normalizeFileName($name) {
		$string = ucwords(str_replace(' ', '_', $name));
		return $string;
	}

	/**
	 * get the name of a font from a package
	 * @param type $folder
	 * @return type
	 */
	public static function get_zip_fontname($folder) {
		$font_name = false;
		$file_list = scandir($folder . "/");
		foreach ($file_list as $file) {
			$ext = strtolower(self::stringToExt($file));
			if ($ext == '.ttf' || $ext == '.otf') {
				$fontinfo = getFontInfo($folder . '/' . $file);
				if (isset($fontinfo[6])) {
					$font_name = $fontinfo[6];
				} else {
					if (isset($fontinfo[4])) {
						$font_name = $fontinfo[4];
					} else {
						$font_name = "font_" . uniqid();
					}
				}
				$font_name = str_replace(array ("&", "#", " ", "\s", "\n", "\r", "!", "+", "`", "~", "'", "\"", ".", ",", "<", ">", "@", "$", "%", "^", "*", ";", ":"), "", $font_name);
				$font_name = trim($font_name);
				$font_name = preg_replace('/[^a-z1-9]/i', "", $font_name);
				break;
			}
		}
		return $font_name;
	}

	/**
	 * remove a folder and its contents
	 * @param type $path
	 * @return boolean
	 */
	public static function remove_folder($path) {
		if ($objs = @glob($path . "/*")) {
			foreach ($objs as $obj) {
				@is_dir($obj) ? self::remove_folder($obj) : @unlink($obj);
			}
		}
		@rmdir($path);
		return true;
	}

	/**
	 * get file extension from a filename
	 * @param type $string
	 * @return type
	 */
	public static function stringToExt($string) {
		$pos = strrpos($string, '.');
		$ext = strtolower(substr($string, $pos));
		return $ext;
	}

}
