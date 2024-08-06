$(document).ready(function () {
    abre_um_em_cima_do_outro();
});

function abre_um_em_cima_do_outro() {
    $(".modal").on({
        "show.bs.modal": function() {
            var idx = $(".modal:visible").length;
            $(this).css("z-index", 1040 + 10 * idx);
            $("#modal_alerta_notificacao").css("z-index", 1041 + 10 * idx);
        },
        "shown.bs.modal": function() {
            var idx = $(".modal:visible").length - 1;
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
