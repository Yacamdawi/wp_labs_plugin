<?php
namespace App\Database\Migrations;

class CreateNewsletterTable
{
  /**
   * Création de la table
   *
   * @return void
   */
  public static function up()
  {
    // Nous récupérons l'objet $wpdb qui est global afin de pouvoir intéragir avec la base de donnée.
    global $wpdb;
    // $wpdb->prefix permet de récuper le prefix qu'on avait choisis quand on a créer notre base de donnée wordpress la toute première fois qu'on a lancé wp server apres notre wp core download
    $table_name = $wpdb->prefix . 'labs_newsletter';

    $wpdb->query("CREATE TABLE IF NOT EXISTS  $table_name  (
      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      email VARCHAR(255) NOT NULL,
      created_at TIMESTAMP
    )
    COLLATE utf8mb4_unicode_520_ci
    ;");
  }
}
