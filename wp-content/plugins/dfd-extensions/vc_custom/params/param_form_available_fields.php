<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 */
if (!class_exists('Dfd_form_available_fields')) {

    class Dfd_form_available_fields {

        function __construct() {
            if (function_exists('vc_add_shortcode_param')) {
                vc_add_shortcode_param('dfd_form_available_fields', array(&$this, 'dfd_form_available'));
            }
        }

        function dfd_form_available($settings, $value) {
            ob_start();
            ?>
            <div class="wpb_element_label">Mail-tags you can use in message field:              
            </div>
            <div id="available_fields"></div>
            <script>

                (function ($, dfd) {


                    $(document).ready(function () {

                        dfd.updateAvaliableFields();
            //                        console.log(dfd);
                    });

                })(jQuery, Dfd_Contact_form_field);
            </script>
            <?php
            $output = '';
            $value = htmlspecialchars($value);

            $output .= '<input  style="display:none" name="' . $settings['param_name']
                      . '" class="wpb_vc_param_value wpb-textinput '
                      . $settings['param_name'] . ' ' . $settings['type']
                      . '" type="text" value="' . $value . '"/>';


            $output .= ob_get_clean();
            return $output;
        }

    }

}

if (class_exists('Dfd_form_available_fields')) {
    $Ultimate_Dfd_Form_Template = new Dfd_form_available_fields();
}
