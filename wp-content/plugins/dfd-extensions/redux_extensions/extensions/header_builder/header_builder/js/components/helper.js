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
