<?php

namespace App\Features\PostTypes;

class TeamPostType
{
    public static $slug = 'team';
    public static function register()
    {
        add_theme_support('post-thumbnails');
        register_post_type(
            self::$slug,
            [
                'labels' => [
                    'name' => __('Teams'),
                    'singular_name' => __('Team'),
                    'add_new' => __('Ajouter'),
                    'add_new_item' => __('Ajouter un Team'),
                    'edit_item' => __('Modifier le Team'),
                    'new_item' => __('Nouveau Team'),
                    'view_item' => __('Voir le Team'),
                    'view_items' => __('Voir les Teams'),
                    'search_items' => __('Rechercher des Teams'),
                    'not_found' => __('Pas de Teams trouvées.'),
                    'not_found_in_trash' => ('Pas de Teams dans la corbeille.'),
                    'all_items' => __('Tous les Teams'),
                    'archives' => __('Teams archivées'),
                    'filter_items_list' => __('Filtre de Team'),
                    'items_list_navigation' => __('Navigation de Team'),
                    'items_list' => __('Liste Team'),
                    'item_published' => __('Team publiée.'),
                    'item_published_privately' => __('Team publiée en privé.'),
                    'item_reverted_to_draft' => __('Le Team est retournée au brouillon.'),
                    'item_scheduled' => __('Team planifiée.'),
                    'item_updated' => __('Team mise à jours.'),
                ],
                'public' => true,
                'has_archive' => true,
                'rewrite' => [
                    'slug' => 'team',
                ],
                'capabilities' => array(
                    'edit_post'          => 'edit_team',
                    'read_post'          => 'read_team',
                    'delete_post'        => 'delete_team',
                    'edit_posts'         => 'edit_teams',
                    'edit_others_posts'  => 'edit_others_teams',
                    'publish_posts'      => 'publish_teams',
                    'read_private_posts' => 'read_private_teams',
                    'create_posts'       => 'edit_teams',
                ),
                'taxonomies' => ['category'],
                'menu_icon' => 'dashicons-networking',

                'supports' =>  ['title', 'editor', 'thumbnail'],
            ]
        );
    }
}
