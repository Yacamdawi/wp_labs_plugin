<?php
use App\Features\PostTypes\PostTypeRegister;
use App\Features\PostTypes\ServicePostType;
use App\Features\MetaBoxes\ServiceDetailsMetabox;
use App\Features\PostTypes\ClientPostType;
use App\Features\MetaBoxes\ClientMetabox;
use App\Features\PostTypes\FeaturePostType;
use App\Features\MetaBoxes\FeatureDetailsMetabox;

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
  ],



  /**
   * Ajout des hooks filtre
   */
  'filters' => []
];
