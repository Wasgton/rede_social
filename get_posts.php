<?php

include 'db_conection.php';

session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
    $id_usuario = $_SESSION["id_usuario"];

    $query_post = "select id_post, 
                           date_format(data_post, '%d %b %Y %T') as data_post, 
                           p.post, 
                           u.usuario,
                           p.id_usuario,  
                           u.nickname,
                           u.imagem,
                          (select 'sim' from curtida where id_usuario_curtida = '$id_usuario' and id_post = p.id_post) curtida,
                          (select count(*) from curtida where id_post = p.id_post) qnt_curtida
                            from post p inner join usuarios u on p.id_usuario = u.id_usuario
                            where p.id_usuario = '$id_usuario'
                            or p.id_usuario in (select seguindo_id_usuario 
                                                from seguidores 
                                                where id_usuario = '$id_usuario')
                            order by data_post desc;";

    if($resultado = mysqli_query(connect(),$query_post)) {

        while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
            $post = $registro['post'];
            $data = $registro["data_post"];
            $usuario = $registro["nickname"];
            $id_post = $registro["id_post"];
            $id_usuario_post = $registro["id_usuario"];
            $curtida = $registro["curtida"];
            $qnt_curtida = $registro["qnt_curtida"];
            $imagem = $registro["imagem"];

            //monta estrutura de exibição dos posts

            echo "<div style='margin-bottom:1%;' class='container-fluid list-group-item'>
                    <div class='row'>
                        <div class='col-sm-12'>
                                <h4 class='list-group-item-heading'>
                                               <img style='margin-left: 0;height: 30px;width: 30px;' class='img-perfil img-responsive img-circle hoverZoomLink pull-left' src='profile_img\\$imagem'>
                                          &nbsp$usuario - <small>$data</small>";

                                        //verifica se o post pertence ao usuario da sessão para exibir o botão de deletar post
                                                if ($id_usuario_post == $id_usuario) {
                                                    echo "<p class='pull-right'> 
                                                            <a href='apagar_post.php?id=$id_post' style='color: black; text-decoration: none;'>
                                                                <i class='fa fa-times' aria-hidden=\"true\"></i>
                                                            </a>
                                                            </p><hr style='margin-top: 2%;'>";
                                                }else{
                                                    echo "<hr style='margin-top: 2%;'>";
                                                }
                        echo "</h4>
                            <div class='col-sm-9'>
                               <p class='list-group-item-text' style='word-wrap:break-word'>$post</p><br>
                            </div>
                            <div class='col-sm-3'>
                            </div>
                            </div>
                            </div>
                            <!--Div dos botões-->
                            <hr style='margin-bottom: 1%;'><div class='col-sm-12'>
                                <!--Div botão curtida-->
                                <div class='col-sm-3'>";
                            if($curtida == 'sim'){
                                        echo"<span>
                                                <button style='padding-right:0; color: orangered;' type='button' id='btn_curtir_$id_post' class='btn btn-link btn_deixar_curtir' data-id_post='$id_post' >
                                                <!--i class='fa fa-star fa-4x fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i-->
                                                <i class='fa fa-heart fa-3x fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i>
                                            </button></span>";
                                    }else{
                                        echo"<span>
                                                <button style='padding-right:0;color: black;' type='button' id='btn_curtir_$id_post' class='btn btn-link btn_curtir' data-id_post='$id_post'>
                                                <!--i class='fa fa-star-o fa-4x fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i-->
                                                <i class='fa fa-heart-o fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i>
                                            </button></span>";
                                    }
                            echo" <a href='comentario.php?id=$id_post'>
                                        <button class='btn btn-link'>
                                            <i class='fa fa-comments fa-fw comentario' data-id_post_comentario='$id_post' aria-hidden='true'></i>
                                        </button>
                                            </a>
                                  </div></div>
                                  <div class='col-sm-3'></div>
                                  <div class='col-sm-6'></div>
                            </div>
                            <!--Fim da div dos botões-->
                            </div>
                            </div>
                            </div>";
        }
    }else{
        echo"Erro ao recuperar os posts";
    }
?>