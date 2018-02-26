<?php

include 'topo.php';

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
$profile_img = $_SESSION['imagem'];
$id_usuario = $_SESSION['id_usuario'];

?>

<div class="container-fluid body-feed">
    <div class="col-md-3 ">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="img-resposive">
                    <img class='img-perfil img-responsive img-circle hoverZoomLink' src='profile_img\<?=$profile_img?>'>
                </div>
                <h2 class="nick-pefil"><?=$_SESSION["nickname"];?></h2>

            </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="panel panel-default">

            <div id="div_pessoas" style="padding-bottom: 1%;" class="list-group">
                <?php
                $id_usuario = $_SESSION["id_usuario"];

                $query_post="select 
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
                            inner join seguidores s on s.seguindo_id_usuario = u.id_usuario
                            where s.id_usuario = $id_usuario";

                $resultado = mysqli_query(connect(),$query_post);

                if($resultado) {

                    while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {

                        $imagem = $registro['u_imagem'];
                        $nick = $registro['u_nickname'];
                        $email = $registro['u_email'];
                        $id = $registro['u_id_usuario'];
                        $usuario_seguido = isset($registro["s_id_seguidor"]) && !empty($registro["s_id_seguidor"]) ? 'S' : 'N';
                        $deixar_seguir_display = 'block';
                        $seguir_display = 'block';

                        echo "<a href='#' class='list-group-item'> ";
                        echo "<div class='container-fluid' >";
                        echo "<div class='col-sm-2'>";
                        echo " <img class='img-responsive img-circle hoverZoomLink pull-left' style='margin-top: 20%; height: 10%; width: 100%; margin-left: 0%;' src='profile_img/$imagem'>";
                        echo "</div>";
                        echo "<div class='col-sm-10'>
                            <strong>$nick</strong><small> - $email</small><br><br>";

                        if ($usuario_seguido == 'N') {
                            $deixar_seguir_display = 'none';
                        } else {
                            $seguir_display = 'none';
                        }

                        echo "<span class='pull-right'><button type='button' id='btn_deixar_seguir_$id' class='btn btn-danger btn_deixar_seguir' style='display: $deixar_seguir_display;' data-id_usuarios='$id'>Deixar de seguir</button></span>
                                  <span class='pull-right'><button type='button' id='btn_seguir_$id' class='btn btn-success btn_seguir' style='display: $seguir_display;' data-id_usuario='$id'>Seguir</button></span>
                                  </div>";
                        echo "</div>";
                        echo '</a>';
                    }

                }else{
                    echo"Erro ao recuperar os usuarios";
                }
                ?>

            </div>
        </div>
    </div>
    <div class="col-md-3 teste">
    </div>
</div>
