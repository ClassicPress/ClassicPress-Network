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

/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function($, window){
	'use strict';

	dfd_header_b.Default = {
		"name": "defalult_03223",
		"isActive": "active",
		"presetValues": {
			"desktop": [
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				]
			],
			"tablet": [
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
						{"name": "Logo", "type": "logo", "isfullwidth": false}
					],
					[
					],
					[
						{"name": "Language", "type": "language", "isfullwidth": false},
						{"name": "Search", "type": "search", "isfullwidth": false},
						{"name": "Cart", "type": "cart", "isfullwidth": false},
						{"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}
					]
				]
			],
			"mobile": [
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
					],
					[
					],
					[
					]
				],
				[
					[
						{"name": "Logo", "type": "logo", "isfullwidth": false}
					],
					[
					],
					[
						{"name": "Delimiter", "type": "delimiter", "isfullwidth": false},
						{"name": "Language", "type": "language", "isfullwidth": false},
						{"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}
					]
				]
			]},
		"settings": {
			"desktop": [
			],
			"tablet": [
				{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"},
			],
			"mobile": [
				{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"},
				{"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"},
			],
			"globals": [
			]}, "active": ""};
	/** 
	 * Default preset for side header
	 */
	dfd_header_b.DefaultPresetSide = {
		"name": "default_343434343",
		"isActive": "",
		"presetValues": {
			"desktop": [[[{"name": "Spacer", "type": "spacer", "isfullwidth": false}, {"name": "Spacer", "type": "spacer", "isfullwidth": false}], [], []], [[], [], []], [[{"name": "Spacer", "type": "spacer", "isfullwidth": false}, {"name": "Spacer", "type": "spacer", "isfullwidth": false}], [], []]], "tablet": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Search", "type": "search", "isfullwidth": false}, {"name": "Cart", "type": "cart", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]], "mobile": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Delimiter", "type": "delimiter", "isfullwidth": false}, {"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]]
		},
		"settings": {
			"desktop": [{"id": "show_top_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "on", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}, {"id": "set_top_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_mid_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_bot_panel_abstract_builder", "type": "trigger", "value": "on", "def": "off", "isGlobal": "false"}, {"id": "header_top_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_mid_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_bot_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_top_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_mid_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_bot_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_border_color_build", "type": "colorpicker", "value": "{ \"color\":\"#e7e7e7\",\"is_transparent\":\"false\"}", "def": "#e7e7e7", "isGlobal": "false"}], "tablet": [{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}, {"id": "set_top_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_mid_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_bot_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}], "mobile": [{"type": "trigger", "id": "show_top_panel_builder", "value": "off", "def": "on", "isGlobal": "false"}, {"type": "trigger", "id": "show_mid_panel_builder", "value": "off", "def": "on", "isGlobal": "false"}, {"type": "trigger", "id": "show_bot_panel_builder", "value": "", "def": "on", "isGlobal": "false"}, {"type": "trigger", "id": "set_top_panel_abstract_builder", "value": "", "def": "off", "isGlobal": "false"}, {"type": "trigger", "id": "set_mid_panel_abstract_builder", "value": "", "def": "off", "isGlobal": "false"}, {"type": "trigger", "id": "set_bot_panel_abstract_builder", "value": "", "def": "off", "isGlobal": "false"}], "globals": [{"id": "header_copyright_builder", "type": "text", "value": "@DFD", "def": "", "isGlobal": "true"}, {"id": "header_telephone_builder", "type": "telephone", "value": "+(032) 323-323-32", "def": "", "isGlobal": "true"}, {"id": "header_button_text_builder", "type": "text", "value": "Button", "def": "", "isGlobal": "true"}, {"id": "header_button_url_builder", "type": "text", "value": "#", "def": "", "isGlobal": "true"}, {"id": "header_side_background_color_builder", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "true"}, {"id": "bg_image_side_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "header_side_bar_width_builder", "type": "slider", "value": "320", "def": "", "isGlobal": "true"}, {"id": "header_alignment_builder", "type": "radio", "value": "left", "def": "", "isGlobal": "true"}, {"id": "header_bg_repeat_builder", "type": "radio", "value": "no-repeat", "def": "", "isGlobal": "true"}, {"id": "header_bg_size_builder", "type": "radio", "value": "cover", "def": "", "isGlobal": "true"}, {"id": "header_bg_position_builder", "type": "radio", "value": "center-center", "def": "", "isGlobal": "true"}, {"id": "header_content_alignment_builder", "type": "radio", "value": "alignleft", "def": "", "isGlobal": "true"}, {"id": "style_header_builder", "type": "image_select", "value": "side", "def": "", "isGlobal": "true"}, {"id": "logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "retina_logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "top_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "mid_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "bot_header_height_builder", "type": "slider", "value": "70", "def": "", "isGlobal": "true"}, {"id": "header_sticky_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "true"}]
		},
	};
	/** 
	 * Default preset for boxed header
	 */
	dfd_header_b.DefaultPresetBoxed = {
		"name": "default_478368",
		"isActive": "",
		"presetValues": {
			"desktop": [[[], [], []], [[], [], []], [[], [], []]], "tablet": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Search", "type": "search", "isfullwidth": false}, {"name": "Cart", "type": "cart", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]], "mobile": [[[], [], []], [[], [], []], [[{"name": "Logo", "type": "logo", "isfullwidth": false}], [], [{"name": "Delimiter", "type": "delimiter", "isfullwidth": false}, {"name": "Language", "type": "language", "isfullwidth": false}, {"name": "Mobile Menu", "type": "mobile_menu", "isfullwidth": false}]]]},
		"settings": {
			"desktop": [{"id": "header_copyright_builder", "type": "text", "value": "@DFD", "def": "", "isGlobal": "true"}, {"id": "header_telephone_builder", "type": "telephone", "value": "+(032) 323-323-32", "def": "", "isGlobal": "true"}, {"id": "header_button_text_builder", "type": "text", "value": "Button", "def": "", "isGlobal": "true"}, {"id": "header_button_url_builder", "type": "text", "value": "#", "def": "", "isGlobal": "true"}, {"id": "header_side_background_color_builder", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "true"}, {"id": "bg_image_side_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "header_side_bar_width_builder", "type": "slider", "value": "490", "def": "", "isGlobal": "true"}, {"id": "header_alignment_builder", "type": "radio", "value": "left", "def": "", "isGlobal": "true"}, {"id": "header_bg_repeat_builder", "type": "radio", "value": "no-repeat", "def": "", "isGlobal": "true"}, {"id": "header_bg_size_builder", "type": "radio", "value": "cover", "def": "", "isGlobal": "true"}, {"id": "header_bg_position_builder", "type": "radio", "value": "center-center", "def": "", "isGlobal": "true"}, {"id": "header_content_alignment_builder", "type": "radio", "value": "alignleft", "def": "", "isGlobal": "true"}, {"id": "style_header_builder", "type": "image_select", "value": "horizontal", "def": "", "isGlobal": "true"}, {"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "on", "def": "on", "isGlobal": "false"}, {"id": "set_top_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_mid_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "set_bot_panel_abstract_builder", "type": "trigger", "value": "", "def": "off", "isGlobal": "false"}, {"id": "logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "retina_logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "top_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "mid_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "bot_header_height_builder", "type": "slider", "value": "70", "def": "", "isGlobal": "true"}, {"id": "header_top_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_mid_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_bot_background_color_build", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "false"}, {"id": "header_top_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_mid_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_bot_text_color_build", "type": "colorpicker", "value": "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}", "def": "#313131", "isGlobal": "false", "hidetransparent": "true"}, {"id": "header_border_color_build", "type": "colorpicker", "value": "{\"color\":\"transparent\",\"is_transparent\":\"true\"}", "def": "#e7e7e7", "isGlobal": "false"}, {"id": "header_sticky_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "true"}], "tablet": [{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}], "mobile": [{"id": "show_top_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_mid_panel_builder", "type": "trigger", "value": "off", "def": "on", "isGlobal": "false"}, {"id": "show_bot_panel_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "false"}], "globals": [{"id": "header_copyright_builder", "type": "text", "value": "@DFD", "def": "", "isGlobal": "true"}, {"id": "header_telephone_builder", "type": "telephone", "value": "+(032) 323-323-32", "def": "", "isGlobal": "true"}, {"id": "header_button_text_builder", "type": "text", "value": "Button", "def": "", "isGlobal": "true"}, {"id": "header_button_url_builder", "type": "text", "value": "#", "def": "", "isGlobal": "true"}, {"id": "header_side_background_color_builder", "type": "colorpicker", "value": "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}", "def": "#ffffff", "isGlobal": "true"}, {"id": "bg_image_side_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "header_side_bar_width_builder", "type": "slider", "value": "490", "def": "", "isGlobal": "true"}, {"id": "header_alignment_builder", "type": "radio", "value": "left", "def": "", "isGlobal": "true"}, {"id": "header_bg_repeat_builder", "type": "radio", "value": "no-repeat", "def": "", "isGlobal": "true"}, {"id": "header_bg_size_builder", "type": "radio", "value": "cover", "def": "", "isGlobal": "true"}, {"id": "header_bg_position_builder", "type": "radio", "value": "center-center", "def": "", "isGlobal": "true"}, {"id": "header_content_alignment_builder", "type": "radio", "value": "alignleft", "def": "", "isGlobal": "true"}, {"id": "style_header_builder", "type": "image_select", "value": "boxed", "def": "", "isGlobal": "true"}, {"id": "logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "retina_logo_header_builder", "type": "image", "value": "{\"id\":\"\",\"thumb\":\"\"}", "def": "", "isGlobal": "true"}, {"id": "top_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "mid_header_height_builder", "type": "slider", "value": "40", "def": "", "isGlobal": "true"}, {"id": "bot_header_height_builder", "type": "slider", "value": "70", "def": "", "isGlobal": "true"}, {"id": "header_sticky_builder", "type": "trigger", "value": "", "def": "on", "isGlobal": "true"}]},
	};



	dfd_header_b.PreSetting = [
		{
			id: "header_copyright_builder",
			type: "text",
			value: "@DFD",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_telephone_builder",
			type: "telephone",
			value: "+(032) 323-323-32",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_button_text_builder",
			type: "text",
			value: "Button",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_button_url_builder",
			type: "text",
			value: "#",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_side_background_color_builder",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "true"
		},
		{
			id: "bg_image_side_header_builder",
			type: "image",
			value: "{\"id\":\"\",\"thumb\":\"\"}",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_side_bar_width_builder",
			type: "slider",
			value: "490",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_alignment_builder",
			type: "radio",
			value: "left",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_bg_repeat_builder",
			type: "radio",
			value: "no-repeat",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_bg_size_builder",
			type: "radio",
			value: "cover",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_bg_position_builder",
			type: "radio",
			value: "center-center",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_content_alignment_builder",
			type: "radio",
			value: "alignleft",
			def: "",
			isGlobal: "true"
		},
		{
			id: "style_header_builder",
			type: "image_select",
			value: "horizontal",
			def: "",
			isGlobal: "true"
		},
		{
			id: "show_top_panel_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "false"
		},
		{
			id: "show_mid_panel_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "false"
		},
		{
			id: "show_bot_panel_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "false"
		},
		{
			id: "set_top_panel_abstract_builder",
			type: "trigger",
			value: "",
			def: "off",
			isGlobal: "false"
		},
		{
			id: "set_mid_panel_abstract_builder",
			type: "trigger",
			value: "",
			def: "off",
			isGlobal: "false"
		},
		{
			id: "set_bot_panel_abstract_builder",
			type: "trigger",
			value: "",
			def: "off",
			isGlobal: "false"
		},
		{
			id: "logo_header_builder",
			type: "image",
			value: "{\"id\":\"\",\"thumb\":\"" + dfd_header_b_local_settings.logo_url + "\"}",
			def: "",
			isGlobal: "true"
		},
		{
			id: "retina_logo_header_builder",
			type: "image",
			value: "{\"id\":\"\",\"thumb\":\"" + dfd_header_b_local_settings.retina_url + "\"}",
			def: "",
			isGlobal: "true"
		},
		{
			id: "top_header_height_builder",
			type: "slider",
			value: "40",
			def: "",
			isGlobal: "true"
		},
		{
			id: "mid_header_height_builder",
			type: "slider",
			value: "40",
			def: "",
			isGlobal: "true"
		},
		{
			id: "bot_header_height_builder",
			type: "slider",
			value: "70",
			def: "",
			isGlobal: "true"
		},
		{
			id: "header_top_background_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "false"
		},
		{
			id: "header_mid_background_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "false"
		},
		{
			id: "header_bot_background_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#ffffff\",\"is_transparent\":\"false\"}",
			def: "#ffffff",
			isGlobal: "false"
		},
		{
			id: "header_top_text_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}",
			def: "#313131",
			hidetransparent: "true",
			isGlobal: "false"
		},
		{
			id: "header_mid_text_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}",
			def: "#313131",
			hidetransparent: "true",
			isGlobal: "false"
		},
		{
			id: "header_bot_text_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#313131\",\"is_transparent\":\"false\"}",
			def: "#313131",
			hidetransparent: "true",
			isGlobal: "false"
		},
		{
			id: "header_border_color_build",
			type: "colorpicker",
			value: "{ \"color\":\"#e7e7e7\",\"is_transparent\":\"false\"}",
			def: "#e7e7e7",
			isGlobal: "false"
		},
		{
			id: "header_sticky_builder",
			type: "trigger",
			value: "",
			def: "on",
			isGlobal: "true"
		},
	];

	dfd_header_b.PremadeElements = {
		el: [
			{
				type: "text",
				name: "Copyright message",
				class_el: "Copyright-message"
			},
			{
				type: "menu",
				name: "Menu",
				class_el: "Menu"
			},
			{
				type: "second_menu",
				name: "Second Menu",
				class_el: "Second-Menu"
			},
			{
				type: "third_menu",
				name: "Third  Menu",
				class_el: "Third-Menu"
			},
			{
				type: "additional_menu",
				name: "Additional Menu",
				class_el: "Additional_Menu"},
			{
				type: "wishlist",
				name: "Wishlist",
				class_el: "Wishlist"
			},
			{
				type: "cart",
				name: "Cart",
				class_el: "Cart"
			},
			{
				type: "search",
				name: "Search",
				class_el: "Search"
			},
			{
				type: "logo",
				name: "Logo",
				class_el: "Logo"},
			{
				type: "language",
				name: "Language",
				class_el: "Language"
			},
			{
				type: "socicon",
				name: "Social Icon",
				class_el: "Socicon"
			},
			{
				type: "login",
				name: "Login on site",
				class_el: "Login"
			},
			{
				type: "info",
				name: "Info",
				class_el: "Info"
			},
			{
				type: "mobile_menu",
				name: "Mobile Menu",
				class_el: "Mobile_Menu"
			},
			{
				type: "side_area",
				name: "Side Area",
				class_el: "Side_Area"
			},
			{
				type: "inner_page",
				name: "Inner Page",
				class_el: "Inner_Page"
			},
			{
				type: "buttonel",
				name: "Button",
				class_el: "Button"
			},
			{
				type: "telephone",
				name: "Telephone",
				class_el: "Telephone"
			},
			{
				type: "spacer",
				name: "Spacer",
				class_el: "spacer",
				onlimit: true
			},
			{
				type: "delimiter",
				name: "Delimiter",
				class_el: "Delimiter",
				onlimit: true
			},
		]
	};

	dfd_header_b.Dependency = {
		side: [
			"set_top_panel_abstract_builder",
			"set_mid_panel_abstract_builder",
			"set_bot_panel_abstract_builder",
			"top_header_height_builder",
			"mid_header_height_builder",
			"bot_header_height_builder",
			"show_top_panel_builder",
			"show_mid_panel_builder",
			"show_bot_panel_builder",
			"header_top_background_color_build",
			"header_mid_background_color_build",
			"header_bot_background_color_build",
//			"header_sticky_builder",
		],
		horizontal: [
			"bg_image_side_header_builder",
			"header_side_background_color_builder",
			"header_side_bar_width_builder",
			"header_alignment_builder",
			"header_content_alignment_builder",
			"header_bg_repeat_builder",
			"header_bg_size_builder",
			"header_bg_position_builder",
		],
		boxed: [
			"bg_image_side_header_builder",
			"header_side_background_color_builder",
			"header_side_bar_width_builder",
			"header_alignment_builder",
			"header_content_alignment_builder",
			"header_bg_repeat_builder",
			"header_bg_size_builder",
			"header_bg_position_builder",
		],
		init: function(){
			var self = this;
			var type = dfd_header_b.View.Setting.getHeaderStyle();
			var curView = dfd_header_b.Config.getCurentView();
			if(curView != "desktop"){
				if(type == "side"){
					type = "horizontal";
				}
			}
			setTimeout(function(){
				self.build(type);
			}, 50);
		},
		build: function(type){
			for(var key in this[type]) {
				var id = this[type][key];
				var obj = $("fieldset[data-id=" + id + "]").parent().parent();
//				if(obj.is(":visible")){
				obj.hide();
//				}
			}
//			if(type == "side"){
//				type = "horizontal";
//			}			
			if(type == "side"){
				type = "horizontal";
			} else {
				type = "side";
			}
			for(var key in this[type]) {
				var id = this[type][key];
				var obj = $("fieldset[data-id=" + id + "]").parent().parent();
//				if(!obj.is(":visible")){
				obj.show();
//				}
			}
		}
	};
})(jQuery, window);

/**
 * $.disablescroll
 * Author: Josh Harrison - aloof.co
 *
 * Disables scroll events from mousewheels, touchmoves and keypresses.
 * Use while jQuery is animating the scroll position for a guaranteed super-smooth ride!
 */

(function($){

	"use strict";

	var instance, proto;

	function UserScrollDisabler($container, options){
		// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
		// left: 37, up: 38, right: 39, down: 40
		this.opts = $.extend({
			handleKeys: true,
			scrollEventKeys: [32, 33, 34, 35, 36, 37, 38, 39, 40]
		}, options);

		this.$container = $container;
		this.$document = $(document);
		this.lockToScrollPos = [0, 0];

		this.disable();
	}

	proto = UserScrollDisabler.prototype;

	proto.disable = function(){
		var t = this;

		t.lockToScrollPos = [
			t.$container.scrollLeft(),
			t.$container.scrollTop()
		];

		t.$container.on(
				"mousewheel.disablescroll DOMMouseScroll.disablescroll touchmove.disablescroll",
				t._handleWheel
				);

		t.$container.on("scroll.disablescroll", function(){
			t._handleScrollbar.call(t);
		});

		if(t.opts.handleKeys){
			t.$document.on("keydown.disablescroll", function(event){
				t._handleKeydown.call(t, event);
			});
		}
	};

	proto.undo = function(){
		var t = this;
		t.$container.off(".disablescroll");
		if(t.opts.handleKeys){
			t.$document.off(".disablescroll");
		}
	};

	proto._handleWheel = function(event){
		event.preventDefault();
	};

	proto._handleScrollbar = function(){
		this.$container.scrollLeft(this.lockToScrollPos[0]);
		this.$container.scrollTop(this.lockToScrollPos[1]);
	};

	proto._handleKeydown = function(event){
		for(var i = 0; i < this.opts.scrollEventKeys.length; i++) {
			if(event.keyCode === this.opts.scrollEventKeys[i]){
				event.preventDefault();
				return;
			}
		}
	};


	// Plugin wrapper for object
	$.fn.disablescroll = function(method){

		// If calling for the first time, instantiate the object and save
		// reference. The plugin can therefore only be instantiated once per
		// page. You can pass options object in through the method parameter.
		if(!instance && (typeof method === "object" || !method)){
			instance = new UserScrollDisabler(this, method);
		}

		// Instance already created, and a method is being explicitly called,
		// e.g. .disablescroll('undo');
		else if(instance && instance[method]){
			instance[method].call(instance);
		}

	};

	// Global access
	window.UserScrollDisabler = UserScrollDisabler;

})(jQuery);
/**!
 * Sortable
 * 
 * Sortable 1.7.0 - MIT | git://github.com/rubaxa/Sortable.git
 * 
 * @author	RubaXa   <trash@rubaxa.org>
 * @license MIT
 */

(function sortableModule(factory) {
	"use strict";

	if (typeof define === "function" && define.amd) {
		define(factory);
	}
	else if (typeof module != "undefined" && typeof module.exports != "undefined") {
		module.exports = factory();
	}
	else {
		/* jshint sub:true */
		window["Sortable"] = factory();
	}
})(function sortableFactory() {
	"use strict";

	if (typeof window === "undefined" || !window.document) {
		return function sortableError() {
			throw new Error("Sortable.js requires a window with a document");
		};
	}

	var dragEl,
		parentEl,
		ghostEl,
		cloneEl,
		rootEl,
		nextEl,
		lastDownEl,

		scrollEl,
		scrollParentEl,
		scrollCustomFn,

		lastEl,
		lastCSS,
		lastParentCSS,

		oldIndex,
		newIndex,

		activeGroup,
		putSortable,

		autoScroll = {},

		tapEvt,
		touchEvt,

		moved,

		/** @const */
		R_SPACE = /\s+/g,
		R_FLOAT = /left|right|inline/,

		expando = 'Sortable' + (new Date).getTime(),

		win = window,
		document = win.document,
		parseInt = win.parseInt,
		setTimeout = win.setTimeout,

		$ = win.jQuery || win.Zepto,
		Polymer = win.Polymer,

		captureMode = false,
		passiveMode = false,

		supportDraggable = ('draggable' in document.createElement('div')),
		supportCssPointerEvents = (function (el) {
			// false when IE11
			if (!!navigator.userAgent.match(/(?:Trident.*rv[ :]?11\.|msie)/i)) {
				return false;
			}
			el = document.createElement('x');
			el.style.cssText = 'pointer-events:auto';
			return el.style.pointerEvents === 'auto';
		})(),

		_silent = false,

		abs = Math.abs,
		min = Math.min,

		savedInputChecked = [],
		touchDragOverListeners = [],

		_autoScroll = _throttle(function (/**Event*/evt, /**Object*/options, /**HTMLElement*/rootEl) {
			// Bug: https://bugzilla.mozilla.org/show_bug.cgi?id=505521
			if (rootEl && options.scroll) {
				var _this = rootEl[expando],
					el,
					rect,
					sens = options.scrollSensitivity,
					speed = options.scrollSpeed,

					x = evt.clientX,
					y = evt.clientY,

					winWidth = window.innerWidth,
					winHeight = window.innerHeight,

					vx,
					vy,

					scrollOffsetX,
					scrollOffsetY
				;

				// Delect scrollEl
				if (scrollParentEl !== rootEl) {
					scrollEl = options.scroll;
					scrollParentEl = rootEl;
					scrollCustomFn = options.scrollFn;

					if (scrollEl === true) {
						scrollEl = rootEl;

						do {
							if ((scrollEl.offsetWidth < scrollEl.scrollWidth) ||
								(scrollEl.offsetHeight < scrollEl.scrollHeight)
							) {
								break;
							}
							/* jshint boss:true */
						} while (scrollEl = scrollEl.parentNode);
					}
				}

				if (scrollEl) {
					el = scrollEl;
					rect = scrollEl.getBoundingClientRect();
					vx = (abs(rect.right - x) <= sens) - (abs(rect.left - x) <= sens);
					vy = (abs(rect.bottom - y) <= sens) - (abs(rect.top - y) <= sens);
				}


				if (!(vx || vy)) {
					vx = (winWidth - x <= sens) - (x <= sens);
					vy = (winHeight - y <= sens) - (y <= sens);

					/* jshint expr:true */
					(vx || vy) && (el = win);
				}


				if (autoScroll.vx !== vx || autoScroll.vy !== vy || autoScroll.el !== el) {
					autoScroll.el = el;
					autoScroll.vx = vx;
					autoScroll.vy = vy;

					clearInterval(autoScroll.pid);

					if (el) {
						autoScroll.pid = setInterval(function () {
							scrollOffsetY = vy ? vy * speed : 0;
							scrollOffsetX = vx ? vx * speed : 0;

							if ('function' === typeof(scrollCustomFn)) {
								return scrollCustomFn.call(_this, scrollOffsetX, scrollOffsetY, evt);
							}

							if (el === win) {
								win.scrollTo(win.pageXOffset + scrollOffsetX, win.pageYOffset + scrollOffsetY);
							} else {
								el.scrollTop += scrollOffsetY;
								el.scrollLeft += scrollOffsetX;
							}
						}, 24);
					}
				}
			}
		}, 30),

		_prepareGroup = function (options) {
			function toFn(value, pull) {
				if (value === void 0 || value === true) {
					value = group.name;
				}

				if (typeof value === 'function') {
					return value;
				} else {
					return function (to, from) {
						var fromGroup = from.options.group.name;

						return pull
							? value
							: value && (value.join
								? value.indexOf(fromGroup) > -1
								: (fromGroup == value)
							);
					};
				}
			}

			var group = {};
			var originalGroup = options.group;

			if (!originalGroup || typeof originalGroup != 'object') {
				originalGroup = {name: originalGroup};
			}

			group.name = originalGroup.name;
			group.checkPull = toFn(originalGroup.pull, true);
			group.checkPut = toFn(originalGroup.put);
			group.revertClone = originalGroup.revertClone;

			options.group = group;
		}
	;

	// Detect support a passive mode
	try {
		window.addEventListener('test', null, Object.defineProperty({}, 'passive', {
			get: function () {
				// `false`, because everything starts to work incorrectly and instead of d'n'd,
				// begins the page has scrolled.
				passiveMode = false;
				captureMode = {
					capture: false,
					passive: passiveMode
				};
			}
		}));
	} catch (err) {}

	/**
	 * @class  Sortable
	 * @param  {HTMLElement}  el
	 * @param  {Object}       [options]
	 */
	function Sortable(el, options) {
		if (!(el && el.nodeType && el.nodeType === 1)) {
			throw 'Sortable: `el` must be HTMLElement, and not ' + {}.toString.call(el);
		}

		this.el = el; // root element
		this.options = options = _extend({}, options);


		// Export instance
		el[expando] = this;

		// Default options
		var defaults = {
			group: Math.random(),
			sort: true,
			disabled: false,
			store: null,
			handle: null,
			scroll: true,
			scrollSensitivity: 30,
			scrollSpeed: 10,
			draggable: /[uo]l/i.test(el.nodeName) ? 'li' : '>*',
			ghostClass: 'sortable-ghost',
			chosenClass: 'sortable-chosen',
			dragClass: 'sortable-drag',
			ignore: 'a, img',
			filter: null,
			preventOnFilter: true,
			animation: 0,
			setData: function (dataTransfer, dragEl) {
				dataTransfer.setData('Text', dragEl.textContent);
			},
			dropBubble: false,
			dragoverBubble: false,
			dataIdAttr: 'data-id',
			delay: 0,
			forceFallback: false,
			fallbackClass: 'sortable-fallback',
			fallbackOnBody: false,
			fallbackTolerance: 0,
			fallbackOffset: {x: 0, y: 0},
			supportPointer: Sortable.supportPointer !== false
		};


		// Set default options
		for (var name in defaults) {
			!(name in options) && (options[name] = defaults[name]);
		}

		_prepareGroup(options);

		// Bind all private methods
		for (var fn in this) {
			if (fn.charAt(0) === '_' && typeof this[fn] === 'function') {
				this[fn] = this[fn].bind(this);
			}
		}

		// Setup drag mode
		this.nativeDraggable = options.forceFallback ? false : supportDraggable;

		// Bind events
		_on(el, 'mousedown', this._onTapStart);
		_on(el, 'touchstart', this._onTapStart);
		options.supportPointer && _on(el, 'pointerdown', this._onTapStart);

		if (this.nativeDraggable) {
			_on(el, 'dragover', this);
			_on(el, 'dragenter', this);
		}

		touchDragOverListeners.push(this._onDragOver);

		// Restore sorting
		options.store && this.sort(options.store.get(this));
	}


	Sortable.prototype = /** @lends Sortable.prototype */ {
		constructor: Sortable,

		_onTapStart: function (/** Event|TouchEvent */evt) {
			var _this = this,
				el = this.el,
				options = this.options,
				preventOnFilter = options.preventOnFilter,
				type = evt.type,
				touch = evt.touches && evt.touches[0],
				target = (touch || evt).target,
				originalTarget = evt.target.shadowRoot && (evt.path && evt.path[0]) || target,
				filter = options.filter,
				startIndex;

			_saveInputCheckedState(el);


			// Don't trigger start event when an element is been dragged, otherwise the evt.oldindex always wrong when set option.group.
			if (dragEl) {
				return;
			}

			if (/mousedown|pointerdown/.test(type) && evt.button !== 0 || options.disabled) {
				return; // only left button or enabled
			}

			// cancel dnd if original target is content editable
			if (originalTarget.isContentEditable) {
				return;
			}

			target = _closest(target, options.draggable, el);

			if (!target) {
				return;
			}

			if (lastDownEl === target) {
				// Ignoring duplicate `down`
				return;
			}

			// Get the index of the dragged element within its parent
			startIndex = _index(target, options.draggable);

			// Check filter
			if (typeof filter === 'function') {
				if (filter.call(this, evt, target, this)) {
					_dispatchEvent(_this, originalTarget, 'filter', target, el, el, startIndex);
					preventOnFilter && evt.preventDefault();
					return; // cancel dnd
				}
			}
			else if (filter) {
				filter = filter.split(',').some(function (criteria) {
					criteria = _closest(originalTarget, criteria.trim(), el);

					if (criteria) {
						_dispatchEvent(_this, criteria, 'filter', target, el, el, startIndex);
						return true;
					}
				});

				if (filter) {
					preventOnFilter && evt.preventDefault();
					return; // cancel dnd
				}
			}

			if (options.handle && !_closest(originalTarget, options.handle, el)) {
				return;
			}

			// Prepare `dragstart`
			this._prepareDragStart(evt, touch, target, startIndex);
		},

		_prepareDragStart: function (/** Event */evt, /** Touch */touch, /** HTMLElement */target, /** Number */startIndex) {
			var _this = this,
				el = _this.el,
				options = _this.options,
				ownerDocument = el.ownerDocument,
				dragStartFn;

			if (target && !dragEl && (target.parentNode === el)) {
				tapEvt = evt;

				rootEl = el;
				dragEl = target;
				parentEl = dragEl.parentNode;
				nextEl = dragEl.nextSibling;
				lastDownEl = target;
				activeGroup = options.group;
				oldIndex = startIndex;

				this._lastX = (touch || evt).clientX;
				this._lastY = (touch || evt).clientY;

				dragEl.style['will-change'] = 'all';

				dragStartFn = function () {
					// Delayed drag has been triggered
					// we can re-enable the events: touchmove/mousemove
					_this._disableDelayedDrag();

					// Make the element draggable
					dragEl.draggable = _this.nativeDraggable;

					// Chosen item
					_toggleClass(dragEl, options.chosenClass, true);

					// Bind the events: dragstart/dragend
					_this._triggerDragStart(evt, touch);

					// Drag start event
					_dispatchEvent(_this, rootEl, 'choose', dragEl, rootEl, rootEl, oldIndex);
				};

				// Disable "draggable"
				options.ignore.split(',').forEach(function (criteria) {
					_find(dragEl, criteria.trim(), _disableDraggable);
				});

				_on(ownerDocument, 'mouseup', _this._onDrop);
				_on(ownerDocument, 'touchend', _this._onDrop);
				_on(ownerDocument, 'touchcancel', _this._onDrop);
				_on(ownerDocument, 'selectstart', _this);
				options.supportPointer && _on(ownerDocument, 'pointercancel', _this._onDrop);

				if (options.delay) {
					// If the user moves the pointer or let go the click or touch
					// before the delay has been reached:
					// disable the delayed drag
					_on(ownerDocument, 'mouseup', _this._disableDelayedDrag);
					_on(ownerDocument, 'touchend', _this._disableDelayedDrag);
					_on(ownerDocument, 'touchcancel', _this._disableDelayedDrag);
					_on(ownerDocument, 'mousemove', _this._disableDelayedDrag);
					_on(ownerDocument, 'touchmove', _this._disableDelayedDrag);
					options.supportPointer && _on(ownerDocument, 'pointermove', _this._disableDelayedDrag);

					_this._dragStartTimer = setTimeout(dragStartFn, options.delay);
				} else {
					dragStartFn();
				}


			}
		},

		_disableDelayedDrag: function () {
			var ownerDocument = this.el.ownerDocument;

			clearTimeout(this._dragStartTimer);
			_off(ownerDocument, 'mouseup', this._disableDelayedDrag);
			_off(ownerDocument, 'touchend', this._disableDelayedDrag);
			_off(ownerDocument, 'touchcancel', this._disableDelayedDrag);
			_off(ownerDocument, 'mousemove', this._disableDelayedDrag);
			_off(ownerDocument, 'touchmove', this._disableDelayedDrag);
			_off(ownerDocument, 'pointermove', this._disableDelayedDrag);
		},

		_triggerDragStart: function (/** Event */evt, /** Touch */touch) {
			touch = touch || (evt.pointerType == 'touch' ? evt : null);

			if (touch) {
				// Touch device support
				tapEvt = {
					target: dragEl,
					clientX: touch.clientX,
					clientY: touch.clientY
				};

				this._onDragStart(tapEvt, 'touch');
			}
			else if (!this.nativeDraggable) {
				this._onDragStart(tapEvt, true);
			}
			else {
				_on(dragEl, 'dragend', this);
				_on(rootEl, 'dragstart', this._onDragStart);
			}

			try {
				if (document.selection) {
					// Timeout neccessary for IE9
					_nextTick(function () {
						document.selection.empty();
					});
				} else {
					window.getSelection().removeAllRanges();
				}
			} catch (err) {
			}
		},

		_dragStarted: function () {
			if (rootEl && dragEl) {
				var options = this.options;

				// Apply effect
				_toggleClass(dragEl, options.ghostClass, true);
				_toggleClass(dragEl, options.dragClass, false);

				Sortable.active = this;

				// Drag start event
				_dispatchEvent(this, rootEl, 'start', dragEl, rootEl, rootEl, oldIndex);
			} else {
				this._nulling();
			}
		},

		_emulateDragOver: function () {
			if (touchEvt) {
				if (this._lastX === touchEvt.clientX && this._lastY === touchEvt.clientY) {
					return;
				}

				this._lastX = touchEvt.clientX;
				this._lastY = touchEvt.clientY;

				if (!supportCssPointerEvents) {
					_css(ghostEl, 'display', 'none');
				}

				var target = document.elementFromPoint(touchEvt.clientX, touchEvt.clientY);
				var parent = target;
				var i = touchDragOverListeners.length;

				if (target && target.shadowRoot) {
					target = target.shadowRoot.elementFromPoint(touchEvt.clientX, touchEvt.clientY);
					parent = target;
				}

				if (parent) {
					do {
						if (parent[expando]) {
							while (i--) {
								touchDragOverListeners[i]({
									clientX: touchEvt.clientX,
									clientY: touchEvt.clientY,
									target: target,
									rootEl: parent
								});
							}

							break;
						}

						target = parent; // store last element
					}
					/* jshint boss:true */
					while (parent = parent.parentNode);
				}

				if (!supportCssPointerEvents) {
					_css(ghostEl, 'display', '');
				}
			}
		},


		_onTouchMove: function (/**TouchEvent*/evt) {
			if (tapEvt) {
				var	options = this.options,
					fallbackTolerance = options.fallbackTolerance,
					fallbackOffset = options.fallbackOffset,
					touch = evt.touches ? evt.touches[0] : evt,
					dx = (touch.clientX - tapEvt.clientX) + fallbackOffset.x,
					dy = (touch.clientY - tapEvt.clientY) + fallbackOffset.y,
					translate3d = evt.touches ? 'translate3d(' + dx + 'px,' + dy + 'px,0)' : 'translate(' + dx + 'px,' + dy + 'px)';

				// only set the status to dragging, when we are actually dragging
				if (!Sortable.active) {
					if (fallbackTolerance &&
						min(abs(touch.clientX - this._lastX), abs(touch.clientY - this._lastY)) < fallbackTolerance
					) {
						return;
					}

					this._dragStarted();
				}

				// as well as creating the ghost element on the document body
				this._appendGhost();

				moved = true;
				touchEvt = touch;

				_css(ghostEl, 'webkitTransform', translate3d);
				_css(ghostEl, 'mozTransform', translate3d);
				_css(ghostEl, 'msTransform', translate3d);
				_css(ghostEl, 'transform', translate3d);

				evt.preventDefault();
			}
		},

		_appendGhost: function () {
			if (!ghostEl) {
				var rect = dragEl.getBoundingClientRect(),
					css = _css(dragEl),
					options = this.options,
					ghostRect;

				ghostEl = dragEl.cloneNode(true);

				_toggleClass(ghostEl, options.ghostClass, false);
				_toggleClass(ghostEl, options.fallbackClass, true);
				_toggleClass(ghostEl, options.dragClass, true);

				_css(ghostEl, 'top', rect.top - parseInt(css.marginTop, 10));
				_css(ghostEl, 'left', rect.left - parseInt(css.marginLeft, 10));
				_css(ghostEl, 'width', rect.width);
				_css(ghostEl, 'height', rect.height);
				_css(ghostEl, 'opacity', '0.8');
				_css(ghostEl, 'position', 'fixed');
				_css(ghostEl, 'zIndex', '100000');
				_css(ghostEl, 'pointerEvents', 'none');

				options.fallbackOnBody && document.body.appendChild(ghostEl) || rootEl.appendChild(ghostEl);

				// Fixing dimensions.
				ghostRect = ghostEl.getBoundingClientRect();
				_css(ghostEl, 'width', rect.width * 2 - ghostRect.width);
				_css(ghostEl, 'height', rect.height * 2 - ghostRect.height);
			}
		},

		_onDragStart: function (/**Event*/evt, /**boolean*/useFallback) {
			var _this = this;
			var dataTransfer = evt.dataTransfer;
			var options = _this.options;

			_this._offUpEvents();

			if (activeGroup.checkPull(_this, _this, dragEl, evt)) {
				cloneEl = _clone(dragEl);

				cloneEl.draggable = false;
				cloneEl.style['will-change'] = '';

				_css(cloneEl, 'display', 'none');
				_toggleClass(cloneEl, _this.options.chosenClass, false);

				// #1143: IFrame support workaround
				_this._cloneId = _nextTick(function () {
					rootEl.insertBefore(cloneEl, dragEl);
					_dispatchEvent(_this, rootEl, 'clone', dragEl);
				});
			}

			_toggleClass(dragEl, options.dragClass, true);

			if (useFallback) {
				if (useFallback === 'touch') {
					// Bind touch events
					_on(document, 'touchmove', _this._onTouchMove);
					_on(document, 'touchend', _this._onDrop);
					_on(document, 'touchcancel', _this._onDrop);

					if (options.supportPointer) {
						_on(document, 'pointermove', _this._onTouchMove);
						_on(document, 'pointerup', _this._onDrop);
					}
				} else {
					// Old brwoser
					_on(document, 'mousemove', _this._onTouchMove);
					_on(document, 'mouseup', _this._onDrop);
				}

				_this._loopId = setInterval(_this._emulateDragOver, 50);
			}
			else {
				if (dataTransfer) {
					dataTransfer.effectAllowed = 'move';
					options.setData && options.setData.call(_this, dataTransfer, dragEl);
				}

				_on(document, 'drop', _this);

				// #1143: Бывает элемент с IFrame внутри блокирует `drop`,
				// поэтому если вызвался `mouseover`, значит надо отменять весь d'n'd.
				// Breaking Chrome 62+
				// _on(document, 'mouseover', _this);

				_this._dragStartId = _nextTick(_this._dragStarted);
			}
		},

		_onDragOver: function (/**Event*/evt) {
			var el = this.el,
				target,
				dragRect,
				targetRect,
				revert,
				options = this.options,
				group = options.group,
				activeSortable = Sortable.active,
				isOwner = (activeGroup === group),
				isMovingBetweenSortable = false,
				canSort = options.sort;

			if (evt.preventDefault !== void 0) {
				evt.preventDefault();
				!options.dragoverBubble && evt.stopPropagation();
			}

			if (dragEl.animated) {
				return;
			}

			moved = true;

			if (activeSortable && !options.disabled &&
				(isOwner
					? canSort || (revert = !rootEl.contains(dragEl)) // Reverting item into the original list
					: (
						putSortable === this ||
						(
							(activeSortable.lastPullMode = activeGroup.checkPull(this, activeSortable, dragEl, evt)) &&
							group.checkPut(this, activeSortable, dragEl, evt)
						)
					)
				) &&
				(evt.rootEl === void 0 || evt.rootEl === this.el) // touch fallback
			) {
				// Smart auto-scrolling
				_autoScroll(evt, options, this.el);

				if (_silent) {
					return;
				}

				target = _closest(evt.target, options.draggable, el);
				dragRect = dragEl.getBoundingClientRect();

				if (putSortable !== this) {
					putSortable = this;
					isMovingBetweenSortable = true;
				}

				if (revert) {
					_cloneHide(activeSortable, true);
					parentEl = rootEl; // actualization

					if (cloneEl || nextEl) {
						rootEl.insertBefore(dragEl, cloneEl || nextEl);
					}
					else if (!canSort) {
						rootEl.appendChild(dragEl);
					}

					return;
				}


				if ((el.children.length === 0) || (el.children[0] === ghostEl) ||
					(el === evt.target) && (_ghostIsLast(el, evt))
				) {
					//assign target only if condition is true
					if (el.children.length !== 0 && el.children[0] !== ghostEl && el === evt.target) {
						target = el.lastElementChild;
					}

					if (target) {
						if (target.animated) {
							return;
						}

						targetRect = target.getBoundingClientRect();
					}

					_cloneHide(activeSortable, isOwner);

					if (_onMove(rootEl, el, dragEl, dragRect, target, targetRect, evt) !== false) {
						if (!dragEl.contains(el)) {
							el.appendChild(dragEl);
							parentEl = el; // actualization
						}

						this._animate(dragRect, dragEl);
						target && this._animate(targetRect, target);
					}
				}
				else if (target && !target.animated && target !== dragEl && (target.parentNode[expando] !== void 0)) {
					if (lastEl !== target) {
						lastEl = target;
						lastCSS = _css(target);
						lastParentCSS = _css(target.parentNode);
					}

					targetRect = target.getBoundingClientRect();

					var width = targetRect.right - targetRect.left,
						height = targetRect.bottom - targetRect.top,
						floating = R_FLOAT.test(lastCSS.cssFloat + lastCSS.display)
							|| (lastParentCSS.display == 'flex' && lastParentCSS['flex-direction'].indexOf('row') === 0),
						isWide = (target.offsetWidth > dragEl.offsetWidth),
						isLong = (target.offsetHeight > dragEl.offsetHeight),
						halfway = (floating ? (evt.clientX - targetRect.left) / width : (evt.clientY - targetRect.top) / height) > 0.5,
						nextSibling = target.nextElementSibling,
						after = false
					;

					if (floating) {
						var elTop = dragEl.offsetTop,
							tgTop = target.offsetTop;

						if (elTop === tgTop) {
							after = (target.previousElementSibling === dragEl) && !isWide || halfway && isWide;
						}
						else if (target.previousElementSibling === dragEl || dragEl.previousElementSibling === target) {
							after = (evt.clientY - targetRect.top) / height > 0.5;
						} else {
							after = tgTop > elTop;
						}
						} else if (!isMovingBetweenSortable) {
						after = (nextSibling !== dragEl) && !isLong || halfway && isLong;
					}

					var moveVector = _onMove(rootEl, el, dragEl, dragRect, target, targetRect, evt, after);

					if (moveVector !== false) {
						if (moveVector === 1 || moveVector === -1) {
							after = (moveVector === 1);
						}

						_silent = true;
						setTimeout(_unsilent, 30);

						_cloneHide(activeSortable, isOwner);

						if (!dragEl.contains(el)) {
							if (after && !nextSibling) {
								el.appendChild(dragEl);
							} else {
								target.parentNode.insertBefore(dragEl, after ? nextSibling : target);
							}
						}

						parentEl = dragEl.parentNode; // actualization

						this._animate(dragRect, dragEl);
						this._animate(targetRect, target);
					}
				}
			}
		},

		_animate: function (prevRect, target) {
			var ms = this.options.animation;

			if (ms) {
				var currentRect = target.getBoundingClientRect();

				if (prevRect.nodeType === 1) {
					prevRect = prevRect.getBoundingClientRect();
				}

				_css(target, 'transition', 'none');
				_css(target, 'transform', 'translate3d('
					+ (prevRect.left - currentRect.left) + 'px,'
					+ (prevRect.top - currentRect.top) + 'px,0)'
				);

				target.offsetWidth; // repaint

				_css(target, 'transition', 'all ' + ms + 'ms');
				_css(target, 'transform', 'translate3d(0,0,0)');

				clearTimeout(target.animated);
				target.animated = setTimeout(function () {
					_css(target, 'transition', '');
					_css(target, 'transform', '');
					target.animated = false;
				}, ms);
			}
		},

		_offUpEvents: function () {
			var ownerDocument = this.el.ownerDocument;

			_off(document, 'touchmove', this._onTouchMove);
			_off(document, 'pointermove', this._onTouchMove);
			_off(ownerDocument, 'mouseup', this._onDrop);
			_off(ownerDocument, 'touchend', this._onDrop);
			_off(ownerDocument, 'pointerup', this._onDrop);
			_off(ownerDocument, 'touchcancel', this._onDrop);
			_off(ownerDocument, 'pointercancel', this._onDrop);
			_off(ownerDocument, 'selectstart', this);
		},

		_onDrop: function (/**Event*/evt) {
			var el = this.el,
				options = this.options;

			clearInterval(this._loopId);
			clearInterval(autoScroll.pid);
			clearTimeout(this._dragStartTimer);

			_cancelNextTick(this._cloneId);
			_cancelNextTick(this._dragStartId);

			// Unbind events
			_off(document, 'mouseover', this);
			_off(document, 'mousemove', this._onTouchMove);

			if (this.nativeDraggable) {
				_off(document, 'drop', this);
				_off(el, 'dragstart', this._onDragStart);
			}

			this._offUpEvents();

			if (evt) {
				if (moved) {
					evt.preventDefault();
					!options.dropBubble && evt.stopPropagation();
				}

				ghostEl && ghostEl.parentNode && ghostEl.parentNode.removeChild(ghostEl);

				if (rootEl === parentEl || Sortable.active.lastPullMode !== 'clone') {
					// Remove clone
					cloneEl && cloneEl.parentNode && cloneEl.parentNode.removeChild(cloneEl);
				}

				if (dragEl) {
					if (this.nativeDraggable) {
						_off(dragEl, 'dragend', this);
					}

					_disableDraggable(dragEl);
					dragEl.style['will-change'] = '';

					// Remove class's
					_toggleClass(dragEl, this.options.ghostClass, false);
					_toggleClass(dragEl, this.options.chosenClass, false);

					// Drag stop event
					_dispatchEvent(this, rootEl, 'unchoose', dragEl, parentEl, rootEl, oldIndex);

					if (rootEl !== parentEl) {
						newIndex = _index(dragEl, options.draggable);

						if (newIndex >= 0) {
							// Add event
							_dispatchEvent(null, parentEl, 'add', dragEl, parentEl, rootEl, oldIndex, newIndex);

							// Remove event
							_dispatchEvent(this, rootEl, 'remove', dragEl, parentEl, rootEl, oldIndex, newIndex);

							// drag from one list and drop into another
							_dispatchEvent(null, parentEl, 'sort', dragEl, parentEl, rootEl, oldIndex, newIndex);
							_dispatchEvent(this, rootEl, 'sort', dragEl, parentEl, rootEl, oldIndex, newIndex);
						}
					}
					else {
						if (dragEl.nextSibling !== nextEl) {
							// Get the index of the dragged element within its parent
							newIndex = _index(dragEl, options.draggable);

							if (newIndex >= 0) {
								// drag & drop within the same list
								_dispatchEvent(this, rootEl, 'update', dragEl, parentEl, rootEl, oldIndex, newIndex);
								_dispatchEvent(this, rootEl, 'sort', dragEl, parentEl, rootEl, oldIndex, newIndex);
							}
						}
					}

					if (Sortable.active) {
						/* jshint eqnull:true */
						if (newIndex == null || newIndex === -1) {
							newIndex = oldIndex;
						}

						_dispatchEvent(this, rootEl, 'end', dragEl, parentEl, rootEl, oldIndex, newIndex);

						// Save sorting
						this.save();
					}
				}

			}

			this._nulling();
		},

		_nulling: function() {
			rootEl =
			dragEl =
			parentEl =
			ghostEl =
			nextEl =
			cloneEl =
			lastDownEl =

			scrollEl =
			scrollParentEl =

			tapEvt =
			touchEvt =

			moved =
			newIndex =

			lastEl =
			lastCSS =

			putSortable =
			activeGroup =
			Sortable.active = null;

			savedInputChecked.forEach(function (el) {
				el.checked = true;
			});
			savedInputChecked.length = 0;
		},

		handleEvent: function (/**Event*/evt) {
			switch (evt.type) {
				case 'drop':
				case 'dragend':
					this._onDrop(evt);
					break;

				case 'dragover':
				case 'dragenter':
					if (dragEl) {
						this._onDragOver(evt);
						_globalDragOver(evt);
					}
					break;

				case 'mouseover':
					this._onDrop(evt);
					break;

				case 'selectstart':
					evt.preventDefault();
					break;
			}
		},


		/**
		 * Serializes the item into an array of string.
		 * @returns {String[]}
		 */
		toArray: function () {
			var order = [],
				el,
				children = this.el.children,
				i = 0,
				n = children.length,
				options = this.options;

			for (; i < n; i++) {
				el = children[i];
				if (_closest(el, options.draggable, this.el)) {
					order.push(el.getAttribute(options.dataIdAttr) || _generateId(el));
				}
			}

			return order;
		},


		/**
		 * Sorts the elements according to the array.
		 * @param  {String[]}  order  order of the items
		 */
		sort: function (order) {
			var items = {}, rootEl = this.el;

			this.toArray().forEach(function (id, i) {
				var el = rootEl.children[i];

				if (_closest(el, this.options.draggable, rootEl)) {
					items[id] = el;
				}
			}, this);

			order.forEach(function (id) {
				if (items[id]) {
					rootEl.removeChild(items[id]);
					rootEl.appendChild(items[id]);
				}
			});
		},


		/**
		 * Save the current sorting
		 */
		save: function () {
			var store = this.options.store;
			store && store.set(this);
		},


		/**
		 * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
		 * @param   {HTMLElement}  el
		 * @param   {String}       [selector]  default: `options.draggable`
		 * @returns {HTMLElement|null}
		 */
		closest: function (el, selector) {
			return _closest(el, selector || this.options.draggable, this.el);
		},


		/**
		 * Set/get option
		 * @param   {string} name
		 * @param   {*}      [value]
		 * @returns {*}
		 */
		option: function (name, value) {
			var options = this.options;

			if (value === void 0) {
				return options[name];
			} else {
				options[name] = value;

				if (name === 'group') {
					_prepareGroup(options);
				}
			}
		},


		/**
		 * Destroy
		 */
		destroy: function () {
			var el = this.el;

			el[expando] = null;

			_off(el, 'mousedown', this._onTapStart);
			_off(el, 'touchstart', this._onTapStart);
			_off(el, 'pointerdown', this._onTapStart);

			if (this.nativeDraggable) {
				_off(el, 'dragover', this);
				_off(el, 'dragenter', this);
			}

			// Remove draggable attributes
			Array.prototype.forEach.call(el.querySelectorAll('[draggable]'), function (el) {
				el.removeAttribute('draggable');
			});

			touchDragOverListeners.splice(touchDragOverListeners.indexOf(this._onDragOver), 1);

			this._onDrop();

			this.el = el = null;
		}
	};


	function _cloneHide(sortable, state) {
		if (sortable.lastPullMode !== 'clone') {
			state = true;
		}

		if (cloneEl && (cloneEl.state !== state)) {
			_css(cloneEl, 'display', state ? 'none' : '');

			if (!state) {
				if (cloneEl.state) {
					if (sortable.options.group.revertClone) {
						rootEl.insertBefore(cloneEl, nextEl);
						sortable._animate(dragEl, cloneEl);
					} else {
						rootEl.insertBefore(cloneEl, dragEl);
					}
				}
			}

			cloneEl.state = state;
		}
	}


	function _closest(/**HTMLElement*/el, /**String*/selector, /**HTMLElement*/ctx) {
		if (el) {
			ctx = ctx || document;

			do {
				if ((selector === '>*' && el.parentNode === ctx) || _matches(el, selector)) {
					return el;
				}
				/* jshint boss:true */
			} while (el = _getParentOrHost(el));
		}

		return null;
	}


	function _getParentOrHost(el) {
		var parent = el.host;

		return (parent && parent.nodeType) ? parent : el.parentNode;
	}


	function _globalDragOver(/**Event*/evt) {
		if (evt.dataTransfer) {
			evt.dataTransfer.dropEffect = 'move';
		}
		evt.preventDefault();
	}


	function _on(el, event, fn) {
		el.addEventListener(event, fn, captureMode);
	}


	function _off(el, event, fn) {
		el.removeEventListener(event, fn, captureMode);
	}


	function _toggleClass(el, name, state) {
		if (el) {
			if (el.classList) {
				el.classList[state ? 'add' : 'remove'](name);
			}
			else {
				var className = (' ' + el.className + ' ').replace(R_SPACE, ' ').replace(' ' + name + ' ', ' ');
				el.className = (className + (state ? ' ' + name : '')).replace(R_SPACE, ' ');
			}
		}
	}


	function _css(el, prop, val) {
		var style = el && el.style;

		if (style) {
			if (val === void 0) {
				if (document.defaultView && document.defaultView.getComputedStyle) {
					val = document.defaultView.getComputedStyle(el, '');
				}
				else if (el.currentStyle) {
					val = el.currentStyle;
				}

				return prop === void 0 ? val : val[prop];
			}
			else {
				if (!(prop in style)) {
					prop = '-webkit-' + prop;
				}

				style[prop] = val + (typeof val === 'string' ? '' : 'px');
			}
		}
	}


	function _find(ctx, tagName, iterator) {
		if (ctx) {
			var list = ctx.getElementsByTagName(tagName), i = 0, n = list.length;

			if (iterator) {
				for (; i < n; i++) {
					iterator(list[i], i);
				}
			}

			return list;
		}

		return [];
	}



	function _dispatchEvent(sortable, rootEl, name, targetEl, toEl, fromEl, startIndex, newIndex) {
		sortable = (sortable || rootEl[expando]);

		var evt = document.createEvent('Event'),
			options = sortable.options,
			onName = 'on' + name.charAt(0).toUpperCase() + name.substr(1);

		evt.initEvent(name, true, true);

		evt.to = toEl || rootEl;
		evt.from = fromEl || rootEl;
		evt.item = targetEl || rootEl;
		evt.clone = cloneEl;

		evt.oldIndex = startIndex;
		evt.newIndex = newIndex;

		rootEl.dispatchEvent(evt);

		if (options[onName]) {
			options[onName].call(sortable, evt);
		}
	}


	function _onMove(fromEl, toEl, dragEl, dragRect, targetEl, targetRect, originalEvt, willInsertAfter) {
		var evt,
			sortable = fromEl[expando],
			onMoveFn = sortable.options.onMove,
			retVal;

		evt = document.createEvent('Event');
		evt.initEvent('move', true, true);

		evt.to = toEl;
		evt.from = fromEl;
		evt.dragged = dragEl;
		evt.draggedRect = dragRect;
		evt.related = targetEl || toEl;
		evt.relatedRect = targetRect || toEl.getBoundingClientRect();
		evt.willInsertAfter = willInsertAfter;

		fromEl.dispatchEvent(evt);

		if (onMoveFn) {
			retVal = onMoveFn.call(sortable, evt, originalEvt);
		}

		return retVal;
	}


	function _disableDraggable(el) {
		el.draggable = false;
	}


	function _unsilent() {
		_silent = false;
	}


	/** @returns {HTMLElement|false} */
	function _ghostIsLast(el, evt) {
		var lastEl = el.lastElementChild,
			rect = lastEl.getBoundingClientRect();

		// 5 — min delta
		// abs — нельзя добавлять, а то глюки при наведении сверху
		return (evt.clientY - (rect.top + rect.height) > 5) ||
			(evt.clientX - (rect.left + rect.width) > 5);
	}


	/**
	 * Generate id
	 * @param   {HTMLElement} el
	 * @returns {String}
	 * @private
	 */
	function _generateId(el) {
		var str = el.tagName + el.className + el.src + el.href + el.textContent,
			i = str.length,
			sum = 0;

		while (i--) {
			sum += str.charCodeAt(i);
		}

		return sum.toString(36);
	}

	/**
	 * Returns the index of an element within its parent for a selected set of
	 * elements
	 * @param  {HTMLElement} el
	 * @param  {selector} selector
	 * @return {number}
	 */
	function _index(el, selector) {
		var index = 0;

		if (!el || !el.parentNode) {
			return -1;
		}

		while (el && (el = el.previousElementSibling)) {
			if ((el.nodeName.toUpperCase() !== 'TEMPLATE') && (selector === '>*' || _matches(el, selector))) {
				index++;
			}
		}

		return index;
	}

	function _matches(/**HTMLElement*/el, /**String*/selector) {
		if (el) {
			selector = selector.split('.');

			var tag = selector.shift().toUpperCase(),
				re = new RegExp('\\s(' + selector.join('|') + ')(?=\\s)', 'g');

			return (
				(tag === '' || el.nodeName.toUpperCase() == tag) &&
				(!selector.length || ((' ' + el.className + ' ').match(re) || []).length == selector.length)
			);
		}

		return false;
	}

	function _throttle(callback, ms) {
		var args, _this;

		return function () {
			if (args === void 0) {
				args = arguments;
				_this = this;

				setTimeout(function () {
					if (args.length === 1) {
						callback.call(_this, args[0]);
					} else {
						callback.apply(_this, args);
					}

					args = void 0;
				}, ms);
			}
		};
	}

	function _extend(dst, src) {
		if (dst && src) {
			for (var key in src) {
				if (src.hasOwnProperty(key)) {
					dst[key] = src[key];
				}
			}
		}

		return dst;
	}

	function _clone(el) {
		if (Polymer && Polymer.dom) {
			return Polymer.dom(el).cloneNode(true);
		}
		else if ($) {
			return $(el).clone(true)[0];
		}
		else {
			return el.cloneNode(true);
		}
	}

	function _saveInputCheckedState(root) {
		var inputs = root.getElementsByTagName('input');
		var idx = inputs.length;

		while (idx--) {
			var el = inputs[idx];
			el.checked && savedInputChecked.push(el);
		}
	}

	function _nextTick(fn) {
		return setTimeout(fn, 0);
	}

	function _cancelNextTick(id) {
		return clearTimeout(id);
	}

	// Fixed #973:
	_on(document, 'touchmove', function (evt) {
		if (Sortable.active) {
			evt.preventDefault();
		}
	});

	// Export utils
	Sortable.utils = {
		on: _on,
		off: _off,
		css: _css,
		find: _find,
		is: function (el, selector) {
			return !!_closest(el, selector, el);
		},
		extend: _extend,
		throttle: _throttle,
		closest: _closest,
		toggleClass: _toggleClass,
		clone: _clone,
		index: _index,
		nextTick: _nextTick,
		cancelNextTick: _cancelNextTick
	};


	/**
	 * Create sortable instance
	 * @param {HTMLElement}  el
	 * @param {Object}      [options]
	 */
	Sortable.create = function (el, options) {
		return new Sortable(el, options);
	};


	// Export
	Sortable.version = '1.7.0';
	return Sortable;
});

var dfd_header_b = dfd_header_b || {};
dfd_header_b.View = [
];
dfd_header_b.View.Input = [
];
dfd_header_b.View.Setting = [
];
dfd_header_b.Model = [
];
dfd_header_b.Collection = [
];
dfd_header_b.APP = [
];
//dfd_header_b.Config = [
//];
dfd_header_b.HTMLEntity={};
/*
 * Defaault Preset for horizontal
 */

dfd_header_b.isInitColorPicker = false;
dfd_header_b.isInitSlider = false;
dfd_header_b.changeslider = true;
dfd_header_b.isFirstStart = true;
dfd_header_b.isnotifyEnable = true;
dfd_header_b.isClickedNewPreset = false;
dfd_header_b.sidePadding = 30;
dfd_header_b.Padding = 10;
dfd_header_b.isInit = false;
(function($){
//	'use strict';
	$(document).ready(function(){
		initHeaderBuilder = function(){
			dfd_header_b.APP.appview = new dfd_header_b.View.AppView();
			dfd_header_b.APP.settingview = new dfd_header_b.View.SettingsView();
		}
		var header_builder_val = $("input[name='native[is_header_builder_enabled]']:checked").val();
		if($("#native-header_builder").is(":visible") && header_builder_val == "on"){
			initHeaderBuilder();
			dfd_header_b.isInit = true;
		}
		var main_btn_set = $("#native-is_header_builder_enabled").find(".dfd-options-two-buttons-set");
		main_btn_set.one("click", function(){
			setTimeout(function(){
				var header_builder_val = $("input[name='native[is_header_builder_enabled]']:checked").val();
				if(header_builder_val == "on"){
					initHeaderBuilder();
					dfd_header_b.isInit = true;
				}
			}, 200);
		});
		$(".redux-group-tab-link-li").on("click", function(){
			if(!dfd_header_b.isInit && header_builder_val == "on"){
				if($("#native-header_builder").is(":visible")){
					initHeaderBuilder();
					dfd_header_b.isInit = true;
				}
			}
		});
	});
})(jQuery);
var dfd_header_b = dfd_header_b || {};
dfd_header_b.HTMLEntity = {
	BuilderApp: {
		top: {
			left: "#dfd_header_t_preview .top .t_l1_left.left .wrapper",
			center: "#dfd_header_t_preview .top .t_l2_left.center .wrapper",
			right: "#dfd_header_t_preview .top .t_l3_left.right .wrapper",
		},
		middle: {
			left: "#dfd_header_t_preview .middle .t_l1_left.left .wrapper",
			center: "#dfd_header_t_preview .middle .t_l2_left.center .wrapper",
			right: "#dfd_header_t_preview .middle .t_l3_left.right .wrapper",
		},
		bottom: {
			left: "#dfd_header_t_preview .bottom .t_l1_left.left .wrapper",
			center: "#dfd_header_t_preview .bottom .t_l2_left.center .wrapper",
			right: "#dfd_header_t_preview .bottom .t_l3_left.right .wrapper",
		},
	},
	emulateDrag: {
		wrrap: ".t_wrap",
		wrrap_left: ".t_wrap .left",
		wrrap_right: ".t_wrap .right",
	},
	Sortable: {
		controls_block: "dfd_header_t_controls",
		preset_close: ".preset-window .close"
	},
	MainBlocks:{
		preview : "#dfd_header_t_preview",
		controls : "#dfd_header_t_controls"
	},
	start_drag_class : "start-drag",
	
	resetBtn:".button-view-switcher .dfd-options-button-cover",
	
	optionInput : "#header_builder_options",
};


dfd_header_b.APP.Builder = (function($){
	var paste = [
	];
	position = {
		top: {
			left: "",
			center: "",
			right: "",
		},
		middle: {
			left: "",
			center: "",
			right: "",
		},
		bottom: {
			left: "",
			center: "",
			right: "",
		},
	};
	initPosition = function(){
		position = {
			top: {
				left: $(dfd_header_b.HTMLEntity.BuilderApp.top.left),
				center: $(dfd_header_b.HTMLEntity.BuilderApp.top.center),
				right: $(dfd_header_b.HTMLEntity.BuilderApp.top.right),
			},
			middle: {
				left: $(dfd_header_b.HTMLEntity.BuilderApp.middle.left),
				center: $(dfd_header_b.HTMLEntity.BuilderApp.middle.center),
				right: $(dfd_header_b.HTMLEntity.BuilderApp.middle.right),
			},
			bottom: {
				left: $(dfd_header_b.HTMLEntity.BuilderApp.bottom.left),
				center: $(dfd_header_b.HTMLEntity.BuilderApp.bottom.center),
				right: $(dfd_header_b.HTMLEntity.BuilderApp.bottom.right),
			},
		};
	};
	clearAll = function(){
		position.top.left.html("");
		position.top.center.html("");
		position.top.right.html("");

		position.middle.left.html("");
		position.middle.center.html("");
		position.middle.right.html("");

		position.bottom.left.html("");
		position.bottom.center.html("");
		position.bottom.right.html("");
	};
	/**
	 * 
	 * @param {dfd_header_b.APP.Sortable} sortable
	 * @returns array
	 */
	build = function(reinitSett){

		triggerReset();
		initPosition();
		clearAll();
		buildPreset(reinitSett);
		dfd_header_b.APP.collection.trigger("reInit");

	};
	buildPreset = function(reinitSett){
		var settings = dfd_header_b.Config.getCurrentSetting();
		var global_setting = dfd_header_b.Config.getGlobalSetting();

		if(settings != ""){
			dfd_header_b.Helper.normalizeLocalSetting();
			var settings = dfd_header_b.Config.getCurrentSetting()
			dfd_header_b.Config.setSettingByView(settings);
		} else {

			dfd_header_b.APP.settingCollection.trigger("reset");
			var new_sett = dfd_header_b.APP.settingCollection.toJSON();
			var new_global_sett = dfd_header_b.APP.globalSettingCollection.toJSON();

			dfd_header_b.Config.setSettingByView(new_sett);
			dfd_header_b.Config.setGlobalSetting(new_global_sett);
		}
		reinitSett = reinitSett == undefined ? true : false;
		if(reinitSett){
			dfd_header_b.View.Setting.init();
		} else {
			dfd_header_b.View.Setting.reInit();
		}


		var preset = dfd_header_b.Config.getCurrentPreset();

		for(var row in preset) {


			var row_el = preset[row];
			for(var col in row_el) {

				var col_el = row_el[col];
				for(var el  in col_el) {
//					row col
					if(_.isObject(col_el[el])){
						pasteObjToGrid(row, col, col_el[el]);
					}
				}
			}
		}

		this.addMarkerToCol();
		dfd_header_b.Helper.calculateOptimalLogoWidth();
		dfd_header_b.Dependency.init();
	};
	addMarkerToCol = function(){
		switcher = function(pos){
			if($(pos).children().length > 0){
				$(pos).addClass("hasEl");
			} else {
				$(pos).removeClass("hasEl");
			}
		};
		for(var key in this.position) {
			var pos = this.position[key];
			switcher(pos.left);
			switcher(pos.center);
			switcher(pos.right);
		}
	};
	pasteObjToGrid = function(row, col, obj){
		var type = obj.type;

		var row_el = "";
		var col_el = "";
		row = parseInt(row);
		col = parseInt(col);
		var canshow = dfd_header_b.View.Setting.canShow();

		switch (row) {
			case 0 :
				if(dfd_header_b.View.Setting.isShowTopPanel() || !canshow){
					row_el = "top";
				}
				break;
			case 1 :
				if(dfd_header_b.View.Setting.isShowMidPanel() || !canshow){
					row_el = "middle";
				}
				break;
			case 2 :
				if(dfd_header_b.View.Setting.isShowBotPanel() || !canshow){
					row_el = "bottom";
				}
				break;
		}
		switch (col) {
			case 0 :
				col_el = "left";
				break;
			case 1 :
				if(canshow){
					col_el = "center";
				}
				break;
			case 2 :
				if(canshow){
					col_el = "right";
				}
				break;
		}

		if(row_el != "" && col_el != ""){
			var models = dfd_header_b.APP.collection.where({type: type});
			if(models[0].get("type") == "delimiter" || models[0].get("type") == "spacer"){
				models[0] = models[0].clone();

			}
			var paste_el = models[0];
			var element = new dfd_header_b.View.ElementPrevView({model: paste_el});
			position[row_el][col_el].append(element.render().el);

			dfd_header_b.APP.collection_prev.add(paste_el);
			dfd_header_b.APP.collection.remove(paste_el);

		}
	};
	triggerReset = function(){
		dfd_header_b.APP.collection.reset();

		dfd_header_b.APP.collection_prev.reset();

		var preset = dfd_header_b.Helper.normalizeElementsCollection();

		dfd_header_b.APP.collection.reset(preset,
				{parse: true}
		);
		dfd_header_b.APP.settingCollection.reset(dfd_header_b.PreSetting, {parse: true});
	};
	addEllToPreview = function(){

	};
	return {
		build: build
	};
})(jQuery);

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
var dfd_header_b = dfd_header_b || {};

dfd_header_b.APP.Sortable = (function($){
	controls = {
		left: [
		],
		right: [
		],
		center: [
		],
	}
	var has_created = false;
	var row = 3, col = 3;
	var $this = this;
	var controls_container_name = dfd_header_b.HTMLEntity.Sortable.controls_block;

	emulateDrag = function(){
		$(dfd_header_b.HTMLEntity.emulateDrag.wrrap).addClass("start");
		$(dfd_header_b.HTMLEntity.emulateDrag.wrrap_left).addClass("start");
		$(dfd_header_b.HTMLEntity.emulateDrag.wrrap_right).addClass("start");
	};
	/**
	 * 
	 * @returns {Array}
	 */
	getValuesFormAllCells = function(){
		var mass = [
			[
				0,
				0,
				0
			],
			[
				0,
				0,
				0
			],
			[
				0,
				0,
				0
			]
		];
		for(var i = 0; i < row; i++) {
			for(j = 0; j < col; j++) {
				switch (j) {
					case 0 :
						if(controls.left[i]){
							mass[i][j] = getModelsByIds(controls.left[i].toArray());
						}
						break;
					case 1 :
						if(controls.center[i]){
							mass[i][j] = getModelsByIds(controls.center[i].toArray());
						}

						break;
					case 2 :
						if(controls.right[i]){
							mass[i][j] = getModelsByIds(controls.right[i].toArray());
						}
						break;
				}
			}
		}
		return mass;
	};
	emulateParse = function(){
		var mass = getValuesFormAllCells();
		var strin = JSON.stringify(mass, [
			"id",
			"name",
			"type",
			"isfullwidth"
		], 4);
		$(".debug").show();
		$(".debug.left").html(strin);
	};
	_copyPresetCode = function(){
		var active_preset = dfd_header_b.APP.presets.findWhere({isActive: "active"});
		var settings = active_preset.get("settings");
		dfd_header_b.Helper.removeNullEl(settings, "desktop");
		dfd_header_b.Helper.removeNullEl(settings, "tablet");
		dfd_header_b.Helper.removeNullEl(settings, "mobile");
		dfd_header_b.Helper.removeNullEl(settings, "globals");
		active_preset.set({settings: settings});
		var code = JSON.stringify(active_preset);
	};
	_debug = function(){
		var mass = dfd_header_b.APP.collection.toArray();
		var mass2 = dfd_header_b.APP.collection_prev.toArray();
		var strin = JSON.stringify(mass, [
			"id",
			"type",
			"isfullwidth"
//			"temp"
		], 4);
		var strin2 = JSON.stringify(mass2, [
			"id",
			"type",
			"isfullwidth"
//			"temp"
		], 4);
		$(".debug").show();
		$(".debug.right").html(strin2 + "<br>--------<br>");
		$(".debug.right").append(strin);
	};
	events = function(){
		
		$(dfd_header_b.HTMLEntity.MainBlocks.preview).on("mouseover", ".c_el", function(){
			return false;
		});
		$(dfd_header_b.HTMLEntity.MainBlocks.preview).on("mouseleave", ".container", function(){
			var cont = $(this).removeClass("hover-element");
			return false;
		});
		$(dfd_header_b.HTMLEntity.MainBlocks.preview).on("mouseleave", ".c_el", function(){
			var cont = $(this).parents(".container").removeClass("hover-element");
			return false;
		});
		$(dfd_header_b.HTMLEntity.Sortable.preset_close).on("click", function(){
			var sidebar = $(this).parent();
			sidebar.parent().removeClass("preset-open");
		});
	};
	/**
	 * 
	 * @param {Array} model_id
	 * @returns {dfd_header_b.Collection.Elements}
	 */
	getModelsByIds = function(model_id){
		var models = _.map(model_id, function(num){
			var model = dfd_header_b.APP.collection.get(num);
			if(_.isObject(model)){
				return model;
			} else {
				return dfd_header_b.APP.collection_prev.get(num);
			}
		});
		return models;
	};

	init = function(){
		$(".c_el").on("touch touchmove", function(){
			$("body").disablescroll();
		});
		var $this = this;

		var controls_id = $("#" + controls_container_name)[0];
		if(has_created){
			return false;
		}
		events();

		createSort(controls_id, 'controls', [
			'controls',
			'preview_left',
			'preview_center',
			'preview_right',
		]);

		var preview_left = $(".t_wrap .t_l1_left .wrapper");
		var preview_center = $(".t_wrap .t_l2_left .wrapper");
		var preview_right = $(".t_wrap .t_l3_left .wrapper");

		preview_left.each(function(){
			controls.left.push(createSort(this, 'preview_left', [
				'controls',
				'preview_left',
				'preview_center',
				'preview_right',
			]));
		});
		preview_center.each(function(){
			controls.center.push(createSort(this, 'preview_center', [
				'controls',
				'preview_left',
				'preview_center',
				'preview_right',
			]));

		});
		preview_right.each(function(){
			controls.right.push(createSort(this, 'preview_right', [
				'controls',
				'preview_left',
				'preview_center',
				'preview_right',
			]));
		});
		has_created = true;
	};
	EventObject = {
		item: "",
		from: "",
		to: "",
		from_id: "",
		to_id: "",
		model_id: "",
		direction_from: "",
		direction_to: "",
		clear: function(){
			this.item = "";
			this.from = "";
			this.to = "";
			this.from_id = "";
			this.to_id = "";
			this.model_id = "";
			this.direction_from = "";
			this.direction_to = "";
		},
		/**
		 * Posible values: prevToprev,prevTocontrols, controlsToprev, controlsTocontrols,
		 * @returns {String}
		 */
		getDirection: function(){
			return this.direction_from + "To" + this.direction_to;
		},
		setDirection: function(){
			var from = $(this.from).hasClass("wrapper");
			if(from){
				this.direction_from = "prev";
			} else {
				this.direction_from = "controls";
			}
			var to = $(this.to).hasClass("wrapper");
			if(to){
				this.direction_to = "prev";
			} else {
				this.direction_to = "controls";
			}
		}
	}
	prepareObject = function(evt){
		EventObject.clear();
		EventObject.item = evt.item;
		EventObject.from = evt.from;
		EventObject.to = evt.to;
		EventObject.from_id = $(EventObject.from).attr("id");
		EventObject.to_id = $(EventObject.to).attr("id");
		EventObject.model_id = $(EventObject.item).attr("id");
		EventObject.setDirection();
	};
	addElement = function(evt){
		prepareObject(evt);
		var direction = EventObject.getDirection();
		var model = dfd_header_b.APP.collection.get(EventObject.model_id);
		var model_prev = dfd_header_b.APP.collection_prev.get(EventObject.model_id);

		if(_.isObject(model)){
			var onlim = model.get("onlimit");
			if(onlim == false){
				dfd_header_b.APP.collection_prev.add(model);
				dfd_header_b.APP.collection.remove(model);
			}
		}
		if(_.isObject(model_prev)){
			var onlim = model_prev.get("onlimit");
			if(onlim == false){
				if(direction != "prevToprev"){
					dfd_header_b.APP.collection.add(model_prev);
					dfd_header_b.APP.collection_prev.remove(model_prev);
				}
			}
		}
	};
	addOnLimitElements = function(evt){
		prepareObject(evt);

		var model = dfd_header_b.APP.collection.get(EventObject.model_id);
		var model_prev = dfd_header_b.APP.collection_prev.get(EventObject.model_id);

		var onlim = false;
		if(_.isObject(model)){
			onlim = model.get("onlimit");
			var type = model.get("type");
			if(onlim == true && EventObject.from_id == controls_container_name){
				var new_model = model.clone();
				new_model.set("id", "");
				var count = dfd_header_b.APP.collection.where({type: type});
				if(count.length <= 1){
					dfd_header_b.APP.collection.add(new_model);
				}
				dfd_header_b.APP.collection.remove(model);
				dfd_header_b.APP.collection_prev.add(model);

			}
		}
		if(_.isObject(model_prev)){
			onlim = model_prev.get("onlimit");
			if(onlim == true && EventObject.to_id == controls_container_name){
				dfd_header_b.APP.collection_prev.remove(model_prev);
				dfd_header_b.APP.collection.add(model_prev);
			}
		}
		dfd_header_b.Helper.saveChanges();
		setTimeout(function(){
			dfd_header_b.APP.Builder.build();
		}, 50);

	};

	createSort = function(obj, name, put, $this){
		return Sortable.create(obj, {
			group: {
				name: name,
				put: put
			},
			onStart: function(evt){

				$(dfd_header_b.HTMLEntity.emulateDrag.wrrap).addClass("start");
				$(dfd_header_b.HTMLEntity.emulateDrag.wrrap_left).addClass("start");
				$(dfd_header_b.HTMLEntity.emulateDrag.wrrap_right).addClass("start");
				dfd_header_b.Helper.claerTransformMiddleBlock();
				dfd_header_b.Helper.RoundContentTransform();
				evt.oldIndex;  // element index within parent
			},
			onMove: function(/**Event*/evt){
				var is_logo = $(evt.dragged).hasClass("Logo");
				if(is_logo){
					dfd_header_b.Helper.calculateOptimalLogoWidth();
				}
			},
			onAdd: function(evt){
				addOnLimitElements(evt);
				addElement(evt);

				var preset_name = dfd_header_b.Config.getCurentPresetName();
				if(preset_name == ""){
					dfd_header_b.Helper.addPresetWindow({hide: true});
					dfd_header_b.isClickedNewPreset = false;
				}
			},
			onEnd: function(evt){

				$(dfd_header_b.HTMLEntity.emulateDrag.wrrap).removeClass("start");
				$(dfd_header_b.HTMLEntity.emulateDrag.wrrap_left).removeClass("start");
				$(dfd_header_b.HTMLEntity.emulateDrag.wrrap_right).removeClass("start");
				$(evt.item).removeClass(dfd_header_b.HTMLEntity.start_drag_class);

				dfd_header_b.Helper.calculateOptimalLogoWidth();
				dfd_header_b.Helper.claerTransformMiddleBlock();
				dfd_header_b.Helper.RoundContentTransform();
				dfd_header_b.Helper.saveChanges();
				$("body").disablescroll("undo");
			},
			//			// Element is chosen
//			onChoose: function(/**Event*/evt){
//			},
//			// Attempt to drag a filtered element
			scroll: false,
			filter: '.hover-controls',
			onFilter: function(evt){
			},
			setData: function(/** DataTransfer */dataTransfer, /** HTMLElement*/dragEl){
				$(dragEl).addClass(dfd_header_b.HTMLEntity.start_drag_class);
				dataTransfer.setData('Text', dragEl.textContent); // `dataTransfer` object of HTML5 DragEvent
			},
			animation: 100,
		});
	};
	return  {
		init: init,
		controls: controls,
		getValuesFormAllCells: getValuesFormAllCells
	};
})(jQuery);


/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function($, window){
	'use strict';
	dfd_header_b.Helper = {
		presetWindowIsOpen: false,
		addPresetWindow: function(obj){
			tb_show("Add new preset", '#TB_inline?width=750&height=600&inlineId=examplePopup1');
			$("#TB_window").addClass("add-preset");
			var new_preset = new dfd_header_b.View.Add_Preset(obj);
			new_preset.render();
		},
		getFileExtension: function(filename)
		{
			var ext = /^.+\.([^.]+)$/.exec(filename);
			return ext == null ? "" : ext[1];
		},
		getBigImgFromthumb: function(image_thumb){
			var big_img = image_thumb.match(/(.*)-[\d]{1,5}x/);

			if(big_img){
				var ext = this.getFileExtension(image_thumb);
				big_img = big_img[1] + "." + ext;
			} else {
				big_img = image_thumb;
			}
			return  big_img;
		},
		classSwitcher: function(value, posible_values, target, prefix){
			function removeClasses(){
				for(var i = 0; i < posible_values.length; i++) {
					var curVal = prefix + "_" + posible_values[i];
					target.removeClass(curVal);
				}
			}
			for(var i = 0; i < posible_values.length; i++) {
				var curVal = posible_values[i];
				if(value == curVal){
					var addclass = prefix + "_" + value;
					removeClasses();
					target.addClass(addclass);
				}
			}
		},
		roundCssTransformMatrix: function(el){

			var mx = window.getComputedStyle(el, null);
			mx = mx.getPropertyValue("-webkit-transform") ||
					mx.getPropertyValue("-moz-transform") ||
					mx.getPropertyValue("-ms-transform") ||
					mx.getPropertyValue("-o-transform") ||
					mx.getPropertyValue("transform") || false;
			var values = mx.replace(/ |\(|\)|matrix/g, "").split(",");
			for(var v in values) {
				values[v] = v > 4 ? Math.ceil(values[v]) : values[v];
			}
			return values;


		},
		claerTransformMiddleBlock: function(){
			$("#container_middle_builder").css("transform", "");
		},
		RoundContentTransform: function(){

			var el_p = $("#container_middle_builder");
			var $this = this;
			setTimeout(function(){
				if($this.CanUseOptionInSideHeader()){
					var el = document.getElementById("container_middle_builder");
					var values = $this.roundCssTransformMatrix(el);
					el_p.css({transform: "matrix(" + values.join() + ")"});
				} else {
					el_p.css({transform: ""});
				}
			}, 100);
		},
		setDelimiterWidth: function(){
			var delim_model = dfd_header_b.APP.globalSettingCollection.findWhere({"id": "header_side_bar_width_builder"});
			var delim_width = delim_model.get("value");
			var delim_model_color = dfd_header_b.APP.globalSettingCollection.findWhere({"id": "header_border_color_build"});
			if(!_.isObject(delim_model_color)){
				var delim_model_color = dfd_header_b.APP.settingCollection.findWhere({"id": "header_border_color_build"});
			}
			var delim_color_raw = delim_model_color.get("value");
			var delim_color = JSON.parse(delim_color_raw);
			var width_main = delim_width - dfd_header_b.sidePadding * 2;
			var css = '.header_builder_app #dfd_header_t_preview.side-header .Delimiter{ width : ' + width_main + 'px !important;} ';
			css += ' .header_builder_app #dfd_header_t_preview.side-header .Delimiter:after{width : ' + delim_width + 'px !important;}';
			$("#header_builder_style").html("");
			$("#header_builder_style").append(css);
		},
		getColor: function(id, islocal){
			var color_obj;
			if(islocal){
				color_obj = dfd_header_b.APP.settingCollection.findWhere({"id": id});
			} else {
				color_obj = dfd_header_b.APP.globalSettingCollection.findWhere({"id": id});
			}
			var row_val = color_obj.get("value");
			var values_obj = JSON.parse(row_val);
			var color = "";
			if(values_obj.is_transparent == "true"){
				color = "transparent";
			} else {
				if(values_obj.color == ""){
					color = color_obj.get("def");
					if(color == ""){
						for(var k in dfd_header_b.PreSetting) {
							var obj = dfd_header_b.PreSetting[k];
							if(obj.id == setting.id){
								color = obj.def;
								break;
							}
						}
					}
				} else {
					color = values_obj.color;

				}
			}
			return color;
		},
		SetColor: function(){
//			if(dfd_header_b.isInitColorPicker == true){
//				return false;
//			}
			var header_top_background_color_build = this.getColor("header_top_background_color_build", true);
			var header_mid_background_color_build = this.getColor("header_mid_background_color_build", true);
			var header_bot_background_color_build = this.getColor("header_bot_background_color_build", true);
			var header_border_color_build = this.getColor("header_border_color_build", true);
			var header_top_text_color_build = this.getColor("header_top_text_color_build", true);
			var header_mid_text_color_build = this.getColor("header_mid_text_color_build", true);
			var header_bot_text_color_build = this.getColor("header_bot_text_color_build", true);
			var header_side_background_color_builder = this.getColor("header_side_background_color_builder");
			var css = '#dfd_header_t_preview:not(.side-header) .top{background:' + header_top_background_color_build + ';border-color:' + header_border_color_build + ';}' +
					'#dfd_header_t_preview .top{color:' + header_top_text_color_build + ';}' +
					'#dfd_header_t_preview:not(.side-header) .middle{background:' + header_mid_background_color_build + ';border-color:' + header_border_color_build + ';}' +
					'#dfd_header_t_preview .middle{color:' + header_mid_text_color_build + ';}' +
					'#dfd_header_t_preview:not(.side-header) .bottom{background:' + header_bot_background_color_build + ';border-color:' + header_border_color_build + ';}' +
					'#dfd_header_t_preview .bottom{color:' + header_bot_text_color_build + ';}' +
					'#dfd_header_t_preview .top .top-inner-page > span > span{background:' + header_top_text_color_build + ';}' +
					'#dfd_header_t_preview .middle .top-inner-page > span > span {background:' + header_mid_text_color_build + ';}' +
					'#dfd_header_t_preview .bottom .top-inner-page > span > span{background:' + header_bot_text_color_build + ';}' +
					'#dfd_header_t_preview .top .dl-menuwrapper .icon-wrap{background:' + header_top_text_color_build + ';}' +
					'#dfd_header_t_preview .middle .dl-menuwrapper .icon-wrap{background:' + header_mid_text_color_build + ';}' +
					'#dfd_header_t_preview .bottom .dl-menuwrapper .icon-wrap{background:' + header_bot_text_color_build + ';}' +
					'.header_builder_app .header_builder_wrapper #dfd_header_t_preview .container{border-color:' + header_border_color_build + ';}' +
					'#dfd_header_t_preview .dfd-header-delimiter{border-color:' + header_border_color_build + ';}' +
					'#dfd_header_t_preview .Delimiter{border-color:' + header_border_color_build + ';}' +
					'.header_builder_app #dfd_header_t_preview.side-header .dfd_header_t_preview_wrapper{background-color:' + header_side_background_color_builder + ';}';
			var telephone_width = this.getWidthEl("header_telephone_builder");
			var copy_right_width = this.getWidthEl("header_copyright_builder");
			var top_info_width = this.getTopInfoWidth();
			var wishlist_width = this.getWishListWidth();
			var login_width = this.getLoginWidth();
			css += "#dfd_header_t_preview .Telephone.c_el{min-width:" + telephone_width + "px;}";
			css += "#dfd_header_t_preview .Copyright-message.c_el{min-width:" + copy_right_width + "px;}";
			css += "#dfd_header_t_preview .Info.c_el{min-width:" + top_info_width + "px;}";
			css += "#dfd_header_t_preview .Wishlist.c_el{min-width:" + wishlist_width + "px;}";
			css += "#dfd_header_t_preview .Login.c_el{min-width:" + login_width + "px;}";
			$("#header_builder_colors").html("");
			$("#header_builder_colors").append(css);

		},
		getWidthEl: function(name){
			var obj = dfd_header_b.APP.globalSettingCollection.findWhere({id: name});
			if(_.isObject(obj)){
				var obj_val = obj.get("value");
				var calc_with = $(".calculate_width");
				calc_with.html(obj_val);
				var obj_width = calc_with.width() + dfd_header_b.Padding * 2 + 1;
				if(dfd_header_b.Helper.CanUseOptionInSideHeader()){
					obj_width = obj_width + dfd_header_b.sidePadding * 2;
					var side_width_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: "header_side_bar_width_builder"});
					var side_width = side_width_model.get("value");
					if(side_width < obj_width){
						obj_width = side_width - dfd_header_b.sidePadding * 2;
					}
					else {
						obj_width = obj_width - dfd_header_b.sidePadding * 2;
					}
				}
				calc_with.html("");
				return obj_width;
			}
			return "";
		},
		getTopInfoWidth: function(){
			var calc_with = $(".calculate_top_info_width");
			calc_with.show();
			var width = calc_with.width() + dfd_header_b.Padding * 2 + 1;
			if(dfd_header_b.Helper.CanUseOptionInSideHeader()){
				width = width + dfd_header_b.sidePadding * 2;
				var side_width_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: "header_side_bar_width_builder"});
				var side_width = side_width_model.get("value");
				if(side_width < width){
					width = side_width - dfd_header_b.sidePadding * 2;
				}
				else {
					width = width - dfd_header_b.sidePadding * 2;
				}
			}
			calc_with.hide();
			return width;
		},
		getWishListWidth: function(){
			var calc_with = $(".calulate_wishlist_width");
			calc_with.show();
			var width = calc_with.width() + dfd_header_b.Padding * 2 + 1;
			calc_with.hide();
			if(width > 55){
				return width;
			}
			return "";
		},
		getLoginWidth: function(){
			var calc_with = $(".calulate_login_width");
			calc_with.show();
			var width = calc_with.width() + dfd_header_b.Padding * 2 + 1;
			calc_with.hide();
			return width;
		},
		CanUseOptionInSideHeader: function(){
			var style = dfd_header_b.View.Setting.getHeaderStyle();
			var cur_view = dfd_header_b.Config.getCurentView();
			if(style == "side" && cur_view == "desktop"){
				return true;
			}
			return false;
		},
		deleteByView: function(settings, view, remove_global){
			var desktop_settiings = settings[view];
			for(var set_key in desktop_settiings) {
				var sett_obj = desktop_settiings[set_key];
				if(_.isObject(sett_obj)){
					if(sett_obj.isGlobal == remove_global){
						delete desktop_settiings[set_key];
					}
				}
			}
			this.removeNullEl(settings, view);
		},
		removeNullEl: function(settings, view){
			var desktop_settiings = settings[view];
			for(var i = desktop_settiings.length - 1; i >= 0; i--) {
				if(desktop_settiings[i] == null){
					desktop_settiings.splice(i, 1);
				}
			}
			return desktop_settiings;
		},
		getDefaultPresetAndSettingsVal: function(style){
			if(typeof style == "undefined"){
				style = dfd_header_b.View.Setting.getHeaderStyle();
			}
			var preset, settings;
			switch (style) {
				case "horizontal" :
					preset = dfd_header_b.Default.presetValues;
					settings = dfd_header_b.Default.settings;
					break;
				case "side" :
					preset = dfd_header_b.DefaultPresetSide.presetValues;
					settings = dfd_header_b.DefaultPresetSide.settings;
					break;
				case "boxed" :
					preset = dfd_header_b.DefaultPresetBoxed.presetValues;
					settings = dfd_header_b.DefaultPresetBoxed.settings;
					break;
				default :
					preset = dfd_header_b.Default.presetValues;
					settings = dfd_header_b.Default.settings;
			}
			return {
				"preset": preset,
				"settings": settings,
			};
		},
		stringifyValus: function(){

//				
			dfd_header_b.Config.setPresetState();

			var presstsToSave = dfd_header_b.APP.presets.where({isDefault: false});
			for(var key in presstsToSave) {
				var preset = presstsToSave[key];
				var settings = preset.get("settings");
				this.deleteByView(settings, "desktop", "true");
				this.deleteByView(settings, "tablet", "true");
				this.deleteByView(settings, "mobile", "true");
				this.deleteByView(settings, "globals", "false");
			}
			presstsToSave = JSON.stringify(presstsToSave, [
				"name",
				"isActive",
				"presetValues",
				"type",
				"desktop",
				"mobile",
				"tablet",
				"settings",
				"id",
				"value",
				"def",
				"globals",
				"isGlobal",
				"color",
				"isfullwidth",
				"is_transparent",
				"overlayContent",
			]);
			return presstsToSave;
		},
		openPresetWindow: function(){
			var sidebar = $(".preset-window");
			var parent = sidebar.parent();

			parent.toggleClass("preset-open");
			if(parent.hasClass("preset-open")){
				this.presetWindowIsOpen = true;
			} else {
				this.presetWindowIsOpen = false;
			}
			return false;
		},
		calculateOptimalLogoWidth: function(){
			var horizView = function(){
				var logoobj = $("#dfd_header_t_preview .c_el.port.Logo");
				var img = logoobj.find("img");
				var parent = logoobj.parent();
				img = img[0];
				if(typeof img == "undefined"){
					return false;
				}
				var naturalHeight = img.naturalHeight;
				var naturalWidth = img.naturalWidth;
				if((typeof naturalHeight == "undefined") && (typeof naturalWidth == "undefined")){
					return false;
				}
				var kx = naturalWidth / naturalHeight;
				var row_height = parent.height();

				var new_width = row_height * kx;
				if(row_height > naturalHeight){
					new_width = naturalWidth;
				}
				new_width += dfd_header_b.Padding * 2;
				new_width = new_width - 1;
				if(dfd_header_b.Config.getCurentView() != "mobile"){
					logoobj.addClass("init").css({
						"width": new_width,
						"max-width": new_width,
						"min-width": new_width,
					});
				} else {
					logoobj.addClass("init").removeAttr("style");
				}

			};
			setTimeout(function(){
				if(!dfd_header_b.Helper.CanUseOptionInSideHeader()){
					horizView();
				}

			}, 200);
		},
		addLoader: function(){
			$(".header_builder_app ").addClass("init");
		},
		removeLoader: function(){
			$(".header_builder_app ").removeClass("init");
		},
		hideSetting: function(){
			var el = $("#info-grid_info_setting_builder");
			el.hide();
			el.next().hide();
		},
		showSetting: function(){
			var el = $("#info-grid_info_setting_builder");
			el.show();
			el.next().show();
		},
		isDefaultCurentPreset: function(){
			var preset = dfd_header_b.APP.presets.findWhere({"isActive": "active"});
			if(_.isObject(preset)){
				var isdefault = preset.get("isDefault");
				if(isdefault){
					return true;
				} else {
					return false;
				}
			}
			return false;
		},
		checkSetOnDefault: function(){
			var isdefault = this.isDefaultCurentPreset();
			if(isdefault){
				dfd_header_b.Helper.hideSetting();
				return false;
			}
			dfd_header_b.Helper.showSetting();
		},
		saveChanges: function(check){
			var curentPreset = dfd_header_b.APP.presets.findWhere({isActive: "active"});

			if(_.isObject(curentPreset)){
				var is_def = curentPreset.get("isDefault");
				if(is_def == true){
					if(check == true || check == null){
						alert("This is default preset. You can't edit this only copy enable");
					}
					return false;
				}
			}

			var el = [
			];
			if(dfd_header_b.Config.isnew == false){
				var mass = dfd_header_b.APP.Sortable.getValuesFormAllCells();
				var strin = JSON.stringify(mass, [
					"name",
					"type",
					"isfullwidth"
				]);
				el = JSON.parse(strin);
				dfd_header_b.Config.setPresetByView(el);
			}
			dfd_header_b.APP.presets.trigger("addToOption");
			dfd_header_b.Config.isnew = false;
		},
		normalizeGlobalSetting: function(){
			var glob_set = dfd_header_b.Config.getGlobalSetting();
			var global_collection = dfd_header_b.APP.globalSettingCollection.toJSON();
			if(glob_set.length != global_collection.length){
				for(var set in global_collection) {
					var obj = global_collection[set];
					var found = false;
					for(var glob_set_key in glob_set) {
						var glob_obj = glob_set[glob_set_key];
						if(obj.id == glob_obj.id){
							found = true;
							var paste_obj_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: obj.id});
							paste_obj_model.set(glob_obj);
							continue;
						}
					}
					if(!found){
						var paste_obj_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: obj.id});
						for(var presetKey in dfd_header_b.PreSetting) {
							var preset_obj = dfd_header_b.PreSetting[presetKey];
							if(preset_obj.id == obj.id){
								paste_obj_model.set(preset_obj);
							}
						}
					}
				}
				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
			} else {
				dfd_header_b.APP.globalSettingCollection.reset(glob_set);
				dfd_header_b.Config.setGlobalSetting(glob_set);
			}
		},
		normalizeLocalSetting: function(){
			var glob_set = dfd_header_b.Config.getCurrentSetting();
			var setting_collection = dfd_header_b.APP.settingCollection.toJSON();
			if(glob_set.length != setting_collection.length){

				for(var set in setting_collection) {
					var obj = setting_collection[set];
					var found = false;
					for(var glob_set_key in glob_set) {
						var glob_obj = glob_set[glob_set_key];
						if(obj.id == glob_obj.id){
							found = true;

							var paste_obj_model = dfd_header_b.APP.settingCollection.findWhere({id: obj.id});
							paste_obj_model.set(glob_obj);
							continue;
						}
					}
					if(!found){
						var paste_obj_model = dfd_header_b.APP.settingCollection.findWhere({id: obj.id});
						for(var presetKey in dfd_header_b.PreSetting) {
							var preset_obj = dfd_header_b.PreSetting[presetKey];
							if(preset_obj.id == obj.id){
								paste_obj_model.set(preset_obj);
							}
						}
					}
				}
				var setting_collection = dfd_header_b.APP.settingCollection.toJSON();
				dfd_header_b.Config.setSettingByView(setting_collection);
			} else {
				dfd_header_b.APP.settingCollection.reset(glob_set, {silent: true});
				dfd_header_b.Config.setSettingByView(glob_set);
			}
		},
		normalizeElementsCollection: function(){
			var preset = dfd_header_b.Config.getCurrentPreset();
			var premade_preset = dfd_header_b.PremadeElements.el;

			var coll = [
			];
			for(var preset_key in preset) {
				var row = preset[preset_key];
				for(var row_key in row) {
					var col = row[row_key];
					if(col.length > 0){
						for(var col_key in col) {
							var obj = col[col_key];
							if(_.isObject(obj)){
								if(obj.type != "delimiter" && obj.type != "spacer"){
									coll.push(obj);
								}
							}

						}
					}
				}
			}
			if(coll.length != premade_preset.length){
				for(var premade_elem_key in premade_preset) {
					var premade_preset_obj = premade_preset[premade_elem_key];
					var found = false;
					for(var coll_key in coll) {
						var coll_obj = coll[coll_key];
						if(_.isObject(obj)){
							if(coll_obj.type == premade_preset_obj.type){
								found = true;
								continue;
							}
						}
					}
					if(!found){
						coll.push(premade_preset_obj);
					}
				}
			}
			return coll;
		}
	};
})(jQuery, window);

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

/*global Backbone */
var dfd_header_b = dfd_header_b || {};

(function(){
	'use strict';

	dfd_header_b.Collection.Settings = Backbone.Collection.extend({
		model: dfd_header_b.Model.Setting,
		parse: function(response){
			return response;
		}
	});
	dfd_header_b.APP.settingCollection = new dfd_header_b.Collection.Settings();
	dfd_header_b.APP.globalSettingCollection = new dfd_header_b.Collection.Settings();

})(jQuery);

var dfd_header_b = dfd_header_b || {};
(function($){
	'use strict';
	dfd_header_b.View.MainElementView = Backbone.View.extend({
		mainTemplate: '',
		tagName: 'div',
		tempname: 'dfd_header_t_el',
		width: '',
		n_width: '',
		events: {
			"click .hover-controls .controls-out-tl .delete": "delete",
			"click .hover-controls .controls-out-tl .fullwidth.active": "setFullwidth",
			"touchstart .hover-controls .controls-out-tl .delete": "delete",
			"touchstart .hover-controls .controls-out-tl .fullwidth.active": "setFullwidth",
		},
		delete: function(){
			this.$el.remove();
			dfd_header_b.Helper.addLoader();
			setTimeout(function(){
				dfd_header_b.Helper.saveChanges();
				dfd_header_b.APP.Builder.build();
			}, 100);

		},
		setFullwidth: function(e){
			var canShow = dfd_header_b.View.Setting.canShow();

			var target = e.target;
			this.$el.find(".hover-controls .controls-out-tl .fullwidth").removeClass("active");
			if($(target).hasClass("full")){
				this.$el.find(".hover-controls .controls-out-tl .inline").addClass("active");
			} else {
				this.$el.find(".hover-controls .controls-out-tl .full").addClass("active");
			}
			$(target).removeClass("active");
			this.$el.toggleClass("fullwidth");
			var val = this.model.get("isfullwidth") == true ? false : true;
			this.model.set({isfullwidth: val});
			dfd_header_b.Helper.saveChanges();
			var parent = this.$el.parent();

			parent.css({display: "table"});
			setTimeout(function(){
				parent.css({display: "block"});
				dfd_header_b.Helper.claerTransformMiddleBlock();
				dfd_header_b.Helper.RoundContentTransform();
			}, 100);
		},
		className: function(){
			return this.model.get("class_el") + " c_el port";
		},
		id: function(){
			return this.model.get("id");
		},
		getTemp: function(type){
			var id_el = $('#dfd_header_t_el_' + type);
			return id_el;
		},
		getTtype: function(){
			var type = this.model.get("type");
			var id_el = this.getTemp(type);

			switch (type) {
				case "logo" :
					var logo_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: "logo_header_builder"});
					var logo_model_val_row = logo_model.get("value");
					var logo_model_val = JSON.parse(logo_model_val_row);
					if(logo_model_val.thumb == ""){
						logo_model_val.thumb = dfd_header_b_local_settings.logo_url;
					}
					var big_img = dfd_header_b.Helper.getBigImgFromthumb(logo_model_val.thumb);
					this.model.set("image", big_img);
					break;
				case "text" :
					var text_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: "header_copyright_builder"});
//
					var text_model_val = text_model.get("value");
					this.model.set("value", text_model_val);

					break;
				case "telephone" :
					var text_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: "header_telephone_builder"});
					var text_model_val = text_model.get("value");
					this.model.set("value", text_model_val);

					break;
				case "info" :

					break;
				case "buttonel" :
					var text_model = dfd_header_b.APP.globalSettingCollection.findWhere({id: "header_button_text_builder"});
					var text_model_val = text_model.get("value");
					this.model.set("value", text_model_val);
					break;
			}
			if(id_el.length){
				this.temp = _.template(id_el.html());
				this.model.set("temp", this.temp(this.model.toJSON()));
			} else {
				this.model.set("temp", '');
			}
			this.model.set("id", this.model.cid);

		},
		initialize: function(){
			this.mainTemplate = _.template($('#' + this.tempname).html());
			this.getTtype();
		},
		render: function(){
			return this;
		}
	});
	dfd_header_b.View.ElementView = dfd_header_b.View.MainElementView.extend({
		render: function(){
			this.$el.html(this.mainTemplate(this.model.toJSON()));

			this.$el.attr("data-id", this.model.get("id"));
			var id = this.model.get("id");
			var controls = $(dfd_header_b.HTMLEntity.MainBlocks.controls);
			controls.find("#" + id).remove();
			controls.append(this.el);
			return this;
		}
	});
	dfd_header_b.View.ElementPrevView = dfd_header_b.View.MainElementView.extend({
		render: function(){
			var $this = this;
			this.$el.html(this.mainTemplate(this.model.toJSON()));
			this.$el.attr("data-id", this.model.get("id"));
			var type = this.model.get("type");

			var is_full_width = this.model.get("isfullwidth");

			var canshow = dfd_header_b.View.Setting.canShow();

			if(is_full_width == true && !canshow){
				$this.$el.addClass("fullwidth");
			}

			return this;
		}
	});

})(jQuery);
var dfd_header_b = dfd_header_b || {};

(function($){
	'use strict';

	dfd_header_b.View.AppView = Backbone.View.extend({
		el: '.header_builder_app',
		mainTemplate: '',
		events: {
			"click #open-preset-window": "openPresetWindow",
			"click #add_preset": "addPresetWindow",
			"click .close-notify ": "closeNotify",
		},
		initialize: function(){
			this.listenTo(this, 'all', _.debounce(this.render, 0));
			this.listenTo(dfd_header_b.APP.collection, 'all', _.debounce(this.render, 0));
			this.listenTo(this, 'initSortable', _.debounce(this.initSortable, 0));
			this.listenTo(dfd_header_b.APP.collection, 'add', _.debounce(this.add, 0));
			this.listenTo(dfd_header_b.APP.collection, 'reset', _.debounce(this.reset, 0));
			this.listenTo(dfd_header_b.APP.settingCollection, 'reset', this.buildSettings);
			this.listenTo(dfd_header_b.APP.collection, 'change', _.debounce(this.change, 0));
			this.listenTo(dfd_header_b.APP.collection, 'reInit', _.debounce(this.reInit, 0));
			this.listenTo(dfd_header_b.APP.presets, 'all', _.debounce(this.changeNamePreset, 0));
			this.listenTo(dfd_header_b.APP.presets, 'addToOption', _.debounce(this.AddToOption, 0));
			this.listenTo(this, "firstStart", this.firstStart());

			this.firstStart();

			this.PresetNameTemplate = _.template($('#dfd_header_t_presetname').html());

			this.hideReduxLeftSideBar();
			var $this = this;
			$(dfd_header_b.HTMLEntity.resetBtn).on("click", function(e){
				if($(this).hasClass("reset")){
					$this.resetToDefault();
				} else {
					dfd_header_b.Helper.addLoader();
					$this.clickChangeView(e);
				}

			});
		},
		resetToDefault: function(){
			var isdefault = dfd_header_b.Helper.isDefaultCurentPreset();
			if(isdefault){
				alert("It's default preset. Pleaase copy it to make changes");
				return false;
			}
			var reset = confirm("All elements and settings will be reset to default. Are you shure?");
			if(!reset){
				return false;
			}
			var DefaultPresetAndSettingsVal = dfd_header_b.Helper.getDefaultPresetAndSettingsVal();
			var preset = DefaultPresetAndSettingsVal.preset;
			var settings = DefaultPresetAndSettingsVal.settings;
			dfd_header_b.Config.setPreset(preset);
			dfd_header_b.Config.setSetting(settings);
			dfd_header_b.Helper.addLoader();
			dfd_header_b.changeslider = true;
			dfd_header_b.Helper.checkSetOnDefault();
			setTimeout(function(){
				dfd_header_b.APP.Builder.build();
				dfd_header_b.Dependency.init();
				dfd_header_b.Helper.saveChanges();
			}, 100);
		},
		addPresetWindow: function(){
			tb_show("Add new preset", '#TB_inline?width=750&height=600&inlineId=examplePopup1');
			$("#TB_window").addClass("add-preset");
			dfd_header_b.Config.isnew = true;

			var new_preset = new dfd_header_b.View.Add_Preset();
			new_preset.render();
			dfd_header_b.isClickedNewPreset = true;
			return false;
		},
		firstStart: function(){
			var DefaultPresetAndSettingsVal = dfd_header_b.Helper.getDefaultPresetAndSettingsVal();
			var preset = DefaultPresetAndSettingsVal.preset;
			var settings = DefaultPresetAndSettingsVal.settings;
			
			dfd_header_b.Config.setPreset(preset);
			dfd_header_b.Config.setSetting(settings);
			dfd_header_b.Helper.addLoader();
			dfd_header_b.changeslider = true;
			dfd_header_b.APP.Builder.build(false);
			dfd_header_b.Helper.checkSetOnDefault();
			setTimeout(function(){
				dfd_header_b.APP.Builder.build();
			},100);
		},
		/**
		 * Split dfd_header_b.APP.settingCollection to two collection(GLobal and local)
		 */
		buildSettings: function(){
			var glob_set = dfd_header_b.Config.getGlobalSetting();
			if(glob_set != "" && typeof glob_set != "undefined"){
				dfd_header_b.Helper.normalizeGlobalSetting();
				dfd_header_b.Config.getGlobalSetting();
				return false;
			}
			dfd_header_b.APP.globalSettingCollection.reset();
			var selectGlobal = dfd_header_b.APP.settingCollection.where({isGlobal: "true"});
			dfd_header_b.APP.settingCollection.remove(selectGlobal);
			dfd_header_b.APP.globalSettingCollection.add(selectGlobal);

			dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
		},
		closeNotify: function(){
			var notify = this.$el.find(".header-app-notify");
			var wrap = notify.find(".wrap");
			wrap.css({
				transform: 'translateY(-100px)',
				opacity: '0'
			});
			notify.css("display", "none");
			setTimeout(function(){
				notify.css("visibility", "hidden");
			}, 100);
		},
		settingReset: function(){
			dfd_header_b.Config.setSettingByView(dfd_header_b.APP.settingCollection.toJSON());
		},
		settingResetInit: function(){
			dfd_header_b.View.Setting.init();
		},
		addNotiy: function(){
			if(dfd_header_b.isFirstStart == false && dfd_header_b.isnotifyEnable == true){
				var notify = this.$el.find(".header-app-notify");
				notify.css({
					"visibility": "visible",
					"display": "block"
				});
				var wrap = notify.find(".wrap");
				setTimeout(function(){
					wrap.css({
						transform: 'translateY(0%)',
						opacity: '1'
					});
				}, 100);
				window.onbeforeunload = confirmOnPageExit;
			}
			dfd_header_b.isFirstStart = false;
			dfd_header_b.isnotifyEnable = true;
		},
		AddToOption: function(){
			var options = dfd_header_b.Helper.stringifyValus();
			var input = $(dfd_header_b.HTMLEntity.optionInput);
			input.prop("value", "");
			input.val(options);
			this.addNotiy();
		},
		changeNamePreset: function(){
			var name = "";
			var preset_name_obj = this.$el.find(".curent-preset-name-app");
			preset_name_obj.html("");
			var curent_preset = dfd_header_b.APP.presets.findWhere({isActive: "active"});
			if(_.isObject(curent_preset)){
				name = curent_preset.get("name");
			}

			preset_name_obj.append(this.PresetNameTemplate({preset_name: name}));
		},
		openPresetWindow: function(){
			dfd_header_b.Helper.openPresetWindow();
		},
		clickChangeView: function(e){
			var $this = this;
			var target = $(e.target);
			var target_siblings = target.parent().siblings();
			target_siblings.removeClass("options-button-green");
			target_siblings.addClass("options-button-green-border");
			target.parent().removeClass("options-button-green-border");
			target.parent().addClass("options-button-green");
			var val = target.data("val");
			switch (val) {
				case "desktop" :
					dfd_header_b.Config.setDesktopView();
					break;
				case "tablet" :
					dfd_header_b.Config.setTabletView();
					break;
				case "mobile" :
					dfd_header_b.Config.setMobileView();
					break;
			}
			$this.$el.removeClass("tablet").removeClass("mobile").removeClass("desktop");
			$this.$el.addClass(val);

			setTimeout(function(){
				dfd_header_b.APP.Builder.build();
			}, 100);
		},
		add: function(model){
			var element = new dfd_header_b.View.ElementView({model: model});
			element.render();
		},
		change: function(ev, collect, prev){
		},
		reInit: function(ev, collect, prev){
			dfd_header_b.APP.collection.trigger("reset");
			this.$el.find(".wrapper").removeAttr("style");
			dfd_header_b.Helper.setDelimiterWidth();
			dfd_header_b.Helper.claerTransformMiddleBlock();
			dfd_header_b.Helper.RoundContentTransform();
			dfd_header_b.Helper.removeLoader();

		},
		reset: function(collect, prev){
			var $this = this;
			this.$el.find("#dfd_header_t_controls").html("");
			dfd_header_b.APP.collection.each(this.add, this);
			this.trigger("initSortable");

		},
		hideReduxLeftSideBar: function(){
			var par = this.$el.parentsUntil(".redux-group-tab");
			var main_tab = $(par[4]).parent();
			main_tab.find("h2:first-child").append("<span> (Beta v0.1)</span>");
			main_tab.addClass("header_builder_redux_tab");
			par.find("tr:first-child > th").hide();
			par.find("tr:first-child > td").attr("colspan", 2);
			var sidebar = $(".redux-sections-wrap .redux-sidebar");

			var PresetTemplate = _.template($("#dfd_header_t_el_preset").html());
			sidebar.append(PresetTemplate());
			new dfd_header_b.View.Presets_View().render();
		},
		initSortable: function(){
			dfd_header_b.APP.Sortable.init();
		},
		render: function(){

			return this;
		}
	});

})(jQuery);
var dfd_header_b = dfd_header_b || {};

(function($){
	'use strict';

	dfd_header_b.View.SettingsView = Backbone.View.extend({
		el: '#71_section_group',
		mainTemplate: '',
		events: {
		},
		initialize: function(){
			var $this = this;


			var BtnShowTopPanel = $("input[name='" + dfd_header_b.View.Setting.BtnShowTopPanel + "']");
			var BtnShowMidPanel = $("input[name='" + dfd_header_b.View.Setting.BtnShowMidPanel + "']");
			var BtnShowBotPanel = $("input[name='" + dfd_header_b.View.Setting.BtnShowBotPanel + "']");

			var BtnTopAbstract = $("input[name='" + dfd_header_b.View.Setting.BtnTopAbstract + "']");
			var BtnMidAbstract = $("input[name='" + dfd_header_b.View.Setting.BtnMidAbstract + "']");
			var BtnBotAbstract = $("input[name='" + dfd_header_b.View.Setting.BtnBotAbstract + "']");

			var BtnLogoImg = $("input[name='" + dfd_header_b.View.Setting.BtnLogoImg + "[id]" + "']");
			var BtnRetinaLogoImg = $("input[name='" + dfd_header_b.View.Setting.BtnRetinaLogoImg + "[id]" + "']");

			var BtnTopBgColor = $("input[name='" + dfd_header_b.View.Setting.BtnTopBgColor + "']");

			var BtnShowSticky = $("input[name='" + dfd_header_b.View.Setting.BtnSticky + "']");


			var BtnSliderTopHeight = $("input[name='" + dfd_header_b.View.Setting.BtnsliderTopHeight + "']");

			/**
			 * 
			 */
			BtnTopAbstract.next().on("click", function(e){
				dfd_header_b.View.Input.triggerBtn.triggerOptionLocal("set_top_panel_abstract_builder");
			});
			BtnMidAbstract.next().on("click", function(e){
				dfd_header_b.View.Input.triggerBtn.triggerOptionLocal("set_mid_panel_abstract_builder");
			});
			BtnBotAbstract.next().on("click", function(e){
				dfd_header_b.View.Input.triggerBtn.triggerOptionLocal("set_bot_panel_abstract_builder");
			});
			/**
			 * 
			 */
			BtnShowTopPanel.next().on("click", function(e){
				dfd_header_b.View.Setting.triggerOption("show_top_panel_builder");
			});
			BtnShowMidPanel.next().on("click", function(e){
				dfd_header_b.View.Setting.triggerOption("show_mid_panel_builder");
			});
			BtnShowBotPanel.next().on("click", function(e){
				dfd_header_b.View.Setting.triggerOption("show_bot_panel_builder");
			});


			BtnLogoImg.on("change", this, function(e){
				dfd_header_b.View.Setting.triggerImageGlobal("logo_header_builder");

			});
			BtnRetinaLogoImg.on("change", this, function(e){
				dfd_header_b.View.Setting.triggerImageGlobal("retina_logo_header_builder");
			});

			BtnShowSticky.next().on("click", function(e){
				dfd_header_b.View.Input.triggerBtn.triggerOption("header_sticky_builder");
			});

		},
		changeCheckbox: function(e){
			e.preventDefault();
			return false;
			var val = $(e.target).val();
		},
		render: function(){
			return this;
		}
	});
	dfd_header_b.View.Setting = {
		BtnShowTopPanel: "native[show_top_panel_builder]",
		BtnShowMidPanel: "native[show_mid_panel_builder]",
		BtnShowBotPanel: "native[show_bot_panel_builder]",
		BtnTopAbstract: "native[set_top_panel_abstract_builder]",
		BtnMidAbstract: "native[set_mid_panel_abstract_builder]",
		BtnBotAbstract: "native[set_bot_panel_abstract_builder]",
		BtnLogoImg: "native[logo_header_builder]",
		BtnRetinaLogoImg: "native[retina_logo_header_builder]",
		BtnTopBgColor: "native[header_top_background_color_build]",
		BtnSticky: "native[header_sticky_builder]",
		BtnsliderTopHeight: "native[top_header_height_builder]",
		getValueByName: function(name){
			var $prop = "getObj_" + name;
			var val = dfd_header_b.View.Setting[$prop]().val();
			return val;
		},
		/* Get Property from HTML*/
		getObj_show_top_panel_builder: function(){
			return  $("input:checked[name='" + this.BtnShowTopPanel + "']");
		},
		getObj_show_mid_panel_builder: function(){
			return  $("input:checked[name='" + this.BtnShowMidPanel + "']");
		},
		getObj_show_bot_panel_builder: function(){
			return  $("input:checked[name='" + this.BtnShowBotPanel + "']");
		},
		getObj_set_top_panel_abstract_builder: function(){
			return  $("input:checked[name='" + this.BtnTopAbstract + "']");
		},
		getObj_set_mid_panel_abstract_builder: function(){
			return  $("input:checked[name='" + this.BtnMidAbstract + "']");
		},
		getObj_set_bot_panel_abstract_builder: function(){
			return  $("input:checked[name='" + this.BtnBotAbstract + "']");
		},
		getObj_header_sticky_builder: function(){
			return  $("input:checked[name='" + this.BtnSticky + "']");
		},
		getObj_logo_header_builder: function(){
			var obj = {};
			obj.id = $("input[name='" + this.BtnLogoImg + "[id]']");
			obj.thumb = $("input[name='" + this.BtnLogoImg + "[thumbnail]']");
			return  obj;
		},
		getObj_retina_logo_header_builder: function(){
			var obj = {};
			obj.id = $("input[name='" + this.BtnRetinaLogoImg + "[id]']");
			obj.thumb = $("input[name='" + this.BtnRetinaLogoImg + "[thumbnail]']");
			return  obj;
		},
		/***/
		init: function(){
			var settings = dfd_header_b.Config.getCurrentSetting();
			this.settingFactoryInit(settings);

			var global_setting = dfd_header_b.Config.getGlobalSetting();
			this.settingFactoryInit(global_setting, true);
//			dfd_header_b.Helper.SetColor();

			var self = this;
			setTimeout(function(){
				self.reInit();
			}, 100);
			dfd_header_b.isInitColorPicker = true;
			dfd_header_b.isInitSlider = true;
			dfd_header_b.changeslider = false;

		},
		settingFactoryInit: function(settings, par){

			for(var i in settings) {
				var setting = settings[i];
				if(setting != null){
					switch (setting.type) {
						case "trigger" :
							dfd_header_b.View.Input.triggerBtn.init(setting);
							break;
						case "image" :
							dfd_header_b.View.Input.image.init(setting);
							break;
						case "colorpicker" :
							dfd_header_b.View.Input.colorpicker.init(setting);
							break;
						case "slider" :
							dfd_header_b.View.Input.slider.init(setting);
							break;
						case "image_select" :
							dfd_header_b.View.Input.image_select.init(setting);
							break;
						case "radio" :
							dfd_header_b.View.Input.radio.init(setting);
							break;
						case "text" :
							dfd_header_b.View.Input.text.init(setting);
							break;
						case "telephone" :
							dfd_header_b.View.Input.telephone.init(setting);
							break;
					}
				}

			}

		},
		reInit: function(){
			setTimeout(function(){
				var top = $("#dfd_header_t_preview .container.row.top");
				var top_abs = $("#native-set_top_panel_abstract_builder").parent().parent();
				var top_bg_color = $("#native-header_top_background_color_build").parent().parent();
				var top_text_color = $("#native-header_top_text_color_build").parent().parent();

				var mid = $("#dfd_header_t_preview .container.row.middle");
				var mid_abs = $("#native-set_mid_panel_abstract_builder").parent().parent();
				var mid_bg_color = $("#native-header_mid_background_color_build").parent().parent();
				var mid_text_color = $("#native-header_mid_text_color_build").parent().parent();

				var bot = $("#dfd_header_t_preview .container.row.bottom");
				var bot_abs = $("#native-set_bot_panel_abstract_builder").parent().parent();
				var bot_bg_color = $("#native-header_bot_background_color_build").parent().parent();
				var bot_text_color = $("#native-header_bot_text_color_build").parent().parent();

				var header_style = dfd_header_b.View.Setting.getHeaderStyle();
				if(header_style == "side" && dfd_header_b.Config.getCurentView() == "desktop"){
					top_abs.hide();
					top_bg_color.hide();
					top_text_color.show();

					mid_abs.hide();
					mid_bg_color.hide();
					mid_text_color.show();

					bot_abs.hide();
					bot_bg_color.hide();
					bot_text_color.show();
				} else {
					if(dfd_header_b.View.Setting.isShowTopPanel()){
						top.show();
						top_abs.show();
						top_bg_color.show();
						top_text_color.show();
					} else {
						top.hide();
						top_abs.hide();
						top_bg_color.hide();
						top_text_color.hide();
					}
					if(dfd_header_b.View.Setting.isShowMidPanel()){
						mid.show();
						mid_abs.show();
						mid_bg_color.show();
						mid_text_color.show();
					} else {
						mid.hide();
						mid_abs.hide();
						mid_bg_color.hide();
						mid_text_color.hide();
					}
					if(dfd_header_b.View.Setting.isShowBotPanel()){
						bot.show();
						bot_abs.show();
						bot_bg_color.show();
						bot_text_color.show();
					} else {
						bot.hide();
						bot_abs.hide();
						bot_bg_color.hide();
						bot_text_color.hide();
					}
				}

				$("#dfd_header_t_preview .container").css({
					"border-bottom-width": "0px"
				});
				$("#dfd_header_t_preview .container:visible").last().css({
					"border-bottom-width": "1px",
					"border-bottom-style": "solid",
				});
			}, 100);


		},
		triggerImageGlobal: function(name){
			setTimeout(function(){

				var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: name});
				var $prop = "getObj_" + name;
				var img_obj = dfd_header_b.View.Setting[$prop]();
				var prepare = {
					id: img_obj.id.val(),
					thumb: img_obj.thumb.val()
				};
				var new_value = JSON.stringify(prepare);
				model.set({
					value: new_value
				});
				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
				dfd_header_b.Helper.saveChanges();
				dfd_header_b.APP.Builder.build();
			}, 100);
		},
		triggerOption: function(name){
			var $this = this;
			setTimeout(function(){
				$this.useCheckbox(name);
				dfd_header_b.View.Setting.reInit();
			}, 200);
		},
		useCheckbox: function(name){


			var set = dfd_header_b.Config.getCurrentSetting();
			dfd_header_b.APP.settingCollection.reset();
			dfd_header_b.APP.settingCollection.reset(set);
			var model = dfd_header_b.APP.settingCollection.findWhere({id: name});
			if(!_.isObject(model)){
				dfd_header_b.APP.settingCollection.reset(dfd_header_b.PreSetting);
				dfd_header_b.Config.setSettingByView(dfd_header_b.APP.settingCollection.toJSON());
				var model = dfd_header_b.APP.settingCollection.findWhere({id: name});
			}

			var $prop = "getObj_" + name;
			var val = dfd_header_b.View.Setting[$prop]().val();
			model.set(
					{
						value: val
					});
			dfd_header_b.Config.setSettingByView(dfd_header_b.APP.settingCollection.toJSON());
			dfd_header_b.Helper.saveChanges();
			dfd_header_b.APP.Builder.build(false);

		},
		isShowTopPanel: function(){
			var val = $("input:checked[name='" + this.BtnShowTopPanel + "']").val();
			if(val == "on"){
				return true;
			}
			return false;
		},
		isShowMidPanel: function(){
			var val = $("input:checked[name='" + this.BtnShowMidPanel + "']").val();
			if(val == "on"){
				return true;
			}
			return false;
		},
		isShowBotPanel: function(){
			var val = $("input:checked[name='" + this.BtnShowBotPanel + "']").val();
			if(val == "on"){
				return true;
			}
			return false;
		},
		getHeaderStyleFromObj: function(){
			return $("input:checked[name='native[style_header_builder]']").val();
		},
		canShow: function(){
			var val = this.getHeaderStyleFromObj();
			var curView = dfd_header_b.Config.getCurentView();
			if(val == "side" && curView == "desktop"){
				return false;
			}
			return true;
		},
		getHeaderStyle: function(){
			var model = dfd_header_b.APP.globalSettingCollection.findWhere({"id": "style_header_builder"});
			if(_.isObject(model)){
				return model.get("value");
			}
			return  "";
		}
	};
	dfd_header_b.View.Input.triggerBtn = {
		init: function(setting){
			var id = setting.id;
			var $this = this;
			var checkboxes = $("input[name='native[" + id + "]']");
			var checkboxes_checked = $("input:checked[name='native[" + id + "]']");
			checkboxes.removeAttr("checked");
			checkboxes.each(function(){

				var val = $(this).val();
				if(val == "on"){
					if(setting.value == "on"){
						$(this).attr("checked", "checked");

					}
					if(setting.value == "" && setting.def == "on"){
						$(this).attr("checked", "checked");
					}
				}
				if(val == "off"){
					if(setting.value == "off"){
						$(this).attr("checked", "checked");
					}
					if(setting.value == "" && setting.def == "off"){
						$(this).attr("checked", "checked");
					}
				}

			});
			var checkboxes_checked_val = $("input:checked[name='native[" + id + "]']").val();
			var parent = checkboxes_checked.parent();
			var btn_anim_obj = parent.find(".button-animation");
			var left_corner = parent.find(".ui-corner-left");
			var right_corner = parent.find(".ui-corner-right");
			if(checkboxes_checked_val == "on"){
				btn_anim_obj.removeClass("right-active");

				right_corner.removeClass("ui-state-active");
				left_corner.addClass("ui-state-active");
			}
			if(checkboxes_checked_val == "off"){
				btn_anim_obj.addClass("right-active");

				left_corner.removeClass("ui-state-active");
				right_corner.addClass("ui-state-active");
			}

			setTimeout(function(){
				var checkboxes_checked = $("input:checked[name='native[" + id + "]']");
				var checkbox_val = checkboxes_checked.val();
				$this.VisualReInit(id, checkbox_val);
			}, 50);
		},
		VisualReInit: function(name, val){

			var switcher = function(obj){

				if(val == "on"){
					obj.addClass("absolute");
				} else {
					obj.removeClass("absolute");
				}
			};
			switch (name) {
				case 'set_top_panel_abstract_builder' :
					var obj = $("#dfd_header_t_preview .container.top");
					switcher(obj, val);
					break;
				case 'set_mid_panel_abstract_builder' :
					var obj = $("#dfd_header_t_preview .container.middle");
					switcher(obj, val);
					break;
				case 'set_bot_panel_abstract_builder' :
					var obj = $("#dfd_header_t_preview .container.bottom");
					switcher(obj, val);
					break;
			}
		},
		triggerOptionLocal: function(name){
			var $this = this;
			setTimeout(function(){

				var model = dfd_header_b.APP.settingCollection.findWhere({id: name});
				if(!_.isObject(model)){
//				throw "Model id not found";
					dfd_header_b.APP.settingCollection.reset(dfd_header_b.PreSetting);
					dfd_header_b.Config.setSettingByView(dfd_header_b.APP.settingCollection.toJSON());
					var model = dfd_header_b.APP.settingCollection.findWhere({id: name});
				}
				var val = $("input:checked[name='native[" + name + "]']").val();

				model.set(
						{
							value: val
						});
				dfd_header_b.Config.setSettingByView(dfd_header_b.APP.settingCollection.toJSON());
				dfd_header_b.Helper.saveChanges();
				$this.VisualReInit(name, val);
			}, 200);
		},
		triggerOption: function(name){
			var $this = this;

			setTimeout(function(){

				var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: name});
				var val = dfd_header_b.View.Setting.getValueByName(name);
				model.set({
					value: val
				});
				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
				dfd_header_b.Helper.saveChanges();
			}, 200);
		}
	};
	dfd_header_b.View.Input.image = {
		init: function(setting){
			var $this = this;
			var id = setting.id;
			if(setting.value == ""){
				return false;
			}
			var value = JSON.parse(setting.value);
			var image_id = $("input[name='native[" + id + "][id]']");
			var image_thumb = $("input[name='native[" + id + "][thumbnail]']");
			var remove_btn = image_id.parent().find(".buttons-cover");
			var parent = image_id.parent();

//			image_id.val(value.id);
//			image_thumb.val(value.thumb);
//			parent.find(".screenshot img").attr("src", value.thumb);

			switch (id) {
				case "bg_image_side_header_builder" :
					if(dfd_header_b.isInitColorPicker == false){
						image_id.on("change", function(){
							$this.VisualreInit(id);
							$this.triggerOption(id);
						});
						remove_btn.on("click", ".remove-image", function(){
							$this.VisualreInit(id);
							$this.triggerOption(id);
						});
					}
					this.VisualreInit(id);
					break;
				case "logo_header_builder":
					if(value.thumb == ""){
						value.thumb = dfd_header_b_local_settings.logo_url;
					}
					break;
				case "retina_logo_header_builder":
					if(value.thumb == ""){
						value.thumb = dfd_header_b_local_settings.retina_url;
					}
					break;
			}
			image_id.val(value.id);
			image_thumb.val(value.thumb);
			parent.find(".screenshot img").attr("src", value.thumb);
		},
		VisualreInit: function(id){

			setTimeout(function(){
				var style = dfd_header_b.View.Setting.getHeaderStyle();
				var cur_view = dfd_header_b.Config.getCurentView();
				var image_id = $("input[name='native[" + id + "][id]']").val();
				var image_thumb = $("input[name='native[" + id + "][thumbnail]']").val();

				switch (id) {
					case "bg_image_side_header_builder" :
						if(style == "side" && cur_view == "desktop"){
							var big_img = "";
							if(image_thumb){
								big_img = dfd_header_b.Helper.getBigImgFromthumb(image_thumb);
							}
							$("#dfd_header_t_preview .dfd_header_t_preview_wrapper").css({
								"background-image": "url(" + big_img + ")"
							});
						} else {
							$("#dfd_header_t_preview .dfd_header_t_preview_wrapper").css({
								"background-image": "none"
							});
						}
						break;
				}
			}, 100);

		},
		triggerOption: function(id, val){
			setTimeout(function(){

				var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: id});
				var obj = {};
				obj.id = $("input[name='native[" + id + "][id]']");
				obj.thumb = $("input[name='native[" + id + "][thumbnail]']");
				var img_obj = obj;
				var prepare = {
					id: img_obj.id.val(),
					thumb: img_obj.thumb.val()
				};
				var new_value = JSON.stringify(prepare);
				model.set({
					value: new_value
				});
				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
				dfd_header_b.Helper.saveChanges();
			}, 100);
		}
	};
	dfd_header_b.View.Input.colorpicker = {
		transparentImgUrl: "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAAHnlligAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAHJJREFUeNpi+P///4EDBxiAGMgCCCAGFB5AADGCRBgYDh48CCRZIJS9vT2QBAggFBkmBiSAogxFBiCAoHogAKIKAlBUYTELAiAmEtABEECk20G6BOmuIl0CIMBQ/IEMkO0myiSSraaaBhZcbkUOs0HuBwDplz5uFJ3Z4gAAAABJRU5ErkJggg==)",
		init: function(setting){
			var id = setting.id;
			if(setting.value == ""){
				return false;
			}
			var value = JSON.parse(setting.value);
			var colorpicker_obj = $("input[name='native[" + id + "]']");
			if(setting.hidetransparent == "true"){
				colorpicker_obj.parent().parent().parent().find(".color-transparency-check").hide();
			}

			var bg_image_obj = colorpicker_obj.parent().parent().find(".wp-color-result");

			if(value.is_transparent == "true"){
				$("#" + id + "-transparency").attr("checked", "true");
				bg_image_obj.find("span").css({"background-image": this.transparentImgUrl});
				colorpicker_obj.val("transparent");
			} else {
				if(value.color == ""){
					value.color = setting.def;
				}
				setTimeout(function(){
					$("#" + id + "-transparency").removeAttr("checked");

					bg_image_obj.find("span").css({"background": value.color});
					colorpicker_obj.val(value.color);
				}, 200);

			}


			if(value.is_transparent == "true"){
				bg_image_obj.css({"background-image": this.transparentImgUrl});
			} else {
				bg_image_obj.css({"background-image": "none"});
				bg_image_obj.find("span").css("background-color", value.color);
			}


			if(dfd_header_b.isInitColorPicker == false){
				this.event(setting);
			}
		},
		VisualreInit: function(setting){

			var value = JSON.parse(setting.value);
			if(value.is_transparent == "true"){
				value.color = "transparent";
			} else {
				if(value.color == ""){
					value.color = setting.def;
				}
			}

			switch (setting.id) {
				case "header_top_background_color_build" :
					var CanUseOptionInSideHeader = dfd_header_b.Helper.CanUseOptionInSideHeader();
					if(CanUseOptionInSideHeader){
						value.color = "initial";
					}
					$("#dfd_header_t_preview .container.top").css("background-color", value.color);
					break;
				case "header_mid_background_color_build" :
					var CanUseOptionInSideHeader = dfd_header_b.Helper.CanUseOptionInSideHeader();
					if(CanUseOptionInSideHeader){
						value.color = "initial";
					}
					$("#dfd_header_t_preview .container.middle").css("background-color", value.color);
					break;
				case "header_bot_background_color_build" :
					var CanUseOptionInSideHeader = dfd_header_b.Helper.CanUseOptionInSideHeader();
					if(CanUseOptionInSideHeader){
						value.color = "initial";
					}
					$("#dfd_header_t_preview .container.bottom").css("background-color", value.color);
					break;
				case "header_top_text_color_build" :
					$("#dfd_header_t_preview .container.top").css("color", value.color);
					$("#dfd_header_t_preview .container.top .dl-menuwrapper a span").css("background", value.color);
					$("#dfd_header_t_preview .container.top .top-inner-page > span span").css("background", value.color);
					break;
				case "header_mid_text_color_build" :
					$("#dfd_header_t_preview .container.middle").css("color", value.color);
					$("#dfd_header_t_preview .container.middle .dl-menuwrapper a span").css("background", value.color);
					$("#dfd_header_t_preview .container.middle .top-inner-page > span span").css("background", value.color);
					break;
				case "header_bot_text_color_build" :
					setTimeout(function(){
						$("#dfd_header_t_preview .container.bottom").css("color", value.color);
						$("#dfd_header_t_preview .container.bottom .dl-menuwrapper a span").css("background", value.color);
						$("#dfd_header_t_preview .container.bottom .top-inner-page > span span").css("background", value.color);
					}, 100);
					break;
				case "header_border_color_build" :
					setTimeout(function(){
						$("#dfd_header_t_preview .container").css("border-color", value.color);
						$("#dfd_header_t_preview .dfd-header-delimiter").css("border-color", value.color);
						$("#dfd_header_t_preview .Delimiter").css("border-color", value.color);
//						$("#dfd_header_t_controls .Delimiter").css("border-color", value.color);
					}, 200);
					break;
				case "header_side_background_color_builder":
					var CanUseOptionInSideHeader = dfd_header_b.Helper.CanUseOptionInSideHeader();
					if(!CanUseOptionInSideHeader){
						value.color = "initial";
					}
					$("#dfd_header_t_preview .dfd_header_t_preview_wrapper").css({
						"background-color": value.color
					});
					break;
			}
		},
		trrigerOption: function(setting, val){

			var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: setting.id});
			if(!_.isObject(model)){
				var model = dfd_header_b.APP.settingCollection.findWhere({id: setting.id});
			}
			var color = "";
			var is_transparent = "false";
			if(val == "transparent"){
				is_transparent = "true";
			} else {
				is_transparent = "false";
			}
			if(val == ""){
				color = model.get("def");
				if(color == ""){
					for(var k in dfd_header_b.PreSetting) {
						var obj = dfd_header_b.PreSetting[k];
						if(obj.id == setting.id){
							color = obj.def;
							break;
						}
					}
				}
			} else {
				color = val;
			}
			var prepare = {
				color: color,
				is_transparent: is_transparent
			};
			var new_value = JSON.stringify(prepare);
			setting.value = new_value;
			if(_.isObject(model)){
				model.set({
					value: new_value
				});
			} else {
				throw "not found model by id = " + setting.id;
			}

			dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
			dfd_header_b.Config.setSettingByView(dfd_header_b.APP.settingCollection.toJSON());
			dfd_header_b.Helper.saveChanges();
			dfd_header_b.Helper.SetColor();
		},
		event: function(setting){
			var id = setting.id;
			var $this = this;
			setTimeout(function(){
				var $count = 0;
				var $input = $("input[name='native[" + id + "]']");
				var $main_obj = $input.parent().parent().parent();
				var $handler = $main_obj.find(".wp-color-result");
				var $transparent_btn = $main_obj.find(".color-transparency-check input");

				$transparent_btn.on("change click", function(){
					var val = $input.val();
					if(val == ""){
						var saved_color = $("#" + id + "-saved-color").val();
						if(saved_color){
							val = saved_color;
						} else {
							val = $(this).parent().parent().find(".wp-picker-container a span").css("background-color");
						}
						$("input[name='native[" + id + "]']").val(val);
					}
					$this.trrigerOption(setting, val);

				});
				$handler.on("click", function(){
					var $self = $(this);
					var refreshIntervalId = setInterval(function(){
						if($self.hasClass("wp-picker-open")){
						} else {
							var val = $("input[name='native[" + id + "]']").val();
							$this.trrigerOption(setting, val);
							clearInterval(refreshIntervalId);
						}
						$count++;

					}, 500);
				});
			}, 300);

		}
	};
	dfd_header_b.View.Input.slider = {
		init: function(setting){
			var $this = this;
			var id = setting.id;
			var slider_obj = $("input[name='native[" + id + "]']");
			var data = slider_obj.next();
			var data_max_val = data.data("max");
			var slide_val = ((setting.value - 35) / data_max_val) * 100;
			slide_val = slide_val + "%";
			data.find(".noUi-background").css("left", slide_val);
			slider_obj.val(setting.value);

			if(dfd_header_b.changeslider == true){
				setTimeout(function(){
					redux.args.disable_save_warn = true;
					slider_obj.trigger("change");
					$("#redux_notification_bar").remove();
				}, 100);
			}

			this.visualReInit(setting, setting.value);

			if(dfd_header_b.isInitSlider == false){
				$this.event(setting);
			}
		},
		event: function(setting){
			var id = setting.id;
			var $this = this;
			var $input = $("input[name='native[" + id + "]']");
			$input.on("blur", function(){
				var val = $input.val();
				$this.triggerOption(setting, val);
//				}
			});

			$input.next().on("change", function(){
				var val = $input.val();
				$this.triggerOption(setting, val);
			});
		},
		visualReInit: function(setting, val){
			var value = val + "px";

			switch (setting.id) {
				case "top_header_height_builder" :
					if(!dfd_header_b.Helper.CanUseOptionInSideHeader()){
						$("#dfd_header_t_preview .container.top").css({
							"height": value,
							"min-height": value,
							"line-height": value
						});
					}

					break;
				case "mid_header_height_builder" :
					if(!dfd_header_b.Helper.CanUseOptionInSideHeader()){
						$("#dfd_header_t_preview .container.middle").css({
							"height": value,
							"min-height": value,
							"line-height": value
						});
					}
					break;
				case "bot_header_height_builder" :
					if(!dfd_header_b.Helper.CanUseOptionInSideHeader()){
						$("#dfd_header_t_preview:not(.side-header) .container.bottom").css({
							"height": value,
							"min-height": value,
							"line-height": value
						});
					}
					break;
				case "header_side_bar_width_builder" :
					var style = dfd_header_b.View.Setting.getHeaderStyle();
					var cur_view = dfd_header_b.Config.getCurentView();
					if(style == "side" && cur_view == "desktop"){
						$("#dfd_header_t_preview .dfd_header_t_preview_wrapper").css({
							"width": value,
						});
					} else {
						$("#dfd_header_t_preview .dfd_header_t_preview_wrapper").css({
							"width": "100%",
						});
					}
					dfd_header_b.Helper.setDelimiterWidth();
					dfd_header_b.Helper.SetColor();
					break;
			}
			dfd_header_b.Helper.calculateOptimalLogoWidth();
		},
		triggerOption: function(setting, val){
			var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: setting.id});

			if(_.isObject(model)){
				model.set({
					value: val
				});
			} else {
				throw "not found model by id = " + setting.id;
			}

			dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
			dfd_header_b.Helper.saveChanges();
			this.visualReInit(setting, val)
		},
	};
	dfd_header_b.View.Input.image_select = {
		init: function(setting){
			var id = setting.id;
			var value = setting.value;
			var $this = this;
			var checkboxes = $("input[name='native[" + id + "]']");
			var checkboxes_checked = $("input:checked[name='native[" + id + "]']");
			checkboxes.removeAttr("checked");
			checkboxes.each(function(){
				var ch_value = $(this).val();
				if(ch_value == value){
					$(this).attr("checked", "checked");
					$(this).parent().addClass("redux-image-select-selected");
				} else {
					$(this).parent().removeClass("redux-image-select-selected");
				}

			});
			$("#dfd_header_t_preview .container.bottom").css({
				"height": "",
				"min-height": "",
				"line-height": ""
			});
			if(dfd_header_b.isInitColorPicker == false){
				checkboxes.parent().on("click", function(){
					dfd_header_b.Helper.addLoader();
					$this.VisualReInit(id);
					$this.triggerOption(id);
					return false;
				});
			}
			this.VisualReInit(id);
		},
		VisualReInit: function(id){
			var checkboxes = $("input[name='native[" + id + "]']");
			var checkboxes_checked = $("input:checked[name='native[" + id + "]']");
			var prev = $("#dfd_header_t_preview");
			switch (checkboxes_checked.val()) {
				case "horizontal" :
					prev.addClass("horiz-header");
					prev.removeClass("side-header");
					prev.removeClass("boxed-header");


					break;
				case "side" :
					var view = dfd_header_b.Config.getCurentView();
					if(view == "desktop"){
						prev.addClass("side-header");
						prev.removeClass("horiz-header");
						prev.removeClass("boxed-header");
						$("#dfd_header_t_preview .container.bottom").css({
							"height": "",
							"min-height": "",
							"line-height": ""
						});
					}

					break;
				case "boxed" :
					prev.removeClass("side-header");
					prev.removeClass("horiz-header");
					prev.addClass("boxed-header");

					break
			}

		},
		triggerOption: function(name){
			var $this = this;
			var scroll= $("#dfd_header_t_preview").scrollTop();
			$("body").scrollTop(scroll + 500);
			setTimeout(function(){

				var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: name});
				var checkboxes_checked = $("input:checked[name='native[" + name + "]']");
				var val = checkboxes_checked.val();
				model.set({
					value: val
				});

				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());

				dfd_header_b.Helper.saveChanges();
				dfd_header_b.APP.Builder.build();
			}, 300);
		}
	};
	dfd_header_b.View.Input.radio = {
		init: function(setting){
			var id = setting.id;
			var value = setting.value;
			var $this = this;
			var checkboxes = $("input[name='native[" + id + "]']");
			var checkboxes_checked = $("input:checked[name='native[" + id + "]']");
			checkboxes.removeAttr("checked");
			checkboxes.each(function(){
				if($(this).val() == value){
					$(this).attr("checked", "checked");
				}
			});
			if(dfd_header_b.isInitColorPicker == false){
				checkboxes.parent().on("click", function(){
					$this.VisualReInit(id);
					$this.triggerOption(id);
				});
			}
			this.VisualReInit(id);
		},
		VisualReInit: function(id){
			setTimeout(function(){
				var val = $("input:checked[name='native[" + id + "]']").val();
				var prev = $("#dfd_header_t_preview");
				switch (id) {
					case "header_alignment_builder" :
						var posible_values = [
							"left",
							"right",
						];
						dfd_header_b.Helper.classSwitcher(val, posible_values, prev, "header_alignment");
						break;
					case "header_content_alignment_builder" :
						var posible_values = [
							"alignleft",
							"alignright",
							'aligncenter',
						];
						dfd_header_b.Helper.classSwitcher(val, posible_values, prev, "header_content_alignment");
						break;
					case "header_bg_position_builder":
						var posible_values = [
							"center-center",
							"top",
							'top-right',
							'right',
							'right-bottom',
							'bottom',
							'bottom-left',
							'left',
							'left-top'
						];
						dfd_header_b.Helper.classSwitcher(val, posible_values, prev, "header_bg_position");
						break;
					case "header_bg_size_builder":
						var posible_values = [
							"cover",
							"contain",
							"initial",
						];
						dfd_header_b.Helper.classSwitcher(val, posible_values, prev, "header_bg_size");
						break;
					case "header_bg_repeat_builder":
						var posible_values = [
							"repeat",
							"no-repeat",
						];
						dfd_header_b.Helper.classSwitcher(val, posible_values, prev, "header_bg_repeat");
						break;
				}
			}, 100);
		},
		triggerOption: function(name){
			var $this = this;
			var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: name});
			var checkboxes_checked = $("input:checked[name='native[" + name + "]']");
			var val = checkboxes_checked.val();
			model.set({
				value: val
			});
			dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
			dfd_header_b.Helper.saveChanges();

		}
	};
	dfd_header_b.View.Input.text = {
		init: function(setting){
			var $this = this;
			var id = setting.id;
			var value = setting.value;
			var input = $("input[name='native[" + id + "]']");
			input.val(value);
			if(dfd_header_b.isInitColorPicker == false){
				input.on("change", function(){
					$this.triggerOption(id);
				});
			}
		},
		triggerOption: function(id){
			var $this = this;
			setTimeout(function(){
				var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: id});
				var input = $("input[name='native[" + id + "]']");
				var val = input.val();
				model.set({
					value: val
				});
				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
				dfd_header_b.Helper.saveChanges();
				dfd_header_b.APP.Builder.build(false);
				dfd_header_b.Helper.SetColor();

			}, 100);
		}
	};
	dfd_header_b.View.Input.telephone = {
		init: function(setting){
			var $this = this;
			var id = setting.id;
			var value = setting.value;
			var input = $("input[name='native[" + id + "]']");
			input.val(value);
			if(dfd_header_b.isInitColorPicker == false){
				input.on("change", function(){
					$this.triggerOption(id);
				});
			}
		},
		triggerOption: function(id){
			var $this = this;
			setTimeout(function(){
				var model = dfd_header_b.APP.globalSettingCollection.findWhere({id: id});
				var input = $("input[name='native[" + id + "]']");
				var val = input.val();
				model.set({
					value: val
				});
				dfd_header_b.Config.setGlobalSetting(dfd_header_b.APP.globalSettingCollection.toJSON());
				dfd_header_b.Helper.saveChanges();
				dfd_header_b.APP.Builder.build(false);
				dfd_header_b.Helper.SetColor();

			}, 100);
		}
	};

})(jQuery);