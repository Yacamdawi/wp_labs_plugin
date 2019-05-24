<?php
use App\Database\Database;
use App\Features\Roles\Role;

/**
 * Plugin Name:     Labs
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          None
 * Author URI:      None
 * Text Domain:     labs
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Labs
 */

// Your code starts here.
 // Import du autoload.php pour récuperer les class automatiquement sans devoir un require
require_once('autoload.php');

 //lancement de l'application
require_once('bootstrap.php');


register_activation_hook(__DIR__ . '/labs.php', [Database::class, 'init']);
register_activation_hook(__DIR__ . '/labs.php', [Role::class, 'init']);