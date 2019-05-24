<?php

namespace App\Features\PostTypes;

class ClientPostType
{
    public static $slug = 'client';
    public static function register()
    {
        add_theme_support('post-thumbnails');
        register_post_type(
            self::$slug,
            [
                'labels' => [
                    'name' => __('Clients'),
                    'singular_name' => __('Client'),
                    'add_new' => __('Ajouter'),
                    'add_new_item' => __('Ajouter un Client'),
                    'edit_item' => __('Modifier le Client'),
                    'new_item' => __('Nouveau Client'),
                    'view_item' => __('Voir le Client'),
                    'view_items' => __('Voir les Clients'),
                    'search_items' => __('Rechercher des Clients'),
                    'not_found' => __('Pas de Clients trouvées.'),
                    'not_found_in_trash' => ('Pas de Clients dans la corbeille.'),
                    'all_items' => __('Tous les Clients'),
                    'archives' => __('Clients archivées'),
                    'filter_items_list' => __('Filtre de Client'),
                    'items_list_navigation' => __('Navigation de Client'),
                    'items_list' => __('Liste Client'),
                    'item_published' => __('Client publiée.'),
                    'item_published_privately' => __('Client publiée en privé.'),
                    'item_reverted_to_draft' => __('Le Client est retournée au brouillon.'),
                    'item_scheduled' => __('Client planifiée.'),
                    'item_updated' => __('Client mise à jours.'),
                ],
                'public' => true,
                'has_archive' => true,
                'rewrite' => [
                    'slug' => 'client',
                ],
                'capabilities' => array(
                    'edit_post'          => 'edit_client',
                    'read_post'          => 'read_client',
                    'delete_post'        => 'delete_client',
                    'edit_posts'         => 'edit_clients',
                    'edit_others_posts'  => 'edit_others_clients',
                    'publish_posts'      => 'publish_clients',
                    'read_private_posts' => 'read_private_clients',
                    'create_posts'       => 'edit_clients',
                ),
                'taxonomies' => ['category'],
                'menu_icon' => 'dashicons-groups',

                'supports' =>  ['title', 'editor', 'thumbnail'],
            ]
        );
    }
}
