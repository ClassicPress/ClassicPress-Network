;
var screen_medium = 800,
	headerResponsiveBreakpoint = 1100;

if (!window.requestAnimationFrame) {

	window.requestAnimationFrame = (function () {

		return window.webkitRequestAnimationFrame ||
			window.mozRequestAnimationFrame ||
			window.oRequestAnimationFrame ||
			window.msRequestAnimationFrame ||
			function (/* function FrameRequestCallback */ callback, /* DOMElement Element */ element) {

				window.setTimeout(callback, 1000 / 60);

			};

	})();
}
if(typeof addComment == 'undefined') {
	addComment = {
		moveForm: function() {}
	};
}
(function ($, window, undefined) {
	'use strict';

    var $doc = $(document),
        Modernizr = window.Modernizr;
	
	$.fn.sbAccordion = function() {
		var settings = {
			speed: 300
		};
		
		return this.each(function(){
			var $accordion = $(this);
			var $lis = $accordion.children('li');
			
			$accordion.find('.title').click(function(){
				var $this = $(this);
				var $li = $this.parent('li');
				
				if ($li.hasClass('active')) {
					return false;
				}
				
				$this.siblings('.content').slideDown(settings.speed);
				$lis.filter('.active').removeClass('active')
					.children('.content').slideUp(settings.speed);
				$li.addClass('active');
				
				return false;
			});
		});
	};
	
    $(document).ready(function () {
		$('ul.accordion').sbAccordion();
        $.fn.foundationAlerts ? $doc.foundationAlerts() : null;
        $.fn.foundationButtons ? $doc.foundationButtons() : null;
        $.fn.foundationNavigation ? $doc.foundationNavigation() : null;
        $.fn.foundationTopBar ? $doc.foundationTopBar() : null;
        $.fn.foundationCustomForms ? $doc.foundationCustomForms() : null;
        $.fn.foundationMediaQueryViewer ? $doc.foundationMediaQueryViewer() : null;
        $.fn.foundationTabs ? $doc.foundationTabs({callback: $.foundation.customForms.appendCustomMarkup}) : null;
        $.fn.foundationTooltips ? $doc.foundationTooltips() : null;
        $.fn.foundationMagellan ? $doc.foundationMagellan() : null;
        $.fn.foundationClearing ? $doc.foundationClearing() : null;

        $.fn.placeholder ? $('input, textarea').placeholder() : null;
    });
	
})(jQuery, this);


/*---------------------------------
 Correct OS & Browser Check
 -----------------------------------*/

var ua = navigator.userAgent,
    checker = {
        os: {
            iphone: ua.match(/iPhone/),
            ipod: ua.match(/iPod/),
            ipad: ua.match(/iPad/),
            blackberry: ua.match(/BlackBerry/),
            android: ua.match(/(Android|Linux armv6l|Linux armv7l)/),
            linux: ua.match(/Linux/),
            win: ua.match(/Windows/),
            mac: ua.match(/Macintosh/)
		},
        ua: {
            ie: ua.match(/MSIE/),
            ie6: ua.match(/MSIE 6.0/),
            ie7: ua.match(/MSIE 7.0/),
            ie8: ua.match(/MSIE 8.0/),
            ie9: ua.match(/MSIE 9.0/),
            ie10: ua.match(/MSIE 10.0/),
            opera: ua.match(/Opera/),
            firefox: ua.match(/Firefox/),
            chrome: ua.match(/Chrome/),
            safari: ua.match(/(Safari|BlackBerry)/)
        }
    };


/*---------------------------------
 DOM mutation
 -----------------------------------*/
(function ($) {
	'use strict';
	$.fn.observeDOM = function(callback){
		var MutationObserver = window.MutationObserver || window.WebKitMutationObserver,
			eventListenerSupported = window.addEventListener,
			$self = $(this)[0];
		
		if($self) {
			if( MutationObserver ){
				// define a new observer
				var obs = new MutationObserver(function(mutations){
					if( mutations[0].addedNodes.length || mutations[0].removedNodes.length ) {
						callback();
					}
				});
				// have the observer observe foo for changes in children
				obs.observe( $self, { childList:true });
			} else if( eventListenerSupported ){
				$self.addEventListener('DOMNodeInserted', callback, false);
				$self.addEventListener('DOMNodeRemoved', callback, false);
			}
		}
		return this;
	};
})(jQuery);

/*---------------------------------
 Navigation dropdown
 -----------------------------------*/
(function ($) {
	"use strict";
	$(document).ready(function() {
		$('form.wpcf7-form input:not([type="submit"])').focus(function(e){
			$(this).parent('span').addClass('active').siblings().addClass('active');
		}).blur(function() {
			if(!$(this).parents('.dfd-contact-form-style-5').length || ($(this).parents('.dfd-contact-form-style-5').length && $(this).val() == '')) {
				$(this).parent('span').removeClass('active').siblings().removeClass('active');
			}
		});
		/*Widgets*/
		$('.widget.widget_categories .children').parent('.cat-item').addClass('has-sub-category');
	});
})(jQuery);

(function ($) {
	"use strict";
	$(document).ready(function() {
		$('form.wpcf7-form select, .widget select, .widget-arhives-empty select, #bbpress-forums select, .bbp-forum-form select').dropkick({mobile: true});
		$('.widget_akismet_widget strong').wrapInner('<span />');
		var $container = $('.pagination');
		if($container.hasClass('dfd-pagination-style-3') || $container.hasClass('dfd-pagination-style-4')) {
			var $current = $('.page-numbers ', $container).find('.current');
			$current.parent().addClass('current-parent');
			$current.parent().prev().addClass('before-current');
			$current.parent().next().addClass('after-current');
		}
		if($('#layout').hasClass('one-page-scroll')) {
			$('.dfd-single-image-module .dfd-one-page-nav').each(function() {
				var $self = $(this),
					dir = $self.data('dir'),
					$carousel = $('#layout.one-page-scroll');
				
				$self.click(function(e) {
					e.preventDefault();
					$carousel.slick(dir);
				});
			});
		}
		if (('devicePixelRatio' in window) && (window.devicePixelRatio > 1)) {
			$('.dfd-single-image-module img').each(function() {
				var $self = $(this),
					retina_img_src = $self.data('retina-img');
				
				$self.attr('src', retina_img_src);
			});
		}
	});
})(jQuery);

(function($){
	"use strict";
	/* Pricing table columns width */
	$.fn.pricingTableEqColumns = function() {
		var $columns = $(this);
		var width = (100 / $columns.length);
		$columns.css('width', width+'%');
		
		return this;
	};
})(jQuery);

(function($){
	"use strict";
	/* Item width fixer */
	$.fn.elementFixedWidth = function() {
		$(this).each(function() {
			var width = $(this).width();
			$(this).css('width', width+'px');
		});
		
		return this;
	};
})(jQuery);

(function($) {
	var ua = window.navigator.userAgent;
	var ie_version;

	var msie = ua.indexOf('MSIE ');
	if (msie > 0) {
		// IE 10 or older => return version number
		ie_version =  parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
		$('html').addClass('dfd-ie-detected ie-'+ie_version);
	}

	var trident = ua.indexOf('Trident/');
	if (trident > 0) {
		// IE 11 => return version number
		var rv = ua.indexOf('rv:');
		ie_version =  parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
		$('html').addClass('dfd-ie-detected ie-'+ie_version);
	}

	var edge = ua.indexOf('Edge/');
	if (edge > 0) {
		// IE 12 => return version number
		ie_version =  parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
		$('html').addClass('dfd-ie-detected ie-'+ie_version);
	}
	var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
	if(isSafari) {
		$('html').addClass('dfd-safari-detected');
	}
})(jQuery);

/*Stunning header carousel*/
(function($) {
	"use strict";
	$(document).ready(function() {
		$('#dfd-stun-header-gallery').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			fade: true,
			autoplay: true,
			autoplaySpeed: 3000,
			speed: 2000,
			pauseOnHover: false,
			infinite: true,
		});
	});
})(jQuery);

/*---------------------------------
 side area
 -----------------------------------*/
(function($){
	'use strict';
	$('.dfd-info-box').each(function () {
		var $self = $(this);
		if ($self.hasClass('icon-color-change') || $self.hasClass('icon-bg-change') || $self.hasClass('icon-border-change')) {
			var icon_el = $self.find('.featured-icon');
			var icon_wrap = $self.find('.module-icon');
			/* Change icon color on hover */
			$self.mouseenter(function () {
				if ($self.hasClass('icon-color-change')) {
					icon_el.velocity({color: icon_el.data('hover')}, 300);
				}
				if ($self.hasClass('icon-border-change')) {
					icon_wrap.velocity({color: icon_wrap.data('hover-border'), colorAlpha: 1}, 300);
				}
			});
			$self.mouseleave(function () {
				icon_el.velocity("reverse", 300);
				icon_wrap.velocity("reverse", 300);
			});
		}
	});

	$(document).ready(function () {
		$('body').on('click', '.dfd-share-title', function(e) {
			e.preventDefault();
			$(this).parent().toggleClass('active');
		});
	});
})(jQuery);


/*!
 * Lettering.JS 0.6.1
 *
 * Copyright 2010, Dave Rupert http://daverupert.com
 * Released under the WTFPL license
 * http://sam.zoy.org/wtfpl/
 *
 * Thanks to Paul Irish - http://paulirish.com - for the feedback.
 *
 * Date: Mon Sep 20 17:14:00 2010 -0600
 */

(function(b){function c(a,e,c,d){e=a.text().split(e);var f="";e.length&&(b(e).each(function(a,b){f+='<span class="'+c+(a+1)+'">'+b+"</span>"+d}),a.empty().append(f))}var d={init:function(){return this.each(function(){c(b(this),"","char","")})},words:function(){return this.each(function(){c(b(this)," ","word"," ")})},lines:function(){return this.each(function(){c(b(this).children("br").replaceWith("eefec303079ad17405c889e092e105b0").end(),"eefec303079ad17405c889e092e105b0","line","")})}};b.fn.lettering=
    function(a){if(a&&d[a])return d[a].apply(this,[].slice.call(arguments,1));if("letters"===a||!a)return d.init.apply(this,[].slice.call(arguments,0));b.error("Method "+a+" does not exist on jQuery.lettering");return this}})(jQuery);

/*
 * textillate.js
 * http://jschr.github.com/textillate
 * MIT licensed
 *
 * Copyright (C) 2012-2013 Jordan Schroter
 */

(function($){"use strict";function isInEffect(effect){return/In/.test(effect)||$.inArray(effect,$.fn.textillate.defaults.inEffects)>=0}function isOutEffect(effect){return/Out/.test(effect)||$.inArray(effect,$.fn.textillate.defaults.outEffects)>=0}function getData(node){var attrs=node.attributes||[],data={};if(!attrs.length)return data;$.each(attrs,function(i,attr){if(/^data-in-*/.test(attr.nodeName)){data["in"]=data["in"]||{};data["in"][attr.nodeName.replace(/data-in-/,"")]=attr.nodeValue}else if(/^data-out-*/.test(attr.nodeName)){data.out=
    data.out||{};data.out[attr.nodeName.replace(/data-out-/,"")]=attr.nodeValue}else if(/^data-*/.test(attr.nodeName))data[attr.nodeName]=attr.nodeValue});return data}function shuffle(o){for(var j,x,i=o.length;i;j=parseInt(Math.random()*i),x=o[--i],o[i]=o[j],o[j]=x);return o}function animate($c,effect,cb){$c.addClass("animated "+effect).css("visibility","visible").show();$c.one("animationend webkitAnimationEnd oAnimationEnd",function(){$c.removeClass("animated "+effect);cb&&cb()})}function animateChars($chars,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            options,cb){var that=this,count=$chars.length;if(!count){cb&&cb();return}if(options.shuffle)shuffle($chars);$chars.each(function(i){var $this=$(this);function complete(){if(isInEffect(options.effect))$this.css("visibility","visible");else if(isOutEffect(options.effect))$this.css("visibility","hidden");count-=1;if(!count&&cb)cb()}var delay=options.sync?options.delay:options.delay*i*options.delayScale;$this.text()?setTimeout(function(){animate($this,options.effect,complete)},delay):complete()})}var Textillate=
    function(element,options){var base=this,$element=$(element);base.init=function(){base.$texts=$element.find(options.selector);if(!base.$texts.length){base.$texts=$('<ul class="texts"><li>'+$element.html()+"</li></ul>");$element.html(base.$texts)}base.$texts.hide();base.$current=$("<span>").text(base.$texts.find(":first-child").html()).prependTo($element);if(isInEffect(options.effect))base.$current.css("visibility","hidden");else if(isOutEffect(options.effect))base.$current.css("visibility","visible");
        base.setOptions(options);setTimeout(function(){base.options.autoStart&&base.start()},base.options.initialDelay)};base.setOptions=function(options){base.options=options};base.start=function(index){var $next=base.$texts.find(":nth-child("+(index||1)+")");(function run($elem){var options=$.extend({},base.options,getData($elem));base.$current.text($elem.html()).lettering("words");base.$current.find('[class^="word"]').css({"display":"inline-block","-webkit-transform":"translate3d(0,0,0)","-moz-transform":"translate3d(0,0,0)",
        "-o-transform":"translate3d(0,0,0)","transform":"translate3d(0,0,0)"}).each(function(){$(this).lettering()});var $chars=base.$current.find('[class^="char"]').css("display","inline-block");if(isInEffect(options["in"].effect))$chars.css("visibility","hidden");else if(isOutEffect(options["in"].effect))$chars.css("visibility","visible");animateChars($chars,options["in"],function(){setTimeout(function(){var options=$.extend({},base.options,getData($elem));var $next=$elem.next();if(base.options.loop&&!$next.length)$next=
        base.$texts.find(":first-child");if(!$next.length)return;animateChars($chars,options.out,function(){run($next)})},base.options.minDisplayTime)})})($next)};base.init()};$.fn.textillate=function(settings,args){return this.each(function(){var $this=$(this),data=$this.data("textillate"),options=$.extend(true,{},$.fn.textillate.defaults,getData(this),typeof settings=="object"&&settings);if(!data)$this.data("textillate",data=new Textillate(this,options));else if(typeof settings=="string")data[settings].apply(data,
    [].concat(args));else data.setOptions.call(data,options)})};$.fn.textillate.defaults={selector:".texts",loop:false,minDisplayTime:2E3,initialDelay:0,"in":{effect:"fadeInLeftBig",delayScale:1.5,delay:50,sync:false,shuffle:false},out:{effect:"hinge",delayScale:1.5,delay:50,sync:false,shuffle:false},autoStart:true,inEffects:[],outEffects:["hinge"]}})(jQuery);

/*! fluidvids.js v2.4.1 | (c) 2014 @toddmotto | https://github.com/toddmotto/fluidvids */
!function(e,t){"function"==typeof define&&define.amd?define(t):"object"==typeof exports?module.exports=t:e.fluidvids=t()}(this,function(){"use strict";function e(e){return new RegExp("^(https?:)?//(?:"+d.players.join("|")+").*$","i").test(e)}function t(e,t){return parseInt(e,10)/parseInt(t,10)*100+"%"}function i(i){if((e(i.src)||e(i.data))&&!i.getAttribute("data-fluidvids")){var n=document.createElement("div");i.parentNode.insertBefore(n,i),i.className+=(i.className?" ":"")+"fluidvids-item",i.setAttribute("data-fluidvids","loaded"),n.className+="fluidvids",n.style.paddingTop=t(i.height,i.width),n.appendChild(i)}}function n(){var e=document.createElement("div");e.innerHTML="<p>x</p><style>"+o+"</style>",r.appendChild(e.childNodes[1])}var d={selector:["iframe","object"],players:["www.youtube.com","player.vimeo.com"]},o=[".fluidvids {","width: 100%; max-width: 100%; position: relative;","}",".fluidvids-item {","position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;","}"].join(""),r=document.head||document.getElementsByTagName("head")[0];return d.render=function(){for(var e=document.querySelectorAll(d.selector.join()),t=e.length;t--;)i(e[t])},d.init=function(e){for(var t in e)d[t]=e[t];d.render(),n()},d});
(function($){
	"use strict";
	var initFluidVids = function() {
		fluidvids.init({selector: ['iframe:not(.dfd-bg-frame)'], players: ['www.youtube.com', 'player.vimeo.com']})
	};
	$(window).on('load', initFluidVids);
	$('body').on('post-load', initFluidVids);
})(jQuery);

(function ($) {
	"use strict";
	$.fn.changeWords = function (options) {
		var settings = $.extend({
			time: 1500,
			animate: "zoomIn",
			afterChangeAnimate: "zoomIn",
			selector: "span"
		}, options);
		var wordCount = $(settings.selector, this).size();
		var words = $(settings.selector, this);
		words.filter(function () {
			return $(this).attr("data-id") != "1"
		}).css("display", "none");
		var count = 1;
		setInterval(function () {
			++count;
			var wordOrder = count;
			words.filter(function () {
				return $(this).attr("data-id") != wordOrder
			}).removeClass(settings.animate).addClass("dfd-text-animated " + settings.afterChangeAnimate).trigger('reinit-chaffle');
//			setTimeout(function() {
				words.filter(function () {
					return $(this).attr("data-id") != wordOrder
				}).css("display", "none").removeClass();
				words.filter(function () {
					return $(this).attr("data-id") == wordOrder
				}).addClass("dfd-text-animated " + settings.animate).css({"display": "inline-block",'opacity':'1'}).trigger('init-chaffle');
//			},settings.time*3);
//			},settings.time/3);
			if (count == wordCount) {
				count = 0;
			}
		}, settings.time);
	};
})(jQuery);

(function($) {
	"use strict";
	var initHoverDir = function() {
		$('.dfd-portfolio.portfolio-hover-style-1, .dfd-gallery.portfolio-hover-style-1, .dfd-portfolio_archive.portfolio-hover-style-1, .dfd-gallery_archive.portfolio-hover-style-1, .dfd-simple-advertisement.portfolio-hover-style-1').each( function() {
			$(this).hoverdir({
			});
		});
	};
	$(document).ready(function() {
		initHoverDir();
	});
	$('body').on('post-load',initHoverDir);
})(jQuery);


(function($) {
	"use strict";
	var dfd_native = window.dfd_native || {};
	
	window.dfd_native = dfd_native;
	
	dfd_native.window = $(window),
	dfd_native.document = $(document),
	dfd_native.windowHeight = dfd_native.window.height(),
	dfd_native.windowWidth = dfd_native.window.width(),
	dfd_native.scrollbarWidth = 0,
	dfd_native.windowScrollTop = 0;
	dfd_native.sameOrigin = true;
	
	dfd_native.initObjectsSizing = function() {
		try {
			dfd_native.sameOrigin = window.parent.location.host == window.location.host;
		} catch (e) {
			dfd_native.sameOrigin = false;
		}
		
		var recalcWindowOffset = function() {
			dfd_native.windowScrollTop = dfd_native.window.scrollTop();
		};

		dfd_native.document.ready(function() {
			var div = document.createElement('div');

			div.style.overflowY = 'scroll';
			div.style.width =  '50px';
			div.style.height = '50px';

			div.style.visibility = 'hidden';

			document.body.appendChild(div);
			dfd_native.scrollbarWidth = div.offsetWidth - div.clientWidth;
			document.body.removeChild(div);

		});

		var recalcWindowInitHeight = function() {
			dfd_native.windowHeight = dfd_native.window.height();
			dfd_native.windowWidth = dfd_native.window.width() + dfd_native.scrollbarWidth;

			recalcWindowOffset();
		};

		recalcWindowInitHeight();

		recalcWindowOffset();
		
		dfd_native.window
				.on("resize load", recalcWindowInitHeight)
				.on("scroll", recalcWindowOffset);
		
		dfd_native.window.on("load", function() {
			$('body').trigger('reinit-waypoint');
		});
	};
	
	dfd_native.bindMobileMenu = function() {
		if($('#header-container').hasClass('header-style-3') || $('#header-container').hasClass('header-style-4')){
			var $mobileMenu = $('<ul />');
			var main_menu_count=0, second_menu_count=0,third_menu_count=0;
			$('ul.menu-clonable-for-mobiles').each(function() {
				var $sub_menu = $(this).children().clone();
				$mobileMenu = $mobileMenu.append($sub_menu);
			});
		} else {
			var $mobileMenu = $('ul.menu-clonable-for-mobiles').clone();
		}
		var main_menu_count = 0, second_menu_count = 0, third_menu_count = 0;
		var canInsert = function(obj){
			if(obj.hasClass("main_menu")){
				main_menu_count++;
				if(main_menu_count>1) {
					return false;
				}
			}
			if(obj.hasClass("second_menu")){
				second_menu_count++;
				if(second_menu_count>1) {
					return false;
				}
			}
			if(obj.hasClass("third_menu")){
				third_menu_count++;
				if(third_menu_count>1) {
					return false;
				}
			}
			return true;
		};
		if($('#header-container').hasClass('dfd-header-builder')){
			var $mobileMenu = $('<ul />');
			$('ul.menu-clonable-for-mobiles').each(function(){
				/*Check for duplicate*/
				if(canInsert($(this))){
					var $sub_menu = $(this).children().clone();
					$mobileMenu = $mobileMenu.append($sub_menu);
				}
			});
		}
		$mobileMenu
				.removeAttr('id')
				.find('ul, li, a').addBack()
				.removeAttr('id');
		$mobileMenu
				.find('ul')
				.removeAttr('style');
	
		$mobileMenu
				.attr('class', 'sidr-dropdown-menu')
			.find('ul')
				.attr('class', 'sidr-class-sub-menu');
		
		$mobileMenu.find('.sub-nav > ul').each(function(){
			$(this).unwrap();
		});
		
		$mobileMenu.find('li').each(function(){
			var $self = $(this);
			if($self.find('ul').length > 0) {
				$self.find('> a').append('<i class="sidr-dropdown-toggler" />');
			}
		});
		
		var $menuButton = $('#mobile-menu,.mobile-menu'),
			sidrSide = ($('#sidr').length > 0 && $('#sidr').data('sidr-side')) ? $('#sidr').data('sidr-side') : 'left';
		
		function sidrToggleClass() {
			$('body').toggleClass('sidr-opened');
		};
		$('.sidr-inner').append($mobileMenu);
		$menuButton.sidr({
			displace: false,
			speed: 500,
			side: sidrSide,
			timing: 'ease .3s',
			onOpen: function() {
				sidrToggleClass();
				$menuButton.addClass('opened');
			},
			onClose: function() {
				sidrToggleClass();
				$menuButton.removeClass('opened');
			}
		});
		
		$('.sidr-dropdown-toggler').unbind('click').bind('touchend click', function(e) {
			e.preventDefault();
			$(this).parent('a').parent('li').toggleClass('active').find('> ul').slideToggle(500);
		});
		$menuButton.unbind('click').bind('touchend click', function(e) {
			e.preventDefault();
			var $self = $(this);
			if(!$self.hasClass('opened')) {
				$.sidr('open');
			} else {
				$.sidr('close');
			}
		});
		$('.dfd-sidr-close').unbind('click').bind('click', function(e) {
			e.preventDefault();
			$.sidr('close');
		});
	};
	
	dfd_native.loadRetinaLogo = function() {
		if (('devicePixelRatio' in window) && (window.devicePixelRatio > 1)) {
			$('.dfd-logo-wrap').each(function(){
				var $logo = $(this).find('img');
				var retina_src = $logo.attr('data-retina');

				if (!retina_src || retina_src.length===0) {
					return;
				}
				
				if($logo.attr('height') && $logo.attr('height') !== '') {
					$logo.css('height', $logo.attr('height'));
				}

				$logo.attr('src', retina_src);
			});
		}
	};
	dfd_native.roundCssTransformMatrix = function(el){
		var trans = $(el).css("transform");
		var values = trans.replace(/ |\(|\)|matrix/g, "").split(",");
		for(var v in values) {
			values[v] = v > 4 ? Math.ceil(values[v]) : values[v];
		}
		$(el).css({transform: "matrix(" + values.join() + ")"});
	};
	dfd_native.headerEvents = function() {

		$.bindHeaderEvents = function() {
			var $header_container = $("#header-container");

			var initAnim = function($el, triggerClass, initClass) {
				var offset = 0;
				if(!$el.hasClass('dfd-header-layout-fixed') && !$el.hasClass('dfd-header-builder')) {
					offset = 150;
				}
				
				if($el && $el.length > 0) {
					$el.addClass(initClass);
					if(dfd_native.windowScrollTop > offset) {
						$el.addClass(triggerClass);
					} else {
						$el.removeClass(triggerClass);
					}
				}
			};

			var hcH,
				$stuning_header = $('#stuning-header'),
				$stun_header_inner = $stuning_header.find('.page-title-inner'),
				$header_title_wrap = $stuning_header.find('.page-title-inner-wrap'),
				heightIncrVal = 40,
				heightIncr = 100;

			var header_el_sizing = function() {
				/* menu fixer */
				var $menu_fixer = $('#menu-fixer');

				hcH = ($header_container.find('.dfd-top-row').length > 0 && typeof dfd_native.windowWidth != 'undefined' && dfd_native.windowWidth > headerResponsiveBreakpoint) ? $header_container.find('.dfd-top-row').outerHeight() : $header_container.find('#header').outerHeight();
				if(typeof hcH == "undefined" || hcH=="" || hcH==null){
					hcH = ($header_container.find('.dfd-top-row').length > 0 && typeof dfd_native.windowWidth != 'undefined' && dfd_native.windowWidth > headerResponsiveBreakpoint) ? $header_container.find('.dfd-top-row').outerHeight() : $header_container.find('.header').outerHeight();
				}
//				console.log(hcH);

				if ($stuning_header.length > 0) {
					var stunHeaderHeight = $stun_header_inner.css('minHeight') ? $stun_header_inner.css('minHeight').replace('px', '') : $stun_header_inner.height(),
						headerTitleWrapHeight = $header_title_wrap.height();

					if (
						$menu_fixer.length === 0 /*&& !$header_container.hasClass('side-header')*/
						&& !$header_container.hasClass('menu-position-bottom')
					) {
						$menu_fixer = $('<div id="menu-fixer"></div>');
					}
					$stuning_header.prepend($menu_fixer);
					var m_f_des = $(".menu-fixer.desktop");
					var m_f_tab = $(".menu-fixer.tablet");
					var m_f_mob = $(".menu-fixer.mobile");
					if(!m_f_des.length){
						$stuning_header.prepend('<div class="menu-fixer desktop"></div>');
					}
					if(!m_f_tab.length){
						$stuning_header.prepend('<div class="menu-fixer tablet"></div>');
					}
					if(!m_f_mob.length){
						$stuning_header.prepend('<div class="menu-fixer mobile"></div>');
					}
					
					if($stuning_header.find('.page-title-inner > .dfd-mini-categories').length > 0 && $stuning_header.find('.page-title-inner > .dfd-meta-wrap').length > 0) {
						heightIncr = 170;
					} else if($stuning_header.find('.page-title-inner > .dfd-mini-categories').length > 0 && !$stuning_header.find('.page-title-inner > .dfd-meta-wrap').length > 0) {
						heightIncr = 80;
					} else if($stuning_header.find('.page-title-inner > .dfd-meta-wrap').length > 0 && !$stuning_header.find('.page-title-inner > .dfd-mini-categories').length > 0) {
						heightIncr = 90;
					}
					
					if(typeof dfd_native.windowWidth != 'undefined' && dfd_native.windowWidth < 800) {
						heightIncrVal = 140;
					} else {
						heightIncrVal = heightIncr;
					}
					
					if(stunHeaderHeight < headerTitleWrapHeight + heightIncrVal || (typeof dfd_native.windowWidth != 'undefined' && dfd_native.windowWidth < 1260)) {
						$stun_header_inner.css('min-height',headerTitleWrapHeight + heightIncrVal);
					} else {
						$stun_header_inner.css('min-height','');
					}
					
					if($stun_header_inner.hasClass('full-height')) {
						var offset = 0;
						if(!$header_container.hasClass('dfd-header-layout-fixed')) {
							offset += hcH;
						} else {
							$menu_fixer.remove();
							$(".menu-fixer").remove();
							if($stun_header_inner.find('.dfd-mini-categories').length > 0) {
								$stun_header_inner.find('.dfd-mini-categories').css('margin-top', hcH);
							}
						}
						if($('#wpadminbar').length > 0) {
							offset += $('#wpadminbar').outerHeight();
						}
						if($('.dfd-frame-line.line-bottom').length > 0) {
							offset += $('.dfd-frame-line.line-bottom').outerHeight() * 2;
						}
						$stun_header_inner.css('min-height','calc(100vh - '+offset+'px)');
					}
				} else {
					if (
						dfd_native.windowWidth > headerResponsiveBreakpoint
						&& ($header_container.hasClass('dfd-header-layout-fixed')
						|| $('#main-wrap').hasClass('dfd-one-page-scroll-layout')
						|| $header_container.hasClass('menu-position-bottom'))
					) {
						if ($menu_fixer.length > 0) {
							$menu_fixer.remove();
						}
					} else {
						if($menu_fixer.length === 0){
							$menu_fixer = $('<div id="menu-fixer"></div>');
							$($menu_fixer).insertAfter('#header-container');
							var m_f_des = $(".menu-fixer.desktop");
							var m_f_tab = $(".menu-fixer.tablet");
							var m_f_mob = $(".menu-fixer.mobile");
							if(!m_f_des.length){
								m_f_des = $('<div class="menu-fixer desktop"></div>');
								m_f_des.insertAfter('.header_wrap.dfd-header-builder');
							}
							if(!m_f_tab.length){
								m_f_tab = $('<div class="menu-fixer tablet"></div>');
								m_f_tab.insertAfter('.header_wrap.dfd-header-builder');
							}
							if(!m_f_mob.length){
								m_f_mob = $('<div class="menu-fixer mobile"></div>');
								m_f_mob.insertAfter('.header_wrap.dfd-header-builder');
							}
//							$($menu_fixer).insertAfter('.header_wrap.dfd-header-builder');
						}
					}
				}
				if ($menu_fixer.length > 0) {
					$menu_fixer.css({
						'height': hcH,
						'max-height': hcH,
					});
				}
				if(($header_container.hasClass('header-style-12') || $header_container.hasClass('header-style-14')) && $('.boxed_layout').length > 0) {
					var $bodyWrapper = $('.boxed_layout'),
						bodyWrapperOffset = $bodyWrapper.offset().left;

					if($header_container.hasClass('left')) {
						$header_container.find('#header').css('left', bodyWrapperOffset);
						$header_container.find('.header').css('left', bodyWrapperOffset);
					} else if($header_container.hasClass('right')) {
						$header_container.find('#header').css('right', bodyWrapperOffset);
						$header_container.find('.header').css('right', bodyWrapperOffset);
					}
				}
				
				if($header_container.hasClass('dfd-header-builder') && $header_container.hasClass('side-header')){
					var mid_pan = $(".dfd-header-builder.side-header .header-builder-wrraper.desktop .header-mid-panel");
					dfd_native.roundCssTransformMatrix(mid_pan);
				}
				$(document.body).trigger("sticky_kit:recalc reinit-waypoint");
			};
			
			dfd_native.window.on('load resize', function() {
				header_el_sizing();
				setTimeout(function() {
					header_el_sizing();
				},400);
				$('body').on('window-on-top', function() {
					setTimeout(function() {
						header_el_sizing();
					}, 400);
				});
				if($('#wpadminbar').length > 0) {
					$('html').addClass('dfd-admin-bar-enabled');
				}
			});

			if($header_container.hasClass('dfd-enable-headroom') && !$('#layout').hasClass('one-page-scroll')) {
				dfd_native.window.on('load resize scroll', function() {
					initAnim($header_container, 'small', 'animated--header');
					if(dfd_native.window.scrollTop() == 0) {
						$('body').trigger('window-on-top');
					}
				});
			}

			var $top_panel_inner = $('#top-panel-inner .top-panel-inner-wrapper'),
				$top_panel_animate_wrap = $('#top-panel-inner .dfd-top-panel-animate-wrap'),
				set_top_panel = function() {
					var height = dfd_native.windowHeight;
					if($('.dfd-frame-line.line-top').length > 0) {
						height = height - $('.dfd-frame-line.line-top').outerHeight() * 2;
					}
					if($('#wpadminbar').length > 0) {
						height = height - $('#wpadminbar').outerHeight();
					}
					$top_panel_inner.outerHeight(height);
					$top_panel_animate_wrap.outerHeight(height);
				};

			$top_panel_inner.wrapInner('<div class="dfd-vertical-aligned" />');
			
			$top_panel_inner.append('<a class="top-inner-page top-inner-page-close dfd-mobile-header-hide dfd-socicon-icon-close-round" href="#"></a>');

			dfd_native.window.on('load resize', set_top_panel);

			if (typeof $.runMegaMenu === 'function') {
				$.runMegaMenu();
			}

			$('.click-dropdown > a').unbind('click').bind('click', function(e){
				var $self = $(this).parent();
				e.preventDefault();
				if(!$self.hasClass('active')) {
					$self.addClass('active').siblings('.click-dropdown').removeClass('active');
				} else {
					$self.removeClass('active');
				}
			});

			var button = $('.header-search-switcher');
			var form = $('.form-search-section');
			
			if (form.find('#dfd-search-loader').length > 0) {
				var searchLoader = new SVGLoader( document.getElementById('dfd-search-loader'), { speedIn : 400 } );
			}
			button.unbind('click').on('click touchend', function() {
				form.toggleClass('shift-form');
				if(form.hasClass('shift-form')) {
					searchLoader.show();
				} else {
					setTimeout(function() {
						searchLoader.hide();
					},200);
				}
				return false;
			});
			
			var $speedIn = $('#dfd-header-loader').data('speed') ? $('#dfd-header-loader').data('speed') : 100;
			var $reverse = $('#dfd-header-loader').data('reverse') ? $('#dfd-header-loader').data('reverse') : 850;
			var $header_anim_wrap = $('#header-anim-wrap');
			if ($header_anim_wrap.find('#dfd-header-loader').length > 0) {
				var loader = new SVGLoader( document.getElementById('dfd-header-loader'), { speedIn : $speedIn} );
			
			}
			
			$('body').on('click', '.dfd-menu-button', function(e) {
				e.preventDefault();
				if($header_container.hasClass('header-style-13')) {
					$header_container.toggleClass('active');
				} else if($header_container.hasClass('click-animated')) {
					$header_container.find('#header').toggleClass('active');
					$header_container.find('.header').toggleClass('active');
					if($header_container.hasClass('with-preloader')) {
						if($header_anim_wrap.hasClass('stretch') || $header_anim_wrap.hasClass('spill') || $header_anim_wrap.hasClass('windscreen') || $header_anim_wrap.hasClass('lateral_swipe')) {
							$header_anim_wrap.toggleClass('active');
							if($header_anim_wrap.hasClass('active')) {
								loader.show();
							} else {
								setTimeout(function() {
									loader.hide();
								}, $reverse ); 
							}
						}
					}
					if($header_container.find('#header').hasClass('active') || $header_container.find('.header').hasClass('active')) {
						setTimeout(function() {
							$header_container.find('#header .mega-menu').addClass('visible-overflow');
							$header_container.find('.header .mega-menu').addClass('visible-overflow');
						}, 1000);
					} else {
						$header_container.find('#header .mega-menu').removeClass('visible-overflow');
						$header_container.find('.header .mega-menu').removeClass('visible-overflow');
					}
				} else if($header_container.hasClass('side-area-enabled')) {
					$('body').toggleClass('side-area-opened');
				}
			});
			var $top_panel = $('#top-panel-inner'),
				$top_panel_wrap = $top_panel.find('.top-panel-inner-wrapper'),
				speed = $('#dfd-top-panel-loader').data('speed') ? $('#dfd-top-panel-loader').data('speed') : 400;
			
			if ($top_panel.find('#dfd-top-panel-loader').length > 0) {
				var TopPanelLoader = new SVGLoader( document.getElementById('dfd-top-panel-loader'), { speedIn : speed } );
			}
			
			$('a.top-inner-page').on('click', function(e){
				e.preventDefault();
				$('body').toggleClass('top-inner-page-active');

				if ($top_panel_wrap.hasClass('stretch') || $top_panel_wrap.hasClass('spill') || $top_panel_wrap.hasClass('windscreen') || $top_panel_wrap.hasClass('lateral_swipe')) {
					$top_panel.toggleClass('active');
					if($top_panel.hasClass('active')) {
						TopPanelLoader.show();
					} else {
						setTimeout(function() {
							TopPanelLoader.hide();
						},200);
					}
				}
			});
			$('#loginModal').find('a.button.registration').click(function(e) {
				var $regForm = $('#dfd-register');
				if($regForm.length > 0) {
					e.preventDefault();
					$('.reveal-modal-bg').trigger('click');
					$regForm.addClass('active');
					$('.dfd-close-register').click(function(e) {
						e.preventDefault();
						$regForm.removeClass('active');
					});
				}
			});
			$('#loginModal .login-lost-password').find('a').click(function(e) {
				var $lostForm = $('#dfd-lost-password');
				if($lostForm.length > 0) {
					e.preventDefault();
					$('.reveal-modal-bg').trigger('click');
					$lostForm.addClass('active');
					$('.dfd-close-lost-password').click(function(e) {
						e.preventDefault();
						$lostForm.removeClass('active');
					});
				}
			});
			
			if($header_container.hasClass('header-style-8') || $header_container.hasClass('header-style-9') || $header_container.hasClass('header-style-12') || $header_container.hasClass('header-style-13')) {
				$header_container.find('nav.mega-menu').siblings(':not(.header-top-panel):not(.dfd-header-logos):not(.dfd-click-menu-button-wrap)').wrapAll('<div class="dfd-header-bottom-buttons" />');
			}
			
			if($header_container.hasClass('header-style-3') || $header_container.hasClass('header-style-4')) {
				var wrapperWidth,
					$menu = $('.menu-wrap'),
					menuWidth,
					menuOffset,
					$buttonsWrap = $('.dfd-header-buttons-wrap'),
					buttonsWidth,
					hideItem = function() {
						$buttonsWrap.find('>:not(.hidden):visible:last').addClass('hidden');
					},
					showItem = function() {
						$buttonsWrap.find('>.hidden:last').removeClass('hidden');
					},
					responsiveHeaderThirdFourth = function() {
						if(dfd_native.windowWidth > headerResponsiveBreakpoint) {
							menuWidth = $menu.width(),
							wrapperWidth = $('.header-wrap > .row > .columns').width(),
							menuOffset = $menu.offset().left,
							buttonsWidth = $buttonsWrap.outerWidth(true);

							if((wrapperWidth - buttonsWidth) < (menuWidth + menuOffset)) {
								hideItem();
							} else {
								showItem();
							}
						} else {
							$buttonsWrap.find('.hidden').removeClass('hidden');
						}
					};
				dfd_native.window.on('load resize', responsiveHeaderThirdFourth);
			}
			
			$('.lang-sel:not(.dfd-wpml-switcher)').find('a').click(function(e) {
				var $self = $(this);
				
				if($self.attr('href') == '#') {
					e.preventDefault();
					alert('The language switcher requires WPML plugin to be installed and activated.');
				}
			});

			dfd_native.loadRetinaLogo();

			dfd_native.bindMobileMenu();
		};

		dfd_native.document.ready(function($) {
			"use strict";
			$.bindHeaderEvents();

			dfd_native.window.on("resize", function () {
				var $tiled_menu = $('.mega-menu, .sub-nav', '#header','.header');
				if (dfd_native.windowWidth >= screen_medium) {
					$tiled_menu.each(function(){
						if (!$(this).is(':visible')) {
							$(this).removeAttr('style');
						}
					});
				}
			});
			
			if($('#wpadminbar').length > 0) {
				$('#wpadminbar').addClass('dfd-admin-bar');
			}
			
			var $back_to_top = $('.body-back-to-top'),
				$fixed_pagination = $('.dfd-single-pagination.fixed');
			var timer, el = $('body'),
			flag = false;
			dfd_native.window.on('scroll', function() {
				if(!Modernizr.touch) {
					if (!flag) {
						flag = true;
						el.addClass('scrolling');
					}
					clearTimeout(timer);
					timer = setTimeout(function() {
						el.removeClass('scrolling');
						flag = false;
					}, 200);
				}
				if ($back_to_top.length>0) {
					if(dfd_native.windowScrollTop > 80) {
						$back_to_top.stop().addClass('visible');
						if($('.dfd-single-pagination').length > 0 && $('.dfd-single-pagination').hasClass('fixed') && !$('.dfd-single-pagination .page-inner-nav.nav-next').hasClass('empty')) {
							$back_to_top.addClass('lifted');
						}
					} else {
						$back_to_top.stop().removeClass('visible active lifted');
					}
				}
				if ($fixed_pagination.length > 0) {
					if(dfd_native.windowScrollTop > 80) {
						$fixed_pagination.addClass('lifted');
					} else {
						$fixed_pagination.removeClass('lifted');
					}
				}
			});

			var duration = 800;
			$('.back-to-top, .body-back-to-top').click(function (event) {
				$back_to_top.addClass('active');
				event.preventDefault();
				$('html, body').animate({scrollTop: 0}, duration);
				return false;
			});

			$('.chaffle').chaffle({
				speed: 20,
				time: 60
			});

			$('.cart-collaterals').on('click touchend', '.dfd-shipping-title > span', function() {
				$(this).parents('.shipping-calculator-wrap').find('.shipping-calculator').slideToggle(500);
			});
			
			$('body').on('post-load reinit-waypoint',function() {
				setTimeout(function() {
					Waypoint.refreshAll();
				}, 500);
			});
			
			$('[data-enable-isotope="1"]').on('layoutComplete', function() {
				Waypoint.refreshAll();
			});
			
			$('[data-init-hover]').each(function() {
				var $self = $(this),
					prop = $self.data('prop'),
					initVal = $self.css(prop),
					hoverVal = $self.data('hover-val');
				
				$self.hover(function() {
					$self.css(prop, hoverVal);
				}, function() {
					$self.css(prop, initVal);
				});
			});
		});

		/* remove header, footer and admin bar if  opened in iframe */
		dfd_native.window.load(function() {
			var hide_show_isotope_category = function () {
				$('[data-enable-isotope="1"]').each(function() {
					var $container = $(this),
						$filter_item = $container.prev().find('.sort-panel a');

					$filter_item.each(function() {
						var $this = $(this);
						var filter = ($this.data('filter') != undefined) ? $this.data('filter') : false;
						if (filter === false) {
							return true;
						}
						var filter_match = $container.find(filter).length;

						if (filter_match == 0) {
							$this.parent('li').hide();
						} else if (filter_match > 0 && $this.parent('li').is(':hidden')) {
							$this.parent('li').show();
						}
					});
				});
			};

			hide_show_isotope_category();

			$('body').on('post-load', function(e) {
				hide_show_isotope_category();
			});
			
			if(dfd_native.sameOrigin && typeof parent.vc != 'undefined' && typeof parent.vc.events != 'undefined') {
				parent.vc.events.on('shortcodeView:ready', function() {
					$('body').trigger('post-load');
					setTimeout(function() {
						$('body').trigger('resort-isotope');
					}, 1000);
				});
			}
		});
	};
	
	dfd_native.initParallaxBackground = function (){
		var dfdParallax = function() {
			$('.dfd_stun_header_vertical_parallax, .dfd-row-parallax, .dfd-column-parallax, .dfd-fade-on-scroll, .dfd-row-bg-image.dfd_vertical_parallax, .dfd-row-bg-image.dfd_horizontal_parallax, .dfd-multi-parallax-layer, .stuning-header-inner .page-title-inner').each(function() {
				// Store some variables based on where we are
				var $self = $(this), offsetCoords, topOffset, selfHeight;

				var recalcInitValues = function() {
					offsetCoords = $self.offset();
					if($self.hasClass('dfd_vertical_parallax')) {
						offsetCoords = $self.parent().offset();
					}
					selfHeight = $self.height();
					if($self.hasClass('dfd_vertical_parallax')) {
						selfHeight = $self.parent().height();
					}
					topOffset = offsetCoords.top;
				};

				recalcInitValues();

				dfd_native.window.on("load resize", recalcInitValues);

				var speed = parseFloat($self.data('parallax_sense')) / 100;
				var maxMinValue = parseFloat($self.data('parallax_limit'));
				var statPos = '0';
				var mobileEnable = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false;

				dfd_native.window.on("load scroll", function() {
					if(!mobileEnable && Modernizr.touch && dfd_native.windowWidth < 800) {
						return;
					}
					if (
						( (dfd_native.windowScrollTop + dfd_native.windowHeight) > topOffset )
						&&
						( (topOffset + selfHeight) > dfd_native.windowScrollTop )
					) {
						recalcInitValues();
						// If this section is in view
						// Scroll the background at var speed
						// the yPos is a negative value because we're scrolling it UP!
						var diff = (topOffset - dfd_native.windowScrollTop) / 3,
							diffPos = -(diff * speed),
							starPosition = '50% 50%';
						// If this element has an Y offset then add it on
						if ($self.data('parallax_offset')) {
							if($self.hasClass('dfd_vertical_parallax') || $self.hasClass('dfd_horizontal_parallax')) {
								if($self.hasClass('dfd_vertical_parallax')) {
									starPosition = '50% calc(50% + '+$self.data('parallax_offset')+'px)';
								} else if($self.hasClass('dfd_horizontal_parallax')) {
									starPosition = 'calc(50% + '+$self.data('parallax_offset')+'px) 50%';
								}
								$self.css('backgroundPosition', starPosition);
							}
						}
						// Put together our final background position
						var coords;
						if($self.hasClass('dfd_vertical_parallax')) {
							coords = statPos + ', ' + diffPos + 'px';
						}

						if($self.hasClass('dfd_horizontal_parallax')) {
							coords = diffPos + 'px,' + statPos;
						}

						if($self.hasClass('dfd-multi-parallax-layer')) {
							var increment = +$self.attr('class').slice(-1);
							var dirMulti = $self.data('direction-multi') ? $self.data('direction-multi') : 'vertical';
							if(dirMulti == 'vertical') {
								coords = statPos + ', ' + diffPos * increment + 'px';
							} else {
								coords = diffPos * increment + 'px,' + ' ' + statPos;
							}
						}

						if($self.hasClass('dfd-row-parallax')) {
							var yPos = -(diff * speed);

							if(yPos > maxMinValue) {
								yPos = maxMinValue;
							}
							if(yPos < -maxMinValue) {
								yPos = -maxMinValue;
							}

							// Move the module
							window.requestAnimationFrame(function() {
								$self.find('>.row').css({
									'-webkit-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'-moz-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'-0-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'transform': 'matrix(1,0,0,1,0,'+yPos+')'
								});
							});
						}
						if($self.hasClass('dfd-column-parallax')) {
							// Move the column
							var yPos = -(diff * speed);

							if(yPos > maxMinValue) {
								yPos = maxMinValue;
							}
							if(yPos < -maxMinValue) {
								yPos = -maxMinValue;
							}

							window.requestAnimationFrame(function() {
								$self.css({
									'-webkit-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'-moz-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'-0-transform': 'matrix(1,0,0,1,0,'+yPos+')',
									'transform': 'matrix(1,0,0,1,0,'+yPos+')'
								});
							});
						}
						if($self.hasClass('dfd_stun_header_vertical_parallax')) {
							// Move the bg container
							var yPos = Math.floor(dfd_native.windowScrollTop * speed / 5);
							
							if(yPos < 0) {
								yPos = 0;
							}

							window.requestAnimationFrame(function() {
								$self.css({
									'-webkit-transform': 'translate3d(0,'+yPos+'px,0)',
									'-moz-transform': 'translate3d(0,'+yPos+'px,0)',
									'-0-transform': 'translate3d(0,'+yPos+'px,0)',
									'transform': 'translate3d(0,'+yPos+'px,0)'
								});
							});
						}
						if($self.hasClass('dfd-fade-on-scroll')) {
							var height = $self.height();

							// Fade the row
							$self.css({
								opacity: (1 + 1/(height/(topOffset - dfd_native.windowScrollTop)))
							});
						}
						if(
							$self.hasClass('dfd_vertical_parallax') ||
							$self.hasClass('dfd_horizontal_parallax') ||
							$self.hasClass('dfd-multi-parallax-layer')
						) {
							window.requestAnimationFrame(function() {
								$self.css({
									'-webkit-transform': 'translate3d('+coords+',0)',
									'-moz-transform': 'translate3d('+coords+',0)',
									'-0-transform': 'translate3d('+coords+',0)',
									'transform': 'translate3d('+coords+',0)'
								});
							});
							// Move the background
						}
					}
				});
			});
		};

		var dfdStunHeaderParallax = function() {
			var $self = $('.stuning-header-inner .page-title-inner'),
				$meta = $('.dfd-meta-wrap', $self);
			
			if($self.hasClass('dfd-enable-parallax')) {
				dfd_native.window.on('scroll',function(e){
			
					var scrolledY = dfd_native.windowScrollTop,
						height = $self.parent().height(),
						coord = scrolledY*.333;

					window.requestAnimationFrame(function() {
						$self.css({
							'-webkit-transform': 'translate3d(0,'+coord+'px,0)',
							'-moz-transform': 'translate3d(0,'+coord+'px,0)',
							'-o-transform': 'translate3d(0,'+coord+'px,0)',
							'transform': 'translate3d(0,'+coord+'px,0)',
							'opacity': (1 - (scrolledY/height))
						});
						$meta.css({
							'opacity': (1 - (scrolledY/(height/5)))
						});
					});
				});
			}
		};
		
		var initMobileBgImage = function() {
			$('.dfd-row-bg-image').each(function() {
				var $self = $(this),
					defaultImage = '',
					mobileImage = '',
					resolution = 800;
				
				if($self.data('default-image')) {
					defaultImage = $self.data('default-image');
				}
				
				if($self.data('responsive-image')) {
					mobileImage = $self.data('responsive-image');
				}
				
				if($self.data('responsive-resolution')) {
					resolution = $self.data('responsive-resolution');
				}
				
				if(defaultImage != '' && mobileImage != '') {
					if(typeof dfd_native.windowWidth != 'undefined' && dfd_native.windowWidth < resolution && mobileImage) {
						$self.css('background-image','url('+mobileImage+')');
					} else {
						$self.css('background-image','url('+defaultImage+')');
					}
				}
			});
		};
		
		dfd_native.window.on('load resize', initMobileBgImage);
		
		if (!$('html').is('.lt-ie10, .lt-ie9, .lt-ie8')) {
			dfdParallax();
			dfd_native.window.load(function(){
				dfdParallax();
				if (!Modernizr.touch && dfd_native.windowWidth > 800) {
					dfdStunHeaderParallax();
					var offset = 0;
					if($('#header-container').length > 0) {
						offset += 60;
					}
					if($('#wpadminbar').length > 0) {
						offset += $('#wpadminbar').outerHeight();
					}
					if($('.dfd-frame-line.line-bottom').length > 0) {
						offset += $('.dfd-frame-line.line-bottom').outerHeight();
					}
					$('#layout.single-folio .dfd-portfolio-description.four.columns > .row').stick_in_parent({
						parent: '.row.entry-thumb',
						sticky_class: 'sticky',
						offset_top: offset + 20,
						bottoming: true,
						inner_scrolling: false
					});
					$('.dfd-blog-share-fixed-wrap').stick_in_parent({
						sticky_class: 'sticky',
						offset_top: offset,
						bottoming: true,
						inner_scrolling: false
					});
					$('.dfd-single-product-desc-wrap > .summary').stick_in_parent({
//						parent: '#layout.dfd-shop-single #main-content .dfd-product_single > .row > .product',
						sticky_class: 'sticky',
						offset_top: offset + 20,
						bottoming: true,
						inner_scrolling: false
					});
					$('.dfd-sticky-row').stick_in_parent({
						sticky_class: 'sticky',
						offset_top: offset,
						bottoming: true,
						inner_scrolling: false
					});
				}
			});
		}
	};
	
	dfd_native.wrapSinglePostVcContent = function() {
		if($('#left-sidebar').length < 1 && $('#right-sidebar').length < 1 ) {

			var setSizes = function($el) {
					var offset = $el.offset().left,
						elWidth = dfd_native.windowWidth - dfd_native.scrollbarWidth;
					
					if($el.parents('.cover').length > 0) {
						offset = $el.parents('.cover').offset().left;
					}

					if($('.dfd-frame-line.line-top').length > 0) {
						var frameSize = $('.dfd-frame-line.line-top').height();
						offset = offset - frameSize;
						elWidth = elWidth -(frameSize * 2);
					}

					$el.find('.dfd-post-vc-content-wrapper').css({
						'width':		elWidth,
						'margin-left':	-offset
					});
				},
				initPosts = function() {
					$('#layout.single-post').find('.dfd-content-wrap.dfd-post_single > article').find('> .entry-content, > .cover > .entry-content').each(function() {
						var $self = $(this);
						if(($self.find('> .vc-row-wrapper').length > 0 || $self.find('> .vc_element.vc_vc_row').length > 0) && typeof dfd_native.windowWidth != 'undefined') {
							$('#layout').addClass('dfd-composer-post');

							if($('#stuning-header').length > 0) {
								$('#stuning-header').addClass('dfd-composer-post');
							}

							$self.wrapInner('<div class="dfd-post-vc-content-wrapper" />').parents('#layout').find('article.post > .dfd-blog-share-fixed-wrap').hide();

							setSizes($self);
							dfd_native.window.on('load resize',function() {
								setSizes($self);
							});
						}
					});
				},
				initPortfolios = function() {
					$('#layout.single-folio').find('.dfd-content-wrap.dfd-portfolio_single > article').find('> .cover > .entry-content > .columns').each(function() {
						var $self = $(this);
						if(($self.find('> .vc-row-wrapper').length > 0 || $self.find('> .vc_element.vc_vc_row').length > 0) && typeof dfd_native.windowWidth != 'undefined') {
							$('#layout').addClass('dfd-composer-post');

							if($('#stuning-header').length > 0) {
								$('#stuning-header').addClass('dfd-composer-post');
							}

							$self.wrapInner('<div class="dfd-post-vc-content-wrapper" />');
							
							$self.parents('#layout').find('.dfd-blog-share-fixed-wrap').hide();

							setSizes($self);
							dfd_native.window.on('load resize',function() {
								setSizes($self);
							});
						}
					});
				},
				init = function() {
					initPosts();
					initPortfolios();
				};
			
			init();
			
			dfd_native.window.on('load', function() {
				if($('body').hasClass('compose-mode')) {
					init();
				}
			});
		}
	};
	
	dfd_native.wrapPostInner = function($el) {
		var $innerItems = $el.children(':not(.author-section):not(.entry-thumb)').clone();
					
		$el.find('> *:not(.author-section):not(.entry-thumb)').remove();

		if($el.find('.author-section').length) {
			$('<div class="inner-cover" />').insertBefore($el.find('.author-section'));
		} else if($el.find('.entry-thumb').length) {
			$('<div class="inner-cover" />').insertAfter($el.find('.entry-thumb'));
		}

		$el.find('.inner-cover').append($innerItems);
	};
	
	dfd_native.initMetroIsotope = function() {
		$('.dfd-post.layout-metro, .dfd-post_archive.layout-metro').each(function() {
			var $container = $(this),
				$item = $container.find('> article');

			$item.each(function() {
				var $self = $(this),
					$cover = $self.find('> .cover');
					
				if(
					$item.hasClass('post') &&
					!$cover.find('.inner-cover').length &&
					(
						(
							($self.hasClass('format-audio') ||
							$self.hasClass('format-quote') ||
							$self.hasClass('format-link')
							) &&
							!$self.find('.entry-thumb').length
						) ||
						$self.hasClass('dfd-featured') ||
						$self.hasClass('dfd-side-image')
					)
				) {
					dfd_native.wrapPostInner($cover);
				}
			});
			$item.equalHeights();
			if(typeof $.fn.imagesLoaded != 'undefined') {
				$container.imagesLoaded().done( function() {
					$item.equalHeights();
				});
			}
			$.browser.firefox = /firefox/.test(navigator.userAgent.toLowerCase());
			if($.browser.firefox) {
				setTimeout(function() {
					$item.equalHeights();
				},1500);
			}
			$('body').trigger('metro-inited');
		});
	};
	
	dfd_native.isotopePosts = function() {
		var init = function(selector) {
			$(selector).each(function() {
				var $container = $(this),
					layoutType = $container.data('layout-type'),
					layoutStyle,
					params = {
						itemSelector : 'article',
						resizable : true,
						sortBy: 'original-order',
					};

				$container.addClass('dfd-isotope layout-'+layoutType);

				if(layoutType === 'masonry' || layoutType === 'metro' || layoutType === 'shortcode_metro') {
					layoutStyle = 'packery';
				} else {
					layoutStyle = 'fitRows';
				}

				params.layoutMode = layoutStyle;

				var runIsotope = function() {
					dfd_native.initMetroIsotope();
					$container.isotope(params);
				};

				runIsotope();

				$container.siblings('.clearfix').find('.sort-panel .filter a').click(function (e) {
					e.preventDefault();

					var selector = $(this).attr('data-filter');

					$(this).parent().parent().find('> li.active').removeClass('active');
					$(this).parent().addClass('active');

					$container.isotope({
						filter : selector
					});

					$('body').trigger('isotope-sorted');
				});
				
				$('.blog-top-block').find('ul > li > a').click(function(e) {
					e.preventDefault();

					var selector = $(this).attr('data-filter');

					$(this).parent().parent().find('> li.active').removeClass('active');
					$(this).parent().addClass('active');

					$container.isotope({
						filter : selector
					});

					$('body').trigger('isotope-sorted');
				});
			});
		};
		dfd_native.window.on('load resize',function() {
			init('[data-enable-isotope="1"]');
		});
		$('body').on('post-load resort-isotope', function() {
			setTimeout(function() {
				init('[data-enable-isotope="1"]');
			},800);
		});
		$('body').on('tabs-reinited', function() {
			setTimeout(function() {
				init('[data-enable-isotope="1"]');
			},800);
		});
		if(typeof $.fn.imagesLoaded != 'undefined') {
			$('[data-enable-isotope="1"]').imagesLoaded().done( function() {
				init('[data-enable-isotope="1"]');
				setTimeout(function() {
					init('[data-enable-isotope="1"]');
				},2500);
			});
		}
		$.browser.firefox = /firefox/.test(navigator.userAgent.toLowerCase());
		if($.browser.firefox) {
			setTimeout(function() {
				init('[data-enable-isotope="1"]');
			},2500);
		}
	};
	
	dfd_native.ajaxAddPosts = function() {
		dfd_native.document.ready(function() {
			$('.dfd-ajax-add-post').each(function() {
				var $self = $(this),
					actionHook = $self.data('action') ? $self.data('action') : 'dfd_load_more',
					currentPage = $self.data('current') ? $self.data('current') : 1,
					max_pages = $self.data('max_pages'),
					extra_params = $self.data('extra_params'),
					container_selector = $self.data('container');

				$self.click(function(e) {
					var $self = $(this),
						action = 'action='+actionHook+'&nonce=' + ajax_var.nonce + '&current=' + currentPage + '&max_pages=' + max_pages;

					if(extra_params && extra_params !== '') {
						action += '&' + extra_params;
					}

					e.preventDefault();
					$.ajax({
						type: 'POST',
						url: ajax_var.url,
						data: action,
						dataType: 'html',
						beforeSend: function() {
							$self.addClass('loading');
						},
						complete: function(XMLHttpRequest) {
							$self.removeClass('loading');
							if (XMLHttpRequest.status == 200 && XMLHttpRequest.responseText != '') {
								++currentPage;
								$self.parent().siblings(container_selector).append(XMLHttpRequest.responseText);
								if(+currentPage == max_pages) {
									$self.parent().html('<span class="loaded button">Done!</span>');
								}
								$('body').trigger('post-load');
							}
						}
					});
				});
			});
		});
	};
	
	dfd_native.postLike = function() {
		$('body').on('click','.post-like a',function () {

			var heart = $(this);

			// Retrieve post ID from data attribute
			var post_id = heart.data("post_id");

			// Ajax call
			$.ajax({
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce=" + ajax_var.nonce + "&post_like=&post_id=" + post_id,
				success: function (count) {
					// If vote successful
					if (count != "already") {
						heart.addClass("voted");
						heart.siblings(".count").text(count);
					}
				}
			});

			return false;
		});

		$("body").on('click','a.post-like, a.post-like-mini',function () {

			var $heart = $(this);

			// Retrieve post ID from data attribute
			var post_id = $heart.data("post_id");

			// Ajax call
			$.ajax({
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce=" + ajax_var.nonce + "&post_like=&post_id=" + post_id,
				success: function (count) {
					// If vote successful
					if (count != "already") {
						$heart.addClass("voted");
						$('.count', $heart).text(count);
					}
				}
			});

			return false;
		});
	};
	
	dfd_native.initGalleryPostCarousel = function() {
		var initGallery = function() {
			$('.dfd-gallery-post-slider').each(function() {
				var $carousel = $(this);
				if(!$carousel.hasClass('slick-initialized')) {
					var total_slides,
						slideshow_speed = 5000,
						$bar = $carousel.siblings('.dfd-gallery-bar'),
						carouselWidth;
					var getSize = function() {
						carouselWidth = $carousel.width();
					};
					getSize();
					dfd_native.window.on('load resize', getSize);
					var startAnimation = function() {
						$bar.css('width',0);
						$bar.animate({
							width: carouselWidth
						}, slideshow_speed, 'linear').parent()
						.hover(
							function(){
								$bar.stop(true,false);
						}, function(){
							var cur = parseInt($bar.css('width'));
							$bar.animate({ 'width' : carouselWidth }, slideshow_speed*((carouselWidth-cur)/carouselWidth), 'linear');
						});
					};
					$carousel.on('init reInit afterChange', function (event, slick, currentSlide) {
						//startAnimation();
						var prev_slide_index, next_slide_index, current;
						var $prev_counter = $carousel.next('.slider-controls').find('.prev .count');
						var $next_counter = $carousel.next('.slider-controls').find('.next .count');
						total_slides = slick.slideCount;
						current = (currentSlide ? currentSlide : 0) + 1;
						prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
						next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
						$prev_counter.text(prev_slide_index + '/' + total_slides);
						$next_counter.text(next_slide_index + '/'+ total_slides);
					});
					$carousel.slick({
						infinite: true,
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: false,
						dots: true,
						autoplay: true,
						autoplaySpeed: slideshow_speed
					});
					$carousel.siblings('.slider-controls').find('.next').click(function(e) {
						e.preventDefault();

						$carousel.eq(0).slick('slickNext');
					});

					$carousel.siblings('.slider-controls').find('.prev').click(function(e) {
						e.preventDefault();

						$carousel.eq(0).slick('slickPrev');
					});
					$carousel.find('div').on('mousedown select',(function(e){
						e.preventDefault();
					}));
				}
				return this;
			});
		};
		dfd_native.document.ready(function() {
			initGallery();
		});
		$('body').on('post-load', initGallery);
	};
	
	dfd_native.initAudioplayer = function() {
		var audioplayerRun = function() {
			$('.post.format-audio').each(function() {
				var $self = $(this),
					initPlayer = function() {
					if(!$self.find('div.audioplayer').length && $self.find('audio.audio').length) {
						$self.find('audio.audio:not(.wp-audio-shortcode)').audioPlayer({
							strPlay: '',
							strPause: '',
							strVolume: ''
						});
					}
				};
				if(!$self.parent().hasClass('layout-metro')) {
					initPlayer();
				} else {
					$('body').on('metro-inited', initPlayer);
				}
			});
			$('body').trigger('audioplayer-inited');
		};
		dfd_native.document.ready(function() {
			audioplayerRun();
		});
		$('body').on('post-load', audioplayerRun);
	};
	
	dfd_native.initAnimation = function() {
		var hideBeforeAnimation = function() {
			$('.cr-animate-gen, [data-animate="1"]').each(function () {
				var $self = $(this),
					$item;

				if ($self.data('animate-item')) {
					$item = $self.find($self.data('animate-item'));
					$item.each(function() {
						if(!$(this).hasClass('animation-done')) {
							$(this).css('opacity','0');
						}
					});
				} else {
					if(!$self.hasClass('animation-done')) {
						$self.css('opacity','0');
					}
				}
			});
		};

		var initAnimation = function () {
			var offset = $('#main-wrap').attr('data-appear-offset') ? $('#main-wrap').attr('data-appear-offset') : '98%';
			$('.cr-animate-gen, [data-animate="1"]').each(function () {
				var $curr = $(this);
				var $item;
				var $animation;
				$animation = $curr.data('animate-type');

				if ($curr.data('animate-item')) {
					$item = $curr.find($curr.data('animate-item'));
					$item.each(function() {
						var $self = $(this);
						$self.waypoint(function () {
							if(!$self.hasClass('animation-done')) {
								$self.addClass('animation-done')
									.velocity($animation,{display:'undefined'});
							}
						}, {offset: offset});
					});
				} else {
					$curr.waypoint(function () {
						if(!$curr.hasClass('animation-done')) {
							$curr.addClass('animation-done')
								.velocity($animation,{display:'undefined'});
						}
					}, {offset: offset});
				}
			});
		},
		initCallOnWaypoint = function() {
			var offset = 'bottom-in-view';//'70%';
			$('.call-on-waypoint').each(function () {
				var $this = $(this);

				$this.waypoint(function () {
					$this.trigger('on-waypoin');
				}, {triggerOnce: true, offset: offset});
			});
		};
		
		dfd_native.window.load(initCallOnWaypoint);

		$('body').on('post-load', function() {
			initCallOnWaypoint();
		});
		
		if(!Modernizr.touch && $(window).width() > 800) {
//			initAnimation();

			hideBeforeAnimation();

			dfd_native.window.load(function() {
				initAnimation();
				setTimeout(function() {
					initAnimation();
				}, 60);
			});

			$('body').on('post-load', function() {
				hideBeforeAnimation();
				initAnimation();
			});
		}
	};
	
	dfd_native.imagesLazyLoad = function() {
		var imagesLazyLoad = function() {
			$('.dfd-img-lazy-load').each(function () {
				var $self = $(this),
					offset = $('#main-wrap').data('lazy-load-offset') ? $('#main-wrap').data('lazy-load-offset') : '140%';
				if($('#layout').data('lazy-load-offset') && $('#layout').data('lazy-load-offset') == '1') {
					offset = '200%';
				}
				$self.waypoint(function () {
					if(!$self.hasClass('image-loaded')) {
						var $data_src = $self.find('img').attr('data-src');
						$self.addClass('image-loaded');
						$self
							.find('img').each(function() {
								var $img = $(this),
									src = $img.attr('data-src');
								
								$img.attr('src', src);
							});

						if(
							($self.parents('.dfd-content-wrap, .dfd-posts-module').hasClass('layout-masonry') || $self.parents('.dfd-content-wrap, .dfd-posts-module').hasClass('layout-metro'))
							&& $self.parents('article.post').hasClass('dfd-featured')
							|| ($self.parents('.dfd-content-wrap').hasClass('layout-metro') && $self.parents('article.post').hasClass('dfd-side-image'))
						) {
							$self.css('backgroundImage','url('+ $data_src +')');
						}
					}
				}, {handler: function(dir){this.destroy();}, offset: offset});
			});
		};
		imagesLazyLoad();
		
		dfd_native.window.load(imagesLazyLoad);
		$('body').on('post-load', imagesLazyLoad);
	};
	
	dfd_native.initLightbox = function() {
		var initPrettyPhoto = function() {
			var deeplinkVal = $('body').hasClass('dfd-pp-deeplinks') ? true : false,
				url = window.location.href,
				title = $('.pp_details .ppt').length ? $('.pp_details .ppt').text() : 'Share';
			$("a[data-rel^='prettyPhoto'], a.zoom-link, a.thumbnail, a[class^='prettyPhoto'], a[rel^='prettyPhoto']").prettyPhoto({
				hook: 'data-rel',
				show_title: true,
				deeplinking:deeplinkVal,
				opacity: 1,
				animation_speed: 'fast',
				theme: 'dfd-custom-theme',
				markup: '<div class="pp_pic_holder"> \
							<div class="pp_top"> \
								<div class="pp_left"></div> \
								<div class="pp_middle"></div> \
								<div class="pp_right"></div> \
							</div> \
							<div class="pp_content_container"> \
								<div class="pp_left"> \
									<div class="pp_right"> \
										<div class="pp_content"> \
											<div class="pp_loaderIcon"></div> \
											<div class="pp_fade"> \
												<div class="pp_hoverContainer"> \
													<a class="pp_next" href="#"><i class="dfd-socicon-arrow-right-01"><span class="count"></span></i></a> \
													<a class="pp_previous" href="#"><i class="dfd-socicon-arrow-left-01"><span class="count"></span></i></a> \
													<div class="pp_nav_wrapper"> \
														<a class="pp_close" href="#"><i class="dfd-socicon-icon-close-round"></i></a> \
														<a href="#" class="pp_expand" title="Expand the image"></a> \
														<div class="pp_nav"> \
															<a href="#" class="pp_arrow_previous">Previous</a> \
															<p class="currentTextHolder">0/0</p> \
															<a href="#" class="pp_arrow_next">Next</a> \
														</div> \
														<div class="pp_social">{pp_social}</div> \
													</div> \
												</div> \
												<div id="pp_full_res"></div> \
												<div class="pp_details"> \
													<div class="ppt">&nbsp;</div> \
													<p class="pp_description"></p> \
												</div> \
											</div> \
										</div> \
									</div> \
								</div> \
							</div> \
							<div class="pp_bottom"> \
								<div class="pp_left"></div> \
								<div class="pp_middle"></div> \
								<div class="pp_right"></div> \
							</div> \
						</div> \
						<div class="pp_overlay"></div>',
				gallery_markup: '<div class="pp_gallery mobile-hide"> \
									<div> \
										<ul> \
											{gallery} \
										</ul> \
									</div> \
								</div>',
				changepicturecallback: function() {
						var imgUrl = $('#fullResImage').attr('src');
						$('.pp_social .dfd-share-buttons').find('> li > a').each(function() {
							var src = $(this).attr('href');
							$(this).attr('href', src + imgUrl);
						});
						$('body').trigger('init-lightbox');
					},
				social_tools:	'<div class="dfd-blog-share-popup-wrap" data-url="'+url+'">\n\
									<div class="dfd-share-title"><i class="dfd-socicon-icon-share"></i></div>\n\
									<ul class="dfd-share-buttons" data-share="1">\n\
										<li class="dfd-share-facebook">\n\
											<a href="https://www.facebook.com/sharer/sharer.php?u=" class="popup" data-share-button="facebook" data-text="'+title+'">\n\
												<i class="dfd-socicon-facebook"></i>\n\
												<span class="share-count" data-share-count="facebook"></span>\n\
											</a>\n\
										</li>\n\
										<li class="dfd-share-googleplus">\n\
											<a href="https://plus.google.com/share?url=" class="popup" data-share-button="google" data-text="'+title+'">\n\
												<i class="dfd-socicon-google-plus"></i>\n\
												<span class="share-count" data-share-count="google"></span>\n\
											</a>\n\
										</li>\n\
										<li class="dfd-share-twitter">\n\
											<a href="https://twitter.com/intent/tweet?text=" class="popup" data-share-button="twitter" data-text="'+title+'">\n\
												<i class="dfd-socicon-twitter"></i>\n\
												<span class="share-count" data-share-count="twitter"></span>\n\
											</a>\n\
										</li>\n\
									</ul>\n\
								</div>',
			});
		};
		
		dfd_native.document.ready(initPrettyPhoto);
		
		$('body').on('post-load', initPrettyPhoto);
	};
	
	dfd_native.fullHeightRow = function() {
		var dfdFullHeightRow = function () {
			$( '.dfd-row-full-height:first' ).each( function () {
				var offset,
					fullHeight,
					$self = $(this);

				setTimeout(function() {
					offset = $self.offset().top;
					if($('.dfd-frame-line.line-bottom').length > 0) {
						offset += $('.dfd-frame-line.line-bottom').height();
					}
					if ( offset < dfd_native.windowHeight ) {
						fullHeight = dfd_native.windowHeight - offset;
						$self.css( 'min-height', fullHeight + 'px' );
					}
				}, 100);
			});
		};

		dfd_native.window.on('load resize', dfdFullHeightRow);
	};
	
	dfd_native.initEqualHeights = function() {
		var eqHeightInit = function() {
			var w = dfd_native.windowWidth;
			$('.vc-row-wrapper.equal-height-columns').each(function(){
				var $container = $(this),
					resolution = $container.data('resolution') ? $container.data('resolution') : 800,
					$columns = $container.find('>.row >.columns');
					
				if($columns.hasClass('twelve') && $columns.find('.vc-row-wrapper.vc_inner').length == 1 && $columns.find('.vc-row-wrapper.vc_inner').siblings().length < 1) {
					$columns = $columns.find('.vc-row-wrapper.vc_inner > .row > .columns');
				}
				if($(this).hasClass('mobile-destroy-equal-heights')) {
					if (w > resolution) {
						$columns.equalHeights();
					} else {
						$columns.equalHeightsDestroy();
					}
				} else {
					$columns.equalHeights();
				}
			});
			$('.dfd-equal-height-wrapper').each(function(){
				if($(this).hasClass('dfd-mobile-destroy-equal-heights')) {
					if (w>800) {
						$(this).find('>div').equalHeights();
					} else {
						$(this).find('>div').equalHeightsDestroy();
					}
				} else {
					$(this).find('>div').equalHeights();
				}
			});
			var $productContainer = $('#layout.dfd-shop-single #main-content .dfd-product_single > .row > .product');
			
			if (w>800) {
				$productContainer.find('.equalize-me').equalHeights();
			} else {
				$productContainer.find('.equalize-me').equalHeightsDestroy();
			}
		};

		dfd_native.document.ready(function() {
			$('.vc-row-wrapper.equal-height-columns.aligh-content-verticaly').each(function(){
				var $container = $(this),
					$columns = $container.find('>.row >.columns');
					
				if($columns.hasClass('twelve') && $columns.find('.vc-row-wrapper.vc_inner').length == 1 && $columns.find('.vc-row-wrapper.vc_inner').siblings().length < 1) {
					$columns = $columns.find('.vc-row-wrapper.vc_inner > .row > .columns');
				}
				
				$columns.each(function() {
					$(this).wrapInner('<div class="dfd-vertical-aligned"></div>');
				});
			});
		});

		$('body').on('post-load',eqHeightInit);
		
		$(window).on('load resize', eqHeightInit);
	};
	
	dfd_native.initSpacerShortcode = function() {
		var initSpacer = function() {
			$('.dfd-spacer-module').each(function() {
				var $self = $(this),
					wWidth = dfd_native.windowWidth,
					units = $self.data('units'),
					screen_wide_spacer_size = $self.data('wide_size'),
					screen_normal_resolution = $self.data('normal_resolution'),
					screen_normal_spacer_size = $self.data('normal_size') !== '' ? $self.data('normal_size') : screen_wide_spacer_size,
					screen_tablet_resolution = $self.data('tablet_resolution'),
					screen_tablet_spacer_size = $self.data('tablet_size') !== '' ? $self.data('tablet_size') : screen_wide_spacer_size,
					screen_mobile_resolution = $self.data('mobile_resolution'),
					screen_mobile_spacer_size = $self.data('mobile_size') !== '' ? $self.data('mobile_size') : screen_wide_spacer_size;
					
				if(units == '%' && screen_normal_spacer_size != 0 && screen_tablet_spacer_size != 0 && screen_mobile_spacer_size != 0) {
					screen_normal_spacer_size = screen_wide_spacer_size * screen_normal_spacer_size / 100;
					screen_tablet_spacer_size = screen_wide_spacer_size * screen_tablet_spacer_size / 100;
					screen_mobile_spacer_size = screen_wide_spacer_size * screen_mobile_spacer_size / 100;
				}

				$self.css('height',screen_wide_spacer_size);
				
				if(wWidth >= screen_tablet_resolution && wWidth < screen_normal_resolution) {
					$self.css('height',screen_normal_spacer_size);
				} else if(wWidth >= screen_mobile_resolution  && wWidth < screen_tablet_resolution) {
					$self.css('height',screen_tablet_spacer_size);
				} else if(screen_mobile_resolution >= wWidth) {
					$self.css('height',screen_mobile_spacer_size);
				}
			});
			$('body').trigger('reinit-waypoint');
		};
		initSpacer();
		dfd_native.window.on('load resize', initSpacer);
	};
	
	dfd_native.initFixedFooter = function() {
		var dfdFixedFooter = function() {
			if(!$('#layout').hasClass('one-page-scroll') && $('#main-wrap').hasClass('dfd-parallax-footer')) {
				if($('body > .boxed_layout').length == 0) {
					$('body').addClass('dfd-parallax-footer');
				}
				var margin =  ((dfd_native.windowWidth) > 799) ? $('#footer-wrap').outerHeight(true) : 0;
				if($('body > .boxed_layout').length > 0) {
					$('body > .boxed_layout').css('margin-bottom', margin);
				} else {
					$('#main-wrap').css('margin-bottom', margin);
				}
			}
		};
		dfd_native.document.ready(function() {
			dfdFixedFooter();
			dfd_native.window.on('load resize', dfdFixedFooter);
		});
	};
	
	dfd_native.onePageMenuNavigation = function() {
		dfd_native.document.ready(function() {
			var $window = $(window);
			var $link = $('a.menu-link');
			$link.each(function() {
				var $self = $(this);
				var href = $self.attr('href');
				if(href && href.indexOf('#') !== -1 && href != '#' && href.indexOf('#/') === -1) {
					href = href.substring(href.indexOf("#"));
					if($(href).length > 0) {
						var highlightCurrent = function() {
							var targetOffset = Math.floor($(href).offset().top);
							if((dfd_native.windowScrollTop + $('body').offset().top) >= targetOffset) {
								$self.parent().addClass('current-menu-ancestor current-menu-item').siblings().removeClass('current-menu-ancestor current-menu-item');
							}
						};
						highlightCurrent();
						$window.on('load resize scroll', highlightCurrent);
						$self.on('click touchend', function(e) {
							e.preventDefault();
							$window.scrollTo(href, {duration:'slow'});
							highlightCurrent();
						});
					}
				}
			});
		});
	};
	
	dfd_native.initVideoBg = function() {
		$('.dfd-video-bg video, .dfd-video-bg .dfd-bg-frame').each(function() {
			var $self = $(this),
				ratio = 1.778,
				pWidth,
				pHeight,
				selfWidth,
				selfHeight;
			var setSizes = function() {
				pWidth = $self.parents('.vc-row-wrapper.wpb_row').length > 0 ? $self.parents('.vc-row-wrapper.wpb_row').width() : $self.parent().width();
				pHeight = $self.parents('.vc-row-wrapper.wpb_row').length > 0 ? $self.parents('.vc-row-wrapper.wpb_row').height() : $self.parent('').height();
				if(pWidth / ratio < pHeight) {
					selfWidth = Math.ceil(pHeight * ratio);
					selfHeight = pHeight;
					$self.css({
						'width': selfWidth,
						'height': selfHeight
					});
				} else {
					selfWidth = pWidth;
					selfHeight = Math.ceil(pWidth / ratio);
					$self.css({
						'width': selfWidth,
						'height': selfHeight
					});
				}
			};
			$self.parents('.dfd-video-bg').siblings('.dfd-video-controller').unbind('click').on('click', function(e) {
				e.preventDefault();
				var $button = $(this);
				if($button.hasClass('dfd-socicon-ic_pause_48px')) {
					$self.get(0).pause();
					$button.removeClass('dfd-socicon-ic_pause_48px').addClass('dfd-socicon-icon-play');
				} else {
					$self.get(0).play();
					$button.removeClass('dfd-socicon-icon-play').addClass('dfd-socicon-ic_pause_48px');
				}
			});
			$self.parents('.dfd-video-bg').siblings('.dfd-sound-controller').unbind('click').on('click', function(e) {
				e.preventDefault();
				var $button = $(this);
				if($button.hasClass('dfd-socicon-unmute')) {
					$self.prop('muted',false);
					$button.removeClass('dfd-socicon-unmute').addClass('dfd-socicon-mute');
				} else {
					$self.prop('muted',true);
					$button.removeClass('dfd-socicon-mute').addClass('dfd-socicon-unmute');
				}
			});
			setSizes();
			dfd_native.window.on('load resize', function() {
				setSizes();
			});
			$('body').on('post-load', setSizes);
			dfd_native.window.on('load', function() {
				if($self.is('video') && $self.get(0).paused) {
					$self.get(0).play();
				}
			});
		});
		if($('.dfd-youtube-bg').length > 0) {
			var tag = document.createElement('script');

			tag.src = "//www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

			var players = {};

			window.onYouTubeIframeAPIReady = function() {
				$('.dfd-youtube-bg iframe').each(function() {
					var $self = $(this),
						id = $self.attr('id');

					if($self.data('muted') && $self.data('muted') == '1') {
						players[id] = new YT.Player(id, {
							events: {
								"onReady": onPlayerReady
							}
						});
					} else {
						players[id] = new YT.Player(id, {
							events: {
								"onReady": onPlayerReadyLoud
							}
						});
					}
				});
			};
		}
		function onPlayerReady(e) {
			e.target.mute();
			e.target.playVideo();
		}
		function onPlayerReadyLoud(e) {
			e.target.playVideo();
		}
		if($('.dfd-vimeo-bg').length > 0) {
			dfd_native.document.ready(function() {
				$('.dfd-vimeo-bg iframe').each(function() {
					var $self = $(this);

					if (window.addEventListener) {
						window.addEventListener('message', onMessageReceived, false);
					} else {
						window.attachEvent('onmessage', onMessageReceived, false);
					}

					function onMessageReceived(e) {
						var data = JSON.parse(e.data);

						switch (data.event) {
							case 'ready':
								$self[0].contentWindow.postMessage('{"method":"play", "value":1}','*');
								if($self.data('muted') && $self.data('muted') == '1') {
									$self[0].contentWindow.postMessage('{"method":"setVolume", "value":0}','*');
								}
								break;
						}
					}
				});
			});
		}
	};
	
	dfd_native.initMousemoveParallax = function() {
		dfd_native.document.ready(function() {
			$('.dfd-row-bg-wrap.dfd-row-bg-image.dfd_mousemove_parallax').each(function() {
				var $self = $(this),
					mobileEnabled = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false;

				if(!mobileEnabled && Modernizr.touch && dfd_native.windowWidth < 800) {
					return;
				}

				$('.dfd-interactive-parallax-item', $self).parallax({mouseport: $self.parents('.vc-row-wrapper')});
			});
		});
	};
	
	dfd_native.initAnimatedBg = function() {
		dfd_native.document.ready(function() {
			$('.dfd-row-bg-image.dfd_animated_bg').each(function() {
				var $self = $(this),
					dir = $self.data('direction'),
					speed = 100 - $self.data('parallax_sense'),
					coords = 0,
					mobileEnabled = ($self.data('mobile_enable') && $self.data('mobile_enable') == '1') ? true : false,
					width = $self.parent().outerWidth(),
					height = $self.parent().outerHeight();
					
				if(!mobileEnabled && Modernizr.touch && dfd_native.windowWidth < 800) {
					return;
				}

				var actualImage = new Image();
				actualImage.src = $self.css('backgroundImage').replace(/"/g,'').replace(/url\(|\)$/ig, '');

				actualImage.onload = function() {
					if(dir == 'left' || dir == 'right') {
						$self.css('width', actualImage.width + width);
					} else if(dir == 'top' || dir == 'bottom') {
						$self.css('height', actualImage.height + height);
					}

					window.requestAnimationFrame(function() {
						setInterval(function() {
							if(dir == 'left' || dir == 'bottom') {
								coords -= 1;
							} else {
								coords += 1;
							}

							if(
								(coords < -actualImage.width && dir == 'left') || 
								(coords < -actualImage.height && dir == 'bottom')
							) {
								coords = 0;
							}

							if( (coords > 0 && dir == 'right') ) {
								coords = -actualImage.width;
							}

							if( (coords > 0 && dir == 'top') ) {
								coords = -actualImage.height;
							}
							if(dir == 'left' || dir == 'right') {
								$self.css({
									'-webkit-transform': 'translate3d('+coords +'px, 0, 0)',
									'-moz-transform': 'translate3d('+coords +'px, 0, 0)',
									'-o-transform': 'translate3d('+coords +'px, 0, 0)',
									'-ms-transform': 'translate3d('+coords +'px, 0, 0)',
									'transform': 'translate3d('+coords +'px, 0, 0)'
								});
							} else {
								$self.css({
									'-webkit-transform': 'translate3d(0, '+ coords + 'px, 0)',
									'-moz-transform': 'translate3d(0, '+ coords + 'px, 0)',
									'-o-transform': 'translate3d(0, '+ coords + 'px, 0)',
									'-ms-transform': 'translate3d(0, '+ coords + 'px, 0)',
									'transform': 'translate3d(0, '+ coords + 'px, 0)'
								});
							}
						}, speed);
					});
				};
			});
		});
	};
	
	dfd_native.initCanvasBg = function() {
		var init = function() {
			
			$('.dfd-row-bg-canvas').each(function(){
				var $self = $(this);
//				if($self.data('mobile-disable') && $self.data('mobile-disable') == 'on' && dfd_native.windowWidth < 1100) {
				if(dfd_native.windowWidth < 1100) {
					return false;
				}
				var canvas_id = $self.data('canvas-id');
				var canvas_style = $self.data('canvas-style');
				var canvas_color = $self.data('canvas-color');
				var apply_to = $self.data('canvas-size');

				if(canvas_color == '') {
					canvas_color = '#ffffff';
				}

				if(canvas_style == 'style_1') {
					$self.append('<canvas id="canvas-'+ canvas_id +'" />');
				}

				var width, height, largeHeader, canvas, ctx, points, target, animateHeader = true;
				var wrapper = (apply_to != 'window') ? $('#'+canvas_id).parents('.vc-row-wrapper') : $(window);

				if(canvas_style == 'style_1') {
					(function() {
						initHeader('canvas-'+canvas_id);
						initAnimation();
						addListeners();
						function initHeader(id) {
							width = wrapper.width();
							height = wrapper.height();
							target = {x: width/2, y: height/2};

							largeHeader = document.getElementById(id);
							largeHeader.style.height = height+'px';

							canvas = document.getElementById(id);
							canvas.width = width;
							canvas.height = height;
							ctx = canvas.getContext('2d');

							// create points
							points = [];
							for(var x = 0; x < width; x = x + width/20) {
								for(var y = 0; y < height; y = y + height/20) {
									var px = x + Math.random()*width/20;
									var py = y + Math.random()*height/20;
									var p = {x: px, originX: px, y: py, originY: py };
									points.push(p);
								}
							}

							// for each point find the 5 closest points
							for(var i = 0; i < points.length; i++) {
								var closest = [];
								var p1 = points[i];
								for(var j = 0; j < points.length; j++) {
									var p2 = points[j]
									if(!(p1 == p2)) {
										var placed = false;
										for(var k = 0; k < 5; k++) {
											if(!placed) {
												if(closest[k] == undefined) {
													closest[k] = p2;
													placed = true;
												}
											}
										}

										for(var k = 0; k < 5; k++) {
											if(!placed) {
												if(getDistance(p1, p2) < getDistance(p1, closest[k])) {
													closest[k] = p2;	
													placed = true;
												}
											}
										}
									}
								}
								p1.closest = closest;
							}

							// assign a circle to each point
							for(var i in points) {
								var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
								points[i].circle = c;
							}
						}

						// Event handling
						function addListeners() {
							if(!('ontouchstart' in window)) {
								window.addEventListener('mousemove', mouseMove);
							}
							window.addEventListener('resize', resize);
						}

						function mouseMove(e) {
							var posx = 0;
							var posy = 0;
							var offset_left = $('#'+canvas_id).offset().left;
							var offset_top = $('#'+canvas_id).offset().top;
							if (e.pageX || e.pageY) {
								posx = e.pageX;
								posy = e.pageY;
							} else if (e.clientX || e.clientY)    {
								posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
								posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
							}
							target.x = posx - offset_left;
							target.y = posy - offset_top;
						}

						function resize() {
							width = wrapper.width();
							height = wrapper.height();
							largeHeader.style.height = height+'px';
							canvas.width = width;
							canvas.height = height;
						}

						// animation
						function initAnimation() {
							animate();
							for(var i in points) {
								shiftPoint(points[i]);
							}
						}

						function animate() {
							if(animateHeader) {
								ctx.clearRect(0,0,width,height);
								for(var i in points) {
									// detect points in range
									if(Math.abs(getDistance(target, points[i])) < 4000) {
										points[i].active = 0.3;
										points[i].circle.active = 0.6;
									} else if(Math.abs(getDistance(target, points[i])) < 20000) {
										points[i].active = 0.1;
										points[i].circle.active = 0.3;
									} else if(Math.abs(getDistance(target, points[i])) < 40000) {
										points[i].active = 0.02;
										points[i].circle.active = 0.1;
									} else {
										points[i].active = 0;
										points[i].circle.active = 0;
									}

									drawLines(points[i]);
									points[i].circle.draw();
								}
							}
							requestAnimationFrame(animate);
						}

						function shiftPoint(p) {
							TweenLite.to(p, 1+1*Math.random(), {
								x:p.originX-50+Math.random()*100,
								y: p.originY-50+Math.random()*100,
								ease:Circ.easeInOut,
								onComplete: function() {
									shiftPoint(p);
								}
							});
						}

						// Canvas manipulation
						function drawLines(p) {
							if(!p.active) {
								return;
							}
							for(var i in p.closest) {
								ctx.beginPath();
								ctx.moveTo(p.x, p.y);
								ctx.lineTo(p.closest[i].x, p.closest[i].y);
								ctx.strokeStyle = 'rgba(255,255,255,'+ p.active+')';
								ctx.stroke();
							}
						}

						function Circle(pos,rad,color) {
							var _this = this;

							// constructor
							(function() {
								_this.pos = pos || null;
								_this.radius = rad || null;
								_this.color = color || null;
							})();

							this.draw = function() {
								if(!_this.active) {
									return;
								}
								ctx.beginPath();
								ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
								ctx.fillStyle = 'rgba(255,255,255,'+ _this.active+')';
								ctx.fill();
							};
						}

						// Util
						function getDistance(p1, p2) {
							return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
						}
					})();
				} else if(canvas_style == 'style_2') {
					$('#'+canvas_id).particleground({
						dotColor: canvas_color,
						lineColor: canvas_color
					});
				} else if(canvas_style == 'style_3') {
					(function() {
						var mouseX = 0, mouseY = 0,

						windowHalfX = window.innerWidth / 2,
						windowHalfY = window.innerHeight / 2,

						SEPARATION = 200,
						AMOUNTX = 1,
						AMOUNTY = 1,

						camera, scene, renderer;

						init();
						animate();

						function init() {
							var container, separation = 1000, amountX = 50, amountY = 50, color = 0xffffff,
							particles, particle;
							container = document.getElementById(canvas_id);
							camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
							camera.position.z = 100;
							scene = new THREE.Scene();
							renderer = new THREE.CanvasRenderer({ alpha: true });
							renderer.setPixelRatio( window.devicePixelRatio );
							renderer.setClearColor( 0x000000, 0 );   // canvas background color
							renderer.setSize( wrapper.width(), wrapper.height() );
							container.appendChild( renderer.domElement );

							var PI2 = Math.PI * 2;
							var material = new THREE.SpriteCanvasMaterial( {
								color: color,
								opacity: 0.5,
								program: function ( context ) {
									context.beginPath();
									context.arc( 0, 0, 0.5, 0, PI2, true );
									context.fill();
								}
							} );
							var geometry = new THREE.Geometry();
							/*
							 *   Number of particles
							 */
							for ( var i = 0; i < 150; i ++ ) {

								particle = new THREE.Sprite( material );
								particle.position.x = Math.random() * 2 - 1;
								particle.position.y = Math.random() * 2 - 1;
								particle.position.z = Math.random() * 2 - 1;
								particle.position.normalize();
								particle.position.multiplyScalar( Math.random() * 10 + 600 );
								particle.scale.x = particle.scale.y = 5;
								scene.add( particle );
								geometry.vertices.push( particle.position );
							}
							/*
							 *   Lines
							 */
							var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: color, opacity: 0.2 } ) );
							scene.add( line );
							document.addEventListener( 'mousemove', onDocumentMouseMove, false );
							document.addEventListener( 'touchstart', onDocumentTouchStart, false );
							window.addEventListener( 'resize', onWindowResize, false );

						}

						function onWindowResize() {
							windowHalfX = wrapper.width() / 2;
							windowHalfY = wrapper.height() / 2;
							camera.aspect = wrapper.width() / wrapper.height();
							camera.updateProjectionMatrix();
							renderer.setSize( wrapper.width(), wrapper.height() );
						}

						function onDocumentMouseMove(event) {
							mouseX = (event.clientX - windowHalfX) * 0.05;
							mouseY = (event.clientY - windowHalfY) * 0.2;
						}

						function onDocumentTouchStart( event ) {

							if ( event.touches.length > 1 ) {

								event.preventDefault();

								mouseX = (event.touches[ 0 ].pageX - windowHalfX) * 0.7;
								mouseY = (event.touches[ 0 ].pageY - windowHalfY) * 0.7;

							}

						}

						function onDocumentTouchMove( event ) {

							if ( event.touches.length == 1 ) {

								event.preventDefault();

								mouseX = event.touches[ 0 ].pageX - windowHalfX;
								mouseY = event.touches[ 0 ].pageY - windowHalfY;

							}

						}

						function animate() {

							requestAnimationFrame( animate );

							render();

						}

						function render() {

							camera.position.x += ( mouseX - camera.position.x ) * 0.1;
							camera.position.y += ( - mouseY + 200 - camera.position.y ) * 0.05;
							camera.lookAt( scene.position );

							renderer.render( scene, camera );

						}
					})();

				} else if(canvas_style == 'style_4') {
					$('#'+canvas_id).particlegroundOld({
						dotColor: canvas_color,
						lineColor: canvas_color
					});
				}
			});
		};
		dfd_native.window.on('load', function() {
			setTimeout(function() {
				init();
			}, 500);
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initCarousel = function() {
		var initCarousel = function() {
			$('.dfd-carousel-wrap').each(function() {
				var $self = $(this),
					slides = $self.data('slides') ? $self.data('slides') : 1,
					scroll = $self.data('scroll') ? $self.data('scroll') : 1,
					autoplay = $self.data('autoplay') ? $self.data('autoplay') : 0,
					dots = $self.data('dots') ? $self.data('dots') : 1,
					speed = $self.data('speed') ? $self.data('speed') : 2000,
					infinite = $self.data('infinite') ? $self.data('infinite') : 0,
					centerMode = $self.data('center-mode') ? $self.data('center-mode') : 0,
					varwidth = $self.data('varwidth') ? $self.data('varwidth') : false,
					initialSlide = centerMode !== 0 ? 1 : 0,
					responsive_point_one = (slides > 3) ? 3 : slides,
					responsive_point_two = (slides > 2) ? 2 : slides,
					responsive_point_three = 1;
					
				if($self.parent().hasClass('dfd-related-posts-wrap')) {
					var selfWidth = $self.width();
					if(selfWidth < 451) {
						slides = 1;
					} else if(selfWidth > 450 && selfWidth < 900) {
						slides = 2;
					}
				}
				
				if(!$self.hasClass('carousel-inited')) {
					$self.addClass('carousel-inited');
					$self.slick({
						infinite: infinite,
						slidesToShow: slides,
						slidesToScroll: scroll,
						arrows: false,
						autoplay: autoplay,
						autoplaySpeed: speed,
						vertical: false,
						centerMode: centerMode,
						focusOnSelect: true,
						initialSlide: initialSlide,
						variableWidth: varwidth,
						dots: dots,
						dotsClass: 'dfd-slick-dots',
						customPaging: function(slider, i) {
							return '<span data-role="none" role="button" aria-required="false" tabindex="0"></span>';
						},
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: responsive_point_one,
									slidesToScroll: 1,
									infinite: true,
									arrows: false,
									dots: false,
									vertical: false
								}
							},
							{
								breakpoint: 800,
								settings: {
									slidesToShow: responsive_point_two,
									slidesToScroll: 1,
									infinite: true,
									arrows: false,
									dots: false,
									vertical: false
								}
							},
							{
								breakpoint: 500,
								settings: {
									slidesToShow: responsive_point_three,
									slidesToScroll: 1,
									arrows: false,
									dots: false,
									vertical: false
								}
							}
						]
					});
				}
			});
		};
		
		$(document).ready(initCarousel);
		
		$('body').on('post-load', initCarousel);
		
		$('body').on('tabs-reinited', function() {
			setTimeout(function() {
				$('body').trigger('post-load');
				initCarousel();
			},800);
		});
	};
	dfd_native.initPanr = function() {
		var initPanr = function() {
			$('.dfd-portfolio.panr .entry-thumb, .dfd-gallery.panr .entry-thumb, .dfd-portfolio_archive.panr .entry-thumb, .dfd-gallery_archive.panr .entry-thumb, .dfd-single-image-module.panr, .dfd-info-banner.panr, .dfd-woo-single-category.panr .entry-thumb, .dfd-simple-advertisement.panr .image-wrap').each(function() {
				var $work = $(this),
					$img = $('img', $work),
					scaleLimit = 1.05;
					
				if($work.hasClass('dfd-single-image-module')) {
					scaleLimit = 1.15;
				}
				
				$img.panr({
					moveTarget: $work,
					sensitivity: 18,
					scale: false,
					scaleOnHover: true,
					scaleTo: scaleLimit,
					scaleDuration: .8,
					panDuration: 3,
					resetPanOnMouseLeave: false,
				});
			});
		};
		
		$(document).ready(function() {
			initPanr();
		});
		
		$('body').on('post-load',initPanr);
		
		$('body').on('post-load swiper-loaded', function() {
			$('.dfd-portfolio-module.layout-fullscreen .dfd-portfolio .cover.panr').each(function() {
				var $self = $(this),
					$img = $('img', $self);
				
				$img.panr({
					moveTarget: $self,
					sensitivity: 25,
					scale: false,
					scaleOnHover: true,
					scaleTo: 1.06,
					scaleDuration: 1,
					panDuration: 5,
					resetPanOnMouseLeave: false,
				});
			});
		});
	};
	dfd_native.initJustifiedGrid = function() {
		var init = function() {
			$(".layout-justified").each(function() {
				var $self = $(this),
					offset = 0;

				$self.justifiedGallery({
					rowHeight: 350,
					thumbnailPath: '> article .enrty-thumb > a.dfd-image-link',
					margins: offset,
					maxRowHeight: 800,
					selector: '> article'
				});
				$(window).trigger('resize');
			});
		};
		dfd_native.window.load(function() {
			init();
		});
		$('body').on('post-load', function() {
			setTimeout(function() {
				init();
			},300);
		});
	};
	
	dfd_native.init3dHover = function() {
		var init = function() {
			$("article.dfd-3d-parallax").hover3d({
				selector		: ".cover",
				shine			: false,
				perspective     : 2000,
				invert			: true
			});
			$(".dfd-simple-advertisement.dfd-3d-parallax").hover3d({
				selector		: ".cover",
				shine			: false,
				perspective     : 3000,
				invert			: true
			});
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.sideImagePosts = function() {
		var init = function() {
			$('.dfd-content-wrap.layout-side-image').find('> article').each(function() {
				var $self = $(this);
				if(!$self.hasClass('inited') && $self.find('.entry-thumb').next().length > 0) {
					$self.addClass('inited').find('.entry-thumb').next().siblings(':not(.entry-thumb)').andSelf().wrapAll('<div class="content-wrap" />');
				}
			});
		};
		
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	dfd_native.initButtonClick = function() {
		var init = function() {
			if($('.dfd-button-click-animated').length > 0) {
				var tl = new TimelineMax();
				if(!$("#dfd-button-svg-sprite").length) {
					$("body").append("<div id=\"dfd-button-svg-sprite\" style=\"height: 0; width: 0; position: absolute; visibility: hidden; overflow: hidden;\" aria-hidden=\"true\">\n\
										<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" focusable=\"false\">\n\
											<symbol id=\"ripply-scott\" viewBox=\"0 0 100 100\"><circle id=\"ripple-shape\" cx=\"1\" cy=\"1\" r=\"1\" /></symbol>\n\
										</svg>\n\
									</div>");
				}
				$('.dfd-button-click-animated .dfd-button-link, .dfd-button-click-animated').each(function() {
					var $self = $(this);
					if(!$('.dfd-button-inner-cover, .dfd-click-anim-button', $self).find('.dfd-button-svg-wrap').length) {
						$('.dfd-button-inner-cover, .dfd-click-anim-button', $self).append('<span class="dfd-button-svg-wrap">\n\
														<svg class="ripple-obj">\n\
															<use height="100" width="100" xlink:href="#ripply-scott" class="js-ripple"></use>\n\
														</svg>\n\
													</span>');
					}
					var $ripple = $self.find('.js-ripple');
						
					$self.click(function(e) {
						
						var x            = e.offsetX,
							y            = e.offsetY,
							w            = e.target.offsetWidth,
							h            = e.target.offsetHeight,
							offsetX      = Math.abs( (w / 2) - x ),
							offsetY      = Math.abs( (h / 2) - y ),
							deltaX       = (w / 2) + offsetX,
							deltaY       = (h / 2) + offsetY,
							scale_ratio  = Math.sqrt(Math.pow(deltaX, 2) + Math.pow(deltaY, 2));;
						
						tl.fromTo($ripple, .75, {
							x: x,
							y: y,
							transformOrigin: '50% 50%',
							scale: 0,
							opacity: 1,
							ease: Linear.easeIn
						},{
							scale: scale_ratio,
							opacity: 0
						});
					});
				});
			}
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initPieCharts = function() {
		var init = function() {
			$('.dfd-piecharts').each(function () {
				var $current_chart = $(this);
				$current_chart.on('on-waypoin', function () {
					if (!$current_chart.hasClass('animated')) {
						var $animation = {duration: 1700};
						var count_html = $current_chart.find('.piecharts-number');
						if ($current_chart.hasClass('circle-off-animation')){
							$animation = {duration: 0};
						}
						if ( false == $animation ){
							count_html.html(count_html.data('max') +  '<span>'+count_html.data('units')+'</span>');
							$current_chart.addClass('animated');
						}
						$current_chart.circleProgress({
								startAngle: -Math.PI / 4 * 2,
								emptyFill: $current_chart.data('emptyfill'),
								animation: $animation
							}
						).on('circle-animation-progress', function (event, progress) {
							count_html.html(parseInt((count_html.data('max')) * progress) + '<span>'+count_html.data('units')+'</span>'
							);
						}).on('circle-animation-end', function (event) {
							$current_chart.addClass('animated');
						});
					}
				});
			});
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initFrontContent = function() {
		var postElementsControl = function() {
			$('.dfd-posts-module.content-full_front, .dfd-posts-module.content-full_front.layout-carousel .slick-track, .dfd-content-wrap.dfd-portfolio.content-front, .dfd-content-wrap.dfd-portfolio_archive.content-front, .dfd-content-wrap.dfd-gallery.content-front, .dfd-content-wrap.dfd-gallery_archive.content-front, .dfd-portfolio-module.content-front, .dfd-gallery-module.content-front').find('article').each(function() {
				if(!$(this).hasClass('front-inited')) {
					$(this).addClass('front-inited');
					if($(this).find('.entry-thumb').next().length > 0) {
						$(this).find('.entry-thumb').next().siblings(':not(.entry-thumb)').andSelf().wrapAll('<div class="content-wrap" />');
					}
				}
			});
			$('.plus-link.dfd-cursor-plus').each(function() {
				if($(this).parents('article').find('.dfd-main-hover-link').length) {
					$(this).parents('article').find('.dfd-main-hover-link').addClass('dfd-cursor-plus');
				}
			});
		};
		dfd_native.document.ready(function() {
			postElementsControl();
		});
		$('body').on('post-load', postElementsControl);
		$('.dfd-posts-module.content-full_front.layout-carousel').on('init reInit', postElementsControl);
	};
	
	dfd_native.initProgressBar = function() {
		var init = function() {
			$('.dfd-progressbar').each(function () {
				var $current = $(this);
				if(!$current.hasClass('progress-inited')) {
					$current.addClass('progress-inited')
					$current.waypoint(function () {
						var bar = $current.find('.meter'),
							val = bar.data('percentage-value'),
							$text = $current.find('.title-wrap');

						setTimeout(function () {
							bar.css({"width": val + '%'});
						}, 100);

						setTimeout(function() {
							$text.addClass('active');
						},1100);
					}, {offset: '85%'});
				}
			});
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	dfd_native.initFactsShortcode = function() {
		var init = function() {
			$('.facts-number').each(function () {
				var $self =  $(this);
				if(!$self.hasClass('facts-inited')) {
					var $anim = $self.data('animation');
					if(!$self.hasClass('disable-animation')) {
						if ('count' == $anim){
							var odometer = new Odometer({el: $self[0], animation: 'count' });
						} else {
							var odometer = new Odometer({el: $self[0]});
						}

						$(this).on('on-waypoin', function () {
							odometer.update($(this).data('max'));
						});
					}
				}
			});
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initAnimatedHeadingShortcode = function() {
		var init = function() {
			$('.dfd-animate-heading-wrap').each(function() {
				var $self = $(this);
				$self.on('on-waypoin',function() {
					if(!$self.hasClass('heading-animate')) {
						$self.addClass('heading-animate');
					}
				});
			});
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initPortfolioGalleryAdvanced = function() {
		var init = function() {
			$('.dfd-portfolio-module.dfd-portfolio-advanced, .dfd-gallery-module.dfd-gallery-advanced').each(function() {
				var $self = $(this);
				if(($self.hasClass('layout-carousel_centered') || $self.hasClass('layout-carousel_skewed_centered'))) {
					$self.find('.thumb-wrap').css('width', $self.find('.thumb-wrap > img').width());
					if(!$self.find('.article-wrap.active').length) {
						$self.find('.article-wrap').first().addClass('active');
					}
					$self.find('.article-wrap .entry-thumb').mousestop(function(e) {
						$(this).parents('.article-wrap').addClass('active').siblings().removeClass('active');
					});
				}
			});
		};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	dfd_native.wishlistAjaxCounter = function() {
		dfd_native.document.ready( function($){
			var update_wishlist_count = function() {
				$.ajax({
					beforeSend: function () {

					},
					complete  : function () {
						
					},
					data      : {
						action: 'dfd_update_wishlist_count'
					},
					success   : function (data) {
						var reg = new RegExp('^[0-9]+$');
						if(reg.test(data) && $('#header-container').find('.header-wishlist-button .wishlist-details').length > 0) {
							$('#header-container').find('.header-wishlist-button .wishlist-details').text(data);
						}
					},

					url: yith_wcwl_l10n.ajax_url
				});
			};

			$('body').on( 'added_to_wishlist removed_from_wishlist', update_wishlist_count );
		} );
	};
	
	dfd_native.addHeaderDynamicStyles = function() {
		var css = '',
			init = function() {
				$('.dfd-dynamic-styles-container').each(function() {
					css += $(this).text();
					$(this).remove();
				});
				$('head').append('<style>'+css+'</style>');
			};
		dfd_native.document.ready(function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initPortfolioSingleCarousel = function() {
		$(document).ready(function() {
			var $mainCarousel = $('#portfolio-main-carousel');
			$mainCarousel.on('init reInit afterChange', function (event, slick, currentSlide) {
				var prev_slide_index, next_slide_index, current;
				var $prev_counter = $mainCarousel.next('.slider-controls').find('.prev .count');
				var $next_counter = $mainCarousel.next('.slider-controls').find('.next .count');
				var total_slides = slick.slideCount;
				current = (currentSlide ? currentSlide : 0) + 1;
				prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
				next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
				$prev_counter.text(prev_slide_index + '/' + total_slides);
				$next_counter.text(next_slide_index + '/'+ total_slides);
			});
			$mainCarousel.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				speed: 600,
				arrows: false,
				asNavFor: '#portfolio-thumbs-carousel',
				autoplay: true,
				autoplaySpeed: 7000,
				dots: false,
				adaptiveHeight: true
			});
			$('#portfolio-thumbs-carousel').slick({
				infinite: true,
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '#portfolio-main-carousel',
				speed: 600,
				arrows: false,
				focusOnSelect: true,
				dots: false,
				responsive: [
				{
					breakpoint: 1280,
					settings: {
						slidesToShow: 4,
						infinite: true,
						arrows: false,
						dots: false
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						infinite: true,
						arrows: false,
						dots: false
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						arrows: false,
						dots: false
					}
				}
			]
			});
			$mainCarousel.siblings('.slider-controls').find('.prev').click(function(e) {
				e.preventDefault();
				$mainCarousel.eq(0).slick('slickPrev');
			});
			$mainCarousel.siblings('.slider-controls').find('.next').click(function(e) {
				e.preventDefault();
				$mainCarousel.eq(0).slick('slickNext');
			});
		});
	};
	
	dfd_native.initGallerySingleCarousel = function() {
		$(document).ready(function() {
			var $mainCarousel = $('#gallery-main-carousel');
			$mainCarousel.on('init reInit afterChange', function (event, slick, currentSlide) {
				var prev_slide_index, next_slide_index, current;
				var $prev_counter = $mainCarousel.next('.slider-controls').find('.prev .count');
				var $next_counter = $mainCarousel.next('.slider-controls').find('.next .count');
				var total_slides = slick.slideCount;
				current = (currentSlide ? currentSlide : 0) + 1;
				prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
				next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
				$prev_counter.text(prev_slide_index + '/' + total_slides);
				$next_counter.text(next_slide_index + '/'+ total_slides);
			});
			$('#gallery-main-carousel').slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				speed: 600,
				arrows: false,
				asNavFor: '#gallery-thumbs-carousel',
				autoplay: true,
				autoplaySpeed: 7000,
				dots: false,
				adaptiveHeight: true
			});
			$('#gallery-thumbs-carousel').slick({
				infinite: true,
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: '#gallery-main-carousel',
				speed: 600,
				arrows: false,
				focusOnSelect: true,
				dots: false,
				responsive: [
				{
					breakpoint: 1280,
					settings: {
						slidesToShow: 4,
						infinite: true,
						arrows: false,
						dots: false
					}
				},
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						infinite: true,
						arrows: false,
						dots: false
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						arrows: false,
						dots: false
					}
				}
			]
			});
			$mainCarousel.siblings('.slider-controls').find('.prev').click(function(e) {
				e.preventDefault();
				$mainCarousel.eq(0).slick('slickPrev');
			});
			$mainCarousel.siblings('.slider-controls').find('.next').click(function(e) {
				e.preventDefault();
				$mainCarousel.eq(0).slick('slickNext');
			});
		});
	};
	
	dfd_native.initDfdTabModule = function() {
		var init = function() {
			$('.dfd_tabs_block').each(function() {
				var tabContainer = $(this).find('.dfd_tta_tabs'),
					activeTab = tabContainer.find('.vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active');
					
				if(dfd_native.windowWidth > 767) {
					activeTab.parent().css({'height': activeTab.find('.vc_tta-panel-body').height()});
				} else {
					activeTab.parent().css({'height': 'auto'});
				}
			});
		};
		$('body').on('click','.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-list a',function() {
			var selector = $(this).data('vc-target'),
				$container = $(selector),
				$panel = $container.find('.vc_tta-panel-body');

			$container.parent().css({'height': $panel.height()});
		});
			
		dfd_native.window.on('load resize', function() {
			init();
		});
		$('body').on('post-load', init);
	};
	dfd_native.initDfdTourModule = function() {
		var init = function() {
			$('.dfd_tabs_block').each(function() {
				var tabContainer = $(this).find('.dfd_tta_tour'),
					activeTab = tabContainer.find('.vc_tta-panels-container .vc_tta-panels .vc_tta-panel.vc_active');
					
				if(dfd_native.windowWidth > 767) {
					activeTab.parent().css({'height': activeTab.find('.vc_tta-panel-body').height()});
				} else {
					activeTab.parent().css({'height': 'auto'});
				}
			});
		};
		$('body').on('click', '.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-list a, .dfd_tabs_block .dfd_tta_tour .vc_pagination li a',function() {
			var selector = $(this).data('vc-target');
			
			setTimeout(function() {
				var $container = $(selector),
					$panel = $container.find('.vc_tta-panel-body');

				$container.parent().css({'height': $panel.height()});
			}, 300);
		});
			
		dfd_native.window.on('load resize', function() {
			init();
		});
		$('body').on('post-load', init);
	};
	
	dfd_native.initWidgetsScripts = function() {
		/* Tags */
		$('.widget_dfd_tags .read-more-section a').click(function(e) {
			e.preventDefault();

			var $self = $(this),
				$wrapper = $self.parents('.widget_dfd_tags'),
				$tagsContainer = $wrapper.find('.tags-widget');

			if($wrapper.find('.dfd-all-tags-content').length > 0) {
				$tagsContainer.fadeOut('slow', function() {
					$tagsContainer.html($wrapper.find('.dfd-all-tags-content').html()).fadeIn('slow');
					$self.parents('.read-more-section').remove();
					$wrapper.find('.dfd-all-tags-content').remove();
				});
			}
		});
	};
	dfd_native.header_builder = function(){
		var checkWidthCart = function(){
	
			var obj = $(".total_cart_header");
			if(obj.length == 0 || !$('#header-container').hasClass('dfd-header-builder')){
				return false;
			}
			var cart_obj = obj.find(".shopping-cart-box");
			var padding = 60;
			var body_width = $("body").width();

			var left = obj.offset().left;
			var obj_width = obj.width();

			var cart_modal_width = cart_obj.width();

			var obj_full_width = left + obj_width;
			

			
			if((left - cart_modal_width) <= 0 ){
				cart_obj.css({
					"right": -(cart_modal_width)
				});
			}
			return false;
		};
		var chekWidth = function(){
			var obj = $(".el.login");
			if(obj.length == 0){
				return false;
			}
			var login_obj = $("#loginModal");
			var forgot_Pass_obj = $("#dfd-lost-password");
			var padding = 60;
			var body_width = $("body").width();

			var left = obj.offset().left;
			var obj_width = obj.width();

			var login_modal_width = login_obj.width();

			var obj_full_width = left + obj_width;

			if((obj_full_width + login_modal_width) >= body_width){
				login_obj.css({
					"left": -(login_modal_width - padding)
				});
				forgot_Pass_obj.css({
					"left": -(login_modal_width - padding)
				});
			}
			return false;
		};
		var checkHeight = function(){
			var obj = $(".el.login");
			if(obj.length == 0){
				return false;
			}
			var login_obj = $("#loginModal");
			var forgot_Pass_obj = $("#dfd-lost-password");
			var p = login_obj.parents(".header-top-panel,.header-mid-panel,.header-bottom-panel").css("z-index","10");
			var padding = 88;
			var body_height = $( window ).height();
			var offset = obj.offset();
			var obj_width = obj.width();
			var obj_height = obj.height();

			var login_modal_width = login_obj.width();
			var login_modal_height = login_obj.height();
			if ((offset.top + obj_height + login_modal_height) > body_height){
				login_obj.css({
					"margin-top": -(login_modal_height + padding)
				});
				forgot_Pass_obj.css({
					"margin-top": -(login_modal_height + padding)
				});
			}
		};
		chekWidth();
		checkHeight();
		setTimeout(function(){
			checkWidthCart();	
		},200);
		
	}
	dfd_native.initVcShortcodesScripts = function() {
		var initShortcodes = function() {
				initAnimatedText();
				initAnnouncement();
				initButtonModule();
				initImageCarousel();
				initClientLogo();
				initCountdown();
				initGradation();
				initImageLayersModule();
				initShareModule();
				initTiltedPresentation();
				initPriceList();
				initRotateBox();
				initServices();
				initShortInfo();
				initSlideParallax();
				initSubscribe();
				initTwitterModule();
				initVideoModule();
				initPortfolioFullscreen();
				initHotspot();
			},
			initAnimatedText = function() {
				$('.dfd-animated-text-block').each(function() {
					var $self = $(this);
					
					if($self.hasClass('style-typed')) {
						var speed = $self.data('speed') && $self.data('speed') != '' ? $self.data('speed') : 10,
							attr = {
								stringsElement: $self.find('.dfd-animate-text'),
								typeSpeed: speed,
								preStringTyped: function() {
									
								}
							};
							
						if($self.data('cursor') && $self.data('cursor') == '1') {
							attr.showCursor = true;
						} else {
							attr.showCursor = false;
						}
						
						if($self.data('loop') && $self.data('loop') == '1') {
							attr.loop = true;
						}
						
						$self.find('.dfd-animate-me').typed(attr);
					} else if($self.hasClass('style-chaffle')) {
						var speed = $self.data('speed') && $self.data('speed') != '' ? $self.data('speed') : 10000;
							
						$self.find('.dfd-animate-text').changeWords({
							animate: 'none',
							afterChangeAnimate: 'none',
							selector: 'span',
							time: speed
						});
					} else if ($self.hasClass('style-changethewords')) {
						var speed = $self.data('speed') && $self.data('speed') != '' ? $self.data('speed') : 10000,
							onchange = $self.data('onchange') && $self.data('onchange') != '' ? $self.data('onchange') : 'bounceIn',
							afterchange = $self.data('afterchange') && $self.data('afterchange') != '' ? $self.data('afterchange') : 'bounceOut';
							
						$self.find('.dfd-animate-text').changeWords({
							animate: onchange,
							afterChangeAnimate: afterchange,
							selector: 'span',
							time: speed
						});
					}
				});
			},
			initAnnouncement = function() {
				$('.dfd-announce-module').each(function() {
					var $self = $(this),
						height = $self.height();
					if(height < 80) {
						$self.find('.module-text .featured-icon').css({
							'width': height + 'px',
							'height': height + 'px',
							'line-height': height + 'px'
						});
					}else{
						$self.find('.module-text .featured-icon').css({
							'width': '80px',
							'height': '80px',
							'line-height': '80px'
						});
					}
				});
			},
			initButtonModule = function() {
				var init = function() {
					$('.dfd-button-module .dfd-button-link').each(function() {
						var $self = $(this);
						if(
							$self.find('.icon-wrap').length < 1
							&&
							(
								$self.hasClass('dfd-scale-in-diagonal')
								||
								$self.hasClass('dfd-scale-out-diagonal')
							)
						) {
							$self.css('width',$self.width());
						}
					});
				};
				
				init();
				dfd_native.window.on('resize', init);
			},
			initImageCarousel = function() {
				var init = function() {
					$('.dfd-logo-carousel-wrap').each(function() {
						var $wrap = $(this),
							slides_to_show = $wrap.data('slide') && $wrap.data('slide') != '' ? $wrap.data('slide') : 1,
							slides_to_scroll = $wrap.data('scroll') && $wrap.data('scroll') ? $wrap.data('scroll') : 1,
							enable_dots = false,
							auto_slideshow = false,
							slideshow_speed = $wrap.data('speed') && $wrap.data('speed') != '' ? $wrap.data('speed') : 3000,
							breakpoint_first = slides_to_show > 3 ? 3 : slides_to_show,
							breakpoint_second = slides_to_show > 2 ? 2 : slides_to_show,
							x = $wrap.data('count');

						if($wrap.data('dots') && $wrap.data('dots') == '1') {
							enable_dots = true;
						}	

						if($wrap.data('autoplay') && $wrap.data('autoplay') == '1') {
							auto_slideshow = true;
						}	

						if($wrap.hasClass('style-3')) {
							var elContainer = $wrap.find('.dfd-item-offset'),
								elThumb = elContainer.find('.thumb-wrap'),
								elThumbImg = elThumb.find('img'),
								descContainer = elThumb.find('.desc-text'),
								descContainerOverflow = descContainer.find('.text-overflow'),
								itemHeight = elThumbImg.height(),
								descHeight = descContainerOverflow.height();

							elContainer.each(function() {
								if(elThumbImg.height() > itemHeight) {
									itemHeight = elThumbImg.height();
								}
									if(descContainerOverflow.height() > descHeight) {
										descHeight = descContainerOverflow.height();
									}
							});
							if(descHeight > itemHeight) {
								descContainer.css('height', itemHeight + 'px');
							} else {
								descContainer.css('height', 'auto');
							}
							elThumb.css('height', itemHeight + 'px');
						} else {
							$('.dfd-equalize-height', $wrap).equalHeights();
						}

						if($wrap.hasClass('enable-delimiter') && dfd_native.windowWidth - dfd_native.scrollbarWidth > 800) {
							$('.columns-with-border:nth-child(-n+'+x+')', $wrap).addClass('no-top-border');
							$('.columns-with-border:nth-child('+x+'n+1)', $wrap).addClass('no-left-border');
						}

						if($wrap.hasClass('dfd-slide-images') && $wrap.find('.slick-initialized').length < 1) {
							$wrap.find('.dfd-logo-carousel-list').slick({
								infinite: true,
								slidesToShow: slides_to_show,
								slidesToScroll: slides_to_scroll,
								arrows: false,
								dots: enable_dots,
								autoplay: auto_slideshow,
								dotsClass: 'dfd-slick-dots',
								autoplaySpeed: slideshow_speed,
								customPaging: function(slider, i) {
									return '<span data-role="none" role="button" aria-required="false" tabindex="0"></span>';
								},
								responsive: [
									{
										breakpoint: 1280,
										settings: {
											slidesToShow: breakpoint_first,
											infinite: true,
											arrows: false,
											dots: enable_dots
										}
									},
									{
										breakpoint: 800,
										settings: {
											slidesToShow: breakpoint_second,
											infinite: true,
											arrows: false,
											dots: enable_dots
										}
									},
									{
										breakpoint: 460,
										settings: {
											slidesToShow: 1,
											infinite: true,
											arrows: false,
											dots: false
										}
									}
								]
							});
						}
					});
				};
				
				init();
				
				dfd_native.window.on('load resize', function() {
					init();
					setTimeout(function() {
						init();
					},200);
				});
			},
			initClientLogo = function() {
				var init = function() {
					$('.dfd-client-logo-wrap').each(function() {
						var $wrap = $(this),
							x = $wrap.data('count');
							if(typeof $.fn.equalHeights != 'undefined') {
								$('.dfd-item-offset .thumb-wrap', $wrap).equalHeights();
							}
							if($wrap.hasClass('style-1') || $wrap.hasClass('style-2')) {
								$('.dfd-client-logo-item', $wrap).each(function() {
									var $self = $(this),
										height = 0,
										titleHeight = 0,
										top = 0;

									if($self.find('.thumb-wrap')) {
										height += $self.find('.thumb-wrap').outerHeight();
									}

									if($self.find('.title-wrap')) {
										titleHeight = $self.find('.title-wrap').outerHeight();
										height += titleHeight;
										if($self.parents('.dfd-client-logo-wrap').hasClass('style-1')) {
											top = titleHeight;
										}
									}

									if($self.find('.description')) {
										height += $self.find('.description').outerHeight();
									}

									if($self.find('.dfd-shadow-wrap')) {
										$self.find('.dfd-shadow-wrap').height(height + 100).css('top', '-'+ top +'px');
									}
								});
							}
							if($wrap.hasClass('enable-delimiter') && dfd_native.windowWidth - dfd_native.scrollbarWidth > 800) {
								$('.columns-with-border:nth-child(-n+'+x+')', $wrap).addClass('no-top-border');
								$('.columns-with-border:nth-child('+x+'n+1)', $wrap).addClass('no-left-border');
							}
					});
				};
				
				init();

				dfd_native.window.on('resize', init);
			},
			initCountdown = function() {
				$('.dfd-countdown-wrap').each(function() {
					var $self = $(this),
						date = $self.data('date'),
						onfinishHtml = $self.data('finish-text'),
						html = $self.find('.dfd-countdown-html').html();

					$self.find('.dfd-countdown-html').remove();

					$self.countdown(date).on('update.countdown', function (event) {
						$(this).html(event.strftime(html));
					}).on('finish.countdown', function () {
						$(this).html(onfinishHtml);
					});
				});
			},
			initGradation = function() {
				var init = function() {
					$('.dfd-gradation-wrap').each(function(){
						$(this).find('.dfd-equalize-height').equalHeights();
					});
				};
				init();
				setTimeout(function() {
					init();
				}, 100);
				dfd_native.window.on('resize', init);
			},
			initImageLayersModule = function() {
				$('.dfd-image-layers-wrap').each(function() {
					var $container = $(this),
						layerWidth = 0,
						initImageLayers = function() {
							if(typeof $.fn.equalHeights != 'undefined') {
								$container.find('.dfd-layer-container').equalHeights();
							}

							if(typeof $.fn.waypoint != 'undefined') {
								$container.waypoint(function () {
									$container.addClass('layer-animate');
								}, {triggerOnce: true, offset: '70%'});
							}
						},
						imageSizing = function() {
							$container.find('.dfd-layer-item').each(function(){
								var $el = $(this),
									elWidth = $el.width();

								if($el.width() > layerWidth) {
									layerWidth = $el.width();
								}
							});

							$container.css({'width': layerWidth});
						};


					dfd_native.window.on('load', function() {
						if(typeof $.fn.imagesLoaded != 'undefined') {
							$container.find('.dfd-layer-item').imagesLoaded().done( function() {
								imageSizing();
								initImageLayers();
							});
						}
					});

					dfd_native.window.on('resize', initImageLayers);

					$('body').on('post-load', function() {
						if(typeof $.fn.imagesLoaded != 'undefined') {
							$container.find('.dfd-layer-item').imagesLoaded().done( function() {
								imageSizing();
							});
						}
						initImageLayers();
					});
				});
			},
			initShareModule = function() {
				$('.dfd-new-share-module').each(function() {
					
					var $parent = $(this),
						$share_container = $parent.find('.module-entry-share-links-list li'),
						setShareWidth = function(){
							if(dfd_native.windowWidth > 800){
								if($parent.hasClass('style-6') || $parent.hasClass('style-7') || $parent.hasClass('vertical')){
									$share_container.width('auto');
								} else {
									if(typeof $.fn.pricingTableEqColumns != 'undefined') {
										$share_container.pricingTableEqColumns();
									}
								}
							} else {
								if($parent.hasClass('style-6') || $parent.hasClass('style-7') || $parent.hasClass('vertical')){
									$share_container.width('auto');
								} else {
									$share_container.width('100%');
								}
							}
						};

					setShareWidth();
					dfd_native.window.on('load resize',setShareWidth);
				});
			},
			initTiltedPresentation = function() {
				$('.dfd-presentation-tilted-wrap').each(function() {
					var $container = $(this),
						$deco = $container.find('.main-decoration'),
						initTransform = function(height) {
							var skew = 24 - (height/260*10);
							if(skew < 0 || dfd_native.windowWidth < 800 || $container.find('.dfd-presentation-tilted-item').width() < 140) {
								skew = 0;
							}
							return skew;
						},
						init = function() {
							$container.find('.dfd-equalize-height').equalHeights();
							var containerHeight = $container.outerHeight();
							if(containerHeight < 260) {
								if($container.hasClass('style-2')) {
									$deco.css({
										'-webkit-transform': 'skew(-24deg)',
										'-moz-transform': 'skew(-24deg)',
										'-o-transform': 'skew(-24deg)',
										'transform': 'skew(-24deg)'
									});
								}else{
									$deco.css({
										'-webkit-transform': 'skew(24deg)',
										'-moz-transform': 'skew(24deg)',
										'-o-transform': 'skew(24deg)',
										'transform': 'skew(24deg)'
									});
								}
							} else {
								if($container.hasClass('style-2')) {
									$deco.css({
										'-webkit-transform': 'skew(-'+initTransform(containerHeight)+'deg)',
										'-moz-transform': 'skew(-'+initTransform(containerHeight)+'deg)',
										'-o-transform': 'skew(-'+initTransform(containerHeight)+'deg)',
										'transform': 'skew(-'+initTransform(containerHeight)+'deg)'
									});
								}else{
									$deco.css({
										'-webkit-transform': 'skew('+initTransform(containerHeight)+'deg)',
										'-moz-transform': 'skew('+initTransform(containerHeight)+'deg)',
										'-o-transform': 'skew('+initTransform(containerHeight)+'deg)',
										'transform': 'skew('+initTransform(containerHeight)+'deg)'
									});
								}
							}
						};
						init();
						dfd_native.window.on('load resize', init);
				});
			},
			initPortfolioFullscreen = function() {
				$('.dfd-portfolio-module.layout-fullscreen').each(function() {
					var $self		= $(this),
						id			= $self.parent().attr('id'),
						dir			= $self.data('direction') ? $self.data('direction') : 'vertical',
						speed		= dir == 'vertical' ? 800 : 1500,
						$container	= $self.find('.swiper-container'),
						$bgWrapper	= $self.siblings('.swiper-background-fade-wrapper'),
						$header		= $('#header-container'),
						swiper;
						
					if(Modernizr.touch) {
						dir			= 'horizontal';
						speed		= 1500;
						$self.removeClass('dfd-direction-vertical').addClass('dfd-direction-horizontal');
					}
					
					var slideChangeCallback = function(swiper) {
							var $counterPrev = $(swiper.wrapper).parent().siblings('.swiper-navigation-wrap').find('.dfd-swiper-prev'),
								$counterNext = $(swiper.wrapper).parent().siblings('.swiper-navigation-wrap').find('.dfd-swiper-next'),
								total = $(swiper.wrapper).find('.swiper-slide:not(.swiper-slide-duplicate)').length,
								prevText = swiper.realIndex +'/'+total,
								nextText = swiper.realIndex + 2 +'/'+total,
								firstClass = '',
								lastClass = '',
								imgSrcData = $bgWrapper.hasClass('dfd-blur-bg-image') ? 'src-small' : 'src';
							
							if((swiper.realIndex) < 1) {
								firstClass = 'first';
								prevText = total+'/'+total;
							}
							
							if((swiper.realIndex + 2) > total) {
								lastClass = 'last';
								nextText = '1/'+total;
							}
							
							$counterPrev.removeClass('first').addClass(firstClass).find('.counter').text(prevText);
							$counterNext.removeClass('last').addClass(lastClass).find('.counter').text(nextText);
							
							if(swiper.previousIndex > swiper.activeIndex) {
								$(swiper.wrapper).removeClass('dfd-to-next-slide').addClass('dfd-to-prev-slide');
							} else {
								$(swiper.wrapper).removeClass('dfd-to-prev-slide').addClass('dfd-to-next-slide');
							}
							$bgWrapper.css('backgroundImage','url('+$(swiper.wrapper).find('.swiper-slide').eq(swiper.activeIndex).find('img').data(imgSrcData)+')');
						},
						initSizes = function() {
							var w = $self.width(),
								h = dfd_native.windowHeight;
							
							if(dfd_native.windowWidth + dfd_native.scrollbarWidth < 1101) {
								h -= $header.outerHeight() - 1;
							} else {
								if(
									!$header.hasClass('header-style-12')
									&&
									!$header.hasClass('header-style-13')
									&&
									!$header.hasClass('header-style-14')
									&&
									!$header.hasClass('menu-position-bottom')
									&&
									!$header.hasClass('dfd-header-layout-fixed')
								) {
									h -= ($header.find('.dfd-top-row').length > 0) ? $header.find('.dfd-top-row').outerHeight() : $header.outerHeight();
								}
							}
							
							if($('#wpadminbar').length > 0) {
								h -= $('#wpadminbar').outerHeight();
							}
							
							if($('.dfd-frame-line.line-top').length > 0) {
								h -= ($('.dfd-frame-line.line-top').outerHeight() * 2);
							}
							
							$container.css({
								'width': w,
								'height': h
							});
						},
						swiper = new Swiper($container, {
							nextButton: '#'+id+' .dfd-swiper-next',
							prevButton: '#'+id+' .dfd-swiper-prev',
							direction: dir,
							slidesPerView: 1,
							speed: speed,
							spaceBetween: 0,
							mousewheelControl: false,
							loop: true,
							loopedSlides: 1,
							paginationType: 'bullets',
							paginationClickable: true,
							bulletClass: 'dfd-swiper-pagination-bullet',
							bulletActiveClass: 'dfd-swiper-pagination-bullet-active',
							pagination: '.swiper-pagination',
							paginationBulletRender: function(swiper, i, bullerClass) {
								var index = i+1,
									text = index < 10 ? '0'+index : index;
								return '<span class="'+bullerClass+'">'+text+'</span>';
							},
							onImagesReady: function(swiper) {
								initSizes();
								slideChangeCallback(swiper);
								swiper.update(true);
								setTimeout(function() {
									initSizes();
									swiper.update(true);
									$('body').trigger('swiper-loaded');
								}, 500);
							},
							onSlideChangeStart: function (swiper) {
								$('body').trigger('reinit-waypoint');
								slideChangeCallback(swiper);
							},
							onSlideChangeEnd: function(swiper) {
							},
							onTransitionStart: function() {
								$('body').addClass('scrolling');
							},
							onTransitionEnd: function() {
								$('body').removeClass('scrolling');
							}
						});
					
					initSizes();
					
					$('body').on('reinit-waypoint', initSizes);

					dfd_native.window.on('load resize', initSizes);
				});
			},
			initPriceList = function() {
				var init = function() {
					$('.dfd-price-wrap .dfd-price-block').each(function() {
						var $self = $(this);
						
						if(!$self.find('.dfd-price-cover')) return;
						
						var $container = $self.find('.dfd-price-cover'),
							$thumb = $self.find('.thumb-wrap'),
							titleWidth = 0,
							priceWidth = 0,
							titleFont = 0,
							titleLine = 0,
							delimBottom = 0,
							elTextHeight = $self.find('.text-wrap').height(),
							elThumbHeight = $thumb.height();
							
						if(elTextHeight < elThumbHeight) {
							$self.find('.text-wrap').addClass('small-img');
							$self.css("height", elThumbHeight + "px");
						}
						
						if($container.find('.price-title')) {
							titleWidth = $container.find('.price-title').width();
								// Height of delimiter	
							titleFont = parseFloat($container.find('.price-title').css('font-size'));
							titleLine = parseFloat($container.find('.price-title').css('line-height'));
							delimBottom = (titleLine - titleFont) / 2;
						}
						if($container.find('>.amount')) {
							priceWidth = $container.find('.amount').width();
						}
						if($("body").hasClass("rtl")) {
							$container.find('.price-delimeter').css({
								'right': titleWidth,
								'left': priceWidth,
								'bottom': delimBottom
							});
						}else {
							$container.find('.price-delimeter').css({
								'left': titleWidth,
								'right': priceWidth,
								'bottom': delimBottom
							});
						}
						$container.find('.price-delimeter').css({
							'left': titleWidth,
							'right': priceWidth,
							'bottom': delimBottom
						});
					});
				};
				
				init();
				
				dfd_native.window.on('load resize', init);
				
				$('body').on('tabs-reinited', function() {
					setTimeout(function() {
						init();
					},300);
				});
			},
			initRotateBox = function() {
				var init = function() {
					$('.dfd-rotate-box-wrap').each(function() {
						var $self = $(this),
							textHeight = $self.find('.thumb-wrap .thumb-wrap-back .content-wrap .description-reverse');

						if(textHeight.height() > ($(this).height()) - 100) {
							textHeight.css('height', ($(this).height()) - 100);
							textHeight.css('overflow', 'hidden');
						}
					});
				};
				init();
				dfd_native.window.on('resize', init);
			},
			initServices = function() {
				var init = function() {
					$('.dfd-services-wrap').each(function(){
						$(this).find('.dfd-equalize-height').equalHeights();
					});
				};
				
				init();
				
				dfd_native.window.on('load resize', init);
			},
			initShortInfo = function() {
				var init = function() {
					$('.dfd-short-info-block-wrap').each(function(){
						$(this).find('.dfd-equalize-height').equalHeights();
					});
				};
				init();
				setTimeout(function() {
					init();
				}, 100);
				dfd_native.window.on('resize', init);
			},
			initSlideParallax = function() {
				if(typeof $.fn.slideParallax != 'undefined') {
					setTimeout(function(){
						$('.dfd-slide-parallax-image-wrapper').slideParallax();
					},200);
				}
			},
			initSubscribe = function() {
				$('.dfd-subscribe-wrap.style-5 input.text').focus(function(e){
					$(this).parent('td').addClass('active').siblings().addClass('active');
				}).blur(function(){
					if($(this).val() == '') {
						$(this).parent('td').removeClass('active').siblings().removeClass('active');
					}
				});
			},
			initTwitterModule = function() {
				$('.dfd-twitter-module').each(function() {
					var $self = $(this);
						
					if($self.find('.tweet-container').length < 1 || $self.find('.slick-initialized').length > 0) {
						return;
					}
					
					var slides_to_show = $self.data('slide') && $self.data('slide') != '' ? $self.data('slide') : 1,
						slides_to_scroll = $self.data('scroll') && $self.data('scroll') ? $self.data('scroll') : 1,
						enable_dots = false,
						auto_slideshow = false,
						slideshow_speed = $self.data('speed') && $self.data('speed') != '' ? $self.data('speed') : 3000,
						breakpoint_first = slides_to_show > 3 ? 3 : slides_to_show,
						breakpoint_second = slides_to_show > 2 ? 2 : slides_to_show;
					
					if($self.data('dots') && $self.data('dots') == '1') {
						enable_dots = true;
					}	
					
					if($self.data('autoplay') && $self.data('autoplay') == '1') {
						auto_slideshow = true;
					}	
					
					$self.find('.tweet-container').slick({
						infinite: true,
						slidesToShow: slides_to_show,
						slidesToScroll: slides_to_scroll,
						arrows: false,
						dots: enable_dots,
						autoplay: auto_slideshow,
						dotsClass: 'dfd-slick-dots',
						autoplaySpeed: slideshow_speed,
						customPaging: function(slider, i) {
							return '<span data-role="none" role="button" aria-required="false" tabindex="0"></span>';
						},
						responsive: [
							{
								breakpoint: 1280,
								settings: {
									slidesToShow: breakpoint_first,
									infinite: true,
									arrows: false,
									dots: enable_dots
								}
							},
							{
								breakpoint: 800,
								settings: {
									slidesToShow: breakpoint_second,
									infinite: true,
									arrows: false,
									dots: enable_dots
								}
							},
							{
								breakpoint: 460,
								settings: {
									slidesToShow: 1,
									infinite: true,
									arrows: false,
									dots: false
								}
							}
						]
					});
					
					$('.tweet-container .tweet-item', $self).on("mousedown select",(function(e){
						e.preventDefault();
					}));
				});
			},
			initVideoModule = function() {
				$('.dfd-videoplayer.style-1').each(function() {
					var $self = $(this),
						id = $self.data('id'),
						blockId = $self.data('block-id');
					
					if(typeof DFD_VideoModule != "undefined") {
						DFD_VideoModule.init(id, blockId);
					}
				});
			},
			initHotspot = function() {
				var initOffsets = function() {
					$('.dfd-hotspot-shortcode').each(function() {
						$(this).find('.HotspotPlugin_Hotspot').each(function(index) {
							var $self = $(this);
							if(!Modernizr.touch && dfd_native.windowWidth > 800) {
								if(!$self.hasClass('animation-done')) {
									$self.css('opacity', '0');
								}
								$self.waypoint(function () {
									if(!$self.hasClass('animation-done')) {
										$self.addClass('animation-done')
											.velocity('transition.slideUpBigIn',{
												display: 'block',
												opacity: '1',
												delay: index * 200,
												complete: function(el) {
													$(el).css({
														'-webkit-transform': 'none',
														'-moz-transform': 'none',
														'-o-transform': 'none',
														'transform': 'none'
													});
												}
											});
									}
								}, {offset: '95%'});
							}
						});
					});
					$('.dfd-hotspot-shortcode .HotspotPlugin_Hotspot').each(function(index) {
						var $self = $(this),
							$tooltip = $self.find('> div'),
							selfWidth = $tooltip.outerWidth(),
							selfOffset = $tooltip.offset();
						
						$tooltip.removeClass('dfd-hotspot-left').removeClass('dfd-hotspot-right');
						
						if(selfOffset.left <= 0 && selfOffset.left + selfWidth > dfd_native.windowWidth) {
							$tooltip.addClass('dfd-hotspot-outsite');
						} else if(selfOffset.left <= 0) {
							$tooltip.addClass('dfd-hotspot-left');
						} else if(selfOffset.left + selfWidth > dfd_native.windowWidth) {
							$tooltip.addClass('dfd-hotspot-right');
						}
					});
				};
				$('.dfd-hotspot-shortcode').each(function() {
					var $self = $(this),
						hotspotClass = $self.data('hotspot-class') ? $self.data('hotspot-class') : 'HotspotPlugin_Hotspot',
						hotspotContent = $self.data('hotspot-content') ? $self.data('hotspot-content') : '',
						action = $self.data('action') ? $self.data('action') : 'hover';
					
					if(hotspotContent != '' && !$self.find('.dfd-hotspot-image-cover').hasClass('dfd-htospot-inited')) {
						$self.find('.dfd-hotspot-image-cover').addClass('dfd-htospot-inited').hotspot({
							hotspotClass: hotspotClass,
							interactivity: action,
							data: decodeURIComponent(hotspotContent)
						});
					}
				});
				$('body').on('dfd-hotspot-inited', initOffsets);
				initOffsets();
				dfd_native.window.on('resize', initOffsets);
			};
		
		dfd_native.document.ready(function() {
			initShortcodes();
		});
		$('body').on('post-load', initShortcodes);
	};
	
	dfd_native.init = function() {
		dfd_native.initObjectsSizing();
		dfd_native.headerEvents();
		dfd_native.initWidgetsScripts();
		dfd_native.initVideoBg();
		dfd_native.ajaxAddPosts();
		dfd_native.initGalleryPostCarousel();
		dfd_native.wrapSinglePostVcContent();
		dfd_native.isotopePosts();
		dfd_native.sideImagePosts();
		dfd_native.initJustifiedGrid();
		dfd_native.initLightbox();
		dfd_native.initAudioplayer();
		dfd_native.fullHeightRow();
		dfd_native.initSpacerShortcode();
		dfd_native.initEqualHeights();
		dfd_native.initParallaxBackground();
		dfd_native.initAnimatedBg();
		dfd_native.initCanvasBg();
		dfd_native.initMousemoveParallax();
		dfd_native.initFixedFooter();
		dfd_native.onePageMenuNavigation();
		dfd_native.initCarousel();
		dfd_native.imagesLazyLoad();
		dfd_native.initPanr();
		dfd_native.init3dHover();
		dfd_native.initAnimation();
		dfd_native.initButtonClick();
		dfd_native.initPieCharts();
		dfd_native.initFrontContent();
		dfd_native.initProgressBar();
		dfd_native.initFactsShortcode();
		dfd_native.initPortfolioGalleryAdvanced();
		dfd_native.initAnimatedHeadingShortcode();
		dfd_native.postLike();
		dfd_native.wishlistAjaxCounter();
		dfd_native.addHeaderDynamicStyles();
		dfd_native.initPortfolioSingleCarousel();
		dfd_native.initGallerySingleCarousel();
		dfd_native.initDfdTabModule();
		dfd_native.initDfdTourModule();
		dfd_native.initVcShortcodesScripts();
		dfd_native.header_builder();
	};
	
	dfd_native.init();
})(jQuery);


function dfd_testimnials_slider(options){
	var $carousel = options.obj;

	var slideCount = "";
	var currentSlide = "";
	var prevSlide = 0;
	var NextSlide = 0;
	var max_height = 0;
	var slick = {
		slideCount: 0,
		currentSlide: 0,
	};

	/**
	 * @param object slider slick library
	 */
	this.init = function(slick){
		slideCount = slick.slideCount;
		currentSlide = slick.currentSlide;

		if(slideCount > 1){
			this.calculateSlideNumberText();
			this.addNext();
			this.addPrev();
			var left = $carousel.find(".slick-prev");
			var right = $carousel.find(".slick-next");
			this.getMaxHeight();
			this.setHeightOnElement();
			left.on("click", function(){
				slick.slickPrev();
			});
			right.on("click", function(){
				slick.slickNext();
			});
		}
	};
	this.getMaxHeight = function(){
		var elements = $carousel.find(".text-wrap");
			if(elements.length>0){
				elements.each(function(){
					var h = jQuery(this).height();
					if(h>max_height){
						max_height = h;
					}
				});
			}
	};
	this.setHeightOnElement = function(){
		$carousel.find(".navigation_arrows").css("height",max_height);
	};
	this.calculateSlideNumberText = function(){
		currentSlide++;
		prevSlide = currentSlide - 1;
		NextSlide = currentSlide + 1
		if(slideCount == 1){
			prevSlide = NextSlide = slideCount;
		}
		if(slideCount == 2){
			var slide = currentSlide == 1 ? 2 : 1;
			prevSlide = NextSlide = slide;
		}
		prevSlide = (prevSlide <= 0) ? slideCount : prevSlide;

		NextSlide = (NextSlide > slideCount) ? 1 : NextSlide;
	};
	
	this.addPrev = function(){
		this.templateForStats("prevSlide", prevSlide,"slick-prev");
	};
	this.addNext = function(){
		this.templateForStats("nextSlide", NextSlide,"slick-next");
	};
	this.templateForStats = function($class, $number,$append){
		var $textslide = $carousel.find(".navigation_arrows ." + $class);
		if($textslide.length){
			$textslide.text($number + "/" + slideCount);
		} else {
			$carousel.find(".navigation_arrows ."+$append+"").append("<span class='t_stats " + $class + "'>" + $number + "/" + slideCount + "</span>");
		}
	};
}
/**
 * Delimier module delegate click to 'Back to Top'
 */
(function($){
	"use strict";
	$(document).ready(function(){
		$(".dfd-delimier-wrapper.dfd-delimiter-with-arrow .inner-wrapper-icon").on("click", function(){
			$(".body-back-to-top").trigger("click");
		});
	});
})(jQuery);
/**
 * Accordion appear text effect
 */
(function($){
	"use strict";
	$.fn.dfd_Accordion = function(){

		$(this).find(".dfd_accordion.style-9 .vc_tta-panel,.dfd_accordion.style-10 .vc_tta-panel").on("click", function(){
			$('body').trigger('tabs-reinited');
			
			var el = $(this).parent();
			el.find(".vc_tta-panel").each(function(){
				$(this).removeClass("remove_border");
			});
			$(this).prev().addClass("remove_border");
		});
		$(this).find(".dfd_accordion.style-9 .vc_tta-panel.vc_active,.dfd_accordion.style-10 .vc_tta-panel.vc_active").prev().addClass("remove_border");

		$(this).find(".vc_tta-accordion .vc_tta-panels").on("click",".vc_tta-panel", function(){
			var self = $(this);
			var $el = self.siblings();
			$el.each(function(){
				$(this).find(".vc_tta-panel-body").slideUp(200);
			});
			self.find(".vc_tta-panel-body").slideDown(200);
		});

	}
	$.fn.dfd_tab = function(){

		$(this).find(".dfd_tta_tabs .vc_tta-tabs-list").on("click", ".vc_tta-tab:not(.vc_active)", function(){
			$('body').trigger('tabs-reinited');
			
			$(this).siblings().removeClass("vc_active");
			$(this).addClass("vc_active");
			
			var id = $(this).find("a").attr("href");
			
			var main_block = $(this).parent().parent().parent();
			
			var next_active_tab = main_block.find(id),
				next_active_tabHeight = next_active_tab.height();

			setTimeout(function(){
				main_block.find(".vc_tta-panels .vc_tta-panel").removeClass("vc_active");
				main_block.find(".vc_tta-panel-body").attr("style", "");
				next_active_tab.addClass("vc_active");
				if(dfd_native.windowWidth > 767) {
					next_active_tab.parent().css({height: next_active_tabHeight});
				}
			},150);

			return false;
		});
		/*
		 * For responsive elements
		 */
		$(this).find(".dfd_tta_tabs.empty_rounded .vc_tta-panels").on("click",".vc_tta-panel:not(.vc_active)", function(){
			var el = $(this).parent();
			el.find(".vc_tta-panel").each(function(){
				$(this).removeClass("remove_border");
			});
			$(this).prev().addClass("remove_border");
		});
		$(this).find(".dfd_tta_tabs .vc_tta-panels").on("click", ".vc_tta-panel:not(.vc_active)", function(){
			$('body').trigger('tabs-reinited');
			
			var self = $(this);
			var $el = self.siblings();
			$el.each(function(){
				$(this).find(".vc_tta-panel-body").slideUp(150);
			});
			self.find(".vc_tta-panel-body").slideDown(200).attr("style","");
		});
	};
	$.fn.dfd_tour = function(){
		var self = this;
		
		$(this).find(".dfd_tta_tour").on("click", ".vc_tta-tabs-list .vc_tta-tab:not(.vc_active), .vc_pagination li:not(.vc_active)", function(){
			$('body').trigger('tabs-reinited');
			
			var li = this;
			$(this).siblings().removeClass("vc_active");
			$(this).addClass("vc_active");

			var id = $(this).find("a").attr("href");

			var main_block = $(this).parent().parent().parent();

			var next_active_tab = main_block.find(id),
				next_active_tabHeight = next_active_tab.find('.vc_tta-panel-body').height();
			if(main_block.hasClass("style-8") || main_block.hasClass("style-9")){
				var el = $(li).parentsUntil(".vc_tta-tabs-container");
				el.find("li").removeClass("remove_border");
				$(li).prev().addClass("remove_border");
			}

			setTimeout(function() {
				var block = main_block.find(".vc_tta-panels .vc_tta-panel");
				block.removeClass("vc_active").attr("style", "");
				/*fix bug width height*/
				block.find(".vc_tta-panel-body").attr("style", "");
				next_active_tab.addClass("vc_active");
				if(dfd_native.windowWidth > 767) {
					next_active_tab.parent().css({height: next_active_tabHeight});
				}
			}, 150);
			main_block.find(".vc_pagination li").removeClass("vc_active").parent().parent().parent().find('.vc_tta-tabs-list .vc_tta-tab.vc_active').removeClass("vc_active");
			main_block.find(".vc_pagination li a[href="+id+"]").parent().addClass("vc_active").parent().parent().parent().find('.vc_tta-tabs-list .vc_tta-tab a[href='+id+']').parent().addClass("vc_active");
			return false;
		});
		
		$(this).bind("DOMSubtreeModified", function(){
			setTimeout(function(){
				$(this).find("li").removeClass("remove_border");
				$(this).find("li.vc_active").prev().addClass("remove_border");
			}, 200);
		});
		setTimeout(function(){
			$(self).find(".style-8 li.vc_active").prev().addClass("remove_border");
			$(self).find(".style-9 li.vc_active").prev().addClass("remove_border");
		}, 200);
	};
})(jQuery);
(function($){
	$.fn.dfd_carousel_module = function(options){
		var self = this;
		var max_height = 0;
		if(options.vertical){
			$(this).find(".dfd-item-wrap").each(function(){
				var height = $(this).height();
				if(height > max_height){
					max_height = height + 20;
				}
			});
			$(this).find(".dfd-item-wrap").each(function(){
				$(this).height(max_height).css({
					padding: "20px 0px 0px 0px",
					overflow: "hidden",
					width : "100%",
				});
			});
		}
		$(self).slick(options);
	};
})(jQuery);	

/**
 * BBpress
 */
(function($){
	"use strict";
	$(document).ready(function(){
		var $el = $('#bbpress-forums .bbp-topic-tags p');
		if($el.length > 0) {
			var html = $el.html(),
				newString = html.replace(/, /g, '');
			$el.html(newString);
		}
		$('#bbpress-forums .forums.bbp-replies .bbp-body > div, #bbpress-forums .forums.bbp-search-results .bbp-body > div').each(function() {
			var $self = $(this);
			
			if($self.find('.bbp-author-avatar').length > 0 && $self.find('.bbp-reply-content').length > 0) {
				var $avatar = $self.find('.bbp-author-avatar').clone();
				$self.find('.bbp-author-avatar').remove();
				$self.find('.bbp-reply-content').prepend($avatar);
				
				$self.find('.bbp-reply-content .bbp-author-avatar').siblings().wrapAll('<div class="dfd-bbpress-content-wrap" />');
			}
		});
		
		
		$('#bbpress-forums .forums.bbp-search-results .bbp-body > div').each(function() {
			var $self = $(this);
			
			if($self.find('.bbp-author-avatar').length > 0 && $self.find('.bbp-topic-content').length > 0) {
				var $avatar = $self.find('.bbp-author-avatar').clone();
				$self.find('.bbp-author-avatar').remove();
				$self.find('.bbp-topic-content').prepend($avatar);
				
				$self.find('.bbp-topic-content .bbp-author-avatar').siblings().wrapAll('<div class="dfd-bbpress-content-wrap" />');
			}
		});
	});
})(jQuery);
