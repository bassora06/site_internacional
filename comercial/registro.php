<?php
    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    $data = json_decode(file_get_contents('php://input'), true);

    // Depuração: Verificar os dados recebidos
    if (empty($data)) {
        $data = $_POST; // Tentar recuperar dados via método POST padrão
    }

    include_once("config.php");

    $conexao = db_connect();

    // Verificação da conexão com o banco de dados
    if ($conexao) {
        // Validação dos dados recebidos
        if (empty($data)) {
            $resultado = "ERR-003: Nenhum dado recebido";
        } elseif (!isset($data['placa']) || !isset($data['quantidade']) || trim($data['placa']) === '' || trim($data['quantidade']) === '') {
            $resultado = "ERR-001: Dados insuficientes";
        } else {
            $placa = filter_var($data['placa'], FILTER_VALIDATE_FLOAT);
            $quantidade = filter_var($data['quantidade'], FILTER_VALIDATE_FLOAT);

            if ($placa === false || $quantidade === false) {
                $resultado = "ERR-002: Dados inválidos";
            } else {
                // Query de inserção
                $sql = "INSERT INTO onibus(placa, quantidade_passageiros) VALUES (:placa, :quantidade)";
                $comando = $conexao->prepare($sql);

                $comando->bindParam(':placa', $placa);
                $comando->bindParam(':quantidade', $quantidade);

                if ($comando->execute()) {
                    $resultado = "OK";
                } else {
                    $resultado = "ERR-009: Falha ao inserir no banco de dados";
                }
            }
        }
    } else {
        $resultado = "ERR-010: Falha na conexão com o banco de dados";
    }

    $response = array("resultado" => $resultado);
    echo json_encode($response);