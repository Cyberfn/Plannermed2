<?php
$titulo_pagina = 'Remedios';
$nome_style = 'css/remedios.css';
include 'navbar.php'; ?>

<div class="text-center mt-3">
    <button id="btn_adicionar_medicacao" type="button" class="btn btn-primary">
        <i class="bi bi-capsule"></i>
        Adicionar medicação
    </button>
</div>

<div class="text-center mt-3">
    <button id="btn_buscar_medicacao_categoria" type="button" class="btn btn-primary">
        <i class="bi bi-capsule"></i>
        Pesquisar por categoria
    </button>
</div>

<div class="modal fade" id="modal_busca_medicacao_categoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <i class="bi bi-capsule"></i>
                    Buscar medicamentos por categoria
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end mt-3 mb-3">
                    <select id="categoria_select" class="form-select w-auto" aria-label="Categoria" style="text-transform: capitalize;"></select>
                    <button id="btn_buscar_remedio" class="btn btn-secondary ms-2"><i class="bi bi-search"></i> Buscar</button>
                </div>

                <div id="div_tabela_medicacao" class="d-none">
                    <table id="tabela_medicacao" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Nuemro de Registro</th>
                                <th>Razão Social</th>
                                <th>Bula</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_tabela_medicacao"></tbody>
                    </table>
                </div>

                <nav id="navegacao_medicacao" aria-label="Page navigation" class="mt-5">
                    <ul id="pagination" class="pagination justify-content-center"></ul>
                </nav>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>




































<script src="js/remedio.js"></script>
<?php include 'footer.php'; ?>