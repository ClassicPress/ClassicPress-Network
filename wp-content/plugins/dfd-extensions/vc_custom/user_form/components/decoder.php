<?php

class Dfd_Contact_Form_Decoder {

    /**
     *
     * @var Dfd_Contact_Form_Decoder $_instance 
     */
    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        
    }

}
