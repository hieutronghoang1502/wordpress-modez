<?php
if( !class_exists( 'tvlgiao_wpdance_widget_special_blog' ) ) {
	class tvlgiao_wpdance_widget_special_blog extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_special_blog', 'description' => esc_html__('Special Blog Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('special_blog', esc_html__('WD - Special Blog','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $title   				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $number   				= esc_attr( isset( $instance['number'] ) ? $instance['number'] : '6' );
	        $data_post   			= esc_attr( isset( $instance['data_post'] ) ? $instance['data_post'] : 'recent-post' );
	        $columns   				= esc_attr( isset( $instance['columns'] ) ? $instance['columns'] : '3' );
	        $style   				= esc_attr( isset( $instance['style'] ) ? $instance['style'] : 'grid' );
	        $show_title   			= esc_attr( isset( $instance['show_title'] ) ? $instance['show_title'] : '1' );
	        $show_thumbnail   		= esc_attr( isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '1' );
	        $show_placeholder_image = esc_attr( isset( $instance['show_placeholder_image'] ) ? $instance['show_placeholder_image'] : '0' );
	        $show_author   			= esc_attr( isset( $instance['show_author'] ) ? $instance['show_author'] : '1' );
	        $show_category   		= esc_attr( isset( $instance['show_category'] ) ? $instance['show_category'] : '1' );
	        $show_date   			= esc_attr( isset( $instance['show_date'] ) ? $instance['show_date'] : '1' );
	        $show_number_comments   = esc_attr( isset( $instance['show_number_comments'] ) ? $instance['show_number_comments'] : '1' );
	        $show_excerpt   		= esc_attr( isset( $instance['show_excerpt'] ) ? $instance['show_excerpt'] : '1' );
	        $number_excerpt   		= esc_attr( isset( $instance['number_excerpt'] ) ? $instance['number_excerpt'] : '20' );
	        $show_readmore   		= esc_attr( isset( $instance['show_readmore'] ) ? $instance['show_readmore'] : '1' );
	        $is_slider   			= esc_attr( isset( $instance['is_slider'] ) ? $instance['is_slider'] : '1' );
	        $show_nav   			= esc_attr( isset( $instance['show_nav'] ) ? $instance['show_nav'] : '1' );
	        $auto_play   			= esc_attr( isset( $instance['auto_play'] ) ? $instance['auto_play'] : '1' );
	        $per_slide   			= esc_attr( isset( $instance['per_slide'] ) ? $instance['per_slide'] : '3' );
	       
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			$data_post_arr 	= array(
				'recent-post' 	=> 'Recent Post',
				'most-view' 	=> 'Most View Post'
			);
			$style_arr 	= array(
				'grid'		=> 'Grid',
				'list'		=> 'List'
			);
			
			$yes_no 	= array(
				'1' 		=> 'Yes',
				'0' 		=> 'No',
			);
			$no_yes 	= array(
				'0' 		=> 'No',
				'1' 		=> 'Yes',
			);
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number Post:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
	                </label>
	            </p>
			
	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('data_post')); ?>"><?php esc_html_e('Data Show:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('data_post')); ?>" id="<?php echo esc_attr($this->get_field_id('data_post')); ?>">
						<?php foreach( $data_post_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($data_post==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php esc_html_e( 'Columns:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" type="text" value="<?php echo $columns; ?>" />
	                </label>
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
					<label for="<?php echo esc_attr( $this->get_field_id('show_title')); ?>"><?php esc_html_e('Show Title:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_title')); ?>" id="<?php echo esc_attr($this->get_field_id('show_title')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_title==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_thumbnail')); ?>"><?php esc_html_e('Show Thumbnail:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_thumbnail')); ?>" id="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_thumbnail==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_placeholder_image')); ?>"><?php esc_html_e('Show Placeholder image:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_placeholder_image')); ?>" id="<?php echo esc_attr($this->get_field_id('show_placeholder_image')); ?>">
						<?php foreach( $no_yes as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_placeholder_image==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
					<label for="<?php echo esc_attr( $this->get_field_id('show_category')); ?>"><?php esc_html_e('Show Category:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_category')); ?>" id="<?php echo esc_attr($this->get_field_id('show_category')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_category==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_date')); ?>"><?php esc_html_e('Show Date:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_date')); ?>" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_date==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_number_comments')); ?>"><?php esc_html_e('Show Number Comment:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_number_comments')); ?>" id="<?php echo esc_attr($this->get_field_id('show_number_comments')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_number_comments==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_excerpt')); ?>"><?php esc_html_e('Show Excerpt:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_excerpt')); ?>" id="<?php echo esc_attr($this->get_field_id('show_excerpt')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_excerpt==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'number_excerpt' ); ?>"><?php esc_html_e( 'Number Excerpt:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'number_excerpt' ); ?>" type="text" value="<?php echo $number_excerpt; ?>" />
	                </label>
	            </p>

	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_readmore')); ?>"><?php esc_html_e('Show Readmore:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_readmore')); ?>" id="<?php echo esc_attr($this->get_field_id('show_readmore')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_readmore==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>
				
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('is_slider')); ?>"><?php esc_html_e('Is slider:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('is_slider')); ?>" id="<?php echo esc_attr($this->get_field_id('is_slider')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($is_slider==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_nav')); ?>"><?php esc_html_e('Show nav:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_nav')); ?>" id="<?php echo esc_attr($this->get_field_id('show_nav')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_nav==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('auto_play')); ?>"><?php esc_html_e('Auto Play:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('auto_play')); ?>" id="<?php echo esc_attr($this->get_field_id('auto_play')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($auto_play==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'per_slide' ); ?>"><?php esc_html_e( 'Per Slider:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'per_slide' ); ?>" name="<?php echo $this->get_field_name( 'per_slide' ); ?>" type="text" value="<?php echo $per_slide; ?>" />
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
	        $title   	  			= $instance['title'];
	        $number  				= $instance['number'];
	        $data_post    			= $instance['data_post'];
	        $columns    			= $instance['columns'];
	        $style    				= $instance['style'];
	        $show_title 			= $instance['show_title'];
	        $show_thumbnail 		= $instance['show_thumbnail'];
	        $show_placeholder_image = $instance['show_placeholder_image'];
	        $show_author    		= $instance['show_author'];
	        $show_category  		= $instance['show_category'];
	        $show_date    			= $instance['show_date'];
	        $show_number_comments   = $instance['show_number_comments'];
	        $show_excerpt   		= $instance['show_excerpt'];
	        $number_excerpt 		= $instance['number_excerpt'];
	        $show_readmore    			= $instance['show_readmore'];
	        $is_slider    			= $instance['is_slider'];
	        $show_nav    			= $instance['show_nav'];
	        $auto_play    			= $instance['auto_play'];
	        $per_slide    			= $instance['per_slide'];
	        $class   	  			= $instance['class'];

	        $grid_list_class 	= "wd-blog-grid-style";
			if($style == 'list'){
				$grid_list_class = "wd-blog-list-style";
			}
        	$show_detail = 0;
			$args = array(
				'post_type'				=> 'post',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page'		=> $number,
				'post_status'			=> 'publish'
			);
			if($data_post == 'most-view'){
				$args['meta_key'] 		= '_wd_post_views_count';
				$args['orderby'] 		= 'meta_value_num';
				$args['order'] 			= 'DESC';
			}
			wp_reset_query();
			$recent_posts = new WP_Query($args);

	        echo $before_widget;
	        if ( $recent_posts->have_posts() ) {
				$num_post =  $recent_posts->post_count;
				if( $num_post < 2 || $num_post <= $per_slide ){
					$is_slider = 0;
				}
				$random_id = 'wd_special_post'.mt_rand();
				?>
				<div class="wd-special-post-wrapper wd-widget-blog-specicel <?php echo ($show_nav)?'has_navi':''; ?> <?php echo esc_attr( $grid_list_class ); ?> <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $random_id ); ?>">
					<?php if($title != "") : ?>
						<?php 			
						echo wp_kses_post($before_title . $title . $after_title); 
						?>
					<?php endif; ?>
					<div class="widget-list-post-inner">
						<?php
						$count = 0;	
						while( $recent_posts->have_posts() ) {
							$recent_posts->the_post();
							global $post;
							if ($count == 0 || $count % $per_slide == 0 ){ ?>
								<div class="widget-per-slide">
									<ul>
							<?php } ?>
									<li> 
										<div class="wd-wrap-content-blog"> 
											<!-- Post type: Show Thumbnail -->
											<?php if( has_post_thumbnail() && $show_thumbnail ): ?>
												<div class="wd-thumbnail-post">
													<a class="thumbnail" href="<?php the_permalink(); ?>">
														<?php
															the_post_thumbnail('post-thumbnail', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title())));
														?>
													</a>
												</div>
											<?php elseif( $show_placeholder_image && $show_thumbnail ): ?>
												<?php echo tvlgiao_wpdance_get_thumb_placeholder_image(); ?>
											<?php endif; // End If ?> 

											<div class="wd-info-post">
												<!-- Show Post Title -->
												<?php tvlgiao_wpdance_display_post_title($show_title); ?>
												<div class="wd-meta-post">
													<!-- Sticky Post -->
													<?php tvlgiao_wpdance_display_post_sticky(); ?>
													<!-- Show Post Author -->
													<?php tvlgiao_wpdance_display_post_author($show_author); ?>
													<!-- Show Post Category -->
													<?php tvlgiao_wpdance_display_post_category($show_category); ?>
													<!-- Show Post Date -->
													<?php tvlgiao_wpdance_display_post_date($show_date); ?>
													<!-- Show Number Comment -->
													<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
												</div>
												<!-- Show Post Excerpt -->
												<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt, $number_excerpt); ?>
												<!-- Show Readmore Button -->
												<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
											</div>
										</div>
									</li>
							<?php $count++; if( $count % $per_slide == 0 || $count == $num_post){ ?>
									</ul>
								</div>
							<?php
							}
						} ?>
					</div>
					<?php if( $show_nav && $is_slider ){ ?>
						<div class="slider_control">
							<a href="#" class="prev">&lt;</a>
							<a href="#" class="next">&gt;</a>
						</div>
					<?php } ?>
				</div>

				<?php if( $is_slider ) : ?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";						
							var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
							var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
							var owl = $_this.find('.widget-list-post-inner').owlCarousel({
								loop : true,
								items : 1,
								nav : false,
								dots : false,
								navSpeed : 1000,
								slideBy: 1,
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
								responsive:{
									0:{
										items : 1
									},
									300:{
										items : 1
									},
									579:{
										items : <?php if($columns > 5){echo 3;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns - 1;}else{echo $columns;}  ?>
									},
									767:{
										items : <?php if($columns > 5){echo 4;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns;}else{echo $columns;}  ?>
									},
									1100:{
										items : <?php echo $columns ?>
									}
								},
								onInitialized: function(){
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
				<?php endif; // End if			
			}
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']            		= strip_tags( $new_instance['title'] );
	        $instance['number']          		= strip_tags( $new_instance['number'] );
	        $instance['data_post']        	 	= strip_tags( $new_instance['data_post'] );
	        $instance['columns']        		= strip_tags( $new_instance['columns'] );
	        $instance['style']            		= strip_tags( $new_instance['style'] );
	        $instance['show_title']         	= strip_tags( $new_instance['show_title'] );
	        $instance['show_thumbnail']         = strip_tags( $new_instance['show_thumbnail'] );
	        $instance['show_placeholder_image'] = strip_tags( $new_instance['show_placeholder_image'] );
	        $instance['show_author']    		= strip_tags( $new_instance['show_author'] );
	        $instance['show_category']    		= strip_tags( $new_instance['show_category'] );
	        $instance['show_date']        		= strip_tags( $new_instance['show_date'] );
	        $instance['show_number_comments']   = strip_tags( $new_instance['show_number_comments'] );
	        $instance['show_excerpt']        	= strip_tags( $new_instance['show_excerpt'] );
	        $instance['number_excerpt']         = strip_tags( $new_instance['number_excerpt'] );
	        $instance['show_readmore']        	= strip_tags( $new_instance['show_readmore'] );
	        $instance['is_slider']            	= strip_tags( $new_instance['is_slider'] );
	        $instance['show_nav']            	= strip_tags( $new_instance['show_nav'] );
	        $instance['auto_play']            	= strip_tags( $new_instance['auto_play'] );
	        $instance['per_slide']            	= strip_tags( $new_instance['per_slide'] );
	        $instance['class']            		= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_special_blog() {
		register_widget( 'tvlgiao_wpdance_widget_special_blog' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_special_blog' );
}
?>