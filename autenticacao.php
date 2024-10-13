<?php
session_start();

include('conexao.php');

$login = isset($_POST['username']) ? $_POST['username'] : '';
$senha = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($login) || empty($senha)) {
    echo "<script>alert('O campo login e senha são obrigatórios')</script>";
    echo "<script>window.location.href='index.php'</script>";
    exit;
}

$select = "SELECT 
                login.id_login, 
                login.senha, 
                usuario.id_usuario, 
                usuario.nome_usuario, 
                usuario.email, 
                tipo_usuario.id_tipo_usuario, 
                tipo_usuario.nome
           FROM 
                login
           INNER JOIN usuario ON login.id_usuario = usuario.id_usuario
           INNER JOIN tipo_usuario ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario
           WHERE login.login = ?";

$stmt = $pdo->prepare($select);

if ($stmt->execute([$login])) {

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && password_verify($senha, $row['senha'])) {
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nome_usuario'] = $row['nome_usuario'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id_tipo_usuario'] = $row['id_tipo_usuario'];
        $_SESSION['tipo_usuario'] = $row['nome'];

        header("Location: principal.php");
        exit;
    } else {

        echo "<script>alert('Login ou senha inválidos')</script>";
        echo "<script>window.location.href='index.php'</script>";
        exit;
    }
} else {

    echo "Erro ao executar a consulta SQL";
}