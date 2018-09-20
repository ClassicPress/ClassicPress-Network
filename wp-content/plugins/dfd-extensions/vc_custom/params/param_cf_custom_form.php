<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 */
if (!class_exists('Dfd_Form_Custom_Template')) {

    class Dfd_Form_Custom_Template {

        function __construct() {
            if (function_exists('vc_add_shortcode_param')) {
                vc_add_shortcode_param('dfd_form_custom_template', array(&$this, 'dfd_form_template_field'));
            }
        }

        function dfd_form_template_field($settings, $value) {
            ob_start();
            $file_template = $settings["dependency"]["value"];
            if (is_array($file_template)) {
                $file_template = $file_template[0];
            }
            ?>
            <div class="dfd_template_layout custom">
                <?php
//                Dfd_User_Form_template_manager::instance()->includeTemplatelayout($file_template);
                ?>
				
            </div>
			<div class="vc_welcome-visible-ne add_row_layout_builder">
				<a id="vc_not-empty-add-element-cf" class="vc_add-element-not-empty-button" title="Add Element" data-vc-element="add-element-action">
					<i class="vc-composer-icon vc-c-icon-add"></i>
				</a>
			</div>
			<script type="text/template" id="dfd_cf_custom_row_template">
				<div class="controls">
								<span class="vc_row_layouts vc_control">
											<a class="vc_control-set-column set_columns" data-cells="11" data-cells-mask="12" title="1/1"><i class="vc-composer-icon vc-c-icon-1-1"></i></a> 
											<a class="vc_control-set-column set_columns" data-cells="12_12" data-cells-mask="26" title="1/2 + 1/2"><i class="vc-composer-icon vc-c-icon-1-2_1-2"></i></a>
											<a class="vc_control-set-column set_columns" data-cells="13_13_13" data-cells-mask="312" title="1/3 + 1/3 + 1/3"><i class="vc-composer-icon vc-c-icon-1-3_1-3_1-3"></i></a> 
											<a class="vc_control-set-column set_columns" data-cells="14_14_14_14" data-cells-mask="420" title="1/4 + 1/4 + 1/4 + 1/4"><i class="vc-composer-icon vc-c-icon-1-4_1-4_1-4_1-4"></i></a> 
								</span>
							
					<a class="vc_control column_delete vc_column-delete" href="" title="Delete this row" data-vc-control="delete"><i class="vc-composer-icon vc-c-icon-delete_empty"></i></a>
				</div>
				<table class="vc_table vc_column-offset-table">
					<tr class="vc_size-lg">
							
					</tr>
					
				</table>
		
				
			</script>
			<script type="text/template" id="dfd_cf_custom_field_template">
							{{field}}
			</script>
				<script type="text/template" id="dfd_cf_custom_field_select_template">
					<span>Mail short tag:&nbsp&nbsp</span><b><span class="code"></span></b>
					<select data-id='' class='dfd_contact_form_select' name='dfd_contact_form'>
						<option data-value='' value=''>Nothing</option>
						<?php 
						echo "<% for(var obj in params){%>";
							echo "<% data = params[obj]%>";
							echo "<option data-value='<%=data.json%>' value='<%=data.unic_name%>'><%=data.rep_arr%></option>";
						echo "<%}%>";
						?>
					</select>
				</script>
            <script>
//					Dfd_Contact_form_field.GenerateTemplate();
//					var Dfd_CF = Dfd_CF || {};
//					Dfd_CF.View = {};
//					Dfd_CF.Model = {};
//					Dfd_CF.Collection = {};
					Dfd_CF.APP = {};
					new Dfd_CF.View.AppView();
//                    Dfd_Contact_form_field.setIds();
//                    Dfd_Contact_form_field.update();
//					(function($){
//						base_val = $("[name='custom_template']");
//						Dfd_Contact_form_field.updateById(base_val);
//					})(jQuery);
					
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

if (class_exists('Dfd_Form_Custom_Template')) {
    $Ultimate_Dfd_Form_Template = new Dfd_Form_Custom_Template();
}
