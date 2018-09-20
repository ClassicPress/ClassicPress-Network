(function ($) {
	vc.atts.dfd_param_responsive_css = {
        parse: function (param) {
            var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
            var $block = $field.parent();
            var options = {},
                string_pieces,
                string,
				resolutions = ['desktop','tablet','mobile'],
				props = ['margin','padding'];
			
//            options.margin_desktop = $block.find('.vc_container_form_field-margin_desktop').val();
            options.margin_top_desktop = $block.find('.vc_container_form_field-margin_top_desktop').val();
            options.margin_bottom_desktop = $block.find('.vc_container_form_field-margin_bottom_desktop').val();
            options.margin_left_desktop = $block.find('.vc_container_form_field-margin_left_desktop').val();
            options.margin_right_desktop = $block.find('.vc_container_form_field-margin_right_desktop').val();
//            options.border_desktop = $block.find('.vc_container_form_field-border_desktop').val();
            options.border_top_desktop = $block.find('.vc_container_form_field-border_top_desktop').val();
            options.border_bottom_desktop = $block.find('.vc_container_form_field-border_bottom_desktop').val();
            options.border_left_desktop = $block.find('.vc_container_form_field-border_left_desktop').val();
            options.border_right_desktop = $block.find('.vc_container_form_field-border_right_desktop').val();
//            options.padding_desktop = $block.find('.vc_container_form_field-padding_desktop').val();
            options.padding_top_desktop = $block.find('.vc_container_form_field-padding_top_desktop').val();
            options.padding_bottom_desktop = $block.find('.vc_container_form_field-padding_bottom_desktop').val();
            options.padding_left_desktop = $block.find('.vc_container_form_field-padding_left_desktop').val();
            options.padding_right_desktop = $block.find('.vc_container_form_field-padding_right_desktop').val();
			
//            options.margin_tablet = $block.find('.vc_container_form_field-margin_tablet').val();
            options.margin_top_tablet = $block.find('.vc_container_form_field-margin_top_tablet').val();
            options.margin_bottom_tablet = $block.find('.vc_container_form_field-margin_bottom_tablet').val();
            options.margin_left_tablet = $block.find('.vc_container_form_field-margin_left_tablet').val();
            options.margin_right_tablet = $block.find('.vc_container_form_field-margin_right_tablet').val();
//            options.border_tablet = $block.find('.vc_container_form_field-border_tablet').val();
            options.border_top_tablet = $block.find('.vc_container_form_field-border_top_tablet').val();
            options.border_bottom_tablet = $block.find('.vc_container_form_field-border_bottom_tablet').val();
            options.border_left_tablet = $block.find('.vc_container_form_field-border_left_tablet').val();
            options.border_right_tablet = $block.find('.vc_container_form_field-border_right_tablet').val();
//            options.padding_tablet = $block.find('.vc_container_form_field-padding_tablet').val();
            options.padding_top_tablet = $block.find('.vc_container_form_field-padding_top_tablet').val();
            options.padding_bottom_tablet = $block.find('.vc_container_form_field-padding_bottom_tablet').val();
            options.padding_left_tablet = $block.find('.vc_container_form_field-padding_left_tablet').val();
            options.padding_right_tablet = $block.find('.vc_container_form_field-padding_right_tablet').val();
			
//            options.margin_mobile = $block.find('.vc_container_form_field-margin_mobile').val();
            options.margin_top_mobile = $block.find('.vc_container_form_field-margin_top_mobile').val();
            options.margin_bottom_mobile = $block.find('.vc_container_form_field-margin_bottom_mobile').val();
            options.margin_left_mobile = $block.find('.vc_container_form_field-margin_left_mobile').val();
            options.margin_right_mobile = $block.find('.vc_container_form_field-margin_right_mobile').val();
//            options.border_mobile = $block.find('.vc_container_form_field-border_mobile').val();
            options.border_top_mobile = $block.find('.vc_container_form_field-border_top_mobile').val();
            options.border_bottom_mobile = $block.find('.vc_container_form_field-border_bottom_mobile').val();
            options.border_left_mobile = $block.find('.vc_container_form_field-border_left_mobile').val();
            options.border_right_mobile = $block.find('.vc_container_form_field-border_right_mobile').val();
//            options.padding_mobile = $block.find('.vc_container_form_field-padding_mobile').val();
            options.padding_top_mobile = $block.find('.vc_container_form_field-padding_top_mobile').val();
            options.padding_bottom_mobile = $block.find('.vc_container_form_field-padding_bottom_mobile').val();
            options.padding_left_mobile = $block.find('.vc_container_form_field-padding_left_mobile').val();
            options.padding_right_mobile = $block.find('.vc_container_form_field-padding_right_mobile').val();
			
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
			$('h4.resolution', $field).click(function(e) {
				$(this).parent('.dfd-responsive-properties-wrap').addClass('active').siblings().removeClass('active');
			});
        },
    };
})(window.jQuery);