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

