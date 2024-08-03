<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dosagem_num = $_POST['num_dosagem'];
    $dosagem_unidade = $_POST['dosagem'];
    $concentracao_num = $_POST['num_concentracao'];
    $concentracao_unidade = $_POST['concentracao'];
    $intervalo_horas = $_POST['frequencia'];
    $duracao_dias = $_POST['duracao'];
    $data_hora_inicio = $_POST['inicio'];

    $data_hora_inicio = date('Y-m-d H:i:s', strtotime($data_hora_inicio));

    try {

        $id_usuario = 1;


        $stmt_horario = $pdo->prepare("
            INSERT INTO horario_administracao (
                horario, id_login, id_remedio, dosagem_num, dosagem_unidade,
                concentracao_num, concentracao_unidade, intervalo_horas,
                duracao_dias, data_hora_inicio
            ) VALUES (
                NOW(), :id_login, :id_remedio, :dosagem_num, :dosagem_unidade,
                :concentracao_num, :concentracao_unidade, :intervalo_horas,
                :duracao_dias, :data_hora_inicio
            )
        ");


        $id_remedio = 1;

        $stmt_horario->execute([
            ':id_login' => $id_usuario,
            ':id_remedio' => $id_remedio,
            ':dosagem_num' => $dosagem_num,
            ':dosagem_unidade' => $dosagem_unidade,
            ':concentracao_num' => $concentracao_num,
            ':concentracao_unidade' => $concentracao_unidade,
            ':intervalo_horas' => $intervalo_horas,
            ':duracao_dias' => $duracao_dias,
            ':data_hora_inicio' => $data_hora_inicio
        ]);


        $stmt_registro = $pdo->prepare("
            INSERT INTO registro_administracao (
                horario_registro, id_remedio, id_usuario
            ) VALUES (
                NOW(), :id_remedio, :id_usuario
            )
        ");

        $stmt_registro->execute([
            ':id_remedio' => $id_remedio,
            ':id_usuario' => $id_usuario
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Medicação cadastrada com sucesso!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar medicação: ' . htmlspecialchars($e->getMessage())]);
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido.']);
}
?>
