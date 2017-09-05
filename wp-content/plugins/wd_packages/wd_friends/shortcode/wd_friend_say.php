<?php
/**
 * Shortcode: wd_friend_say
 */

if (!function_exists('wd_friend_say_function')) {
	function wd_friend_say_function($atts) {
		extract(shortcode_atts(array(
			'id_friend_day'			=> '-1',
			'style'					=> 'style-1',
			'number'				=> 100,
			'class'					=> '',
		), $atts));
		$data_friend	= get_post($id_friend_day); 
		$name 			= esc_html(get_the_title($id_friend_day));
		$excerpt 		= tvlgiao_wpdance_string_limit_words($data_friend->post_excerpt , $number )."...";
		$_date 			= get_the_date('Y-m-d');
		wp_reset_postdata();

		ob_start();
		?>
		<div  class="wd-friend-say <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?>">
			<div class="wd-friend-avata">
				<?php echo get_the_post_thumbnail( $id_friend_day, 'full'); ?>
			</div>
			<div class="wd-friend-info">																					<h3><?php echo esc_attr($name); ?></h3>
				<div class="wd-friend-content">
					<?php  echo esc_attr($excerpt); ?>	
				</div>
				<p><?php echo wd_friend_time_elapsed_string($_date); ?></p>
			</div>
		</div>

		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('wd_friend_say', 'wd_friend_say_function');
?>