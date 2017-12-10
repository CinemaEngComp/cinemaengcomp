/* -----------------------------------------------------------
 *
 * EBA:Grid version 2.7
 *
 * Details and latest version at:
 * developer.ebusiness-apps.com
 *
 *
 * Copyright 2002-2005 eBusiness Applications ALL RIGHTS RESERVED. DO NOT MAKE PUBLIC 
 * Copyright in the whole and every part of this documentation belongs to eBusiness 
 * Applications. It is also the confidential information of eBusiness Applications. 
 * You may not use, sell, license, transfer, copy or reproduce it in whole or in part 
 * in any manner or form or in or on any media to any person other than in accordance 
 * with the terms of the License or as otherwise agreed in writing with eBusiness Applications. 
 *
 *
 * TradeMark Information
 * The EBA:Grid and eBusiness Applications logos are trademarks of eBusiness Applications.
 * All other trademarks are acknowledged and are the property of their respective owners. 
 *
 */



_ebaDebug=false;

var DEF_COL_GRAYING_COLOR = "#F7F7F7";
var DEF_DATE_MASK = "yyyy-mm-dd hh:mm:ss";

function _gridlist (oObj) 
{
	this.version = 2.7;
	this.element = oObj;	
	this.nextXK = oObj.nextXK || "";
	this.width = oObj.width;
	this.cellwidth = 0;
	this.height = oObj.height || Math.max(100,oObj.parentElement.scrollHeight);
	this.active = "";
	this.xdatasrc = oObj.xdatasrc;
	this.xdatalog = oObj.xdatalog;
	this.xselect = oObj.xselect || "";
	
	
	this.sortColumn = oObj.sortColumn || "0";
	
	this.curSortColumn = this.sortColumn;
	
	this.descending = _getBoolean(oObj.descending,"false");
	
	this.curSortColumnDesc = this.descending;
	
	this.selected = oObj.selected;



	this.oncolumnresize = oObj.oncolumnresize || "";
	this.resizedcolumn = "";
	this.resizeCall = 0;

	this.ondblclick = oObj.ondblclick || "";
	this.onbeforepaging=oObj.onbeforepaging || "";
	this.onbeforeedit=oObj.onbeforeedit || "";	
	this.onafterpaging=oObj.onafterpaging || "";	
	this.onbeforeinsert = oObj.onbeforeinsert || "";
	this.onafterinsert = oObj.onafterinsert || "";
	this.onbeforesort = oObj.onbeforesort || "";
	this.onaftersort = oObj.onaftersort || "";	
	this.onbeforesave = oObj.onbeforesave || "";
	this.onaftersave = oObj.onaftersave || "";	
	this.onrowchanged = oObj.onrowchanged || ""; 
	this.oncellenter = oObj.oncellenter || "";
	this.onafterdelete = oObj.onafterdelete || ""; 	
	this.onbeforedelete = oObj.onbeforedelete || "true";
	this.onmodified = oObj.onmodified || ""; 	
	this.onrowselect = oObj.onrowselect || ""; 	
	this.onbeforecopy = _GetFunctionString(oObj.onbeforecopy); 	
	this.onaftercopy = _GetFunctionString(oObj.onaftercopy); 	
	this.onbeforepaste = _GetFunctionString(oObj.onbeforepaste); 	
	this.onafterpaste = _GetFunctionString(oObj.onafterpaste); 	
	this.onGenerateRecordKey = oObj.onGenerateRecordKey || "";
	this.onError = oObj.onError || "";
	this.freezeColumn = oObj.freezeColumn || "0";
	if (this.freezeColumn > 0) defaultval="scroll"; else defaultval="auto";
	this.scrollX = oObj.scrollX || defaultval;
	this.scrollY = oObj.scrollY || "auto";
	this.forceValidate = _getBoolean(oObj.forceValidate);
	this.asynchronous = _getBoolean(oObj.asynchronous,"true");
	this.autoSave = _getBoolean(oObj.autoSave,"false");	
	this.autoAdd = _getBoolean(oObj.autoAdd);
	this.showNav = _getBoolean(oObj.showNav);
	this.showSummary = false;
	this.head = null;
	this.summary = null;


	this.normalColor = null;
	this.normalColor2 = new Array(oObj.children.length);
	
	this.prevColor = null;
	this.activeColor = oObj.activeColor || "#D0FED0";
	this.selectionColor = oObj.selectionColor || "#99CCFF";
	this.highlight = oObj.highlight || "#BAE6FE";
	this.activeRow = null;
	this.rowhighlight=_getBoolean(oObj.rowhighlight);
	this.rowselect=_getBoolean(oObj.rowselect);
	this.highlightCell = null;
	this.activeCell = null;
	this.activePane = null;
	this.scrolling = false;
	this.lastError = "";
	this.showErrors=_getBoolean(oObj.showErrors,false);
	this.columnGraying = _getBoolean(oObj.columnGraying,"false");
	this.columnGrayingColor = oObj.columnGrayingColor || DEF_COL_GRAYING_COLOR;

	this.fieldmap = new Array();
	this.oXML = null;
	this.oXSL = null;
	this.prevCell = null;
	this.prevText = "";
	this.prevData = "";
	
	this.hwrap = _getBoolean(oObj.hwrap,"true");
	this.vwrap = _getBoolean(oObj.vwrap,"true");
	
	
	this.entertab= oObj.entertab || "RT";
	
	this.PageSize = parseInt(oObj.PageSize) || 10;
	this.PageStart = parseInt(oObj.PageStart) || 0;

	this.saveHandler=oObj.saveHandler || "";
	
	this.lastSaveHandlerResponse = "";
	
	this.getHandler=oObj.getHandler || "";
	this.gridColor=oObj.gridColor || "#F0F0F0";
	this.cellHeight=parseInt(oObj.cellHeight || "16");
	
	this.scrollbarWidth = document.body.offsetWidth  - document.body.clientWidth - (document.body.clientLeft*2); 

	this.onlyOnceFlag=true;


	this.shift = false;

	this.calendar = null;


	this.showToolTips=(oObj.showToolTips=="Y");
	
	this.allowInsert=_getBoolean(oObj.allowInsert,"true");
	
	this.allowDelete=_getBoolean(oObj.allowDelete,"true");
	
	this.isPasting=false;
	
	this.d = new Date();

	this.decimalSeparator = oObj.decimalSeparator || ".";
	this.groupingSeparator = oObj.groupingSeparator || ",";
	
	
	gEsc = false;
	doNotFreeze=false;
	lookupSelectionMade=false;

	oObj.attachEvent("onkeypress",_GLKeyPress);	
	oObj.attachEvent("onkeydown",_GLKeyDown);	

	oObj.attachEvent("onkeyup",_GLKeyUp);

	oObj.attachEvent("onclick",_GLactivate);
	oObj.attachEvent("ondblclick",_GLdoubleclick);
	oObj.attachEvent("onmouseover",_GLHighlight);
	oObj.attachEvent("onmouseout",_GLRestore);
	oObj.attachEvent("onfocus",_GLFocus);
	oObj.attachEvent("onmousemove",_GLScroll);
	oObj.attachEvent("oncontextmenu",_GLMenu);

	oObj.attachEvent("onmousewheel",_GLMouseWheel);
	
	this.selection = new GridSelection(this);	
	oObj.attachEvent("onmousedown",_GLMouseDown);
	document.body.attachEvent("onmouseup",_GLMouseUp);
	oObj.attachEvent("onselectstart",_Cancle);
	
	oObj.attachEvent("onmousemove",trapCoordinates);
	oObj.attachEvent("onmousedown",resizeMouseDown);
	this.dontSortOnlyOnce=false;
}

function _GetFunctionString(fnc)
{
	var temp;
	temp = "";
	if (fnc)
	{
		temp = fnc.toString();
		if (temp.indexOf("function anonymous") > -1)
			temp = temp.substring(temp.indexOf("{") + 2, temp.indexOf("}") - 1);
	}
	return temp;
}

function _Cancle() {
	var This = _GLGrid(event.srcElement);
	if (This.inputCell.style.display =="block" || This.passwordCell.style.display == "block" || This.textCell.style.display == "block")
		return true;
	else
		return false;		
}

function GridSelection(oGrid) {
	this.grid = oGrid;
	
	this.startCol = -1;
	this.startRow = -1;
	this.endCol = -1;
	this.endRow = -1;
	
	this.lastEndRow = -1;
	this.lastEndCol = -1;
	
	this.mouseDown = false;
}
function GridSelection.prototype.highlight() {	
	var rowDiff, colDiff;
	rowDiff = this.endRow-this.lastEndRow;
	colDiff = this.endCol - this.lastEndCol;
		
	if ( (this.startRow>this.lastEndRow) || (this.startCol>this.lastEndCol) || (this.startRow>this.endRow) || (this.startCol>this.endCol) )  {
		
	} else {		
		var grayIdx = this.grid.columnGraying ? this.grid.curSortColumn : -1;
		if (rowDiff >=1) {
			for (i=this.lastEndRow; i<=this.endRow; i++) {
				for (j=this.startCol; j<=this.endCol; j++) {
					var cs = this.grid.getCellObject(i,j).runtimeStyle;
					cs.backgroundColor = this.grid.selectionColor;
					if (j == grayIdx)
					{
						cs.borderRightColor = this.grid.selectionColor;
						cs.borderBottomColor = this.grid.selectionColor;
					}
				}
			}
		} else if (rowDiff <= -1) {
			for (i=this.lastEndRow; i > this.endRow; i--) {
				for (j=this.startCol; j<=this.endCol; j++) {
					var cs = this.grid.getCellObject(i,j).runtimeStyle;
					cs.backgroundColor = this.grid.normalColor2[j];
					var c = (j == grayIdx) ? this.grid.columnGrayingColor : this.grid.gridColor;
					cs.borderRightColor = c;
					cs.borderBottomColor = c;
				}
			}
			var cs = this.grid.getCellObject(this.lastEndRow,this.lastEndCol).runtimeStyle;
			cs.backgroundColor = this.grid.normalColor2[this.lastEndCol];
			var c = (this.lastEndCol == grayIdx) ? this.grid.columnGrayingColor : this.grid.gridColor;
			cs.borderRightColor = c;
			cs.borderBottomColor = c;
		}
		if (colDiff >=1) {
			for (i=this.lastEndCol; i<=this.endCol; i++) {
				for (j=this.startRow; j<=this.endRow; j++) {					
					var cs = this.grid.getCellObject(j,i).runtimeStyle;
					cs.backgroundColor = this.grid.selectionColor;
					if (i == grayIdx)
					{
						cs.borderRightColor = this.grid.selectionColor;
						cs.borderBottomColor = this.grid.selectionColor;
					}
				}
			}	
		} else if (colDiff <= -1) {
			for (i=this.lastEndCol; i > this.endCol; i--) {
				for (j=this.startRow; j<=this.endRow; j++) {
					var cs = this.grid.getCellObject(j,i).runtimeStyle;
					cs.backgroundColor = this.grid.normalColor2[i];
					var c = (i == grayIdx) ? this.grid.columnGrayingColor : this.grid.gridColor;
					cs.borderRightColor = c;
					cs.borderBottomColor = c;
				}
			}
			var cs = this.grid.getCellObject(this.lastEndRow,this.lastEndCol).runtimeStyle;
			cs.backgroundColor = this.grid.normalColor2[this.lastEndCol];
			var c = (this.lastEndCol == grayIdx) ? this.grid.columnGrayingColor : this.grid.gridColor;
			cs.borderRightColor = c;
			cs.borderBottomColor = c;
		}
		this.lastEndRow = this.endRow;
		this.lastEndCol = this.endCol;			
	}	
}
function GridSelection.prototype.deselect() {
	if (this.startRow==-1) return;
	var oCell;
	var grayIdx = this.grid.columnGraying ? this.grid.curSortColumn : -1;
	for (i=this.startRow; i<=this.endRow; i++) {
		for (j=this.startCol; j<=this.endCol; j++) {
			oCell=this.grid.getCellObject(i,j);
			if (oCell!=null)
			{
				var cs = oCell.runtimeStyle;
				cs.backgroundColor = this.grid.normalColor2[j];
				var c = (j == grayIdx) ? this.grid.columnGrayingColor : this.grid.gridColor;
				cs.borderRightColor = c;
				cs.borderBottomColor = c;
			}
		}
	}
	this.grid.activateCell();
	this.startCol = -1;
	this.startRow = -1;
	this.endCol = -1;
	this.endRow = -1;
	
	this.lastEndCol = -1;
	this.lastEndRow = -1;
}

function GridSelection.prototype.containsSelection() {
	if ( ((this.startCol != this.endCol) || (this.startRow!=this.endRow)) && (this.startCol != -1) && (this.startRow!=-1) && (this.endCol!=-1) && (this.endRow!=-1) )
		return true;
	else return false;
}

function GridSelection.prototype.cellIsInSelection(oCell) {
	if (this.startRow==-1) return false;
	var col,row;
	col=this.grid.getColumn(false,oCell);
	row=this.grid.getRow(oCell);
	if ( (col >= this.startCol) && (col <= this.endCol) && (row >= this.startRow) && (row <= this.endRow)
	  && !(((this.startCol-this.endCol)==0) && ((this.startRow-this.endRow)==0)) )
		return true;
	else
		return false;
}

function GridSelection.prototype.copy() {
	if (this.startRow==-1) return;

	if (eval(this.grid.onbeforecopy || "") == false)
		return;
	setTimeout("document.getElementById(\"" + this.grid.element.id + "\").object.selection.doCopy();",0);
}

function GridSelection.prototype.doCopy() {
	var clipboardText="";
	for (i=this.startRow; i<=this.endRow; i++) {
		for (j=this.startCol; j<=this.endCol; j++) {
			clipboardText+=this.grid.getCellValue(i,j)+"\t";
		}
		clipboardText=clipboardText.substring(0,clipboardText.length-1);
		clipboardText+="\n";
	}
	window.clipboardData.setData("Text",clipboardText);

	eval(this.grid.onaftercopy);
}

function _gridlist.prototype.paste() {	
	var clipboardText=window.clipboardData.getData("Text");
	
	if ( (clipboardText.indexOf("\t")==-1) && (clipboardText.indexOf("\n")==-1)) return;
	if (this.activeCell==null) return;

	if (eval(this.onbeforepaste || "") == false)
		return;
	
	setTimeout("document.getElementById(\"" + this.element.id + "\").object.doPaste();",0);
}

function _gridlist.prototype.doPaste(){
	var clipboardText, sR, sC, cR, cC, rowCount, columnCount, cellpaste, cChar;
	clipboardText=window.clipboardData.getData("Text");

	this.isPasting=true;
	this.freezeCell();
	cellpaste="";

	oCell=this.activeCell;
	sR=this.getRow(oCell);
	sC=this.getColumn(false,oCell);
	cR = sR;
	cC = sC;
	
	rowCount=this.rowCount();
	columnCount=this.columnCount();

	for (i=0;i<clipboardText.length; i++) {
		cChar=clipboardText.charAt(i);
		if ( (cChar=="\t") || (cChar=="\n") ) {
			if (cC>=columnCount) {
				cC=sC;
				cR++;
				var j;
				j=i;
				while ( (j<clipboardText.length) && (clipboardText.charAt(j)!="\n") ) {	
					j++;
				}
				i=j;
				cellpaste="";
				continue;				
			}
			if (cR>=rowCount) {
				this.insertRow();
				rowCount++;			
			}
			this.setCell(cR,cC,cellpaste);
			
			if (cChar=="\t") {
				cC++;
			} else if (cChar=="\n") {
				cR++;
				cC=sC;				
			}			
			cellpaste="";
		} else {
			cellpaste+=clipboardText.charAt(i);
		}
	}
	this.activeCell=oCell;

	eval(this.onafterpaste);
	
	this.isPasting=false;
	if (this.autoSave) {
		this.save();
	}
}

function _GLMouseDown() {
	var This = _GLGrid(event.srcElement);
	This.selection.deselect();
	var selectionStartCell=This.findCellObject(event.srcElement);
	if (selectionStartCell!=null && event.button == 1) {
		document.body.attachEvent("onmousemove",SelectAndScroll);
		DoSelectScrollRightStarted=false;
		DoSelectScrollDownStarted=false;
		
		This.selection.startCol=This.getColumn(false,selectionStartCell);
		This.selection.startRow=This.getRow(selectionStartCell);
		This.selection.endCol=This.selection.startCol;
		This.selection.endRow=This.selection.startRow;
		This.selection.lastEndRow=This.selection.endRow;
		This.selection.lastEndCol=This.selection.endCol;
		This.selection.mouseDown=true;
	}
	_gridObj = This;
}

function SelectAndScroll() {
	
	var This = _gridObj;
	__x = event.clientX + document.body.scrollLeft;
	__y = event.clientY + document.body.scrollTop;

	var gridDim=getDim(This.element);
	
	if ( ( __x > (gridDim.x + This.element.offsetWidth) ) && (!DoSelectScrollRightStarted) ) { 
		DoSelectScrollRightStarted=true;		
		DoSelectScrollRight();
	}
	if ( ( __y > (gridDim.y + This.element.offsetHeight) ) && (!DoSelectScrollDownStarted) ) {
		DoSelectScrollDownStarted=true;
		DoSelectScrollDown();
	}
	if ( __x < gridDim.x + This.element.offsetWidth ) {
		DoSelectScrollRightStarted=false;
	}
	if ( __y < gridDim.y + This.element.offsetHeight ) {
		DoSelectScrollDownStarted=false;
	}
	
}

function DoSelectScrollRight() {
	var This = _gridObj;
	if (DoSelectScrollRightStarted) {
		This.body.scrollLeft+=10;
		oNewEndSelCell=This.getCellObject(This.selection.endRow,This.selection.endCol+1);
		if ( (oNewEndSelCell!=null) && (oNewEndSelCell.getClientRects()[0].right < This.element.getClientRects()[0].right) ) {
			This.selection.endCol+=1;
			This.selection.highlight();
		}
		setTimeout("DoSelectScrollRight()",10);
	}
}

function DoSelectScrollDown() {
	var This = _gridObj;
	if (DoSelectScrollDownStarted) {
		This.body.scrollTop+=10;
		oNewEndSelCell=This.getCellObject(This.selection.endRow+1,This.selection.endCol);
		if ( (oNewEndSelCell!=null) && (oNewEndSelCell.getClientRects()[0].bottom < This.body.getClientRects()[0].bottom+5  ) ) {
			This.selection.endRow+=1;
			This.selection.highlight();
		}
		setTimeout("DoSelectScrollDown()",10);
	}
}

function _GLMouseUp() {
	if (typeof(_gridObj)=="undefined") return;
	var This = _gridObj;
	if (This==null) return;	
	This.selection.mouseDown=false;
	document.body.detachEvent("onmousemove",SelectAndScroll);
	DoSelectScrollRightStarted=false;
	DoSelectScrollDownStarted=false;
}


__x = 0;
__y = 0;
function trapCoordinates() {
	var This = _GLGrid(event.srcElement);
	
	__x = event.clientX;
	__y = event.clientY;
	
	var oColumnHeader = event.srcElement.parentElement.parentElement;
	var tagName = oColumnHeader.tagName.toLowerCase();
	if (tagName == "columndefinition") {
		if ( This.resizeLine.style.visibility == "visible" ) {
			oColumnHeader.style.cursor = "w-resize";
		} else {
			var colrightX = getDim(oColumnHeader).x + oColumnHeader.offsetWidth - document.body.scrollLeft;

			if ( __x > (colrightX-10))
				oColumnHeader.style.cursor = "w-resize";
			else
				oColumnHeader.style.cursor = "default";
		}			
	}	
}

function cancleAll() {
	return false;
}

function _gridlist.prototype.getPendingSortColumn() {
	try {
		var val = event.srcElement.parentElement.parentElement.firstChild.nr;
		if (typeof(val)=="undefined") return null;
		else return val;
	} catch(e) {
		return null;
	}
}

function resizeMouseDown() {
	var This = _GLGrid(event.srcElement);
	var oColumnHeader = event.srcElement.parentElement.parentElement;
	This.dontSortOnlyOnce=false;
	mouseOffset=0;
	__x_start=__x;
	
	if (oColumnHeader.style.cursor == "w-resize") {
		This.curResizeColumn = oColumnHeader;
		var colDim = getDim(oColumnHeader);		
		This.resizeLine.style.posLeft = colDim.x + oColumnHeader.offsetWidth;
		This.resizeLine.style.posTop = colDim.y;
		This.resizeLine.style.visibility = "visible";
		_grid = This;	
		document.body.attachEvent("onmousemove",rePositionResizeLine);
		document.body.attachEvent("onmouseup",resizeMouseUp);
		document.body.attachEvent("onselectstart",cancleAll);
	}
}
function rePositionResizeLine() 
{
	__x = event.clientX;
	mouseOffset= __x - __x_start;
	var colDim = getDim(_grid.curResizeColumn);
	_grid.resizeLine.style.left = colDim.x + _grid.curResizeColumn.offsetWidth + mouseOffset;
	_grid.resizeLine.style.top = colDim.y;
}

function resizeMouseUp() 
{
	var This = _grid;
	if ( This.resizeLine.style.visibility == "visible" ) {
		This.resize(This.curResizeColumn.firstChild.nr,(This.curResizeColumn.offsetWidth + mouseOffset));
		This.dontSortOnlyOnce=true;
		
		This.resizeLine.style.visibility = "hidden";
		document.body.detachEvent("onmousemove",rePositionResizeLine);
		document.body.detachEvent("onmouseup",resizeMouseUp);
		document.body.detachEvent("onselectstart",cancleAll);
		This.curResizeColumn.style.cursor = "w-resize";
	}
}

function _GLHighlight() 
{
	try {		
		var This = _GLGrid(event.srcElement);
		if (This==null) return;
						
		var oCell= This.findCellObject(event.srcElement);
		if ( oCell == null ) {
			This.highlightCell = oCell;
			return;		
		}
		if ( This.resizeLine.style.visibility == "visible" ) {
			oCell.runtimeStyle.cursor = "w-resize";
		} else if (This.selection.mouseDown) {
			This.selection.endRow=This.getRow(oCell);
			This.selection.endCol=This.getColumn(false,oCell);
			This.selection.highlight();
		} else if (This.selection.startRow == -1) {
		
			This.highlightCell = oCell;
			This.normalColor = This.highlightCell.style.backgroundColor;
			var cols = This.columns;
			var numCols = This.columnCount();
			for (var i = 0; i < numCols; i++)
			{
				if (This.columnGraying && i == This.curSortColumn)
					This.normalColor2[i] = This.columnGrayingColor;
				else{
					This.normalColor2[i] = "";
					if (cols[i].bgcolor && cols[i].bgcolor.length > 5 && cols[i].bgcolor.substring(0,5) != "field")
						This.normalColor2[i] = cols[i].bgcolor || "";
				}
			}

			This.highlightCell.runtimeStyle.backgroundColor  = This.highlight;
			This.highlightCell.runtimeStyle.cursor = "hand";
			if (This.rowhighlight)
			{
				This.highlightCell.parentElement.runtimeStyle.backgroundColor  = This.highlight;
				
				if (This.freezeColumn > 0)
				{
					var otherRow = This.getOppositeRowObject(This.highlightCell.parentElement.id);
					otherRow.runtimeStyle.backgroundColor=This.highlight;
				}

				var oHLRow = This.highlightCell.parentElement;
				var oRow = ("xkf" == oHLRow.id.substring(0,3)) ? oHLRow : This.getOppositeRowObject(oHLRow.id);
				for (var i = 0; i < oRow.children.length; i++)
				{
					if ((This.columnGraying && i == This.curSortColumn) || (cols[i].bgcolor != undefined && cols[i].bgcolor != ""))
					{
						oRow.children[i].runtimeStyle.backgroundColor = This.highlight;
					}
				}
				oRow = This.getOppositeRowObject(oRow.id);
				for (var i = 0; i < oRow.children.length; i++)
				{
					var j = i + parseInt(This.freezeColumn);
					if ((This.columnGraying && j == This.curSortColumn) || (cols[j].bgcolor != undefined && cols[j].bgcolor != ""))
					{
						oRow.children[i].runtimeStyle.backgroundColor = This.highlight;
					}
				}
			}
		}
	} catch (err) 
	{
	}
}

function _gridlist.prototype.findCellObject(pObj) {
	while (pObj.id.indexOf("xkc") != 0 && pObj.tagName!="gridlist") {
		pObj = pObj.parentElement;
	}
	if (pObj.id.indexOf("xkc") == 0)
		return pObj;
	else 
		return null;
}

function _getBoolean(boolStr,defaultval) {
	if (typeof(defaultval)!="undefined")
		if ( (typeof(boolStr)=="undefined") || (boolStr=="") || (boolStr==null)) boolStr=defaultval;
	boolStr=boolStr || "";
	boolStr=boolStr.toUpperCase();
	if ( (boolStr=="Y") || (boolStr=="1") || (boolStr=="TRUE") ) return true;
	else return false;
}


function InitEBAGrids() {
	rl = document.getElementsByTagName("gridlist");
	for (var i=0; i<rl.length; i++) {
		rl(i).object = new _gridlist(rl(i));
		rl(i).object.init();
	}
}

var onlyOnce=true;

function _ebaAssert(condition, description)
{
	if (_ebaDebug && !condition && onlyOnce)
	{
		onlyOnce=false;
		alert("Assert: " + description);
		onlyOnce=true;
	}
}

function _GLK() {
	this.k = new Array();
}

function _gridlist.prototype.ConfirmPageOperation()
{
	try
	{
		var numChanges = this.oLog.selectSingleNode("//root").childNodes.length;
		if (numChanges > 0)
		{
			if (confirm("You must save your changes before moving to another page or you lose your recent changes. Would you like to save now? \n\n If you press 'Cancel' you lose your recent changes."))
			{
				this.save();
			} else {
				this.oLog.loadXML("<root></root>");
			}
		}
		return true;
	}
	catch(e)
	{
		return true;		
	}
}

function _gridlist.prototype.PageNext() {
	if (this.ConfirmPageOperation())
	{
		this.GetPage(this.PageStart + this.PageSize);
	}
} 

function _gridlist.prototype.PagePrevious() {
	if (this.ConfirmPageOperation())
	{
		this.GetPage(this.PageStart - this.PageSize);
	}
}

function _gridlist.prototype.GetPage(nStart) 
{
	try
	{
		if (document.getElementById(this.getHandler)!=null) return;
		
		eval(this.onbeforepaging);
	}catch(err){
	}

	setTimeout("document.getElementById(\"" + this.element.id + "\").object.doGetPage(" + nStart + ");",0);
}

function _gridlist.prototype.doGetPage(nStart){
	try
	{
		this.selection.deselect();

		this.PageStart = parseInt(nStart);

		this.oXML.async=false;
		var getHandlerURL = this.getHandler;
		getHandlerURL.indexOf("?") == -1 ? getHandlerURL += "?" :  getHandlerURL += "&";
		getHandlerURL += "start="+nStart+"&pagesize="+this.PageSize;
		
		var result = this.oXML.load(getHandlerURL);
		if (result!=true) {
			this.lastError="Your gethandler URL is not correct or the XML from that source is not available. The URL supplied was " + getHandlerURL;
			eval(this.onError);
			return;
		}

		this.sort(this.curSortColumn,this.curSortColumnDesc,true,true);
		

		if (this.showSummary)
		{
			this.calcSummary();
		}


		eval(this.onafterpaging);
		if (this.columnGraying)
		{
			var cols = this.columns;
			this.grayThisColumn(cols[this.curSortColumn], this.curSortColumn);
		}
	}
	catch(err)
	{
	}
}

function _GLMenu() 
{
	noBubble();
}

function _GLFocus() 
{
	try {
		var This = _GLGrid(event.srcElement); 
	} catch (err) 
	{
	}
}

function _gridlist.prototype.init() 
{
	try {
		if (typeof(ghttpObjInUse)=="undefined")
			ghttpObjInUse = false;


		var EL=this.element;
		var uniqueID = EL.uniqueID;

		this.active="";

		if (this.getHandler!="") {
			if (document.getElementById(this.getHandler)!=null) {
				this.xdatasrc=this.getHandler;
			} else {
				this.xdatasrc="xData_"+uniqueID;
				EL.insertAdjacentHTML('beforeBegin','<xml id="' +this.xdatasrc+ '"></xml>');
				var xData=eval(this.xdatasrc);
				xData.async=false;

				var getHandlerURL;
				getHandlerURL = this.getHandler;
				getHandlerURL += getHandlerURL.indexOf("?") == -1 ? "?" : "&";
				getHandlerURL += "start="+this.PageStart+"&pagesize="+this.PageSize;

				validXML = xData.load(getHandlerURL);
				if (!validXML) {
					this.lastError="Your gethandler for the Grid does not deliver valid XML! Try to hit the gethandler URL directly in order to debug your gethandler.";
					this.lastError+=this.getResponseFromURL(getHandlerURL);
					eval(this.onError);
					return;
				}					
			}
		}

		document.body.insertAdjacentHTML('beforeEnd','<span id="resizeline'+uniqueID+'" style="background:#000000;overflow:hidden;position:absolute;top:0;left:0;width:4;height:'+(this.height-6)+';visibility:hidden;z-index:10000;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=50);"></span>');

		EL.insertAdjacentHTML('afterBegin','<input class="gridlistinput" type="text" onblur="this.parentElement.object.freezeCell()" style="display:none;z-index:10;position:absolute;top:-1;overflow:hidden;height:'+this.cellHeight+';padding-top:0;width:100%;border:1pt solid;" id="cell'+uniqueID+'" name="cell'+uniqueID+'" value=""><select class="gridlistselect" onblur="this.parentElement.object.freezeCell()" type="text" style="display:none;z-index:10;position:absolute;top:-1;overflow:hidden;height:'+this.cellHeight+';font:11px Tahoma,Verdana,Arial;padding-top:0;width:100%;border:1pt solid;" id="celllb'+uniqueID+'" name="celllb'+uniqueID+'" value=""></select><input class="gridlistchk" onblur="this.parentElement.object.deactivateCell()" type="checkbox" class="gridlistchk" style="" id="checkcell'+uniqueID+'" name="checkcell'+uniqueID+'" value=""><div style="position:absolute;top:-10000;left:-10000;width:1;height:1;overflow:hidden;" id="clipboard'+uniqueID+'"></div><input class="gridlistinput" type="password" onblur="this.parentElement.object.freezeCell()" style="display:none;z-index:10;position:absolute;top:-1;overflow:hidden;height:'+this.cellHeight+';padding-top:0;width:100%;border:1pt solid;" id="cellpassword'+uniqueID+'" name="cellpassword'+uniqueID+'" value=""><span style="position:absolute;top:-10000;left:-10000;width:1;height:1;overflow:hidden;z-index:0;visibility:hidden;" id="columnGraying'+uniqueID+'"></span><span style="position:absolute;top:-10000;left:-10000;width:1;height:1;overflow:hidden;z-index:1;visibility:hidden;" id="columnGrayingDummy'+uniqueID+'"></span><textarea class="gridlistinput" onblur="this.parentElement.object.freezeCell()" style="display:none;z-index:10;position:absolute;top:-1;overflow:hidden;height:'+this.cellHeight+';padding-top:0;width:100%;border:1pt solid;" id="celltext'+uniqueID+'" name="celltext'+uniqueID+'"></textarea>');

		this.inputCell = EL.firstChild;

		this.textCell = document.getElementById("celltext" + uniqueID);

		this.selectCell = EL.childNodes(1);
		this.checkCell = EL.childNodes(2);
		this.clipboard = EL.childNodes(3);
		this.passwordCell = EL.childNodes(4);
		this.columnGrayingCell = document.getElementById("columnGraying" + uniqueID);
		this.columnGrayingDummyCell = document.getElementById("columnGrayingDummy" + uniqueID);
		this.oXSL = new ActiveXObject("Msxml2.DOMDocument.3.0"); 


var dataItems = this.setColumnWidths(true);
var dii = dataItems.length;

		this.width = EL.width || (this.cellwidth+16);
		EL.style.width = this.width;


		var summaryHtml = "";
		var freezeSummaryHtml = "";


		EL.insertAdjacentHTML('beforeEnd','<div class="gridlisthead" id="head'+uniqueID+'" style="position:relative;width:'+this.cellwidth+';"></div>');

		this.head = document.getElementById("head"+uniqueID);
		this.resizeLine = document.getElementById("resizeline"+uniqueID);

		dummywidth = this.width - this.cellwidth-2;
		if (dummywidth<0) dummywidth=0;
		EL.insertAdjacentHTML('beforeEnd','<span id="dummyHeader' +uniqueID+ '" class="gridlistheadingdeadspace" style="position:absolute;top:0;right:0;width:'+ dummywidth +';overflow:hidden;"></span>');

		var dataItem;
		var sFH="";
		for (var i=0; i< dii; i++) 
		{
			dataItem = dataItems[i];

			var oNode=dataItem.removeNode(true);

			this.head.appendChild(oNode);

			dataItem.innerHTML = '<span id="'  + i + '_Column' + uniqueID + '" nr="' +i+ '" style="width:'+dataItem.width+';overflow:hidden;position:relative;display:inline;z-index:900"><span onclick="this.parentElement.parentElement.parentElement.parentElement.object.sort('+i+')" onmouseover="this.parentElement.parentElement.parentElement.parentElement.object.headerMouseOver('+i+')" onmouseout="this.parentElement.parentElement.parentElement.parentElement.object.headerMouseOut('+i+')" onmousedown="this.parentElement.parentElement.parentElement.parentElement.object.headerMouseDown('+i+')" onmouseup="this.parentElement.parentElement.parentElement.parentElement.object.headerMouseUp('+i+')" class="gridlistheading" '+(dataItem.celldisabled?'':'')+'><nobr>'+(dataItem.label || dataItem.xdatafld)+'</nobr></span></span>';


			if (i < this.freezeColumn)
				freezeSummaryHtml += '<span id="'  + i + '_Column_Sum' + uniqueID + '" nr="' +i+ '" style="width:'+dataItem.width+';overflow:hidden;position:relative;display:inline;z-index:1000;" class="gridlistsummarycell"></span>';
			else
				summaryHtml += '<span id="'  + i + '_Column_Sum' + uniqueID + '" nr="' +i+ '" style="width:'+dataItem.width+';overflow:hidden;position:relative;display:inline;z-index:900;" class="gridlistsummarycell"></span>';


			if (i < this.freezeColumn) {
				sFH+=dataItems[i].outerHTML;
				dataItems[i].style.visibility = "hidden";
				dataItems[i].firstChild.id = i + "_" + uniqueID;
			}

			if (!this.showSummary)
				this.showSummary = _getBoolean(dataItems[i].showSummary);

		}

		EL.insertAdjacentHTML('beforeEnd','<span style="position:absolute;top:0;left:0;z-index:1000" id="freezeColumnDefs' + uniqueID + '">'+sFH+'</span>');
		EL.style.height = parseInt(this.height);

		var freezeCellDisplay = (this.freezeColumn == 0) ? "display: none" : "";

		var h=0;
		var lastElement=null;


		if (this.showSummary) {
			EL.insertAdjacentHTML('beforeEnd','<span class="gridlistsummary" id="summary'+uniqueID+'" style="position:relative;overflow:hidden;width:'+this.cellwidth+';"><span id="freezesummaryrows'+uniqueID+'" >' + freezeSummaryHtml + '</span><span id="summaryrows'+uniqueID+'" style="overflow:hidden;position:relative;">'+summaryHtml+'</span></span><span id="dummySummary' +uniqueID+ '" class="gridlistsummarydeadspace" style="width:'+dummywidth+';overflow:hidden;"></span>');
			var tbElement = document.getElementById('summary' + uniqueID);
			h -= tbElement.offsetHeight;
			lastElement = tbElement;
			this.summary = document.getElementById('summaryrows' + uniqueID);
		}


		if (this.showNav) {
			EL.insertAdjacentHTML('beforeEnd','<div id="toolbar' + uniqueID +'" class="toolbar"><table width="'+EL.width+'" cellpadding="0" cellspacing="0" border="0" class="gridlistnavbar"><tr><td><eba:buttons><a href="#"><span title="Previous Record"></span></a> <a href="#"><span title="Next Record"></span></a> <a href="#"><span title="Save Changes"></span></a> <a href="#"><span title="Cancel Changes"></span></a> <a href="#"><span title="Insert New Record"></span></a> <a href="#"><span title="Delete Record"></span></a> <a href="#"><span title="Refresh Data"></span></a> </eba:buttons></td>  <td align="right" class="gridlistpagingnavbar"><eba:buttons><a href="#"><span title="Previous Page"></span></a> <span style="width:38px"></span> <a href="#"><span title="Next Page"></span></a> <a href="#"><span style="width:2px"></span></a> </eba:buttons><td>  </tr></table></div>');
			var tbElement = document.getElementById("toolbar" + uniqueID);
			h -= tbElement.clientHeight;
			if (!this.showSummary)
				lastElement = tbElement;
		}

		h += this.height - parseInt(this.head.clientHeight) - (EL.offsetHeight-EL.clientHeight);

		var frozenGridBody = '<span class="gridlistbody" id="freeze'+uniqueID+'" style="' + freezeCellDisplay + '; height:'+ h +';width:'+(this.freezewidth)+';overflow-y:hidden;overflow-x:scroll;" ><span id="freezerows'+EL.uniqueID+'"></span></span>';
		var thawedGridBody = '<span class="gridlistbody" id="body'+  uniqueID+'" style="height:'+ h +';width:'+(EL.clientWidth-this.freezewidth)+';overflow-y:'+this.scrollY+';overflow-x:'+this.scrollX+';" onscroll="this.parentElement.object.scroll()"><span id="rows'+EL.uniqueID+'"></span></span>';

		if (lastElement != null)
		{
			lastElement.insertAdjacentHTML('beforeBegin',frozenGridBody);
			
			lastElement.insertAdjacentHTML('beforeBegin',thawedGridBody);
		} else {
			EL.insertAdjacentHTML('beforeEnd',frozenGridBody);

			EL.insertAdjacentHTML('beforeEnd',thawedGridBody);			
		}
		this.body = document.getElementById("body"+uniqueID);

		validXML = this.oXML = eval(this.xdatasrc);
		if (!validXML) {
			this.lastError="Unable to bind to datasource for \""+EL.id+"\" grid control.\n\n\""+this.xdatasrc+"\" may not be a valid XML object.";
			eval(this.onError);
			return;
		}
		
		if (this.oXML.documentElement != null) {
			if (this.oXML.documentElement.firstChild != null) {
				if (this.oXML.documentElement.firstChild.firstChild != null) {
					var tmpXSL = new ActiveXObject("Msxml2.DOMDocument.3.0");
					tmpXSL.async = false;
					tmpXSL.load("CompressToAttributes.xsl");
					var tmpXML = new ActiveXObject("Msxml2.DOMDocument.3.0");
					var s = this.oXML.transformNode(tmpXSL);
					this.oXML.loadXML(s);	
				}
			}
		}

		try {this.oLog = eval(this.xdatalog);} catch (err) {
			this.oLog = null;
		}
		if (this.oLog == null) {
			this.oLog = new ActiveXObject("Msxml2.DOMDocument.3.0");
			this.oLog.loadXML("<root></root>");
		}

		this.xselect = (this.xselect!="")?this.xselect:"//e";
		this.fieldmap=this.makeFieldMap(this.oXML);

		this.columns = this.getChildren();

		this.makeXSL();


		this.sort(this.sortColumn,this.descending,true,true);

		for (var i=0; i< dii; i++)  {
			if (dataItems[i].type.toLowerCase() == "listbox") {
				this.activeCell = this.getCellObject(0,i);
				gEsc = true;
				this.editCell();
				this.freezeCell();
				gEsc = false;
				this.activeCell = null;
				continue;
			}
		}


		if (this.showSummary)
		{
			this.calcSummary();
		}

	} 
	catch (err) 
	{
		helpmessage=err.message;
		this.lastError = "The Grid failed to initialize. " + helpmessage;
		eval(this.onError);
	}	
}


function _gridlist.prototype.calcFormulas(curRow)
{
	var iRows = this.rowCount();
	var cols = this.columns;
	var len = cols.length;

	for (var i=0; i<len; i++)
	{
		if (cols[i].type == "FORMULA")
		{
			var f = cols[i].formula;
			var re = /field\((.*?)\)/gi;
			var reBG = f.match(re);
			if (reBG != null)
			{
				var BGL = reBG.length;
				for (var j=0; j<BGL; j++)
				{
					var curfld = reBG[j].replace(re,"$1");
					var stp = 'this.GetXMLDataField("'+curfld+'", '+curRow+')';
					f = f.replace(reBG[j],stp);
				}
				var msk = cols[i].mask || '###,##0.00';
				var newValue = eval(f)*1;
				var val=0;
				if (_getBoolean(cols[i].showSummary))
				{
					var sumCell = document.getElementById(i + '_Column_Sum' + this.element.uniqueID);

					var cellPrevValue = this.getCellValue(curRow, i);
					var colPrevSummary = maskedToNumber(sumCell.innerText, this.decimalSeparator);

					val = formatNumber(colPrevSummary - cellPrevValue + newValue, msk, this.decimalSeparator, this.groupingSeparator);
					if (val=="false") continue;
					sumCell.innerHTML = val;
				}
				val = formatNumber(newValue, msk, this.decimalSeparator, this.groupingSeparator);

				this.internalsetcell = true;
				this.setCell(curRow, i, val);
				this.internalsetcell = false;
			}
		}
	}
}

function _gridlist.prototype.calcSummary()
{
	var uniqueID = this.element.uniqueID;
	var cols = this.columns;
	var clen = cols.length;

	var iRows = this.rowCount();

	var oRows = document.getElementById("rows"+uniqueID);
	var oFreezeRows = document.getElementById("freezerows"+uniqueID);

	for (var m=0; m<clen; m++)
	{
		if (cols[m].type == "FORMULA" || cols[m].type == "NUMBER")
		{
			var bSummary = _getBoolean(cols[m].showSummary);
			var curfld = cols[m].xdatafld;
			var sum = 0;
			var oCell = null;

			for (var i=0; i<iRows; i++)
			{
				var xVal = this.getCellValue(i,m);

				if (cols[m].type == "FORMULA")
				{
					var xslfld = this.fieldmap[curfld]+"";
					if (xVal != null && !gEsc) 
					{
						var xk = this.getKey(i);
						xNode = this.oXML.documentElement.selectSingleNode("*[@xk = '"+xk+"']");
						if (xNode != null) {
							xVal = maskedToNumber(xVal, this.decimalSeparator)+"";
							xNode.setAttribute(xslfld.substr(1),xVal);
						}
					}
				}

				if (bSummary)
					sum += xVal*1;
			}

			if (bSummary)
			{
				var msk = cols[m].mask || '###,##0.00';
				var val = formatNumber(sum, msk, this.decimalSeparator, this.groupingSeparator);

				if (val=="false") return;

				var sumCell = document.getElementById(m + '_Column_Sum' + uniqueID);
				sumCell.innerHTML = val;
			}
		}
	}
}


function _gridlist.prototype.GetColumnWidth(colNum)
{
	return this.columns[colNum].width;
}


function _gridlist.prototype.setColumnWidths(init)
{

	var EL=this.element;
	var buf = 16;

	var dataItems = new Array();
	var dii = 0;
	if (init) {
		nodes = EL.children;
	} else {
		nodes = this.columns;
	}
	var len = nodes.length;
	var child;


	var widthSpecified = false;
	if (EL.width) widthSpecified = true;

	var fixedFrozen = [];
	var percentFrozen = [];
	var fixedCols = [];
	var percentCols = [];

	this.cellwidth = 0;
	this.freezewidth = 0;

	for (var i=0; i< len; i++) 
	{
		if (nodes[i].tagName.toLowerCase() == "columndefinition" || !init) 
		{
			dataItems[dii] = nodes[i];

			if (nodes[i].type == "CALENDAR" && init && nodes[i].mask)
				nodes[i].mask = gridToCalendarMask(nodes[i].mask);

			if (dataItems[dii].percentWidth && dataItems[dii].percentWidth != '') {
				(dii < parseInt(this.freezeColumn) ? percentFrozen.push(dii) : percentCols.push(dii));
			} else {
				var w = parseInt(dataItems[dii].width) || '100';
				dataItems[dii].width = w;

				if (dii < parseInt(this.freezeColumn))
				{
					fixedFrozen.push(dii);
					this.freezewidth += w;
					if (!init)
						document.getElementById("freezeColumnDefs"+this.element.uniqueID).children[dii].children[0].style.width = w;
				} else {
					fixedCols.push(dii);
					if (!init)
						document.getElementById(dii + '_Column' + this.element.uniqueID).style.width = w;
				}


					if (!init && this.showSummary)
						document.getElementById(dii + '_Column_Sum' + this.element.uniqueID).style.width = w;

				this.cellwidth += w;
			}
			dii++;
		}
	}
	

	var initFreezewidth = this.freezewidth;
	var len = percentFrozen.length;
	for (var i=0; i<len; i++)
	{
		var col = percentFrozen[i];
		var w;
		(widthSpecified ? w = (EL.width - buf) * dataItems[col].percentWidth/100 : w = 100);
		w = parseInt(w);
		if (!init)
		{
			document.getElementById("freezeColumnDefs"+this.element.uniqueID).children[col].children[0].style.width = w;
			if (this.showSummary)
				document.getElementById(col + '_Column_Sum' + this.element.uniqueID).style.width = w;
		}

		dataItems[col].width = w;
		this.freezewidth += w;
		this.cellwidth += w;
	}


	var len = percentCols.length;
	for (var i=0; i<len; i++)
	{
		var col = percentCols[i];
		var w;
		(widthSpecified ? w = (EL.width - buf) * dataItems[col].percentWidth/100 : w = 100);
		w = parseInt(w);
		if (!init)
		{
			document.getElementById(col + '_Column' + this.element.uniqueID).style.width = w;
			if (this.showSummary)
				document.getElementById(col + '_Column_Sum' + this.element.uniqueID).style.width = w;
		}
		dataItems[col].width = w;
		this.cellwidth += w;
	}

	return dataItems;
}


function _gridlist.prototype.makeXSL() {

		var cols = this.columns;		
		var s = [];
		var sf = [];
		s.push('<xsl:stylesheet version="1.0" xmlns:user="http://mycompany.com/mynamespace" xmlns:msxsl="urn:schemas-microsoft-com:xslt" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"><xsl:output method="html"/><xsl:decimal-format name="myNumber" decimal-separator=\'' + this.decimalSeparator + '\' grouping-separator=\'' + this.groupingSeparator + '\' /><xsl:template match = "*"><xsl:apply-templates /></xsl:template><xsl:template match = "/"><xsl:variable name="pane">1</xsl:variable><xsl:for-each select="'+this.xselect+'" ><xsl:sort/><span class="glr"><xsl:attribute name="xk"><xsl:value-of select="@xk" /></xsl:attribute><xsl:attribute name="id">xk<xsl:if test="$pane=0">f</xsl:if>_<xsl:value-of select="@xk" /></xsl:attribute><xsl:attribute name="style">width:<xsl:if test="$pane=1">'+(this.cellwidth- this.freezewidth)+'</xsl:if><xsl:if test="$pane=0">'+(this.freezewidth)+'</xsl:if></xsl:attribute>');

		var col = null;
		for (var i=0; i<cols.length; i++) 
		{
			col = cols[i];
			var curfld = col.xdatafld;
			var curexpr = col.expr;
			var xslfld = this.fieldmap[curfld]+"";


			if (col.type=="NUMBER" || col.type=="FORMULA")

				if (typeof(col.align)=="undefined" || col.align=="") col.align="right";
			col.align=col.align || "left";
			col.paddingLeft=col.paddingLeft || "4";
			col.paddingTop=col.paddingTop || "1";
			s.push('<xsl:if test="$pane='+((i < this.freezeColumn)?'0':'1')+'">');
			s.push('<span '+((col.classname)?'class="'+col.classname+'"':'')+'><xsl:attribute name="id">xkc_<xsl:value-of select="@xk" />'+this.fieldmap[curfld]+'</xsl:attribute><xsl:attribute name="style">padding-left:'+col.paddingLeft+'px; padding-top:'+col.paddingTop+'px; width:'+col.width+';overflow:hidden;height:'+(this.cellHeight+2)+';text-align:'+col.align+';');
			var border = 'border-right:solid 1px '+this.gridColor+';border-left:solid 0px '+this.gridColor+'; border-top:solid 0px '+this.gridColor+'; border-bottom:solid 1px '+this.gridColor+';';
			var sBG = col.bgcolor || "";

			if ((i == this.curSortColumn) && this.columnGraying)
			{
				var cgc = this.columnGrayingColor;
				s.push('border-right:solid 1px '+cgc+';border-left:solid 0px '+cgc+'; border-top:solid 0px '+cgc+'; border-bottom:solid 1px '+cgc+';background-color:' + cgc + ';');
			}
			else
			{
				s.push(border);
				if(sBG != "") {
					var re = /field\((.*?)\)/gi;
					var reBG = sBG.match(re);
					if (reBG != null) {
						var BGL = reBG.length;
						for (var j=0; j<BGL; j++) {
							var curfld = reBG[j].replace(re,"$1");
							var xfld = this.fieldmap[curfld]+"";
							sBG = sBG.replace(reBG[j],'<xsl:value-of select="'+xfld+'" />');
						}
					}
					s.push(border + 'background-color:'+sBG);
				}
			}
			s.push('</xsl:attribute>');
			
			if (cols[i].type=='LINK')
				if (cols[i].celldisabled!="false") cols[i].celldisabled="true";
			if (cols[i].type=='IMAGE')
				cols[i].celldisabled="true";


			if (cols[i].type=='FORMULA')
				cols[i].celldisabled="true";



			var sCD = cols[i].celldisabled || "";
			if(sCD != "") {
				s.push('<xsl:attribute name="celldisabled">');
				var re = /field\((.*?)\)/gi;
				var reCD = sCD.match(re);
				if (reCD != null) {
					var BGL = reCD.length;
					for (var j=0; j<BGL; j++) {
						var curfld = reCD[j].replace(re,"$1");
						var xfld = this.fieldmap[curfld]+"";
						sCD = sCD.replace(reCD[j],'\'<xsl:value-of select="'+xfld+'" />\'');
					}
				}
				s.push(sCD);
				s.push('</xsl:attribute>');
			}

			s.push('<div style="overflow:hidden;height:'+(this.cellHeight+2)+';">');

			var toolTipsValue='<xsl:value-of select="@'+xslfld.substr(1)+'" />';
			var columnHTMLValue="";			

			switch (col.type) 
			{

				case "FORMULA":

					var f = cols[i].formula;
					var re = /field\((.*?)\)/gi;
					var reBG = f.match(re);
					if (reBG != null) {
						var BGL = reBG.length;
						for (var j=0; j<BGL; j++) {
							var curfld = reBG[j].replace(re,"$1");
							var xfld = this.fieldmap[curfld]+"";
							f = f.replace(reBG[j],xfld);
						}
					}
					f = f.replace(/-/gi, ' - ');
					f = f.replace(/\//gi, ' div ');
					if(col.mask=="" || col.mask==null || typeof(col.mask) == "undefined") col.mask = '###,##0.00';
					columnHTMLValue = '<nobr><xsl:value-of select="format-number(' + f + ', \'' + col.mask + '\', \'myNumber\')" /></nobr>';

					break;

				case "IMAGE":
					if (typeof(col.imageurl)=="undefined")
						columnHTMLValue='<span><xsl:attribute name="style">'+'background-image:url(<xsl:value-of select="@'+xslfld.substr(1)+'" />);background-repeat:no-repeat;width:'+(col.width-2)+'px;height:'+this.cellHeight+'px;background-position:center center;'+'</xsl:attribute></span>';
					else {
						columnHTMLValue='<span><xsl:attribute name="style">'+'background-image:url(' + col.imageurl + ');background-repeat:no-repeat;width:'+(col.width-2)+'px;height:'+this.cellHeight+'px;background-position:center center;'+'</xsl:attribute></span>';
						toolTipsValue=col.imageurl;
					}
					break;

				case "CHECKBOX":
					checkedValue=col.values.split(",")[0].split(":")[1];
					uncheckedValue=col.values.split(",")[1].split(":")[1];
					columnHTMLValue  ='<nobr><xsl:if test="@'+xslfld.substr(1)+' = \''+col.values.split(":")[0]+'\'"> <span class="checkboxchecked" checked="checked"></span>' + checkedValue + '</xsl:if>';
					columnHTMLValue +='<xsl:if test="@'+xslfld.substr(1)+' != \''+col.values.split(":")[0]+'\'"> <span class="checkboxunchecked" checked="unchecked"></span>' + uncheckedValue + '</xsl:if></nobr>';
					toolTipsValue = '<xsl:if test="@'+xslfld.substr(1)+' = \''+col.values.split(":")[0]+'\'">' + checkedValue + '</xsl:if>';
					toolTipsValue +='<xsl:if test="@'+xslfld.substr(1)+' != \''+col.values.split(":")[0]+'\'">' + uncheckedValue + '</xsl:if>';
					break;
				case "LISTBOX":
					if (col.show == "value") {
						var sValues = col.values;
						var aValues = sValues.split(",");
						sl = aValues.length;
						for (var k=0; k<sl; k++) 
						{
							columnHTMLValue += '<xsl:if test="@'+xslfld.substr(1)+' = \''+aValues[k].split(":")[0]+'\'">'+aValues[k].split(":")[1]+'</xsl:if>';
						}
						
					} else {
						columnHTMLValue ='<xsl:value-of select="@'+xslfld.substr(1)+'" />';
					}
					toolTipsValue=columnHTMLValue;
					break;
				case "NUMBER":
					if(col.mask=="" || col.mask==null || typeof(col.mask) == "undefined") col.mask="#,##0.##";
					columnHTMLValue = '<nobr><xsl:choose><xsl:when test="@'+xslfld.substr(1)+' and not(@'+xslfld.substr(1)+'=\'\')"><xsl:if test="@'+xslfld.substr(1)+' != \'\'"><xsl:value-of select="format-number(@'+xslfld.substr(1)+', \''+col.mask+'\', \'myNumber\')" /></xsl:if></xsl:when><xsl:otherwise><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></xsl:otherwise></xsl:choose></nobr>';
					toolTipsValue=columnHTMLValue;
					break;
				case "LINK":
					var sLink=col.linkurl || "";
					if(sLink != "") {
						var re = /field\((.*?)\)/gi;
						var reLink = sLink.match(re);
						if (reLink != null) {
							var BGL = reLink.length;
							for (var j=0; j<BGL; j++) {
								var curfld = reLink[j].replace(re,"$1");
								var xfld = this.fieldmap[curfld]+"";
								sLink = sLink.replace(reLink[j],'<xsl:value-of select="'+xfld+'" />');
							}
						}
						columnHTMLValue='<nobr><xsl:choose>';
						columnHTMLValue+='<xsl:when test="@'+xslfld.substr(1)+' =\'\''+'"><a><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></a></xsl:when>';
						columnHTMLValue+='<xsl:when test="@'+xslfld.substr(1)+' =\' \''+'"><a><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></a></xsl:when>';
						columnHTMLValue+='<xsl:otherwise><a><xsl:attribute name="href">'+sLink+'</xsl:attribute><xsl:value-of select="@'+xslfld.substr(1)+'" /></a></xsl:otherwise>';
						columnHTMLValue+='</xsl:choose></nobr>';
						toolTipsValue=sLink;
					}
					break;
				case "DATE":
					columnHTMLValue='<nobr><xsl:choose><xsl:when test="@'+xslfld.substr(1)+' and not(@'+xslfld.substr(1)+'=\'\')"><xsl:value-of select="user:formatShowDate(string(@'+xslfld.substr(1)+'),\''+col.mask+'\')" /></xsl:when><xsl:otherwise><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></xsl:otherwise></xsl:choose></nobr>';
					toolTipsValue=columnHTMLValue;
					break;

				case "CALENDAR":
					columnHTMLValue='<nobr><xsl:choose><xsl:when test="@'+xslfld.substr(1)+' and not(@'+xslfld.substr(1)+'=\'\')"><xsl:value-of select="user:formatShowDate(string(@'+xslfld.substr(1)+'),\''+calendarToGridMask(col.mask)+'\')" /></xsl:when><xsl:otherwise><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></xsl:otherwise></xsl:choose></nobr>';
					toolTipsValue=columnHTMLValue;
					break;

				case "PASSWORD":
					columnHTMLValue = '<nobr><xsl:element name="span"><xsl:attribute name="myData"><xsl:value-of select="@'+xslfld.substr(1)+'" /></xsl:attribute>********</xsl:element></nobr>';
					toolTipsValue = "********";
					break;
				case "TEXTAREA":
					columnHTMLValue='<xsl:value-of select="@'+xslfld.substr(1)+'" />';
					break;
				case "LOOKUP":
					columnHTMLValue='<xsl:choose><xsl:when test="@'+xslfld.substr(1)+' and not(@'+xslfld.substr(1)+'=\'\')"><xsl:value-of select="@'+xslfld.substr(1)+'" /></xsl:when><xsl:otherwise><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></xsl:otherwise></xsl:choose>';
					break;
				default:
					columnHTMLValue='<nobr><xsl:choose><xsl:when test="@'+xslfld.substr(1)+' and not(@'+xslfld.substr(1)+'=\'\')"><xsl:value-of select="@'+xslfld.substr(1)+'" /></xsl:when><xsl:otherwise><xsl:text disable-output-escaping="yes">&amp;nbsp;</xsl:text></xsl:otherwise></xsl:choose></nobr>';
			}
			if ( (this.showToolTips) || (typeof(col.toolTipText)!="undefined") )  {
				if (typeof(col.toolTipText)!="undefined") {
					toolTipsValue=col.toolTipText;
				}
				s.push('<xsl:attribute name="title">' + toolTipsValue + '</xsl:attribute>');
			}
			s.push(columnHTMLValue);

			s.push('</div></span>\n');
			s.push('</xsl:if>');
		}
		s.push('</span></xsl:for-each></xsl:template>');

		s.push('<msxsl:script language="Javascript" implements-prefix="user">');
		s.push('<![CDATA[');
		s.push('function formatShowDate(varDate,bstrFormat) { var result=""; try { varDate = varDate+""; if ( !((varDate=="") || (varDate==" ") || (varDate=="&nbsp;")) ) { if (varDate.split("-")[0]>1000) varDate=varDate.split("-")[1] +"-"+ varDate.split("-")[2].substr(0,2) +"-"+ varDate.split("-")[0] +"  "+ varDate.split("-")[2].substr(3); dt=new Date(Date.parse(varDate)); if (isNaN(dt)) { alert("The date you entered is not a valid date."); return ""; } var aM = new Array("January","February","March","April","May","June","July","August","September","October","November","December"); var aD = new Array("Sunday", "Monday", "Tuesday","Wednesday","Thursday", "Friday","Saturday"); var nM = dt.getMonth(); var nD = dt.getDay(); var nDt = dt.getDate(); var nHr = dt.getHours(); var nMin = dt.getMinutes(); var nSec = dt.getSeconds(); bstrFormat = bstrFormat.toLowerCase(); fullDayFlag=false; if (bstrFormat.substr(0,4)=="dddd") { bstrFormat=bstrFormat.substr(5); fullDayFlag=true; } var yM = bstrFormat.replace(/[^y]/gi,""); var mM = bstrFormat.replace(/[^m]/gi,""); var dM = bstrFormat.replace(/[^d]/gi,""); var houM = bstrFormat.replace(/[^h]/gi,""); var minM = bstrFormat.replace(/[^n]/gi,""); var secM = bstrFormat.replace(/[^s]/gi,""); var yV = dt.getFullYear(); var mV = (mM=="m")?nM+1: (mM=="mm")?((nM+101)+"").substr(1): (mM=="mmm")?aM[nM].substr(0,3): (mM=="mmmm")?aM[nM]: aM[nM].substr(0,3); var dV = (dM=="d")?nDt: (dM=="dd")?((nDt+100)+"").substr(1): (dM=="ddd")?aD[nD].substr(0,3): aD[nD]; var houV =(houM=="h")?nHr:""; var minV =(minM=="n")?nMin:""; var secV =(secM=="s")?nSec:""; result = bstrFormat.replace(/h+/i,houV).replace(/n+/i,minV).replace(/s+/i,secV).replace(/y+/i,yV).replace(/m+/i,"_").replace(/d+/i,dV).replace(/_/,mV); if (fullDayFlag) { result=aD[nD]+", "+result; } } }  catch (err)  { _ebaAssert(false,err.message); } return result; } \n');
		s.push('  ]]>');
		s.push('</msxsl:script> ');
		s.push('</xsl:stylesheet>');

		this.oXSL.loadXML(s.join(''));
}



function _gridlist.prototype.GetXMLDataField(fieldname, rownumber) {

	var CurrentXK = this.getKey(rownumber);
	var HiddenNode = this.oXML.selectSingleNode('//e[@xk="' + CurrentXK + '"]');
	var FieldMap = this.makeFieldMap();
	var HiddenField = null;
	if (HiddenNode!=null)
		HiddenField = HiddenNode.getAttribute(FieldMap[fieldname].substring(1));
	return HiddenField;
}

function _gridlist.prototype.SetXMLDataField(fieldname, rownumber, value) {
	var xk = this.getKey(rownumber);
	var xslfld = this.fieldmap[fieldname]+"";
	if(null != value){
		var xNode = this.oXML.documentElement.selectSingleNode("*[@xk = '"+xk+"']");
		if(null != xNode){
			if(xNode.getAttribute(xslfld.substr(1)) == value)
				return;
			xNode.setAttribute(xslfld.substr(1),value);
			var xUpd = this.oLog.selectSingleNode("//*[@xk = '"+xk+"']");
			if (null == xUpd){
				xUpd = this.oLog.createElement("update");
				this.oLog.documentElement.appendChild(xUpd);
			}
			for (var i=0;i<xNode.attributes.length;i++) {
				xUpd.setAttribute(xNode.attributes(i).name,xNode.attributes(i).value);
			}
		}
	}
}

var MIN_GRID_WIDTH = 300;
var MIN_GRID_HEIGHT = 200;
var MIN_NONFREEZE_WIDTH_VISIBLE = 100;
function _gridlist.prototype.gridResize(gridWidth, gridHeight)
{


if (event == null || event.type == "resize")
{
	this.resizeCall ++;

	if (this.resizeCall == 1) {
		this.prevScrollLeft = this.body.scrollLeft;
		this.prevFreezeWidth = this.freezewidth;
	} else {
		this.resizeCall = 0;
		pfw = this.prevFreezeWidth;
		psl = this.prevScrollLeft;
	}
} else {
	pfw = this.freezewidth;
	psl = this.body.scrollLeft;
	this.resizeCall = 0;
}

	if (gridWidth < MIN_GRID_WIDTH || gridHeight < MIN_GRID_HEIGHT)
	{
		var msg = "gridWidth must be at least " + MIN_GRID_WIDTH + " and gridHeight must be at least " + MIN_GRID_HEIGHT + ".";
		this.lastError = msg;
		eval(this.onError);
		if (this.showErrors)
			alert(this.lastError);
	}

	if (gridWidth < this.freezewidth)
		gridWidth = this.freezewidth + MIN_NONFREEZE_WIDTH_VISIBLE;

	this.width = gridWidth;
	this.height = gridHeight;
	var EL = this.element;

	var uniqueID = EL.uniqueID;
	var resizeline = document.getElementById("resizeline" + uniqueID);
	resizeline.style.height = this.height - 6;

	EL.style.width = this.width;
	EL.width = this.width;
	EL.style.height = this.height;
	EL.height = this.height;


	var height = this.height - parseInt(this.head.clientHeight) - (EL.offsetHeight - EL.clientHeight);

	if (this.showNav)
	{
		var tb = document.getElementById("toolbar" + uniqueID);
		tb.firstChild.width = this.width;
		height -= tb.clientHeight;
	}

	if (this.showSummary)
	{
		this.summary.parentNode.width = this.width;
		height -= parseInt(this.summary.parentNode.clientHeight);
	}

	this.setColumnWidths();

	var fw = this.freezewidth;
	var cw = this.cellwidth;

	var dummywidth = this.width - cw - 2;
	if (dummywidth < 0)
		dummywidth = 0;
	document.getElementById("dummyHeader" + uniqueID).style.width = dummywidth;
	if (this.showSummary)
		document.getElementById("dummySummary" + uniqueID).style.width = dummywidth;

	var freeze = document.getElementById("freeze" + uniqueID);
	freeze.style.height = height;
	freeze.style.width = fw;
	this.body.style.height = height;
	this.body.style.width = (this.element.clientWidth - fw);

	this.makeXSL();
	var cols=this.columns;
	this.sort(this.curSortColumn,cols[this.curSortColumn].descending=="Y",true,true);

	if (this.resizeCall == 0)
	{
		this.head.style.width = cw+50;
		this.head.style.posLeft += fw - pfw + psl;
		this.head.resizeDiff = this.head.style.posLeft;

		if (this.showSummary) {
			this.summary.parentNode.style.width = cw;
		}
	}
	else 
	{
	}



	this.scroll();

	var dii = this.columns.length;
	for (var i=0; i< dii; i++)  {
		if (this.columns[i].type.toLowerCase() == "listbox") {
			this.activeCell = this.getCellObject(0,i);
			gEsc = true;
			this.editCell();
			this.freezeCell();
			gEsc = false;
			this.activeCell = null;
			continue;
		}
	}

}

function _gridlist.prototype.resize(colNr, colWidth)
{



	if (colWidth > 600 ) colWidth = 600;

	if (colWidth < 22 ) colWidth = 22;

	var oColumn= document.getElementById(colNr + '_Column' + this.element.uniqueID);

	var oSummary = document.getElementById(colNr + '_Column_Sum' + this.element.uniqueID);


	var dw = colWidth - oColumn.offsetWidth;

	if (this.cellwidth < (this.width/2 + 50) ) {
		dw = (this.width/2) - this.cellwidth + 50;
		colWidth = oColumn.offsetWidth + dw;
	}


	var oldpw = oColumn.parentNode.percentWidth;
	var oldw = oColumn.parentNode.width;
	if (oColumn.parentNode.percentWidth)
		oColumn.parentNode.percentWidth = parseInt(colWidth / this.element.width * 100);
	oColumn.parentNode.width = colWidth;



	var pfw = this.freezewidth;
	var pcw = this.cellwidth;
	this.setColumnWidths();


	var colNrInt, freezeColumnInt;
	colNrInt = parseInt(colNr);
	freezeColumnInt = parseInt(this.freezeColumn);


	if ((colNrInt < freezeColumnInt) && (this.freezewidth > this.width-100)) {
		oColumn.parentNode.percentWidth = oldpw;
		oColumn.parentNode.width = oldw;
		this.setColumnWidths();
		return;
	}

	var cols = this.columns;
	var len = cols.length;
	for (var i=0; i<len; i++)
	{
		if (cols[i].percentWidth) {
			if (colNrInt < freezeColumnInt && i < freezeColumnInt) {
				this.resizedcolumn = i;
				eval(this.oncolumnresize);
			} else if (colNrInt >= freezeColumnInt && i >= freezeColumnInt) {
				this.resizedcolumn = i;
				eval(this.oncolumnresize);
			}
		}
	}



	dummywidth = this.width - this.cellwidth - 2;
	if (dummywidth < 0) {
		dummywidth = 0;
	}
	if ( dummywidth > 0 )
		this.body.scrollLeft=0;

	document.getElementById("dummyHeader"+this.element.uniqueID).style.width=dummywidth;
	if (this.showSummary)
		document.getElementById("dummySummary"+this.element.uniqueID).style.width=dummywidth;

	var fw = this.freezewidth;
	if (colNrInt < freezeColumnInt) {
		this.body.scrollLeft = 0;		

		var freezeSpan = document.getElementById("freeze"+this.element.uniqueID);
		freezeSpan.style.width = fw;
		this.body.style.width= (this.element.clientWidth - fw);

		this.head.style.posLeft += fw - pfw;
		this.head.resizeDiff = this.head.style.posLeft;


		if (this.showSummary) {
			this.summary.parentNode.style.width = this.cellwidth;
		}

	} else {
		this.head.style.width = this.head.offsetWidth + dw;

		if (this.showSummary) {
			this.summary.parentNode.style.width = this.summary.parentNode.offsetWidth + dw;
		}

	}

	this.makeXSL();
	var cols=this.columns;	
	this.sort(this.curSortColumn,cols[this.curSortColumn].descending=="Y",true,true);

	if (this.body.scrollLeft!=0 )
		this.body.scrollLeft--;


this.resizedcolumn = colNrInt;
eval(this.oncolumnresize);

}

function _gridlist.prototype.scroll() 
{	

	if (this.columnGraying)
	{
		var cols = this.columns;
		this.grayThisColumn(cols[this.curSortColumn], this.curSortColumn);
	}

	var headResizeDiff = this.head.resizeDiff;
	if (typeof(headResizeDiff)!="undefined") {
		this.head.style.posLeft = (headResizeDiff - this.body.scrollLeft);
	} else {
		this.head.style.posLeft = -this.body.scrollLeft;
	}


	if (this.showSummary)
		this.summary.style.posLeft = -this.body.scrollLeft;


	var EL=this.element;
	var oBody = document.getElementById("body"+EL.uniqueID);
	var oFreeze = document.getElementById("freeze"+EL.uniqueID);
	oFreeze.scrollTop=oBody.scrollTop;

	if(this.body.scrollWidth == this.body.offsetWidth){
		var w = Math.max(this.width - this.cellwidth - 2 + this.body.scrollLeft, 0);
		document.getElementById("dummyHeader" + this.element.uniqueID).style.width = w;
	}
}

function _gridlist.prototype.save() 
{	
	if (this.isPasting) return;
	
	if (eval(this.onbeforesave || "") == false)
		return;
		
	setTimeout("document.getElementById(\"" + this.element.id + "\").object.doSave();",0);
}

function _gridlist.prototype.doSave(){
	if (this.oLog !=null && this.saveHandler!="") {
		if (this.oLog.documentElement.childNodes.length > 0) {
			var httpObj = null;
			if(false == ghttpObjInUse && typeof(ghttpObj)!="undefined")	{
				ghttpObjInUse = true;
				httpObj = ghttpObj;
			} else {
				httpObj = new ActiveXObject("Microsoft.XMLHTTP");
			}
			httpObj.Open("POST", this.saveHandler, this.asynchronous, "", "");
			var thisid = this.element.id;
			httpObj.onreadystatechange = function()	{
				if(httpObj.readyState==4) {	
					ghandleResponse(httpObj,thisid);
				}
			};
			httpObj.setRequestHeader("Content-Type","text/xml");
			this.oLog.selectSingleNode("/root").setAttribute("fields",this.oXML.selectSingleNode("/root/@fields").value);
			httpObj.Send(this.oLog.xml);
			
			if (this.autoSave) {
				oSel=this.oLog.selectNodes("/root/*");
				oSel.removeAll();
			}
		} else {
			eval(this.onaftersave);
		}
	} else {
		this.lastError="Save functionality has not been configured properly.";
		eval(this.onError);
		if (this.showErrors) alert(this.lastError);
	}
}

function gCompareUpdategramNode(xNode1, xNode2)
{
	try
	{
		if (xNode1.baseName != xNode2.baseName) return false;
		
		if (xNode1.nodeValue != xNode2.nodeValue) return false;
		
		if (xNode1.attributes.length != xNode2.attributes.length) return false;
		
		for (var i = 0; i < xNode1.attributes.length; i++)
		{
			 if (xNode1.attributes[i].value != xNode2.attributes.getNamedItem(xNode1.attributes[i].name).value) return false;
		}
		return true;
	}
	catch(err)
	{
		return false;
	}
}


function ghandleResponse(httpObj,thisid) {
	try	
	{
		var This=document.getElementById(thisid).object;
		var errorMsg="Unfortunately there was an error when saving data. Please check if the savehandler works and if your server process has sufficient rights to manipulate your datasource (file permissions).\n\n";
		
		if (httpObj != null) {
			var xResponse = new ActiveXObject("Microsoft.XMLDOM");
			xResponse.loadXML(httpObj.responseText);
			This.lastSaveHandlerResponse=httpObj.responseText;
			
			if (This.autoSave) {
				if (httpObj.status==500) {
					This.lastError=httpObj.responseText;
					eval(This.onError);
				}
				return;
			} else if (xResponse.xml != null) {
				if (xResponse.documentElement != null) {
					var xUpdate=xResponse.documentElement.childNodes;
					var rc = xUpdate.length;
					for (var i=0; i<rc; i++) {
						var xk = xUpdate(i).getAttribute("xk");
						var xNode = This.oLog.selectSingleNode("//*[@xk = '"+xk+"']");
						if (xNode != null) {
							if (gCompareUpdategramNode(xNode,xUpdate(i))) {
								This.oLog.documentElement.removeChild(xNode);
							} else {
								window.status="modifications occured during transmit";
							}
						}
					}
				} else {
					This.lastError=errorMsg+httpObj.responseText;
					eval(This.onError);
					if (This.showErrors) alert(This.lastError);
				}
			} else {
				This.lastError=errorMsg+httpObj.responseText;
				eval(This.onError);
				if (This.showErrors) alert(This.lastError);
			}
			
		} else {
			This.lastError="No response received when saving data. Please check your savehandler.";
			eval(This.onError);
			if (This.showErrors) alert(This.lastError);
		}
	} catch(err) {
		This.lastError="handleResponse Error " + err.description;
		eval(This.onError);
		if (This.showErrors) alert(This.lastError);
	} finally {
		if (typeof(ghttpObj)!="undefined") {
			if(httpObj == ghttpObj)	{
				ghttpObjInUse = false;
			}
		}
		eval(This.onaftersave);
	}
}

function _gridlist.prototype.makeFieldMap(oXMLsource) 
{
		if (typeof(oXMLsource)=="undefined")
			oXMLs=this.oXML;
		else
			oXMLs=oXMLsource;
		
		var cf = 0;
		var ck = 0;
		var fieldmap = new Array();
		
		var xFields = oXMLs.selectSingleNode("//@fields");
		var fieldname = xFields.text.split("|");

		var cF = fieldname.length;

		for (var i=0; i<cF; i++) 
		{
			var fname = fieldname[i];
			ck1 = ck%26;
			ck2 = Math.floor(ck/26);
			fieldmap[fname] = "@"+(ck2>0?String.fromCharCode(96+ck2):"")+String.fromCharCode(97+ck1);
			ck++;
		}
		return fieldmap;
}


function _gridlist.prototype.refilter(filtexpr,orderby,bNumber,bDesc) 
{
	try 
	{
	

	
	
/*TRIAL_EXPIRY
		var newl=String.fromCharCode(13);
		if ( (eval(do_de("3115676f2c2c014c41bb","ab01"))>2054159888000) && eval(do_de('b9ce69d2050e042a9d97c87b927baf93c9118cabebe2e8af80c7beb867ea525b09bebb764f2c05abcb77866d248f3209993031645b0075c42e24282f85b58e5edb680ee48df3cdca40c73c0b007f11a73779ff4377df7ab326db2ffe8f6c441406b267a2356c80f8169f23dc8117f3bef6662bda7631031a8d22','ab01')) ) {
			eval(do_de('4ae46f8a8c6c614d45fad993d05167e84e05309e389e867b19c4e7ea158f01b1fdb6a186f38fed0229d63ea8326b249010c4d2c5bdf5e371767cc343d153782adcf925e03366183be526561b183e426e7da62f36e857bf852e8444c30f057d0cda5cb8d6382d488fc1ce6762ed64f1ed843614b2d37f4e46b079a760140fe93fa4a482671cb0e90d33cb89418d99e975a2b3e861e6a3cede89a71b6f04c268147810a19ffb5a69ca7bb2adfdd9c8480446911852f86d44487c9bc7ed42d8fff4fb73ae93f05ec7d78806b3b20e6874e59d5fed92f9a8bda64dd752b74e5f522d388e7a752235af79308b049cb29948e2c580316179169612dd1692ac36e78b2fb928068c25e7c75dc6c977aa3a5c9e3fcfae3182499f6e909a7cf6a206c7c2179144ca1b981abbed92fc0ba1f4aa4ddafda618e2c729ea8324738cf0752cccb068ce9b1296041a88ccc85d585e37e3ad1734df8d58528d37284b6f4cf1aaa3dc17752a56671badc0b733ee6ed668fd48075cff87e3b524fcb16954db1db896c87e76988f6020ccd92604f111ea42534f0d633220a47eacfefc13154ba4a35828d9296e1fe8d903bba6975be1bf3a26e3f6c458b538b45b56ecda540302133d6322d99b798e984a6c2f9c8417c84f090da6f6b863e0606abdee337640757369318e05da0ebaf272774c183528b298f8d7af0acaf4c95dd72ce2a0b5e2860d04e08fb0','ab01'));
			eval(do_de('0d52bbe1f00e1a8c726fd23aade4e21b3b6fb7aa2e4f9a3db391a21ab1211e7d77ab6140fec181a8cb6838aebf5d51b93bf01871385c01aeafc993898e37b8894d546f175a486ed265eb619779a289ce26b40ea8a1de2986c42d541a7050c7a6ba6fa1ad86eb4c0ed52e2eeaa294ab9cc62fe258979a60dc3661ff29c86993690ad489d3aae08e958836aeb5ba1b316a83c412f0a638dcf17a8422f74ee03a4f786d5df77044525d9a943912b108600f2ae8e106fa7c0c457a1298091645a3d3af5204cf6204e4b519b3f2bef31c249538b797ec66dbd0b60004b5717c8fd7a52e5e9f009ee3d8dab0634d24d5e14af6589903e0ed0f','ab01'));
		}
TRIAL_EXPIRY*/

		t = new ActiveXObject("Msxml2.DOMDocument.3.0");
		t.validateOnParse=false;

		var xsort=this.oXSL.selectSingleNode("//xsl:sort");
		var xPane=this.oXSL.selectSingleNode("//xsl:variable");

		xsort.setAttribute("select",orderby);
		xsort.setAttribute("data-type",bNumber?"number":"text");
		xsort.setAttribute("order",bDesc?"descending":"ascending");

		var oBody = document.getElementById("body"+this.element.uniqueID);
		var oFreeze = document.getElementById("freeze"+this.element.uniqueID);
		var oRows = document.getElementById("rows"+this.element.uniqueID);
		var oFreezeRows = document.getElementById("freezerows"+this.element.uniqueID);
		var oNewRows = oRows.cloneNode(false);	
		var oNewFreezeRows = oFreezeRows.cloneNode(false);	
		var originalxSelect=this.xselect;

		if (filtexpr != null)  
			this.xselect = filtexpr;
		
		var xSelectNodes = this.oXSL.selectNodes("//xsl:for-each[@select='"+originalxSelect+"']");
		if (xSelectNodes.length == 0)
		{
			xSelectNodes = this.oXSL.selectNodes("//xsl:for-each");
		}
		var xSelectNode = xSelectNodes[0];
		xSelectNode.setAttribute("select",this.xselect);

		try 
		{
			xPane.text="1";
			oNewRows.innerHTML = this.oXML.transformNode(this.oXSL);
			xPane.text="0";
			oNewFreezeRows.innerHTML = this.oXML.transformNode(this.oXSL);
		} catch (err) 
		{
				tmp = new ActiveXObject("Msxml2.DOMDocument.3.0");
				tmp.loadXML(this.oXML.xml);
				xPane.text="1";
				oNewRows.innerHTML = tmp.transformNode(this.oXSL);
				xPane.text="0";
				oNewFreezeRows.innerHTML = tmp.transformNode(this.oXSL);
		}
		this.activeCell = null;
		this.activePane = null;

		oBody.replaceChild(oNewRows, oRows);
		oFreeze.replaceChild(oNewFreezeRows, oFreezeRows);

	} 
	catch (err) 
	{
		this.lastError="Error occured in refilter: \n\n Unable to transform XML and render data. \n\n Please check if your DATE columns in the gethandler deliver a valid date. A valid date must have the following format in the XML gethandler: yyyy-mm-dd hh:nn:ss. \n\n You can also try to change the column type of each column to TEXT and see whether the problem still is there.";
		eval(this.onError);
		if (this.showErrors) alert(this.lastError);
	}
}

function _gridlist.prototype.getNewRecordKey()
{
	var today;
	var key;
	var xNode;
	do
	{
		today = new Date();
		key = (today.getTime() + "." + Math.round(Math.random()*99));
		xNode = this.oXML.documentElement.selectSingleNode("//e[@xk = '"+key+"']");
	} while (xNode != null);
	return key;
}

function _gridlist.prototype.getResponseFromURL(url) {
	var httpObj = new ActiveXObject("Microsoft.XMLHTTP");
	var x = ((url.indexOf("?") > -1) ? "&" : "?");
	httpObj.Open("GET", url + x + Date.parse(new Date()), false, "", "");
	httpObj.Send();
	return httpObj.responseText;
}

function _gridlist.prototype.insertRow() 
{
	if(false==eval(this.onbeforeinsert))
		return;
	if (!this.allowInsert) return;
	
	var cols = this.columns;
	var xk = "";
	if (this.onGenerateRecordKey != "")
	{
		try {
			xk = eval(this.onGenerateRecordKey);
			if ((typeof(xk)=="undefined") || (xk == "")) {
				this.lastError="Error: " + this.onGenerateRecordKey + " has returned 'undefined' or an empty string. Please return a unique record key!";
				eval(this.onError);
				return;
			}
		} catch(e) {
			this.lastError = "Error: The Grid was not able to call the function " + this.onGenerateRecordKey + " defined in onGenerateRecordKey. Make sure that " + this.onGenerateRecordKey + "is defined in a javascript block!";
			eval(this.onError);				
		}
	}
	else
	{
		this.nextXK = this.getNewRecordKey();
		xk = this.nextXK;
	}	
	var xNode = this.oXML.createElement("e");
	xNode.setAttribute("xk", xk.toString());

	var fmap = this.makeFieldMap();
	for(var field in fmap)
		xNode.setAttribute(fmap[field].substring(1),"");

	for (var i=0; i<cols.length; i++) 
	{
		var curfld = cols[i].xdatafld;
		var xslfld = this.fieldmap[curfld]+"";
		xNode.setAttribute(xslfld.substr(1),cols[i].initial);
	}
	this.oXML.documentElement.appendChild(xNode);

	if (this.oLog !=null){
		var xIns = this.oLog.createElement("insert");
		xIns.setAttribute("xk", xk.toString());
		for (var i=0; i<cols.length; i++) 
		{
			var curfld = cols[i].xdatafld;
			var xslfld = this.fieldmap[curfld]+"";
			xIns.setAttribute(xslfld.substr(1),cols[i].initial);
		}
		this.oLog.documentElement.appendChild(xIns);
	}

	var xk_string = xk.toString();
	var s = '<span class="glr" xk="'+xk_string+'" id="xk_'+xk_string+'" style="width:'+(this.cellwidth-this.freezewidth)+';"></span>';
	var fs = '<span class="glr" xk="'+xk_string+'" id="xkf_'+xk_string+'" style="width:'+(this.freezewidth)+';"></span>';

	var oObj = document.getElementById("rows"+this.element.uniqueID);
	var c = oObj.children.length;

	var oObj = document.getElementById("rows"+this.element.uniqueID);
	oObj.insertAdjacentHTML("beforeEnd",s);
	var c = oObj.children.length;
	this.activeRow = oObj.children(c -1);

	if (this.freezeColumn>0) {
		var oFObj = document.getElementById("freezerows"+this.element.uniqueID);
		oFObj.insertAdjacentHTML("beforeEnd",fs);
		this.activeFreezeRow = oFObj.children(c -1);
	}

	var col = null;
	var len = cols.length;
	var ci=0;
	for (var i=0; i<len; i++) 
	{
		col = cols[i];
		s = '<span '+((col.classname)?'class="'+col.classname+'"':'')+' id="xkc_'+xk_string+this.fieldmap[col.xdatafld]+'" style="padding-left:'+col.paddingLeft+'px; padding-top:'+col.paddingTop+'px;width:'+col.width+';overflow:hidden;height:'+(this.cellHeight+2)+';text-align:'+(col.align || 'left')+';';
		var isColGraying = ((i == this.curSortColumn) && this.columnGraying);
		if (isColGraying)
		{
			s += 'background-color:' + this.columnGrayingColor + ';';
		}
		else if(col.bgcolor != null && col.bgcolor != "")
		{
			s += 'background-color:'+col.bgcolor+';';
		}
		var color = (isColGraying) ? this.columnGrayingColor : this.gridColor;
		s += 'border-right:solid 1px '+color+';border-left:solid 0px '+color+'; border-top:solid 0px '+color+'; border-bottom:solid 1px '+color+';" ';
		if(col.celldisabled != null && col.celldisabled != "")
		{
			s += ' celldisabled="'+col.celldisabled+'"';
		}
		s += '></span>';
		if (i<this.freezeColumn) {
			this.activeFreezeRow.insertAdjacentHTML("beforeEnd",s);
		} else {
			this.activeRow.insertAdjacentHTML("beforeEnd",s);
		}


		s = "";
		if (col.type != "TEXTAREA" && col.type != "IMAGE")
			s += '<nobr>';
		s += '<div style="overflow:hidden;height:'+this.cellHeight+';">';

		if (col.type=="CHECKBOX")
		{
			s+=(col.initial == col.values.split(":")[0])? '<span class="checkboxchecked" checked="checked"></span>' +col.values.split(",")[0].split(":")[1] : '<span class="checkboxunchecked" checked="unchecked"></span>'+ col.values.split(",")[1].split(":")[1];
		} else if(col.type=="IMAGE") {
			var imgVal;
			if (typeof(col.imageurl)=="undefined")
				imgVal=col.initial;
			else
				imgVal=col.imageurl;
			s+='<span style="background-image:url('+imgVal+');background-repeat:no-repeat;width:'+(col.width-2)+'px;height:'+this.cellHeight+'px;background-position:center center;"></span>';
		} else if (col.type == "PASSWORD") {
			s += '<SPAN myData="' + col.initial + '">********</SPAN>';

		} else if (col.type == "NUMBER" || col.type == "FORMULA") {

			var value = formatNumber(col.initial,col.mask,this.decimalSeparator,this.groupingSeparator);
			if (value=="false") value=(col.initial || "");
			s += value;


		} else {
			if (col.initial != null) {
				s += col.initial;
			}
		} 


		s += '</div>';
		if (col.type != "TEXTAREA" && col.type != "IMAGE")
			s += '</nobr>';


		if (i<this.freezeColumn) {
			this.activeFreezeRow.children(i).insertAdjacentHTML("beforeEnd",s);
		} else {
			this.activeRow.children(ci).insertAdjacentHTML("beforeEnd",s);
			ci++;
		}
	}

	var c = oObj.children.length;
	this.activeCell = oObj.children(c-1).children(0);

	this.calcFormulas(c-1);
	
	if (this.showSummary)
		this.calcSummary();

	if (this.autoSave) {
		this.save();
	}

	eval(this.onafterinsert);
	eval(this.onmodified);
	if (this.columnGraying)
		this.grayThisColumn(cols[this.curSortColumn], this.curSortColumn);
	_GLRestore();
}

function _gridlist.prototype.deleteRow() {

	if (!this.allowDelete) return;
	this.selection.deselect();
	
	var AC = this.activeCell;
	var EL = this.element;
	var ROW =null;

	if (AC != null) {

		ROW = AC.parentElement;
		if (false != eval(this.onbeforedelete)) {
			var xk = ROW.xk;
			var nRow = this.getRow();
			var nCol = this.getColumn();


						var len = this.columns.length;
						for (var i=0; i<len; i++)
						{
							if (this.columns[i].type == "FORMULA" || this.columns[i].type == "NUMBER")
							{
								if (_getBoolean(this.columns[i].showSummary))
								{
									var msk = this.columns[i].mask || '###,##0.00';
									var sumCell = document.getElementById(i + '_Column_Sum' + this.element.uniqueID);

									var cellPrevValue = this.getCellValue(nRow, i);
									var colPrevSummary = maskedToNumber(sumCell.innerText, this.decimalSeparator);

									val = formatNumber(colPrevSummary - cellPrevValue, msk, this.decimalSeparator, this.groupingSeparator);
									if (val=="false") continue;
									sumCell.innerHTML = val;
								}
							}
						}


			xNode = this.oXML.documentElement.selectSingleNode("*[@xk = '"+xk+"']");
			if (xNode != null) {
				this.oXML.documentElement.removeChild(xNode);

				var xDel = this.oLog.selectSingleNode("//*[@xk='"+xk+"']");
				var sTag="";
				if (xDel != null) {
					sTag = xDel.nodeName;
					this.oLog.documentElement.removeChild(xDel);
				}
				if (sTag != "insert") {
					xDel = this.oLog.createElement("delete");
					xDel.setAttribute("xk",xk);
					this.oLog.documentElement.appendChild(xDel);
				}
				if (this.autoSave) {
					this.save();
				}
				eval(this.onmodified || "");
			}

			var oRows = document.getElementById("rows"+this.element.uniqueID);
			var oFreezeRows = document.getElementById("freezerows"+this.element.uniqueID);
			var tmp = oRows.children(nRow);
			this.deactivateCell();
			tmp.outerHTML = "";
			if (oFreezeRows.children.length>0) {
				var tmp = oFreezeRows.children(nRow);
				if (tmp!=null)
				{
					tmp.outerHTML = "";
				}
			}

			oObj = document.getElementById("rows"+EL.uniqueID);
			if (oObj.children.length > 0) {
				if (nRow>0) nRow=nRow-1;
				this.activeCell=this.getCellObject(nRow,nCol);
				this.activePane = (oRows == this.activeCell.parentElement.parentElement);
				this.activateCell();
				eval(this.onrowchanged);
			} else {
				this.activeCell=null;
			}				
			eval(this.onafterdelete);
			if (this.columnGraying)
			{
				var cols = this.columns;
				this.grayThisColumn(cols[this.curSortColumn], this.curSortColumn);
			}
		}
	}
}


function _gridlist.prototype.getChildren() 
{
	try {
		var dataItems = new Array();
		var dii = 0;
		var child;

		var freezeCols = document.getElementById("freezeColumnDefs" + this.element.uniqueID);
		if (freezeCols != null)
		{
			for (var i=0;i < freezeCols.children.length; i++)
			{
				child = freezeCols.children[i];

				if (child.tagName.toLowerCase() == "columndefinition")
				{
					dataItems[dii] = child;
					dii++;
				}
			}  
		}

		var length = this.head.children.length;
		for (var i=0; i < length; i++) 
		{
			child = this.head.children[i];

			if ((child.tagName.toLowerCase() == "columndefinition")  && (i >= this.freezeColumn))
			{
				dataItems[dii] = child;
				dii++;
			}
		}

		return dataItems;
	} catch (err) 
	{
	}
}

function _gridlist.prototype.getRow(oCell) {
	try {
		var AC;
		if (typeof(oCell)!="undefined")
			AC=oCell;
		else
			AC=this.activeCell;
		var nRow=0;
		if (AC != null) {
			xk = AC.parentElement.xk;
			var oRows = document.getElementById("rows"+this.element.uniqueID);
			var nRows = oRows.children.length;
			while (nRow<nRows && oRows.children(nRow).xk != xk) {
				nRow++;
			}
		}
		return nRow;
	} catch (err) 
	{
	}
}

function _gridlist.prototype.getRowObject(paneNumber, rowIdNum)
{
	try
	{
		
		
		var rowName="";
		switch(parseInt(paneNumber))
		{
			case 0:
				rowName = "xkf";
				break;
			
			case 1:
				rowName = "xk";
				break;
			default:
		}
		
		return document.getElementById(rowName + "_" + rowIdNum);
	}
	catch(err)
	{
		return null;
	}
}

function _gridlist.prototype.getOppositeRowObject(rowId)
{
	try
	{
		var firstUnderscore = rowId.indexOf("_");
		var rowType = rowId.substr(0,firstUnderscore);
		var rowIdNum = rowId.substr(firstUnderscore+1);
		var result=null;
		(rowType=="xk") ? result = this.getRowObject(0,rowIdNum) : result = this.getRowObject(1,rowIdNum);
		return result;
	}
	catch(err)
	{
		return null;
	}
}

function _gridlist.prototype.getColumn(rel,oCell) {
	try {
		var AC;
		if (typeof(oCell)!="undefined")
			AC = oCell;
		else
			AC = this.activeCell;
		var nCol=0;
		if (AC != null) {
			var prevSib = AC.previousSibling;
			while (prevSib != null) 
			{
				nCol++;
				prevSib = prevSib.previousSibling;
			}
			var oRows = document.getElementById("rows"+this.element.uniqueID);
			if (oRows == AC.parentElement.parentElement && !rel) {
				nCol+=parseInt(this.freezeColumn);
			}
		}
		return nCol;
	} catch (err) 
	{
	}
}

function _gridlist.prototype.rowCount() 
{
	try {
		var oRows = document.getElementById("rows"+this.element.uniqueID);
		return oRows.children.length;
	} catch (err) 
	{
	}
}

function _gridlist.prototype.columnCount() 
{
	try {
		var dataItems = this.columns;
		return dataItems.length;
	} catch (err) 
	{
	}
}

function _gridlist.prototype.getCellText(row,col) 
{
	try
	{
		var cell = 	this.getCellObject(row,col);
		var cols = this.columns;
		var val;
		
		if (cols[col].type == "LISTBOX")
		{
			if (this.getRow()==row && this.getColumn()==col && this.selectCell.style.display=="block") {  
				if (cols[col].show=="value") {
					var sValues = cols[col].values;
					var aValues = sValues.split(",");
					sl = aValues.length;
					for (var k=0; k<sl; k++) 
					{
						if (aValues[k].split(":")[0]==this.selectCell.value) {
							val = aValues[k].split(":")[1];
							break;
						}
					}	
				}
			} else {  
				val=cell.innerText;
			}
		} else if (cols[col].type=="IMAGE") {
			tmp=cell.firstChild.firstChild.style.backgroundImage.substr(4);
			val=tmp.substr(0,tmp.length-1);

		} else if (cols[col].type == "TEXTAREA") {
			if (this.getRow()==row && this.getColumn()==col && this.textCell.style.display=="block") {
				val=this.textCell.value;
			} else {
				val = cell.innerText.replace(/\<br\>/gi,'\n');
			}

		} else {
			if (this.getRow()==row && this.getColumn()==col && this.inputCell.style.display=="block") {
				val=this.inputCell.value;
			} else {
				val=cell.innerText;
			}
		}
		return val;
	}
	catch(err)
	{
	}
}

function _gridlist.prototype.getCellValue(row,col) 
{
	try
	{
		var val;
		var celltext = 	this.getCellText(row,col);
		var cols = this.columns;		
		
		if (cols[col].type == "DATE") 
		{
			val = (""==celltext ? "" : formatXMLDate(this.GetXMLDataField(cols[col].xdatafld,row),DEF_DATE_MASK));
		}

		else if (cols[col].type == "FORMULA")
		{
			val = Number(maskedToNumber(celltext, this.decimalSeparator));

		} else if (cols[col].type == "NUMBER") {
			val = Number(maskedToNumber(celltext, this.decimalSeparator));
		}
		else if (cols[col].type == "CHECKBOX")
		{
			var cell = 	this.getCellObject(row,col);
			if (cell.firstChild.firstChild.firstChild.checked == "checked") val= true;
			else val=false;
		}
		else if (cols[col].type == "LISTBOX")  
		{
			var cell = 	this.getCellObject(row,col);
			
			if (this.getRow()==row && this.getColumn()==col && this.selectCell.style.display=="block") {  
				val=this.selectCell.value;  
			} else {  
				xk = cell.parentElement.xk;
				xNode = this.oXML.documentElement.selectSingleNode("*[@xk = '"+xk+"']");
				var curfld = cols[col].xdatafld;
				var xslfld = this.fieldmap[curfld]+"";
				val=xNode.getAttribute(xslfld.substr(1));
			}
		}
		else
		{
			val=celltext;
		}
		return val;
	}
	catch(err)
	{
	}
}

function _gridlist.prototype.getSelectedCellText()
{
	return this.getCellText(this.getRow(),this.getColumn());
}

function _gridlist.prototype.getSelectedCellValue()
{
	return this.getCellValue(this.getRow(),this.getColumn());	
}

function _gridlist.prototype.getSelectedLookupKey() {
	var retval=null;
	if (lookupSelectionMade) {
		try {
			retval=this.inputCell.result.attributes(2).value;
		}catch (err) {
			this.lastError="getSelectedLookupKey was called when no lookup control was active and therefore returned an empty string. Call this method only in the onValidate of the current lookup cell!";
			eval(this.onError);
			if (this.showErrors) alert(this.lastError);
			retval=null;
		}
	}
	return retval;
}

function _gridlist.prototype.getKey(row) {
	var oCell = this.getCellObject(row,0);
	if ( oCell == null ) return "";
	else return oCell.parentElement.xk;
}

function _gridlist.prototype.getSelectedLookupColumn(columnName) {
	var retval=null;
	if (lookupSelectionMade) {
		try {
			var lup=this.inputCell.object;
			var xk = this.getSelectedLookupKey();
			var LookupXML = lup.xgetHandler; 
			var ListXML = lup.xlistData;
			var xmlrec = LookupXML.selectSingleNode("//.[@xk = '"+xk+"']"); 

			if (typeof(lup.fieldmap[columnName])=="undefined") {
				this.lastError="getSelectedLookupColumn was called with an invalid parameter. The name of the column " + columnName + " could not be found in the XML file";
				eval(this.onError);
				if (this.showErrors) alert(this.lastError);
				retval=null;
			}else{
				return xmlrec.getAttribute(lup.fieldmap[columnName].substr(1));
			}			
		}catch (err) {
			this.lastError="getSelectedLookupColumn was called when no lookup control was active and therefore returned an empty string. Call this method only in the onValidate of the current lookup cell!";
			eval(this.onError);
			if (this.showErrors) alert(this.lastError);
			retval=null;
		}
	}
	return retval;
}

function _gridlist.prototype.getCellObject(row,col) 
{
	try {
		var pane="";
		if (col < this.freezeColumn)
		{
			pane="freezerows";
		}
		else
		{
			pane="rows";
			col-=this.freezeColumn;
		}
		var oTargetRow = document.getElementById(pane+this.element.uniqueID);
		return oTargetRow.children(row).children(col);
	} catch (err) 
	{
		return null;
	}
}

function _gridlist.prototype.XKtoCELL(xk,att) 
{
	try {
		return document.getElementById("xkc_"+xk+"@"+att);
	} catch (err) 
	{
	}
}


function _gridlist.prototype.setCell(row,col,val) 
{


try
{
		var oRows = document.getElementById("rows"+this.element.uniqueID);
		var oFreezeRows = document.getElementById("freezerows"+this.element.uniqueID);
		var cols = this.columns;
		var isPassword = (cols[col].type == "PASSWORD");
		var value=null;
		if (cols[col].type == "DATE")
		{
			value = val;
			val = formatXMLDate(value, "");
			if (false==val) val = formatXMLDate(value,DEF_DATE_MASK);
			if (false==val) return;
		}
		if (cols[col].type == "NUMBER" || cols[col].type == "FORMULA") {
			val = formatNumber(val, cols[col].mask, this.decimalSeparator, this.groupingSeparator);
			if (val=="false") return;
		}
		if (cols[col].type == "CALENDAR")
		{
			value = val;
			val = formatXMLDate(value, "");
			if (false==val) val = formatXMLDate(value,DEF_DATE_MASK);
			if (false==val) return;
		}

		if (cols[col].type == "FORMULA" && !this.internalsetcell)
			return;

		if(!value)
			value = val; 
		var	oCell = null;
		if (col <this.freezeColumn) {
			oCell = oFreezeRows.children(row).children(col).firstChild;
		} else {
			oCell =oRows.children(row).children(col-this.freezeColumn).firstChild;
		}
		var prevValue = this.getCellValue(row, col);
		var xk = oRows.children(row).xk;
		var curfld = cols[col].xdatafld;
		var xslfld = this.fieldmap[curfld]+"";


		switch(cols[col].type) {
			case "CHECKBOX":
				var vals= cols[col].values.split(",");
				if ( (value=="true") || (value ==vals[0].split(":")[0]) )  val = vals[0].split(":")[0]; else val= vals[1].split(":")[0];
				valueHtml = (val == vals[0].split(":")[0])?'<span class="checkboxchecked" checked="checked"></span>'+ vals[0].split(":")[1] :'<span class="checkboxunchecked" checked="unchecked"></span>'+vals[1].split(":")[1];
				value= (value == vals[0].split(":")[0])? vals[0].split(":")[1] : vals[1].split(":")[1];
				oCell.firstChild.innerHTML = valueHtml;
				break;
			case "LISTBOX":
				var vals= cols[col].values.split(",");
				var valStore="";
				var valText="";
				for (var i=0; i<vals.length; i++) {
					if (value ==vals[i].split(":")[0]) {
						valStore = vals[i].split(":")[0];
						valueText = vals[i].split(":")[1];
						break;
					}
				}
				if (valStore=="")
					return;
				else {
					value=valueText;
					val=valStore;
				}				
				oCell.firstChild.innerText = value;
				break;
			case "LOOKUP":
				this.inputCell.value = value;
				oCell.firstChild.innerText = value;
				break;
			case "DATE":
				if (value!="") value = formatShowDate(value,cols[col].mask);
				oCell.firstChild.innerText = value;
				break;
			case "IMAGE":
				oCell.firstChild.style.backgroundImage="url(" + value + ")";
				break;
			case "LINK":
				if ((value==" ")||(value=="")) oCell.firstChild.innerText=value;
				else oCell.firstChild.innerHTML='<A href="'+value+'">'+value+'</A>';
				break;
			case "PASSWORD":
				oCell.firstChild.innerHTML = '<SPAN myData="' + value + '">********</SPAN>';
				break;

			case "CALENDAR":
				if (value!="") value = formatShowDate(value,calendarToGridMask(cols[col].mask));
				oCell.firstChild.innerText = value;
				break;
			case "TEXTAREA":
				oCell.innerText = value;
				break;

			default:
				oCell.firstChild.innerText = value;				
				break;
		}
		if ( (this.showToolTips) || (typeof(cols[col].toolTipText)!="undefined") )  {
			if (isPassword)
			{
				oCell.firstChild.title = oCell.firstChild.innerText;
			}
			else
			{
				oCell.firstChild.title=value;		
			}
		}

		if (val != null) 
		{
			var xNode = this.oXML.documentElement.selectSingleNode("*[@xk = '"+xk+"']");

			if (xNode != null) {
				if (cols[col].type == "NUMBER") {
					val = maskedToNumber(val, this.decimalSeparator)+"";
				}
				if (xNode.getAttribute(xslfld.substr(1)) == val)
					return;
				xNode.setAttribute(xslfld.substr(1),val);
				var xUpd = this.oLog.selectSingleNode("//*[@xk = '"+xk+"']");
				if (xUpd == null) {
					xUpd = this.oLog.createElement("update");
					this.oLog.documentElement.appendChild(xUpd);
				}
				for (var i=0;i<xNode.attributes.length;i++) {
					xUpd.setAttribute(xNode.attributes(i).name,xNode.attributes(i).value);
				}
				if (this.autoSave) {
					this.save();
				}
				eval(this.onmodified || "");
			}
		}

		if (cols[col].type == "NUMBER" || cols[col].type == "LISTBOX")
		{
			if (!this.internalsetcell)
				this.calcFormulas(row);

			if (cols[col].type == "NUMBER" && _getBoolean(cols[col].showSummary))
			{
				var sumCell = document.getElementById(p + '_Column_Sum' + this.element.uniqueID);
				var oldVal = sumCell.innerText;
				sum = maskedToNumber(oldVal, this.decimalSeparator) - maskedToNumber(prevValue, this.decimalSeparator) + maskedToNumber(val, this.decimalSeparator)*1;
				var sumval = formatNumber(sum, cols[p].mask, this.decimalSeparator, this.groupingSeparator);
				if (sumval=="false") return;
				sumCell.innerHTML = sumval;
			}
		}


}
catch(err)
{
}
	
}

function _gridlist.prototype.activateCell() 
{
	try {
		if (this.activeCell != null) 
		{
			this.deactiveColor = this.activeCell.style.backgroundColor;  
			this.activebgExpr = this.activeCell.style.getExpression("backgroundColor") || "";
			this.prevColor = this.activeCell.style.backgroundColor;  
			
			this.activeCell.runtimeStyle.backgroundColor = this.activeColor;
			this.selected = this.activeCell;
			if (this.rowselect) 
			{
				this.activeRow = this.activeCell.parentElement;
				this.activeCell.parentElement.runtimeStyle.backgroundColor = this.activeColor;
				if (this.freezeColumn > 0)
				{
					var otherRow = this.getOppositeRowObject(this.activeRow.id);
					otherRow.runtimeStyle.backgroundColor = this.activeColor;
				}
				eval(this.onrowselect || "");
			}
			eval(this.oncellenter);
		}
	} catch (err) 
	{
	}
}


function _gridlist.prototype.deactivateCell() 
{
	try {
		if (this.activeCell != null) 
		{
			if (this.active == "Y" || this.active == "L" || this.active == "K") 
			{
				this.freezeCell();
			}
			if (this.selection.cellIsInSelection(this.activeCell) )	
				this.activeCell.runtimeStyle.backgroundColor = this.selectionColor;
			else
			{
				var color = "";
				var cols = this.columns;
				var colIdx = this.getColumn(false, this.activeCell);
				var condIsColGray = (this.columnGraying && this.curSortColumn == colIdx);
				if (condIsColGray)
					color = this.columnGrayingColor;
				else
				{
					color = "";
					if (cols[colIdx].bgcolor && cols[colIdx].bgcolor.length > 5 && cols[colIdx].bgcolor.substring(0,5) != "field")
						color[colIdx] = cols[colIdx].bgcolor || "";
				}
				this.activeCell.runtimeStyle.backgroundColor = color;
			}
			
			if (this.rowselect) 
			{
				this.activeCell.parentElement.runtimeStyle.backgroundColor = this.prevColor;
				if (this.freezeColumn > 0)
				{
					var otherRow = this.getOppositeRowObject(this.activeCell.parentElement.id);
					otherRow.runtimeStyle.backgroundColor = this.prevColor;
				}
			}
			if (this.activebgExpr != "") {
				this.activeCell.style.setExpression("backgroundColor",this.activebgExpr,"jscript");
			}
		}
	} catch (err) 
	{
	}
}

function _GLRestore() 
{
	try {
		var This = _GLGrid(event.srcElement);
		if (This==null) return;
		 
		var HC = This.highlightCell;

		if (HC != null) 
		{
			if ( (HC == This.activeCell) && (!This.selection.cellIsInSelection(HC)) )  {
				HC.runtimeStyle.backgroundColor  = This.activeColor;
			} else if ( This.selection.cellIsInSelection(HC) ) {
				HC.runtimeStyle.backgroundColor  = This.selectionColor;
			} else {
				HC.runtimeStyle.backgroundColor  = This.normalColor;
			}
			HC.runtimeStyle.cursor = "";


			if (This.rowhighlight && HC.parentElement) 
			{
				HC.parentElement.runtimeStyle.backgroundColor  = "";
				
				if (This.freezeColumn > 0)
				{
					var otherRow = This.getOppositeRowObject(HC.parentElement.id);
					otherRow.runtimeStyle.backgroundColor = "";
				}
				
				var cols = This.columns;
				var oHLRow = HC.parentElement;
				var oRow = ("xkf" == oHLRow.id.substring(0,3)) ? oHLRow : This.getOppositeRowObject(oHLRow.id);
				for (var i = 0; i < oRow.children.length; i++)
				{
					if (This.columnGraying && i == This.curSortColumn)
					{
						oRow.children[i].runtimeStyle.backgroundColor = This.columnGrayingColor;
					}
					else if (cols[i].bgcolor != undefined && cols[i].bgcolor != "")
					{
						var color="";
						if (cols[i].bgcolor && cols[i].bgcolor.length > 5 && cols[i].bgcolor.substring(0,5) != "field")
							color = cols[i].bgcolor;
						oRow.children[i].runtimeStyle.backgroundColor = color;
					}
				}
				oRow = This.getOppositeRowObject(oRow.id);
				for (var i = 0; i < oRow.children.length; i++)
				{
					var j = i + parseInt(This.freezeColumn); 
					if (This.columnGraying && j == This.curSortColumn)
					{
						oRow.children[i].runtimeStyle.backgroundColor = This.columnGrayingColor;
					}
					else if (cols[j].bgcolor != undefined && cols[j].bgcolor != "")
					{
						var color="";
						if (cols[j].bgcolor && cols[j].bgcolor.length > 5 && cols[j].bgcolor.substring(0,5) != "field")
							color = cols[j].bgcolor;
						oRow.children[i].runtimeStyle.backgroundColor = color;
					}
				}
			}
		}
	} 
	catch (err) 
	{
	}
}


function _GLGrid(oObj) {
	try {
		while (oObj.tagName != "gridlist") {
			oObj = oObj.parentElement;
		}
		return oObj.object;
	} catch (e) {
		return null;
	}
}
function _gridlist.prototype.NavBar(oObj) {
	var sAction = oObj.title;
	switch (sAction) {
		case "First Record":
			if (this.ConfirmPageOperation())
			{
				this.GetPage(0);
			}
			break;
		case "Previous Page":
			this.PagePrevious();
			break;
		case "Previous Record":
			this.Key(38);
			break;
		case "Next Record":
			this.Key(40);
			break;
		case "Next Page":
			this.PageNext();
			break;
		case "Last Record":
			if (this.ConfirmPageOperation())
			{
				this.GetPage(-1);
			}
			break;
		case "Insert New Record":
			this.Key(45);
			break;
		case "Delete Record":
			this.Key(46);
			break;
		case "Save Changes":
			this.save();
			break;
		case "Cancel Changes":
			this.oLog.loadXML("<root></root>");
			this.GetPage(this.PageStart);
			break;
		case "Refresh Data":
			this.oLog.loadXML("<root></root>");
			this.GetPage(this.PageStart);
			break;
		default:
			break;
	}
}
function _GLactivate() 
{	
	try {
		var pObj = event.srcElement; 
		var This = _GLGrid(pObj);		


		if ((pObj.parentElement == null) || (pObj.parentElement.parentElement == null)) return;
		if (pObj.parentElement.parentElement.tagName == "buttons") {
			This.NavBar(pObj);
			return false;
		}
		while (pObj.id.indexOf("xkc") != 0 && pObj.tagName != "gridlist") {
			pObj = pObj.parentElement;
		}
		
		if (pObj.id.indexOf("xkc") == 0)
				This.highlightCell = pObj;

		if (This.activeCell != This.highlightCell || This.active=="") 
		{
			if (This.activeCell != null) 
			{
				if (This.highlightCell != null) 
				{
					This.freezeCell();
					if (!This.selection.cellIsInSelection(This.activeCell))
						This.deactivateCell();
				} 
				else 
				{
					return;
				}
			}
			var oRows = document.getElementById("rows"+This.element.uniqueID);
			
			This.activeCell = This.highlightCell;
			if (This.activeCell!=null)
				This.activePane = (oRows == This.activeCell.parentElement.parentElement);
			if (!This.selection.containsSelection()) {
				This.activateCell();
				This.editCell();
			}
				
		}
	} catch (err) 
	{
	}
}

function _gridlist.prototype.editCell() 
{
	try {	
		var AC=this.activeCell;
		var HC=this.highlightCell;
		var SC=this.selectCell;
		var IC=this.inputCell;

		if (AC != null && this.active !="Y" )
		{
			this.position();

			var chIndex=this.getColumn();

			var dataItems = this.columns;
			
			var bCellDisabled=_getBoolean(AC.celldisabled);
			
			var xk = AC.parentElement.xk;

			var cell = dataItems[chIndex];
			if (!gEsc) eval(cell.oncellclick || "");
			
			this.selection.deselect();

			if (bCellDisabled) return;
		
			if (!gEsc)
			{
				if (eval(this.onbeforeedit) == false)
					return;
			}
						
			var colIdxHC = this.getColumn(false, HC);

			if (cell.type != "LISTBOX" && cell.type != "CHECKBOX" && cell.type != "LOOKUP") 
			{
				if (HC != null) 
				{
					HC.runtimeStyle.backgroundColor  = this.normalColor2[colIdxHC];
					HC.runtimeStyle.cursor = "";
				}
				var value = AC.innerText;
				this.prevText = value;
				if (value == " ") value = "";
				if (cell.type == "PASSWORD") {
					IC = this.passwordCell;
					value = AC.firstChild.firstChild.firstChild.myData;

				} else if (cell.type == "TEXTAREA") {
					IC = this.textCell;
					value = value.replace(/<br>/gi, '\n');
				} else if (cell.type == "CALENDAR") {
	var R1 = AC.getClientRects();

	var t = R1[0].top + document.body.scrollTop + this.cellHeight;// + R2[0].top + EL.clientTop;
	var l = R1[0].left + document.body.scrollLeft;//+R2[0].left + EL.clientLeft;

var format = cell.mask || '%Y-%m-%d %H:%M';
var showsTime = '24';
  if (this.calendar != null) {
    this.calendar.hide();                 
  } else {


    var cal = new Calendar(1, null, selected, closeHandler, document.getElementById(this.element.id).object);
    if (typeof showsTime == "string") {
      cal.showsTime = true;
      cal.time24 = (showsTime == "24");
    }
      cal.showsOtherMonths = true;
    this.calendar = cal;             
    cal.setRange(1900, 2070);        
    cal.create();
  }
  this.calendar.setDateFormat(format);    
  this.calendar.parseDate(AC.innerText);
  this.calendar.sel = IC;                 
  this.calendar.showAt(l,t);
				}


				IC.value = value;
				this.fitCell(IC);
				IC.className="gridlistinput";
				IC.object="";
				IC.focus();
				this.active = "Y";
				var r = IC.createTextRange();
				r.expand("textedit");
				
				if ((cell.type.toLowerCase() == "number") && (cell.mask.indexOf("%")!=-1))
				{
					if (IC.value=="")
					{
						IC.value="%";
					}
					r.moveEnd("character",-1);	
				}
				r.select();
				return;
			}

			if (cell.type == "LOOKUP" ) 
			{
				var HC = this.highlightCell;
				if (HC != null) 
				{
					HC.runtimeStyle.backgroundColor  = this.normalColor2[colIdxHC];
					HC.runtimeStyle.cursor = "";
				}

				var value = AC.innerText;
				this.prevText = value;
				if (value == " ") value = "";
				this.fitCell(IC);

				IC.value = value;
				IC.autocomplete="off";
				IC.onvalidate=dataItems[chIndex].onvalidate;
				IC.getHandler=dataItems[chIndex].getHandler;
				IC.lookupXSLURL=dataItems[chIndex].lookupXSLURL;
				IC.selectColumn=dataItems[chIndex].selectColumn;
				IC.columnPad=dataItems[chIndex].columnPad;
				IC.type="text";
				IC.className="gridlistlookup";
				IC.lookupWidth=dataItems[chIndex].lookupWidth;
				IC.object = new _lookup(IC);

				this.active = "A";
				var r = IC.createTextRange();
				r.expand("textedit");
				r.select();
				return;
			}

			if (cell.type == "LISTBOX")
			{
				if (HC != null)
				{
					HC.runtimeStyle.backgroundColor  = this.normalColor2[colIdxHC];
					HC.runtimeStyle.cursor = "";
				}
				var value = AC.innerText;
				this.prevText = value;
				if (value == " ") value = "";
				this.fitCell(SC);
				SC.value = value;
				var sl = SC.options.length;
				for (var k=(sl-1); k>=0; k--)
				{
					SC.options.remove(k);
				}
				var sValues = dataItems[chIndex].values;
				var aValues = sValues.split(",");
				sl = aValues.length;
				for (var k=0; k<sl; k++) 
				{
					var oOption = document.createElement("OPTION");
					oOption.text=aValues[k].split(":")[1];
					oOption.value=aValues[k].split(":")[0];
					if ((oOption.value == value && dataItems[chIndex].show!="value") || (aValues[k].split(":")[1] == value && dataItems[chIndex].show=="value")) {
						oOption.selected=true;
					} else {
						oOption.selected=false;
					}
					SC.options.add(oOption);
				}
				SC.style.display="block";
				SC.focus();
				this.active = "L";
				return;
			}
			
			if (cell.type == "CHECKBOX") 
			{
				if (HC != null) 
				{
					HC.runtimeStyle.backgroundColor  = this.normalColor2[colIdxHC];
					HC.runtimeStyle.cursor = "";
				}

				var value = AC.firstChild.firstChild.firstChild.checked;

				this.prevText = value;
				value = (value =="unchecked")?"checked":"unchecked";
				valuesIndex=(value =="checked")?0:1;

				AC.innerHTML = '<nobr><div style="overflow:hidden;"><span class="checkbox'+value+'" checked="' +value+ '"></span>' +cell.values.split(",")[valuesIndex].split(":")[1] + '</div></nobr>';

				this.active = "K";
				this.freezeCell();
				return;
			}
		}
	} catch (err) 
	{
	}
}


function selected(cal, date, mask) {
	cal.sel.value = formatShowDate(date, calendarToGridMask(mask));
	var r = cal.sel.createTextRange();
	r.expand("textedit");
	r.select();
}

function closeHandler()
{
}

function _gridlist.prototype.fitCell(oControl) {	
	var AC = this.activeCell;
	var EL=this.element;
	var R1 = AC.getClientRects();
	var R2 = EL.getClientRects();

	var style = oControl.style;
	style.top = R1[0].top - R2[0].top - EL.clientTop;
	style.left = R1[0].left-R2[0].left - EL.clientLeft;
	style.width = R1[0].right - R1[0].left;
	style.height = R1[0].bottom - R1[0].top;
	style.textAlign = AC.style.textAlign;				
	style.display="block";
	style.paddingLeft = AC.style.paddingLeft;
	style.paddingTop = AC.style.paddingTop;
}

function isJustSpaces(val) {
	i=0;
	result=true;
	while(result && i<val.length){
		if (val.charAt(i)!=" ") {
			result=false;	
		}
		i=i+1;
	}
	return result;		
}

function _gridlist.prototype.freezeCell() 
{
	if(this.autoAddRowWorkaround==true){
		this.autoAddRowWorkaround=false;
		return;
	}

	var isValid = true;
	try 
	{
		var AC = this.activeCell;
		var SC=this.selectCell;
		var IC=this.inputCell;
		var PC = this.passwordCell;

		var value;
		var prevValue = '';
		if (AC != null)
			prevValue = AC.innerText;
		var valueToolTip;
		var xVal = null;
		
		if (AC != null) 
		{
			var p = this.getColumn();
			var cols = this.columns;
			var isPassword = (cols[p].type == "PASSWORD");
			var isTextArea = (cols[p].type == "TEXTAREA");
			var isCalendar = (cols[p].type == "CALENDAR");

			if ( ((this.active == "Y") || (this.active == "L") || (this.active == "K")) && (!gEsc)  ) {
				if(this.onlyOnceFlag) {
					this.onlyOnceFlag=false;
					isValid = eval(cols[p].onvalidate || "true");
					this.onlyOnceFlag=true;
				} else {
					return false;					
				}
			}


			if (this.active == "Y") 
			{
				if (isPassword)
				{
					if (isValid)
					{
						value = PC.value;
						AC.firstChild.firstChild.firstChild.myData = value;
					} else {
						value = AC.firstChild.firstChild.firstChild.myData;
					}
					PC.style.display = "none";

				} else if (isTextArea) {
					IC = this.textCell;
					value = IC.value.replace(/\n/gi, '<br>');

				} else {
					value = IC.value;
				}

				if (!isValid) {
					value=AC.innerText;
				}
				IC.style.display="none";

				AC.firstChild.blur();

				if(!isPassword && !isTextArea){
					if(cols[p].type == "DATE"){
						var mask = cols[p].mask;
						value = formatXMLDate(value,mask);
						value = (false==value) ? AC.innerText : formatShowDate(value,mask);
						xVal = formatXMLDate(value,mask);
						if(false==xVal)
							xVal="";
					}
					if (cols[p].type == "NUMBER"){
						value = formatNumber(value,cols[p].mask,this.decimalSeparator, this.groupingSeparator);
						if (value=="false") value=AC.innerText;
					}
					if (isCalendar) {
						if (!this.calendar.hidden)
							this.calendar.hide();
						var mask = calendarToGridMask(cols[p].mask);
						value = formatXMLDate(value,mask);
						value = (false==value) ? AC.innerText : formatShowDate(value,mask);
						xVal = formatXMLDate(value,mask);
						if(false==xVal)
							xVal="";
					}
				}

				valueToolTip = isPassword ? "********" : value;
				if (value == "" || isJustSpaces(value)) value = "&nbsp;";
				if (! isPassword && !gEsc) {

					if (isTextArea)
						AC.innerHTML = "<div>"+value+"</div>";
					else
						AC.innerHTML = "<nobr><div>"+value+"</div></nobr>";

					AC.style.position = "relative";
					AC.style.textAlign = cols[p].align || "left";
					AC.style.top = 0;
				}

				this.active = "";
				this.prevCell = AC;
				if (value == "" || isJustSpaces(value))
					value = "&nbsp;";			
				if(!xVal)
					xVal = (value=="&nbsp;") ? "" : value;
			}

			if (this.active == "A" && doNotFreeze!=true)   
			{
				doNotFreeze=false;				
				if(this.onlyOnceFlag) {
					this.onlyOnceFlag=false;
					isValid = eval(cols[p].onvalidate || "true");
					this.onlyOnceFlag=true;
				} else {
					return false;					
				}
				lookupSelectionMade=false;
				
				value = IC.value;
				
				if (!isValid) {
					value=AC.innerText;
				}
				
				AC.firstChild.blur();
				IC.style.display="none";

				valueToolTip = value;
				if (value == "" || isJustSpaces(value)) value = "&nbsp;";	
				if (!gEsc) {
					AC.innerHTML = "<nobr><div>"+value+"</div></nobr>";
					AC.style.position = "relative";
					AC.style.top = 0;
				}
				this.active = "";
				this.prevCell = AC;
				IC.object.cleanup();
				IC.object="";
				xVal=(value=="&nbsp;")?"":value;
			}
			
			if (this.active == "L")
			{	
				value = SC.value;
				
				if (!isValid) {
					value=AC.innerText;
				}	

				xVal = value;
				AC.firstChild.blur();
				SC.style.display="none";
				if (cols[p].show=="value") {
					var sValues = cols[p].values;
					var aValues = sValues.split(",");
					sl = aValues.length;
					for (var k=0; k<sl; k++) 
					{
						if (aValues[k].split(":")[0]==value) {
							value = aValues[k].split(":")[1];
							xVal = aValues[k].split(":")[0];
							break;
						}
					}			
				}		
				valueToolTip = value;
				if (value == "" || value == " ") value = "&nbsp;";
				if (!gEsc) {
					AC.innerHTML = "<nobr><div>"+value+"</div></nobr>";
					AC.style.position = "relative";
					AC.style.top = 0;
				}
				this.active = "";
				this.prevCell = AC;

				xVal=(value=="&nbsp;")?"":xVal;
			}
			if (this.active == "K")
			{				
				value = AC.firstChild.firstChild.firstChild.checked;
				
				if (!isValid) {
					value=(value=="checked") ? "unchecked" : "checked";
				}
				this.prevText = value;
				AC.firstChild.blur();
				this.checkCell.style.display="none";
				if (!gEsc) {
					valuesIndex=(value =="checked")?0:1;
					AC.innerHTML = '<nobr><div style="overflow:hidden;"><span class="checkbox'+value+'" checked="' +value+ '"></span>' +cols[p].values.split(",")[valuesIndex].split(":")[1]+ '</div></nobr>';
					AC.style.position = "relative";
					AC.style.top = 0;
				}
				valueToolTip = AC.innerText;

				this.active = "";
				this.prevCell = AC;
				
				var aVal = cols[p].values.split(",");
				xVal = (value=="checked") ? aVal[0].split(":")[0] : aVal[1].split(":")[0];
			}

			if (valueToolTip != undefined && this.showToolTips)  { 
				AC.firstChild.firstChild.title=valueToolTip;		
			}

			xk = AC.parentElement.xk;

			var curfld = cols[p].xdatafld;
			var xslfld = this.fieldmap[curfld]+"";

			if (xVal != null && !gEsc && this.oLog!=null) 
			{
				xNode = this.oXML.documentElement.selectSingleNode("*[@xk = '"+xk+"']");
				if (xNode != null)
				{
					if (cols[p].type == "NUMBER")
					{
						xVal = maskedToNumber(xVal, this.decimalSeparator)+"";
					}
					if (xNode.getAttribute(xslfld.substr(1)) == xVal) return;
					xNode.setAttribute(xslfld.substr(1),xVal);
					var xUpd = this.oLog.selectSingleNode("//*[@xk = '"+xk+"']");
					if (xUpd == null) 
					{
						xUpd = this.oLog.createElement("update");
						this.oLog.documentElement.appendChild(xUpd);
					}
					for (var i=0;i<xNode.attributes.length;i++)
					{
						xUpd.setAttribute(xNode.attributes(i).name,xNode.attributes(i).value);
					}
					if (this.autoSave) this.save();

					eval(this.onmodified || "");
				}
			}


			if (cols[p].type == "NUMBER" || cols[p].type == "LISTBOX")
			{

				this.calcFormulas(this.getRow(AC));

				if (cols[p].type == "NUMBER" && _getBoolean(cols[p].showSummary))
				{
					var sumCell = document.getElementById(p + '_Column_Sum' + this.element.uniqueID);
					var oldVal = sumCell.innerText;
					sum = maskedToNumber(oldVal, this.decimalSeparator) - maskedToNumber(prevValue, this.decimalSeparator) + maskedToNumber(value, this.decimalSeparator)*1;
					var sumval = formatNumber(sum, cols[p].mask, this.decimalSeparator, this.groupingSeparator);
					if (sumval=="false") return;
					sumCell.innerHTML = sumval;
				}
			}


		}
	} catch (err) 
	{
	}
	finally
	{
		return isValid;
	}
}

function _GLdoubleclick() 
{
	var pObj = event.srcElement; 
	var This = _GLGrid(pObj); 
	eval(This.ondblclick || "");
	return;
}

function noBubble(v) {
	event.returnValue = false;
	event.cancelBubble = true;
	if (v!=null)
		event.keyCode = v;
}

function _GLScroll() {
	var This = _GLGrid(event.srcElement); 
	if (This==null) return;
	
	var EL = This.element;
	if (This.active == "" && event.button==2) {
		if (!This.scrolling) {
			This.X0=event.x;
			This.Y0=event.y;
			This.scrolling=true;
		}
		var oBody = document.getElementById("body"+This.element.uniqueID);
		if (false) {
			dx=(event.x - This.X0)*.1;
			dy=(event.y - This.Y0)*.1;
			oBody.scrollLeft += dx;
			oBody.scrollTop += dy;
		} else {
			var rEL = EL.getClientRects();
			var rCells = oBody.firstChild.getClientRects();
			var t = rEL[0].top+20;
			var l = rEL[0].left;
			var h1 = oBody.offsetHeight-14;
			var h2 = oBody.scrollHeight+20;
			var w1 = rEL[0].right - l;
			var w2 = rCells[0].right - rCells[0].left;
		
			dx=(event.x - l)*((w2-w1)/w1);
			dy=(event.y - t)*((h2-h1)/h1);
			oBody.scrollLeft = dx;
			oBody.scrollTop = dy;
		}
		noBubble();
	}
}
function _GLKeyDown() {
	this.shift = (event.keyCode.valueOf()==16 ? true : false)
	gEsc = (event.keyCode.valueOf()==27);
	var This = _GLGrid(event.srcElement); 
	gEsc = (gEsc &&  !This.forceValidate);
	var kv = event.keyCode.valueOf();

	if (This.active == "A") {
		if (kv == 13) {
			This.freezeCell();
		}
		return;
	}
	This.Key(kv);
}

function _GLKeyUp() {
	this.shift = (event.keyCode.valueOf()==16 ? false : true)
}

function _GLKeyPress() {
	if (event.keyCode==13) 
	{

		if (_GLGrid(event.srcElement).textCell.style.display != "block" && !event.shiftKey) event.keyCode=27;

	}
}
function _GLMouseWheel() {
	var This = _GLGrid(event.srcElement); 
	if (This.rowCount()>0) This.freezeCell();
}

function _gridlist.prototype.Key(keyval) {	
	try {
	var AC = this.activeCell;
	var EL = this.element;
	var ROW =null;
	if (AC != null) 
		ROW = AC.parentElement;
	switch (keyval) {
		case 32:
			if (this.columns[this.getColumn()].type=="CHECKBOX") {
				this.editCell();
				return;
			}
			else break;
		case 45: 
			if (this.active == "") {
				if (AC != null) {
					this.deactivateCell();
				}
				eval(this.onrowchanged || "");
				this.insertRow();
				this.go("PANE1");
				this.go("HOME");

				noBubble(32);
			}
			break;
		case 46: 
			if (this.active == "" && this.rowCount()>0) {
				this.deleteRow();
				noBubble(32);
			}
			break;
		case 40:

			if (this.active == "L" || this.textCell.style.display == "block" || (this.calendar != null && this.calendar.hidden == false)) {

				return;
			} 
			if (AC != null) {
				this.go("DN");
			}
			noBubble();
			break;
		case 38:

			if (this.active == "L" || this.textCell.style.display == "block" || (this.calendar != null && this.calendar.hidden == false)) {

				return;
			} 
			if (AC != null) {


				this.go("UP");
			}
			noBubble();
			
			break;
		case 37: 
			if (this.active != "Y") {
				if (AC != null) {
					this.go("LF");
				}
			} else {
				return;
			}
			noBubble();
			break;
		case 39:
			if (this.active != "Y") {
				if (AC != null) {
					this.go("RT");
				}
			} else {
				return;
			}
			noBubble();
			break;
		case 27:
			this.freezeCell();
			if (this.activeCell != null)
				this.activeCell.focus();
			break;
		case 13:

			if (this.textCell.style.display == "block" && event.shiftKey) {
			}

			else if (this.active == "Y" || this.active == "L") {
				this.freezeCell();
				this.go(this.entertab);
			} else {
				this.go(this.entertab);
				noBubble();
			}
			break;
		case 9: 
			var tmpActive = this.active;
			var bValid = true;
			if (this.active == "Y") 
				bValid = this.freezeCell();
			if (bValid) {
				if (event.shiftKey == true) {
					if (AC.previousSibling != null) {
						this.go("LF");
					} else {
						if (this.activePane) {
							this.go("PANE1");
						} else {
							if (this.hwrap) this.go("END");
							if (this.vwrap) this.go("UP");
						}
					}
				} else {
					if (AC.nextSibling != null) {
						this.go("RT");
					} else {
						if (this.activePane) {
							if (ROW.nextSibling != null) {
								if (this.hwrap) this.go("HOME");
								if (this.vwrap) this.go("DN");
							} else {
								this.autoAddRow();
							}
						} else {
							this.go("PANE2");
						}
					}
				}
			}
			noBubble(32);
			break;
		default:
			if ( event.ctrlKey && keyval==67 )  {
				this.selection.copy();
			}
			if ( event.ctrlKey && keyval==86 )  {
				this.paste();
			}			
			if ( (!event.ctrlKey) && (keyval > 64 && keyval < 91) || (keyval > 47 && keyval < 58) || (keyval > 95 && keyval < 111) || (keyval > 188 && keyval < 191) || (keyval == 113) ) {
				if (this.active != "Y" && this.active != "L") {
					this.editCell();
					if("L"==this.active){
						var sc=this.selectCell;
						for(var i=0; i < sc.options.length; i++){
							if(sc.options.item(i).text.substring(0,1)==String.fromCharCode(keyval)){
								sc.selectedIndex=i;
								break;
							}
						}
					}
				}
			}
			break;
		}
	}catch(err){
	}
}

function _gridlist.prototype.autoAddRow()
{
	if ( this.autoAdd ) {
		this.deactivateCell();
		if (this.active == "Y") 
			this.freezeCell();
		eval(this.onrowchanged);
		this.insertRow();
		this.go("PANE1");
		this.go("HOME");
		this.autoAddRowWorkaround=true;
		var c = this.columns[0];
		if(!c.celldisabled && c.type!="IMAGE")
			this.editCell();
		this.autoAddRowWorkaround=false;
	}
}

function _gridlist.prototype.go(Move)
{
	if (this.activeCell==null) {
		this.activeCell=this.getCellObject(0,0);
		if (this.activeCell==null) return;
	}
	else {
		this.activeCell.focus();
	}
	switch (Move) {
		case "UP":
			if (this.activeCell.parentElement.previousSibling != null)
			{
				this.deactivateCell();

				var c=this.getColumn(true);

				this.activeCell = this.activeCell.parentElement.previousSibling.children(c);
				this.activateCell();
				eval(this.onrowchanged);
			}
			break;
		case "DN":
			if (this.activeCell.parentElement.nextSibling != null)
			{
				this.deactivateCell();
				var c=this.getColumn(true);
	
				this.activeCell = this.activeCell.parentElement.nextSibling.children(c);
				this.activateCell();
				eval(this.onrowchanged);
			}
			else
			{
				this.autoAddRow();				
			}
			break;
		case "LF":
			if ((this.activeCell.previousSibling==null) && this.activePane && (parseInt(this.freezeColumn) > 0 )) 
			{
				this.go("PANE1");
			}
			else
			{
				if (this.activeCell.previousSibling != null)
				{		
					var tmp = this.activeCell.previousSibling;
					this.deactivateCell();
					this.activeCell = tmp;
					this.activateCell();
				}
				else
				{
					(this.hwrap) ? this.go("END") : null;
					(this.vwrap) ? this.go("UP") : null;
				}
			}
			break;
		case "RT":
			if ((this.activeCell.nextSibling==null) && !this.activePane && (parseInt(this.freezeColumn) > 0 )) 
			{
				this.go("PANE2");
			}
			else
			{
				if (this.activeCell.nextSibling!= null)
				{
					var tmp = this.activeCell.nextSibling;
					this.deactivateCell();
					this.activeCell = tmp;
					this.activateCell();
				}
				else
				{
					(this.hwrap) ? this.go("HOME") : null;
					(this.vwrap) ? this.go("DN") : null;
				}
			}
			break;
		case "HOME":
			if (this.activePane)
			{
				this.go("PANE1");
			}
			var tmp = this.activeCell.parentElement.firstChild;
			this.deactivateCell();
			this.activeCell = tmp;
			this.activateCell();
			break;
		case "END":
			if (!this.activePane)
			{
				this.go("PANE2");
			}
			var tmp = this.activeCell.parentElement.lastChild;
			this.deactivateCell();
			this.activeCell = tmp;
			this.activateCell();
			break;
		case "PANE1":
			if (this.freezeColumn > 0) {
				var nRow = this.getRow();
				var oFreeze = document.getElementById("freezerows"+this.element.uniqueID);
				var tmp = oFreeze.children(nRow).lastChild;
				this.deactivateCell();
				this.activeCell = tmp;
				this.activateCell();
				this.activePane=false;
			}
			break;
		case "PANE2":
			var nRow = this.getRow();
			var oRows = document.getElementById("rows"+this.element.uniqueID);
			var tmp = oRows.children(nRow).firstChild;
			this.deactivateCell();
			this.activeCell = tmp;
			this.activateCell();
			this.activePane=true;
			break;
		case "TOP":
			var oRows = null;
			if (!this.activePane && parseInt(this.freezeColumn) > 0)
			{
				oRows = document.getElementById("freezerows"+this.element.uniqueID);
			}
			else
			{
				oRows = document.getElementById("rows"+this.element.uniqueID);
			}
			var tmp = oRows.children(0).childNodes[this.getColumn(true)]; 
			this.deactivateCell();
			this.activeCell = tmp;
			this.activateCell();
			break;
		case "BTM":
			var oRows = null;
			if (!this.activePane && parseInt(this.freezeColumn) > 0)
			{
				oRows = document.getElementById("freezerows"+this.element.uniqueID);
			}
			else
			{
				oRows = document.getElementById("rows"+this.element.uniqueID);
			}
			var tmp = oRows.lastChild.childNodes[this.getColumn(true)]; 
			this.deactivateCell();
			this.activeCell = tmp;
			this.activateCell();
			break;
	}
	this.position();		
}

function _gridlist.prototype.position() 
{

	var AC=this.activeCell;
	var EL=this.element;

	var R1 = AC.getClientRects();
	var R2 = EL.getClientRects();

	var oBody = document.getElementById("body"+this.element.uniqueID);
	var R3 = oBody.getClientRects();

	var st = R1[0].top-R2[0].top-parseInt(this.head.clientHeight);
	if (st < 0) {
		oBody.scrollTop += st-2;
	}

	var st = R1[0].top-R2[0].top+parseInt(this.cellHeight)-this.body.clientHeight-parseInt(this.head.clientHeight)-0;
	if (st > 0) {
		oBody.scrollTop += st;
	}
	
	var sb = this.scrollbarWidth;
	
	var st = R1[0].left-R3[0].left-0;
	if (st < 0) {
		oBody.scrollLeft += st-sb;
	}

	var st = R1[0].right-R3[0].left-this.body.clientWidth-0;
	if (st > 0) {
		oBody.scrollLeft += st+4;
	}

}

function _gridlist.prototype.headerMouseOver(i)
{
	if (this.resizeLine.style.visibility != "visible")
		this.headerMouseAction(i, "_over");
}

function _gridlist.prototype.headerMouseOut(i)
{
	this.headerMouseAction(i, "");
}

function _gridlist.prototype.headerMouseAction(i, suffix)
{
	var cols = this.columns;
	if (this.curSortColumn == i)
	{
		var bDesc = (cols[i].descending == "Y");
		cols[i].firstChild.firstChild.className = bDesc ? "gridlistheadingdescending" + suffix : "gridlistheadingascending" + suffix;
	}
	else
	{
		cols[i].firstChild.firstChild.className = "gridlistheading" + suffix;
	}
}

function _gridlist.prototype.headerMouseDown(i)
{
	var oColumnHeader = event.srcElement.parentElement.parentElement;
	if (oColumnHeader.style.cursor != "w-resize")
		this.headerMouseAction(i, "_pressed");
}

function _gridlist.prototype.headerMouseUp(i)
{
	this.headerMouseAction(i, "");
}

function _gridlist.prototype.grayThisColumn(oCol, colIdx)
{


	colIdx = parseInt(colIdx);
	var rowcnt=this.rowCount();
	var cell = (rowcnt==0 ? oCol : this.getCellObject(rowcnt - 1, colIdx) || oCol);
	var body = document.getElementById("body" + this.element.uniqueID);
	var el = this.element;
	var r1 = cell.getBoundingClientRect();
	var r2 = el.getBoundingClientRect();
	var cg = this.columnGrayingCell.style;
	var dcg = this.columnGrayingDummyCell.style;
	var top = parseInt(r1.bottom - r2.top - el.clientTop);
	var height = body.offsetTop + body.clientHeight - top;
	if (0 >= height)
	{
		cg.visibility = "hidden";
		dcg.visibility = "hidden";
		return;
	}
	cg.top = top;
	var left = parseInt(r1.left - r2.left - el.clientLeft);
	cg.left = left;
	cg.width = parseInt(r1.right - r1.left);
	cg.height = height;
	cg.backgroundColor = this.columnGrayingColor;
	cg.visibility = "visible";

	if (colIdx >= this.freezeColumn)
	{
		dcg.top = cg.top;
		dcg.left = 0;
		dcg.width = this.freezewidth;
		dcg.height = height;
		dcg.backgroundColor = "#FFFFFF";
		dcg.visibility = "visible";
	}
	else
		dcg.visibility = "hidden";
}

function _gridlist.prototype.sort(nColumn,descending,firstTimeInit,dontChangeDescending) 
{
	try
	{	
		if ( (this.dontSortOnlyOnce) && !firstTimeInit) {
			this.dontSortOnlyOnce = false;
			return;
		}
		if (!firstTimeInit) {
			var x = eval(this.onbeforesort);
			if ( (typeof(x)!="undefined") && (!x) ) return;
		}
		var cols = this.columns;
		if (cols[nColumn].type == "PASSWORD")
			return;
		if ( (!_getBoolean(cols[nColumn].allowSorting,"true")) && !firstTimeInit )
			return;


		var bNumber = (cols[nColumn].type=="NUMBER" || cols[nColumn].type=="FORMULA");

		var bDesc;
		if (typeof(descending)!="undefined") bDesc=descending;
		else bDesc=(cols[nColumn].descending=="Y");

		if ( (typeof(dontChangeDescending)=="undefined")  )
		{
			bDesc = ! bDesc;
			cols[nColumn].descending = bDesc ? "Y" : "N";
		}
		this.curSortColumnDesc = bDesc;

		cols[this.curSortColumn].firstChild.firstChild.className="gridlistheading";
		

		
		var prevSortColumn = this.curSortColumn;
		this.curSortColumn = nColumn;
		this.headerMouseAction(nColumn, "");

		if (typeof(cols[nColumn].imageurl)!="undefined") {
			if (firstTimeInit) {
				this.lastError="The grid can not be initialized. Please define another initial sorting column with a xdatafld attribute. You can achieve that with myGrid.object.sortColumn=[columnNumber]";
				eval(this.onError);
			} else
				return;
		}
		if (typeof(cols[nColumn].xdatafld)=="undefined") {
			this.lastError="The grid can not sort a column with no xdatafld. Please define a xdatafld in the ListColumnDefinition of column " +cols[nColumn].label;
			eval(this.onError);
			return;
		}
		var sSortby = this.fieldmap[cols[nColumn].xdatafld];
		if (typeof(sSortby)=="undefined") {
			this.lastError="The grid can not sort this column as it was not found in the datasource. Please make sure that your gethandler delivers data for this column: " +cols[nColumn].xdatafld;
			eval(this.onError);
			return;
		}
		if (this.columnGraying)
		{
			var c = cols[nColumn];
			this.makeXSL();
			this.refilter(this.xselect,sSortby,bNumber,bDesc);
			this.grayThisColumn(c, nColumn);
		}
		else
			this.refilter(this.xselect,sSortby,bNumber,bDesc);
		
		if (!firstTimeInit) {
			 eval(this.onaftersort);
		}
		return;
	}
	catch(err)
	{
	}
}

function maskedToNumber(number, decimalSeparator)
{
	number+="";
	var percentage=(number.indexOf("%") != -1);
	if ("." == decimalSeparator)
	{
		number = number.replace(/[^0-9a-z\.-]/g,'');
	}
	else
	{
		var re = new RegExp("[^0-9a-z" + decimalSeparator + "-]", "g");
		number=number.replace(re, '');
		re = new RegExp(decimalSeparator, "g");
		number=number.replace(re, ".");
	}
	number = Number(number);
	return percentage ? number/100 : number; 
}

function formatNumber(dblNumber, bstrFormat, decimalSeparator, groupingSeparator) 
{
	try 
	{
		dblNumber+="";		 
		dblNumber=maskedToNumber(dblNumber,decimalSeparator)+"";
		
		if (dblNumber == "")
		{
			return "";
		}
		
		if (isNaN(Number(dblNumber)))
		{
			return "false";
		}
			
		var xmlDoc = new ActiveXObject("Msxml2.DOMDocument.3.0");
		var xslDoc = new ActiveXObject("Msxml2.DOMDocument.3.0");
		

		var aXml = [];
		aXml.push("<?xml version='1.0' encoding='ISO-8859-1'?>");
		aXml.push("<xsl:stylesheet version='1.0' xmlns:xsl='http://www.w3.org/1999/XSL/Transform'>");
		aXml.push("<xsl:output method='xml' version='4.0' omit-xml-declaration='yes' />");
		aXml.push("<xsl:decimal-format name=\"myNumber\" decimal-separator='" + decimalSeparator + "' grouping-separator='" + groupingSeparator + "' />");
		aXml.push("<xsl:template match='/'><xsl:value-of select='format-number(" + dblNumber + ", \"" + bstrFormat + "\", \"myNumber\")' /></xsl:template></xsl:stylesheet>");
		
		xmlDoc.loadXML('<root/>');
		xslDoc.loadXML(aXml.join(''));

		var result = xmlDoc.transformNode(xslDoc);
		
		xmlDoc = null;
		xslDoc = null;
		return result;
	} 
	catch (err) 
	{
	}
}

function formatXMLDate(varDate, mask){
	var result="";
	try{
		varDate=varDate+"";
		if ("" != varDate && " " != varDate){
			varDate = varDate.replace(/\./g, "-");
			if(mask.match(/(y+)(-|\/)(dd|mm)(-|\/)(dd|mm)/)){
				mask = mask.replace(/(y+)(-|\/)(dd|mm)(?:-|\/)(dd|mm)/,"$3$2$4$2$1");
				varDate = varDate.replace(/(\d{2,4})(-|\/)(\d{1,2}(?:-|\/)\d{1,2})/,"$3$2$1");
			}
			if(mask.match(/dd(-|\/)mm(-|\/)yyyy/))
				varDate = varDate.replace(/(\d{1,2})(?:-|\/)(\d{1,2})/,"$2-$1");
			else if(mask.match(/dd(-|\/)mm(-|\/)yy/))
				varDate = varDate.replace(/(\d{1,2})(?:-|\/)(\d{1,2})(?:-|\/)(\d{1,2})/,"$2-$1-20$3");
			else if(mask.match(/mm(-|\/)dd(-|\/)yy(?!y)/))
				varDate = varDate.replace(/(\d{1,2})(?:-|\/)(\d{1,2})(?:-|\/)(\d{1,2})(?!\d)/,"$1-$2-20$3");
			var d=new Date(Date.parse(varDate));
			if(isNaN(d))
				return false;
			var date=d.getDate();
			if(date<10)
				date='0'+date; 
			var month=d.getMonth()+1;
			if(month<10)
				month='0'+month;
			return d.getFullYear() + '-' + month + '-' + date + '  ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
		}
	}catch(err){
	}
	return result;
}

function calendarToGridMask(bstrFormat)
{
	return bstrFormat.replace(/%a/,'ddd').replace(/%A/,'dddd').replace(/%b/,'mmm').replace(/%B/,'mmmm').replace(/%d/,'dd').replace(/%e/,'d').replace(/%H/,'h').replace(/%I/,'h').replace(/%j/,'dd').replace(/%k/,'h').replace(/%l/,'h').replace(/%m/,'mm').replace(/%M/,'n').replace(/%n/,'').replace(/%p/,'').replace(/%P/,'').replace(/%s/,'').replace(/%S/,'s').replace(/%t/,'').replace(/%U/,'').replace(/%u/,'').replace(/%w/,'').replace(/%y/,'yy').replace(/%Y/,'yyyy').replace(/%%/,'');
}

function gridToCalendarMask(bstrFormat)
{
	return bstrFormat.replace(/dddd/,'%A').replace(/ddd/,'%a').replace(/dd/,'%D').replace(/d/,'%e').replace(/%D/,'%d').replace(/mmm/,'%b').replace(/mm/,'%m').replace(/h/,'%k').replace(/n/,'%M').replace(/s/,'%S').replace(/yyyy/,'%Y').replace(/yy/,'%y');
}

function formatShowDate(varDate,bstrFormat)
{
	var result="&nbsp;";
	try
	{
		varDate = varDate+"";
		if ( !((varDate=="") || (varDate==" ") || (varDate=="&nbsp;")) ) {
			if (varDate.split("-")[0]>1000)
				varDate=varDate.split("-")[1] +"-"+ varDate.split("-")[2].substr(0,2) +"-"+ varDate.split("-")[0] +"  "+ varDate.split("-")[2].substr(3);
				
			dt=new Date(Date.parse(varDate));

			if (isNaN(dt)) {
				alert("The date you entered is not a valid date.");
				return "";
			}

			var aM = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
			var aD = new Array("Sunday", "Monday", "Tuesday","Wednesday","Thursday", "Friday","Saturday");
			var nM = dt.getMonth();
			var nD = dt.getDay();
			var nDt = dt.getDate();
			var nHr = dt.getHours();
			var nMin = dt.getMinutes();
			var nSec = dt.getSeconds();

			bstrFormat = bstrFormat.toLowerCase();

			fullDayFlag=false;
			if (bstrFormat.substr(0,4)=="dddd") {
				bstrFormat=bstrFormat.substr(5);
				fullDayFlag=true;
			}
						
			var yM = bstrFormat.replace(/[^y]/gi,"");
			var mM = bstrFormat.replace(/[^m]/gi,"");
			var dM = bstrFormat.replace(/[^d]/gi,"");
			
			var houM = bstrFormat.replace(/[^h]/gi,"");
			var minM = bstrFormat.replace(/[^n]/gi,"");
			var secM = bstrFormat.replace(/[^s]/gi,"");

			var fy=dt.getFullYear()+"";;
			var yV = (yM=="yyyy" || yM=="y") ? fy : fy.substring(fy.length-2);
			var mV = (mM=="m")?nM+1: (mM=="mm")?((nM+101)+"").substr(1): (mM=="mmm")?aM[nM].substr(0,3): (mM=="mmmm")?aM[nM]: aM[nM].substr(0,3);
			var dV = (dM=="d")?nDt: (dM=="dd")?((nDt+100)+"").substr(1): (dM=="ddd")?aD[nD].substr(0,3): aD[nD];

			var houV =(houM=="h")?nHr:"";
			var minV =(minM=="n")?nMin:"";
			var secV =(secM=="s")?nSec:"";
	
			result = bstrFormat.replace(/h+/i,houV).replace(/n+/i,minV).replace(/s+/i,secV).replace(/y+/i,yV).replace(/m+/i,"_").replace(/d+/i,dV).replace(/_/,mV);

			if (fullDayFlag) {
				result=aD[nD]+", "+result;
			}
			
		}
	} 
	catch (err) 
	{
	}

	return result;
}




































function _lookup (oObj) {	
	this.element = oObj;
	this.width = this.element.width || "200";
	this.active = this.element.active;
	this.enabled = this.element.enabled;
	this.sortby = this.element.sortby;
	this.result = this.element.result;
	this.palign = this.element.palign;
	this.readystate = this.element.readystate || "uninitialized";
	this.onvalidate = this.element.onvalidate;
	this.bVisible = false;
	this.notClicked = true;
	this.lwidth = this.element.lookupWidth || 200;
	this.columnPad=this.element.columnPad || "10";	
	this.selectColumn= this.element.selectColumn;
	this.getHandler= this.element.getHandler;
	this.lookupXSLURL = this.element.lookupXSLURL;
	
	this.grid=this.element.parentElement.object;
	
	this.lookupXSL='<?xml version="1.0"?> <xsl:stylesheet xmlns:xsl="http://www.w3.org/TR/WD-xsl"> <xsl:template> <xsl:copy> <xsl:apply-templates select="@* | * | comment() | pi() | text()"/> </xsl:copy> </xsl:template> <xsl:template match="root"> <xsl:copy> <xsl:apply-templates select="@*"/> <xsl:apply-templates select="e" order-by="@a"/> </xsl:copy> </xsl:template> <xsl:template match="e"> <option class="lookupdropdown"> <xsl:attribute name="value"><xsl:eval>rownum()</xsl:eval></xsl:attribute> <xsl:attribute name="xk"><xsl:value-of select="@xk"/></xsl:attribute> <xsl:apply-templates select="@*" /> </option> </xsl:template> <xsl:template match="@*"> <xsl:eval language="JScript">pad(unescape(this.text),' + this.columnPad + ')</xsl:eval> </xsl:template> <xsl:template match="@xk"> </xsl:template> <xsl:script> <![CDATA[ var row = 0; var width; function rownum() { return row++; } function pad(sText,nLen) { sText = sText.substr(0,nLen); var tl = nLen - sText.length; var padding = ""; for (var i=0; i<tl; i++) padding += ".";   return sText + padding; } ]]> </xsl:script>  </xsl:stylesheet>';
	
	_lookup.prototype.KeyDown = _LUKeyDown;
	_lookup.prototype.init = _LUinit;
	_lookup.prototype.cleanup = _LUcleanup;
	_lookup.prototype.HideListBox = _LUHideListBox;

	this.element.attachEvent("onkeydown",_LUKeyDown);
	this.init();
}

function getDim(el){
	for (var lx=0,ly=0;el!=null;
		lx+=el.offsetLeft,ly+=el.offsetTop,el=el.offsetParent);
	return {x:lx,y:ly};
}

function _LUinit() {
	try {		
		try {
			this.xgetHandler=eval(this.getHandler);
		} catch (e) {
			this.xgetHandler = new ActiveXObject("Msxml2.DOMDocument.3.0");
			this.xgetHandler.async = false;
			this.xgetHandler.resolveExternals = false;
			this.xgetHandler.load(this.getHandler);
		}
		
		if (this.xgetHandler.parseError.errorCode != 0) {
			alert("getHandler is not valid XML: \n\n " + this.xgetHandler.parseError.reason +" \n Please contact your administrator");
		} else {
			
			this.xlistStyle=new ActiveXObject("Msxml2.DOMDocument.3.0");
			this.xlistStyle.async = false;
			this.xlistStyle.resolveExternals = false;

			if ( (this.lookupXSLURL=="") || (typeof(this.lookupXSLURL)=="undefined") )
				this.xlistStyle.loadXML(this.lookupXSL);
			else
				this.xlistStyle.load(this.lookupXSLURL);
			
			if (this.xlistStyle.parseError.errorCode != 0) {
				alert("Lookup.xsl is not valid XML: \n\n " + this.xlistStyle.parseError.reason +" \n Please contact your administrator");
				return false;
			}
			this.xlistData=new ActiveXObject("Msxml2.DOMDocument.3.0");
			this.xgetHandler.transformNodeToObject(this.xlistStyle,this.xlistData);
			this.listdata="thisObj.xlistData";
			
			this.fieldmap=this.grid.makeFieldMap(this.xgetHandler);		
			
		}

		var oSpan = document.getElementById("span_"+ this.element.uniqueID);
		if (oSpan != null) {
			this.notClicked = true;
			this.bVisible = true;
			
			
			var body=document.getElementById("body"+this.grid.element.uniqueID);
			var scrollLeft=body.scrollLeft;
			
			if (this.grid.getColumn() < this.grid.freezeColumn) scrollLeft=0;  
			
			oSpan.style.position="absolute";
			var cord=getDim(this.grid.activeCell);
			oSpan.style.top = cord.y-body.scrollTop-20+this.grid.cellHeight;
			oSpan.style.posLeft = cord.x+Number(this.grid.getChildren()[this.grid.getColumn()].width)- scrollLeft + 1;
			oSpan.style.display="block";			
			
		} else {
			var sortField = this.xlistStyle.selectSingleNode("//@order-by");
			sortField.value = this.sortby;
			lbHTML = '<span id="span_'+ this.element.uniqueID +'" style="display:none;position:absolute;z-index:10">';
			if (typeof(palign) == 'undefined') palign="LR";
			switch (palign) {
				case "UL":
					lbHTML += '<span style="position:absolute;top:22;left:-'+this.lwidth;
					break;
				case "LL":
					lbHTML += '<span style="position:absolute;top:22;left:-'+this.lwidth;
					break;
				case "UR":
					lbHTML += '<span style="position:absolute;top:-136;left:-'+this.element.style.width;
					break;
				default:
					lbHTML += '<span style="position:absolute;top:22;left:-'+this.element.style.width;
					break;
			}
			lbHTML += ';border:0px solid;text-align:left;height:75;width:'+(this.lwidth+10)+';z-index:20;font:8pt Arial;filter:glow(color=#000000 strength=5 direction=45);">';
			lbHTML += '<select onmousedown="_LUMouseDown()" onclick="_LUItemClicked()" id="lbLookUp'+ this.element.uniqueID +'" size="5" class="lookupdropdown" style="width:'+this.lwidth+';">';
			lbHTML += this.xlistData.xml;
			lbHTML += '</select>';
			lbHTML += '</span></span>';
			document.body.insertAdjacentHTML('beforeEnd',lbHTML);
			var oLookUp = document.getElementById("lbLookUp"+ this.element.uniqueID);
			this.notClicked = false;
			this.bVisible = false;
		}
	} catch (err) {
		alert("_LUinit: error when creating LOOKUP control:" + err.description );
	}
}

function _LUcleanup() {
	try {
		this.element.detachEvent("onkeydown",_LUKeyDown);
		this.HideListBox();
		var oSpan = document.getElementById("span_"+ this.element.uniqueID);
		if (oSpan != null) {
			oSpan.outerHTML = "";
		}
	} catch (err) {
		alert("_LUcleanup: error in LOOKUP control:" + err.description );
	}
}
function _LUKeyDown() {
	try {
		var thisObj;
		if (typeof(clickSrcElement) != "undefined" && clickSrcElement!=null) {
			thisObj=clickSrcElement;
			clickSrcElement=null;
		}
		else {
			thisObj = event.srcElement;
			while (thisObj.tagName != "INPUT") {
				thisObj = thisObj.parentElement;
			}
			thisObj = thisObj.object;
		}
		var keyval = event.keyCode.valueOf();
		if (keyval == 27) {
			gEsc = true;
			thisObj.HideListBox();
			thisObj.grid.freezeCell();
			return;
		}
		if ( event.ctrlKey && keyval==86 )  {
			thisObj.grid.paste();
			return;
		}
		if ( event.ctrlKey ) return;
		
		if (!thisObj.bVisible) {
			if (keyval !=9 && keyval != 13) {
				thisObj.init();
			} else {
				if (thisObj.grid.activeCell != null)
					thisObj.grid.activeCell.focus();
				return;
			}
		}		
			switch (keyval) {
			default:
				if (keyval > 64 && keyval < 91) {
					var srchval = ""+thisObj.element.value + String.fromCharCode(keyval + 32);
				} else if (keyval > 47 && keyval < 58) {
					var srchval = ""+thisObj.element.value + String.fromCharCode(keyval);
				} else if (keyval == 189) {
					var srchval = ""+thisObj.element.value+"-";
				} else {
					var srchval = ""+thisObj.element.value;
				}
				srchval = srchval.replace(new RegExp("'", "g"), "&apos;");
				var srch = "//option[. $ge$ '" + srchval + "']";
				var lu = eval(thisObj.listdata + ".documentElement.selectSingleNode(srch)");
				if (lu != null) {
					var lineno = lu.attributes(1).value;
					var oLookUp = document.getElementById("lbLookUp"+ thisObj.element.uniqueID);
					if (oLookUp != null)  {
						oLookUp.selectedIndex = lineno +1;
						oLookUp.selectedIndex = lineno;
					}
				}
				break;
			case 9:
				thisObj.cleanup();
			case 13:
				var oLookUp = document.getElementById("lbLookUp"+ thisObj.element.uniqueID);
				if (thisObj.bVisible && oLookUp != null) {
					var srch = "//option[@value = '"+ (oLookUp.selectedIndex) +"']";
					thisObj.element.result = eval(thisObj.listdata + ".documentElement.selectSingleNode(srch)");
					event.returnValue = false;
					event.cancelBubble = true;
					event.keyCode = 32;
					thisObj.notClicked=false;
					thisObj.HideListBox();
					
					xk = thisObj.element.result.selectSingleNode("@xk").text;
					
					xmlrec = thisObj.xgetHandler.selectSingleNode("//.[@xk = '"+xk+"']");

					var select;
					var sC=thisObj.selectColumn;
					if ( (sC=="") || (typeof(sC)=="undefined") )
						select="a";
					else
						select=thisObj.fieldmap[sC].substr(1);
					
					thisObj.grid.inputCell.value=xmlrec.getAttribute(select);
					
					lookupSelectionMade=true;
					thisObj.grid.freezeCell();
					thisObj.grid.activeCell.focus();
				}
				break;
			case 38:
				var oLookUp = document.getElementById("lbLookUp"+ thisObj.element.uniqueID);
				if (oLookUp.selectedIndex == -1) oLookUp.selectedIndex=0;
				if (oLookUp.selectedIndex > 0) oLookUp.selectedIndex--;
				break;
			case 40:
				var oLookUp = document.getElementById("lbLookUp"+ thisObj.element.uniqueID);
				if (oLookUp != null) {
					if (oLookUp.selectedIndex < (oLookUp.length -1)) {
						oLookUp.selectedIndex++;
					}
				}
				break;
			}
	} catch (err) {
		alert("_LUKeyDown: error in LOOKUP control:" + err.description );
	}
}

function _LUMouseDown() {
	doNotFreeze=true;
}
function _LUItemClicked() {
	try {
		var oLookUp = event.srcElement;		
		if (oLookUp != null) {
			var thisObj = document.getElementById(oLookUp.id.substr(8)).object;
			event.keyCode = 13;
			clickSrcElement = thisObj;
			thisObj.bVisible=true;
			doNotFreeze=false;
			thisObj.KeyDown();
		}
	} catch (err) {
		alert("_LUItemClicked: error in LOOKUP control:" + err.description );
	}
}
function _LUHideListBox() {
	try {
		if (typeof(palign) == 'undefined') palign="LR";
		switch (palign) {
			case "UL":
				var mx = event.offsetX+200-0 ;
				var my = event.offsetY+175-0;
				break;
			case "LL":
				var mx = event.offsetX+200-0 ;
				var my = event.offsetY;
				break;
			case "UR":
				var mx = event.offsetX;
				var my = event.offsetY +175-0;
				break;
			default:
				var mx = event.offsetX;
				var my = event.offsetY;
				break;
		}
		if (mx > 0 && mx < (this.lwidth-25) && my > 25 && my < 150 && this.notClicked) {
			return;
		}
		
		var oSpan = document.getElementById("span_"+ this.element.uniqueID);
		if (oSpan != null) {
			oSpan.style.display="none";
			this.bVisible = false;
			this.notClicked = true;
		}
	} catch (err) {
		alert("_LUHideListBox: error in LOOKUP control:" + err.description );
	}
}

