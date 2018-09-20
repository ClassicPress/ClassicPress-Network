var dfd_header_b = dfd_header_b || {};
(function($){
	'use strict';

	dfd_header_b.View.Add_Preset = Backbone.View.extend({
		mainTemplate: '',
		el: ".add-preset-app",
		curentStyleHeader: "",
		hide: false,
		events: {

		},
		initialize: function(obj){
			if(typeof obj != "undefined"){
				this.hide = obj.hide;
			}
			this.hasError = false;
			this.ErrorMessage = "";
			this.mainTemplate = _.template($('#dfd_header_t_add_preset').html());
			this.listenTo(this, 'addError', this.addErrorMessage);
			this.listenTo(this, 'addEvents', _.debounce(this.ev, 0));
			this.curentStyleHeader = dfd_header_b.View.Setting.getHeaderStyle();
			this.trigger("addEvents");
		},
		ev: function(){
			var self = this;
			this.elem = this.$el.find("[type='submit']");
			this.elem.on("click", function(){
				self.save();
			});
			this.$el.find(".dfd-tiles").on("click", function(){
				var input = $(this).prev();
				self.$el.find("label.redux-image-select").removeClass("redux-image-select-selected");
				$(this).parent().addClass("redux-image-select-selected");
				self.curentStyleHeader = input.val();
				return false;
			});
		},
		addErrorMessage: function(){
			this.$(".error").html("");
			this.$(".error").show();
			this.$(".error").append(this.ErrorMessage);
		},
		save: function(e){
			var new_preset = this.newAttributes();
			if(_.isObject(new_preset)){
				var actives = dfd_header_b.APP.presets.where({isActive: "active"});
				for(var key in actives) {
					actives[key].set({isActive: ""});
				}
				dfd_header_b.APP.presets.add([
					new_preset
				]);
				new_preset.trigger("select");
				dfd_header_b.Helper.saveChanges();

				tb_remove();
				if(!dfd_header_b.Helper.presetWindowIsOpen){
					dfd_header_b.Helper.openPresetWindow();
				}
				this.elem.unbind("click");
			} else {
				this.trigger('addError');
			}
			return false;
		},
		newAttributes: function(){
			var DefaultPresetAndSettingsVal = dfd_header_b.Helper.getDefaultPresetAndSettingsVal(this.curentStyleHeader);
			var preset = DefaultPresetAndSettingsVal.preset;
			var settings = DefaultPresetAndSettingsVal.settings;
			if(dfd_header_b.isClickedNewPreset == true){
				dfd_header_b.Config.clearEditView();
				dfd_header_b.Config.clearSetting();


				dfd_header_b.Config.setSetting(settings);
			}

			var new_preset = new dfd_header_b.Model.Preset();
			var is_new = true;
			if(dfd_header_b.Config.editView.desktop.length == 0){
				is_new = false;
				dfd_header_b.Config.editView.desktop = preset.desktop;
			}
			if(dfd_header_b.Config.editView.tablet.length == 0){
				is_new = false;
				dfd_header_b.Config.editView.tablet = preset.tablet;
			}
			if(dfd_header_b.Config.editView.mobile.length == 0){
				is_new = false;
				dfd_header_b.Config.editView.mobile = preset.mobile;
			}

			new_preset.set({
				name: this.$input.val().trim(),
				isActive: "active",
				copyProc: "true",
				presetValues: {
					desktop: dfd_header_b.Config.editView.desktop,
					tablet: dfd_header_b.Config.editView.tablet,
					mobile: dfd_header_b.Config.editView.mobile,
				},
				settings: {
					desktop: dfd_header_b.Config.settings.desktop,
					tablet: dfd_header_b.Config.settings.tablet,
					mobile: dfd_header_b.Config.settings.mobile,
					globals: dfd_header_b.Config.globalSetting,
				}
			});

			if(new_preset.isValid()){
				return new_preset;
			} else {
				this.hasError = true;
				this.ErrorMessage = new_preset.validationError;
			}
			dfd_header_b.isClickedNewPreset == false;
			return new_preset.validationError;

		},
		render: function(){
			this.$el.html("");
			this.$el.append(this.mainTemplate({hide: this.hide}));
			if(!this.hide){
				var choose_preset_html = $("#native-style_header_builder");
				var preset_html = choose_preset_html.clone();
				this.$el.append(preset_html);
			}

			this.$input = this.$(".add_name");
			return this;
		}
	});
})(jQuery);