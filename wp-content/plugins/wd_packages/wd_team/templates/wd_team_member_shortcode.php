<?php
/**
 * Shortcode: wd_team_member
 */

if (!function_exists('wd_team_member_function')) {
	function wd_team_member_function($atts) {
		extract(shortcode_atts(array(
			'slider_or_one'			=> '1'
			,'id_team'				=> '-1'
			,'style'				=> 'style-1'
			,'number_teammember'	=> 5
			,'number'				=> 100		
			,'class'				=> ''
		), $atts));
		$args 	= array( 
			'post_type' 	=> 'team'
			,'post_status' 	=> 'publish',
		);
		$random_id = "";
		if($slider_or_one == "1"){
			$args['p'] =  $id_team;
		}else{
			$args['posts_per_page']  	=  $number_teammember;
			$style_testimonial 			= "wd-style-slider-team";
			$random_id 					= 'wd_shortcode_teammember_'.mt_rand();	
		}
		wp_reset_postdata();
		$teammember 	= new WP_Query($args);
		ob_start();
		
		?>
		<div class="wd-team-member <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?>" >
			<?php if($id_team == '-1' && $slider_or_one == '1'){ ?>
				<p><?php esc_html_e('Please select team','wpdancelaparis'); ?></p>
			<?php }else{ ?>
				<?php if($slider_or_one == '1') : ?>
					<?php while ($teammember->have_posts()) : $teammember->the_post(); global $post; ?>
						<?php
							$name 			= esc_html(get_the_title($post->ID));
							if( $number != '' || $number != 0 ){
								$content 		= substr(wp_strip_all_tags($post->post_content),0, $number).'...';
							}else{
								$content == '';
							}
							$member_role 	= esc_html(get_post_meta($post->ID,'wd_member_role',true));

							$member_email	= get_post_meta($post->ID,'wd_member_email',true);
							$member_phone	= get_post_meta($post->ID,'wd_member_phone',true);
							$member_link	= get_post_meta($post->ID,'wd_member_link',true);

							$member_face	= get_post_meta($post->ID,'wd_member_facebook_link',true);
							$member_twitter	= get_post_meta($post->ID,'wd_member_twitter_link',true);
							$member_rss		= get_post_meta($post->ID,'wd_member_rss_link',true);
							$member_google	= get_post_meta($post->ID,'wd_member_google_link',true);
							$member_linke	= get_post_meta($post->ID,'wd_member_linkedlin_link',true);
							$member_dribble	= get_post_meta($post->ID,'wd_member_dribble_link',true);
						?>
						<div class="wd_member_thumb">
							<a class="image" title="<?php echo esc_attr($name); ?>" ><?php the_post_thumbnail('full', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) )); ?><div class="thumbnail-effect"></div> </a>
							<?php if($style == "style-2"): ?>
								<div class="social-icons">
									<ul>
										<li class="icon-facebook">	<a class="fa fa-facebook" href="<?php echo esc_url($member_face); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>				
										<li class="icon-twitter">	<a class="fa fa-twitter" href="<?php echo esc_url($member_twitter); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-rss">		<a class="fa fa-rss" href="<?php echo esc_url($member_rss); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-google">	<a class="fa fa-google-plus" href="<?php echo esc_url($member_google); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-instagram">	<a class="fa fa-instagram" href="<?php echo esc_url($member_linke); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>	
										<li class="icon-pin">		<a class="fa fa-pinterest" href="<?php echo esc_url($member_dribble); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
									</ul>
								</div>
							<?php endif; ?>
						</div>
						<div class="wd_member_info">
							<div class="wd-member-name-role">
								<h3><?php echo esc_attr($name); ?></h3>
								<span class="wd_member_role"><?php echo esc_attr($member_role); ?></span>
							</div>
							<?php if($style == "style-6" || $style == "style-7"): ?>
								<div class="social-icons">
									<ul>
										<li class="icon-facebook">	<a class="fa fa-facebook" href="<?php echo esc_url($member_face); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>				
										<li class="icon-twitter">	<a class="fa fa-twitter" href="<?php echo esc_url($member_twitter); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-rss">		<a class="fa fa-rss" href="<?php echo esc_url($member_rss); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-google">	<a class="fa fa-google-plus" href="<?php echo esc_url($member_google); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-instagram">	<a class="fa fa-instagram" href="<?php echo esc_url($member_linke); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>	
										<li class="icon-pin">		<a class="fa fa-pinterest" href="<?php echo esc_url($member_dribble); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
									</ul>
								</div>
							<?php endif; ?>
							<?php if($style == "style-4"): ?>
								<div class="social-icons">
									<ul>
										<li class="icon-facebook">	<a class="fa fa-facebook" href="<?php echo esc_url($member_face); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>				
										<li class="icon-twitter">	<a class="fa fa-twitter" href="<?php echo esc_url($member_twitter); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-rss">		<a class="fa fa-rss" href="<?php echo esc_url($member_rss); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-google">	<a class="fa fa-google-plus" href="<?php echo esc_url($member_google); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
										<li class="icon-instagram">	<a class="fa fa-instagram" href="<?php echo esc_url($member_linke); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>	
									</ul>
								</div>
							<?php endif; ?>
							<?php if($style == "style-1" || $style == "style-4"): ?>
								<div class="wd-member-content">
									<?php echo esc_attr($content); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile;// End While ?>
				<?php else: ?>
			<!-- Test -->
				<?php $_random_id = 'testi'.rand();  ?>
				<div class="sc_testimonial">
					 <div class="project" id="nav<?php echo $_random_id ?>">
						<div id="<?php echo $_random_id ?>" class="sky-carousel">						  
							<div class="sky-carousel-wrapper">
								<ul class="sky-carousel-container">
									<?php while ($teammember->have_posts()) : $teammember->the_post(); global $post; ?>
										<?php
											$name 			= esc_html(get_the_title($post->ID));
											$content 		= substr(wp_strip_all_tags($post->post_content),0, $number).'...';
											$member_role 	= esc_html(get_post_meta($post->ID,'wd_member_role',true));

											$member_email	= get_post_meta($post->ID,'wd_member_email',true);
											$member_phone	= get_post_meta($post->ID,'wd_member_phone',true);
											$member_link	= get_post_meta($post->ID,'wd_member_link',true);

											$member_face	= get_post_meta($post->ID,'wd_member_facebook_link',true);
											$member_twitter	= get_post_meta($post->ID,'wd_member_twitter_link',true);
											$member_rss		= get_post_meta($post->ID,'wd_member_rss_link',true);
											$member_google	= get_post_meta($post->ID,'wd_member_google_link',true);
											$member_linke	= get_post_meta($post->ID,'wd_member_linkedlin_link',true);
											$member_dribble	= get_post_meta($post->ID,'wd_member_dribble_link',true);
										?>
										<li>
											<img src="<?php the_post_thumbnail_url(); ?>" alt="" class="sc-image">
											<div class="sc-content">																						
												<div class="avartar">
													<?php echo esc_attr($content); ?>
													<div class="social-icons">
														<ul>
															<li class="icon-facebook">	<a class="fa fa-facebook" href="<?php echo esc_url($member_face); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>				
															<li class="icon-twitter">	<a class="fa fa-twitter" href="<?php echo esc_url($member_twitter); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
															<li class="icon-rss">		<a class="fa fa-rss" href="<?php echo esc_url($member_rss); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
															<li class="icon-google">	<a class="fa fa-google-plus" href="<?php echo esc_url($member_google); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>
															<li class="icon-instagram">	<a class="fa fa-instagram" href="<?php echo esc_url($member_linke); ?>" target="_blank" title="<?php echo esc_attr($name); ?>" ></a></li>	
														</ul>
													</div>
													<div class="wd-member-name-role">
														<h3><?php echo esc_attr($name); ?></h3>
														<span class="wd_member_role"><?php echo esc_attr($member_role); ?></span>
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
								selectedItemZoomFactor: 1,
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
			<!-- End test -->
				<?php endif; ?>				
			<?php } // End if ?>
		</div>

		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('wd_team_member', 'wd_team_member_function');
?>