<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 */
if (!class_exists('Dfd_Check_Layout')) {

    class Dfd_Check_Layout {

        function __construct() {
            if (function_exists('vc_add_shortcode_param')) {
                vc_add_shortcode_param('dfd_check_layout', array(&$this, 'radio_image_settings_field'));
            }
        }

        function radio_image_settings_field($settings, $value) {
            ob_start();
            $param_name = isset($settings['param_name']) ? esc_attr($settings['param_name']) : '';
            $type = isset($settings['type']) ? esc_attr($settings['type']) : '';
            $options = isset($settings['options']) ? $settings['options'] : '';
            $class = isset($settings['class']) ? esc_attr($settings['class']) : '';
            $fake_checkbox = Dfd_User_Form_Manager::instance()->getFakeParamName();
            $uni = esc_attr(uniqid());
            $output = '';
			$tooltip = array(
					"forms_00"=>esc_html__("Separate",'dfd-native'),
					"forms_01"=>esc_html__("Simple",'dfd-native'),
					"forms_02"=>esc_html__("Full Info",'dfd-native'),
					"forms_03"=>esc_html__("Three Columns",'dfd-native'),
					"forms_04"=>esc_html__("Classic",'dfd-native'),
					"forms_05"=>esc_html__("Single Column",'dfd-native'),
					"forms_06"=>esc_html__("Standard",'dfd-native'),
					"forms_07"=>esc_html__("Wide Columns",'dfd-native'),
					"forms_08"=>esc_html__("Simple Halves",'dfd-native'),
			);
            ?>
            <span class="vc_description vc_clearfix">Or customize your own</span>
            <input id="radio_image_setting_val_<?php echo $uni; ?>" 
                   class="wpb_vc_param_value
                   <?php echo $param_name . ' ' . $type . ' ' . $class . ' ' . $value . ' vc_ug_gradient"' ?>"
                   name="<?php echo $param_name ?>" style="display:none"  value="<?php echo $value ?>"/>
			
            <div class="ult-radio-image-box" data-uniqid="<?php echo $uni ?>">
                <?php
                foreach ($options as $key => $img_url) {
                    if ($value == esc_attr($key))
                        $checked = 'checked';
                    else
                        $checked = '';
                    ?>
                    <label>
                        <input type="radio" style="display:none" name="radio_image_<?php echo $uni ?>" <?php echo $checked ?> data-value="<?php echo $img_url; ?>" class="radio_pattern_image" value="<?php echo $key ?>" />
                        <img class="pattern-background" src="<?php echo Dfd_User_Form_template_manager::instance()->getImgNameByTemplate($img_url); ?>" >
						<span class="image-picker-tooltip"><?php echo array_key_exists($img_url, $tooltip) ? $tooltip[$img_url]:"";?></span>
                    </label>
                    <?php
                }
                ?>
            </div>
            <style>
                .ult-radio-image-box label > input{ /* HIDE RADIO */
                    display:none;
                }
                .ult-radio-image-box label > input + img{ /* IMAGE STYLES */
                    cursor:pointer;
                    border:2px solid #dddddd;
                }
                .ult-radio-image-box .no-bg {
                    border:2px solid #ccc;
                }
                .ult-radio-image-box label > input:checked + img, .ult-radio-image-box label > input:checked + .pattern-background{ /* (CHECKED) IMAGE STYLES */
                    border:2px solid #454545;
                }
                .pattern-background {                               
                    width: auto;
                    height: auto;
                    border:2px solid #ccc;;
                    display: inline-block;  
					box-sizing: content-box;
                }
				.wpb_el_type_dfd_check_layout label{
					position: relative;
				}
				.wpb_el_type_dfd_check_layout .image-picker-tooltip{
					margin-top: 0px;
				}
                .radio_pattern_image{
                    display: none ;
                }
            </style>

            <script type="text/javascript">
                (function($){
                    var defaults = {
                        fake_checkbox: '<?php echo $fake_checkbox; ?>'
                    };
                    var Dfd_User_Form = {
                        params: {
                            data_val: "",
                            fake_checkbox: "",
                        },
                        init: function(par){
                            var options;
                            options = $.extend({}, defaults, par);
                            $("[data-vc-shortcode-param-name='fake_check_layout']").css("display", "none");
                            $(".dfd_form_template").css("display", "none");
                            
                            $(".radio_pattern_image").change(function(){
                                var radio_id = $(this).parent().parent().data("uniqid");
                                var val = $(this).val();
                                var data_val = $(this).data("value");
                                Dfd_User_Form.params.data_val = data_val;
                                Dfd_User_Form.params.fake_checkbox = options.fake_checkbox;
                                $("#radio_image_setting_val_" + radio_id).val(val);
                                Dfd_User_Form.resetCheckboxes();

                                data_value = $(this).attr("data-value");
                                base_val = $("[name='check_layout_" + data_value + "']");
                                if(!base_val.val()){
                                    Dfd_Contact_form_field.AddDefaultValueToForm(data_val);
                                }
                                Dfd_Contact_form_field.updateById(base_val);
                            });
                        },
                        firstStart: function(){
                            form = "forms_01";
                            $("[value='" + form + ".php']").attr('checked', 'checked');
                            $("[value='" + form + "']").attr('checked', 'checked');
                            var radio_id = $("[value='" + form + ".php']").parent().parent().data("uniqid");
                            $("#radio_image_setting_val_" + radio_id).val(form + ".php");
                            preset = $(".preset[name='preset']").val();
                            //                            console.log(preset);
                            base = $("[name='check_layout_" + form + "']");
                            Dfd_Contact_form_field.updateById(base);
                            Dfd_Contact_form_field.AddDefaultValueToForm(form);
                            $("select[name='preset']").trigger("change");

                        },
                        resetCheckboxes: function(){
                            $(".fake_check_layout").each(function(index){
                                $(this).attr("checked", false);
                            });
                            $("#" + Dfd_User_Form.params.fake_checkbox + "-" + Dfd_User_Form.params.data_val).click();
                        }
                    };

                    checked_layout = $(".radio_pattern_image:checked").attr("data-value");
                    if(checked_layout){
                        base_val = $("[name='check_layout_" + checked_layout + "']");
                        Dfd_Contact_form_field.updateById(base_val);
                    } else {
                        Dfd_User_Form.firstStart();
                    }
                    Dfd_User_Form.init();

                })(jQuery)

            </script>
            <?php
            $output .= ob_get_clean();
            return $output;
        }

    }

}

if (class_exists('Dfd_Check_Layout')) {
//    $Ultimate_Radio_Image_Param = new Dfd_Check_Layout();
}
