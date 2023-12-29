<?php

function motaphoto_scripts()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/theme.css', array(), filemtime(get_stylesheet_directory() . '/theme.css'));
    wp_enqueue_script('mota-photo-script', get_stylesheet_directory_uri() . '/script.js');
}
add_action('wp_enqueue_scripts', 'motaphoto_scripts');

function register_my_menu() {
    register_nav_menu( 'main-menu' , __( 'Menu principal', 'text-domain' ));
    register_nav_menu( 'footer-menu' , __( 'Menu footer', 'text-domain' ));
}
add_action( 'after_setup_theme', 'register_my_menu' );

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );
