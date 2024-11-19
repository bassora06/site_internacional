<?php
	require_once("verifica.php");

	$data=$_REQUEST;

	include_once("config.php");

	$conexao = db_connect();

	extract($data);
	
	if( $op != "I" )
	{
		$sql = "select * 
				from usuario
				where usucodigo = :codigo ";

		$comando = $conexao->prepare($sql);

		$comando->bindParam(':codigo', $codigo);

		$comando->execute();

		$dados = $comando->fetch(PDO::FETCH_OBJ);
	}
?>


<?php include_once("cabec.php"); 
	//I Inserir
	//C Vizualizar
	//A Alterar

?>

	

	<p>&nbsp;</p>

	<h2 class="centralizar"><?php echo $lng['dadosUsuario']; ?></h2>

	<p>&nbsp;</p>

	<form class="form-inline row justify-content-center col-lg-12" action="usuarioGrava.php" method="post">
		<input type="hidden" name="edtCodigo" value="<?php if( $op != "I" ) { echo $dados->usucodigo; } else { echo "0"; } if($op == "A"){ echo $dados->usucodigo; } else {  echo "0";}?>" />
		<input type="hidden" name="op" value="<?php echo $op; ?>" />

		
		<div class="form-group row my-2">
			<label for="edtMail" class="col-sm-2 col-form-label text-end"><?php echo $lng['email']; ?>: &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="edtMail" name="edtmail" placeholder="e-mail do usuário" value="<?php if( $op != "I" ) { echo $dados->usumail; }?>" <?php if( $op == "C" ) echo "readonly" ?>>
			</div>
	  	</div>	
		
		<div class="form-group row my-2">
			<label for="edtSenha" class="col-sm-2 col-form-label text-end"><?php echo $lng['senha']; ?>: &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<input type="password" class="form-control" id="edtSenha" name="edtsenha" placeholder="Senha do Usuário" value="<?php if( $op != "I" ) { echo '********'; } ?>" <?php if( $op != "I" ) echo "readonly" ?>>
			</div>
	  	</div>
		
		<div class="form-group row my-2">
			<label for="edtnome" class="col-sm-2 col-form-label text-end"><?php echo $lng['nomeDeUsu']; ?>: &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<input type="text" class="form-control" id="edtnome" name="edtnome" placeholder="Nome do Usuário" value="<?php if( $op != "I" ) { echo $dados->usunome; } ?>" <?php if( $op == "C" ) echo "readonly" ?>>
			</div>
	  	</div>
		
		<div class="form-group row my-2">
			<label class="col-sm-2 col-form-label text-end"><?php echo $lng['dataCad']; ?>: &nbsp;</label>
			<label class="col-sm-7 col-form-label text-start"><?php if( $op != "I" ) { echo $dados->usudatecad; } else { echo '---'; } ?></label>
	  	</div>
		
		<div class="form-group row my-2">
			<label for="edtstatus" class="col-sm-2 col-form-label text-end"><?php echo $lng['status']; ?>: &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<select required="" id="edtstatus" name="edtstatus" class="form-control col-md-8" <?php if( $op == "C" ) echo "disabled" ?> >
					<option value="A" <?php if( $op != "I" && $dados->usustatus == "A" ) { echo "selected"; } ?>>Ativo</option>
					<option value="I" <?php if( $op != "I" && $dados->usustatus == "I" ) { echo "selected"; } ?>>Inativo</option>
				</select>
			</div>
	  	</div>
		
		<div class="form-group row my-2">
			<label for="edttipo" class="col-sm-2 col-form-label text-end"><?php echo $lng['tipoDeUsu']; ?>: &nbsp;<h11>*</h11>&nbsp;</label>
			<div class="col-sm-7">
				<select required="" id="edttipo" name="edttipo" class="form-control col-md-8" <?php if( $op == "C" ) echo "disabled" ?> >
					<option value="M" <?php if( $op != "I" && $dados->usutipo == "M" ) { echo "selected"; } ?>>Master</option>
					<option value="A" <?php if( $op != "I" && $dados->usutipo == "A" ) { echo "selected"; } ?>>Admin</option>
					<option value="O" <?php if( $op != "I" && $dados->usutipo == "O" ) { echo "selected"; } ?>>Operador</option>
				</select>
			</div>
	  	</div>
		
		<div class="col-md-12 my-3" >
			<div class="form-group col-md-11">
				<label class="col-md-6">&nbsp;</label>
				<button type="button" class="btn btn-dark col-md-2" onClick="window.open('usuario.php', '_self')"><?php echo $lng['sairForm']; ?></button>
				<label class="col-md-1">&nbsp;</label>
				<button type="submit" class="btn btn-dark col-md-2" <?php if( $op == "C" ) echo "disabled" ?> ><?php echo $lng['salvar']; ?></button>
			</div>
		</div>
	</form>

	<p>&nbsp;</p>

	

<?php include_once("rodape.php"); ?>