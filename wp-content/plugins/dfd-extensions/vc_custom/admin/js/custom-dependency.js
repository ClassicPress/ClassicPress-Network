(function($) {
	"use stricr";
	var dfdCustomDependencies = function() {
		$('[data-vc-shortcode="dfd_blog_posts"], [data-vc-shortcode="dfd_portfolio_module"], [data-vc-shortcode="dfd_gallery_module_shortcode"]').each(function() {
			/*if($('[data-vc-shortcode-param-name="items"]').find('[name="items"]').length > 0 && $('[data-vc-shortcode-param-name="items"]').find('[name="items"]').val() == 'single') {
				$('[data-vc-shortcode-param-name="columns"]').hide();
			} else {
				$('[data-vc-shortcode-param-name="columns"]').show();
			}*/
			if($('[name="post_content_style"]').find('option:selected').length > 0 && $('[name="post_content_style"]').find('option:selected').val() == 'full_front') {
				$('[name="post_style"]').next('.thumbnails.image_picker_selector').find('li span:contains("Masonry")').parents('li').hide();
				$('[name="post_style"]').next('.thumbnails.image_picker_selector').find('li span:contains("Metro")').parents('li').show();
				if($('[name="post_style"]').find('option:selected').val() == 'masonry') {
					$('[name="post_style"]').find('option:selected').removeAttr('selected').prev('option').attr('selected', 'selected');
					$('[name="post_style"]').trigger('change');
				}
			} else {
				$('[name="post_style"]').next('.thumbnails.image_picker_selector').find('li span:contains("Masonry")').parents('li').show();
				$('[name="post_style"]').next('.thumbnails.image_picker_selector').find('li span:contains("Metro")').parents('li').hide();
				if($('[name="post_style"]').find('option:selected').val() == 'metro') {
					$('[name="post_style"]').find('option:selected').removeAttr('selected').prev('option').attr('selected', 'selected');
					$('[name="post_style"]').trigger('change');
				}
			}
			if($('[name="post_style"]').find('option:selected').length > 0 && $('[name="post_style"]').find('option:selected').val() == 'carousel') {
				$('[data-vc-shortcode-param-name="post_tiled"]').hide();
			} else {
				$('[data-vc-shortcode-param-name="post_tiled"]').show();
			}
		});
	};
//	dfdCustomDependencies();
	$(window).load(function() {
		$('.vc_ui-panel-window').on('vcPanel.shown',dfdCustomDependencies);
	});
	$('body').on('change', '[data-vc-shortcode-param-name="items"]', dfdCustomDependencies);
	$('body').on('change', '[name="post_content_style"]', dfdCustomDependencies);
	$('body').on('change', '[name="post_style"]', dfdCustomDependencies);
	var dfdImageGalleryDepend = function() {
		if($('[data-vc-shortcode-param-name="images_style"]').find('option:selected').val() == 'carousel' && !$('[data-vc-shortcode-param-name="crop_images"]').find('input[type="checkbox"]').is(':checked')) {
			$('[data-vc-shortcode-param-name="image_width"]').addClass('invisible');
		} else {
			$('[data-vc-shortcode-param-name="image_width"]').removeClass('invisible');
		}
	};
	$(window).load(function() {
		$('.vc_ui-panel-window').on('vcPanel.shown',dfdImageGalleryDepend);
	});
	$('body').on('change', '[data-vc-shortcode-param-name="crop_images"]', dfdImageGalleryDepend);
})(jQuery);
(function($) {
	"use stricr";
	var dfdCustomDependenciesHover = function() {
		$('[name$="_hover_appear_effect"]').each(function() {
			if($(this).val() == 'dfd-3d-parallax' && $('[name$="_hover_main_decoration"]').length > 0) {
				$('[name$="_hover_main_decoration"]').siblings('ul').find('[value="buttons"]').parents('li').hide();
				if($('[name$="_hover_main_decoration"]').siblings('ul').find('[value="buttons"]').parents('li').hasClass('active')) {
					$('[name$="_hover_main_decoration"]').siblings('ul').find('[value="buttons"]').parents('li').prev('li').find('input[type="radio"]').click();
				}
			} else {
				$('[name$="_hover_main_decoration"]').siblings('ul').find('[value="buttons"]').parents('li').show();
			}
		});
	};
	$(window).load(function() {
		$('.vc_ui-panel-window').on('vcPanel.shown',dfdCustomDependenciesHover);
	});
	$('body').on('change', '[name$="_hover_appear_effect"]', dfdCustomDependenciesHover);
})(jQuery);