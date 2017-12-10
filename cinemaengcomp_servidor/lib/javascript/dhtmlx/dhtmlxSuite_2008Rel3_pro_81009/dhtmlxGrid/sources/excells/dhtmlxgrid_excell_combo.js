//v.2.0 build 81009

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/
/**
*	@desc: integration with dhtmlxCombo editor
*	@returns: dhtmlxGrid cell editor object
*/

dhtmlXGridObject.prototype._init_point_bcg=dhtmlXGridObject.prototype._init_point;
dhtmlXGridObject.prototype._init_point = function(){
	
	if(!window.dhx_globalImgPath) window.dhx_globalImgPath = this.imgURL;

	this._col_combos=[];
	for (var i=0; i<this._cCount; i++){
		if(this.cellType[i]=="combo")
			this._col_combos[i] = eXcell_combo.prototype.initCombo.call({grid:this});
	}
	if(!this._loading_handler_set){
		this._loading_handler_set = this.attachEvent("onXLE",function(a,b,c,xml){
			eXcell_combo.prototype.fillColumnCombos(this,xml);	
			this.detachEvent(this._loading_handler_set);
		})
	}
	this._init_point=this._init_point_bcg;
	if (this._init_point) this._init_point();
};


function eXcell_combo(cell){
	
	if(!cell) return;

	this.cell = cell; 
	
	this.grid = cell.parentNode.grid;

	
				
		/**
		*	@desc: method called by grid to start editing
		*/
	this.edit = function(){
		
		
		var val = this.getText();  
		if(val == "&nbsp;") val="";
		this.cell.innerHTML = "";
		if(!this.cell.dcombo)
			this.combo = this.grid._col_combos[this.cell._cellIndex];
		else
			this.combo = this.cell.dcombo;
			
		this.cell.appendChild(this.combo.DOMParent);
		
		this.combo.setSize(this.cell.offsetWidth-2);
		
		if(!this.combo._xml){ 

			
			if(this.combo.getIndexByValue(this.cell._cval)!=-1)
				this.combo.selectOption(this.combo.getIndexByValue(this.cell._cval));
			else {
				if(this.combo.getOptionByLabel(val))
					this.combo.selectOption(this.combo.getIndexByValue(this.combo.getOptionByLabel(val).value));
				else this.combo.setComboText(val);
			}

		}
		else{
			this.combo.setComboValue(val);
		}
		
		this.combo.openSelect();
		
		
	}
	
	this.selectComboOption = function(val,obj){
		obj.selectOption(obj.getIndexByValue(obj.getOptionByLabel(val).value));
	}
	
		/**
		*	@desc: get real value of the cell
		*/
		
	this.getValue = function(val){
		
		return this.cell._cval;
	}

	this.getText = function(val){
		return this.getTitle();
	}

	/**
	*	@desc: set formated value to the cell
	*/
	this.setValue = function(val){
		
			
			
			for(var i = 0; i < this.cell.parentNode.childNodes.length; i++){
				this.cell.parentNode.childNodes[i].tabIndex = 0;
			}
			
			
			if(typeof(val)=="object"){
				this.cell.dcombo = this.initCombo();
				var index = this.cell._cellIndex;
				var idd = this.cell.parentNode.idd;
				this.cell._cval = val.firstChild.data;
				this.setComboOptions(this.cell.dcombo,val,this.grid,index,idd);
				
			}else{
			
			
			this.cell._cval = val;	
			
			var cm=null;
			if (cm = this.grid._col_combos[this.cell._cellIndex])
				val=(cm.getOption(val)||{}).text||val;
				
			
			if ((val||"").toString()._dhx_trim()=="")
				val = null;
            
			if (val!==null)
 			    this.setCValue(val);
            else
                 this.setCValue("&nbsp;",val);		
				 
			}
	}
	            
		/**
		*	@desc: this method called by grid to close editor
		*   @type: private 
		*/
	this.detach = function(){
		this.cell.removeChild(this.combo.DOMParent);
		var val = this.cell._cval;
		if (!this.combo.getComboText() || this.combo.getComboText().toString()._dhx_trim()==""){
			this.setCValue("&nbsp;");
    	}
		else this.setCTxtValue(this.combo.getComboText(),this.combo.getActualValue());
		this.cell._cval = this.combo.getActualValue();
		this.combo.closeAll();
		return val!=this.cell._cval;
	}
}

				
eXcell_combo.prototype = new eXcell;

		/**
		*	@desc: create combo object
		*   @returns: combo object
		*   @type: private 		  
		*/
eXcell_combo.prototype.initCombo = function(){
	
	container = document.createElement("DIV");
	
	combo = new dhtmlXCombo(container,"combo",0);
	
	combo.DOMelem.className+=" fake_editable";
	grid = this.grid;
	combo.DOMelem.onselectstart=function(){event.cancelBubble=true; return true;};
	combo.DOMelem.onkeydown=function(ev){ ev=ev||window.event; if (ev.keyCode!=9) ev.cancelBubble=true; if (ev.keyCode==13) grid.editStop();};
	combo.DOMelem.onkeydown=function(ev){ ev=ev||window.event; if (ev.keyCode!=9) ev.cancelBubble=true;};
	combo.attachEvent("onKeyPressed",function(ev){if(ev==13) grid.editStop();})
	combo.DOMelem.style.border = "0px";
	combo.DOMelem.style.height = "18px";
	return combo;

}
		
eXcell_combo.prototype.fillColumnCombos = function(grid,xml){
	
	grid.combo_columns = grid.combo_columns||[];
	columns = grid.xmlLoader.doXPath("//column",xml);
	for(var i = 0; i < columns.length; i++){
		if(columns[i].getAttribute("type")=="combo"){
			grid.combo_columns[grid.combo_columns.length] = i; 
			
			this.setComboOptions(grid._col_combos[i],columns[i],grid,i);
			
		}
	}
	
}
		/**
		*	@desc: this method sets combo options and prorerties 
		*   @type: private 
		*/

eXcell_combo.prototype.setComboOptions = function(combo,obj,grid,index,idd){
	if(convertStringToBoolean(obj.getAttribute("xmlcontent"))){

		if(!obj.getAttribute("source")){
			options = obj.childNodes;
			for (var i=0; i < options.length; i++){
				if(options[i].tagName =="option"){
					combo.addOption(options[i].getAttribute("value"),options[i].firstChild.data);
				}
			}
			if(arguments.length == 4){
					grid.forEachRow(function(id){
						var c = grid.cells(id,index);
						if(!c.cell.dcombo&&!c.cell._cellType)
						c.setCValue(combo.getOption(c.cell._cval).text);
					});	
				}
				else {
					var c = (this.cell)?this:grid.cells(idd,index);
					if(obj.getAttribute("text")) {
						if(obj.getAttribute("text")._dhx_trim()=="") c.setCValue("&nbsp;"); 
						else c.setCValue(obj.getAttribute("text")); 
					}
					else{
						if((!c.cell._cval)||(c.cell._cval._dhx_trim()=="")) c.setCValue("&nbsp;");
						else c.setCValue(combo.getOption(c.cell._cval).text);
					}
			}
			
		}				
	}

	if(obj.getAttribute("source")){
		if(obj.getAttribute("auto")&&convertStringToBoolean(obj.getAttribute("auto"))){
		
			if(obj.getAttribute("xmlcontent")){
				var c = (this.cell)?this:grid.cells(idd,index);
				if(obj.getAttribute("text")) c.setCValue(obj.getAttribute("text"));
			}
			else{
				grid.forEachRow(function(id){
					var c = grid.cells(id,index);
					if(!c.cell.dcombo&&!c.cell._cellType){
						var str = c.cell._cval.toString();
						if(str.indexOf("^")!=-1){
							var arr = str.split("^");
							c.cell._cval = arr[0];
							c.setCValue(arr[1]);
						}
					}
				});	
			}
			combo.enableFilteringMode(true,obj.getAttribute("source"),convertStringToBoolean(obj.getAttribute("cache")||true),convertStringToBoolean(obj.getAttribute("sub")||false));	
		
		}
		else {
			var that = this;
			var length = arguments.length; 
			combo.loadXML(obj.getAttribute("source"),function(){
				if(length == 4){
					grid.forEachRow(function(id){
						var c = grid.cells(id,index);
						if(!c.cell.dcombo&&!c.cell._cellType){
							if(combo.getOption(c.cell._cval))
								c.setCValue(combo.getOption(c.cell._cval).text);
							else 
								c.setCValue(c.cell._cval);
						}
					});	
				}
				else {
					//var c = (that.cell)? that : grid.cells(idd,index);
					var c = grid.cells(idd,index);
					c.setCValue(obj.getAttribute("text")); //fx
				}
			});
			
		}
	}
	if(!obj.getAttribute("auto")||!convertStringToBoolean(obj.getAttribute("auto"))){
	
		if(obj.getAttribute("editable")&&!convertStringToBoolean(obj.getAttribute("editable"))) combo.readonly(true);
		if(obj.getAttribute("filter")&&convertStringToBoolean(obj.getAttribute("filter"))) combo.enableFilteringMode(true);	
		
	}

}

		/**
		*	@desc: gets dhtmlxCombo object for specified cell  
		*   @returns: combo object
		*   @type: public 
		*/
eXcell_combo.prototype.getCellCombo = function(){
	
	if(this.cell.dcombo) return this.cell.dcombo;
	else {
		this.cell.dcombo = this.initCombo();
		return this.cell.dcombo;
	}
}
		/**
		*	@desc: gets dhtmlxCombo object for specified column  
		*   @param: index - column index
		*   @returns: combo object 
		*   @type: public
		*/

dhtmlXGridObject.prototype.getColumnCombo = function(index){
	if(this._col_combos&&this._col_combos[index]) return this._col_combos[index];
	else{
		if(!this._col_combos) this._col_combos=[];
		this._col_combos[index] = eXcell_combo.prototype.initCombo.call({grid:this});
		return this._col_combos[index];
	}
}


//(c)dhtmlx ltd. www.dhtmlx.com