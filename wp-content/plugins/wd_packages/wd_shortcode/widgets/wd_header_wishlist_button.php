<?php
// we can only use this Widget if the plugin is active
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
if ( in_array( "yith-woocommerce-wishlist/init.php", $_actived ) ) {
	if( !class_exists( 'tvlgiao_wpdance_widget_wishlist_permarlink' ) ) {
		class tvlgiao_wpdance_widget_wishlist_permarlink extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_wishlist_permarlink', 'description' => esc_html__('Wishlist Permarlink Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('wishlist_permarlink', esc_html__('WD - Wishlist Permarlink','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		        $title      		= esc_attr( isset( $instance['title'] ) ? $instance['title'] : 'Wishlist' );
		        $icon_class      	= esc_attr( isset( $instance['icon_class'] ) ? $instance['icon_class'] : 'fa-heart' );
		        $class      		= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
		        ?>
		        	<p>
		                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		                </label>
		            </p>

		            <p>
		                <label for="<?php echo $this->get_field_id( 'icon_class' ); ?>"><?php esc_html_e( 'Icon Class (Font awesome):', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'icon_class' ); ?>" name="<?php echo $this->get_field_name( 'icon_class' ); ?>" type="text" value="<?php echo $icon_class; ?>" placeholder="<?php esc_html_e( 'Ex: fa-heart', 'wpdancelaparis' ); ?>" />
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
		        $title      	  = ($instance['title']) ? $instance['title'] : 'Wishlist';
		        $icon_class       = $instance['icon_class'];
		        $class      	  = $instance['class'];


		        echo $before_widget; ?>
					<div class="wd_wishlist_permarlink <?php echo esc_html($class); ?>">
						<a href="<?php echo get_permalink( get_page_by_path( 'wishlist' ) ) ?>" title="<?php esc_html_e('Wishlist','wpdancelaparis');?>">
							<span>
								<?php if($icon_class): ?>	
									<i class="fa <?php echo esc_html($icon_class); ?>" aria-hidden="true"></i>
								<?php endif;?>
								<?php echo esc_html($title); ?>
							</span>
									
						</a>	
					</div>
		        <?php
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['class']            	 = strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wd_widget_register_widget_wishlist_permarlink() {
			register_widget( 'tvlgiao_wpdance_widget_wishlist_permarlink' );
		}
		add_action( 'widgets_init', 'wd_widget_register_widget_wishlist_permarlink' );
	}
}
?>