$(document).ready(function () {
    
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

});

function pegarMedicacoes(categoria, pagina) {
    $.ajax({
        url: `https://bula.vercel.app/medicamentos?categoria=${categoria}&pagina=${pagina}`,
        method: "GET",
        success: (res) => {
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
                </tr>`
            });

            $("#tbody_tabela_medicacao").html(concat);
            $("#div_tabela_medicacao").removeClass("d-none");

            $(".bula_link").on('click', function() {
                abre_pdf_bula($(this).data('id_bula'));
            })

        configurarNavegacaoPaginas(res.totalPages, categoria);

        },
        error: function () {
        alert("Erro ao buscar medicamentos.");
        },
    });
}
    
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
 * 
 * @param {*} pdf_url 
 */
function downloadBula(pdf_url) {

    const link = document.createElement('a');
    link.href = pdf_url;
    link.download = pdf_url.split('/').pop();
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function configurarNavegacaoPaginas(numPaginas, categoria) {
    for (let i = 1; i <= numPaginas; i++) {
        $("#pagination").append(`
                <li class="page-item">
                    <a class="page-link" href="#" data-pagina="${i}" data-categoria="${categoria}">${i}</a>
                </li>
            `);
    }

    $("#pagination a").on("click", function(event) {
        event.preventDefault(); // Evita a navegação da página
        const pagina = $(this).data("pagina");
        const categoria = $(this).data("categoria");
        pegarMedicacoes(categoria, pagina);
    });
}