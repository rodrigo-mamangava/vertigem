<?php

/**
 *  Plugin Name: Custom Post Type para o tema Vertigem
 *  Description: Adição de custom post do tipo: Colunas, Artigos e Equipe
 *  Version: 1.0
 *  Author: Mamangava
 *  Author URI: http://mamangava.com
 * 	Author Email: rodrigo@mamangava.com
 *  Licence: GPL2
 */
///////////CUSTON POSTS
function mmgv_PostsSet() {

    //coluna-config

    $labels = array(
        'name' => 'Colunas',
        'singular_name' => 'Coluna',
        'menu_name' => 'Colunas',
        'name_admin_bar' => 'Colunas',
        'add_new' => 'Adicionar nova',
        'add_new_item' => 'Adicionar nova',
        'new_item' => 'Nova',
        'edit_item' => 'Editar',
        'view_item' => 'Ver ',
        'all_items' => 'Todas ',
        'search_items' => 'Buscar coluna',
        'parent_item_colon' => ' Colunas relacionadas:',
        'not_found' => 'Nenhuma coluna encontrada.',
        'not_found_in_trash' => 'Nenhuma coluna na lixeira.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-forms',
        'query_var' => true,
        'rewrite' => array('slug' => 'coluna'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
        'taxonomies' => array('category')
    );

    register_post_type('coluna', $args);

    //coluna-config - END
    //coluna

    $labels = array(
        'name' => 'Artigos das Colunas',
        'singular_name' => 'Artigo',
        'menu_name' => 'Artigos',
        'name_admin_bar' => 'Artigos',
        'add_new' => 'Adicionar novo',
        'add_new_item' => 'Adicionar novo',
        'new_item' => 'Novo',
        'edit_item' => 'Editar',
        'view_item' => 'Ver ',
        'all_items' => 'Todos ',
        'search_items' => 'Buscar artigo',
        'parent_item_colon' => ' Artigos relacionadas:',
        'not_found' => 'Nenhum artigo encontrada.',
        'not_found_in_trash' => 'Nenhum artigo na lixeira.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-format-quote',
        'query_var' => true,
        'rewrite' => array('slug' => 'artigo'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
        'taxonomies' => array('category')
    );

    register_post_type('artigo', $args);

    //coluna - END
    //
    //equipe

    $labels = array(
        'name' => 'Equipe',
        'singular_name' => 'Equipe',
        'menu_name' => 'Equipe',
        'name_admin_bar' => 'Equipe',
        'add_new' => 'Adicionar novo',
        'add_new_item' => 'Adicionar novo',
        'new_item' => 'Novo',
        'edit_item' => 'Editar',
        'view_item' => 'Ver ',
        'all_items' => 'Todos ',
        'search_items' => 'Buscar',
        'parent_item_colon' => ' Relacionadas:',
        'not_found' => 'Nenhum encontrada.',
        'not_found_in_trash' => 'Nenhum lixeira.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-id',
        'query_var' => true,
        'rewrite' => array('slug' => 'equipe'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => true,
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes'),
        'taxonomies' => array('category')
    );

    register_post_type('equipe', $args);

    //equipe - END
}

add_action('init', 'mmgv_PostsSet');

function my_rewrite_flush_02() {
    mmgv_PostsSet();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'my_rewrite_flush_02');

///////////CUSTON POSTS - END


/* Taxonomia */

function myCustonTaxonomies() {

    // Tipos de publicaocao
    $labels = array(
        'name' => 'Nome da coluna',
        'singular_name' => 'Nome da coluna',
        'search_items' => 'Buscar por',
        'all_items' => 'Todas',
        'parent_item' => 'Parent',
        'parent_item_colon' => 'Parent:',
        'edit_item' => 'Editar ',
        'update_item' => 'Atualizar',
        'add_new_item' => 'Adicionar nova',
        'new_item_name' => 'Novo ',
        'menu_name' => 'Nome da coluna',
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'nome-coluna'),
    );

    register_taxonomy('nome-coluna', array('artigo'), $args);
}

add_action('init', 'myCustonTaxonomies');



