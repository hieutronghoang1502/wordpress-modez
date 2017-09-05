<?php
if( !class_exists( 'tvlgiao_wpdance_widget_search_blog' ) ) {
	class tvlgiao_wpdance_widget_search_blog extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_search_blog', 'description' => esc_html__('Search Blog Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('search_blog', esc_html__('WD - Search Blog','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $style  				= esc_attr( isset( $instance['style'] ) ? $instance['style'] : 'style-1' );
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			$style_arr = array(
				'style-1'	=> 'Style 1',
				'style-2'	=> 'Style 2',
			);
	        ?>
	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('style')); ?>"><?php esc_html_e('Style:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
						<?php foreach( $target_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($style==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
	        $style   	  	 			= isset( $instance['style'] ) ? $instance['style'] : 'style-1';
	        $class   	  	  		  	= isset( $instance['class'] ) ? $instance['class'] : '';
	        
	        echo $before_widget;
	        ?>
				<div class="wd-search-post <?php echo esc_attr($class) ?> <?php echo esc_attr($style) ?>">
					<?php if($style == "style-1") : ?>
						<a class="wd-click-popup-search"><i class="fa fa-search"></i></a>
						<div class="wd-popup-search hidden">
							<?php get_search_form( $echo = true );?>
							<div class="wd-search-close">X</div>
						</div>
					<?php else: ?>
						<?php get_search_form( $echo = true );?>
					<?php endif; ?>
				</div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['style']      		= strip_tags( $new_instance['style'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_search_blog() {
		register_widget( 'tvlgiao_wpdance_widget_search_blog' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_search_blog' );
}
?>