<?

require ('n_connector.php');

	$ingressos=$c;


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
				<h1 class="entry-title">Compra Efetuada comSucesso</h1>
			</div>
		</section>
	
		<section class="section-page-content">
			<div class="container">
				<div class="row">
	   
					<div id="primary" class="col-sm-12 col-md-12">
						<div class="section-download-ticket">
							<img src="/images/download-ticket-img.png" alt="image">
							<p>Mais uma compra efetuada para o filme "<strong><?=$n?></strong>". </p>
							<p>Espera a impressao dos ingressos. Caso nao ocorra aperte o botao <span>IMPRIMIR INGRESSO</span> abaixo.</p>
							<a href="sessao_imprimir.php?n=<?=$n?>&cf=<?=$cf?>&s=<?=$s?>&c=<?=$ingressos?>" target="_blank" class="primary-link">IMPRIMIR INGRESSO</a>
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



</script>

<form action="sessao_pagar.php" method="GET" style="display:none" id="frmAssentos">
<input type="hidden" name="cf" value="<?=$cf?>">
<input type="hidden" name="n" value="<?=$n?>">
<input type="hidden" name="q" value="<?=$q?>">
<input type="hidden" name="d" value="<?=$d?>">
<input type="hidden" name="h" value="<?=$h?>">
<input type="hidden" name="s" value="<?=$s?>">
<input type="hidden" name="vt" id="vt" value="<?=$vt?>">
<input type="hidden" name="q0" id="q0" value="<?=$q0?>">
<input type="hidden" name="q1" id="q1" value="<?=$q1?>">
<input type="hidden" name="q2" id="q2" value="<?=$q2?>">
<input type="hidden" name="qT" id="qT" value="<?=$qT?>">
<input type="hidden" name="aS" id="aS" value="<?=$aS?>">
</form>
	</body>
</html>