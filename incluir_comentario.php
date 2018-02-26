<?php
session_start();
if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
include 'db_conection.php';
$id_usuario = $_SESSION["id_usuario"];
$comentario = $_POST['comentario'];
$id_post = $_POST['id_post'];

if($comentario!='' || $id_usuario){
    $query_post = "INSERT INTO comentarios (comentario,id_usuario, id_post) values ('$comentario','$id_usuario','$id_post');";

    if(!mysqli_query(connect(),$query_post)){
        echo"Erro ao publicar post!";
    }
}else{
    echo"<script>alert('Erro ao publicar o post!');</script>";
}