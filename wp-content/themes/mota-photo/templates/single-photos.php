<!-- <?php
get_header();


if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php
                // Affiche le contenu de la publication
                the_content();

                // Affiche les images attachées à la publication
                $args = array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'numberposts' => -1,
                    'post_status' => null,
                    'post_parent' => $post->ID
                );

                $attachments = get_posts($args);

                if ($attachments) {
                    foreach ($attachments as $attachment) {
                        echo wp_get_attachment_image($attachment->ID, 'full');
                    }
                }
                ?>
            </div>
        </article>
        <?php
    endwhile;
endif;


get_footer();
?> -->