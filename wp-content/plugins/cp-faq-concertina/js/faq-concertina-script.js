jQuery( document ).ready( function( $ ) {
	// Prevent scroll down when spacebar pressed
	$( '.faqconc' ).on( 'keydown', function( e ) {
		if ( e.keyCode === 32 || e.which === 32 ) {
			e.preventDefault();
		}
	} );

	// FAQ entries are shown by default in case JS is disabled; hide them now
	$( '.faq_q' ).attr( 'aria-expanded', 'false' );
	$( '.faq_a' ).prop( 'hidden', true );

	// Get the speed at which answers should open and close
	var speed = parseInt( faqconcvars.speed, 10 );
	// Get whether only one answer can be open at a time
	var hideothers = Boolean( parseInt( faqconcvars.hideothers, 10 ) );

	// Set up show/hide event handler (toggle function)
	$( '.faq_button, .faq_link' ).on( 'click keyup', function( e ) {
		// Ignore keys other than 13 (Enter) and 32 (Space)
		if ( e.type !== 'click' && e.which !== 13 && e.which !== 32 ) {
			return;
		}

		var $this = $( this );
		var $faq_conc = $this.closest( '.faqconc' );
		var $faq_q = $this.closest( '.faq_q' );
		var $faq_a = $faq_q.next( '.faq_a' );

		// Clicks on '#' links get some special handling: ensure the relevant
		// FAQ is expanded and scroll it to the top of the page
		var isLinkClick = $( e.target ).is( '.faq_link' );

		if ( hideothers ) {
			var $toHide = $faq_conc.find( '.faq_a' ).not( $faq_a );
			$toHide.slideUp( speed, function() {
				$toHide.prop( 'hidden', true );
				$faq_conc.find( '.faq_q' ).not( $faq_q )
					.attr( 'aria-expanded', false );
			} );
		}

		if ( hideothers || $faq_a.prop( 'hidden' ) ) {
			// This answer is currently closed; open it.
			$faq_a.slideDown( speed, function() {
				$faq_q.attr( 'aria-expanded', true );
				$faq_a.prop( 'hidden', false );
			} );
		} else if ( ! isLinkClick ) {
			// This answer is currently open; close it.
			$faq_a.slideUp( speed, function() {
				$faq_q.attr( 'aria-expanded', false );
				$faq_a.prop( 'hidden', true );
			} );
		}
	} );

	// Navigate between FAQ items using arrow keys
	$( '.faq_q, .faq_a' ).on( 'keydown', function( e ) {
		var $this = $( this ),
			$faq_q = $this.closest( '.faq_q' ),
			$next_q = null;
		if ( ! $faq_q.length ) {
			$faq_q = $this.closest( '.faq_a' ).prev( '.faq_q' );
		}
		if ( ! $faq_q.length ) {
			return;
		}
		if ( e.which === 39 || e.which === 40 ) {
			// Down or Right arrow pressed
			$next_q = $faq_q.nextAll( '.faq_q:first' );
			if ( ! $next_q.length ) {
				// At bottom; wrap around to top
				$next_q = $this.closest( '.faqconc' ).find( '.faq_q:first' );
			}
		} else if ( e.which === 37 || e.which === 38 ) {
			// Up or Left arrow pressed
			$next_q = $faq_q.prevAll( '.faq_q:first' );
			if ( ! $next_q.length ) {
				// At top; wrap around to bottom
				$next_q = $this.closest( '.faqconc' ).find( '.faq_q:last' );
			}
		} else if ( e.which === 36 ) {
			// Home key pressed
			$next_q = $this.closest( '.faqconc' ).find( '.faq_q:first' );
		} else if ( e.which === 35 ) {
			// End key pressed
			$next_q = $this.closest( '.faqconc' ).find( '.faq_q:last' );
		}

		if ( $next_q && $next_q.length === 1 ) {
			$next_q.find( '.faq_button' ).focus();
			// Scroll the element into view (with some margin, which is not
			// supported by Element#scrollIntoView())
			// Note: Works on this site, but may not work correctly for all
			// pages / DOM structures!
			var qOffsetTop = $next_q.offset().top;
			var qHeight = $next_q.height();
			var scrollTop = document.documentElement.scrollTop;
			var scrollToOffset = null;
			if ( qOffsetTop - 45 < scrollTop ) {
				// Scroll up
				scrollToOffset = qOffsetTop - 45;
			} else if ( qOffsetTop + qHeight + 30 > scrollTop + window.innerHeight ) {
				// Scroll down
				scrollToOffset = qOffsetTop + qHeight + 30 - window.innerHeight;
			}
			if ( scrollToOffset !== null ) {
				document.documentElement.scrollTop = scrollToOffset;
			}
			e.preventDefault();
		}
	} );

	// Expand FAQ item linked in hash fragment, if any
	if ( document.location.hash ) {
		var $linkedItem = $( document.location.hash ),
			$expandButton = null;
		if ( $linkedItem.length !== 1 ) {
			return;
		}
		if ( $linkedItem.is( '.faq_a' ) ) {
			// Note: Better not to link directly to answers, as this scrolls
			// the question out of the viewport
			$expandButton = $linkedItem.prev( '.faq_q' ).find( '.faq_button' );
		} else if ( $linkedItem.is( '.faq_q' ) ) {
			$expandButton = $linkedItem.find( '.faq_button' );
		} else if ( $linkedItem.is( '.faq_button' ) ) {
			$expandButton = $linkedItem;
		}
		if ( $expandButton ) {
			$expandButton.trigger( 'click' );
		}
	}
} );
