<?php

class Dfd_Contact_Form_Email extends Dfd_Contact_Form_Input {

    public $name = "email";
    public $unic_name = "email";

    protected function property() {
        return array(
                ///Use required-[index] to get this field value
                "required" => array(
                        "name" => "Field type",
                        "type" => "checkbox",
                        "options" => array(
                                "Required field" => "1"
                        ),
                ),
                "name" => array(
                        "type" => "text",
                        "name" => "Label",
                ),
                "def_value" => array(
                        "type" => "text",
                        "name" => "Default value",
                ),
                ///akismet_[type validate]
                "akismet_comment_author_email" => array(
                        "name" => "Akismet",
                        "type" => "checkbox",
                        "options" => array(
                                "This field requires authors email address(Akismet validate)" => "1",
                        ),
                ),
        );
    }

    public function toHtml($options = "", $index = "") {
//        echo print_r($options);
        $settings = Dfd_contact_form_settings::instance()->getAllSettings();
//        print_r($settings);
        $result = "";
        $required = isset($options["required-1"]) ? esc_attr($options["required-1"]) : "";
        $required_text = $required ? $this->requiredText() : "";
        $show_placeholder = isset($settings["placeholder"]) ? esc_attr($settings["placeholder"]) : "";
        $show_label_text = isset($settings["show_label_text"]) ? esc_attr($settings["show_label_text"]) : "";
        $default = isset($options["def_value"]) ? esc_attr($options["def_value"]) : "";
        $name = isset($options["name"]) ? esc_attr($options["name"]) : "";
        $placeholder = $show_placeholder == "on" ? ' placeholder="' . $name . '" ' : '';
        if ($show_label_text == "on") {
            $result .='<span class="label_text"><label>' . $name ."</label>". $required_text . '</span>';
        }
        $effect="";
        if($settings["preset"]=="preset3"){
            $effect = '<span class="right-border"></span>'
                      . '<span class="top-border"></span>'
                      . '<span class="left-border"></span>';
        }
        $result .= '<input type="text" name="' . $this->unic_name . '-' . $index . '" value="' . $default . '"'
                  . ' ' . $placeholder . '>';
        return $result.$effect;
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
        if ($params["value"] != "" && !is_email(trim($params["value"]))) {
            $this->addError($name["name"], esc_html__('Email address seems invalid', 'dfd-native'));
        }
        $this->setResult($this->getErrors());
        $this->setGlobalError();
    }

}
