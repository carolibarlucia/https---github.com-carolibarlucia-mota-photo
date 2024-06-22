<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MotaPhoto</title>
    <?php wp_head(); ?>
</head>

<body class="main-container">

    <header>
        <div class="haut">
        <img class="logo" src="<?php echo get_template_directory_uri() . './images/Logo.png'; ?>">
        <img src="<?php echo get_template_directory_uri() . './images/State=Open.png'; ?>" class="cross" id="cross" />
        <img src="<?php echo get_template_directory_uri() . './images/Menu.png'; ?>" class="burger" id="burger" />
        </div>
        <nav id="header-"  class="header-" role="navigation" aria-label="<?php _e('Menu principal', 'text-domain'); ?>">
        
            <?php
            wp_nav_menu([
                'theme_location' => 'main-menu',
            ]);

            get_template_part('/templates/contact');
            ?>
        </nav>

    </header>