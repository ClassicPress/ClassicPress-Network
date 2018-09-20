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