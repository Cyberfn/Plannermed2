<?php
include('conexao.php');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$login = isset($_POST['login']) ? $_POST['login'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$query_verificar_usuario = "SELECT * FROM usuario
    INNER JOIN login
    ON usuario.id_usuario = login.id_usuario
    WHERE usuario.email = '$email' AND login.login = '$login'";

$resultado_verificar_usuario = mysqli_query($conexao, $query_verificar_usuario);

if (mysqli_num_rows($resultado_verificar_usuario) > 0) {
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Usando hash para segurança
    $renovar = "UPDATE login SET senha = '$senha_hash' WHERE login = '$login'";
    $query_validacao = mysqli_query($conexao, $renovar);

    if (!$query_validacao) {
        die("Erro na consulta: " . mysqli_error($conexao));
    } else {
        header("location: index.php");
    }
} else {
    echo "<script>window.alert('Email e/ou login inválidos')</script>";
    echo "<script>window.location.href='confirmar_dados.php'</script>";
}
