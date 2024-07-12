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

<div class="modal fade" id="modal_busca_medicacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <i class="bi bi-capsule"></i>
                    Buscar medicamentos
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center mt-3 mb-3">
                    <input id="input_busca_medicamento" class="form-control w-50 mx-2" type="text" placeholder="Digite o nome do medicamento">
                    <button id="btn_buscar_remedio" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                </div>

                <div id="div_tabela_medicacao" class="d-none">
                    <table id="tabela_medicacao" class="table ">
                        <thead>
                            <tr>
                                <th>Nome do Produto</th>
                                <th>Razão Social</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_tabela_medicacao"></tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="js/remedio.js"></script>
<?php include 'footer.php'; ?>