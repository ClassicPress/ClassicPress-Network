<?php

class Dfd_Contact_Form_Checkbox extends Dfd_Contact_Form_Input {

	public $name = "checkbox";
	public $unic_name = "checkbox_name";

	protected function property() {
		return array (
				"required" => array (
						"name" => "Field type",
						"type" => "checkbox",
						"options" => array (
								"Required field" => "1",
						),
				),
				"options" => array (
						"type" => "textarea",
						"name" => "Options",
				),
		);
	}

	function __construct() {
		
	}

	public function toHtml($settings = "", $index = "") {
		extract($settings);
		if (!isset($options))
			return "";
		$result = "<span class='checkboxgroup dfd_cf_checkbox_group'>";
		$options = isset($options) ? esc_attr($options) : "";
		$opt_val = $this->explodeSettings($options);
		$unic_id = uniqid();
		if (is_array($opt_val) && !empty($opt_val)) {
			foreach ($opt_val as $key => $value) {
				$result .='<span class="checkbox"><input type="checkbox" name="' . $this->unic_name . '-' . $index . '-' . $unic_id . '[]" value="' . $value . '"><span class="c_value">' . $value . '</span></span>';
			}
		}

//        $result .= "</ul>";
		return $result . "</span>";
	}

	public function innerValidate() {

		$name = $this->submission->getCur_active_field();
		$params = $this->submission->getField($name["name"]);
		$param = $params["param"];
		$values = json_decode($params["value"]);
		if (isset($param["required-1"])) {
			if (empty($values)) {
				$this->addError($name["name"], __('Check one or more options', 'dfd-native'));
			}
		}
		$this->setResult($this->getErrors());
		$this->setGlobalError();
	}

}
