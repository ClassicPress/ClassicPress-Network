<?php

class IconConfig {

	function __construct() {
		
	}

	public static function initSettings(&$obj) {
		$obj->paths = wp_upload_dir();
		$obj->paths['fonts'] = 'dfd_fonts';
		$obj->paths['temp'] = trailingslashit($obj->paths['fonts']) . 'dfd_temp';
		$obj->paths['fontdir'] = trailingslashit($obj->paths['basedir']) . $obj->paths['fonts'];
		$obj->paths['tempdir'] = trailingslashit($obj->paths['basedir']) . $obj->paths['temp'];
		$obj->paths['fonturl'] = set_url_scheme(trailingslashit($obj->paths['baseurl']) . $obj->paths['fonts']);
		$obj->paths['tempurl'] = trailingslashit($obj->paths['baseurl']) . trailingslashit($obj->paths['temp']);
		$obj->paths['config'] = 'charmap.php';
	}

	public static function setDefaults() {
		$GLOBALS["dfd_icon_defaults_pack"] = array (
				"dfd_icon_set" => array (
						'main' => trailingslashit('assets/fonts'),
						'include' => trailingslashit('assets/fonts') . 'dfd_icon_set',
						'folder' => trailingslashit('assets/fonts') . 'dfd_icon_set',
						'style' => 'dfd_icon_set' . '/' . 'dfd_icon_set' . '.css',
						'config' => 'charmap.php',
						'is_default' => true,
						'active' => true
				)
		);
	}

	public static function getDefaults() {
		return $GLOBALS["dfd_icon_defaults_pack"];
	}

}
