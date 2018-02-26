<?php
include 'topo.php';

if(!isset($_SESSION["usuario"])){
    echo"<script>location.href='index.php?erro=2';</script>";
}

$usuario = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
$nome = $_SESSION['nome'];
$data_nascimento = $_SESSION['data_nascimento'];
$email = $_SESSION['email'];
$nick = $_SESSION['nickname'];
$sexo = $_SESSION['sexo'];
$profile_img = $_SESSION['imagem'];

$nome_inicio = explode(" ", $_SESSION["nickname"]);
$nick_modal = $nome_inicio[0];
?>

<div class="container-fluid body-feed">
    <div class="col-md-3 ">
        <div class="panel panel-default perfil">
            <div class="panel-body">
                <!--BOTÃO PARA ABRIR O MODAL-->
                <div class="row text-center img-resposive">
                    <a href="#" class="btn btn-lg btn-link" data-toggle="modal" data-target="#basicModal">
                        <img style="margin-left: 0; width:50%; height: 25%;" src='profile_img\<?=$profile_img?>'>
                    </a>
                </div>

                <!--MODAL PARA UPLOAD DE FOTOS-->
                <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Upload de foto</h4>
                            </div>
                            <div class="modal-body">
                                <h3>Selecione a nova foto para seu perfil <?= $nick_modal ?></h3>
                                <form method="post" action="upload.php" enctype="multipart/form-data" name="atualizar">
                                    <input type="file" name="foto"><br>
                                    <input type="submit" name="atualizar" class="btn btn-success" value="Atualizar">
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="panel panel-default perfil">
            <div class="panel-body">
                <form method="post">
                    <label for="usuario">Usuario</label> <input id="usuario" name="usuario" type="text" class="form-control" value="<?=$usuario ?>"><br>
                    <label for="nick">Nickname</label> <input id="nick" name="nick" type="text" class="form-control" value="<?=$nick ?>"><br>
                    <label for="nome">Nome</label> <input id="nome" name="nome" type="text" class="form-control" value="<?=$nome?>"><br>
                    <label for="data">Data nascimento</label> <input id="data" name="data" type="date" class="form-control" value="<?=$data_nascimento ?>"><br>
                    <label for="email">E-mail </label><input id="email" name="email" type="email" class="form-control" value="<?=$email ?>"><br>
                    <b>Sexo: </b><br>
                    <label for="masculino">Masculino <input type="radio"  id="masculino" name="sexo" value="Masculino"  <?php if($sexo=='Masculino') echo 'checked'; ?>></label>
                    <label for="feminino">Feminino  <input type="radio"  id="feminino" name="sexo" value="Feminino" <?php if($sexo=='Feminino') echo 'checked'; ?>></label><br>

                    <hr style='margin-bottom: 2%; margin-top: 1%;'>
                    <input type="submit" class="btn btn-success" value="Atualizar">
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3">

    </div>
</div>

<?php

if($_POST==true) {
    $usuario_post = $_POST["usuario"];
    $nick_post = $_POST["nick"];
    $nome_post = $_POST["nome"];
    $data_post = $_POST["data"];
    $email_post = $_POST["email"];
    $sexo_post = $_POST["sexo"];

    $query = "update usuarios
              set usuario = '$usuario_post', 
                  email = '$email_post', 
                  nome = '$nome_post',
                  data_nascimento = '$data_post',
                  nickname = '$nick_post',
                  sexo = '$sexo_post'
              where id_usuario = $id_usuario";

    if (!$result = mysqli_query(connect(), $query)) {
        echo "<script>alert('Erro ao atualizar os dados')</script>";
    } else {

        $query_dados = "select 
                            id_usuario, usuario,nome,data_nascimento,email,nickname, sexo, imagem 
                            from usuarios 
                            where id_usuario = $id_usuario";

        $resultado = mysqli_query(connect(), $query_dados);

        $dados_usuario = mysqli_fetch_array($resultado);

        if ($dados_usuario !== null) {

            $_SESSION['id_usuario'] = $dados_usuario["id_usuario"];
            $_SESSION['usuario'] = $dados_usuario["usuario"];
            $_SESSION['nome'] = $dados_usuario["nome"];
            $_SESSION['data_nascimento'] = $dados_usuario["data_nascimento"];
            $_SESSION['email'] = $dados_usuario["email"];
            $_SESSION['nickname'] = $dados_usuario["nickname"];
            $_SESSION['sexo'] = $dados_usuario["sexo"];
            $_SESSION['imagem'] = $dados_usuario["imagem"];

            header('Location:index.php');

        } else {
            echo "<script>alert('Erro ao recuperar atualizados os dados do perfil');</script>";
        }
    }

}
