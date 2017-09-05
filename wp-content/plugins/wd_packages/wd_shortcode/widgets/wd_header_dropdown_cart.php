<?php
// we can only use this Widget if the plugin is active
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
if ( in_array( "woocommerce/woocommerce.php", $_actived ) ) {
	if( !class_exists( 'tvlgiao_wpdance_widget_dropdown_cart' ) ) {
		class tvlgiao_wpdance_widget_dropdown_cart extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_dropdown_cart', 'description' => esc_html__('Dropdown Cart Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('dropdown_cart', esc_html__('WD - Dropdown Cart','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
		        ?>
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
		        $class      	  = $instance['class'];
		        echo $before_widget;
				echo tvlgiao_wpdance_tini_cart( $class);
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['class']            	 = strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wd_widget_register_widget_dropdown_cart() {
			register_widget( 'tvlgiao_wpdance_widget_dropdown_cart' );
		}
		add_action( 'widgets_init', 'wd_widget_register_widget_dropdown_cart' );
	}
}
?>