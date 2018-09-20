var dfd_header_b = dfd_header_b || {};
(function($){
	'use strict';
	dfd_header_b.View.Presets_View = Backbone.View.extend({
		el: '.preset-window .list',
		mainTemplate: '',
		events: {
		},
		initialize: function(){

			this.listenTo(dfd_header_b.APP.presets, 'add', _.debounce(this.add, 0));
			this.listenTo(dfd_header_b.APP.presets, 'all', _.debounce(this.render, 0));
			this.listenTo(dfd_header_b.APP.presets, 'reset', _.debounce(this.reset, 0));
			this.listenTo(dfd_header_b.APP.presets, 'change', this.change);
			this.listenTo(dfd_header_b.APP.presets, 'triggerActive', this.triggerActive);


			var value = $(dfd_header_b.HTMLEntity.optionInput).val();
			var parsedVal = [
			];
			if(dfd_header_b_DefaultPresets){
				for(var def_preset in dfd_header_b_DefaultPresets) {
					parsedVal.push(dfd_header_b_DefaultPresets[def_preset]);
				}
			}

			if(value.trim() != ""){
				var presets = JSON.parse(value);
				for(var key in presets) {
					parsedVal.push(presets[key]);
				}
			}
			dfd_header_b.APP.presets.reset(parsedVal, {parse: true});
		},
		sel: function(m){

		},
		add: function(model){
			var preset = new dfd_header_b.View.Preset_View({model: model});
			this.$el.append(preset.render().el);
			if(model.get("isActive") == "active"){
				model.trigger("select");
			}
		},

		triggerActive: function(model){
			this.filterOne(model);
		},
		filterOne: function(model){
			return false;
			var name = model.get('name')
			var isCopy = model.get('copyProc')
			if(model.get("isActive") == "active"){
				dfd_header_b.Config.curentPreset = name;
			}
			var AllActivePresets = dfd_header_b.APP.presets.filter(function(preset){
				return  preset.get("name") != name;
			});
			if(AllActivePresets.length){
				for(var preset in AllActivePresets) {
					AllActivePresets[preset].set({isActive: ""},
					{silent: true}
					);
				}
			}
		},
		change: function(model){
			this.filterOne(model);

		},
		reset: function(collect, prev){
			this.$el.html("");
			dfd_header_b.APP.presets.each(this.add, this);
		},
		render: function(){
			return this;
		}
	});


})(jQuery);