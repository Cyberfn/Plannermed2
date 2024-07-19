$(document).ready(function () {
    let carregando = false;
    let paginaAtual = 1;
    let totalPaginas = 0;

    $("#btn_buscar_medicacao_categoria").on("click", function () {
        $("#modal_busca_medicacao_categoria").modal("show");
    });

    $("#btn_buscar_remedio").on("click", function () {
        let categoria = $("#categoria_select").val();
        if (categoria) {
            paginaAtual = 1;
            pegar_medicacoes_categoria(categoria, paginaAtual);
        } else {
            alert("Por favor, escolha uma categoria antes de buscar.");
        }
    });

    $("#btn_anterior").on("click", function () {
        if (paginaAtual > 1 && !carregando) {
            paginaAtual--;
            pegar_medicacoes_categoria($("#categoria_select").val(), paginaAtual);
        }
    });

    $("#btn_proximo").on("click", function () {
        if (paginaAtual < totalPaginas && !carregando) {
            paginaAtual++;
            pegar_medicacoes_categoria($("#categoria_select").val(), paginaAtual);
        }
    });

    $("#btn_nav_modal_anterior").on("click", function () {
        if (paginaAtual > 1 && !carregando) {
            paginaAtual--;
            pegar_medicacoes_nome($("#input_nome_medicamento").val(), paginaAtual);
        }
    });

    $("#btn_nav_modal_proximo").on("click", function () {
        if (paginaAtual < totalPaginas && !carregando) {
            paginaAtual++;
            pegar_medicacoes_nome($("#input_nome_medicamento").val(), paginaAtual);
        }
    });

    $("#btn_adicionar_medicacao").on("click", function () {
        $("#modal_busca_medicacao").modal("show");
    });

    $("#btn_buscar_medicamento").on("click", function () {
        let categoria = $("#input_nome_medicamento").val();
        if (categoria) {
            paginaAtual = 1;
            pegar_medicacoes_nome(categoria, paginaAtual);
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

    function pegar_medicacoes_categoria(categoria, pagina) {
        carregando = true;

        $(".spinner-border").show();
        $("#btn_anterior, #btn_proximo").prop("disabled", true);

        $.ajax({
            url: "https://bula.landin.dev.br/busca/categoria-regulatoria?",
            method: "GET",
            data: {
                termo: categoria,
                pagina: pagina,
            },
            dataType: "json",
            beforeSend: function () {
                $("#modal_agaurde").modal("show");
            },
            success: function (res) {
                let concat = "";

                res.resultado.map((r) => {
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

                $("#div_cards_medicacao").html(
                    `<div class="row justify-content-center">${concat}</div>`
                );

                $(".card").on("click", function () {
                    let numeroProcesso = $(this).data("numero_processo");
                    mostrar_metalhes_medicacao(numeroProcesso);
                });

                $("#div_cards_medicacao").removeClass("d-none");
                $("#btns_navegacao_categoria").removeClass("d-none");
                $("#modal_agaurde").modal("hide");

                totalPaginas = res.totalPaginas;

                atualizar_botoes_navegacao();
            },
            error: function () {
                alert("Erro ao buscar medicamentos.");
            },
            complete: function () {
                carregando = false;

                $(".spinner-border").hide();
                $("#btn_anterior, #btn_proximo").prop("disabled", false);
            },
        });
    }

    function pegar_medicacoes_nome(nome, pagina) {
        $.ajax({
            type: "GET",
            url: "https://bula.landin.dev.br/busca/",
            data: {
                termo: nome,
                pagina: pagina,
            },
            dataType: "json",
            success: (res) => {
                let concat = "";

                res.resultado.map((r) => {
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

                $("#div_cards_remedios").html(
                    `<div class="row justify-content-center">${concat}</div>`
                );

                $(".card").on("click", function () {
                    let numeroProcesso = $(this).data("numero_processo");
                    mostrar_metalhes_medicacao(numeroProcesso);
                });

                $("#div_cards_remedios").removeClass("d-none");
                $("#btns_navegacao_medicamentos").removeClass("d-none");
                $("#modal_agaurde").modal("hide");

                totalPaginas = res.totalPaginas;

                atualizar_botoes_navegacao();
            },
        });
    }

    function atualizar_botoes_navegacao() {
        $("#btn_nav_modal_anterior").prop("disabled", paginaAtual === 1);
        $("#btn_nav_modal_proximo").prop("disabled", paginaAtual === totalPaginas);

        $("#btn_anterior").prop("disabled", paginaAtual === 1);
        $("#btn_proximo").prop("disabled", paginaAtual === totalPaginas);
    }

    function mostrar_metalhes_medicacao(numeroProcesso) {
        $.ajax({
            url: `https://bula.landin.dev.br/busca/numero-processo/${numeroProcesso}`,
            method: "GET",
            dataType: "json",
            success: function (res) {
                $("#modal_detalhes_medicacao .modal-title").text(res.nomeProduto);
                $("#modal_detalhes_medicacao .modal-body").html(`
                    <p><strong>Nome Comercial:</strong> ${res.nomeComercial}</p>
                    <p><strong>Apresentação:</strong> ${res.apresentacao}</p>
                    <p><strong>Formas Farmacêuticas:</strong> ${res.formasFarmaceuticas}</p>
                    <p><strong>Tarja:</strong> ${res.tarja == null ? "MIP (Medicação isento de prescrição)" : res.tarja}</p>
                    <p><strong>Categoria Regulatória:</strong> ${res.categoriaRegulatoria}</p>
                    <p><strong>Referência:</strong> ${res.medicamentoReferencia ? res.medicamentoReferencia : "Medicamento inovador"}</p>
                    <p><strong>Princípio Ativo:</strong> ${res.principioAtivo}</p>
                    <p><strong>Vias de Administração:</strong> ${res.viasAdministracao}</p>
                    <p><strong>Empresa:</strong> ${res.empresaNome} (${res.empresaCnpj})</p>
                    <p><strong>Conservação:</strong> ${res.conservacao}</p>
                    <p><strong>Restrição de Prescrição:</strong> ${res.restricaoPrescricao ? res.restricaoPrescricao : "Sem restrição de prescrição"}</p>
                    <p><strong>Restrição de Uso:</strong> ${res.restricaoUso ? res.restricaoUso : "Medicação de venda livre"}</p>
                    <p><strong>Classe Terapêutica:</strong> ${res.classeTerapeutica ? res.classeTerapeutica : "Sem classe terapêutica específica"}</p>
                `);
                $("#modal_detalhes_medicacao").modal("show");
            },
            error: function () {
                alert("Erro ao buscar detalhes da medicação.");
            },
        });
    }
});
