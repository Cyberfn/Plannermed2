<?php
session_start();
include('conexao.php'); // Agora $pdo é a conexão PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare statements to prevent SQL Injection
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_confirmacao = $_POST['senha_confirmacao'];
    $tipo_usuario = $_POST['tipo_usuario'];

    try {
        // Verificar se o login já existe
        $stmt = $pdo->prepare("SELECT login FROM login WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $quant_login = $stmt->rowCount();

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
                        $stmt = $pdo->prepare("SELECT email FROM usuario WHERE email = :email");
                        $stmt->execute(['email' => $email]);

                        if ($stmt->rowCount() > 0) {
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

                    // Inserir usuário
                    $stmt = $pdo->prepare("INSERT INTO usuario (nome_usuario, email, id_tipo_usuario) VALUES (:nome, :email, :tipo_usuario)");
                    $stmt->execute([
                        'nome' => $nome,
                        'email' => $email,
                        'tipo_usuario' => $tipo_usuario
                    ]);

                    $id_usuario = $pdo->lastInsertId();

                    // Inserir login
                    $stmt = $pdo->prepare("INSERT INTO login (login, senha, id_usuario) VALUES (:login, :senha_hash, :id_usuario)");
                    $stmt->execute([
                        'login' => $login,
                        'senha_hash' => $senha_hash,
                        'id_usuario' => $id_usuario
                    ]);

                    echo "<script>alert('Cadastrado com sucesso!'); window.location.href='index.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Tipo de usuário inválido.')</script>";
                    echo "<script>window.location.href='cadastro_usuario.php'</script>";
                }
            }
        }
    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar usuário.')</script>";
        echo "<script>window.location.href='cadastro_usuario.php'</script>";
    }
} else {
    header("Location: cadastro_usuario.php");
}
?>
