<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 */
if (!class_exists('Dfd_Form_Template')) {

    class Dfd_Form_Template {

        function __construct() {
            if (function_exists('vc_add_shortcode_param')) {
                vc_add_shortcode_param('dfd_form_template', array(&$this, 'dfd_form_template_field'));
            }
        }

        function dfd_form_template_field($settings, $value) {
            ob_start();
            $file_template = $settings["dependency"]["value"];
            if (is_array($file_template)) {
                $file_template = $file_template[0];
            }
            ?>
            <div class="dfd_template_layout">
                <?php
                Dfd_User_Form_template_manager::instance()->includeTemplatelayout($file_template);
                ?>
            </div>
            <script>
                    Dfd_Contact_form_field.setIds();
                    Dfd_Contact_form_field.update();
            </script>
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

if (class_exists('Dfd_Form_Template')) {
    $Ultimate_Dfd_Form_Template = new Dfd_Form_Template();
}
