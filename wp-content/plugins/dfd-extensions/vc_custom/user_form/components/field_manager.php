<?php

class Dfd_Contact_Form_FieldManager {

	private $_fields = array ();

	function __construct() {
		
	}

	public function fillfieldsForBuilder($layoutVal, $template_name) {
		$decodes_values = json_decode($layoutVal, true);

		if (empty($decodes_values))
			return false;
		$content = "";
		$set = Dfd_contact_form_settings::instance()->getAllSettings();
		$layout_builder_row = $set["layout_builder"];
		$layout = str_replace("{1+}", "[", $layout_builder_row);
		$layout = str_replace("{+1}", "]", $layout);

		$layout_decoded = json_decode($layout, true);
		$layout_builder = new Dfd_Contact_Form_Layout_Builder();
		$content = $layout_builder->generate($layout_decoded);
		
		preg_match_all("/{{field}}/", $content, $matches);
		if (is_array($matches[0]) && !empty($matches[0])) {
			$count = count($matches[0]);
		}
		if ($count) {
			foreach ($layout_decoded as $key_row => $row) {
				$columns = $row["presets"];
				foreach ($columns as $key_col => $col) {
					$template_key = ($key_row + 1) . "-" . ($key_col + 1);
					if (array_key_exists($template_key, $decodes_values)) {
						$property = $decodes_values[$template_key];
						if (is_array($property)) {
							foreach ($property as $name_property => $value) {
								$this->setField($name_property . "-" . $template_key, $value);
							}
						}
					}
				}
			}
		}
	}

	public function fillfields($layoutVal, $template_name) {
		$decodes_values = json_decode($layoutVal, true);


		if (empty($decodes_values))
			return false;
		$file = Dfd_User_Form_template_manager::instance()->getPathTempleteByName($template_name);
		$content = "";

		if ($file && $template_name) {
			$content = file_get_contents($file);
			preg_match_all("/{{field}}/", $content, $matches);
			if (is_array($matches[0]) && !empty($matches[0])) {
				$count = count($matches[0]);
			}
			if ($count) {
				for ($i = 1; $i <= $count; $i++) {
					if (array_key_exists($i, $decodes_values)) {
						$property = $decodes_values[$i];
						if (is_array($property)) {
							foreach ($property as $name_property => $value) {
								$this->setField($name_property . "-" . $i, $value);
							}
						}
					}
				}
			}
		}
	}

	public function populateForBuilder($atts) {
		$template_name = "form_builder";
		$layout = str_replace("{1+}", "[", $atts["layout_builder"]);
		$layout = str_replace("{+1}", "]", $layout);

		$layout_decoded = json_decode($layout, true);
		$layout_builder = new Dfd_Contact_Form_Layout_Builder();

		$template = str_replace("\n", "{+}", $atts["custom_template"]);
		$decodes_values = json_decode($template, true);
		if (empty($decodes_values))
			return false;
		$content = "";
		if (!session_id()) {
			session_start();
		}
		$content = $layout_builder->generate($layout_decoded, $atts);
		$form_id = uniqid();

		$settings = Dfd_contact_form_settings::instance();
		$settings->setformId($form_id);
		$settings->setValuesForm($atts);

		preg_match_all("/{{field}}/", $content, $matches);

		if (is_array($matches[0]) && !empty($matches[0])) {
			$count = count($matches[0]);
		}
		if ($count) {
			foreach ($layout_decoded as $key_row => $row) {
				$columns = $row["presets"];
				foreach ($columns as $key_col => $col) {
					$template_key = ($key_row + 1) . "-" . ($key_col + 1);
					if (array_key_exists($template_key, $decodes_values)) {
						$property = $decodes_values[$template_key];
						if (is_array($property)) {
							foreach ($property as $name_property => $value) {
								$this->setField($name_property . "-" . $template_key, $value);
								$replace_text = Dfd_User_Input::instance()->populateValByType($name_property, $value, $template_key);
								$content = preg_replace("/{{field}}/", $replace_text, $content, 1);
							}
						}
					}else{
						$content = preg_replace("/{{field}}/", "", $content, 1);
					}
				}
			}

			$set = $settings->getAllSettings();
			$_SESSION[$template_name . "_" . $form_id] = $template;
			$nonce = $_SESSION["dfd_nonce_contact_form_" . $form_id] = $form_id;
			$hidden = "";
			$hidden .= "<input type='hidden' name='template' value='$template_name'>";
			$hidden .= "<input type='hidden' name='formid' value='$form_id'>";
			$hidden .= wp_nonce_field("n_" . $nonce, 'dfd_nonce_' . $form_id, true, false);
			$content = preg_replace("/{{hidden}}/", $hidden, $content, 1);
		}
		return $content;
	}

	public function populate($check_layout_template_layout, $template_name, $atts) {
		$check_layout_template_layout = str_replace("\n", "{+}", $check_layout_template_layout);
		$decodes_values = json_decode($check_layout_template_layout, true);
		if (empty($decodes_values))
			return false;
		$file = Dfd_User_Form_template_manager::instance()->getPathTempleteByName($template_name);
		$content = "";
		if (!session_id()) {
			session_start();
		}
		$form_id = uniqid();

		$settings = Dfd_contact_form_settings::instance();
		$settings->setformId($form_id);
		$settings->setValuesForm($atts);

		if ($file && $template_name) {


			$content = file_get_contents($file);
			preg_match_all("/{{field}}/", $content, $matches);
			if (is_array($matches[0]) && !empty($matches[0])) {
				$count = count($matches[0]);
			}
			if ($count) {
				for ($i = 1; $i <= $count; $i++) {
					if (array_key_exists($i, $decodes_values)) {
						$property = $decodes_values[$i];
						if (is_array($property)) {
							foreach ($property as $name_property => $value) {
								$this->setField($name_property . "-" . $i, $value);
								$replace_text = Dfd_User_Input::instance()->populateValByType($name_property, $value, $i);
								$content = preg_replace("/{{field}}/", $replace_text, $content, 1);
							}
						}
					} else {
						$content = preg_replace("/{{field}}/", "", $content, 1);
					}
				}

				$set = $settings->getAllSettings();
				$_SESSION[$template_name . "_" . $form_id] = $check_layout_template_layout;
				$nonce = $_SESSION["dfd_nonce_contact_form_" . $form_id] = $form_id;
				$hidden = "";
				$hidden .= "<input type='hidden' name='template' value='$template_name'>";
				$hidden .= "<input type='hidden' name='formid' value='$form_id'>";
				$hidden .= wp_nonce_field("n_" . $nonce, 'dfd_nonce_' . $form_id, true, false);
				$content = preg_replace("/{{hidden}}/", $hidden, $content, 1);
			}
		}
		return $content;
	}

	public function isfieldExist($key) {
		if (array_key_exists($key, $this->_fields)) {
			return true;
		}
		return false;
	}

	public function setField($key, $value) {
		$this->_fields[$key] = $value;
	}

	public function getField($key) {
		if (isset($this->_fields[$key])) {
			return $this->_fields[$key];
		}
		return false;
	}

	public function getAllFields() {
		return $this->_fields;
	}

}
