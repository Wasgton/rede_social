<?php

include 'topo.php';

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
$id_usuario_sessao = $_SESSION["id_usuario"];
$id_post = $_GET["id"];

$query_post = "select
date_format(data_post, '%d %b %Y %T') as data_post,
p.post,
u.usuario,
p.id_usuario,
u.nickname,
u.imagem,
(select 'sim' from curtida where id_usuario_curtida = '$id_usuario_sessao' and id_post = $id_post) curtida,
(select count(*) from curtida where id_post = p.id_post) qnt_curtida
from post p inner join usuarios u on p.id_usuario = u.id_usuario
where p.id_post = $id_post;";

if($resultado_post = mysqli_query(connect(),$query_post)){
    $dados = mysqli_fetch_assoc($resultado_post);

    $nick = $dados["nickname"];
    $post = $dados["post"];
    $data_post = $dados["data_post"];
    $id_usuario = $dados["id_usuario"];
    $imagem = $dados["imagem"];
    $curtida = $dados["curtida"];
    $qnt_curtida = $dados["qnt_curtida"];
}else{
    echo"Erro ao recuperar os dados so post";
}
?>

<div class="container-fluid body-feed">
    <div class="col-md-3 ">
    </div>
    <div class="col-md-6 ">
                    <!--POST-->
                            <div style="margin-bottom:1%;" class="container-fluid list-group-item">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="list-group-item-heading">
                                            <img style="margin-left: 0;height: 30px;width: 30px;" class="img-perfil img-responsive img-circle hoverZoomLink pull-left" src="profile_img\<?=$imagem?>">
                                            <?=$nick?></a> - <small><?=$data_post?></small><p class="pull-right">
                                                <?php if($id_usuario == $id_usuario_sessao){
                                                    echo'<a href="apagar_post.php?id='.$id_post.'" style="color: black; text-decoration: none;">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>';
                                                }?>
                                            </p><hr style="margin-top: 2%;"></h4>
                                        <div class="col-sm-9">
                                            <p class="list-group-item-text" style="word-wrap:break-word"><?=$post?></p><br>
                                        </div>
                                        <div class="col-sm-3">
                                        </div>
                                    </div>
                                </div>
                                <!--Div dos botões-->
<!--                                <hr style="margin-bottom: 1%;"-->
                                    <div class="col-sm-12">
                                    <!--Div botão curtida-->
                                    <div class="col-sm-3">
                                        <span>
<!--                                            <!--Div botão curtida-->
<!--                                            --><?php //if($curtida == 'sim'){
//                                                echo"<button style='padding-right:0; padding-left:1px; color: goldenrod;' type='button' id='btn_curtir_$id_post' class='btn btn-link btn_deixar_curtir' data-id_post='$id_post' >
//                                                       <i class='fa fa-star fa-4x fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i>
//                                                       <!--i class='fa fa-heart fa-3x fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i-->
//                                                    </button>";
//                                            }else{
//                                                echo"<button style='padding-right:0; padding-left:1px; color: black;' type='button' id='btn_curtir_$id_post' class='btn btn-link btn_curtir' data-id_post='$id_post'>
//                                                        <i class='fa fa-star-o fa-4x fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i>
//                                                        <!--i class='fa fa-heart-o fa-fw' data-placement='top' data-toggle='tooltip' title='$qnt_curtida' aria-hidden='true'></i-->
//                                                    </button>";
//                                            }
//                                            ?>
                                        </span>
                                    </div>

                                    <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-6"></div>
                                </div>
                                <!--Fim da div dos botões-->
                            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="input-group" style="width: 100%;">
                        <form class="input-group">
                            <input type="text" class="form-control" id="comentario" maxlength="140">
                            <input type="text" hidden id="id_post_comentario" value="<?=$id_post?>">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" id="btn_comentar">Comentar</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div id="comentarios" class="list-group">

            </div>

    </div>
    <div class="col-md-3">

    </div>
</div>