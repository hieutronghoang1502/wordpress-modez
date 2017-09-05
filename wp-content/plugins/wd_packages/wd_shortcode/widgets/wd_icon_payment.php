<?php
if( !class_exists( 'tvlgiao_wpdance_widget_icon_payment' ) ) {
	class tvlgiao_wpdance_widget_icon_payment extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_icon_payment', 'description' => esc_html__('Icon Payment Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('icon_payment', esc_html__('WD - Icon Payment','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $list_icon_payment  	= esc_attr( isset( $instance['list_icon_payment'] ) ? $instance['list_icon_payment'] : 'fa-cc-mastercard, fa-cc-visa, fa-cc-amex, fa-cc-diners-club, fa-cc-discover, fa-credit-card-alt' );
	        $size  					= esc_attr( isset( $instance['size'] ) ? $instance['size'] : 'fa-2' );
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
        	$size_arr = array(
				'fa-2'			=> '2x',
				'fa-1'			=> '1x',
				'fa-3'			=> '3x',
				'fa-4'			=> '4x',
				'fa-5'			=> '5x',
				'fa-6'			=> '6x',
			);
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'list_icon_payment' ); ?>"><?php esc_html_e( 'List Icon Payment (Separated by commas):', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'list_icon_payment' ); ?>" name="<?php echo $this->get_field_name( 'list_icon_payment' ); ?>" type="text" value="<?php echo $list_icon_payment; ?>" placeholder="<?php esc_html_e( 'Exam: fa-cc-mastercard, fa-cc-visa, fa-cc-amex, fa-cc-diners-club, fa-cc-discover, fa-credit-card-alt', 'wpdancelaparis' ); ?>" />
	                </label>
	                <kbd><a href="http://fontawesome.io/icons/"><?php esc_html_e( 'Get here', 'wpdancelaparis' ); ?></a></kbd>
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
	        $list_icon_payment   	  	= isset( $instance['list_icon_payment'] ) ? $instance['list_icon_payment'] : '';
	        $size   	  				= isset( $instance['size'] ) ? $instance['size'] : 'fa-2';
	        $class   	  	  		  	= isset( $instance['class'] ) ? $instance['class'] : '';
	        
	        echo $before_widget;
	        ?>
        	<?php if ($title != ''): ?>
        		<?php echo $before_title.$title.$after_title; ?>
        	<?php endif ?>
        	<?php if ($list_icon_payment): ?>
        		<?php $icons_class = explode(',', $list_icon_payment); ?>
        		<?php if (count($icons_class) > 0): ?>
        			<ul class="payment wd-icon-widget-payment <?php echo esc_attr($class); ?>">
	        			<?php foreach ($icons_class as $icon): ?>
	        				<?php if ($icon != ''): ?>
	        					<li><i class="fa <?php echo esc_html($size); ?> <?php echo esc_html(trim($icon)); ?>" aria-hidden="true"></i></li>
	        				<?php endif ?>
	        			<?php endforeach ?>
        			</ul>
        		<?php endif ?>
        	<?php endif ?>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']      		= strip_tags( $new_instance['title'] );
	        $instance['list_icon_payment']  = strip_tags( $new_instance['list_icon_payment'] );
	        $instance['size']  				= strip_tags( $new_instance['size'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_icon_payment() {
		register_widget( 'tvlgiao_wpdance_widget_icon_payment' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_icon_payment' );
}
?>