<?php

session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: index.php");
    exit;
}

$titulo_pagina = 'Principal';
$nome_style = 'css/principal.css';
include 'navbar.php';
?>


<script src="js/principal.js"></script>
<?php include 'footer.php'; ?>