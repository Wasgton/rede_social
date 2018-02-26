<?php

include 'db_conection.php';

session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
$id_usuario = $_SESSION["id_usuario"];
$id_comentario = $_GET["id"];
$id_post = $_GET["id_post"];

$query_post="delete from comentarios
             where id_comentario = $id_comentario
             and id_usuario = $id_usuario";



if($resultado = mysqli_query(connect(),$query_post)){
    header("Location: comentario.php?id=$id_post");

}else{
    echo"<script>Alert('Erro ao apagar o comentario');</script>";
    header("Location: comentario.php?id=$id_post");
}
?>