jQuery(document).ready(function($) {
    console.log('Custom select2 script loaded'); // Debugging
    $('.select2').select2({
        dropdownParent: $('.menu-taxonomy'), // Spécifiez le parent
        dropdownAutoWidth: true, // Ajuste automatiquement la largeur du dropdown
        minimumResultsForSearch: Infinity // Désactive le champ de recherche
    });

    // Appliquer le style au survol
    $(document).on('mouseenter', '.select2-results__option', function() {
        $(this).css('background-color', 'red');
    }).on('mouseleave', '.select2-results__option', function() {
        $(this).css('background-color', '');
    });
});
