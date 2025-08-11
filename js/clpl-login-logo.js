jQuery(document).ready(function ($) {

    // ===== ADD LOGO ON CLICK ON "UPLOAD LOGO" BUTTON =====//
    $('#upload_logo').on('click', function (e) {
        e.preventDefault();

        var customLogoUploader = wp.media({
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
});
