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
