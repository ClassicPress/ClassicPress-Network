/**
 * Backend JS for dfd_font_container_param - parameter
 */

(function ($) {
	/*font container*/
	vc.atts.dfd_font_container = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;
			options.tag = $block.find('.vc_font_container_form_field-tag-select input[type="radio"]:checked').val();
			options.font_size = $block.find('.vc_font_container_form_field-font_size-input').val();
			options.text_align = $block.find('.vc_font_container_form_field-text_align-select > option:selected').val();
			options.font_family = $block.find('.vc_font_container_form_field-font_family-select input[type="radio"]:checked').val();
			options.color = $block.find('.field-color-result').val();
			options.line_height = $block.find('.vc_font_container_form_field-line_height-input').val();
			options.letter_spacing = $block.find('.vc_font_container_form_field-letter_spacing-input').val();
			options.font_style_italic = $block.find('.vc_font_container_form_field-font_style-checkbox.italic').prop('checked') ? "1" : "";
			options.font_style_bold = $block.find('.vc_font_container_form_field-font_style-checkbox.bold').prop('checked') ? "1" : "";
			options.font_style_underline = $block.find('.vc_font_container_form_field-font_style-checkbox.underline').prop('checked') ? "1" : "";
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
			$field.find(".vc_font_container_form_field-color-input").wpColorPicker({
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
					$field.find(".field-color-result").val('');
				}
			});
//            $field.find(".vc_font_container_form_field-font_family-select").chosen({
//                disable_search_threshold: 10,
//                inherit_select_classes: true,
//                no_results_text: "Oops, nothing found!",
//                width: "100%"
//            });
			var $fontContainer = $field.find(".vc_font_container_form_field-font_family-select"),
				$google_fonts_param = $fontContainer.parents('[data-param_type="dfd_font_container"]').next('[data-vc-shortcode-param-name*="_google_fonts"]'),
				showHideElements = function () {
					var select = $('input[type="radio"]:checked', $fontContainer).val(),
						$google_fonts_param_checkbox_checked = $google_fonts_param.find('.dfd_single_checkbox_wrap input[type="checkbox"]:checked');

					if ($google_fonts_param.length > 0) {
						if (select != '') {
							if ($google_fonts_param_checkbox_checked.length > 0) {
								$google_fonts_param_checkbox_checked
									.click()
									.next('.dfd_single_checkbox')
									.find('.button-animation')
									.toggleClass('right-active');
							}

							$google_fonts_param
								.hide();
						} else {
							$google_fonts_param
								.show();
						}
					}
				};

			showHideElements();

			$fontContainer.find('input[type="radio"]').on('change', function () {
				$(this).parents('li').addClass('active').siblings().removeClass('active');
				showHideElements();
			});

			$field.find('.vc_font_container_form_field-tag-select input[type="radio"]').on('change', function () {
				$(this).parents('li').addClass('active').siblings().removeClass('active');
			});
		}
	};

	/*radio image*/
	vc.atts.radio_image_select = {
		render: function (param, value) {
			return value;
		},
		init: function (param, $field) {
			$field.find('.wpb_vc_param_value').imagepicker();
		}
	};

	/*radio advanced*/
	vc.atts.dfd_radio_advanced = {
		init: function (param, $field) {
			$field.find('input[type="radio"]').on('click', function () {
				$(this).parents('li').addClass('active').siblings().removeClass('active');
				$field.find('input[type="hidden"]').val($(this).val()).trigger('change');
			});
		}
	};

	/*border*/
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
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
					$field.find(".field-color-result").val('');
				}
			});
//            $field.find(".vc_container_form_field-border_style").chosen({
//                disable_search_threshold: 3,
//                inherit_select_classes: true,
//                no_results_text: "Oops, nothing found!",
//                width: "100%"
//            });
			if ($border_width_field.val() == '') {
				$field.find('.dfd-border-width').removeClass('expandable');
			}
			$field.find('.border-width-block input[type="number"]').change(function () {
				var $self = $(this);
				if ($self.hasClass('vc_container_form_field-border_width') && $self.val() != '') {
					$self.siblings('input[type="number"]').val('');
				} else if (!$self.hasClass('vc_container_form_field-border_width') && $self.val() != '') {
					$self.siblings('.vc_container_form_field-border_width').val('');
				}
			});
			$field.find('.dfd-border-expand').bind('click', function (e) {
				e.preventDefault();
				$(this).parents('.dfd-border-width').toggleClass('expandable');
			});
			var $borderStyle = $field.find('.vc_container_form_field-border_style'),
				showHideOptions = function () {
					if ($borderStyle.val() != 'none' && $borderStyle.val() != 'default') {
						$borderStyle.parents('.dfd-border-style').addClass('expanded').siblings().show();
					} else {
						$borderStyle.parents('.dfd-border-style').removeClass('expanded').siblings().hide();
					}
				};
			showHideOptions();
			$borderStyle.change(function () {
				showHideOptions();
			});
		},
	};

	/*box-shadow*/
	vc.atts.dfd_box_shadow_param = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;
			options.box_shadow_enable = $block.find('.vc_container_form_field-box_shadow_enable input[type="radio"]:checked').val();
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
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
					$field.find(".field-color-result").val('');
				}
			});
			var currValue = $field.find('.vc_container_form_field-box_shadow_enable input[type="radio"]:checked').val(),
				expandSection = function (val) {
					if (val != 'disable') {
						$field.find('.dfd-box-shadow-enable').addClass('expanded').siblings().show();
					} else {
						$field.find('.dfd-box-shadow-enable').removeClass('expanded').siblings().hide();
					}
				};

			expandSection(currValue);
			$field.find('.vc_container_form_field-box_shadow_enable input[type="radio"]').on('click', function () {
				$(this).attr('checked', 'checked').parents('li').addClass('active').siblings().removeClass('active').find('input[type="radio"]').removeAttr('checked');
				expandSection($(this).val());
			});
		},
	};

	/*gradient*/
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
				val = ($initValue.val() != '') ? $initValue.val() : '0% #f2f2f2,100% #f2f2f2',
				showHideOptions = function () {
					if ($gradStyle.val() != 'custom') {
						$gradStyle.parents('.dfd-gradient-direction').siblings('.dfd-gradient-dir-custom').hide();
						direction = $gradStyle.val();
					} else {
						$gradStyle.parents('.dfd-gradient-direction').siblings('.dfd-gradient-dir-custom').show();
						direction = $gradStyle.parents('.dfd-gradient-direction').siblings('.dfd-gradient-dir-custom').find('.vc_container_form_field-direction_custom').val() + 'deg';
					}
				};

			showHideOptions();

			$gradStyle.change(function () {
				showHideOptions();
				$gradientController.data('ClassyGradient').setOrientation(direction);
				$gradientDemo.find('.vc_container_form_field-gradient_css').val($gradientController.data('ClassyGradient').getCSS());
			});

			$field.find('.vc_container_form_field-direction_custom').on('change keyup', function () {
				direction = $(this).val() + 'deg';
				$gradientController.data('ClassyGradient').setOrientation(direction);
				$gradientDemo.find('.vc_container_form_field-gradient_css').val($gradientController.data('ClassyGradient').getCSS());
			});

			$gradientController.ClassyGradient({
				width: 450,
				orientation: direction,
				target: $gradientDemo,
				gradient: val,
				onChange: function (stringGradient, cssGradient) {
					var initValue = stringGradient.substring(stringGradient.indexOf(' background'));

					$gradientDemo.find('.vc_container_form_field-gradient_css').val(cssGradient);
					$initValue.val(initValue);
				}
			});
		},
	};

	/*margin*/
	vc.atts.dfd_margin_param = {
		$this: this,
		parse: function (param) {

			var options = {},
				string_pieces,
				string;
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var getAllValues = function () {
				options.margin_top = $block.find('.vc_margin_container_form_field-margin-top').val();
				options.margin_bottom = $block.find('.vc_margin_container_form_field-margin-bottom').val();
				options.margin_left = $block.find('.vc_margin_container_form_field-margin-left').val();
				options.margin_right = $block.find('.vc_margin_container_form_field-margin-right').val();
			};
			var setValues = function () {
				string_pieces = _.map(options, function (value, key) {
					if (_.isString(value) && 0 < value.length) {
						key = key.replace(/_/g, "-");
						return key + ':' + encodeURIComponent(value);
					}
				});
				string = $.grep(string_pieces, function (value) {
					return _.isString(value) && 0 < value.length;
				}).join('|');

				return string;
			};

			getAllValues();
			return setValues();

		},
	};

	/*responsive*/
	vc.atts.dfd_param_responsive_css = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;

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
			$('h4.resolution', $field).click(function (e) {
				$(this).parent('.dfd-responsive-properties-wrap').addClass('active').siblings().removeClass('active');
			});
		},
	};

	/*responsive*/
	vc.atts.dfd_param_responsive_text = {
		parse: function (param) {
			var $field = this.content().find('.wpb_vc_param_value[name=' + param.param_name + ']');
			var $block = $field.parent();
			var options = {},
				string_pieces,
				string;

			options.font_size_desktop = $block.find('.vc_container_form_field-font_size_desktop').val();
			options.line_height_desktop = $block.find('.vc_container_form_field-line_height_desktop').val();
			options.letter_spacing_desktop = $block.find('.vc_container_form_field-letter_spacing_desktop').val();

			options.font_size_tablet = $block.find('.vc_container_form_field-font_size_tablet').val();
			options.line_height_tablet = $block.find('.vc_container_form_field-line_height_tablet').val();
			options.letter_spacing_tablet = $block.find('.vc_container_form_field-letter_spacing_tablet').val();

			options.font_size_mobile = $block.find('.vc_container_form_field-font_size_mobile').val();
			options.line_height_mobile = $block.find('.vc_container_form_field-line_height_mobile').val();
			options.letter_spacing_mobile = $block.find('.vc_container_form_field-letter_spacing_mobile').val();

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
			$field.find('a.dfd-resolution-section-expand').click(function (e) {
				e.preventDefault();
				$(this).parents('.inner-wrap').toggleClass('expanded').find('input[type="number"]').each(function () {
					$(this).val('');
				});
			});
		}
	};

	/*delimiter*/
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
				palettes: true,
				change: function (event, ui) {
					var hexcolor = $(this).wpColorPicker('color');
					$field.find(".field-color-result").val(hexcolor);
				},
				clear: function () {
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
				showHideOptions = function () {
					if ($delimiterStyle.val() != 'none') {
						$delimiterStyle.parents('.dfd-delimiter-style').addClass('expanded').siblings().show();
					} else {
						$delimiterStyle.parents('.dfd-delimiter-style').removeClass('expanded').siblings().hide();
					}
				};
			showHideOptions();
			$delimiterStyle.change(function () {
				showHideOptions();
			});
		},
	};

	/*hotspot*/
	vc.atts.dfd_hotspot_param = {
		init: function (param, $field) {
			if(!$field.prev().data('vc-shortcode-param-name') || !$field.prev().data('vc-shortcode-param-name') == 'image') {
				return false;
			}
			
			var imgSrc = '',
				$imgInput = $field.prev().find('input[name="image"]'),
				previewImage = function() {
					if($field.prev().find('img').length > 0) {
						var id = $field.find('.dfd_hotspot_ls_var').attr('id');
						imgSrc = $field.prev().find('img').attr('src');
						imgSrc = imgSrc.replace('-150x150', '', imgSrc);
						if($field.find('img.dfd-hotspot-image').length > 0) {
							$field.find('img.dfd-hotspot-image').attr('src', imgSrc);
						} else {
							$field.find('.dfd-hotspot-image-holder').append('<img src="'+imgSrc+'" alt="Preview image" class="dfd-hotspot-image" />');
						}
						$field.find('.dfd-hotspot-image-holder').hotspot({
							mode:			'admin',
							LS_Variable:	'#'+id,
							popupTitle:		$field.find('.dfd-hotspot-image-holder').data('popup-title') ? $field.find('.dfd-hotspot-image-holder').data('popup-title') : 'Save',
							saveText:		$field.find('.dfd-hotspot-image-holder').data('save-text') ? $field.find('.dfd-hotspot-image-holder').data('save-text') : 'Save',
							closeText:		$field.find('.dfd-hotspot-image-holder').data('close-text') ? $field.find('.dfd-hotspot-image-holder').data('close-text') : 'Close',
							dataStuff: [
								{
									'property': 'Title',
									'default': 'Please enter title here'
								},
								{
									'property': 'Message',
									'default': 'Please enter content here'
								}
							]
						});
					}
				};
				
			previewImage();
			$imgInput.change(function() {
				previewImage();
			});
		},
	};
})(window.jQuery);