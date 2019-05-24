<?php

namespace App\Features\PostTypes;

class ServicePostType
{
    public static $slug = 'service';
    public static function register()
    {
        add_theme_support('post-thumbnails');
        register_post_type(
            self::$slug,
            [
                'labels' => [
                    'name' => __('Services'),
                    'singular_name' => __('Service'),
                    'add_new' => __('Ajouter'),
                    'add_new_item' => __('Ajouter un service'),
                    'edit_item' => __('Modifier le service'),
                    'new_item' => __('Nouveau service'),
                    'view_item' => __('Voir le service'),
                    'view_items' => __('Voir les services'),
                    'search_items' => __('Rechercher des services'),
                    'not_found' => __('Pas de services trouvées.'),
                    'not_found_in_trash' => ('Pas de services dans la corbeille.'),
                    'all_items' => __('Tous les services'),
                    'archives' => __('Services archivées'),
                    'filter_items_list' => __('Filtre de service'),
                    'items_list_navigation' => __('Navigation de service'),
                    'items_list' => __('Liste service'),
                    'item_published' => __('Service publiée.'),
                    'item_published_privately' => __('Service publiée en privé.'),
                    'item_reverted_to_draft' => __('Le service est retournée au brouillon.'),
                    'item_scheduled' => __('Service planifiée.'),
                    'item_updated' => __('Service mise à jours.'),
                ],
                'public' => true,
                'has_archive' => true,
                'rewrite' => [
                    'slug' => 'service',
                ],
                'capabilities' => array(
                    'edit_post'          => 'edit_service',
                    'read_post'          => 'read_service',
                    'delete_post'        => 'delete_service',
                    'edit_posts'         => 'edit_services',
                    'edit_others_posts'  => 'edit_others_services',
                    'publish_posts'      => 'publish_services',
                    'read_private_posts' => 'read_private_services',
                    'create_posts'       => 'edit_services',
                ),
                // as pointed out by iEmanuele, adding map_meta_cap will map the meta correctly 

                'taxonomies' => ['category'],
                'menu_icon' => 'dashicons-book',

                'supports' =>  ['title', 'editor', 'thumbnail'],
            ]
        );
    }
}
