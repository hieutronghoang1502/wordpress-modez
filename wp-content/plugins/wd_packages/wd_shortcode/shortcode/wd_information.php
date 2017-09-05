<?php
/**
 * Shortcode: tvlgiao_wpdance_information
 */

if (!function_exists('tvlgiao_wpdance_information_site')) {
	function tvlgiao_wpdance_information_site($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' 			=> '',
			'style'				=> 'style-1',
			'icon_fontawesome'	=> 'fa fa-adjust'

		), $atts));
	
		ob_start();
		?>
		<div class="wd-information <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?>">
			<div class="wd-feature-icon <?php echo esc_attr($icon_fontawesome); ?>"></div>
			<div class="wd-content-info">
				<?php echo ($content); ?>
			</div>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_information', 'tvlgiao_wpdance_information_site');
?>