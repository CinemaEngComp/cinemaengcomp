<?

require ('n_connector.php');

    if (''==$cookie_cod_usr) {
        header("Location: index.php");
        exit;
    }


?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=$global_config['titulo']?></title>

    <link href="/temas/admin/v100/css/bootstrap.min.css" rel="stylesheet">
    <link href="/temas/admin/v100/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/temas/admin/v100/css/animate.css" rel="stylesheet">
    <link href="/temas/admin/v100/css/style.css" rel="stylesheet">

    <link rel="STYLESHEET" type="text/css" href="/lib/javascript/dhtmlxSuite_v25/dhtmlxGrid/codebase/dhtmlxgrid.css">
    <link rel="STYLESHEET" type="text/css" href="/lib/javascript/dhtmlxSuite_v25/dhtmlxGrid/codebase/dhtmlxgrid_skins.css">

<style>
.dhx_combo_select{
    font-family:arial;
    font-size:9px;
    border:1px solid;
    border-color:black silver silver black;
    background-color:white;
    overflow:scroll;
    cursor:default;
    position:absolute;
    height:auto;
    width:300px;
    z-index:600;
}    
</style>

</head>

<body>
    <div id="wrapper">
    
    <? require "menu.php" ?>
    
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">CinemaEngComp 2017</span>
                </li>


                <li>
                    <a href="index.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>












<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Grid de Filmes<small class="m-l-sm">Gerencie seus filmes</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div id="gridbox" width="1000" height="400" style="background-color:white;overflow:hidden; width:1000px;height:400px"></div>

                    </div>
                    <div class="ibox-footer">
                        <span class="pull-right">
                        <button type="button" class="btn btn-w-m btn-success" onclick="SaveGrid()">Salvar</button>
                    </span>
                        <button type="button" class="btn btn-w-m btn-primary" onclick="doIncluirLinha()">Incluir</button>
                    </div>
                </div>
            </div>
        </div>




























        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Livres.
            </div>
            <div>
                <strong>Copyright</strong> CinemaEngComp &copy; 2017
            </div>
        </div>
        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="/temas/admin/v100/js/jquery-2.1.1.js"></script>
    <script src="/temas/admin/v100/js/bootstrap.min.js"></script>
    <script src="/temas/admin/v100/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/temas/admin/v100/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.js"></script>
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="/temas/admin/v100/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="/temas/admin/v100/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="/temas/admin/v100/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/temas/admin/v100/js/inspinia.js"></script>
    <script src="/temas/admin/v100/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="/temas/admin/v100/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="/temas/admin/v100/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="/temas/admin/v100/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="/temas/admin/v100/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="/temas/admin/v100/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="/temas/admin/v100/js/demo/sparkline-demo.js"></script>






<script  src="/lib/javascript/dhtmlxSuite_v25/dhtmlxGrid/codebase/dhtmlxcommon.js"></script>
<script  src="/lib/javascript/dhtmlxSuite_v25/dhtmlxGrid/codebase/dhtmlxgrid.js"></script>
<script  src="/lib/javascript/dhtmlxSuite_v25/dhtmlxGrid/codebase/dhtmlxgridcell.js"></script>
<script  src="/lib/javascript/dhtmlxSuite_v25/dhtmlxTreeGrid/codebase/dhtmlxtreegrid.js"></script>
<!-- dhtmlxDataProcessor -->
<script  src="/lib/javascript/dhtmlxSuite_v25/dhtmlxDataProcessor/codebase/dhtmlxdataprocessor.js"></script>















<script type="text/javascript">

var mygrid;

//create function for processing menu commands 
$(document).ready(function(){

console.log('Entrou');

        mygrid = new dhtmlXGridObject('gridbox');

        mygrid.selMultiRows = true;
//      mygrid.imgURL = "/php/lib/javascript/dhtmlx/dhtmlxSuite_2008Rel3_pro_81009/dhtmlxGrid/codebase/imgs/icons_greenfolders/";
        mygrid.imgURL = "/lib/javascript/dhtmlxSuite_v25/imgs/icons_greenfolders/";
        mygrid.setHeader("ID,Nome, Genero, Inicio , Fim, Duracao, Classificacao, Sinopse, Path Banner");
        mygrid.setInitWidths("50,100,100,80,80,80,80,200,150")
        mygrid.setColAlign("left,left")
        mygrid.setColTypes("ro,edtxt,coro,edtxt,edtxt,edn,edn,edtxt,edtxt,coro,edtxt,edtxt,edtxt,edtxt");
        mygrid.setColSorting("str,str")
        mygrid.attachEvent("onEditCell",doOnCellEdit);
//      mygrid.attachEvent("onRowSelect",doOnRowSelected);
        mygrid.attachEvent("onXLE",function(){showLoading(false)});
        mygrid.attachEvent("onXLS",function(){showLoading(true)});

//      mygrid.enableSmartXMLParsing(true);

        mygrid.init();
        mygrid.setSkin("light")
        mygrid.loadXML("filme_get.php");
        
        
        myDataProcessor = new dataProcessor("filme_save.php"); 
        myDataProcessor.init(mygrid);       
        myDataProcessor.setUpdateMode('off');
        myDataProcessor.attachEvent("onAfterUpdate", function(sid, action, tid, tag){
            console.log('onAfterUpdate='+action);

           if (action == "insert"){
            console.log('inserted');
               mygrid.changeRowId(sid,tid);
               mygrid.cells(tid,0).setValue(tid);

           }
           if (action == "updated"){

           }
        }); 
        myDataProcessor.setVerificator(1,not_empty);
        myDataProcessor.setVerificator(2,not_empty);
        myDataProcessor.setVerificator(3,not_empty);
        myDataProcessor.setVerificator(4,not_empty);
        myDataProcessor.setVerificator(5,not_empty);
        myDataProcessor.setVerificator(6,not_empty);
        myDataProcessor.setVerificator(7,not_empty);

        comboconta5=mygrid.getCombo(2);
        comboconta5.save();
        comboconta5.put('Acao','Acao');
        comboconta5.put('Aventura','Aventura');
        comboconta5.put('Drama','Drama');
        comboconta5.put('Ficcao','Ficcao');
        comboconta5.put('Infantil','Infantil');
        comboconta5.put('Romance / Acao','Romance / Acao');
        comboconta5.put('Suspense','Suspense');
        comboconta5.put('Terror','Terror');
    


        var p=$('#gridbox').offset();
        var w=$('#gridbox').width();
        $('#indicatorNucciGridLoading').css('left', p.left);
        $('#indicatorNucciGridLoading').css('width', w);
        $('#indicatorNucciGridLoading').css('top', p.top+26);
        var p2=$('#indicatorNucciGridLoading').offset();
        var w2=$('#indicatorNucciGridLoading').width();




});

function not_empty(value) {
    return value != "";
}
function not_empty_senha(value) {
    return value != "";
}


function SaveGrid() {
    myDataProcessor.sendData();
}

var nExpande=0;
function doGridExpandeToggle() {
    if (0==nExpande) {
        $('#imgExpandeM').hide();
        $('#imgExpandeN').show();
        mygrid.expandAll();
        nExpande=1;
    } else {
        $('#imgExpandeN').hide();
        $('#imgExpandeM').show();
        mygrid.collapseAll();
        nExpande=0;
    }
}
function doNucci_Init() {
//return false;
    setTimeout('DoNucci_InitSecond()',1000);
}
function DoNucci_InitSecond() {
}
function DoPlanoSALVAR() {
//  var plano           =$("#novoplano").val();
    indicatorNucciLoading_SHOW('visible');

//  x_sajax_DoPlanoSalvar(plano,DoPlanoSALVAR_RETORNO);

}
function doIncluirLinha() {
//  mygrid.addRow(123,"text1,text2",1);
    if (null==mygrid.getSelectedId()) {
        mygrid.addRow('NOVO',['NOVO','Novo Filme']);
    } else {
        mygrid.addRowAfter((new Date()).valueOf(),['NOVO','Novo Filme'],mygrid.getSelectedId());
    }
}

    function showLoading(fl){       
        if(fl===true)
            indicatorNucciLoadingGRID_SHOW('visible');
        else 
            indicatorNucciLoadingGRID_SHOW('hidden');
    }

var currentRowID=0;
var currentShowID="";
var currentNivel=0;

function doOnRowSelected(id){ 


    currentRowID=id;
    currentNivel=mygrid.getLevel(mygrid.getSelectedId())+1;

    
    
}
        
function doOnCellEdit(stage,rowId,cellInd){ 
    if (0==cellInd) {
        return false;
    }
    if(stage==0){ 
        return true; 
    }else if(stage==1){ 
        return true; 
    }else if(stage==2){ 
        return true; 
    }
}



    

function str_repeat (input, multiplier) {
    // Returns the input string repeat mult times  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/str_repeat    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // *     example 1: str_repeat('-=', 10);
    // *     returns 1: '-=-=-=-=-=-=-=-=-=-='
    return new Array(multiplier + 1).join(input);
}

function doApagarConta() {

//  alert(mygrid.hasChildren(mygrid.getSelectedId()));
//  return true;    
                var txt = 'Tem certeza que quer apagar este histórico?';
                
                $.prompt(txt,{ 
                    buttons:{Apagar:true, Cancelar:false},
                    callback: function(v,m,f){
                        
                        if(v){
                            var uid = f.userid;
//                          mygrid.deleteChildItems(mygrid.getSelectedId());
                            mygrid.deleteSelectedItem();
                        }
                        else{}
                        
                    }
                });
    
    
}

var bContaValida=false;
function doCheckCanIncluir() {
    var error=false;
    $('#showRAND').val(Math.random()*1000);
    if (!bContaValida) {
        error=true;
    }
    
    if (""==trim($('#nova_descricao').val())) {
        error=true;
    }

    if (error) {
        $('#btnIncluirConta').attr('disabled', 'disabled'); 
    } else {
        $('#btnIncluirConta').attr('disabled', ''); 
    }
}
function sprintf () {
    // Return a formatted string  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/sprintf    // +   original by: Ash Searle (http://hexmen.com/blog/)
    // + namespaced by: Michael White (http://getsprink.com)
    // +    tweaked by: Jack
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Paulo Freitas    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: sprintf("%01.2f", 123.1);
    // *     returns 1: 123.10    // *     example 2: sprintf("[%10s]", 'monkey');
    // *     returns 2: '[    monkey]'
    // *     example 3: sprintf("[%'#10s]", 'monkey');
    // *     returns 3: '[####monkey]'
    var regex = /%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuidfegEG])/g;
    var a = arguments,
        i = 0,
        format = a[i++];
 
    // pad()    
    var pad = function (str, len, chr, leftJustify) {
        if (!chr) {            
            chr = ' ';        
        }
        var padding = (str.length >= len) ? '' : Array(1 + len - str.length >>> 0).join(chr);
        return leftJustify ? str + padding : padding + str;
    };
 
    // justify()
    var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
        var diff = minWidth - value.length;
        if (diff > 0) {
            if (leftJustify || !zeroPad) {
                value = pad(value, minWidth, customPadChar, leftJustify);
            } else {                value = value.slice(0, prefix.length) + pad('', diff, '0', true) + value.slice(prefix.length);
            }
        }
        return value;
    }; 
    // formatBaseX()
    var formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
        // Note: casts negative numbers to positive ones
        var number = value >>> 0; 
        prefix = prefix && number && {
            '2': '0b',
            '8': '0',
            '16': '0x'
        }[base] || '';        
        value = prefix + pad(number.toString(base), precision || 0, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
    };
 
    // formatString()
    var formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
        if (precision != null) {
           value = value.slice(0, precision);
        }
        return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
    };
 
    // doFormat()
    var doFormat = function (substring, valueIndex, flags, minWidth, _, precision, type) {
        var number;        
        var prefix;
        var method;
        var textTransform;
        var value;
        if (substring == '%%') {
            return '%';
        }
 
        // parse flags        
        var leftJustify = false,
        positivePrefix = '',
        zeroPad = false,
        prefixBaseX = false,
        customPadChar = ' ';
        var flagsl = flags.length;
        for (var j = 0; flags && j < flagsl; j++) {
            switch (flags.charAt(j)) {
            case ' ':
                positivePrefix = ' ';
                break;
            case '+':
                positivePrefix = '+';
                break;
            case '-':
                leftJustify = true;
                break;
            case "'":
                customPadChar = flags.charAt(j + 1);
                break;            
            case '0':
                zeroPad = true;
                break;
            case '#':
                prefixBaseX = true;
                break;
            }
        }
 
        // parameters may be null, undefined, empty-string or real valued        
        // we want to ignore null, undefined and empty-string values
        if (!minWidth) {
            minWidth = 0;
        } else if (minWidth == '*') {
            minWidth = +a[i++];        
        } else if (minWidth.charAt(0) == '*') {
            minWidth = +a[minWidth.slice(1, -1)];
        } else {
            minWidth = +minWidth;
        } 
        // Note: undocumented perl feature:
        if (minWidth < 0) {
            minWidth = -minWidth;
            leftJustify = true;        }
 
        if (!isFinite(minWidth)) {
            throw new Error('sprintf: (minimum-)width must be finite');
        } 
        if (!precision) {
            precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type == 'd') ? 0 : undefined;
        } else if (precision == '*') {
            precision = +a[i++];        } else if (precision.charAt(0) == '*') {
            precision = +a[precision.slice(1, -1)];
        } else {
            precision = +precision;
        } 
        // grab value using valueIndex if required?
        value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];
 
        switch (type) {        
        case 's':
            return formatString(String(value), leftJustify, minWidth, precision, zeroPad, customPadChar);
        case 'c':
            return formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
        case 'b':            
            return formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'o':
            return formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'x':
            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'X':
            return formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad).toUpperCase();
        case 'u':
            return formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
        case 'i':        
        case 'd':
            number = (+value) | 0;
            prefix = number < 0 ? '-' : positivePrefix;
            value = prefix + pad(String(Math.abs(number)), precision, '0', false);
            return justify(value, prefix, leftJustify, minWidth, zeroPad);
        case 'e':
        case 'E':
        case 'f':
        case 'F':
        case 'g':        
        case 'G':
            number = +value;
            prefix = number < 0 ? '-' : positivePrefix;
            method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
            textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
            value = prefix + Math.abs(number)[method](precision);
            return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
        default:
            return substring;
        }  
    }
 
    return format.replace(regex, doFormat);
}
function trim (str, charlist) {
    // Strips whitespace from the beginning and end of a string  
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/trim    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: mdsjack (http://www.mdsjack.bo.it)
    // +   improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
    // +      input by: Erkekjetter
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)    // +      input by: DxGx
    // +   improved by: Steven Levithan (http://blog.stevenlevithan.com)
    // +    tweaked by: Jack
    // +   bugfixed by: Onno Marsman
    // *     example 1: trim('    Kevin van Zonneveld    ');    // *     returns 1: 'Kevin van Zonneveld'
    // *     example 2: trim('Hello World', 'Hdle');
    // *     returns 2: 'o Wor'
    // *     example 3: trim(16, 1);
    // *     returns 3: 6    var whitespace, l = 0,
       i = 0;
    str += '';
 
    if (!charlist) {        // default list
        whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    } else {
        // preg_quote custom list
        charlist += '';
        whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
    }
 
    l = str.length;
    for (i = 0; i < l; i++) {        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(i);
            break;
        }
    } 
    l = str.length;
    for (i = l - 1; i >= 0; i--) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);            break;
        }
    }
 
    return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}
</script>

<div id="indicatorNucciSaving" style="background-color : #ffffff;color: #666666;font-size: 10px;font-family: Verdana, Arial, Helvetica, sans-serif;border: 1px solid #DDDDDD;text-align: center;    margin: 0 auto; visibility:hidden;position:absolute;z-index:900;width: 200px;height: 40px;top:40%;left:40%">
<table><tr><td valign=center align=center>Salvando documento ...<br><img border="0" src="http://logistica.nuccitms.com.br//images/icon_indicator.gif"></td></tr></table></div>
<script language="JavaScript">function indicatorNucciSaving_SHOW(stilo) { document.getElementById("indicatorNucciSaving").style.visibility=stilo; } </script><div id="indicatorNucciWait" style="background-color : #ffffff;color: #666666;font-size: 10px;font-family: Verdana, Arial, Helvetica, sans-serif;border: 1px solid #DDDDDD;text-align: center; margin: 0 auto; visibility:hidden;position:absolute;z-index:9000;width: 200px;height: 40px;top:40%;left:40%">
<table style=" width:100%; height:100%"><tr><td valign=center align=center>Espere por favor...<br /><img border="0" src="http://logistica.nuccitms.com.br/images/icon_indicator.gif"></td></tr></table></div>
<script language="JavaScript">function indicatorNucciWait_SHOW(stilo) { document.getElementById("indicatorNucciWait").style.visibility=stilo; } </script><div id="indicatorNucciGridLoading" style="background-color : #ffffff;color: #666666;font-size: 10px;font-family: Verdana, Arial, Helvetica, sans-serif;border: 1px solid #DDDDDD;text-align: center;  margin: 0 auto; visibility:hidden;position:absolute;z-index:901;width: 7px;height: 321px;top:-342px;left:-10px;opacity:.5;">
<table style=" width:100%; height:100%"><td valign=center align=center>Carregando...<br />  <img src="http://logistica.nuccitms.com.br//images/images_avancado/indicator_verybig.gif" alt="Carregando" width="128" height="128"></td>
</table></div>
<script language="JavaScript">function indicatorNucciLoadingGRID_SHOW(stilo) { document.getElementById('indicatorNucciGridLoading').style.visibility=stilo; } </script>


</body>
</html>
