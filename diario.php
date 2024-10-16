<?php

session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.php");
    exit;
}

$titulo_pagina = 'Diario';
$nome_style = 'css/diario.css';
include 'navbar.php'; ?>


<?php include 'footer.php'; ?>