<?php

class Dfd_Contact_Form_Recaptcha extends Dfd_Contact_Form_Input {

	public $name = "reCaptcha";
	public $unic_name = "recaptcha";

	protected function property() {
		return array (
				"recaptcha" => array (
						"name" => "recaptcha",
						"type" => "checkbox",
						"options" => array (
								"Use reCaptcha" => "1",
						),
				),
		);
	}

	function __construct() {
		
	}

	public function toHtml($settings = "", $index = "") {
		ob_start();
		$settings = Dfd_contact_form_settings::instance()->getAllSettings();
		$publicKey = isset($settings["recaptcha_publickey"]) ? esc_attr($settings["recaptcha_publickey"]) : "";
		Dfd_contact_form_recaptcha_manager::instance()->setPubKey($publicKey);
		if ($publicKey) {
//        $publicKey = Dfd_contact_form_recaptcha_manager::instance()->getPubkey();
//        $result = '<div class="g-recaptcha" data-size="compact" data-sitekey="'.$publicKey.'"></div>';
			$id = uniqid($index);
			?>
			<p class="recaptcha last">
				<span id="el_<?php echo $id ?>"class="captcha"></span>
				<span class="reloadCap" data-id="el_<?php echo $id ?>" >Reload Captcha</span>
				<input type="hidden" name="recaptcha-<?php echo $index; ?>">
				<script type="text/javascript">
					(function($){
						$(document).ready(function(){
							try {
								dfdreCaptcha.add("el_<?php echo $id; ?>");
								dfdreCaptcha.addSitekey("<?php echo $publicKey; ?>");
								dfdreCaptcha.show();
							} catch(e) {

							}
						});

					})(jQuery);
				</script>
			</p>
			<?php
		}
		return ob_get_clean();
	}

	public function innerValidate() {
		$settings = Dfd_contact_form_settings::instance()->getAllSettings();
//        print_r($settings);
		if (!$settings["use_recaptcha"]) {
			return true;
		}
		$privatekey = isset($settings["recaptcha_privatekey"]) ? esc_attr($settings["recaptcha_privatekey"]) : "";
		$captcha_manager = Dfd_contact_form_recaptcha_manager::instance();
		$captcha_manager->setPrivKey($privatekey);
		$name = $this->submission->getCur_active_field();
		$params = $this->submission->getField($name["name"]);
//        print_r($params);
//        print_r($_POST);
		$is_verif = false;
		if (isset($_POST["g-recaptcha-response"])) {
			$response = $_POST["g-recaptcha-response"];
			$is_verif = $captcha_manager->checkAnswer($response);
			if ($is_verif) {
				return true;
			}
		}
		$response = $captcha_manager->getresponseData();
//        print_r($response);
		if (!empty($response["error-codes"])) {
			$error_mess = implode(", ", $response["error-codes"]);
			$this->addError($name["name"], $error_mess);
			return false;
		}
		unset($settings);
		return false;
	}

}
