<?php

include 'db_conection.php';

session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}
    $id_usuario = $_SESSION["id_usuario"];
    $id_post = $_GET["id"];

    $query_post="delete from post
                 where id_post = $id_post
                 and id_usuario = $id_usuario";


    $query_apagar_comentarios = "delete from comentarios
                                WHERE id_post = $id_post";

    if(mysqli_query(connect(),$query_post)){

        if(mysqli_query(connect(),$query_apagar_comentarios)){
            header("Location: home.php");
        }else{
            echo"<script>Alert('Erro ao apagar o post');</script>";
            header("Location: home.php");
        }

    }else{
        echo"<script>Alert('Erro ao apagar o post');</script>";
        header("Location: home.php");
    }
?>