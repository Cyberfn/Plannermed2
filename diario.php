<?php

session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: index.php");
    exit;
}

$titulo_pagina = 'Diario';
$nome_style = 'css/diario.css';
include 'navbar.php'; ?>


<?php include 'footer.php'; ?>