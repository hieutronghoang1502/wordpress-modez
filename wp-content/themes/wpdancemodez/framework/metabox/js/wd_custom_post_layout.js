jQuery(document).ready(function($) {    
    var file_frame_bridal;
    $('#wd_breadcrumb_media_lib').live('click', function( event ){
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
            $('#'+imgfield).val(attachment.url);
            $('#wd_breadcrumb_url_img_id').val(attachment.id);
            $('#wd_bread_img_con_id').attr("src",attachment.url); 
        });
		 
        file_frame_bridal.open();
    });
});
