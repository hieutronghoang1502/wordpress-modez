<?php
/**
 * Shortcode: wd_event
 */

if (!function_exists('wd_event_function')) {
	function wd_event_function($atts) {
		extract(shortcode_atts(array(
			'id_event'				=> '-1'
			,'number_event'			=> '-1'
			,'number'				=> 100
			,'class'				=> ''
		), $atts));
		$args 	= array( 
					'post_type' 	=> 'event'
					,'post_status' 	=> 'publish',
				);
		$random_id = "";
		$args['posts_per_page'] =  $number_event;
		wp_reset_postdata();
		$event 	= new WP_Query($args);
		ob_start();
		
		?>
			<?php while ($event->have_posts()) : $event->the_post(); global $post; ?>
				<div class="wd-event <?php echo esc_attr($class); ?>" >
					<?php
						$name 			= esc_html(get_the_title($post->ID));
						$event_startdate = get_post_meta($post->ID,'wd_event_startdate',true);
						$event_starttime = get_post_meta($post->ID,'wd_event_starttime',true);
						$event_enddate	= get_post_meta($post->ID,'wd_event_enddate',true);
						$event_endtime = get_post_meta($post->ID,'wd_event_endtime',true);
						$event_location	= get_post_meta($post->ID,'wd_event_location',true);
						$event_phone	= get_post_meta($post->ID,'wd_event_phone',true);
						$event_email	= get_post_meta($post->ID,'wd_event_email',true);
						$event_link	= get_post_meta($post->ID,'wd_event_link',true);
						
						$datestart = date("l", strtotime($event_startdate));
						$daystart = date("d", strtotime($event_startdate));
						$monthstart = date("M", strtotime($event_startdate));
			
						$dateend = date("l", strtotime($event_enddate));
					?>
					<div class="date-event">
						<span class="date-start"><?php echo $daystart; ?></span><span class="month-start"><?php echo $monthstart; ?></span>
						<span class="day-start"><?php echo $datestart; ?></span>
					</div>
					<div class="info-event">
						<div class="event-content">
							<h3><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
							<p class="time-event"><i class="pe-7s-alarm"></i> <?php echo $datestart; ?>, <?php echo $event_starttime; ?> - <?php echo $dateend; ?>, <?php echo $event_endtime; ?></p>
						</div>
						<div class="icon-event">
							<div class="">
								<ul class="event-contact">
									<?php if($event_location){ ?>
										<li><a target="_blank" href="<?php echo $event_location; ?>"><i class="pe-7s-map-marker" aria-hidden="true"></i></a></li>
									<?php } ?>
									<?php if($event_phone){ ?>
										<li><a href="tel:<?php echo str_replace(' ', '', $event_phone); ?>"><i class="pe-7s-call" aria-hidden="true"></i></a></li>
									<?php } ?>
									<?php if($event_email){ ?>
										<li><a href="mailto:<?php echo $event_email; ?>"><i class="pe-7s-mail" aria-hidden="true"></i></a></li>
									<?php } ?>
									<li class="sharing">
										<a><i class="pe-7s-share" aria-hidden="true"></i></a>
										<ul class="social-event">
											<li class="face-event"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li class="twitter-event"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
											<li class="google-event"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>
							<?php if($event_link) { ?><a href="<?php echo $event_link; ?>">Register</a><?php } ?>
						</div>
					</div>
					<script>
						jQuery( ".sharing" ).click(function() {
							jQuery(this).find(".social-event" ).toggle();
						});
					</script>
					</div>
			<?php endwhile;// End While ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('wd_event', 'wd_event_function');

if (!function_exists('wd_eventcountdown_function')) {
	function wd_eventcountdown_function($atts) {
		extract(shortcode_atts(array(
			'event_id'			=> '-1',
			'class'				=> ''
		), $atts));
			
		$today = time();
		if ($event_id == '-1') {
			$args = array(
				'post_type' => 'event',
				'posts_per_page' => 1,

				'meta_query' => array(
					array(
						'key' => 'wd_event_startdate',
						'compare' => '>=',
						'value' => $today,
						'type' => 'DATE'
					)
				),

				'meta_key' => 'wd_event_startdate',
				'orderby' => 'meta_value',
				'order' => 'ASC',
			);
		}else{
			$args = array(
				'post_type' => 'event',
				'posts_per_page' => 1,
				'post__in'		=> array($event_id),
			);
		}
		

		wp_reset_postdata();
		$eventcountdown 	= new WP_Query($args);
		ob_start();
		
		?>
		<div class="wd-eventcountdown <?php echo esc_attr($class); ?>" >
			<?php while ($eventcountdown->have_posts()) : $eventcountdown->the_post(); global $post; ?>
					<?php
						$name 			= esc_html(get_the_title($post->ID));
						$event_startdate = get_post_meta($post->ID,'wd_event_startdate',true);
						$event_starttime = get_post_meta($post->ID,'wd_event_starttime',true);
						$event_enddate	= get_post_meta($post->ID,'wd_event_enddate',true);
						$event_endtime = get_post_meta($post->ID,'wd_event_endtime',true);
						$event_link	= get_post_meta($post->ID,'wd_event_link',true);
						
						$datestart = date("l", strtotime($event_startdate));
						$daystart = date("d", strtotime($event_startdate));
						$monthstart = date("M", strtotime($event_startdate));
						$countdown = date("Y/m/d", strtotime($event_startdate));
						
						$dateend = date("l", strtotime($event_enddate));
					?>
					<div class="countdown-info">
						<p>Next up coming event</p>
						<h2><?php the_title(); ?></h2>
					</div>
					<div class="countdown-time">
						<div id="clock"></div>
						<script type="text/javascript">
							jQuery('#clock').countdown('<?php echo $countdown; ?>').on('update.countdown', function(event) {
							  var $this = jQuery(this).html(event.strftime(''
								+ '<div class="countdown-column"><span>%d</span> days </div>'
								+ '<div class="countdown-column"><span>%H</span> Hours </div>'
								+ '<div class="countdown-column"><span>%M</span> Minutes </div>'
								+ '<div class="countdown-column"><span>%S</span> Seconds </div>'));
							});
						</script>
						<a href="<?php echo $event_link; ?>">Event Detail</a>
					</div>
			<?php endwhile;// End While ?>
		</div>

		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('wd_eventcountdown', 'wd_eventcountdown_function');
?>