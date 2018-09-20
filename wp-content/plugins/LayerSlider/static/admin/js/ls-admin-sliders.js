jQuery(function($) {


	var importModalWindowTimeline = null,
		importModalWindowTransition = null,
		importModalThumbnailsTransition = null;


	// Tabs
	$('.km-tabs').kmTabs();

	// Auto-submit filter/search bar when choosing different view mode
	// from drop-down menus.
	$('#ls-slider-filters').on('change', 'select', function() {
		$(this).closest('#ls-slider-filters').submit();
	});


	$('.ls-sliders-grid').on('contextmenu', '.preview', function( e ) {
		e.preventDefault();
		$(this).parent().find('.slider-actions').click();
	});

	$('.ls-sliders-grid').on('click', '.slider-actions', function() {

		var $this 		= $(this),
			$item 		= $this.closest('.slider-item'),
			$wrapper 	= $item.children(),
			$sheet 		= $item.find('.slider-actions-sheet');

			$item.addClass('ls-opened');
			$sheet.removeClass('ls-hidden');
			$('.ls-hover', $item).hide();
			TweenLite.fromTo($sheet[0], 0.3, { x: 0 }, {
				y: 0
			});
	});

	$('.ls-sliders-grid').on('mouseleave', '.slider-item', function() {

		var $this 		= $(this),
			$item 		= $this.closest('.slider-item'),
			$sheet		= $('.slider-actions-sheet', $item ),
			$options 	= $('.ls-export-options', $item );

			if( $item.hasClass('ls-opened') ) {

				$item.removeClass('ls-opened').removeClass('ls-export-options-open');
				$sheet.removeClass('ls-hidden');
				$('.ls-hover', $item).show();

				TweenLite.to($sheet[0], 0.4, { y: -150 });
				TweenLite.to($options[0], 0.4, {
					y: -150,
					onComplete: function() {
						$options.hide();
					}
				});
			}

	// Add slider
	}).on('click', '#ls-add-slider-button', function(e) {
		e.preventDefault();

		var $button = $(this),
			$wrap 	= $button.closest('.slider-item-wrapper'),
			$sheet 	= $('#ls-add-slider-template');

		if( ! $sheet.length ) {
			$sheet = $( $('#tmpl-ls-add-slider-grid').text() ).appendTo( $wrap );
		}

		$sheet.find('input').focus();
		TweenLite.set( $sheet, { x: 240 });
		TweenLite.to( [ $button[0], $sheet[0] ], 0.5, {
			x: '-=240'
		});

	// Export options
	}).on('click', '.ls-export-options-button', function( e ) {
		e.preventDefault();

		var $item 		= $(this).closest('.slider-item'),
			$sheet 		= $('.slider-actions-sheet', $item),
			$options 	= $('.ls-export-options', $item);


		$item.addClass('ls-export-options-open');
		$options.show();

		TweenLite.fromTo($sheet[0], 0.5, { x: 0 }, { x: -240 });
		TweenLite.fromTo($options[0], 0.5, { x: 240, y: 0 }, { x: 0 });
	});


	$('.ls-sliders-list').on('click', '#ls-add-slider-button', function(e) {
		e.preventDefault();

		var offsets = $(this).offset();
		var popup = $('#ls-add-slider-template-list').length ?
					$('#ls-add-slider-template-list') :
					$( $('#tmpl-ls-add-slider-list').html() ).prependTo('body');

		popup.css({
			top : offsets.top + 35,
			left : offsets.left - popup.outerWidth() / 2 + $(this).width() / 2 + 7
		}).show().animate({ marginTop : 0, opacity : 1 }, 150, function() {
			$(this).find('.inner input').focus();
		});

		$('<div>', { 'class' : 'ls-overlay dim'}).prependTo('body');


	}).on('click', '.slider-actions', function() {

		var $this = $(this);
		setTimeout(function() {
			var offsets = $this.position(),
				height 	= $('#ls-slider-actions-template').removeClass('ls-hidden').show().height();

			$('#ls-slider-actions-template').css({
				top : offsets.top + 15 - height / 2,
				right : 40,
				marginTop : 0,
				opacity : 1
			});

			$('#ls-slider-actions-template a:eq(0)').data('id', $this.data('id') );
			$('#ls-slider-actions-template a:eq(0)').data('slug', $this.data('slug') );

			$('#ls-slider-actions-template a:eq(1)').attr('href', $this.data('export-url') );
			$('#ls-slider-actions-template a:eq(2)').attr('href', $this.data('export-html-url') );
			$('#ls-slider-actions-template a:eq(3)').attr('href', $this.data('duplicate-url') );
			$('#ls-slider-actions-template a:eq(4)').attr('href', $this.data('revisions-url') );
			$('#ls-slider-actions-template a:eq(5)').attr('href', $this.data('remove-url') );


			setTimeout(function() {
				$('body').one('click', function() {
					$('#ls-slider-actions-template').addClass('ls-hidden');
				});
			}, 200);
		}, 100);
	});

	// Slider remove
	$('.ls-slider-list-form').on('click', 'a.remove', function(e) {
		e.preventDefault();
		if(confirm(LS_l10n.SLRemoveSlider)){
			document.location.href = $(this).attr('href');
		}


	// Upload
	}).on('click', '#ls-import-button', function(e) {
		e.preventDefault();
		kmUI.modal.open('#tmpl-upload-sliders', { width: 700, height: 500 });

	// Embed
	}).on('click', 'a.embed', function(e) {
		e.preventDefault();

		var $this 	= $(this),
			$modal 	= kmUI.modal.open('#tmpl-embed-slider', { width: 900, height: 600 }),
			id 		= $this.data('id'),
			slug 	= $this.data('slug') || id;

		$modal.find('input.shortcode').val('[layerslider id="'+slug+'"]');

	// HTML export
	}).on('click', 'a.ls-html-export', function( e ) {

		if( ! window.lsSiteActivation ) {
			e.preventDefault();

			lsDisplayActivationWindow();

			return false;
		}



		if( window.localStorage ) {

			if( ! localStorage.lsExportHTMLWarning ) {
				localStorage.lsExportHTMLWarning = 0;
			}

			var counter = parseInt( localStorage.lsExportHTMLWarning ) || 0;

			if( counter < 3 ) {

				localStorage.lsExportHTMLWarning = ++counter;

				if( ! confirm( LS_l10n.SLExportSliderHTML ) ) {
					e.preventDefault();
					return false;
				}
			}
		}
	});

	// Pagivation
	$('.pagination-links a.disabled').click(function(e) {
		e.preventDefault();
	});


	// Import sample slider
	$( '#ls-import-samples-button' ).on( 'click', function( event ) {

		event.preventDefault();

		var	$modal;

		// If the Template Store was previously opened on the current page,
		// just grab the element, do not bother re-appending and setting
		// up events, etc.

		// Append dark overlay
		if( !jQuery( '#ls-import-modal-overlay' ).length ){
			jQuery( '<div id="ls-import-modal-overlay">' ).appendTo( '#wpwrap' );
		}

		if( jQuery( '#ls-import-modal-window' ).length ){

			$modal = jQuery( '#ls-import-modal-window' );

		// First time open on the current page. Set up the UI and others.
		} else {

			// Append the template & setup the live logo
			$modal = jQuery( jQuery('#tmpl-import-sliders').text() ).hide().prependTo('body');
			lsLogo.append( '#ls-import-modal-window .layerslider-logo', true );

			// Update last store view date
			if( $modal.hasClass('has-updates') ) {
				jQuery.get( window.ajaxurl, { action: 'ls_store_opened' });
			}


			// Setup Shuffle. Use setTimeout to avoid timing issues.
			setTimeout(function(){

				// Init Shuffle
				var	Shuffle = window.shuffle,
					element = jQuery( '#ls-import-modal-window .inner .items' )[0];
					shuffle = new Shuffle(element, {
						itemSelector: '.item',
						speed: 400,
						easing:'ease-in-out',
						delimeter: ','
					}),
					$comingSoon = jQuery( '.coming-soon' );

				// Setup category switcher sidebar.
				jQuery( '#ls-import-modal-window' ).on( 'click', '.inner nav li', function(){

					// Highlight and filter new category
					jQuery(this).addClass('active').siblings().removeClass('active');
					shuffle.filter( jQuery(this).data( 'group' ) );

					// Display the Coming Soon tile if the category
					// has no entries at all.
					var $tiles = jQuery( '.shuffle .shuffle-item--visible' );
					$comingSoon[ $tiles.length ? 'removeClass' : 'addClass' ]('visible');
				});

			}, 100 );

			// Hide all template items temporarily for faster animations
			jQuery( '#ls-import-modal-window .items' ).hide();

			importModalWindowTimeline = new TimelineMax({
				onStart: function(){
					jQuery( '#ls-import-modal-overlay' ).show();
					jQuery( 'html, body' ).addClass( 'ls-no-overflow' );
					jQuery(document).on( 'keyup.LS', function( e ) {
						if( e.keyCode === 27 ){
							jQuery( '#ls-import-samples-button' ).data( 'lsModalTimeline' ).reverse().timeScale(1.5);
						}
					});
				},
				onComplete: function(){
					if( importModalWindowTimeline ) {
						importModalWindowTimeline.remove( importModalThumbnailsTransition );
					}
				},
				onReverseComplete: function(){
					jQuery( 'html, body' ).removeClass( 'ls-no-overflow' );
					jQuery(document).off( 'keyup.LS' );
					jQuery( '#ls-import-modal-overlay' ).hide();
					TweenMax.set( jQuery( '#ls-import-modal-window' )[0], { css: { y: -100000 } });
				},
				paused: true
			});

			$(this).data( 'lsModalTimeline', importModalWindowTimeline );

			importModalWindowTimeline.fromTo( $('#ls-import-modal-overlay')[0], 0.75, {
				autoCSS: false,
				css: {
					opacity: 0
				}
			},{
				autoCSS: false,
				css: {
					opacity: 0.75
				},
				ease: Quart.easeInOut
			}, 0 );

			importModalThumbnailsTransition = TweenMax.fromTo( $( '#ls-import-modal-window .items' )[0], 0.5, {
				autoCSS: false,
				css: {
					opacity: 0,
					display: 'block'
				}
			},{
				autoCSS: false,
				css: {
					opacity: 1
				},
			ease: Quart.easeInOut
			});

			importModalWindowTimeline.add( importModalThumbnailsTransition, 0.75 );

			importModalWindowTimeline.add( function(){
				shuffle.update();
			}, 0.25 );
		}

		importModalWindowTimeline.remove( importModalWindowTransition );

		importModalWindowTransition = TweenMax.fromTo( $modal[0], 0.75, {
			autoCSS: false,
			css: {
				position: 'fixed',
				display: 'block',
				y: 0,
				x: jQuery( window ).width()
			}
		},{
			autoCSS: false,
			css: {
				x: 0
			},
			ease: Quart.easeInOut
		}, 0 );

		importModalWindowTimeline.add( importModalWindowTransition, 0 );

		importModalWindowTimeline.play();
	});

	$( document ).on( 'click', '#ls-import-modal-window > header b', function(){
		$( '#ls-import-samples-button' ).data( 'lsModalTimeline' ).reverse();
	});

	// Close add slider window
	$(document).on( 'click', '.ls-overlay', function() {

		if($(this).data('manualclose')) {
			return false;
		}

		if($('.ls-pointer').length) {
			$('.ls-overlay').remove();
			$('.ls-pointer').animate({ marginTop : 40, opacity : 0 }, 150);
		}

	// Upload window
	}).on('submit', '#ls-upload-modal-window form', function(e) {

		jQuery('.button', this).text(LS_l10n.SLUploadSlider).addClass('saving');

	}).on('click', '.ls-open-template-store', function(e) {

		e.preventDefault();

		kmUI.modal.close();
		kmUI.overlay.close();

		setTimeout(function() {
			$('#ls-import-samples-button').click();
		}, $(this).data('delay') || 0);
	});

	// Auto-update setup screen
	$('.button-activation').click(function(e) {
		e.preventDefault();

		var $wrapper 	= $(this).closest('.ls-box'),
			$guide 		= $wrapper.find('.guide'),
			$form 		= $wrapper.find('form'),
			width 		= $wrapper.outerWidth(true) + 10;

		$form.show().find('.key input').focus();

		TweenLite.set( $form, { x: width });
		TweenLite.to( [ $guide[0], $form[0] ], 0.5, {
			x: '-='+width,
			onComplete: function() {
				$guide.hide();
				$wrapper.addClass('ls-opened');
			}
		});
	});

	// Auto-update authorization
	$('.ls-auto-update form').submit(function(e) {

		// Prevent browser default submission
		e.preventDefault();

		var $form 	= $(this),
			$key 	= $form.find('.key input'),
			$button = $form.find('.button-save:visible');

		if( $key.val().length < 10 ) {
			alert(LS_l10n.SLEnterCode);
			return false;
		}

		// Send request and provide feedback message
		$button.data('text', $button.text() ).text(LS_l10n.working).addClass('saving');

		// Post it
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: $(this).serialize(),
			error: function( jqXHR, textStatus, errorThrown ) {
				alert(LS_l10n.SLActivationError.replace('%s', errorThrown) );
				$button.removeClass('saving').text( $button.data('text') );
			},
			success: function( data ) {

				// Parse response and set message
				data = $.parseJSON(data);

				// Success
				if(data && ! data.errCode ) {

					// Apply activated state to GUI
					$form.closest('.ls-box').addClass('active');

					// Display activation message
					$('p.note', $form).css('color', '#74bf48').text( data.message );

					// Make sure that features requiring activation will
					// work without refreshing the page.
					window.lsSiteActivation = true;

				// Alert message (if any)
				} else if(typeof data.message !== "undefined") {
					alert(data.message);
				}

				$button.removeClass('saving').text( $button.data('text') );
			}
		});
	});


	// Auto-update deauthorization
	$('.ls-auto-update a.ls-deauthorize').click(function(event) {
		event.preventDefault();

		if( confirm(LS_l10n.SLDeactivate) ) {

			var $form = $(this).closest('form');

			$.get( ajaxurl, $.param({ action: 'layerslider_deauthorize_site'}), function(data) {

				// Parse response and set message
				var data = $.parseJSON(data);

				if( data && ! data.errCode ) {

					var $box 	= $form.closest('.ls-box'),
						$guide 	= $box.find('.guide'),
						$notice = $form.find('p.note');

					$notice.css('color', '#666').text('');

					$form.find('.key input').val('');
					$box.removeClass('active');

					$form.hide();
					$guide.css('transform', 'translateX(0px)').show();

					window.lsSiteActivation = false;
				}

				// Alert message (if any)
				if(typeof data.message !== "undefined") {
					alert(data.message);
				}
			});
		}
	});

	var lsShowActivationBox = function( activateBox ) {

		document.location.hash = '';

		kmUI.overlay.close();
		kmUI.modal.close();

		var $box 	= $('.ls-product-banner.ls-auto-update'),
			$window = $(window),
			wh 		= $window.height(),
			bt 		= $box.offset().top,
			bh 		= $box.height(),
			top 	= bt + (bh / 2) - (wh / 2);

		$('html,body').animate({ scrollTop: top }, 500, function() {
			setTimeout(function() {

				TweenMax.to( $box[0], 0.2, {
					yoyo: true,
					repeat: 3,
					ease: Quad.easeInOut,
					scale: 1.1,
					onComplete: function() {

						if( activateBox && ! $box.hasClass('ls-opened') ) {
							setTimeout(function() {
								$box.find('.button-activation').click();
							}, 300 );
						}
					}
				});
			}, 200);
		});
	};

	$('.ls-product-banner .unlock, .ls-show-activation-box').click(function(e) {
		e.preventDefault();
		lsShowActivationBox();
	});

	$( document ).on('click', '#tmpl-activation-modal-window .button-activation', function( e ) {

		e.preventDefault();

		if( $(this).closest('#ls-import-modal-window').length ) {

			jQuery(document).trigger( jQuery.Event('keyup', { keyCode: 27 }) );
			setTimeout(function() {
				lsShowActivationBox( true );
			}, 800);

		} else {

			kmUI.overlay.close();
			kmUI.modal.close( function() {
				lsShowActivationBox( true );
			});
		}
	});

	if( document.location.href.indexOf('#activationBox') !== -1 ) {
		setTimeout(function() {
			lsShowActivationBox( true );
		}, 500 );
	}



	// News filters
	$('.ls-news .filters li').click(function() {

		// Highlight
		$(this).siblings().attr('class', '');
		$(this).attr('class', 'active');

		// Get stuff
		var page = $(this).data('page');
		var frame = $(this).closest('.ls-box').find('iframe');
		var baseUrl = frame.attr('src').split('#')[0];

		// Set filter
		frame.attr('src', baseUrl+'#'+page);

	});


	// Shortcode
	$('input.ls-shortcode').click(function() {
		this.focus();
		this.select();
	});

	// Importing demo sliders
	$( document ).on('click', '#ls-import-modal-window .item-import', function( event ) {
		event.preventDefault();

		var $item 	= jQuery(this),
			$figure = $item.closest('figure'),
			handle 	= $figure.data('handle'),
			bundled = !! $figure.data('bundled'),
			action 	= bundled ? 'ls_import_bundled' : 'ls_import_online';

		// Premium notice
		if( $figure.data('premium') && ! window.lsSiteActivation ) {

			lsDisplayActivationWindow({
				into: '#ls-import-modal-window',
				title: LS_l10n.activationTemplate
			});

			return;

		} else if( $figure.data('version-warning') ) {
			kmUI.modal.open({
				into: '#ls-import-modal-window',
				title: LS_l10n.TSVersionWarningTitle,
				content: LS_l10n.TSVersionWarningContent,
				width: 700,
				height: 200,
				overlayAnimate: 'fade'
			});
			return;
		}

		kmUI.modal.open( '#tmpl-importing', {
			into: '#ls-import-modal-window',
			width: 300,
			height: 300,
			close: false
		});
		lsLogo.append( '#ls-importing-modal-window .layerslider-logo', true );

		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: action,
				slider: handle,
				security: window.lsImportNonce
			},

			beforeSend: function( jqXHR, settings ) {

				setTimeout( function( ) {

					var $modal = jQuery('#ls-import-modal-window .km-ui-modal-window');

					TweenLite.to( $modal[0], 1, {
						width: 500,
						height: 400,
						marginLeft: -290,
						marginTop: -240,

						onComplete: function() {
							$('<div class="ls-import-notice">'+LS_l10n.SLImportNotice+'</div>')
							.hide()
							.appendTo( $modal )
							.fadeIn( 500 );
						}
					});
				}, 1000*60 );
			},

			success: function(data, textStatus, jqXHR) {

				data = data ? JSON.parse( data ) : {};

				if( data.success ) {
					document.location.href = data.url;

				} else {

					setTimeout(function() {
						alert( data.message ? data.message : LS_l10n.SLImportError);
						setTimeout(function() {
							kmUI.modal.close();
							kmUI.overlay.close();
						}, 1000);
					}, 600);

					if( data.reload ) {
						window.location.reload( true );
					}
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				setTimeout(function() {
					kmUI.modal.close();
							kmUI.overlay.close();
					alert(LS_l10n.SLImportHTTPError.replace('%s', errorThrown) );
					setTimeout(function() {
						kmUI.modal.close();
						kmUI.overlay.close();
					}, 1000);
				}, 600);
			},
			complete: function() {
				$item.css('color', '#0073aa');
			}
		});
	});

	if( document.location.hash === '#open-template-store' ) {
		setTimeout( function() {
			$('#ls-import-samples-button').click();
		}, 500);
	}


	$('.layerslider_notice_img .button-install').click(function( e ) {

		if( ! window.lsSiteActivation ) {
			e.preventDefault();
			lsDisplayActivationWindow({
				title: LS_l10n.activationUpdate
			});
		}
	});

	if( ! window.lsGDPRConsent ) {

		setTimeout(function() {
			lsDisplayGDPRConsent();
		}, 500 );
	}

});


var lsDisplayGDPRConsent = function() {

	// Init & step 1
	kmUI.modal.open({
		into: 'body',
		title: '',
		content: $('#tmpl-ls-gdpr-consent').text(),
		width: 700,
		height: 700,
		close: false,
		overlayAnimate: 'fade'
	});

	var $modalWindow 	= $('._tmpl-gdpr-modal-window'),
		$modalH1 		= $('header h1', $modalWindow),
		$nextButton 	= $('.button-next', $modalWindow);

	$modalWindow.find(':checkbox').customCheckbox();
	$modalH1.text( $('#ls-gdpr-step-1 h1').text() );


	// Step 2
	$nextButton.one('click', function() {


		$modalH1.fadeOut(500, function() {
			$modalH1.text( $('#ls-gdpr-step-2 h1').text() ).fadeIn(500);
		});

		$('#ls-gdpr-step-1').css('transform', 'translateX(-740px)');
		$('#ls-gdpr-step-2').css('transform', 'translateX(0px)');
		$('#ls-gdpr-step-3').css('transform', 'translateX(740px)');
		$('#ls-gdpr-step-4').css('transform', 'translateX(1480px)');

		// Step 3
		$nextButton.off().one('click', function() {

			$modalH1.fadeOut(500, function() {
				$modalH1.text( $('#ls-gdpr-step-3 h1').text() );
			}).fadeIn(500);

			$('#ls-gdpr-step-1').css('transform', 'translateX(-1480px)');
			$('#ls-gdpr-step-2').css('transform', 'translateX(-740px)');
			$('#ls-gdpr-step-3').css('transform', 'translateX(0px)');
			$('#ls-gdpr-step-4').css('transform', 'translateX(740px)');


			// Step 4
			$nextButton.off().one('click', function() {

				$modalH1.fadeOut(500, function() {
					$modalH1.text( $('#ls-gdpr-step-4 h1').text() );
				}).fadeIn(500);

				$('#ls-gdpr-step-1').css('transform', 'translateX(-2220px)');
				$('#ls-gdpr-step-2').css('transform', 'translateX(-1480px)');
				$('#ls-gdpr-step-3').css('transform', 'translateX(-740px)');
				$('#ls-gdpr-step-4').css('transform', 'translateX(0px)');

				// Do ajax

				$nextButton.one('click', function() {

					kmUI.modal.close();
					kmUI.overlay.close();

					$.post( ajaxurl, $('#tmpl-gdpr-modal-window form').serialize() );
				});
			});
		});
	});
};

var addLSOverlay = function() {

	var $overlay = jQuery('<div class="ls-overlay"></div>').prependTo('body');

	TweenLite.fromTo( $overlay[0], 0.4, {
		autoCSS: false,
		css: {
			y: -jQuery( window ).height()
		}
	},{
		autoCSS: false,
		ease: Quart.easeInOut,
		css: {
			y: 0
		}
	});

	setTimeout(function() {

		jQuery( '.ls-overlay' ).one( 'click', function() {

			// TweenLite.fromTo( this, 0.4, {
			// 	autoCSS: false,
			// 	css: {
			// 		y: 0
			// 	}
			// },{
			// 	autoCSS: false,
			// 	ease: Quart.easeInOut,
			// 	css: {
			// 		y: -jQuery( window ).height()
			// 	},
			// 	onComplete: function(){
			// 		jQuery('.ls-overlay,.ls-modal').remove();
			// 		jQuery('body').css('overflow', 'auto');
			// 	}
			// });

			jQuery('.ls-overlay,.ls-modal').remove();
			jQuery('body').css('overflow', 'auto');
		});

		jQuery( '.ls-modal b' ).one( 'click', function() {
			jQuery( '.ls-overlay' ).click();
		});

	}, 300);
};
