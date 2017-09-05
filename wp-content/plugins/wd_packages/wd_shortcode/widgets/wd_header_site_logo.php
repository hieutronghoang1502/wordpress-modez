<?php
if( !class_exists( 'tvlgiao_wpdance_widget_site_header' ) ) {
	class tvlgiao_wpdance_widget_site_header extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_site_header', 'description' => esc_html__('Site Header Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('site_header', esc_html__('WD - Site Logo','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $bg_image   	= esc_attr( isset( $instance['bg_image'] ) ? $instance['bg_image'] : '' );
	        $image_url  	= get_template_directory_uri().'/assets/images/wpdance_logo.png';
	        if ($bg_image) {
	        	$image 		= wp_get_attachment_image_src( $bg_image, 'full' );
	        	$image_url 	= $image[0];
	        }
	        $image_size   	= esc_attr( isset( $instance['image_size'] ) ? $instance['image_size'] : 'full' );
	        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
	        ?>
	            <p>
	                <label><?php esc_html_e( 'Logo:', 'wpdancelaparis' ); ?></label>
	                <div class="wd_banner_image_widget_img">
	                	<img class="wd_banner_image_view_image" src="<?php echo $image_url; ?>" alt="" width="172px">
	                </div>
	                <input type="hidden" class="widefat wd_banner_image_bg_image" id="<?php echo $this->get_field_id( 'bg_image' ); ?>" name="<?php echo $this->get_field_name( 'bg_image' ); ?>" value="<?php echo $bg_image; ?>">

	                <a href="#" id="wd_banner_image_select_image" data-view="wd_banner_image_view_image" data-field="wd_banner_image_bg_image">Select Image</a>
	            </p>
				

	            <p>
	                <label for="<?php echo $this->get_field_id( 'class' ); ?>"><?php esc_html_e( 'Extra class name:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'class' ); ?>" name="<?php echo $this->get_field_name( 'class' ); ?>" type="text" value="<?php echo $class; ?>" />
	                </label>
	            </p>

	            <script>
		            (function ($) {
					    var file_frame;
					    $('#wd_banner_image_select_image').live('click', function( event ){
					        var imgview  = $(this).attr('data-view');
					        var imgfield = $(this).attr('data-field');
					        event.preventDefault();
								 
					        if ( file_frame ) {
					            file_frame.open();
					            return;
					        }

					        var _states = [new wp.media.controller.Library({
					            filterable: 'uploaded',
					            title: 'Select an Image',
					            multiple: false,
					            priority:  20
					        })];
								 
					        file_frame = wp.media.frames.file_frame = wp.media({
					            states: _states,
					            button: {
					                text: 'Insert URL'
					            }
					        });

					        file_frame.on( 'select', function() {
					            var attachment = file_frame.state().get('selection').first().toJSON();
					            $('.'+imgview).attr('src', attachment.url); 
					            $('.'+imgfield).val(attachment.id); 
					        });
							 
					        file_frame.open();
					    });
					    
					})(jQuery);
				</script>
	        <?php
	    }
	    function widget( $args, $instance )
	    {
	        extract($args);
	        $bg_image   	  = $instance['bg_image'];
	        $class   	  	  = $instance['class'];

	        $hide_site_title 	= get_theme_mod('tvlgiao_wpdance_hide_site_title','1');
			$default_logo 		= get_template_directory_uri().'/assets/images/wpdance_logo.png';
			if($bg_image != ""){
				$image	  		= wp_get_attachment_image_src($bg_image,'full');
				$logo_url 		= $image[0];
			}else{
				$logo_url	  	= get_theme_mod('tvlgiao_wpdance_header_logo_url', $default_logo); 
			}
			$id_logo = 'site-logo-'.mt_rand();
	        echo $before_widget;
	        ?>
	            <div class="header-main <?php echo esc_attr($class) ?>">
					<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						
						<img id="<?php echo esc_attr($id_logo); ?>" class="site-logo" src='<?php echo esc_url($logo_url); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name') ); ?>' title="<?php echo esc_attr(bloginfo('name')) ?>">
					
						<?php if (!$hide_site_title): ?>
							<?php if (is_front_page() && is_home()): ?>
								<h1 class="site-title" rel="home"><?php bloginfo( 'name' ); ?></h1>
							<?php else: ?>
								<p class="site-title" rel="home"><?php bloginfo( 'name' ); ?></p>
							<?php endif ?>
						<?php endif ?>
					</a>
				</div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['bg_image']            = strip_tags( $new_instance['bg_image'] );
	        $instance['class']            	 = strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_site_header() {
		register_widget( 'tvlgiao_wpdance_widget_site_header' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_site_header' );
}
?>