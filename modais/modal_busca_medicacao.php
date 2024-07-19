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

    .card {
        width: 100%;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

</style>

<div class="modal fade" id="modal_busca_medicacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <i class="bi bi-capsule"></i>
                    Buscar medicamentos
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-end mb-3 col-12">
                    <input type="text" id="input_nome_medicamento" class="form-control w-250" placeholder="Digite o nome do medicamento" aria-label="Nome">
                    <button id="btn_buscar_medicamento" class="btn btn-secondary ms-2"><i class="bi bi-search"></i> Buscar</button>
                </div>

                <div id="div_cards_remedios" class="container d-none">
                </div>

                <div id="btns_navegacao_medicamentos" class="d-none d-flex justify-content-center mt-3">
                    <button type="button" id="btn_nav_modal_anterior" class="btn btn-secondary me-2" >&lt; Anterior</button>
                    <button type="button" id="btn_nav_modal_proximo" class="btn btn-secondary">Próximo &gt;</button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>