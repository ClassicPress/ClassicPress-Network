<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 */
if (!class_exists('Dfd_Form_Layout_Builder')) {

    class Dfd_Form_Layout_Builder {

        function __construct() {
            if (function_exists('vc_add_shortcode_param')) {
                vc_add_shortcode_param('dfd_form_layout_builder', array(&$this, 'dfd_form_template_field'));
            }
        }

        function dfd_form_template_field($settings, $value) {
            ob_start();
            
			?>
				<?php
          
            $output = '';
            $value = htmlspecialchars($value);

            $output .= '<input  name="' . $settings['param_name']
                      . '" class="wpb_vc_param_value wpb-textinput '
                      . $settings['param_name'] . ' ' . $settings['type']
                      . '" type="text" value="' . $value . '"/>';


            $output .= ob_get_clean();
            return $output;
        }

    }

}

if (class_exists('Dfd_Form_Layout_Builder')) {
    $Ultimate_Dfd_Form_Template = new Dfd_Form_Layout_Builder();
}
