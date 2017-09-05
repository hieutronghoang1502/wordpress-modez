<?php
	global $post;
	$post_id 		= $post->ID;
	$_post_config 	= get_post_meta($post_id,'_tvlgiao_wpdance_custom_couple',true);
	$_default_post_config = array(
		/*Bridal*/
		'wd_bridal_name' 			=> '',
		'wd_bridal_file_url'		=> '',
		'wd_bridal_date'			=> '',
		'wd_bridal_employment'		=> '',
		'wd_bridal_address'			=> '',
		'wd_bridal_description'		=> '',
		'wd_bridal_father_name'		=> '',
		'wd_bridal_mother_name'		=> '',
		'wd_bridal_facebook'		=> '',
		'wd_bridal_twitter'			=> '',
		'wd_bridal_pinterest'		=> '',
		'wd_bridal_instagram'		=> '',
		/*Groom*/
		'wd_groom_name' 			=> '',
		'wd_groom_file_url'			=> '',
		'wd_groom_date'				=> '',
		'wd_groom_employment'		=> '',
		'wd_groom_address'			=> '',
		'wd_groom_description'		=> '',
		'wd_groom_father_name'		=> '',
		'wd_groom_mother_name'		=> '',
		'wd_groom_facebook'			=> '',
		'wd_groom_twitter'			=> '',
		'wd_groom_pinterest'		=> '',
		'wd_groom_instagram'		=> '',
		/*Information Weedding*/
		'wd_groom_wedding_day'		=> '',
		'wd_groom_wedding_location'	=> '',
		'wd_groom_wedding_des'		=> '',
	);
	if( strlen($_post_config) > 0 ){
		$_post_config = unserialize(base64_decode($_post_config));
		if( is_array($_post_config) && count($_post_config) > 0 ){
			foreach($_default_post_config as $key=>$value){
				$_post_config["{$key}"] 		= ( isset($_post_config["{$key}"]) 	&& strlen($_post_config["{$key}"]) > 0 ) ? $_post_config["{$key}"] : $_default_post_config["{$key}"];
			}
		}
	}else{
		$_post_config = $_default_post_config;
	}
?>
<div class="select-layout area-config area-config1">
	<!-- Address -->
	
	<div class="wd-content-bridal" style="width:48%; float:left">
		<h3 class="area-title"><?php esc_html_e('Bridal','wpdance'); ?></h3>
		<p>
			<label><?php esc_html_e('Name Bridal','wpdance');?> </label>
			<input type="text" name="wd_bridal_name" id="wd_bridal_name" value="<?php echo strlen($_post_config['wd_bridal_name'])? esc_attr($_post_config['wd_bridal_name']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Avata Bridal','wpdance');?> </label>
			<?php $image = wp_get_attachment_image_src( $_post_config['wd_bridal_file_url'], 'full' ); ?>
			<img id="wd_bridal_file_url_img" src="<?php echo strlen($image[0])? esc_attr($image[0]): ''; ?>"  height="200" />
			<input type="text" name="wd_bridal_file_url" id="wd_bridal_file_url" class="hidden" value="<?php echo strlen($_post_config['wd_bridal_file_url'])? esc_attr($_post_config['wd_bridal_file_url']): ''; ?>"/>
			<a id="wd_bridal_media_lib" href="javascript:void(0);" class="button" rel="wd_bridal_file_url">Upload Avata</a>
		</p>
		<p>
			<label><?php esc_html_e('Date Of Birth','wpdance');?> </label>
			<input type="text" name="wd_bridal_date" id="wd_bridal_date" value="<?php echo strlen($_post_config['wd_bridal_date'])? esc_attr($_post_config['wd_bridal_date']): ''; ?>" />
		</p>	
		<p>
			<label><?php esc_html_e('Job','wpdance');?> </label>
			<input type="text" name="wd_bridal_employment" id="wd_bridal_employment" value="<?php echo strlen($_post_config['wd_bridal_employment'])? esc_attr($_post_config['wd_bridal_employment']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Address','wpdance');?> </label>
			<input type="text" name="wd_bridal_address" id="wd_bridal_address" value="<?php echo strlen($_post_config['wd_bridal_address'])? esc_attr($_post_config['wd_bridal_address']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Short Description','wpdance');?> </label>
			<textarea rows="4" cols="38" type="text" name="wd_bridal_description" id="wd_bridal_description"/><?php echo strlen($_post_config['wd_bridal_description'])? esc_attr($_post_config['wd_bridal_description']): ''; ?></textarea>
		</p>

		<h4>Info Family</h4>
		<p>
			<label><?php esc_html_e('Father Name','wpdance');?> </label>
			<input type="text" name="wd_bridal_father_name" id="wd_bridal_father_name" value="<?php echo strlen($_post_config['wd_bridal_father_name'])? esc_attr($_post_config['wd_bridal_father_name']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Mother Name','wpdance');?> </label>
			<input type="text" name="wd_bridal_mother_name" id="wd_bridal_mother_name" value="<?php echo strlen($_post_config['wd_bridal_mother_name'])? esc_attr($_post_config['wd_bridal_mother_name']): ''; ?>" />
		</p>

		<h4>Social Profile</h4>
		<p>
			<label><?php esc_html_e('facebook','wpdance');?> </label>
			<input type="text" name="wd_bridal_facebook" id="wd_bridal_facebook" value="<?php echo strlen($_post_config['wd_bridal_facebook'])? esc_url($_post_config['wd_bridal_facebook']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Twitter','wpdance');?> </label>
			<input type="text" name="wd_bridal_twitter" id="wd_bridal_twitter" value="<?php echo strlen($_post_config['wd_bridal_twitter'])? esc_url($_post_config['wd_bridal_twitter']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Pinterest','wpdance');?> </label>
			<input type="text" name="wd_bridal_pinterest" id="wd_bridal_pinterest" value="<?php echo strlen($_post_config['wd_bridal_pinterest'])? esc_url($_post_config['wd_bridal_pinterest']): ''; ?>" />
		</p>	
		<p>
			<label><?php esc_html_e('Instagram','wpdance');?> </label>
			<input type="text" name="wd_bridal_instagram" id="wd_bridal_instagram" value="<?php echo strlen($_post_config['wd_bridal_instagram'])? esc_url($_post_config['wd_bridal_instagram']): ''; ?>" />
		</p>
	</div>
	<div class="wd-content-groom" style="width:48%; float:right">
		<h3 class="area-title"><?php esc_html_e('Groom','wpdance'); ?></h3>
		<p>
			<label><?php esc_html_e('Name groom','wpdance');?> </label>
			<input type="text" name="wd_groom_name" id="wd_groom_name" value="<?php echo strlen($_post_config['wd_groom_name'])? esc_attr($_post_config['wd_groom_name']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Avata groom','wpdance');?> </label>
			<?php $image = wp_get_attachment_image_src( $_post_config['wd_groom_file_url'], 'full' ); ?>
			<img id="wd_groom_file_url_img" src="<?php echo strlen($image[0])? esc_attr($image[0]): ''; ?>" height="200" />
			<input type="text" name="wd_groom_file_url" id="wd_groom_file_url" class="hidden" value="<?php echo strlen($_post_config['wd_groom_file_url'])? esc_attr($_post_config['wd_groom_file_url']): ''; ?>"/>
			<a id="wd_groom_media_lib" href="javascript:void(0);" class="button" rel="wd_groom_file_url">Upload Avata</a>
		</p>
		<p>
			<label><?php esc_html_e('Date Of Birth','wpdance');?> </label>
			<input type="text" name="wd_groom_date" id="wd_groom_date" value="<?php echo strlen($_post_config['wd_groom_date'])? esc_attr($_post_config['wd_groom_date']): ''; ?>" />
		</p>	
		<p>
			<label><?php esc_html_e('Job','wpdance');?> </label>
			<input type="text" name="wd_groom_employment" id="wd_groom_employment" value="<?php echo strlen($_post_config['wd_groom_employment'])? esc_attr($_post_config['wd_groom_employment']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Address','wpdance');?> </label>
			<input type="text" name="wd_groom_address" id="wd_groom_address" value="<?php echo strlen($_post_config['wd_groom_address'])? esc_attr($_post_config['wd_groom_address']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Short Description','wpdance');?> </label>
			<textarea rows="4" cols="38" type="text" name="wd_groom_description" id="wd_groom_description"/><?php echo strlen($_post_config['wd_groom_description'])? esc_attr($_post_config['wd_groom_description']): ''; ?></textarea>
		</p>

		<h4>Info Family</h4>
		<p>
			<label><?php esc_html_e('Father Name','wpdance');?> </label>
			<input type="text" name="wd_groom_father_name" id="wd_groom_father_name" value="<?php echo strlen($_post_config['wd_groom_father_name'])? esc_attr($_post_config['wd_groom_father_name']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Mother Name','wpdance');?> </label>
			<input type="text" name="wd_groom_mother_name" id="wd_groom_mother_name" value="<?php echo strlen($_post_config['wd_groom_mother_name'])? esc_attr($_post_config['wd_groom_mother_name']): ''; ?>" />
		</p>

		<h4>Social Profile</h4>
		<p>
			<label><?php esc_html_e('facebook','wpdance');?> </label>
			<input type="text" name="wd_groom_facebook" id="wd_groom_facebook" value="<?php echo strlen($_post_config['wd_groom_facebook'])? esc_url($_post_config['wd_groom_facebook']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Twitter','wpdance');?> </label>
			<input type="text" name="wd_groom_twitter" id="wd_groom_twitter" value="<?php echo strlen($_post_config['wd_groom_twitter'])? esc_url($_post_config['wd_groom_twitter']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Pinterest','wpdance');?> </label>
			<input type="text" name="wd_groom_pinterest" id="wd_groom_pinterest" value="<?php echo strlen($_post_config['wd_groom_pinterest'])? esc_url($_post_config['wd_groom_pinterest']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Instagram','wpdance');?> </label>
			<input type="text" name="wd_groom_instagram" id="wd_groom_instagram" value="<?php echo strlen($_post_config['wd_groom_instagram'])? esc_url($_post_config['wd_groom_instagram']): ''; ?>" />
		</p>		
	</div>
	<div class="clear"></div>
	<div class="wd-info-married">
		<h3 class="area-title"><?php esc_html_e('Info Wedding','wpdance'); ?></h3>
		<p>
			<label><?php esc_html_e('Wedding day','wpdance');?> </label>
			<input type="text" name="wd_groom_wedding_day" id="wd_groom_wedding_day" value="<?php echo strlen($_post_config['wd_groom_wedding_day'])? esc_attr($_post_config['wd_groom_wedding_day']): ''; ?>" />
		</p>
		<p>
			<label><?php esc_html_e('Wedding Location','wpdance');?> </label>
			<input type="text" name="wd_groom_wedding_location" id="wd_groom_name" value="<?php echo strlen($_post_config['wd_groom_wedding_location'])? esc_attr($_post_config['wd_groom_wedding_location']): ''; ?>" />
		</p>	
		<p>
			<label><?php esc_html_e('Short Wedding Description','wpdance');?> </label>
			<textarea rows="5" cols="50" type="text" name="wd_groom_wedding_des" id="wd_groom_wedding_des" /><?php echo strlen($_post_config['wd_groom_wedding_des'])? esc_attr($_post_config['wd_groom_wedding_des']): ''; ?></textarea>
		</p>		
	</div>
	<div class="clear"></div>
	<input type="hidden" name="custom_post_wd_couple" class="change-layout" value="custom_post_wd_couple"/>	
</div>