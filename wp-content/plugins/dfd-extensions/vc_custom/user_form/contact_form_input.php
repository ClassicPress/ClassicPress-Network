<?php

abstract class Dfd_Contact_Form_Input {

    function __construct() {
        
    }

    public $name = "text";
    public $unic_name = "def_name";
    protected $_error = array();

    /**
     *
     * @var Dfd_Submission 
     */
    public $submission = "";

    protected function property() {
        return array(
                "name" => $this->name,
                "type" => "text",
                "options" => array(
                        "text" => "textarea"
                )
        );
    }

    public function propertyToJson() {
        return json_encode($this->property());
    }

    public function getName() {
        return $this->name;
    }

    public function getunicName() {
        return $this->unic_name;
    }

    public function toHtml($options = "", $index = "") {
//        echo print_r($options);
        return '<input type="text" vlaue="val">';
    }

    public function explodeSettings($options) {
        return explode("{+}", $options);
    }

    public function setResult($arr) {
        if ($this->submission instanceof Dfd_Submission) {
            $sub = $this->submission->getCur_active_field();
            $f = $this->submission->getField($sub["name"]);
            $f = array_merge($f, array("validation" => $arr));
            $this->submission->setField($sub["name"], $f);
        }
    }

    public function setGlobalError() {

        $valid = $this->submission->getField("validation");
        $valid = !empty($valid) ? $valid : array();
        $this->submission->setField("validation", array_merge($valid, $this->getErrors()));
    }

    public function addError($errorname, $message) {
        $this->_error[$errorname] = $message;
    }

    public function getErrors() {
        if (!empty($this->_error)) {
            return $this->_error;
        }
        return array();
    }

    public function hasError() {
        $errors = $this->submission->getField("validation");
        if (!empty($errors)) {
            return true;
        }
        return false;
    }

    public function validate(Dfd_Submission $submission) {
        $this->submission = $submission;
        return $this->innerValidate();
    }
    public function requiredText() {
        return "<span class='req_text'>*</span>";
    }
    abstract public function innerValidate();
}
