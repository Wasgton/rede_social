<?php
session_start();
if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
include 'db_conection.php';
$id_usuario = $_SESSION["id_usuario"];
$post = $_POST['postagem'];

if($post!='' || $id_usuario){
    $query_post = "INSERT INTO post (post,id_usuario) values ('$post','$id_usuario');";

    if(!mysqli_query(connect(),$query_post)){
        echo"Erro ao publicar post!";
    }
}else{
    echo"<script>alert('Não é possivel publicar postagens em branco!');</script>";
}
