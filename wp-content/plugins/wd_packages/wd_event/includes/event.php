<?php
global $post;
wp_nonce_field( 'wd_event_box', 'wd_event_box_nonce' );
?>

<label>Start Date:</label>
<input type="text" class="startdate" name="event_startdate" value="<?php echo get_post_meta($post->ID,'wd_event_startdate',true);?>"/><br/>

<label>Start Time:</label>
<input type="text" name="event_starttime" value="<?php echo get_post_meta($post->ID,'wd_event_starttime',true);?>"/><br/>

<label>End Date:</label>
<input type="text" class="enddate" name="event_enddate" value="<?php echo get_post_meta($post->ID,'wd_event_enddate',true);?>"/><br/>

<label>End Time:</label>
<input type="text" name="event_endtime" value="<?php echo get_post_meta($post->ID,'wd_event_endtime',true);?>"/><br/>

<label>Location:</label>
<input type="text" name="event_location" value="<?php echo get_post_meta($post->ID,'wd_event_location',true);?>"/><br/>

<label>Phone:</label>
<input type="text" name="event_phone" value="<?php echo get_post_meta($post->ID,'wd_event_phone',true);?>"/><br/>

<label>Email:</label>
<input type="text" name="event_email" value="<?php echo get_post_meta($post->ID,'wd_event_email',true);?>"/><br/>
<label>Link Register:</label>
<input type="text" name="event_link" value="<?php echo get_post_meta($post->ID,'wd_event_link',true);?>"/><br/>
<script>
	jQuery( function() {
		jQuery( ".startdate" ).datepicker({
  dateFormat: "yy-mm-dd"
} )
		jQuery( ".enddate" ).datepicker({
  dateFormat: "yy-mm-dd"
});
	} );
  </script>