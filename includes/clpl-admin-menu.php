<?php

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit;

// ========== ADD ADMIN MENU PAGE FOR CUSTOM LOGIN LOGO ========== // 
function clpl_logo_menu() {
    add_menu_page(
        esc_html__('Custom Login Logo', 'custom-login-page-logo'),
        esc_html__('Login Logo', 'custom-login-page-logo'),
        'manage_options',
        'clpl-logo-settings',
        'clpl_logo_settings_page',
        'dashicons-wordpress'
    );
}

add_action('admin_menu', 'clpl_logo_menu');
