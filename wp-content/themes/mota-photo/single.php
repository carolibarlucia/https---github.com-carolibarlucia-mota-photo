<?php

/**
 * Template part for displaying page content in single_photo.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage mota-photo
 * @since Mota Photo 1.0
 */

// require_once("../../../wp-load.php");

get_header();
?>

<section class="main-container">
    <?php
    // Récupérer l'ID passé depuis l'URL
    $post_id = get_the_ID();
    $post = get_post($post_id);
    // echo get_the_ID();


    // Vérifier si l'ID est défini et s'il correspond à un post existant

    // Récupérer le titre du custom post type
    $title = get_the_title($post_id);
    $taxonomies = get_taxonomies('', 'names');

    $terms = wp_get_post_terms($post->ID, $taxonomies);

    // var_dump(get_the_terms($post, 'categorie'));
    ?>

    <div class="single-photo">
        <div class="row">
            <div class="column">
                <h2><?php echo $title; ?></h2>
                <div class="row2">
                    <p>référence : </p>
                    <p><?php echo get_post_meta($post_id, 'reference', true); ?></p>
                </div>
                <div class="row2">
                    <p>catégorie : </p>
                    <p><?php echo get_the_terms($post, 'categorie')[0]->name; ?></p>
                </div>
                <div class="row2">
                    <p>format : </p>
                    <p><?php echo get_the_terms($post_id, 'format')[0]->name; ?></p>
                </div>
                <div class="row2">
                    <p>type : </p>
                    <p><?php echo get_post_meta($post_id, 'type', true); ?></p>
                </div>
                <div class="row2">
                    <p>année : </p>
                    <p><?php echo get_post_meta($post_id, 'annee', true); ?></p>
                </div>
            </div>
            <div>
                <?php echo get_the_post_thumbnail($post_id, 'large'); ?>
            </div>
        </div>
        <div class="row3">
            <div class="row4">
                <p>
                    Cette photo vous intéresse
                </p>
                <p id="btn-contact" class="btn1 btn-text idcontact">
                    Contact
                </p>

            </div>
            <div class="row4">
                <div> </div>
                <div class="column2">
                    <?php
                    $prev_custom_post = get_previous_post($post_id);
                    $next_custom_post = get_next_post($post_id);
                    $next_post_thumbnail = get_the_post_thumbnail($next_custom_post, 'thumbnail');
                    // echo get_the_post_thumbnail($post_id, 'thumbnail');

                    echo $next_post_thumbnail; ?>
                    <!-- carousel -->
                    <div class="arrow">


                        <img id="single_prev" src="<?php echo get_template_directory_uri() . '/images/Line2.png'; ?>">
                        <img id="single_next" src="<?php echo get_template_directory_uri() . '/images/Line1.png'; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p class="upper">
                Vous aimerez aussi
            </p>
            <div class="row3 image-categorie">
                <?php
                // Obtenez les termes de la taxonomie 'catégorie' pour le post actuel
                $terms = get_the_terms($post, 'categorie')[0];

                if ($terms) {
                    // Récupère le premier terme (ou ajustez selon vos besoins)


                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 2,
                        'orderby'        => 'rand',
                        'post__not_in' => [$post_id],
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',  // Nom de la taxonomie
                                'field'    => 'slug',
                                'terms'    => $terms->slug,  // Slug du terme actuel

                            ),
                        ),
                    );

                    // Affiche les arguments de la requête pour déboguer


                    $loop = new WP_Query($args);

                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) : $loop->the_post();
                            get_template_part('archive_photos');
                        endwhile;
                    } else {
                        // Affiche un message si aucun post n'est trouvé
                        echo '<p>Aucune photo trouvée pour cette catégorie.</p>';
                    }

                    wp_reset_postdata();
                } else {
                    // Affiche un message si le post n'a pas de termes dans la taxonomie 'catégorie'
                    echo '<p>Ce post n\'a pas de catégorie associée.</p>';
                }
                ?>



            </div>

        </div>
        <div class="btn-ttes-photos  btn1">
            <a class="btn-text" href="<?php echo get_home_url(); ?>">
                Toutes les photos
            </a>
        </div>
    </div>
    <?php

    ?>
</section>
<?php
get_footer();
?>