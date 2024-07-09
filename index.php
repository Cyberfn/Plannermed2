<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? $titulo_pagina : 'Título Padrão'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <div class="div_branca">
        <div class="d-flex justify-content-center mt-5 mb-3">
            <img class="logo_img" src="img/logo_plannermed.png">
        </div>
        <form action="autenticacao.php" method="post">
            <div class="mt-4">
                <div class="input input-group mt-5">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="input input-group mt-4">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
                    <input id="input_senha_login" type="password" class="form-control" name="password" placeholder="Senha">
                    <button class="btn btn-outline-secondary" type="button" id="btn_olho_senha">
                        <i id="icon_olho_senha" class="bi bi-eye-fill"></i>
                    </button>
                </div>
                <div class="mt-4 d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" type="submit">Acessar</button>
                </div>

                <div class="text-center mt-4">
                    <a href="esqueceu_senha.php">Esqueceu a Senha?</a>
                </div>

                <div class="text-center mt-3">
                    <span>Não possui conta?</span>
                    <a href="cadastro_usuario.php">Criar conta</a>
                </div>
            </div>
        </form>

    </div>
    <script src="js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>