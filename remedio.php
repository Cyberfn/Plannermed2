<?php
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
    <div class="d-inline-block ml-2">
        <button id="btn_buscar_medicacao_categoria" type="button" class="btn btn-primary">
            <i class="bi bi-capsule"></i>
            Pesquisar por categoria
        </button>
    </div>
</div>






































<script src="js/remedio.js"></script>
<?php include 'footer.php'; ?>