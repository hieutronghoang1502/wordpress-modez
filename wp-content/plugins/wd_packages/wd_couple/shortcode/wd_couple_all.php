<?php
/**
 * Shortcode: tvlgiao_wpdance_couple_all_data
 */

if (!function_exists('tvlgiao_wpdance_couple_all_data_function')) {
	function tvlgiao_wpdance_couple_all_data_function($atts) {
		extract(shortcode_atts(array(
			'number_couple'	=> '6',
			'column_couple'	=> '2',
			'class' 		=> '',
		), $atts));
		wp_reset_postdata();
		$args = array(		
			'post_type' 				=> 'wd_couple',
			'posts_per_page' 			=> $number_couple,
			'ignore_sticky_posts' 		=> 1,
		);
		$couples 	= new WP_Query($args);
		$span_class = "col-sm-".(24/$column_couple);
		ob_start(); ?>
			<div class="wd-couple-all <?php echo esc_attr($class);?>">
				<?php while ( $couples->have_posts() ) : $couples->the_post(); global $post; ?>
					<?php
						$meta_couple = get_post_meta(get_the_ID(),'_tvlgiao_wpdance_custom_couple',true);
						$meta_couple = unserialize($meta_couple);
					?>
					<div class="wd-content-couple <?php echo esc_attr($span_class); ?> clear-padding">
						<div class="wd-thumbnail-couple">
							<a class="thumbnail" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('image_size_large'); ?>
							</a>
						</div>
						<div class="wd-couple-info">
							<div class="wd-couple-info-sub">
								<span class="icon"></span>
								<span class="wd-groom-name"><?php echo esc_attr($meta_couple['wd_groom_name']); ?></span>
								<span class="wd-bridal-name"><?php echo esc_attr($meta_couple['wd_bridal_name']); ?></span>
								<p class="wd-time-couple"><?php echo get_the_date('M d,Y'); ?></p>
							</div>
						</div>
					</div>
				<?php endwhile;   ?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_couple_all_data', 'tvlgiao_wpdance_couple_all_data_function');
?>