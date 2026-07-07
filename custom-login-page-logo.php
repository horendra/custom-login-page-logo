<?php
/*
Plugin Name: Custom Login Page Logo
Description: Allows users to customize or change wordpress logo to their own brand on WordPress login page.
Version: 1.4.1
Author: Horendra Pal Singh Kandari
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: custom-login-page-logo
Domain Path: /languages
*/

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit; 

// CONSTANTS 
define( 'CLPL_PATH', plugin_dir_path(__FILE__) );
define( 'CLPL_URL', plugin_dir_url(__FILE__) );

// ========== GET PLUGIN DATA ========== //
if ( ! function_exists( 'get_plugin_data' ) ) {
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

$clpl_plugin_data = get_plugin_data( __FILE__ );
define( 'CLPL_VERSION', $clpl_plugin_data['Version'] );

// ========== INCLUDE ALL REQUIRED FILES ========== //
require_once CLPL_PATH . 'includes/clpl-core.php';
require_once CLPL_PATH . 'includes/clpl-enqueue.php';
require_once CLPL_PATH . 'includes/clpl-admin-menu.php';
require_once CLPL_PATH . 'includes/clpl-settings-fields.php';
require_once CLPL_PATH . 'includes/clpl-style.php';
