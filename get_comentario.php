<?php

include 'db_conection.php';

session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
$id_post = $_POST["id_post"];
$id_usuario_sessao = $_SESSION["id_usuario"];

$query_comentario = "select 
                    comentario, 
                    date_format(data_comentario, '%d %b %Y %T') as data_comentario, 
                    c.id_usuario,
                    c.id_comentario,
                    u.nickname,
                    u.imagem
                    from post p inner join comentarios c on p.id_post = c.id_post
                    inner join usuarios u on u.id_usuario = c.id_usuario
                    where p.id_post = $id_post
                    order by id_comentario desc;";

if($resultado = mysqli_query(connect(),$query_comentario)) {

    while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $comentario = $registro["comentario"];
        $data_comentario = $registro["data_comentario"];
        $id_usuario_comentario = $registro["id_usuario"];
        $id_comentario = $registro["id_comentario"];
        $nickname_comentario = $registro["nickname"];
        $imagem_comentario = $registro["imagem"];

        //monta estrutura de exibição dos posts

        echo "<div style='margin-bottom:1%; margin-top:0;' class='container-fluid list-group-item'>
                    <div class='row'>
                        <div class='col-sm-12'>
                                <h4 class='list-group-item-heading'>
                                       <img style='margin-left: 0;height: 30px;width: 30px;' class='img-perfil img-responsive img-circle hoverZoomLink pull-left' src='profile_img\\$imagem_comentario'>
                                          &nbsp <a style='color: #1b1e21; text-decoration: none;' href='perfil.php?id=$id_usuario_comentario'>$nickname_comentario</a> - <small>$data_comentario</small>";

        //verifica se o post pertence ao usuario da sessão para exibir o botão de deletar post
        if ($id_usuario_comentario == $id_usuario_sessao) {
            echo "<p class='pull-right'> 
                    <a href='apagar_comentario.php?id=$id_comentario&id_post=$id_post' style='color: black; text-decoration: none;'>
                        <i class='fa fa-times' aria-hidden=\"true\"></i>
                    </a>
                </p><hr style='margin-top: 2%;'>";
        }else{
            echo "<hr style='margin-top: 2%;'>";
        }

        echo "</h4>
                <div class='col-sm-9'>
                   <p class='list-group-item-text' style='word-wrap:break-word'>$comentario</p><br>
                </div>
                <div class='col-sm-3'>
                </div>
                </div>
                </div>
                <!--Div dos botões-->
                <hr style='margin-bottom: 1%;'><div class='col-sm-12'>
                    </div>
                <!--Fim da div dos botões-->
                </div>
                </div>
                </div>";
    }
}else{
    echo"Erro ao recuperar os comentario";
}

?>
