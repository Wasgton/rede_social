<?php
session_start();
if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
include 'db_conection.php';
$usuario_sessao = $_SESSION["id_usuario"];
$usuario_seguir = $_POST["usuario"];

if($usuario_seguir!='' || $usuario_sessao!='') {
    $query_seguir = "INSERT INTO seguidores (id_usuario,seguindo_id_usuario) 
                   values ($usuario_sessao,$usuario_seguir);";

    if (mysqli_query(connect(), $query_seguir)) {
        echo "Você está seguindo este usuario agora!";
    }else{
        echo "Erro ao seguir usuario!";
    }

}
