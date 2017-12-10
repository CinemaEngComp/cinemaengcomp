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


	$assentos_selecionados=json_decode($aS);



?>
<!--
<? print_r($assentos_selecionados);?>
-->
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
    padding: 20px;
    background: #fff;
}
.section-select-payment-method {
    width: 80%;
    margin: 0 auto;
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


.section-select-payment-method .tab-content #paypal {
	padding: 40px 70px;
    border-top: 1px solid #b3b3b3;
}

#dinheiro_total, #dinheiro_troco{
	background: #f9f9f9;
}
#dinheiro_total, #dinheiro_troco, #dinheiro_recebido{
	text-align: right;
	color:#000000;
	font-weight: bold;
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
				<h1 class="entry-title">Pagamento</h1>
			</div>
		</section>
	
		<section class="section-page-content">
			<div class="container">
				<div class="row">
	   
					<div id="primary" class="col-md-8">
<div class="section-select-payment-method">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#credit-card" aria-controls="credit-card" role="tab" data-toggle="tab" onclick="pagamentoTipo(0)">
										<i class="fa fa-credit-card" aria-hidden="true"></i>
										Cartao Credito
									</a>
								</li>
								<li role="presentation" >
									<a href="#credit-card" aria-controls="credit-card" role="tab" data-toggle="tab" onclick="pagamentoTipo(1)">
										<i class="fa fa-credit-card" aria-hidden="true"></i>
										Cartao Debito
									</a>
								</li>
								<li role="presentation">
									<a href="#paypal" aria-controls="paypal" role="tab" data-toggle="tab" onclick="pagamentoTipo(2)">		
										<i class="fa fa-money" aria-hidden="true"></i>
										Dinheiro
									</a>
								</li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content clearfix">
								<div role="tabpanel" class="tab-pane active" id="credit-card">
									<form>
										<div class="row">
											<div class="col-sm-12">
												<label>Nome Impresso no Cartao</label>
												<input type="text" class="form-control" id="cartao_nome" maxlength="40">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-8">
												<label>Numero do Cartao</label>
												<input type="text" class="form-control" placeholder="0000-0000-0000-0000" id="cartao_numero" maxlength="20">
											</div>
											<div class="cvv col-sm-4">
												<label>CVV</label>
												<input type="text" class="form-control" id="cartao_cvv" maxlength="3">
												<i class="fa fa-question-circle-o" aria-hidden="true"></i>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<label>Mes</label>
												<select class="selectpicker dropdown" id="cartao_mes">
													<option value="0">Selecione um mes</option>
													<option value="1">Janeiro</option>
													<option value="2">Fevereiro</option>
													<option value="3">Marco</option>
													<option value="4">Abril</option>
													<option value="5">Maio</option>
													<option value="6">Junho</option>
													<option value="7">Julho</option>
													<option value="8">Agosto</option>
													<option value="9">Setembro</option>
													<option value="10">Outubro</option>
													<option value="11">Novembro</option>
													<option value="12">Dezembro</option>
												</select>
											</div>
											<div class="col-sm-6">
												<label>Ano</label>
												<select class="selectpicker dropdown" id="cartao_ano">
												<option value="0">Seleciona o Ano</option>
													<option value="2030">2030</option>
													<option value="2029">2029</option>
													<option value="2028">2028</option>
													<option value="2027">2027</option>
													<option value="2026">2026</option>
													<option value="2025">2025</option>
													<option value="2024">2024</option>
													<option value="2023">2023</option>
													<option value="2022">2022</option>
													<option value="2021">2021</option>
													<option value="2020">2020</option>
													<option value="2019">2019</option>
													<option value="2018">2018</option>
													<option value="2017">2017</option>
												</select>												
											</div>
										</div>
									</form>
								</div>
								<div role="tabpanel" class="tab-pane" id="paypal">
									<form>
										<div class="row">
											<div class="col-sm-12">
												<label>Valor Total</label>
												<input type="text" class="form-control" id="dinheiro_total" value="<?=format_moeda($vt)?>" onFocus="this.blur();">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<label>Valor Recebido</label>
												<input type="text" class="form-control" id="dinheiro_recebido" onKeyPress="return doRecebido(this);">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<label>Troco</label>
												<input type="text" class="form-control" id="dinheiro_troco" value="<?=format_moeda(0)?>" onFocus="this.blur();">
											</div>
										</div>
									</form>

								</div>
							</div>
							<div class="section-select-payment-method-action">
								<div class="row">
									<div class="col-xs-6 col-sm-6">
										<button class="secondary-link" onclick="doCancelarCompra();" >Cancelar</button>
									</div>
									<div class="col-xs-6 col-sm-6">
										<button class="primary-link" onclick="doConfirmarCompra();" >Confirmar Pagamento</button>
									</div>
								</div>
							</div>
						</div>


					</div>
		
					<div id="secondary" class="col-md-4">
						<div class="ticket-price">
							<div class="tickets">
								<label>Quantidade Ingressos: <h3 id="quantidade_ingresso"></h3><h3 id="quantidade_ingresso_show"></h3></label>
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
<?

	foreach($assentos_selecionados as $ingresso_key=>$valor) {
		if (""!=$showIngresso) {$showIngresso.=",";}
		$showIngresso.=$ingresso_key;
	}

?>
									<tr class="select-seat">
										<td>Inteira</td>
										<td><?=$q0?></td>
										<td><?=format_moeda($q0*35)?></td>
									</tr>
									<tr class="select-seat">
										<td>Meia</td>
										<td><?=$q1?></td>
										<td><?=format_moeda($q1*17.5)?></td>
									</tr>
									<tr class="select-seat">
										<td>Idoso</td>
										<td><?=$q2?></td>
										<td><?=format_moeda($q2*17.5)?></td>
									</tr>
<?

//}



?>

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


		<script type="text/javascript" src="http://logistica.nuccitms.com.br/php/lib/javascript/nucci/nucci_format.js"></script>

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


//	$('#valor_total').html(format_moeda(valor_total));
	$('#quantidade_ingresso').html('<?=$qT?>');
	$('#quantidade_ingresso_show').html('<?=$showIngresso?>')
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


var quantidade_maxima=<?=$qT?>;
DoCalculaTotal();

var tipo_pagamento=0;
function pagamentoTipo(tipo) {
tipo_pagamento=tipo;
console.log('tipo_pagamento='+tipo_pagamento);
}
function doConfirmarCompra() {
	var msg='';



	if (2!=tipo_pagamento) {
		var cartao_nome=$('#cartao_nome').val();
		var cartao_numero=$('#cartao_numero').val();
		var cartao_cvv=$('#cartao_cvv').val();
		var cartao_mes=$('#cartao_mes').val();
		var cartao_ano=$('#cartao_ano').val();

		if (''==cartao_nome) {
			msg+="-Nome no Cartao\n";
		}
		if (''==cartao_numero) {
			msg+="-Numero do Cartao\n";
		}
		if ( (''==cartao_cvv) || (3!=cartao_cvv.length)) {
			msg+="-Codigo do Cartao\n";
		}
		if ('0'==cartao_mes) {
			msg+="-Mes de Validade do Cartao\n";
		}
		if ('0'==cartao_ano) {
			msg+="-Ano de Validade do Cartao\n";
		}



	}


	if (2==tipo_pagamento) {
		if (0==troco_ok) {
			alert('Troco Errado!');
			return false;
		}
	}


	if (''!=msg) {
		alert(msg);
		return false;

	}
/*
<input type="hidden" name="pT" id="pT" value="">
<input type="hidden" name="pN" id="pN" value="">
<input type="hidden" name="pC" id="pC" value="">
<input type="hidden" name="pS" id="pS" value="">
<input type="hidden" name="pA" id="pA" value="">
<input type="hidden" name="pM" id="pM" value="">
<input type="hidden" name="pR" id="pR" value="
*/
	var myJsonString = JSON.stringify('<?=$aS?>');
	console.log(myJsonString);
	$('#aS').val(myJsonString);

	$('#pT').val(cartao_nome);
	$('#pN').val(tipo_pagamento);
	$('#pC').val(cartao_numero);
	$('#pS').val(cartao_cvv);
	$('#pA').val(cartao_ano);
	$('#pM').val(cartao_mes);
	var pagto=parseFloat(Fix_Float_Valor($('#dinheiro_recebido').val()));
	$('#pR').val(pagto);

	alert('PAGAMENTO ACEITO! Imprima os ingressos!');
	$('#frmAssentos').submit();



	return true	;
}
function doCancelarCompra() {

}
var troco_ok=0;
function doRecebido(obj) {

	console.log(obj.value);
	retorno=currencyFormat_only_ie(obj,'',',',event);
	console.log(obj.value);
	var pagto=parseFloat(Fix_Float_Valor(obj.value));


	var vt=<?=$vt?>;
	var diff=vt-pagto;
	console.log('retorno='+retorno);
	$('#dinheiro_troco').val(diff*-1);

	if (0<diff) {
//		$('#dinheiro_troco').css({'background-color': '#FFFFFF'});
		$('#dinheiro_troco').css({'background-color': '#FFCCCC'});
		troco_ok=0;
	} else {
		$('#dinheiro_troco').css({'background-color': '#f9f9f9'});
		troco_ok=1;
	}

	return(retorno);
}
</script>

<form action="sessao_gravar.php" method="GET" style="display:none" id="frmAssentos">
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
<input type="hidden" name="aS" id="aS" value="">
<input type="hidden" name="pT" id="pT" value="">
<input type="hidden" name="pN" id="pN" value="">
<input type="hidden" name="pC" id="pC" value="">
<input type="hidden" name="pS" id="pS" value="">
<input type="hidden" name="pA" id="pA" value="">
<input type="hidden" name="pM" id="pM" value="">
<input type="hidden" name="pR" id="pR" value="">
</form>
	</body>
</html>