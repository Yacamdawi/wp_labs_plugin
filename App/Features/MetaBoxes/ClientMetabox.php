<?php
namespace App\Features\MetaBoxes;
use App\Features\PostTypes\ClientPostType;

class ClientMetabox
{
  public static $slug = 'client_metabox';
  /**
   * Ajout d'une méta box au type de contenu qui sont passer dans le tableau $screens
   * https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
   *
   * @return void
   */
  public static function add_meta_box()
  {
    $screen = [ClientPostType::$slug];
      add_meta_box(
        self::$slug,           // Unique ID
        __("Description du client"),  // Box title
        [self::class, 'render'],  // Content callback, must be of type callable
        $screen                   // Post type
      );
  }
  /**
   * Fonction pour rendre le code html dans la metabox
   *
   * @return void
   */
  public static function render()
  {
    $data = get_post_meta(get_the_ID(), '_key_description_client');
    $description = $data[0];

    view('metaboxes/description-client', compact('description'));
  }
  /**
   * sauvegarde des données de la metabox
   *
   * @param [type] $post_id reçu par le do_action
   * @return void
   */
  public static function save($post_id)
  {
    if (count($_POST) != 0) {
      // Je créer un tableau dans le quel je stock les données récupéré par ma requete aux quelles j'assigne des clefs 

      $description = $_POST['description_client'];
      // J'utilise le helper update_post_metas que j'ai créer dans le fichier helpers.php ligne 36,je passe deux variables, $post_id qui contient l'id du post, et $data qui contient un tableau de données récupéré
      update_post_metas($post_id , ['_key_description_client' => $description]);
    }
  }
} 