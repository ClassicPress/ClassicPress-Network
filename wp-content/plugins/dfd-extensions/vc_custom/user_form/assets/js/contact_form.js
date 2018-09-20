
(function($){

	if(typeof global_dfd == 'undefined' || global_dfd === null){
		global_dfd = {};
	}
	;
	if(typeof _dfdcf == 'undefined' || _dfdcf === null){
		_dfdcf = {};
	}
	var defaults = {};

	var methods = {
		init: function(params){
			var options = $.extend({}, defaults, params);

			this.ajaxForm({
				beforeSubmit: function(arr, $form, options){
					$form.wpcf7ClearResponseOutput();

//                $form.wpcf7ClearResponseOutput();
//                $form.find('[aria-invalid]').attr('aria-invalid', 'false');
					$form.find('.cssload-spin-box2').css({"display": 'block'});
					return true;
				},
				beforeSerialize: function($form, options){
					$form.find('[placeholder].placeheld').each(function(i, n){
						$(n).val('');
					});
					return true;
				},
				data: {'_dfd_is_ajax_call': 1},
				dataType: 'json',
				success: $.dfdAjaxSuccess,
				error: function(xhr, status, error, $form){
					var e = $('<div class="ajax-error"></div>').text(error.message);
					$form.after(e);
				}
			});
			this.find('.wpcf7-submit').wpcf7AjaxLoader();

		}

	};
	$.fn.wpcf7AjaxLoader = function(){
		return this.each(function(){
//			var loader = $('<img class="ajax-loader" />')
//					.attr({src: _dfdcf.loaderUrl, alt: _dfdcf.sending})
//					.css('display', 'none');
			var loader = '<div class="cssload-spin-box2"></div>';
			$(this).after(loader);
		});
	};
	$.fn.wpcf7ClearResponseOutput = function(){
		return this.each(function(){
//			$(this).find('div.wpcf7-response-output').hide().empty();
			$(this).find('div.wpcf7-response-output').hide("fast").css("opacity",0);
			$(this).find('div.wpcf7-response-output span').text("");
			$(this).find('.cssload-spin-box2').css({"display": 'none'});
			$(this).find('.error').remove();
			$(this).find('.field_error').removeClass("field_error");
		});
	};

	$.dfdAjaxSuccess = function(data, status, xhr, $form){
		if(!$.isPlainObject(data) || $.isEmptyObject(data)){
			return;
		}
		$form.wpcf7ClearResponseOutput();
		var $responseOutput = $form.find('div.wpcf7-response-output');
		var message = "";
		$responseOutput.addClass("success");
		$.each(data.fileds.validation, function(i, n){
//            console.log(i);
			sel = $form.find("[name*=" + i + "]");
//            sel.remove();
			$.addErrorToField(sel, n);
			$responseOutput.removeClass("success");

		});
		$.wpcf7UpdateScreenReaderResponse($form, data);
//		$responseOutput.append(data.fileds.validation).slideDown('fast');
//		$responseOutput.append(data.fileds.validation).css({"opacity":"1","display":"block"});
		$responseOutput.append(data.fileds.validation).css({"display":"table"}).animate({opacity:1},70);
//        console.log(data);
//        console.log(xhr);
//        console.log($form);
	};
	$.addErrorToField = function($this, message){
//		$this.parent().parent().find(".error").remove();
//		var d = document;
//		var odv = d.createElement("span");
//		odv.style.display = "block";
//		odv.innerHTML = message;
//		odv.className = "error";
		$this.parent().parent().removeClass("field_error");
		$this.parent().parent().addClass("field_error");
		//$this.parent().parent().prepend(odv).find(".error").animate({opacity: 1}, 70);
	};
	$.wpcf7UpdateScreenReaderResponse = function($form, data){

		var $response = $form.find('div.wpcf7-response-output span');
		if(data.fileds.validation && !data.is_mail_send){

			var $invalids = _dfdcf.ErrorMessage;

			$response.append($invalids);

		} else {
			$form.find('input[type=text],  textarea').each(function(i, n){
				$(n).val('');
				$(n).text('');
				$(n).empty();
			});
			$form.find('input[type=checkbox]').each(function(i, n){
				$(n).prop("checked","");
				$(n).trigger("change");
			});
			message = _dfdcf.SuccessMessage;
//			$response.css("border", "2px solid #279E71");
			$response.append(message);
		}
	};
	$.fn.dfdContactForm = function(method){

		if(methods[method]){
			return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if(typeof method === 'object' || !method){
			return methods.init.apply(this, arguments);
		} else {
			$.error(method);
		}
	};

	$('.dfd_contact_form').dfdContactForm();

	$(".reloadCap").live("click", function(){
		id = $(this).attr("data-id");
//        console.log(dfdreCaptcha.widgets);
		grecaptcha.reset(dfdreCaptcha.widgets[id]);
	});
	$(document).ready(function(){
		global_dfd.init($);
	});


	global_dfd.init = function($){
		/*
		 * remove empty elements in form
		 */
		$("p.border-bottom span.wpcf7-form-control-wrap").each(function(index){
			$this = $(this);
			el = $this.find("input,textarea,select");
			if(!el.length){
//				$this.parent("p").remove();
			}
		});
		/**
		 * remove last margin
		 */
		$(".dfd-contact-form-style-compact div p.border-bottom").last().css("margin-bottom", 0);
		/**
		 * replace all textarea in dfd-contact-form-style-1 to input
		 */
//		$(".dfd-contact-form-style-1 textarea").each(function(index){
//			$this = $(this);
//			placehplder = $this.attr("placeholder");
//			name = $this.attr("name");
//			defvalue = $this.text();
//			input = "<input type='text' placeholder='" + placehplder + "' name='" + name + "' value='" + defvalue + "'>";
//			$this.parent().append(input);
//			$this.remove();
//		});
		/**
		 * add focus effect
		 */
		$('form.wpcf7-form input:not([type="submit"]), form.wpcf7-form textarea').focus(function(e){
			$(this).parent().addClass('active').siblings().addClass('active').find("span").addClass('active');
		}).blur(function(){
			$(this).parent().removeClass('active').siblings().removeClass('active').find("span").removeClass('active');
		});
		$(".dfd_contact_form.preset3").on("mouseover",".dk-select",function(){
			$(this).parent().addClass("dk-hover");
		});
		$(".dfd_contact_form.preset3").on("mouseleave",".dk-select",function(){
			$(this).parent().removeClass("dk-hover");
		});
		/**
		 * remove all errors
		 */
		$(".dfd_contact_form input, .dfd_contact_form textarea, .dfd_contact_form radio, .dfd_contact_form checkbox, .dk_container").live("focus", function(){
//			$(this).parent().parent().find(".error").remove();
			$(this).parent().parent().removeClass("field_error");
		});
		$(".error").live("click", function(){
			$(this).remove();
		});
		$(".wpcf7-response-output").on("click","i",function(){
//			$(this).parent().slideUp("fast");
			$(this).parent().animate({opacity:0},300,function(){
				$(this).hide();
			});
		});
	};
})(jQuery);

if(typeof dfdreCaptcha == 'undefined' || dfdreCaptcha === null){
	dfdreCaptcha = {};
}
;
dfdreCaptcha.widgets = [
];
dfdreCaptcha.el = [
];
dfdreCaptcha.sitekey = [
];
dfdreCaptcha.add = function(el){
	this.el.push(el);
};
dfdreCaptcha.addSitekey = function(key){
	this.sitekey["sitekey"] = key;
};
dfdreCaptcha.show = function(){

	for(elm in this.el) {
		var id = this.el[elm];
		this.widgets[id] = grecaptcha.render("" + id + "", {
			'sitekey': this.sitekey["sitekey"],
		});

	}
};
var onloadCallback = function(){
	dfdreCaptcha.show();
};
