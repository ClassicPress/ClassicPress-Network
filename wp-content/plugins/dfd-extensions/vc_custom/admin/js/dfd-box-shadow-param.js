(function ($) {
	vc.atts.dfd_box_shadow_param = {
        parse: function (param) {
            var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
            var $block = $field.parent();
            var options = {},
                string_pieces,
                string;
            options.box_shadow_enable = $block.find('.vc_container_form_field-box_shadow_enable > option:selected').val();
            options.shadow_horizontal = $block.find('.vc_container_form_field-shadow_horizontal').val();
            options.shadow_vertical = $block.find('.vc_container_form_field-shadow_vertical').val();
            options.shadow_blur = $block.find('.vc_container_form_field-shadow_blur').val();
            options.shadow_spread = $block.find('.vc_container_form_field-shadow_spread').val();
            options.box_shadow_color = $block.find('.field-color-result').val();
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
            $field.find(".vc_container_form_field-color-input").wpColorPicker({
				palettes:   true,
                change:		function( event, ui ) {
                    var hexcolor = $( this ).wpColorPicker( 'color' );
                    $field.find(".field-color-result").val(hexcolor);
                },
                clear: function() {
                    $field.find(".field-color-result").val('');
                }
			});
            $field.find(".vc_container_form_field-box_shadow_enable").chosen({
                disable_search_threshold: 3,
                inherit_select_classes: true,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
			var $borderStyle = $field.find('.vc_container_form_field-box_shadow_enable'),
				showHideOptions = function() {
					if($borderStyle.val() != 'disable') {
						$borderStyle.parents('.dfd-box-shadow-enable').addClass('expanded').siblings().show();
					} else {
						$borderStyle.parents('.dfd-box-shadow-enable').removeClass('expanded').siblings().hide();
					}
				};
			showHideOptions();
			$borderStyle.change(function() {
				showHideOptions();
			});
        },
    };
})(window.jQuery);