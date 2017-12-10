// This is just a sample script. Paste your real code (javascript or HTML) here.
scheduler._props = {};
scheduler.createUnitsView = function (a, f, j, g, k, l) {
    if (typeof a == "object") j = a.list, f = a.property, g = a.size || 0, k = a.step || 1, l = a.skip_incorrect, a = a.name;
    scheduler._props[a] = {
        map_to: f,
        options: j,
        step: k,
        position: 0
    };
    if (g > scheduler._props[a].options.length) scheduler._props[a]._original_size = g, g = 0;
    scheduler._props[a].size = g;
    scheduler._props[a].skip_incorrect = l || !1;
    scheduler.date[a + "_start"] = scheduler.date.day_start;
    scheduler.templates[a + "_date"] = function (a) {
        return scheduler.templates.day_date(a)
    };
    scheduler.templates[a + "_scale_date"] = function (c) {
        var h = scheduler._props[a].options;
        if (!h.length) return "";
        var f = (scheduler._props[a].position || 0) + Math.floor((scheduler._correct_shift(c.valueOf(), 1) - scheduler._min_date.valueOf()) / 864E5);
        return h[f].css ? "<span class='" + h[f].css + "'>" + h[f].label + "</span>" : h[f].label
    };
    scheduler.date["add_" + a] = function (a, f) {
        return scheduler.date.add(a, f, "day")
    };
    scheduler.date["get_" + a + "_end"] = function (c) {
        return scheduler.date.add(c, scheduler._props[a].size || scheduler._props[a].options.length, "day")
    };
    scheduler.attachEvent("onOptionsLoad", function () {
        for (var c = scheduler._props[a], f = c.order = {}, g = c.options, i = 0; i < g.length; i++) f[g[i].key] = i;
        if (c._original_size && c.size == 0) c.size = c._original_size, delete c.original_size;
        c.size > g.length ? (c._original_size = c.size, c.size = 0) : c.size = c._original_size || c.size;
        scheduler._date && scheduler._mode == a && scheduler.setCurrentView(scheduler._date, scheduler._mode)
    });
    scheduler.callEvent("onOptionsLoad", [])
};
scheduler.scrollUnit = function (a) {
    var f = scheduler._props[this._mode];
    if (f) f.position = Math.min(Math.max(0, f.position + a), f.options.length - f.size), this.update_view()
};
(function () {
    var a = function (b) {
            var d = scheduler._props[scheduler._mode];
            if (d && d.order && d.skip_incorrect) {
                for (var a = [], e = 0; e < b.length; e++) typeof d.order[b[e][d.map_to]] != "undefined" && a.push(b[e]);
                b.splice(0, b.length);
                b.push.apply(b, a)
            }
            return b
        },
        f = scheduler._pre_render_events_table;
    scheduler._pre_render_events_table = function (b, d) {
        b = a(b);
        return f.apply(this, [b, d])
    };
    var j = scheduler._pre_render_events_line;
    scheduler._pre_render_events_line = function (b, d) {
        b = a(b);
        return j.apply(this, [b, d])
    };
    var g = function (b,
        d) {
		alert(b);
		alert(d);
            if (b && typeof b.order[d[b.map_to]] == "undefined") {
                var a = scheduler,
                    e = 864E5,
                    c = Math.floor((d.end_date - a._min_date) / e);
                d[b.map_to] = b.options[Math.min(c + b.position, b.options.length - 1)].key;
                return !0
            }
        },
        k = scheduler._reset_scale,
        l = scheduler.is_visible_events;
    scheduler.is_visible_events = function (b) {
        var d = l.apply(this, arguments);
        if (d) {
            var a = scheduler._props[this._mode];
            if (a && a.size) {
                var e = a.order[b[a.map_to]];
                if (e < a.position || e >= a.size + a.position) return !1
            }
        }
        return d
    };
    scheduler._reset_scale = function () {
        var b = scheduler._props[this._mode],
            a = k.apply(this, arguments);
        if (b) {
            this._max_date = this.date.add(this._min_date, 1, "day");
            for (var c = this._els.dhx_cal_data[0].childNodes, e = 0; e < c.length; e++) c[e].className = c[e].className.replace("_now", "");
            if (b.size && b.size < b.options.length) {
                var f = this._els.dhx_cal_header[0],
                    g = document.createElement("DIV");
                if (b.position) g.className = "dhx_cal_prev_button", g.style.cssText = "left:1px;top:2px;position:absolute;", g.innerHTML = "&nbsp;", f.firstChild.appendChild(g), g.onclick = function () {
                    scheduler.scrollUnit(b.step * -1)
                };
                if (b.position + b.size < b.options.length) g = document.createElement("DIV"), g.className = "dhx_cal_next_button", g.style.cssText = "left:auto; right:0px;top:2px;position:absolute;", g.innerHTML = "&nbsp;", f.lastChild.appendChild(g), g.onclick = function () {
                    scheduler.scrollUnit(b.step)
                }
            }
        }
        return a
    };
    var c = scheduler._get_event_sday;
    scheduler._get_event_sday = function (b) {
        var a = scheduler._props[this._mode];
        return a ? (g(a, b), a.order[b[a.map_to]] - a.position) : c.call(this, b)
    };
    var h = scheduler.locate_holder_day;
    scheduler.locate_holder_day = function (a, d, c) {
        var e = scheduler._props[this._mode];
        return e ? (g(e, c), e.order[c[e.map_to]] * 1 + (d ? 1 : 0) - e.position) : h.apply(this, arguments)
    };
    var m = scheduler._mouse_coords;
    scheduler._mouse_coords = function () {
        var a = scheduler._props[this._mode],
            d = m.apply(this, arguments);
        if (a) {
            if (!this._drag_event) this._drag_event = {};
            var c = this._drag_event;
            if (this._drag_id && this._drag_mode) c = this.getEvent(this._drag_id), this._drag_event._dhx_changed = !0;
            var e = Math.min(d.x + a.position, a.options.length - 1);
            c[a.map_to] = a.options[e].key;
            d.x = 0;
            d.custom = !0
        }
        return d
    };
    var i = scheduler._time_order;
    scheduler._time_order = function (a) {
        var d = scheduler._props[this._mode];
        d ? a.sort(function (a, b) {
            return d.order[a[d.map_to]] > d.order[b[d.map_to]] ? 1 : -1
        }) : i.apply(this, arguments)
    };
    scheduler.attachEvent("onEventAdded", function (a, d) {
        if (this._loading) return !0;
        for (var c in scheduler._props) {
            var e = scheduler._props[c];
            if (typeof d[e.map_to] == "undefined") d[e.map_to] = e.options[0].key
        }
        return !0
    });
    scheduler.attachEvent("onEventCreated", function (a, c) {
        var f = scheduler._props[this._mode];
        if (f) {
            var e = this.getEvent(a);
            this._mouse_coords(c);
            g(f, e);
            this.event_updated(e)
        }
        return !0
    })
})();