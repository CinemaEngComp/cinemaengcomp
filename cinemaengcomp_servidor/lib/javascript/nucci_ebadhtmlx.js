// FCV - 10/12/2015 - funcoes para criacao de DTHMX GRID sobre a configuracao do EBA

dhtmlXGridObject.prototype.setCell=function(rowID,celIndex,valor) {
	this.cells(this.getRowId(rowID),celIndex).setValue(valor);
}
dhtmlXGridObject.prototype.getCellValue=function(rowID,celIndex) {
	return this.cells(this.getRowId(rowID),celIndex).getValue();
}
dhtmlXGridObject.prototype.getCellText=function(rowID,celIndex) {
	return this.cells(this.getRowId(rowID),celIndex).getValue();
}
dhtmlXGridObject.prototype.getRow=function() {
	return this.getRowIndex(this.getSelectedRowId());
}
dhtmlXGridObject.prototype.insertRow=function() {
	var newId = (new Date()).valueOf();
	return this.addRow(newId,"");
}
dhtmlXGridObject.prototype.deleteRow=function() {
	var newId = (new Date()).valueOf();
	return this.addRow(newId,"");
}

dhtmlXGridObject.prototype.rowCount=function() {
	return this.getRowsNum();
}
dhtmlXGridObject.prototype.columnCount=function() {
	return this.getColumnsNum();
}



dhtmlXGridObject.prototype.getResponseFromURL=function(url) {
	var ret = dhtmlxAjax.getSync(url );
	if (ret.xmlDoc.responseText  != null) {
		return ret.xmlDoc.responseText;
	} else {;
		return '';
	}
}
getElementsByTagName = function(n, tag, ns) {
    // map the namespace prefix to the full namespace URIs
    var nsMap = {
        'svg': 'http://www.w3.org/2000/svg'
        // etc - whatever's relevant for your page
    };
    if (!ns) {
        // no namespace - use the standard method
        return n.getElementsByTagName(tag);
    }
    if (n.getElementsByTagNameNS && nsMap[ns]) {
        // function and namespace both exist
        return n.getElementsByTagNameNS(nsMap[ns], tag);
    }
    // no function, get with the colon tag name
    return 111;//n.getElementsByTagName(ns + ':' + tag);
};
var ebadhtmlx_debug=0;
function InitEBAGridsDHTMLX(debug) {
	ebadhtmlx_debug=debug;
	var rl=document.getElementsByTagName("eba:gridlist");
	for (var i=0; i<rl.length; i++) {
		InitGridfromEBA(rl[i]);
	}
}

function InitGridfromEBA(objEBA) {
	var tabela_colunas= new Array();
	var tabela_colunas_indice= new Array();
	var rC=objEBA.getElementsByTagName("eba:ColumnDefinition");
	for (var i=0; i<rC.length; i++) {
		tabela_colunas.push(new Array(rC[i].getAttribute('label'),rC[i].getAttribute('width'),rC[i].getAttribute('type'),rC[i].getAttribute('onvalidate'),rC[i].getAttribute('bgcolor'),rC[i].getAttribute('celldisabled'),rC[i].getAttribute('mask'),rC[i].getAttribute('values') ,rC[i].getAttribute('onmodified'),rC[i].getAttribute('xdatafld')    ) );
	}

	var cores='';
	var listvalores=new Array();
	var celldisabled=new Array();
	var onvalidate=new Array();
	var freezeColumn=$("#"+objEBA.id).attr('freezeColumn');
	var showsplit='';
	if (0<freezeColumn) {
		showsplit=" split='"+freezeColumn+"' ";
	}
	var novohtml='<table skin="dhx_skyblue" imgpath="/php/lib/javascript/dhtmlxSuite_v30/dhtmlxGrid/codebase/imgs/" name="'+objEBA.id+'" id="gridbox_'+objEBA.id+'" gridWidth="'+$("#"+objEBA.id).attr('width')+'" gridHeight="'+$("#"+objEBA.id).attr('height')+'" '+showsplit+'><tr>';
	var onmodified=$("#"+objEBA.id).attr('onmodified');
	var allowDelete=$("#"+objEBA.id).attr('allowDelete');
	var allowInsert=$("#"+objEBA.id).attr('allowInsert');
	var onError=$("#"+objEBA.id).attr('onError');
	var onbeforesave=$("#"+objEBA.id).attr('onbeforesave');
	var onbeforeinsert=$("#"+objEBA.id).attr('onbeforeinsert');
	var onaftersave=$("#"+objEBA.id).attr('onaftersave');
	var getHandler=$("#"+objEBA.id).attr('getHandler');
	var saveHandler=$("#"+objEBA.id).attr('saveHandler');


	// Todas Colunas
	for(i=0;i<tabela_colunas.length;i++) {
		var atributos='';
		var tipo_celula='ed';
		if (0<tabela_colunas[i][1]) {
			atributos+=' width="'+tabela_colunas[i][1]+'"';
		}
		if ('NUMBER'==tabela_colunas[i][2]) {
			var tipo='nuccinumber_simple';
			var formato=tabela_colunas[i][6].split(',');

			if ('00'==formato[1]) {
				var tipo='nucci_fin_double';
			}
			if ('000'==formato[1]) {
				var tipo='nucci_double_3casas';
			}
			if ('0000'==formato[1]) {
				var tipo='nucci_double_4casas';
			}
			if ('00%'==formato[1]) {
				var tipo='nucci_percentual';
			}
			if ('000%'==formato[1]) {
				var tipo='nucci_percentual3casas';
			}
			if ('0000%'==formato[1]) {
				var tipo='nucci_percentual4casas';
			}
			atributos+=' align="right" ';
			tipo_celula = tipo;
		}
		if ('CHECKBOX'==tabela_colunas[i][2]) {
			tipo_celula ='nucci_simnao';
		}
		if ('LISTBOX'==tabela_colunas[i][2]) {
			tipo_celula ='coro';
			listvalores.push(tabela_colunas[i][7]);
		} else {
			listvalores.push('');
		}

		atributos+=' type="'+ tipo_celula +'" ';

		if ('Y'==tabela_colunas[i][5]) {
			celldisabled.push('Y');
		} else {
			celldisabled.push('');
		}
		if ( (''==tabela_colunas[i][3]) || !tabela_colunas[i][3]) {
			onvalidate.push('');
		} else {
			onvalidate.push(tabela_colunas[i][3]);
		}
		if ( (''==tabela_colunas[i][4]) || !tabela_colunas[i][4]) {
			cores+=' #FFFFFF,';
			atributos+=' bgcolor="" ';

		} else {
			cores+=' '+tabela_colunas[i][4]+',';
			atributos+=' bgcolor="'+tabela_colunas[i][4]+'" ';
		}
		if (''!=tabela_colunas[i][9]) {
			atributos+=' colid="'+tabela_colunas[i][9]+'" ';
			tabela_colunas_indice[tabela_colunas[i][9]]= new Array(i,'nulo');
		}

		novohtml+='<td '+atributos+'>'+tabela_colunas[i][0]+'</td>';
	}
	novohtml+='</tr>';
	// onmodified
	if(typeof getHandler === 'undefined') {
		getHandler='';
	} else {
		if (""!=getHandler) {
			var extension = ebadhtmlx_getExtension(getHandler);
			if (""==extension) {
				// sem extensao..
				var xmlGH=document.getElementById(getHandler);
				var xmlRoot=xmlGH.getElementsByTagName("root");
				var xmlRootFields=xmlRoot[0].getAttribute('fields');
				var arrayRootFields=xmlRootFields.split('|');
				for(fi=0;fi<arrayRootFields.length;fi++) {
					if(typeof tabela_colunas_indice[arrayRootFields[fi]] === 'undefined') {
					} else {
						tabela_colunas_indice[arrayRootFields[fi]][1]=ebadhtmlx_getEbaIndice(fi);
					}
				}
				var xmlRow=xmlRoot[0].getElementsByTagName("e");
				var xk=0;
				for (var i=0; i<xmlRow.length; i++) {
					var xk=xmlRow[i].getAttribute("xk");
					// Todas Colunas
					novohtml+='<tr id="'+xk+'">';
					for(fi=0;fi<tabela_colunas.length;fi++) {
						valor=xmlRow[i].getAttribute((tabela_colunas_indice[tabela_colunas[fi][9]][1]));
						novohtml+='<td>'+valor;
						novohtml+='</td>';
					}
					novohtml+='</tr>';
				} // for row

			} else {
				// get handler por load xml...
			}
		}
	}

	novohtml+='</table>';

	ebadhtmlx_log('novohtml');
	ebadhtmlx_log(novohtml);
	$("#"+objEBA.id).before(novohtml);

	var gridatual=dhtmlXGridFromTable('gridbox_'+objEBA.id,0,tabela_colunas,listvalores);
//	gridatual.setSkin("dhx_skyblue");
	gridatual.enableTooltips("false");
	gridatual.setDateFormat("%d/%m/%Y");
	gridatual.i18n.decimal_separator=","
	gridatual.i18n.group_separator=".";


	// valores de listbox
	//
//	var bHasListbox=0;
//	for(i=0;i<tabela_colunas.length;i++) {
//		if (""!=listvalores[i]) {
//			bHasListbox=1;
//			var valores=listvalores[i].split(',');
//			comboconta1=gridatual.getCombo(i);
//			for(n=0;n<valores.length;n++) {
//				var aberto=valores[n].split(':');
//				comboconta1.put(aberto[0],aberto[1]);
//			}
//		}
//
//	}



	// onmodified
	if(typeof onmodified === 'undefined') {
		onmodified='';
	} else {

	}





	var setEditCell='gridatual.attachEvent("onEditCell",gridbox_'+objEBA.id+'doOnCellEdit);';

	var functionEditCell="";
	var functionEditCell="";


	for(i=0;i<tabela_colunas.length;i++) {
		if ("Y"==celldisabled[i]) {
			functionEditCell+=' if ('+i+'==cellInd) { return false; }';
		}
		if (""!=onvalidate[i]) {
			functionEditCell+=' if (2==stage) { if ('+i+'==cellInd) { retorno='+onvalidate[i]+'; '+onmodified+'; return retorno;	 } }';
		}

	}

//		onvalidate
	if (""!=functionEditCell) {
		functionEditCell+=" if (2==stage) {	"+onmodified+";		return true;	}	return true; ";
		var setEditCell='gridatual.attachEvent("onEditCell",function (stage,rowId,cellInd) {  '+functionEditCell+' });';
		eval(setEditCell);
	}







}
var EBAFieldOrder = new Array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
var EBAFieldOrder2 = new Array('','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

function ebadhtmlx_getEbaIndice(indice) {
	var divisao=parseInt(indice/EBAFieldOrder.length);
	var resto= indice % EBAFieldOrder.length;
//	console.log('indice='+indice+' / divisao='+divisao+' / resto='+resto);
	return EBAFieldOrder2[divisao]+EBAFieldOrder[resto];
}
function ebadhtmlx_getExtension(path) {
    var basename = path.split(/[\\/]/).pop(),  // extract file name from full path ...
                                               // (supports `\\` and `/` separators)
        pos = basename.lastIndexOf(".");       // get last position of `.`

    if (basename === "" || pos < 1)            // if file name is empty or ...
        return "";                             //  `.` not found (-1) or comes first (0)
	var ext1=basename.slice(pos + 1);
	pos = ext1.lastIndexOf("?");
	if (0<pos) {
		ext1=ext1.substr(0,pos);
	}
    return ext1;            // extract extension ignoring `.`
}


function ebadhtmlx_log(valor) {
	if (1==ebadhtmlx_debug) {
		console.log(valor);
	}
}


//v.3.0 build 110713

/*
//Copyright DHTMLX LTD. http://www.dhtmlx.com
//To use this component please contact sales@dhtmlx.com to obtain license
*/
function dhtmlXGridFromTable(obj,init,tabela_colunas,listvalores){
      if(typeof(obj)!='object')
         obj = document.getElementById(obj);

			obj.className="";
            var w=document.createElement("DIV");
	            w.setAttribute("width",obj.getAttribute("gridWidth")||(obj.offsetWidth?(obj.offsetWidth+"px"):0)||(window.getComputedStyle?window.getComputedStyle(obj,null)["width"]:(obj.currentStyle?obj.currentStyle["width"]:0)));
	            w.setAttribute("height",obj.getAttribute("gridHeight")||(obj.offsetHeight?(obj.offsetHeight+"px"):0)||(window.getComputedStyle?window.getComputedStyle(obj,null)["height"]:(obj.currentStyle?obj.currentStyle["height"]:0)));

	            w.setAttribute("name",obj.getAttribute("name"));

            var mr=obj;
            var drag=obj.getAttribute("dragAndDrop");
            mr.parentNode.insertBefore(w,mr);
            var f=mr.getAttribute("name")||("name_"+(new Date()).valueOf());

            var windowf=new dhtmlXGridObject(w);
            window[f]=windowf;

            var acs=mr.getAttribute("onbeforeinit");
            var acs2=mr.getAttribute("oninit");

			if (acs) eval(acs);

        	windowf.setImagePath(windowf.imgURL||(mr.getAttribute("imgpath")||""));

        	if (init) init(windowf);

            var hrow=mr.rows[0];
            var za="";
            var zb="";
            var zc="";
            var zd="";
            var ze="";
            var zn="";
            var zz="";

            for (var i=0; i<hrow.cells.length; i++){
                za+=(za?",":"")+hrow.cells[i].innerHTML;
                var width=hrow.cells[i].getAttribute("width")||hrow.cells[i].offsetWidth||(window.getComputedStyle?window.getComputedStyle(hrow.cells[i],null)["width"]:(hrow.cells[i].currentStyle?hrow.cells[i].currentStyle["width"]:0));
                zb+=(zb?",":"")+(width=="*"?width:parseInt(width));
                zc+=(zc?",":"")+(hrow.cells[i].getAttribute("align")||"left");
                zd+=(zd?",":"")+(hrow.cells[i].getAttribute("type")||"ed");
                ze+=(ze?",":"")+(hrow.cells[i].getAttribute("sort")||"str");
                zn+=(zn?",":"")+(hrow.cells[i].getAttribute("colid")||"");
                zz+=(zz?",":"")+(hrow.cells[i].getAttribute("bgcolor")||"");
            	var f_a=hrow.cells[i].getAttribute("format");
            	if (f_a)
            		if(hrow.cells[i].getAttribute("type").toLowerCase().indexOf("calendar")!=-1)
            			windowf._dtmask=f_a;
            		else
            			windowf.setNumberFormat(f_a,i);
            }
			windowf.setSkin("dhx_skyblue");
        	windowf.setHeader(za);
        	windowf.setInitWidths(zb)
        	windowf.setColAlign(zc)
        	windowf.setColTypes(zd);
        	windowf.setColSorting(ze);
        	windowf.setColumnIds(zn);
			windowf.setColumnColor(zz);

			if (obj.getAttribute("gridHeight")=="auto")
		    	windowf.enableAutoHeigth(true);

			if (obj.getAttribute("multiline")) windowf.enableMultiline(true);

			var lmn=mr.getAttribute("lightnavigation");
			if (lmn) windowf.enableLightMouseNavigation(lmn);

			var evr=mr.getAttribute("evenrow");
			var uevr=mr.getAttribute("unevenrow");

			if (evr||uevr) windowf.enableAlterCss(evr,uevr);
			if (drag) windowf.enableDragAndDrop(true);

            windowf.init();
            if (obj.getAttribute("split")) windowf.splitAt(obj.getAttribute("split"));

// FCV
	// valores de listbox
	//
			for(i=0;i<tabela_colunas.length;i++) {
				if (""!=listvalores[i]) {
					bHasListbox=1;
					var valores=listvalores[i].split(',');
					comboconta1=windowf.getCombo(i);
					for(n=0;n<valores.length;n++) {
						var aberto=valores[n].split(':');
						comboconta1.put(aberto[0],aberto[1]);
					}
				}

			}

            //adding rows
            windowf._process_inner_html(mr,1);

			if (acs2) eval(acs2);
			if (obj.parentNode && obj.parentNode.removeChild)
				obj.parentNode.removeChild(obj);

	 return windowf;

}
dhtmlXGridObject.prototype._process_html=function(xml){
	if (xml.tagName && xml.tagName == "TABLE") return this._process_inner_html(xml,0);
	var temp=document.createElement("DIV");
	temp.innerHTML=xml.xmlDoc.responseText;
	var mr = temp.getElementsByTagName("TABLE")[0];
	this._process_inner_html(mr,0);
}
dhtmlXGridObject.prototype._process_inner_html=function(mr,start){
	var n_l=mr.rows.length;
	for (var j=start; j<n_l; j++){
		var id=mr.rows[j].getAttribute("id")||j;
		this.rowsBuffer.push({ idd:id, data:mr.rows[j], _parser: this._process_html_row, _locator:this._get_html_data });
	}
	this.render_dataset();
	this.setSizes();
}

dhtmlXGridObject.prototype._process_html_row=function(r,xml){
	var cellsCol = xml.getElementsByTagName('TD');
    var strAr = [];

	r._attrs=this._xml_attrs(xml);

	//load cell data
    for(var j=0;j<cellsCol.length;j++){
    	var cellVal=cellsCol[j];
        var exc=cellVal.getAttribute("type");
        if (r.childNodes[j]){
        	if (exc)
        		r.childNodes[j]._cellType=exc;
       		r.childNodes[j]._attrs=this._xml_attrs(cellsCol[j]);
   		}

		if (cellVal.firstChild)
		    strAr.push(cellVal.innerHTML);
		else strAr.push("");

        if (cellVal.colSpan>1){
            r.childNodes[j]._attrs["colspan"]=cellVal.colSpan;
            for (var k=1; k<cellVal.colSpan; k++){
                strAr.push("")
            }
        }
	}
	for(j<cellsCol.length; j<r.childNodes.length; j++)
        r.childNodes[j]._attrs={};

    //back to common code
	this._fillRow(r,(this._c_order?this._swapColumns(strAr):strAr));
    return r;
}
dhtmlXGridObject.prototype._get_html_data=function(data,ind){
	data=data.firstChild;
	while (true){
		if (!data) return "";
		if (data.tagName=="TD") ind--;
		if (ind<0) break;
		data=data.nextSibling;
	}
  return (data.firstChild?data.firstChild.data:"");
}



//dhtmlxEvent(window,"load",function(){
//function dhtmlxInitGridfromTable() {
//    var z=document.getElementsByTagName("table");
//    for (var a=0; a<z.length; a++)
//        if (z[a].className=="dhtmlxGrid"){
//            dhtmlXGridFromTable(z[a]);
//            //we have found IT!
//        }
//});
