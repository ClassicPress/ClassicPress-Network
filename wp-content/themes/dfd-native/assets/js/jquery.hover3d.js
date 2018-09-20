/*
jQuery Hover3d
=================================================
Version: 1.0.0
Author: Rian Ariona
Website: http://ariona.net
Docs: http://ariona.github.io/hover3d
Repo: http://github.com/ariona/hover3d
Issues: http://github.com/ariona/hover3d/issues
*/

(function($){
	"use strict";
	$.fn.hover3d = function(options){
		
		var settings = $.extend({
			selector      : null,
			perspective   : 1000,
			invert        : false,
			shine         : false,
			hoverInClass  : "hover-in",
			hoverOutClass : "hover-out",
			hoverClass    : "hover-3d"
		}, options);
		
		return this.each(function(){
			
			var $this = $(this),
				$card = $this.find(settings.selector),
				$shadow = $card.next('.dfd-shadow-box');

			if( settings.shine ){
				$card.find('.entry-thumb .thumb-wrap').append('<div class="shine"></div>');
				
				var $shine = $(this).find(".shine");

				$shine.css({
					position  : "absolute",
					top       : 0,
					left      : 0,
					bottom    : 0,
					right     : 0,
					"z-index" : 10
				});
			}
			
			if(!$this.parent().hasClass('layout-side-image') && !$this.parent().hasClass('content-front')) {
				$this.parent().addClass('content-front content-valign-bottom');
			}

			// Mouse Enter function, this will add hover-in
			// Class so when mouse over it will add transition
			// based on hover-in class
			function enter(){
				$this.css('zIndex','9');
				
				$card.addClass(settings.hoverInClass+" "+settings.hoverClass);
				
				setTimeout(function(){
					$card.removeClass(settings.hoverInClass);
				}, 500);
			}
			
			// Mouse movement Parallax effect
			function move(event){
				var w      = $this.innerWidth(),
					h      = $this.innerHeight(),
					sW	   = w / 7.5,
					sH	   = h / 7.5,
					ax 	   = settings.invert ?  ( w / 2 - event.offsetX)/sW : -( w / 2 - event.offsetX)/sW,
					ay     = settings.invert ? -( h / 2 - event.offsetY)/sH :  ( h / 2 - event.offsetY)/sH;
				
				$card.css({
					transform      : "perspective("+w*3+"px) rotateY("+ax*2.5+"deg) rotateX("+ay*2.5+"deg) translateX("+ -ax*1.5 +"px) translateY("+ ay*1.5 +"px)  translateZ(0) scale(1.02, 1.02)",
				});
				$shadow.css({
					transform      : "perspective("+w*3+"px) rotateY("+ax*2.5+"deg) rotateX("+ay*2.5+"deg) translateX("+ -ax*1.5 +"px) translateY("+ ay*1.5 +"px)  translateZ(-50px)",
				});
					
				if( settings.shine ){
					var dy     = event.offsetY - h / 2,
						dx     = event.offsetX - w / 2,
						theta  = Math.atan2(dy, dx),
						angle  = theta * 180 / Math.PI - 90;

					if (angle < 0) {
						angle  = angle + 360;
					}
					$shine.css('background', 'linear-gradient(' + angle + 'deg, rgba(255,255,255,' + event.offsetY / h * .8 + ') 0%,rgba(255,255,255,0) 80%)');
				}
			}
			
			// Mouse leave function, will set the transform
			// property to 0, and add transition class
			// for exit animation
			function leave(){
				var w = $this.innerWidth();
				$this.stop().animate({
					'zIndex': '1'
				},500);
				$card.addClass(settings.hoverOutClass+" "+settings.hoverClass);
				$card.css({
					transform      : "perspective("+w*3+"px) rotateX(0) rotateY(0) translateX(0) translateY(0) translateZ(0) scale(1, 1)"
				});
				$shadow.css({
					transform      : "perspective("+w*3+"px) rotateY(0) rotateX(0) translateX(0) translateY(0) translateZ(-150px)"
				});
				
				setTimeout( function(){
					$card.removeClass(settings.hoverOutClass+" "+settings.hoverClass);
				}, 500 );
			}
			
			// Mouseenter event binding
			$this.on( "mouseenter", function(){
				return window.requestAnimationFrame(function(){
					enter();
				});
			});
			
			// Mousemove event binding
			$this.on( "mousemove", function(event){
				return window.requestAnimationFrame(function(){
					move(event);
				});
			});
			
			// Mouseleave event binding
			$this.on( "mouseleave", function(){
				return window.requestAnimationFrame(function(){
					leave();
				});
			});
			
		});
		
	};
	
}(jQuery));