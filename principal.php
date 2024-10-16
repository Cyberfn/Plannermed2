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


<script src="js/principal.js"></script>
<?php include 'footer.php'; ?>