<?php

session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: index.php");
    exit;
}

$titulo_pagina = 'Remedios';
$nome_style = 'css/remedios.css';
include 'navbar.php';
include 'modais/modal_busca_categoria.php';
include 'modais/modal_detalhes_medicacao.php';
include 'modais/modal_busca_medicacao.php';
include 'modais/modal_cadastro_medicamento_usuario.php';
?>

<div class="text-center mt-3">
    <div class="d-inline-block">
        <button id="btn_adicionar_medicacao" type="button" class="btn btn-primary">
            <i class="bi bi-capsule"></i>
            Adicionar medicação
        </button>
    </div>
</div>






































<script src="js/remedio.js"></script>
<?php include 'footer.php'; ?>