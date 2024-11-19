<?php
	require_once("verifica.php");

	include_once("cabec.php");
	
	include_once("config.php");

    $conexao = db_connect();

	$sql = "select usuario.usucodigo, usuario.usumail, usuario.usunome, usuario.usustatus, usuario.usutipo
			from usuario 
			order by usuario.usunome ";

	$comando = $conexao->prepare($sql);

	$comando->execute();
			
	$dados = $comando->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <p>&nbsp;</p>
            <h2 class="text-dark titulo sm-justify-content-center"><?php echo $lng['cadastroDeUsuários']; ?></h2>
            <p>&nbsp;</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-sm-10">
            <form id="formNovo" name="formNovo" action="usuarioCad.php" method="post" class="form">
                <input type="hidden" name="op" value="I" />
                <input type="hidden" name="codigo" value="0" />

                <button type="submit" class="btn btn-dark"><?php echo $lng['novoCadastro']; ?></button>
				<p>&nbsp;</p>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="dados" class="table">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="text-center col"><?php echo $lng['codigo']; ?></th>
                            <th class="text-center col"><?php echo $lng['nome']; ?></th>
                            <th class="text-center col"><?php echo $lng['email']; ?></th>
                            <th class="text-center col"><?php echo $lng['status']; ?></th>
                            <th class="text-center col"><?php echo $lng['tipo']; ?></th>
                            <th class="text-center col"><?php echo $lng['opções']; ?></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach($dados as $linha): ?>
                            <tr>
                                <td class="text-center"><?php echo htmlspecialchars($linha->usucodigo); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($linha->usunome); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($linha->usumail); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($linha->usustatus); ?></td>
                                <td class="text-center">
                                    <?php 
                                        if ($linha->usutipo == 'M') { echo 'Master'; }
                                        elseif ($linha->usutipo == 'A') { echo 'Admin'; }
                                        elseif ($linha->usutipo == 'O') { echo 'Operador'; }
                                    ?>
                                </td>
                                <td>
                                    <div class="row justify-content-center">
                                        <form id="<?php echo 'formVer' . $linha->usucodigo; ?>" name="<?php echo 'formVer' . $linha->usucodigo; ?>" action="usuarioCad.php" method="post" class="form col p-0">
                                            <input type="hidden" name="op" value="C" />
                                            <input type="hidden" name="codigo" value="<?php echo $linha->usucodigo; ?>" />

                                            <button type="submit" title="<?php echo $lng['visualizar']; ?>" class="btn btn-link"><i class="bi-display" style="font-size: 1.5rem; color: black;"></i></button>
                                        </form>

                                        <form id="<?php echo 'formAlt' . $linha->usucodigo; ?>" name="<?php echo 'formAlt' . $linha->usucodigo; ?>" action="usuarioCad.php" method="post" class="form col p-0">
                                            <input type="hidden" name="op" value="A" />
                                            <input type="hidden" name="codigo" value="<?php echo $linha->usucodigo; ?>" />

                                            <button type="submit" title="<?php echo $lng['alterar']; ?>" class="btn btn-link"><i class="bi-pencil" style="font-size: 1.5rem; color: black;"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</div>

<p>&nbsp;</p>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
<script>
    idioma = "<?php echo $_COOKIE['idioma']; ?>";
    idioma = idioma.replace('_', '-');
    
    $(document).ready(function () {
        $('#dados').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/' + idioma.trim() + '.json',
                decimal: ',',
                thousands: '.',
            },
        });
    });
</script>


<?php
    include_once("rodape.php");
?>
