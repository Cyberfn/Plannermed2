<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    function sanitizeInput($data) {
        return htmlspecialchars(trim($data));
    }

    $id = sanitizeInput($_POST['id']);
    $codigo = sanitizeInput($_POST['codigo']);
    $numeroRegistro = sanitizeInput($_POST['numeroRegistro']);
    $numeroProcesso = sanitizeInput($_POST['numeroProcesso']);
    $nomeProduto = sanitizeInput($_POST['nomeProduto']);
    $nomeComercial = sanitizeInput($_POST['nomeComercial']);
    $apresentacao = sanitizeInput($_POST['apresentacao']);
    $formasFarmaceuticas = sanitizeInput($_POST['formasFarmaceuticas']);
    $tarja = sanitizeInput($_POST['tarja']);
    $categoriaRegulatoria = sanitizeInput($_POST['categoriaRegulatoria']);
    $medicamentoReferencia = sanitizeInput($_POST['medicamentoReferencia']);
    $principioAtivo = sanitizeInput($_POST['principioAtivo']);
    $viasAdministracao = sanitizeInput($_POST['viasAdministracao']);
    $classeTerapeutica = sanitizeInput($_POST['classeTerapeutica']);
    $empresaNome = sanitizeInput($_POST['empresaNome']);
    $empresaCnpj = sanitizeInput($_POST['empresaCnpj']);
    $atc = sanitizeInput($_POST['atc']);
    $conservacao = sanitizeInput($_POST['conservacao']);
    $restricaoPrescricao = sanitizeInput($_POST['restricaoPrescricao']);
    $restricaoUso = sanitizeInput($_POST['restricaoUso']);
    $classesTerapeuticas = sanitizeInput($_POST['classesTerapeuticas']);
    $dataProduto = sanitizeInput($_POST['dataProduto']);
    $tipoProduto = sanitizeInput($_POST['tipoProduto']);
    $restricaoHospitais = sanitizeInput($_POST['restricaoHospitais']);
    $situacaoRegistro = sanitizeInput($_POST['situacaoRegistro']);

    
    $dataProduto = date('Y-m-d', strtotime($dataProduto));

    try {
        
        $verificarMedicamento = "SELECT COUNT(*) FROM remedios WHERE 
            codigo = :codigo AND 
            numeroRegistro = :numeroRegistro AND 
            numeroProcesso = :numeroProcesso";

        $stmt = $pdo->prepare($verificarMedicamento);
        $stmt->execute([
            ':codigo' => $codigo,
            ':numeroRegistro' => $numeroRegistro,
            ':numeroProcesso' => $numeroProcesso
        ]);

        $existeMedicamento = $stmt->fetchColumn();

        if ($existeMedicamento > 0) {
            echo "<script>alert('Medicamento já cadastrado.'); window.location.href='cadastro_medicamento.php';</script>";
        } else {
            $sql = "INSERT INTO remedios (
                        codigo, numeroRegistro, numeroProcesso, nomeProduto, nomeComercial, 
                        apresentacao, formasFarmaceuticas, tarja, categoriaRegulatoria, 
                        medicamentoReferencia, principioAtivo, viasAdministracao, classeTerapeutica, 
                        empresaNome, empresaCnpj, atc, conservacao, restricaoPrescricao, 
                        restricaoUso, classesTerapeuticas, dataProduto, tipoProduto, restricaoHospitais, 
                        situacaoRegistro
                    ) VALUES (
                        :codigo, :numeroRegistro, :numeroProcesso, :nomeProduto, :nomeComercial, 
                        :apresentacao, :formasFarmaceuticas, :tarja, :categoriaRegulatoria, 
                        :medicamentoReferencia, :principioAtivo, :viasAdministracao, :classeTerapeutica, 
                        :empresaNome, :empresaCnpj, :atc, :conservacao, :restricaoPrescricao, 
                        :restricaoUso, :classesTerapeuticas, :dataProduto, :tipoProduto, :restricaoHospitais, 
                        :situacaoRegistro
                    )";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':codigo' => $codigo,
                ':numeroRegistro' => $numeroRegistro,
                ':numeroProcesso' => $numeroProcesso,
                ':nomeProduto' => $nomeProduto,
                ':nomeComercial' => $nomeComercial,
                ':apresentacao' => $apresentacao,
                ':formasFarmaceuticas' => $formasFarmaceuticas,
                ':tarja' => $tarja,
                ':categoriaRegulatoria' => $categoriaRegulatoria,
                ':medicamentoReferencia' => $medicamentoReferencia,
                ':principioAtivo' => $principioAtivo,
                ':viasAdministracao' => $viasAdministracao,
                ':classeTerapeutica' => $classeTerapeutica,
                ':empresaNome' => $empresaNome,
                ':empresaCnpj' => $empresaCnpj,
                ':atc' => $atc,
                ':conservacao' => $conservacao,
                ':restricaoPrescricao' => $restricaoPrescricao,
                ':restricaoUso' => $restricaoUso,
                ':classesTerapeuticas' => $classesTerapeuticas,
                ':dataProduto' => $dataProduto,
                ':tipoProduto' => $tipoProduto,
                ':restricaoHospitais' => $restricaoHospitais,
                ':situacaoRegistro' => $situacaoRegistro
            ]);

            echo "<script>alert('Medicamento cadastrado com sucesso!'); window.location.href='cadastro_medicamento.php';</script>";
        }
    } catch (PDOException $e) {
        
        echo "<script>alert('Erro ao cadastrar medicamento. Por favor, tente novamente mais tarde.'); window.location.href='cadastro_medicamento.php';</script>";
        
        error_log($e->getMessage());
    }
} else {
    header("Location: cadastro_medicamento.php");
}
?>