(function ($) {
	vc.atts.dfd_gradient = {
        parse: function (param) {
            var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
            var $block = $field.parent();
            var options = {},
                string_pieces,
                string;
            options.gradient_style = $block.find('.vc_container_form_field-gradient_style').val();
            options.gradient_custom_direction = $block.find('.vc_container_form_field-direction_custom').val();
            options.gradient_css = $block.find('.vc_container_form_field-gradient_css').val();
            options.gradient_value = $block.find('.vc_container_form_field-gradient_value').val();
            string_pieces = _.map(options, function (value, key) {
                if (_.isString(value) && 0 < value.length) {
                    return key + ':' + encodeURIComponent(value);
                }
            });
            string = $.grep(string_pieces, function (value) {
                return _.isString(value) && 0 < value.length;
            }).join('|');
            return string;
        },
        init: function (param, $field) {
			var $gradStyle = $field.find('.vc_container_form_field-gradient_style'),
				direction = 'left',
				$gradientController = $field.find(".dfd-gradient-controls"),
				$gradientDemo = $field.find('.dfd-gradient-demo'),
				$initValue = $gradientDemo.find('.vc_container_form_field-gradient_value'),
				val = ($initValue.val() != '') ? $initValue.val() : '0% #f2f2f2,100% #f2f2f2'
				showHideOptions = function() {
					if($gradStyle.val() != 'custom') {
						$gradStyle.parents('.dfd-gradient-direction').siblings('.dfd-gradient-dir-custom').hide();
						direction = $gradStyle.val();
					} else {
						$gradStyle.parents('.dfd-gradient-direction').siblings('.dfd-gradient-dir-custom').show();
						direction = $gradStyle.parents('.dfd-gradient-direction').siblings('.dfd-gradient-dir-custom').find('.vc_container_form_field-direction_custom').val() + 'deg';
					}
				};
				
			showHideOptions();
			
			$gradStyle.change(function() {
				showHideOptions();
				$gradientController.data('ClassyGradient').setOrientation(direction);
			});
			
			$field.find('.vc_container_form_field-direction_custom').on('keyup', function() {
				direction = $(this).val() + 'deg';
				$gradientController.data('ClassyGradient').setOrientation(direction);
			});
			
			/*
			$gradStyle.chosen({
                disable_search_threshold: 3,
                inherit_select_classes: true,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
			*/
			
            $gradientController.ClassyGradient({
				width: 450,
				orientation: direction,
				target: $gradientDemo,
				gradient: val,
				onChange: function(stringGradient,cssGradient) {
					var initValue = stringGradient.substring(stringGradient.indexOf(' background'));
					
					$gradientDemo.find('.vc_container_form_field-gradient_css').val(cssGradient);
					$initValue.val(initValue);
				}
			});
        },
    };
})(window.jQuery);