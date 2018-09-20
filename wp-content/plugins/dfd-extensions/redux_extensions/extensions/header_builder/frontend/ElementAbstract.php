<?php
if (!defined('ABSPATH'))
	exit;

abstract class DfdHeaderBuilderElementAbstract {

	protected $template = "";
	protected $option_name = "";
	protected $_check = false;
	protected $path = 'templates/header/block';

	function __construct() {
	}



	public function getUseCheck() {
		return $this->_check;
	}

	/**
	 * 
	 * @param boolean $val
	 */
	public function setUseCheck($val) {
		$this->_check = (bool) $val;
	}

	protected function get_value($option_name) {
		global $dfd_native;

		$value = '';
		/**
		 * @todo Chanege header 5 to main
		 */
		$header_style = "5";

		if (isset($dfd_native[$option_name . '_' . $header_style]) && $dfd_native[$option_name . '_' . $header_style] != '') {
			$value = $dfd_native[$option_name . '_' . $header_style];
		}

		return $value;
	}

	protected function show_element($option = "") {
		global $dfd_native;

		$show = true;
		$option = trim($option);
		if ($option == "") {
			$option = $this->option_name;
		}

		if (isset($dfd_native[$option]) && $dfd_native[$option] == 'off') {
			$show = false;
		}

//		return $show;
		return true;
	}

	protected function wrapper() {
		get_template_part($this->path, $this->template);
	}

	public function render() {
		if ($this->template != "" && $this->path != "") {
			if ($this->show_element()) {
				$this->wrapper();
			}
		}
	}

}
