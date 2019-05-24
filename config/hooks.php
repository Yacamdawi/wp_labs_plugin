<?php
use App\Features\PostTypes\PostTypeRegister;
use App\Features\PostTypes\ServicePostType;
use App\Features\MetaBoxes\ServiceDetailsMetabox;
use App\Features\PostTypes\ClientPostType;
use App\Features\MetaBoxes\ClientMetabox;
use App\Features\PostTypes\FeaturePostType;
use App\Features\MetaBoxes\FeatureDetailsMetabox;

use App\Setup;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NewsletterController;
use App\Features\Pages\Page;

return [
  /**
   * Ajout des hooks action
   */
  'actions' => [
    // Ajout d'un listener à l'event "init". le listener est la méthode "register" des class suivantes..
    ['init', [PostTypeRegister::class, 'register']],

    // Ajout d'une Metabox pour le postType service
    ['add_meta_boxes_service', [ServiceDetailsMetabox::class, 'add_meta_box']],
    ['save_post_' . ServicePostType::$slug, [ServiceDetailsMetabox::class, 'save']],

    // Ajout d'une Metabox pour le postType client
    ['add_meta_boxes_client', [ClientMetabox::class, 'add_meta_box']],
    ['save_post_' . ClientPostType::$slug, [ClientMetabox::class, 'save']],

    // Ajout d'une Metabox pour le postType feature
    ['add_meta_boxes_feature', [FeatureDetailsMetabox::class, 'add_meta_box']],
    ['save_post_' . FeaturePostType::$slug, [FeatureDetailsMetabox::class, 'save']],

    ['admin_menu', [Page::class, 'init']],
    ['init', [Setup::class, 'start_session']],
    ['admin_enqueue_scripts', [Setup::class, 'enqueue_scripts']],
    ['phpmailer_init', [Setup::class, 'mailtrap']],

    ['admin_post_send-mail', [MailController::class, 'send']],
    ['admin_post_nopriv_send-mail', [MailController::class, 'send']],

    ['admin_post_send-newsletter', [NewsletterController::class, 'send']],
    ['admin_post_nopriv_send-newsletter', [NewsletterController::class, 'send']],
    // Hook personnalisé, c'est la combinaison du hook 'admin_action_' de wordpress avec mail-delete qui est l'action qu'on envoi dans l'url ligne 27 du fichier show-mail-html.php 
    ['admin_action_delete-newsletter', [NewsletterController::class, 'delete']],
  ],



  /**
   * Ajout des hooks filtre
   */
  'filters' => []
];
