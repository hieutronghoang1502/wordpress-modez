<?php
/**
 * Shortcode: tvlgiao_wpdance_couple_event
 */
if (!function_exists('tvlgiao_wpdance_couple_event_function')) {
	function tvlgiao_wpdance_couple_event_function($atts) {
		extract(shortcode_atts(array(
			'event_style'		=> 'wd-event-style-1',
			'event_title'		=> '',
			'event_icon'		=> '',
			'event_location'	=> '',
			'event_date'		=> '',
			'event_time'		=> '',
			'event_show_des'	=> '0',
			'event_description'	=> '',
			'event_show_map'	=> '0',
			'event_url_map'		=> '',
			'class' 			=> '',
		), $atts));
		//
		$event_icon_ 	= wp_get_attachment_image_src($event_icon, "full");
		$event_icon_url = $event_icon_[0];

		ob_start(); ?>
			<div class="wd-event-wrapper <?php echo esc_attr($event_style); ?>">
				<div class="wd-event-icon">
					<img alt="<?php echo esc_attr($event_title);?>" title="<?php echo esc_attr($event_title);?>" class="img" src="<?php echo esc_url($event_icon_url)?>" />
				</div>
				<h2 class="wd-event-title"><?php echo esc_attr($event_title); ?></h2>
				<span class="wd-event-location"><?php echo esc_attr($event_location); ?></span>
				<div class="wd-event-datetime">
					<span class="wd-event-date"><?php echo esc_attr($event_date); ?></span>
					<span class="wd-event-time"><?php echo esc_attr($event_time); ?></span>
				</div>
				<?php if($event_show_des) : ?>
					<p class="wd-event-description"><?php echo esc_attr($event_description); ?></p>
				<?php endif; ?>
				<?php if($event_show_map) : ?>
					<a target="_blank" href="<?php echo esc_url($event_url_map);?>"><?php esc_html_e('View Map','wpdance'); ?></a>
				<?php endif; ?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_couple_event', 'tvlgiao_wpdance_couple_event_function');
?>