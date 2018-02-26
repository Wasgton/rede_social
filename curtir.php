<?php
session_start();
if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
include 'db_conection.php';
$usuario_sessao = $_SESSION["id_usuario"];
$id_post = $_POST["id_post"];

    $query_seguir = "INSERT INTO curtida (id_usuario_curtida,id_post) 
                   values ('$usuario_sessao','$id_post');";

    if (!mysqli_query(connect(), $query_seguir)) {
        echo "Erro ao curtir post!";
    }
