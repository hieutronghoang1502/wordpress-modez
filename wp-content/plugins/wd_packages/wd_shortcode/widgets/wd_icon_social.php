<?php
if( !class_exists( 'tvlgiao_wpdance_widget_icon_social' ) ) {
	class tvlgiao_wpdance_widget_icon_social extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_icon_social', 'description' => esc_html__('Icon Social Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('icon_social', esc_html__('WD - Icon Social','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $style  				= esc_attr( isset( $instance['style'] ) ? $instance['style'] : 'style-1' );
	        $size  					= esc_attr( isset( $instance['size'] ) ? $instance['size'] : 'fa-2' );
	        $show_title  			= esc_attr( isset( $instance['show_title'] ) ? $instance['show_title'] : '1' );
	        $rss_url  				= esc_attr( isset( $instance['rss_url'] ) ? $instance['rss_url'] : '#' );
	        $twitter_url  			= esc_attr( isset( $instance['twitter_url'] ) ? $instance['twitter_url'] : '#' );
	        $facebook_url  			= esc_attr( isset( $instance['facebook_url'] ) ? $instance['facebook_url'] : '#' );
	        $google_url  			= esc_attr( isset( $instance['google_url'] ) ? $instance['google_url'] : '#' );
	        $pin_url  				= esc_attr( isset( $instance['pin_url'] ) ? $instance['pin_url'] : '#' );
	        $youtube_url  			= esc_attr( isset( $instance['youtube_url'] ) ? $instance['youtube_url'] : '#' );
	        $instagram_url  		= esc_attr( isset( $instance['instagram_url'] ) ? $instance['instagram_url'] : '#' );
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
        	$size_arr = array(
				'fa-2'			=> '2x',
				'fa-1'			=> '1x',
				'fa-3'			=> '3x',
				'fa-4'			=> '4x',
				'fa-5'			=> '5x',
				'fa-6'			=> '6x',
			);

			$style_arr = array(
				'style-1'			=> 'Style 1',
				'style-2'			=> 'Style 2',
				'style-3'			=> 'Style 3',
			);

			$yes_no = array(
				'1'			=> 'Yes',
				'0'			=> 'No',
			);
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
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
					<label for="<?php echo esc_attr( $this->get_field_id('size')); ?>"><?php esc_html_e('Icon Size:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('size')); ?>" id="<?php echo esc_attr($this->get_field_id('size')); ?>">
						<?php foreach( $size_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($size==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_title')); ?>"><?php esc_html_e('Show Title Social:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_title')); ?>" id="<?php echo esc_attr($this->get_field_id('show_title')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_title==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>


				<p>
	                <label for="<?php echo $this->get_field_id( 'rss_url' ); ?>"><?php esc_html_e( 'RSS URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'rss_url' ); ?>" name="<?php echo $this->get_field_name( 'rss_url' ); ?>" type="text" value="<?php echo $rss_url; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'twitter_url' ); ?>"><?php esc_html_e( 'Twitter URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'twitter_url' ); ?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" type="text" value="<?php echo $twitter_url; ?>" />
	                </label>
	            </p>
	            
	            <p>
	                <label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php esc_html_e( 'Facebook URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" type="text" value="<?php echo $facebook_url; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'google_url' ); ?>"><?php esc_html_e( 'Google URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'google_url' ); ?>" name="<?php echo $this->get_field_name( 'google_url' ); ?>" type="text" value="<?php echo $google_url; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'pin_url' ); ?>"><?php esc_html_e( 'Pinterest URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'pin_url' ); ?>" name="<?php echo $this->get_field_name( 'pin_url' ); ?>" type="text" value="<?php echo $pin_url; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'youtube_url' ); ?>"><?php esc_html_e( 'Youtube URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'youtube_url' ); ?>" name="<?php echo $this->get_field_name( 'youtube_url' ); ?>" type="text" value="<?php echo $youtube_url; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'instagram_url' ); ?>"><?php esc_html_e( 'Instagram URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'instagram_url' ); ?>" name="<?php echo $this->get_field_name( 'instagram_url' ); ?>" type="text" value="<?php echo $instagram_url; ?>" />
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
	        $title   	  	 			= isset( $instance['title'] ) ? $instance['title'] : '';
	        $style   	  	 			= isset( $instance['style'] ) ? $instance['style'] : '';
	        $size   	  				= isset( $instance['size'] ) ? $instance['size'] : 'fa-2';
	        $show_title   	  			= isset( $instance['show_title'] ) ? $instance['show_title'] : '1';
	        $rss_url   	  				= isset( $instance['rss_url'] ) ? $instance['rss_url'] : '';
	        $twitter_url   	  			= isset( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
	        $facebook_url   	  		= isset( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
	        $google_url   	  			= isset( $instance['google_url'] ) ? $instance['google_url'] : '';
	        $pin_url   	  				= isset( $instance['pin_url'] ) ? $instance['pin_url'] : '';
	        $youtube_url   	  			= isset( $instance['youtube_url'] ) ? $instance['youtube_url'] : '';
	        $instagram_url   	  		= isset( $instance['instagram_url'] ) ? $instance['instagram_url'] : '';
	        $class   	  	  		  	= isset( $instance['class'] ) ? $instance['class'] : '';
	        
	        echo $before_widget;
	        ?>
        	<?php if ($title != ''): ?>
        		<?php echo $before_title.$title.$after_title; ?>
        	<?php endif ?>
        	<div class="wd-social-icons <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $style ); ?>">
				<div class="wd-content <?php if($show_title) echo ("wd-has-title") ?>">
					<ul>
						<?php if($facebook_url != ''){?>
							<li class="icon-facebook">
								<a href="<?php echo esc_attr($facebook_url); ?>" target="_blank" title="<?php esc_html_e('Become our fan', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-facebook"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Facebook', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>				
						<?php } ?>
						<?php if($rss_url != ''){?>
							<li class="icon-rss">
								<a href="<?php echo esc_attr($rss_url); ?>" target="_blank" title="<?php esc_html_e('Rss', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-rss"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Rss', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>				
						<?php } ?>
						<?php if($twitter_url != ''){?>
							<li class="icon-twitter">
								<a href="<?php echo esc_attr($twitter_url); ?>" target="_blank" title="<?php esc_html_e('Twitter', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-twitter"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Twitter', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>				
						<?php } ?>
						<?php if($google_url != ''){?>
							<li class="icon-google">
								<a href="<?php echo esc_attr($google_url); ?>" target="_blank" title="<?php esc_html_e('Google', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-google-plus"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Google', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>				
						<?php } ?>
						<?php if($pin_url != ''){?>
							<li class="icon-pin">
								<a href="<?php echo esc_attr($pin_url); ?>" target="_blank" title="<?php esc_html_e('Pin', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-pinterest"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Pin', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>			
						<?php } ?>
						<?php if($youtube_url != ''){?>
							<li class="icon-youtube">
								<a href="<?php echo esc_attr($youtube_url); ?>" target="_blank" title="<?php esc_html_e('Youtube', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-youtube"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Youtube', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>			
						<?php } ?>
						<?php if($instagram_url != ''){?>
							<li class="icon-instagram">
								<a href="<?php echo esc_attr($instagram_url); ?>" target="_blank" title="<?php esc_html_e('Instagram', 'wpdancelaparis'); ?>" >
									<i class="fa <?php echo esc_attr($size); ?> fa-instagram"></i>
									<?php if($show_title): ?>
										<span><?php esc_html_e('Instagram', 'wpdancelaparis'); ?></span>
									<?php endif; ?>
								</a>
							</li>				
						<?php } ?>
					</ul>
				</div>
			</div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']      		= strip_tags( $new_instance['title'] );
	        $instance['style']  			= strip_tags( $new_instance['style'] );
	        $instance['size']  				= strip_tags( $new_instance['size'] );
	        $instance['show_title']  		= strip_tags( $new_instance['show_title'] );
	        $instance['rss_url']  			= strip_tags( $new_instance['rss_url'] );
	        $instance['twitter_url']  		= strip_tags( $new_instance['twitter_url'] );
	        $instance['facebook_url']  		= strip_tags( $new_instance['facebook_url'] );
	        $instance['google_url']  		= strip_tags( $new_instance['google_url'] );
	        $instance['pin_url']  			= strip_tags( $new_instance['pin_url'] );
	        $instance['youtube_url']  		= strip_tags( $new_instance['youtube_url'] );
	        $instance['instagram_url']  	= strip_tags( $new_instance['instagram_url'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_icon_social() {
		register_widget( 'tvlgiao_wpdance_widget_icon_social' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_icon_social' );
}
?>