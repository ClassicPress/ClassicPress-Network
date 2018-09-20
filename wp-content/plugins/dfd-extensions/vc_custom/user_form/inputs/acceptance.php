<?php

class Dfd_Contact_Form_acceptance extends Dfd_Contact_Form_Input {

    public $name = "acceptance";
    public $unic_name = "acceptance";

    protected function property() {
        return array(
                ///Use required-[index] to get this field value
                "checkthis" => array(
                        "name" => "checkthis",
                        "type" => "checkbox",
                        "options" => array(
                                "Make this checkbox checked by default" => "1"
                        ),
                ),
                "name" => array(
                        "type" => "text",
                        "name" => "Label",
                ),
        );
    }

    function __construct() {
        
    }

    public function toHtml($options = "", $index = "") {
//        echo print_r($options);
        $settings = Dfd_contact_form_settings::instance()->getAllSettings();
//        print_r($settings);
        $result = "<span class='checkboxgroup dfd_acceptance_group'>";
        $checkthis = isset($options["checkthis-1"]) ? esc_attr($options["checkthis-1"]) : "";
        $checked = $checkthis ? "checked" : "";

        $name = isset($options["name"]) ? esc_attr($options["name"]) : "";

        $result .= '<span class="checkbox"><input type="checkbox" name="' . $this->unic_name . '-' . $index . '"'
                  . $checked . '><span class="c_value">' . $name . '</span></span>';
        return $result."</span>";
    }

    public function innerValidate() {
        $name = $this->submission->getCur_active_field();
        $params = $this->submission->getField($name["name"]);
        $param = $params["param"];
//        print_r($params);
        if ($params["value"] == "") {
            $this->addError($name["name"], __('Need acceptance', 'dfd-native'));
        }
        $this->setResult($this->getErrors());
        $this->setGlobalError();
    }

}
