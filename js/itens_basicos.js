$(document).ready(function () {
    get_categorias();
    abre_um_em_cima_do_outro();
});

/**
 * Monta o select de categoria de medicamentos
 */
function get_categorias() {
    $.ajax({
        type: "GET",
        url: "https://bula.landin.dev.br/busca/categoria-regulatoria/lista",
        data: "",
        dataType: "json",
    success: (res) => {
            let select =
            '<option value="" disabled selected>Selecione uma categoria</option>';

        select += res.resultado.map((r) => {
            return `<option value="${r.nome}">${r.nome}</option>`;
        
        });

        $("#categoria_select").html(select);
    },
    });
}

/**
 * Ajusta o z-index para permitir que múltiplos modais sejam abertos ao mesmo tempo.
 */
function abre_um_em_cima_do_outro() {
    $(".modal").on({
        "show.bs.modal": function() {
            var idx = $(".modal:visible").length;
            $(this).css("z-index", 1040 + 10 * idx);
            $("#modal_alerta_notificacao").css("z-index", 1041 + 10 * idx);
        },
        "shown.bs.modal": function() {
            var idx = $(".modal:visible").length - 1; // raise backdrop after animation.
            $(".modal-backdrop").not(".stacked").css("z-index", 1039 + 10 * idx).addClass("stacked");
        },
        "hidden.bs.modal": function() {
            if ($(".modal:visible").length > 0) {
                setTimeout(function () {
                    $(document.body).addClass("modal-open");
                }, 0);
            }
        },
    });
}
