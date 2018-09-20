(function($) {
	$(window).load(function() {
		$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
	
		if ( !navigator.platform.match(/(Mac|iPhone|iPod|iPad)/i) && $.browser.chrome && $('body').hasClass('dfd-smooth-scroll') ) {
			(function () {
				function init() {
					if (document.body) {
						var a = document.body,
							b = document.documentElement,
							c = window.innerHeight,
							d = a.scrollHeight;
						if (root = 0 <= document.compatMode.indexOf("CSS") ? b : a, activeElement = a, initdone = !0, top != self) frame = !0;
						else if (d > c && (a.offsetHeight <= c || b.offsetHeight <= c)) {
							var e = !1,
								d = function() {
									e || b.scrollHeight == document.height || (e = !0, setTimeout(function() {
										b.style.height = document.height + "px", e = !1
									}, 500))
								};
							b.style.height = "auto", setTimeout(d, 10), addEvent("DOMNodeInserted", d), addEvent("DOMNodeRemoved", d), root.offsetHeight <= c && (c = document.createElement("div"), c.style.clear = "both", a.appendChild(c))
						} - 1 < document.URL.indexOf("mail.google.com") && (c = document.createElement("style"), c.innerHTML = ".iu { visibility: hidden }", (document.getElementsByTagName("head")[0] || b).appendChild(c)), fixedback || disabled || (a.style.backgroundAttachment = "scroll", b.style.backgroundAttachment = "scroll")
					}
				}

				function scrollArray(a, b, c, d) {
					if (d || (d = 1e3), directionCheck(b, c), acceleration) {
						var e = +new Date - lastScroll;
						accelDelta > e && (e = (1 + 30 / e) / 2, e > 1 && (e = Math.min(e, accelMax), b *= e, c *= e)), lastScroll = +new Date
					}
					if (que.push({
							x: b,
							y: c,
							lastX: 0 > b ? .99 : -.99,
							lastY: 0 > c ? .99 : -.99,
							start: +new Date
						}), !pending) {
						if($('body').hasClass('top-inner-page-initializing') || $('#layout').hasClass('one-page-scroll')) {
							return;
						}
						var f = a === document.body,
							g = function() {
								for (var e = +new Date, h = 0, i = 0, j = 0; j < que.length; j++) {
									var k = que[j],
										l = e - k.start,
										m = l >= animtime,
										n = m ? 1 : l / animtime;
									pulseAlgorithm && (n = pulse(n)), l = k.x * n - k.lastX >> 0, n = k.y * n - k.lastY >> 0, h += l, i += n, k.lastX += l, k.lastY += n, m && (que.splice(j, 1), j--)
								}
								f ? window.scrollBy(h, i) : (h && (a.scrollLeft += h), i && (a.scrollTop += i)), b || c || (que = []), que.length ? requestFrame(g, a, d / framerate + 1) : pending = !1
							};
						requestFrame(g, a, 0), pending = !0
					}
				}

				function wheel(a) {
					initdone || init();
					var b = a.target,
						c = overflowingAncestor(b);
					if (!c || a.defaultPrevented || isNodeName(activeElement, "embed") || isNodeName(b, "embed") && /\.pdf/i.test(b.src)) return !0;
					var b = a.wheelDeltaX || 0,
						d = a.wheelDeltaY || 0;
					b || d || (d = a.wheelDelta || 0), 1.2 < Math.abs(b) && (b *= stepsize / 120), 1.2 < Math.abs(d) && (d *= stepsize / 120), scrollArray(c, -b, -d), a.preventDefault()
				}

				function keydown(a) {
					var b = a.target,
						c = a.ctrlKey || a.altKey || a.metaKey || a.shiftKey && a.keyCode !== key.spacebar;
					if (/input|textarea|select|embed/i.test(b.nodeName) || b.isContentEditable || a.defaultPrevented || c || isNodeName(b, "button") && a.keyCode === key.spacebar) return !0;
					var d;
					d = b = 0;
					var c = overflowingAncestor(activeElement),
						e = c.clientHeight;
					switch (c == document.body && (e = window.innerHeight), a.keyCode) {
						case key.up:
							d = -arrowscroll;
							break;
						case key.down:
							d = arrowscroll;
							break;
						case key.spacebar:
							d = a.shiftKey ? 1 : -1, d = .9 * -d * e;
							break;
						case key.pageup:
							d = .9 * -e;
							break;
						case key.pagedown:
							d = .9 * e;
							break;
						case key.home:
							d = -c.scrollTop;
							break;
						case key.end:
							e = c.scrollHeight - c.scrollTop - e, d = e > 0 ? e + 10 : 0;
							break;
						case key.left:
							b = -arrowscroll;
							break;
						case key.right:
							b = arrowscroll;
							break;
						default:
							return !0
					}
					scrollArray(c, b, d), a.preventDefault()
				}

				function mousedown(a) {
					activeElement = a.target
				}

				function setCache(a, b) {
					for (var c = a.length; c--;) cache[uniqueID(a[c])] = b;
					return b
				}

				function overflowingAncestor(a) {
					var b = [],
						c = root.scrollHeight;
					do {
						var d = cache[uniqueID(a)];
						if (d) return setCache(b, d);
						if (b.push(a), c === a.scrollHeight) {
							if (!frame || root.clientHeight + 10 < c) return setCache(b, document.body)
						} else if (a.clientHeight + 10 < a.scrollHeight && (overflow = getComputedStyle(a, "").getPropertyValue("overflow-y"), "scroll" === overflow || "auto" === overflow)) return setCache(b, a)
					} while (a = a.parentNode)
				}

				function addEvent(a, b, c) {
					window.addEventListener(a, b, c || !1)
				}

				function removeEvent(a, b, c) {
					window.removeEventListener(a, b, c || !1)
				}

				function isNodeName(a, b) {
					return (a.nodeName || "").toLowerCase() === b.toLowerCase()
				}

				function directionCheck(a, b) {
					a = a > 0 ? 1 : -1, b = b > 0 ? 1 : -1, (direction.x !== a || direction.y !== b) && (direction.x = a, direction.y = b, que = [], lastScroll = 0)
				}

				function pulse_(a) {
					var b;
					return a *= pulseScale, 1 > a ? b = a - (1 - Math.exp(-a)) : (b = Math.exp(-1), a = 1 - Math.exp(-(a - 1)), b += a * (1 - b)), b * pulseNormalize
				}

				function pulse(a) {
					return a >= 1 ? 1 : 0 >= a ? 0 : (1 == pulseNormalize && (pulseNormalize /= pulse_(1)), pulse_(a))
				}

				var framerate = 150,
					animtime = 800,
					stepsize = 150,
					pulseAlgorithm = true,
					pulseScale = 6,
					pulseNormalize = 1,
					acceleration = !0,
					accelDelta = 20,
					accelMax = 1,
					keyboardsupport = !0,
					disableKeyboard = !1,
					arrowscroll = 50,
					exclude = "",
					disabled = !1,
					frame = !1,
					direction = {
						x: 0,
						y: 0
					},
					initdone = !1,
					fixedback = !0,
					root = document.documentElement,
					activeElement, key = {
						left: 37,
						up: 38,
						right: 39,
						down: 40,
						spacebar: 32,
						pageup: 33,
						pagedown: 34,
						end: 35,
						home: 36
					},
					que = [],
					pending = !1,
					lastScroll = +new Date,
					cache = {};

				setInterval(function() {
					cache = {}
				}, 1e4);

				var uniqueID = function() {
						var a = 0;
						return function(b) {
							return b.uniqueID || (b.uniqueID = a++)
						}
					}(),
					requestFrame = function() {
						return window.requestAnimationFrame || window.webkitRequestAnimationFrame || function(a, b, c) {
							window.setTimeout(a, c || 1e3 / 60)
						}
					}();

				addEvent("mousedown", mousedown), addEvent("mousewheel", wheel), addEvent("load", init);

			})();
		}
	});
	
})(jQuery);