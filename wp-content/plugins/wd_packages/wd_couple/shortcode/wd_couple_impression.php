<?php
/**
 * Shortcode: tvlgiao_wpdance_couple_impression
 */
if (!function_exists('tvlgiao_wpdance_couple_impression_function')) {
	function tvlgiao_wpdance_couple_impression_function($atts) {
		extract(shortcode_atts(array(
			'impression_avata'	=> '',
			'impression_name'	=> '',
			'impression_desc'	=> '',
			'class' 			=> '',
		), $atts));
		//
		$impression_avata_ 	= wp_get_attachment_image_src($impression_avata, "full");
		$event_avata_url 	= $impression_avata_[0];

		ob_start(); ?>
			<div class="wd-impression-wrapper <?php echo esc_attr($class); ?>">
				<div class="wd-impression-avata">
					<img alt="<?php echo esc_attr($impression_name);?>" title="<?php echo esc_attr($impression_name);?>" class="img" src="<?php echo esc_url($event_avata_url)?>" />
				</div>
				<h2 class="wd-impression-name"><?php echo esc_attr($impression_name); ?></h2>
				<span class="wd-impression-des"><?php echo esc_attr($impression_desc); ?></span>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_couple_impression', 'tvlgiao_wpdance_couple_impression_function');
?>