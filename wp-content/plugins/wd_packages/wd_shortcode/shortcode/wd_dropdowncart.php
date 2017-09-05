<?php
/**
 * Shortcode: tvlgiao_wpdance_dropdowncart
 */

if (!function_exists('tvlgiao_wpdance_shortcode_dropdowncart')) {
	function tvlgiao_wpdance_shortcode_dropdowncart($atts) {
		extract(shortcode_atts(array(
			'class' 		=> ''
		), $atts));
	
		return tvlgiao_wpdance_tini_cart( $class);
	}
}
add_shortcode('tvlgiao_wpdance_dropdowncart', 'tvlgiao_wpdance_shortcode_dropdowncart');
?>