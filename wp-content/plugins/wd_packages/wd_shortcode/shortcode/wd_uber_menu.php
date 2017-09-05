<?php
/**
 * Shortcode: tvlgiao_wpdance_uber_menu
 */
if (!function_exists('tvlgiao_wpdance_uber_menu_function')) {
	function tvlgiao_wpdance_uber_menu_function($atts) {
		extract(shortcode_atts(array(
			'type'						=> '1',
			'menu_theme_location'		=> '',
			'integrate_specific_menu'	=> '',
			'class' 					=> '',
		), $atts));
		
		ob_start();
		$shortcode = '';
		if ($type == 1) {
			$shortcode = ($menu_theme_location) ? '[ubermenu config_id="main" theme_location="'.$menu_theme_location.'"]' : '';
		}else{
			$shortcode = ($integrate_specific_menu) ? '[ubermenu config_id="main" menu="'.$integrate_specific_menu.'"]' : '';
		}
		?>
		<div class="wd-shortcode-uber-menu <?php echo esc_attr($class) ?>">
			<?php if ($shortcode): ?>
				<?php echo do_shortcode( $shortcode ); ?>
			<?php endif ?>
		</div>
		<?php
		$content = ob_get_clean();
		wp_reset_query();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_uber_menu', 'tvlgiao_wpdance_uber_menu_function');
?>