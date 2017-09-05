<?php
if( !class_exists( 'tvlgiao_wpdance_widget_fanpage_likebox' ) ) {
	class tvlgiao_wpdance_widget_fanpage_likebox extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_fanpage_likebox', 'description' => esc_html__('Fanpage Like Box Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('fanpage_likebox', esc_html__('WD - Fanpage Like Box','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $fanpage_url  			= esc_attr( isset( $instance['fanpage_url'] ) ? $instance['fanpage_url'] : '' );
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'fanpage_url' ); ?>"><?php esc_html_e( 'Fanpage URL:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'fanpage_url' ); ?>" name="<?php echo $this->get_field_name( 'fanpage_url' ); ?>" type="text" value="<?php echo $fanpage_url; ?>" />
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
	        $fanpage_url   	  	 		= isset( $instance['fanpage_url'] ) ? $instance['fanpage_url'] : '';
	        $class   	  	  		  	= isset( $instance['class'] ) ? $instance['class'] : '';
	        
	        echo $before_widget;
	        ?>
        	<?php if ($title != ''): ?>
        		<?php echo $before_title.$title.$after_title; ?>
        	<?php endif ?>
        	<?php if ($fanpage_url): ?>
				<div class="fb-like-box <?php echo esc_attr($class) ?>">
					<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo esc_url($fanpage_url); ?>&amp;width=320&amp;colorscheme=light&amp;show_faces=true&amp;connections=9&amp;stream=false&amp;header=false&amp;height=230" scrolling="no" frameborder="0" scrolling="no"></iframe>
				</div>
        	<?php endif ?>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']      		= strip_tags( $new_instance['title'] );
	        $instance['fanpage_url']      	= strip_tags( $new_instance['fanpage_url'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_fanpage_likebox() {
		register_widget( 'tvlgiao_wpdance_widget_fanpage_likebox' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_fanpage_likebox' );
}
?>