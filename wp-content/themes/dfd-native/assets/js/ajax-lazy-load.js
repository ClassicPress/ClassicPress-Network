(function ($) {
	'use strict';
	
	if (window.dfd_pagination_data == undefined) {
		return false;
	}
	
	$(document).ready(function() {
		
		var page_num = parseInt(dfd_pagination_data.startPage) + 1;
		var max_pages = parseInt(dfd_pagination_data.maxPages);
		var next_link = dfd_pagination_data.nextLink;
		
		var container = dfd_pagination_data.container;
		var $container = $(container);
		var container_has_isotope = false;
		
		var $popup = $('.dfd-lazy-load-pop-up');
		
		if (page_num > max_pages) {
			$popup.addClass('visible');
			setTimeout(function() {
				$popup.removeClass('visible');
			},1000);
		}
		
		var windowWidth, windowHeight, documentHeight, scrollTop, containerHeight, containerOffset, $window = $(window);
		
		var recalcValues = function() {
			windowWidth = $window.width();
			windowHeight = $window.height();
			documentHeight = $('body').height();
			containerHeight = $container.height();
			containerOffset = $container.offset().top;
		};
		
		recalcValues();
		$window.resize(recalcValues);
		
		$window.bind('scroll', function(e) {
			e.preventDefault();
			recalcValues();
			scrollTop = $window.scrollTop();
			
			if (page_num <= max_pages && !$popup.hasClass('visible') && scrollTop < documentHeight && scrollTop > (containerHeight + containerOffset - windowHeight) && !$popup.hasClass('last-page')) {
				$.ajax({
					type: 'GET',
					url: next_link,
					dataType: 'html',
					beforeSend: function() {
						$popup.addClass('visible');
					},
					complete: function(XMLHttpRequest) {
						$popup.removeClass('visible');
						
						if (XMLHttpRequest.status == 200 && XMLHttpRequest.responseText != '') {
							page_num++;
							
							var link = next_link.substring(0,next_link.indexOf("page"));
							link += 'page/';
							
							var extraLink = next_link.substring(link.length);
							if(extraLink.indexOf('/') != -1) {
								extraLink = extraLink.substring(extraLink.indexOf('/'));
							} else {
								extraLink = '';
							}
							
							next_link = link + page_num + extraLink;
							
							if (page_num > max_pages) {
								var text = $popup.data('loaded');
								$popup.addClass('last-page').append('<span>'+text+'</span>');
							}
							if ($(XMLHttpRequest.responseText).find(container).length > 0) {
								container_has_isotope = (typeof($container.isotope) === 'function' && $container.hasClass('dfd-isotope'));
								$(XMLHttpRequest.responseText).find(container).children().each(function() {
									if (!container_has_isotope) {
										$container.append($(this));
									} else {
										$container.isotope( 'insert', $(this) );
									}
								});
								$('body').trigger('post-load');
							}
						}
					}
				});
			}
		});
	});
}(jQuery));