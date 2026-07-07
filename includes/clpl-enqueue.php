<?php

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit; 

// ========== REGISTER PLUGIN ALL SCRIPTS ========== //
function clpl_register_scripts(){

    // REGISTER PLUGIN SCRIPT
    wp_register_script(
        'custom-login-logo-script', // HANDLE
        CLPL_URL . 'js/clpl-login-logo.js', // SOURCE
        array('jquery', 'wp-i18n', 'wp-color-picker'), // DEPENDENCIES
        CLPL_VERSION, // VERSION
        true // IN FOOTER
    );
    wp_register_script(
        'clpl-color-picker-alpha',
        CLPL_URL . 'js/clpl-color-picker-alpha.min.js',
        array('wp-color-picker'),
        CLPL_VERSION,
        true
    );

    // REGISTER PLUGIN STYLESHEET
    wp_register_style(
        'custom-login-logo-style', 
        CLPL_URL . 'css/clpl-style.css', 
        array(), 
        CLPL_VERSION 
    );

}

// ========= ENQUEUE MEDIA UPLOADER AND SCRIPTS ========= //
function clpl_enqueue_scripts($hook){

    if ( $hook !== 'toplevel_page_clpl-logo-settings' ) {
        return;
    }

    // INCLUDE MEDIA UPLOADER
    wp_enqueue_media();

    // ENQUEUE PLUGIN STYLESHEET
    wp_enqueue_style('custom-login-logo-style');

    // ENQUEUE THE CUSTOM SCRIPT
    wp_enqueue_script('custom-login-logo-script');

    // WP color picker
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('clpl-color-picker-alpha');

    $clpl_translation_array = array(
        'choose_or_upload_logo' => esc_html__('Choose or Upload a Logo', 'custom-login-page-logo'),
        'choose_or_upload_background_image' => esc_html__('Choose or Upload a background Image', 'custom-login-page-logo'),
        'use_this_logo'         => esc_html__('Use this Logo', 'custom-login-page-logo'),
        'use_this_image'         => esc_html__('Use this Image', 'custom-login-page-logo'),
    );

    wp_localize_script('custom-login-logo-script', 'clpl_Translations', $clpl_translation_array);

}

function clpl_login_lang_switch_scripts() {

    wp_enqueue_script(
        'clpl-login-lang-switch-js',
        CLPL_URL . 'js/clpl-login-lang-switch.js',
        array(),
        CLPL_VERSION,
        true
    );

}

// ========= LOAD TEXT DOMAIN ========= //
// function clpl_load_textdomain() {
//     load_plugin_textdomain( 'custom-login-page-logo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
// }

add_action('admin_enqueue_scripts', 'clpl_register_scripts');
add_action('admin_enqueue_scripts', 'clpl_enqueue_scripts');
add_action('login_enqueue_scripts', 'clpl_login_lang_switch_scripts');
//add_action('plugins_loaded', 'clpl_load_textdomain' );
