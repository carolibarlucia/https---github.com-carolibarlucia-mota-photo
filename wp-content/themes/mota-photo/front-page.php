<?php
get_header();
?>

<div class="hero">
    
    <h1>PHOTOGRAPHE EVENT</h1>
</div>

<?php get_template_part('templates/filtre'); ?>

<div class="cptcontent">
    
<?php
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => 12,
    'orderby' => 'date',
    'order' => 'DESC',
);
$loop = new WP_Query($args);

while ($loop->have_posts()) : $loop->the_post();
    get_template_part('archive_photos');
endwhile;
wp_reset_postdata();
?>
</div>

<button class="chargerPlus" id="load_more" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>

<?php get_template_part('templates/lightbox'); ?>



<?php
get_footer();
?>