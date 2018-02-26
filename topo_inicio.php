<?php include 'db_conection.php';
error_reporting(1);

$erro = $_GET["erro"];
session_start();

if(isset($_SESSION["usuario"])){
    header('location:home.php');
}

?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rede Social</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inicio.css">
    <script src="Js/js.js"></script>

</head>

<body>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             <a href="index.php"><img class="logo" src="img/logo.png"></i></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="registro.php">Inscrever-se</a></li>
                <!-- ABRE O NAVBAR CASO O GET RETORNA ERRO -->
                <li class="<?php if($erro == 1 || $erro == 2){
                    echo 'open';
                } else{
                    echo '';
                }; ?>">
                    <a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
                    <ul class="dropdown-menu" aria-labelledby="entrar">
                        <div class="col-md-12 form-login">
                            <br><p class="collapse-color">Você possui uma conta?</p>
                            <br />
                            <form method="post" action="validar_login.php" id="formLogin">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
                                    </div>
                                    <?php error_reporting(1);
                                    if($_GET["erro"]==1){
                                        echo"<br><p class='erro'>Usuário e/ou senha inválido(s) !</p>";
                                    }elseif ($_GET["erro"]==2){
                                        echo"<br><p class='erro'>Conecte-se antes para acessar o Nice!</p>";
                                    }
                                    ?>
                                </div>
                                <input type="submit" name="entrar" class="btn btn-primary btn-block" id="btn_login" onclick="" value="Entrar">
                                <br><br>
                            </form>
                        </div>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>