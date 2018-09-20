var dfd_header_b = dfd_header_b || {};

(function(){
	'use strict';

	dfd_header_b.Model.Setting = Backbone.Model.extend({
		defaults: {
			id: "",
			type: "",
			value: "",
			def: "",
			isGlobal : "",
		},

		parse: function(response){
			return response;
		}
	});
})();