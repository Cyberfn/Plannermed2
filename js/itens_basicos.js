$(document).ready(function() {
    get_categorias();
    abre_um_em_cima_do_outro();
});

/**
 * Monta o select de categoria de medicamentos 
 */
function get_categorias(){
    $.ajax({
        type: "GET",
        url: "https://bula.vercel.app/categorias",
        data: "",
        dataType: "json",
        success: (res) => {
            let select = '<option value="" disabled selected>Selecione uma categoria</option>'; 

            select += res.categorias.map((r, index) => {
            if (index !== 0 && index !== 5) {
                return `<option value="${r.id}">${r.descricao}</option>`;
            }
            })

            $("#categoria_select").html(select);
        }
    });
}

/**
 * Ajusta o z-index para permitir que múltiplos modais sejam abertos ao mesmo tempo.
 */
function abre_um_em_cima_do_outro(){
    $(document).on('show.bs.modal', '.modal', function () {
        let zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    $(document).on('hidden.bs.modal', '.modal', function () {
        if ($('.modal:visible').length) {
            $('.modal-backdrop').not('.modal-stack').css('z-index', 1040 + (10 * ($('.modal:visible').length - 1)));
        }
    });
}
