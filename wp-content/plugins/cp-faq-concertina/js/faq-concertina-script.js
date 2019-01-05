jQuery(document).ready(function($) {

	// Make first FAQ tabbable
	$('.faqconc').find('.faq_q:first').attr('tabindex','0');

	// Get the category 
	var category = faqconcvars.category; 
	if (category) { category = '_'+category}

	// Prevent scroll down when spacebar pressed
	document.getElementById('faqconc_1_4_3'+category).addEventListener('keydown', function(e) {
		if ( (e.keycode || e.which) == 32) {
			e.preventDefault();
		}
	}, false);

	// Toggle Function
	$('.faq_item').on('click keyup', function(e) {

		if (e.type == "click" || e.which == 13 || e.which == 32) {

			var speed = parseInt( faqconcvars.speed, 10 ); // get the speed which answers should open and close

			if ( parseInt( faqconcvars.hideothers, 10) ) { // if hideothers set, i.e. only one answer can be open at a time

				if ( $('#'+$(this).attr("id")+'_q').hasClass("faq_is_open") ) { // if this answer is already open

					$('#'+$(this).attr("id")+'_a').slideUp(speed).attr('aria-hidden','true'); // hide this answer
					$('#'+$(this).attr("id")+'_q').removeClass("faq_is_open").attr('aria-expanded','false'); // set show/hide indicator to 'show' on this question

				} else { // if this answer is currently closed

					$('.faq_a').slideUp(speed).attr('aria-hidden','true'); // hide all answers
					$('.faq_q').removeClass("faq_is_open").attr('aria-expanded','false'); // set show/hide indicators to 'show' on all questions
					$('#'+$(this).attr("id")+'_a').slideDown(speed).attr('aria-hidden','false'); // show this answer
					$('#'+$(this).attr("id")+'_q').addClass("faq_is_open").attr('aria-expanded','true'); // set show/hide indicator to 'hide' on this question

				}

			} else { // if hideothers not set	

				$('#'+$(this).attr("id")+'_a').slideToggle(speed); // toggle visibility of current answer
				$('#'+$(this).attr("id")+'_q').toggleClass("faq_is_open"); // toggle show/hide indicator of current question
				
				var ans = $('#'+$(this).attr("id")+'_q').next('.faq_a');
				
				if ( $('#'+$(this).attr("id")+'_q').hasClass("faq_is_open") ) {
					 $('#'+$(this).attr("id")+'_q').attr('aria-expanded','true');
					 $(ans).attr('aria-hidden','false');
				}
				else if ( !$('#'+$(this).attr("id")+'_q').hasClass("faq_is_open") ) {
					 $('#'+$(this).attr("id")+'_q').attr('aria-expanded','false');
					 $(ans).attr('aria-hidden','true');
				}					 

			}

			if ($(this).not('.faq_q')) {
				$(e.target).closest('.faq_item').children('.faq_q:first').focus().attr('tabindex','0'); // restore focus to question when leaving answer
			}

		}

	});

	//	Navigate between questions using arrow keys
	$('.faq_q').on('keyup', function(e) {

		if (e.which == 39 || e.which == 40) { // 'down' or 'right' arrow pressed
			if ($(this).parent('.faq_item').is('.faq_item:last')) {
				$(this).attr('tabindex','-1'); // set this faq_q tabindex to -1
				$(this).parent('.faq_item').siblings().first().children('.faq_q').focus().attr('tabindex','0'); // set receiving faq_q tabindex to 0
			} else {	
				$(this).attr('tabindex','-1'); // set this faq_q tabindex to -1
				$(this).parent('.faq_item').next().children('.faq_q').focus().attr('tabindex','0'); // set receiving faq_q tabindex to 0
			}
        }

        if (e.which == 37 || e.which == 38) { // 'up' or 'left' arrow pressed
			if ($(this).parent('.faq_item').is('.faq_item:first')) {	
				$(this).attr('tabindex','-1'); // set this faq_q tabindex to -1
				$(this).parent('.faq_item').siblings().last().children('.faq_q').focus().attr('tabindex','0'); // set receiving faq_q tabindex to 0
			} else {
				$(this).attr('tabindex','-1'); // set this faq_q tabindex to -1
				$(this).parent('.faq_item').prev().children('.faq_q').focus().attr('tabindex','0'); // set receiving faq_q tabindex to 0
			}
		}

	});
	
});
