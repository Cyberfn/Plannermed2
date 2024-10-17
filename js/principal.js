$(document).ready(function() {
    cards_noticias();
});

function cards_noticias() {
    $.ajax({
        type: "get",
        url: "https://api.rss2json.com/v1/api.json?rss_url=https://www.fda.gov/about-fda/contact-fda/stay-informed/rss-feeds/press-releases/rss.xml",
        dataType: "json",
        success: (res) => {
            let concat = ''; 
            res.items.forEach(item => {
              concat += `
                <div class="col-md-4 mt-3">
                  <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                      <h5 class="card-title">${item.title}</h5>
                      <p class="card-text">${item.description.substring(0, 100)}...</p>
                      <a href="${item.link}" class="btn btn-primary" target="_blank">Leia mais</a>
                    </div>
                  </div>
                </div>`;
            });

            $('#div_card_noticias').html(concat);  // Insere o HTML dos cards na div
        },
        error: () => {
            $('#div_card_noticias').html('<p>Não foi possível carregar as notícias.</p>');  // Mensagem de erro
        }
    });
}
