( function( api ) {

	// Extends our custom "pagebuilderly" section.
	api.sectionConstructor['pagebuilderly'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
