jQuery(document).ready(function($) {
	'use strict'; // satisfy code inspectors

	$('#primary-menu li a:contains(About)').append('<span class="screen-reader-text">Click to be taken to a page with further information about ClassicPress</span>');

	if (window.matchMedia("screen and (max-width: 800px)").matches) {
		$('#primary-menu li').last().after(MENU_ITEM.searchform);
		$('#menu-toggle').click(function() {
			$(this).hide();
			$('#menu-toggle-close, .main-navigation, .get-started').show();
			$('#menu-toggle-close').focus();
		});
		$('#menu-toggle-close').click(function() {
			$('#menu-toggle-close, .main-navigation, .get-started').hide();
			$('#menu-toggle').show().focus();
		});
	}
	if (window.matchMedia("screen and (min-width: 801px)").matches) {
		$('#primary-menu li').first().find('li').last().after(MENU_ITEM.searchform);
		$('.menu li a').on('mouseenter focus', function() {
			$(this).next('.sub-menu').show();
			$(this).parent().siblings().children('.sub-menu').hide();
			$('.ui-menu-item').hide();
		});
		$('#content, .logo a, .get-started').on('mouseenter focus', function() {
			$('.sub-menu, .ui-menu-item').hide();
		});
	}

});
