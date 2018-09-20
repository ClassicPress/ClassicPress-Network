(function ($) {
	vc.atts.dfd_delimiter = {
        parse: function (param) {
            var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
            var $block = $field.parent();
            var options = {},
                string_pieces,
                string;
            options.delimiter_style = $block.find('.vc_container_form_field-delimiter_style > option:selected').val();
            options.delimiter_width = $block.find('.vc_container_form_field-delimiter_width').val();
            options.delimiter_height = $block.find('.vc_container_form_field-delimiter_height').val();
            options.delimiter_color = $block.find('.field-color-result').val();
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
            $field.find(".vc_container_form_field-delimiter_style").chosen({
                disable_search_threshold: 3,
                inherit_select_classes: true,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
			var $delimiterStyle = $field.find('.vc_container_form_field-delimiter_style'),
				showHideOptions = function() {
					if($delimiterStyle.val() != 'none') {
						$delimiterStyle.parents('.dfd-delimiter-style').addClass('expanded').siblings().show();
					} else {
						$delimiterStyle.parents('.dfd-delimiter-style').removeClass('expanded').siblings().hide();
					}
				};
			showHideOptions();
			$delimiterStyle.change(function() {
				showHideOptions();
			});
        },
    };
})(window.jQuery);