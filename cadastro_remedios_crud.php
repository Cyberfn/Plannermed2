<?php
session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $numeroRegistro = $_POST['numeroRegistro'];
    $numeroProcesso = $_POST['numeroProcesso'];
    $nomeProduto = $_POST['nomeProduto'];
    $nomeComercial = $_POST['nomeComercial'];
    $apresentacao = $_POST['apresentacao'];
    $formasFarmaceuticas = $_POST['formasFarmaceuticas'];
    $tarja = $_POST['tarja'];
    $categoriaRegulatoria = $_POST['categoriaRegulatoria'];
    $medicamentoReferencia = $_POST['medicamentoReferencia'];
    $principioAtivo = $_POST['principioAtivo'];
    $viasAdministracao = $_POST['viasAdministracao'];
    $classeTerapeutica = $_POST['classeTerapeutica'];
    $empresaNome = $_POST['empresaNome'];
    $empresaCnpj = $_POST['empresaCnpj'];
    $atc = $_POST['atc'];
    $conservacao = $_POST['conservacao'];
    $restricaoPrescricao = $_POST['restricaoPrescricao'];
    $restricaoUso = $_POST['restricaoUso'];
    $classesTerapeuticas = $_POST['classesTerapeuticas'];
    $dataProduto = $_POST['dataProduto'];
    $tipoProduto = $_POST['tipoProduto'];
    $restricaoHospitais = $_POST['restricaoHospitais'];
    $situacaoRegistro = $_POST['situacaoRegistro'];


    $dataProduto = date('Y-m-d', strtotime($dataProduto));

    try {

        $verificarMedicamento = "SELECT COUNT(*) FROM remedios WHERE 
            codigo = :codigo AND 
            numeroRegistro = :numeroRegistro AND 
            numeroProcesso = :numeroProcesso AND 
            nomeProduto = :nomeProduto AND 
            nomeComercial = :nomeComercial AND 
            apresentacao = :apresentacao AND 
            formasFarmaceuticas = :formasFarmaceuticas AND 
            tarja = :tarja AND 
            categoriaRegulatoria = :categoriaRegulatoria AND 
            medicamentoReferencia = :medicamentoReferencia AND 
            principioAtivo = :principioAtivo AND 
            viasAdministracao = :viasAdministracao AND 
            classeTerapeutica = :classeTerapeutica AND 
            empresaNome = :empresaNome AND 
            empresaCnpj = :empresaCnpj AND 
            atc = :atc AND 
            conservacao = :conservacao AND 
            restricaoPrescricao = :restricaoPrescricao AND 
            restricaoUso = :restricaoUso AND 
            classesTerapeuticas = :classesTerapeuticas AND 
            dataProduto = :dataProduto AND 
            tipoProduto = :tipoProduto AND 
            restricaoHospitais = :restricaoHospitais AND 
            situacaoRegistro = :situacaoRegistro";

        $stmt = $pdo->prepare($verificarMedicamento);
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

        $existeMedicamento = $stmt->fetchColumn();

        if ($existeMedicamento > 0) {
            echo "<script>alert('Medicamento já cadastrado.'); window.location.href='cadastro_medicamento.php';</script>";
        } else {

            $sql = "INSERT INTO remedios (
                        id, codigo, numeroRegistro, numeroProcesso, nomeProduto, nomeComercial, 
                        apresentacao, formasFarmaceuticas, tarja, categoriaRegulatoria, 
                        medicamentoReferencia, principioAtivo, viasAdministracao, classeTerapeutica, 
                        empresaNome, empresaCnpj, atc, conservacao, restricaoPrescricao, 
                        restricaoUso, classesTerapeuticas, dataProduto, tipoProduto, restricaoHospitais, 
                        situacaoRegistro
                    ) VALUES (
                        :id, :codigo, :numeroRegistro, :numeroProcesso, :nomeProduto, :nomeComercial, 
                        :apresentacao, :formasFarmaceuticas, :tarja, :categoriaRegulatoria, 
                        :medicamentoReferencia, :principioAtivo, :viasAdministracao, :classeTerapeutica, 
                        :empresaNome, :empresaCnpj, :atc, :conservacao, :restricaoPrescricao, 
                        :restricaoUso, :classesTerapeuticas, :dataProduto, :tipoProduto, :restricaoHospitais, 
                        :situacaoRegistro
                    )";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':id' => $id,
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

            echo "<script>alert('Medicamento cadastrado com sucesso!'); window.location.href='index.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar medicamento: " . htmlspecialchars($e->getMessage()) . "'); window.location.href='cadastro_medicamento.php';</script>";
    }
} else {
    header("Location: cadastro_medicamento.php");
}
