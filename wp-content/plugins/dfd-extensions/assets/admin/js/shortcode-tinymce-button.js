(function($){
	setUserSetting('hidetb', 1);
	tinymce.PluginManager.add('crumshortcodes', function(editor, url){
		var property = 'color';
		var command = 'ForeColor';
		var index = 400;
		/*
		 editor.addButton('New_Dropcaps', {
		 text: 'New Dropcaps',
		 onclick: function(){
		 editor.windowManager.open({
		 title: 'Insert Dropcap Shortcode',
		 body: [
		 {
		 type: 'listbox',
		 name: 'dropcapClass',
		 'values': [
		 {text: 'Square + shadow', value: 'square shadow'},
		 {text: 'Square + border', value: 'square border'},
		 {text: 'Square + colored border', value: 'square border main'},
		 {text: 'Square + border + shadow', value: 'square border shadow'},
		 {text: 'Square + colored border + shadow', value: 'square border shadow main'},
		 {text: 'Square filled + shadow', value: 'square filled shadow'},
		 {text: 'Square filled', value: 'square filled'},
		 {text: 'Double bottom border', value: 'square border double'},
		 {text: 'Double bottom border + shadow', value: 'square border double shadow'},
		 {text: 'Double bottom colored border', value: 'square border double  main'},
		 {text: 'Double colored border + shadow', value: 'square border double shadow main'},
		 {text: 'Rounded + shadow', value: 'rounded shadow'},
		 {text: 'Rounded filled', value: 'rounded filled'},
		 {text: 'Rounded filled + shadow', value: 'rounded filled shadow'},
		 {text: 'Rounded filled + raised', value: 'rounded filled raised'},
		 {text: 'Rounded gray + raised', value: ' rounded gray-bg raised'},
		 {text: 'Rounded + text colored', value: ' rounded text-colored'},
		 {text: 'Circle + shadow', value: 'circle shadow'},
		 {text: 'Circle filled', value: 'circle filled'},
		 {text: 'Circle filled + shadow', value: 'circle filled shadow'}
		 
		 ]
		 }
		 ],
		 onsubmit: function(e){
			 var selected_text = tinyMCE.activeEditor.selection.getContent();
			if(jQuery(tinyMCE.activeEditor.selection.getNode()).find('.dfd-dropcap').length){
				selected_text = selected_text.replace(/<\/?span[^>]*>/g, "");
			}
			editor.insertContent('<span class="dfd-dropcap ' + e.data.dropcapClass + '">' + selected_text.charAt(0) + '</span>' + selected_text.slice(1));
		 }
		 });
		 }
		 }
		 );
		 */
		editor.addButton('Testimonial', {
			text: 'Testimonial',
			icon: 'testimonial-icon',
			onclick: function(){
				var selected_text = tinyMCE.activeEditor.selection.getContent();
				editor.insertContent('<blockquote class="dfd-textmodule-blockquote">' + selected_text + '</blockquote>');
			}
		}
		);

		editor.addButton('Featured_quote', {
			text: 'Featured quote',
			icon: 'featured-quote-icon',
			onclick: function(){
				var selected_text = tinyMCE.activeEditor.selection.getContent();
				editor.insertContent('<q class="dfd-textmodule-featured-quote">' + selected_text + '</q>');
			}
		}
		);

		editor.addButton('FeaturedDecoration', {
			text: 'Featured decoration',
			icon: 'mce-ico mce-i-italic',
			onclick: function(){
				var selected_text = tinyMCE.activeEditor.selection.getContent();
				editor.insertContent('<em class="dfd-textmodule-featured-decoration">' + selected_text + '</em>');
			}
		}
		);

		colorPickerFunc = function(){
//			console.log(this);
			var panel = $(this.getEl());
			setTimeout(function(){
				var pos = panel.position();
				var id = panel.attr("id");
				panel.parent().append('<input type="text" name="sfgdf" class="' + id + '">');
				var obj_c = $("." + id);
				obj_c.wpColorPicker({
					change: function(event, ui){
						panel.val((obj_c.wpColorPicker('color')));
					},
					clear: function(){
					}
				}).parentsUntil(".wp-picker-container").parent().css(
						{
							"background": "white",
							"position": "absolute",
							"top": pos.top,
							"left": pos.left,
							"z-index": index--
						}
				);
				panel.hide();

			}, 200);
			panel.val(this.settings.color);
		};

		editor.addButton('DropCaps', {
			text: 'DropCaps',
			icon: 'dropcaps-icon',
			onclick: function(){
				editor.windowManager.open({
					title: 'Drops caps settings',
					width: 500,
					height: 370,
					body: [
//						{
//							type: 'checkbox',
//							name: 'title',
//							label: 'Your title',
//							classes: 'what'
//						},
						{
							type: 'textbox',
							name: 'background_color',
							label: 'Background color',
//							color: "#e9e9e9",
							onPostRender: colorPickerFunc
						},
						{
							type: 'textbox',
							name: 'text_color',
							label: 'Text color',
							onPostRender: colorPickerFunc
						},
						{
							type: 'textbox',
							name: 'border_color',
							label: 'Border color',
							onPostRender: colorPickerFunc
						},
						{
							type: 'textbox',
							name: 'font_size',
							label: 'Font size (px)',
						},
						{
							type: 'textbox',
							name: 'margin_top',
							label: 'Margin top (px)',
						},
						{
							type: 'listbox',
							name: 'border_style',
							label: 'Border Style',
							'values': [
								{text: 'solid', value: 'solid'},
								{text: 'dashed', value: 'dashed'},
								{text: 'dotted', value: 'right'},
								{text: 'double', value: 'double'}
							]
						},
						{
							type: 'textbox',
							name: 'border_width',
							label: 'Border Width (px)',
						},
						{
							type: 'textbox',
							name: 'border_radius',
							label: 'Border Radius (px)',
						},
//						{
//							type: 'textbox',
//							name: 'mycolorpicker2',
//							onPostRender: colorPickerFunc
//						},
					],
					onsubmit: function(e){
						var cont = tinyMCE.activeEditor.getContent();
						var font_size;
						var border_style = "";
						var border_color = "";
						var border_width = 1;
						var border_radius = 6;
						var margin_top = 0;
						var kx = 1.72;

//						var char = $(cont).text().charAt(0);
//						if($(cont).find('.drop-caps-color').length){
//							cont = cont.replace(/<span class=\"drop-caps-color\".*>.*<\/span>/g, char);
//						}
//						var re = new RegExp("^(<.*>)?" + char, 'g');
//						prev = cont.match(re);
//						var previus_text = prev[0].slice(0, prev[0].length - 1);
						var style = " style='";

						if(e.data.font_size){
							font_size = e.data.font_size;
						}
						if(e.data.border_style){
							border_style = e.data.border_style;
						}
						if(e.data.border_color){
							border_color = e.data.border_color;
						}
						if(e.data.border_width){
							border_width = e.data.border_width;
						}
						if(e.data.border_radius){
							border_radius = e.data.border_radius;
						}
						if(e.data.margin_top){
							margin_top = e.data.margin_top;
						}
						style += font_size ? "font-size:" + font_size + "px;" : "";
						style += font_size ? "line-height:" + (font_size*kx) + "px;" : "";
						style += font_size ? "width:" + (font_size*kx) + "px;" : "";
						style += font_size ? "height:" + (font_size*kx) + "px;" : "";
						
						style += margin_top ? "top:" + margin_top + "px;" : "";
						
						if(!e.data.background_color && !e.data.border_color){
							style += "font-weight:bold;";
							style += font_size ? "font-size:" + font_size + "px;" : "font-size:43px;";
							style += "color:#3498db;";
						}
						style += "background-color:" + e.data.background_color + ";";
						style += "color:" + e.data.text_color + ";";
						if(e.data.border_color){
							style += border_style ? "border-style:" + border_style + ";" : "";
							style += border_color ? "border-color:" + border_color + ";" : "";
							style += border_width ? "border-width:" + border_width + "px;" : "";
							style += border_radius ? "border-radius:" + border_radius + "px;" : "";
							style += font_size ? "line-height:" + (font_size*kx) + "px;" : "";
							style += font_size ? "width:" + (font_size*kx) + "px;" : "";
							style += font_size ? "height:" + (font_size*kx) + "px;" : "";
						}
						style += "' ";
						
						var selected_text = tinyMCE.activeEditor.selection.getContent();
						if(jQuery(tinyMCE.activeEditor.selection.getNode()).find('.drop-caps-color').length){
							selected_text = selected_text.replace(/<\/?span[^>]*>/g, "");
						}
						editor.insertContent('<span class="drop-caps-color" '+style+'>' + selected_text.charAt(0) + '</span>' + selected_text.slice(1));
						
//						cont = cont.replace(prev[0], previus_text + "<span class='drop-caps-color'" + style + ">" + char + "</span>");
//
//						tinyMCE.activeEditor.setContent("");
//						editor.insertContent(cont);
					}
				});

			},
		}
		);

		editor.addButton('UnderlineAdvanced', {
			text: 'UnderlineAdvanced',
			icon: 'mce-ico mce-i-hr',
			onclick: function(){
				editor.windowManager.open({
					title: 'Underline decoration settings',
					width: 500,
					height: 170,
					body: [
						{
							type: 'textbox',
							name: 'border_color',
							label: 'Line color',
							onPostRender: colorPickerFunc
						},
						{
							type: 'textbox',
							name: 'border_width',
							label: 'Line height (px)',
						},
						{
							type: 'textbox',
							name: 'margin_top',
							label: 'Shift bottom (%)',
						},
					],
					onsubmit: function(e){
						var cont = tinyMCE.activeEditor.getContent();
						var border_color = "";
						var border_width = 1;
						var margin_top = 0;

						var style = " style='";

						border_color = e.data.border_color ? e.data.border_color : '';
						
						border_width = e.data.border_width ? +e.data.border_width : 1;
						
						margin_top = e.data.margin_top ? +e.data.margin_top : 0;
						
						style += "background-position: 0 " + (100 + margin_top) + "%;";
						
						style += "background-image: -webkit-linear-gradient(to bottom, " + border_color + " 0, " + border_color + " 100%);";
						style += "background-image: -moz-linear-gradient(to bottom, " + border_color + " 0, " + border_color + " 100%);";
						style += "background-image: linear-gradient(to bottom, " + border_color + " 0, " + border_color + " 100%);";
						
						style += "background-size: 100% " + border_width + "px;";
						
						style += "background-repeat: no-repeat";
						
						style += "' ";
						
						var selected_text = tinyMCE.activeEditor.selection.getContent();
						if(jQuery(tinyMCE.activeEditor.selection.getNode()).find('.dfd-underline-decoration-advanced').length){
							selected_text = selected_text.replace(/<\/?span[^>]*>/g, "");
						}
						editor.insertContent('<span class="dfd-underline-decoration-advanced" '+style+'>' + selected_text + '</span>');
					}
				});

			},
		}
		);
		editor.addButton('Tooltips', {
			text: 'Tooltips',
			icon: 'tooltip-icon',
			onclick: function(){
				editor.windowManager.open({
					title: 'Insert Tooltip Shortcode',
					width: 400,
					height: 260,
					body: [
						{
							type: 'label',
							name: 'popoverTitle',
							label: 'Tooltip text'
						},
						{
							type: 'textbox',
							name: 'tooltipContent',
							multiline: 'true',
							minHeight: 150
						},
						{
							type: 'listbox',
							name: 'tooltipAlign',
							'values': [
								{text: 'Left', value: 'left'},
								{text: 'Right', value: 'right'},
								{text: 'Bottom', value: 'bottom'},
								{text: 'Top', value: 'top'}
							]
						}
					],
					onsubmit: function(e){
						var selected_text = tinyMCE.activeEditor.selection.getContent();
						var shortcode_text = e.data.tooltipContent.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
						editor.insertContent('[tooltip text="' + shortcode_text + '" align="' + e.data.tooltipAlign + '" ]' + selected_text + '[/tooltip]');
					}
				});
			}
		}
		);
		editor.addButton('Popover', {
			text: 'Popover',
			icon: 'popover-icon',
			onclick: function(){
				editor.windowManager.open({
					title: 'Insert Popover Shortcode',
					body: [
						{
							type: 'textbox',
							name: 'popoverImage',
							label: 'Custom image url',
							id: 'my-image-box'
						},
						{
							type: 'button',
							name: 'selectImage',
							text: 'Select Image',
							onclick: function(){
								window.mb = window.mb || {};

								window.mb.frame = wp.media({
									frame: 'post',
									state: 'insert',
									library: {
										type: 'image'
									},
									multiple: false
								});

								window.mb.frame.on('insert', function(){
									var json = window.mb.frame.state().get('selection').first().toJSON();

									if(0 > jQuery.trim(json.url.length)){
										return;
									}

									jQuery('#my-image-box').val(json.url);
								});

								window.mb.frame.open();
							}
						},
						{
							type: 'textbox',
							name: 'maxwidthcontent',
							label: 'Content width(px)',
							id: 'id-maxwidthcontent'
						},
						{
							type: 'label',
							name: 'popoverTitle',
							label: 'Popover Content'
						},
						{
							type: 'textbox',
							name: 'popoverContent',
							multiline: 'true',
							minHeight: 150
						},
						{
							type: 'listbox',
							name: 'popoverAlign',
							'values': [
								{text: 'Left', value: 'left'},
								{text: 'Right', value: 'right'},
								{text: 'Bottom', value: 'bottom'},
								{text: 'Top', value: 'top'}
							]
						}
					],
					onsubmit: function(e){
						var selected_text = tinyMCE.activeEditor.selection.getContent();
						var shortcode_text = e.data.popoverContent.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&#34;').replace(/'/g, '&apos');

						editor.insertContent('[popover image="' + e.data.popoverImage + '" content="' + shortcode_text + '" position="' + e.data.popoverAlign + '" contentwidth="' + e.data.maxwidthcontent + '"]' + selected_text + '[/popover]');
					}
				});
			}
		}
		);

	});
})(jQuery);
