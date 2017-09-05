<?php
if( !class_exists( 'tvlgiao_wpdance_widget_feedburner_subscription' ) ) {
	class tvlgiao_wpdance_widget_feedburner_subscription extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_feedburner_subscription', 'description' => esc_html__('Feedburner Subscription Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('feedburner_subscription', esc_html__('WD - Feedburner Subscription','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : 'Sign up for Our Newsletter' );
	        $intro_text  				= esc_attr( isset( $instance['intro_text'] ) ? $instance['intro_text'] : 'A newsletter is a regularly distributed publication generally' );
	        $button_text  				= esc_attr( isset( $instance['button_text'] ) ? $instance['button_text'] : 'Subscribe' );
	        $feedburner_id  				= esc_attr( isset( $instance['feedburner_id'] ) ? $instance['feedburner_id'] : 'WpComic-Manga' );
	        
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
	        ?>
				<p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'intro_text' ); ?>"><?php esc_html_e( 'Enter your Intro Text:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'intro_text' ); ?>" name="<?php echo $this->get_field_name( 'intro_text' ); ?>" type="text" value="<?php echo $intro_text; ?>" />
	                </label>
	            </p>
				
				<p>
	                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Enter your Button:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
	                </label>
	            </p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'feedburner_id' ); ?>"><?php esc_html_e( 'Enter your Feedburner ID:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'feedburner_id' ); ?>" name="<?php echo $this->get_field_name( 'feedburner_id' ); ?>" type="text" value="<?php echo $feedburner_id; ?>" />
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
	        $title   	  	  	= $instance['title'];
	        $intro_text   	  	= $instance['intro_text'];
	        $button_text   	  	= $instance['button_text'];
	        $feedburner_id   	= $instance['feedburner_id'];
	        $class   	  	  	= $instance['class'];
	        echo $before_widget;
	        ?>
				<div class="subscribe_widget <?php echo esc_attr( $class ); ?>">
				<?php if($title != "") : ?>
					<?php
					echo '<div class="wd-subscribe-header">';
					echo wp_kses_post($before_title . $title . $after_title); 
					echo '</div>';
					?>
				<?php endif; ?>
				<?php echo ($intro_text) ? '<div class="textwidget">'.esc_html($intro_text).'</div>' : ''; ?>		
				<div class="subscribe_form">
					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feedburner_id); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<p class="subscribe-email"><input type="text" name="email" class="subscribe_email" value="" placeholder="<?php esc_html_e('Enter your email address','wpdancelaparis');?>" /></p>
						<input type="hidden" value="<?php echo esc_attr($feedburner_id);?>" name="uri"/>
						<input type="hidden" value="<?php echo get_bloginfo( 'name' );?>" name="title"/>
						<input type="hidden" name="loc" value="en_US"/>
						<button class="button" type="submit" title="Subscribe"><?php echo esc_attr($button_text); ?></button>
						<p class="hidden">Delivered by <a href="#">FeedBurner</a></p>
					</form>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";
					var subscribe_input = jQuery(".subscribe_widget input.subscribe_email");
					var value_default = subscribe_input.attr('data-default');
					subscribe_input.val(value_default);
					if( jQuery(this).val() === "" ) jQuery(this).val(value_default);
					subscribe_input.click(function(){
						if( jQuery(this).val() === value_default ) jQuery(this).val("");
					});
					subscribe_input.blur(function(){
						if( jQuery(this).val() === "" ) jQuery(this).val(value_default);
					});
				});
			</script>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']      		= strip_tags( $new_instance['title'] );
	        $instance['intro_text']      	= strip_tags( $new_instance['intro_text'] );
	        $instance['button_text']      	= strip_tags( $new_instance['button_text'] );
	        $instance['feedburner_id']      = strip_tags( $new_instance['feedburner_id'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_feedburner_subscription() {
		register_widget( 'tvlgiao_wpdance_widget_feedburner_subscription' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_feedburner_subscription' );
}
?>