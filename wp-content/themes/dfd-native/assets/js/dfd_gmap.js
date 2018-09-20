(function($){
	'use strict'

	$.fn.dfd_gmap = function(options)
	{
		new $.DfdGmapAPI(options, this);
	}
	$.DfdGmapAPI = function(options, container){
		this.options = options;
		this.container = container;
		this.map;
		this.delay = 500;
		this.has_hover_img = false;
		this.infowondowsObj = [
		];
		this.idexmarker = 700;
		this._init();
	}
	$.DfdGmapAPI.prototype = {
		_getOptions: function(){

			var enable_zoom = this.options.enable_zoom ? true : false;
			var mapOptions = {
				zoom: this.options.zoom,
				zoomControl: enable_zoom,
				disableDoubleClickZoom: !enable_zoom,
				mapMaker: false,
				styles: this.options.styles,
				center: {lat: -25.363, lng: 136.044},
				disableDefaultUI: true,
				mapTypeControl: false,
				scrollwheel: false,
				draggable: this._isDraggable(),
			}
			return mapOptions;
		},
		_isDraggable: function(){
			isDraggable = true;
			if(!this.options.disableTouchOnMobile){
				var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
				var isDraggable = w > 1024 ? true : false;
			}
			return isDraggable;
		},
		_getinfowindows: function(){
			if(typeof this.data != "undefined"){
				return this.data[0].infowindows;
			}
			return [
			];
		},
		_getMarkers: function(){
			return this.data[0].markers;
		},
		_getImgObj: function(){
			return this.data[0].imgObj;
		},
		_loop: function(i){
			var self = this;
			setTimeout(function(){
				if(--i){          // If i > 0, keep going
					self._loop(i);       // Call the loop again, and pass it the current value of i
				}
			}, 4000);
		},
		_geocodeAddress: function(obj_location){

			var self = this;
			var address = obj_location.marker_location;
			var is_last = obj_location.is_last;
			this.geocoder.geocode({'address': address}, function(results, status){
				if(status === google.maps.GeocoderStatus.OK){
					var LatLng = results[0].geometry.location;
					var arr = [
						{
							content: obj_location.marker_content,
							latlng: LatLng,
							image: obj_location.marker_image,
							hover_image: obj_location.hover_marker_image,
							tooltip_show_setting: obj_location.tooltip_show_setting,
							is_last: is_last
						}
					];
					if(obj_location.show_tooltip == "infowindow"){
						self.data[0].infowindows.push(arr);
						self._createInfowWindow(arr);
					} else {
						self.data[0].markers.push(arr);
						self._createMarker(arr);
					}
				} else {
					if(status == "OVER_QUERY_LIMIT"){
						setTimeout(function(){
							self._geocodeAddress(obj_location);
						}, self.delay);
					}
					console.log('Geocode was not successful for the following reason: ' + status);
				}
			});
		},
		_data: function(){
			this.obj = {
				elem: [
				],
				closeBtn: [
				]
			}
			this.data = [
				{
					infowindows: [
					],
					markers: [
					],
					imgObj: [
					]
				}
			];
			var self = this;
			for(var location in this.options.location) {

				var obj_location = this.options.location[location];

				var LatLng = self.result;

				this._geocodeAddress(obj_location);

			}
		},
		_print: function(){

		},
		_createInfowWindow: function(obj){
			var infowinow = new google.maps.InfoWindow({
				content: obj[0].content,
				position: obj[0].latlng,
				maxWidth: 500,
				pixelOffset: {
					height: 8,
					width: 0
				},
				zIndex: 666
			});
			infowinow.open(this.map);
			if(this.options.auto_pan == "show"){
				this.map.setCenter(infowinow.getPosition());
			}
			this.obj.elem.push(infowinow);
		},
		_createMarker: function(obj){

			var self = this;
			obj = obj[0];
			var image = "";
			self.idexmarker++;
			if(obj.image){
				var image = {
					url: obj.image,
				};
			}
			var len = this.data[0].markers.length - 1;
			if(obj.hover_image){
				var index = "#gmimap" + len;
				var hov_img = {
					id: index,
					index: self.idexmarker,
					img: obj.hover_image,
					content: obj.content
				}
				this.data[0].imgObj.push(hov_img);
				this.has_hover_img = true;
				this.map.setOptions({zoomControl: false});
				this.map.setOptions({disableDoubleClickZoom: true});
			}


			var marker = new google.maps.Marker({
				position: obj.latlng,
				map: self.map,
				icon: image,
				optimized: false,
				zIndex: self.idexmarker,
				opacity: 1
			});

			if((obj.tooltip_show_setting == "always_show" || obj.tooltip_show_setting == "show_onclick") && obj.content){

				var infowindow = new google.maps.InfoWindow({
					content: obj.content,
					maxWidth: 500,
					pixelOffset: {
						height: 10,
						width: 0
					},
				});
				if(obj.tooltip_show_setting == "always_show"){
					infowindow.open(this.map, marker);
				}
				if(obj.tooltip_show_setting == "show_onclick"){
					infowindow.setZIndex(self.idexmarker);
					self.obj.closeBtn.push(self.idexmarker);
				}
				marker.addListener('click', function(){
					infowindow.open(this.map, marker);
					self._stylingInfoWindows();
					setTimeout(function(){
						self._styletooltip();
						self._showTooltips();
					}, 300);
				});
				self._stylingInfoWindows();

			}
			if(self.options.auto_pan == "show"){
				this.map.setCenter(obj.latlng);
			}
			setTimeout(function(){
				self.map.setCenter(obj.latlng);
			}, 200);
			if(obj.is_last == "true"){
				setTimeout(function(){
					self.map.setCenter(obj.latlng);
				}, 300);
			}
			this.obj.elem.push(marker);
		},
		_styletooltip: function(){
			var self = this;
			var obj = this.container.find(".gm-style-iw");
			obj.each(function(){
				var main = $(this).parent();
				var z_index = main.css("z-index");
				if(!main.hasClass("aligned")){
					for(var key in self.obj.closeBtn) {
						var inx = self.obj.closeBtn[key];
						if(inx == z_index){
							main.addClass("close_btn");
						}
					}
					main.addClass("aligned");
					var pos = main.position().left;
					var width = main.width();
					var offset = 42;
					if(width < 120){
						offset = 25;
						pos = pos + offset;
					} else {
						pos = pos + offset;
					}

					main.css({"left": pos});

					var arrow = main.find("div:first-child div:nth-child(3)");
					if(!arrow.hasClass("arrow_align")){
						arrow.addClass("arrow_align");
						arrow.css({"left": (arrow.position().left) - offset});
					}

				}

			});

		},
		_stylingInfoWindows: function(){
			var mainobj = this.container.find(".gm-style-iw");
			var findStandartInfoWin = mainobj.find(".poi-info-window");
			if(findStandartInfoWin.length == 0){
				mainobj.addClass("CustomStyleInfoWin");
				mainobj.prev().addClass("gmap-infowindows-style");
			} else {
			}
		},
		ismsie: function()
		{
			var ua = window.navigator.userAgent;
			var msie = ua.indexOf("MSIE ");

			if(msie > 0)
			{
			} else {
				$(".dfd_gmap .gm-style div div div .gmnoprint").css({"opacity": "1"});
			}
		},
		_init: function()
		{
			var self = this;
			this.map = new google.maps.Map(document.getElementById(this.options.id), this._getOptions());

			this.geocoder = new google.maps.Geocoder();
			this.bounds = new google.maps.LatLngBounds();

			this._data();

			var canPan = true;

			this.map.addListener('zoom_changed', function(){
				var aligned = self.container.find(".aligned");

				aligned.each(function(){
					var z_index = $(this).css("z-index");
					/*
					 *  666 - it's z-index of single infowindow object without marker
					 */
					if(z_index != 666){
						var arrow_aligned = $(this).find(".arrow_align");
						arrow_aligned.each(function(){
							$(this).removeClass("arrow_align");
						});
					}
					$(this).removeClass("aligned");
				});

				self._addCloaseBtn();
				self._stylingInfoWindows();
				setTimeout(function(){
					self._styletooltip();
					self._showTooltips();
					self.ismsie();
				}, 400);
			});
			this.map.addListener('tilesloaded', function(){
				self._stylingInfoWindows();
				setTimeout(function(){
					self._styletooltip();
					self._showTooltips();
				}, 400);
				if(canPan){
					self._addHoveredImageToBg();
					self._addEvents();

					self._autoPan();
					setTimeout(function(){
						self._styletooltip();
						self._showTooltips();
						if(self.options.auto_pan != "show"){
							var last_obj = self.obj.elem[self.obj.elem.length - 1];
							try {
								self.map.setCenter(last_obj.getPosition());
							} catch(e) {
								console.log("Cannot read property 'latlng' of undefined");
							}
						}
						self._SetUserPan();


					}, 400);
					if(self.options.auto_pan != "show"){
						var last_obj = self.obj.elem[self.obj.elem.length - 1];
						try {
							self.map.setCenter(last_obj.latlng);

						} catch(e) {
							console.log("Cannot read property 'latlng' of undefined");
						}

					}
				}
				canPan = false;

			});
		},
		_SetUserPan: function(){
			var x = 0, y = 0;
			var setZoom = false;
			if(this.options.x_pan){
				x = this.options.x_pan;
				setZoom = true;
			}
			if(this.options.y_pan){
				y = this.options.y_pan;
				setZoom = true;
			}
			if(setZoom){
				this.map.panBy(x, y);
			}
		},
		_addCloaseBtn: function(){
			this.container.find(".aligned");
		},
		_showTooltips: function(){
			this.container.find(".gm-style div:first-child  div:nth-child(3) .gmnoprint").css({"opacity": 1});
		},
		_autoPan: function(){
			if(this.options.auto_pan == "show"){
				for(var k in this.obj.elem) {
					this.bounds.extend(this.obj.elem[k].position);
				}
				this.map.fitBounds(this.bounds);
			}
		},
		_addHoveredImageToBg: function(){
			var self = this;
			setTimeout(function(){
				self.container.find(".gmnoprint > img").each(function(i){
					var iter = i;
					$(this).attr("usemap", "#gmimap" + iter);
				});
			}, 200);

			this._prepareHoveredImages();
		},
		_prepareHoveredImages: function(){

			var self = this;
			var html = '<div class="img_wrapper"></div>';
			var el = this.container.find(".gm-style > div:first-child");
			var w = el.find(".img_wrapper");
			if(w.length <= 0){
				el.append(html);
			}
			var imgObj = this._getImgObj();

			for(var key in imgObj) {


				var url = imgObj[key].img;
				var id = imgObj[key].id;
				var index = imgObj[key].index;
				if(url){
					self._addImage(url, id, index);
				}
			}

		},
		_addImage: function(src, id, index){
			var wrapper = this.container.find(".img_wrapper");
			var find = wrapper.find("div[usemap=" + index + "]");
			if(find.length <= 0){
				wrapper.append("<div class='hover_img' style='background-image: url(" + src + ")' usemap='" + index + "'></div>");
			}
		},
		_addtext: function(id, text){
			var self = this;
			setTimeout(function(){
				var gmnoprint = self.container.find(".gmnoprint");
				gmnoprint.each(function(){
					var index = $(this).css("z-index");
					if(index == id){

						var cont = $(this).find(".gmap_text_appear");
						if(cont.length <= 0){
							$(this).append("<div class='gmap_text_appear'><div class='gmap_text_appear_content'>" + text + "</div></div>");
						} else {
							$(this).find(".gmap_text_appear .gmap_text_appear_content").text(text);
						}
						return true;
					}
				});

			}, 500);
		},
		_addEvents: function(){
			var self = this;
			var imgObj = this._getImgObj();
			setTimeout(function(){

				self.container.find(".gm-style div div div").on("mouseover", ".gmnoprint", function(){
					var id = $(this).css("z-index");
					for(var key in imgObj) {
						if(imgObj[key].index == id){
							$(this).parent().parent().css({"z-index": 110});
							var img = self.container.find(".hover_img[usemap=" + id + "]");
							self._hideAllMarkers(id, this);
							$(this).find(".gmap_text_appear").css({"opacity": "1", "transform": "translateY(15%)", "visibility": "visible"});
							img.css({"opacity": "0.9"});
							continue;
						}
					}

				}).on("mouseleave", function(){
					var el = self.container.find(".gm-style > div:first-child");
					self._showAllMarkers();
					var w = el.find(".img_wrapper .hover_img").css({"opacity": "0"});
					$(this).find(".gmap_text_appear").css({"opacity": "0", "transform": "translateY(55%)", "visibility": "hidden"});
					w.html("");
				});
				;

			}, self.delay);


		},
		_hideAllMarkers: function(id, el){
			var obj = this.container.find(".gm-style .gmnoprint");
			obj.each(function(){
				var index = $(this).css("z-index");
				if(index !== id){
					$(this).find(">img").css({"opacity": "0", "transform": "translateY(10px)"});
				}
			});
			this.container.find(".gm-style-iw").parent().parent().css({"opacity": "0"})
		},
		_showAllMarkers: function(){
			this.container.find(".gm-style .gmnoprint > img").css({"opacity": "1", "transform": "none"});
			this.container.find(".gm-style-iw").parent().parent().css({"opacity": "1"});
		},
	};

})(jQuery);