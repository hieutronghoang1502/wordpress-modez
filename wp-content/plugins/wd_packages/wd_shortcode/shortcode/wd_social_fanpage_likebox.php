<?php
/**
 * Shortcode: tvlgiao_wpdance_social_fanpage_likebox
 */
if(!function_exists('tvlgiao_wpdance_social_fanpage_likebox_function')){
	function tvlgiao_wpdance_social_fanpage_likebox_function($atts,$content){
		extract(shortcode_atts(array(
			'fanpage_url'	=> '',
			'width'			=> '320',
			'height'		=> '230',
			'class'			=> '',
		),$atts));
		ob_start();
		?>
		<?php if ($fanpage_url): ?>
			<div class="fb-like-box <?php echo esc_attr($class) ?>">
				<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo esc_url($fanpage_url); ?>&amp;width=<?php echo esc_html($width); ?>&amp;colorscheme=light&amp;show_faces=true&amp;connections=9&amp;stream=false&amp;header=false&amp;height=<?php echo esc_html($height); ?>" scrolling="no" frameborder="0" scrolling="no"></iframe>
			</div>
    	<?php endif ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_social_fanpage_likebox','tvlgiao_wpdance_social_fanpage_likebox_function');
?>