<?php
session_start();
if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
include 'db_conection.php';

$usuario_sessao = $_SESSION["id_usuario"];
$id_post = $_POST["id_post"];

    $query_seguir = "delete from curtida 
                     where id_usuario_curtida= '$usuario_sessao'
                     and id_post='$id_post';";

    if (mysqli_query(connect(), $query_seguir)) {
        echo "Você deixou de curtir este post!";
    }else{
        echo "Erro ao curtir post!";
    }
