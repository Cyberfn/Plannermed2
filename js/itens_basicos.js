$(document).ready(function() {
    get_categorias();
});

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