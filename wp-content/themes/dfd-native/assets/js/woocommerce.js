var add_to_cart_button;

(function($){
	"use strict";
	
	/* Plus-minus buttons customization */
	var initArrows = function() {
		$('.single_add_to_cart_button_wrap .quantity, .shop_table .quantity').each(function(){
			var $inputNumber, min, max, $self = $(this);
			if($self.length > 0) {
				$self.prepend('<i class="dfd-socicon-minus-symbol minus">').append('<i class="dfd-socicon-plus-black-symbol plus">');
				$self.find('.minus').on('click', function() {
					$inputNumber = $(this).siblings('.qty');
					min = $inputNumber.attr('min') ? $inputNumber.attr('min') : 1;
					max = $inputNumber.attr('max');
					var beforeVal = +$inputNumber.val();
					var newVal = (beforeVal > min || !min) ? +beforeVal - 1 : min;
					$inputNumber.val(newVal).trigger('change');
					$(this).parent().siblings('.single_add_to_cart_button').attr('data-quantity', newVal);
				});
				$self.find('.plus').on('click', function() {
					$inputNumber = $(this).siblings('.qty');
					min = $inputNumber.attr('min') ? $inputNumber.attr('min') : 1;
					max = $inputNumber.attr('max');
					var beforeVal = +$inputNumber.val();
					var newVal = (beforeVal < max || !max) ? +beforeVal + 1 : max;
					$inputNumber.val(newVal).trigger('change');
					$(this).parent().siblings('.single_add_to_cart_button').attr('data-quantity', newVal);
				});
			}
			$self.find('.qty').on('input propertychange',function() {
				$('.single_add_to_cart_button').attr('data-quantity', $(this).val());
			});
		});
	},
	wooInitDropkick = function() {
		if($('body').hasClass('single-product')) {
			if ($('.ul-dropdown-toggle').length>0)
				$('.ul-dropdown-toggle').dropkick({mobile: true});
			if ($('.variations .value select').length>0)
				$('.variations .value select').dropkick({mobile: true});
		}
		if($('body.woocommerce-cart .cart-wrap .shipping select').length > 0)
			$('body.woocommerce-cart .cart-wrap .shipping select').dropkick();
	},
	initProductsListCarousel = function() {
		$('.dfd-woo-category-wrap.swiper-container').each(function() {
			var $self = $(this),
				slides = $self.data('slides') ? $self.data('slides') : 3;
				
			var swiper = new Swiper($self, {
				pagination: '.dfd-slick-dots',
				bulletClass: 'slick-dot',
				bulletActiveClass: 'slick-active',
				paginationElement: 'li',
				slidesPerView: slides,
				paginationClickable: true,
				speed: 800,
				spaceBetween: 0,
				mousewheelControl: false,
				paginationBulletRender: function(s, i, c) {
					return '<li class="'+c+'"><span></span></li>';
				},
				onImagesReady: function(swiper) {
				},
				onSlideChangeStart: function (swiper) {
					$('body').trigger('reinit-waypoint');
				},
				onSlideChangeEnd: function(swiper) {
				}
			});
		});
	};

	$(document).ready(function(){
		initProductsListCarousel();
		$('body').on('post-load', initProductsListCarousel);
		$('.woocommerce-page #reviews #comments ol.commentlist li').each(function(){
			var $self = $(this),
				$title = $self.find('.comment_container .comment-text .meta strong').clone(),
				$meta = $self.find('.comment_container .comment-text .meta time').clone();
				
			$self.find('.comment_container .comment-text .meta').text('').append($title).append($meta);
		});
		if(!$('html').hasClass('dfd-ie-detected')) {
			wooInitDropkick();
			$('body').on('post-load', wooInitDropkick);
			
			$('body').on('post-load', function() {
				if ($('.variations .value select').length>0)
					$('.variations .value select').dropkick('refresh');
			});

			$('.variations_form').on('click touchend', '.reset_variations', function(e) {
				$('table.variations select').dropkick('reset', true);
			});
			
			$('.variations_form').on('check_variations update_variation_values hide_variation show_variation reload_product_variations', function(e) {
				$('.variations .value select').dropkick('refresh');
			});
			
			if ($('.woocommerce-ordering').find('select').length > 0) {
				$('.woocommerce-ordering').find('select').dropkick({mobile: true});
			}
		}
		initArrows();
		if($('body').hasClass('woocommerce-checkout')) {
			if($('.dfd-content-wrap > .woocommerce > form.login').length > 0) {
				$('.dfd-content-wrap > .woocommerce > form.login').prev('.woocommerce-info').andSelf().wrapAll('<div class="dfd-login-wrap" />')
			}
			if($('.dfd-content-wrap > .woocommerce > form.checkout_coupon').length > 0) {
				$('.dfd-content-wrap > .woocommerce > form.checkout_coupon').prev('.woocommerce-info').andSelf().wrapAll('<div class="dfd-coupon-wrap" />')
			}
			if($('.dfd-content-wrap > .woocommerce > form.woocommerce-checkout').length > 0) {
				$('form.woocommerce-checkout').before('<div class="clear" />');
			}
		}
		
		$('.dfd-single-product-thumbs-carousel').each(function() {
			var $self = $(this),
				num = $self.data('slides') && $self.data('slides') != '' ? $self.data('slides') : 4,
				ver = false,
				responsive_point_one = (num > 1) ? num - 1 : 1,
				responsive_point_two = (responsive_point_one > 1) ? responsive_point_one - 1 : 1;
			
			if($self.data('vertical') && $self.data('vertical') == '1') {
				ver = true;
			}
			
			$self.slick({
				infinite: true,
				slidesToShow: num,
				slidesToScroll: 1,
				arrows: false,
				dots: false,
				autoplay: false,
				autoplaySpeed: 2000,
				vertical: ver,
				focusOnSelect: true,
				responsive: [
					{
						breakpoint: 800,
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
						breakpoint: 500,
						settings: {
							slidesToShow: responsive_point_two,
							slidesToScroll: 1,
							arrows: false,
							dots: false,
							vertical: false
						}
					}
				]
			});
			
			$self.find('.single-product-thumbnail a').each(function() {
					var $this = $(this);
					$this.click(function(e) {
						e.preventDefault();
						var url = $this.attr('href');
						$this.parent().parents('.images').find('.single-product-image img.dfd-woo-main-image').attr('src', url).removeAttr('srcset');
					});
				});
		});
	});
	
	$(document.body).on('updated_wc_div cart_page_refreshed',function() {
		initArrows();
		$( document ).trigger('change input');
	});
	
	var products_li_eq_height = function() {
		jQuery('.products').each(function() {
			$(this).find('.product').equalHeights();
		});
	};
	$(document).ready(products_li_eq_height);
	$(window).on('load resize', products_li_eq_height);
	$('body').on('post-load', products_li_eq_height);
	
})(jQuery);
