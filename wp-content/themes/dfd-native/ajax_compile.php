<?php
if (session_id() == "" || !session_id()) {
			@session_start();
		}

$result = "";
$dir = __DIR__;
$path_to_dir = "/inc/lib/CompileLess/";
$class_to_inc = array (
		$dir . $path_to_dir . "CompileLess.php",
		$dir . $path_to_dir . "ajaxCompileLess.php",
		$dir . "/inc/lessc.inc.php"
);
foreach ($class_to_inc as $class) {
	if (!is_file($class)) {
		echo json_encode(array ("Not found file $class"));
		return false;
	}
	require_once $class;
}

new AjaxCompileLess($dir);

