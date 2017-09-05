<?php
// we can only use this Widget if the plugin is active
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
if ( in_array( "woocommerce/woocommerce.php", $_actived ) ) {
	if( !class_exists( 'tvlgiao_wpdance_widget_user_link' ) ) {
		class tvlgiao_wpdance_widget_user_link extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_user_link', 'description' => esc_html__('User Link Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('user_link', esc_html__('WD - User Links','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		        $show_title      	= esc_attr( isset( $instance['show_title'] ) ? $instance['show_title'] : 1 );
		        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
		        ?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id('show_title')); ?>"><?php esc_html_e('Show Title:','wpdancelaparis'); ?></label>
						<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_title')); ?>" id="<?php echo esc_attr($this->get_field_id('show_title')); ?>">
							<option value="1" <?php echo ($show_title == 1)?'selected':'' ?> ><?php esc_html_e('Show Text Sign Up / Login','wpdancelaparis'); ?></option>
							<option value="0" <?php echo ($show_title == 0)?'selected':'' ?> ><?php esc_html_e('Show Icon User','wpdancelaparis'); ?></option>
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
		        $show_title       = $instance['show_title'];
		        $class      	  = $instance['class'];
		        echo $before_widget;
		        $class_show_title = "";
				if( $show_title == '0') $class_show_title = 'show-icon-user';
				echo tvlgiao_wpdance_tini_account( $class, $class_show_title );
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['show_title']            	 = strip_tags( $new_instance['show_title'] );
		        $instance['class']            	 = strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		//register_widget( 'tvlgiao_wpdance_widget_user_link111');
	}
	function wd_widget_register_widget_user_link() {
		register_widget( 'tvlgiao_wpdance_widget_user_link' );
	}
	add_action( 'widgets_init', 'wd_widget_register_widget_user_link' );
}

?>