<?php

    // ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

    // ========== DISPLAYS - UPLOAD LOGO  ========== //
    function clpl_logo_field_callback() {
        
        // GET THE LOGO URL FROM THE DATABASE AND SANITIZE IT
        $logo_url = get_option('clpl_logo_field');
        
        // DISPLAYS FIELD - CUSTOM LOGO URL
        echo '<input type="url" name="clpl_logo_field" id="custom_login_logo" autocomplete="on" 
            placeholder="Enter Logo URL" title="' . esc_attr($logo_url) . '" 
            value="' . esc_url($logo_url) . '" />';
        
        // DISPLAYS BUTTON - UPLOAD LOGO
        echo '<button class="button button-secondary" id="upload_logo">' . esc_html__('Upload Logo', 'custom-login-page-logo') . '</button>';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Upload image or enter a custom URL with http or https', 'custom-login-page-logo').')</p>';
        
        // DISPLAYS LOGO IF THE URL IS NOT EMPTY
        if (!empty($logo_url)) {
            echo '<div id="clpl_logo_container">
                    <img src="' . esc_url($logo_url) . '" 
                    title="' . esc_attr(basename($logo_url)) . '" alt = "Logo image" />
                  </div>';
        }
    }

    // ========== DISPLAYS - LOGO WIDTH ========== //
    function clpl_logo_width_callback() {

        // GET THE LOGO WIDTH FROM THE DATABASE, DEFAULTING TO '100' IF NOT SET
        $width = get_option('clpl_logo_width', '100');

        // DISPLAYS FIELD - LOGO WIDTH
        echo '<input type="number" name="clpl_logo_width" id="clpl_logo_width" min="0" max="600" 
              placeholder="100" title = "Enter logo width" value="' . esc_attr($width) . '" />';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Enter logo width', 'custom-login-page-logo').')</p>';
    }


    // ========== DISPLAYS - LOGO WIDTH MEASUREMENT UNIT ========== //
    function clpl_logo_width_unit_callback() {

        // GET THE LOGO WIDTH UNIT FROM THE DATABASE, DEFAULTING TO 'PX' IF NOT SET
        $width_mmt = esc_attr(get_option('clpl_logo_width_unit', 'px'));

        // DISPLAYS FIELD - LOGO WIDTH UNIT
        echo '<select name="clpl_logo_width_unit" id="clpl_logo_width_unit" title = "Enter logo width measurement unit">
                <option value="px" ' . selected($width_mmt, 'px', false) . '>Pixels (px)</option>
                <option value="%" ' . selected($width_mmt, '%', false) . '>Percentage (%)</option>
              </select>';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Choose the measurement unit for logo width', 'custom-login-page-logo').')</p>';
    }


    // ========== DISPLAYS - LOGO HEIGHT ========== //
    function clpl_logo_height_callback() {

        // GET THE LOGO HEIGHT FROM THE DATABASE, DEFAULTING TO '100' IF NOT SET
        $height = get_option('clpl_logo_height', '100');

        // DISPLAYS FIELD - LOGO HEIGHT
        echo '<input type="number" name="clpl_logo_height" id="clpl_logo_height" min="0" max="600" 
              placeholder="100" title = "Enter logo height" value="' . esc_attr($height) . '" />';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Enter logo height', 'custom-login-page-logo').')</p>';
    }


    // ========== DISPLAYS LOGO HEIGHT MEASUREMENT UNIT ========== //
    function clpl_logo_height_unit_callback() {

        // GET THE LOGO HEIGHT UNIT FROM THE DATABASE, DEFAULTING TO 'PX' IF NOT SET
        $height_mmt = esc_attr(get_option('clpl_logo_height_unit', 'px'));

        // DISPLAYS FIELD - LOGO HEIGHT UNIT
        echo '<select name="clpl_logo_height_unit" id="clpl_logo_height_unit" title = "Enter logo height measurement unit">
                <option value="px" ' . selected($height_mmt, 'px', false) . '>Pixels (px)</option>
                <option value="%" ' . selected($height_mmt, '%', false) . '>Percentage (%)</option>
              </select>';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Choose the measurement unit for logo height', 'custom-login-page-logo').')</p>';
    }


    // ========== DISPLAYS LOGO REDIRECT URL ========== //
    function clpl_logo_redirect_url_callback() {

        // GET THE LOGO REDIRECT URL FROM THE DATABASE, DEFAULTING TO SITE_URL() IF NOT SET
        $logo_redirect_url = esc_url(get_option('clpl_logo_redirect_url', ''));

        if(empty($logo_redirect_url)){
            $logo_redirect_url = site_url(); 
        } 

        // DISPLAYS FIELD - LOGO REDIRECT URL
        echo '<input type="url" name="clpl_logo_redirect_url" id="clpl_logo_redirect_url" autocomplete="on"
              placeholder="Enter Logo Redirect URL" title="' . esc_attr($logo_redirect_url) . '" 
              value="' . esc_attr($logo_redirect_url) . '" />';

        // DISPLAYS DESCRIPTION
        echo'<p class="description clpl_description">('.esc_html__('Example: https://mydomain.com or http://mydomain.com', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO SHADOW ========== //
    function clpl_logo_shadow_callback() {

        // GET THE LOGO SHADOW VALUE FROM THE DATABASE
        $logo_shadow = esc_attr(get_option('clpl_logo_shadow', ''));

        // DISPLAY CHECKBOX, CHECKED IF THE VALUE IS SET TO '1'
        echo '<input type="checkbox" name="clpl_logo_shadow" id="clpl_logo_shadow" title="show shadow" 
              value="1" ' . checked($logo_shadow, '1', false) . ' />';
        echo '<label for="clpl_logo_shadow">'.esc_html__('Yes', 'custom-login-page-logo').'</label>';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Select if you want logo shadow', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO BORDER-RADIUS ========== //
    function clpl_logo_border_radius_callback() {

        // GET THE LOGO BORDER RADIUS VALUE FROM THE DATABASE
        $logo_border_radius = get_option('clpl_logo_border_radius', '0');

        // DISPLAY FIELD - LOGO BORDER-RADIUS
        echo '<input type="number" name="clpl_logo_border_radius" id="clpl_logo_border_radius" title="Enter logo border-radius" max = "250" min = "0" placeholder = "5"
              value="' . esc_attr($logo_border_radius) . '" />';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Enter logo border radius in "px"', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO PADDING ========== //
    function clpl_logo_padding_callback() {

        // GET THE LOGO BORDER RADIUS VALUE FROM THE DATABASE
        $logo_padding = get_option('clpl_logo_padding', '0');

        // DISPLAY FIELD - LOGO PADDING
        echo '<input type="number" name="clpl_logo_padding" id="clpl_logo_padding" title="Enter logo padding" max = "100" min = "0" placeholder = "5"
              value="' . esc_attr($logo_padding) . '" />';
        
        // DISPLAYS DESCRIPTION
        echo '<p class="description clpl_description">('.esc_html__('Enter logo padding in "px"', 'custom-login-page-logo').')</p>';
    }
   

    // ========== CALLBACK FUNCTION OF SETTING'S SECTION ========== //
    function clpl_logo_section_callback() {
        echo '<p>'.esc_html__('(Upload or select a custom logo for the login page.)', 'custom-login-page-logo').'</p>';
    }

    // ========== ADDING SETTINGS ========== //
    function clpl_logo_settings_init() {

    	// ADDING SETTING'S SECTION //
        add_settings_section(
            'clpl_logo_section',
            __('Custom Login Logo Settings', 'custom-login-page-logo'),
            'clpl_logo_section_callback',
            'clpl_logo_settings'
        );

        add_settings_field(
            'clpl_logo_field',
            __('Logo URL', 'custom-login-page-logo'), // CUSTOM LOGO URL
            'clpl_logo_field_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_width',
            __('Logo Width', 'custom-login-page-logo'), // CUSTOM LOGO WIDTH
            'clpl_logo_width_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_width_unit',
             __('Logo Width Unit', 'custom-login-page-logo'), // CUSTOM LOGO WIDTH MEASUREMENT UNIT
            'clpl_logo_width_unit_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_height',
            __('Logo Height', 'custom-login-page-logo'), // CUSTOM LOGO HEIGHT
            'clpl_logo_height_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_height_unit',
             __('Logo Height Unit', 'custom-login-page-logo'), // CUSTOM LOGO HEIGHT MEASUREMENT UNIT
            'clpl_logo_height_unit_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_redirect_url',
             __('Logo Redirect URL', 'custom-login-page-logo'), // CUSTOM LOGO REDIRECT URL
            'clpl_logo_redirect_url_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_shadow',
             __('Logo Shadow', 'custom-login-page-logo'), // CUSTOM LOGO SHADOW
            'clpl_logo_shadow_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_border_radius',
             __('Logo Border Radius', 'custom-login-page-logo'), // CUSTOM LOGO BORDER-RADIUS
            'clpl_logo_border_radius_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_padding',
             __('Logo Padding', 'custom-login-page-logo'), // CUSTOM LOGO PADDING
            'clpl_logo_padding_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        // ========== REGISTER SETTINGS ========== //
        register_setting('clpl_logo_settings', 'clpl_logo_field');
        register_setting('clpl_logo_settings', 'clpl_logo_width');
        register_setting('clpl_logo_settings', 'clpl_logo_width_unit');
        register_setting('clpl_logo_settings', 'clpl_logo_height');
        register_setting('clpl_logo_settings', 'clpl_logo_height_unit');
        register_setting('clpl_logo_settings', 'clpl_logo_redirect_url');
        register_setting('clpl_logo_settings', 'clpl_logo_shadow');
        register_setting('clpl_logo_settings', 'clpl_logo_border_radius');
        register_setting('clpl_logo_settings', 'clpl_logo_padding');
        
    }

    add_action('admin_init', 'clpl_logo_settings_init');
