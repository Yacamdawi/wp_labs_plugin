<?php
namespace App;
use App\Database\Database;
use App\Features\Roles\Role;
class Setup
{
  public static function init()
  {
    $plugin = plugin_dir_path(__FILE__) . '/labs.php';
    register_activation_hook($plugin, [self::class, 'activation']);
    register_deactivation_hook($plugin, [self::class, 'deactivation']);
    register_uninstall_hook($plugin, [self::class, 'uninstall']);
  }
  /**
   * Fonction lancé lors de l'activation du plugin
   *
   * @return void
   */
  public static function activation()
  {
    Database::init();
    Role::init();
  }
  /**
   * Fonction appelé lors de la désactivation du plugin
   *
   * @return void
   */
  public static function deactivation()
  { }
  /**
   * Fonction appelé lors de la désinstallation du plugin
   *
   * @return void
   */
  public static function uninstall()
  { }
  /**
   * Fonction pour démarrer une session afin de pouvoir utiliser la variable $_SESSION
   *
   * @return void
   */
  public static function start_session()
  {
    // on vérifie si une session n'existe pas déjà. Si non on en commence une
    if (!session_id()) {
      session_start();
    }
  }
  /**
   * Fonction pour ajouter des script et css pour l'admin
   *
   * @return void
   */
  public static function enqueue_scripts()
  {
    // Cette css a été créer à partir des fichier scss de bootstrap en n'utilisant que la partie grid. Si vous essayé de reproduire cette action, sachez que j'ai du rajouter ceci manuellement *{box-sizing:border-box};
    wp_enqueue_style('flaticon', plugin_dir_url(__FILE__) . "../resources/assets/css/flaticon.css");
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . "../resources/assets/css/bootstrap.min.css");
    wp_enqueue_style('style', plugin_dir_url(__FILE__) . "../resources/assets/css/style.css");
  }
  /**
   * Configuration du phpmailer pour rediriger les mails vers mailTrap
   *
   * @param [type] $phpmailer
   * @return void
   */
  public static function mailtrap($phpmailer)
  {
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'cc4a4a753e5f69';
    $phpmailer->Password = '481725160775de';
  }
}