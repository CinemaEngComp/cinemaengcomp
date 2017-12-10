<?

require ('n_connector.php');

require "../lib/phpqrcode/qrlib.php";   

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

body {
    font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    background-color: #FFF;
    font-size: 13px;
    color: #676a6c;
    overflow-x: hidden;
}
.section-artist-content {
    background: #FFF;
    padding: 00px 0;
}

.section-artist-content .artist-event-item {
 	border: 1px solid #cecece;

 }
hr.style5 {
	background-color: #fff;
	border-top: 2px dashed #8c8b8b;
	margin-bottom: 100px;
	margin-top: 100px;
}


	</style>
	<script>

var assento_bloqueado=[];
//assento_bloqueado['I3']=1;
<?	

$ingressos_lista=str_replace('|',',',$ingressos);
$ingressos_lista.="0";


$sql=" select data_sessao, DATE_FORMAT(data_sessao,'%Y') as ANO, DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES,horario_sessao
,DATE_FORMAT(horario_sessao,'%H:%i') as TIME , DATE_FORMAT(data_sessao,'%d/%m/%Y') as DATASESSAO,sessao.codigo_sessao
, DATE_FORMAT(data_sessao,'%w') as DIASEMANA,qrcode_ingresso
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

     
where ingresso.codigo_ingresso in ($ingressos_lista)
order  by horario_sessao ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}

	$first=' active ';
?>
	</script>
	<body>
<!-- <?=$sql?> -->


		<section class="section-artist-content">
			<div class="container">
				<div class="row">
					<div id="primary" class="col-sm-12">
<?
	$PNG_TEMP_DIR="../lib/phpqrcode/temp/";
	while($rowcombo = mysql_fetch_array($resultcombo)){

		$data=$rowcombo['qrcode_ingresso'];

		 // user data
        $filename = 'ingresso'.md5($data).'.png';
        $filename_FULL = $PNG_TEMP_DIR.$filename;
		QRcode::png($data, $filename_FULL);

?>
					
						<div class="artist-event-item">
							<div class="row">
								<div class="artist-event-item-info col-sm-9">
									<h3><?=$n?></h3>
									<ul class="row">
										<li class="col-sm-5">
											<span>Assento</span>
											<?=strtoupper($rowcombo['nome_cadeira'])?>
										</li>
										<li class="col-sm-4">
											<span>Sessao</span>
											<?=$rowcombo['DATASESSAO']." ".$rowcombo['TIME'];?>
										</li>
										<li class="col-sm-3">
											<span>Sala</span>
											<?=$rowcombo['codigo_sala'];?>
										</li>
									</ul>
								</div>
								<div class="artist-event-item-price col-sm-3">
									<span>QrCode</span>
									<img src="<?=$filename_FULL?>" alt="image">
								</div>
							</div>
							<div class="row" style="text-align:center">
							<small>(c) Anhembi Morumbi - Engenharia da Computacao, Turma 2013, Willian,Rodrigo,Barbara,Natalia,Vinicius. Ingresso valido apenas para a sessao e assento escolhida. Em caso de perda nao havera reembolso por parte do estabelecimento. Assentos estarao travado ao entrar na sessao. Destrave seu assento pelo aplicativo Android CinemaEngComp. Lembre que Pipoca tambem faz parte da dirvesao. Muita pimenta na pipoca pode estragar sua experiencia conosco, use com moderacao. Aproveite o filme.</small>
							</div>
						</div>
						<hr class="style5">
	<? 
		}
	?>
					</div>

				</div>
			</div>
		</section>



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