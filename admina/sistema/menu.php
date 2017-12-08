<?

require ('n_connector.php');



?>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$cookie_usuario['nome']?></strong>
                             </span> <span class="text-muted text-xs block"> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
<!--                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
-->                            <li class="divider"></li>
                            <li><a href="/">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li class="active">
                    <a href="sistema.php"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
<!--                    <ul class="nav nav-second-level">
                        <li><a href="index.html">Dashboard v.1</a></li>
                        <li class="active"><a href="dashboard_2.html">Dashboard v.2</a></li>
                        <li><a href="dashboard_3.html">Dashboard v.3</a></li>
                        <li><a href="dashboard_4_1.html">Dashboard v.4</a></li>
                        <li><a href="dashboard_5.html">Dashboard v.5 </a></li>
                    </ul> -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-video-camera"></i> <span class="nav-label">Filmes</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="filme.php">Gerenciar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-sitemap"></i> <span class="nav-label"><?=utf8_decode('Sessão')?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="sessao.php">Gerenciar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Sala</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="sala.php">Gerenciar</a></li>
                    </ul>
                </li>
<!--                <li>
                    <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ingresso</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="contacts.html">Listagem</a></li>
                    </ul>
                </li> -->
                <li>
                    <a href="#"><i class="fa fa-group"></i> <span class="nav-label"><?=utf8_decode('Usuários')?></span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="funcionario.php">Gerenciar</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
