<?php

class Dfd_Contact_Form_Date extends Dfd_Contact_Form_Input {

    public $name = "date";
    public $unic_name = "date";

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
                "range" => array(
                        "type" => "daterange",
                        "name" => "Range",
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
                "akismet_comment_author" => array(
                        "name" => "Akismet",
                        "type" => "checkbox",
                        "options" => array(
                                "This field requires authors name(Akismet validate)" => "1",
                        ),
                ),
        );
    }

    function __construct() {
        
    }

    public function toHtml($options = "", $index = "") {
//        print_r($options);
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
        $daterange_from_1 = isset($options["daterange_from_1"]) ? esc_attr($options["daterange_from_1"]) : "";
        $daterange_to_2 = isset($options["daterange_to_2"]) ? esc_attr($options["daterange_to_2"]) : "";
        $unic = uniqid();
        if ($show_label_text == "on") {
            $result .='<span class="label_text"><label>' . $name ."</label>". $required_text . '</span>';
        }
        $effect="";
        if($settings["preset"]=="preset3"){
            $effect = '<span class="right-border"></span>'
                      . '<span class="top-border"></span>'
                      . '<span class="left-border"></span>';
        }
        $result .= '<input type="text" id="' . $this->unic_name . '-' . $index . $unic . '" name="' . $this->unic_name . '-' . $index . '" value="' . $default . '"'
                  . ' ' . $placeholder . '>'.$effect;
        $result.= '<script>
            (function($){
 $( document ).ready(function() {
    dateMin = new Date("'.$daterange_from_1.'");
	dateMax = new Date("'.$daterange_to_2.'");
    $( "#' . $this->unic_name . '-' . $index . $unic . '" ).datepicker({
		minDate: dateMin, maxDate: dateMax,
		beforeShow : function(){
		}
		});
});            
})(jQuery);           
  </script>';
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
