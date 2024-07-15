(function ($) {
  $(document).ready(function () {
    // ------------------------ Ajax gestion des filtres ------------------------------- //
    let page = 1;
    let btnLoadMore = $("#load_more");
    let apiUrl = btnLoadMore.attr("data-ajaxurl");
    let categorie = $("#categorie");
    let format = $("#format");
    let date = $("#date");
    let categorieValue = categorie.val();
    let formatValue = format.val();
    let orderValue = date.val();

    function processFilter() {
      page = 1; // Réinitialiser la pagination lorsque les filtres changent
      $.ajax({
        type: "POST",
        url: apiUrl,
        dataType: "html",
        data: {
          action: "motaphoto_filter_fact",
          paged: page,
          category: categorieValue,
          format: formatValue,
          order: orderValue,
        },
        success: function (resp) {
          if ($.trim(resp) !== "") {
            $(".cptcontent").html(resp);
          } else {
            // Aucun post trouvé, réinitialisez la pagination
            page = 1;
            $(".cptcontent").html('<p>Aucun résultat trouvé.</p>');
          }
        },
      });
    }

    // Charger le contenu initial
    processFilter();

    // Événements de changement de filtre
    categorie.change(function () {
      categorieValue = $(this).val();
      processFilter();
    });

    format.change(function () {
      formatValue = $(this).val();
      processFilter();
    });

    date.change(function () {
      orderValue = $(this).val();
      processFilter();
    });

    // Bouton "Charger plus"
    btnLoadMore.on("click", function (e) {
      e.preventDefault();
      page++;
      $.ajax({
        type: "POST",
        url: apiUrl,
        dataType: "html",
        data: {
          action: "motaphoto_load_more",
          paged: page,
          category: categorieValue,
          format: formatValue,
          order: orderValue,
        },
        success: function (resp) {
          if ($.trim(resp) !== "") {
            $(".cptcontent").append(resp);
          } else {
            page--;
            alert("Aucun autre post à charger.");
          }
        },
      });
    });
  });
})(jQuery);
