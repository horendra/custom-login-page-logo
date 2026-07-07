<?php

// ========== EXIT IF ACCESSED DIRECTLY ==========//
if ( ! defined( 'ABSPATH' ) ) exit; 

require_once plugin_dir_path(__FILE__) . 'clpl-core.php';

// ========= ENQUEUE STYLE ========= //
function clpl_enqueue_styles() {

    // Get all options
    $options = get_option('clpl_settings', clpl_default_options_with_values_new());

    // ========== LOGO ========== //

    $logo_display       = $options['logo_display'];
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

    $bg_type            = $options['background_type'];
    $bg_color           = $options['background_color'];
    $bg_image           = $options['background_img'];
    $bg_img_size        = $options['background_img_size'];
    $bg_img_pos         = $options['background_img_position'];
    $bg_img_rep         = $options['background_img_repeat'];
    $bg_overlay_color   = $options['background_overlay_color'];

    // ========== FORM ========== //

    $form_bg_color                  = $options['form_bg_color'];
    $form_btn_bg_color              = $options['form_btn_bg_color'];
    $form_eye_icon_color            = $options['form_eye_icon_color'];
    $form_label_color               = $options['form_label_color'];
    $form_btn_txt_color             = $options['form_btn_txt_color'];
    $form_btn_border_color          = $options['form_btn_border_color'];
    $form_txtfield_border_color     = $options['form_txtfield_border_color'];
    $form_txtfield_bg_color         = $options['form_txtfield_bg_color'];
    $form_txtfield_txt_color        = $options['form_txtfield_txt_color'];
    $form_remember_checkmark_color  = $options['form_remember_checkmark_color'];
    $form_pwd_reset_color           = $options['form_pwd_reset_color'];
    $form_go_to_site_color          = $options['form_go_to_site_color'];

    // ========== LANGUAGE SWITCHER ========== //

    $lang_switch_display                    = $options['lang_switch_display'];

    $lang_switch_select_bg_color            = $options['lang_switch_select_bg_color'];
    $lang_switch_select_txt_color           = $options['lang_switch_select_txt_color'];
    $lang_switch_select_border_color        = $options['lang_switch_select_border_color'];
    $lang_switch_select_arrow_color         = $options['lang_switch_select_arrow_color'];

    $lang_switch_select_hover_bg_color      = $options['lang_switch_select_hover_bg_color'];
    $lang_switch_select_hover_txt_color     = $options['lang_switch_select_hover_txt_color'];
    $lang_switch_select_hover_border_color  = $options['lang_switch_select_hover_border_color'];

    $lang_switch_select_focus_bg_color      = $options['lang_switch_select_focus_bg_color'];
    $lang_switch_select_focus_txt_color     = $options['lang_switch_select_focus_txt_color'];
    $lang_switch_select_focus_border_color  = $options['lang_switch_select_focus_border_color'];

    $lang_switch_btn_bg_color               = $options['lang_switch_btn_bg_color'];
    $lang_switch_btn_txt_color              = $options['lang_switch_btn_txt_color'];
    $lang_switch_btn_border_color           = $options['lang_switch_btn_border_color'];

    $lang_switch_btn_hover_bg_color         = $options['lang_switch_btn_hover_bg_color'];
    $lang_switch_btn_hover_txt_color        = $options['lang_switch_btn_hover_txt_color'];
    $lang_switch_btn_hover_border_color     = $options['lang_switch_btn_hover_border_color'];
    
    // ========== BACKGROUND ========== //

    echo'<style type = text/css>';
        if($bg_type === 'color'){
            echo'body.login {';
                if ( ! empty( $bg_color ) ) {
                    echo 'background-color: ' . esc_attr( $bg_color ) . ';';
                } 
            echo'}';
        } else{
            echo'body.login {'; 
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
        }
            
        // ========== LOGO ========== // 

        if(isset($logo_display) && $logo_display === 0){
            echo'#login h1 a { display:none;}';        
        } else{
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
        }

        // ========== FORM ========== //

        if(!empty($form_bg_color)){
            echo '#loginform, #lostpasswordform {   
                background-color:'.esc_attr($form_bg_color).';
                border:1px solid '.esc_attr($form_bg_color).';
            }';
        } 
        if(!empty($form_btn_bg_color)){
            echo '.login .button-primary{
                background-color:'.esc_attr($form_btn_bg_color).'!important;
                border-color: ' . esc_attr($form_btn_bg_color) . '!important;
            }';
        }
        if(!empty($form_eye_icon_color)){
            echo '.login .button.wp-hide-pw .dashicons{
                color:'.esc_attr($form_eye_icon_color).';
            }';
        }
        if(!empty($form_label_color)){
            echo 'body.login form label{
                color:'.esc_attr($form_label_color).';
            }';
        }
        if(!empty($form_btn_txt_color)){
            echo 'body.login #loginform .button-primary, body.login #lostpasswordform .button-primary{
                color:'.esc_attr($form_btn_txt_color).';
            }';
        }
        if(!empty($form_btn_border_color)){
            echo '.wp-core-ui .button-primary{
                border-color:'.esc_attr($form_btn_border_color).'!important;
            }';
        }
        if(!empty($form_txtfield_border_color)){
            echo 'body.login #loginform input:focus, body.login #lostpasswordform input:focus{
                border-color:'.esc_attr($form_txtfield_border_color).';
                box-shadow: 0 0 0 1px ' .esc_attr($form_txtfield_border_color).';
            }';
        }
        if(!empty($form_txtfield_bg_color)){
            echo 'body.login #loginform input[type=text], body.login #loginform input[type=password], body.login #lostpasswordform input[type=text]{
                background-color:'.esc_attr($form_txtfield_bg_color).';
            }';
        }
        if(!empty($form_txtfield_txt_color)){
            echo 'body.login #loginform input[type=text], body.login #loginform input[type=password], body.login #lostpasswordform input[type=text]{
                color:'.esc_attr($form_txtfield_txt_color).';
            }';
        }
        if ( ! empty( $form_remember_checkmark_color ) ) {

            echo '.login form input[type="checkbox"]:checked::before {
                content: "";
            }';

            echo '.login form input[type="checkbox"] {
                position: relative;
            }';

            echo '.login form input[type="checkbox"]:checked::after {
                content: "\2713";
                position: absolute;
                top: 7px;
                left: 2px;
                font-size: 0.9rem;
                font-weight: 900;
                color: ' . esc_attr( $form_remember_checkmark_color ) . ';
            }';
        }
        if ( ! empty( $form_pwd_reset_color ) ) {

            echo '#login #nav a {
                color: ' . esc_attr( $form_pwd_reset_color ) . ';
            }';
        }
        if ( ! empty( $form_go_to_site_color ) ) {

            echo '#login #backtoblog a {
                color: ' . esc_attr( $form_go_to_site_color ) . ';
            }';
        }

        // ========== LANGUAGE SWITCHER ========== //

        if(isset($lang_switch_display) && $lang_switch_display === 0){
            echo'.language-switcher { display:none;}';        
        } else{

            if ( ! empty( $lang_switch_select_bg_color ) ) {

                echo '.login .language-switcher select {
                    background: ' . esc_attr( $lang_switch_select_bg_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_txt_color ) ) {

                echo '.login .language-switcher select {
                    color: ' . esc_attr( $lang_switch_select_txt_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_border_color ) ) {

                echo '.login .language-switcher select {
                    border-color: ' . esc_attr( $lang_switch_select_border_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_arrow_color ) ) {
                echo'.login .language-switcher select {
                    appearance: none;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    padding-right: 30px;
                }';
                echo'.login .language-switcher .clpl-lang-wrap::after {
                    content:"";
                    position: relative;
                    display:inline-block;
                    transform: rotate(135deg);
                    height:10px;
                    width:10px;
                    border-right:2px solid '.esc_attr($lang_switch_select_arrow_color).';
                    border-top:2px solid '.esc_attr($lang_switch_select_arrow_color).';
                    pointer-events: none;
                    right:25px;
                }';
            }

            if ( ! empty( $lang_switch_select_hover_bg_color ) ) {
                echo'.login .language-switcher select:hover{
                    background-color: ' . esc_attr( $lang_switch_select_hover_bg_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_hover_txt_color ) ) {
                echo'.login .language-switcher select:hover{
                    color: ' . esc_attr( $lang_switch_select_hover_txt_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_hover_border_color ) ) {
                echo'.login .language-switcher select:hover{
                    border-color: ' . esc_attr( $lang_switch_select_hover_border_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_focus_bg_color ) ) {
                echo'.login .language-switcher select:focus{
                    background-color: ' . esc_attr( $lang_switch_select_focus_bg_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_focus_txt_color ) ) {
                echo'.login .language-switcher select:focus{
                    color: ' . esc_attr( $lang_switch_select_focus_txt_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_select_focus_border_color ) ) {
                echo'.login .language-switcher select:focus{
                    border-color: ' . esc_attr( $lang_switch_select_focus_border_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_btn_bg_color ) ) {

                echo '.login .language-switcher .button {
                    background: ' . esc_attr( $lang_switch_btn_bg_color ) . ';
                    border-color: ' . esc_attr( $lang_switch_btn_bg_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_btn_txt_color ) ) {

                echo '.login .language-switcher .button {
                    color: ' . esc_attr( $lang_switch_btn_txt_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_btn_border_color ) ) {

                echo '.login .language-switcher .button {
                    border-color: ' . esc_attr( $lang_switch_btn_border_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_btn_hover_bg_color ) ) {
                echo'.login .language-switcher .button:hover{
                    background-color: ' . esc_attr( $lang_switch_btn_hover_bg_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_btn_hover_txt_color ) ) {
                echo'.login .language-switcher .button:hover{
                    color: ' . esc_attr( $lang_switch_btn_hover_txt_color ) . ';
                }';
            }
            if ( ! empty( $lang_switch_btn_hover_border_color ) ) {
                echo'.login .language-switcher .button:hover{
                    border-color: ' . esc_attr( $lang_switch_btn_hover_border_color ) . ';
                }';
            }
        }
                
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