(function ($) {
  $(document).ready(function () {
    // ------------------------ Ajax gestion des filtres ------------------------------- //
    let page = 1;
    let btnLoadMore = $("#load_more");
    let apiUrl = btnLoadMore.attr("data-ajaxurl");
    let categorie = $("#categorie");
    let format = $("#format");
    let date = $("#date");
    let categorieValue;
    let formatValue;
    let orderValue;
    processFilter();

    // const selectCategorie = document.querySelector(".categorie");
    $(categorie).change(function () {
      console.log($(this).val());
      categorieValue = $(this).val();
      processFilter();
    });

    $(format).change(function () {
      // console.log($(this).val());
      formatValue = $(this).val();
      processFilter();
    });

    $(date).change(function () {
      // console.log($(this).val());
      orderValue = $(this).val();
      processFilter();
    });

    function processFilter() {
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
            // Aucun post supplémentaire, réinitialisez la pagination
            page = 1;
          }
        },
      });
    }

    btnLoadMore.on("click", function (e) {
      page++;
      $.ajax({
        type: "POST",
        url: apiUrl,
        dataType: "html",
        data: {
          action: "motaphoto_load_more",
          paged: page,
        },
        success: function (resp) {
          if ($.trim(resp) !== "") {
            $(".cptcontent").append(resp);
          } else {
            page = 1;
          }
        },
      });
    });
  });
  // Ecoute evenement filtres
})(jQuery);
