<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $login = mysqli_real_escape_string($conexao, $_POST['login']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];
    $senha_confirmacao = $_POST['senha_confirmacao'];
    $tipo_usuario = $_POST['tipo_usuario'];

    $verificar_login = "SELECT login FROM login WHERE login ='$login'";
    $query_ver_login = mysqli_query($conexao, $verificar_login);
    $quant_login = mysqli_num_rows($query_ver_login);

    if ($quant_login > 0) {
        echo "<script>alert('O login já existe, por favor escolha outro')</script>";
        echo "<script>window.location.href='cadastro_usuario.php'</script>";
    } else {

        if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
            echo "<script>alert('O login deve conter apenas letras e números.')</script>";
            echo "<script>window.location.href='cadastro_usuario.php'</script>";
        } else {

            if ($tipo_usuario == 1 || $tipo_usuario == 2) {

                if ($tipo_usuario == 1) {
                    $verificar_email = "SELECT email FROM usuario WHERE email = '$email'";
                    $query_verificar = mysqli_query($conexao, $verificar_email);

                    if (mysqli_num_rows($query_verificar) > 0) {
                        echo "<script>alert('Usuário já cadastrado com este email.')</script>";
                        echo "<script>window.location.href='cadastro_usuario.php'</script>";
                        exit;
                    }
                }

                if ($senha !== $senha_confirmacao) {
                    echo "<script>alert('As senhas não coincidem.')</script>";
                    echo "<script>window.location.href='cadastro_usuario.php'</script>";
                    exit;
                }

                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                $incluir_usuario = "INSERT INTO usuario (nome_usuario, email, id_tipo_usuario)
                                    VALUES ('$nome', '$email', $tipo_usuario)";
                $query_incluir_usuario = mysqli_query($conexao, $incluir_usuario);

                if (!$query_incluir_usuario) {
                    echo "<script>alert('Erro ao cadastrar usuário.')</script>";
                    echo "<script>window.location.href='cadastro_usuario.php'</script>";
                    exit;
                }
                $id_usuario = mysqli_insert_id($conexao);
                $incluir_login = "INSERT INTO login (login, senha, id_usuario)
                                    VALUES ('$login', '$senha_hash', $id_usuario)";
                $query_incluir_login = mysqli_query($conexao, $incluir_login);

                if ($query_incluir_login) {
                    echo "<script>alert('Cadastrado com sucesso!'); window.location.href='index.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Erro ao cadastrar usuário.')</script>";
                    echo "<script>window.location.href='cadastro_usuario.php'</script>";
                }
            } else {
                echo "<script>alert('Tipo de usuário inválido.')</script>";
                echo "<script>window.location.href='cadastro_usuario.php'</script>";
            }
        }
    }
} else {
    header("Location: cadastro_usuario.php");
}