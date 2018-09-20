! function(e) {
    "use strict";
    window.InlineShortcodeView_vc_column = window.InlineShortcodeViewContainerWithParent.extend({
        controls_selector: "#vc_controls-template-vc_column",
        resizeDomainName: "columnSize",
        _x: 0,
        css_width: 12,
        prepend: !1,
        initialize: function(e) {
            window.InlineShortcodeView_vc_column.__super__.initialize.call(this, e), _.bindAll(this, "startChangeSize", "stopChangeSize", "resize")
        },
        render: function() {
            return window.InlineShortcodeView_vc_column.__super__.render.call(this), this.prepend = !1, e('<div class="vc_resize-bar"></div>').appendTo(this.$el).mousedown(this.startChangeSize), this.setColumnClasses(), this.customCssClassReplace(), this
        },
        destroy: function(e) {
            var i = this.model.get("parent_id");
            window.InlineShortcodeView_vc_column.__super__.destroy.call(this, e), vc.shortcodes.where({
                parent_id: i
            }).length || vc.shortcodes.get(i).destroy()
        },
        customCssClassReplace: function() {
            var e, i, t;
            e = this.$el.find(".wpb_column").attr("class"), i = /.*(vc_custom_\d+).*/, t = e && e.match ? e.match(i) : !1, t && t[1] && (this.$el.addClass(t[1]), this.$el.find(".wpb_column").attr("class", e.replace(t[1], "").trim()))
        },
        setColumnClasses: function() {
            var e = this.getParam("offset") || "",
                i = this.getParam("width") || "1/1";
            this.moveAttributes(), this.css_class_width = this.convertSize(i), e.match(/vc_col\-sm\-\d+/) || this.$el.addClass(this.widthToString(this.css_class_width)), vc.responsive_disabled && (e = e.replace(/vc_col\-(lg|md|xs)[^\s]*/g, "")), _.isEmpty(e) || this.$el.addClass(e)
        },
        startChangeSize: function(i) {
            var t = this.getParam(t) || 12;
            this._grid_step = this.parent_view.$el.width() / t, vc.frame_window.jQuery("body").addClass("vc_column-dragging").disableSelection(), this._x = parseInt(i.pageX), vc.$page.bind("mousemove." + this.resizeDomainName, this.resize), e(vc.frame_window.document).mouseup(this.stopChangeSize)
        },
        stopChangeSize: function() {
            this._x = 0, vc.frame_window.jQuery("body").removeClass("vc_column-dragging").enableSelection(), vc.$page.unbind("mousemove." + this.resizeDomainName)
        },
        resize: function(e) {
            var i, t, s = this.model.get("params");
            t = e.pageX - this._x, Math.abs(t) < this._grid_step || (this._x = parseInt(e.pageX), i = "" + this.css_class_width, t > 0 ? this.css_class_width += 1 : 0 > t && (this.css_class_width -= 1), 12 < this.css_class_width && (this.css_class_width = 12), 1 > this.css_class_width && (this.css_class_width = 1), s.width = vc.getColumnSize(this.css_class_width), this.model.save({
                params: s
            }, {
                silent: !0
            }), this.$el.removeClass(this.widthToString(i)).addClass(this.widthToString(this.css_class_width)))
        },
        convertSize: function(e) {
            var i = e ? e.split("/") : [1, 1],
                t = _.range(1, 13),
                s = !_.isUndefined(i[0]) && 0 <= _.indexOf(t, parseInt(i[0], 10)) ? parseInt(i[0], 10) : !1,
                n = !_.isUndefined(i[1]) && 0 <= _.indexOf(t, parseInt(i[1], 10)) ? parseInt(i[1], 10) : !1;
            return !1 !== s && !1 !== n ? this.widthToString(12 * s / n) : 12
        },
        widthToString: function(e) {
            e && "" != e ? e > 12 ? e = 12 : 1 > e && (e = 1) : e = 12;
            var i = ["one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve"];
            return i[+e - 1]
        },
        moveAttributes: function() {
            var e = jQuery(this.$el),
                i = jQuery(this.$el.find("> .columns"));
            jQuery(i[0].attributes).each(function() {
                "class" == this.nodeName ? e.addClass(this.nodeValue) : e.attr(this.nodeName, this.nodeValue), i.attr(this.nodeName, "")
            });
			jQuery(i).find('> div').unwrap();
        },
        allowAddControl: function() {
            return vc_user_access().shortcodeAll("vc_column")
        }
    }),
	window.InlineShortcodeView_vc_column_inner = window.InlineShortcodeView_vc_column.extend({})
}(jQuery);