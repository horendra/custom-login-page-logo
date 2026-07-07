jQuery(document).ready(function ($) {

    var customLogoUploader;
    var customBGImgUploader;

    // ========== ADD LOGO ON CLICK ON "UPLOAD LOGO" BUTTON ========== //

    $('#upload_logo').on('click', function (e) {
        e.preventDefault();

        if (customLogoUploader) {
            customLogoUploader.open();
            return;
        }
        customLogoUploader = wp.media({
            title: clpl_Translations.choose_or_upload_logo,
            button: {
                text: clpl_Translations.use_this_logo
            },
            multiple: false
        });

        customLogoUploader.on('select', function () {
            var attachment = customLogoUploader.state().get('selection').first().toJSON();
            $('#custom_login_logo').val(attachment.url);
        });

        // ===== OPEN MEDIA UPLOADER =====//
        customLogoUploader.open();
    });

    // ========== ADD BACKGROUND IMAGE ON CLICK ON "UPLOAD BACKGROUND IMAGE" BUTTON ========== //

    $('#upload_bg_img').on('click', function (e) {
        e.preventDefault();

        if (customBGImgUploader) {
            customBGImgUploader.open();
            return;
        }
        customBGImgUploader = wp.media({
            title: clpl_Translations.choose_or_upload_background_image,
            button: {
                text: clpl_Translations.use_this_image
            },
            multiple: false
        });

        customBGImgUploader.on('select', function () {
            var attachment = customBGImgUploader.state().get('selection').first().toJSON();
            $('#clpl_background_image').val(attachment.url);
        });

        // ===== OPEN MEDIA UPLOADER =====//
        customBGImgUploader.open();
    });

    // ========== ADD COLOR PICKER ========== //
    $('#clpl_background_color, #clpl_background_overlay_color, #clpl_form_bg_color, #clpl_form_btn_bg_color, #clpl_form_eye_icon_color, #clpl_form_label_color, #clpl_form_btn_txt_color, #clpl_form_btn_border_color, #clpl_form_txtfield_border_color, #clpl_form_txtfield_bg_color, #clpl_form_txtfield_txt_color, #clpl_form_remember_checkmark_color, #clpl_form_pwd_reset_color, #clpl_form_go_to_site_color, #clpl_lang_switch_select_bg_color, #clpl_lang_switch_select_txt_color, #clpl_lang_switch_select_border_color, #clpl_lang_switch_select_arrow_color, #clpl_lang_switch_select_hover_bg_color, #clpl_lang_switch_select_hover_txt_color, #clpl_lang_switch_select_hover_border_color, #clpl_lang_switch_select_focus_bg_color, #clpl_lang_switch_select_focus_txt_color, #clpl_lang_switch_select_focus_border_color, #clpl_lang_switch_btn_bg_color, #clpl_lang_switch_btn_txt_color, #clpl_lang_switch_btn_border_color, #clpl_lang_switch_btn_hover_bg_color, #clpl_lang_switch_btn_hover_txt_color, #clpl_lang_switch_btn_hover_border_color').wpColorPicker({
        palettes: true,
        change: function(event, ui) {
            // Optional: do something on change
            
        }
    });
});
