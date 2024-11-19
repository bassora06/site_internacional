<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *'); // Permitir requisições de qualquer origem
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    include_once("config.php");

    $conexao = db_connect();

    if ($conexao) {
        try {
            $sqlSelect = "SELECT * FROM onibus ORDER BY id_onibus DESC LIMIT 10";
            $stmt = $conexao->prepare($sqlSelect);
            $stmt->execute();
            $estacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($estacoes);
        } catch (Exception $e) {
            echo json_encode(["erro" => "Falha ao buscar registros: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["erro" => "Falha na conexão com o banco de dados"]);
    }
?>
