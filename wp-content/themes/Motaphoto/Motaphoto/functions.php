<?php

    //enqueue css
    function enqueue_my_theme_styles() {
        wp_enqueue_style('my-theme-style', get_stylesheet_uri());
    }

    add_action('wp_enqueue_scripts', 'enqueue_my_theme_styles');
    
    // mise en place des menus header et footers
    function register_my_menus() {
        register_nav_menus(
            array(
                'header' => __('Menu du header'),
                'footer' => __('Menu du footer')
            )
        );
    }
    add_action('after_setup_theme', 'register_my_menus');

    //enqueue script du menu
    function enqueue_menu_script() {
        wp_enqueue_script('menu-script', get_template_directory_uri() . '/js/menu.js', array('jquery'), '1.0', true);
    }
    add_action('wp_enqueue_scripts', 'enqueue_menu_script');


    //enqueu script de la modale de contact
    function enqueue_custom_script() {
        wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);

    }
    add_action('wp_enqueue_scripts', 'enqueue_custom_script');



//fonction d'image random pour le premier bloc de la home page
function obtenir_image_aleatoire_photo() {
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );
  
    $query = new WP_Query($args);
  
    if ($query->have_posts()) {
        $query->the_post();
        return get_the_post_thumbnail_url();
    }
  
    wp_reset_postdata();
    return false;
  }



//enqueue le fichier lightbox.js
function motaphoto_enqueue_lightbox() {
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_lightbox');


// Charger plus de photos sur la home avec ajax
function load_more_photos() {

    //superglobale post
    $page = $_POST['page'];

    //On récupère les valeurs des 3 filtres
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    $order = isset($_POST['order']) ? $_POST['order'] : 'DESC';

    //On vérifie si le contenu doit être filtré
    if($categorie == 'all' && $format == 'all'){
        //si on veut tout sans filtre
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'paged' => $page,
            'order' => $order,
        );
    }else if($categorie == 'all'){
        //si on veut seulement toutes les catégories, on filtre uniquement sur le format
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'paged' => $page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
            ),
            'order' => $order,
        );
    }else if($format== 'all'){
        //si on veut seulement tous les formats, on filtre uniquement sur les catégories
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'paged' => $page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
            ),
            'order' => $order,
        );
    }else{
        //sinon c'est que l'on filtre à la fois les formats et les catégories
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 12,
            'paged' => $page,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
                ),
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
            ),
            'order' => $order,
        );
    }

    $query = new WP_Query($args); //on envoie la requette avec les arguments

    if ($query->have_posts()) : //si la requette retourne des résultats
        while ($query->have_posts()) : $query->the_post();
            $urlrelated = get_the_permalink();
            echo '<div class="photos-container-image survol-photo">'; //on affiche les résultats dans la div
            echo("<a href='".$urlrelated."'>");
            echo get_the_post_thumbnail();
            echo '</a>';
            echo '</div>';
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Pas de photos trouvées<br/>'; //sinon message d'erreur
    endif;

    die();
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


// Enqueue le fichier filtre-script.js pour gérer la détection des changements de filtre sur la homepage
function enqueue_filtre_scripts_and_styles() {
    wp_enqueue_script('filtre-script', get_template_directory_uri() . '/js/filtre-script.js', array('jquery'), '', true);
    wp_localize_script('filtre-script', 'ajax_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_filtre_scripts_and_styles');
