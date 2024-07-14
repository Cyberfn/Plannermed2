<style>
    #navegacao_medicacao {
        overflow-x: auto;
        white-space: nowrap;
        max-width: 100%;
        scrollbar-width: thin;
        scrollbar-color: #ccc transparent;
    }

    #pagination {
        display: inline-flex;
        padding: 0;
    }

    #navegacao_medicacao::-webkit-scrollbar {
        width: 8px;
        height: 8px;
        border-radius: 4px;
    }

    #navegacao_medicacao::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }

    #navegacao_medicacao::-webkit-scrollbar-track {
        background-color: transparent;
    }
</style>

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
                <div class="d-flex justify-content-end mb-3">
                    <select id="categoria_select" class="form-select w-auto" aria-label="Categoria" style="text-transform: capitalize;"></select>
                    <button id="btn_buscar_remedio" class="btn btn-secondary ms-2"><i class="bi bi-search"></i> Buscar</button>
                </div>

                <div id="div_tabela_medicacao" class="d-none">
                    <table id="tabela_medicacao" class="table table-bordered border-primary">
                        <thead>
                            <tr>
                                <th class="text-center">Nome do Produto</th>
                                <th class="text-center">Nuemro de Registro</th>
                                <th class="text-center">Razão Social</th>
                                <th class="text-center">Bula</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_tabela_medicacao"></tbody>
                    </table>
                </div>

                <div id="btns_navegacao" class="d-none d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary me-2" id="btnAnterior">&lt; Anterior</button>
                    <button type="button" class="btn btn-secondary" id="btnProximo">Próximo &gt;</button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>