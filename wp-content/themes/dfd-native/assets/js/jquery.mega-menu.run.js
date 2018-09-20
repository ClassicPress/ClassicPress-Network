(function($){
	"use strict";
	var $window = $(window);
	$.runMegaMenu = function() {
		$("nav.mega-menu")
			.accessibleMegaMenu({
				/* prefix for generated unique id attributes, which are required 
				 to indicate aria-owns, aria-controls and aria-labelledby */
				uuidPrefix: "accessible-megamenu",
				/* css class used to define the megamenu styling */
				menuClass: "nav-menu",
				/* css class for a top-level navigation item in the megamenu */
				topNavItemClass: "nav-item",
				/* css class for a megamenu panel */
				panelClass: "sub-nav",
				/* css class for a group of items within a megamenu panel */
				panelGroupClass: "sub-nav-group",
				/* css class for the hover state */
				hoverClass: "hover",
				/* css class for the focus state */
				focusClass: "focus",
				/* css class for the open state */
				openClass: "open"
			})
			.on('megamenu:open', function(e, el) {
				if ($window.width() <= screen_medium) return false;
		
				var $menu = $(this),
					$el = $(el),
					$sub_nav;

				if ($el.is('.main-menu-link.open') && $el.siblings('div.sub-nav').length>0) {
					$sub_nav = $el.siblings('div.sub-nav');
				} else if ($el.is('div.sub-nav')) {
					$sub_nav = $el;
					$el = $sub_nav.siblings('.main-menu-link');
				} else {
					return true;
				}
				
				$sub_nav.removeAttr('style').removeClass('sub-nav-onecol');

				if($sub_nav.parents('#header-container').hasClass('dfd-enable-mega-menu')) {
					$sub_nav.find('ul.sub-menu-wide').each(function(){
						var $ul = $(this),
							total_width = 1,
							limit = $ul.data('limit-columns'),
							i = 0;

						$ul.children().each(function(){
							if(!limit || limit > i) {
								total_width += Math.ceil($(this).outerWidth());
							}
							i++;
						});

						$ul.innerWidth(total_width);
					});

					var w_width = $window.width();
					var sub_nav_width = $sub_nav.width();
					var sub_nav_margin = 0;

					$sub_nav.css({'max-width': w_width});

					if (sub_nav_width > w_width) {
						$sub_nav.addClass('sub-nav-onecol');

						sub_nav_width = $sub_nav.width();
					}
					var el_width = $el.outerWidth();
					var el_offset_left = $el.offset().left;
					var el_offset_right = w_width - $el.offset().left - el_width;

					if($("body").hasClass("rtl")) {
						if(el_offset_right < 0) {		
							sub_nav_margin = -(el_offset_right -sub_nav_width/2 + el_width/2);
						}
						if(el_offset_left < (sub_nav_width - el_width)) {		
							sub_nav_margin = -(sub_nav_width - el_offset_left);
						}
						$sub_nav.css('margin-right', sub_nav_margin);
					}else {
						if(el_offset_left < 0) {
							sub_nav_margin = -(el_offset_left -sub_nav_width/2 + el_width/2);
						}
						if(el_offset_right < (sub_nav_width - el_width)) {
							sub_nav_margin = -(sub_nav_width - el_width - el_offset_right);
						}
						$sub_nav.css('margin-left', sub_nav_margin);
					}
				}
			});
		if(typeof dfd_native.windowWidth != 'undefined' && typeof headerResponsiveBreakpoint != 'undefined' && dfd_native.windowWidth > headerResponsiveBreakpoint) {
			$('.sub-menu.sub-nav-group .has-submenu').hover(function() {
				var $self = $(this),
					$sub_sub_nav = $self.find('> .sub-sub-menu');
				setTimeout(function() {
					var windowWidth = (typeof dfd_native.windowWidth != 'undefined') ? dfd_native.windowWidth : $(window).width(),
						windowHeight = (typeof dfd_native.windowHeight != 'undefined') ? dfd_native.windowHeight : $(window).height(),
						selfWidth = $self.outerWidth(true),
						sub_sub_nav_height = $sub_sub_nav.outerHeight(true),
						offset = $sub_sub_nav.offset(),
						parentOffset = $self.parent().offset(),
						shiftTop = offset.top - parentOffset.top,
						frameSize = 0,
						transformY = 0,
						$header_container = $('#header-container'),
						headerHeight = ($header_container.find('.dfd-top-row').length > 0) ? $header_container.find('.dfd-top-row').outerHeight() : $header_container.find('#header').outerHeight();
						if(typeof headerHeight == "undefined"){
							headerHeight = ($header_container.find('.dfd-top-row').length > 0) ? $header_container.find('.dfd-top-row').outerHeight() : $header_container.find('.header').outerHeight();
						}
						
					if($header_container.find('.dfd-top-row').length < 1 && $header_container.hasClass('small')) {
						headerHeight = $header_container.find('.header-wrap').outerHeight();
					}

					if($('.dfd-frame-line.line-bottom').length > 0) {
						frameSize = $('.dfd-frame-line.line-bottom').height() * 2;
						windowWidth = windowWidth - frameSize;
						windowHeight = windowHeight - frameSize;
					}

					if($('#wpadminbar').length > 0) {
						windowHeight = windowHeight - $('#wpadminbar').outerHeight();
					}

					if($("body").hasClass("rtl")){
						if(offset.left < 0 && !$sub_sub_nav.hasClass('sub-nav-left')) {
							$sub_sub_nav.addClass('sub-nav-left');
						} else if($sub_sub_nav.hasClass('sub-nav-left')) {
							$sub_sub_nav.addClass('sub-nav-left');
						}
					}else {
						if(offset.left + selfWidth > windowWidth && !$sub_sub_nav.hasClass('sub-nav-left')) {
							$sub_sub_nav.addClass('sub-nav-left');
						} else if($sub_sub_nav.hasClass('sub-nav-left')) {
							$sub_sub_nav.addClass('sub-nav-left');
						}
					}

					if(
						!$self.parents('#header-container').hasClass('side-header')
						&&
						!$self.parents('.sub-menu.sub-nav-group').hasClass('sub-menu-wide')
						&&
						sub_sub_nav_height > windowHeight - shiftTop - headerHeight
					) {
						transformY = sub_sub_nav_height - (windowHeight - shiftTop - headerHeight) + 20;

						if(sub_sub_nav_height > windowHeight) {
							transformY = shiftTop;
						}
					} else if(
						$self.parents('#header-container').hasClass('side-header')
						&&
						sub_sub_nav_height > windowHeight - (offset.top - $(window).scrollTop())
					) {
						transformY = sub_sub_nav_height - (windowHeight - (offset.top - $(window).scrollTop())) - 20;
					}
					transformY = Math.abs(transformY);
					
					if($self.parents('#header-container').hasClass('header-style-7') && sub_sub_nav_height > windowHeight - offset.top - headerHeight) {
						transformY = sub_sub_nav_height - (windowHeight - offset.top) - 20;
					}
					
					if(transformY != 0) {
						$sub_sub_nav.css({
							'-webkit-transform': 'translate3d(0,-'+transformY+'px,0)',
							'-moz-transform': 'translate3d(0,-'+transformY+'px,0)',
							'-o-transform': 'translate3d(0,-'+transformY+'px,0)',
							'transform': 'translate3d(0,-'+transformY+'px,0)',
							'-webkit-transition': '-webkit-transform .3s ease',
							'-moz-transition': '-moz-transform .3s ease',
							'-o-transition': '-o-transform .3s ease',
							'transition': 'transform .3s ease',
						}, 500);
					}
						
				},50);
			}, function() {
				$(this).find('> .sub-sub-menu').css({
					'-webkit-transform': 'translate3d(0,0,0)',
					'-moz-transform': 'translate3d(0,0,0)',
					'-o-transform': 'translate3d(0,0,0)',
					'transform': 'translate3d(0,0,0)',
					'-webkit-transition': '-webkit-transform .3s ease',
					'-moz-transition': '-moz-transform .3s ease',
					'-o-transition': '-o-transform .3s ease',
					'transition': 'transform .3s ease',
				});
			});
		}
	};
	
	$.fn.dfdInitClickMenu = function() {
		return this.each(function() {
			$(this).click(function(e){
				e.preventDefault();

				var $a = $(this);
				var $sub_nav = $a.siblings('div.sub-nav');

				if ($sub_nav.length === 0) {
					$sub_nav = $a.siblings('ul');
				}

				$sub_nav.slideToggle();
				$a.toggleClass('open');
			});
		});
	};
	
	$('document').ready(function() {
		$('#header .onclick-nav-menu li.has-submenu > a').dfdInitClickMenu();
		$('.header .onclick-nav-menu li.has-submenu > a').dfdInitClickMenu();
		$('.widget.widget_nav_menu li.has-submenu > a').dfdInitClickMenu();
	});
})(jQuery);