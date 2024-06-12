<?php
// Récupérer l'ID de la publication personnalisée
$post_id = get_the_ID();
$post = get_post($post_id);
$categories = get_the_terms($post, 'categorie');


// Récupérer l'URL de l'image depuis un champ personnalisé
$image_url = get_post_meta($post_id, 'photo', true);

// Récupérer les termes de la taxonomie (catégories) associés à la publication personnalisée

$reference = get_field('reference', $post_id);

// Afficher les informations dans votre HTML
?>
<section class="main-container">
    <div id="lightboxes" class="lightboxHidden">
        <button class="lightbox__close"><img src="<?php echo get_template_directory_uri() . '/images/Vector.png'; ?>" /></button>
        <div class="main-container">
            <button class="lightbox__prev"><img src="<?php echo get_template_directory_uri() . '/images/Line8.png'; ?>" /> Précédent</button>
            <button class="lightbox__next">Suivant <img src="<?php echo get_template_directory_uri() . '/images/Line7.png'; ?>" /></button>
            <div id="photo" class="lightbox__container">

                <img id="lightboximage" src="<?php echo esc_url($image_url); ?>" />
            </div>
            <div class="underlightbox">
                <div id="reference"></div>
                <p> </p>
                <div id="category"></div>
            </div>
        </div>
    </div>
</section>