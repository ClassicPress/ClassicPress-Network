(function($){
	"use strict";
	$.dfdIconManager = $.dfdIconManager || {};
	$.dfdIconManager = {
		isFiltered: false,
		getInst: function(){
			return this;
		},
		upload_active: function(event){
			event.preventDefault();
			var jQueryel = $(this);
			var frame;
			var libFilter;
			var selector = $(this).parents(".wrap");
			selector = $(selector[0]);
			// Get library filter data

			var filter = selector.find('.library-filter').data('lib-filter');
			// Must exist to do decoding

			if(filter !== undefined){
				if(filter !== ''){
					libFilter = [
					];
					this.isFiltered = true;
					filter = decodeURIComponent(filter);
					filter = JSON.parse(filter);
					$.each(filter, function(index, value){
						libFilter.push(value);
					});
				}
			}

			// Create the media frame.
			frame = wp.media(
					{
						multiple: false,
						library: {
							type: libFilter //Only allow images
						},
						// Set the title of the modal.
						title: jQueryel.data('choose'),
						// Customize the submit button.
						button: {
							// Set the text of the button.
							text: jQueryel.data('update')
									// Tell the button not to close the modal, since we're
									// going to refresh the page when the image is selected.
						}
					}
			);
			// When an image is selected, run a callback.
			frame.on(
					'select', function(){

						// Grab the selected attachment.
						var attachment = frame.state().get('selection').first();
						frame.close();


//						selector.find('.redux_upload_file_name').text(attachment.attributes.filename);
//						selector.find('.upload').val(attachment.attributes.url);
						selector.find('.upload_file_id').val(attachment.attributes.id);
//						selector.find('.upload-height').val(attachment.attributes.height);
//						selector.find('.upload-width').val(attachment.attributes.width);
//						console.log(selector.find('.upload_file'));
						redux_change(selector.find('.upload_file_id'));

						var thumbSrc = attachment.attributes.url;
						if(typeof attachment.attributes.sizes !== 'undefined' && typeof attachment.attributes.sizes.thumbnail !== 'undefined'){
							thumbSrc = attachment.attributes.sizes.thumbnail.url;
						} else if(typeof attachment.attributes.sizes !== 'undefined'){
							var height = attachment.attributes.height;

							for(var key in attachment.attributes.sizes) {
								var object = attachment.attributes.sizes[key];

								if(object.height < height){
									height = object.height;
									thumbSrc = object.url;
								}
							}
						} else {
							thumbSrc = attachment.attributes.icon;
						}
//						selector.find('.upload-thumbnail').val(thumbSrc);
//						if(!selector.find('.upload').hasClass('noPreview')){
						var html = "<div class='updated'><p>Please click the button 'Save Changes'.<br/>to upload icons</p></div>";
						selector.find('.screenshot').empty().hide().append('<img class="redux-option-image" src="' + thumbSrc + '">' + html).slideDown('fast');
//						}

//						selector.find('.remove-image').removeClass('hide');//show "Remove" button
//						selector.find('.redux-background-properties').slideDown();
					}
			);
			// Finally, open the modal.
			frame.open();
		},
		media_new_insert: function(file_frame, options)
		{

		},
		addFile: function(){

		},
		init: function(){
			this.dispatchEvent();
		},
		in_array: function(arr, el){
			for(var el_arr in arr) {
				if(arr[el_arr] == el){
					return true;
				}
			}
			return false;
		},
		icon_remove: function(event){
			event.preventDefault();
			var jQueryel = $(this);
			jQueryel.parents(".postbox").addClass("removed");
			var atr = jQueryel.data("delete");
			var previousVal = $(".delete_file_id").val();
			if(previousVal == ""){
				previousVal = [
				];
			} else {
				previousVal = JSON.parse(previousVal);
			}
			if($.dfdIconManager.in_array(previousVal, atr)){
				return false;
			}
			previousVal.push(atr);
			previousVal = JSON.stringify(previousVal);
			$(".delete_file_id").val(previousVal);
			var html = "<div class='updated'><p>Please click the button 'Save Changes'.<br/>to remove selected icons</p></div>";
			$(".redux-container-icon_manager .screenshot").hide();
			$(".redux-container-icon_manager .screenshot").append(html).slideDown("fast");
			jQueryel.remove();
		},
		icon_in_use: function(event){
//			event.preventDefault();
			var self = $(this);
//			console.log(self.attr("checked"));
			var is_checked = self.attr("checked");
			var atr = self.data("select");
			if(is_checked){
				$.dfdIconManager.addToActice(atr);
//				$.dfdIconManager.addToStat(self, atr, "add");
			} else {
				$.dfdIconManager.addToInActive(atr);
			}
			$.dfdIconManager.addToStat();
//			console.log($.dfdIconManager.arrToAct);
//			console.log($.dfdIconManager.arrToDel);

		},
		addToActice: function(atr){
			this.triggerprocces(this.arrToDel, this.arrToAct, atr);
		},
		addToInActive: function(atr){
			this.triggerprocces(this.arrToAct, this.arrToDel, atr);
		},
		triggerprocces: function(arrToCheck, arrToAdd, atr){
			if($.dfdIconManager.in_array(arrToCheck, atr)){
				var index = arrToCheck.indexOf(atr);
				if(index > -1){
					arrToCheck.splice(index, 1);
				}
			}
			if($.dfdIconManager.in_array(arrToAdd, atr)){
				var index = arrToAdd.indexOf(atr);
				if(index > -1){
					arrToAdd.splice(index, 1);
				}
			} else {
				arrToAdd.push(atr);
			}
		},
		arrToAct: [
		],
		arrToDel: [
		],
		addToStat: function(){
			var res = {};
			res["ToActive"]= this.arrToAct;
			res["ToInActive"]= this.arrToDel;
			console.log(res);
			var previousVal = JSON.stringify(res);
			$(".select_file_id").val(previousVal);
		},
		dispatchEvent: function(){
			$("body").on('click', '.icon_upload_font_button', this.upload_active);
			$("body").on('click', '.dfd_del_icon', this.icon_remove);
			$("body").on('click', '.sel_use_icon', this.icon_in_use);
		},
	};
	$(document).ready(function(){
		$.dfdIconManager.init();
	});
})(jQuery);