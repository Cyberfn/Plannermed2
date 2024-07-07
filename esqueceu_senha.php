<?php
$titulo_pagina = 'Recuperar senha';
$nome_style = 'css/esqueceu_senha.css';
?>
<?php include 'header.php'; ?>

<div class="div_branca">
    <div class="d-flex justify-content-center mt-2 mb-4">
        <img class="logo_img" src="img/logo_plannermed.png" alt="Logo">
    </div>

    <form id="form_confirma_dados" action="esqueceu_senha_script.php" method="post" class="needs-validation" novalidate>
        <div class="mt-4">
            <div class="row mt-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="email-addon"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        <div class="invalid-feedback">Email é obrigatório.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="login-addon"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="login" id="login" class="form-control" placeholder="Username" required>
                        <div class="invalid-feedback">Username é obrigatório.</div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="senha-addon"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
                        <button class="btn btn-outline-secondary" type="button" id="btn_mostrar_senha">
                            <i id="icon_mostrar_senha" class="bi bi-eye-fill"></i>
                        </button>
                        <div id="senha-error" class="invalid-feedback">A senha deve ter no mínimo 6 caracteres.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="senha-confirmacao-addon"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="confirma" id="confirma" class="form-control" placeholder="Confirme a Senha" required>
                        <button class="btn btn-outline-secondary" type="button" id="btn_mostrar_confirma">
                            <i id="icon_mostrar_confirma" class="bi bi-eye-fill"></i>
                        </button>
                        <div id="senha-confirmacao-error" class="invalid-feedback">As senhas não coincidem.</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 d-grid gap-2 col-6 mx-auto">
                <button id="btn_cadastrar" class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>
    <div class="text-center mt-2">
        <button id="btn_voltar" class="btn btn-primary">Voltar</button>
    </div>
</div>
<script src="js/esqueceu_senha.js"></script>
<?php include 'footer.php'; ?>
