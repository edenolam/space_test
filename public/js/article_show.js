//  nous avons écrit un code JavaScript simple qui dit :
//  lorsque le lien "J'aime" est cliqué, basculez le style sur le cœur,
//  puis envoyez une requête POST à URL qui se trouve dans le href.
//  Ensuite, lorsque l'appel AJAX est terminé,
//  lisez le nouveau numéro de hearts la réponse JSON et mettez à jour la page.

$(document).ready(function () {
    $('.js-like-article').on('click', function (e) {
        e.preventDefault()
        let $link = $(e.currentTarget);
        $link.toggleClass('fa-heart-o').toggleClass('fa-heart')

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function (data) {
            $('.js-like-article-count').html(data.hearts)
        })
    })
});