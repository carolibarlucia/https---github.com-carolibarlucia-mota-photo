<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MotaPhoto</title>
    <?php wp_head(); ?>
</head>

<body>

    <header>
        <img class="logo" src="<?php echo get_template_directory_uri() . './images/Logo.png'; ?>">
        <nav class="header-" role="navigation" aria-label="<?php _e('Menu principal', 'text-domain'); ?>">
            <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
                // 'container' => false,
                // 'walker' => new A11y_Walker_Nav_Menu()
            ]);

            get_template_part('contact');
            ?>
        </nav>

    </header>