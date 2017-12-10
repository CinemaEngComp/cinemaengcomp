<?

require ('n_connector.php');



	$sql=" select * from filmes where codigo_filme=$cf ";

	$result = mysql_query($sql);
	if (!$result) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}
	$rowFILME = mysql_fetch_array($result);


	$sql=" select data_sessao, DATE_FORMAT(data_sessao,'%Y') as ANO, DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES,horario_sessao
,DATE_FORMAT(horario_sessao,'%H:%i') as TIME , DATE_FORMAT(data_sessao,'%d/%m/%Y') as DATASESSAO,CONCAT(DATE_FORMAT(data_sessao,'%d/%m/%Y'),' ',DATE_FORMAT(horario_sessao,'%H:%i')) as DATASESSAOFULL,sessao.codigo_sessao
, DATE_FORMAT(data_sessao,'%w') as DIASEMANA,SALA.codigo_sala
,sessao.*,QUANTIDADE_CADEIRA_TOTAL,ifnull(QUANTIDADE_CADEIRA_SESSAO,0) as QUANTIDADE_CADEIRA_SESSAO, (QUANTIDADE_CADEIRA_TOTAL-ifnull(QUANTIDADE_CADEIRA_SESSAO,0)) as LIVRE 
	 from sessao
     
left join (     select codigo_sala,count(*) as QUANTIDADE_CADEIRA_TOTAL from  cadeira
group by codigo_sala  ) as SALA on sessao.codigo_sala=SALA.codigo_sala

left join (

select codigo_sessao,count(*) as QUANTIDADE_CADEIRA_SESSAO from  ingresso
group by codigo_sessao
) as INGRESSOS on  sessao.codigo_sessao=INGRESSOS.codigo_sessao
     
where CONCAT(data_sessao,' ',horario_sessao)>=now()
and data_sessao='$d' and  sessao.codigo_filme=$cf
and sessao.codigo_sessao=$s
order  by horario_sessao  ";

	$result = mysql_query($sql);
	if (!$result) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}
	$rowSESSAO = mysql_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?=$global_config['titulo']?></title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="/css/bootstrap-slider.min.css">
		<link rel="stylesheet" href="/css/jquery.scrolling-tabs.min.css">
		<link rel="stylesheet" href="/css/bootstrap-checkbox.css">
		<link rel="stylesheet" href="/css/flexslider.css">
		<link rel="stylesheet" href="/css/featherlight.min.css">
		<link rel="stylesheet" href="/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/bootstrap.offcanvas.min.css">
		<link rel="stylesheet" href="/css/core.css">
	  

		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="/css/style.css" >
		<link rel="stylesheet" href="/css/responsive.css" >

		<link rel="stylesheet" href="/css/custom.css" >

		<link href="/temas/admin/v100/css/bootstrap.min.css" rel="stylesheet">
	    <link href="/temas/admin/v100/font-awesome/css/font-awesome.css" rel="stylesheet">
	    <link href="/temas/admin/v100/css/plugins/iCheck/custom.css" rel="stylesheet">
	    <link href="/temas/admin/v100/css/animate.css" rel="stylesheet">
	    <link href="/temas/admin/v100/css/style.css" rel="stylesheet">

	    <link href="/temas/porto/assets/vendor/pnotify/pnotify.custom.css" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
			<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<style>
	.section-select-seat-2-featured-header{
		min-height:322px;
		background: url(/images/filmes/<?=$cf?>/1539x322.jpg)no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		position:relative;
	}

.section-artist-content {
    background: #f8f8f8;
    padding: 00px 0; 
}
.section-artist-content .artist-details .artist-details-title{
	margin:0 0 0px;
	padding:0 60px;
	overflow:hidden;
}

.ticket-price .table > tbody > tr > td{
	padding:10px
}

.section-page-content {
    padding: 20px 0;
    background: #fff;
}

.section-choose-how-many-tickets {
    padding: 20px 0;
}

.ticket-price th:nth-child(2), .ticket-price td:nth-child(2) {
    float: left;
    width: 50%;
    text-align: center;
}
.ticket-price th:nth-child(3), .ticket-price td:nth-child(3) {
    float: left;
    width: 30%;
}
.ticket-price th,
.ticket-price td{
	float:left;
	width:20%;
}

	</style>
	<script>

var assento_bloqueado=[];
//assento_bloqueado['I3']=1;
<?	$sql=" select data_sessao, DATE_FORMAT(data_sessao,'%Y') as ANO, DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES,horario_sessao
,DATE_FORMAT(horario_sessao,'%H:%i') as TIME , DATE_FORMAT(data_sessao,'%d/%m/%Y') as DATASESSAO,sessao.codigo_sessao
, DATE_FORMAT(data_sessao,'%w') as DIASEMANA
,sessao.*,QUANTIDADE_CADEIRA_TOTAL,ifnull(QUANTIDADE_CADEIRA_SESSAO,0) as QUANTIDADE_CADEIRA_SESSAO, (QUANTIDADE_CADEIRA_TOTAL-ifnull(QUANTIDADE_CADEIRA_SESSAO,0)) as LIVRE 

,nome_cadeira,IF(0<ingresso.codigo_sessao,1,0) as TEMINGRESSO,coordenadas_cadeira

	 from sessao
     
left join (     select codigo_sala,count(*) as QUANTIDADE_CADEIRA_TOTAL from  cadeira
group by codigo_sala  ) as SALA on sessao.codigo_sala=SALA.codigo_sala

left join (

select codigo_sessao,count(*) as QUANTIDADE_CADEIRA_SESSAO from  ingresso
group by codigo_sessao
) as INGRESSOS on  sessao.codigo_sessao=INGRESSOS.codigo_sessao

left join cadeira on sessao.codigo_sala=cadeira.codigo_sala
left join ingresso on cadeira.codigo_cadeira=ingresso.codigo_cadeira and sessao.codigo_sessao=ingresso.codigo_sessao 

     
where CONCAT(data_sessao,' ',horario_sessao)>=now()
and sessao.codigo_sessao=$s
and IF(0<ingresso.codigo_sessao,1,0)=1
order  by horario_sessao ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}

	$first=' active ';
	while($rowcombo = mysql_fetch_array($resultcombo)){
		$indice=strtoupper($rowcombo['nome_cadeira']);

		$assento_bloqueado[$indice]=1;
?>
assento_bloqueado['<?=$indice?>']=1;
	<? 
		}
	?>

	</script>
	<body>

	<? 
		require('n_header.php');
	?>

		<section class="section-select-seat-2-featured-header">
			<div class="container">
				<div class="section-content">
					<p><strong><?=$n?></strong> <span><?=$rowSESSAO['DATASESSAOFULL']?></span></p>
				</div>
			</div>
		</section>
	
		<section class="section-page-header">
			<div class="container">
				<h1 class="entry-title">Quantidade de assentos</h1>
			</div>
		</section>
	
		<section class="section-page-content">
			<div class="container">
				<div class="row">
	   
					<div id="primary" class="col-md-8">
							<h1>Inteira: R$ 35,00</h1>
						<div class="section-choose-how-many-tickets">
							<ul class="ticket-nav">
								<li id="quantidade_0_1" nucci-tipo="0"><a href="javascript: DoingressoSelect(0,1)"><span>1</span> ticket</a></li>
								<li id="quantidade_0_2" nucci-tipo="0"><a href="javascript: DoingressoSelect(0,2)"><span>2</span> tickets</a></li>
								<li id="quantidade_0_3" nucci-tipo="0"><a href="javascript: DoingressoSelect(0,3)"><span>3</span> tickets</a></li>
								<li id="quantidade_0_4" nucci-tipo="0"><a href="javascript: DoingressoSelect(0,4)"><span>4</span> tickets</a></li>
<!--								<li class="selected"><a href="#"><span>4</span> tickets</a></li>
								<li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
							</ul>
						</div>
						<h1>Meia: R$ 17,50</h1>
						<div class="section-choose-how-many-tickets">
							<ul class="ticket-nav">
								<li id="quantidade_1_1" nucci-tipo="1"><a href="javascript: DoingressoSelect(1,1)"><span>1</span> ticket</a></li>
								<li id="quantidade_1_2" nucci-tipo="1"><a href="javascript: DoingressoSelect(1,2)"><span>2</span> tickets</a></li>
								<li id="quantidade_1_3" nucci-tipo="1"><a href="javascript: DoingressoSelect(1,3)"><span>3</span> tickets</a></li>
								<li id="quantidade_1_4" nucci-tipo="1"><a href="javascript: DoingressoSelect(1,4)"><span>4</span> tickets</a></li>
<!--								<li class="selected"><a href="#"><span>4</span> tickets</a></li>
								<li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
							</ul>
						</div>
						<h1>Idoso: R$ 17,50</h1>
						<div class="section-choose-how-many-tickets">
							<ul class="ticket-nav">
								<li id="quantidade_2_1" nucci-tipo="2"><a href="javascript: DoingressoSelect(2,1)"><span>1</span> ticket</a></li>
								<li id="quantidade_2_2" nucci-tipo="2"><a href="javascript: DoingressoSelect(2,2)"><span>2</span> tickets</a></li>
								<li id="quantidade_2_3" nucci-tipo="2"><a href="javascript: DoingressoSelect(2,3)"><span>3</span> tickets</a></li>
								<li id="quantidade_2_4" nucci-tipo="2"><a href="javascript: DoingressoSelect(2,4)"><span>4</span> tickets</a></li>
<!--								<li class="selected"><a href="#"><span>4</span> tickets</a></li>
								<li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li> -->
							</ul>
						</div>						
					</div>
		
					<div id="secondary" class="col-md-4">
						<div class="ticket-price">
							<div class="tickets">
								<label>Quantidade Ingressos: <h3 id="quantidade_ingresso"></h3></label>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Tipo</th>
										<th>Quantidade</th>
										<th>Preco</th>
									</tr>
								</thead>
								<tbody id="lista_assentos">
<!--

									<tr class="select-seat">
										<td>A3-Middle <span>2 Tickets left</span></td>
										<td>5</td>
										<td>$65 <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>C1-Left <span>4 Tickets left</span></td>
										<td>4</td>
										<td>$67 <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>C2-Left <span>14 Tickets left</span></td>
										<td>2</td>
										<td>$76 <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>C5-Right <span>1 Ticket left</span></td>
										<td>5</td>
										<td>$58 <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>C6-Right <span>1 Ticket left</span></td>
										<td>5</td>
										<td>$59 <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>B1-Left <span>10 Ticket left</span></td>
										<td>1</td>
										<td>$58 <span>Per seat</span></td>
									</tr>
									<tr class="select-seat">
										<td>B6-Right <span>12 Ticket left</span></td>
										<td>5</td>
										<td>$70 <span>Per seat</span></td>
									</tr>
 -->

 								<tfoot>
									<tr>
										<th>TOTAL</th>
										<th></th>
										<th id="valor_total">R$ 0,00</th>
									</tr>
								</tfoot>

								</tbody>
							</table>
						</div>
					</div>

				</div>

			</div>
		</section>
		<section class="section-artist-content">
		
					
					
						<div class="artist-details">
							<div class="artist-details-title">
								<a onclick="doConfirmarCompra();">Confirmar Compra</a>
							</div>
							
						</div>

		

		</section>



		<?

			require "n_footer.php";

		?>

		<script src="/js/jquery-3.2.0.min.js"></script>
		<script src="/js/bootstrap-slider.min.js"></script>
		<script src="/js/bootstrap-select.min.js"></script>
		<script src="/js/jquery.scrolling-tabs.min.js"></script>
		<script src="/js/jquery.countdown.min.js"></script>
		<script src="/js/jquery.flexslider-min.js"></script>
		<script src="/js/jquery.imagemapster.min.js"></script> 
		<script src="/js/tooltip.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/featherlight.min.js"></script>
		<script src="/js/featherlight.gallery.min.js"></script>
		<script src="/js/bootstrap.offcanvas.min.js"></script>
		<!-- <script src="/js/main.js"></script> -->
		<!--<script src="http://davidlynch.org/projects/maphilight/jquery.maphilight.js"></script>	-->
<script>


(function ($) {
 "use strict";
 	
	$( ".event-map" ).on('mouseleave', function( event ){
		console.log('event-map mouseleave');
	  $('.event-map iframe').css("pointer-events", "none"); 
	});

	   
	$("a,section,div,span,li,input[type='text'],input[type='button'],tr,button").on("click", function(){
		
		if ($(this).hasClass("event-map")) { 
			console.log('event-map click');

			$('.event-map iframe').css("pointer-events", "auto");
		}
		
		if ($(this).hasClass("select-seat")) { 
			console.log('select-seat click');
			$(this).siblings().removeClass("selected");
			$(this).addClass('selected');
		}
		
		if ($(this).hasClass("clearer")) { 
			$(this).prev('input').val('').focus();
			$(this).hide();
		}
		
		
		if ($(this).hasClass("closecanvas")) { 
			$("body").removeClass("offcanvas-stop-scrolling");
		}
	});



	$('#mapa-assentos').mapster({
		mapKey: 'data-seat',
        fillColor: 'ace0aa',
        fillOpacity: .7,
		singleSelect: false,
		toolTipClose: ["area-mouseout"],
		areas: [{
			key: "sold",
				staticState: true,
				highlight: false,
				fillColor: 'aac4e8',
				fillOpacity: .7,
			},
			{
			key: "a1",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>A1</strong></p><span>Selected</span>')
				
			},
			{
			key: "a2",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>A2</strong></p><span>Selected</span>'),
			},
			{
			key: "a3",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>A3</strong></p><span>Selected</span>'),
			},
			{
			key: "a4",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>A4</strong></p><span>Selected</span>'),
			},
			{
			key: "a5",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>A5</strong></p><span>Selected</span>'),
			},
			{
			key: "a6",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>A6</strong></p><span>Selected</span>'),
			},
			{
			key: "b1",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>B1</strong></p><span>Selected</span>'),
			},
			{
			key: "b2",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>B2</strong></p><span>Selected</span>'),
			},
			{
			key: "b3",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>B3</strong></p><span>Selected</span>'),
			},
			{
			key: "b4",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>B4</strong></p><span>Selected</span>'),
			},
			{
			key: "b5",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>B5</strong></p><span>Selected</span>'),
			},
			{
			key: "b6",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>B6</strong></p><span>Selected</span>'),
			},
			{
			key: "c1",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>C1</strong></p><span>Selected</span>'),
			},
			{
			key: "c2",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>C2</strong></p><span>Selected</span>'),
			},
			{
			key: "c3",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>C3</strong></p><span>Selected</span>'),
			},
			{
			key: "c4",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>C4</strong></p><span>Selected</span>'),
			},
			{
			key: "c5",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>C5</strong></p><span>Selected</span>'),
			},
			{
			key: "c6",
				toolTip: $('<img src="/images/seat-preview.jpg"><p>Section <strong>C6</strong></p><span>Selected</span>'),
		}]
	});
	

	   

})(jQuery);

var valor_assento=35;
var valor_total=0;
var quantidade_total=0;
var assento_selecionado=[];
//assento_bloqueado['I4']=1;

function doSelect(id) {
	console.log(id);
	console.log('assento_bloqueado');
	console.log(assento_bloqueado);


	if (id in assento_bloqueado) {
		console.log('bloqueado='+id);
		return false;
	}


	if(id in assento_selecionado) {
		ApagarAssento(id);
		assento_selecionado=removeKey(assento_selecionado,id);
		valor_total-=valor_assento;
		quantidade_total--;
	} else {
		AddAssento(id);
		assento_selecionado[id]=1;
		valor_total+=valor_assento;
		quantidade_total++;
	}

	DoCalculaTotal();

	console.log(assento_selecionado);

}

function AddAssento(id) {
	console.log('AddAssento='+id);
	// lista_assentos
//	$('#lista_assentos').append('<tr class="select-seat"><td>B6-Right <span>12 Ticket left</span></td><td>5</td><td>$70 <span>Per seat</span></td></tr>');
	$('#lista_assentos').append('<tr class="select-seat" id="assento_'+id+'"><td>'+id+'</td><td>Inteira</td><td>R$35,00 <span>Por assento</span></td></tr>');

}
function ApagarAssento(id) {
	console.log('ApagarAssento='+id);
	$('#assento_'+id).remove();

}


function format_moeda(dValor) {
	return "R$"+sprintf("%10.2f",dValor);
}

function format_moeda2(num) {
	num = num.toString().replace(/\$|\,/g,'');
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
// Array Remove - By John Resig (MIT Licensed)
Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};

function removeKey(arrayName,key)
{
 var x;
 var tmpArray = new Array();
 for(x in arrayName)
 {
  if(x!=key) { tmpArray[x] = arrayName[x]; }
 }
 return tmpArray;
}

function doConfirmarCompra() {
	console.log('doConfirmarCompra');
	$('#frmAssentos').submit();
}

var quantidade_selecao=[];
quantidade_selecao[0]=0;
quantidade_selecao[1]=0;
quantidade_selecao[2]=0;
DoCalculaTotal();


function DoingressoSelect(tipo,quantidade) {
	console.log('tipo='+tipo);
	console.log('quantidade='+quantidade);

	$( "li[nucci-tipo='"+tipo+"']" ).removeClass("selected");

	if (quantidade_selecao[tipo]==quantidade) {
		quantidade_selecao[tipo]=0;
		console.log('Entrou 1');

	} else {
		$( "#quantidade_"+tipo+"_"+quantidade ).addClass("selected");
		quantidade_selecao[tipo]=quantidade;
		console.log('Entrou 2');
//		$('#lista_assentos').append('<tr class="select-seat" id="assento_'+id+'"><td>'+id+'</td><td>Inteira</td><td>R$35,00 <span>Por assento</span></td></tr>');
	}


//quantidade_1_1
	console.log(quantidade_selecao);
	DoCalculaTotal();
}
function DoCalculaTotal() {
console.log('DoCalculaTotal');

	var total=0;
	var valor_total=0;

	total+=quantidade_selecao[0]+quantidade_selecao[1]+quantidade_selecao[2];
	valor_total+=(quantidade_selecao[0]*35)+(quantidade_selecao[1]+quantidade_selecao[2])*17.5;

	$('#valor_total').html(format_moeda(valor_total));
	$('#vt').val((valor_total));
	$('#quantidade_ingresso').html(total);
	$('#qT').val((total));

	$('#assento_0').remove();
	$('#assento_1').remove();
	$('#assento_2').remove();
	$('#lista_assentos').append('<tr class="select-seat" id="assento_0"><td>Inteira</td><td>'+quantidade_selecao[0]+'</td><td>'+format_moeda(quantidade_selecao[0]*35)+'<span></span></td></tr>');
	$('#lista_assentos').append('<tr class="select-seat" id="assento_1"><td>Meia</td><td>'+quantidade_selecao[1]+'</td><td>'+format_moeda(quantidade_selecao[1]*17.5)+'<span></span></td></tr>');
	$('#lista_assentos').append('<tr class="select-seat" id="assento_2"><td>Idoso</td><td>'+quantidade_selecao[2]+'</td><td>'+format_moeda(quantidade_selecao[2]*17.5)+'<span></span></td></tr>');
	$('#q0').val((quantidade_selecao[0]));
	$('#q1').val((quantidade_selecao[1]));
	$('#q2').val((quantidade_selecao[2]));

}

</script>
<form action="sessao_assentos.php" method="GET" style="display:none" id="frmAssentos">
<input type="hidden" name="cf" value="<?=$cf?>">
<input type="hidden" name="n" value="<?=$n?>">
<input type="hidden" name="q" value="<?=$q?>">
<input type="hidden" name="d" value="<?=$d?>">
<input type="hidden" name="h" value="<?=$h?>">
<input type="hidden" name="s" value="<?=$s?>">
<input type="hidden" name="sl" value="<?=$sl?>">
<input type="hidden" name="vt" id="vt" value="0">
<input type="hidden" name="q0" id="q0" value="0">
<input type="hidden" name="q1" id="q1" value="0">
<input type="hidden" name="q2" id="q2" value="0">
<input type="hidden" name="qT" id="qT" value="0">
</form>

	</body>
</html>