/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function(){
	'use strict';

	dfd_header_b.Collection.Elements = Backbone.Collection.extend({
		model: dfd_header_b.Model.Element,

		parse: function(response){
			return response;
		}
	});
	dfd_header_b.APP.collection = new dfd_header_b.Collection.Elements();
	dfd_header_b.APP.collection_prev = new dfd_header_b.Collection.Elements();

	dfd_header_b.Collection.Presets = Backbone.Collection.extend({
		model: dfd_header_b.Model.Preset,
		parse: function(response){
			return response;
		}
	});  
	dfd_header_b.APP.presets = new dfd_header_b.Collection.Presets();

})(jQuery);
