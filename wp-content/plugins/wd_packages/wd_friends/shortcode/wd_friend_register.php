<?php
/**
 * Shortcode: wd_friend_day_form_register
 */

if (!function_exists('wd_friend_day_form_register_function')) {
	function wd_friend_day_form_register_function($atts) {
		extract(shortcode_atts(array(
			'id_cate_couple'		=> '-1',
			'title_wedding'			=> "",
			'time_wedding'			=> "",
			'bridal_wedding'		=> "",
			'groom_wedding'			=> "",
			'image_url'				=> "",	
			'class'					=> '',
		), $atts));
		$image_data = wp_get_attachment_image_src($image_url, "full");
		$img_url 	= $image_data[0];		
		ob_start();
		?>
		<div id="wd-friend-form-register" class="wd-friend-form-register <?php echo esc_attr($class) ?>" >
			<form action="#" method="post">
				<div class="wd-form-content">
					<div class="wd-form-content-info">
						<div class="wd-form-heading">
							<?php if($title_wedding != "") : ?>
								<h2><?php echo esc_attr($title_wedding); ?></h2>
							<?php endif; ?>
							<?php if($time_wedding != "") : ?>
								<span><?php echo esc_attr($time_wedding); ?></span>
							<?php endif; ?>
							<div class="wd-form-info-wedding">
								<span class="wd-groom-name"><?php echo esc_attr($groom_wedding); ?></span>
								<span class="wd-icon-wedding"><?php esc_html_e('&','wpdance'); ?></span>
								<span class="wd-bridal-name"><?php echo esc_attr($bridal_wedding); ?></span>
							</div>
						</div>
						<div class="wd-form-data">
							<input type="text" name="friend_name" placeholder="<?php esc_html_e('Your name','wpdance'); ?>">
							<input type="text" name="friend_email" placeholder="<?php esc_html_e('Email address','wpdance'); ?>">
							<p>
								<span><?php esc_html_e('Guests','wpdance'); ?></span>
								<select name="friend_number">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="-1">Other</option>
								</select>
							</p>
							<h3><?php esc_html_e('WILL YOU ATTEND','wpdance'); ?></h3>
							<span><input type="radio" name="friend_join" value="1" checked><?php esc_html_e("Yes, I will be there",'wpdance'); ?></span>
							<span><input type="radio" name="friend_join" value="0" ><?php esc_html_e("Sorry, I can't come",'wpdance'); ?></span>
						</div>
					</div>
				</div>
				<div class="wd-form-footer">
					<textarea name="friend_desciption" placeholder="<?php esc_html_e("Add content text at here...",'wpdance'); ?>"></textarea>
					<input type="submit" value="<?php esc_html_e("SENT YOUR RSVP",'wpdance'); ?>">
				</div>
			</form>
		</div>

		<style type="text/css">
			@media (min-width: 767px){
				.wd-form-content {
					background-image: url("<?php echo esc_url($img_url);?>");
				}
		</style>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('wd_friend_day_form_register', 'wd_friend_day_form_register_function');
?>