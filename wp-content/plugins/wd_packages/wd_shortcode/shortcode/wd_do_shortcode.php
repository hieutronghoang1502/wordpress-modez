<?php
/**
 * Shortcode: tvlgiao_wpdance_do_shortcode
 */
if (!function_exists('tvlgiao_wpdance_do_shortcode_function')) {
	function tvlgiao_wpdance_do_shortcode_function($atts) {
		extract(shortcode_atts(array(
			'shortcode'		=> '',
			'class' 		=> '',
		), $atts));
		ob_start();
		?>
		<div class="wd-shortcode-do-shortcode <?php echo esc_attr($class) ?>">
			<?php if ($shortcode): ?>
				<?php 
				$shortcode = str_replace('`{`', '[', $shortcode);
				$shortcode = str_replace('`}`', ']', $shortcode);
				echo do_shortcode( $shortcode ); ?>
			<?php endif ?>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_do_shortcode', 'tvlgiao_wpdance_do_shortcode_function');
?>