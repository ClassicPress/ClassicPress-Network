<?php
if (!defined('ABSPATH')) {
	exit;
}
/*
 */
if (!class_exists('Dfd_Check_Layout')) {

	class Dfd_Check_Layout {

		function __construct() {
			if (function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_check_layout', array (&$this, 'radio_image_settings_field'));
			}
		}

		function radio_image_settings_field($settings, $value) {
			ob_start();
			$param_name = isset($settings['param_name']) ? esc_attr($settings['param_name']) : '';
			$type = isset($settings['type']) ? esc_attr($settings['type']) : '';
			$options = isset($settings['options']) ? $settings['options'] : '';
			$class = isset($settings['class']) ? esc_attr($settings['class']) : '';
			$fake_checkbox = Dfd_User_Form_Manager::instance()->getFakeParamName();
			$uni = uniqid();
			$output = '';
			$tooltip = array (
					"forms_00" => esc_html__("Full info", 'dfd-native'),
					"forms_01" => esc_html__("Standard", 'dfd-native'),
					"forms_02" => esc_html__("Simple", 'dfd-native'),
					"forms_03" => esc_html__("Simple full width", 'dfd-native'),
//					"forms_04" => esc_html__("Classic", 'dfd-native'),
					"forms_05" => esc_html__("Top two columns", 'dfd-native'),
					"forms_06" => esc_html__("Top three columns", 'dfd-native'),
//					"forms_07" => esc_html__("Wide Columns", 'dfd-native'),
					"forms_08" => esc_html__("Full width", 'dfd-native'),
			);
			?>
			<!--<span class="vc_description vc_clearfix">Or customize your own</span>-->
			<input id="radio_image_setting_val_<?php echo esc_attr($uni); ?>" 
				   class="wpb_vc_param_value
				   <?php echo $param_name . ' ' . $type . ' ' . $class . ' ' . $value . ' vc_ug_gradient"' ?>"
				   name="<?php echo $param_name ?>" style="display:none"  value="<?php echo $value ?>"/>

			<div class="ult-radio-image-box" data-uniqid="<?php echo esc_attr($uni) ?>">
				<ul class="thumbnails image_picker_selector">
					<?php
					foreach ($options as $key => $img_url) {
						if ($value == esc_attr($key)){
							$checked = 'checked';
							$selected = 'selected';	
						}
						else{
							$selected = '';
							$checked = '';
						}
							
						?>
						<li>
							<div class="thumbnail <?php echo $selected;?>">
								<input type="radio" style="display:none" name="radio_image_<?php echo esc_attr($uni) ?>" <?php echo $checked ?> data-value="<?php echo esc_attr($img_url); ?>" class="radio_pattern_image" value="<?php echo $key ?>" <?php echo $selected;?> />
								<img class="image_picker_image pattern-background" src="<?php echo Dfd_User_Form_template_manager::instance()->getImgNameByTemplate($img_url); ?>" >
								<span class="image-picker-tooltip"><?php echo array_key_exists($img_url, $tooltip) ? $tooltip[$img_url] : ""; ?></span>
							</div>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
			<style>
				.ult-radio-image-box label > input{ /* HIDE RADIO */
					display:none;
				}
				.radio_pattern_image{
					display: none ;
				}
			</style>

			<script type="text/javascript">
				(function($){
					var defaults = {
						fake_checkbox: '<?php echo esc_js($fake_checkbox); ?>'
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
							$(".vc_wrapper-param-type-dfd_check_layout .thumbnail").click(function(){
								$(".vc_wrapper-param-type-dfd_check_layout .thumbnail").removeClass("selected");
								$(this).addClass("selected");
								$(this).find(".radio_pattern_image").trigger("change");
							});
							$(".radio_pattern_image").change(function(){
								var radio_id = $(this).parent().parent().parent().parent().data("uniqid");
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
							$("[value='" + form + ".php']").parent().addClass("selected");
							var radio_id = $("[value='" + form + ".php']").parent().parent().parent().parent().data("uniqid");
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
//					console.log(checked_layout);
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
	$Ultimate_Radio_Image_Param = new Dfd_Check_Layout();
}
