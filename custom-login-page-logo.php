<?php
/*
Plugin Name: Custom Login Page Logo
Description: Allows users to customize or change wordpress logo to their own brand on WordPress login page.
Version: 1.3.2
Author: Horendra Pal Singh Kandari
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: custom-login-page-logo
Domain Path: /languages
*/

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit; 

// ========== INCLUDE ALL REQUIRED FILES ========== //
include_once(plugin_dir_path(__FILE__) . 'functions.php');
include_once(plugin_dir_path(__FILE__) . 'clpl-admin-menu.php');
include_once(plugin_dir_path(__FILE__) . 'clpl-settings-fields.php');
include_once(plugin_dir_path(__FILE__) . 'clpl-style.php');







