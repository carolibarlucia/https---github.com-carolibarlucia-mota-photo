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

require_once("../../../wp-load.php");

get_header();
?>


<?php
// Récupérer l'ID passé depuis l'URL
$post_id = isset($_GET['id']) ? $_GET['id'] : '';
$post = get_post($post_id);


// Vérifier si l'ID est défini et s'il correspond à un post existant
if ($post_id && get_post_status($post_id)) {
    // Récupérer le titre du custom post type
    $title = get_the_title($post_id);
    $taxonomies = get_taxonomies('', 'names');
    $image_url = get_post_meta($post_id, 'photo', true);
    $categories = get_the_terms($post_id, 'categorie');
    $formats = get_the_terms($post_id, 'format');
    $lieu = get_the_terms($post_id, 'lieu');

    $terms = wp_get_post_terms($post->ID, $taxonomies);

    var_dump(get_the_terms($post, 'categorie'));
    // Ajoutez ceci pour vérifier les termes de catégorie
var_dump($categories);

// Ajoutez ceci pour vérifier les termes de format
var_dump($formats);
?>

    <div class="single-photo">
        <div class="row">
            <div class="column">
                <h2><?php echo $title; ?></h2>
                <div class="row2">
                <p>lieu : <?php echo $lieu; ?></p>
                    
                    <p>référence : </p>
                    <p><?php echo get_post_meta($post_id, 'reference', true); ?></p>
                </div>
                <div class="row2">
                    <p>catégorie : </p>
                    <p>
                        <?php
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                echo $category->name . ', ';
                            }
                        } else {
                            echo 'Aucune catégorie';
                        }
                        ?>
                        </p>
                </div>
                <div class="row2">
                    <p>format : </p>
                    <p>
                    <?php 
                            if (!empty($formats)) {
                                foreach ($formats as $format) {
                                    echo $format->name . ', ';
                                }
                            } else {
                                echo 'Aucun format';
                            }
                        ?>
                        </p>
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
                <img src="<?php echo esc_url($image_url); ?>" class="single-photo-image">
            </div>
        </div>
        <div class="row3">
            <div class="row4">
                <p>
                    Cette photo vous intéresse
                </p>
                <div id="btn-contact" class="btn1 btn-text idcontact">
                    Contact
                </div>
            </div>
            <div class="row4">
                <div> </div>
                <div class="column2">
                    <img src="./images/nathalie-15.jpeg" class="thumb">
                    <!-- carousel -->
                    <div class="row4">
                        <img src="<?php echo get_template_directory_uri() . 'images/Line4.png'; ?>">
                        <img src="/images/Line5.png">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p class="upper">
                Vous aimerez aussi
            </p>
            <div class="row3">
                <div>
                    <img src="./images/nathalie-5.jpeg">
                </div>
                <div>
                    <img src="./images/nathalie-4.jpeg">
                </div>
            </div>
        </div>
        <div class="btn-ttes-photos  btn1">
            <a class="btn-text" href="<?php echo get_home_url(); ?>">
                Toutes les photos
            </a>
        </div>
    </div>
<?php
} else {
    // Si aucun ID valide n'est passé, afficher un message d'erreur ou une redirection par exemple
    echo 'Aucun élément trouvé.';
}
?>

<?php get_template_part('templates/lightbox'); ?>

<?php
get_footer();
?>