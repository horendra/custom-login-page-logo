<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function clpl_default_options_with_values_new() {
    
    return array(

        // ========== LOGO ========== //

        'logo_display'              => 1, 
        'logo_field'                => '',
        'logo_width'                => 200,
        'logo_width_unit'           => 'px',
        'logo_height'               => 200,
        'logo_height_unit'          => 'px',
        'logo_redirect_url'         => '',
        'logo_shadow'               => '',
        'logo_border_radius'        => 0,
        'logo_padding'              => 0,

        // ========== BACKGROUND ========== //

        'background_type'           => 'color',
        'background_color'          => '#FFFFFF',
        'background_img'            => '',
        'background_img_size'       => 'cover', 
        'background_img_position'   => 'center center',
        'background_img_repeat'     => 'no-repeat', 
        'background_overlay_color'  => 'rgba(0,0,0,0)', 

        // ========== FORM ========== //

        'form_bg_color'                     => '#FFFFFF',
        'form_label_color'                  => '#3c434a',
        'form_txtfield_border_color'        => '#2271b1',
        'form_txtfield_bg_color'            => '#FFFFFF',
        'form_txtfield_txt_color'           => '#2c3338',
        'form_eye_icon_color'               => '#2271b1',
        'form_btn_bg_color'                 => '#2271b1',
        'form_btn_txt_color'                => '#FFFFFF',
        'form_btn_border_color'             => '#2271b1',
        'form_remember_checkmark_color'     => '#2271b1',
        'form_pwd_reset_color'              => '#50575e',
        'form_go_to_site_color'             => '#50575e',

        // ========== LANGUAGE SWITCHER ========== //

        'lang_switch_display'                   => 0,
        'lang_switch_select_bg_color'           => '#FFFFFF', 
        'lang_switch_select_txt_color'          => '#2c3338',
        'lang_switch_select_border_color'       => '#8c8f94',
        'lang_switch_select_arrow_color'        => '#2c3338',
        'lang_switch_select_hover_bg_color'     => '#2271b1',
        'lang_switch_select_hover_txt_color'    => '#2271b1',
        'lang_switch_select_hover_border_color' => '#2271b1',
        'lang_switch_select_focus_bg_color'     => '#2271b1',
        'lang_switch_select_focus_txt_color'    => '#2271b1',
        'lang_switch_select_focus_border_color' => '#2271b1',
        'lang_switch_btn_bg_color'              => '#FFFFFF',
        'lang_switch_btn_txt_color'             => '#2271b1',
        'lang_switch_btn_border_color'          => '#2271b1',
        'lang_switch_btn_hover_bg_color'        => '#FFFFFF',
        'lang_switch_btn_hover_txt_color'       => '#2271b1',
        'lang_switch_btn_hover_border_color'    => '#2271b1',

        // ========== REVIEW ========== //

        'activation_time'           => time(),
        'review_done'               => 0,
        'review_remind_time'        => 0,
    );
}

function clpl_get_option($key) {
    $defaults = clpl_default_options_with_values_new();
    $options = get_option('clpl_settings', $defaults);
    return $options[$key] ?? $defaults[$key] ?? null;
}

