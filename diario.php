<?php

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

$titulo_pagina = 'Diario';
$nome_style = 'css/diario.css';
include 'navbar.php'; ?>

<div id="diario_medicamentos">
    
</div>

<script src="js/diario.js"></script>
<?php include 'footer.php'; ?>