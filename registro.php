<?php include 'topo_inicio.php';
error_reporting(1);

$erro_email = $_GET["erro_email"];
$erro_usuario = $_GET["erro_usuario"];
?>

	    <div class="container">
	    	<div class="col-md-4"></div>
	    	<div class="col-md-4">
	    		<h3>Inscreva-se já.</h3>
	    		<br>
                <div class="cadastro-form">
				<form method="post" action="registra_usuario.php" id="formCadastrarse">
					<div class="form-group">
                        <label for="usuario"> Usuário </label>
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="João" required>
                        <?php if($erro_usuario==1) echo"<p class='erro'>Usuario já cadastrado!</p>";?>
					</div>
                    <div class="form-group">
                        <label for="nome"> Nome completo </label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="João dos santos" required>
                    </div>
                    <div class="form-group">
                        <label> Data de Nascimento</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <div class="form-group">
                        <b>Sexo: </b><br>
                        <label for="masculino">Masculino <input type="radio"  id="masculino" name="sexo" value="Masculino" checked></label>
                        <label for="feminino">Feminino  <input type="radio"  id="feminino" name="sexo" value="Feminino"></label>
                    </div>
					<div class="form-group">
                        <label for="email"> E-mail</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <?php if($erro_email==1) echo"<p class='erro'>E-mail já cadastrado!</p>";?>
					</div>
					<div class="form-group">
                        <label for="senha"> Senha </label>
						<input type="password" class="form-control" id="senha" name="senha" placeholder="********" required>
                        <p id="erro" style="color: red;"></p>
					</div>
                    <input type="submit" name="cadastrar" id="cadastrar" class="btn btn-primary form-control" value="Inscreva-se">
				</form>
                </div>
			</div>
			<div class="col-md-4"></div>

			<div class="clearfix"></div>
			<br />
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
		</div>

	</body>
</html>