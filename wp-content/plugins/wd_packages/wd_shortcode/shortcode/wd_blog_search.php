<?php
/**
 * Shortcode: tvlgiao_wpdance_search_blog
 */

if (!function_exists('tvlgiao_wpdance_search_post')) {
	function tvlgiao_wpdance_search_post($atts) {
		extract(shortcode_atts(array(
			'style' 		=> 'style-1',
			'class'			=> ''

		), $atts));
	
		ob_start();
		?>
		<div class="wd-search-post <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?>">
			<?php if($style == "style-1") : ?>
				<a class="wd-click-popup-search"><i class="fa fa-search"></i></a>
				<div class="wd-popup-search hidden">
					<?php get_search_form( $echo = true );?>
					<div class="wd-search-close">X</div>
				</div>
			<?php else: ?>
				<?php get_search_form( $echo = true );?>
			<?php endif; ?>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_search_blog', 'tvlgiao_wpdance_search_post');
?>