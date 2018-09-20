(function($) {
	'use strict';

	var dfd_share = dfd_share || {};

	dfd_share.share = function () {
		var shareItems = [];

		if ($('[data-share]').length > 0) {
			$('[data-share]').each(function (index) {
				shareItems[index] = {};
				shareItems[index].self = $(this);
				if(!shareItems[index].self.hasClass('initialized')) {
					shareItems[index].self.addClass('initialized');
					
					shareItems[index].url = shareItems[index].self.data('share-url');
					shareItems[index].countFacebook = shareItems[index].self.find('[data-share-count="facebook"]');
					shareItems[index].countGoogle = shareItems[index].self.find('[data-share-count="google"]');
					shareItems[index].SHARE_URL = typeof shareItems[index].url === 'undefined' || shareItems[index].url === '' ? window.location.href : shareItems[index].url;
					$.ajax({
						url: ajax_var.url,
						type: 'POST',
						dataType: 'json',
						data: {
							action: 'dfd_share_counter',
							nonce: ajax_var.nonce,
							url: shareItems[index].SHARE_URL,
							counts: {
								facebook: shareItems[index].countFacebook.length,
								google: shareItems[index].countGoogle.length,
							}
						},
						success: function (response) {
							shareItems[index].countFacebook.text(dfd_share.shareApproximate(response.Facebook));
							shareItems[index].countGoogle.text(dfd_share.shareApproximate(response.Google));
						},
						error: function () {
							shareItems[index].countFacebook.html(0);
							shareItems[index].countGoogle.html(0);
						}
					});
				}
			});
		}	
		dfd_share.dfdSimpleShareInit();
	};

	dfd_share.shareFormatDecimals = function (num, base) {
		var workingNum = num / base;

		return workingNum < 10 ? Math.round(workingNum * 10) / 10 : Math.round(workingNum);
	};

	dfd_share.shareApproximate = function (num) {
		var negative = num < 0;
		var number = num;
		var numString;

		if (negative) {
			number = Math.abs(num);
		}

		if (number < 10000) {
			numString = number;
		} else if (number < 1000000) {
			numString = dfd_share.shareFormatDecimals(number, 1000) + 'k';
		} else if (number < 1000000000) {
			numString = dfd_share.shareFormatDecimals(number, 1000000) + 'm';
		} else {
			numString = dfd_share.shareFormatDecimals(number, 1000000000) + 'b';
		}

		if (negative) {
			numString = '-' + numString;
		}

		return numString;
	};
	
	dfd_share.dfdSimpleShareInit = function() {
		try {
			$('body').on('click', '.dfd-share-buttons a.popup', {}, function popUp(e) {
				e.preventDefault();
				var self = $(this);
				dfd_share.popupCenter(self.attr('href'), self.data('text'), 580, 470);
			});
		} catch (e) {
			
		}
	};

	dfd_share.popupCenter = function(url, title, w, h) {
		var dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screen.left;
		var dualScreenTop = window.screenTop !== undefined ? window.screenTop : screen.top;

		var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
		var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

		var left = ((width / 2) - (w / 2)) + dualScreenLeft;
		var top = ((height / 3) - (h / 3)) + dualScreenTop;

		var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

		if (newWindow && newWindow.focus) {
			newWindow.focus();
		}
	};

	$(document).ready(function () {
		dfd_share.share();
		$('body').on('post-load init-lightbox', function() {
			dfd_share.share();
		});
	});
})(jQuery);
