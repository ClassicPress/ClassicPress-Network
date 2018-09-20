<?php

class Dfd_Contact_Form_Radio extends Dfd_Contact_Form_Input {

    public $name = "radio";
    public $unic_name = "radio_name";

    protected function property() {
        return array(
                "options" => array(
                        "type" => "textarea",
                        "name" => "Options",
                )
        );
    }

    function __construct() {
        
    }

    public function toHtml($setting = "", $index = "") {
//        echo print_r($options);
        extract($setting);
		if(!isset($options)) return "";
        $result = "<span class='checkboxgroup dfd_cf_radio_group'>";
        $options = $options ? esc_attr($options) : array();
        $options = $this->explodeSettings($options);
//        echo $options;
		$unic_id = uniqid();
        if (is_array($options) && !empty($options)) {
            foreach ($options as $key => $value) {
                if ($value) {

                    $result.="<span class='checkbox'><input type='radio' id='{$this->unic_name}-$value' name='{$this->unic_name}-$index-$unic_id]' value='$value'>"
                              . "<span class='c_value'><label for='{$this->unic_name}-$value'>$value</label></span></span>";
                }
            }
        }
        $result .="</span>";
        return $result;
    }

    public function innerValidate() {
        
    }

}
