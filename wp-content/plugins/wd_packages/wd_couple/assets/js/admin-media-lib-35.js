jQuery(document).ready(function($) {    
    var file_frame_bridal;
    $('#wd_bridal_media_lib').live('click', function( event ){
        var imgfield = $(this).attr('rel');
        event.preventDefault();
			 
        if ( file_frame_bridal ) {
            file_frame_bridal.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: 'Select an Image',
            multiple: false,
            priority:  20
        })];
			 
        file_frame_bridal = wp.media.frames.file_frame_bridal = wp.media({
            states: _states,
            button: {
                text: 'Insert URL'
            }
        });

        file_frame_bridal.on( 'select', function() {
            var attachment = file_frame_bridal.state().get('selection').first().toJSON();
            $('#'+imgfield).val(attachment.id);
            $('#wd_bridal_file_url_img').attr("src",attachment.url); 
        });
		 
        file_frame_bridal.open();
    });

    var file_frame_groom;
    $('#wd_groom_media_lib').live('click', function( event ){
        var imgfield = $(this).attr('rel');
        event.preventDefault();
             
        if ( file_frame_groom ) {
            file_frame_groom.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: 'Select an Image',
            multiple: false,
            priority:  20
        })];
             
        file_frame_groom = wp.media.frames.file_frame_groom = wp.media({
            states: _states,
            button: {
                text: 'Insert URL'
            }
        });

        file_frame_groom.on( 'select', function() {
            var attachment = file_frame_groom.state().get('selection').first().toJSON();
            $('#'+imgfield).val(attachment.id);
            $('#wd_groom_file_url_img').attr("src",attachment.url); 
        });
         
        file_frame_groom.open();
    });  

    jQuery( "#wd_bridal_date" ).datepicker(); 
    jQuery( "#wd_groom_date" ).datepicker();
    jQuery( "#wd_groom_wedding_day" ).datepicker(); 
     

    /*---------------------------------------------------------------------*/
    /*                               GALLERY IMAGE                         */
    /*---------------------------------------------------------------------*/

    var image_gallery_frame;
    var $image_gallery_ids = $('#image_gallery');
    var $gallery_images = $('#wd_couple_gallery_image ul.wd_gallery_images');
    jQuery('.add_gallery_images').on( 'click', 'a', function( event ) {

        var $el = $(this);

        var attachment_ids = $image_gallery_ids.val();

        event.preventDefault();

        // If the media frame already exists, reopen it.
        if ( image_gallery_frame ) {
            image_gallery_frame.open();
            return;
        }

        // Create the media frame.
        image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
            // Set the title of the modal.
            title: "Add Images to Gallery",
            button: {
                text: "Add to gallery",
            },
            multiple: true
        });

        // When an image is selected, run a callback.
        image_gallery_frame.on( 'select', function() {

            var selection = image_gallery_frame.state().get('selection');

            selection.map( function( attachment ) {

                attachment = attachment.toJSON();

                if ( attachment.id ) {
                    attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

                    $gallery_images.append('\
                        <li class="image attachment details" data-attachment_id="' + attachment.id + '">\
                            <div class="attachment-preview">\
                                <div class="thumbnail">\
                                    <img src="' + attachment.url + '" />\
                                </div>\
                               <a style="display: block;" href="#" class="delete check" title="Remove image"><div class="media-modal-icon"></div></a>\
                            </div>\
                        </li>'
                    );
                   
                }

            } );

            $image_gallery_ids.val( attachment_ids );
        });
        // Finally, open the modal.
        image_gallery_frame.open();
    });

    // Image ordering
    $gallery_images.sortable({
        items: 'li.image',
        cursor: 'move',
        scrollSensitivity:40,
        forcePlaceholderSize: true,
        forceHelperSize: false,
        helper: 'clone',
        opacity: 0.65,
        placeholder: 'eig-metabox-sortable-placeholder',
        start:function(event,ui){
            ui.item.css('background-color','#f6f6f6');
        },
        stop:function(event,ui){
            ui.item.removeAttr('style');
        },
        update: function(event, ui) {
            var attachment_ids = '';

            $('#wd_couple_gallery_image ul li.image').css('cursor','default').each(function() {
                var attachment_id = jQuery(this).attr( 'data-attachment_id' );
                attachment_ids = attachment_ids + attachment_id + ',';
            });

            $image_gallery_ids.val( attachment_ids );
        }
    });
    // Remove images
    $('#wd_couple_gallery_image').on( 'click', 'a.delete', function() {

        $(this).closest('li.image').remove();

        var attachment_ids = '';

        $('#wd_couple_gallery_image ul li.image').css('cursor','default').each(function() {
            var attachment_id = jQuery(this).attr( 'data-attachment_id' );
            attachment_ids = attachment_ids + attachment_id + ',';
        });

        $image_gallery_ids.val( attachment_ids );

        return false;
    } );
});
