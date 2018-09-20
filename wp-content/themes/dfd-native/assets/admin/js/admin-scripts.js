(function($) {
	"use strict";
	var initColorpicker = function() {
		$('.dfd-widget-colorpicker-field').each(function() {
			$(this).wpColorPicker();
		});
	};
	$(document).ready(function() {
		$('body:not(.post-type-product)').on('click','.upload_image_button',function(e) {
			var custom_uploader, attachment;
			var $self;
			$self = $(this);
			e.preventDefault();
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}

			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				multiple: false
			});

			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON();
				$self.siblings('.upload_image').val(attachment.url);
				$self.siblings('.image_uploaded').attr('src',attachment.url).css('display','block');
				custom_uploader.close();
			});

			//Open the uploader dialog
			custom_uploader.open();
		});
		$('body').on('click','.remove_image_button',function(e) {
			var $self = $(this);
			e.preventDefault();
			var $self = $(this);
			$self.siblings('.upload_image').val('');
			$self.siblings('.image_uploaded').attr('src','').css('display','none');
		});
		$('.edit-menu-item-_dfd_mega_menu_enabled').each(function() {
			var $self = $(this);
			var $image_select = $self.parent().parent().siblings('.field-_dfd_mega_menu_image');
			var $image_position = $self.parent().parent().siblings('.field-_dfd_mega_menu_bg_position');
			var $image_repeat = $self.parent().parent().siblings('.field-_dfd_mega_menu_bg_repeat');
			var $columns_limit = $self.parent().parent().siblings('.field-_dfd_mega_menu_limit_columns');
			if($self.val() == 0) {
				$image_select.hide();
				$image_position.hide();
				$image_repeat.hide();
				$columns_limit.hide();
			}
			$self.change(function() {
				if($self.val() == 1) {
					$image_select.show();
					$image_position.show();
					$image_repeat.show();
					$columns_limit.show();
				}else {
					$image_select.hide();
					$image_position.hide();
					$image_repeat.hide();
					$columns_limit.hide();
				}
			});
		});

		var menu_icon = $("input.edit-menu-item-_dfd_mega_menu_icon");

		if (0 == menu_icon.siblings("a").length && false == menu_icon.hasClass("iconname")) {
			menu_icon.addClass("iconname").after("<a href=\"#\" class=\"button crum-icon-add\">Add icon</a>");
		}
		
		initColorpicker();
	});
	$(document).on('widget-added widget-updated', initColorpicker);
})(jQuery);