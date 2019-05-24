<?php
namespace App\Features\Pages;
use App\Http\Controllers\NewsletterController;

class SendNewsletter
{
  /**
   * Initialisation de la page.
   *
   * @return void
   */
  public static function init()
  {
    //https: //developer.wordpress.org/reference/functions/add_menu_page/  
    add_menu_page(
      __("Liste d'email abonnés"), // Le titre qui s'affichera sur la page
      __('Newsletters'), // le texte dans le menu
      'read_newsletter', // la capacité qu'il faut posséder en tant qu'utilisateur pour avoir accès à cette page (les roles et capacité seront vue plus tard)
      'newsletter-client', // Le slug du menu
      [self::class, 'render'], // La méthode qui va afficher la page
      'dashicons-email-alt', // L'icon dans le menu
      26 // la position dans le menu (à comparer avec la valeur deposition des autres liens menu que l'on retrouve dans la doc).
    );
  }
  public static function render()
  {
    /**
     * on fait un refactoring afin que la méthode render renvoi vers la bonne méthode en fonction de l'action
     */
    // on défini une valeur par défaut pour $action qui est index et qui correspondra à la méthode à utiliser(celle qui renvoi la vue avec tous les mails et le formulaire)
    $action = isset($_GET["action"]) ? $_GET["action"] : "index";
    call_user_func([NewsletterController::class, $action]);
  }
}