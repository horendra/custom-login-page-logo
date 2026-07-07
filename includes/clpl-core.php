<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function clpl_default_options_with_values_new() {
    return array(

        // ========== LOGO ========== //

        'logo_field'           => '',
        'logo_width'           => 200,
        'logo_width_unit'      => 'px',
        'logo_height'          => 100,
        'logo_height_unit'     => 'px',
        'logo_redirect_url'    => '',
        'logo_shadow'          => '',
        'logo_border_radius'   => 0,
        'logo_padding'         => 10,

        // ========== BACKGROUND ========== //

        'background_color'     => '#FFFFFF',
        'background_img'            => '',
        'background_img_size'       => 'cover',
        'background_img_position'   => 'center center',
        'background_img_repeat'     => 'no-repeat',

        // ========== REVIEW ========== //

        'activation_time'      => time(),
        'review_done'          => 0,
        'review_remind_time'   => 0,
    );
}

function clpl_get_option($key) {
    $defaults = clpl_default_options_with_values_new();
    $options = get_option('clpl_settings', $defaults);
    return $options[$key] ?? $defaults[$key] ?? null;
}

