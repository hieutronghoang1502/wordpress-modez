<?php
/**
 * Shortcode: wd_friend_day
 */

if (!function_exists('wd_friend_day_function')) {
	function wd_friend_day_function($atts) {
		extract(shortcode_atts(array(
			'id_cate_couple'		=> '-1',
			'style'					=> 'style-1',
			'friend_columns'		=> 'wd-colums-10',
			'number_friend'			=> 5,
			'number'				=> 100,
			'auto_loop'				=> '0',
			'time_loop'				=> '3000',		
			'class'					=> '',
		), $atts));
		$args 	= array( 
					'post_type' 		=> 'wd_friend',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> $number_friend,
				);
		//Category
		if( $id_cate_couple != -1 ){
			$args['tax_query']= array(
					    	array(
							    	'taxonomy' 		=> 'wd_friend_category',
									'terms' 		=> $id_cate_couple,
									'field' 		=> 'term_id',
									'operator' 		=> 'IN'
								)
			   			);
		}
		wp_reset_postdata();
		$teammember 		= new WP_Query($args);
		ob_start();
		if($number_friend % 2 == 0){
			$class_active 	= $number_friend / 2;
		}else{
			$class_active 	= round($number_friend / 2);
		}
		if($style == 'style-2') $friend_columns == '';
		?>
		<div  class="wd-friend-wrapper <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?> <?php echo esc_attr($friend_columns) ?>" >
			<?php $_random_id = 'wd_friend'.rand();  $count = 1; ?>
			
			<?php if( $style == 'style-1' || $style == 'style-2' ) : ?>
				<div class="project" id="<?php echo $_random_id ?>">
										  
					<?php while ($teammember->have_posts()) : $teammember->the_post(); global $post; ?>
						<?php
							$name 			= esc_html(get_the_title($post->ID));
							$excerpt 		= tvlgiao_wpdance_string_limit_words(get_the_excerpt() , $number )."...";
							$_date 			= get_the_date('Y-m-d');
							$number_data	= $teammember->post_count;
							$class_span 	= '';
							if($count == 1){ $class_span = 'first';}
							if($count == $number_data){ $class_span = 'last';}
						?>
						<div class="wd-content-friend <?php if($count == $class_active) echo "wd-friend-avtive";?> <?php echo esc_attr($class_span); ?> ">
							<div class="wd-friend-avata">
								<img src="<?php the_post_thumbnail_url(); ?>" alt="" class="sc-image">
								<span></span>
							</div>
							<div class="wd-friend-info">																												
								<h3><?php echo esc_attr($name); ?></h3>
								<div class="wd-friend-content">
									<?php  echo esc_attr($excerpt); ?>	
								</div>
								<p><?php echo wd_friend_time_elapsed_string($_date); ?></p>
							</div>
						</div>
						
					<?php $count++; endwhile; ?>								
				</div>
				<div class="wd-control-nav <?php echo $_random_id ?>">
					<a class="wd-next"><?php echo esc_html('Next','wpdance'); ?></a>
					<a class="wd-preview"><?php echo esc_html('Preview','wpdance'); ?></a>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						"use strict";
						function tvlgiao_wpdance_auto_loop() {
							var _this = jQuery("#<?php echo $_random_id ?> .wd-friend-avtive");
							if(jQuery("#<?php echo $_random_id ?> .wd-content-friend").hasClass( "wd-friend-avtive" )){
								jQuery("#<?php echo $_random_id ?> .wd-content-friend").removeClass("wd-friend-avtive");
							}
							if(_this.hasClass( "last" )){
								jQuery("#<?php echo $_random_id ?> .first").addClass('wd-friend-avtive');
							}else{
								_this.next().addClass('wd-friend-avtive');
							}					   
						}
						jQuery("#<?php echo $_random_id ?> .wd-friend-avata").click(function () {
							var _this 	  = $(this);
							if(jQuery("#<?php echo $_random_id ?> .wd-content-friend").hasClass( "wd-friend-avtive" )){
								jQuery("#<?php echo $_random_id ?> .wd-content-friend").removeClass("wd-friend-avtive");
							}
							_this.parent().addClass('wd-friend-avtive');
						});
						jQuery(".<?php echo $_random_id ?> .wd-next").click(function () {
							tvlgiao_wpdance_auto_loop();
						});
						jQuery(".<?php echo $_random_id ?> .wd-preview").click(function () {
							var _this = jQuery("#<?php echo $_random_id ?> .wd-friend-avtive");
							if(jQuery("#<?php echo $_random_id ?> .wd-content-friend").hasClass( "wd-friend-avtive" )){
								jQuery("#<?php echo $_random_id ?> .wd-content-friend").removeClass("wd-friend-avtive");
							}
							if(_this.hasClass( "first" )){
								jQuery("#<?php echo $_random_id ?> .last").addClass('wd-friend-avtive');
							}else{
								_this.prev().addClass('wd-friend-avtive');
							}
						});
						<?php if($auto_loop) : ?>
							var time_loop = <?php esc_html_e($time_loop); ?>;
							setInterval(tvlgiao_wpdance_auto_loop, time_loop );
						<?php endif; ?>
					});
				</script>
			<?php endif; ?>
			<!--             Style 03             -->
			<?php if( $style == 'style-3' ) : ?>
			
				<?php $_random_id = 'testi'.rand();  ?>
				<div class="sc_testimonial">
					 <div class="project" id="nav<?php echo $_random_id ?>">
						<div id="<?php echo $_random_id ?>" class="sky-carousel">						  
							<div class="sky-carousel-wrapper">
								<ul class="sky-carousel-container">
									<?php while ($teammember->have_posts()) : $teammember->the_post(); global $post; ?>
										<?php
											$name 			= esc_html(get_the_title($post->ID));
											$excerpt 		= tvlgiao_wpdance_string_limit_words(get_the_excerpt() , $number )."...";
											$_date 			= get_the_date('Y-m-d');
											$number_data	= $teammember->post_count;
											$class_span 	= '';
										?>
										<li class="wd-content-friend">
											<img src="<?php the_post_thumbnail_url(); ?>" alt="" class="sc-image">
											<div class="sc-content">																						
												<div class="avartar">
													<div class="wd-friend-info">																												
														<h3><?php echo esc_attr($name); ?></h3>
														<div class="wd-friend-content">
															<?php  echo esc_attr($excerpt); ?>	
														</div>
														<p><?php echo wd_friend_time_elapsed_string($_date); ?></p>
													</div>
												</div>
											</div>
										</li>
									<?php endwhile; ?>								
								</ul>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						jQuery(function() {	
							'use strict';
							jQuery("#<?php echo $_random_id ?>").carousel({
								itemWidth: 90,
								itemHeight: 170,
								distance: 25,
								selectedItemDistance: 50,
								selectedItemZoomFactor: 0.7,
								unselectedItemZoomFactor: 0.7,
								unselectedItemAlpha: 0.6,
								motionStartDistance: 210,
								topMargin: 115,
								gradientStartPoint: 0.35,
								gradientOverlayColor: "#ebebeb",
								gradientOverlaySize: 190,
								selectByClick: true,
								enableMouseWheel: false,
								classprev:"#nav<?php echo $_random_id ?>"
							});
						});
					</script>
				</div>
			<?php endif; ?>
			<!-- End test -->	
		</div>

		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('wd_friend_day', 'wd_friend_day_function');
?>