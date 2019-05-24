<?php

namespace App\Features\PostTypes;

class FeaturePostType
{
    public static $slug = 'feature';
    public static function register()
    {
        add_theme_support('post-thumbnails');
        register_post_type(
            self::$slug,
            [
                'labels' => [
                    'name' => __('Features'),
                    'singular_name' => __('Feature'),
                    'add_new' => __('Ajouter'),
                    'add_new_item' => __('Ajouter un Feature'),
                    'edit_item' => __('Modifier le Feature'),
                    'new_item' => __('Nouveau Feature'),
                    'view_item' => __('Voir le Feature'),
                    'view_items' => __('Voir les Features'),
                    'search_items' => __('Rechercher des Features'),
                    'not_found' => __('Pas de Features trouvées.'),
                    'not_found_in_trash' => ('Pas de Features dans la corbeille.'),
                    'all_items' => __('Tous les Features'),
                    'archives' => __('Features archivées'),
                    'filter_items_list' => __('Filtre de Feature'),
                    'items_list_navigation' => __('Navigation de Feature'),
                    'items_list' => __('Liste Feature'),
                    'item_published' => __('Feature publiée.'),
                    'item_published_privately' => __('Feature publiée en privé.'),
                    'item_reverted_to_draft' => __('Le Feature est retournée au brouillon.'),
                    'item_scheduled' => __('Feature planifiée.'),
                    'item_updated' => __('Feature mise à jours.'),
                ],
                'public' => true,
                'has_archive' => true,
                'rewrite' => [
                    'slug' => 'feature',
                ],
                'capabilities' => array(
                    'edit_post'          => 'edit_feature',
                    'read_post'          => 'read_feature',
                    'delete_post'        => 'delete_feature',
                    'edit_posts'         => 'edit_features',
                    'edit_others_posts'  => 'edit_others_features',
                    'publish_posts'      => 'publish_features',
                    'read_private_posts' => 'read_private_features',
                    'create_posts'       => 'edit_features',
                ),
                'taxonomies' => ['category'],
                'menu_icon' => 'dashicons-hammer',

                'supports' =>  ['title', 'editor', 'thumbnail'],
            ]
        );
    }
}
