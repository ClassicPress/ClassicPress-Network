var dfd_header_b = dfd_header_b || {};
(function($){
	'use strict';

	dfd_header_b.View.Preset_View = Backbone.View.extend({
		mainTemplate: '',
		events: {
			"click": "selectPreset",
			"click .delete": "delete",
			"click .copy": "copyel",
			"click .rename": "rename",
			"click .change-name": "changeName",
			"click [type='submit']": "saveChanges",
		},
		initialize: function(){
			this.model.set("active", "");
			this.mainTemplate = _.template($('#dfd_header_t_preset_elem').html());

			this.model.on("invalid", function(model, error){
				alert( error);
			});
			this.listenTo(this.model, 'select', this.sel);
			this.listenTo(this.model, 'removeActive', this.removeActive);
			this.listenTo(this.model, 'change:name', this.viewNameChange);
		},
		sel: function(){
			this.selectPreset();
		},
		viewNameChange : function(obj){
			var name = this.model.get("name");
			this.$el.find(".name").html(name);
			dfd_header_b.Helper.saveChanges();
		},
		delete: function(){
			var isDelete = confirm("Preset will be deleted. Are  your sure?");
			if(!isDelete){
				return false;
			}
			var DefaultPresetAndSettingsVal = dfd_header_b.Helper.getDefaultPresetAndSettingsVal();
			var preset = DefaultPresetAndSettingsVal.preset;
			var settings = DefaultPresetAndSettingsVal.settings;
			var id = this.model.get("id");
			dfd_header_b.APP.presets.remove(id);
			this.$el.remove();
			dfd_header_b.Config.clearEditView();
			dfd_header_b.Config.clearSetting();
			dfd_header_b.Config.clearView();
			dfd_header_b.Helper.saveChanges();
			dfd_header_b.Config.setPreset(preset);
			dfd_header_b.Config.setSetting(settings);
			dfd_header_b.Helper.addLoader();
			setTimeout(function(){
				dfd_header_b.APP.Builder.build();
			}, 100);
		},
		changeName: function(){
			var val = this.$el.find("input[name='edit_name']").val();
			this.model.set({
				name: val
			},{validate:true});
		},
		rename: function(){
			this.$el.find(".rename_preset").toggleClass("show");
		},
		copyel: function(){

			var id = this.model.get("id");
			var $this = this;

			var name = this.model.get("name") + " Copy";
			var overlayContent = this.model.get("overlayContent");

			this.model.set({isActive: ""});

			var obj = new dfd_header_b.Model.Preset();
			obj.set({
				id: obj.cid,
				isActive: "active",
				name: name,
				copyProc: "true",
				isDefault: false,
				presetValues: this.model.get("presetValues"),
				settings: this.model.get("settings"),
				overlayContent: overlayContent,
			});


			this.model.trigger("removeActive");



			dfd_header_b.Config.clearEditView();
			dfd_header_b.Config.clearSetting();
			dfd_header_b.APP.presets.add([
				obj
			]);

			var preset = obj.get("presetValues");
			var setttings = obj.get("settings");

			dfd_header_b.Config.setPreset(preset);

			dfd_header_b.Config.setSetting(setttings);

			dfd_header_b.Helper.saveChanges();
			setTimeout(function(){
				dfd_header_b.APP.Builder.build();
			}, 100);
		},
		saveChanges: function(){
		},
		selectPreset: function(force){
			if(this.$el.hasClass("active")){
				return false;
			}
			var active = this.model.get("isActive");
			if(active == "active" && _.isObject(force)){
				return false;
			}
			var actives = dfd_header_b.APP.presets.where({isActive: "active"});
			for(var key in actives) {
				actives[key].set({isActive: ""});
			}
			var name = this.model.get('name')
			dfd_header_b.Config.curentPreset = name;
			
			this.model.set({isActive: "active"});
			
			this.model.trigger("removeActive");
			$(this.$el).toggleClass("active");
			dfd_header_b.Config.clearEditView();
			dfd_header_b.Config.clearSetting();


			var preset = this.model.get("presetValues");
			var setttings = this.model.get("settings");

			dfd_header_b.Config.setPreset(preset);

			dfd_header_b.Config.setSetting(setttings);

			dfd_header_b.Helper.addLoader();
			dfd_header_b.changeslider = true;
			setTimeout(function(){
				dfd_header_b.isnotifyEnable = false;
				dfd_header_b.APP.Builder.build();
				dfd_header_b.Helper.saveChanges(false);
			}, 100);
			dfd_header_b.isnotifyEnable = true;
			dfd_header_b.Helper.checkSetOnDefault();

		},
		className: function(){
			return "preset";
		},
		removeActive: function(){
			$(this.$el).siblings().removeClass("active");
		},
		render: function(){

			this.$el.append(this.mainTemplate(this.model.toJSON()));
			return this;
		}
	});
})(jQuery);