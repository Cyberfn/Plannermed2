$(document).ready(function () {
    let carregando = false;

    $("#btn_buscar_medicacao_categoria").on("click", function() {
        $("#modal_busca_medicacao_categoria").modal("show");
    });

    $("#btn_buscar_remedio").on("click", function () {
        
        let categoria = $("#categoria_select").val();
        
        if (categoria) {
            const pagina = 1;
            pegarMedicacoes(categoria, pagina);
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
        if (paginaAtual < numPaginas && !carregando) {
            paginaAtual++;
            pegarMedicacoes($("#categoria_select").val(), paginaAtual);
        }
    });

});

/**
 * Monta a tabela com as informações dos medicamentos por categoria.
 *
 * @param {number} categoria - O ID da categoria dos medicamentos.
 * @param {number} pagina - O número da página a ser exibida.
 */
function pegarMedicacoes(categoria, pagina) {
    let carregando = true;

    $(".spinner-border").show();
    $("#btnAnterior, #btnProximo").prop("disabled", true);

    $.ajax({
        url: `https://bula.vercel.app/medicamentos?categoria=${categoria}&pagina=${pagina}`,
        method: "GET",
        dataType: "json",
        beforeSend: function() {
            $("#modal_agaurde").modal('show');
        },
        success: function(res) {
            let concat = '';

            res.content.map((r) => {
                concat += `
                    <tr>
                        <td>${r.nomeProduto}</td>
                        <td>${r.numeroRegistro}</td>
                        <td>${r.razaoSocial}</td>
                        <td class="bula_medicacao">
                            <a href="#" class="bula_link" data-id_bula="${r.idBulaPacienteProtegido}">
                                Baixar Bula
                            </a>
                        </td>
                    </tr>`;
            });

            $("#tbody_tabela_medicacao").html(concat);
            $("#div_tabela_medicacao").removeClass("d-none");
            $("#btns_navegacao").removeClass("d-none");
            $("#modal_agaurde").modal('hide');
        
            configurarNavegacaoPaginas(res.totalPages, categoria);

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
 * Faz uma requisição AJAX para obter e baixar o PDF da bula pelo ID.
 * 
 * @param {string} id_bula - O ID da bula.
 */
function abre_pdf_bula(id_bula) {
    $.ajax({
        type: "GET",
        url: `https://bula.vercel.app/bula?id=${id_bula}`,
        dataType: "json",
        success: (res) => {
            if (res.pdf) {
                downloadBula(res.pdf);
            } else {
                alert("PDF não encontrado.");
            }
        },
        error: function() {
            alert("Erro ao abrir a bula.");
        }
    });
}

/**
 * Realiza o download do PDF da bula a partir do URL fornecido.
 *
 * @param {string} pdf_url - O URL do PDF da bula a ser baixado.
 */
function downloadBula(pdf_url) {
    const link = document.createElement('a');
    link.href = pdf_url;
    link.download = pdf_url.split('/').pop();
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

/**
 * Configura a navegação de páginas para a lista de medicamentos.
 *
 * @param {number} numPaginas - O número total de páginas.
 * @param {number} categoria - O ID da categoria de medicamentos.
 */
function configurarNavegacaoPaginas(totalPages, categoria) {
    numPaginas = totalPages;
    paginaAtual = 1;
    
    $("#btnAnterior").prop("disabled", true);
    $("#btnProximo").prop("disabled", totalPages <= 1);
    
    if (totalPages > 1) {
        $("#btnProximo").prop("disabled", false);
    }
}