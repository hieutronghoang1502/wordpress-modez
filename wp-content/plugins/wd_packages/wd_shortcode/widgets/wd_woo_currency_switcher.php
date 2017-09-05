<?php
$_active_vc = apply_filters('active_plugins',get_option('active_plugins'));
if(in_array('woocommerce-currency-switcher/index.php',$_active_vc)){
	if( !class_exists( 'tvlgiao_wpdance_widget_woo_currency_switcher' ) ) {
		class tvlgiao_wpdance_widget_woo_currency_switcher extends WP_Widget{
		    function __construct() {
				$widget_ops 		= array('classname' => 'widget_woo_currency_switcher', 'description' => esc_html__('Currency Switcher Woocommerce Widget','wpdancelaparis'));
				$control_ops 		= array('width' => 400, 'height' => 350);
				parent::__construct('woo_currency_switcher', esc_html__('WD - Currency Switcher Woocommerce','wpdancelaparis'), $widget_ops);
			}
		    function form( $instance )
		    {
		       
		        $title      	= esc_attr( isset( $instance['title'] ) ? $instance['title'] : 'USD' );
		        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
		        ?>
		            <p>
		                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Widget Title:', 'wpdancelaparis' ); ?>
		                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
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
		        $title   	  	  = $instance['title'];
		        $class   	  	  = $instance['class'];
		        
		        echo $before_widget;
		        ?>
		            <style>
						.WOOCS_SELECTOR, .header-top-right .WOOCS_SELECTOR {
						    padding: 0;
						}
						
						 .widget-woocommerce-currency-switcher {
						    
						    position: relative;
						    overflow: hidden;
						    width:110px;
						    padding-top: 10px;
						}
					
						.widget-woocommerce-currency-switcher h2:after {
						    
						    display: inline-block;
						    content: "";
						    font-size: 14px;
						    line-height: inherit;
						    font-family: "FontAwesome";
						    padding-left: 10px;
						}
						.site-header .widget .widget-title {
						    margin: 0;
						}
						 .widget-woocommerce-currency-switcher form {
						    right: 0;
						    left: auto;
						    z-index: 10000;
						    transition:All 2s ease-out;
							-webkit-transition:All 1s ease-out;
							-moz-transition:All 1s ease-out;
							-o-transition:All 1s ease-out;
							transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-webkit-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-moz-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-o-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-ms-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
					    
						}
						  .widget-woocommerce-currency-switcher > form {
						    position: absolute;
						    opacity: 0;
						    
						}
						 .widget-woocommerce-currency-switcher:hover {
						    overflow: visible;
						}
						.widget-woocommerce-currency-switcher:hover > form {
							z-index: 10000;
						    opacity: 1;
						    margin-top: 0;
						    transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-webkit-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-moz-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-o-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
							-ms-transform: rotate(0deg) scale(1) skew(1deg) translate(0px);
						}
					</style>
					<section id="woocs_selector-4" class="widget WOOCS_SELECTOR <?php echo esc_attr($class) ?>">
						<div class="widget widget-woocommerce-currency-switcher">
					    	<h2 class="widget-title"><?php echo esc_attr($title) ; ?></h2>
					    	<?php if(do_shortcode('[woocs]')) {echo do_shortcode('[woocs]');} ?>
				   	 	</div>

					</section>
		        <?php
		        echo $after_widget;
		    }
		    function update( $new_instance, $old_instance )
		    {
		        $instance = $old_instance;
		        $instance['title']            	= strip_tags( $new_instance['title'] );
		        $instance['class']            	= strip_tags( $new_instance['class'] );
		        return $instance;
		    }
		}
		function wp_widget_register_widget_woo_currency_switcher() {
			register_widget( 'tvlgiao_wpdance_widget_woo_currency_switcher' );
		}
		add_action( 'widgets_init', 'wp_widget_register_widget_woo_currency_switcher' );
	}
}
?>