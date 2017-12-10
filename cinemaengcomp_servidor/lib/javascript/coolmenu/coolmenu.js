//----------------------------------------------------------------------------------
// Title: COOLjsMenu
// URL: http://javascript.cooldev.com/scripts/coolmenu/
// Version: 1.7.1
// Last Modify: 10/21/2002
// Author: Sergey Nosenko <darknos@cooldev.com>
// Notes: Registration needed to use this script on your web site.
// Registration for this version is FREE for personal and non-profit use.
// See official site for details
// Copyright (c) 2001-2002 by CoolDev.Com
// Copyright (c) 2001-2002 by Sergey Nosenko
//----------------------------------------------------------------------------------
window.CMenus=[];
var BLANK_IMAGE="/images/dot_clear.gif";
function bw_check(){this.dom=document.getElementById?1:0;this.opera=window.opera?1:0;this.ns4=(document.layers && !this.dom)?1:0;return this;}
function none(){}
function nn(val){return val != null;}
function und(val){return typeof(val) == 'undefined';}
function COOLjsMenu(name, items){
	this.bw=new bw_check();this.bi=new Image();this.bi.src=BLANK_IMAGE;
	if (!window.CMenus) window.CMenus=[];
	window.CMenus[name]=this;
	if (!window.CMenuHideTimers) window.CMenuHideTimers=[];
	window.CMenuHideTimers[name]=null;this.name=name;this.root=[];this.root.par=null;
	this.root.cd=[];this.root.fmt=items[0];this.items=[];
	this.root.frameoff = items[0].pos?items[0].pos:[0,0];
	this.root.lvl=new CMenuLevel(this, this.root);
	for (var i=1;i<items.length;i++) if (!und(items[i])) new CMenuItem(this, this.root, items[i], und(items[i].format)?items[0]:items[i].format);
	this.draw=function (){ for (var i=0;i<this.items.length;i++) document.write(this.items[i].draw()); }
	this.hide=function(){
		if (this.root.fmt.popup) {
			this.root.lvl.vis(0);
		} else {
			for (var i=0;i<this.root.cd.length;i++) if (this.root.cd[i].lvl) this.root.cd[i].lvl.vis(0);
			this.root.lvl.a=null;
			this.root.lvl.draw();
		}
	}
	this.mpopup=function(ev,offX,offY){
		var x=ev.pageX?ev.pageX:(this.bw.opera?ev.clientX:ev.x);
		var y=ev.pageY?ev.pageY:(this.bw.opera?ev.clientY:ev.y);
		var po=this.root.fmt.popupoff;
		y += offY?offY:po?po[0]:0;
		x += offX?offX:po?po[1]:0;
		this.popup(x, y);
	}
	this.popup=function(x,y){
		this.move(x,y);
		this.root.lvl.a=null;
		this.root.lvl.vis(1);
		mEvent(this.name,0,'t');
		mEvent(this.name,0,'0');
	}
	this.move=function(x,y){
		if (!this.root.pos || this.root.pos[0] != x || this.root.pos[1] != y) {
			this.root.pos=[x,y];
			this.root.loff=[0,0];
			this.root.ioff=[0,0];
			for (var i=0;i<this.items.length;i++){
				this.items[i].setPosFromParent();
				this.items[i].move(this.items[i].pos[0],this.items[i].pos[1]);
			}
		}
	}
	this.draw();
	if (!this.root.fmt.popup) 
		this.root.lvl.vis(1)
	else
		this.root.lvl.vis(0)
}

function CMenuLevel(menu, par){
	this.menu=menu;
	this.par=par;
	this.v=0;
	this.abs=null;
	this.vis=function(s){
		this.v=s;
		var l=this.par.cd.length;
		for (var i=0;i<l;i++){
			var n=this.par.cd[i];
			if ( n.hc() && n.lvl.v && !s ) n.lvl.vis(s);
			n.vis(s);
		}
		if (!s) this.a=null;
	}
	this.setA=function(idx,s){
		var n=this.menu.items[idx];
		if (nn(this.a)&&n.par.lvl!=this.a.par.lvl) return;
		if(s&&n.hc())n.lvl.vis(1);
		if( s && n!= this.a && nn(this.a) && this.a.hc() && this.a.lvl.v ) this.a.lvl.vis(0);
		this.a=n;
		this.draw();
	}
	this.draw=function(){
		for (var i=0;i<this.par.cd.length;i++)
			if (this.par.cd[i]==this.a)
				this.par.cd[i].setVis('o');
			else
				this.par.cd[i].setVis('n');
	}
}

function CMenuItem(menu, par, item, format){
	if (und(item)) return;
	this.lvl=null;this.par=par;
	this.code=item.code;
	this.ocode=item.ocode?item.ocode:item.code;
	this.targ=und(item.target)?"":'target="'+item.target+'" ';
	this.url=und(item.url)?"javascript:none()":item.url;
	this.fmt=format;this.menu=menu;this.bw=menu.bw;this.cd=[];
	this.divs=[];this.index=menu.items.length;
	menu.items[menu.items.length]=this;
	this.pindex=par.cd.length;
	par.cd[par.cd.length]=this;
	this.id="cmi"+this.menu.name+"_"+this.index;
	this.v=0;this.state='n';this.diva=["b","s","o","n","e"];
	this.hc=function(){return this.cd.length > 0};
	this.div=function(n){return und(this.divs[n])?this.divs[n]=get_div(this.id+n):this.divs[n]};
	this.draw=function (){	
		var b=this.style.border;
		var s=this.style.shadow;
		return  (!this.style.shadow?"":adiv(this.menu.bw, this.id+"s", parseInt(this.z)+1, this.pos[0]+s, this.pos[1]+s, this.size[1], this.size[0], this.style.color.shadow, "", ""))+
				(!this.style.border?"":adiv(this.menu.bw, this.id+"b", parseInt(this.z)+2, this.pos[0], this.pos[1], this.size[1], this.size[0], this.style.color.border, "", ""))+
				adiv(this.menu.bw, this.id+"o", parseInt(this.z)+3, this.pos[0]+b, this.pos[1]+b, this.size[1]-b*2, this.size[0]-b*2, this.style.color.bgOVER, '<div class="'+this.style.css.OVER+'">'+this.ocode+'</div>', "")+
				adiv(this.menu.bw, this.id+"n", parseInt(this.z)+4, this.pos[0]+b, this.pos[1]+b, this.size[1]-b*2, this.size[0]-b*2, this.style.color.bgON, '<div class="'+this.style.css.ON+'">'+this.code+'</div>', "")+
				adiv(this.menu.bw, this.id+"e", parseInt(this.z)+5, this.pos[0]+b, this.pos[1]+b, this.size[1]-b*2, this.size[0]-b*2, "", '<a href="'+this.url+'" '+this.targ+'onclick="mEvent(\''+this.menu.name+'\','+this.index+',\'c\');"  onmouseover="mEvent(\''+this.menu.name+'\','+this.index+',\'o\');" onmouseout="mEvent(\''+this.menu.name+'\','+this.index+',\'t\');">'+'<img src="'+this.menu.bi.src+'" width="'+this.size[1]+'" height="'+this.size[0]+'" border="0"></a>', "", '' );
	}
	this.vis=function(s){
			if (this.style.shadow) this.visDiv("s",s);
			if (this.style.border) this.visDiv("b",s);
			if (!s) {this.visDiv("o",0);this.visDiv("n",0);this.state="n";}
			else if (this.state=="n")
				this.visDiv("n",1);
			else
				this.visDiv("o",1);
			this.visDiv("e",s);
	}
	this.setVis=function (n){
		if (this.state!=n)
			switch (n){
				case "n":this.visDiv("n",1);this.visDiv("o",0);break;
				case "o":this.visDiv("n",0);this.visDiv("o",1);break;
			}
		this.state=n;
	}
	this.visDiv=this.bw.ns4? visDivNS:visDivDom;
	this.getf=function(obj, name){
		if (!und(obj) && nn(obj) && !und(obj.fmt)) {
			if (!und(obj.fmt[name]))
				return obj.fmt[name]; 
			if (obj.par!=this.menu.root && obj.par && obj.par.sub && obj.par.sub[0][name]) 
				return obj.par.sub[0][name]; 
			return this.getf(obj.par, name);}
		return;
	}
	this.ioff=this.getf(this, "itemoff");
	this.loff=this.getf(this, "leveloff");
	this.style=this.getf(this, "style");
	this.size=this.getf(this, "size");
	this.prev=this.pindex==0? null : this.par.cd[this.pindex-1];
	this.setPos=function(){
		if (this.prev==null){
			this.z=this.par == this.menu.root? 0: parseInt(this.par.z)+10;
			this.pos=und(this.fmt.pos)?(this.par == this.menu.root? this.menu.root.fmt.pos : this.pos=[this.par.pos[0]+this.loff[1], this.par.pos[1]+this.loff[0]]):this.fmt.pos;
		}else{
			this.prev.next=this;
			this.z=this.prev.z;
			this.pos=[this.prev.pos[0]+this.ioff[1], this.prev.pos[1]+this.ioff[0]];
		}
	}
	this.setPos();
	this.sub=item.sub;
	if (!und(this.sub) && !und(this.sub.length)&& this.sub.length>0){
		this.lvl=new CMenuLevel(menu, this);
		for (var i=1;i<this.sub.length;i++)
			if (!und(this.sub[i])) new CMenuItem(this.menu, this, this.sub[i], und(this.sub[i].format)?this.sub[0]: this.sub[i].format);
	}
	this.setPosFromParent=function(){
		if (this.index == 0) {
			this.pos=[this.menu.root.pos[0], this.menu.root.pos[1]]
		} else 
		if (this.prev==null){
			this.pos=[this.par.pos[0]+this.loff[1], this.par.pos[1]+this.loff[0]];
		}else{
			this.pos=[this.prev.pos[0]+this.ioff[1], this.prev.pos[1]+this.ioff[0]];
		}
	}
	this.move=function( x, y ){
		var bl=bt=this.style.border;
		if (this.style.shadow) this.moveTo(x+parseInt(this.style.shadow),y+parseInt(this.style.shadow),"s");
		if (this.style.border) this.moveTo(x,y,"b");
		this.moveTo(x+bl,y+bt,"o");
		this.moveTo(x+bl,y+bt,"n");
		this.moveTo(x+bl,y+bt,"e");
	}
	this.moveTo=function( x, y, b ){
		if (this.bw.ns4){
			this.div(b).moveTo(x,y);
		}else{
			this.div(b).style.left=x;
			this.div(b).style.top=y;
		}
	}
	return this;
}
function adiv(bw,name,z,left,top,width,height,bgc,code,otherCSS, otherDIV){return bw.ns4?'<layer id="'+name+'" z-index="'+z+'" left="'+left+'" top='+top+'" width="'+width+'" height="'+height+'"'+(bgc!=""?' bgcolor="'+bgc+'"':'')+' style="'+otherCSS+'" visibility="hidden" '+otherDIV+'>'+code+'</layer>\n':'<div id="'+name+'" style="position:absolute;visibility:show;z-index:'+z+';left:'+left+'px;top:'+top+'px;width:'+width+'px;height:'+height+'px;visibility:hidden'+(bgc!=""?';background-color:'+bgc+'':'')+';'+otherCSS+';" '+otherDIV+'>'+code+'</div>';}
function get_div(name){return new bw_check().ns4?document.layers[name]:document.all?document.all[name]:document.getElementById(name);}
function visDivNS(d,s){this.div(d).visibility=s?'show':'hide';}
function visDivDom(d,s){this.div(d).style.visibility=s?'visible':'hidden';}
function mEvent(m,i,e) {
	if (nn(window.CMenuHideTimers[m])) {
		window.clearTimeout(window.CMenuHideTimers[m]);
		window.CMenuHideTimers[m]=null;
	}
	switch (e){
		case "o": 
			window.CMenus[m].items[i].par.lvl.setA(i,1);
			if (window.CMenus[m].onmouseover) window.CMenus[m].onmouseover(window.CMenus[m].items[i]);
			break;
		case "c":
			if (window.CMenus[m].items[i].hc()) 
				window.CMenus[m].items[i].lvl.vis(!window.CMenus[m].items[i].lvl.v);
			else
				for (var i=0;i<window.CMenus[m].root.cd.length;i++)
					if (nn(window.CMenus[m].root.cd[i].lvl)) window.CMenus[m].root.cd[i].lvl.vis(0);
			if (window.CMenus[m].onclick) window.CMenus[m].onclick(window.CMenus[m].items[i]);
			break;
		case "t": 
			window.CMenuHideTimers[m]=setTimeout('window.CMenus["'+m+'"].hide()', und(window.CMenus[m].root.fmt.delay)?600:window.CMenus[m].root.fmt.delay);
			if (window.CMenus[m].onmouseout) window.CMenus[m].onmouseout(window.CMenus[m].items[i]);
			break;
	}
	return true;
}
window.oldCMOnLoad=window.onload;
function CMOnLoad(){
	var bw=new bw_check();
	if (bw.ns4 || bw.opera){
		window.origWidth=window.innerWidth;
		window.origHeight=window.innerHeight;
		if (bw.opera && !window.operaResizeTimer) resizeHandler();
	}
	if (typeof(window.oldCMOnLoad)=='function') window.oldCMOnLoad();
	if (bw.ns4) window.onresize=resizeHandler;
}
window.onload=new CMOnLoad();
function resizeHandler() {
	if (window.reloading) return;
	var reload = window.innerWidth != window.origWidth || window.innerHeight != window.origHeight;
	window.origWidth=window.innerWidth; window.origHeight=window.innerHeight;
	if (reload) {window.reloading=1;document.location.reload();return};
	if (new bw_check().opera) window.operaResizeTimer=setTimeout('resizeHandler()',500);
}
function CMenuPopUp(menu, evn, offX, offY){window.CMenus[menu].mpopup(evn, offX, offY);}
function CMenuPopUpXY(menu,x,y){window.CMenus[menu].popup(x,y);}