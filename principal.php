<?php

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

$titulo_pagina = 'Principal';
$nome_style = 'css/principal.css';
include 'navbar.php';
?>

<div id="div_card_noticias" class="row justify-content-center">
</div>

<script src="js/principal.js"></script>
<?php include 'footer.php'; ?>