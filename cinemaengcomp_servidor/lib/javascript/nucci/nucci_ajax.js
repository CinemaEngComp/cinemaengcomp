<!-- Original:  Fabiano Vanucci -->
var script_current_url='';
var script_current_target='';
var script_postfunction;
var script_current_url_popup='';
var script_current_target_popup='';
function NUCCI_AJAX_RefreshLastPage() {
	NUCCI_AJAX_GetPage(script_current_url,script_current_target);
}
function NUCCI_AJAX_GetPage(url,target,postfunction) {
		script_current_url=url;
		script_current_target=target;
		script_postfunction=postfunction;
		indicatorNucciLoading_SHOW('visible')
		new Ajax.Request(url, { method: 'get'
			  ,onComplete: GetOK
			  ,onError  : GetNOTOK
			  ,timeout  : 120
		});
}
function NUCCI_AJAX_GetPage_background(url,target) {
		script_current_url_popup	=url;
		script_current_target_popup	=target;
//		indicatorNucciLoading_SHOW('visible')
		new Ajax.Request(url, { method: 'get'
			  ,onComplete: GetOK_background
			  ,onError  : GetNOTOK_background
			  ,timeout  : 120
		});
}

function GetNOTOK (transport){
	indicatorNucciLoading_SHOW('hidden');
	showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico ');
	
}
function GetNOTOK_background (transport){
//	indicatorNucciLoading_SHOW('hidden');
//	showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico ');
	
}
function GetOK_background (transport){
	if (200 == transport.status) {
		if (""==transport.responseText) {
//			showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (PHP#1).');
		} else {
			document.getElementById(script_current_target_popup).innerHTML=transport.responseText;
		}
	}  else {
//		showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (4)='+transport.status);
	}	
}	
function GetOK (transport){
	indicatorNucciLoading_SHOW('hidden');
	if (200 == transport.status) {
		indicatorNucciLoading_SHOW('hidden');
		if (""==transport.responseText) {
			showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (PHP#1).');
		} else {
			document.getElementById(script_current_target).innerHTML=transport.responseText;
			if ("function"==typeof(script_postfunction)) {
				script_postfunction.call(this,null);
			}
		}
	}  else {
		showERROR('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (4)='+transport.status);
	}	
}	
	function NUCCI_AJAX_GetPage_popup(url,target) {
		script_current_url_popup=url;
		script_current_target_popup=target;

		indicatorNucciLoading_SHOW('visible')
		new Ajax.Request(url, { method: 'get'
//			  ,onLoading: function(request){indicatorNucciLoading_SHOW('visible');}
			  ,onComplete: GetOK_popup
			  ,onError  : GetNOTOK_popup
			  ,timeout  : 120
		});
	}

function GetOK_popup (transport){
	indicatorNucciLoading_SHOW('hidden');
	if (200 == transport.status) {
		indicatorNucciLoading_SHOW('hidden');
		if (""==transport.responseText) {
			alert('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (2)='+transport.status);
		} else {
			document.getElementById(script_current_target_popup).innerHTML=transport.responseText;
		}
	} else {
		alert('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (3)='+transport.status);
	}
}

function GetNOTOK_popup (transport){
	indicatorNucciLoading_SHOW('hidden');
	alert('Erro ao acessar servidor. Tente novamente ou entre em contato com Suporte Técnico (PHP#4).');
}


function showERROR(msg) {
	alert(msg);
}
function doonShow_LARANJA() {
	document.getElementById('overlay_modal').style.backgroundColor="#FF9900";
//	document.getElementById('dialog_buttons').style.backgroundColor="#FF9900";
//	document.getElementById('dialog_buttons').style.visible=false;
}
function doonShow_VERDE() {
	document.getElementById('overlay_modal').style.backgroundColor="#00FF00";
}
function doonShow_ROXO() {
	document.getElementById('overlay_modal').style.backgroundColor="#9102AE";
}
function doonShow_AZUL() {
	document.getElementById('overlay_modal').style.backgroundColor="#0000FF";
}
function doonShow_VERMELHO() {
	document.getElementById('overlay_modal').style.backgroundColor="#FF0000";
}
function doonShow_BRANCO() {
	document.getElementById('overlay_modal').style.backgroundColor="#FFFFFF";
}
function doonShow_PRETO() {
	document.getElementById('overlay_modal').style.backgroundColor="#000000";
}
function doNULL() {

}
if (typeof console === "undefined") console = {log: function() {}};