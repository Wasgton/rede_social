<?php

function connect(){

    $host = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'social';

    $con = new mysqli($host,$usuario,$senha,$banco);

    if($con->connect_error==true){
        echo"<script> alert('Erro ao conectar ao banco de dados!');</script>";
    }
    return $con;
}