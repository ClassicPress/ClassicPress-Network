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
		
		var $button = $('#ajax-pagination-load-more');
		
		if (page_num > max_pages) {
			var text = $button.data('loaded');
			$button.addClass('last-page').text(text);
		}
		
		$button.bind('click', function(e) {
			e.preventDefault();
			
			if (page_num <= max_pages && !$(this).hasClass('loading') && !$(this).hasClass('last-page')) {
				
				$.ajax({
					type: 'GET',
					url: next_link,
					dataType: 'html',
					beforeSend: function() {
						$button.addClass('loading');
					},
					complete: function(XMLHttpRequest) {
						$button.removeClass('loading');
						
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
								$button.addClass('last-page').text('Everything is loaded');
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