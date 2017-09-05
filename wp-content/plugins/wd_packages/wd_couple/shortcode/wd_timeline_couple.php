<?php
/**
 * Shortcode: tvlgiao_wpdance_couple_timeline
 */
if (!function_exists('tvlgiao_wpdance_couple_timeline_function')) {
	function tvlgiao_wpdance_couple_timeline_function($atts) {
		$array_shortcode 						= array();
		$array_shortcode['number_event']		= '1';
		$array_shortcode['timeline_style'] 		= 'wd-style-event-1';
		$array_shortcode['timeline_des_show'] 	= '0';

		for($i = 1; $i <= 10; $i++){
			$event_icon 	= 'event_icon_'.$i;
			$array_shortcode[$event_icon] 			= '';
			$event_title 	= 'event_title_'.$i;
			$array_shortcode[$event_title] 			= '';
			$event_time 	= 'event_time_'.$i;
			$array_shortcode[$event_time] 			= '';
			$evetn_des 		= 'event_description_'.$i;
			$array_shortcode[$evetn_des] 	= '';
		}
		extract(shortcode_atts($array_shortcode, $atts));
		ob_start(); ?>
			<div class="wd-wrapper-timeline <?php echo esc_attr($timeline_style); ?>">
				<div class="wd-timeline-content <?php echo 'wd-number-item-'.$number_event; ?>">
					<?php for($j = 1; $j <= $number_event ; $j++ ) { ?>
						<?php // Data 
							$icon_event 		= wp_get_attachment_image_src(${'event_icon_'.$j}, "full");
							$icon_event_url 	= $icon_event[0];
							$event_title		= ${'event_title_'.$j};
							$event_time			= ${'event_time_'.$j};
							$event_description 	= ${'event_description_'.$j};
							$class_item 		= 'wd-item_right';
							if($j % 2 == 0){ $class_item 		= 'wd-item_left'; }
						?>
						<div class="wd-timeline-item <?php echo esc_attr($class_item); ?>">
							<div class="wd-item-icon">
								<img alt="<?php echo esc_attr($event_title);?>" title="<?php echo esc_attr($event_title);?>" class="img" src="<?php echo esc_url($icon_event_url)?>" />
								<span class="icon-info">&gt;</span>
							</div>
							<?php if($timeline_style == 'wd-style-event-1') : ?>
								<div class="wd-item-info">							
									<span class="wd-item-time">
										<?php echo esc_attr($event_time); ?>
									</span>
									<h3 class="wd-item-title">
										<?php echo esc_attr($event_title); ?>
									</h3>
									<?php if($timeline_des_show) : ?>
										<div class="wd-item-description">
											<?php echo esc_attr($event_description); ?>
										</div>
									<?php endif; ?>							
								</div>
							<?php endif; ?>
							<?php if($timeline_style == 'wd-style-event-2') : ?>
								<div class="wd-item-info">
									<h3 class="wd-item-title">
										<?php echo esc_attr($event_title); ?>
									</h3>
									<span class="wd-item-time">
										<?php echo esc_attr($event_time); ?>
									</span>
									
									<?php if($timeline_des_show) : ?>
										<div class="wd-item-description">
											<?php echo esc_attr($event_description); ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>

						</div>
					<?php }; ?>
				</div>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_couple_timeline', 'tvlgiao_wpdance_couple_timeline_function');
?>