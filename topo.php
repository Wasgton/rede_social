<?php
include 'db_conection.php';
    session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
$id_usuario = $_SESSION['id_usuario'];

?>

<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rede Social</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="Js/home.js"></script>
    <script src="Js/buscar.js"></script>
    <script src="Js/comentario.js"></script>
    <script src="Js/seguidores.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/topo.css">
    <link rel="stylesheet" href="css/home.css">


</head>
<body>
<!-- BARRA TOPO -->
<div class="navbar-fixed-top">
    <header>
        <section class="top-nav">
            <nav class="navbar navbar-expand-lg py-0 topo">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <a href="index.php"><img class="logo" src="img/logo.png"></i></a>
                            </div>
                            <div class="col-sm-3 ">
                            </div>
                            <div class="col-sm-6" >
                                <!--Menu de usuario-->
                                <div class="nav-link navbar-nav pull-right" id="exCollapsingNavbar2">
                                    <a id="menu" class="nav-link btn-group open" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-caret-down fa-3" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="entrar">
                                        <li><a href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i> Home    </a></li>
                                        <li><a href="encontrar.php"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Procurar</a></li>
                                        <li><a href="editar_perfil.php?id=<?= $id_usuario?>"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i>Perfil</a></li>
                                        <li class="divider"></li>
                                        <li><a href="logoff.php"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> Sair </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </section>
    </header>
</div><br>
