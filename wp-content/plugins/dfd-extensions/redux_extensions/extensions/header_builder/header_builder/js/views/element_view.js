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