<?php
	require_once("verifica.php");

    include_once("cabec.php");
?>

<div class="container">
	<p>&nbsp;</p>
	<div class="row">
		<div class="col">
			<form id="formNovo" name="formNovo" action="" method="post" class="form">
				<div class="input-group mb-3">
					<span class="input-group-text" id="basic-addon1">CEP</span>
					<input type="text" class="form-control" name="cep" placeholder="00000-000" aria-label="Username" aria-describedby="basic-addon1">
					<button type="submit" class="btn btn-dark"><?php echo $lng['pesquisar']; ?></button>
				</div>
				<p>&nbsp;</p>
			</form>
		</div>
	</div>
	
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$cep = preg_replace("/[^0-9]/", "", $_POST['cep']); // Recebe o CEP do formulário
	
			$url = "https://viacep.com.br/ws/" . $cep . "/json/"; // Corrige a URL
	
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	
			$response = curl_exec($curl);
			curl_close($curl);
	
			$dados = json_decode($response, true);
	
			if (isset($dados['cep'])) { // Verifica se o CEP foi encontrado
				echo '<div>';
				echo $lng['cep'] . ': ' . $dados['cep'] . '<br>';
				echo $lng['logradouro'] . ': ' . $dados['logradouro'] . '<br>';
				echo $lng['complemento'] . ': ' . $dados['complemento'] . '<br>';
				echo $lng['bairro'] . ': ' . $dados['bairro'] . '<br>';
				echo $lng['localidade'] . ': ' . $dados['localidade'] . '<br>';
				echo $lng['UF'] . ': ' . $dados['uf'] . '<br>';
				echo $lng['IBGE'] . ': ' . $dados['ibge'] . '<br>';
				echo '</div>';
			} else {
				echo '<div>CEP não encontrado.</div>';
			}
		}
?>
</div>

<?php
    include_once("rodape.php");
?>
