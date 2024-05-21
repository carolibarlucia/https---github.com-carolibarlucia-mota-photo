<?php
// Récupérer l'ID de la publication personnalisée
$post_id = get_the_ID();

// Récupérer l'URL de l'image depuis un champ personnalisé
$image_url = get_post_meta($post_id, 'photo', true);

// Récupérer les termes de la taxonomie (catégories) associés à la publication personnalisée
$categories = get_the_terms($post_id, 'categorie');
$reference = get_field('reference', $post_id);

// Afficher les informations dans votre HTML
?>
<div id="lightboxes" class="lightboxHidden">
    <button class="lightbox__close"><img src="<?php echo get_template_directory_uri() . '/images/Vector.png'; ?>" /></button>

    <div>
        <button class="lightbox__prev"><img src="<?php echo get_template_directory_uri() . '/images/Line8.png'; ?>" /> Précédent</button>
        <button class="lightbox__next">Suivant <img src="<?php echo get_template_directory_uri() . '/images/Line7.png'; ?>" /></button>
        <div class="lightbox__container">
            <div id="photo">
                <img id="lightboximage" src="<?php echo esc_url($image_url); ?>" />
            </div>
            <div class="underlightbox">

                <div>

                    <?php echo get_post_meta($post_id, 'reference', true); ?>

                    <?php
                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            echo $category->name . ' ';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>