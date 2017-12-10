//v.2.0 build 81009

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/
dhtmlXWindows.prototype._enableWebMenu = function() {
	
	// this._sb = document.createElement("DIV");
	// this._sb.style.height = height+"px";
	
	this._attachWebMenu = function(win) {
		
		win._menuId = win._midd;
		win._menuH = (_isIE?25:22);
		win._menuT = (_isIE?24:23);
		win.menu = new dhtmlXMenuObject(win._menuId, "topId");
		var skin = "glassy_blue";
		switch (this.skin) {
			case "glassy_blue":
			case "glassy_blue_light":
				// skin = "GlassyBlue";
				win._menuH = 23;
				win._menuT = 23;
				break;
			case "dhx_black":
			case "dhx_blue":
				skin = this.skin;
				if (win.toolbar != null) {
					win._menuH = 25;
					win._menuT = 25;
					win._content.childNodes[0].className += " dhtmlxMenu_"+this._skin+"_bottom_border";
				} else {
					win._menuH = 24;
					win._menuT = 24;
				}
				break;
		}
		win.menu.setSkin(skin);
		//win.menu.base.style.marginLeft = "-1";
		//win.menu._topLevelBottomMargin = 1;
		win._content.childNodes[0].style.display = "";
		win._content.childNodes[0].style.height = win._menuH + "px";
		win._content.childNodes[2].style.top = win._menuT + (win._toolbarT!=null?win._toolbarT:0) + "px";
		
		// win._content.childNodes[0].style.marginTop = "-1px";
		if (_isIE) {
			win._IEFixMTS = true;
			var pad = win._menuT + (win._toolbarT!=null?win._toolbarT:0) + (win._sbH!=null?win._sbH:0);
			win._content.childNodes[2].style.paddingBottom = pad + "px";
		}
		// opera 950 fix
		if (_isOpera && win.layout != null) {
			win.layout._fixCellsContentOpera950();
		}
		// fix inner elements
		if (win.accordion != null) { win.accordion.setSizes(); }
		if (win.layout != null) { win.layout.setSizes(win); }
		//
		return win.menu;
	}
}