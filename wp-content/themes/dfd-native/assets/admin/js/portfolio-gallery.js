(function($) {
	$(document).ready(function($){
		"use strict";
		// Uploading files
		var my_product_gallery_frame;
		var $image_gallery_ids = $('#my_product_image_gallery');
		var $my_product_images = $('#my_product_images_container ul.my_product_images');

		$('.add_my_product_images').on( 'click', 'a', function( event ) {

			var $el = $(this),
				title = $el.data('title') ? $el.data('title') : 'Add Images to Portfolio Gallery',
				buttonText = $el.data('button-text') ? $el.data('button-text') : 'Add to gallery',
				deleteText = $el.data('delete-text') ? $el.data('delete-text') : 'Delete image',
				attachment_ids = $image_gallery_ids.val();

			event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( my_product_gallery_frame ) {
				my_product_gallery_frame.open();
				return;
			}

			// Create the media frame.
			my_product_gallery_frame = wp.media.frames.downloadable_file = wp.media({
				// Set the title of the modal.
				title: title,
				button: {
					text: buttonText
				},
				multiple: true
			});

			// When an image is selected, run a callback.
			my_product_gallery_frame.on( 'select', function() {

				var selection = my_product_gallery_frame.state().get('selection');

				selection.map( function( attachment ) {

					attachment = attachment.toJSON();

					if ( attachment.id ) {
						attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

						$my_product_images.append('\
								<li class="image" data-attachment_id="' + attachment.id + '">\
									<img src="' + attachment.url + '" />\
									<ul class="actions">\
										<li><a href="#" class="delete" title="'+deleteText+'">'+deleteText+'</a></li>\
									</ul>\
								</li>');
					}

				} );

				$image_gallery_ids.val( attachment_ids );
			});

			// Finally, open the modal.
			my_product_gallery_frame.open();
		});

		// Image ordering
		$my_product_images.sortable({
			items: 'li.image',
			cursor: 'move',
			scrollSensitivity:40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			helper: 'clone',
			opacity: 0.65,
			placeholder: 'wc-metabox-sortable-placeholder',
			start:function(event,ui){
				ui.item.css('background-color','#f6f6f6');
			},
			stop:function(event,ui){
				ui.item.removeAttr('style');
			},
			update: function(event, ui) {
				var attachment_ids = '';

				$('#my_product_images_container ul li.image').css('cursor','default').each(function() {
					var attachment_id = $(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$image_gallery_ids.val( attachment_ids );
			}
		});

		// Remove images
		$('#my_product_images_container').on( 'click', 'a.delete', function() {

			$(this).closest('li.image').remove();

			var attachment_ids = '';

			$('#my_product_images_container ul li.image').css('cursor','default').each(function() {
				var attachment_id = $(this).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );

			return false;
		} );

	});
})(jQuery);