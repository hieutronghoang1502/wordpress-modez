<?php
/**
 * Shortcode: wpdancebootstrap_user_links
 */
if ( ! function_exists( 'tvlgiao_wpdance_shortcode_user_links' ) ) {
	function tvlgiao_wpdance_shortcode_user_links($atts){
		extract(shortcode_atts(array(
			'class' 		=> '',
			'show_title'	=> '1',
		), $atts));
		$class_show_title = "";
		if( $show_title == '0') $class_show_title = 'show-icon-user';
		return tvlgiao_wpdance_tini_account( $class, $class_show_title );
	}
}
add_shortcode('tvlgiao_wpdance_user_links', 'tvlgiao_wpdance_shortcode_user_links');
?>