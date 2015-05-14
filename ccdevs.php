<?php
/**
 * Plugin Name:       CC Devs
 * Description:       Send copies of admin emails to a list of developers
 * Version:           0.1
 * Author:            John Hawkins & Todd Huish
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ccdevs
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Set some paths
define( 'CCD_PATH', plugin_dir_path(__FILE__) );
define( 'CCD_URL', plugins_url( '/', __FILE__ ) );

// grab some files
require_once( CCD_PATH . 'includes/functions.php' );
