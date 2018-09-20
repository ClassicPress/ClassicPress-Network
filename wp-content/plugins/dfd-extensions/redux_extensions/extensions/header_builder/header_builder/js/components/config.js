/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function($, window){
	'use strict';

	dfd_header_b.Config = {
		curentView: "desktop",
		curentPreset: "",
		PresetName: "Default",
		isnew: false,
		defaultView: {
			desktop: '',
			tablet: '',
			mobile: '',
		},
		editView: {
			desktop: "",
			tablet: "",
			mobile: "",
		},
		settings: {
			desktop: "",
			tablet: "",
			mobile: "",
		},
		globalSetting: "",
		getCurrentSetting: function(){
			var view = this.getCurentView();
			return this.settings[view];
		},
		getCurentPresetName: function(){
			var model = dfd_header_b.APP.presets.findWhere({isActive: "active"});
			if(_.isObject(model)){
				return model.get("name");
			}
			return "";
		},
		getCurrentPreset: function(){
			var view = this.getCurentView();
			return this.defaultView[view];
		},
		getCurentView: function(){
			return this.curentView;
		},
		setDesktopView: function(){
			this.curentView = "desktop";
		},
		setTabletView: function(){
			this.curentView = "tablet";
		},
		setMobileView: function(){
			this.curentView = "mobile";
		},
		setPresetState: function(){
			var findpreset = dfd_header_b.APP.presets.findWhere({isActive: "active", isDefault: false});

			if(_.isObject(findpreset)){
				findpreset.set(
						{
							settings: {
								desktop: this.settings.desktop,
								tablet: this.settings.tablet,
								mobile: this.settings.mobile,
								globals: this.globalSetting
							}
						}
				), {merge: false};
			}

		},
		setPreset: function(preset){
			this.defaultView.desktop = preset.desktop;
			this.defaultView.tablet = preset.tablet;
			this.defaultView.mobile = preset.mobile;
		},
		setSetting: function(preset){
			this.settings.desktop = preset.desktop;
			this.settings.tablet = preset.tablet;
			this.settings.mobile = preset.mobile;
			this.globalSetting = preset.globals;
		},
		setSettingByView: function(setting){
			var view = this.getCurentView();
			this.settings[view] = setting;
		},
		setGlobalSetting: function(global){
			this.globalSetting = global;
		},
		getGlobalSetting: function(){
			return this.globalSetting;
		},
		setPresetByView: function(preset){
			var view = this.getCurentView();
			this.defaultView[view] = preset;
			if(this.getCurentPresetName() == ""){
				this.editView[view] = preset;
			} else {
				this.clearEditView();
			}
			var findpreset = dfd_header_b.APP.presets.findWhere({isActive: "active", isDefault: false});
			var curview = this.getCurentView();
			var paste = this.defaultView;

			/*For Update*/
			if(_.isObject(findpreset)){
				findpreset.set(
						{
							presetValues: {
								desktop: this.defaultView.desktop,
								tablet: this.defaultView.tablet,
								mobile: this.defaultView.mobile,
							},
							settings: {
								desktop: this.settings.desktop,
								tablet: this.settings.tablet,
								mobile: this.settings.mobile,
								globals: this.globalSetting
							}
						}
				);
			}
		},
		clearTopPanel: function(){
		},
		clearMidPanel: function(){
		},
		clearBotPanel: function(){
			var $preset = this.getCurrentPreset();
			$preset[2] = [
			];
			this.setPresetByView($preset);
		},
		clearEditView: function(){
			this.editView = {
				desktop: "",
				tablet: "",
				mobile: ""
			};
		},
		clearSetting: function(){
			this.settings = {
				desktop: "",
				tablet: "", mobile: ""
			};
			this.globalSetting = "";
		},
		clearView: function(){
			this.defaultView = {
				desktop: "",
				tablet: "",
				mobile: ""
			};
		}
	};
})(jQuery, window);
