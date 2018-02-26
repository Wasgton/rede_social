<?php
include 'db_conection.php';
session_start();

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}

$id_usuario = $_SESSION["id_usuario"];

if(isset($_POST["atualizar"])){

    $foto = $_FILES["foto"];

    if(!empty($foto["name"])) {

        $error = 0;

        if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])) {
            $error = 1;
        }

            if ($error == 0) {

                // Pega extensão da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

                // Gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                // Caminho de onde ficará a imagem
                $caminho_imagem = "profile_img/" . $nome_imagem;

                // Faz o upload da imagem para seu respectivo caminho
                move_uploaded_file($foto["tmp_name"], $caminho_imagem);

                // Insere os dados no banco
                $query_foto = "update usuarios 
                               set imagem = '$nome_imagem'
                               where id_usuario = $id_usuario";

                if (!mysqli_query(connect(), $query_foto)) {
                    echo"<script>alert('Erro ao realizar o update da foto!');</script>";
                }else{
                        $query_dados_usuario = "select 
                        id_usuario, usuario,nome,data_nascimento,email,nickname, sexo, imagem 
                        from usuarios 
                        where id_usuario = '$id_usuario';";

                    $resultado = mysqli_query(connect(),$query_dados_usuario);

                    $dados_usuario = mysqli_fetch_array($resultado);

                    if($dados_usuario!==null) {

                        $_SESSION['id_usuario'] = $dados_usuario["id_usuario"];
                        $_SESSION['usuario'] = $dados_usuario["usuario"];
                        $_SESSION['nome'] = $dados_usuario["nome"];
                        $_SESSION['data_nascimento'] = $dados_usuario["data_nascimento"];
                        $_SESSION['email'] = $dados_usuario["email"];
                        $_SESSION['nickname'] = $dados_usuario["nickname"];
                        $_SESSION['sexo'] = $dados_usuario["sexo"];
                        $_SESSION['imagem'] = $dados_usuario["imagem"];
                    }
                    header('Location:editar_perfil.php?id='.$id_usuario);
                }
            }
        }else{
    echo"
        <script>
            alert('Erro ao realizar o upload da foto');
            location.href='editar_perfil.php?id='.$id_usuario;
        </script>";
        }
}else{
    echo"
        <script>
            alert('Erro ao realizar o upload da foto');
            location.href='editar_perfil.php?id='.$id_usuario;
        </script>";
}