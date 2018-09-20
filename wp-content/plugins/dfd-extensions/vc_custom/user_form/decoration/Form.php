<?php

abstract class Dfd_FormDecorator {

	abstract public function generate($content);
}

class Main_Form_Decorator extends Dfd_FormDecorator {

	public function generate($content) {
		return $content;
	}

}

abstract class Dfd_Abstract_FormDecorator extends Dfd_FormDecorator {

	/**
	 *
	 * @var Dfd_FormDecorator $_simpleForm
	 */
	protected $_simpleForm;

	public function __construct(Dfd_FormDecorator $form) {
		$this->_simpleForm = $form;
	}

}

class Dfd_Simple_FormDecorator extends Dfd_Abstract_FormDecorator {

	function generate($content) {
		$settings = Dfd_contact_form_settings::instance()->getAllSettings();
		if (empty($settings))
			return false;
		$form_id = esc_attr(Dfd_contact_form_settings::instance()->getFormid());
		$general_class = '';
		$general_class .= $settings["preset"] . ' ' . $settings["el_class"].' ';
		$general_class .= 'hover_style_input_'.$settings["hover_style_input"].' ';
		$general_class .= 'hover_style_input2_'.$settings["hover_style_input2"]. ' ';

		$animation_data = '';
		$el_class = '';
		if (isset($settings["module_animation"])) {
			if (!( $settings["module_animation"] == '' )) {
				$el_class = 'cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($settings["module_animation"]) . '" ';
			}
		}
		?>
		<div class="wpb_wrapper <?php echo esc_attr($el_class); ?>" <?php echo $animation_data; ?>>
			<div class="wpcf7">
				<div class="">
					<form action="" method="post" id="cf_<?php echo $form_id; ?>" class="wpcf7-form dfd_contact_form <?php echo $general_class; ?> cf_<?php echo $form_id; ?>" >
						<div class="container">
							<?php
							$class = "";
							if ($settings["preset"] == "preset3") {
								$class = "dfd-contact-form-style-1 dfd_user_form";
							};
							if ($settings["preset"] == "preset2") {
								$class = "dfd-contact-form-style-compact dfd_user_form";
							};
							?>
							<div class="<?php echo $class; ?>">
								<?php echo $this->_simpleForm->generate($content); ?>
							</div>
						</div>
						<?php Dfd_reCaptchaDecorator::generate(); ?>
						<div class="wpcf7-response-output wpcf7-display-none wpcf7-validation-errors"><span></span><i class="dfd-socicon-cross-24"></i></div>
					</form>
				</div>
			</div>
		</div>
		<?php
		unset($settings);
	}

}

class Dfd_ButtonDecorator extends Dfd_Abstract_FormDecorator {

	function generate($content) {
		echo $this->_simpleForm->generate($content);
		$settings = Dfd_contact_form_settings::instance()->getAllSettings();
		$message = isset($settings["btn_message"]) ? esc_attr($settings["btn_message"]) : "SEND MESSAGE";
		$width = isset($settings["btn_width"]) ? esc_attr($settings["btn_width"]) : "";
		$btn_align = "";
		if (isset($settings["btn_align"]) && $settings["button_aligned_sections"] !== "lines") {
			$param_align = $settings["btn_align"];
			switch ($param_align) {
				case "left":
					$btn_align = "";
					break;
				case "center":
					$btn_align = "margin:0 auto; float: inherit;";
					break;
				case "right":
					$btn_align = "float:right;";
					break;
			}
		}
		?>
		<p class="<?php echo $width; ?> form_button" style="<?php echo $btn_align ?>">
			<input type="submit" value="<?php echo $message; ?>" class="wpcf7-submit">
		</p>
		<div class="clear"></div>
		<?php
		unset($settings);
	}

}

class Dfd_reCaptchaDecorator {

	static function generate($content = "") {
		$recaptcha = new Dfd_Contact_Form_Recaptcha();
		?>
		<?php echo $recaptcha->toHtml(); ?>
		<?php
	}

}

class Dfd_MessageDecorator extends Dfd_Abstract_FormDecorator {

	function generate($content) {
		echo $this->_simpleForm->generate($content);
		?>  

		<?php
	}

}
