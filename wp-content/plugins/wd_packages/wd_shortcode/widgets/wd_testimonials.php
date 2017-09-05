<?php
if( post_type_exists('testimonial') || class_exists('Woothemes_Testimonials') ){
	if( !class_exists( 'tvlgiao_wpdance_widget_testimonials' ) ) {
		class tvlgiao_wpdance_widget_testimonials extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_testimonials', 'description' => esc_html__('Testimonials Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('testimonials', esc_html__('WD - Testimonials','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		       	
		        $show_avatar      	= esc_attr( isset( $instance['show_avatar'] ) ? $instance['show_avatar'] : '1' );
		        $show_author      	= esc_attr( isset( $instance['show_author'] ) ? $instance['show_author'] : '1' );
		        $show_rating      	= esc_attr( isset( $instance['show_rating'] ) ? $instance['show_rating'] : '1' );
		        $limit_post   	 	= esc_attr( isset( $instance['limit_post'] ) ? $instance['limit_post'] : '-1' );
		        $per_slide  		= esc_attr( isset( $instance['per_slide'] ) ? $instance['per_slide'] : '1' );
		        $number_excerpt  	= esc_attr( isset( $instance['number_excerpt'] ) ? $instance['number_excerpt'] : '20' );
		        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );

				$yes_no = array(
					'1'	=> 'Yes',
					'0'	=> 'No',
				)
		        ?>
		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('show_avatar')); ?>"><?php esc_html_e('Show Avatar:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_avatar')); ?>" id="<?php echo esc_attr($this->get_field_id('show_avatar')); ?>">
							<?php foreach( $yes_no as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_avatar==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('show_author')); ?>"><?php esc_html_e('Show Author:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_author')); ?>" id="<?php echo esc_attr($this->get_field_id('show_author')); ?>">
							<?php foreach( $yes_no as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_author==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('show_rating')); ?>"><?php esc_html_e('Show Rating:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_rating')); ?>" id="<?php echo esc_attr($this->get_field_id('show_rating')); ?>">
							<?php foreach( $yes_no as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_rating==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
				       <label for="<?php echo $this->get_field_id( 'limit_post' ); ?>"><?php _e( 'Limit Post:', 'wpdancelaparis' ); ?></label>
				        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('limit_post'); ?>" name="<?php echo $this->get_field_name('limit_post'); ?>"><?php echo $limit_post; ?></textarea>
				    </p>

				    <p>
				       <label for="<?php echo $this->get_field_id( 'per_slide' ); ?>"><?php _e( 'Testimonial Per Slide:', 'wpdancelaparis' ); ?></label>
				        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('per_slide'); ?>" name="<?php echo $this->get_field_name('per_slide'); ?>"><?php echo $per_slide; ?></textarea>
				    </p>

				    <p>
		                <label for="<?php echo $this->get_field_id( 'number_excerpt' ); ?>"><?php esc_html_e( 'Number of excerpt words:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'number_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'number_excerpt' ); ?>" type="text" value="<?php echo $number_excerpt; ?>" />
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
		        $show_avatar   	  	  	  = $instance['show_avatar'];
		        $show_author   	  	  	  = $instance['show_author'];
		        $show_rating   	  	  	  = $instance['show_rating'];
		        $limit_post   	  	  	  = $instance['limit_post'];
		        $per_slide   	  	  	  = $instance['per_slide'];
		        $number_excerpt   	  	  = $instance['number_excerpt'];
		        $class   	  	  		  = $instance['class'];


		        $args 	= array( 
					'post_type' 			=> 'testimonial',
					'post_status' 			=> 'publish',
					'posts_per_page'		=> $limit_post,
				);
				
				
				$rating = '<div class="star-rating" title="Rated 5 out of 5"><span style="width:100%"><strong class="rating">5</strong> out of 5</span></div>';
				wp_reset_postdata();
				$testimonials 	= new WP_Query($args);
				$random_id 		= 'wd-testimonials-'.mt_rand();
		        
		        echo $before_widget;
		        ?>
					<?php if ( $testimonials->have_posts() ) : ?>
					<div class="wd-shortcode-testimonials wd-style-slider-testimonial_1 <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($random_id); ?>">
						<div class="wd-testimonial-wrapper">
							<?php $count = 1; ?>
							<div class="widget_per_slide">
								<?php while ($testimonials->have_posts()) : $testimonials->the_post(); global $post;
									$_url 				= esc_url(get_post_meta($post->ID,'_url',true));
									$byline				= get_post_meta( $post->ID, '_byline', true );
									?>
										<div class="wd-testimonial <?php echo $count; ?>">
											<div class="wd-testimonials">
												<?php if( $show_avatar ): ?>
													<div class="wd-avatar">
														<a href="<?php echo esc_url($_url); ?>">
															<?php the_post_thumbnail('woo_shortcode', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ));?>
														</a>
													</div>
												<?php endif; ?>
												<div class="wd-info-testimonial">	
													<div class='wd-conent-testimonial'>
														<?php echo tvlgiao_wpdance_string_limit_words(get_the_content(),$number_excerpt).' [...]'; ?>
													</div>
													<?php if( $show_author ){ ?>
															<div class="wd-author-byline">
																<span class="wd-author"><a class="title" href="<?php echo esc_url($_url); ?>"><?php the_title();?></a></span>
																<span class="wd-byline"><?php echo esc_attr($byline); ?></span>
															</div>
														<?php } ?>
													<?php if( $show_rating ): ?>
														<div class="rating"><?php echo ($rating); ?></div>
													<?php endif; ?>
													
												</div>
												
											</div>					
										</div>
										<?php if(($count % $per_slide == 0 && $count < $testimonials->post_count)){ ?>
											</div>
											<div class="widget_per_slide">
										<?php } ?>
										
									<?php $count++; ?>	
								<?php endwhile; // End While ?>		
							</div>	
						</div>
					</div>
					
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";					
							var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
							var _auto_play = 1;
							var owl = $_this.find('.wd-testimonial-wrapper').owlCarousel({
								loop : true,
								items : 1,
								nav : false,
								dots : true,
								navSpeed : 1000,
								slideBy: 2,
								rtl:jQuery('body').hasClass('rtl'),
								navRewind: false,
								autoplay: _auto_play,
								autoplayTimeout: 5000,
								autoplayHoverPause: true,
								autoplaySpeed: false,
								mouseDrag: true,
								touchDrag: true,
								responsiveBaseElement: $_this,
								responsiveRefreshRate: 1000,
								onInitialized: function(){}
							});
							$_this.on('click', '.next', function(e){
								e.preventDefault();
								owl.trigger('next.owl.carousel');
							});

							$_this.on('click', '.prev', function(e){
								e.preventDefault();
								owl.trigger('prev.owl.carousel');
							});
						});
					</script>
				<?php endif; ?>	
		        <?php
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['show_avatar']            = strip_tags( $new_instance['show_avatar'] );
		        $instance['show_author']        	= strip_tags( $new_instance['show_author'] );
		        $instance['show_rating']      		= strip_tags( $new_instance['show_rating'] );
		        $instance['limit_post']      		= strip_tags( $new_instance['limit_post'] );
		        $instance['per_slide']      		= strip_tags( $new_instance['per_slide'] );
		        $instance['number_excerpt']      	= strip_tags( $new_instance['number_excerpt'] );
		        $instance['class']            		= strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wp_widget_register_widget_testimonials() {
			register_widget( 'tvlgiao_wpdance_widget_testimonials' );
		}
		add_action( 'widgets_init', 'wp_widget_register_widget_testimonials' );
	}
}
?>