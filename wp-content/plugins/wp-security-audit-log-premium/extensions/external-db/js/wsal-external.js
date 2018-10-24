jQuery(document).ready(function(){
	var meta_index = 0;
	var occurrence_index = 0;
	var time = '01:00';

	if (jQuery('#archiving-time').val() != "") {
		time = jQuery('#archiving-time').val()
	}

	jQuery('#wsal-time').timeEntry({
		spinnerImage: '',
		show24Hours: is_24_hours
	}).timeEntry('setTime', time);

	// tab handling code
	jQuery('#wsal-tabs>a').click(function(){
		jQuery('#wsal-tabs>a').removeClass('nav-tab-active');
		jQuery('table.wsal-tab').hide();
		jQuery(jQuery(this).addClass('nav-tab-active').attr('href')).show();
	});
	// show relevant tab
	var hashlink = jQuery('#wsal-tabs>a[href="' + location.hash + '"]');
	if (hashlink.length) {
		hashlink.click();
	} else {
		jQuery('#wsal-tabs>a:first').click();
	}

	jQuery('#wsal-migrate').click(function() {
		var button = this;
		jQuery(button).addClass('disabled');
		jQuery(button).val('Migrating, Please Wait..');
		jQuery('#ajax-response').removeClass("hidden");

		MigrateMeta();
	});

	jQuery('#wsal-migrate-back').click(function() {
		var button = this;
		jQuery(button).addClass('disabled');
		jQuery(button).val('Migrating, Please Wait..');
		jQuery('#ajax-response').removeClass("hidden");

		MigrateBackMeta();
	});

	function MigrateMeta() {
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			async: true,
			dataType: 'json',
			data: {
				action: 'MigrateMeta',
				index: meta_index
			},
			success: function(response) {
				if (typeof response['empty'] != "undefined") {
					jQuery('#ajax-response').addClass("hidden");
					msg = "No alerts to import";
					alert(msg);
					return;
				}
				meta_index = response['index'];
				if (!response['complete']) {
					jQuery("#ajax-response-counter").html(' So far '+(query_limit * meta_index)+' alerts have been migrated.');
					MigrateMeta();
				} else {
					MigrateOccurrence();
				}
			}
		});
	}

	function MigrateOccurrence() {
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			async: true,
			dataType: 'json',
			data: {
				action: 'MigrateOccurrence',
				index: occurrence_index
			},
			success: function(response) {
				if (typeof response['empty'] != "undefined") {
					jQuery('#ajax-response').addClass("hidden");
					msg = "No alerts to import";
					alert(msg);
					return;
				}
				occurrence_index = response['index'];
				if (!response['complete']) {
					jQuery("#ajax-response-counter").html(' So far '+(query_limit * occurrence_index)+' alerts have been migrated.');
					MigrateOccurrence();
				} else {
					msg = "WordPress security alerts successfully migrated to new database.";
					afterCompleted('#wsal-migrate', msg);
					return;
				}
			}
		});
	}

	function MigrateBackMeta() {
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			async: true,
			dataType: 'json',
			data: {
				action: 'MigrateBackMeta',
				index: meta_index
			},
			success: function(response) {
				if (typeof response['empty'] != "undefined") {
					jQuery('#ajax-response').addClass("hidden");
					msg = "No alerts to import";
					alert(msg);
					return;
				}
				meta_index = response['index'];
				if (!response['complete']) {
					jQuery("#ajax-response-counter").html(' So far '+(query_limit * meta_index)+' alerts have been migrated.');
					MigrateBackMeta();
				} else {
				   	MigrateBackOccurrence();
				}
			}
		});
	}

	function MigrateBackOccurrence() {
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			async: true,
			dataType: 'json',
			data: {
				action: 'MigrateBackOccurrence',
				index: occurrence_index
			},
			success: function(response) {
				if (typeof response['empty'] != "undefined") {
					jQuery('#ajax-response').addClass("hidden");
					msg = "No alerts to import";
					alert(msg);
					return;
				}
				occurrence_index = response['index'];
				if (!response['complete']) {
					jQuery("#ajax-response-counter").html(' So far '+(query_limit * occurrence_index)+' alerts have been migrated.');
					MigrateBackOccurrence();
				} else {
					msg = "WordPress security alerts successfully migrated to Wordpress database.";
					afterCompleted('#wsal-migrate-back', msg);
					return;
				}
			}
		});
	}

	function afterCompleted(button, msg) {
		jQuery(button).val('Migration complete');
		jQuery('#ajax-response').addClass("hidden");
		alert(msg);
	}

	jQuery('#wsal-mirroring').click(function() {
		var button = this;
		jQuery( button ).val( 'Mirroring...' );
		jQuery( button ).attr( 'disabled', 'disabled' );
		MirroringNow( button );
	});

	function MirroringNow( button ) {
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			async: true,
			data: {
				action: 'MirroringNow'
			},
			success: function() {
				setTimeout( function() {
					jQuery( button ).val( 'Mirroring Complete!' );
				}, 1000 );
			}
		});
	}

	jQuery('#wsal-archiving').click(function() {
		var button = this;
		jQuery( button ).val( 'Archiving...' );
		jQuery( button ).attr( 'disabled', 'disabled' );
		ArchivingNow( button );
	});

	function ArchivingNow( button ) {
		jQuery.ajax({
			type: 'POST',
			url: ajaxurl,
			async: true,
			data: {
				action: 'ArchivingNow'
			},
			success: function() {
				setTimeout( function() {
					jQuery( button ).val( 'Archiving Complete!' );
				}, 1000 );
			}
		});
	}

	// Empty buffer button.
	jQuery( '#wsal-empty-buffer' ).click( function( event ) {
		event.preventDefault();

		var wsal_empty_butter_btn = jQuery( this );
		wsal_empty_butter_btn.attr( 'disabled', 'disabled' );

		// Ajax request to remove array of files from file exception list.
		jQuery.ajax( {
			type: 'POST',
			url: ajaxurl,
			async: true,
			dataType: 'json',
			data: {
				action: 'wsal_empty_buffer',
				nonce: wsal_empty_butter_btn.data( 'empty-buffer-nonce' )
			},
			success: function( data ) {
				if ( data.success ) {
					wsal_empty_butter_btn.val( 'Sent!' );
				} else {
					console.log( data.message );
				}
			},
			error: function( xhr, textStatus, error ) {
				console.log( xhr.statusText );
				console.log( textStatus );
				console.log( error );
			}
		} );
	} );

	// Test connection button.
	jQuery( '#adapter-test, #mirror-test, #archive-test' ).click( function() {
		// event.preventDefault();

		jQuery( this ).val( 'Testing...' );
		jQuery( this ).attr( 'disabled', true );
		var testType = jQuery( this ).data( 'connection' );
		var nonce = jQuery( '#' + testType + '-test-nonce' ).val();

		wsalTestConnection( this, testType, nonce);
	} );

	/**
	 * Test connection with external DBs.
	 *
	 * @param {element} btn   – Button element.
	 * @param {string}  type  – Type of connection to test.
	 * @param {string}  nonce – Connection nonce.
	 */
	function wsalTestConnection(btn, type, nonce) {
		// Make sure the arguments are not empty.
		if ( ! type.length || ! nonce.length ) {
			return;
		}

		// Ajax request to test connection.
		jQuery.ajax( {
			type: 'POST',
			url: ajaxurl,
			async: true,
			dataType: 'json',
			data: {
				action: 'wsal_test_connection',
				nonce: nonce,
				connectionType: type
			},
			success: function( data ) {
				if ( data.success ) {
					jQuery( btn ).val( 'Connected!' );
				} else {
					jQuery( btn ).val( 'Connection Failed!' );
					console.log( data.message );
				}
			},
			error: function( xhr, textStatus, error ) {
				jQuery( btn ).val( 'Connection Failed!' );
				console.log( xhr.statusText );
				console.log( textStatus );
				console.log( error );
			}
		} );
	}
});
