<?php
	global $post;
	$image_gallery 	= get_post_meta( $post->ID, '_wd_couple_image_gallery', true );
	$attachments 	= array_filter( explode( ',', $image_gallery ) );
?>
<div class="select-layout area-config area-config1">
	<!-- Address -->
	<div id="wd_couple_gallery_image">
		<ul class="wd_gallery_images">
			<?php if ( $attachments ){ 
		        foreach ( $attachments as $attachment_id ) {
		            echo '<li class="image attachment details" data-attachment_id="' . $attachment_id . '"><div class="attachment-preview"><div class="thumbnail">
		                            ' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</div>
		                            <a style="display: block;" href="#" class="delete check" title="' . __( 'Remove image', 'easy-image-gallery' ) . '"><div class="media-modal-icon"></div></a>
		                           
		                        </div></li>';
		        }			
			} // End If ?>
		</ul>
		<input type="hidden" id="image_gallery" name="image_gallery" value="<?php echo esc_attr( $image_gallery ); ?>" />
		<div class="wd-button-gallery">
			<p class="add_gallery_images">
				<a href="#"><?php _e( 'Add gallery images', 'easy-image-gallery' ); ?></a>
			</p>
		</div>
	</div>	

	<div class="clear"></div>
	<input type="hidden" name="wd_couple_image_galley_data" class="change-layout" value="wd_couple_image_galley_data"/>	
</div>