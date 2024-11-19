<?php
	include_once("verifica.php");

	$key = "PortalZ";

    $data = $_REQUEST;

    include_once("config.php");

    $conexao = db_connect();

    extract($data);

	$senha = base64_encode($edtSenha . '::' . $key);
	
	$resultado = "ERRO";	
	
	if( $op == "A")
	{
		$sql = "update usuario set usumail = :mail, usunome = :nome,
				usustatus = :status, usutipo = :tipo  
				where usucodigo = :codigo ";

		$comando = $conexao->prepare($sql);

		$comando->bindParam(':codigo', 		$edtcodigo);
		$comando->bindParam(':mail', 		$edtmail);
		$comando->bindParam(':nome', 		$edtnome);
		$comando->bindParam(':status', 		$edtstatus);
		$comando->bindParam(':tipo', 		$edttipo);

		$comando->execute();
	}
	else
	{
		$sql = "insert into usuario ( usumail, ususenha, usunome, usustatus, usutipo )
				values( :mail, :senha, :nome, :status, :tipo ) ";

		$comando = $conexao->prepare($sql);

		$comando->bindParam(':mail', 		$edtmail);
		$comando->bindParam(':senha', 		$senha);
		$comando->bindParam(':nome', 		$edtnome);
		$comando->bindParam(':status', 		$edtstatus);
		$comando->bindParam(':tipo', 		$edttipo);


		$comando->execute();
	}

	header('location: usuario.php');
?>