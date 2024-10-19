$(document).ready(function() {
    cards_noticias();
});

function format_date(data) {
  let date = new Date(data);
  let day = String(date.getDate()).padStart(2, '0');
  let month = String(date.getMonth() + 1).padStart(2, '0');
  let year = date.getFullYear();
  return `${day}/${month}/${year}`;
}

function cards_noticias() {
  $.ajax({
      type: "get",
      url: "https://api.rss2json.com/v1/api.json?rss_url=https://www.fda.gov/about-fda/contact-fda/stay-informed/rss-feeds/press-releases/rss.xml",
      dataType: "json",
      success: (res) => {
          let concat = '';  
          res.items.forEach(item => {
            concat += `

            <div class="col-md-5 mt-3" style="height: 230px;"> 
                <div class="card mb-4 shadow-sm d-flex flex-column h-100" style="height: 100%;"> 
                    <div class="card-body d-flex flex-column flex-grow-1" style="overflow: hidden;"> 
                        <h5 class="card-title">${item.title}</h5>
                        <p class="card-text text-muted">${format_date(item.pubDate)}</p>
                        <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${item.description}">
                            ${item.description.substring(0, 200)}
                        </p>
                        <div class="mt-auto"> <!-- Isso empurra o botão para o rodapé -->
                            <a href="${item.link}" class="btn btn-primary" target="_blank">Leia mais</a>
                        </div>
                    </div>
                </div>
            </div>

            `;});

          $('#div_card_noticias').html(concat);  
      },
      error: () => {
          $('#div_card_noticias').html('<p>Não foi possível carregar as notícias.</p>');  
      }
  });
}