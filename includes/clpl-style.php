<?php

// ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

require_once plugin_dir_path(__FILE__) . 'clpl-core.php';

// ========= ENQUEUE STYLE ========= //
function clpl_enqueue_styles() {

    // Get all options
    $options = get_option('clpl_settings', clpl_default_options_with_values_new());

    // ========== LOGO ========== //

    $logo_url           = $options['logo_field'];
    $logo_width         = $options['logo_width'];
    $logo_width_unit    = $options['logo_width_unit'];
    $logo_height        = $options['logo_height'];
    $logo_height_unit   = $options['logo_height_unit'];
    $logo_shadow        = $options['logo_shadow'];
    $logo_border_radius = $options['logo_border_radius'];
    $logo_padding       = $options['logo_padding'];
    $logo_redirect_url  = $options['logo_redirect_url'] ?: site_url();

    // ========== BACKGROUND ========== //

    $bg_color           = $options['background_color'];
    $bg_image           = $options['background_img'];
    $bg_img_size        = $options['background_img_size'];
    $bg_img_pos         = $options['background_img_position'];
    $bg_img_rep         = $options['background_img_repeat'];
    $bg_overlay_color   = $options['background_overlay_color'];
    
    echo '<style type = text/css>    
        body.login {';
            
            // ========== BACKGROUND ========== //

            if ( ! empty( $bg_color ) ) {
                echo 'background-color: ' . esc_attr( $bg_color ) . ';';
            } 
            if ( ! empty( $bg_image ) ) {
                echo 'background-image: url(' . esc_url( $bg_image ) . ');';
            }
            if ( ! empty( $bg_img_size ) ) {
                echo 'background-size: '. esc_attr( $bg_img_size ) . ';';
            }
            if ( ! empty( $bg_img_pos ) ) {
                echo 'background-position: '. esc_attr( $bg_img_pos ) . ';';
            }
            if ( ! empty( $bg_img_rep ) ) {
                echo 'background-repeat: '. esc_attr( $bg_img_rep ) . ';';
            }
            echo 'transition: background-color 0.3s ease;';
        
        echo '}';

        if ( ! empty( $bg_overlay_color ) ) {
            echo'  
            body.login {
                position: relative;
            }  
            body.login::before{
                content:"";
                position:fixed;
                inset:0;
                background:'.esc_attr($bg_overlay_color).';
                z-index:0;
                pointer-events: none;
            }
            body.login #login, body.login .language-switcher{
                position:relative;
                z-index:1;
            }';
        }
            
        // ========== LOGO ========== // 

        echo '#login h1 a {';

            if (!empty($logo_url)) {
                echo'background-image: url(' . esc_url($logo_url) . ');
                    width: ' . esc_attr($logo_width) . esc_attr($logo_width_unit) . ';
                    height: ' . esc_attr($logo_height) . esc_attr($logo_height_unit) . ';
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;';
            }
            
            if(!empty($logo_border_radius)){
                echo'border-radius: '.esc_attr($logo_border_radius).'px;';
            }

            if(!empty($logo_shadow)){
                if($logo_shadow == 1){
                    echo '
                        box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);             
                        ';
                }
            }

            if(!empty($logo_padding)){
                echo 'padding:'.esc_attr($logo_padding).'px;
                background-origin: content-box;';
            }
        
        echo'}'; 
        
    echo'</style>';
}

    // ========= SETS LOGO REDIRECT URL ========= //

    if(!empty($logo_redirect_url)){

        function clpl_logo_redirect_url() {

            $options = get_option('clpl_settings', clpl_default_options());
            $url = $options['logo_redirect_url'] ?: site_url();
            return esc_url($url);      
                   
        }
        
        function clpl_logo_redirect_url_title() {
            $blog_name = get_bloginfo( 'name' );
            return $blog_name;
        }
        add_filter( 'login_headerurl', 'clpl_logo_redirect_url' );
        add_filter( 'login_headertext', 'clpl_logo_redirect_url_title' );
    }
    
add_action('login_enqueue_scripts', 'clpl_enqueue_styles');