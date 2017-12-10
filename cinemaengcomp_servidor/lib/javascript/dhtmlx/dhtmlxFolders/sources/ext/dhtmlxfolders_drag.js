//v.1.0 build 80319

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
/**
*     @desc: enable/disable context menu
*     @param: menu object, if null - context menu will be disabled
*     @type: public
*     @topic: 0
*/
    dhtmlxFolders.prototype.enableContextMenu=function(menu){
        this._ctmndx=menu;
    };
    /**
	*   @desc: enables drag-n-drop in Folders 
	*	@param: mode - true/false
	*   @type:  public
	*/
    dhtmlxFolders.prototype.enableDragAndDrop=function(mode){
    	if (convertStringToBoolean(mode)){
    		this._drager=new dhtmlDragAndDropObject();
		} else
		this._drager=null;
    };    
	/**
	*   @desc: 
	*   @type:  private
	*/
	dhtmlxFolders.prototype._createDragNode=function(htmlObject,e){
		var id=htmlObject.itemObj.data.id;
		this._dragged=[].concat(this._selectedCol);
		if (!this.matchSelected(null,id)){
			this.selectItem(id);
			this._dragged=[id];
		}
			
		
		if (this._dragged.length>1){
			var z=this._idpullCol[this._dragged[1]].item.cloneNode(true);
			var z2=this._idpullCol[this._dragged[0]].item.cloneNode(true);	
			z2.style.left="10px";
			z2.style.top="10px";
			z2.className+=' dhx_DnD_drag';
			z.appendChild(z2);
		}
		else
			var z=htmlObject.cloneNode(true);	
		z.className+=' dhx_DnD_drag';
		this._idpullCol[id].parentObject={id:id, ex:this, treeNod:{_nonTrivialNode:this._dragInTree}};
  		z._exp_id=id;

   		return z;
    };        
    /**
	*   @desc: 
	*   @type:  private
	*/
    dhtmlxFolders.prototype._dragInTree=function(tree,tobj,bnod,item){
    	var that=item.ex;
    	for (var i=0; i<that._dragged.length; i++){
    		var id=that._dragged[i];
    		var text=that.getItem(id)._data()[0];
			var src=that.getItem(id)._data()[1];    	
    		if (!bnod)
	    		tree.insertNewItem(tobj.id,id,text,src,src,src);
		    else
		    	tree.insertNewNext(bnod.id,id,text,src,src,src);
    		that.deleteItem(id);
    	}
    }
	/**
	*   @desc: 
	*   @type:  private
	*/
	dhtmlxFolders.prototype._drag=function(sourceHtmlObject,dhtmlObject,targetHtmlObject,lastLanding){
		this.hideDnDSelection(true);
		if (dhtmlObject.mytype=="tree"){
			for (var j=0; j<dhtmlObject._dragged.length; j++){
				var t=dhtmlObject; var i=dhtmlObject._dragged[j].id;
				this.addItem(i,t.getItemText(i),t.getItemImage(i),{id:targetHtmlObject._exp_id,mode:this._dndPos});
				t.deleteItem(i);
			}
			return;
		}
		if (sourceHtmlObject.itemObj.data.id==targetHtmlObject.itemObj.data.id) 
			return false;
		if (!this.matchSelected(null,targetHtmlObject.itemObj.data.id))
			this.getItem(targetHtmlObject.itemObj.data.id).setSelectedState(false);
		if (this.callEvent("onBeforeDrop",[this._dndPos,this._getAllDragItemsIds(sourceHtmlObject),targetHtmlObject.itemObj.data.id]) && this._dndPos!="in"){
			for (var i=0; i<dhtmlObject._dragged.length; i++)
				this.moveItem(dhtmlObject._dragged[i],this._dndPos,targetHtmlObject.itemObj.data.id,dhtmlObject);
			this._dragged=null;
		}
	}
	/**
	*   @desc: 
	*   @type:  private
	*/
	dhtmlxFolders.prototype.hideDnDSelection=function(mode,left,top,dy){
		if(!this._DnDSel){
			this._DnDSel = new Array();
		}
		var orientat = this._getCurrentPlacementType();
		if (!this._DnDSel[orientat]) {
				this._DnDSel[orientat]=document.createElement("IMG");
				this._DnDSel[orientat].className='dhx_DnD_selector';
				this._DnDSel[orientat].src=this.imgSrc+'dnd_selector_'+orientat+'.png';
				this._DnDSel[orientat].dragLanding=this;
				this.cont.appendChild(this._DnDSel[orientat]);
			}
		if (mode)
			this._DnDSel[orientat].style.display="none";
		else {
			this._DnDSel[orientat].style.display="";
			this._DnDSel[orientat].style.top=top+"px";
			this._DnDSel[orientat].style.left=left+"px";			
			this._DnDSel[orientat].style.width = "6px";
			this._DnDSel[orientat].style.height = "6px";
			if(orientat=="cells")
				this._DnDSel[orientat].style.height=dy+"px";
			else
				this._DnDSel[orientat].style.width=dy+"px";
		}
	}
	/**
	*   @desc: 
	*   @type:  private
	*/
	dhtmlxFolders.prototype._dragIn=function(htmlObject,shtmlObject,x,y){
		if (htmlObject.tagName=="IMG")
			htmlObject=this._lastDH;
		this._lastDH=htmlObject;
		if (shtmlObject.itemObj.data.id==htmlObject.itemObj.data.id) 
			return false;
		
		tObjWidth = htmlObject.offsetWidth;	
		tObjHeight = htmlObject.offsetHeight;
		tObjTop = getAbsoluteTop(htmlObject);
		tObjLeft = getAbsoluteLeft(htmlObject);
		topCorrector = getAbsoluteTop(this.cont);
		leftCorrector = getAbsoluteLeft(this.cont);
		
		if(this._getCurrentPlacementType()=="cells"){
			if(x-tObjLeft<tObjWidth/4 && this.callEvent("onBeforeDragIn",["before",this._getAllDragItemsIds(shtmlObject),htmlObject.itemObj.data.id])){
				this.hideDnDSelection(false,tObjLeft-leftCorrector,tObjTop-topCorrector,tObjHeight)
				this._dndPos="before";
			}else if(x-tObjLeft>(tObjWidth/4)*3  && this.callEvent("onBeforeDragIn",["next",this._getAllDragItemsIds(shtmlObject),htmlObject.itemObj.data.id])){
				this.hideDnDSelection(false,tObjLeft+tObjWidth-leftCorrector,tObjTop-topCorrector,tObjHeight);
				this._dndPos="next";
			}else if(this.callEvent("onBeforeDragIn",["in",this._getAllDragItemsIds(shtmlObject),htmlObject.itemObj.data.id])){
				this._dndPos="in";
				this.hideDnDSelection(true);
				this.getItem(htmlObject.itemObj.data.id).setSelectedState(true);
			}
				
		}else if(this._getCurrentPlacementType()=="lines"){
			debugger;
			if(y-tObjTop<tObjHeight/4  && this.callEvent("onBeforeDragIn",["before",this._getAllDragItemsIds(shtmlObject),htmlObject.itemObj.data.id])){
				this.hideDnDSelection(false,tObjLeft-leftCorrector,tObjTop-topCorrector,tObjWidth)
				this._dndPos="before";
			}else if(y-tObjTop>(tObjHeight/4)*3  && this.callEvent("onBeforeDragIn",["next",this._getAllDragItemsIds(shtmlObject),htmlObject.itemObj.data.id])){
				this.hideDnDSelection(false,tObjLeft+tObjWidth-leftCorrector,tObjTop-topCorrector,tObjWidth);
				this._dndPos="next";
			}else if(this.callEvent("onBeforeDragIn",["in",this._getAllDragItemsIds(shtmlObject),htmlObject.itemObj.data.id])){
				this._dndPos="in";
				this.hideDnDSelection(true);
				this.getItem(htmlObject.itemObj.data.id).setSelectedState(true);
			}
		}
			
		return htmlObject;
	}
	/**
	*   @desc: 
	*   @type:  private
	*/
	dhtmlxFolders.prototype._dragOut=function(htmlObject){    
		this.hideDnDSelection(true);
		if (!this.matchSelected(null,htmlObject.itemObj.data.id))
			this.getItem(htmlObject.itemObj.data.id).setSelectedState(false);
	}
	
	dhtmlxFolders.prototype._getAllDragItemsIds = function(sHTMLObj){
		var curItemId = sHTMLObj.itemObj.data.id;
		var selected = this.getSelectedId();
		if(typeof(selected)=="object"){
			for(var i=0;i<selected.length;i++){
				if(curItemId==selected[i])
					return selected;//array
			}
			selected[selected.length] = curItemId;
			return selected;
		}else if(selected!=null){
			if(selected!=curItemId)
				return [selected,curItemId];
			else
				return selected;
		}else
			return curItemId;
	}