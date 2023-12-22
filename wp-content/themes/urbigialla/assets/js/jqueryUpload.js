jQuery(document).ready(function($){


    var custom_uploader;
    var elementImage;
    var targetElement;

    $('.addMediaMadiButton').click(function(e) {

        e.preventDefault();
        targetElement =  jQuery('#' + jQuery(this).attr('data-target'));

        if (jQuery('#' + jQuery(this).attr('data-target') + '_image').length){
             elementImage = jQuery('#' + jQuery(this).attr('data-target') + '_image');
        } else {
             elementImage = false;
        }
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title : 'Scegli un\'immagine o un documento da creare',
            button: {
                text: 'Usami!'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            targetElement.val(attachment.url);
            if (elementImage){
                elementImage.attr('src',attachment.url);

            }
        });
        //Open the uploader dialog
        custom_uploader.open();

    });


});