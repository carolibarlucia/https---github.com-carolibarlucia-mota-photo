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

    ?>
</div>

<button class="chargerPlus" id="load_more" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>

<?php
get_footer();
?>