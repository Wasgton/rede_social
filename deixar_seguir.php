<?php
session_start();
if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
include 'db_conection.php';
$usuario_sessao = $_SESSION["id_usuario"];
$usuario_seguir = $_POST["deixar_seguir"];

if($usuario_seguir!='' || $usuario_sessao!='') {

    $query_deixar_seguir = "DELETE FROM seguidores
                     WHERE id_usuario = '$usuario_sessao' 
                     AND seguindo_id_usuario = '$usuario_seguir;'";

    if (mysqli_query(connect(), $query_deixar_seguir)) {
        echo "Deixou de seguir o usuario!";
    }else{
        echo "Erro ao deixar de seguir o usuario!";
    }
}