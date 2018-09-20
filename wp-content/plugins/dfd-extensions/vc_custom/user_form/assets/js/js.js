var Dfd_Contact_form_field = {};
(function($, dfd){

	dfd.classMain = '.dfd_contact_form_select';
	dfd.selectedElm = '';
	dfd.curChacngedElem = '';
	dfd.cur_name = '';
	dfd.typeOption = '';
	dfd.cur_name_field = '';
	dfd.base = '';
	dfd.canUpdateAvalField = true;
	dfd.isSetids = false;
	dfd.init = function(){
		dfd.bindEvent();
	};
	dfd.atr = '';
	dfd.obj = {};

	dfd.id = '';

	dfd.bindEvent = function(){
		/*Event on field editor 'select(type of field)' change*/
		$(dfd.classMain).live("change", function(){
			dfd.selectedElm = $(this);
			dfd.findBaseField();
			dfd.clear();
			if(!dfd.selectedElm.val()){
				dfd.removeFormElm();
				dfd.update();
				dfd.updateAvaliableFields();
				dfd.updateAvaliableFieldsForBuilder();
				dfd.pasteCode();
				return;
			}
			atr = dfd.selectedElm.find(":selected").attr("data-value");
			atr = JSON.parse(atr);
			dfd.id = dfd.selectedElm.attr("data-id");
			var selected_val = dfd.selectedElm.find(":selected").val();
			dfd.pasteCode(selected_val, dfd.id);
			dfd.values = "";
			dfd.atr = atr;
			dfd.createForm();
			dfd.update();
			////
			dfd.typeOption = dfd.selectedElm.attr("value");
			dfd.AddToBaseFieldValue("", "");
			//////
			dfd.updateAvaliableFields();
			dfd.updateAvaliableFieldsForBuilder();
		});
		/*
		 * Event on filed editor 'input or textarea' change
		 */
		$(".form_elem input, .form_elem textarea").live("change", function(){
			dfd.initUpdate($(this));
		});
		/* Event on change Style Preset*/
		$("select[name='preset']").live("change", function(){
			val = $(this).val();
			callFunc = "Dfd_Contact_form_field." + val + "()";
			try {
				eval(callFunc);
			} catch(e) {
				console.log(" not calleble" + e);
			}
		});
		/* Event on change radioin field Editor*/
		$("body").on("click", ".checkbox_backend_contactform .dfd_single_checkbox", function(){
			var $self = $(this),
					$button = $self.find(".button-animation"),
					$checkbox = $self.parent().prev().find("input");

			$button.toggleClass("right-active");

			if($self.find(".button-animation").hasClass("right-active")){
				$checkbox.removeAttr("checked").val("");
			} else {
				$checkbox.attr("checked", "checked").val($self.data("value"));
			}
			setTimeout(function(){
				$checkbox.trigger("change");
			}, 300);


		});

	};
	dfd.GenerateTemplate = function(){
		var main = $(".dfd_template_layout.custom");
		var main_template = $("#dfd_cf_custom_field_template").html();
		var select_template = $("#dfd_cf_custom_field_select_template").html();
		var compiled = _.template(select_template);
		var params = [];

		for(var key in _dfdcf_fields) {
			var obj = _dfdcf_fields[key];
			var insert = {};
			insert.rep_arr = obj.name;
			insert.unic_name = obj.unic_name;
			insert.json = obj.json;
			params.push(insert);
		}
		var res = compiled({params: params});
		main_template = main_template.replace(/{{field}}/g, res);
		main.append(main_template);
//		_dfdcf_fields;
	};
	dfd.initUpdate = function($this){
		var val = $this.val();
		var name = $this.attr("name");
		dfd.selectedElm = $this.parents(".form_elem").parent().children(dfd.classMain);
		dfd.typeOption = dfd.selectedElm.attr("value");
		dfd.curChacngedElem = $this;
		dfd.findBaseField();
		dfd.AddToBaseFieldValue(name, val);
		dfd.update();
		dfd.updateAvaliableFields();
		dfd.updateAvaliableFieldsForBuilder();
	};
	dfd.AddToBaseFieldValue = function(name, val){
		base_val = dfd.base.val();
		id = dfd.selectedElm.attr("data-id");

		var delChexboxValue = false;
		if(dfd.curChacngedElem){
			if(dfd.curChacngedElem.attr("type") == "checkbox"){
				if(!dfd.curChacngedElem.attr("checked")){
					delChexboxValue = true;
				}
			}
		}

		if(base_val){
			base_val_parse = JSON.parse(base_val);

			if(!base_val_parse[id]){
				base_val_parse[id] = {};
			}
			if(!base_val_parse[id][dfd.typeOption]){
				base_val_parse[id][dfd.typeOption] = {};
			}
			val = val.replace(new RegExp('\r?\n', 'g'), '{+}');
			base_val_parse[id][dfd.typeOption][name] = val;
			if(delChexboxValue){
				delete base_val_parse[id][dfd.typeOption][name];
			}
			if(!val){
				delete base_val_parse[id][dfd.typeOption][name];
			}

			val = JSON.stringify(base_val_parse);
			dfd.base.val(val);
		} else {
			dfd.obj = {};
			dfd.obj[id] = {};
			dfd.obj[id][dfd.typeOption] = {};
			dfd.obj[id][dfd.typeOption][name] = val;

			val = JSON.stringify(dfd.obj);
			dfd.base.val(val);
		}
	};
	dfd.findBaseField = function(){
		dfd.base = dfd.selectedElm.parentsUntil(".dfd_template_layout").parent().prev();
	};
	dfd.clear = function(){
		base_val = dfd.base.val();
		id = dfd.selectedElm.attr("data-id");
		if(base_val){
			var base_val_parse = JSON.parse(base_val);
			delete base_val_parse[id];
			val = JSON.stringify(base_val_parse);
			dfd.base.val(val);
		}

	};
	dfd.pasteCode = function(type, code){
		if(typeof type == "undefined"){
			dfd.selectedElm.prev().text("");
			return false;
		}
		dfd.selectedElm.prev().text("{{" + type + "-" + code + "}}");
	};
	dfd.updateById = function(inputElm){
		$this = inputElm;
		value = $this.val();
		dfd.base = $this;
		if(value){
			var value = JSON.parse(value);
			dfd.values = value;
			block = $this.next();
			block.find(".dfd_contact_form_select").each(function(index){

				dfd.id = $(this).attr("data-id");
				id = dfd.id;
				if(value[id]){
					dfd.selectedElm = $(this);
					for(type in value[id]) {
						dfd.type = type;
						dfd.selectedElm.find("option").each(function(){
							if($(this).attr("value") == type){
								dfd.pasteCode(type, id);
								$(this).attr("selected", true);
								atr = $(this).attr("data-value");
								atr = JSON.parse(atr);
								dfd.atr = atr;
								dfd.createForm();
							}

						})
					}
				}
			});
		}
		else {
			dfd.values = "";
		}
		dfd.updateAvaliableFields();
		dfd.updateAvaliableFieldsForBuilder();
	};
	dfd.update = function(){

		var prevSelected = dfd.selectedElm;
		var prevSelBase = dfd.base;
		$(".dfd_form_template").each(function(index){
			value = $(this).val();
			if(value){
				dfd.base = $(this);
				var value = JSON.parse(value);
				dfd.values = value;
				block = $(this).next();
				block.find(".dfd_contact_form_select").each(function(index){

					dfd.id = $(this).attr("data-id");
					id = dfd.id;
					if(value[id]){
						dfd.selectedElm = $(this);
						for(type in value[id]) {
							dfd.type = type;
							dfd.selectedElm.find("option").each(function(){
								if($(this).attr("value") == type){
									$(this).attr("selected", true);
									atr = $(this).attr("data-value");
									atr = JSON.parse(atr);
									dfd.atr = atr;
									dfd.createForm();

								}
							})
						}
					}
				});
			}

		});
		dfd.selectedElm = prevSelected;
		dfd.base = prevSelBase;
	}
	dfd.createForm = function(){
		dfd.removeFormElm();
		/// get all property selected value

		for(atr_name in  dfd.atr) {
			/// Type current property
			type = dfd.atr[atr_name].type;
			/// Object current property
			dfd.cur_name = dfd.atr[atr_name];
			//name curent property
			dfd.cur_name_field = atr_name;
			callFunc = "dfd." + type + "()";
			eval(callFunc);
		}
	};
	dfd.insert = function(str){
		dfd.selectedElm.parent().append(str);
	};
	dfd.createFormElement = function(content){
		var str = "";
		str += '<div class="form_elem">';
		str += content;
		str += '</div>';
		return str;
	};
	///////////////////////////////
	dfd.checkbox = function(){
		var str = "";
		name = "";

		for(var option in dfd.cur_name.options) {
			if(dfd.values){
				name = dfd.values[dfd.id][dfd.type][dfd.cur_name_field + "-" + dfd.cur_name.options[option]];
			}
			var checked = "", anim_class = '';
			if(name == "undefined" || name == ""){
				checked = "";
				anim_class = 'right-active';
			} else {
				checked = "checked";
			}
			str += '<div class="wpb_element_label">' + option + '</div><label class="checkbox" style="display: none;"><input type="checkbox" ' + checked + ' name="' + dfd.cur_name_field + "-" + dfd.cur_name.options[option] + '" value="' + dfd.cur_name.options[option] + '">' + option + '</label>';
			str += '<div class="dfd_single_checkbox_wrap checkbox_backend_contactform">' +
					'<label class="dfd_single_checkbox" for="" data-value="' + dfd.cur_name.options[option] + '">' +
					'<span class="button-animation ' + anim_class + '"></span>' +
					'</label>' +
					'<span class="param-title"></span>' +
					'</div>';
		}
		str = dfd.createFormElement(str);
		dfd.insert(str);
	};
	dfd.textarea = function(){
		var str = "";
		value = "";
		if(dfd.values){
			value = dfd.values[dfd.id][dfd.type][dfd.cur_name_field];
		}
		value = value ? value : "";
		value = value.replaceAll("{+}", "\n");


		str += '<label>' + dfd.cur_name.name + '</label><textarea name="' + dfd.cur_name_field + '">' + value + '</textarea>';
		str = dfd.createFormElement(str);
		dfd.insert(str);
	};
	dfd.text = function(){
		var str = "";
		value = "";
		if(dfd.values){
			value = dfd.values[dfd.id][dfd.type][dfd.cur_name_field];
		}
		value = value ? value : "";
		str += '<label>' + dfd.cur_name.name + '</label><input type="text" name="' + dfd.cur_name_field + '" value="' + value + '">';
		str = dfd.createFormElement(str);
		dfd.insert(str);
	};
	dfd.daterange = function(){
		var str = "";
		value = "";
		if(dfd.values){
			value = dfd.values[dfd.id][dfd.type];
		}
		daterange_from_1 = value["daterange_from_1"] ? value["daterange_from_1"] : "";
		daterange_to_2 = value["daterange_to_2"] ? value["daterange_to_2"] : "";
		str += '<label>' + dfd.cur_name.name + '</label><br>' +
				'min <input class="daterange from" data-id="' + dfd.id + '" id="daterange_from_' + dfd.id + '" type="text" name="daterange_from_1" value="' + daterange_from_1 + '">' +
				'max <input class="daterange to" data-id="' + dfd.id + '" id="daterange_to_' + dfd.id + '" type="text" name="daterange_to_2" value="' + daterange_to_2 + '">';
		str = dfd.createFormElement(str);
		dfd.insert(str);
		$("#daterange_from_" + dfd.id).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
//            altField: "#daterange_to_2",
//            altFormat: "DD, d MM, yy",
			onSelect: function(selectedDate){
				dfd.initUpdate($(this));
			},
			onClose: function(selectedDate){
				id = $(this).attr("data-id");
				$("#daterange_to_" + id).datepicker("option", "minDate", selectedDate);
			}
		});
		$("#daterange_to_" + dfd.id).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function(selectedDate){
				dfd.initUpdate($(this));
			},
			onClose: function(selectedDate){
				id = $(this).attr("data-id");
				$("#daterange_from_" + id).datepicker("option", "maxDate", selectedDate);
			}
		});
	};
	///////////////////////////////
	dfd.removeFormElm = function(){
		dfd.selectedElm.parent().find(".form_elem").remove();
	};

	dfd.setIds = function(){
		var i = 1;
		$(".dfd_template_layout").each(function(index){
			var j = 1;
			$(this).find(".dfd_contact_form_select").each(function(){
				$(this).attr("id", "sel-" + i + "-" + j);
				$(this).attr("data-id", j);
				j++;
			});
			i++;
		});

	};
	dfd.setLayoutBuilderIds = function(){
		var i = 1;
		var row = 1;
		$(".dfd_template_layout.custom").each(function(index){
			$(this).find("table").each(function(){
				var j = 1;
				$(this).find(".dfd_contact_form_select").each(function(){
					$(this).attr("id", "sel-" + row + "-" + j);
					$(this).attr("data-id", row + "-" + j);
					$(this).attr("data-pos", row + "-" + j);
					j++;
				});
				row++;
			});
//			var j = 1;
//			$(this).find(".dfd_contact_form_select").each(function(){
//				$(this).attr("id", "sel-" + i + "-" + j);
//				$(this).attr("data-id", j);
//				j++;
//			});
//			i++;
		});

	};
	dfd.AddDefaultValueToForm = function(form){
		switch (form) {
			case "forms_00" :
				jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"name": "Email", "required-1": "1", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"telephone": {"name": "Telephone"}}, "5": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_01" :
				jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"name": "Email", "required-1": "1", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_02" :
				jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"name": "Email", "required-1": "1", "akismet_comment_author_email-1": "1"}}, "3": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_03" :
				jsonPresetVal = {"1": {"email": {"name": "Email", "akismet_comment_author_email-1": "1", "required-1": "1"}}, "2": {"text_name": {"name": "text"}}, "3": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_04" :
				jsonPresetVal = {"1": {"text_name": {"name": "Name", "akismet_comment_author-1": "1", "required-1": "1"}}, "2": {"email": {"required-1": "1", "akismet_comment_author_email-1": "1", "name": "Email"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"telephone": {"name": "Telephone"}}, "5": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_05" :
				jsonPresetVal = {"1": {"text_name": {"name": "Name", "required-1": "1", "akismet_comment_author-1": "1"}}, "2": {"email": {"required-1": "1", "name": "Email", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"required-1": "1", "name": "Subject"}}, "4": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_06" :
				jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"required-1": "1", "name": "Email", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"text_name": {"name": "Subject"}}, "5": {"textarea_name": {"name": "Message"}}};
				break;
			case "forms_07" :
				jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"required-1": "1", "name": "Email", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"required-1": "1", "name": "Subject"}}, "4": {"telephone": {"name": "Telephone"}}, "5": {"text_name": {"name": "Some else"}}, "6": {"text_name": {"name": "Some else"}}, "7": {"text_name": {"name": "Some else"}}, "8": {"text_name": {"name": "Some else"}}};
				break;
			case "forms_08" :
				jsonPresetVal = {"1": {"text_name": {"name": "Name", "required-1": "1", "akismet_comment_author-1": "1"}}, "2": {"email": {"required-1": "1", "name": "Email", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"telephone": {"name": "Telephone"}}, "5": {"text_name": {"name": "Some else"}}, "6": {"textarea_name": {"name": "Message"}}};
				break;
			default:
				jsonPresetVal = {"1": {"text_name": {"required-1": "1", "name": "Name", "akismet_comment_author-1": "1"}}, "2": {"email": {"name": "Email", "required-1": "1", "akismet_comment_author_email-1": "1"}}, "3": {"text_name": {"name": "Subject"}}, "4": {"textarea_name": {"name": "Message"}}};
				;
		}
		valueStr = JSON.stringify(jsonPresetVal);
		base = $(".check_layout_" + form);
		base.val(valueStr);
	};
	dfd.updateAvaliableFields = function(){
		if(!dfd.canUpdateAvalField){
			return false;
		}
		var fields = [
		];
		for(elm in dfd.values) {
			for(name in dfd.values[elm]) {
				fields.push(name + "-" + elm);
			}
		}
		$("#available_fields").text("");
		for(field in fields) {
			$("#available_fields").append("{{" + fields[field] + "}}<br>");
		}
	};
	dfd.updateAvaliableFieldsForBuilder = function(){
		var fields = [
		];
		var val = $("input[name='custom_template']").val();
		if(val == "" || val == null || typeof val == "undefined"){
			return false;
		}
		var prsed = JSON.parse(val);
		for(elm in prsed) {
			for(name in prsed[elm]) {
				fields.push(name + "-" + elm);
			}
		}
		var input = $("#available_fields_for_builder");
		input.text("");
		if(fields.length <= 0){
			return false;
		}
		for(field in fields) {
			input.append("{{" + fields[field] + "}}<br>");
		}
	};
	dfd.preset1 = function(){
		/*Show placeholder*/
		dfd.triggerSwitchOff("placeholder");
		/*Show label to text field*/
		dfd.triggerSwitchOn("show_label_text");
		/*Border Style*/

		/********/
	}
	dfd.preset2 = function(){
		/*Show label to text field*/
		dfd.triggerSwitchOff("show_label_text");
		/*Show placeholder*/
		dfd.triggerSwitchOn("placeholder");
		/*Border Style*/

		/********/
	};
	dfd.preset3 = function(){
		/*Show label to text field*/
		dfd.triggerSwitchOff("show_label_text");
		/*Show placeholder*/
		dfd.triggerSwitchOn("placeholder");
		/*Border Style*/

		/********/

	};
	dfd.triggerSwitchOn = function(name){
		$("[name='" + name + "']").attr("value", "on");
		$("[name='" + name + "']").attr("checked", "checked");
		$("[for='" + name + "'] .button-animation").removeClass("right-active");
	};
	dfd.triggerSwitchOff = function(name){
		$("[name='" + name + "']").attr("value", "off");
		$("[name='" + name + "']").removeAttr("checked");
		$("[for='" + name + "'] .button-animation").addClass("right-active");
	};
	dfd.SetSelectValue = function(name, value){
		$("select[name='" + name + "']").val(value);
	};
	dfd.setInputVal = function(name, value){
		$("[name='" + name + "']").val(value);
	};
	dfd.setColor = function(name, value){
		dfd.setInputVal(name, value);
		$("[name='" + name + "']").parent().prev().css("background-color", value);
	};

})(jQuery, Dfd_Contact_form_field);
Dfd_Contact_form_field.init();

var Dfd_CF = Dfd_CF || {};
Dfd_CF.View = {};
Dfd_CF.Model = {};
Dfd_CF.Collection = {};
Dfd_CF.APP = {};
(function($){
	'use strict';

	Dfd_CF.View.AppView = Backbone.View.extend({
		el: '.dfd_template_layout.custom',
		mainTemplate: '',
		baseInput: '',
		initialize: function(){
			Dfd_CF.APP.presets = new Dfd_CF.Collection.Presets();
			Dfd_CF.APP.rows = new Dfd_CF.Collection.Rows();
			this.baseInput = $("input[name='layout_builder']");
			this.listenTo(Dfd_CF.APP.rows, 'add', _.debounce(this.add, 0));
			this.listenTo(Dfd_CF.APP.rows, 'add', this.addFast);
			this.listenTo(Dfd_CF.APP.rows, 'reset', _.debounce(this.reset, 0));
			this.listenTo(Dfd_CF.APP.rows, 'remove', _.debounce(this.remove, 0));
			this.listenTo(Dfd_CF.APP.rows, 'reset', this.resetfast);
			this.listenTo(Dfd_CF.APP.rows, 'save', _.debounce(this.save, 0));
			this.listenTo(Dfd_CF.APP.rows, 'updateField', _.debounce(this.updateField, 0));
			this.build();
			this.render();
			var self = this;
			/* Event on button (Add new row)*/
			$("#vc_not-empty-add-element-cf").on("click", function(){
				self.add_row();
			});
		},
		add_row: function(){
			var row = new Dfd_CF.Model.Row();
			var pres = new Dfd_CF.Model.Preset({name: "add_col"});
			var collection = new Dfd_CF.Collection.Presets();

			collection.add(pres);

			row.set("presets", collection);

			Dfd_CF.APP.rows.add(row);
			Dfd_CF.APP.rows.trigger("updateField");
			Dfd_CF.APP.rows.trigger("save");
		},
		remove: function(){
			this.save();
			this.updateField();

		},
		build: function(){
			var value = this.baseInput.val();
			if(value == ""){
				var str = [
					{"name": "",
						"presets": [{"name": "col1"}]
					},
				];
				Dfd_CF.APP.rows.reset(str);
				this.save();
			} else {
				value = value.replaceAll("{1+}", "[");
				value = value.replaceAll("{+1}", "]");
				var parse_val = JSON.parse(value);
				Dfd_CF.APP.rows.reset(parse_val);
			}
		},
		save: function(){
			var data = Dfd_CF.APP.rows.toJSON()
			var j = {};
			j.a = data;
			var new_val = JSON.stringify(j.a);
			new_val = new_val.replaceAll("[", "{1+}");
			new_val = new_val.replaceAll("]", "{+1}");
			this.baseInput.val(new_val);
		},
		add: function(row){
			var presets = row.get("presets");

			var row_view = new Dfd_CF.View.rowView({model: row});
			presets.each(function(pr){
				row_view.add(pr);
			});
			row_view.setCountCol();
			this.$el.append(row_view.render().el);
		},
		addFast: function(row){
			var presets = row.get("presets");
			if(typeof presets.models == "undefined"){
				var collection = new Dfd_CF.Collection.Presets(presets);
				row.set("presets", collection);
				return false;
			}

		},
		resetfast: function(){
			Dfd_CF.APP.rows.each(this.addFast, this);
		},
		reset: function(collect, prev){
			this.$el.html("");
			Dfd_CF.APP.rows.each(this.add, this);
			this.updateField();
		},
		updateField: function(){
			Dfd_Contact_form_field.canUpdateAvalField = false;
			Dfd_Contact_form_field.setLayoutBuilderIds();
			Dfd_Contact_form_field.update();
			var base_val = $("[name='custom_template']");
			Dfd_Contact_form_field.updateById(base_val);
			Dfd_Contact_form_field.canUpdateAvalField = true;
		},
		render: function(){
			return this;
		}

	});
	Dfd_CF.View.presetView = Backbone.View.extend({
		mainTemplate: '',
		select_template: '',
		tagName: 'td',
		initialize: function(){
			this.listenTo(this.model, 'remove', this.remove);
			this.mainTemplate = $('#dfd_cf_custom_field_template').html();
			this.select_template = _.template($("#dfd_cf_custom_field_select_template").html());
		},
		remove: function(){
			this.$el.remove();

		},
		render: function(){
			var params = [];
			for(var key in _dfdcf_fields) {
				var obj = _dfdcf_fields[key];
				var insert = {};
				insert.rep_arr = obj.name;
				insert.unic_name = obj.unic_name;
				insert.json = obj.json;
				params.push(insert);
			}
			var code = "";
			var ids = this.model.cid;
			var mod = this.model;
			var find = "";
			var row_pos = 1;
			Dfd_CF.APP.rows.each(function(row){
				var cols_collection = row.get("presets");
				var col_pos = 1;
				cols_collection.each(function(col){
					if(col.cid == ids){
						code = row_pos + "-" + col_pos;
					}
					col_pos++;
				});

				row_pos++;
			});
			var res = this.select_template({params: params, code: code});
			this.mainTemplate = this.mainTemplate.replace(/{{field}}/g, res);
			this.$el.append(this.mainTemplate);
			return this;
		}
	});
	Dfd_CF.View.rowView = Backbone.View.extend({
		mainTemplate: '',
		tagName: 'div',
		className: "row_custom",
		events: {
			"click .set_columns": "add_col",
			"click .column_delete": "del_row",
		},
		click: function(){
		},
		setCountCol: function(){
			var count = this.model.get("presets").size();
			this.$el.find(".set_columns").removeClass("active");
			switch (count) {
				case 1:
					this.$el.find("[data-cells=11]").addClass("active");
					break;
				case 2:
					this.$el.find("[data-cells=12_12]").addClass("active");
					break;
				case 3:
					this.$el.find("[data-cells=13_13_13]").addClass("active");
					break;
				case 4:
					this.$el.find("[data-cells=14_14_14_14]").addClass("active");
					break;
				default:
					this.$el.find("[data-cells=11]").addClass("active");
					break;
			}
		},
		sortByKey: function(arr){
			var keys = [],res = {},
					k, i, len;
			for(k in arr) {
				if(arr.hasOwnProperty(k)){
					keys.push(k);
				}
			}
			keys.sort();
			len = keys.length;
			for(i = 0; i < len; i++) {
				k = keys[i];
				res[k] = arr[k];
			}
			return res;
		},
		del_row: function(){
			var self = this;
			if(Dfd_CF.APP.rows.size() > 1){
				var cur_model = this.model;
				var row_pos = 1;
				Dfd_CF.APP.rows.each(function(m){
					if(m.cid == cur_model.cid){
						var v = $("input[name='custom_template']").val();
						var presets = JSON.parse(v);
						var paste = {};
						var finded = false;
						presets = self.sortByKey(presets);
						for(var key in presets) {
							var r = '(' + row_pos + ')-';
							var find = new RegExp(r).exec(key);
							var second = new RegExp('(\\d)-(\\d)').exec(key);
							var firt_part = parseInt(second[1])
							var second_part = parseInt(second[2])
							if(!find){
								if(finded){
									firt_part = firt_part - 1;
								}
								var new_key = firt_part + "-" + second_part;
								var obj = presets[key];
								paste[new_key] = obj;
							} else {
								finded = true;
							}
						}
						var new_val = JSON.stringify(paste);
						$("input[name='custom_template']").val(new_val);
					}
					row_pos++;
				});
				this.model.destroy();
			} else {
				alert("Can't delete all rows. Most be one row");
			}
			return false;

		},
		add_col: function(target){
			var remove = function(rem, presets){
				for(var key in rem) {
					presets.remove(rem[key]);
				}
			};
			var self = this;
			var tar = target.currentTarget;
			this.$el.find(".set_columns").removeClass("active");
			$(tar).addClass("active");
			var type = String($(tar).data("cells"));
			var presets = this.model.get("presets");
			var count = presets.length;
			var p = new Dfd_CF.Model.Preset({name: "col2"});
			var rem = [];
			switch (type) {
				case "11":
					presets.each(function(pr, i){
						if(i > 0){
							rem.push(pr);
						}
					});
					remove(rem, presets);
					break;
				case "12_12":
					var point = 2;
					presets.each(function(pr, i){
						if(i > 1){
							rem.push(pr);
						}
					});
					remove(rem, presets);
					if(count < point){
						var to = point - count;
						for(var i = 0; i < to; i++) {
							self.add(p.clone());
						}
					}
					break;
				case "13_13_13":
					var point = 3;
					presets.each(function(pr, i){
						if(i > 2){
							rem.push(pr);
						}
					});
					remove(rem, presets);
					if(count < point){
						var to = point - count;
						for(var i = 0; i < to; i++) {
							self.add(p.clone());
						}
					}
					break;
				case "14_14_14_14":
					var point = 4;
					presets.each(function(pr, i){
						if(i > 3){
							rem.push(pr);
						}
					});
					remove(rem, presets);
					if(count < point){
						var to = point - count;
						for(var i = 0; i < to; i++) {
							self.add(p.clone());
						}
					}
					break;
			}
			Dfd_CF.APP.rows.trigger("updateField");
			Dfd_CF.APP.rows.trigger("save");
			return false;
		},
		add_row: function(){
			var row = new Dfd_CF.Model.Row();
			var pres = new Dfd_CF.Model.Preset({name: "add_col"});

			var collection = new Dfd_CF.Collection.Presets();
			collection.add(pres);
			row.set("presets", collection);
			Dfd_CF.APP.rows.add(row);
			Dfd_CF.APP.rows.trigger("updateField");
			Dfd_CF.APP.rows.trigger("save");
			return false;

		},
		initialize: function(){
			this.listenTo(this.model, 'remove', this.remove);
			this.mainTemplate = $('#dfd_cf_custom_row_template').html();
			this.$el.append(this.mainTemplate);
		},
		remove: function(){
			this.$el.remove();
		},
		add: function(model){
			var all = this.model.get("presets");
			if(all != ""){
				all.add(model);
			} else {
				var new_preset = new Dfd_CF.Collection.Presets(model);
				this.model.set("presets", new_preset);
			}
			var pres = new Dfd_CF.View.presetView({model: model});
			this.$el.find("tr").append(pres.render().el);
		},
		render: function(){
			return this;
		}
	});
	Dfd_CF.Model.Preset = Backbone.Model.extend({
		defaults: {
			name: '',
		},
	});
	Dfd_CF.Model.Row = Backbone.Model.extend({
		defaults: {
			name: '',
			presets: [],
		},
	});

	Dfd_CF.Collection.Presets = Backbone.Collection.extend({
		model: Dfd_CF.Model.Preset,
		parse: function(response){
			return response;
		}
	});
	Dfd_CF.Collection.Rows = Backbone.Collection.extend({
		model: Dfd_CF.Model.Row,
		parse: function(response){
			return response;
		}
	});
	Dfd_CF.APP.presets = new Dfd_CF.Collection.Presets();
	Dfd_CF.APP.rows = new Dfd_CF.Collection.Rows();
})(jQuery);

String.prototype.replaceAll = function(str1, str2, ignore)
{
	return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), (ignore ? "gi" : "g")), (typeof (str2) == "string") ? str2.replace(/\$/g, "$$$$") : str2);
} 