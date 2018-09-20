var dfd_header_b = dfd_header_b || {};

(function(){
	'use strict';

	dfd_header_b.Model.Preset = Backbone.Model.extend({
		defaults: {
			name: '',
//			active: 'active',
			isActive: '',
			isDefault: false,
			presetValues: {
				desktop: '',
				tablet: '',
				mobile: '',
			},
			settings: {
				desktop: '',
				tablet: '',
				mobile: '',
				globals: '',
			}
		},
		validate: function(attrs, options){
			var name = attrs.name;
			if(name == ""){
				return "You must enter the name";
			}
			var count = dfd_header_b.APP.presets.where({name: name, isDefault: false});
			if(count.length > 0){
				return "Name '" + name + "' already exists";
			}
		},
		initialize: function(models, options){
			var cid = this.cid;
			var id = this.get("id");
			if(id == "" || typeof id == "undefined"){
				this.set("id", cid);
			}
		},
		parse: function(response){
			return response;
		}
	});
})();