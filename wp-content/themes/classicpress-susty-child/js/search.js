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
					},
					// https://stackoverflow.com/questions/9656523/jquery-autocomplete-with-callback-ajax-json
					success: function(data) {
						$('#s').attr('autocomplete','on');
						response($.map(data, function(item) {
							return {
								label: item.title,
								url: item.link
							};
						}));
					},
					error: function(error) {
						var r = $.parseJSON(error.responseText);
						alert(r.message, function() {
							$('#s').focus();
							return false;
						});
					}
				});
			},
			select: function(event, ui) {
				window.location.href = ui.item.url;
			},
			delay: 200,
			minLength: 3,
			position: {
				my: 'right top',
				at: 'right+11 bottom+3'
			}
        });
        return false;
    });

});
