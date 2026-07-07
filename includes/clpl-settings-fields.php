<?php

    // ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

    // ========== CREATING SETTINGS FOR CUSTOM LOGIN LOGO ========== //
    function clpl_logo_settings_page() {

        $active_tab = isset($_GET['tab']) 
            ? sanitize_key($_GET['tab']) 
            : 'logo';
            ?>
        
        <div class="wrap clpl-admin-wrapper">
            <h1>
                <?php esc_html_e('Custom Login Page Logo Settings', 'custom-login-page-logo');?>
            </h1>
            <h2 class="nav-tab-wrapper">
                <a href="<?php 
                            echo esc_url(
                                admin_url('admin.php?page=clpl-logo-settings&tab=logo')
                            );
                        ?>"
                   class="nav-tab <?php echo ($active_tab == 'logo') ? 'nav-tab-active' : ''; ?> ">
                   Logo Settings
                </a>
                <a href="<?php 
                            echo esc_url(
                                admin_url('admin.php?page=clpl-logo-settings&tab=background')
                            );
                        ?>"
                   class="nav-tab <?php echo ($active_tab == 'background') ? 'nav-tab-active' : ''; ?>">
                   Background
                </a>
                <a href="<?php 
                            echo esc_url(
                                admin_url('admin.php?page=clpl-logo-settings&tab=form')
                            );
                        ?>"
                   class="nav-tab <?php echo ($active_tab == 'form') ? 'nav-tab-active' : ''; ?>">
                   Login Form
                </a>
                <a href="<?php 
                            echo esc_url(
                                admin_url('admin.php?page=clpl-logo-settings&tab=language')
                            );
                        ?>"
                   class="nav-tab <?php echo ($active_tab == 'language') ? 'nav-tab-active' : ''; ?>">
                   Language Switcher
                </a>
                <a href="<?php 
                            echo esc_url(
                                admin_url('admin.php?page=clpl-logo-settings&tab=advanced')
                            );
                        ?>"
                   class="nav-tab <?php echo ($active_tab == 'advanced') ? 'nav-tab-active' : '';?> ">
                   Advanced
                </a>
            </h2>
            <form method="post" action="options.php">
                <?php 
                    settings_fields('clpl_settings_group');
                    switch($active_tab) {
                        case 'background':
                            do_settings_sections('clpl_background_tab');
                            break;
                        case 'form':
                            do_settings_sections('clpl_form_tab');
                            break;
                        case 'language':
                            do_settings_sections('clpl_language_tab');
                            break;
                        case 'advanced':
                            do_settings_sections('clpl_advanced_tab');
                            break;
                        default: 
                            do_settings_sections('clpl_logo_tab');
                            break;
                    }
                    submit_button();
                ?>
            </form>
            <?php settings_errors(); ?>
        </div>  
        <?php
    }

    // ========== DISPLAYS - UPLOAD LOGO  ========== //
    function clpl_logo_field_callback() {
        
        $logo_url = clpl_get_option('logo_field');
        echo '<input type="url" name="clpl_settings[logo_field]" id="custom_login_logo" autocomplete="on" 
            placeholder="Enter Logo URL" title="' . esc_attr($logo_url) . '" 
            value="' . esc_url($logo_url) . '" />';
        echo '<button class="button button-secondary" id="upload_logo">' . esc_html__('Upload Logo', 'custom-login-page-logo') . '</button>';
        echo '<p class="description clpl_description">('.esc_html__('Upload image or enter a custom URL with http or https', 'custom-login-page-logo').')</p>';
        
        if (!empty($logo_url)) {
            echo '<div id="clpl_logo_container">
                    <img src="' . esc_url($logo_url) . '" 
                    title="' . esc_attr(basename($logo_url)) . '" alt = "Logo image" />
                  </div>';
        }
    }

    // ========== DISPLAYS - LOGO WIDTH ========== //
    function clpl_logo_width_callback() {

        $width = clpl_get_option('logo_width');
        echo '<input type="number" name="clpl_settings[logo_width]" id="clpl_logo_width" min="0" max="600" 
              placeholder="100" title = "Enter logo width" value="' . esc_attr($width) . '" />';
        echo '<p class="description clpl_description">('.esc_html__('Enter logo width', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS - LOGO WIDTH MEASUREMENT UNIT ========== //
    function clpl_logo_width_unit_callback() {
        
        $width_mmt = esc_attr(clpl_get_option('logo_width_unit'));
        echo '<select name="clpl_settings[logo_width_unit]" id="clpl_logo_width_unit" title = "Enter logo width measurement unit">
                <option value="px" ' . selected($width_mmt, 'px', false) . '>Pixels (px)</option>
                <option value="%" ' . selected($width_mmt, '%', false) . '>Percentage (%)</option>
              </select>';
        echo '<p class="description clpl_description">('.esc_html__('Choose the measurement unit for logo width', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS - LOGO HEIGHT ========== //
    function clpl_logo_height_callback() {

        $height = clpl_get_option('logo_height');
        echo '<input type="number" name="clpl_settings[logo_height]" id="clpl_logo_height" min="0" max="600" 
              placeholder="100" title = "Enter logo height" value="' . esc_attr($height) . '" />';
        echo '<p class="description clpl_description">('.esc_html__('Enter logo height', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO HEIGHT MEASUREMENT UNIT ========== //
    function clpl_logo_height_unit_callback() {

        $height_mmt = esc_attr(clpl_get_option('logo_height_unit'));
        echo '<select name="clpl_settings[logo_height_unit]" id="clpl_logo_height_unit" title = "Enter logo height measurement unit">
                <option value="px" ' . selected($height_mmt, 'px', false) . '>Pixels (px)</option>
                <option value="%" ' . selected($height_mmt, '%', false) . '>Percentage (%)</option>
              </select>';
        echo '<p class="description clpl_description">('.esc_html__('Choose the measurement unit for logo height', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO REDIRECT URL ========== //
    function clpl_logo_redirect_url_callback() {

        $logo_redirect_url = esc_url(clpl_get_option('logo_redirect_url'));
        if(empty($logo_redirect_url)){
            $logo_redirect_url = site_url(); 
        } 
        echo '<input type="url" name="clpl_settings[logo_redirect_url]" id="clpl_logo_redirect_url" autocomplete="on"
              placeholder="Enter Logo Redirect URL" title="' . esc_attr($logo_redirect_url) . '" 
              value="' . esc_attr($logo_redirect_url) . '" />';
        echo'<p class="description clpl_description">('.esc_html__('Example: https://mydomain.com or http://mydomain.com', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO SHADOW ========== //
    function clpl_logo_shadow_callback() {

        $logo_shadow = esc_attr(clpl_get_option('logo_shadow'));
        echo'<input type="hidden" name="clpl_settings[logo_shadow]" value="0" />';
        echo '<input type="checkbox" name="clpl_settings[logo_shadow]" id="clpl_logo_shadow" title="show shadow" 
              value="1" ' . checked($logo_shadow, '1', false) . ' />';
        echo '<label for="clpl_logo_shadow">'.esc_html__('Yes', 'custom-login-page-logo').'</label>';
        echo '<p class="description clpl_description">('.esc_html__('Select if you want logo shadow', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO BORDER-RADIUS ========== //
    function clpl_logo_border_radius_callback() {

        $logo_border_radius = clpl_get_option('logo_border_radius');
        echo '<input type="number" name="clpl_settings[logo_border_radius]" id="clpl_logo_border_radius" title="Enter logo border-radius" max = "250" min = "0" placeholder = "5"
              value="' . esc_attr($logo_border_radius) . '" />';
        echo '<p class="description clpl_description">('.esc_html__('Enter logo border radius in "px"', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LOGO PADDING ========== //
    function clpl_logo_padding_callback() {

        $logo_padding = clpl_get_option('logo_padding');
        echo '<input type="number" name="clpl_settings[logo_padding]" id="clpl_logo_padding" title="Enter logo padding" max = "100" min = "0" placeholder = "5"
              value="' . esc_attr($logo_padding) . '" />';
        echo '<p class="description clpl_description">('.esc_html__('Enter logo padding in "px"', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS BACKGROUND COLOR ========== //
    function clpl_background_color_callback(){

        $background_color = clpl_get_option('background_color');
        echo '<input type="text" name="clpl_settings[background_color]" id="clpl_background_color" 
        class="clpl-color-field" title="Select background color" 
        value="' . esc_attr($background_color) . '" data-default-color="#FFFFFF" />';
        echo '<p class="description clpl_description">('.esc_html__('Select background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS BACKGROUND IMAGE ========== //
    function clpl_background_image_callback(){

        $background_image = clpl_get_option('background_img');
        echo '<input type="url" name="clpl_settings[background_img]" id="clpl_background_image" 
         autocomplete="on" 
         placeholder="Enter background image URL" title="'.esc_attr($background_image).'" 
         value="' . esc_url($background_image) . '"  />';
        echo '<button class="button button-secondary" id="upload_bg_img">' . esc_html__('Upload background image', 'custom-login-page-logo') . '</button>';
        echo '<p class="description clpl_description">('.esc_html__('(Upload image or enter a custom URL with http or https)', 'custom-login-page-logo').')</p>';
        
        if (!empty($background_image)) {
            echo '<div id="clpl_bg_img_container">
                    <img src="' . esc_url($background_image) . '" 
                    title="' . esc_attr(basename($background_image)) . '" alt = "Background image" />
                  </div>';
        }
    }

    // ========== DISPLAYS BACKGROUND IMAGE SIZE ========== //
    function clpl_background_image_size_callback(){

        $background_image_size = clpl_get_option('background_img_size');?>
        <select name="clpl_settings[background_img_size]" id="clpl_background_image_size" 
        title="Select background image size" >
            <option value="cover" <?php selected($background_image_size, 'cover'); ?>>
                <?php esc_html_e('Cover', 'custom-login-page-logo'); ?>
            </option>
            <option value="contain" <?php selected($background_image_size, 'contain'); ?>>
                <?php esc_html_e('Contain', 'custom-login-page-logo'); ?>
            </option>
            <option value="auto" <?php selected($background_image_size, 'auto'); ?>>
                <?php esc_html_e('Auto', 'custom-login-page-logo'); ?>
            </option>
        </select>
        <p class="description clpl_description">
            (<?php esc_html_e('Select background image size', 'custom-login-page-logo');?>)</p>
            <?php
    }

    // ========== DISPLAYS BACKGROUND IMAGE POSITION ========== //
    function clpl_background_image_position_callback(){

        $background_image_position = clpl_get_option('background_img_position');?>
        <select name="clpl_settings[background_img_position]" id="clpl_background_image_position" 
        title="Select background image position" >
            <option value="center center" <?php selected($background_image_position, 'center center'); ?>>
                <?php esc_html_e('center center', 'custom-login-page-logo'); ?>
            </option>
            <option value="top center" <?php selected($background_image_position, 'top center'); ?>>
                <?php esc_html_e('top center', 'custom-login-page-logo'); ?>
            </option>
            <option value="bottom center" <?php selected($background_image_position, 'bottom center'); ?>>
                <?php esc_html_e('bottom center', 'custom-login-page-logo'); ?>
            </option>
            <option value="left center" <?php selected($background_image_position, 'left center'); ?>>
                <?php esc_html_e('left center', 'custom-login-page-logo'); ?>
            </option>
            <option value="right center" <?php selected($background_image_position, 'right center'); ?>>
                <?php esc_html_e('right center', 'custom-login-page-logo'); ?>
            </option>
        </select>
        <p class="description clpl_description">
            (<?php esc_html_e('Select background image position', 'custom-login-page-logo');?>)</p>
            <?php
    }

    // ========== DISPLAYS BACKGROUND IMAGE REPEAT ========== //
    function clpl_background_image_repeat_callback(){

        $background_image_repeat = clpl_get_option('background_img_repeat');?>
        <select name="clpl_settings[background_img_repeat]" id="clpl_background_image_repeat" 
        title="Select background image repeat" >
            <option value="no-repeat" <?php selected($background_image_repeat, 'no-repeat'); ?>>
                <?php esc_html_e('no-repeat', 'custom-login-page-logo'); ?>
            </option>
            <option value="repeat" <?php selected($background_image_repeat, 'repeat'); ?>>
                <?php esc_html_e('repeat', 'custom-login-page-logo'); ?>
            </option>
            <option value="repeat-x" <?php selected($background_image_repeat, 'repeat-x'); ?>>
                <?php esc_html_e('repeat-x', 'custom-login-page-logo'); ?>
            </option>
            <option value="repeat-y" <?php selected($background_image_repeat, 'repeat-y'); ?>>
                <?php esc_html_e('repeat-y', 'custom-login-page-logo'); ?>
            </option>
        </select>
        <p class="description clpl_description">
            (<?php esc_html_e('Select background image repeat', 'custom-login-page-logo');?>)</p>
            <?php
    }

    // ========== DISPLAYS BACKGROUND OVERLAY COLOR ========== //
    function clpl_background_overlay_color_callback(){

        $background_overlay_color = clpl_get_option('background_overlay_color');
        echo '<input type="text" name="clpl_settings[background_overlay_color]" id="clpl_background_overlay_color" class="clpl-color-field" data-alpha-enabled="true"
        title="Select background overlay color" 
        value="' . esc_attr($background_overlay_color) . '" data-default-color="rgba(0,0,0,0)" />';
        echo '<p class="description clpl_description">('.esc_html__('Select background overlay color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM BACKGROUND COLOR ========== //
    function clpl_form_background_color_callback(){

        $form_bg_color = clpl_get_option('form_bg_color');
        echo '<input type="text" name="clpl_settings[form_bg_color]" id="clpl_form_bg_color" 
        class="clpl-color-field" title="Select form background color" 
        value="' . esc_attr($form_bg_color) . '" data-default-color="#FFFFFF" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM TEXTFIELD BORDER COLOR ========== //
    function clpl_form_txtfield_bg_color_callback(){

        $form_txtfield_bg_color = clpl_get_option('form_txtfield_bg_color');
        echo '<input type="text" name="clpl_settings[form_txtfield_bg_color]" id="clpl_form_txtfield_bg_color" 
        class="clpl-color-field" title="Select form text field background color" 
        value="' . esc_attr($form_txtfield_bg_color) . '" data-default-color="#FFFFFF" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form Input field background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM BUTTON BACKGROUND COLOR ========== //
    function clpl_form_btn_bg_color_callback(){

        $form_btn_bg_color = clpl_get_option('form_btn_bg_color');
        echo '<input type="text" name="clpl_settings[form_btn_bg_color]" id="clpl_form_btn_bg_color" 
        class="clpl-color-field" title="Select form button background color" 
        value="' . esc_attr($form_btn_bg_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form button background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM EYE ICON COLOR ========== //
    function clpl_form_eye_icon_color_callback(){

        $form_eye_icon_color = clpl_get_option('form_eye_icon_color');
        echo '<input type="text" name="clpl_settings[form_eye_icon_color]" id="clpl_form_eye_icon_color" 
        class="clpl-color-field" title="Select form eye icon color" 
        value="' . esc_attr($form_eye_icon_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form eye icon color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM LABEL COLOR ========== //
    function clpl_form_label_color_callback(){

        $form_label_color = clpl_get_option('form_label_color');
        echo '<input type="text" name="clpl_settings[form_label_color]" id="clpl_form_label_color" 
        class="clpl-color-field" title="Select form label color" 
        value="' . esc_attr($form_label_color) . '" data-default-color="#3c434a" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form label color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM BUTON TEXT COLOR ========== //
    function clpl_form_btn_txt_color_callback(){

        $form_btn_txt_color = clpl_get_option('form_btn_txt_color');
        echo '<input type="text" name="clpl_settings[form_btn_txt_color]" id="clpl_form_btn_txt_color" 
        class="clpl-color-field" title="Select form button text color" 
        value="' . esc_attr($form_btn_txt_color) . '" data-default-color="#FFFFFF" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form button text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM BUTON BORDER COLOR ========== //
    function clpl_form_btn_border_color_callback(){

        $form_btn_border_color = clpl_get_option('form_btn_border_color');
        echo '<input type="text" name="clpl_settings[form_btn_border_color]" id="clpl_form_btn_border_color" 
        class="clpl-color-field" title="Select form button border color" 
        value="' . esc_attr($form_btn_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form button border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM TEXTFIELD BORDER COLOR ========== //
    function clpl_form_txtfield_border_color_callback(){

        $form_txtfield_border_color = clpl_get_option('form_txtfield_border_color');
        echo '<input type="text" name="clpl_settings[form_txtfield_border_color]" id="clpl_form_txtfield_border_color" 
        class="clpl-color-field" title="Select form textfield border color" 
        value="' . esc_attr($form_txtfield_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form textfield border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM REMEMBER ME (CHECK MARK) COLOR ========== //
    function clpl_form_remember_checkmark_color_callback(){

        $form_remember_checkmark_color = clpl_get_option('form_remember_checkmark_color');
        echo '<input type="text" name="clpl_settings[form_remember_checkmark_color]" id="clpl_form_remember_checkmark_color" 
        class="clpl-color-field" title="Select form checkmark color" 
        value="' . esc_attr($form_remember_checkmark_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form remember checkmark color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM PASSWORD RESET COLOR ========== //
    function clpl_form_pwd_reset_color_callback(){

        $form_pwd_reset_color = clpl_get_option('form_pwd_reset_color');
        echo '<input type="text" name="clpl_settings[form_pwd_reset_color]" id="clpl_form_pwd_reset_color" 
        class="clpl-color-field" title="Select form password reset color" 
        value="' . esc_attr($form_pwd_reset_color) . '" data-default-color="#50575e" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form password reset color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM GO TO SITE COLOR ========== //
    function clpl_form_go_to_site_color_callback(){

        $form_go_to_site_color = clpl_get_option('form_go_to_site_color');
        echo '<input type="text" name="clpl_settings[form_go_to_site_color]" id="clpl_form_go_to_site_color" 
        class="clpl-color-field" title="Select form go to site color" 
        value="' . esc_attr($form_go_to_site_color) . '" data-default-color="#50575e" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form go to site color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS FORM TEXTFIELD BORDER COLOR ========== //
    function clpl_form_txtfield_txt_color_callback(){

        $form_txtfield_txt_color = clpl_get_option('form_txtfield_txt_color');
        echo '<input type="text" name="clpl_settings[form_txtfield_txt_color]" id="clpl_form_txtfield_txt_color" 
        class="clpl-color-field" title="Select form text field text color" 
        value="' . esc_attr($form_txtfield_txt_color) . '" data-default-color="#2c3338" />';
        echo '<p class="description clpl_description">('.esc_html__('Select form Input field text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BG COLOR ========== //

    function clpl_lang_switch_select_bg_color_callback(){

        $lang_switch_select_bg_color = clpl_get_option('lang_switch_select_bg_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_bg_color]" id="clpl_lang_switch_select_bg_color" 
        class="clpl-color-field" title="Select language switcher background color" 
        value="' . esc_attr($lang_switch_select_bg_color) . '" data-default-color="#FFFFFF" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER TEXT COLOR ========== //

    function clpl_lang_switch_select_txt_color_callback(){

        $lang_switch_select_txt_color = clpl_get_option('lang_switch_select_txt_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_txt_color]" id="clpl_lang_switch_select_txt_color" 
        class="clpl-color-field" title="Select language switcher text color" 
        value="' . esc_attr($lang_switch_select_txt_color) . '" data-default-color="#2c3338" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT BORDER COLOR ========== //

    function clpl_lang_switch_select_border_color_callback(){
        $lang_switch_select_border_color = clpl_get_option('lang_switch_select_border_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_border_color]" id="clpl_lang_switch_select_border_color" 
        class="clpl-color-field" title="Select language switcher select border color" 
        value="' . esc_attr($lang_switch_select_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT ARROW COLOR ========== //

    function clpl_lang_switch_select_arrow_color_callback(){
        $lang_switch_select_arrow_color = clpl_get_option('lang_switch_select_arrow_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_arrow_color]" id="clpl_lang_switch_select_arrow_color" 
        class="clpl-color-field" title="Select language switcher Arrow color" 
        value="' . esc_attr($lang_switch_select_arrow_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher arrow color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT HOVER BG COLOR ========== //

    function clpl_lang_switch_select_hover_bg_color_callback(){
        $lang_switch_select_hover_bg_color = clpl_get_option('lang_switch_select_hover_bg_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_hover_bg_color]" id="clpl_lang_switch_select_hover_bg_color" 
        class="clpl-color-field" title="Select language switcher select hover bg color" 
        value="' . esc_attr($lang_switch_select_hover_bg_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select hover background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT HOVER TEXT COLOR ========== //

    function clpl_lang_switch_select_hover_txt_color_callback(){
        $lang_switch_select_hover_txt_color = clpl_get_option('lang_switch_select_hover_txt_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_hover_txt_color]" id="clpl_lang_switch_select_hover_txt_color" 
        class="clpl-color-field" title="Select language switcher select hover text color" 
        value="' . esc_attr($lang_switch_select_hover_txt_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select hover text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT HOVER BORDER COLOR ========== //

    function clpl_lang_switch_select_hover_border_color_callback(){
        $lang_switch_select_hover_border_color = clpl_get_option('lang_switch_select_hover_border_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_hover_border_color]" id="clpl_lang_switch_select_hover_border_color" 
        class="clpl-color-field" title="Select language switcher select hover border color" 
        value="' . esc_attr($lang_switch_select_hover_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select hover border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT FOCUS BG COLOR ========== //

    function clpl_lang_switch_select_focus_bg_color_callback(){
        $lang_switch_select_focus_bg_color = clpl_get_option('lang_switch_select_focus_bg_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_focus_bg_color]" id="clpl_lang_switch_select_focus_bg_color" 
        class="clpl-color-field" title="Select language switcher select focus background color" 
        value="' . esc_attr($lang_switch_select_focus_bg_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select focus background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT FOCUS TEXT COLOR ========== //

    function clpl_lang_switch_select_focus_txt_color_callback(){
        $lang_switch_select_focus_txt_color = clpl_get_option('lang_switch_select_focus_txt_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_focus_txt_color]" id="clpl_lang_switch_select_focus_txt_color" 
        class="clpl-color-field" title="Select language switcher select focus text color" 
        value="' . esc_attr($lang_switch_select_focus_txt_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select focus text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER SELECT FOCUS BORDER COLOR ========== //

    function clpl_lang_switch_select_focus_border_color_callback(){
        $lang_switch_select_focus_border_color = clpl_get_option('lang_switch_select_focus_border_color');
        echo '<input type="text" name="clpl_settings[lang_switch_select_focus_border_color]" id="clpl_lang_switch_select_focus_border_color" 
        class="clpl-color-field" title="Select language switcher select focus border color" 
        value="' . esc_attr($lang_switch_select_focus_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher select focus border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BUTTON BG COLOR ========== //

    function clpl_lang_switch_btn_bg_color_callback(){

        $lang_switch_btn_bg_color = clpl_get_option('lang_switch_btn_bg_color');
        echo '<input type="text" name="clpl_settings[lang_switch_btn_bg_color]" id="clpl_lang_switch_btn_bg_color" 
        class="clpl-color-field" title="Select language switcher button background color" 
        value="' . esc_attr($lang_switch_btn_bg_color) . '" data-default-color="#FFFFFF" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher button background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BUTTON TEXT COLOR ========== //

    function clpl_lang_switch_btn_txt_color_callback(){

        $lang_switch_btn_txt_color = clpl_get_option('lang_switch_btn_txt_color');
        echo '<input type="text" name="clpl_settings[lang_switch_btn_txt_color]" id="clpl_lang_switch_btn_txt_color" 
        class="clpl-color-field" title="Select language switcher button text color" 
        value="' . esc_attr($lang_switch_btn_txt_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher button text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BUTTON BORDER COLOR ========== //

    function clpl_lang_switch_btn_border_color_callback(){
        $lang_switch_btn_border_color = clpl_get_option('lang_switch_btn_border_color');
        echo '<input type="text" name="clpl_settings[lang_switch_btn_border_color]" id="clpl_lang_switch_btn_border_color" 
        class="clpl-color-field" title="Select language switcher button border color" 
        value="' . esc_attr($lang_switch_btn_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher button border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BUTTON HOVER BG COLOR ========== //

    function clpl_lang_switch_btn_hover_bg_color_callback(){
        $lang_switch_btn_hover_bg_color = clpl_get_option('lang_switch_btn_hover_bg_color');
        echo '<input type="text" name="clpl_settings[lang_switch_btn_hover_bg_color]" id="clpl_lang_switch_btn_hover_bg_color" 
        class="clpl-color-field" title="Select language switcher button hover background color" 
        value="' . esc_attr($lang_switch_btn_hover_bg_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher button hover background color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BUTTON HOVER TEXT COLOR ========== //

    function clpl_lang_switch_btn_hover_txt_color_callback(){
        $lang_switch_btn_hover_txt_color = clpl_get_option('lang_switch_btn_hover_txt_color');
        echo '<input type="text" name="clpl_settings[lang_switch_btn_hover_txt_color]" id="clpl_lang_switch_btn_hover_txt_color" 
        class="clpl-color-field" title="Select language switcher button hover text color" 
        value="' . esc_attr($lang_switch_btn_hover_txt_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher button hover text color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS LANGUAGE SWITCHER BUTTON HOVER BORDER COLOR ========== //

    function clpl_lang_switch_btn_hover_border_color_callback(){
        $lang_switch_btn_hover_border_color = clpl_get_option('lang_switch_btn_hover_border_color');
        echo '<input type="text" name="clpl_settings[lang_switch_btn_hover_border_color]" id="clpl_lang_switch_btn_hover_border_color" 
        class="clpl-color-field" title="Select language switcher button hover border color" 
        value="' . esc_attr($lang_switch_btn_hover_border_color) . '" data-default-color="#2271b1" />';
        echo '<p class="description clpl_description">('.esc_html__('Select language switcher button hover border color', 'custom-login-page-logo').')</p>';
    }

    // ========== DISPLAYS ADVANCED ========== //
    function clpl_advanced_callback(){

    }
   
    // DEFAULT VALUES OF THE OPTIONS OF THE PLUGIN
    function clpl_default_options_with_values(){
        return[
            // Logo
            'clpl_logo_field'           => '',
            'clpl_logo_width'           => 100,
            'clpl_logo_width_unit'      => 'px',
            'clpl_logo_height'          => 100,
            'clpl_logo_height_unit'     => 'px',
            'clpl_logo_redirect_url'    => '',
            'clpl_logo_shadow'          => '',
            'clpl_logo_border_radius'   => 0,
            'clpl_logo_padding'         => 10,

            // Background
            'clpl_background_color'     => 'rgba(255, 255, 255, 1)',

            // Review System
            'clpl_activation_time'      => time(),
            'clpl_review_done'          => 0,
            'clpl_review_remind_time'   => 0,

        ];
    }

    // CREATES OPTIONS WHEN ACTIVATION ( NEW INSTALLS )
    function clpl_plugin_activation(){
        if ( get_option('clpl_settings') === false ) {
            add_option(
                'clpl_settings',
                clpl_default_options_with_values_new()
            );
        }
    } 

    register_activation_hook(__FILE__, 'clpl_plugin_activation');

    // ========== ADDING SETTINGS ========== //
    function clpl_logo_settings_init() {

    	// ADDING SETTING'S SECTIONS //
        add_settings_section(
            'clpl_logo_section',
            __('Logo Settings', 'custom-login-page-logo'),
            '__return_false',
            'clpl_logo_tab'
        );
        add_settings_section(
            'clpl_background_section',
            __('Background Settings', 'custom-login-page-logo'),
            '__return_false',
            'clpl_background_tab'
        );
        add_settings_section(
            'clpl_form_section',
            __('Form Settings', 'custom-login-page-logo'),
            '__return_false',
            'clpl_form_tab'
        );
        add_settings_section(
            'clpl_language_section',
            __('Language Settings', 'custom-login-page-logo'),
            '__return_false',
            'clpl_language_tab'
        );
        add_settings_section(
            'clpl_advanced_section',
            __('Advanced Settings', 'custom-login-page-logo'),
            '__return_false',
            'clpl_advanced_tab'
        );

        // ADDING SETTING'S FIELDS //

        add_settings_field(
            'clpl_logo_field',
            __('Logo URL', 'custom-login-page-logo'), // CUSTOM LOGO URL
            'clpl_logo_field_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_width',
            __('Logo Width', 'custom-login-page-logo'), // CUSTOM LOGO WIDTH
            'clpl_logo_width_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_width_unit',
             __('Logo Width Unit', 'custom-login-page-logo'), // CUSTOM LOGO WIDTH MEASUREMENT UNIT
            'clpl_logo_width_unit_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_height',
            __('Logo Height', 'custom-login-page-logo'), // CUSTOM LOGO HEIGHT
            'clpl_logo_height_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_height_unit',
             __('Logo Height Unit', 'custom-login-page-logo'), // CUSTOM LOGO HEIGHT MEASUREMENT UNIT
            'clpl_logo_height_unit_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_redirect_url',
             __('Logo Redirect URL', 'custom-login-page-logo'), // CUSTOM LOGO REDIRECT URL
            'clpl_logo_redirect_url_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_shadow',
             __('Logo Shadow', 'custom-login-page-logo'), // CUSTOM LOGO SHADOW
            'clpl_logo_shadow_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_border_radius',
             __('Logo Border Radius', 'custom-login-page-logo'), // CUSTOM LOGO BORDER-RADIUS
            'clpl_logo_border_radius_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_padding',
             __('Logo Padding', 'custom-login-page-logo'), // CUSTOM LOGO PADDING
            'clpl_logo_padding_callback',
            'clpl_logo_tab',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_background_color',
             __('Background Color', 'custom-login-page-logo'), // BACKGROUND COLOR
            'clpl_background_color_callback',
            'clpl_background_tab',
            'clpl_background_section'
        );
        add_settings_field(
            'clpl_background_image',
             __('Background Image', 'custom-login-page-logo'), // BACKGROUND IMAGE
            'clpl_background_image_callback',
            'clpl_background_tab',
            'clpl_background_section'
        );
        add_settings_field(
            'clpl_background_image_size',
             __('Background Image Size', 'custom-login-page-logo'), // BACKGROUND IMAGE SIZE
            'clpl_background_image_size_callback',
            'clpl_background_tab',
            'clpl_background_section'
        );
        add_settings_field(
            'clpl_background_image_position',
             __('Background Image Position', 'custom-login-page-logo'), // BACKGROUND IMAGE POSITION
            'clpl_background_image_position_callback',
            'clpl_background_tab',
            'clpl_background_section'
        );
        add_settings_field(
            'clpl_background_image_repeat',
             __('Background Image Repeat', 'custom-login-page-logo'), // BACKGROUND IMAGE REPEAT
            'clpl_background_image_repeat_callback',
            'clpl_background_tab',
            'clpl_background_section'
        );
        add_settings_field(
            'clpl_background_overlay_color',
             __('Background Overlay Color', 'custom-login-page-logo'), // BACKGROUND OVERLAY COLOR
            'clpl_background_overlay_color_callback',
            'clpl_background_tab',
            'clpl_background_section'
        );

        // ========== FORM SETTINGS FIELDS ========== //
        
        add_settings_field(
            'clpl_form_background',
             __('Form Background Color', 'custom-login-page-logo'), // FORM BACKGROUND
            'clpl_form_background_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_btn_background',
             __('Form Button Color', 'custom-login-page-logo'), // FORM BUTTON BACKGROUND
            'clpl_form_btn_bg_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_eye_icon_color',
             __('Form Eye Icon Color', 'custom-login-page-logo'), // FORM EYE ICON COLOR
            'clpl_form_eye_icon_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_label_color',
             __('Form Label Color', 'custom-login-page-logo'), // FORM LABEL COLOR
            'clpl_form_label_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_btn_txt_color',
             __('Form Button Text Color', 'custom-login-page-logo'), // FORM BUTTON TEXT COLOR
            'clpl_form_btn_txt_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_btn_border_color',
             __('Form Button Border Color', 'custom-login-page-logo'), // FORM BUTTON TEXT COLOR
            'clpl_form_btn_border_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_txtfield_border_color',
             __('Form Inputfield Border Color', 'custom-login-page-logo'), // FORM TEXTFIELD BORDER COLOR
            'clpl_form_txtfield_border_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_txtfield_bg_color',
             __('Form Input field Background Color', 'custom-login-page-logo'), // FORM TEXTFIELD BORDER COLOR
            'clpl_form_txtfield_bg_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_txtfield_txt_color',
             __('Form Input field Text Color', 'custom-login-page-logo'), // FORM TEXTFIELD BORDER COLOR
            'clpl_form_txtfield_txt_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_remember_checkmark_color',
             __('Form Remember Checkmark Color', 'custom-login-page-logo'), // FORM REMEMBER CHECKMARK COLOR
            'clpl_form_remember_checkmark_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_pwd_reset_color',
             __('Form Password Reset Color', 'custom-login-page-logo'), // FORM PASSWORD RESET COLOR
            'clpl_form_pwd_reset_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );
        add_settings_field(
            'clpl_form_go_to_site_color',
             __('Form Go to Site Color', 'custom-login-page-logo'), // FORM GO TO SITE COLOR
            'clpl_form_go_to_site_color_callback',
            'clpl_form_tab',
            'clpl_form_section'
        );

        // ========== LANGUAGE SWITCHER SETTINGS FIELDS ========== //

        add_settings_field(
            'clpl_lang_switch_select_bg_color',
             __('Language Switcher Background color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BG COLOR
            'clpl_lang_switch_select_bg_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_txt_color',
             __('Language Switcher Text color', 'custom-login-page-logo'), // LANGUAGE SWITCHER TEXT COLOR
            'clpl_lang_switch_select_txt_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_border_color',
             __('Language Switcher Border color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BORDER COLOR
            'clpl_lang_switch_select_border_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_drop_down_color',
             __('Drop Down Arrow color', 'custom-login-page-logo'), // LANGUAGE SWITCHER DROP DOWN COLOR
            'clpl_lang_switch_select_arrow_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_hover_bg_color',
             __('Language Switcher Hover Background Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER HOVER BG COLOR
            'clpl_lang_switch_select_hover_bg_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_hover_txt_color',
             __('Language Switcher Hover Text Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER HOVER TEXT COLOR
            'clpl_lang_switch_select_hover_txt_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_hover_border_color',
             __('Language Switcher Hover Border Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER HOVER BORDER COLOR
            'clpl_lang_switch_select_hover_border_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_focus_bg_color',
             __('Language Switcher Focus Background Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER FOCUS BG COLOR
            'clpl_lang_switch_select_focus_bg_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_focus_txt_color',
             __('Language Switcher Focus Text Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER FOCUS TEXT COLOR
            'clpl_lang_switch_select_focus_txt_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_select_focus_border_color',
             __('Language Switcher Focus Border Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER FOCUS BORDER COLOR
            'clpl_lang_switch_select_focus_border_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_btn_bg_color',
             __('Button Background color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BUTTON BG COLOR
            'clpl_lang_switch_btn_bg_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_btn_txt_color',
             __('Button Text color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BUTTON TEXT COLOR
            'clpl_lang_switch_btn_txt_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_btn_border_color',
             __('Button Border color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BUTTON BORDER COLOR
            'clpl_lang_switch_btn_border_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_btn_hover_bg_color',
             __('Button Hover Background Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BUTTON BG COLOR
            'clpl_lang_switch_btn_hover_bg_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_btn_hover_txt_color',
             __('Button Hover Text Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BUTTON HOVER TEXT COLOR
            'clpl_lang_switch_btn_hover_txt_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );
        add_settings_field(
            'clpl_lang_switch_btn_hover_border_color',
             __('Button Hover Border Color', 'custom-login-page-logo'), // LANGUAGE SWITCHER BUTTON HOVER BORDER COLOR
            'clpl_lang_switch_btn_hover_border_color_callback',
            'clpl_language_tab',
            'clpl_language_section'
        );

        // ========== ADVANCED SETTINGS FIELDS ========== //

        add_settings_field(
            'clpl_advanced',
             __('Coming soon...', 'custom-login-page-logo'), // ADVANCE
            'clpl_advanced_callback',
            'clpl_advanced_tab',
            'clpl_advanced_section'
        );

        // ========== REGISTER SETTINGS ========== //
        register_setting(
            'clpl_settings_group',
            'clpl_settings',
            array(
                'sanitize_callback' => 'clpl_sanitize_settings'
            )
        );

        // ========== SANITIZATIONS ========== //
        function clpl_sanitize_settings($input) {

            $defaults = clpl_default_options_with_values_new();
            $existing = get_option('clpl_settings', $defaults);

            // Prevent tab wipe issue
            $input = wp_parse_args($input, $existing);

            $allowed_units          = array('px', '%');
            $allowed_bg_img_size    = array('cover', 'contain', 'auto'); 
            $allowed_bg_img_pos     = array(
                'center center',
                'top center',
                'bottom center',
                'left center',
                'right center' 
            );
            $allowed_bg_img_repeat     = array(
                'no-repeat',
                'repeat',
                'repeat-x',
                'repeat-y'
            ); 

            $sanitized = array();

            // ========== LOGO ========== //

            $sanitized['logo_field']        = esc_url_raw($input['logo_field']);
            $sanitized['logo_width']        = intval($input['logo_width']);
            $sanitized['logo_height']       = intval($input['logo_height']);

            $sanitized['logo_width_unit']   = in_array(
                $input['logo_width_unit'],
                $allowed_units,
                true
            )
            ? $input['logo_width_unit'] : $defaults['logo_width_unit'];
            
            $sanitized['logo_height_unit']  = in_array(
                $input['logo_height_unit'],
                $allowed_units,
                true
            )
            ? $input['logo_height_unit'] : $defaults['logo_height_unit'];
            
            $sanitized['logo_redirect_url'] = esc_url_raw($input['logo_redirect_url']);
            $sanitized['logo_shadow']       = ( isset($input['logo_shadow']) && $input['logo_shadow'] == 1 ) ? 1 : 0;
            $sanitized['logo_border_radius']= intval($input['logo_border_radius']);
            $sanitized['logo_padding']      = intval($input['logo_padding']);

            // ========== BACKGROUND ========== //
            
            $sanitized['background_color']  = sanitize_hex_color($input['background_color'])
            ?: $defaults['background_color'];

            $sanitized['background_overlay_color']  = sanitize_text_field(
                $input['background_overlay_color']
            ) ?: $defaults['background_overlay_color'];

            $sanitized['background_img']    = esc_url_raw($input['background_img']);

            $sanitized['background_img_size']= in_array(
                $input['background_img_size'], 
                $allowed_bg_img_size,
                true
            )
            ? $input['background_img_size'] : $defaults['background_img_size'];

            $sanitized['background_img_position']= in_array(
                $input['background_img_position'],
                $allowed_bg_img_pos,
                true
            )
            ? $input['background_img_position'] : $defaults['background_img_position'];

            $sanitized['background_img_repeat']= in_array(
                $input['background_img_repeat'],
                $allowed_bg_img_repeat,
                true
            )
            ? $input['background_img_repeat'] : $defaults['background_img_repeat'];

            // ========== FORM ========== //
            
            $sanitized['form_bg_color']         = sanitize_hex_color(
                $input['form_bg_color']
            ) ?: $defaults['form_bg_color'];

            $sanitized['form_btn_bg_color']     = sanitize_hex_color(
                $input['form_btn_bg_color']
            ) ?: $defaults['form_btn_bg_color'];

            $sanitized['form_eye_icon_color']   = sanitize_hex_color(
                $input['form_eye_icon_color']
            ) ?: $defaults['form_eye_icon_color'];

            $sanitized['form_label_color']   = sanitize_hex_color(
                $input['form_label_color']
            ) ?: $defaults['form_label_color'];

            $sanitized['form_btn_txt_color']   = sanitize_hex_color(
                $input['form_btn_txt_color']
            ) ?: $defaults['form_btn_txt_color'];

            $sanitized['form_btn_border_color']   = sanitize_hex_color(
                $input['form_btn_border_color']
            ) ?: $defaults['form_btn_border_color'];

            $sanitized['form_txtfield_border_color']   = sanitize_hex_color(
                $input['form_txtfield_border_color']
            ) ?: $defaults['form_txtfield_border_color'];

            $sanitized['form_txtfield_bg_color']   = sanitize_hex_color(
                $input['form_txtfield_bg_color']
            ) ?: $defaults['form_txtfield_bg_color'];

            $sanitized['form_txtfield_txt_color']   = sanitize_hex_color(
                $input['form_txtfield_txt_color']
            ) ?: $defaults['form_txtfield_txt_color'];

            $sanitized['form_remember_checkmark_color']   = sanitize_hex_color(
                $input['form_remember_checkmark_color']
            ) ?: $defaults['form_remember_checkmark_color'];

            $sanitized['form_pwd_reset_color']   = sanitize_hex_color(
                $input['form_pwd_reset_color']
            ) ?: $defaults['form_pwd_reset_color'];

            $sanitized['form_go_to_site_color']   = sanitize_hex_color(
                $input['form_go_to_site_color']
            ) ?: $defaults['form_go_to_site_color'];

            // ========== LANGUAGE SWITCHER ========== //

            $sanitized['lang_switch_select_bg_color']   = sanitize_hex_color(
                $input['lang_switch_select_bg_color']
            ) ?: $defaults['lang_switch_select_bg_color'];

            $sanitized['lang_switch_select_txt_color']   = sanitize_hex_color(
                $input['lang_switch_select_txt_color']
            ) ?: $defaults['lang_switch_select_txt_color'];

            $sanitized['lang_switch_select_border_color']   = sanitize_hex_color(
                $input['lang_switch_select_border_color']
            ) ?: $defaults['lang_switch_select_border_color'];

            $sanitized['lang_switch_select_arrow_color']   = sanitize_hex_color(
                $input['lang_switch_select_arrow_color']
            ) ?: $defaults['lang_switch_select_arrow_color'];

            $sanitized['lang_switch_select_hover_bg_color']   = sanitize_hex_color(
                $input['lang_switch_select_hover_bg_color']
            ) ?: $defaults['lang_switch_select_hover_bg_color'];

            $sanitized['lang_switch_select_hover_txt_color']   = sanitize_hex_color(
                $input['lang_switch_select_hover_txt_color']
            ) ?: $defaults['lang_switch_select_hover_txt_color'];

            $sanitized['lang_switch_select_hover_border_color']   = sanitize_hex_color(
                $input['lang_switch_select_hover_border_color']
            ) ?: $defaults['lang_switch_select_hover_border_color'];

            $sanitized['lang_switch_select_focus_bg_color']   = sanitize_hex_color(
                $input['lang_switch_select_focus_bg_color']
            ) ?: $defaults['lang_switch_select_focus_bg_color'];

            $sanitized['lang_switch_select_focus_txt_color']   = sanitize_hex_color(
                $input['lang_switch_select_focus_txt_color']
            ) ?: $defaults['lang_switch_select_focus_txt_color'];

             $sanitized['lang_switch_select_focus_border_color']   = sanitize_hex_color(
                $input['lang_switch_select_focus_border_color']
            ) ?: $defaults['lang_switch_select_focus_border_color'];

            $sanitized['lang_switch_btn_bg_color']   = sanitize_hex_color(
                $input['lang_switch_btn_bg_color']
            ) ?: $defaults['lang_switch_btn_bg_color'];

            $sanitized['lang_switch_btn_txt_color']   = sanitize_hex_color(
                $input['lang_switch_btn_txt_color']
            ) ?: $defaults['lang_switch_btn_txt_color'];

            $sanitized['lang_switch_btn_border_color']   = sanitize_hex_color(
                $input['lang_switch_btn_border_color']
            ) ?: $defaults['lang_switch_btn_border_color'];

            $sanitized['lang_switch_btn_hover_bg_color']   = sanitize_hex_color(
                $input['lang_switch_btn_hover_bg_color']
            ) ?: $defaults['lang_switch_btn_hover_bg_color'];

            $sanitized['lang_switch_btn_hover_txt_color']   = sanitize_hex_color(
                $input['lang_switch_btn_hover_txt_color']
            ) ?: $defaults['lang_switch_btn_hover_txt_color'];

            $sanitized['lang_switch_btn_hover_border_color']   = sanitize_hex_color(
                $input['lang_switch_btn_hover_border_color']
            ) ?: $defaults['lang_switch_btn_hover_border_color'];

            // ========== REVIEW SYSTEM ========== //

            $sanitized['activation_time']   = intval($input['activation_time']);
            $sanitized['review_done']       = intval($input['review_done']);
            $sanitized['review_remind_time']= intval($input['review_remind_time']);

            return $sanitized;
        }

        // ========== MIGRATION LOGIC (Will be removed soon) ========== //
        function clpl_migrate_old_options() {

            if ( get_option('clpl_settings') !== false ) {
                return; // already migrated
            }
            $defaults = clpl_default_options_with_values_new();
            $new_settings = $defaults;

            // Map old keys to new keys
            $mapping = array(
                'clpl_logo_field'         => 'logo_field',
                'clpl_logo_width'         => 'logo_width',
                'clpl_logo_width_unit'    => 'logo_width_unit',
                'clpl_logo_height'        => 'logo_height',
                'clpl_logo_height_unit'   => 'logo_height_unit',
                'clpl_logo_redirect_url'  => 'logo_redirect_url',
                'clpl_logo_shadow'        => 'logo_shadow',
                'clpl_logo_border_radius' => 'logo_border_radius',
                'clpl_logo_padding'       => 'logo_padding',
                'clpl_background_color'   => 'background_color',
                'clpl_activation_time'    => 'activation_time',
                'clpl_review_done'        => 'review_done',
                'clpl_review_remind_time' => 'review_remind_time',
            );

            foreach ($mapping as $old_key => $new_key) {
                $old_value = get_option($old_key);
                if($old_value !== false){
                    $new_settings[$new_key] = $old_value;    
                }
            }
            add_option('clpl_settings', $new_settings);
        }
        add_action('admin_init', 'clpl_migrate_old_options');
        
    }

    add_action('admin_init', 'clpl_logo_settings_init');

    // ========== ADMIN NOTICE FOR REVIEW ========== //

    // SAVE PLUGIN ACTIVATION TIME
    function clpl_set_activation_time(){
        if(!get_option('clpl_activation_time')){
            update_option('clpl_activation_time', time());
        }
    } 
    register_activation_hook(__FILE__, 'clpl_set_activation_time');

    //add_action('admin_notices', 'clpl_review_admin_notice');

    // SHOW THE ADMIN NOTICE
    function clpl_review_admin_notice(){

        $one_day_in_seconds = 86400;
        $activation_time = get_option('clpl_activation_time');
        $review_done = get_option('clpl_review_done');
        $remind_time = get_option('clpl_review_remind_time');
        $review_url = "https://wordpress.org/support/plugin/custom-login-page-logo/reviews/";

        // if(!current_user_can('manage_options')){
        //     return;
        // }

        // // NOTICE IS VISIBALE ONLY AFTER 7 DAYS
        // if( !$activation_time || time() - $activation_time < 7*$one_day_in_seconds){
        //     return;
        // }

        // // IF REVIEW IS ALREADY DONE THEN STOP SHOWING NOTICE
        // if($review_done){
        //     return;
        // }

        // if($remind_time && time() < $remind_time){
        //     return;
        // }

        // CREATE NONCE
        $nonce = wp_create_nonce('clpl_review_action_nonce');

        // GENERATE SECURE URLS
        $remind_url = add_query_arg([
            'clpl_review_action' => 'remind',
            'clpl_nonce' => $nonce,
        ]);

        $done_url = add_query_arg([
            'clpl_review_action' => 'done',
            'clpl_nonce' => $nonce,
        ]);
?>

        <div class = "notice notice-info clpl-review-notice">
            <p><strong>Enjoy the plugin?</strong>
                if you find it helpful, please consider leaving us a &#x2606;&#x2606;&#x2606;&#x2606;&#x2606; review on wordpress.org.
            </p>
            <p>
                <a href = "<?php echo esc_url($review_url); ?>" target="_blank" class = "button-primary">Sure, I'll review</a>
                <a href = "<?php echo esc_url($remind_url); ?>" class = "button">Remind me later</a>
                <a href = "<?php echo esc_url($done_url); ?>" class = "button">Already did</a>
            </p>

        </div>
<?php    
    }

    // HANDLE REVIEW BUTTON ACTIONS
    add_action('admin_init', 'clpl_handle_review_action');

    function clpl_handle_review_action(){
        $one_day_in_seconds = 86400;
        if(!isset($_GET['clpl_review_action'])){
            return;
        }
        if ( ! isset($_GET['clpl_nonce']) ||
             ! wp_verify_nonce( sanitize_text_field(wp_unslash($_GET['clpl_nonce'])), 'clpl_review_action_nonce' ) ) {
            return; 
        }
        $action = sanitize_text_field(wp_unslash($_GET['clpl_review_action']));
        if($action == "done"){
            update_option('clpl_review_done', 1); // Hide admin notice forever
        }
        if($action == "remind"){
            update_option('clpl_review_remind_time', time()+7*$one_day_in_seconds); // Hide admin notice for 7 days
        }
        wp_safe_redirect(remove_query_arg('clpl_review_action'));
        exit;
    }
