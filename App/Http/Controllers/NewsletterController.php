<?php
namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Models\Newsletter;
use App\Http\Middlewares\CheckPermission;

class NewsletterController
{
  public static function send()
  {
    // on vérifie la sécurité pour voir si le formulaire est bien authentique,que le formulaire envoyé est bien celui de notre page
    if (!wp_verify_nonce($_POST['_wpnonce'], 'send-newsletter')) {
      return;
    };

    // Maintenant à chaque fois qu'il y a une tenative réussie ou ratée d'envoi de mail, on lance la methode 'validation' de la class Request et on rempli son paramètre avec un tableau de clef et de valeur. On fait en sorte que le nom des clefs correspondent aux names des inputs du formulaire.
    Request::validationNewsletters([
      'email' => 'email',
    ]);

    $email = sanitize_email($_POST['email']);
    $header = 'Content-Type: text/html; charset=UTF-8';
    // on à remplacé notre pavé par un helper qui le contient et on le stock dans une variable qu'on passe à notre wp_mail.
    $mail = mail_template('pages/template-newsletter', compact('email'));

    // Si le mail est bien envoyé status = 'success' sinon 'error'
    if (wp_mail($email, 'Nouveau newsletter' , $mail, $header)) {
      $_SESSION['newsletter'] = [
        'status' => 'success',
        'message' => 'Votre e-mail a bien été envoyé'
      ];
      // Nous récupérons les données envoyé par le formulaire qui se retrouve dans la variable $_POST
      // Nous allons également sauvegarder en base de donnée les mails que nous avons envoyé.
      // Refactoring pour apprendre et utiliser les models. Seul les models peuvent intéragir avec la base de donnée.
      // on instancie la class Mail et on rempli les valeurs dans les propriétés.
      $mail = new Newsletter();
      // $mail->userid = get_current_user_id();
      $mail->email = $email;
      // Sauvegarde du mail dans la base de donnée
      $mail->save();
    } else {
      $_SESSION['newsletter'] = [
        'status' => 'error',
        'message' => 'Une erreur est survenue, veuillez réessayer plus tard..'
      ];
    }
    // la fonction wp_safe_redirect redirige vers une url. La fonction wp_get_referer renvoi vers la page d'ou la requête a été envoyé.
    wp_safe_redirect(wp_get_referer());
  }

  public static function index()
  {
    // Vérification des permissions
    CheckPermission::check('read_newsletter');
    // on va chercher toute les entrés de la table dont le model mail s'occupe et on inverse l'ordre afin d'avoir le plus récent en premier.
    $newsletters = array_reverse(Newsletter::all());

    view('pages/send-newsletter', compact('newsletters'));
  }

  public static function delete()
  {
    // Vérification des permissions
    CheckPermission::check('delete_newsletter');

    // on récupère l'id envoyé via $_POST notre formulaire ligne 29 dans show-mail.html.php
    $id = $_POST['newsletter_id'];
    // si notre function delete($id) est lancée alors on rempli SESSION avec un status et un message positif puis on redirect sur notre page mail-client
    if (Newsletter::delete($id)) {
      //   $_SESSION['notice'] = [
      //     'status' => 'success',
      //     'message' => 'Le mail a bien été supprimé'
      //   ];
      wp_safe_redirect(menu_page_url('newsletter-client'));
    }
    // Si le mail na pas été supprimé on renvoi sur la page avec une notification négative
    else {
      //   $_SESSION['notice'] = [
      //     'status' => 'error',
      //     'message' => 'un Problème est survenu, veuillez rééssayer'
      //   ];
      wp_safe_redirect(wp_get_referer());
    }
  }
}
