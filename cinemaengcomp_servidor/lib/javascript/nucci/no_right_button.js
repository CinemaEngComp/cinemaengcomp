var message="Opera��o n�o permitida.\r\nEm caso de erro, cancele o contrato.";
function clickIE() {
	if (document.all) {
		alert(message);
		return false;
	}
}

function clickNS(e) {
	if (document.layers||(document.getElementById&&!document.all)) {
		if (e.which==2||e.which==3) {
			alert(message);
			return false;
		}
	}
}

if (document.layers){
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS;
}else{
	document.onmouseup=clickNS;
	document.oncontextmenu=clickIE;
}
