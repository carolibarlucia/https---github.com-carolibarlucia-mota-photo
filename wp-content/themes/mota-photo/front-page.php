<?php
get_header();
?>

<div class="hero">
    <img src="<?php echo get_template_directory_uri() . '/images/nathalie-2.jpeg'; ?>">
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
<div class="buttonCenter">
<button class="chargerPlus" id="load_more" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
</div>
<?php
get_footer();
?>