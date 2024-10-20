<?php

require_once 'conexao.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define o retorno JSON
header('Content-Type: application/json');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
    exit;
}

// Captura os dados do formulário
$id_usuario = $_POST['id_usuario'];
$id_remedio = $_POST['id_remedio'];
$num_dosagem = $_POST['num_dosagem'];
$dosagem = $_POST['dosagem'];
$num_concentracao = $_POST['num_concentracao'];
$concentracao = $_POST['concentracao'];
$frequencia = $_POST['frequencia']; // Intervalo em horas
$duracao = $_POST['duracao']; // Duração em dias
$inicio = date('Y-m-d H:i:s', strtotime($_POST['inicio'])); // Data e hora de início

try {
    // Verifica se já existe um horário de administração para o remédio e usuário na mesma data e hora
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

    // Calcula o intervalo de horas entre as doses
    $intervalo_horas = 24 / $frequencia;

    // Prepara a inserção dos dados na tabela (usando os nomes de colunas corretos)
    $sql = "INSERT INTO horario_administracao 
            (horario, id_login, id_remedio, dosagem, dosagem_unidade, concentracao, concentracao_unidade, intervalo_horas, duracao_dias, data_hora_inicio) 
            VALUES (NOW(), :id_usuario, :id_remedio, :num_dosagem, :dosagem, :num_concentracao, :concentracao, :intervalo_horas, :duracao, :data_hora_inicio)";
    
    $stmt = $pdo->prepare($sql);

    // Loop para inserir horários de administração ao longo da duração especificada
    for ($i = 0; $i < $duracao; $i++) {
        $data_base = date('Y-m-d H:i:s', strtotime("$inicio + $i days")); // Define a data base para cada dia

        // Insere os horários de acordo com a frequência de doses por dia
        for ($j = 0; $j < $frequencia; $j++) {
            $data_hora_alarme = date('Y-m-d H:i:s', strtotime("$data_base + " . ($j * $intervalo_horas) . " hours"));

            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_remedio' => $id_remedio,
                ':num_dosagem' => $num_dosagem,
                ':dosagem' => $dosagem,
                ':num_concentracao' => $num_concentracao,
                ':concentracao' => $concentracao,
                ':intervalo_horas' => $intervalo_horas,
                ':duracao' => $duracao,
                ':data_hora_inicio' => $data_hora_alarme
            ]);
        }
    }

    // Resposta de sucesso
    echo json_encode(['success' => true, 'message' => 'Horários de administração cadastrados com sucesso!']);

} catch (PDOException $e) {
    // Tratamento de erro e resposta JSON
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar horário de administração: ' . htmlspecialchars($e->getMessage())]);
}