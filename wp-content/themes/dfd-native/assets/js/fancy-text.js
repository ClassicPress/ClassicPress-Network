(function(u,r){"function"===typeof define&&define.amd?define([],r):"object"===typeof module&&module.exports?module.exports=r():u.anime=r()})(this,function(){var u={duration:1E3,delay:0,loop:!1,autoplay:!0,direction:"normal",easing:"easeOutElastic",elasticity:400,round:!1,begin:void 0,update:void 0,complete:void 0},r="translateX translateY translateZ rotate rotateX rotateY rotateZ scale scaleX scaleY scaleZ skewX skewY".split(" "),y,f={arr:function(a){return Array.isArray(a)},obj:function(a){return-1<
Object.prototype.toString.call(a).indexOf("Object")},svg:function(a){return a instanceof SVGElement},dom:function(a){return a.nodeType||f.svg(a)},num:function(a){return!isNaN(parseInt(a))},str:function(a){return"string"===typeof a},fnc:function(a){return"function"===typeof a},und:function(a){return"undefined"===typeof a},nul:function(a){return"null"===typeof a},hex:function(a){return/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)},rgb:function(a){return/^rgb/.test(a)},hsl:function(a){return/^hsl/.test(a)},
col:function(a){return f.hex(a)||f.rgb(a)||f.hsl(a)}},D=function(){var a={},b={Sine:function(a){return 1-Math.cos(a*Math.PI/2)},Circ:function(a){return 1-Math.sqrt(1-a*a)},Elastic:function(a,b){if(0===a||1===a)return a;var d=1-Math.min(b,998)/1E3,g=a/1-1;return-(Math.pow(2,10*g)*Math.sin(2*(g-d/(2*Math.PI)*Math.asin(1))*Math.PI/d))},Back:function(a){return a*a*(3*a-2)},Bounce:function(a){for(var b,d=4;a<((b=Math.pow(2,--d))-1)/11;);return 1/Math.pow(4,3-d)-7.5625*Math.pow((3*b-2)/22-a,2)}};["Quad",
"Cubic","Quart","Quint","Expo"].forEach(function(a,e){b[a]=function(a){return Math.pow(a,e+2)}});Object.keys(b).forEach(function(c){var e=b[c];a["easeIn"+c]=e;a["easeOut"+c]=function(a,b){return 1-e(1-a,b)};a["easeInOut"+c]=function(a,b){return.5>a?e(2*a,b)/2:1-e(-2*a+2,b)/2};a["easeOutIn"+c]=function(a,b){return.5>a?(1-e(1-2*a,b))/2:(e(2*a-1,b)+1)/2}});a.linear=function(a){return a};return a}(),z=function(a){return f.str(a)?a:a+""},E=function(a){return a.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()},
F=function(a){if(f.col(a))return!1;try{return document.querySelectorAll(a)}catch(b){return!1}},A=function(a){return a.reduce(function(a,c){return a.concat(f.arr(c)?A(c):c)},[])},t=function(a){if(f.arr(a))return a;f.str(a)&&(a=F(a)||a);return a instanceof NodeList||a instanceof HTMLCollection?[].slice.call(a):[a]},G=function(a,b){return a.some(function(a){return a===b})},R=function(a,b){var c={};a.forEach(function(a){var d=JSON.stringify(b.map(function(b){return a[b]}));c[d]=c[d]||[];c[d].push(a)});
return Object.keys(c).map(function(a){return c[a]})},H=function(a){return a.filter(function(a,c,e){return e.indexOf(a)===c})},B=function(a){var b={},c;for(c in a)b[c]=a[c];return b},v=function(a,b){for(var c in b)a[c]=f.und(a[c])?b[c]:a[c];return a},S=function(a){a=a.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i,function(a,b,c,m){return b+b+c+c+m+m});var b=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a);a=parseInt(b[1],16);var c=parseInt(b[2],16),b=parseInt(b[3],16);return"rgb("+a+","+c+","+b+")"},
T=function(a){a=/hsl\((\d+),\s*([\d.]+)%,\s*([\d.]+)%\)/g.exec(a);var b=parseInt(a[1])/360,c=parseInt(a[2])/100,e=parseInt(a[3])/100;a=function(a,b,c){0>c&&(c+=1);1<c&&--c;return c<1/6?a+6*(b-a)*c:.5>c?b:c<2/3?a+(b-a)*(2/3-c)*6:a};if(0==c)c=e=b=e;else var d=.5>e?e*(1+c):e+c-e*c,g=2*e-d,c=a(g,d,b+1/3),e=a(g,d,b),b=a(g,d,b-1/3);return"rgb("+255*c+","+255*e+","+255*b+")"},p=function(a){return/([\+\-]?[0-9|auto\.]+)(%|px|pt|em|rem|in|cm|mm|ex|pc|vw|vh|deg)?/.exec(a)[2]},I=function(a,b,c){return p(b)?
b:-1<a.indexOf("translate")?p(c)?b+p(c):b+"px":-1<a.indexOf("rotate")||-1<a.indexOf("skew")?b+"deg":b},w=function(a,b){if(b in a.style)return getComputedStyle(a).getPropertyValue(E(b))||"0"},U=function(a,b){var c=-1<b.indexOf("scale")?1:0,e=a.style.transform;if(!e)return c;for(var d=/(\w+)\((.+?)\)/g,g=[],m=[],f=[];g=d.exec(e);)m.push(g[1]),f.push(g[2]);e=f.filter(function(a,c){return m[c]===b});return e.length?e[0]:c},J=function(a,b){if(f.dom(a)&&G(r,b))return"transform";if(f.dom(a)&&(a.getAttribute(b)||
f.svg(a)&&a[b]))return"attribute";if(f.dom(a)&&"transform"!==b&&w(a,b))return"css";if(!f.nul(a[b])&&!f.und(a[b]))return"object"},K=function(a,b){switch(J(a,b)){case "transform":return U(a,b);case "css":return w(a,b);case "attribute":return a.getAttribute(b)}return a[b]||0},L=function(a,b,c){if(f.col(b))return b=f.rgb(b)?b:f.hex(b)?S(b):f.hsl(b)?T(b):void 0,b;if(p(b))return b;a=p(a.to)?p(a.to):p(a.from);!a&&c&&(a=p(c));return a?b+a:b},M=function(a){var b=/-?\d*\.?\d+/g;return{original:a,numbers:z(a).match(b)?
z(a).match(b).map(Number):[0],strings:z(a).split(b)}},V=function(a,b,c){return b.reduce(function(b,d,g){d=d?d:c[g-1];return b+a[g-1]+d})},W=function(a){a=a?A(f.arr(a)?a.map(t):t(a)):[];return a.map(function(a,c){return{target:a,id:c}})},N=function(a,b,c,e){"transform"===c?(c=a+"("+I(a,b.from,b.to)+")",b=a+"("+I(a,b.to)+")"):(a="css"===c?w(e,a):void 0,c=L(b,b.from,a),b=L(b,b.to,a));return{from:M(c),to:M(b)}},X=function(a,b){var c=[];a.forEach(function(e,d){var g=e.target;return b.forEach(function(b){var l=
J(g,b.name);if(l){var q;q=b.name;var h=b.value,h=t(f.fnc(h)?h(g,d):h);q={from:1<h.length?h[0]:K(g,q),to:1<h.length?h[1]:h[0]};h=B(b);h.animatables=e;h.type=l;h.from=N(b.name,q,h.type,g).from;h.to=N(b.name,q,h.type,g).to;h.round=f.col(q.from)||h.round?1:0;h.delay=(f.fnc(h.delay)?h.delay(g,d,a.length):h.delay)/k.speed;h.duration=(f.fnc(h.duration)?h.duration(g,d,a.length):h.duration)/k.speed;c.push(h)}})});return c},Y=function(a,b){var c=X(a,b);return R(c,["name","from","to","delay","duration"]).map(function(a){var b=
B(a[0]);b.animatables=a.map(function(a){return a.animatables});b.totalDuration=b.delay+b.duration;return b})},C=function(a,b){a.tweens.forEach(function(c){var e=c.from,d=a.duration-(c.delay+c.duration);c.from=c.to;c.to=e;b&&(c.delay=d)});a.reversed=a.reversed?!1:!0},Z=function(a){if(a.length)return Math.max.apply(Math,a.map(function(a){return a.totalDuration}))},O=function(a){var b=[],c=[];a.tweens.forEach(function(a){if("css"===a.type||"transform"===a.type)b.push("css"===a.type?E(a.name):"transform"),
a.animatables.forEach(function(a){c.push(a.target)})});return{properties:H(b).join(", "),elements:H(c)}},aa=function(a){var b=O(a);b.elements.forEach(function(a){a.style.willChange=b.properties})},ba=function(a){O(a).elements.forEach(function(a){a.style.removeProperty("will-change")})},ca=function(a,b){var c=a.path,e=a.value*b,d=function(d){d=d||0;return c.getPointAtLength(1<b?a.value+d:e+d)},g=d(),f=d(-1),d=d(1);switch(a.name){case "translateX":return g.x;case "translateY":return g.y;case "rotate":return 180*
Math.atan2(d.y-f.y,d.x-f.x)/Math.PI}},da=function(a,b){var c=Math.min(Math.max(b-a.delay,0),a.duration)/a.duration,e=a.to.numbers.map(function(b,e){var f=a.from.numbers[e],l=D[a.easing](c,a.elasticity),f=a.path?ca(a,l):f+l*(b-f);return f=a.round?Math.round(f*a.round)/a.round:f});return V(e,a.to.strings,a.from.strings)},P=function(a,b){var c;a.currentTime=b;a.progress=b/a.duration*100;for(var e=0;e<a.tweens.length;e++){var d=a.tweens[e];d.currentValue=da(d,b);for(var f=d.currentValue,m=0;m<d.animatables.length;m++){var l=
d.animatables[m],k=l.id,l=l.target,h=d.name;switch(d.type){case "css":l.style[h]=f;break;case "attribute":l.setAttribute(h,f);break;case "object":l[h]=f;break;case "transform":c||(c={}),c[k]||(c[k]=[]),c[k].push(f)}}}if(c)for(e in y||(y=(w(document.body,"transform")?"":"-webkit-")+"transform"),c)a.animatables[e].target.style[y]=c[e].join(" ");a.settings.update&&a.settings.update(a)},Q=function(a){var b={};b.animatables=W(a.targets);b.settings=v(a,u);var c=b.settings,e=[],d;for(d in a)if(!u.hasOwnProperty(d)&&
"targets"!==d){var g=f.obj(a[d])?B(a[d]):{value:a[d]};g.name=d;e.push(v(g,c))}b.properties=e;b.tweens=Y(b.animatables,b.properties);b.duration=Z(b.tweens)||a.duration;b.currentTime=0;b.progress=0;b.ended=!1;return b},n=[],x=0,ea=function(){var a=function(){x=requestAnimationFrame(b)},b=function(b){if(n.length){for(var e=0;e<n.length;e++)n[e].tick(b);a()}else cancelAnimationFrame(x),x=0};return a}(),k=function(a){var b=Q(a),c={};b.tick=function(a){b.ended=!1;c.start||(c.start=a);c.current=Math.min(Math.max(c.last+
a-c.start,0),b.duration);P(b,c.current);var d=b.settings;d.begin&&c.current>=d.delay&&(d.begin(b),d.begin=void 0);c.current>=b.duration&&(d.loop?(c.start=a,"alternate"===d.direction&&C(b,!0),f.num(d.loop)&&d.loop--):(b.ended=!0,b.pause(),d.complete&&d.complete(b)),c.last=0)};b.seek=function(a){P(b,a/100*b.duration)};b.pause=function(){ba(b);var a=n.indexOf(b);-1<a&&n.splice(a,1)};b.play=function(a){b.pause();a&&(b=v(Q(v(a,b.settings)),b));c.start=0;c.last=b.ended?0:b.currentTime;a=b.settings;"reverse"===
a.direction&&C(b);"alternate"!==a.direction||a.loop||(a.loop=1);aa(b);n.push(b);x||ea()};b.restart=function(){b.reversed&&C(b);b.pause();b.seek(0);b.play()};b.settings.autoplay&&b.play();return b};k.version="1.1.1";k.speed=1;k.list=n;k.remove=function(a){a=A(f.arr(a)?a.map(t):t(a));for(var b=n.length-1;0<=b;b--)for(var c=n[b],e=c.tweens,d=e.length-1;0<=d;d--)for(var g=e[d].animatables,k=g.length-1;0<=k;k--)G(a,g[k].target)&&(g.splice(k,1),g.length||e.splice(d,1),e.length||c.pause())};k.easings=D;
k.getValue=K;k.path=function(a){a=f.str(a)?F(a)[0]:a;return{path:a,value:a.getTotalLength()}};k.random=function(a,b){return Math.floor(Math.random()*(b-a+1))+a};return k});

!function(e){"undefined"==typeof module?this.charming=e:module.exports=e}(function(e,n){"use strict";n=n||{};var t=n.tagName||"span",o=null!=n.classPrefix?n.classPrefix:"char",r=1,a=function(e){for(var n=e.parentNode,a=e.nodeValue,c=a.length,l=-1;++l<c;){var d=document.createElement(t);o&&(d.className=o+r,r++),d.appendChild(document.createTextNode(a[l])),n.insertBefore(d,e)}n.removeChild(e)};return function c(e){for(var n=[].slice.call(e.childNodes),t=n.length,o=-1;++o<t;)c(n[o]);e.nodeType===Node.TEXT_NODE&&a(e)}(e),e});

/*!
 * imagesLoaded PACKAGED v4.1.1
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}("undefined"!=typeof window?window:this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||{};return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter")):t.imagesLoaded=e(t,t.EvEmitter)}(window,function(t,e){function i(t,e){for(var i in e)t[i]=e[i];return t}function n(t){var e=[];if(Array.isArray(t))e=t;else if("number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e}function o(t,e,r){return this instanceof o?("string"==typeof t&&(t=document.querySelectorAll(t)),this.elements=n(t),this.options=i({},this.options),"function"==typeof e?r=e:i(this.options,e),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(t,e,r)}function r(t){this.img=t}function s(t,e){this.url=t,this.element=e,this.img=new Image}var h=t.jQuery,a=t.console;o.prototype=Object.create(e.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),this.options.background===!0&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&d[e]){for(var i=t.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(e.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,t),n=i.exec(e.backgroundImage)}},o.prototype.addImage=function(t){var e=new r(t);this.images.push(e)},o.prototype.addBackground=function(t,e){var i=new s(t,e);this.images.push(i)},o.prototype.check=function(){function t(t,i,n){setTimeout(function(){e.progress(t,i,n)})}var e=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(e){e.once("progress",t),e.check()}):void this.complete()},o.prototype.progress=function(t,e,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,t,e)},o.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},r.prototype=Object.create(e.prototype),r.prototype.check=function(){var t=this.getIsImageComplete();return t?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var t=this.getIsImageComplete();t&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},o.makeJQueryPlugin=function(e){e=e||t.jQuery,e&&(h=e,h.fn.imagesLoaded=function(t,e){var i=new o(this,t,e);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

/**
 * TextFx.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
;(function(window) {

	'use strict';

	/**
	 * Equation of a line.
	 */
	function lineEq(y2, y1, x2, x1, currentVal) {
		var m = (y2 - y1) / (x2 - x1),
			b = y1 - m * x1;

		return m * currentVal + b;
	}

	function TextFx(el) {
		this.el = el;
		this._init();
	}
		
	TextFx.prototype.effects = {
		'style-1' : {
			in: {
				duration: 1000,
				delay: function(el, index) { return 75+index*40; },
				easing: 'easeOutElastic',
				elasticity: 650,
				opacity: {
					value: 1,
					easing: 'easeOutExpo',
				},
				translateY: ['50%','0%']
			},
			out: {
				duration: 400,
				delay: function(el, index) { return index*40; },
				easing: 'easeOutExpo',
				opacity: 0,
				translateY: '-100%'
			}
		},
		'style-2' : {
			in: {
				duration: 800,
				delay: function(el, index) { return index*50; },
				easing: 'easeOutElastic',
				opacity: 1,
				translateY: function(el, index) {
					return index%2 === 0 ? ['-80%', '0%'] : ['80%', '0%'];
				}
			},
			out: {
				duration: 800,
				delay: function(el, index) { return index*50; },
				easing: 'easeOutExpo',
				opacity: 0,
				translateY: function(el, index) {
					return index%2 === 0 ? '80%' : '-80%';
				}
			}
		},
		'style-3' : {
			in: {
				duration: 700,
				delay: function(el, index) { return index*50; },
				easing: 'easeOutCirc',
				opacity: 1,
				translateX: function(el, index) {
					return [(50+index*10),0]
				}
			},
			out: {
				duration: 0,
				opacity: 0
			}
		},
		'fx4' : {
			in: {
				duration: 700,
				delay: function(el, index) { return (el.parentNode.children.length-index-1)*80; },
				easing: 'easeOutElastic',
				opacity: 1,
				translateY: function(el, index) {
					return index%2 === 0 ? ['-80%', '0%'] : ['80%', '0%'];
				},
				rotateZ: [90,0]
			},
			out: {
				duration: 500,
				delay: function(el, index) { return (el.parentNode.children.length-index-1)*80; },
				easing: 'easeOutExpo',
				opacity: 0,
				translateY: function(el, index) {
					return index%2 === 0 ? '80%' : '-80%';
				},
				rotateZ: function(el, index) {
					return index%2 === 0 ? -25 : 25;
				}
			}
		},
		'fx5' : {
			perspective: 1000,
			in: {
				duration: 700,
				delay: function(el, index) { return 550+index*50; },
				easing: 'easeOutQuint',
				opacity: {
					value: 1,
					easing: 'linear',
				},
				translateY: ['-150%','0%'],
				rotateY: [180,0]
			},
			out: {
				duration: 700,
				delay: function(el, index) { return index*60; },
				easing: 'easeInQuint',
				opacity: {
					value: 0,
					easing: 'linear',
				},
				translateY: '150%',
				rotateY: -180
			}
		},
		'fx6' : {
			in: {
				duration: 600,
				easing: 'easeOutQuart',
				opacity: 1,
				translateY: function(el, index) {
					return index%2 === 0 ? ['-40%', '0%'] : ['40%', '0%'];
				},
				rotateZ: [10,0]
			},
			out: {
				duration: 0,
				opacity: 0
			}
		},
		'style-4' : {
			in: {
				duration: 250,
				delay: function(el, index) { return 200+index*25; },
				easing: 'easeOutCubic',
				opacity: 1,
				translateY: ['-50%','0%']
			},
			out: {
				duration: 250,
				delay: function(el, index) { return index*25; },
				easing: 'easeOutCubic',
				opacity: 0,
				translateY: '50%'
			}
		},
		'fx8' : {
			in: {
				duration: 400,
				delay: function(el, index) { return 150+(el.parentNode.children.length-index-1)*20; },
				easing: 'easeOutQuad',
				opacity: 1,
				translateY: ['100%','0%']
			},
			out: {
				duration: 400,
				delay: function(el, index) { return (el.parentNode.children.length-index-1)*20; },
				easing: 'easeInOutQuad',
				opacity: 0,
				translateY: '-100%'
			}
		},
		'style-5' : {
			perspective: 1000,
			origin: '50% 100%',
			in: {
				duration: 400,
				delay: function(el, index) { return index*50; },
				easing: 'easeOutSine',
				opacity: 1,
				rotateY: [-90,0]
			},
			out: {
				duration: 200,
				delay: function(el, index) { return index*50; },
				easing: 'easeOutSine',
				opacity: 0,
				rotateY: 45
			}
		},
		'fx10' : {
			in: {
				duration: 1000,
				delay: function(el, index) { return 100+index*30; },
				easing: 'easeOutElastic',
				elasticity: anime.random(400, 700),
				opacity: 1,
				rotateZ: function(el, index) {
					return [anime.random(20,40),0];
				}
			},
			out: {
				duration: 0,
				opacity: 0
			}
		},
		'style-6' : {
			perspective: 1000,
			origin: '50% 100%',
			in: {
				duration: 400,
				delay: function(el, index) { return 200+index*20; },
				easing: 'easeOutExpo',
				opacity: 1,
				rotateY: [-90,0]
			},
			out: {
				duration: 400,
				delay: function(el, index) { return index*20; },
				easing: 'easeOutExpo',
				opacity: 0,
				rotateY: 90
			}
		},
		'fx12' : {
			perspective: 1000,
			origin: '50% 100%',
			in: {
				duration: 400,
				delay: function(el, index) { return 200+index*30; },
				easing: 'easeOutExpo',
				opacity: 1,
				rotateX: [90,0]
			},
			out: {
				duration: 400,
				delay: function(el, index) { return index*30; },
				easing: 'easeOutExpo',
				opacity: 0,
				rotateX: -90
			}
		},
		'fx13' : {
			in: {
				duration: 800,
				easing: 'easeOutExpo',
				opacity: 1,
				translateY: function(el, index) {
					var p = el.parentNode,
						lastElOffW = p.lastElementChild.offsetWidth,
						firstElOffL = p.firstElementChild.offsetLeft,
						w = p.offsetWidth - lastElOffW - firstElOffL - (p.offsetWidth - lastElOffW - p.lastElementChild.offsetLeft),
						tyVal = lineEq(0, 200, firstElOffL + w/2, firstElOffL, el.offsetLeft);

					return [Math.abs(tyVal)+50+'%','0%'];
				},
				rotateZ: function(el, index) {
					var p = el.parentNode,
						lastElOffW = p.lastElementChild.offsetWidth,
						firstElOffL = p.firstElementChild.offsetLeft,
						w = p.offsetWidth - lastElOffW - p.firstElementChild.offsetLeft - (p.offsetWidth - lastElOffW - p.lastElementChild.offsetLeft),
						rz = lineEq(90, -90,firstElOffL + w, firstElOffL, el.offsetLeft);

					return [rz,0];
				}
			},
			out: {
				duration: 500,
				easing: 'easeOutExpo',
				opacity: 0,
				translateY: '-150%'
			}
		},
		'fx14' : {
			in: {
				duration: 500,
				easing: 'easeOutExpo',
				delay: function(el, index) { return 200+index*30; },
				opacity: 1,
				rotateZ: [20,0],
				translateY: function(el, index) {
					var p = el.parentNode,
						lastElOffW = p.lastElementChild.offsetWidth,
						firstElOffL = p.firstElementChild.offsetLeft,
						w = p.offsetWidth - lastElOffW - firstElOffL - (p.offsetWidth - lastElOffW - p.lastElementChild.offsetLeft),
						tyVal = lineEq(-130, -60, firstElOffL+w, firstElOffL, el.offsetLeft);

					return [Math.abs(tyVal)+'%','0%'];
				}
			},
			out: {
				duration: 400,
				easing: 'easeOutExpo',
				delay: function(el, index) { return (el.parentNode.children.length-index-1)*30; },
				opacity: 0,
				rotateZ: 20,
				translateY: function(el, index) {
					var p = el.parentNode,
						lastElOffW = p.lastElementChild.offsetWidth,
						firstElOffL = p.firstElementChild.offsetLeft,
						w = p.offsetWidth - lastElOffW - firstElOffL - (p.offsetWidth - lastElOffW - p.lastElementChild.offsetLeft),
						tyVal = lineEq(-60, -130, firstElOffL+w, firstElOffL, el.offsetLeft);

					return tyVal+'%';
				}
			}
		},
		'style-7' : {
			perspective: 1000,
			in: {
				duration: 400,
				delay: function(el, index) { return 100+index*50; },
				easing: 'easeOutExpo',
				opacity: 1,
				rotateX: [110,0]
			},
			out: {
				duration: 400,
				delay: function(el, index) { return index*50; },
				easing: 'easeOutExpo',
				opacity: 0,
				rotateX: -110
			}
		},
		'fx16' : {
			in: {
				duration: function(el, index) { return anime.random(800,1000) },
				delay: function(el, index) { return anime.random(0,75) },
				easing: 'easeInOutExpo',
				opacity: 1,
				translateY: ['-300%','0%'],
				rotateZ: function(el, index) { return [anime.random(-50,50), 0]; }
			},
			out: {
				duration: function(el, index) { return anime.random(800,1000) },
				delay: function(el, index) { return anime.random(0,80) },
				easing: 'easeInOutExpo',
				opacity: 0,
				translateY: '300%',
				rotateZ: function(el, index) { return anime.random(-50,50); }
			}
		},
		'style-8' : {
			in: {
				duration: 650,
				easing: 'easeOutQuint',
				delay: function(el, index) { return 450+(el.parentNode.children.length-index-1)*30; },
				opacity: 1,
				translateX: function(el, index) {
					return [-1*el.offsetLeft,0];
				}
			},
			out: {
				duration: 1,
				delay: 400,
				opacity: 0
			}
		},
		'fx18' : {
			in: {
				duration: 800,
				delay: function(el, index) { return 600+index*150; },
				easing: 'easeInOutQuint',
				opacity: 1,
				scaleY: [8,1],
				scaleX: [0.5,1],
				translateY: ['-100%','0%']
			},
			out: {
				duration: 800,
				delay: function(el, index) { return index*150; },
				easing: 'easeInQuint',
				opacity: 0,
				scaleY: {
					value: 8,
					delay: function(el, index) { return 100+index*150; },
				},
				scaleX: 0.5,
				translateY: '100%'
			}
		}
	};

	TextFx.prototype._init = function() {
		this.el.classList.add('letter-effect');
		// Split word(s) into letters/spans.
		charming(this.el, {classPrefix: 'letter'});
		this.letters = [].slice.call(this.el.querySelectorAll('span'));
		this.lettersTotal = this.letters.length;
	};
	
	TextFx.prototype._stop = function() {
		anime.remove(this.letters);
		this.letters.forEach(function(letter) { letter.style.WebkitTransform = letter.style.transform = ''; });
	};

	TextFx.prototype.show = function(effect, callback) {
		this._stop();
		arguments.length ? this._animate('in', effect, callback) : this.letters.forEach(function(letter) { letter.style.opacity = 1; });
	};

	TextFx.prototype.hide = function(effect, callback) {
		this._stop();
		arguments.length ? this._animate('out', effect, callback) : this.letters.forEach(function(letter) { letter.style.opacity = 0; });
	};

	TextFx.prototype._animate = function(direction, effect, callback) {
		var effecSettings = typeof effect === 'string' ? this.effects[effect] : effect;
			
		if( effecSettings.perspective != undefined ) {
			this.el.style.WebkitPerspective = this.el.style.perspective = effecSettings.perspective + 'px';
		}
		if( effecSettings.origin != undefined ) {
			this.letters.forEach(function(letter) { 
				letter.style.WebkitTransformOrigin = letter.style.transformOrigin = effecSettings.origin;
			});
		}

		// Custom effect
		var iscustom = this._checkCustomFx(direction, effect, callback);

		var animOpts = effecSettings[direction],
			target = this.letters;
		
		target.forEach(function(t,p) { 
			if( t.innerHTML === ' ' ) {
				target.splice(p, 1);
			}
		});

		animOpts.targets = target;
		
		if( !iscustom ) {
			animOpts.complete = callback;
		}

		anime(animOpts);
	};

	/**
	 * Extra stuff for an effect.. this is just an example for effect 17.
	 * TODO! (for now, just some quick way to implement something different only for 	)
	 */
	TextFx.prototype._checkCustomFx = function(direction, effect, callback) {
		var custom = typeof effect === 'string' && effect === 'style-8' && direction === 'out';
		if( custom ) {
			var tmp = document.createElement('div');
			tmp.style.width = tmp.style.height = '100%';
			tmp.style.top = tmp.style.left = 0;
			tmp.style.background = jQuery(this.el).data('bg-color') ? jQuery(this.el).data('bg-color') : '#e24b1e';
			tmp.style.position = 'absolute';
			tmp.style.WebkitTransform = tmp.style.transform = 'scale3d(0,1,1)';
			tmp.style.WebkitTransformOrigin = tmp.style.transformOrigin = '0% 50%';
			this.el.appendChild(tmp);
			var self = this;
			anime({
				targets: tmp,
				duration: 400,
				easing: 'easeInOutCubic',
				scaleX: [0,1],
				complete: function() {
					tmp.style.WebkitTransformOrigin = tmp.style.transformOrigin = '100% 50%';
					anime({
						targets: tmp,
						duration: 400,
						easing: 'easeInOutCubic',
						scaleX: [1,0],
						complete: function() {
							self.el.removeChild(tmp);
							if( typeof callback === 'function' ) {
								callback();
							}
						}
					});
				}
			});
		}

		return custom;
	};
	window.TextFx = TextFx;
	
})(window);


(function($) {
	"use strict";
	var DFDInitLetterEffect = function() {
		var bodyEl = document.body;

		// Slide obj: each Slideshow´s slide will contain the HTML element and the instance of TextFx.
		var Slide = function(el) {
				this.el = el;
				this.txt = new TextFx(this.el.querySelector('.title'));
			},
			// The Slideshow obj.
			Slideshow = function(el) {
				this.el = el;
				this.current = 0;
				this.slides = [];
				var self = this;
				[].slice.call(this.el.querySelectorAll('.dfd-slide')).forEach(function(slide) {
					self.slides.push(new Slide(slide));
				});
				this.slidesTotal = this.slides.length;
				this.effect = this.el.getAttribute('data-effect');
			};

		Slideshow.prototype._navigate = function(direction) {
			if( this.isAnimating ) {
				return false;
			}
			this.isAnimating = true;

			var self = this, currentSlide = this.slides[this.current];

			this.current = direction === 'next' ? (this.current < this.slidesTotal - 1 ? this.current + 1 : 0) : (this.current = this.current > 0 ? this.current - 1 : this.slidesTotal - 1);
			var nextSlide = this.slides[this.current];

			var checkEndCnt = 0, checkEnd = function() {
				++checkEndCnt;
				if( checkEndCnt === 2 ) {
					currentSlide.el.classList.remove('dfd-slide--current');
					nextSlide.el.classList.add('dfd-slide--current');
					self.isAnimating = false;
				}
			};

			// Call the TextFx hide method and pass the effect string defined in the data-effect attribute of the Slideshow element.
			currentSlide.txt.hide(this.effect, function() {
				currentSlide.el.style.opacity = 0;
				checkEnd();
			});
			// First hide the next slide´s TextFx text.
			nextSlide.txt.hide();
			nextSlide.el.style.opacity = 1;
			// And now call the TextFx show method.
			nextSlide.txt.show(this.effect, function() {
				checkEnd();
			});
		};

		Slideshow.prototype.next = function() { this._navigate('next'); };

		Slideshow.prototype.prev = function() { this._navigate('prev');	};

		function getDecoColor(pos) {
			switch(pos) {
				case 0 : return '#d9d9e0'; break;
				case 2 : return '#171412'; break;
				case 6 : return '#87d6b5'; break;
				case 11 : return '#CBD6CB'; break;
				case 13 : return '#F1D50E'; break;
				case 14 : return '#52CA67'; break;
				default : return '#fff'; break;
			};
		}

		[].slice.call(document.querySelectorAll('.content')).forEach(function(el, pos) {
			var slideshow = new Slideshow(el.querySelector('.dfd-letters-slideshow'));
			setInterval(function() {
				slideshow.next();
			},2000);
			
			if( pos === 0 || pos === 2 || pos === 6 || pos === 11 || pos === 13 || pos === 14 ) {
				var decoColor = getDecoColor(pos);
			}
		});

		// bezier function: https://github.com/arian/cubic-bezier
		function bezier(x1, y1, x2, y2, epsilon) {
			var curveX = function(t){
				var v = 1 - t;
				return 3 * v * v * t * x1 + 3 * v * t * t * x2 + t * t * t;
			};

			var curveY = function(t){
				var v = 1 - t;
				return 3 * v * v * t * y1 + 3 * v * t * t * y2 + t * t * t;
			};

			var derivativeCurveX = function(t){
				var v = 1 - t;
				return 3 * (2 * (t - 1) * t + v * v) * x1 + 3 * (- t * t * t + 2 * v * t) * x2;
			};

			return function(t){

				var x = t, t0, t1, t2, x2, d2, i;

				// First try a few iterations of Newton's method -- normally very fast.
				for (t2 = x, i = 0; i < 8; i++){
					x2 = curveX(t2) - x;
					if (Math.abs(x2) < epsilon) return curveY(t2);
					d2 = derivativeCurveX(t2);
					if (Math.abs(d2) < 1e-6) break;
					t2 = t2 - x2 / d2;
				}

				t0 = 0, t1 = 1, t2 = x;

				if (t2 < t0) return curveY(t0);
				if (t2 > t1) return curveY(t1);

				// Fallback to the bisection method for reliability.
				while (t0 < t1){
					x2 = curveX(t2);
					if (Math.abs(x2 - x) < epsilon) return curveY(t2);
					if (x > x2) t0 = t2;
					else t1 = t2;
					t2 = (t1 - t0) * .5 + t0;
				}

				// Failure
				return curveY(t2);

			};
		};
	};
	$(document).ready(function() {
		DFDInitLetterEffect();
	});
	$('body').on('post-load', function() {
		DFDInitLetterEffect();
	});
})(jQuery);