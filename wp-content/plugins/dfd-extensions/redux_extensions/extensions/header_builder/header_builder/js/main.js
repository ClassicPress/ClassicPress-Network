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