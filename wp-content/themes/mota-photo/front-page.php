<?php
get_header();
?>

<div class="hero">

    <h1>PHOTOGRAPHE EVENT</h1>
</div>

<?php get_template_part('templates/filtre'); ?>

<div class="cptcontent">

    <?php
    $categories = get_terms(array(
        'taxonomy' => 'categorie',
        'hide_empty' => false,
    ));

    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $term) {
            $cats[] = $term->slug;
        }
    }
    // print_r($cats[0]);
    // $args = array(
    //     'post_type' => 'photos',
    //     'posts_per_page' => 12,
    //     'orderby' => 'date',
    //     'order' => 'DESC',
       
    // );
    // $loop = new WP_Query($args);

    // if ($loop->have_posts()) {
    //     while ($loop->have_posts()) : $loop->the_post();
    //         get_template_part('archive_photos');
    //     endwhile;
    //     wp_reset_postdata();
    // } else {
    //     // Affiche un message si aucun post n'est trouvé
    //     echo '<p>Aucune photo trouvée pour cette catégorie.</p>';
    // }

    ?>
</div>

<button class="chargerPlus" id="load_more" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>

<?php
get_footer();
?>