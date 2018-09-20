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

					if(el_offset_right < 0) {
						sub_nav_margin = -(el_offset_right -sub_nav_width/2 + el_width/2);
					}
					if(el_offset_left < (sub_nav_width - el_width)) {
						sub_nav_margin = -(sub_nav_width - el_width - el_offset_left);
					}
					$sub_nav.css('margin-right', sub_nav_margin);
				}
		});
	};
	
	$.fn.dfdInitClickMenu = function(elem) {			
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