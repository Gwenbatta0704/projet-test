<?php
//Charger les fichiers nécessaire
require_once(__DIR__ . './Menus/PrimaryMenuWalker.php'); // __DIR__ constance magique représente une constante qui dit ou l'on est
//Désactiver l'éditeur Gutenberg de Wordpress
add_filter('use_block_editor_for_post', '__return_false');
//Activer les images sur les articles
add_theme_support('post-thumbnails');
//Enregistrer un seul custom post-type pour nos voyages
register_post_type('trip',[
    'label'=>'Voyages',
    'description'=>'Tout les articles qui décrivent les voyages',
    'menu_position'=>5,
    'menu_icon'=>'dashicons-airplane',
    'public' =>true,
    'labels'=>[
        'name'=>'Voyages',
        'singular_name'=>'Voyage',
    ],
    'supports' => [
        'title',
        'editor',
        'thumbnail',
    ],
    'rewrite' => [
        'slug' => 'voyages',
    ],
]);
// Récupérer les trips via une requête Wordpress

function dw_get_trips($count = 20){
    //1. on instancie l'objet WP_Query
    $trips = new WP_Query([
        //arguments
        'post_type' => 'trip',
        'orderby' =>'date',
        'order'=>'DESC',
        'posts_per_page' => $count,
    ]);
    //2. on retourne l'objet WP_Query
    return $trips;
}

//enregistrer les zones de menu

register_nav_menu('primary','Navigation principale (haut de page)');
register_nav_menu('footer','Navigation de pied de page (bas de page)');
