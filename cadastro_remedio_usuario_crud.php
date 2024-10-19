<?php

require_once 'conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
    exit;
}

$id_usuario = $_POST['id_usuario'];
$id_remedio = $_POST['id_remedio'];
$num_dosagem = $_POST['num_dosagem'];
$dosagem = $_POST['dosagem'];
$num_concentracao = $_POST['num_concentracao'];
$concentracao = $_POST['concentracao'];
$frequencia = $_POST['frequencia'];
$duracao = $_POST['duracao'];
$inicio = date('Y-m-d H:i:s', strtotime($_POST['inicio']));

try {
    // Verifica se já existe horário de administração para o remédio
    $verificarHorario = "SELECT COUNT(*) FROM horario_administracao 
                         WHERE id_login = :id_usuario 
                         AND id_remedio = :id_remedio 
                         AND data_hora_inicio = :inicio";
                         
    $stmt = $pdo->prepare($verificarHorario);
    $stmt->execute([':id_usuario' => $id_usuario, ':id_remedio' => $id_remedio, ':inicio' => $inicio]);
    
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'Horário de administração já cadastrado para este remédio.']);
        exit;
    }

    // Cadastra os horários de administração
    $intervalo_horas = 24 / $frequencia;

    $sql = "INSERT INTO horario_administracao 
            (horario, id_login, id_remedio, dosagem_num, dosagem_unidade, concentracao_num, concentracao_unidade, intervalo_horas, duracao_dias, data_hora_inicio) 
            VALUES (NOW(), :id_usuario, :id_remedio, :num_dosagem, :dosagem, :num_concentracao, :concentracao, :frequencia, :duracao, :inicio)";
    
    $stmt = $pdo->prepare($sql);

    for ($i = 0; $i < $duracao; $i++) {
        $data_alarme = date('Y-m-d', strtotime("$inicio + $i days"));
        
        for ($j = 0; $j < $frequencia; $j++) {
            $data_hora_alarme = $data_alarme . ' ' . date('H:i:s', strtotime("$inicio + " . ($j * $intervalo_horas) . " hours"));
            
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_remedio' => $id_remedio,
                ':num_dosagem' => $num_dosagem,
                ':dosagem' => $dosagem,
                ':num_concentracao' => $num_concentracao,
                ':concentracao' => $concentracao,
                ':frequencia' => $frequencia,
                ':duracao' => $duracao,
                ':inicio' => $data_hora_alarme
            ]);
        }
    }

    echo json_encode(['success' => true, 'message' => 'Horários de administração cadastrados com sucesso!']);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar horário de administração: ' . htmlspecialchars($e->getMessage())]);
}