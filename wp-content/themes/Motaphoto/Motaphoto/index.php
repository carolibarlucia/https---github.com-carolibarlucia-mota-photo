<?php get_header(); ?>
<?php $image_aleatoire_photo = obtenir_image_aleatoire_photo(); ?>

<div class="banniere-img">
    <img id="banniere-img" src="<?php echo $image_aleatoire_photo ?>" alt="Photo bannière">
    <h1 class="banniere-txt">PHOTOGRAPHIE EVENT</h1>
</div>
            
<!-- Sélecteurs de filtres -->
<div class="filters-box">
    <div class="filters-left">
        
        <!-- Filtre catégorie -->
        <select id="categorie-select" class="home-filter">
            <option value="all">Catégories</option>
            <?php
                // Récupérer tous les termes de la taxonomie catégorie
                $terms = get_terms(array(
                    'taxonomy' => 'categorie',
                    'hide_empty' => false,
                ));
                // Vérifier s'il y a des termes
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                }
            ?>
        </select>

        <!-- Filtre format -->
        <select id="format-select" class="home-filter">
            <option value="all">Formats</option>
            <?php
                // Récupérer tous les termes de la taxonomie format
                $terms = get_terms(array(
                    'taxonomy' => 'format',
                    'hide_empty' => false,
                ));
                // Vérifier s'il y a des termes
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
                    }
                }
            ?>
        </select>
    </div>

    <!-- Filtre tri par date -->
    <select id="order-select" class="home-filter">
        <option value="ASC">Trier par</option>
        <option value="ASC">Date - Ordre croissant</option>
        <option value="DESC">Date - Ordre décroissant</option>
    </select>
</div>

<!-- Liste des images -->
<div id="photos-container">
    <?php

    //création des arguments pour la requette
    $args = array(
        'post_type' => 'photo', //post type photo
        'posts_per_page' => 12, //12 photos par défaut
        'paged' => 1, //par défaut on charge la page 1
        'order' => 'ASC', //par défaut on charge les dates croissantes
    );

    $query = new WP_Query($args); //envoi de la requette avec nos arguments

    if ($query->have_posts()) : //si la requette retourne des photos
        while ($query->have_posts()) : $query->the_post(); //tant qu'on a des photos, on les affiche une par une
            $urlrelated = get_the_permalink(); //on récupère l'url de la photo
            echo '<div class="photos-container-image survol-photo">';
            echo("<a href='".$urlrelated."'>"); //on créer un lien vers le template photo
            echo get_the_post_thumbnail(); //on affiche la thumbnail de la photo
            echo '</a></div>';
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Pas de photos trouvées<br/>'; //si on ne trouve pas de photos, message d'erreur
    endif;
    ?>
</div>

<!-- Bouton "Charger plus" -->
<div class="load-more-photos-box">
    <button id="load-more-photos">Charger plus</button>
</div>


<?php get_footer(); ?>
