;(function ($, window, undefined) {
    'use strict';
	
	$.fn.slideParallax = function() {
		return this.each(function() {
			var $container = $(this),
				direction = $container.parents('.dfd-slide-parallax-wrap').data('direction') ? $container.parents('.dfd-slide-parallax-wrap').data('direction') : 'horizontal',
				$handler = $container.find('.handler'),
				$pointer = $handler.find('.pointer'),
				$imageLeft = $container.find('.image-left img'),
				$imageRight = $container.find('.image-right img'),
				$imageContainers = $container.find('.image-left, .image-right'),
				size =  {
					width: null,
					height: null,
					pointer_height: null,
				},
				_offset_x = 0.5,
				_offset_y = 0.5,

				init = function(o) {
					init_sizes();
					bind();

					$(window)
						.on("load resize", function(){
							init_sizes();
							reinit_offset_x();
							reinit_offset_y();
						});
				},

				init_sizes = function() {
					resetSizes();
					getSizes();
					setSizes();
				},

				resetSizes = function() {
					// Reset styles to auto
					$container
						.find('.image-left img, .image-right img')
						.andSelf()
							.css({
								'width': 'auto',
								'height': 'auto'
							});

				},

				getSizes = function() {
					size.pointer_height = $pointer.height();

					var container_w = $container.width();
					var left_image_w = $imageLeft.width();
					var left_image_h = $imageLeft.height();

					var right_image_w = $imageRight.width();
					var right_image_h = $imageRight.height();

					size.width = Math.min(left_image_w, right_image_w, container_w);

					var new_left_image_h = Math.floor(size.width*left_image_h / left_image_w);
					var new_right_image_h = Math.floor(size.width*right_image_h / right_image_w);

					size.height = Math.min(new_left_image_h, new_right_image_h);
				},

				setSizes = function() {
					$container.find('.image-wrap > img')
							.css({
								display: 'block',
								position: 'absolute',
							})
						.andSelf()
							.css({
								width: size.width,
								height: size.height
							});

					var half_width = Math.round(size.width / 2);
					var half_height = Math.round(size.height / 2);
					
					if(direction == 'vertical') {
						$imageContainers.css({
							width: size.width,
							height: half_height
						});
					} else {
						$imageContainers.css({
							width: half_width,
							height: size.height
						});
					}

				},

				bind = function() {

					$container.on('mousedown touchstart',function(e) {
						e.preventDefault();

						$(this).bind('mousemove touchmove', function(e) {
							update_position(e);
						});
					});

					$container.on('mouseup touchend',function(e) {
						$(this).unbind('mousemove touchmove');
					});
				},

				update_position = function(e) {
					var vector = _cursor_position(e);

					_update_offset_y(vector.y);
					_update_offset_x(vector.x);
				},
				_update_offset_y = function(y) {
					if(direction == 'vertical') {
						$handler.css('top', y);
						$imageLeft.parent().css('height', y);
						$imageRight.parent().css('height', size.height - y);
					} else {
						$pointer.css('top', y);
					}
					
					_offset_y = y / size.height;
				},
				_update_offset_x = function(x) {
					if(direction == 'vertical') {
						$pointer.css('left', x);
					} else {
						$handler.css('left', x);
						$imageLeft.parent().css('width', x);
						$imageRight.parent().css('width', size.width - x);
					}

					_offset_x = x / size.width;
				},

				reinit_offset_x = function() {			
					_update_offset_x(Math.floor(_offset_x * size.width));
				},

				reinit_offset_y = function() {			
					_update_offset_y(Math.floor(_offset_y * size.height));
				},

				_cursor_position = function(e) {
					var vector = {x: null, y: null};
					var event;

					if (e.type == 'touchmove') {
						e.stopImmediatePropagation();
						event = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
					} else {
						event = e;
					}

					var offset = $container.offset(),
						containerHeight = $container.height();

					vector.x = event.pageX - offset.left;
					vector.y = event.pageY - offset.top;

					var setY = null;
					var minY = 0;
					var maxY = containerHeight;

					if ( (vector.y > minY) && (vector.y < maxY) ) {
						setY = vector.y;
					} else if (vector.y <= minY) {
						setY = minY;
					} else if (vector.y >= maxY) {
						setY = maxY;
					}

					var setX = null;
					var minX = parseInt($handler.width() / 2) + 1;
					
					var maxX = $container.width() - parseInt($handler.width() / 2);
					
					if(direction == 'vertical') {
						minX = 0;
						maxX = $container.width();
					}

					if (vector.x > minX && vector.x < maxX) {
						setX = vector.x;
					} else if (vector.x <= minX) {
						setX = minX;
					} else if (vector.x >= maxX) {
						setX = maxX;
					}

					return {x: setX, y: setY};			
				};
			
			init();
		});
	};
})(jQuery, window);
