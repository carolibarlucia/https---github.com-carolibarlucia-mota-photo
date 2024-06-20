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

get_header();
?>

<section class="main-container">
    <?php
    $post_id = get_the_ID();
    $post = get_post($post_id);
    $title = get_the_title($post_id);
    $taxonomies = get_taxonomies('', 'names');
    $terms = wp_get_post_terms($post->ID, $taxonomies);
    ?>

    <div class="single-photo">
        <div class="row">
            <div class="column">
                <h2><?php echo esc_html($title); ?></h2>
                <div class="row2">
                    <p>référence : </p>
                    <p id="referenceid"><?php echo esc_html(get_post_meta($post_id, 'reference', true)); ?></p>
                </div>
                <div class="row2">
                    <p>catégorie : </p>
                    <p><?php echo esc_html(get_the_terms($post, 'categorie')[0]->name ?? ''); ?></p>
                </div>
                <div class="row2">
                    <p>format : </p>
                    <p><?php echo esc_html(get_the_terms($post_id, 'format')[0]->name ?? ''); ?></p>
                </div>
                <div class="row2">
                    <p>type : </p>
                    <p><?php echo esc_html(get_post_meta($post_id, 'type', true)); ?></p>
                </div>
                <div class="row2">
                    <p>année : </p>
                    <p><?php echo esc_html(get_post_meta($post_id, 'annee', true)); ?></p>
                </div>
            </div>
            <div>
                <?php echo get_the_post_thumbnail($post_id, 'large'); ?>
            </div>
        </div>
        <div class="row3">
            <div class="row4">
                <p>Cette photo vous intéresse</p>
                <p id="btn-contact" class="btn1 btn-text idcontact2">Contact</p>
            </div>
            <div class="row4">
                <div></div>
                <div class="column2">
                    <div id="current-thumbnail-container">
                        <?php
                        $prev_custom_post = get_previous_post();
                        $next_custom_post = get_next_post();
                        $next_post_thumbnail = get_the_post_thumbnail($next_custom_post, 'thumbnail', ['id' => 'current-thumbnail']);
                        echo $next_post_thumbnail;

                        ?>
                    </div>
                    <!-- carrousel -->
                    <div class="arrow">

                        <?php

                        if ($prev_custom_post) {
                            $prev_custom_post_link = get_permalink($prev_custom_post);
                            echo '<a href="' . esc_url($prev_custom_post_link) . '"><img src="' . get_template_directory_uri() . '/images/Line2.png" alt="voir la photo précédente" class="arrow-left"/></a>';
                        }

                        if ($next_custom_post) {
                            $next_custom_post_link = get_permalink($next_custom_post);
                            echo '<a href="' . esc_url($next_custom_post_link) . '"><img src="' . get_template_directory_uri() . '/images/Line1.png" alt="voir la photo suivante" class="arrow-right"/></a>';
                        }
                        ?>

                    </div>
                </div>


            </div>
        </div>
        <div>
            <p class="upper">Vous aimerez aussi</p>
            <div class="row3 image-categorie">
                <?php
                $terms = get_the_terms($post, 'categorie')[0] ?? null;

                if ($terms) {
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 2,
                        'orderby'        => 'rand',
                        'post__not_in' => [$post_id],
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',
                                'field'    => 'slug',
                                'terms'    => $terms->slug,
                            ),
                        ),
                    );

                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) : $loop->the_post();
                            get_template_part('archive_photos');
                        endwhile;
                    } else {
                        echo '<p>Aucune photo trouvée pour cette catégorie.</p>';
                    }

                    wp_reset_postdata();
                } else {
                    echo '<p>Ce post n\'a pas de catégorie associée.</p>';
                }
                ?>
            </div>
        </div>
        <div class="btn-ttes-photos btn1">
            <a class="btn-text" href="<?php echo esc_url(get_home_url()); ?>">
                Toutes les photos
            </a>
        </div>
    </div>
</section>

<?php
get_footer();
?>