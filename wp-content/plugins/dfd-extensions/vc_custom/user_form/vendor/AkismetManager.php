<?php

class Dfd_Akismet_Manager {

    /**
     *
     * @var Dfd_Akismet_Manager $_instance 
     */
    private static $_instance = null;

    /**
     *
     * @var Dfd_Akismet $akismet 
     */
    private $akismet;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function setAkisment() {
        if ($this->getApiKey()) {
            $this->akismet = new Dfd_Akismet(get_site_url(), $this->getApiKey());
        }
    }

    public function validate($arr_params) {
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $userip = $_SERVER['REMOTE_ADDR'];
            $this->akismet->setUserIP($userip);
        }
        $this->akismet->setCommentType("contact-form");
        if (!empty($arr_params)) {
            foreach ($arr_params as $type => $value) {
                $this->addField($type, $value);
            }
        }
//        print_r($_SERVER);
        $objDateTime = new DateTime('NOW');
        $date = $objDateTime->format(DateTime::ISO8601);
        $this->akismet->setCommentDateGmt($date);
//        print_r($arr_params);
//        print_r($this->akismet->getAllFields());
        return $this->akismet->isCommentSpam();
    }

    public function addField($type, $value) {
        switch ($type) {
            case "comment_content":
                $this->akismet->setCommentContent($value);
                break;
            case "comment_author":
                $this->akismet->setCommentAuthor($value);
                break;
            case "comment_author_email":
                $this->akismet->setCommentAuthorEmail($value);
                break;
            case "comment_type":
                $this->akismet->setCommentType($value);
                break;
            case "permalink":
                $this->akismet->setPermalink($value);
                break;
            case "comment_author_url":
                $this->akismet->setCommentAuthorURL($value);
                break;

            default:
                break;
        }
    }

    public function getApiKey() {
        $api_key = "";
        if (is_callable(array('Akismet', 'get_api_key'))) { // Akismet v3.0+
            $api_key = Akismet::get_api_key();
        } else {
            if (function_exists('akismet_get_key')) {
                $api_key = akismet_get_key();
            } else {
                return false;
            }
        }
        return $api_key;
    }

    function __construct() {
        $this->setAkisment();
    }

}
