<?php

include 'db_conection.php';

session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
    $id_usuario = $_SESSION["id_usuario"];
    $usuario = $_POST["input_search"];

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
                from usuarios u left join seguidores s on (s.id_usuario = $id_usuario and u.id_usuario = s.seguindo_id_usuario) 
                where (u.nickname like '%$usuario%' or u.usuario like '%$usuario%' or u.nome like '%$usuario%') 
                and u.id_usuario <> $id_usuario";

    $resultado = mysqli_query(connect(),$query_post);

    if($resultado){

        while($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

            $nick = $registro['u_nickname'];
            $email = $registro['u_email'];
            $id = $registro['u_id_usuario'];
            $usuario_seguido = isset($registro["s_id_seguidor"]) && !empty($registro["s_id_seguidor"]) ? 'S' : 'N';
            $deixar_seguir_display = 'block';
            $seguir_display = 'block';

    echo"<a href='#' class='list-group-item'> ";
        echo"<div class='container-fluid' >";
            echo"<div class='col-sm-2'>";
                    if($registro["u_sexo"]=='Masculino'){
                        echo" <img class='img-responsive img-circle hoverZoomLink pull-left' style='margin-top: 20%; height: 10%; width: 100%; margin-left: 0%;' src='https://vignette.wikia.nocookie.net/simpsons/images/7/7f/Mmm.jpg'>";
                    }else{
                        echo" <img class='img-responsive img-circle hoverZoomLink pull-left' style='margin-top: 20%; height: 10%; width: 100%;margin-left: 0%;' src='https://i.pinimg.com/736x/34/81/e4/3481e4fec96ac6f7728fa35bbbf70ac5--los-simpsons-cartoon-girls.jpg'>";
                    }
            echo"</div>";
            echo"<div class='col-sm-10'>
                <strong>$nick</strong><small> - $email</small><br><br>";

                if($usuario_seguido=='N'){
                    $deixar_seguir_display = 'none';
                }else{
                    $seguir_display = 'none';
                }

            echo"<span class='pull-right'><button type='button' id='btn_deixar_seguir_$id' class='btn btn-danger btn_deixar_seguir' style='display: $deixar_seguir_display;' data-id_usuarios='$id'>Deixar de seguir</button></span>
                 <span class='pull-right'><button type='button' id='btn_seguir_$id' class='btn btn-success btn_seguir' style='display: $seguir_display;' data-id_usuario='$id'>Seguir</button></span>
                </div>";
        echo"</div>";
    echo'</a>';
        }

    }else{
        echo"Erro ao recuperar os usuarios";
    }
?>