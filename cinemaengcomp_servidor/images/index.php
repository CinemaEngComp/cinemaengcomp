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
	<title>
	<?=$global_config['titulo']?>
	</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
	<link rel="stylesheet" href="css/bootstrap-slider.min.css">
	<link rel="stylesheet" href="css/jquery.scrolling-tabs.min.css">
	<link rel="stylesheet" href="css/bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/featherlight.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.offcanvas.min.css">
	<link rel="stylesheet" href="css/core.css">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/style.css" >
	<link rel="stylesheet" href="css/responsive.css" >
	<link rel="stylesheet" href="css/custom.css" >
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
	<style type="text/css">
<!--
.style1 {color: #CC3300}
-->
        </style>
<script type="text/javascript">
function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
    </script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

	<body onLoad="MM_CheckFlashVersion('7,0,0,0','Content on this page requires a newer version of Adobe Flash Player. Do you want to download it now?');">
		<? require('n_header.php') ; ?>
		
		<section class="hero-3">
			<div class="container">
				<div class="row">
					<div class="hero-content">
						<div class="hero-date">
							<span class="day">12</span>
							<span class="month">Set</span>
						</div>
						<h1 class="hero-title">Deadpool 2</h1>
						<p class="hero-caption style1">Sequencia das aventuras do Mercenario Tagarela</p>
<!--						<div class="hero-location">
							<p><i class="fa fa-map-marker" aria-hidden="true"></i> TPC Summerlin, Las Vegas, NV</p>
						</div> -->
						<div class="hero-purchase-ticket">
						<a href="#">Compre agora!!!</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="section-todays-schedule">
			<div class="container">
				<div class="row">
					<div class="section-header">
						<h2>Sessoes de HOJE</h2>
						<span class="todays-date"><i class="fa fa-calendar" aria-hidden="true"></i> <strong>29</strong> Setembro 2017 </span>
					</div>
					<div class="section-content">
						<ul class="clearfix">
							<li class="event-1">
								<span class="event-time">18:00</span>
								<strong class="event-name">Deadpool - Leg</strong>
								<a href="#" class="get-ticket">Compre agora</a>
							</li>
							<li class="event-2">
								<span class="event-time">18:30</span>
								<strong class="event-name">Deadpool - Dub</strong>
								<a href="#" class="get-ticket">Compre agora</a>							</li>
					  <li class="event-3">
								<span class="event-time">22:00 <strong>Estreia</strong></span>
								<strong class="event-name">WarCraft</strong>
								<a href="#" class="sold-ticket">Lotado</a>
							</li>
							<li class="event-4">
								<span class="event-time">23:30 <strong>Estreia</strong></span>
								<strong class="event-name">X-Men</strong>
								<a href="#" class="sold-ticket">Lotado</a>
							</li>	
						</ul>
						<strong class="event-list-label">Lista <span>completa</span></strong>
					</div>
				</div>
			</div>
		</section>
<!--		
		<section class="section-upcoming-events">
			<div class="container">
				<div class="row">
					<div class="section-header">
						<h2>Estreias</h2>
						<p>As melhores estreias voce encontra e reserva aqui com antecedencia e sem fila!!!</p>
						<a href="#">Ver todas estreias</a>
					</div>
					<div class="section-content">
						<ul class="clearfix">
							<li>
								<div class="date">
									<a href="#">
										<span class="day">12</span>
										<span class="month">Outubro</span>
										<span class="year">2017</span>
									</a>
								</div>
								<a href="#">
									<img src="images/upcoming-event-1.jpg" alt="image">
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
										<span class="month">August</span>
										<span class="year">2016</span>
									</a>
								</div>
								<a href="#">
									<img src="images/upcoming-event-2.jpg" alt="image">
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
										<span class="month">August</span>
										<span class="year">2016</span>
									</a>
								</div>
								<a href="#">
									<img src="images/upcoming-event-3.jpg" alt="image">
								</a>
								<div class="info">
									<p>Envato Author SF Meetup <span>San Francisco</span></p>
									<a href="#" class="get-ticket">Get Ticket</a>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="spacer-35"></div>
		</section>
	-->	
		<section class="section-video-parallax">
			<div class="container">
				<div class="section-content">
					<h2>Assista Aqui</h2>
					<p>
					  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0','width','850','height','437','id','FLVPlayer','src','FLVPlayer_Progressive','flashvars','&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=Deadpool2&autoPlay=true&autoRewind=false','quality','high','scale','noscale','name','FLVPlayer','salign','lt','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','FLVPlayer_Progressive' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="850" height="437" id="FLVPlayer">
                        <param name="movie" value="FLVPlayer_Progressive.swf" />
                        <param name="salign" value="lt" />
                        <param name="quality" value="high" />
                        <param name="scale" value="noscale" />
                        <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=Deadpool2&autoPlay=true&autoRewind=false" />
                        <embed src="FLVPlayer_Progressive.swf" flashvars="&MM_ComponentVersion=1&skinName=Clear_Skin_1&streamName=Deadpool2&autoPlay=true&autoRewind=false" quality="high" scale="noscale" width="850" height="437" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" />                        
</object></noscript>
				    Veja o trailer dos seus filmes favoritos aqui mesmo e aproveite e compre seu ingresso</p>
				  <p>&nbsp;</p>
			  </div>
			</div>
		</section>
	<!--	
		<section class="section-event-category">
			<div class="spacer-35"></div>
			<div class="container">
				<div class="row">
					<div class="section-header">
						<h2>Event by Categories</h2>
					</div>
					<div class="section-content">
						<ul class="row clearfix">
							<li class="category-1 col-sm-4">
								<img src="images/event-category-1.jpg" alt="image">
								<a href="#"><span>Concerts</span></a>
							</li>
							<li class="category-2 col-sm-4">
								<img src="images/event-category-2.jpg" alt="image">
								<a href="#"><span>Sports</span></a>
							</li>
							<li class="category-3 col-sm-4">
								<img src="images/event-category-3.jpg" alt="image">
								<a href="#"><span>Threaters</span></a>
							</li>
							<li class="category-4 col-sm-4">
								<img src="images/event-category-4.jpg" alt="image">
								<a href="#"><span>Parties</span></a>
							</li>
							<li class="category-5 col-sm-4">
								<img src="images/event-category-5.jpg" alt="image">
								<a href="#"><span>Communities</span></a>
							</li>
							<li class="category-6 col-sm-4">
								<img src="images/event-category-6.jpg" alt="image">
								<a href="#"><span>Classes</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		
		<section class="section-recent-videos no-top">
			<div class="container">
				<div class="row">
					<div class="section-header">
						<h2>Recent Videos</h2>
					</div>
					<div class="section-content">
						<ul class="row clearfix">
							<li class="col-sm-3">
								<div class="video">
									<img src="images/recent-video-1.jpg" alt="image">
									<div class="video-player">
										<a href="#"><i class="fa fa-play" aria-hidden="true"></i></a> 
										<span>2:33</span>
									</div>
								</div>
								<h3 class="video-title">
									<a href="#">Envato Author Community Fun Hiking at Semeru Mountaint</a>
								</h3>
							</li>
							<li class="col-sm-3">
								<div class="video">
									<img src="images/recent-video-2.jpg" alt="image">
									<div class="video-player">
										<a href="#"><i class="fa fa-play" aria-hidden="true"></i></a> 
										<span>2:33</span>
									</div>
								</div>
								<h3 class="video-title">
									<a href="#">Nike Urban Running Chalenge with Kobe 2016</a>
								</h3>
							</li>
							<li class="col-sm-3">
								<div class="video">
									<img src="images/recent-video-3.jpg" alt="image">
									<div class="video-player">
										<a href="#"><i class="fa fa-play" aria-hidden="true"></i></a> 
										<span>2:33</span>
									</div>
								</div>
								<h3 class="video-title">
									<a href="#">Entrepreneurial Think Thank: Shifting the Education Paradigm</a>
								</h3>
							</li>
							<li class="col-sm-3">
								<div class="video">
									<img src="images/recent-video-4.jpg" alt="image">
									<div class="video-player">
										<a href="#"><i class="fa fa-play" aria-hidden="true"></i></a> 
										<span>2:33</span>
									</div>
								</div>
								<h3 class="video-title">
									<a href="#">Southeast Asia Weekend Festival 2016</a>
								</h3>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	-->	
		<section class="section-call-to-action"></section>
		<!--
		<section class="section-latest">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-8">
						<div class="latest-news">
							<div class="section-header">
								<h2>Latest News</h2>
							</div>
							<div class="section-content">
								<ul class="clearfix">
									<li class="row news-item">
										<div class="col-sm-5 news-item-img">
											<div class="date">
												<a href="#">
													<span class="day">25</span>
													<span class="month">August</span>
													<span class="year">2016</span>
												</a>
											</div>
											<a href="#"><img src="images/latest-news-1.jpg" alt="image"></a>
										</div>
										<div class="col-sm-7 news-item-info">
											<h3><a href="#">Attending the Indonesian Envato Authors National Meetup</a></h3>
											<span class="meta-data">6 hours ago  |  By <a href="#">Admin</a></span>
											<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesenlup.</p>
										</div>
									</li>
									<li class="row news-item">
										<div class="col-sm-5 news-item-img">
											<div class="date">
												<a href="#">
													<span class="day">25</span>
													<span class="month">August</span>
													<span class="year">2016</span>
												</a>
											</div>
											<a href="#"><img src="images/latest-news-2.jpg" alt="image"></a>
										</div>
										<div class="col-sm-7 news-item-info">
											<h3><a href="#">How to Join The Biggest Event Total Transverse Half Marathon</a></h3>
											<span class="meta-data">08:00 AM  |  By <a href="#">Admin</a></span>
											<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesenlup.</p>
										</div>
									</li>
									<li class="row news-item">
										<div class="col-sm-5 news-item-img">
											<div class="date">
												<a href="#">
													<span class="day">25</span>
													<span class="month">August</span>
													<span class="year">2016</span>
												</a>
											</div>
											<a href="#"><img src="images/latest-news-3.jpg" alt="image"></a>
										</div>
										<div class="col-sm-7 news-item-info">
											<h3><a href="#">Ramayana Ballet at Prambanan Temple Klaten, Central of Java</a></h3>
											<span class="meta-data">10:00 AM  |  By <a href="#">Admin</a></span>
											<p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesenlup.</p>
										</div>
									</li>
								</ul>
								<div class="new-item-pagination">
									<nav aria-label="Page navigation">
										<ul class="pagination">
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-md-4">
						<div class="latest-tweets">
							<div class="section-header">
								<h2>Latest Tweets</h2>
							</div>
							<div class="section-content">
								<div class="twitter-header clearfix">
									<div class="twitter-name">
										<a href="#">
											<img src="images/twitter-avatar.png" alt="image">
											<strong>myticket.com</strong>
											<span>@myticket</span>
										</a>
									</div>
									<div class="twitter-btn">
										<a href="#">Follow</a>
									</div>
								</div>
								<div class="tweet-list clearfix">
									<ul class="clearfix">
										<li class="row tweet-item">
											<div class="col-sm-10">
												<p><a href="#">@myticket</a> Lorem ipsum dolor sit amet, consecter adipiscing elit, sed diam nonummy nibh euismod dolore magna aliquam <a href="#">#EratVolutpat</a>.</p>
											</div>
											<div class="col-sm-2">
												<span>17 min</span>
											</div>
										</li>
										<li class="row tweet-item">
											<div class="col-sm-10">
												<p><a href="#">@myticket</a>Lorem ipsum dolor sit amet, consecter adipiscing elit, sed diam<a href="#">#EratVolutpat</a>.</p>
											</div>
											<div class="col-sm-2">
												<span>18 min</span>
											</div>
										</li>
										<li class="row tweet-item">
											<div class="col-sm-10">
												<p><a href="#">@myticket</a> Lorem ipsum dolor sit amet, consecter adipiscing elit, sed diam nonummy nibh euismod dolore magna aliquam <a href="#">#EratVolutpat</a>.</p>
											</div>
											<div class="col-sm-2">
												<span>19 min</span>
											</div>
										</li>
										<li class="row tweet-item">
											<div class="col-sm-10">
												<p><a href="#">@myticket</a>Lorem ipsum dolor sit amet, consecter adipiscing elit, sed diam<a href="#">#EratVolutpat</a>.</p>
											</div>
											<div class="col-sm-2">
												<span>19 min</span>
											</div>
										</li>
										<li class="row tweet-item">
											<div class="col-sm-10">
												<p><a href="#">@myticket</a> Lorem ipsum dolor sit amet, consecter adipiscing elit, sed diam nonummy nibh euismod dolore magna aliquam <a href="#">#EratVolutpat</a>.</p>
											</div>
											<div class="col-sm-2">
												<span>20 min</span>
											</div>
										</li>
										<li class="row tweet-item">
											<div class="col-sm-10">
												<p><a href="#">@myticket</a>Lorem ipsum dolor sit amet, consecter adipiscing elit, sed diam<a href="#">#EratVolutpat</a>.</p>
											</div>
											<div class="col-sm-2">
												<span>22 min</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		-->
		<section class="section-stats"></section>
		
		<section class="section-sponsors">
			<div class="container">
				<div class="section-content">
					<ul class="row">
						<li class="col-sm-3">
							<a href="#">
								<img src="images/paramounts_logo.png" alt="image">
							</a>
						</li>
						<li class="col-sm-3">
							<a href="#">
								<img src="images/sony_logo.png" alt="image">
							</a>
						</li>
						<li class="col-sm-3">
							<a href="#">
								<img src="images/warner_bros_pictures_logo.png" alt="image">
							</a>
						</li>
						<li class="col-sm-3">
							<a href="#">
								<img src="images/universal_logo.png" alt="image">
							</a>
						</li>
					</ul>
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

		<footer id="colophon" class="site-footer">
			<div class="top-footer">
				<div class="container">
					<div class="row">
						
						<div class="col-md-8">
							<a href="#"><img src="http://cinemaengcomp.nucci.com.br/images/logo1/logo1.png" alt="logo"></a>
						</div>
						<div class="col-md-4">
						
						<p>&copy; 2017 CinemaEngComp - Projeto Conclusao de Curso</p>
						</div>
					</div>
					
				</div>
			</div>
			<div class="main-footer">
				<div class="container">
					<div class="row">
						<div class="footer-1 col-md-9">
							<div class="about clearfix">
								<h3>Sobre</h3>
								<ul>
									<li><a href="http://portal.anhembi.br/" target="_blank">Anhembi Morumbi</a></li>
									<li><a href="#">Engenharia da Computacao</a></li>
									<li><a href="#">Turma 2013</a></li>
								</ul>
							</div>
						<div class="support clearfix">
								<h3>Grupo</h3>
								<ul>
									<li><a href="#">Willian</a></li>
									<li><a href="#">Rodrigo</a></li>
									<li><a href="#">Barbara</a></li>
									<li><a href="#">Natalia</a></li>
									<li><a href="#">Vinicius</a></li>
								</ul>
							</div>

						</div>
<!--					<div class="footer-2 col-md-3">
							<div class="footer-dashboard">
								<h3>MyTicket Dashboard</h3>
								<ul>
									<li><a href="#">Professional</a></li>
									<li><a href="#">Subscriber Login</a></li>
								</ul>
							</div>
						</div>
-->
					</div>
				</div>
			</div>
		</footer>
		
		<script src="js/jquery-3.2.0.min.js"></script>
		<script src="js/bootstrap-slider.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/jquery.scrolling-tabs.min.js"></script>
		<script src="js/jquery.countdown.min.js"></script>
		<script src="js/jquery.flexslider-min.js"></script>
		<script src="js/jquery.imagemapster.min.js"></script>
		<script src="js/tooltip.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/featherlight.min.js"></script>
		<script src="js/featherlight.gallery.min.js"></script>
		<script src="js/bootstrap.offcanvas.min.js"></script>
		<script src="js/main.js"></script>
	
<!-- Mainly scripts -->
<!--   <script src="js/jquery-2.1.1.js"></script> -->
<!--    <script src="/temas/admin/v100/js/bootstrap.min.js"></script> -->
    <script src="/temas/admin/v100/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/temas/admin/v100/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/temas/admin/v100/js/inspinia.js"></script>
    <script src="/temas/admin/v100/js/plugins/pace/pace.min.js"></script>
    <script src="/temas/porto/assets/vendor/pnotify/pnotify.custom.js"></script>


 <!--   <script src="sistema.js"></script> -->
	<script src="checklogin.js"></script>



	</body>
</html>