<?php
/**
 * Plugin Name: Go Galapagos
 * Plugin URI: https://www.gogalapagos.com/
 * Description: Create custom structures to Go Galapagos WordPress site.
 * Version: 1.0
 * Author: The Go Galapagos Team
 * Author URI: https://www.gogalapagos.com/
 * License: GPL2+
 * Text Domain: gogalapagos
 * Domain Path: /languages/
 *
 * @package Meta Box
 */

// If try to access directly
if(!defined ('ABSPATH') ){
	exit('There is nothing here!');
}

// Definitions
define('URLPLUGINGOGALAPAGOS', plugin_dir_url( __FILE__ )); // Plugins URL

// Libraries
require_once('includes/gogalapagos_extras.php');
require_once('includes/gogalapagos_cpt.php');
require_once('includes/gogalapagos_taxonomies.php');
require_once('includes/gogalapagos_metaboxes.php');
