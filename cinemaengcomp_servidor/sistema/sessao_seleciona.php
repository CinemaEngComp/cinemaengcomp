<?

require ('n_connector.php');



	$sql=" select * from filmes where codigo_filme=$cf ";

	$result = mysql_query($sql);
	if (!$result) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}
	$rowFILME = mysql_fetch_array($result);





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

	.section-artist-featured-header {
	    background: url(/images/filmes/<?=$cf?>/1539x322.jpg) no-repeat center center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	    min-height: 322px;
	    position: relative;
	}

	</style>


	<body>
	
	<? 
		require('n_header.php');
	?>
		
		<section class="section-artist-featured-header">
			<div class="container">
				<div class="section-content">
					<h1><?=$n?></h1>
				</div>
			</div>
		</section>
		
		<section class="section-artist-page-header">
			<div class="container">
				<h1 class="entry-title">Encontrados <?=$q?> sessoes para esse filme na data selecionada</h1>
			</div>
		</section>
	
		<section class="section-artist-content">
			<div class="container">
				<div class="row">
					<div id="primary" class="col-sm-12 col-md-8">


<?
	$first=' class="active" ';

	$sql=" select data_sessao, DATE_FORMAT(data_sessao,'%Y') as ANO, DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES,horario_sessao
,DATE_FORMAT(horario_sessao,'%H:%i') as TIME , DATE_FORMAT(data_sessao,'%d/%m/%Y') as DATASESSAO,sessao.codigo_sessao
, DATE_FORMAT(data_sessao,'%w') as DIASEMANA
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

order  by horario_sessao  ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}

	$first=' active ';
	while($rowcombo = mysql_fetch_array($resultcombo)){

		$codigosessao=$rowcombo['codigo_sessao'];
		$ano=$rowcombo['ANO'];
		$mes=$rowcombo['MES'];
		$dia=$rowcombo['DIA'];
		$TIME=$rowcombo['TIME'];
		$QUANT=$rowcombo['LIVRE'];
		$datasessao=$rowcombo['data_sessao'];
		$showdata=$rowcombo['DATASESSAO'];
		$diasemana=$dias_da_semana[$rowcombo['DIASEMANA']];
		$sala=$rowcombo['codigo_sala'];

//		$myCombo.=montar_combo($rowcombo['snome_grp'],$rowcombo['cod_grp'],$cod_grp);

?>





					
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3><?=$n?></h3>
									<ul class="row">
										<li class="col-sm-5">
											<span><?=utf8_decode('Poltronas Disponíveis');?></span>
											<?=$QUANT;?>
										</li>
										<li class="col-sm-4">
											<span><?=utf8_decode($diasemana)?></span>
											<?=$showdata.' '.$TIME?>
										</li>
										<li class="col-sm-3">
											<span>Sala</span>
											<?=$sala?>
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span><?=utf8_decode('Preço');?></span>
									<strong>R$35,00</strong>
									<a href="sessao_quantidade.php?cf=<?=$cf?>&n=<?=$n?>&q=<?=$q?>&d=<?=$d?>&sl=<?=$sala?>&h=<?=$TIME?>&s=<?=$codigosessao?>">COMPRAR</a>
								</div>
							</div>
						</div>
<?
	}
?>
<!--

						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Buffalo</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											First Niagara Center
											<span class="location">Buffalo, NY</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 1st, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$99</strong>
									<span class="tickets-left">19 tickets left</span>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Auburn</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											Palace Of Auburn Hills
											<span class="location">Auburn Hills, MI</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 4th, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$112</strong>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Pittsburgh</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											CONSOL Energy Center
											<span class="location">Pittsburgh, PA</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 4th, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$120</strong>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Buffalo</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											First Niagara Center
											<span class="location">Buffalo, NY</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 1st, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$99</strong>
									<span class="tickets-left">19 tickets left</span>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Auburn</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											Palace Of Auburn Hills
											<span class="location">Auburn Hills, MI</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 4th, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$112</strong>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Pittsburgh</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											CONSOL Energy Center
											<span class="location">Pittsburgh, PA</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 4th, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$120</strong>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Buffalo</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											First Niagara Center
											<span class="location">Buffalo, NY</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 1st, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$99</strong>
									<span class="tickets-left">19 tickets left</span>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Auburn</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											Palace Of Auburn Hills
											<span class="location">Auburn Hills, MI</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 4th, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$112</strong>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3>Serena Gimez Live in Pittsburgh</h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Venue</span>
											CONSOL Energy Center
											<span class="location">Pittsburgh, PA</span>
										</li>
										<li class="col-sm-4">
											<span>Saturday</span>
											August. 4th, 2016
										</li>
										<li class="col-sm-3">
											<span>Time</span>
											07:00 PM
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>Price From</span>
									<strong>$120</strong>
									<a href="#">Book Now</a>
								</div>
							</div>
						</div>
						
						<div class="artist-event-footer">
							<ul class="pagination">
								<li>
									<a href="#" aria-label="Previous">
										<span aria-hidden="true"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Anterior</span>
									</a>
								</li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li class="active"><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li>
									<a href="#" aria-label="Next">
										<span aria-hidden="true">Proximo <i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
									</a>
								</li>
							</ul>
						</div>

-->

					</div>
					
					<div id="secondary" class="col-sm-12 col-md-4">
						<div class="artist-details">
							<img src="/images/filmes/<?=$rowFILME['codigo_filme']?>/371x153.jpg" alt="image">
							<div class="artist-details-title">
								<h3><?=$n?></h3>
								<a href="#">Seguir</a>
							</div>
							
							<div class="artist-details-info">
								<h4>Duracao: <?=$rowFILME['duracao_filme']?></h4>
								<h4>Classificacao: <?=$rowFILME['classificacao_filme']?></h4>
								<h4>Sobre</h4>
								<p><?=$rowFILME['sinopse_filme']?></p>
							</div>
						</div>
						
	
					</div>
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
		<script src="/js/main.js"></script>	
		
	</body>
</html>