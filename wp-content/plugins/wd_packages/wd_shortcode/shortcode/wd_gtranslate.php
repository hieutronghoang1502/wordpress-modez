<?php
/**
 * Shortcode: tvlgiao_wpdance_gtranslate
 */
if (!function_exists('tvlgiao_wpdance_gtranslate_function')) {
	function tvlgiao_wpdance_gtranslate_function($atts) {
		extract(shortcode_atts(array(
			'class' => '',
		), $atts));
		
		ob_start();
		?>
		<div class="wd-shortcode-gtranslate <?php echo esc_attr($class) ?>">
			<?php echo do_shortcode( '[GTranslate]' ); ?>
		</div>
		<?php
		$content = ob_get_clean();
		wp_reset_query();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_gtranslate', 'tvlgiao_wpdance_gtranslate_function');
?>