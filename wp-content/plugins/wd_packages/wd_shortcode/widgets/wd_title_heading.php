<?php
if( !class_exists( 'tvlgiao_wpdance_widget_title' ) ) {
	class tvlgiao_wpdance_widget_title extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_title', 'description' => esc_html__('Title Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('title', esc_html__('WD - Title','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $title      	= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $description    = esc_attr( isset( $instance['description'] ) ? $instance['description'] : '' );
	        $type    		= esc_attr( isset( $instance['type'] ) ? $instance['type'] : 'heading' );
	        $position  		= esc_attr( isset( $instance['position'] ) ? $instance['position'] : 'text-center' );
	        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );

	        $type_arr = array(
				'heading'		=> 'Heading h2',
				'widget'		=> 'Widget',
				'h1'		=> 'Heading h1',
				'h3'		=> 'Heading h3',
				'h4'		=> 'Heading h4',
				'h5'		=> 'Heading h5',
			);
			$position_arr = array(
				'text-center'	=> 'Center aligned text',
				'text-left'		=> 'Left aligned text',
				'text-right'	=> 'Right aligned text',
				'text-justify'	=> 'Justified text',
				'text-nowrap'	=> 'No wrap text',
			);
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Widget Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

	            

				<p>
			       <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:', 'wpdancelaparis' ); ?></label>
			        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
			    </p>

			    <p>
					<label for="<?php echo esc_attr( $this->get_field_id('position')); ?>"><?php esc_html_e('Position:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('position')); ?>" id="<?php echo esc_attr($this->get_field_id('position')); ?>">
						<?php foreach( $position_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($position==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('type')); ?>"><?php esc_html_e('Title Format:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('type')); ?>" id="<?php echo esc_attr($this->get_field_id('type')); ?>">
						<?php foreach( $type_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($type==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
	        $title   	  	  		  	= $instance['title'];
	        $description   	  	  	  	= $instance['description'];
	        $type   	  	  	  		= $instance['type'];
	        $position   	  	  	  	= $instance['position'];
	        $class   	  	  		  	= $instance['class'];
	        
	        echo $before_widget;
	        ?>
				<?php if($title != "") : ?>
					<div class="<?php echo esc_attr($position) ?>">
						<?php if ($type == 'heading'): ?>
							<h2 class="wd-title-shortcode <?php echo esc_attr($class) ?>"><?php echo esc_attr($title); ?></h2>
						<?php elseif ($type == 'widget'): ?>
							<?php echo wp_kses_post($before_title . $title . $after_title);  ?>
						<?php else: ?>
							<<?php echo esc_html($type); ?> class="wd-title-shortcode <?php echo esc_attr($class) ?>"><?php echo esc_attr($title); ?></<?php echo esc_html($type); ?>>
						<?php endif ?>
						
						<?php if($description != "") : ?>
							<p class="wd-description-shortcode"><?php echo esc_attr($description); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']            	= strip_tags( $new_instance['title'] );
	        $instance['description']        = strip_tags( $new_instance['description'] );
	        $instance['type']        		= strip_tags( $new_instance['type'] );
	        $instance['position']      		= strip_tags( $new_instance['position'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_title() {
		register_widget( 'tvlgiao_wpdance_widget_title' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_title' );
}
?>