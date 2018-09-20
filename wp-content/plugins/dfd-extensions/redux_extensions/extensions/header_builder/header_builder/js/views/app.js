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