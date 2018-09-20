<?php

class Dfd_contact_form_recaptcha_manager {

    private $publickey = "";
    private $privatekey = "";
    private $path = "/recaptcha/api/siteverify";
    private $host = "www.google.com";
    private $port = 80;
    private $_response_data="";
    const SITE_VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     *
     * @var Dfd_contact_form_recaptcha_manager $_instance 
     */
    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Encodes the given data into a query string format
     * @param $data - array of string elements to be encoded
     * @return string - encoded request
     */
    private function _recaptcha_qsencode($data) {
        $req = "";
        foreach ($data as $key => $value)
            $req .= $key . '=' . urlencode(stripslashes($value)) . '&';

        // Cut the last '&'
        $req = substr($req, 0, strlen($req) - 1);
        return $req;
    }

    /**
     * Submits an HTTP POST to a reCAPTCHA server
     */
    private function _recaptcha_http_post($data) {
        $req = $this->_recaptcha_qsencode($data);
        $peer_key = version_compare(PHP_VERSION, '5.6.0', '<') ? 'CN_name' : 'peer_name';
        $options = array(
                'http' => array(
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => $req,
                        // Force the peer to validate (not needed in 5.6.0+, but still works
                        'verify_peer' => true,
                        // Force the peer validation to use www.google.com
                        $peer_key => 'www.google.com',
                ),
        );
        $context = stream_context_create($options);
        return file_get_contents(self::SITE_VERIFY_URL, false, $context);
    }

    public function checkAnswer($response) {
        $userip = "";
        if (isset($_SERVER['REMOTE_ADDR'])) {
            $userip = $_SERVER['REMOTE_ADDR'];
        }
        $data = array(
                "secret" => $this->getprivKey(),
                "response" => $response,
                "remoteip" => $userip,
        );
        $json = $this->_recaptcha_http_post($data);
        $responseData = json_decode($json, true);
        $this->_response_data = $responseData;
        if (!$responseData) {
            return false;
        }
        if (isset($responseData['success']) && $responseData['success'] == true) {
            return true;
        }
        if (isset($responseData['error-codes']) && is_array($responseData['error-codes'])) {
            return false;
        }
        return false;
    }

    function __construct() {
        
    }

    public function getresponseData() {
        return $this->_response_data;
    }

    public function setPubKey($value) {
        $this->publickey = $value;
    }

    public function setPrivKey($value) {
        $this->privatekey = $value;
    }

    public function getPubkey() {
        return $this->publickey;
    }

    public function getprivKey() {
        return $this->privatekey;
    }

}
