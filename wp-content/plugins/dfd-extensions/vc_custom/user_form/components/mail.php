<?php

class Dfd_Contact_Form_Mail {

    /**
     *
     * @var Dfd_Contact_Form_Mail $_instance 
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

    /**
     * 
     * @param Dfd_Submission $subm
     * @return boolean
     */
    public function send($subm) {
        $settings = Dfd_contact_form_settings::instance();
        $set = $settings->getAllSettings();
        if (empty($set))
            return false;
		
        $input = $subm->getAllFields();


        $to = isset($set["email_to"]) ? wp_specialchars_decode($set["email_to"]) : '';
        $subject = isset($set["email_subject"]) ? wp_specialchars_decode($set["email_subject"]) : '';
        $body = isset($set["content"]) ? $set["content"] : '';

//        $replay_to = isset($set["email_replay_to"]) ? wp_specialchars_decode($set["email_replay_to"]) : '';
		$email = get_bloginfo("admin_email");
		if($email){
			$headers[] = 'From: ' . get_bloginfo("name") . ' <'.  $email.'>';
		}
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
		$headers[] = "X-WPCF7-Content-Type: text/html";
//        $headers[] = 'BCC: ' . $replay_to . '';

		foreach ($input as $item) {
			if (isset($item['type']) && $item['type'] == 'email') {
				$headers[] = 'Reply-To: ' . $item['value'] . '';
			}
		}

		preg_match_all("/({{([A-Za-z0-9-_}}])+)+/i", $body, $match);
        if (isset($match[1])) {
            foreach ($match[1] as $key => $value) {
                $row_value = preg_replace("/{/", "", $value);
                $row_value = preg_replace("/}/", "", $row_value);
                if (array_key_exists($row_value, $input)) {
                    $res_val = $input[$row_value]["value"];
                    if (is_array(json_decode($res_val))) {
                        $arr = json_decode($res_val);
                        $res_val = implode(", ", $arr);
                    }
                    $res_val = htmlspecialchars($res_val);
                    $body = "<p>".  preg_replace("/" . $value . "/i", $res_val, $body)."</p>";
					
                }
            }
        }

        return wp_mail($to, $subject, $body, $headers);
    }

}
