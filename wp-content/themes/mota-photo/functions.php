<?php

function motaphoto_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
    wp_enqueue_script('mota-photo-script', get_stylesheet_directory_uri() . '/js/script.js');
    wp_enqueue_script('mota-photo-ajax', get_stylesheet_directory_uri() . '/js/api_ajax.js');
    wp_enqueue_script('jquery');

}
add_action('wp_enqueue_scripts', 'motaphoto_scripts');


function register_my_menu()
{
    register_nav_menu('main-menu', __('Menu principal', 'text-domain'));
    register_nav_menu('footer-menu', __('Menu footer', 'text-domain'));
}
add_action('after_setup_theme', 'register_my_menu');

remove_action('shutdown', 'wp_ob_end_flush_all', 1);
add_action('shutdown', function () {
    while (@ob_end_flush());
});


function get_thumbnail_ajax_handler() {
    $post_id = intval($_GET['post_id']);
    if ($post_id) {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
    wp_die();
}

add_action('wp_ajax_get_thumbnail', 'get_thumbnail_ajax_handler');
add_action('wp_ajax_nopriv_get_thumbnail', 'get_thumbnail_ajax_handler');



// Filtres
function motaphoto_filter()
{
    $categorie = $_POST['category'];
    $format = $_POST['format'];
    $orderDate = $_POST['order'];

    $args = array();

    //Tous les paramètres
    if (isset($categorie) && isset($format) && isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => $orderDate,
            'relation' => 'AND',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
            ),
        );
    }
    //Par catégorie
     
    if (isset($categorie) && !isset($format) && !isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                )
            ),

        );
    }
    //Par format
    if (!isset($categorie) && isset($format) && !isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
            ),
        );
    }
    //Par date
    if (!isset($categorie) && !isset($format) && isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => $orderDate,
        );
    }
    //Par catégorie et format
    if (isset($categorie) && isset($format) && !isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'relation' => 'AND',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
            ),
        );
    }
    //Par format et date
    if (!isset($categorie) && isset($format) && isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => $orderDate,
            'relation' => 'AND',
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
            ),
        );
    }
    //Par catégorie et date
    if (isset($categorie) && !isset($format) && isset($orderDate)) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => $orderDate,
            'relation' => 'AND',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
            ),
        );
    }


    $ajaxQuery =  new WP_Query($args);

    $result = '';

    if ($ajaxQuery->have_posts()) {
        while ($ajaxQuery->have_posts()) :
            $ajaxQuery->the_post();

            $result .= get_template_part('archive_photos');

        endwhile;
        wp_reset_postdata();
    } else {

        $result = '';
    }
    echo $result;
    exit;
}
add_action('wp_ajax_motaphoto_filter', 'motaphoto_filter');
add_action('wp_ajax_nopriv_motaphoto_filter', 'motaphoto_filter');

function motaphoto_filter_fact()
{
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
    );

    if (isset($_POST['category']) && $_POST['category'] != '0') {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['category'],
        );
    }

    if (isset($_POST['format']) && $_POST['format'] != '0') {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format'],
        );
    }

    if (isset($_POST['order']) && $_POST['order'] != '0') {
        $args['orderby'] = 'date';
        $args['order'] = $_POST['order'];
    }

    $ajaxQuery = new WP_Query($args);

    $result = '';

    if ($ajaxQuery->have_posts()) {
        while ($ajaxQuery->have_posts()) :
            $ajaxQuery->the_post();

            $result .= get_template_part('archive_photos');

        endwhile;
        wp_reset_postdata();
    }
    exit;
}

add_action('wp_ajax_motaphoto_filter_fact', 'motaphoto_filter_fact');
add_action('wp_ajax_nopriv_motaphoto_filter_fact', 'motaphoto_filter_fact');

// Ajouter affichage posts
function motaphoto_load_more()
{
    $page = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $categorie = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';

    // Vérifiez si la page est supérieure à 1
    if ($page > 1 || $page == 1) {
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'orderby' => 'date',
            'order' => $order,
            'paged' => $page,
        );

        // Ajouter des taxonomies à la requête si des valeurs sont définies
        if (!empty($categorie)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categorie,
            );
        }

        if (!empty($format)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format,
            );
        }

        $ajaxQuery = new WP_Query($args);

        $result = '';

        if ($ajaxQuery->have_posts()) {
            while ($ajaxQuery->have_posts()) :
                $ajaxQuery->the_post();

                $result .= get_template_part('archive_photos');

            endwhile;
            wp_reset_postdata();
        } else {
            $result = '';
        }
        echo $result;
    } else {
        // Retourner une sortie vide si la page est égale à 1
        echo '';
    }

    exit;
}
add_action('wp_ajax_motaphoto_load_more', 'motaphoto_load_more');
add_action('wp_ajax_nopriv_motaphoto_load_more', 'motaphoto_load_more');

function lightboxShow()
{
    $args = array(
        'post_type' => 'photo', //CPT Photo
        'posts_per_page' => -1, //-1 pour récupérer toutes les photos
    );
    
    $query = new WP_Query($args); //requette avec les arguments donnés précédemment
    
    // Vérifier si des articles ont été trouvés
    if ($query->have_posts()) {
        // Initialiser un tableau pour stocker les objets
        $photo_objects = array();
    
        while ($query->have_posts()) {//parcours de toutes les photos
            $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'categorie'); //récupération de la catégorie
            
            // Obtenir les données de la photo pour la lightbox
            $photo_data = array( //stockage des données dans un tableau
                'thumbnail' => get_the_post_thumbnail_url(),
                'reference' => get_post_meta(get_the_ID(), 'reference', true),
                'categorie' => $categories[0]->name,
            );
            $photo_objects[] = $photo_data; //stockage des tableaux de données dans le tableau principal
        }
       
       echo wp_send_json($photo_objects) ;
        // wp_reset_postdata();
    }
}

add_action('wp_ajax_lightboxShow', 'lightboxShow');
add_action('wp_ajax_nopriv_lightboxShow', 'lightboxShow');


// SLIDER PAGE SINGLE

