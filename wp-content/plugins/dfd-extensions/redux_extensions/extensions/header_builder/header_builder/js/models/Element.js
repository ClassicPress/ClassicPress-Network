/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function($, window){
	'use strict';

	dfd_header_b.Model.Element = Backbone.Model.extend({
		defaults: {
//			id: '',
			name: '',
			type: '',
			class_el: '',
			onlimit: false,
			image: '',
			isfullwidth: false
		},
		initialize: function(models, options){
			if(this.get("class_el") == ""){
				var premade_preset = dfd_header_b.PremadeElements.el;
				for(var premade_preset_key in premade_preset) {
					var premade_preset_obj = premade_preset[premade_preset_key];
					if(premade_preset_obj.type == this.get("type")){
						this.set("class_el", premade_preset_obj.class_el);
						break;
					}
				}
			}
		},
		validate: function(attrs, options){

		},
		parse: function(response){
			return response;
		}
	});
	
})(jQuery, window);
