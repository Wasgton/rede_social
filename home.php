<?php
include 'topo.php';

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
$nome = explode(" ", $_SESSION["nickname"]);
$nick = $nome[0];
$id_usuario = $_SESSION['id_usuario'];
// conta seguidores

$query = "  select count(id_seguidor) as total_seguindo,
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
        <div class="panel panel-default perfil">
            <div class="panel-body">
                <div class="img-resposive">
                    <img class='img-perfil img-responsive img-circle hoverZoomLink' src='profile_img\<?=$profile_img?>'>
                </div>
                <h2 class="nick-pefil"><?=$_SESSION["nickname"];?></h2>
                <hr>
                <div class="col-md-6"><a style="text-decoration: none; color: #1b1e21;" href="seguidores.php"><b>Seguidores</b> <br><?= $seguido;?></a></div>
                <div class="col-md-6"><a style="text-decoration: none; color: #1b1e21;" href="seguindo.php"><b>Seguindo</b>  <br><?= $seguindo;?></a></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="input-group" style="width: 100%;">
                    <form class="input-group">
                        <input type="text" class="form-control" id="post" placeholder="O que você tem a dizer hoje <?= $nick;?>?" maxlength="140">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" id="btn_post">Postar</button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
        <div id="posts" class="list-group">

        </div>

    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div id="div_pessoas" style="padding-bottom: 1%;" class="list-group">
            <?php

            $query_post="      select
                                    u.id_usuario as u_id_usuario,
                                    u.usuario as u_usuario,
                                    u.email as u_email,
                                    u.senha as  u_senha,
                                    u.nome as u_nome,
                                    u.data_nascimento as u_data_nascimento,
                                    u.nickname as u_nickname,
                                    u.imagem as u_imagem,
                                    u.sexo as u_sexo,
                                    s.id_seguidor as s_id_seguidor,
                                    s.id_usuario as s_id_usuario,
                                    s.seguindo_id_usuario as s_seguindo_id_usuario,
                                    s.data_registro as s_data_registro
                                from usuarios u 
                                inner join seguidores s on u.id_usuario = s.id_usuario
                                where s.seguindo_id_usuario = $id_usuario
                                order by s_data_registro desc 
                                LIMIT 5";

            $resultado = mysqli_query(connect(),$query_post);

            if($resultado) {

                while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {

                    $imagem = $registro['u_imagem'];
                    $nick = $registro['u_nickname'];
                    $email = $registro['u_email'];
                    $id = $registro['u_id_usuario'];
                    $usuario_seguido = isset($registro["s_id_seguidor"]) && !empty($registro["s_id_seguidor"]) ? 'S' : 'N';

                    echo "<div class='list-group-item'> ";
                    echo "<div class='container-fluid' >";
                    echo "<div class='col-sm-4'>";
                    echo " <img class='img-responsive img-circle hoverZoomLink pull-left' style='margin-top: 20%; height: 10%; width: 200%; margin-left: 0%;' src='profile_img/$imagem'>";
                    echo "</div>";
                    echo "<div class='col-sm-8'>
                            <strong>$nick</strong><small> - $email</small><br><br>";

                    echo "</div>";
                    echo "</div>";
                    echo '</div>';
                }

            }else{
                echo"Erro ao recuperar os usuarios";
            }
            ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>