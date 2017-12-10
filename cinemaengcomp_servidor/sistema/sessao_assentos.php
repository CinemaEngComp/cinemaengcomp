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
				<h1 class="entry-title">Selecione os assentos</h1>
			</div>
		</section>
	
		<section class="section-page-content">
			<div class="container">
				<div class="row">
	   
					<div id="primary" class="col-md-8">
						<div class="stage-name">
							<h3>Sala <?=$rowSESSAO['codigo_sala']?></h3>
						</div>
						
						<img id="mapa-assentos" src="/images/stage-<?=$rowSESSAO['codigo_sala']?>.png" alt="stage" usemap="#map" />
						<map name="map" class="seatmap">
							<!-- SEAT A -->

<?

	$pos_ini=154;
	$posicao_x=$pos_ini+6;
	$posicao_y=$pos_ini+31;
	$tam_x=0;
	$tam_y=27;

	for($nIndexLinha=1;$nIndexLinha<=10;$nIndexLinha++) {
		for($nIndexColuna=1;$nIndexColuna<=10;$nIndexColuna++) {

			$indice=chr($nIndexLinha+64).$nIndexColuna;
			$indice_seat=$indice;

			if (1==$assento_bloqueado[$indice]) {
				$indice_seat='sold';
			}

?>

							<area  data-seat="<?=$indice_seat?>" alt="<?=$indice?>" href="#" shape="rect" coords="<?=$posicao_x?>,<?=$tam_x?>,<?=$posicao_y?>,<?=$tam_y?>" style="outline:none;"  onclick="doSelect('<?=$indice?>')"    />
<?
			$posicao_x+=30;
			$posicao_y+=30;

		}


		$posicao_x=$pos_ini+6;
		$posicao_y=$pos_ini+31;	


			$tam_x+=30;
			$tam_y+=30;

	}

?>

<!--

							<area  data-seat="I2" alt="I2" href="#" shape="rect" coords="38,7,64,33" style="outline:none;" onclick="doSelect('I2')"   />
							<area  data-seat="sold" alt="I3" href="#" shape="rect" coords="118,7,144,33" style="outline:none;" onclick="doSelect('I3')"   />
							<area  data-seat="sold" alt="I4" href="#" shape="rect" coords="148,7,174,33" style="outline:none;" onclick="doSelect('I4')"   />
							<area  data-seat="sold" alt="I5" href="#" shape="rect" coords="148,7,174,33" style="outline:none;" onclick="doSelect('I5')"   />

							<area data-seat="sold" alt="a1" href="#"  shape="poly" coords="190,302,193,281,199,261,167,243,158,264,153,282,150,302">
							<area data-seat="sold" alt="a2" href="#" shape="poly" coords="212,241,224,227,240,212,220,179,202,195,190,209,180,223">
							<area data-seat="a3" alt="a3" href="#" shape="poly" coords="264,199,283,192,302,189,301,150,273,156,243,168">
							<area data-seat="sold" alt="a4" href="#" shape="poly" coords="327,189,347,192,365,199,385,166,361,158,336,152,327,152">
							<area data-seat="sold" alt="a5" href="#" shape="poly" coords="389,212,404,226,416,240,436,228,449,222,433,201,418,188,405,179">
							<area data-seat="sold" alt="a6" href="#" shape="poly" coords="461,245,471,268,476,288,477,301,439,301,438,287,434,273,430,262">
							
							<area data-seat="b1" alt="b1" href="#" shape="poly" coords="75,301,114,302,115,289,116,277,119,263,123,250,128,237,134,224,102,205,97,215,90,230,86,244,83,256,79,275,77,290">
							<area data-seat="sold" alt="b2" href="#" shape="poly" coords="184,114,166,127,152,140,135,157,123,172,114,185,146,203,156,189,169,174,183,161,203,146">
							<area data-seat="sold" alt="b3" href="#" shape="poly" coords="224,134,248,124,276,117,302,114,300,74,275,78,243,86,220,95,205,103">
							<area data-seat="sold" alt="b4" href="#" shape="poly" coords="328,113,356,117,374,122,393,129,404,133,423,100,407,93,390,87,370,82,352,78,339,76,326,76">
							<area data-seat="sold" alt="b5" href="#" shape="poly" coords="426,146,442,159,458,175,475,194,482,203,514,183,496,159,477,138,444,114">
							<area data-seat="b6" alt="b6" href="#" shape="poly" coords="495,225,503,246,509,265,513,286,515,302,552,302,550,276,545,251,537,226,526,205">
							
							<area data-seat="c1" alt="c1" href="#" shape="poly" coords="0,302,38,302,39,282,43,261,48,241,53,221,60,205,68,187,36,168,26,187,20,205,14,224,8,243,5,262,2,281">
							<area data-seat="c2" alt="c2" href="#" shape="poly" coords="146,50,132,59,117,70,102,83,88,96,75,110,63,125,53,139,49,146,82,165,93,150,107,133,125,112,142,97,166,80">
							<area data-seat="sold" alt="c3" href="#" shape="poly" coords="186,68,219,55,250,46,280,40,302,38,300,1,263,4,234,11,199,22,168,36">
							<area data-seat="sold" alt="c4" href="#"  shape="poly" coords="326,0,327,39,347,40,365,42,383,46,402,52,417,58,440,69,460,37,444,28,422,19,396,10,374,5,351,2">
							<area data-seat="c5" alt="c5" href="#" shape="poly" coords="464,81,481,94,500,110,514,124,532,144,547,164,580,146,568,130,552,109,530,86,504,63,482,49">
							<area data-seat="c6" alt="c6" href="#" shape="poly" coords="560,187,568,204,574,222,580,241,586,261,588,278,589,301,627,301,627,282,624,260,619,235,612,212,604,191,592,168">
-->

						</map>

						<div class="seat-label">
							<ul>
								<li><img src="/images/available.png" alt="available" > Disponivel</li>
								<li><img src="/images/sold.png" alt="sold" > Vendido</li>
								<li><img src="/images/selected.png" alt="selected" > Selecionado</li>
							</ul>
						</div>
						
						<p class="seat-info">Selecione os assentos na quantidade correta.</p>


					</div>
		
					<div id="secondary" class="col-md-4">
						<div class="ticket-price">
							<div class="tickets">
								<label>Quantidade Ingressos: <h3 id="quantidade_ingresso"></h3></label>
							</div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Assento</th>
										<th></th>
										<th></th>
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
		
					
					
						<div class="artist-details" >
							<div class="artist-details-title">
								<a onclick="doConfirmarCompra();" id="btnConfirmar" style=" display:none">Confirmar Compra</a>
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
				console.log('click1');
			if (quantidade_total==quantidade_maxima) {
				console.log('Maximo atingido 222222222222!!!');
				return 0;
			}
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
		onClick: clickHandler,
		toolTipClose: ["area-mouseout"],
		areas: [{
			key: "blocked",
				staticState: true,
				highlight: false,
				fillColor: '000000',
				fillOpacity: 0,
			},
			{			
			key: "sold",
				staticState: true,
				highlight: false,
				fillColor: 'aac4e8',
				fillOpacity: .7,
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
	
$('#valor_total').html(format_moeda(<?=$vt?>));
	   

})(jQuery);

function clickHandler(data) {
	console.log(data);
	var id=data.key;
	if ('sold'==id) {
			data.selected=false;
			return false;

	}

	if (quantidade_total==quantidade_maxima) {

		if(id in assento_selecionado) {
			$('#btnConfirmar').hide();
		} else {
			console.log('Maximo atingido!!!');
			$('#btnConfirmar').show();
			data.selected=false;
			return false;
		}


	}
	doSelectReal(data.key);
//	console.log(data);



	return true;
/*        //this = area element clicked
        //data = {
            e: jQuery eventObject
            listTarget: $(item) from boundList
            key: mapKey for this area
            selected: true | false
        };
*/
}


var valor_assento=35;
var valor_total=0;
var quantidade_total=0;
var assento_selecionado=[];
//assento_bloqueado['I4']=1;

function UnsetAssrnto(id) {
	console.log('UnsetAssrnto='+id);
	$('#mapa-assentos').mapster('set', false, id);
}


function doSelect(id) {
}
function doSelectReal(id) {
	if (quantidade_total==quantidade_maxima) {
//		return false;
	}

	if (id in assento_bloqueado) {
		console.log('bloqueado='+id);
		return false;
	}


	if(id in assento_selecionado) {
		ApagarAssento(id);
		assento_selecionado=removeKey(assento_selecionado,id);
//		valor_total-=valor_assento;
		quantidade_total--;
	} else {
		AddAssento(id);
		assento_selecionado[id]=1;
//		valor_total+=valor_assento;
		quantidade_total++;

	}

	DoCalculaTotal();

	console.log(assento_selecionado);

}

function AddAssento(id) {
	console.log('AddAssento='+id);
	// lista_assentos
//	$('#lista_assentos').append('<tr class="select-seat"><td>B6-Right <span>12 Ticket left</span></td><td>5</td><td>$70 <span>Per seat</span></td></tr>');
//	$('#lista_assentos').append('<tr class="select-seat" id="assento_'+id+'"><td>'+id+'</td><td>Inteira</td><td>R$35,00 <span>Por assento</span></td></tr>');
	$('#lista_assentos').append('<tr class="select-seat" id="assento_'+id+'"><td>'+id+'</td><td></td><td><span></span></td></tr>');

}
function ApagarAssento(id) {
	console.log('ApagarAssento='+id);
	$('#assento_'+id).remove();

}
function DoCalculaTotal() {
console.log('DoCalculaTotal');

	console.log(assento_selecionado);
	var total=0;

	for (var i = 0, len = assento_selecionado.length; i < len; i++) {
	  console.log(assento_selecionado[i]);
	}
	if (quantidade_total==quantidade_maxima) {

			console.log('Maximo atingido!!!');
			$('#btnConfirmar').show();



	}	

//	$('#valor_total').html(format_moeda(valor_total));
	$('#quantidade_ingresso').html(quantidade_total+'/<?=$qT?>');

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


	console.log(assento_selecionado);


	var myJsonString = JSON.stringify(assento_selecionado);
	console.log(myJsonString);
	$('#aS').val(myJsonString);

/*	var aS='';
	console.log(assento_selecionado.length);
	for (var i = 0, len = Object.keys(assento_selecionado).length; i < len; i++) {
	  aS+='"'+assento_selecionado[i]+'",';
	}
	 aS+='"0"';
	console.log(aS);
	$('#aS').val(aS);


console.log('object key:'+Object.keys(assento_selecionado).length);

*/


	$('#btnConfirmar').hide();
	$('#frmAssentos').submit();


}
// Modify JSON.stringify to allow recursive and single-level arrays
(function(){
    // Convert array to object
    var convArrToObj = function(array){
        var thisEleObj = new Object();
        if(typeof array == "object"){
            for(var i in array){
                var thisEle = convArrToObj(array[i]);
                thisEleObj[i] = thisEle;
            }
        }else {
            thisEleObj = array;
        }
        return thisEleObj;
    };
    var oldJSONStringify = JSON.stringify;
    JSON.stringify = function(input){
        return oldJSONStringify(convArrToObj(input));
    };
})();

var quantidade_maxima=<?=$qT?>;
DoCalculaTotal();

</script>

<form action="sessao_pagar.php" method="GET" style="display:none" id="frmAssentos">
<input type="hidden" name="cf" value="<?=$cf?>">
<input type="hidden" name="n" value="<?=$n?>">
<input type="hidden" name="q" value="<?=$q?>">
<input type="hidden" name="d" value="<?=$d?>">
<input type="hidden" name="h" value="<?=$h?>">
<input type="hidden" name="s" value="<?=$s?>">
<input type="hidden" name="sl" value="<?=$sl?>">
<input type="hidden" name="vt" id="vt" value="<?=$vt?>">
<input type="hidden" name="q0" id="q0" value="<?=$q0?>">
<input type="hidden" name="q1" id="q1" value="<?=$q1?>">
<input type="hidden" name="q2" id="q2" value="<?=$q2?>">
<input type="hidden" name="qT" id="qT" value="<?=$qT?>">
<input type="hidden" name="aS" id="aS" value="<?=$aS?>">
</form>
	</body>
</html>