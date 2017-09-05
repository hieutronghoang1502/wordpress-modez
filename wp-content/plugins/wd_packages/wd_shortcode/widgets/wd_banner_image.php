<?php
if( !class_exists( 'tvlgiao_wpdance_widget_banner_image' ) ) {
	class tvlgiao_wpdance_widget_banner_image extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_banner_image', 'description' => esc_html__('Banner image Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('banner_image', esc_html__('WD - Banner Image','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $bg_image   	= esc_attr( isset( $instance['bg_image'] ) ? $instance['bg_image'] : '' );
	        $image_url  	= '';
	        if ($bg_image) {
	        	$image 		= wp_get_attachment_image_src( $bg_image, 'full' );
	        	$image_url 	= $image[0];
	        }
	        $image_size   	= esc_attr( isset( $instance['image_size'] ) ? $instance['image_size'] : 'full' );
	        $effect_style   	= esc_attr( isset( $instance['effect_style'] ) ? $instance['effect_style'] : 'banner-effect-style-1' );
	        $button_text   	= esc_attr( isset( $instance['button_text'] ) ? $instance['button_text'] : '' );
	        $link_url      	= esc_attr( isset( $instance['link_url'] ) ? $instance['link_url'] : '' );
	        $button_class  	= esc_attr( isset( $instance['button_class'] ) ? $instance['button_class'] : '' );
	        $top      		= esc_attr( isset( $instance['top'] ) ? $instance['top'] : 0 );
	        $right      	= esc_attr( isset( $instance['right'] ) ? $instance['right'] : 0 );
	        $bottom      	= esc_attr( isset( $instance['bottom'] ) ? $instance['bottom'] : 0 );
	        $left      		= esc_attr( isset( $instance['left'] ) ? $instance['left'] : 0 );
	        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			global $_wp_additional_image_sizes;
			$list_image_size = array('full' => 'Full size');
			foreach ($_wp_additional_image_sizes as $key => $value) {
				$list_image_size[$key] = $key.' - '.$value['width'].'x'.$value['height'];
			} 

			$effect_style_arr = array(
				'banner-effect-style-1'		=> 'Style 1',
				'banner-effect-style-2'		=> 'Style 2',
				'banner-effect-style-3'		=> 'Style 3',
			);
	        ?>
	            <p>
	                <label><?php esc_html_e( 'Image:', 'wpdancelaparis' ); ?></label>
	                <div class="wd_banner_image_widget_img">
	                	<img class="wd_banner_image_view_image" src="<?php echo $image_url; ?>" alt="" width="400px">
	                </div>
	                <input type="hidden" class="widefat wd_banner_image_bg_image" id="<?php echo $this->get_field_id( 'bg_image' ); ?>" name="<?php echo $this->get_field_name( 'bg_image' ); ?>" value="<?php echo $bg_image; ?>">

	                <a href="#" id="wd_banner_image_select_image" data-view="wd_banner_image_view_image" data-field="wd_banner_image_bg_image">Select Image</a>
	            </p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('image_size')); ?>"><?php esc_html_e('Image Size:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('image_size')); ?>" id="<?php echo esc_attr($this->get_field_id('image_size')); ?>">
						<?php foreach( $list_image_size as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($image_size==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('effect_style')); ?>"><?php esc_html_e('Effect Style:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('effect_style')); ?>" id="<?php echo esc_attr($this->get_field_id('effect_style')); ?>">
						<?php foreach( $effect_style_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($effect_style==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Button Text:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php esc_html_e( 'Button Link:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" type="text" value="<?php echo $link_url; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'button_class' ); ?>"><?php esc_html_e( 'Button Class:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'button_class' ); ?>" name="<?php echo $this->get_field_name( 'button_class' ); ?>" type="text" value="<?php echo $button_class; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'top' ); ?>"><?php esc_html_e( 'Top:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'top' ); ?>" name="<?php echo $this->get_field_name( 'top' ); ?>" type="text" value="<?php echo $top; ?>" placeholder="<?php esc_html_e("ex: 5%", 'wpdancelaparis') ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'right' ); ?>"><?php esc_html_e( 'Right:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'right' ); ?>" name="<?php echo $this->get_field_name( 'right' ); ?>" type="text" value="<?php echo $right; ?>" placeholder="<?php esc_html_e("ex: 5%", 'wpdancelaparis') ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'bottom' ); ?>"><?php esc_html_e( 'Bottom:', 'wpdancelaparis' ); ?>
	                    <input class="widefat" id="<?php echo $this->get_field_id( 'bottom' ); ?>" name="<?php echo $this->get_field_name( 'bottom' ); ?>" type="text" value="<?php echo $bottom; ?>" placeholder="<?php esc_html_e("ex: 5%", 'wpdancelaparis') ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'left' ); ?>"><?php esc_html_e( 'Left:', 'wpdancelaparis' ); ?>
            		<input class="widefat" id="<?php echo $this->get_field_id( 'left' ); ?>" name="<?php echo $this->get_field_name( 'left' ); ?>" type="text" value="<?php echo $left; ?>" placeholder="<?php esc_html_e("ex: 5%", 'wpdancelaparis') ?>" />
	                </label>
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
	        $image_size   	  = $instance['image_size'];
	        $effect_style     = (isset($instance['effect_style'])) ? $instance['effect_style'] : 'banner-effect-style-1';
	        $button_text      = $instance['button_text'];
	        $link_url      	  = $instance['link_url'];
	        $button_class     = $instance['button_class'];
	        $top      	 	  = ($instance['top']) ? $instance['top'] : 0;
	        $right      	  = ($instance['right']) ? $instance['right'] : 0;
	        $bottom      	  = ($instance['bottom']) ? $instance['bottom'] : 0;
	        $left      	  	  = ($instance['left']) ? $instance['left'] : 0;
	        $class      	  = $instance['class'];
	        
	        $image_url 		  = wp_get_attachment_image_src($bg_image, $image_size);
			$title			  = get_bloginfo('name');
			$imgSrc 		  = $image_url[0];
	        echo $before_widget;
	        ?>
	            <div class="wd-shortcode-banner banner-catalog <?php echo esc_attr($class); ?> <?php echo esc_attr($effect_style); ?>">				
					<div class="wd-image-banner">
						<?php if($button_text == '' && $link_url !== '' ):?>
							<a href="<?php echo esc_url($link_url)?>">
								<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
							</a>
						<?php else: ?>
							<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
						<?php endif;?>
					</div>
					<?php if($button_text !== '' && $link_url !== '' ):?>
						<div class="wd-button-banner" style="top: <?php echo esc_attr($top);?>;left: <?php echo esc_attr($left);?>; right: <?php echo esc_attr($right);?>; bottom: <?php echo esc_attr($bottom);?>;">
							<a class="wd-button-bn <?php echo esc_attr($button_class)?>" href="<?php echo esc_url($link_url)?>" title="<?php echo esc_attr($title);?>" style="font-size: <?php echo esc_attr($button_text_size);?>;"><?php echo esc_attr($button_text);?></a>
						</div>
					<?php endif;?>
				</div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['bg_image']            = strip_tags( $new_instance['bg_image'] );
	        $instance['image_size']          = strip_tags( $new_instance['image_size'] );
	        $instance['button_text']         = strip_tags( $new_instance['button_text'] );
	        $instance['link_url']            = strip_tags( $new_instance['link_url'] );
	        $instance['button_class']        = strip_tags( $new_instance['button_class'] );
	        $instance['top']            	 = strip_tags( $new_instance['top'] );
	        $instance['right']            	 = strip_tags( $new_instance['right'] );
	        $instance['bottom']              = strip_tags( $new_instance['bottom'] );
	        $instance['left']            	 = strip_tags( $new_instance['left'] );
	        $instance['class']            	 = strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_banner_image() {
		register_widget( 'tvlgiao_wpdance_widget_banner_image' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_banner_image' );
}
?>