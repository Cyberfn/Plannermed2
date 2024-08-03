<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro usuário</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cadastro_usuario.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<div class="div_branca">
    <div class="d-flex justify-content-center mt-2 mb-4">
        <img class="logo_img" src="img/logo_plannermed.png">
    </div>

    <form id="form_cadastro_usuario" action="cadastro_usuario_script.php" method="post" class="needs-validation" novalidate>
        <div class="mt-4">
            <div class="row mt-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="nome-addon"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome Completo" required>
                        <div class="invalid-feedback">Nome é obrigatório.</div>
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
                        <span class="input-group-text" id="email-addon"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        <div class="invalid-feedback">Email é obrigatório.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="tipo-usuario-addon"><i class="bi bi-person-check-fill"></i></span>
                        <select name="tipo_usuario" id="tipo_usuario" class="form-select" required>
                            <option value="" disabled selected>Selecione o Tipo de Usuário</option>
                            <option value="1">Usuário Comum</option>
                            <option value="2">Dependente</option>
                        </select>
                        <div class="invalid-feedback">Selecione o tipo de usuário.</div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="senha-addon"><i class="bi bi-lock-fill"></i></span>
                        <input id="senha" type="password" name="senha" class="form-control" placeholder="Senha" required>
                        <div id="senha-error" class="invalid-feedback">A senha deve ter no mínimo 6 caracteres.</div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="senha-confirmacao-addon"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="senha_confirmacao" id="senha_confirmacao" class="form-control" placeholder="Confirme a Senha" required>
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
        <button id="btn_voltar" action="index.php" class="btn btn-primary">Voltar</button>
    </div>
</div>
<script src="js/cadastro_usuario.js"></script>
<?php include 'footer.php'; ?>