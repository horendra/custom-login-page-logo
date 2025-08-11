<?php

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit;

// ========== CREATING SETTINGS FOR CUSTOM LOGIN LOGO ========== //
function clpl_logo_settings_page() {
    
    echo'<div class="wrap">';
        echo '<h1>'.esc_html__('Custom Login Page Logo Settings', 'custom-login-page-logo').'</h1>';
        echo'<form method="post" action="options.php">';
        settings_fields('clpl_logo_settings', 'clpl_logo_section');

        // ========== CHECKS IF THE ADDON IS ACTIVATED ========== //
        if(is_plugin_active('custom-login-page-logo-addon/custom-login-page-logo-addon.php')){

            // ========== DISPLAY ADDITIONAL FIELDS ========== /
            settings_fields('clpl_additional_settings', 'clpl_additional_section');
        }
        
        do_settings_sections('clpl_logo_settings');
        submit_button();
        echo'</form>';
        settings_errors();
    echo'</div>';
    
}

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
