<?php
include 'db_conection.php';

session_start();

if($_POST["entrar"]!==null){
   $usuario = $_POST["usuario"];
   $senha = md5($_POST["senha"]);

    $query_validacao = "select 
                        id_usuario, usuario,nome,data_nascimento,email,nickname, sexo, imagem 
                        from usuarios 
                        where usuario = '$usuario' 
                        and senha = '$senha';";

    $resultado = mysqli_query(connect(),$query_validacao);

    $dados_usuario = mysqli_fetch_array($resultado);

    if($dados_usuario!==null){

        $_SESSION['id_usuario']      = $dados_usuario["id_usuario"];
        $_SESSION['usuario']         = $dados_usuario["usuario"];
        $_SESSION['nome']            = $dados_usuario["nome"];
        $_SESSION['data_nascimento'] = $dados_usuario["data_nascimento"];
        $_SESSION['email']           = $dados_usuario["email"];
        $_SESSION['nickname']        = $dados_usuario["nickname"];
        $_SESSION['sexo']            = $dados_usuario["sexo"];
        $_SESSION['imagem']          = $dados_usuario["imagem"];

        echo "<script>location.href='home.php'</script>";
    }else{
        echo "<script>location.href='index.php?erro=1';</script>";
    }
}