(function($) {
	$(document).ready(function() {
		var $carousel = $('.dfd-gallery-carousel'),
			$navBar = $carousel.siblings('.dfd-gallery-thumbnails'),
			slidesToShow = 1,
			autoSlideshow = $carousel.data('autoplay'),
			slideshowSpeed = $carousel.data('slideshow-speed');
		
		if(!slidesToShow) {
			slidesToShow = 1;
		}
		if(!slideshowSpeed) {
			slideshowSpeed = 3000;
		}
		console.log(autoSlideshow);
		$carousel.slick({
			infinite: true,
			slidesToShow: slidesToShow,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			autoplay: autoSlideshow,
			autoplaySpeed: slideshowSpeed,
			asNavFor: $navBar
		});
		$navBar.slick({
			infinite: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			speed: 600,
			centerMode: true,
			asNavFor: $carousel,
			arrows: false,
			focusOnSelect: true,
			dots: false,
			responsive: [
			{
				breakpoint: 1280,
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
					slidesToShow: 1,
					arrows: false,
					dots: false
				}
			}
		]
		});
	});
})(jQuery);