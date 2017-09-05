<?php
/**
 * Shortcode: tvlgiao_wpdance_currency
 */

if (!function_exists('tvlgiao_wpdance_currency_site')) {
	function tvlgiao_wpdance_currency_site($atts, $content = null) {
		extract(shortcode_atts(array(
			'title'			=> 'Currency',
			'class' 		=> ''
		), $atts));
		ob_start();
		?>
		<section id="woocs_selector-4" class="widget woocs_selector <?php echo esc_attr($class) ?>">
			<div class="widget widget-woocommerce-currency-switcher">
		    	<h2 class="widget-title"><?php echo esc_attr($title) ; ?></h2>
		    	<?php if(do_shortcode('[woocs]')) {echo do_shortcode('[woocs]');} ?>
	   	 	</div>

		</section>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_currency', 'tvlgiao_wpdance_currency_site');
?>