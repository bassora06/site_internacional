<?php include_once("cabec.php"); ?>

	<p>&nbsp;</p>

	<h2 class="cor_texto titulo "><?php echo $lng['acessoSistema']; ?></h2>

	<form action="autentica.php" method="post" class="form card-body row border-dark justify-content-center w-100">
		<div class="col-lg-8 col-sm-12">
			<div class="row g-3 align-items-center">
				<div class="col-lg-2 col-sm-12 ">
					&nbsp;
				</div>
				<div class="input-group mb-3">
					<span for="edtMail" class="input-group-text" id="basic-addon1"><?php echo $lng['email']; ?></span>
					<input type="email" id="edtMail" name="edtMail" class="form-control" id="edtSenha" name="edtSenha" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
				</div>
			</div>
			&nbsp;
			<div class="row g-3 align-items-center">
				<div class="col-lg-2 col-sm-12 ">
				</div>
				<div class="input-group mb-3">
					<span for="edtSenha" class="input-group-text" id="basic-addon1"><?php echo $lng['senha']; ?></span>
					<input type="password" class="form-control" id="edtSenha" name="edtSenha" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
				</div>
			</div>
			
			<p>&nbsp;</p>

			<div class="row g-3 justify-content-center">
				<button type="submit" class="btn btn-lg cor_barra cor_texto_barra btn-block col-lg-3"><?php echo $lng['entrar']; ?></button>	
			</div>

			<p>&nbsp;</p>
			
		</div>
	</form>

	<p>&nbsp;</p>

<?php include_once("rodape.php"); ?>