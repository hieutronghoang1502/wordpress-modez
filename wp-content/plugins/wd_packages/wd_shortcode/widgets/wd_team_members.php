<?php
$_active_vc = apply_filters('active_plugins',get_option('active_plugins'));
if(in_array('wd_team/wd_team.php',$_active_vc)){
	if( !class_exists( 'tvlgiao_wpdance_widget_team_members' ) ) {
		class tvlgiao_wpdance_widget_team_members extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_team_members', 'description' => esc_html__('Team Members Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('team_members', esc_html__('WD - Team Members','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		       	
		        $slider_or_one  = esc_attr( isset( $instance['slider_or_one'] ) ? $instance['slider_or_one'] : '1' );
		        $id_team  		= esc_attr( isset( $instance['id_team'] ) ? $instance['id_team'] : '-1' );
		        $style  		= esc_attr( isset( $instance['style'] ) ? $instance['style'] : 'style-1' );
		        $number_teammember  		= esc_attr( isset( $instance['number_teammember'] ) ? $instance['number_teammember'] : '5' );
		        $columns  		= esc_attr( isset( $instance['columns'] ) ? $instance['columns'] : '4' );
		        $number  		= esc_attr( isset( $instance['number'] ) ? $instance['number'] : '100' );
		        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


				$team_member_array = array();
				$team_member_array[-1] = esc_html__('Select Teammember','wpdancelaparis');
				$args = array(
						'post_type'			=> 'team',
						'post_status'		=> 'publish',
						'posts_per_page'	=> -1
					);
				$members = new WP_Query($args);		
				if( $members->have_posts() ){
					while( $members->have_posts() ){
						$members->the_post();
						global $post;
						$team_member_array[$post->ID] = $post->post_title;
					}
				}
				wp_reset_postdata();

				$slider_or_one_arr = array(
					'1'			=> 'One Team Member',
					'2'			=> 'Many Team Members (Grid)',
					'0'			=> 'Many Team Members (Slider)'
					
				);

				$columns_arr = array(
					'4'	=> '4 Cols',
					'3'	=> '3 Cols',
					'2'	=> '2 Cols',
					'1'	=> '1 Col',
				);

				$style_arr = array(
					'style-1'	=> 'Style 1',
					'style-2'	=> 'Style 2',
					'style-3'	=> 'Style 3',
					'style-4'	=> 'Style 4',
					'style-5'	=> 'Style 5',
					'style-6'	=> 'Style 6',
					'style-7'	=> 'Style 7',
				);
		        ?>
		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('slider_or_one')); ?>"><?php esc_html_e('Slider Or One Teammember:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('slider_or_one')); ?>" id="<?php echo esc_attr($this->get_field_id('slider_or_one')); ?>">
							<?php foreach( $slider_or_one_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($slider_or_one==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('id_team')); ?>"><?php esc_html_e('Select Team (Single):','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id_team')); ?>" id="<?php echo esc_attr($this->get_field_id('id_team')); ?>">
							<?php foreach( $team_member_array as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($id_team==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					
					
					<p>
		                <label for="<?php echo $this->get_field_id( 'number_teammember' ); ?>"><?php esc_html_e( 'Number Teammember (Multi):', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'number_teammember' ); ?>" name="<?php echo $this->get_field_name( 'number_teammember' ); ?>" type="text" value="<?php echo $number_teammember; ?>" />
		                </label>
		            </p>


		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('columns')); ?>"><?php esc_html_e('Columns (Multi):','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('columns')); ?>" id="<?php echo esc_attr($this->get_field_id('columns')); ?>">
							<?php foreach( $columns_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($columns==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('style')); ?>"><?php esc_html_e('Style:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
							<?php foreach( $style_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($style==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

		            <p>
		                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number word content:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
		                </label>
		            </p>

		            <p>
		                <label for="<?php echo $this->get_field_id( 'class' ); ?>"><?php esc_html_e( 'Extra class name:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" type="text" value="<?php echo $class; ?>" />
		                </label>
		            </p>
		        <?php
		    }
		    function widget( $args, $instance )
		    {
		        extract($args);
		        $slider_or_one   	  	  = $instance['slider_or_one'];
		        $id_team   	  	  		  = $instance['id_team'];
		        $style   	  	 		  = $instance['style'];
		        $number_teammember   	  = $instance['number_teammember'];
		        $columns   	 			  = isset($instance['columns']) ? $instance['columns'] : 4;
		        $class_column 			  = 'wd-team-member-item';
		        if ($slider_or_one == '2') {
		        	$class_column .= ' col-md-'.(24/$columns);
		        }
		        
		        $number   	  	   		  = $instance['number'];
		        $class   	  	  		  = $instance['class'];

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
		        
		        echo $before_widget;
		        ?>
					<div class="wd-team-member <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?>" >
						<?php if($id_team == '-1' && $slider_or_one == '1'){ ?>
							<p><?php esc_html_e('Please select team','wpdancelaparis'); ?></p>
						<?php }else{ ?>
							<?php if($slider_or_one == '1' || $slider_or_one == '2'): ?>
								<?php $i = 1; ?>
								<?php if ($slider_or_one == '2'): ?>
									<div class="row">
								<?php endif ?>
								
									<?php while ($teammember->have_posts()) : $teammember->the_post(); global $post; ?>
										<div class="<?php echo esc_attr($class_column) ?>" >
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
												<a class="image" title="<?php echo esc_attr($name); ?>" ><?php the_post_thumbnail('full'); ?><div class="thumbnail-effect"></div> </a>
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
										</div>

									<?php if ($i%$columns == 0): ?>
										</div>
										<div class="row">
									<?php endif ?>
									
									<?php $i++; ?>
								<?php endwhile;// End While ?>
								<?php if ($slider_or_one == '2'): ?>
									</div>
								<?php endif ?>
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
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['slider_or_one']      = strip_tags( $new_instance['slider_or_one'] );
		        $instance['id_team']            = strip_tags( $new_instance['id_team'] );
		        $instance['style']            	= strip_tags( $new_instance['style'] );
		        $instance['number_teammember']  = strip_tags( $new_instance['number_teammember'] );
		        $instance['number']            	= strip_tags( $new_instance['number'] );
		        $instance['class']            	= strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wp_widget_register_widget_team_members() {
			register_widget( 'tvlgiao_wpdance_widget_team_members' );
		}
		add_action( 'widgets_init', 'wp_widget_register_widget_team_members' );
	}
}

?>