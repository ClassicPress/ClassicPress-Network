<?php

class Dfd_Contact_Form_Select extends Dfd_Contact_Form_Input {

    public $name = "Drop Down";
    public $unic_name = "drop_down";

    protected function property() {
        return array(
                "required" => array(
                        "name" => "Field type",
                        "type" => "checkbox",
                        "options" => array(
                                "Required field" => "1",
                        ),
                ),
                 "name" => array(
                        "type" => "text",
                        "name" => "Label",
                ),
                "options" => array(
                        "type" => "textarea",
                        "name" => "Options",
                ),
                "insert_blank_item" => array(
                        "name" => "",
                        "type" => "checkbox",
                        "options" => array(
                                "Insert a blank item as the first option" => "1",
                        ),
                ),
//                "allow_multi_select" => array(
//                        "name" => "",
//                        "type" => "checkbox",
//                        "options" => array(
//                                "Allow multiple selections" => "1"
//                        ),
//                ),
        );
    }

    function __construct() {
        
    }

    public function toHtml($settings = "", $index = "") {
        extract($settings);
        $globset = Dfd_contact_form_settings::instance()->getAllSettings();

        $result = "";
        $options = isset($options) ? esc_attr($options) : "";
        $required = isset($settings["required-1"]) ? esc_attr($settings["required-1"]) : "";
        $required_text = $required ? $this->requiredText() : "";
        $show_label_text = isset($globset["show_label_text"]) ? esc_attr($globset["show_label_text"]) : "";
        $name = isset($settings["name"]) ? esc_attr($settings["name"]) : "";

        $opt_val = $this->explodeSettings($options);
        if (is_array($opt_val) && !empty($opt_val)) {
            if ($show_label_text == "on") {
                $result .='<span class="select_elem label_text"><label>' . $name ."</label>". $required_text . '</span>';
            }
            $result .= '<select  name="' . $this->unic_name . '-' . $index . '-' . uniqid() . '">';
            if (isset($settings["insert_blank_item-1"])) {
                $result.='<option value="">Select Value</option>';
            }
            foreach ($opt_val as $key => $value) {
                if ($value) {
                    $result .= '<option value="' . $value . '">' . $value . '</option>';
                }
            }
            $result .= '</select>';
        }
        return $result;
    }

    public function innerValidate() {

        $name = $this->submission->getCur_active_field();
        $params = $this->submission->getField($name["name"]);
        $param = $params["param"];
        if (isset($param["required-1"])) {
            if ($params["value"] == "") {
                $this->addError($name["name"], __('This field is required', 'dfd-native'));
            }
        }
        $this->setResult($this->getErrors());
        $this->setGlobalError();
    }

}
