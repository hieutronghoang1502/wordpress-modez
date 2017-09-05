<?php
if( post_type_exists('testimonial') || class_exists('Woothemes_Testimonials') ){
	if( !class_exists( 'tvlgiao_wpdance_widget_testimonials_plus' ) ) {
		class tvlgiao_wpdance_widget_testimonials_plus extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_testimonials_plus', 'description' => esc_html__('Testimonials Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('testimonials_plus', esc_html__('WD - Testimonials','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		       	
		        $slider_or_one      	= esc_attr( isset( $instance['slider_or_one'] ) ? $instance['slider_or_one'] : '1' );
		        $id_testimonial      	= esc_attr( isset( $instance['id_testimonial'] ) ? $instance['id_testimonial'] : '-1' );
		        $style_testimonial      = esc_attr( isset( $instance['style_testimonial'] ) ? $instance['style_testimonial'] : 'style-1' );
		        $style_slider_testimonial = esc_attr( isset( $instance['style_slider_testimonial'] ) ? $instance['style_slider_testimonial'] : 'style-1' );
		        $show_avatar  		= esc_attr( isset( $instance['show_avatar'] ) ? $instance['show_avatar'] : '1' );
		        $show_author  		= esc_attr( isset( $instance['show_author'] ) ? $instance['show_author'] : '1' );
		        $number_excerpt  	= esc_attr( isset( $instance['number_excerpt'] ) ? $instance['number_excerpt'] : '20' );
		        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );

	        	$testimonials_options = array();
				$args = array(
					'post_type'			=> 'testimonial'
					,'post_status'		=> 'publish'
					,'posts_per_page' 	=> -1
				);
				$testimonials_options = tvlgiao_wpdance_get_data($args);	

	        	$slider_or_one_arr = array(
					'1'	=> 'One Testimonials',
					'0'			=> 'Slider'
				);

				$style_testimonial_arr = array(
					 'style-1'			=> 'Style 1',
					 'style-2'			=> 'Style 2',
					 'style-3'			=> 'Style 3',
					 'style-4'			=> 'Style 4',
					 'style-5'			=> 'Style 5',
				);
				$style_slider_testimonial_arr = array(
					 'style-1'			=> 'Style 1',
					 'style-2'			=> 'Style 2',
				);

				$yes_no = array(
					'1'	=> 'Yes',
					'0'	=> 'No',
				);
		        ?>
		            <p>
						<label for="<?php echo esc_attr( $this->get_field_id('slider_or_one')); ?>"><?php esc_html_e('Slider Or One Testimonials:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('slider_or_one')); ?>" id="<?php echo esc_attr($this->get_field_id('slider_or_one')); ?>">
							<?php foreach( $slider_or_one_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($slider_or_one==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('id_testimonial')); ?>"><?php esc_html_e('Select Testimonials (One Testimonials):','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id_testimonial')); ?>" id="<?php echo esc_attr($this->get_field_id('id_testimonial')); ?>">
							<?php foreach( $testimonials_options as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($id_testimonial==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('style_testimonial')); ?>"><?php esc_html_e('Style (One Testimonials):','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_testimonial')); ?>" id="<?php echo esc_attr($this->get_field_id('style_testimonial')); ?>">
							<?php foreach( $style_testimonial_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($style_testimonial==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('style_slider_testimonial')); ?>"><?php esc_html_e('Style Slider (One Testimonials):','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_slider_testimonial')); ?>" id="<?php echo esc_attr($this->get_field_id('style_slider_testimonial')); ?>">
							<?php foreach( $style_slider_testimonial_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($style_slider_testimonial==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('style_slider_testimonial')); ?>"><?php esc_html_e('Style Slider (One Testimonials):','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_slider_testimonial')); ?>" id="<?php echo esc_attr($this->get_field_id('style_slider_testimonial')); ?>">
							<?php foreach( $style_slider_testimonial_arr as $key => $value ){ ?>
							<option value="<?php echo esc_attr($key); ?>" <?php echo ($style_slider_testimonial==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
							<?php } ?>
						</select>
					</p>

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
		        $slider_or_one   	  	  = $instance['slider_or_one'];
		        $id_testimonial   	  	  = $instance['id_testimonial'];
		        $style_testimonial   	  = $instance['style_testimonial'];
		        $style_slider_testimonial = $instance['style_slider_testimonial'];
		        $show_avatar   	  	  	  = $instance['show_avatar'];
		        $show_author   	  	  	  = $instance['show_author'];
		        $number_excerpt   	  	  = $instance['number_excerpt'];
		        $class   	  	  		  = $instance['class'];


		        $args 	= array( 
					'post_type' 	=> 'testimonial'
					,'post_status' 			=> 'publish',
				);
		
				if($slider_or_one == "1"){
					$args['p'] =  $id_testimonial;
				}else{
					$args['posts_per_page']  	=  4;
					$style_testimonial 			= "wd-style-slider-testimonial ".$style_slider_testimonial;
				}
				$rating = '<div class="star-rating" title="Rated 5 out of 5"><span style="width:100%"><strong class="rating">5</strong> out of 5</span></div>';
				wp_reset_postdata();
				$testimonials 	= new WP_Query($args);
				$random_id = 'wd_shortcode_testimonial_'.mt_rand();
		        
		        echo $before_widget;
		        ?>
		        <?php if ( $testimonials->have_posts() ) : ?>
					<div class="wd-shortcode-testimonials <?php echo esc_attr($class); ?> <?php echo esc_attr($style_testimonial); ?>" id="<?php echo esc_attr($random_id ); ?>">
						<?php while ($testimonials->have_posts()) : $testimonials->the_post(); global $post;
							$_url 				= esc_url(get_post_meta($post->ID,'_url',true));
							$byline				= get_post_meta( $post->ID, '_byline', true );
						?>
							<div class="wd-testimonial">
								<?php if($style_testimonial == "style-1" || $style_testimonial == "style-4" || $style_testimonial == "style-5") { ?>
									<div class='wd-conent-testimonial'>
										<?php if($style_testimonial == "style-4"){ ?>
										<blockquote class="testimonial-body">
											<?php echo tvlgiao_wpdance_string_limit_words(get_the_content(),$number_excerpt).' [...]'; ?>
										</blockquote>
										<?php }else{ ?>
											<?php echo tvlgiao_wpdance_string_limit_words(get_the_content(),$number_excerpt).' [...]'; ?>
										<?php } ?>
									</div>
									<div class="wd-info-testimonial">
										<?php if( $show_avatar ): ?>
											<div class="wd-avatar">
												<a href="<?php echo esc_url($_url); ?>"><?php the_post_thumbnail('woo_shortcode', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ));?></a>
											</div>
										<?php endif; ?>		
										<?php if( $show_author ){ ?>
											<div class="wd-author-byline">
												<span class="wd-author"><a class="title" href="<?php echo esc_url($_url); ?>"><?php the_title();?></a></span>
												<span class="wd-byline"><?php echo esc_attr($byline); ?></span>
											</div>
											<?php if($style_testimonial == 'style-5') echo ($rating); ?>
										<?php } ?>
									</div>							
								<?php }else{ ?>
									<?php if( $show_avatar ): ?>
										<div class="wd-avatar">
											<a href="<?php echo esc_url($_url); ?>"><?php the_post_thumbnail('woo_shortcode', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ));?></a>
										</div>
									<?php endif; ?>
									<div class="wd-info-testimonial">
										<?php if($style_testimonial == "style-2"){ ?>
											<?php if( $show_author ){ ?>
												<div class="wd-author-byline">
													<span class="wd-author"><a class="title" href="<?php echo esc_url($_url); ?>"><?php the_title();?></a></span>
													<span class="wd-byline"><?php echo esc_attr($byline); ?></span>
												</div>
											<?php } ?>
											<div class='wd-conent-testimonial'>
												<?php echo tvlgiao_wpdance_string_limit_words(get_the_content(),$number_excerpt).' [...]'; ?>
											</div>
											<?php echo ($rating); ?>
										<?php }else{ ?>
											<div class='wd-conent-testimonial'>
												<?php if($style_testimonial == "style-4"){ ?>
													<blockquote class="testimonial-body">
														<?php echo tvlgiao_wpdance_string_limit_words(get_the_content(),$number_excerpt).' [...]'; ?>
													</blockquote>
												<?php }else{ ?>
													<?php echo tvlgiao_wpdance_string_limit_words(get_the_content(),$number_excerpt).' [...]'; ?>
												<?php } ?>
											</div>
											<?php if( $show_author ){ ?>
												<div class="wd-author-byline">
													<span class="wd-author"><a class="title" href="<?php echo esc_url($_url); ?>"><?php the_title();?></a></span>
													<span class="wd-byline"><?php echo esc_attr($byline); ?></span>
												</div>
											<?php } ?>
										<?php } ?>
									</div>
								<?php };  // End If?>
							</div>			
						<?php endwhile; // End While ?>		
					</div>
					<?php if($slider_or_one == '0') : ?>
						<script type="text/javascript">
							jQuery(document).ready(function(){
								"use strict";					
								var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
								var _auto_play = 1;
								var owl = $_this.owlCarousel({
									loop : true
									,items : 1
									<?php if($style_slider_testimonial == "style-2"){ ?>
									,nav : false
									,dots : true
									<?php }else{ ?>
									,nav : true
									,dots : false
									<?php } ?>
									,navSpeed : 1000
									,slideBy: 1
									,rtl:jQuery('body').hasClass('rtl')
									,navRewind: false
									,autoplay: _auto_play
									,autoplayTimeout: 5000
									,autoplayHoverPause: true
									,autoplaySpeed: false
									,mouseDrag: true
									,touchDrag: true
									,responsiveBaseElement: $_this
									,responsiveRefreshRate: 1000
									,onInitialized: function(){
									}
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
				<?php endif; ?>
		        <?php
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['slider_or_one']          = strip_tags( $new_instance['slider_or_one'] );
		        $instance['id_testimonial']        	= strip_tags( $new_instance['id_testimonial'] );
		        $instance['style_testimonial']      = strip_tags( $new_instance['style_testimonial'] );
		        $instance['style_slider_testimonial'] = strip_tags( $new_instance['style_slider_testimonial'] );
		        $instance['show_avatar']      		= strip_tags( $new_instance['show_avatar'] );
		        $instance['show_author']      		= strip_tags( $new_instance['show_author'] );
		        $instance['number_excerpt']      	= strip_tags( $new_instance['number_excerpt'] );
		        $instance['class']            		= strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wp_widget_register_widget_testimonials_plus() {
			register_widget( 'tvlgiao_wpdance_widget_testimonials_plus' );
		}
		add_action( 'widgets_init', 'wp_widget_register_widget_testimonials_plus' );
	}
}
?>