<?php

class Dfd_contact_form_settings {

    private $settings = array();
    private $_formid = "";

    /**
     *
     * @var Dfd_contact_form_settings $_instance 
     */
    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        if (!session_id()) {
            session_start();
        }
    }

    public function setValuesForm($atts) {
        $_SESSION[$this->_formid] = $atts;
    }

    public function setformId($formid) {
        $this->_formid = $formid;
    }

    public function getAllSettings() {
        if (isset($_SESSION[$this->_formid])) {
            return $_SESSION[$this->_formid];
        }
        return array();
    }

    public function getFormid() {
        if ($this->_formid) {
            return $this->_formid;
        }
        return "";
    }
}
