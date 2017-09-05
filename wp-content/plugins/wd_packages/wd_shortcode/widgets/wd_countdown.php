<?php
if( !class_exists( 'tvlgiao_wpdance_widget_countdown' ) ) {
	class tvlgiao_wpdance_widget_countdown extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_countdown', 'description' => esc_html__('Countdown Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('countdown', esc_html__('WD - Countdown','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $title      		= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $description      	= esc_attr( isset( $instance['description'] ) ? $instance['description'] : '' );
	        $date      			= esc_attr( isset( $instance['date'] ) ? $instance['date'] : date('Y-m-d', time()) );
	        $time     			= esc_attr( isset( $instance['time'] ) ? $instance['time'] : '00:00' );
	        $format     		= esc_attr( isset( $instance['format'] ) ? $instance['format'] : '1' );
	        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );

			$format_arr = array(
				 '1'			=> 'Day : Hour : Minute : Second',
				 '2'			=> 'Hour : Minute : Second',
				 '3'			=> 'Minute : Second',
			);
	        ?>
	        	<p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo $description; ?>" />
	                </label>
	            </p>
	        	<p>
	                <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php esc_html_e( 'Date:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="date" value="<?php echo $date; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'time' ); ?>"><?php esc_html_e( 'Time:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'time' ); ?>" name="<?php echo $this->get_field_name( 'time' ); ?>" type="time" value="<?php echo $time; ?>" />
	                </label>
	            </p>

	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('format')); ?>"><?php esc_html_e('Format:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('format')); ?>" id="<?php echo esc_attr($this->get_field_id('format')); ?>">
						<?php foreach( $format_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($format==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
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
	        $title   	  	  = $instance['title'];
	        $description   	  = $instance['description'];
	        $date   	  	  = $instance['date'];
	        $time   	  	  = $instance['time'];
	        $format   	  	  = $instance['format'];
	        $class   	  	  = $instance['class'];

	        $data_date        = $date . ' ' . $time . ':00';
	        echo $before_widget;
	        ?>
			<div class="comingsoon-page <?php echo esc_attr($class); ?>">
				<?php if ($title): ?>
					<div class="wd-comingsoon-title"><?php echo wp_kses_post($before_title . $title . $after_title);  ?></div>
				<?php endif ?>
				<?php if ($description): ?>
					<div class="wd-comingsoon-description"><?php echo esc_html($description);  ?></div>
				<?php endif ?>
				<div id="DateCountdown" data-date="<?php echo esc_attr($data_date); ?>"></div>
			</div>
			<script>
				jQuery("#DateCountdown").TimeCircles({ 
					time: { 
						Days: { show: <?php echo ($format == 1) ? true : false; ?> }, 
						Hours: { show: <?php echo ($format == 1 || $format == 2) ? true : false; ?> } 
					}
				});
			</script>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']          = strip_tags( $new_instance['title'] );
	        $instance['description']    = strip_tags( $new_instance['description'] );
	        $instance['date']           = strip_tags( $new_instance['date'] );
	        $instance['time']        	= strip_tags( $new_instance['time'] );
	        $instance['format']      	= strip_tags( $new_instance['format'] );
	        $instance['class']            		= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_countdown() {
		register_widget( 'tvlgiao_wpdance_widget_countdown' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_countdown' );
}
?>