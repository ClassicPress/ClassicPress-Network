<?php

class Dfd_User_Form_Manager {

	private $param_name = "check_layout";
	private $fake_param_name = "fake_check_layout";
	private $param_type = "dfd_check_layout";

	/**
	 *
	 * @var Dfd_User_Form_Manager $_instance 
	 */
	private static $_instance = null;

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct() {
		$this->init();
	}

	public function init() {
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/template_manager.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/user_input.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/contact_form_input.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/LayoutBuilder.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/decoder.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/submission.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/field_manager.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/reCaptcha.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/mail.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/components/settings.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/decoration/Form.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/vendor/Akismet.class.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/vendor/AkismetManager.php";
		require_once DFD_EXTENSIONS_PLUGIN_PATH."vc_custom/user_form/inputs/recaptcha.php";

		$this->setActions();
	}

	public function setActions() {
		add_action('init', array ($this, "dfd_contact_from_init"));
	}

	public function dfd_contact_from_init() {
		if (!isset($_SERVER['REQUEST_METHOD'])) {
			return;
		}
		wp_enqueue_script('jquery-form');

		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			if (isset($_POST['_dfd_is_ajax_call'])) {

				$submission = Dfd_Submission::instance();

				$echo = $submission->ajaxValidate();

				$echo = wp_json_encode($echo);

				@header('Content-Type: application/json; charset=' . get_option('blog_charset'));
				echo $echo;
				exit();
			}
		}
	}

	public function getParamName() {
		return $this->param_name;
	}

	public function getFakeParamName() {
		return $this->fake_param_name;
	}

	public function getParamType() {
		return $this->param_type;
	}

	public function getoptions() {

		$files = Dfd_User_Form_template_manager::instance()->getAllTempletes();
		$res_arr = array ();
		//revers key and  value
		foreach ($files as $key => $value) {
			$res_arr[$value] = $key;
		}
		return $res_arr;
	}

	public function generateDependencys() {
		$files = Dfd_User_Form_template_manager::instance()->getAllTempletes();

		$result = array ();
		foreach ($files as $f_key => $f_value) {
			$merge_arr = array (
					'type' => 'dfd_form_template',
					'param_name' => $this->getParamName() . '_' . $f_key,
					'dependency' => Array ('element' => $this->fake_param_name, 'value' => array ($f_key)),
					'group' => esc_html__('Field Editor', 'dfd-native').' {' . $f_key . '}',
					'weight' => "400",
			);
			$result[] = ($merge_arr);
		}
//        print_r($r);
//        print_r($reuslt);
		return $result;
	}

	public function getParams() {
		$message = "From: {{your-name}}
		Subject: {{your-subject}}

		Message Body:
		{{your-message}}

		--
		This e-mail was sent from a contact form";
		//        $message = htmlspecialchars($message);
		$arr = array_merge(
			array (
				array (
					'type' => 'dfd_form_preset_select',
					'heading' => esc_html__('Style', 'dfd-native'),
					'param_name' => 'preset',
					'value' => array (
						esc_html__('Standart', 'dfd-native') => 'preset1',
						esc_html__('General border', 'dfd-native') => 'preset2',
						esc_html__('Simple', 'dfd-native') => 'preset3'
					),
					'weight' => "600",
				),
				array (
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to design your own style for the contact form','dfd-native').'</span></span>'.esc_html__('Your own style', 'dfd-native'),
					'param_name' => 'use_custom_layout',
					'options' => array (
						'on' => array (
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				),
				array (
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the button to the right side of the form. The button will be aligned to the first row of contact form. Note: if this option is enabled all fields are divided on equal parts and the button is equal to the columns in size','dfd-native').'</span></span>'.esc_html__('Right aligned button', 'dfd-native'),
					'param_name' => 'button_aligned_sections',
					'options' => array (
						'lines' => array (
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'dependency' => array ('element' => 'use_custom_layout', 'value' => array ('on')),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
				),
				array (
					'type' => 'dfd_form_layout_builder',
					'param_name' => 'layout_builder',
					'dependency' => Array ('element' => 'use_custom_layout', 'value' => array ('on')),
					'weight' => "400",
				),
				array (
					'type' => 'dfd_form_custom_template',
					'param_name' => 'custom_template',
					'dependency' => Array ('element' => 'use_custom_layout', 'value' => array ('on')),
					'weight' => "400",
				),
				array (
					'type' => 'dfd_check_layout',
					'heading' => esc_html__('Form Layout', 'dfd-native'),
					'dependency' => Array ('element' => 'use_custom_layout', 'value_not_equal_to' => array ('on')),
					'param_name' => $this->param_name,
					'options' => $this->getoptions(),
					'weight' => "500",
				),
				array (
					'type' => 'checkbox',
					'heading' => esc_html__('Sort panel', 'dfd-native'),
					'dependency' => Array ('element' => 'use_custom_layout', 'value_not_equal_to' => array ('on')),
					'edit_field_class' => 'fakecheckbox',
					'param_name' => $this->fake_param_name,
					'value' => $this->getoptions()
				),
				array (
					'type' => 'dfd_heading_param',
					'param_name' => 'other_settings',
					'text' => esc_html__('Other settings', 'dfd-native'),
					'value' => '',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				),	
				array (
					'type' => 'dropdown',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element.','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
					'param_name' => 'module_animation',
					'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
				),
				array (
					'type' => 'textfield',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
					'param_name' => 'el_class',
				),
				/* -------------------Input Style----------------------------------------- */
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the background color for the inputs. The default value is inherited from Theme Options > Styling options > Second site color lighter for 3.7 percents','dfd-native').'</span></span>'.esc_html__("Inputs inner background color", 'dfd-native'),
					"param_name" => "input_background",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'dependency' => Array ('element' => 'preset', 'value' => array ('preset1','preset2')),
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the style of the inputs','dfd-native').'</span></span>'.esc_html__('Input style on focus', 'dfd-native'),
					'param_name' => 'hover_style_input',
					'options' => array (
						__('with shadow', 'dfd-native') => 'shadow_appear',
						__('simple', 'dfd-native') => 'simple',
					),
					'value'	=> 'shadow_appear',
					'dependency' => Array ('element' => 'preset', 'value' => array ('preset1')),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-top-padding',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dropdown',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the style of the inputs','dfd-native').'</span></span>'.esc_html__('Input style on focus', 'dfd-native'),
					'param_name' => 'hover_style_input2',
					'value' => array (
						__('simple', 'dfd-native') => 'simple',
						__('underline', 'dfd-native') => 'underline_hover',
					),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'dependency' => Array ('element' => 'preset', 'value' => array ('preset3', 'preset2')),
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_single_checkbox',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide the placeholder text (the text will be visible inside the input)','dfd-native').'</span></span>'.esc_html__('Placeholder', 'dfd-native'),
					'param_name' => 'placeholder',
					'value' => 'off',
					'options' => array (
						'on' => array (
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_single_checkbox',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide the label text (the text will be visible above the input)','dfd-native').'</span></span>'.esc_html__('Label for text field', 'dfd-native'),
					'param_name' => 'show_label_text',
					'value' => 'off',
					'options' => array (
						'on' => array (
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'dependency' => array ('element' => 'preset', 'value' => array ('preset1')),
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_heading_param',
					'param_name' => 'content_spacing',
					'text' => esc_html__('Border settings', 'dfd-native'),
					'value' => '',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dropdown',
					'heading' => esc_html__('Border Style', 'dfd-native'),
					'param_name' => 'border_style',
					'value' => array (
						esc_html__('solid', 'dfd-native') => 'solid',
						esc_html__('dotted', 'dfd-native') => 'dotted',
						esc_html__('dashed', 'dfd-native') => 'dashed',
						esc_html__('hidden', 'dfd-native') => 'hidden',
						esc_html__('double', 'dfd-native') => 'double',
						esc_html__('initial', 'dfd-native') => 'initial',
						esc_html__('inherit', 'dfd-native') => 'inherit',
					),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'heading' => esc_html__('Border width', 'dfd-native'),
					'param_name' => 'borderwidth',
					'min' => 1,
					'max' => 10,
					'dependency' =>
					array (
						'element' => 'preset',
						'value' => array ("preset1","preset3")
					),
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap crum_vc',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"heading" => esc_html__("Outer Border Color", 'dfd-native'),
					"param_name" => "outer_border_color",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset2")),
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'heading' => esc_html__('Border radius', 'dfd-native'),
					'param_name' => 'border_radius',
					'min' => 1,
					'max' => 10,
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom dfd-number-wrap crum_vc',
					'dependency' => Array ('element' => 'preset', 'value' => array ("preset1")),
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => esc_html__("Border Color", 'dfd-native'),
					"param_name" => "border_color",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_heading_param',
					'param_name' => 'content_spacing',
					'text' => esc_html__('Text settings', 'dfd-native'),
					'value' => '',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the content text. The default value is #000','dfd-native').'</span></span>'.esc_html__("Text Color", 'dfd-native'),
					"param_name" => "text_color",
					"value" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6',
					"description" => "",
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font.','dfd-native').'</span></span>'.esc_html__('Custom font family for input text', 'dfd-native'),
					'param_name' => 'use_google_fonts_input',
					'options' => array(
						'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'edit_field_class' => 'vc_column vc_col-sm-6',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'google_fonts',
					'param_name' => 'custom_fonts_input',
					'settings' => array (
						'fields' => array (
							'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
							'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
						),
					),
					'dependency' => array ('element' => 'use_google_fonts_input', 'value' => 'yes'),
					'edit_field_class' => 'vc_column vc_col-sm-12 no-border-bottom',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_heading_param',
					'param_name' => 'content_spacing',
					'text' => esc_html__('Other settings', 'dfd-native'),
					'value' => '',
					'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the height of the text area','dfd-native').'</span></span>'.esc_html__('Textarea height (Number of visible paragraphs)', 'dfd-native'),
					'param_name' => 'text_area_height',
					'min' => 1,
					'max' => 200,
					'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc',
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
				array(
					'type' => 'number',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to add the paddings. Note, the value you add will be added both to right and left colums. If you set 10px the space between columns will be 20px','dfd-native').'</span></span>'. esc_html__('Padding between columns', 'dfd-native'),
					'param_name' => 'horiz_margin_btw_inputs',
					'value' => 10,
					'min' => 1,
					'max' => 200,
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
					'dependency' => array('element' => 'preset', 'value' => array("preset1", "preset3")),
					'group' => esc_attr__('Input Style', 'dfd-native'),
				),
			/* ------------------------Button Style------------------------------------ */
				array (
					'type' => 'dfd_radio_advanced',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the text properties','dfd-native').'</span></span>'. esc_html__('Text Transform', 'dfd-native'),
					'param_name' => 'btn_text_transform',
					'options' => array (
						esc_html__('inherit from theme options', 'dfd-native') => '',
						esc_html__('Capitalize', 'dfd-native') => 'capitalize',
						esc_html__('Uppercase', 'dfd-native') => 'uppercase',
						esc_html__('Lowercase', 'dfd-native') => 'lowercase',
						esc_html__('Initial', 'dfd-native') => 'initial',
						esc_html__('Inherit', 'dfd-native') => 'inherit',
					),
					'value'	=> '',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the font size for the button text. The default value is 45px','dfd-native').'</span></span>'. esc_html__('Font size', 'dfd-native'),
					'param_name' => 'font_size',
					'value' => '',
					'min' => 1,
					'max' => 200,
					'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the letter spacing for the button text','dfd-native').'</span></span>'. esc_html__('Letter Spacing', 'dfd-native'),
					'param_name' => 'letter_spacing',
					'value' => '',
					'max' => 200,
					'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the border width for the button. The border is not set by default','dfd-native').'</span></span>'. esc_html__('Border width', 'dfd-native'),
					'param_name' => 'button_border_width',
					'value' => '',
					'max' => 200,
					'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc dfd-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the border color','dfd-native').'</span></span>'. esc_html__("Border color", 'dfd-native'),
					"param_name" => "button_border_color",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the border hover color','dfd-native').'</span></span>'. esc_html__("Border hover color", 'dfd-native'),
					"param_name" => "button_border_color_on_hover",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'dropdown',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the border style','dfd-native').'</span></span>'. esc_html__('Border style', 'dfd-native'),
					'param_name' => 'button_border_style',
					'value' => array (
						esc_html__('inherit from theme option', 'dfd-native') => '',
						esc_html__('solid', 'dfd-native') => 'solid',
						esc_html__('dotted', 'dfd-native') => 'dotted',
						esc_html__('dashed', 'dfd-native') => 'dashed',
						esc_html__('hidden', 'dfd-native') => 'hidden',
						esc_html__('double', 'dfd-native') => 'double',
						esc_html__('initial', 'dfd-native') => 'initial',
						esc_html__('inherit', 'dfd-native') => 'inherit',
					),
					'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'number',
					'class' => '',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the border radius for the button. The default value is inherited from Theme Options > General Options > Default Button Options > Default button border radius','dfd-native').'</span></span>'. esc_html__('Border radius', 'dfd-native'),
					'param_name' => 'button_border_radius',
					'value' => '',
					'min' => 1,
					'max' => 200,
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the background color for the button. The default value is inherited from Theme Options > General Options > Default Button Options > Default button background color','dfd-native').'</span></span>'. esc_html__("Background", 'dfd-native'),
					"param_name" => "button_backgrond",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the background color for the button. The default value is inherited from Theme Options > General Options > Default Button Options > Default button hover background color','dfd-native').'</span></span>'. esc_html__("Hover background", 'dfd-native'),
					"param_name" => "hover_button_backgrond",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the content text. The default value is inherited from Theme Options > General Options > Default Button Options > Default Button Typography','dfd-native').'</span></span>'.esc_html__("Text color", 'dfd-native'),
					"param_name" => "button_color_text",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "colorpicker",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the color for the content text. The default value is inherited from Theme Options > General Options > Default Button Options > Default Button hover text color','dfd-native').'</span></span>'.__("Text hover color", 'dfd-native'),
					"param_name" => "button_hover_color_text",
					"value" => "",
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "dfd_radio_advanced",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the text horizontally','dfd-native').'</span></span>'.esc_html__("Text alignment", 'dfd-native'),
					"param_name" => "text_align",
					"options" => array (
						esc_html__('Left Align', 'dfd-native') => "left",
						esc_html__('Center Align', 'dfd-native') => "center",
						esc_html__('Right Align', 'dfd-native') => "right",
					),
					"value" => "center",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'textfield',
					'heading' => esc_html__('Button Message', 'dfd-native'),
					'param_name' => 'btn_message',
					"value" => "Send message",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "dropdown",
					"class" => "",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width of the button according to the width of the form','dfd-native').'</span></span>'.__("Button width", 'dfd-native'),
					"param_name" => "btn_width",
					"value" => array (
						esc_html__('Inherit from theme options', 'dfd-native') => "",
						esc_html__('Full size (1/1 size)', 'dfd-native') => "dfd-full-size",
						esc_html__('Half size (1/2 size)', 'dfd-native') => "dfd-half-size",
						esc_html__('Third size (1/3 size)', 'dfd-native') => "dfd-third-size",
					),
					"description" => "",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					"type" => "dfd_radio_advanced",
					"heading" => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the button horizontally','dfd-native').'</span></span>'.__("Button alignment", 'dfd-native'),
					"param_name" => "btn_align",
					"options" => array (
						esc_html__('Left Align', 'dfd-native') => "left",
						esc_html__('Center Align', 'dfd-native') => "center",
						esc_html__('Right Align', 'dfd-native') => "right",
					),
					'value'	=> "center",
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font.','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
					'param_name' => 'use_google_fonts_button',
					'options' => array(
						'yes' => array (
							'on' => 'Yes',
							'off' => 'No',
						),
					),
					'value' => '',
					'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				array (
					'type' => 'google_fonts',
					'param_name' => 'custom_fonts_button',
					'value' => '',
					'settings' => array (
						'fields' => array (
							'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
							'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
						),
					),
					'dependency' => array ('element' => 'use_google_fonts_button', 'value' => 'yes'),
					'edit_field_class' => 'vc_column vc_col-sm-12 crum_vc',
					'group' => esc_attr__('Button Style', 'dfd-native'),
				),
				/* -----------------------reCaptcha setting------------------------------------- */
				array (
					'type' => 'dfd_single_checkbox',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the recaptcha for the contact form','dfd-native').'</span></span>'.__('ReCaptcha', 'dfd-native'),
					"description" => esc_html__("Get recaptcha in", 'dfd-native')." <a target='blank' href='https://www.google.com/recaptcha/intro/index.html'>google.com/recaptcha</a>",
					'param_name' => 'use_recaptcha',
					'options' => array(
						'yes' => array(
							'on' => 'Yes',
							'off' => 'No',
						),
					),	
					'value' => '',
					'group' => "reCaptcha setting",
				),
				array (
					'type' => 'textfield',
					'heading' => esc_html__('Public key', 'dfd-native'),
					'param_name' => 'recaptcha_publickey',
					"value" => "",
					'dependency' => Array ('element' => 'use_recaptcha', 'value' => array ("yes")),
					'group' => "reCaptcha setting",
				),
				array (
					'type' => 'textfield',
					'heading' => esc_html__('Private key', 'dfd-native'),
					'param_name' => 'recaptcha_privatekey',
					"value" => "",
					'dependency' => Array ('element' => 'use_recaptcha', 'value' => array ("yes")),
					'group' => "reCaptcha setting",
				),
			),
			$this->generateDependencys(),
			array (
					/* -----------------------Recived email form------------------------------------- */
				array (
					'type' => 'textfield',
					'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enter the email address the emails should be mailed to','dfd-native').'</span></span>'.esc_html__('To', 'dfd-native'),
					'param_name' => 'email_to',
					"value" => get_option("admin_email"),
					'weight' => "300",
					'group' => "Recived email form",
				),
				array (
					'type' => 'textfield',
					'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This subject will be visible in received emails','dfd-native').'</span></span>'.__('Subject', 'dfd-native'),
					'param_name' => 'email_subject',
					"value" => "your-subject",
					'weight' => "300",
					'group' => "Recived email form",
				),
				array (
					'type' => 'dfd_form_available_fields',
					'param_name' => 'form_available_fields',
					'weight' => "300",
					'dependency' => Array ('element' => 'use_custom_layout', 'value_not_equal_to' => array ('on')),
					'group' => "Message Text",
				),
				array (
					'type' => 'dfd_form_available_fields_for_builder',
					'param_name' => 'form_available_fields_for_builder',
					'weight' => "300",
						'dependency' => Array ('element' => 'use_custom_layout', 'value' => array ('on')),
					'group' => "Message Text",
				),
				array (
					"type" => "textarea_html",
					"class" => "",
					"heading" => esc_html__("Message", 'dfd-native'),
					"param_name" => "content",
					"value" => $message,
					'group' => "Message Text",
				),
			)
		);
//        print_r($arr);
		return $arr;
	}
}

function dfdcf_ajax_loader() {
//    $url = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/user_form/assets/images/ajax-loader.gif';
//    $url = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/user_form/assets/images/ajax-loader.gif';
	$url = "";
	return $url;
}

if (!function_exists("dfd_normalize_css")) {
	function dfd_normalize_css($b1) {
		$b1 = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $b1);
		$b1 = str_replace(array ("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $b1);
		return $b1;
	}
}