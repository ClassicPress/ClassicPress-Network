jQuery(document).ready(function($) {

	$('#s').keyup(function(e) {
        e.preventDefault();
        var route = SEARCHCOMPLETE.rest_url + 'cp/v1/search';
        $(this).autocomplete({
			source: function(request, response) {
				$.ajax({
					url: route,
					type: 'GET',
					data: {
						query: request.term,
					},
					beforeSend: function(xhr) {
						xhr.setRequestHeader('X-WP-Nonce', SEARCHCOMPLETE.search_nonce);
					}
				}).then(function(data) { // https://stackoverflow.com/questions/9656523/jquery-autocomplete-with-callback-ajax-json
					$('#s').attr('autocomplete','on');					
					$('.live-search-error').remove();
					response($.map(data, function(item) {
						return {
							label: item.title,
							url: item.link
						};
					})); // https://stackoverflow.com/questions/25638661/how-to-display-error-messages-jquery-ajax
				}, function(reason) { // no results
					$('.live-search-error').remove();
					$('.ui-menu').hide();
					$('#s').after('<div class="live-search-error">No matches found</div>');
				});
				return false;
			},
			select: function(event, ui) {
				window.location.href = ui.item.url;
			},
			delay: 200,
			minLength: 3,
			position: {
				my: 'right top',
				at: 'right+16 bottom+0'
			}
        });
        return false;
    });

});
