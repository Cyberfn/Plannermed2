<?php
$titulo_pagina = 'Login';
$nome_style = 'css/index.css';
?>
<?php include 'header.php'; ?>

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
<?php include 'footer.php'; ?>
