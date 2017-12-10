//v.3.0 build 110713

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/
dhtmlXEditor.prototype.initDhtmlxToolbar=function(){this.tb=this.base.attachToolbar();this.tb.setSkin(this.skin);if(this.skin=="dhx_skyblue")this.tb.base.style.borderLeft="none",this.tb.base.style.borderRight="none",this.tb.base.style.top="-1px";this.setSizes();this.tb.setIconsPath(this.iconsPath+"dhxeditor_"+this.skin+"/");this._availFonts="Arial,Arial Narrow,Comic Sans MS,Courier,Georgia,Impact,Tahoma,Times New Roman,Verdana".split(",");this._initFont=this._availFonts[0];this._xmlFonts="";for(var d=
0;d<this._availFonts.length;d++){var h=String(this._availFonts[d]).replace(/\s/g,"_");this._xmlFonts+='<item type="button" id="applyFontFamily:'+h+'"><itemText><![CDATA[<img src="'+this.tb.imagePath+"font_"+String(h).toLowerCase()+'.gif" border="0" style="/*margin-top:1px;margin-bottom:1px;*/width:110px;height:16px;">]]\></itemText></item>'}this._availSizes={1:"8pt",2:"10pt",3:"12pt",4:"14pt",5:"18pt",6:"24pt",7:"36pt"};this._xmlSizes="";for(var f in this._availSizes)this._xmlSizes+='<item type="button" id="applyFontSize:'+
f+":"+this._availSizes[f]+'" text="'+this._availSizes[f]+'"/>';this.tbXML='<toolbar><item id="applyH1" type="buttonTwoState" img="h1.gif" imgdis="h4_dis.gif" title="H1"/><item id="applyH2" type="buttonTwoState" img="h2.gif" imgdis="h4_dis.gif" title="H2"/><item id="applyH3" type="buttonTwoState" img="h3.gif" imgdis="h4_dis.gif" title="H3"/><item id="applyH4" type="buttonTwoState" img="h4.gif" imgdis="h4_dis.gif" title="H4"/><item id="separ01" type="separator"/><item id="applyBold" type="buttonTwoState" img="bold.gif" imgdis="bold_dis.gif" title="Bold Text"/><item id="applyItalic" type="buttonTwoState" img="italic.gif" imgdis="italic_dis.gif" title="Italic Text"/><item id="applyUnderscore" type="buttonTwoState" img="underline.gif" imgdis="underline_dis.gif" title="Underscore Text"/><item id="applyStrikethrough" type="buttonTwoState" img="strike.gif" imgdis="strike_dis.gif" title="Strikethrough Text"/><item id="separ02" type="separator"/><item id="alignLeft" type="buttonTwoState" img="align_left.gif" imgdis="align_left_dis.gif" title="Left Alignment"/><item id="alignCenter" type="buttonTwoState" img="align_center.gif" imgdis="align_center_dis.gif" title="Center Alignment"/><item id="alignRight" type="buttonTwoState" img="align_right.gif" imgdis="align_right_dis.gif" title="Right Alignment"/><item id="alignJustify" type="buttonTwoState" img="align_justify.gif" title="Justified Alignment"/><item id="separ03" type="separator"/><item id="applySub" type="buttonTwoState" img="script_sub.gif" imgdis="script_sub.gif" title="Subscript"/><item id="applySuper" type="buttonTwoState" img="script_super.gif" imgdis="script_super_dis.gif" title="Superscript"/><item id="separ04" type="separator"/><item id="createNumList" type="button" img="list_number.gif" imgdis="list_number_dis.gif" title="Number List"/><item id="createBulList" type="button" img="list_bullet.gif" imgdis="list_bullet_dis.gif" title="Bullet List"/><item id="separ05" type="separator"/><item id="increaseIndent" type="button" img="indent_inc.gif" imgdis="indent_inc_dis.gif" title="Increase Indent"/><item id="decreaseIndent" type="button" img="indent_dec.gif" imgdis="indent_dec_dis.gif" title="Decrease Indent"/><item id="separ06" type="separator"/><item id="clearFormatting" type="button" img="clear.gif" title="Clear Formatting"/></toolbar>';
this.tb.loadXMLString(this.tbXML);this._checkAlign=function(a){this.tb.setItemState("alignCenter",!1);this.tb.setItemState("alignRight",!1);this.tb.setItemState("alignJustify",!1);this.tb.setItemState("alignLeft",!1);a&&this.tb.setItemState(a,!0)};this._checkH=function(a){this.tb.setItemState("applyH1",!1);this.tb.setItemState("applyH2",!1);this.tb.setItemState("applyH3",!1);this.tb.setItemState("applyH4",!1);a&&this.tb.setItemState(a,!0)};this._doOnFocusChanged=function(a){if(!a.h1&&!a.h2&&!a.h3&&
!a.h4){var b=String(a.fontWeight).search(/bold/i)!=-1||Number(a.fontWeight)>=700;this.tb.setItemState("applyBold",b)}else this.tb.setItemState("applyBold",!1);var c="alignLeft";String(a.textAlign).search(/center/)!=-1&&(c="alignCenter");String(a.textAlign).search(/right/)!=-1&&(c="alignRight");String(a.textAlign).search(/justify/)!=-1&&(c="alignJustify");this.tb.setItemState(c,!0);this._checkAlign(c);this.tb.setItemState("applyH1",a.h1);this.tb.setItemState("applyH2",a.h2);this.tb.setItemState("applyH3",
a.h3);this.tb.setItemState("applyH4",a.h4);if(window._KHTMLrv)a.sub=a.vAlign=="sub",a.sup=a.vAlign=="super";this.tb.setItemState("applyItalic",a.fontStyle=="italic");this.tb.setItemState("applyStrikethrough",a.del);this.tb.setItemState("applySub",a.sub);this.tb.setItemState("applySuper",a.sup);this.tb.setItemState("applyUnderscore",a.u)};this._doOnToolbarClick=function(a){var b=String(a).split(":");this[b[0]]!=null&&typeof this[b[0]]=="function"&&(this[b[0]](b[1]),this.callEvent("onToolbarClick",
[a]))};this._doOnStateChange=function(a){this[a]();switch(a){case "alignLeft":case "alignCenter":case "alignRight":case "alignJustify":this._checkAlign(a);break;case "applyH1":case "applyH2":case "applyH3":case "applyH4":this._checkH(a)}this.callEvent("onToolbarClick",[a])};this._doOnBeforeStateChange=function(a,b){return(a=="alignLeft"||a=="alignCenter"||a=="alignRight"||a=="alignJustify")&&b==!0?!1:!0};var g=this;this.tb.attachEvent("onClick",function(a){g._doOnToolbarClick(a)});this.tb.attachEvent("onStateChange",
function(a,b){g._doOnStateChange(a,b)});this.tb.attachEvent("onBeforeStateChange",function(a,b){return g._doOnBeforeStateChange(a,b)});this.applyBold=function(){this.runCommand("Bold")};this.applyItalic=function(){this.runCommand("Italic")};this.applyUnderscore=function(){this.runCommand("Underline")};this.applyStrikethrough=function(){this.runCommand("StrikeThrough")};this.alignLeft=function(){this.runCommand("JustifyLeft")};this.alignRight=function(){this.runCommand("JustifyRight")};this.alignCenter=
function(){this.runCommand("JustifyCenter")};this.alignJustify=function(){this.runCommand("JustifyFull")};this.applySub=function(){this.runCommand("Subscript")};this.applySuper=function(){this.runCommand("Superscript")};this.applyH1=function(){this.runCommand("FormatBlock","<H1>")};this.applyH2=function(){this.runCommand("FormatBlock","<H2>")};this.applyH3=function(){this.runCommand("FormatBlock","<H3>")};this.applyH4=function(){this.runCommand("FormatBlock","<H4>")};this.createNumList=function(){this.runCommand("InsertOrderedList")};
this.createBulList=function(){this.runCommand("InsertUnorderedList")};this.increaseIndent=function(){this.runCommand("Indent")};this.decreaseIndent=function(){this.runCommand("Outdent")};this.clearFormatting=function(){this.runCommand("RemoveFormat");this.tb.setItemState("applyBold",!1);this.tb.setItemState("applyItalic",!1);this.tb.setItemState("applyStrikethrough",!1);this.tb.setItemState("applySub",!1);this.tb.setItemState("applySuper",!1);this.tb.setItemState("applyUnderscore",!1)};this.getParentByTag=
function(a,b){var b=b.toLowerCase(),c=a;do if(b==""||c.nodeName.toLowerCase()==b)return c;while(c=c.parentNode);return a};this.isStyleProperty=function(a,b,c,d){var b=b.toLowerCase(),e=a;do if(e.nodeName.toLowerCase()==b&&e.style[c]==d)return!0;while(e=e.parentNode);return!1};this.setStyleProperty=function(a,b){this.style[b]=!1;var c=this.getParentByTag(a,b);c&&c.tagName.toLowerCase()==b&&(this.style[b]=!0);if(b=="del"&&this.getParentByTag(a,"strike")&&this.getParentByTag(a,"strike").tagName.toLowerCase()==
"strike")this.style.del=!0};this._unloadExtModule=function(){this.tb.unload();this.setStyleProperty=this.isStyleProperty=this.getParentByTag=this.clearFormatting=this.decreaseIndent=this.increaseIndent=this.createBulList=this.createNumList=this.applyH4=this.applyH3=this.applyH2=this.applyH1=this.applySuper=this.applySub=this.alignJustify=this.alignCenter=this.alignRight=this.alignLeft=this.applyStrikethrough=this.applyUnderscore=this.applyItalic=this.applyBold=this._doOnBeforeStateChange=this._doOnStateChange=
this._doOnToolbarClick=this._doOnFocusChanged=this._checkH=this._checkAlign=this.tbXML=this._xmlSizes=this._availSizes=this._xmlFonts=this._initFont=this._availFonts=this.tb=null}};

//v.3.0 build 110713

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
To use this component please contact sales@dhtmlx.com to obtain license
*/se
*/