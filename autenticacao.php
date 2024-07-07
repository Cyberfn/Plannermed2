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

// Consulta preparada para buscar o login e a senha no banco de dados
$select = "SELECT login.id_login, login.senha, usuario.id_usuario, usuario.nome_usuario, usuario.email, tipo_usuario.id_tipo_usuario, tipo_usuario.nome
           FROM login
           INNER JOIN usuario ON login.id_usuario = usuario.id_usuario
           INNER JOIN tipo_usuario ON usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario
           WHERE login.login = ?";

$stmt = mysqli_stmt_init($conexao);
if (mysqli_stmt_prepare($stmt, $select)) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "s", $login);
    // Execute statement
    mysqli_stmt_execute($stmt);
    // Get result
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verifica a senha usando password_verify
        if (password_verify($senha, $row['senha'])) {
            // Autenticação bem-sucedida, iniciar sessão
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
        echo "<script>alert('Login ou senha inválidos')</script>";
        echo "<script>window.location.href='index.php'</script>";
        exit;
    }
} else {
    echo "Erro ao preparar a consulta SQL: " . mysqli_error($conexao);
}

// Fechar statement e conexão
mysqli_stmt_close($stmt);
mysqli_close($conexao);
?>
