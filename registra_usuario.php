<?php
include 'db_conection.php';

if($_POST['cadastrar']!==null){
$usuario = $_POST["usuario"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$nome = $_POST["nome"];
$data = $_POST["data"];
$sexo = $_POST["sexo"];

$words = explode(" ", $nome);
$nickname = $words[0];
$nickname = $nickname." ".$words[count($words)-1];
$erro_usuario = false;
$erro_email = false;

$query_validacao_usuario = "select usuario from usuarios where usuario = '$usuario'";
$query_validacao_email = "select email from usuarios where email = '$email'";

//comparação usuario
    if($resultado_usuario = mysqli_query(connect(),$query_validacao_usuario)){
        $dados_comparacao = mysqli_fetch_array($resultado_usuario);

        if($usuario == $dados_comparacao["usuario"]) {
            $erro_usuario = true;
        }
    }else{
        echo"<script>alert('Erro ao verificar se o usuario já existe, favor contactar o administrador!');</script>";
    }

//caomparação email
    if($resultado_email = mysqli_query(connect(),$query_validacao_email)){
        $dados_comparacao = mysqli_fetch_array($resultado_email);

        if ($email == $dados_comparacao["email"] || $email == ''){
            $erro_email = true;
        }
    }else{
        echo"<script>alert('Erro ao verificar se o usuario já existe, favor contactar o administrador!');</script>";
    }

//Instruções de retorno caso já exista dados cadastrados

    if($erro_usuario || $erro_email) {
        $retorno_get = '';

        if($erro_usuario){
            $retorno_get.="erro_usuario=1&";
        }
        if($erro_email){
            $retorno_get.="erro_email=1&";
        }
            echo "<script>location.href='registro.php?$retorno_get';</script>";
    }else{

        if($sexo=='Masculino'){
                $imagem = 'inicial_m.jpg';
        }else{
                $imagem = 'inicial_f.jpg';
        }

        $query = "INSERT INTO `usuarios` (usuario, email, senha, nome, data_nascimento, nickname, sexo, imagem) 
                  VALUES ('$usuario', '$email', '$senha','$nome','$data', '$nickname','$sexo','$imagem');";

            if(mysqli_query(connect(),$query)){
                echo"<script>alert('Registro efetuado com sucesso!');</script>";
                echo "<script>location.href='registro.php';</script>";
            }else{
                echo"<script>alert('Erro registro não efetuado!');</script>";
                echo "<script>location.href='registro.php';</script>";
            }
    }
}



