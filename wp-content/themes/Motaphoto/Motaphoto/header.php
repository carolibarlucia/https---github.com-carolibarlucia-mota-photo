<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Votre en-tête -->
    <header id="header">
        <div class="top-menu">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/Logo.png" class="logo" alt="logo" />
            <?php 
                wp_nav_menu(array(
                    'theme_location' => 'header',
                    'menu_id' => 'menu-header', // ID attribué au menu
                ));
            ?>
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/menubtn.png" alt="bouton d'ouverture du menu" id="menuBtn" class="mobile" />
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/Croix.png" alt="bouton de fermeture du menu" id="menuBtnFermeture" class="mobile inactive-mobile" />
        </div>
    </header>
        <!--Menu mobile-->
        <div class="menu-fullscreen inactive-mobile" id="megaMenu">
            <?php 
            wp_nav_menu(array(
                'theme_location' => 'header',
                'menu_id' => 'megaMenu', // ID attribué au menu mobile
            ));
            ?>
        </div>

