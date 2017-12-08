<?

require ('n_connector.php');


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
	    <link href="/temas/porto/assets/vendor/pnotify/pnotify.custom.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Administracao CinemaEngComp</h2>

                <p>
                    <?=utf8_decode('Este projeto é criação da equipe DINAMICA:')?>
                </p>

                <p>
                    Willian, Rodrigo, Barbara, Natalia e Vinicius
                </p>

                <p>
                    <?=utf8_decode('Anhembi Morumbi, Engenharia da Computação, Turma 2013')?>
                </p>

                <p>
                    <small><?=utf8_decode('"Na teoria, teoria e prática são iguais. Na prática, não." - Yogi Berra.')?></small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="index.html">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Username" required="" id="ni_login_email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required="" id="ni_login_senha">
                        </div>
                        <button type="button" class="btn btn-primary block full-width m-b" id="ni_LoginBtn">Login</button>

                        <a href="#">
                            <small>Esqueceu a senha?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Nao tenho conta?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.html">Criar uma contas</a>
                    </form>
                    <p class="m-t">
                        <small>CinemaEngComp &copy; 2017</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright CinemaEngComp
            </div>
            <div class="col-md-6 text-right">
               <small>© 2017</small>
            </div>
        </div>
    </div>


	<script src="/js/jquery-3.2.0.min.js"></script>
	<script src="checklogin.js"></script>
    <script src="/temas/porto/assets/vendor/pnotify/pnotify.custom.js"></script>

</body>

</html>
