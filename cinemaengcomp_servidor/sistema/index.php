<?

require ('n_connector.php');



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

	<body>
	<? 
		require('n_header.php');
	?>
	
		<section class="section-page-header">
			<div class="container">
				<h1 class="entry-title">Todos Filmes</h1>
			</div>
		</section>
	
		<section class="section-calendar-events">
			<div class="container">
				<div class="row">
					<div class="section-header">
						<ul class="nav nav-tabs event-tabs" role="tablist">
<?

	$sql=" select data_sessao, DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES from sessao
where CONCAT(data_sessao,' ',horario_sessao)>=now() 
group by data_sessao  ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: " . mysql_error() ); exit();
	}

	$first=' class="active" ';
	while($rowcombo = mysql_fetch_array($resultcombo)){
//		$myCombo.=montar_combo($rowcombo['snome_grp'],$rowcombo['cod_grp'],$cod_grp);

?>
							<li role="presentation" <?=$first?> >
								<a href="#tab<?=$rowcombo['MES'].$rowcombo['DIA']?>" role="tab" data-toggle="tab"><?=$rowcombo['DIA']?> <span><?=$mesesSHORT[$rowcombo['MES']]?></span></a>
							</li>
<?
		$first='';
	}



?>

						</ul>
					</div>
					<div class="section-content">
						<div class="tab-content">
<?
	$first=' class="active" ';

	$sql=" select data_sessao, DATE_FORMAT(data_sessao,'%Y') as ANO, DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES from sessao
where CONCAT(data_sessao,' ',horario_sessao)>=now() 
group by data_sessao  ";
	$resultcombo = mysql_query($sql);
	if (!$resultcombo) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}

	$first=' active ';
	while($rowcombo = mysql_fetch_array($resultcombo)){

		$ano=$rowcombo['ANO'];
		$mes=$rowcombo['MES'];
		$dia=$rowcombo['DIA'];
		$datasessao=$rowcombo['data_sessao'];

//		$myCombo.=montar_combo($rowcombo['snome_grp'],$rowcombo['cod_grp'],$cod_grp);

?>





						    <div role="tabpanel" class="tab-pane <?=$first?>" id="tab<?=$rowcombo['MES'].$rowcombo['DIA']?>">
								<ul class="clearfix">
<?

	$sql=" select data_sessao,horario_sessao, DATE_FORMAT(data_sessao,'%Y') as ANO,DATE_FORMAT(data_sessao,'%d') as DIA,DATE_FORMAT(data_sessao,'%m') as MES ,nome_filme,sessao.codigo_filme,count(sessao.codigo_filme) as QUANT
from sessao inner join filmes on sessao.codigo_filme=filmes.codigo_filme
where CONCAT(data_sessao,' ',horario_sessao)>=now() 
and data_sessao='$datasessao'

group by data_sessao,sessao.codigo_filme
order by  nome_filme ";
	$result = mysql_query($sql);
	if (!$result) {
			echo("Error performing query: $sql " . mysql_error() ); exit();
	}
//QUANT
		$first=' class="active" ';
		while($row = mysql_fetch_array($result)){
	//		$myCombo.=montar_combo($rowcombo['snome_grp'],$rowcombo['cod_grp'],$cod_grp);

?>
									<li>
										<div class="date">
											<a href="#">
												<span class="day"><?=$row['DIA']?></span>
												<span class="month"><?=$mesesSHORT[$row['MES']]?></span>
												<span class="year"><?=$row['ANO']?></span>
											</a>
										</div>
										<a href="sessao_seleciona.php?cf=<?=$row['codigo_filme']?>&n=<?=$row['nome_filme']?>&q=<?=$row['QUANT']?>&d=<?=$row['data_sessao']?>">
											<img src="/images/filmes/<?=$row['codigo_filme']?>/390x280.jpg" alt="image">
										</a>
										<div class="info">
											<p><?=$row['nome_filme']?><span><?=$row['QUANT']?> sessoes</span></p>
											<a href="sessao_seleciona.php?cf=<?=$row['codigo_filme']?>&n=<?=$row['nome_filme']?>&q=<?=$row['QUANT']?>&d=<?=$row['data_sessao']?>" class="get-ticket">Comprar</a>
										</div>
									</li>
<?
		}

		$first='';

?>
</ul>
</div>

<?
	}

	$first='';

?>

<!--


									<li>
										<div class="date">
											<a href="#">
												<span class="day">26</span>
												<span class="month">May</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-2.jpg" alt="image">
										</a>
										<div class="info">
											<p>Kiai Kanjeng Orchestra <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">27</span>
												<span class="month">May</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-3.jpg" alt="image">
										</a>
										<div class="info">
											<p>Envato Author SF Meetup <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">28</span>
												<span class="month">May</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-4.jpg" alt="image">
										</a>
										<div class="info">
											<p>FIFA WORLD CUP 2016 <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">May</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-5.jpg" alt="image">
										</a>
										<div class="info">
											<p>Prep Football America <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">May</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-6.jpg" alt="image">
										</a>
										<div class="info">
											<p>UEFA Champions League <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab2">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">25</span>
												<span class="month">Jun</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-1.jpg" alt="image">
										</a>
										<div class="info">
											<p>BMW Open Championship <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">26</span>
												<span class="month">Jun</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-2.jpg" alt="image">
										</a>
										<div class="info">
											<p>Kiai Kanjeng Orchestra <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">27</span>
												<span class="month">Jun</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-3.jpg" alt="image">
										</a>
										<div class="info">
											<p>Envato Author SF Meetup <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab3">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">28</span>
												<span class="month">Jul</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-4.jpg" alt="image">
										</a>
										<div class="info">
											<p>FIFA WORLD CUP 2016 <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Jul</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-5.jpg" alt="image">
										</a>
										<div class="info">
											<p>Prep Football America <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Jul</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-6.jpg" alt="image">
										</a>
										<div class="info">
											<p>UEFA Champions League <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab4">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Aug</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-6.jpg" alt="image">
										</a>
										<div class="info">
											<p>UEFA Champions League <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab5">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">25</span>
												<span class="month">Sep</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-1.jpg" alt="image">
										</a>
										<div class="info">
											<p>BMW Open Championship <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">26</span>
												<span class="month">Sep</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-2.jpg" alt="image">
										</a>
										<div class="info">
											<p>Kiai Kanjeng Orchestra <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">27</span>
												<span class="month">Sep</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-3.jpg" alt="image">
										</a>
										<div class="info">
											<p>Envato Author SF Meetup <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">28</span>
												<span class="month">Sep</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-4.jpg" alt="image">
										</a>
										<div class="info">
											<p>FIFA WORLD CUP 2016 <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab6">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">28</span>
												<span class="month">Oct</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-4.jpg" alt="image">
										</a>
										<div class="info">
											<p>FIFA WORLD CUP 2016 <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Oct</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-5.jpg" alt="image">
										</a>
										<div class="info">
											<p>Prep Football America <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Oct</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-6.jpg" alt="image">
										</a>
										<div class="info">
											<p>UEFA Champions League <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab7">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">25</span>
												<span class="month">Nov</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-1.jpg" alt="image">
										</a>
										<div class="info">
											<p>BMW Open Championship <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">26</span>
												<span class="month">Nov</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-2.jpg" alt="image">
										</a>
										<div class="info">
											<p>Kiai Kanjeng Orchestra <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">27</span>
												<span class="month">Nov</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-3.jpg" alt="image">
										</a>
										<div class="info">
											<p>Envato Author SF Meetup <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab8">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Dec</span>
												<span class="year">2016</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-5.jpg" alt="image">
										</a>
										<div class="info">
											<p>Prep Football America <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab9">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">28</span>
												<span class="month">Jan</span>
												<span class="year">2017</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-4.jpg" alt="image">
										</a>
										<div class="info">
											<p>FIFA WORLD CUP 2016 <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							
							</div>
						    <div role="tabpanel" class="tab-pane" id="tab10">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">27</span>
												<span class="month">Feb</span>
												<span class="year">2017</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-3.jpg" alt="image">
										</a>
										<div class="info">
											<p>Envato Author SF Meetup <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							</div>
				
							<div role="tabpanel" class="tab-pane" id="tab11">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Mar</span>
												<span class="year">2017</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-5.jpg" alt="image">
										</a>
										<div class="info">
											<p>Prep Football America <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">29</span>
												<span class="month">Mar</span>
												<span class="year">2017</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-6.jpg" alt="image">
										</a>
										<div class="info">
											<p>UEFA Champions League <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							</div>
							
						    <div role="tabpanel" class="tab-pane" id="tab12">
								<ul class="clearfix">
									<li>
										<div class="date">
											<a href="#">
												<span class="day">25</span>
												<span class="month">Apr</span>
												<span class="year">2017</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-1.jpg" alt="image">
										</a>
										<div class="info">
											<p>BMW Open Championship <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
									<li>
										<div class="date">
											<a href="#">
												<span class="day">26</span>
												<span class="month">Apr</span>
												<span class="year">2017</span>
											</a>
										</div>
										<a href="#">
											<img src="/images/upcoming-event-2.jpg" alt="image">
										</a>
										<div class="info">
											<p>Kiai Kanjeng Orchestra <span>San Francisco</span></p>
											<a href="#" class="get-ticket">Get Ticket</a>
										</div>
									</li>
								</ul>
							</div>
	-->


						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="section-newsletter">
			<div class="container">
				<div class="section-content">
					<h2>Fique atualizado com as novidades e promocoes!</h2>
					<p>Se cadastre agora para nao perder seu filme favorito e participar dos sorteios de ingressos.</p>
					<div class="newsletter-form clearfix">
						<input type="email" placeholder="Seu email">
						<input type="submit" value="Enviar">
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