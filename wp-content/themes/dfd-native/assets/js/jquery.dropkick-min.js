/*
 * DropKick 1.3.3
 *
 * Highly customizable <select> lists
 * https://github.com/robdel12/DropKick
 *
 * Created by: Jamie Lottering <http://github.com/JamieLottering> <http://twitter.com/JamieLottering>
 *
 *
 */
/*
 * 
 New version added
 this is a backup, just for any case ;)
 * 
 (function(e,t,n){"use strict";var r=navigator.userAgent.match(/MSIE ([0-9]{1,}[\.0-9]{0,})/),i=!!r,s=i&&parseFloat(r[1])<7,o=navigator.userAgent.match(/iPad|iPhone|Android|IEMobile|BlackBerry/i),u={},a=[],f={left:37,up:38,right:39,down:40,enter:13,tab:9,zero:48,z:90,last:221},l=['<div class="dk_container" id="dk_container_{{ id }}" tabindex="{{ tabindex }}">','<a class="dk_toggle">','<span class="dk_label">{{ label }}</span>',"</a>",'<div class="dk_options">','<ul class="dk_options_inner">',"</ul>","</div>","</div>"].join(""),c='<li class="{{ current }} {{ disabled }}"><a data-dk-dropdown-value="{{ value }}">{{ text }}</a></li>',h={startSpeed:400,theme:!1,changes:!1,syncReverse:!0,nativeMobile:!0},p=null,d=null,v=function(e,t,n){var r,i,s,o;r=e.attr("data-dk-dropdown-value");i=e.text();s=t.data("dropkick");o=s.$select;o.val(r).trigger("change");t.find(".dk_label").text(i);n=n||!1;s.settings.change&&!n&&!s.settings.syncReverse&&s.settings.change.call(o,r,i)},m=function(e){e.removeClass("dk_open");p=null},g=function(n){var r=n.find(".dk_toggle"),i=n.find(".dk_options").outerHeight(),s=e(t).height()-r.outerHeight()-r.offset().top+e(t).scrollTop(),o=r.offset().top-e(t).scrollTop();return i<o?i<s:!0},y=function(e,t,n){var r=e.find(".dk_options_inner"),i=t.prevAll("li").outerHeight()*t.prevAll("li").length,s=r.scrollTop(),o=r.height()+r.scrollTop()-t.outerHeight();(n&&n.type==="keydown"||i<s||i>o)&&r.scrollTop(i)},b=function(e,t){var n=g(e);e.find(".dk_options").css({top:n?e.find(".dk_toggle").outerHeight()-1:"",bottom:n?"":e.find(".dk_toggle").outerHeight()-1});p=e.toggleClass("dk_open");y(e,e.find(".dk_option_current"),t)},w=function(e,t,n){t.find(".dk_option_current").removeClass("dk_option_current");e.addClass("dk_option_current");y(t,e,n)},E=function(t,n){var r=t.keyCode,i=n.data("dropkick"),s=String.fromCharCode(r),o=n.find(".dk_options"),u=n.hasClass("dk_open"),a=o.find("li"),l=n.find(".dk_option_current"),c=a.first(),h=a.last(),p,d,g,y,E,S,x;switch(r){case f.enter:if(u){if(!l.hasClass("disabled")){v(l.find("a"),n);m(n)}}else b(n,t);t.preventDefault();break;case f.tab:if(u){v(l.find("a"),n);m(n)}break;case f.up:d=l.prev("li");u?d.length?w(d,n,t):w(h,n,t):b(n,t);t.preventDefault();break;case f.down:if(u){p=l.next("li").first();p.length?w(p,n,t):w(c,n,t)}else b(n,t);t.preventDefault();break;default:}if(r>=f.zero&&r<=f.z){g=(new Date).getTime();if(i.finder===null){i.finder=s.toUpperCase();i.timer=g}else if(g>parseInt(i.timer,10)+1e3){i.finder=s.toUpperCase();i.timer=g}else{i.finder=i.finder+s.toUpperCase();i.timer=g}y=a.find("a");for(E=0,S=y.length;E<S;E++){x=e(y[E]);if(x.html().toUpperCase().indexOf(i.finder)===0){v(x,n);w(x.parent(),n,t);break}}n.data("dropkick",i)}},S=function(t){return e.trim(t).length>0?t:!1},x=function(t,n){var r=t.replace("{{ id }}",n.id).replace("{{ label }}",n.label).replace("{{ tabindex }}",n.tabindex),i=[],s,o,u,a,f;if(n.options&&n.options.length)for(o=0,u=n.options.length;o<u;o++){a=e(n.options[o]);o===0&&a.attr("selected")!==undefined&&a.attr("disabled")!==undefined?f=null:f=c.replace("{{ value }}",a.val()).replace("{{ current }}",S(a.val())===n.value?"dk_option_current":"").replace("{{ disabled }}",a.attr("disabled")!==undefined?"disabled":"").replace("{{ text }}",e.trim(a.html()));i[i.length]=f}s=e(r);s.find(".dk_options_inner").html(i.join(""));return s};s||(n.documentElement.className=n.documentElement.className+" dk_fouc");u.init=function(t){t=e.extend({},h,t);return this.each(function(){var n=e(this),r=n.find(":selected").first(),i=n.find("option"),s=n.data("dropkick")||{},u=n.attr("id")||n.attr("name"),f=t.width||n.outerWidth(),c=n.attr("tabindex")||"0",h=!1,p,v;if(s.id)return n;s.settings=t;s.tabindex=c;s.id=u;s.$original=r;s.$select=n;s.value=S(n.val())||S(r.attr("value"));s.label=r.text();s.options=i;h=x(l,s);h.find(".dk_toggle").css({width:f+"px"});n.before(h).appendTo(h);h=e('div[id="dk_container_'+u+'"]').fadeIn(t.startSpeed);p=t.theme||"default";h.addClass("dk_theme_"+p);s.theme=p;s.$dk=h;n.data("dropkick",s);h.addClass(n.attr("class"));h.data("dropkick",s);a[a.length]=n;h.bind("focus.dropkick",function(){d=h.addClass("dk_focus")}).bind("blur.dropkick",function(){h.removeClass("dk_focus");d=null});o&&s.settings.nativeMobile&&h.addClass("dk_mobile");s.settings.syncReverse&&n.on("change",function(t){var r=n.val(),i=e('a[data-dk-dropdown-value="'+r+'"]',h),o=i.text();h.find(".dk_label").text(o);s.settings.change&&s.settings.change.call(n,r,o);w(i.parent(),h,t)});if(n.attr("form")||n.closest("form").length){v=n.attr("form")?e("#"+n.attr("form").replace(" ",", #")):n.closest("form");v.on("reset",function(){n.dropkick("reset")})}})};u.theme=function(t){var n=e(this).data("dropkick"),r=n.$dk,i="dk_theme_"+n.theme;r.removeClass(i).addClass("dk_theme_"+t);n.theme=t};u.reset=function(){return this.each(function(){var t=e(this).data("dropkick"),n=t.$dk,r=e('a[data-dk-dropdown-value="'+t.value+'"]',n);!t.$original.eq(0).prop("selected")&&t.$original.eq(0).prop("selected",!0);n.find(".dk_label").text(t.label);w(r.parent(),n)})};u.setValue=function(t){var n=e(this).data("dropkick").$dk,r=e('.dk_options a[data-dk-dropdown-value="'+t+'"]',n);if(r.length){v(r,n);w(r.parent(),n)}else console.warn("There is no option with this value in the <select>")};u.refresh=function(){return this.each(function(){var t=e(this).data("dropkick"),n=t.$select,r=t.$dk;t.settings.startSpeed=0;n.removeData("dropkick").insertAfter(r);r.remove();n.dropkick(t.settings)})};e.fn.dropkick=function(e){if(!s){if(u[e])return u[e].apply(this,Array.prototype.slice.call(arguments,1));if(typeof e=="object"||!e)return u.init.apply(this,arguments)}};e(function(){e(n).on(i?"mousedown":"click",".dk_options a",function(){var t=e(this),n=t.parents(".dk_container").first();if(!t.parent().hasClass("disabled")){v(t,n);w(t.parent(),n);m(n)}return!1});e(n).bind("keydown.dk_nav",function(e){var t=null;p?t=p:d&&!p&&(t=d);t&&E(e,t)});e(n).on("click",null,function(t){if(p&&e(t.target).closest(".dk_container").length===0)m(p);else if(e(t.target).is(".dk_toggle, .dk_label")){var n=e(t.target).parents(".dk_container").first();if(n.hasClass("dk_open"))m(n);else{p&&m(p);b(n,t)}return!1}});var r="onwheel"in t?"wheel":"onmousewheel"in n?"mousewheel":"MouseScrollEvent"in t?"DOMMouseScroll MozMousePixelScroll":!1;r&&e(n).on(r,".dk_options_inner",function(e){var t=e.originalEvent.wheelDelta||-e.originalEvent.deltaY||-e.originalEvent.detail;if(i){this.scrollTop-=Math.round(t/10);return!1}return t>0&&this.scrollTop<=0||t<0&&this.scrollTop>=this.scrollHeight-this.offsetHeight?!1:!0})})})(jQuery,window,document);
 
 And one more ;)
 !function(e){var t;if("object"==typeof exports){try{t=require("jquery")}catch(s){}module.exports=e(window,document,t)}else window.Dropkick=e(window,document,window.jQuery)}(function(e,t,s,i){var a,n=/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),l=e.parent!==e.self&&location.host===parent.location.host,o=-1!==navigator.appVersion.indexOf("MSIE"),d=function(s,i){var a,n;if(this===e)return new d(s,i);for("string"==typeof s&&"#"===s[0]&&(s=t.getElementById(s.substr(1))),a=0;a<d.uid;a++)if(n=d.cache[a],n instanceof d&&n.data.select===s)return c.extend(n.data.settings,i),n;return s?"SELECT"===s.nodeName?this.init(s,i):void 0:(console.error("You must pass a select to DropKick"),!1)},r=function(){},h={initialize:r,change:r,open:r,close:r,search:"strict",bubble:!0},c={hasClass:function(e,t){var s=new RegExp("(^|\\s+)"+t+"(\\s+|$)");return e&&s.test(e.className)},addClass:function(e,t){e&&!c.hasClass(e,t)&&(e.className+=" "+t)},removeClass:function(e,t){var s=new RegExp("(^|\\s+)"+t+"(\\s+|$)");e&&(e.className=e.className.replace(s," "))},toggleClass:function(e,t){var s=c.hasClass(e,t)?"remove":"add";c[s+"Class"](e,t)},extend:function(e){return Array.prototype.slice.call(arguments,1).forEach(function(t){if(t)for(var s in t)e[s]=t[s]}),e},offset:function(s){var i=s.getBoundingClientRect()||{top:0,left:0},a=t.documentElement,n=o?a.scrollTop:e.pageYOffset,l=o?a.scrollLeft:e.pageXOffset;return{top:i.top+n-a.clientTop,left:i.left+l-a.clientLeft}},position:function(e,t){for(var s={top:0,left:0};e&&e!==t;)s.top+=e.offsetTop,s.left+=e.offsetLeft,e=e.parentNode;return s},closest:function(e,t){for(;e;){if(e===t)return e;e=e.parentNode}return!1},create:function(e,s){var i,a=t.createElement(e);s||(s={});for(i in s)s.hasOwnProperty(i)&&("innerHTML"===i?a.innerHTML=s[i]:a.setAttribute(i,s[i]));return a},deferred:function(t){return function(){var s=arguments,i=this;e.setTimeout(function(){t.apply(i,s)},1)}}};return d.cache={},d.uid=0,d.prototype={add:function(e,s){var i,a,n;"string"==typeof e&&(i=e,e=t.createElement("option"),e.text=i),"OPTION"===e.nodeName&&(a=c.create("li",{"class":"dk-option","data-value":e.value,innerHTML:e.text,role:"option","aria-selected":"false",id:"dk"+this.data.cacheID+"-"+(e.id||e.value.replace(" ","-"))}),c.addClass(a,e.className),this.length+=1,e.disabled&&(c.addClass(a,"dk-option-disabled"),a.setAttribute("aria-disabled","true")),this.data.select.add(e,s),"number"==typeof s&&(s=this.item(s)),this.options.indexOf(s)>-1?s.parentNode.insertBefore(a,s):this.data.elem.lastChild.appendChild(a),a.addEventListener("mouseover",this),n=this.options.indexOf(s),this.options.splice(n,0,a),e.selected&&this.select(n))},item:function(e){return e=0>e?this.options.length+e:e,this.options[e]||null},remove:function(e){var t=this.item(e);t.parentNode.removeChild(t),this.options.splice(e,1),this.data.select.remove(e),this.select(this.data.select.selectedIndex),this.length-=1},init:function(e,s){var i,o=d.build(e,"dk"+d.uid);if(this.data={},this.data.select=e,this.data.elem=o.elem,this.data.settings=c.extend({},h,s),this.disabled=e.disabled,this.form=e.form,this.length=e.length,this.multiple=e.multiple,this.options=o.options.slice(0),this.selectedIndex=e.selectedIndex,this.selectedOptions=o.selected.slice(0),this.value=e.value,this.data.cacheID=d.uid,d.cache[this.data.cacheID]=this,this.data.settings.initialize.call(this),d.uid+=1,this._changeListener||(e.addEventListener("change",this),this._changeListener=!0),!n||this.data.settings.mobile){if(e.parentNode.insertBefore(this.data.elem,e),e.setAttribute("data-dkCacheId",this.data.cacheID),this.data.elem.addEventListener("click",this),this.data.elem.addEventListener("keydown",this),this.data.elem.addEventListener("keypress",this),this.form&&this.form.addEventListener("reset",this),!this.multiple)for(i=0;i<this.options.length;i++)this.options[i].addEventListener("mouseover",this);a||(t.addEventListener("click",d.onDocClick),l&&parent.document.addEventListener("click",d.onDocClick),a=!0)}return this},close:function(){var e,t=this.data.elem;if(!this.isOpen||this.multiple)return!1;for(e=0;e<this.options.length;e++)c.removeClass(this.options[e],"dk-option-highlight");t.lastChild.setAttribute("aria-expanded","false"),c.removeClass(t.lastChild,"dk-select-options-highlight"),c.removeClass(t,"dk-select-open-(up|down)"),this.isOpen=!1,this.data.settings.close.call(this)},open:c.deferred(function(){var s,i,a,n,l,d,r=this.data.elem,h=r.lastChild;return l=o?c.offset(r).top-t.documentElement.scrollTop:c.offset(r).top-e.scrollY,d=e.innerHeight-(l+r.offsetHeight),this.isOpen||this.multiple?!1:(h.style.display="block",s=h.offsetHeight,h.style.display="",i=l>s,a=d>s,n=i&&!a?"-up":"-down",this.isOpen=!0,c.addClass(r,"dk-select-open"+n),h.setAttribute("aria-expanded","true"),this._scrollTo(this.options.length-1),this._scrollTo(this.selectedIndex),void this.data.settings.open.call(this))}),disable:function(e,t){var s="dk-option-disabled";(0===arguments.length||"boolean"==typeof e)&&(t=e===i?!0:!1,e=this.data.elem,s="dk-select-disabled",this.disabled=t),t===i&&(t=!0),"number"==typeof e&&(e=this.item(e)),c[t?"addClass":"removeClass"](e,s)},select:function(e,t){var s,i,a,n,l=this.data.select;if("number"==typeof e&&(e=this.item(e)),"string"==typeof e)for(s=0;s<this.length;s++)this.options[s].getAttribute("data-value")===e&&(e=this.options[s]);return!e||"string"==typeof e||!t&&c.hasClass(e,"dk-option-disabled")?!1:c.hasClass(e,"dk-option")?(i=this.options.indexOf(e),a=l.options[i],this.multiple?(c.toggleClass(e,"dk-option-selected"),a.selected=!a.selected,c.hasClass(e,"dk-option-selected")?(e.setAttribute("aria-selected","true"),this.selectedOptions.push(e)):(e.setAttribute("aria-selected","false"),i=this.selectedOptions.indexOf(e),this.selectedOptions.splice(i,1))):(n=this.data.elem.firstChild,this.selectedOptions.length&&(c.removeClass(this.selectedOptions[0],"dk-option-selected"),this.selectedOptions[0].setAttribute("aria-selected","false")),c.addClass(e,"dk-option-selected"),e.setAttribute("aria-selected","true"),n.setAttribute("aria-activedescendant",e.id),n.className="dk-selected "+a.className,n.innerHTML=a.text,this.selectedOptions[0]=e,a.selected=!0),this.selectedIndex=l.selectedIndex,this.value=l.value,t||this.data.select.dispatchEvent(new CustomEvent("change",{bubbles:this.data.settings.bubble})),e):void 0},selectOne:function(e,t){return this.reset(!0),this._scrollTo(e),this.select(e,t)},search:function(e,t){var s,i,a,n,l,o,d,r,h=this.data.select.options,c=[];if(!e)return this.options;for(t=t?t.toLowerCase():"strict",t="fuzzy"===t?2:"partial"===t?1:0,r=new RegExp((t?"":"^")+e,"i"),s=0;s<h.length;s++)if(a=h[s].text.toLowerCase(),2==t){for(i=e.toLowerCase().split(""),n=l=o=d=0;l<a.length;)a[l]===i[n]?(o+=1+o,n++):o=0,d+=o,l++;n===i.length&&c.push({e:this.options[s],s:d,i:s})}else r.test(a)&&c.push(this.options[s]);return 2===t&&(c=c.sort(function(e,t){return t.s-e.s||e.i-t.i}).reduce(function(e,t){return e[e.length]=t.e,e},[])),c},focus:function(){this.disabled||(this.multiple?this.data.elem:this.data.elem.children[0]).focus()},reset:function(e){var t,s=this.data.select;for(this.selectedOptions.length=0,t=0;t<s.options.length;t++)s.options[t].selected=!1,c.removeClass(this.options[t],"dk-option-selected"),this.options[t].setAttribute("aria-selected","false"),!e&&s.options[t].defaultSelected&&this.select(t,!0);this.selectedOptions.length||this.multiple||this.select(0,!0)},refresh:function(){this.dispose().init(this.data.select,this.data.settings)},dispose:function(){return delete d.cache[this.data.cacheID],(!n||this.data.settings.mobile)&&(this.data.elem.parentNode.removeChild(this.data.elem),this.data.select.removeAttribute("data-dkCacheId")),this},handleEvent:function(e){if(!this.disabled)switch(e.type){case"click":this._delegate(e);break;case"keydown":this._keyHandler(e);break;case"keypress":this._searchOptions(e);break;case"mouseover":this._highlight(e);break;case"reset":this.reset();break;case"change":this.data.settings.change.call(this)}},_delegate:function(t){var s,i,a,n,l=t.target;if(c.hasClass(l,"dk-option-disabled"))return!1;if(this.multiple){if(c.hasClass(l,"dk-option"))if(s=e.getSelection(),"Range"===s.type&&s.collapseToStart(),t.shiftKey)if(a=this.options.indexOf(this.selectedOptions[0]),n=this.options.indexOf(this.selectedOptions[this.selectedOptions.length-1]),i=this.options.indexOf(l),i>a&&n>i&&(i=a),i>n&&n>a&&(n=a),this.reset(!0),n>i)for(;n+1>i;)this.select(i++);else for(;i>n-1;)this.select(i--);else t.ctrlKey||t.metaKey?this.select(l):(this.reset(!0),this.select(l))}else this[this.isOpen?"close":"open"](),c.hasClass(l,"dk-option")&&this.select(l)},_highlight:function(e){var t,s=e.target;if(!this.multiple){for(t=0;t<this.options.length;t++)c.removeClass(this.options[t],"dk-option-highlight");c.addClass(this.data.elem.lastChild,"dk-select-options-highlight"),c.addClass(s,"dk-option-highlight")}},_keyHandler:function(e){var t,s,i=this.selectedOptions,a=this.options,n=1,l={tab:9,enter:13,esc:27,space:32,up:38,down:40};switch(e.keyCode){case l.up:n=-1;case l.down:if(e.preventDefault(),t=i[i.length-1],c.hasClass(this.data.elem.lastChild,"dk-select-options-highlight"))for(c.removeClass(this.data.elem.lastChild,"dk-select-options-highlight"),s=0;s<a.length;s++)c.hasClass(a[s],"dk-option-highlight")&&(c.removeClass(a[s],"dk-option-highlight"),t=a[s]);n=a.indexOf(t)+n,n>a.length-1?n=a.length-1:0>n&&(n=0),this.data.select.options[n].disabled||(this.reset(!0),this.select(n),this._scrollTo(n));break;case l.space:if(!this.isOpen){e.preventDefault(),this.open();break}case l.tab:case l.enter:for(n=0;n<a.length;n++)c.hasClass(a[n],"dk-option-highlight")&&this.select(n);case l.esc:this.isOpen&&(e.preventDefault(),this.close())}},_searchOptions:function(e){var t,s=this,a=String.fromCharCode(e.keyCode||e.which),n=function(){s.data.searchTimeout&&clearTimeout(s.data.searchTimeout),s.data.searchTimeout=setTimeout(function(){s.data.searchString=""},1e3)};this.data.searchString===i&&(this.data.searchString=""),n(),this.data.searchString+=a,t=this.search(this.data.searchString,this.data.settings.search),t.length&&(c.hasClass(t[0],"dk-option-disabled")||this.selectOne(t[0]))},_scrollTo:function(e){var t,s,i,a=this.data.elem.lastChild;return-1===e||"number"!=typeof e&&!e||!this.isOpen&&!this.multiple?!1:("number"==typeof e&&(e=this.item(e)),t=c.position(e,a).top,s=t-a.scrollTop,i=s+e.offsetHeight,void(i>a.offsetHeight?(t+=e.offsetHeight,a.scrollTop=t-a.offsetHeight):0>s&&(a.scrollTop=t)))}},d.build=function(e,t){var s,i,a,n=[],l={elem:null,options:[],selected:[]},o=function(e){var s,i,a,n,d=[];switch(e.nodeName){case"OPTION":s=c.create("li",{"class":"dk-option ","data-value":e.value,innerHTML:e.text,role:"option","aria-selected":"false",id:t+"-"+(e.id||e.value.replace(" ","-"))}),c.addClass(s,e.className),e.disabled&&(c.addClass(s,"dk-option-disabled"),s.setAttribute("aria-disabled","true")),e.selected&&(c.addClass(s,"dk-option-selected"),s.setAttribute("aria-selected","true"),l.selected.push(s)),l.options.push(this.appendChild(s));break;case"OPTGROUP":for(i=c.create("li",{"class":"dk-optgroup"}),e.label&&i.appendChild(c.create("div",{"class":"dk-optgroup-label",innerHTML:e.label})),a=c.create("ul",{"class":"dk-optgroup-options"}),n=e.children.length;n--;d.unshift(e.children[n]));d.forEach(o,a),this.appendChild(i).appendChild(a)}};for(l.elem=c.create("div",{"class":"dk-select"+(e.multiple?"-multi":"")}),i=c.create("ul",{"class":"dk-select-options",id:t+"-listbox",role:"listbox"}),e.disabled&&c.addClass(l.elem,"dk-select-disabled"),l.elem.id=t+(e.id?"-"+e.id:""),c.addClass(l.elem,e.className),e.multiple?(l.elem.setAttribute("tabindex",e.getAttribute("tabindex")||"0"),i.setAttribute("aria-multiselectable","true")):(s=e.options[e.selectedIndex],l.elem.appendChild(c.create("div",{"class":"dk-selected "+s.className,tabindex:e.tabindex||0,innerHTML:s?s.text:"&nbsp;",id:t+"-combobox","aria-live":"assertive","aria-owns":i.id,role:"combobox"})),i.setAttribute("aria-expanded","false")),a=e.children.length;a--;n.unshift(e.children[a]));return n.forEach(o,l.elem.appendChild(i)),l},d.onDocClick=function(e){var t,s;if(1!==e.target.nodeType)return!1;null!==(t=e.target.getAttribute("data-dkcacheid"))&&d.cache[t].focus();for(s in d.cache)c.closest(e.target,d.cache[s].data.elem)||s===t||d.cache[s].disabled||d.cache[s].close()},s!==i&&(s.fn.dropkick=function(){var e=Array.prototype.slice.call(arguments);return s(this).each(function(){e[0]&&"object"!=typeof e[0]?"string"==typeof e[0]&&d.prototype[e[0]].apply(new d(this),e.slice(1)):new d(this,e[0]||{})})}),d});
 *
 *  */

/*
 * DropKick
 *
 * Highly customizable <select> lists
 * https://github.com/robdel12/DropKick
 *
 */
(function (factory) {
	var jQuery;

	if (typeof exports === "object") {
		// Node. Does not work with strict CommonJS, but
		// only CommonJS-like environments that support module.exports,
		// like Node.
		try {
			jQuery = require("jquery");
		} catch (e) {
		}

		module.exports = factory(window, document, jQuery);
	} else if (typeof define === 'function' && define.amd) {
		define([], function () {
			return factory(window, document, window.jQuery)
		});
	} else {
		// Browser globals (root is window)
		window.Dropkick = factory(window, document, window.jQuery);
	}

}(function (window, document, jQuery, undefined) {


	var
		// Browser testing stuff
		isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
		isIframe = window.parent !== window.self,
		isIE = navigator.appVersion.indexOf("MSIE") !== -1,
		/**
		 * # Getting started
		 * After you've cloned the repo you will need to add the library to your page. In the `build/js` folder use
		 * one of the two DropKick files given. One has a version number in the file name and the other is a version
		 * number-less version. You will also need to grab the css from `build/css` and load it on the page.
		 *
		 * Once those files are imported into the page you can call DropKick on any HTMLSelectElement:
		 * `new Dropkick( HTMLSelectElement, Options );` or `new Dropkick( "ID", Options );`. This returns the dropkick
		 * object to you. It may be useful for you to store this in a var to reference later.
		 *
		 * If you're using jQuery you can do this instead:
		 * `$('#select').dropkick( Options );`
		 *
		 *
		 * @class Dropkick
		 * @return { object } DropKick Object for that select. You can call your methods on this if stored in a var
		 * @param {elem} sel HTMLSelect Element being passed.
		 * @param {opts} options See list of [properties you can pass in here](#list_of_properties)
		 * @constructor
		 * @example
		 *  ```js
		 *    // Pure JS
		 *    var select = new Dropkick("#select");
		 *  ```
		 * @example
		 *  ```js
		 *    // jQuery
		 *    $("#select").dropkick();
		 *  ```
		 */
		Dropkick = function (sel, opts) {
			var i, dk;

			// Safety if `Dropkick` is called without `new`
			if (this === window) {
				return new Dropkick(sel, opts);
			}

			if (typeof sel === "string" && sel[0] === "#") {
				sel = document.getElementById(sel.substr(1));
			}

			// Check if select has already been DK'd and return the DK Object
			for (i = 0; i < Dropkick.uid; i++) {
				dk = Dropkick.cache[ i ];

				if (dk instanceof Dropkick && dk.data.select === sel) {
					_.extend(dk.data.settings, opts);
					return dk;
				}
			}

			if (!sel) {
				console.error("You must pass a select to DropKick");
				return false;
			}

			if (sel.length < 1) {
				console.error("You must have options inside your <select>: ", sel);
				return false;
			}

			if (sel.nodeName === "SELECT") {
				return this.init(sel, opts);
			}
		},
		noop = function () {
		},
		_docListener,
		// DK default options
		defaults = {
			/**
			 * Called once after the DK element is inserted into the DOM.
			 * The value of `this` is the Dropkick object itself.
			 *
			 * @config initialize
			 * @type Function
			 *
			 */
			initialize: noop,
			/**
			 * Whether or not you would like Dropkick to render on mobile devices.
			 *
			 * @default false
			 * @property {boolean} mobile
			 * @type boolean
			 *
			 */
			mobile: false,
			/**
			 * Called whenever the value of the Dropkick select changes (by user action or through the API).
			 * The value of `this` is the Dropkick object itself.
			 *
			 * @config change
			 * @type Function
			 *
			 */
			change: noop,
			/**
			 * Called whenever the Dropkick select is opened. The value of `this` is the Dropkick object itself.
			 *
			 * @config open
			 * @type Function
			 *
			 */
			open: noop,
			/**
			 * Called whenever the Dropkick select is closed. The value of `this` is the Dropkick object itself.
			 *
			 * @config close
			 * @type Function
			 *
			 */
			close: noop,
			// Search method; "strict", "partial", or "fuzzy"
			/**
			 * `"strict"` - The search string matches exactly from the beginning of the option's text value (case insensitive).
			 *
			 * `"partial"` - The search string matches part of the option's text value (case insensitive).
			 *
			 * `"fuzzy"` - The search string matches the characters in the given order (not exclusively).
			 * The strongest match is selected first. (case insensitive).
			 *
			 * @default "strict"
			 * @config search
			 * @type string
			 *
			 */
			search: "strict",
			/**
			 * Bubble up the custom change event attached to Dropkick to the original element (select).
			 */
			bubble: true
		},
	// Common Utilities
	_ = {
		hasClass: function (elem, classname) {
			var reg = new RegExp("(^|\\s+)" + classname + "(\\s+|$)");
			return elem && reg.test(elem.className);
		},
		addClass: function (elem, classname) {
			if (elem && !_.hasClass(elem, classname)) {
				elem.className += " " + classname;
			}
		},
		removeClass: function (elem, classname) {
			var reg = new RegExp("(^|\\s+)" + classname + "(\\s+|$)");
			elem && (elem.className = elem.className.replace(reg, " "));
		},
		toggleClass: function (elem, classname) {
			var fn = _.hasClass(elem, classname) ? "remove" : "add";
			_[ fn + "Class" ](elem, classname);
		},
		// Shallow object extend
		extend: function (obj) {
			Array.prototype.slice.call(arguments, 1).forEach(function (source) {
				if (source) {
					for (var prop in source)
						obj[ prop ] = source[ prop ];
				}
			});

			return obj;
		},
		// Returns the top and left offset of an element
		offset: function (elem) {
			var box = elem.getBoundingClientRect() || {top: 0, left: 0},
			docElem = document.documentElement,
				offsetTop = isIE ? docElem.scrollTop : window.pageYOffset,
				offsetLeft = isIE ? docElem.scrollLeft : window.pageXOffset;

			return {
				top: box.top + offsetTop - docElem.clientTop,
				left: box.left + offsetLeft - docElem.clientLeft
			};
		},
		// Returns the top and left position of an element relative to an ancestor
		position: function (elem, relative) {
			var pos = {top: 0, left: 0};

			while (elem && elem !== relative) {
				pos.top += elem.offsetTop;
				pos.left += elem.offsetLeft;
				elem = elem.parentNode;
			}

			return pos;
		},
		// Returns the closest ancestor element of the child or false if not found
		closest: function (child, ancestor) {
			while (child) {
				if (child === ancestor) {
					return child;
				}
				child = child.parentNode;
			}
			return false;
		},
		// Creates a DOM node with the specified attributes
		create: function (name, attrs) {
			var a, node = document.createElement(name);

			if (!attrs) {
				attrs = {};
			}

			for (a in attrs) {
				if (attrs.hasOwnProperty(a)) {
					if (a === "innerHTML") {
						node.innerHTML = attrs[ a ];
					} else {
						node.setAttribute(a, attrs[ a ]);
					}
				}
			}

			return node;
		},
		deferred: function (fn) {
			return function () {
				var args = arguments,
					ctx = this;

				window.setTimeout(function () {
					fn.apply(ctx, args);
				}, 1);
			};
		}

	};


// Cache of DK Objects
	Dropkick.cache = {};
	Dropkick.uid = 0;


// Extends the DK objects's Prototype
	Dropkick.prototype = {
		// Emulate some of HTMLSelectElement's methods

		/**
		 * Adds an element to the select. This option will not only add it to the original
		 * select, but create a Dropkick option and add it to the Dropkick select.
		 *
		 * @method add
		 * @param {string} elem   HTMLOptionElement
		 * @param {Node/Integer} before HTMLOptionElement/Index of Element
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.add("New option", 5);
		 *  ```
		 */
		add: function (elem, before) {
			var text, option, i;

			if (typeof elem === "string") {
				text = elem;
				elem = document.createElement("option");
				elem.text = text;
			}

			if (elem.nodeName === "OPTION") {
				option = _.create("li", {
					"class": "dk-option",
					"data-value": elem.value,
					"text": elem.text,
					"innerHTML": elem.innerHTML,
					"role": "option",
					"aria-selected": "false",
					"id": "dk" + this.data.cacheID + "-" + (elem.id || elem.value.replace(" ", "-"))
				});

				_.addClass(option, elem.className);
				this.length += 1;

				if (elem.disabled) {
					_.addClass(option, "dk-option-disabled");
					option.setAttribute("aria-disabled", "true");
				}

				if (elem.hidden) {
					_.addClass(option, "dk-option-hidden");
					option.setAttribute("aria-hidden", "true");
				}

				this.data.select.add(elem, before);

				if (typeof before === "number") {
					before = this.item(before);
				}

				i = this.options.indexOf(before);

				if (i > -1) {
					before.parentNode.insertBefore(option, before);
					this.options.splice(i, 0, option);
				} else {
					this.data.elem.lastChild.appendChild(option);
					this.options.push(option);
				}

				option.addEventListener("mouseover", this);

				if (elem.selected) {
					this.select(i);
				}
			}
		},
		/**
		 * Selects an option in the list at the desired index (negative numbers select from the end).
		 *
		 * @method item
		 * @param  {Integer} index Index of element (positive or negative)
		 * @return {Node}          The DK option from the list, or null if not found
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.item(4); //returns DOM node of index
		 *  ```
		 */
		item: function (index) {
			index = index < 0 ? this.options.length + index : index;
			return this.options[ index ] || null;
		},
		/**
		 * Removes the option (from both the select and Dropkick) at the given index.
		 *
		 * @method  remove
		 * @param  {Integer} index Index of element (positive or negative)
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.remove(4);
		 *  ```
		 */
		remove: function (index) {
			var dkOption = this.item(index);
			dkOption.parentNode.removeChild(dkOption);
			this.options.splice(index, 1);
			this.data.select.remove(index);
			this.select(this.data.select.selectedIndex);
			this.length -= 1;
		},
		/**
		 * Initializes the DK Object
		 *
		 * @method init
		 * @private
		 * @param  {Node}   sel  [description]
		 * @param  {Object} opts Options to override defaults
		 * @return {Object}      The DK Object
		 */
		init: function (sel, opts) {
			var i,
				dk = Dropkick.build(sel, "dk" + Dropkick.uid);

			// Set some data on the DK Object
			this.data = {};
			this.data.select = sel;
			this.data.elem = dk.elem;
			this.data.settings = _.extend({}, defaults, opts);

			// Emulate some of HTMLSelectElement's properties

			/**
			 * Whether the form is currently disabled or not
			 *
			 * @property {boolean} disabled
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.disabled;
			 *  ```
			 */
			this.disabled = sel.disabled;

			/**
			 * The form associated with the select
			 *
			 * @property {node} form
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.form;
			 *  ```
			 */
			this.form = sel.form;

			/**
			 * The number of options in the select
			 *
			 * @property {integer} length
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.length;
			 *  ```
			 */
			this.length = sel.length;

			/**
			 * If this select is a multi-select
			 *
			 * @property {boolean} multiple
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.multiple;
			 *  ```
			 */
			this.multiple = sel.multiple;

			/**
			 * An array of Dropkick options
			 *
			 * @property {array} options
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.options;
			 *  ```
			 */
			this.options = dk.options.slice(0);

			/**
			 * An index of the first selected option
			 *
			 * @property {integer} selectedIndex
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.selectedIndex;
			 *  ```
			 */
			this.selectedIndex = sel.selectedIndex;

			/**
			 * An array of selected Dropkick options
			 *
			 * @property {array} selectedOptions
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.selectedOptions;
			 *  ```
			 */
			this.selectedOptions = dk.selected.slice(0);

			/**
			 * The current value of the select
			 *
			 * @property {string} value
			 * @example
			 *  ```js
			 *    var select = new Dropkick("#select");
			 *
			 *    select.value;
			 *  ```
			 */
			this.value = sel.value;

			// Add the DK Object to the cache
			this.data.cacheID = Dropkick.uid;
			Dropkick.cache[ this.data.cacheID ] = this;

			// Call the optional initialize function
			this.data.settings.initialize.call(this);

			// Increment the index
			Dropkick.uid += 1;

			// Add the change listener to the select
			if (!this._changeListener) {
				sel.addEventListener("change", this);
				this._changeListener = true;
			}

			// Don't continue if we're not rendering on mobile
			if (!(isMobile && !this.data.settings.mobile)) {

				// Insert the DK element before the original select
				sel.parentNode.insertBefore(this.data.elem, sel);
				sel.setAttribute("data-dkCacheId", this.data.cacheID);

				// Bind events
				this.data.elem.addEventListener("click", this);
				this.data.elem.addEventListener("keydown", this);
				this.data.elem.addEventListener("keypress", this);

				if (this.form) {
					this.form.addEventListener("reset", this);
				}

				if (!this.multiple) {
					for (i = 0; i < this.options.length; i++) {
						this.options[ i ].addEventListener("mouseover", this);
					}
				}

				if (!_docListener) {
					document.addEventListener("click", Dropkick.onDocClick);

					if (typeof dfd_native.sameOrigin != "undefined" && dfd_native.sameOrigin && isIframe) {
						parent.document.addEventListener("click", Dropkick.onDocClick);
					}

					_docListener = true;
				}
			}

			return this;
		},
		/**
		 * Closes the DK dropdown
		 *
		 * @method close
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.close(); //closes dk dropdown
		 *  ```
		 */
		close: function () {
			var i,
				dk = this.data.elem;

			if (!this.isOpen || this.multiple) {
				return false;
			}

			for (i = 0; i < this.options.length; i++) {
				_.removeClass(this.options[ i ], "dk-option-highlight");
			}

			dk.lastChild.setAttribute("aria-expanded", "false");
			_.removeClass(dk.lastChild, "dk-select-options-highlight");
			_.removeClass(dk, "dk-select-open-(up|down)");
			this.isOpen = false;

			this.data.settings.close.call(this);
		},
		/**
		 * Opens the DK dropdown
		 *
		 * @method open
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.open(); //Opens the dk dropdown
		 *  ```
		 */
		open: _.deferred(function () {
			var dropHeight, above, below, direction, dkTop, dkBottom,
				dk = this.data.elem,
				dkOptsList = dk.lastChild,
				// Using MDNs suggestion for crossbrowser scrollY:
				// https://developer.mozilla.org/en-US/docs/Web/API/Window/scrollY
				supportPageOffset = window.pageXOffset !== undefined,
				isCSS1Compat = ((document.compatMode || "") === "CSS1Compat"),
				scrollY = supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;

			dkTop = _.offset(dk).top - scrollY;
			dkBottom = window.innerHeight - (dkTop + dk.offsetHeight);

			if (this.isOpen || this.multiple) {
				return false;
			}

			dkOptsList.style.display = "block";
			dropHeight = dkOptsList.offsetHeight;
			dkOptsList.style.display = "";

			above = dkTop > dropHeight;
			below = dkBottom > dropHeight;
			direction = above && !below ? "-up" : "-down";

			this.isOpen = true;
			_.addClass(dk, "dk-select-open" + direction);
			dkOptsList.setAttribute("aria-expanded", "true");
			this._scrollTo(this.options.length - 1);
			this._scrollTo(this.selectedIndex);

			this.data.settings.open.call(this);
		}),
		/**
		 * Disables or enables an option; if only a boolean is passed (or nothing),
		 * then the entire Dropkick will be disabled or enabled.
		 *
		 * @method disable
		 * @param  {Integer} elem     The element or index to disable
		 * @param  {Boolean}      disabled Value of disabled
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    // To disable the entire select
		 *    select.disable();
		 *
		 *    // To disable just an option with an index
		 *    select.disable(4, true);
		 *
		 *    // To re-enable the entire select
		 *    select.disable(false);
		 *
		 *    // To re-enable just an option with an index
		 *    select.disable(4, false);
		 *  ```
		 */
		disable: function (elem, disabled) {
			var disabledClass = "dk-option-disabled";

			if (arguments.length === 0 || typeof elem === "boolean") {
				disabled = elem === undefined ? true : false;
				elem = this.data.elem;
				disabledClass = "dk-select-disabled";
				this.disabled = disabled;
			}

			if (disabled === undefined) {
				disabled = true;
			}

			if (typeof elem === "number") {
				elem = this.item(elem);
			}

			if (disabled) {
				elem.setAttribute('aria-disabled', true);
				_.addClass(elem, disabledClass);
			} else {
				elem.setAttribute('aria-disabled', false);
				_.removeClass(elem, disabledClass);
			}
		},
		/**
		 * Hides or shows an option.
		 *
		 * @method hide
		 * @param  {Integer} elem     The element or index to hide
		 * @param  {Boolean} hidden   Whether or not to hide the element
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    // To hide an option with an index
		 *    select.hide(4, true);
		 *
		 *    // To make an option visible with an index
		 *    select.hide(4, false);
		 *  ```
		 */
		hide: function (elem, hidden) {
			var hiddenClass = "dk-option-hidden";

			if (hidden === undefined) {
				hidden = true;
			}

			elem = this.item(elem);

			if (hidden) {
				elem.setAttribute('aria-hidden', true);
				_.addClass(elem, hiddenClass);
			} else {
				elem.setAttribute('aria-hidden', false);
				_.removeClass(elem, hiddenClass);
			}
		},
		/**
		 * Selects an option from the list
		 *
		 * @method select
		 * @param  {String} elem     The element, index, or value to select
		 * @param  {Boolean}             disabled Selects disabled options
		 * @return {Node}                         The selected element
		 * @example
		 *  ```js
		 *    var elm = new Dropkick("#select");
		 *
		 *    // Select by index
		 *    elm.select(4); //selects & returns 5th item in the list
		 *
		 *    // Select by value
		 *    elm.select("AL"); // selects & returns option with the value "AL"
		 *  ```
		 */
		select: function (elem, disabled) {
			var i, index, option, combobox,
				select = this.data.select;

			if (typeof elem === "number") {
				elem = this.item(elem);
			}

			if (typeof elem === "string") {
				for (i = 0; i < this.length; i++) {
					if (this.options[ i ].getAttribute("data-value") === elem) {
						elem = this.options[ i ];
					}
				}
			}

			// No element or enabled option
			if (!elem || typeof elem === "string" ||
				(!disabled && _.hasClass(elem, "dk-option-disabled"))) {
				return false;
			}

			if (_.hasClass(elem, "dk-option")) {
				index = this.options.indexOf(elem);
				option = select.options[ index ];

				if (this.multiple) {
					_.toggleClass(elem, "dk-option-selected");
					option.selected = !option.selected;

					if (_.hasClass(elem, "dk-option-selected")) {
						elem.setAttribute("aria-selected", "true");
						this.selectedOptions.push(elem);
					} else {
						elem.setAttribute("aria-selected", "false");
						index = this.selectedOptions.indexOf(elem);
						this.selectedOptions.splice(index, 1);
					}
				} else {
					combobox = this.data.elem.firstChild;

					if (this.selectedOptions.length) {
						_.removeClass(this.selectedOptions[0], "dk-option-selected");
						this.selectedOptions[0].setAttribute("aria-selected", "false");
					}

					_.addClass(elem, "dk-option-selected");
					elem.setAttribute("aria-selected", "true");

					combobox.setAttribute("aria-activedescendant", elem.id);
					combobox.className = "dk-selected " + option.className;
					combobox.innerHTML = option.innerHTML;

					this.selectedOptions[0] = elem;
					option.selected = true;
				}

				this.selectedIndex = select.selectedIndex;
				this.value = select.value;

				if (!disabled) {
					this.data.select.dispatchEvent(new CustomEvent("change", {bubbles: this.data.settings.bubble}));
				}

				return elem;
			}
		},
		/**
		 * Selects a single option from the list and scrolls to it (if the select is open or on multi-selects).
		 * Useful for selecting an option after a search by the user. Important to note: this doesn't close the
		 * dropdown when selecting. It keeps the dropdown open and scrolls to proper position.
		 *
		 * @method selectOne
		 * @param  {Integer} elem     The element or index to select
		 * @param  {Boolean}      disabled Selects disabled options
		 * @return {Node}                  The selected element
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.selectOne(4);
		 *  ```
		 */
		selectOne: function (elem, disabled) {
			this.reset(true);
			this._scrollTo(elem);
			return this.select(elem, disabled);
		},
		/**
		 * Finds all options who's text matches a pattern (strict, partial, or fuzzy)
		 *
		 * `"strict"` - The search string matches exactly from the beginning of the
		 * option's text value (case insensitive).
		 *
		 * `"partial"` - The search string matches part of the option's text value
		 * (case insensitive).
		 *
		 * `"fuzzy"` - The search string matches the characters in the given order (not
		 * exclusively). The strongest match is selected first. (case insensitive).
		 *
		 * @method search
		 * @param  {String} string  The string to search for
		 * @param  {Integer} mode   How to search; "strict", "partial", or "fuzzy"
		 * @return {Boolean}  An Array of matched elements
		 */
		search: function (pattern, mode) {
			var i, tokens, str, tIndex, sIndex, cScore, tScore, reg,
				options = this.data.select.options,
				matches = [];

			if (!pattern) {
				return this.options;
			}

			// Fix Mode
			mode = mode ? mode.toLowerCase() : "strict";
			mode = mode === "fuzzy" ? 2 : mode === "partial" ? 1 : 0;

			reg = new RegExp((mode ? "" : "^") + pattern, "i");

			for (i = 0; i < options.length; i++) {
				str = options[ i ].text.toLowerCase();

				// Fuzzy
				if (mode == 2) {
					tokens = pattern.toLowerCase().split("");
					tIndex = sIndex = cScore = tScore = 0;

					while (sIndex < str.length) {
						if (str[ sIndex ] === tokens[ tIndex ]) {
							cScore += 1 + cScore;
							tIndex++;
						} else {
							cScore = 0;
						}

						tScore += cScore;
						sIndex++;
					}

					if (tIndex === tokens.length) {
						matches.push({e: this.options[ i ], s: tScore, i: i});
					}

					// Partial or Strict (Default)
				} else {
					reg.test(str) && matches.push(this.options[ i ]);
				}
			}

			// Sort fuzzy results
			if (mode === 2) {
				matches = matches.sort(function (a, b) {
					return (b.s - a.s) || a.i - b.i;
				}).reduce(function (p, o) {
					p[ p.length ] = o.e;
					return p;
				}, []);
			}

			return matches;
		},
		/**
		 * Brings focus to the proper DK element
		 *
		 * @method focus
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    $("#some_elm").on("click", function() {
		 *      select.focus();
		 *    });
		 *  ```
		 */
		focus: function () {
			if (!this.disabled) {
				(this.multiple ? this.data.elem : this.data.elem.children[0]).focus();
			}
		},
		/**
		 * Resets the Dropkick and select to it's original selected options; if `clear` is `true`,
		 * It will select the first option by default (or no options for multi-selects).
		 *
		 * @method reset
		 * @param  {Boolean} clear Defaults to first option if True
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    // Reset to originally `selected` option
		 *    select.reset();
		 *
		 *    // Reset to first option in select
		 *    select.reset(true);
		 *  ```
		 */
		reset: function (clear) {
			var i,
				select = this.data.select;

			this.selectedOptions.length = 0;

			for (i = 0; i < select.options.length; i++) {
				select.options[ i ].selected = false;
				_.removeClass(this.options[ i ], "dk-option-selected");
				this.options[ i ].setAttribute("aria-selected", "false");
				if (!clear && select.options[ i ].defaultSelected) {
					this.select(i, true);
				}
			}

			if (!this.selectedOptions.length && !this.multiple) {
				this.select(0, true);
			}
		},
		/**
		 * Rebuilds the DK Object
		 * (use if HTMLSelectElement has changed)
		 *
		 * @method refresh
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    //... [change original select] ...
		 *
		 *    select.refresh();
		 *  ```
		 */
		refresh: function () {
			if (Object.keys(this).length > 0 && !(isMobile && !this.data.settings.mobile)) {
				this.dispose().init(this.data.select, this.data.settings);
			}
		},
		/**
		 * Removes the DK Object from the cache and the element from the DOM
		 *
		 * @method dispose
		 * @example
		 *  ```js
		 *    var select = new Dropkick("#select");
		 *
		 *    select.dispose();
		 *  ```
		 */
		dispose: function () {
			if (Object.keys(this).length > 0 && !(isMobile && !this.data.settings.mobile)) {
				delete Dropkick.cache[ this.data.cacheID ];
				this.data.elem.parentNode.removeChild(this.data.elem);
				this.data.select.removeAttribute("data-dkCacheId");
			}
			return this;
		},
		// Private Methods

		/**
		 * @method handleEvent
		 * @private
		 */
		handleEvent: function (event) {
			if (this.disabled) {
				return;
			}

			switch (event.type) {
				case "click":
					this._delegate(event);
					break;
				case "keydown":
					this._keyHandler(event);
					break;
				case "keypress":
					this._searchOptions(event);
					break;
				case "mouseover":
					this._highlight(event);
					break;
				case "reset":
					this.reset();
					break;
				case "change":
					this.data.settings.change.call(this);
					break;
			}
		},
		/**
		 * @method delegate
		 * @private
		 */
		_delegate: function (event) {
			var selection, index, firstIndex, lastIndex,
				target = event.target;

			if (_.hasClass(target, "dk-option-disabled")) {
				return false;
			}

			if (!this.multiple) {
				this[ this.isOpen ? "close" : "open" ]();
				if (_.hasClass(target, "dk-option")) {
					this.select(target);
				}
			} else {
				if (_.hasClass(target, "dk-option")) {
					selection = window.getSelection();
					if (selection.type === "Range")
						selection.collapseToStart();

					if (event.shiftKey) {
						firstIndex = this.options.indexOf(this.selectedOptions[0]);
						lastIndex = this.options.indexOf(this.selectedOptions[ this.selectedOptions.length - 1 ]);
						index = this.options.indexOf(target);

						if (index > firstIndex && index < lastIndex)
							index = firstIndex;
						if (index > lastIndex && lastIndex > firstIndex)
							lastIndex = firstIndex;

						this.reset(true);

						if (lastIndex > index) {
							while (index < lastIndex + 1) {
								this.select(index++);
							}
						} else {
							while (index > lastIndex - 1) {
								this.select(index--);
							}
						}
					} else if (event.ctrlKey || event.metaKey) {
						this.select(target);
					} else {
						this.reset(true);
						this.select(target);
					}
				}
			}
		},
		/**
		 * @method highlight
		 * @private
		 */
		_highlight: function (event) {
			var i, option = event.target;

			if (!this.multiple) {
				for (i = 0; i < this.options.length; i++) {
					_.removeClass(this.options[ i ], "dk-option-highlight");
				}

				_.addClass(this.data.elem.lastChild, "dk-select-options-highlight");
				_.addClass(option, "dk-option-highlight");
			}
		},
		/**
		 * @method keyHandler
		 * @private
		 */
		_keyHandler: function (event) {
			var lastSelected, j,
				selected = this.selectedOptions,
				options = this.options,
				i = 1,
				keys = {
					tab: 9,
					enter: 13,
					esc: 27,
					space: 32,
					up: 38,
					down: 40
				};

			switch (event.keyCode) {
				case keys.up:
					i = -1;
					// deliberate fallthrough
				case keys.down:
					event.preventDefault();
					lastSelected = selected[ selected.length - 1 ];

					if (_.hasClass(this.data.elem.lastChild, "dk-select-options-highlight")) {
						_.removeClass(this.data.elem.lastChild, "dk-select-options-highlight");
						for (j = 0; j < options.length; j++) {
							if (_.hasClass(options[ j ], "dk-option-highlight")) {
								_.removeClass(options[ j ], "dk-option-highlight");
								lastSelected = options[ j ];
							}
						}
					}

					i = options.indexOf(lastSelected) + i;

					if (i > options.length - 1) {
						i = options.length - 1;
					} else if (i < 0) {
						i = 0;
					}

					if (!this.data.select.options[ i ].disabled) {
						this.reset(true);
						this.select(i);
						this._scrollTo(i);
					}
					break;
				case keys.space:
					if (!this.isOpen) {
						event.preventDefault();
						this.open();
						break;
					}
					// deliberate fallthrough
				case keys.tab:
				case keys.enter:
				for (i = 0; i < options.length; i++) {
					if (_.hasClass(options[ i ], "dk-option-highlight")) {
						this.select(i);
					}
				}
				// deliberate fallthrough
				case keys.esc:
					if (this.isOpen) {
						event.preventDefault();
						this.close();
					}
					break;
			}
		},
		/**
		 * @method searchOptions
		 * @private
		 */
		_searchOptions: function (event) {
			var results,
				self = this,
				keyChar = String.fromCharCode(event.keyCode || event.which),
				waitToReset = function () {
					if (self.data.searchTimeout) {
						clearTimeout(self.data.searchTimeout);
					}

					self.data.searchTimeout = setTimeout(function () {
						self.data.searchString = "";
					}, 1000);
				};

			if (this.data.searchString === undefined) {
				this.data.searchString = "";
			}

			waitToReset();

			this.data.searchString += keyChar;
			results = this.search(this.data.searchString, this.data.settings.search);

			if (results.length) {
				if (!_.hasClass(results[0], "dk-option-disabled")) {
					this.selectOne(results[0]);
				}
			}
		},
		/**
		 * @method scrollTo
		 * @private
		 */
		_scrollTo: function (option) {
			var optPos, optTop, optBottom,
				dkOpts = this.data.elem.lastChild;

			if (option === -1 || (typeof option !== "number" && !option) ||
				(!this.isOpen && !this.multiple)) {
				return false;
			}

			if (typeof option === "number") {
				option = this.item(option);
			}

			optPos = _.position(option, dkOpts).top;
			optTop = optPos - dkOpts.scrollTop;
			optBottom = optTop + option.offsetHeight;

			if (optBottom > dkOpts.offsetHeight) {
				optPos += option.offsetHeight;
				dkOpts.scrollTop = optPos - dkOpts.offsetHeight;
			} else if (optTop < 0) {
				dkOpts.scrollTop = optPos;
			}
		}
	};

// Static Methods

	/**
	 * Builds the Dropkick element from a select element
	 *
	 * @method  build
	 * @private
	 * @param  {Node} sel The HTMLSelectElement
	 * @return {Object}   An object containing the new DK element and it's options
	 */
	Dropkick.build = function (sel, idpre) {
		var selOpt, optList, i,
			options = [],
			ret = {
				elem: null,
				options: [],
				selected: []
			},
		addOption = function (node) {
			var option, optgroup, optgroupList, i,
				children = [];

			switch (node.nodeName) {
				case "OPTION":
					option = _.create("li", {
						"class": "dk-option ",
						"data-value": node.value,
						"text": node.text,
						"innerHTML": node.innerHTML,
						"role": "option",
						"aria-selected": "false",
						"id": idpre + "-" + (node.id || node.value.replace(" ", "-"))
					});

					_.addClass(option, node.className);

					if (node.disabled) {
						_.addClass(option, "dk-option-disabled");
						option.setAttribute("aria-disabled", "true");
					}

					if (node.hidden) {
						_.addClass(option, "dk-option-hidden");
						option.setAttribute("aria-hidden", "true");
					}

					if (node.selected) {
						_.addClass(option, "dk-option-selected");
						option.setAttribute("aria-selected", "true");
						ret.selected.push(option);
					}

					ret.options.push(this.appendChild(option));
					break;
				case "OPTGROUP":
					optgroup = _.create("li", {"class": "dk-optgroup"});

					if (node.label) {
						optgroup.appendChild(_.create("div", {
							"class": "dk-optgroup-label",
							"innerHTML": node.label
						}));
					}

					optgroupList = _.create("ul", {
						"class": "dk-optgroup-options"
					});

					for (i = node.children.length; i--; children.unshift(node.children[ i ]))
						;
					children.forEach(addOption, optgroupList);

					this.appendChild(optgroup).appendChild(optgroupList);
					break;
			}
		};

		ret.elem = _.create("div", {
			"class": "dk-select" + (sel.multiple ? "-multi" : "")
		});

		optList = _.create("ul", {
			"class": "dk-select-options",
			"id": idpre + "-listbox",
			"role": "listbox"
		});

		if (sel.disabled) {
			_.addClass(ret.elem, "dk-select-disabled");
			ret.elem.setAttribute('aria-disabled', true);
		}
		ret.elem.id = idpre + (sel.id ? "-" + sel.id : "");
		_.addClass(ret.elem, sel.className);

		if (!sel.multiple) {
			selOpt = sel.options[ sel.selectedIndex ];
			ret.elem.appendChild(_.create("div", {
				"class": "dk-selected " + selOpt.className,
				"tabindex": sel.tabindex || 0,
				"innerHTML": selOpt ? selOpt.text : '&nbsp;',
				"id": idpre + "-combobox",
				"aria-live": "assertive",
				"aria-owns": optList.id,
				"role": "combobox"
			}));
			optList.setAttribute("aria-expanded", "false");
		} else {
			ret.elem.setAttribute("tabindex", sel.getAttribute("tabindex") || "0");
			optList.setAttribute("aria-multiselectable", "true");
		}

		for (i = sel.children.length; i--; options.unshift(sel.children[ i ]))
			;
		options.forEach(addOption, ret.elem.appendChild(optList));

		return ret;
	};

	/**
	 * Focus DK Element when corresponding label is clicked; close all other DK's
	 *
	 * @method  onDocClick
	 * @private
	 * @param {Object} event  Event from document click
	 */
	Dropkick.onDocClick = function (event) {
		var tId, i;

		if (event.target.nodeType !== 1) {
			return false;
		}

		if ((tId = event.target.getAttribute("data-dkcacheid")) !== null) {
			Dropkick.cache[ tId ].focus();
		}

		for (i in Dropkick.cache) {
			if (!_.closest(event.target, Dropkick.cache[ i ].data.elem) && i !== tId) {
				Dropkick.cache[ i ].disabled || Dropkick.cache[ i ].close();
			}
		}
	};


// Add jQuery method
	if (jQuery !== undefined) {
		jQuery.fn.dropkick = function () {
			var args = Array.prototype.slice.call(arguments);
			return jQuery(this).each(function () {
				if (!args[0] || typeof args[0] === 'object') {
					new Dropkick(this, args[0] || {});
				} else if (typeof args[0] === 'string') {
					Dropkick.prototype[ args[0] ].apply(new Dropkick(this), args.slice(1));
				}
			});
		};
	}

	return Dropkick;

}));
