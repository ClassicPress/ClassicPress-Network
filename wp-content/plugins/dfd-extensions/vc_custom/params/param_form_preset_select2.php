<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 */
if (!class_exists('Dfd_Form_Preset_Select')) {

	class Dfd_Form_Preset_Select {

		function __construct() {
			if (function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_form_preset_select', array (&$this, 'dfd_form_preset_select'));
			}
		}

		function dfd_form_preset_select($settings, $value) {
			ob_start();
			$output = '';
			$css_option = str_replace('#', 'hash-', vc_get_dropdown_option($settings, $value));
			$output .= '<select style="display:none;" name="'
					  . $settings['param_name']
					  . '" class="wpb_vc_param_value wpb-input wpb-select '
					  . $settings['param_name']
					  . ' ' . $settings['type']
					  . ' ' . $css_option
					  . '" data-option="' . $css_option . '">';
			if (is_array($value)) {
				$value = isset($value['value']) ? $value['value'] : array_shift($value);
			}
			if (!empty($settings['value'])) {
				foreach ($settings['value'] as $index => $data) {
					if (is_numeric($index) && ( is_string($data) || is_numeric($data) )) {
						$option_label = $data;
						$option_value = $data;
					} elseif (is_numeric($index) && is_array($data)) {
						$option_label = isset($data['label']) ? $data['label'] : array_pop($data);
						$option_value = isset($data['value']) ? $data['value'] : array_pop($data);
					} else {
						$option_value = $data;
						$option_label = $index;
					}
					$selected = '';

					if ($value !== '' && (string) $option_value === (string) $value) {
						$selected = ' selected';
					}
					$option_class = str_replace('#', 'hash-', $option_value);
					$output .= '<option class="' . $option_class . '" value="' . $option_value . '"' . $selected . '>'
							  . htmlspecialchars($option_label) . '</option>';
				}
			}
			$output .= '</select>';
			?>
			<div class="ult-radio-image-box">
				<?php
				$tooltip = array (
						"preset1" => esc_html__("Bordered", 'dfd-native'),
						"preset2" => esc_html__("Boxed", 'dfd-native'),
						"preset3" => esc_html__("Simple", 'dfd-native'),
				);
				$preset_img_array = array (
						/* preset value => image name */
						"preset1" => "standart",
						"preset2" => "general-border",
						"preset3" => "simple",
				);
				if (!empty($settings['value'])) {
					foreach ($settings['value'] as $index => $data) {
						$selected = '';
						if ($value !== '' && (string) $data === (string) $value) {
							$selected = 'checked';
						}
						$img_name = "";
						$img = "";
						if (key_exists($data, $preset_img_array)) {
							$img_name = $preset_img_array[$data];
							$img = Dfd_User_Form_template_manager::instance()->getPresetStyleImgByname($img_name);
						}
						?>
						<label>
							<input type="radio" style="display: none;" name="dfd_form_preset_select" class="dfd_form_preset_select" value="<?php echo esc_attr($data); ?>" <?php echo $selected; ?>>
							<img class="pattern-background" src="<?php echo esc_url($img); ?>">
							<span class="image-picker-tooltip"><?php echo array_key_exists($data, $tooltip) ? $tooltip[$data]:"";?></span>
						</label>
						<?php
					}
				}
				?>
			</div>
			<style>
				.wpb_el_type_dfd_form_preset_select label{
					position: relative;
				}
				.wpb_el_type_dfd_form_preset_select .image-picker-tooltip{
					margin-top: 0px;
				}
			</style>
			<script type="text/javascript">
				(function($){
					var Dfd_form_preset_select = {
						init: function(){
							$(".dfd_form_preset_select").click(function(){
								value = $(this).attr("value");
								$("select[name='preset']").val(value);
								$("select[name='preset']").change();

							});
						},
						resetCheckboxes: function(){
							$(".fake_check_layout").each(function(index){
								$(this).attr("checked", false);
							});
							$("#" + Dfd_User_Form.params.fake_checkbox + "-" + Dfd_User_Form.params.data_val).click();
						},
					};
					Dfd_form_preset_select.init();

				})(jQuery);

			</script>	
			<?php
			$output .= ob_get_clean();

			return $output;
		}

	}

}

if (class_exists('Dfd_Form_Preset_Select')) {
	new Dfd_Form_Preset_Select();
}
