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
                <select id="categoria_select" class="form-select w-auto" aria-label="Categoria" style="text-transform: capitalize; max-height: 200px; overflow-y: auto;"></select>
                <button id="btn_buscar_remedio" class="btn btn-secondary ms-2"><i class="bi bi-search"></i> Buscar</button>
                </div>

                <div id="div_cards_medicacao" class="container d-none">
                </div>

                <div id="btns_navegacao_categoria" class="d-none d-flex justify-content-center mt-3">
                    <button type="button" id="btn_anterior" class="btn btn-secondary me-2">&lt; Anterior</button>
                    <button type="button" id="btn_proximo" class="btn btn-secondary">Próximo &gt;</button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>