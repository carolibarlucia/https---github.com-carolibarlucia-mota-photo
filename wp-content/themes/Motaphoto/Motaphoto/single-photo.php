<?php
    get_header();
?>

<div class="placement-fiche">
    <div class="fiche-photo">
        <div class="photo_img_mobile inactive active-mobile">
            <?php
            // Récupérer le thumbnail (image miniature) lié au custom post type
            $thumbnail = get_the_post_thumbnail($post_photos, 'large'); // Remplacez 'thumbnail_size' par la taille d'image que vous souhaitez utiliser
            echo $thumbnail;
            ?>
        </div>
        <div class="photo-informations">
            <h1>
                <?php
                // Récupérer l'ID du custom post type en cours
                $post_id = get_the_ID();
                // Récupérer le titre du custom post type
                $title = get_the_title($post_id);
                echo $title;
                ?>
            </h1>


            <p>référence : 
                <?php
                // Récupérer la valeur du custom field "reference"
                $ma_reference = get_post_meta($post_id, 'reference', true);
                // Vérifier si la référence existe
                if ($ma_reference) {
                    // Afficher la référence
                    echo $ma_reference;
                } else {
                    // Afficher un message si la référence n'est pas définie
                    echo 'Aucune référence définie pour cet article.';
                }
                ?>
            </p>


            <p>catégorie : 
                <?php
                // Récupérer les termes de la taxonomie "categorie" associés à ce post
                $terms = get_the_terms($post_id, 'categorie');
                if ($terms && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $cat = $term->name;
                        echo $cat;
                    }
                } else {
                    echo 'Aucune référence définie pour cet article.';
                }
                ?>
            </p>


            <p>format : 
                <?php
                // Récupérer les termes de la taxonomie "format" associés à ce post
                $terms = get_the_terms($post_id, 'format');
                // Vérifier si des termes existent
                if ($terms && !is_wp_error($terms)) {
                    // Boucler à travers les termes
                    foreach ($terms as $term) {
                        // Afficher la référence
                        echo $term->name;
                    }
                } else {
                    // Afficher un message si aucun terme n'est trouvé
                    echo 'Aucune référence définie pour cet article.';
                }
                ?>
            </p>

            <p>type :
                <?php
                // Récupérer la valeur du custom field "type"
                $mon_type = get_post_meta($post_id, 'type', true);
                if ($mon_type) {
                    echo $mon_type;
                } else {
                    echo 'Aucune référence définie pour cet article.';
                }
                ?>
            </p>


            <p>date :
                <?php
                // Récupérer la date du custom post type
                $date = get_the_date('Y', $post_id);
                echo $date;
                ?>
            </p>

        </div>


        <div class="photo_img inactive-mobile" id="photo-lightbox">
            <?php
            // thumbnail du cpt
            $thumbnail = get_the_post_thumbnail($post_photos, 'large'); 
            echo $thumbnail;
            ?>
        </div>
    </div>
</div>

<div class="zone-contact-et-miniature">
    <div class="zone-contact">
        <div class="zone-contact-position-texte">
            <p>Cette photo vous intéresse ?</p>
        </div>
        <div class="bouton-contact">
            <a onClick="passerRef('<?php echo $ma_reference; ?>')">Contact</a>
        </div>
    </div>
    <div class="zone-miniature">
        <div>
            <?php 
                // Récupérer la miniature du post précédent
                $prev_custom_post = get_previous_post($postID);
                $next_custom_post = get_next_post($postID);
                $next_post_thumbnail = get_the_post_thumbnail($next_custom_post, 'thumbnail');

                // Afficher la miniature
                echo $next_post_thumbnail;
            ?>
            <div class="photo-arrows">
                <p class="get_id"><?php $postID = the_ID(); ?></p>
                <?php

                    if ($prev_custom_post) {
                        $prev_custom_post_link = get_permalink($prev_custom_post);
                        echo '<a href="' . esc_url($prev_custom_post_link) . '"><img src="'. get_template_directory_uri() . '/assets/images/arrow-left.png" alt="voir la photo précédente" class="arrow-left"/></a>';
                    }

                    if ($next_custom_post) {
                        $next_custom_post_link = get_permalink($next_custom_post);
                        echo '<a href="' . esc_url($next_custom_post_link) . '"><img src="'. get_template_directory_uri() . '/assets/images/arrow-right.png" alt="voir la photo suivante" class="arrow-right"/></a>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="presentation-autres-photos">
    <div class="presentation-texte">
        <p>VOUS AIMEREZ AUSSI</p>
    </div>
    <div class="presentation-images">
        <?php 
                        $args = array(
                          'post_type' => 'photo', // Le type de publication personnalisé
                          'posts_per_page' => 2, // Récupère tous les articles de cette taxonomie
                          'tax_query' => array(
                              array(
                                  'taxonomy' => 'categorie', // récupérer les catégories
                                  'field' => 'slug', 
                                  'terms' => $cat, // on veut des images qui ont la même catégorie que notre image en cours
                              ),
                          ),
                      );
                      
                      $query = new WP_Query($args);
                      
                      if ($query->have_posts()) {
                          while ($query->have_posts()) {
                            $query->the_post();
                            $urlrelated = get_the_permalink();
                            echo("<a href='".$urlrelated."' class='presentation-images-gauche'><div >");
                              $query->the_post_thumbnail();
                              the_post_thumbnail(); 
                              // Le contenu de chaque article ici.
                            echo("</div></a>");
                          }
                          wp_reset_postdata(); // Réinitialise la requête WP_Query.
                      }
        ?>
    </div>
    <div class="presentation-bouton">
        <a href="/MotaPhoto/"><input class="bouton" type="button" value="Toutes les photos"></a>
    </div>
</div>

<?php
    get_footer();
?>