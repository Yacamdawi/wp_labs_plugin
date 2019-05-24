<?php
namespace App\Features\Roles;

use App\Features\PostTypes\ClientPostType;
use App\Features\PostTypes\ServicePostType;
use App\Features\PostTypes\TeamPostType;
use App\Features\PostTypes\FeaturePostType;

class Role
{

  /**
   * Fonction qui attribut des autorisations à l'administrateur 
   *
   * @param $slug ('string')
   * @return void
   */

  public static function permissions($slug)
  {
    $role_admin = get_role('administrator');

    $role_admin->add_cap('edit_' . $slug);
    $role_admin->add_cap('read_' . $slug);
    $role_admin->add_cap('delete_' . $slug);
    $role_admin->add_cap('edit_' . $slug . 's');
    $role_admin->add_cap('edit_others_' . $slug . 's');
    $role_admin->add_cap('publish_' . $slug . 's');
    $role_admin->add_cap('read_private_' . $slug . 's');
    $role_admin->add_cap('edit_' . $slug . 's');
  }
  /**
   * Fonction d'initialisation des romes
   *
   * @return void
   */
  public static function init()
  {
    // Rappel si vous voulez faire un reset de tout les roles pour revenir à la configuration de base, utiliser wp-cli
    // wp role reset --all | n'oubliez pas également d'utiliser wp role pour checker les roles 
    // https://developer.wordpress.org/cli/commands/role/

    self::permissions(ClientPostType::$slug);
    self::permissions(ServicePostType::$slug);
    self::permissions(TeamPostType::$slug);
    self::permissions(FeaturePostType::$slug);
    self::permissions('email');
    self::permissions('newsletter');
  }
}
