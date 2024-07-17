$(document).ready(function () {
    let carregando = false;
    let paginaAtual = 1;
    let totalPaginas = 0;

    $("#btn_buscar_medicacao_categoria").on("click", function() {
        $("#modal_busca_medicacao_categoria").modal("show");
    });

    $("#btn_buscar_remedio").on("click", function () {
        let categoria = $("#categoria_select").val();
        if (categoria) {
            paginaAtual = 1;
            pegarMedicacoes(categoria, paginaAtual);
        } else {
            alert("Por favor, escolha uma categoria antes de buscar.");
        }
    });

    $("#categoria_select").on("change", function () {
        if ($(this).val() !== "") {
            $("#btn_buscar_remedio").prop("disabled", false);
        } else {
            $("#btn_buscar_remedio").prop("disabled", true);
        }
    });

    $("#modal_busca_medicacao").on("show.bs.modal", function () {
        $("#div_tabela_medicacao").addClass("d-none");
        $("#categoria_select").val("");
        $("#input_busca_medicamento").val("");
    });

    $("#btnAnterior").on("click", function() {
        if (paginaAtual > 1 && !carregando) {
            paginaAtual--;
            pegarMedicacoes($("#categoria_select").val(), paginaAtual);
        }
    });
    
    $("#btnProximo").on("click", function() {
        if (paginaAtual < totalPaginas && !carregando) {
            paginaAtual++;
            pegarMedicacoes($("#categoria_select").val(), paginaAtual);
        }
    });

    /**
     * Busca medicamentos por categoria e página.
     *
     * @param {string} categoria - O ID da categoria dos medicamentos.
     * @param {number} pagina - O número da página a ser exibida.
     */
    function pegarMedicacoes(categoria, pagina) {
        carregando = true;

        $(".spinner-border").show();
        $("#btnAnterior, #btnProximo").prop("disabled", true);

        $.ajax({
            url: `https://bula.landin.dev.br/busca/categoria-regulatoria?termo=${categoria}&pagina=${pagina}`,
            method: "GET",
            dataType: "json",
            beforeSend: function() {
                $("#modal_agaurde").modal('show');
            },
            success: function(res) {
                let concat = '';

                res.resultado.forEach((r) => {
                    concat += `
                        <div class="col-md-4 mb-2" style="cursor: pointer;">
                            <div class="card h-100" data-numero_processo="${r.numeroProcesso}">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">${r.nomeProduto}</h5>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">${r.numeroRegistro}</h6>
                                    <p class="card-text">${r.empresaNome}</p>
                                </div>
                            </div>
                        </div>`;
                });

                $("#div_cards_medicacao").html(`<div class="row justify-content-center">${concat}</div>`);

                $(".card").on('click', function() {
                    let numeroProcesso = $(this).data("numero_processo");
                    mostrarDetalhesMedicacao(numeroProcesso);
                });

                $("#div_cards_medicacao").removeClass("d-none");
                $("#btns_navegacao").removeClass("d-none");
                $("#modal_agaurde").modal('hide');

                totalPaginas = res.totalPaginas;

                atualizarBotoesNavegacao();
            },
            error: function () {
                alert("Erro ao buscar medicamentos.");
            },
            complete: function () {
                carregando = false;

                $(".spinner-border").hide();
                $("#btnAnterior, #btnProximo").prop("disabled", false);
            }
        });
    }

    /**
     * Atualiza o estado dos botões de navegação com base na página atual e no total de páginas.
     */
    function atualizarBotoesNavegacao() {
        $("#btnAnterior").prop("disabled", paginaAtual === 1);
        $("#btnProximo").prop("disabled", paginaAtual === totalPaginas);
    }

    /**
     * Exibe os detalhes de um medicamento em um modal.
     *
     * @param {string} numeroProcesso - O número do processo do medicamento.
     */
    function mostrarDetalhesMedicacao(numeroProcesso) {
        $.ajax({
            url: `https://bula.landin.dev.br/busca/numero-processo/${numeroProcesso}`,
            method: "GET",
            dataType: "json",
            success: function(res) {
                $("#modal_detalhes_medicacao .modal-title").text(res.nomeProduto);
                $("#modal_detalhes_medicacao .modal-body").html(`
                    <p><strong>Nome Comercial:</strong> ${res.nomeComercial}</p>
                    <p><strong>Apresentação:</strong> ${res.apresentacao}</p>
                    <p><strong>Formas Farmacêuticas:</strong> ${res.formasFarmaceuticas}</p>
                    <p><strong>Tarja:</strong> ${res.tarja == null ? 'MIP (Medicação isento de prescrição)' : res.tarja}</p>
                    <p><strong>Categoria Regulatória:</strong> ${res.categoriaRegulatoria}</p>
                    <p><strong>Referência:</strong> ${res.medicamentoReferencia ? res.medicamentoReferencia : 'Medicamento inovador'}</p>
                    <p><strong>Princípio Ativo:</strong> ${res.principioAtivo}</p>
                    <p><strong>Vias de Administração:</strong> ${res.viasAdministracao}</p>
                    <p><strong>Empresa:</strong> ${res.empresaNome} (${res.empresaCnpj})</p>
                    <p><strong>Conservação:</strong> ${res.conservacao}</p>
                    <p><strong>Restrição de Prescrição:</strong> ${res.restricaoPrescricao ? res.restricaoPrescricao : 'Sem restrição de prescrição'}</p>
                    <p><strong>Restrição de Uso:</strong> ${res.restricaoUso ? res.restricaoUso : 'Medicação de venda livre'}</p>
                    <p><strong>Classe Terapêutica:</strong> ${res.classeTerapeutica ? res.classeTerapeutica : 'Sem classe terapêutica específica'}</p>
                `);
                $("#modal_detalhes_medicacao").modal('show');
            },
            error: function() {
                alert("Erro ao buscar detalhes da medicação.");
            }
        });
    }
});
