<?php

class Dfd_User_Input {

    /**
     *
     * @var Dfd_User_Input $_instance 
     */
    private static $_instance = null;
    private $_components = array();
    private $folder = "/vc_custom/user_form/inputs/";

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	public function setJsOpt() {
		 $result = array();
		 foreach (self::$_coreComponents as $file_name => $component) {
            /* @var $component Dfd_Contact_Form_Input */
            $rep_arr = $component->getName();
            $unic_name = $component->getunicName();
            $json = $component->propertyToJson();
			$res = array(
					"name"=>$rep_arr,
					"unic_name"=>$unic_name,
					"json"=>$json
			);
			array_push($result, $res);
        }
		return $result;
	}
    public function generate($file) {
        $str = file_get_contents($file);
        $rep_arr = array();
        $select = "<select data-id='' class='dfd_contact_form_select' name='dfd_contact_form'>";
        $json = "";
        $select.='<option data-value="" value="">Nothing</option>';
        foreach (self::$_coreComponents as $file_name => $component) {
            /* @var $component Dfd_Contact_Form_Input */
            $rep_arr = $component->getName();
            $unic_name = $component->getunicName();
            $json = $component->propertyToJson();
            $select.='<option data-value=\'' . $json . '\' value="' . $unic_name . '">' . $rep_arr . '</option>';
        }
        $select.="</select>";
        $str = str_replace("{{field}}", $select, $str);
        echo $str;
    }

    public function populateValByType($inputType, $value = "", $index = "") {

        foreach (self::$_coreComponents as $file_name => $component) {
            /* @var $component Dfd_Contact_Form_Input */
            $unic_name = $component->getunicName();
            if ($unic_name == $inputType) {
                return $component->toHtml($value, $index);
            }
        }
    }

    function __construct() {
        $this->registerCoreComponents();
    }

    private static $_coreComponents = array(
            //fileName => className ///
            'radio' => "Dfd_Contact_Form_Radio",
            'email' => "Dfd_Contact_Form_Email",
            'select' => "Dfd_Contact_Form_Select",
            'text' => "Dfd_Contact_Form_Text",
            'textarea' => "Dfd_Contact_Form_Textarea",
            'tel' => "Dfd_Contact_Form_Tel",
            'checkbox' => "Dfd_Contact_Form_Checkbox",
            'date' => "Dfd_Contact_Form_Date",
            'acceptance' => "Dfd_Contact_Form_acceptance",
    );

    protected function registerCoreComponents() {
        foreach (self::$_coreComponents as $file_name => $component) {
            $file = DFD_EXTENSIONS_PLUGIN_PATH.$this->folder . $file_name . ".php";
            if (file_exists($file)) {
                require_once $file;
                if (class_exists($component)) {
                    self::$_coreComponents[$file_name] = new $component();
                } else {
                    unset(self::$_coreComponents[$file_name]);
                }
            }
        }
    }

    public function validate(Dfd_Submission $submission) {
        foreach (self::$_coreComponents as $file_name => $component) {
            /* @var $component Dfd_Contact_Form_Input */
            $sub = $submission->getCur_active_field();
//            print_r($sub);  
            if ($component->unic_name == $sub["type"]) {

                $component->validate($submission);
            }
        }
    }

}
