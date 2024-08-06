$(document).ready(function() {
    var feedUrl = 'https://g1.globo.com/rss/g1/saude.xml'; // Altere para o feed desejado
    
    $.ajax({
        url: feedUrl,
        type: 'GET',
        dataType: 'xml',
        success: function(data) {
            var $xml = $(data);
            var $items = $xml.find('item');
            var newsHtml = '';

            $items.each(function() {
                var $item = $(this);
                var title = $item.find('title').text();
                var link = $item.find('link').text();
                var description = $item.find('description').text();

                newsHtml += '<div class="noticia">';
                newsHtml += '<h2><a href="' + link + '" target="_blank">' + title + '</a></h2>';
                newsHtml += '<p>' + description + '</p>';
                newsHtml += '</div>';
            });

            $('#noticias').html(newsHtml);
        },
        error: function() {
            $('#noticias').html('<p>Não foi possível carregar as notícias.</p>');
        }
    });
});