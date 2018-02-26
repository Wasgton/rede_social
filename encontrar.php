<?php
include 'topo.php';

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}

$nome = explode(" ", $_SESSION["nickname"]);
$nick = $nome[0];

$id_usuario = $_SESSION['id_usuario'];
// conta seguidores

$query = "select count(id_seguidor) as total_seguindo,
            (select count(seguindo_id_usuario) from seguidores where seguindo_id_usuario = $id_usuario) as total_seguido
            from seguidores
            where id_usuario = $id_usuario";

$result = mysqli_query(connect(),$query);
$dados_usuario = mysqli_fetch_array($result);

if($dados_usuario!==null) {
    $seguindo = $dados_usuario["total_seguindo"];
    $seguido = $dados_usuario["total_seguido"];
    $profile_img = $_SESSION['imagem'];
}
?>

<div class="container-fluid body-feed">
    <div class="col-md-3 ">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="img-resposive">
                    <img class='img-perfil img-responsive img-circle hoverZoomLink' src='profile_img\<?=$profile_img?>'>
                </div>
                <h2 class="nick-pefil"><?=$_SESSION["nickname"];?></h2>
                <hr>
                <div class="col-md-6"><a style="text-decoration: none; color: #1b1e21;" href="seguidores.php"><b>Seguidores</b> <br> <?= $seguido ;?></a></div>
                <div class="col-md-6"><a style="text-decoration: none; color: #1b1e21;" href="seguindo.php"><b>Seguindo</b>   <br> <?= $seguindo;?></a></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="panel panel-default">
            <div class="panel-body">
                <form id="form_procurar_pessoas" class="input-group">
                    <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <input type="text" id="input_search" name="input_search" class="form-control" placeholder="Quem você está procurando <?= $nick;?>?" maxlength="140">

                </form>
            </div>
        </div>
        <div id="div_pessoas" class="list-group">

        </div>
    </div>
    <div class="col-md-3 teste">
    </div>
</div>