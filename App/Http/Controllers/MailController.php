<?php
namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Http\Models\Mail;
use App\Http\Middlewares\CheckPermission;

class MailController
{
  public static function send()
  {
    // Vérification des permissions
    // CheckPermission::check('create_email');
    // on vérifie la sécurité pour voir si le formulaire est bien authentique,que le formulaire envoyé est bien celui de notre page
    if (!wp_verify_nonce($_POST['_wpnonce'], 'send-mail')) {
      return;
    };


    // Maintenant à chaque fois qu'il y a une tenative réussie ou ratée d'envoi de mail, on lance la methode 'validation' de la class Request et on rempli son paramètre avec un tableau de clef et de valeur. On fait en sorte que le nom des clefs correspondent aux names des inputs du formulaire.
    Request::validation([
      'name' => 'required',
      'email' => 'email',
      'subject' => 'required',
      'message' => 'required'
    ]);

    // Nous récupérons les données envoyé par le formulaire qui se retrouve dans la variable $_POST
    $email = sanitize_email($_POST['email']);
    $name = sanitize_text_field($_POST['name']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    $header = 'Content-Type: text/html; charset=UTF-8';
    // on à remplacé notre pavé par un helper qui le contient et on le stock dans une variable qu'on passe à notre wp_mail.
    $mail = mail_template('pages/template-mail', compact('name', 'subject', 'message'));

    // Si le mail est bien envoyé status = 'success' sinon 'error'
    if (wp_mail($email, $name . ' - ' .  $subject, $mail, $header)) {
      $_SESSION['notice'] = [
        'status' => 'success',
        'message' => 'Votre e-mail a bien été envoyé'
      ];

      // Nous allons également sauvegarder en base de donnée les mails que nous avons envoyé.
      // Refactoring pour apprendre et utiliser les models. Seul les models peuvent intéragir avec la base de donnée.
      // on instancie la class Mail et on rempli les valeurs dans les propriétés.
      $mail = new Mail();
      $mail->userid = get_current_user_id();
      $mail->lastname = $name;
      $mail->subject = $subject;
      $mail->email = $email;
      $mail->content = $message;
      // Sauvegarde du mail dans la base de donnée
      $mail->save();

      unset($_SESSION['old']);
    } else {
      $_SESSION['notice'] = [
        'status' => 'error',
        'message' => 'Une erreur est survenue, veuillez réessayer plus tard'
      ];

      $_SESSION['old'] = [
        'email' => $email,
        'name' => $name,
        'subject' => $subject,
        'message' => $message
      ];
    }

    // la fonction wp_safe_redirect redirige vers une url. La fonction wp_get_referer renvoi vers la page d'ou la requête a été envoyé.
    wp_safe_redirect(wp_get_referer());
  }

  public static function index()
  {
    // Vérification des permissions
    CheckPermission::check('read_private_emails');
    // on va chercher toute les entrés de la table dont le model mail s'occupe et on inverse l'ordre afin d'avoir le plus récent en premier.
    $mails = array_reverse(Mail::all());

    view('pages/send-mail', compact('mails'));
  }

  public static function show()
  {
    // Vérification des permissions
    CheckPermission::check('read_email');
    // Maintenant qu'on est ici on à besoin de savoir quel mail est demandé on va donc dans notre url voir que vaut id= ?? et on le stock dans une variable $id
    $id = $_GET['mail_id'];
    // on fait appel à notre function find et dans passe en paramètre l'id pour que notre function sache l'émail à aller chercher dans notre BDD
    $mail = Mail::find($id);
    // on retourn une vue avec le contenu de Mail, cette vue n'est pas encore crée nous allons la crée au prochain commit. A présent la vue existe et donc on peut y utiliser la variable mail qu'on compact.
    view('pages/show-mail', compact('mail'));
  }
}
