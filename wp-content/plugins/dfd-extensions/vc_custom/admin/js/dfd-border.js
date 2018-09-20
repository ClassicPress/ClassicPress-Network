(function ($) {
	vc.atts.dfd_param_border = {
        parse: function (param) {
            var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
            var $block = $field.parent();
            var options = {},
                string_pieces,
                string;
            options.border_style = $block.find('.vc_container_form_field-border_style > option:selected').val();
            options.border_width = $block.find('.vc_container_form_field-border_width').val();
            options.border_top_width = $block.find('.vc_container_form_field-border_top_width').val();
            options.border_bottom_width = $block.find('.vc_container_form_field-border_bottom_width').val();
            options.border_left_width = $block.find('.vc_container_form_field-border_left_width').val();
            options.border_right_width = $block.find('.vc_container_form_field-border_right_width').val();
            options.border_radius = $block.find('.vc_container_form_field-border_radius').val();
            options.border_color = $block.find('.field-color-result').val();
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
			var $border_width_field = $field.find('.vc_container_form_field-border_width');
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
            $field.find(".vc_container_form_field-border_style").chosen({
                disable_search_threshold: 3,
                inherit_select_classes: true,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
			if($border_width_field.val() == '') {
				$field.find('.dfd-border-width').removeClass('expandable');
			}
			$field.find('.border-width-block input[type="number"]').change(function() {
				var $self = $(this);
				if($self.hasClass('vc_container_form_field-border_width') && $self.val() != '') {
					$self.siblings('input[type="number"]').val('');
				} else if(!$self.hasClass('vc_container_form_field-border_width') && $self.val() != '') {
					$self.siblings('.vc_container_form_field-border_width').val('');
				}
			});
			$field.find('.dfd-border-expand').bind('click', function(e) {
				e.preventDefault();
				$(this).parents('.dfd-border-width').toggleClass('expandable');
			});
			var $borderStyle = $field.find('.vc_container_form_field-border_style'),
				showHideOptions = function() {
					if($borderStyle.val() != 'none') {
						$borderStyle.parents('.dfd-border-style').addClass('expanded').siblings().show();
					} else {
						$borderStyle.parents('.dfd-border-style').removeClass('expanded').siblings().hide();
					}
				};
			showHideOptions();
			$borderStyle.change(function() {
				showHideOptions();
			});
        },
    };
})(window.jQuery);