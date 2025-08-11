<?php

// ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

// ========= ENQUEUE STYLE ========= //
function clpl_enqueue_styles() {

    // ADD STYLES TO ADMIN LOGIN PAGE
    $logo_url = get_option('clpl_logo_field');
    $logo_width = get_option('clpl_logo_width', '100'); // DEFAULT 100
    $logo_width_unit = get_option('clpl_logo_width_unit', 'px'); // DEFAULT PX
    $logo_height = get_option('clpl_logo_height', '100'); // DEFAULT 100
    $logo_height_unit = get_option('clpl_logo_height_unit', 'px'); // DEFAULT PX
    $logo_shadow = get_option('clpl_logo_shadow', '0'); // LOGO SHADOW
    $logo_border_radius = get_option('clpl_logo_border_radius', '0'); // LOGO SHADOW
    $logo_padding = get_option('clpl_logo_padding', '0'); // LOGO PADDING
    $logo_redirect_url = get_option('clpl_logo_redirect_url', site_url()); // DEFAULT SITE URL

    echo '<style>
            #login h1 a {';

            // SETS LOGO IMAGE WITH STYLE
            if (!empty($logo_url)) {
                echo'background-image: url(' . esc_url($logo_url) . ');
                    width: ' . esc_attr($logo_width) . esc_attr($logo_width_unit) . ';
                    height: ' . esc_attr($logo_height) . esc_attr($logo_height_unit) . ';
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                    border-radius: '.esc_attr($logo_border_radius).'px;';
            }
           
            // SETS LOGO SHADOW
            if(!empty($logo_shadow)){
                if($logo_shadow == 1){
                    echo '
                        box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);             
                        ';
                }
            }

            // SETS LOGO PADDING
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

            $logo_redirect_url = get_option('clpl_logo_redirect_url', site_url());

            if(empty($logo_redirect_url)){
                $logo_redirect_url = site_url();
            } 
            return esc_url($logo_redirect_url);       
                   
        }
        
        function clpl_logo_redirect_url_title() {
            $blog_name = get_bloginfo( 'name' );
            return $blog_name;
        }
        add_filter( 'login_headerurl', 'clpl_logo_redirect_url' );
        add_filter( 'login_headertext', 'clpl_logo_redirect_url_title' );
    }
    
add_action('login_enqueue_scripts', 'clpl_enqueue_styles');