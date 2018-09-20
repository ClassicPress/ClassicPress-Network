//(function(e,t,n){"use strict";var r=navigator.userAgent.match(/MSIE ([0-9]{1,}[\.0-9]{0,})/),i=!!r,s=i&&parseFloat(r[1])<7,o=navigator.userAgent.match(/iPad|iPhone|Android|IEMobile|BlackBerry/i),u={},a=[],f={left:37,up:38,right:39,down:40,enter:13,tab:9,zero:48,z:90,last:221},l=['<div class="dk_container" id="dk_container_{{ id }}" tabindex="{{ tabindex }}">','<a class="dk_toggle">','<span class="dk_label">{{ label }}</span>',"</a>",'<div class="dk_options">','<ul class="dk_options_inner">',"</ul>","</div>","</div>"].join(""),c='<li class="{{ current }} {{ disabled }}"><a data-dk-dropdown-value="{{ value }}">{{ text }}</a></li>',h={startSpeed:400,theme:!1,changes:!1,syncReverse:!0,nativeMobile:!0},p=null,d=null,v=function(e,t,n){var r,i,s,o;r=e.attr("data-dk-dropdown-value");i=e.text();s=t.data("dropkick");o=s.$select;o.val(r).trigger("change");t.find(".dk_label").text(i);n=n||!1;s.settings.change&&!n&&!s.settings.syncReverse&&s.settings.change.call(o,r,i)},m=function(e){e.removeClass("dk_open");p=null},g=function(n){var r=n.find(".dk_toggle"),i=n.find(".dk_options").outerHeight(),s=e(t).height()-r.outerHeight()-r.offset().top+e(t).scrollTop(),o=r.offset().top-e(t).scrollTop();return i<o?i<s:!0},y=function(e,t,n){var r=e.find(".dk_options_inner"),i=t.prevAll("li").outerHeight()*t.prevAll("li").length,s=r.scrollTop(),o=r.height()+r.scrollTop()-t.outerHeight();(n&&n.type==="keydown"||i<s||i>o)&&r.scrollTop(i)},b=function(e,t){var n=g(e);e.find(".dk_options").css({top:n?e.find(".dk_toggle").outerHeight()-1:"",bottom:n?"":e.find(".dk_toggle").outerHeight()-1});p=e.toggleClass("dk_open");y(e,e.find(".dk_option_current"),t)},w=function(e,t,n){t.find(".dk_option_current").removeClass("dk_option_current");e.addClass("dk_option_current");y(t,e,n)},E=function(t,n){var r=t.keyCode,i=n.data("dropkick"),s=String.fromCharCode(r),o=n.find(".dk_options"),u=n.hasClass("dk_open"),a=o.find("li"),l=n.find(".dk_option_current"),c=a.first(),h=a.last(),p,d,g,y,E,S,x;switch(r){case f.enter:if(u){if(!l.hasClass("disabled")){v(l.find("a"),n);m(n)}}else b(n,t);t.preventDefault();break;case f.tab:if(u){v(l.find("a"),n);m(n)}break;case f.up:d=l.prev("li");u?d.length?w(d,n,t):w(h,n,t):b(n,t);t.preventDefault();break;case f.down:if(u){p=l.next("li").first();p.length?w(p,n,t):w(c,n,t)}else b(n,t);t.preventDefault();break;default:}if(r>=f.zero&&r<=f.z){g=(new Date).getTime();if(i.finder===null){i.finder=s.toUpperCase();i.timer=g}else if(g>parseInt(i.timer,10)+1e3){i.finder=s.toUpperCase();i.timer=g}else{i.finder=i.finder+s.toUpperCase();i.timer=g}y=a.find("a");for(E=0,S=y.length;E<S;E++){x=e(y[E]);if(x.html().toUpperCase().indexOf(i.finder)===0){v(x,n);w(x.parent(),n,t);break}}n.data("dropkick",i)}},S=function(t){return e.trim(t).length>0?t:!1},x=function(t,n){var r=t.replace("{{ id }}",n.id).replace("{{ label }}",n.label).replace("{{ tabindex }}",n.tabindex),i=[],s,o,u,a,f;if(n.options&&n.options.length)for(o=0,u=n.options.length;o<u;o++){a=e(n.options[o]);o===0&&a.attr("selected")!==undefined&&a.attr("disabled")!==undefined?f=null:f=c.replace("{{ value }}",a.val()).replace("{{ current }}",S(a.val())===n.value?"dk_option_current":"").replace("{{ disabled }}",a.attr("disabled")!==undefined?"disabled":"").replace("{{ text }}",e.trim(a.html()));i[i.length]=f}s=e(r);s.find(".dk_options_inner").html(i.join(""));return s};s||(n.documentElement.className=n.documentElement.className+" dk_fouc");u.init=function(t){t=e.extend({},h,t);return this.each(function(){var n=e(this),r=n.find(":selected").first(),i=n.find("option"),s=n.data("dropkick")||{},u=n.attr("id")||n.attr("name"),f=t.width||n.outerWidth(),c=n.attr("tabindex")||"0",h=!1,p,v;if(s.id)return n;s.settings=t;s.tabindex=c;s.id=u;s.$original=r;s.$select=n;s.value=S(n.val())||S(r.attr("value"));s.label=r.text();s.options=i;h=x(l,s);/*h.find(".dk_toggle").css({width:f+"px"});*/n.before(h).appendTo(h);h=e('div[id="dk_container_'+u+'"]').fadeIn(t.startSpeed);p=t.theme||"default";h.addClass("dk_theme_"+p);s.theme=p;s.$dk=h;n.data("dropkick",s);h.addClass(n.attr("class"));h.data("dropkick",s);a[a.length]=n;h.bind("focus.dropkick",function(){d=h.addClass("dk_focus")}).bind("blur.dropkick",function(){h.removeClass("dk_focus");d=null});o&&s.settings.nativeMobile&&h.addClass("dk_mobile");s.settings.syncReverse&&n.on("change",function(t){var r=n.val(),i=e('a[data-dk-dropdown-value="'+r+'"]',h),o=i.text();h.find(".dk_label").text(o);s.settings.change&&s.settings.change.call(n,r,o);w(i.parent(),h,t)});if(n.attr("form")||n.closest("form").length){v=n.attr("form")?e("#"+n.attr("form").replace(" ",", #")):n.closest("form");v.on("reset",function(){n.dropkick("reset")})}})};u.theme=function(t){var n=e(this).data("dropkick"),r=n.$dk,i="dk_theme_"+n.theme;r.removeClass(i).addClass("dk_theme_"+t);n.theme=t};u.reset=function(){return this.each(function(){var t=e(this).data("dropkick"),n=t.$dk,r=e('a[data-dk-dropdown-value="'+t.value+'"]',n);!t.$original.eq(0).prop("selected")&&t.$original.eq(0).prop("selected",!0);n.find(".dk_label").text(t.label);w(r.parent(),n)})};u.setValue=function(t){var n=e(this).data("dropkick").$dk,r=e('.dk_options a[data-dk-dropdown-value="'+t+'"]',n);if(r.length){v(r,n);w(r.parent(),n)}else console.warn("There is no option with this value in the <select>")};u.refresh=function(){return this.each(function(){var t=e(this).data("dropkick"),n=t.$select,r=t.$dk;t.settings.startSpeed=0;n.removeData("dropkick").insertAfter(r);r.remove();n.dropkick(t.settings)})};e.fn.dropkick=function(e){if(!s){if(u[e])return u[e].apply(this,Array.prototype.slice.call(arguments,1));if(typeof e=="object"||!e)return u.init.apply(this,arguments)}};e(function(){e(n).on(i?"mousedown":"click",".dk_options a",function(){var t=e(this),n=t.parents(".dk_container").first();if(!t.parent().hasClass("disabled")){v(t,n);w(t.parent(),n);m(n)}return!1});e(n).bind("keydown.dk_nav",function(e){var t=null;p?t=p:d&&!p&&(t=d);t&&E(e,t)});e(n).on("click",null,function(t){if(p&&e(t.target).closest(".dk_container").length===0)m(p);else if(e(t.target).is(".dk_toggle, .dk_label")){var n=e(t.target).parents(".dk_container").first();if(n.hasClass("dk_open"))m(n);else{p&&m(p);b(n,t)}return!1}});var r="onwheel"in t?"wheel":"onmousewheel"in n?"mousewheel":"MouseScrollEvent"in t?"DOMMouseScroll MozMousePixelScroll":!1;r&&e(n).on(r,".dk_options_inner",function(e){var t=e.originalEvent.wheelDelta||-e.originalEvent.deltaY||-e.originalEvent.detail;if(i){this.scrollTop-=Math.round(t/10);return!1}return t>0&&this.scrollTop<=0||t<0&&this.scrollTop>=this.scrollHeight-this.offsetHeight?!1:!0})})})(jQuery,window,document);
(function($) {
	"use strict";
	$(document).ready(function() {
		if($('body').hasClass('post-type-page') || $('body').hasClass('post-type-post') || $('body').hasClass('post-type-portfolio') || $('body').hasClass('post-type-gallery') || $('body').hasClass('post-type-product')) {
			var dfdBuildDependencies = function() {
				var $metaboxWrap = $('#advanced-sortables .dfd-metaboxes-wrap .postbox');
				$('.cmb_metabox > tbody > tr', $metaboxWrap).each(function() {
					var $self = $(this),
						dataOption = $self.attr('data-dependancy-option'),
						dataValue = $self.attr('data-dependancy-value');
						
					if(dataOption && dataOption != '' && dataValue && dataValue != '') {
						var showHideBoxes = function() {
							var currentValue = $('[name="' + dataOption + '"]').is('input[type="radio"]') ? $('[name="' + dataOption + '"]:checked').val() : $('[name="' + dataOption + '"]').val(),
								availValuesArr = dataValue.split(',');
							
							if($.inArray(currentValue, availValuesArr) != -1) {
								$self.show(500);
							} else {
								$self.find('input[type="text"], select').val('');
								$self.find('input[type="radio"]:checked').removeAttr('checked').trigger('change');
								
//								if($self.find('select').parent().hasClass('dk_container')) {
//									$self.find('select').dropkick('refresh');
//								}
								
								$self.hide(500);
							}
						};
						
						showHideBoxes();
						
						$metaboxWrap.on('change', '[name="' + dataOption+'"]', function() {
							showHideBoxes();
						});
					}
				});
			};
			var portfolioDependacies = function() {
				$('.repeatable-grouping').each(function() {
					var $container = $(this),
						$radioInput = $container.find('input[type="radio"]'),
						$parent = $container.find('.cmb-nested-table > tbody > tr'),
						showHide = function() {
							var curr = $container.find('input[type="radio"]:checked').val();
							$parent.siblings('[data-dependancy-value]:not([data-dependancy-value*="'+curr+'"])').hide(500);
							$parent.siblings('[data-dependancy-value*="'+curr+'"]').show(500);
						};

					showHide();
					
					$radioInput.on('change', function() {
						showHide();
					});
				});
			};
			var portfolioHoverDependacies = function() {
				if($('[class$="_hover_appear_effect"]').find('option:selected').val() == 'dfd-3d-parallax') {
					$('[class$="_hover_main_decoration"]')
						.find('ul > li:last-child')
						.hide(500)
							.find('input[type="radio"]:checked')
							.removeAttr('checked')
							.trigger('change');
				} else {
					$('[class$="_hover_main_decoration"]').find('ul > li:last-child').show(500);
				}
			};

			var $metaBoxes				= $('#normal-sortables')
												.children('.postbox:not(#wpb_visual_composer):not(#woocommerce-product-data):not(#wc-memberships-product-memberships-data):not(#wpseo_meta):not(#the_grid_item_formats)')
												.clone(),
				$advancedContainer		= $('#advanced-sortables');

			$('#normal-sortables').children('.postbox:not(#wpb_visual_composer):not(#woocommerce-product-data):not(#wc-memberships-product-memberships-data):not(#wpseo_meta):not(#the_grid_item_formats)').remove();

			$metaBoxes.prependTo($advancedContainer);

			$advancedContainer
				.wrapInner('<div class="dfd-metaboxes-wrap" />')
				.prepend('<div class="dfd-metaboxes-titles" />');

			$('.dfd-metaboxes-wrap .postbox', $advancedContainer).each(function() {
				var $self = $(this),
					idAttr = $self.attr('id'),
					title = $self.not('.acf-hidden').find('.hndle').clone().attr('class',idAttr);

				if($self.hasClass('closed')) {
					$self.removeClass('closed');
				}

				if($self.hasClass('acf-hidden')) {
					$self.remove();
				}

				$self
					.find('.hndle')
					.remove();

				$self
					.find('.handlediv')
					.remove();

				title.appendTo('.dfd-metaboxes-titles', $advancedContainer);
			});

			$('.dfd-metaboxes-wrap', $advancedContainer).find('.postbox').not(':first').hide();

			dfdBuildDependencies();
			
			portfolioDependacies();
			
			$('body').on('cmb_add_row cmb_shift_row', function() {
				portfolioDependacies();
			});
			
			portfolioHoverDependacies();
			
			$('body').on('change', '[class$="_hover_appear_effect"]', function() {
				portfolioHoverDependacies();
			});

//			$('select', $advancedContainer).dropkick({
//				change: function() {
//					dfdBuildDependencies();
//				}
//			});
			
			$advancedContainer.on('click touchend', '.dfd-metaboxes-titles > *', function() {
				var $self = $(this),
					id = $self.attr('class');

				$self.addClass('active').siblings().removeClass('active');

				$('.dfd-metaboxes-wrap', $advancedContainer).find('#'+id).show().siblings('.postbox').hide();

				dfdBuildDependencies();
			});

			$('.dfd-metaboxes-titles', $advancedContainer).find('> *').first().click();
		}
		$('input[type="checkbox"]').each(function(){
			var $self = $(this),
				$label = $self.siblings('label'),
				$button = $label.find(".button-animation");

			$label.click(function() {
				$button.toggleClass("right-active");
			});
		});
//		$('#side-sortables').each(function() {
//			$(this).find('select:not(#mm)').dropkick();
//		});
	});
})(jQuery);
window.CMB = function(window, document, $) {
    "use strict";
    var l10n = window.cmb_l10,
        setTimeout = window.setTimeout,
        cmb = {
            formfield: "",
            idNumber: !1,
            file_frames: {},
            repeatEls: 'input:not([type="button"]),select,textarea,.cmb_media_status'
        };
    return cmb.metabox = function() {
        return cmb.$metabox ? cmb.$metabox : (cmb.$metabox = $("table.cmb_metabox"), cmb.$metabox)
    }, cmb.init = function() {
        var $metabox = cmb.metabox(),
            $repeatGroup = $metabox.find(".repeatable-group");
        l10n.new_admin_style && $metabox.find(".cmb-spinner img").hide(), cmb.initPickers($metabox.find("input:text.cmb_timepicker"), $metabox.find("input:text.cmb_datepicker"), $metabox.find("input:text.cmb_colorpicker")), $("#ui-datepicker-div").wrap('<div class="cmb_element" />'), $('<p><span class="button cmb-multicheck-toggle">' + l10n.check_toggle + "</span></p>").insertBefore("ul.cmb_checkbox_list"), $metabox.on("change", ".cmb_upload_file", function() {
            cmb.formfield = $(this).attr("id"), $("#" + cmb.formfield + "_id").val("")
        }).on("click", ".cmb-multicheck-toggle", cmb.toggleCheckBoxes).on("click", ".cmb_upload_button", cmb.handleMedia).on("click", ".cmb_remove_file_button", cmb.handleRemoveMedia).on("click", ".add-group-row", cmb.addGroupRow).on("click", ".add-row-button", cmb.addAjaxRow).on("click", ".remove-group-row", cmb.removeGroupRow).on("click", ".remove-row-button", cmb.removeAjaxRow).on("keyup paste focusout", ".cmb_oembed", cmb.maybeOembed).on("cmb_remove_row", ".repeatable-group", cmb.resetTitlesAndIterator), $repeatGroup.length && $repeatGroup.filter(".sortable").each(function() {
            $(this).find(".remove-group-row").before('<a class="shift-rows move-up alignleft" href="#">' + l10n.up_arrow + '</a> <a class="shift-rows move-down alignleft" href="#">' + l10n.down_arrow + "</a>")
        }).on("click", ".shift-rows", cmb.shiftRows).on("cmb_add_row", cmb.emptyValue), setTimeout(cmb.resizeoEmbeds, 500), $(window).on("resize", cmb.resizeoEmbeds)
    }, cmb.resetTitlesAndIterator = function() {
        $(".repeatable-group").each(function() {
            var $table = $(this);
            $table.find(".repeatable-grouping").each(function(rowindex) {
                var $row = $(this);
                $row.data("iterator", rowindex), $row.find(".cmb-group-title h4").text($table.find(".add-group-row").data("grouptitle").replace("{#}", rowindex + 1))
            })
        })
    }, cmb.toggleCheckBoxes = function(event) {
        event.preventDefault();
        var $self = $(this),
            $multicheck = $self.parents("td").find("input[type=checkbox]");
        $self.data("checked") ? ($multicheck.prop("checked", !1), $self.data("checked", !1)) : ($multicheck.prop("checked", !0), $self.data("checked", !0))
    }, cmb.handleMedia = function(event) {
        if (wp) {
            event.preventDefault();
            var $metabox = cmb.metabox(),
                $self = $(this);
            cmb.formfield = $self.prev("input").attr("id");
            var $formfield = $("#" + cmb.formfield),
                formName = $formfield.attr("name"),
                uploadStatus = !0,
                attachment = !0,
                isList = $self.hasClass("cmb_upload_list");
            if (cmb.formfield in cmb.file_frames) return void cmb.file_frames[cmb.formfield].open();
            cmb.file_frames[cmb.formfield] = wp.media.frames.file_frame = wp.media({
                title: $metabox.find("label[for=" + cmb.formfield + "]").text(),
                button: {
                    text: l10n.upload_file
                },
                multiple: isList ? !0 : !1
            });
            var handlers = {
                list: function(selection) {
                    attachment = selection.toJSON(), $formfield.val(attachment.url), $("#" + cmb.formfield + "_id").val(attachment.id);
                    var fileGroup = [];
                    $(attachment).each(function() {
                        uploadStatus = this.type && "image" === this.type ? '<li class="img_status"><img width="50" height="50" src="' + this.url + '" class="attachment-50x50" alt="' + this.filename + '"><p><a href="#" class="cmb_remove_file_button" rel="' + cmb.formfield + "[" + this.id + ']">' + l10n.remove_image + '</a></p><input type="hidden" id="filelist-' + this.id + '" name="' + formName + "[" + this.id + ']" value="' + this.url + '"></li>' : "<li>" + l10n.file + " <strong>" + this.filename + '</strong>&nbsp;&nbsp;&nbsp; (<a href="' + this.url + '" target="_blank" rel="external">' + l10n.download + '</a> / <a href="#" class="cmb_remove_file_button" rel="' + cmb.formfield + "[" + this.id + ']">' + l10n.remove_file + '</a>)<input type="hidden" id="filelist-' + this.id + '" name="' + formName + "[" + this.id + ']" value="' + this.url + '"></li>', fileGroup.push(uploadStatus)
                    }), $(fileGroup).each(function() {
                        $formfield.siblings(".cmb_media_status").slideDown().append(this)
                    })
                },
                single: function(selection) {
                    attachment = selection.first().toJSON(), $formfield.val(attachment.url), $("#" + cmb.formfield + "_id").val(attachment.id), uploadStatus = attachment.type && "image" === attachment.type ? '<div class="img_status"><img style="max-width: 350px; width: 100%; height: auto;" src="' + attachment.url + '" alt="' + attachment.filename + '" title="' + attachment.filename + '" /><p><a href="#" class="cmb_remove_file_button" rel="' + cmb.formfield + '">' + l10n.remove_image + "</a></p></div>" : l10n.file + " <strong>" + attachment.filename + '</strong>&nbsp;&nbsp;&nbsp; (<a href="' + attachment.url + '" target="_blank" rel="external">' + l10n.download + '</a> / <a href="#" class="cmb_remove_file_button" rel="' + cmb.formfield + '">' + l10n.remove_file + "</a>)", $formfield.siblings(".cmb_media_status").slideDown().html(uploadStatus)
                }
            };
            cmb.file_frames[cmb.formfield].on("select", function() {
                var selection = cmb.file_frames[cmb.formfield].state().get("selection"),
                    type = isList ? "list" : "single";
                handlers[type](selection)
            }), cmb.file_frames[cmb.formfield].open()
        }
    }, cmb.handleRemoveMedia = function(event) {
        event.preventDefault();
        var $self = $(this);
        if ($self.is(".attach_list .cmb_remove_file_button")) return $self.parents("li").remove(), !1;
        cmb.formfield = $self.attr("rel");
        var $container = $self.parents(".img_status");
        return cmb.metabox().find("input#" + cmb.formfield).val(""), cmb.metabox().find("input#" + cmb.formfield + "_id").val(""), $container.length ? $container.html("") : $self.parents(".cmb_media_status").html(""), !1
    }, $.fn.replaceText = function(b, a, c) {
        return this.each(function() {
            var g, e, f = this.firstChild,
                d = [];
            if (f)
                do 3 === f.nodeType && (g = f.nodeValue, e = g.replace(b, a), e !== g && (!c && /</.test(e) ? ($(f).before(e), d.push(f)) : f.nodeValue = e)); while (f = f.nextSibling);
            d.length && $(d).remove()
        })
    }, $.fn.cleanRow = function(prevNum, group) {
        var $self = $(this),
            $inputs = $self.find('input:not([type="button"]), select, textarea, label');
        return group && $self.find(".cmb-repeat-table .repeat-row:not(:first-child)").remove(),
			cmb.$focus = !1,
			cmb.neweditor_id = [],
			$inputs.filter(":checked").removeAttr("checked"),
			$inputs.filter(":selected").removeAttr("selected"),
			$self.find(".cmb-group-title") && $self.find(".cmb-group-title h4").text($self.data("title").replace("{#}", cmb.idNumber + 1)),
			$inputs.each(function() {
            var newID, oldID, val, $newInput = $(this),
                isEditor = $newInput.hasClass("wp-editor-area"),
                oldFor = $newInput.attr("for"),
                attrs = {};
            if (oldFor) {
				attrs = {
					"for": oldFor.replace("_" + prevNum, "_" + cmb.idNumber)
				};
			} else {
                var oldName = $newInput.attr("name"),
                    newName = oldName ? oldName.replace("[" + prevNum + "]", "[" + cmb.idNumber + "]") : "";
					oldID = $newInput.attr("id"), newID = oldID ? oldID.replace("_" + prevNum, "_" + cmb.idNumber) : "",
					val = $newInput.is('input[type="radio"]')? $newInput.val() : '',
					attrs = {
						id: newID,
						name: newName,
						"data-iterator": cmb.idNumber,
						value: val
					}
            }
            if ($newInput.removeClass("hasDatepicker").attr(attrs), isEditor) {
                newID = newID ? oldID.replace("zx" + prevNum, "zx" + cmb.idNumber) : "", $newInput.html("");
                var $wysiwyg = $newInput.parents(".cmb-type-wysiwyg");
                $wysiwyg.find(".mce-tinymce:not(:first-child)").remove();
                var html = $wysiwyg.html().replace(new RegExp(oldID, "g"), newID);
                $wysiwyg.html(html), cmb.neweditor_id.push({
                    id: newID,
                    old: oldID
                })
            }
            cmb.$focus = cmb.$focus ? cmb.$focus : $newInput
        }), this
    }, $.fn.newRowHousekeeping = function() {
        var $row = $(this),
            $colorPicker = $row.find(".wp-picker-container"),
            $list = $row.find(".cmb_media_status");
        return $colorPicker.length && $colorPicker.each(function() {
            var $td = $(this).parent();
            $td.html($td.find("input:text.cmb_colorpicker").attr("style", ""))
        }), $list.length && $list.empty(), this
    }, cmb.afterRowInsert = function($row) {
        cmb.$focus && cmb.$focus.focus();
        var _prop;
        if (cmb.neweditor_id.length) {
            var i;
            for (i = cmb.neweditor_id.length - 1; i >= 0; i--) {
                var id = cmb.neweditor_id[i].id,
                    old = cmb.neweditor_id[i].old;
                if ("undefined" == typeof tinyMCEPreInit.mceInit[id]) {
                    var newSettings = jQuery.extend({}, tinyMCEPreInit.mceInit[old]);
                    for (_prop in newSettings) "string" == typeof newSettings[_prop] && (newSettings[_prop] = newSettings[_prop].replace(new RegExp(old, "g"), id));
                    tinyMCEPreInit.mceInit[id] = newSettings
                }
                if ("undefined" == typeof tinyMCEPreInit.qtInit[id]) {
                    var newQTS = jQuery.extend({}, tinyMCEPreInit.qtInit[old]);
                    for (_prop in newQTS) "string" == typeof newQTS[_prop] && (newQTS[_prop] = newQTS[_prop].replace(new RegExp(old, "g"), id));
                    tinyMCEPreInit.qtInit[id] = newQTS
                }
                tinyMCE.init({
                    id: tinyMCEPreInit.mceInit[id]
                })
            }
        }
        cmb.initPickers($row.find("input:text.cmb_timepicker"), $row.find("input:text.cmb_datepicker"), $row.find("input:text.cmb_colorpicker"))
    }, cmb.updateNameAttr = function() {
        var $this = $(this),
            name = $this.attr("name");
        if ("undefined" == typeof name) return !1;
        var prevNum = parseInt($this.parents(".repeatable-grouping").data("iterator")),
            newNum = prevNum - 1,
            $newName = name.replace("[" + prevNum + "]", "[" + newNum + "]");
        $this.attr("name", $newName)
    }, cmb.emptyValue = function(event, row) {
        $('input:not([type="button"]):not([type="radio"]):not([type="checkbox"]), textarea', row).val("");
        $('input[type="radio"], input[type="checkbox"]', row).removeAttr("checked");
    }, cmb.addGroupRow = function(event) {
        event.preventDefault();
        var $self = $(this),
            $table = $("#" + $self.data("selector")),
            $oldRow = $table.find(".repeatable-grouping").last(),
            prevNum = parseInt($oldRow.data("iterator"));
        cmb.idNumber = prevNum + 1;
        var $row = $oldRow.clone();
        $row.data("title", $self.data("grouptitle")).newRowHousekeeping().cleanRow(prevNum, !0);
        var $newRow = $('<tr class="repeatable-grouping" data-iterator="' + cmb.idNumber + '">' + $row.html() + "</tr>");
        $oldRow.after($newRow), cmb.afterRowInsert($newRow), $table.find(".repeatable-grouping").length <= 1 ? $table.find(".remove-group-row").prop("disabled", !0) : $table.find(".remove-group-row").removeAttr("disabled"), $table.trigger("cmb_add_row", $newRow);
		$('body').trigger('cmb_add_row');
    }, cmb.addAjaxRow = function(event) {
        event.preventDefault();
        var $self = $(this),
            tableselector = "#" + $self.data("selector"),
            $table = $(tableselector),
            $emptyrow = $table.find(".empty-row"),
            prevNum = parseInt($emptyrow.find("[data-iterator]").data("iterator"));
        cmb.idNumber = prevNum + 1;
        var $row = $emptyrow.clone();
        $row.newRowHousekeeping().cleanRow(prevNum), $emptyrow.removeClass("empty-row").addClass("repeat-row"), $emptyrow.after($row), cmb.afterRowInsert($row), $table.trigger("cmb_add_row", $row);
		$('body').trigger('cmb_add_row');
    }, cmb.removeGroupRow = function(event) {
        event.preventDefault();
        var $self = $(this),
            $table = $("#" + $self.data("selector")),
            $parent = $self.parents(".repeatable-grouping"),
            noRows = $table.find(".repeatable-grouping").length;
        $parent.nextAll(".repeatable-grouping").find(cmb.repeatEls).each(cmb.updateNameAttr), noRows > 1 && ($parent.remove(), 3 > noRows ? $table.find(".remove-group-row").prop("disabled", !0) : $table.find(".remove-group-row").prop("disabled", !1), $table.trigger("cmb_remove_row"))
    }, cmb.removeAjaxRow = function(event) {
        event.preventDefault();
        var $self = $(this),
            $parent = $self.parents("tr"),
            $table = $self.parents(".cmb-repeat-table");
        $table.find("tr").length > 1 && ($parent.hasClass("empty-row") && $parent.prev().addClass("empty-row").removeClass("repeat-row"), $self.parents(".cmb-repeat-table tr").remove(), $table.trigger("cmb_remove_row"))
    }, cmb.shiftRows = function(event) {
        event.preventDefault();
        var $self = $(this),
            $parent = $self.parents(".repeatable-grouping"),
            $goto = $self.hasClass("move-up") ? $parent.prev(".repeatable-grouping") : $parent.next(".repeatable-grouping");
        if ($goto.length) {
            var inputVals = [];
            $parent.find(cmb.repeatEls).each(function() {
                var val, $element = $(this);
                $element.hasClass("cmb_media_status") ? val = $element.html() : "checkbox" === $element.attr("type") ? (val = $element.is(":checked"), cmb.log("checked", val)) : "select" === $element.prop("tagName") ? (val = $element.is(":selected"), cmb.log("checked", val)) : val = $element.val(), inputVals.push({
                    val: val,
                    $: $element
                })
            }), $goto.find(cmb.repeatEls).each(function(index) {
                var val, $element = $(this);
                $element.hasClass("cmb_media_status") ? (val = $element.html(), $element.html(inputVals[index].val), inputVals[index].$.html(val)) : "checkbox" === $element.attr("type") ? (inputVals[index].$.prop("checked", $element.is(":checked")), $element.prop("checked", inputVals[index].val)) : "select" === $element.prop("tagName") ? (inputVals[index].$.prop("selected", $element.is(":selected")), $element.prop("selected", inputVals[index].val)) : (inputVals[index].$.val($element.val()), $element.val(inputVals[index].val))
            });
			$('body').trigger("cmb_shift_row");
        }
    }, cmb.initPickers = function($timePickers, $datePickers, $colorPickers) {
        cmb.initTimePickers($timePickers), cmb.initDatePickers($datePickers), cmb.initColorPickers($colorPickers)
    }, cmb.initTimePickers = function($selector) {
        $selector.length && $selector.timePicker({
            startTime: "00:00",
            endTime: "23:59",
            show24Hours: !1,
            separator: ":",
            step: 30
        })
    }, cmb.initDatePickers = function($selector) {
        $selector.length && ($selector.datepicker("destroy"), $selector.datepicker())
    }, cmb.initColorPickers = function($selector) {
        $selector.length && ("object" == typeof jQuery.wp && "function" == typeof jQuery.wp.wpColorPicker ? $selector.wpColorPicker() : $selector.each(function(i) {
            $(this).after('<div id="picker-' + i + '" style="z-index: 1000; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>'), $("#picker-" + i).hide().farbtastic($(this))
        }).focus(function() {
            $(this).next().show()
        }).blur(function() {
            $(this).next().hide()
        }))
    }, cmb.maybeOembed = function(evt) {
        var $self = $(this),
            type = evt.type,
            m = {
                focusout: function() {
                    setTimeout(function() {
                        cmb.spinner(".postbox table.cmb_metabox", !0)
                    }, 2e3)
                },
                keyup: function() {
                    var betw = function(min, max) {
                        return evt.which <= max && evt.which >= min
                    };
                    (betw(48, 90) || betw(96, 111) || betw(8, 9) || 187 === evt.which || 190 === evt.which) && cmb.doAjax($self, evt)
                },
                paste: function() {
                    setTimeout(function() {
                        cmb.doAjax($self)
                    }, 100)
                }
            };
        m[type]()
    }, cmb.resizeoEmbeds = function() {
        cmb.metabox().each(function() {
            var $self = $(this),
                $tableWrap = $self.parents(".inside");
            if (!$tableWrap.length) return !0;
            var newWidth = Math.round(.82 * $tableWrap.width() * .97) - 30;
            if (newWidth > 639) return !0;
            var $embeds = $self.find(".cmb-type-oembed .embed_status"),
                $children = $embeds.children().not(".cmb_remove_wrapper");
            return $children.length ? void $children.each(function() {
                var $self = $(this),
                    iwidth = $self.width(),
                    iheight = $self.height(),
                    _newWidth = newWidth;
                $self.parents(".repeat-row").length && (_newWidth = newWidth - 91);
                var newHeight = Math.round(_newWidth * iheight / iwidth);
                $self.width(_newWidth).height(newHeight)
            }) : !0
        })
    }, cmb.log = function() {
        l10n.script_debug && console && "function" == typeof console.log && console.log.apply(console, arguments)
    }, cmb.spinner = function($context, hide) {
        hide ? $(".cmb-spinner", $context).hide() : $(".cmb-spinner", $context).show()
    }, cmb.doAjax = function($obj) {
        var oembed_url = $obj.val();
        if (!(oembed_url.length < 6)) {
            var field_id = $obj.attr("id"),
                $context = $obj.parents(".cmb-repeat-table  tr td");
            $context = $context.length ? $context : $obj.parents(".cmb_metabox tr td");
            var embed_container = $(".embed_status", $context),
                oembed_width = $obj.width(),
                child_el = $(":first-child", embed_container);
            cmb.log("oembed_url", oembed_url, field_id), oembed_width = embed_container.length && child_el.length ? child_el.width() : $obj.width(), cmb.spinner($context), $(".embed_wrap", $context).html(""), setTimeout(function() {
                $(".cmb_oembed:focus").val() === oembed_url && $.ajax({
                    type: "post",
                    dataType: "json",
                    url: l10n.ajaxurl,
                    data: {
                        action: "cmb_oembed_handler",
                        oembed_url: oembed_url,
                        oembed_width: oembed_width > 300 ? oembed_width : 300,
                        field_id: field_id,
                        object_id: $obj.data("objectid"),
                        object_type: $obj.data("objecttype"),
                        cmb_ajax_nonce: l10n.ajax_nonce
                    },
                    success: function(response) {
                        cmb.log(response), "undefined" != typeof response.id && (cmb.spinner($context, !0), $(".embed_wrap", $context).html(response.result))
                    }
                })
            }, 500)
        }
    }, $(document).ready(cmb.init), cmb
}(window, document, jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var headerStyle = $('#dfd_headers_header_style'),
			logoPosition = $('#dfd_headers_logo_position'),
			menuPosition = $('#dfd_headers_menu_position'),
			sideArea = $('.cmb_id_dfd_headers_show_side_area'),
			topInnerPage = $('.cmb_id_dfd_headers_show_top_inner_page'),
			headerCheck = function() {
			
			if(+headerStyle.val() < 7) {
				sideArea.show();
				topInnerPage.show();
			} else {
				sideArea.hide();
				topInnerPage.hide();
			}
			
			if(headerStyle.val() == '0' || headerStyle.val() == '1' || headerStyle.val() == '2') {
				logoPosition.parents('tr').show();
				menuPosition.parents('tr').show();
			} else {
				logoPosition.parents('tr').hide();
				menuPosition.parents('tr').hide();
			}
		};
		headerCheck();
		headerStyle.on('change',headerCheck);
//		if($('#editor-expand-toggle').is(':checked')) {
//			$('#editor-expand-toggle').click();
//		}
		
	});
})(jQuery);