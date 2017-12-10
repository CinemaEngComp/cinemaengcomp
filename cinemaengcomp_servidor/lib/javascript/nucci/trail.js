/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/

var offsetfrommouse=[15,15]; //image x,y offsets from cursor position in pixels. Enter 0,0 for no offset
var displayduration=0; //duration in seconds image should remain visible. 0 for always.
var currentimageheight = 270;	// maximum image size.
var mywidth=0;
var myheight=0;

if (document.getElementById || document.all){
	document.write('<div id="trailimageid">');
	document.write('</div>');
}

function gettrailobj(){
if (document.getElementById)
return document.getElementById("trailimageid").style
else if (document.all)
return document.all.trailimagid.style
}

function gettrailobjnostyle(){
if (document.getElementById)
return document.getElementById("trailimageid")
else if (document.all)
return document.all.trailimagid
}

function gettableobj(){
if (document.getElementById)
return document.getElementById("tablefloating").style
else if (document.all)
return document.all.trailimagid.style
}

function gettableobjnostyle(){
if (document.getElementById)
return document.getElementById("tablefloating")
else if (document.all)
return document.all.trailimagid
}


function truebody(){
return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function stm(t,s,codigo,cliente,ano,produto,campanha,origem,autor,data,tamanho,from,texto,chave,aprovado,cliente_txt){

	document.onmousemove=followmouse;


		if(from==1){
			var txt="<table style='width: 300' id='tablefloating' cellspacing='0' cellpadding='0' class='image' bgcolor='#FFFFFF'><tr><td align='center' valign='middle'><table width='95%' height='95%' cellpadding='0' cellspacing='0'><tr><td height='20' valign='bottom' align='left' class='txtRED'><b>DETALHES</b></td><td align='right' class='txtBLACK' valign='bottom'><b>ID."+codigo+"</b></td></tr><tr><td height='1' colspan='2' background='../../../../images/dot_int.gif'></td></tr><tr><td colspan='2' align='center' valign='middle'><table width='95%' cellspacing='0' cellpadding='0'><tr><td height='5'></td></tr><tr><td height='14' width='70' class='txtFORM' align='left'><b>"+cliente_txt+":</b></td><td class='txtBLACK' align='left'>"+cliente+"</td></tr><tr><td height='14' class='txtFORM' align='left'><b>ano:</b></td><td class='txtFORM' align='left'>"+ano+"</td></tr><tr><td height='14' class='txtFORM' align='left'><b>produto:</b></td><td class='txtFORM' align='left'>"+produto+"</td></tr><tr><td height='14' class='txtFORM' align='left'><b>campanha:</b></td><td class='txtFORM' align='left'>"+campanha+"</td></tr><tr><td height='14' class='txtFORM' align='left'><b>autor:</b></td><td class='txtFORM' align='left'>"+autor+"</td></tr><tr><td class='txtFORM' height='14' align='left'><b>origem:</b></td><td class='txtFORM' align='left'>"+origem+"</td></tr><tr><td class='txtFORM' height='14' align='left'><b>aprovado:</b></td><td class='txtFORM' align='left'>"+aprovado+"</td></tr><tr><td class='txtFORM' height='14' align='left'><b>palavras<br>chaves:</b></td><td class='txtFORM' align='left'>"+chave+"</td></tr><tr><td class='txtFORM' height='14' align='left'><b>criado em:</b></td><td class='txtFORM' align='left'>"+data+"</td></tr><tr><td class='txtFORM' height='14' align='left'><b>DVD n#:</b></td><td class='txtFORM' align='left'>LOCAL</td></tr><tr><td height='5'></td></tr></table></td></tr></table></td></tr></table>";
		}
		if(from==2){
			var txt="<table style='width: 300'  id='tablefloating' cellspacing='0' cellpadding='0' class='image' bgcolor='#FFFFFF'><tr><td align='center' valign='middle'><table width='95%' height='95%' cellpadding='0' cellspacing='0'><tr><td height='20' valign='bottom' align='left' class='txtRED'><b>DESCRIÇÃO</b></td><td align='right' class='txtBLACK' valign='bottom'><b>ID."+codigo+"</b></td></tr><tr><td height='1' colspan='2' background='../../../../images/dot_int.gif'></td></tr><tr><td colspan='2' align='center' valign='middle'><table width='95%' cellspacing='0' cellpadding='0'><tr><td width='70' height='5'></td></tr><tr><td height='14' colspan='2' align='left' class='txtFORM'>"+texto+"</td></tr><tr><td height='5'></td></tr></table></td></tr></table></td></tr></table>";
		}
		if(from==3){
			var txt="<table style='width: "+s[12]+"'  id='tablefloating' cellspacing='0' cellpadding='0' class='image' bgcolor='#FFFFFF'><tr><td align='center' valign='middle'><table width='95%' height='95%' cellpadding='0' cellspacing='0'><tr><td height='20' align='left' valign='middle' class='txtBLACK'><strong>"+texto+"</strong></td></tr></table></td></tr></table>";
		}
		if(from==4){
			var txt="<table width=\"397\" id='tablefloating' cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=\"3\" height=\"1\" bgcolor=\"#999999\"></td></tr><tr><td width=\"1\" bgcolor=\"#999999\"></td><td width=\"393\" height=\"90\" align=\"left\" valign=\"top\" bgcolor=\"#FFFF99\" class=\"txtBLACKB\">AJUDA:<br><br><span class=\"txtFORM\">— Utilize o campo </span>'palavra-chave'<span class=\"txtFORM\"> para fazer pesquisa também no nome do arquivo, e na descrição. </span></td><td width=\"1\" bgcolor=\"#999999\"></td></tr><tr><td colspan=\"3\" height=\"1\" bgcolor=\"#999999\"></td></tr></table>";
		}

	
//var txt="<TABLE "+ab+" WIDTH='"+s[12]+"' BORDER='0' CELLSPACING='0' CELLPADDING='"+s[14]+"' "+brdCol+"><TR><TD>"+title+"<TABLE WIDTH='100%' "+tipHeight+" BORDER='0' CELLPADDING='"+s[16]+"' CELLSPACING='0' "+txtBgCol+" "+txtBgImg+"><TR><TD "+txtTxtAli+" "+ap+" VALIGN='top'><FONT SIZE='"+s[11]+"' FACE='"+s[10]+"' "+txtCol +">"+t[1]+"</FONT></TD></TR></TABLE></TD></TR></TABLE>"


	newHTML = '';
	newHTML = newHTML + txt;
	newHTML = newHTML + '';

	gettrailobjnostyle().innerHTML = newHTML;

	gettrailobj().visibility="visible";
}


function htm(){

	document.onmousemove="";
	gettrailobj().visibility="hidden";
	gettrailobj().left="-500px";
//	alert("teste :"+mywidth);
}




function followmouse_original(e){

	var xcoord=offsetfrommouse[0]
	var ycoord=offsetfrommouse[1]

	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15
	var docheight=document.all? Math.min(truebody().scrollHeight, truebody().clientHeight) : Math.min(window.innerHeight)

	//if (document.all){
	//	gettrailobjnostyle().innerHTML = 'A = ' + truebody().scrollHeight + '<br>B = ' + truebody().clientHeight;
	//} else {
	//	gettrailobjnostyle().innerHTML = 'C = ' + document.body.offsetHeight + '<br>D = ' + window.innerHeight;
	//}

	if (typeof e != "undefined"){
		if (docwidth - e.pageX < 300){
			xcoord = e.pageX - xcoord - 286; // Move to the left side of the cursor
		} else {
			xcoord+= e.pageX;
		}
		if (docheight - e.pageY < (currentimageheight + 110)){
			ycoord += e.pageY - Math.max(0,(110 + currentimageheight + e.pageY - docheight - truebody().scrollTop));
		} else {
			ycoord += e.pageY;
		}

	} else if (typeof window.event != "undefined"){
		if (docwidth - event.clientX < 300){
			xcoord = event.clientX + truebody().scrollLeft - xcoord - 286; // Move to the left side of the cursor
		} else {
			xcoord = truebody().scrollLeft+event.clientX
		}
		if (docheight - event.clientY < (currentimageheight + 110)){
			ycoord += event.clientY + truebody().scrollTop - Math.max(0,(110 + currentimageheight + event.clientY - docheight));
		} else {
			ycoord += truebody().scrollTop + event.clientY;
		}
	}

	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15
	var docheight=document.all? Math.max(truebody().scrollHeight, truebody().clientHeight) : Math.max(document.body.offsetHeight, window.innerHeight)
		if(ycoord < 0) { ycoord = ycoord*-1; }
	gettrailobj().left=xcoord+"px"
	gettrailobj().top=ycoord+"px"

}


function followmouse(e){

	var xcoord=offsetfrommouse[0];
	var ycoord=offsetfrommouse[1];

	mywidth=parseInt(gettableobj().width);
	mywidth=parseInt(gettableobjnostyle().offsetWidth);
	myheight=parseInt(gettableobjnostyle().offsetHeight);

	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth-20 : pageXOffset+window.innerWidth-20;
	var docheight=document.all? Math.min(truebody().scrollHeight, truebody().clientHeight) : Math.min(window.innerHeight)
xcoordO=xcoord;
	if (typeof e != "undefined"){
		if (docwidth - e.pageX < mywidth){
			xcoord = e.pageX - xcoord - mywidth ; // Move to the left side of the cursor
		} else {
			xcoord += e.pageX;
		}
		if (docheight - e.pageY < myheight){
			ycoord += e.pageY - Math.max(0,( 20+ myheight + e.pageY - docheight - truebody().scrollTop));
		} else {
			ycoord += e.pageY;
		}

	} else if (typeof window.event != "undefined"){
		if (docwidth - event.clientX < mywidth){
			xcoord = event.clientX + truebody().scrollLeft - xcoord - mywidth ; // Move to the left side of the cursor
		} else {
			xcoord +=  event.clientX ;
		}
		if (docheight - event.clientY < myheight){
			ycoord += event.clientY + truebody().scrollTop - Math.max(0,( 20+myheight + event.clientY - docheight));
		} else {
			ycoord += truebody().scrollTop + event.clientY;
		}
	}

//	window.status="N XO:"+xcoordO+" Ep:"+event.clientX+" fim:"+xcoord;

	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15;
	var docheight=document.all? Math.max(truebody().scrollHeight, truebody().clientHeight) : Math.max(document.body.offsetHeight, window.innerHeight);

	gettrailobj().left=xcoord+"px";
	gettrailobj().top=ycoord+"px";
}


