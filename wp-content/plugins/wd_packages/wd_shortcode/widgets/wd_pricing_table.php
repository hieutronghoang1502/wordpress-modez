<?php
if( !class_exists( 'tvlgiao_wpdance_widget_pricing_table' ) ) {
	class tvlgiao_wpdance_widget_pricing_table extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_pricing_table', 'description' => esc_html__('Pricing table Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('pricing_table', esc_html__('WD - Pricing table','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	       	
	        $style  				= esc_attr( isset( $instance['style'] ) ? $instance['style'] : 'style-1' );
	        $show_icon_font_image  	= esc_attr( isset( $instance['show_icon_font_image'] ) ? $instance['show_icon_font_image'] : '1' );
	        $class_icon_font  		= esc_attr( isset( $instance['class_icon_font'] ) ? $instance['class_icon_font'] : 'fa-rocket' );
	        $image_pricing_url  	= esc_attr( isset( $instance['image_pricing_url'] ) ? $instance['image_pricing_url'] : '' );
	        $title  				= esc_attr( isset( $instance['title'] ) ? $instance['title'] : 'Basic Plan' );
	        $description  			= esc_attr( isset( $instance['description'] ) ? $instance['description'] : '' );
	        $price  				= esc_attr( isset( $instance['price'] ) ? $instance['price'] : '0' );
	        $currency  				= esc_attr( isset( $instance['currency'] ) ? $instance['currency'] : '$' );
	        $price_period  			= esc_attr( isset( $instance['price_period'] ) ? $instance['price_period'] : 'month' );
	        $link  					= esc_attr( isset( $instance['link'] ) ? $instance['link'] : 'http://wpdance.com/' );
	        $target  				= esc_attr( isset( $instance['target'] ) ? $instance['target'] : '' );
	        $button_text  			= esc_attr( isset( $instance['button_text'] ) ? $instance['button_text'] : 'Buy Now' );
	        $active  				= esc_attr( isset( $instance['active'] ) ? $instance['active'] : '#' );
	        $content  				= esc_attr( isset( $instance['content'] ) ? $instance['content'] : '' );
	        
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			$style_arr = array(
				'style-1'	=> 'Style 1',
				'style-2'	=> 'Style 2',
				'style-3'	=> 'Style 3',
				'style-4'	=> 'Style 4',
				'style-5'	=> 'Style 5',
				'style-6'	=> 'Style 6',
				'style-7'	=> 'Style 7',
				'style-8'	=> 'Style 8',
			);

			$show_icon_font_image_arr = array(
				'1'			=> 'Icon Font (Only Style 3)',
				'0'			=> 'Image (Only Style 8)'
			);

			$target_arr = array(
				"" 				=> "",
				"_self" 		=> "Self",
				"_blank" 		=> "Blank",	
				"_parent" 		=> "Parent"
			);

			$yes_no = array(
				"no" 			=> "No",
				"yes" 			=> "Yes"	
			); 


	        ?>
	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('style')); ?>"><?php esc_html_e('Style:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
						<?php foreach( $style_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($style==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_icon_font_image')); ?>"><?php esc_html_e('Show image or icon font:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_icon_font_image')); ?>" id="<?php echo esc_attr($this->get_field_id('show_icon_font_image')); ?>">
						<?php foreach( $show_icon_font_image_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_icon_font_image==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'class_icon_font' ); ?>"><?php esc_html_e( 'Class Icon (Font Awesome):', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'class_icon_font' ); ?>" name="<?php echo $this->get_field_name( 'class_icon_font' ); ?>" type="text" value="<?php echo $class_icon_font; ?>" placeholder="<?php esc_html_e('Exam: fa-diamond','wpdancelaparis'); ?>; ?>" />
	                </label>
	            </p>


				<p>
	                <label><?php esc_html_e( 'Image Pricing:', 'wpdancelaparis' ); ?></label>
	                <div class="wd_banner_image_widget_img">
	                	<img class="wd_banner_image_view_image" src="<?php echo $image_url; ?>" alt="" width="400px">
	                </div>
	                <input type="hidden" class="widefat wd_banner_image_image_pricing_url" id="<?php echo $this->get_field_id( 'image_pricing_url' ); ?>" name="<?php echo $this->get_field_name( 'image_pricing_url' ); ?>" value="<?php echo $image_pricing_url; ?>">

	                <a href="#" id="wd_banner_image_select_image" data-view="wd_banner_image_view_image" data-field="wd_banner_image_image_pricing_url">Select Image</a>
	            </p>
				
				<p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo $description; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'price' ); ?>"><?php esc_html_e( 'Price:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'price' ); ?>" name="<?php echo $this->get_field_name( 'price' ); ?>" type="text" value="<?php echo $price; ?>" />
	                </label>
	            </p>



	            <p>
	                <label for="<?php echo $this->get_field_id( 'currency' ); ?>"><?php esc_html_e( 'Currency:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'currency' ); ?>" name="<?php echo $this->get_field_name( 'currency' ); ?>" type="text" value="<?php echo $currency; ?>" />
	                </label>
	            </p>


	            <p>
	                <label for="<?php echo $this->get_field_id( 'price_period' ); ?>"><?php esc_html_e( 'Price Period:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'price_period' ); ?>" name="<?php echo $this->get_field_name( 'price_period' ); ?>" type="text" value="<?php echo $price_period; ?>" />
	                </label>
	            </p>


	            <p>
	                <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php esc_html_e( 'Link:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo $link; ?>" />
	                </label>
	            </p>

	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('target')); ?>"><?php esc_html_e('Target:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('target')); ?>" id="<?php echo esc_attr($this->get_field_id('target')); ?>">
						<?php foreach( $target_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($target==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Button Text:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $button_text; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'active' ); ?>"><?php esc_html_e( 'Active:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'active' ); ?>" name="<?php echo $this->get_field_name( 'active' ); ?>" type="text" value="<?php echo $active; ?>" />
	                </label>
	            </p>

	            <p>
			       <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:', 'wpdancelaparis' ); ?></label>
			        <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
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
	        $style   	  	  = $instance['style'];
	        $show_icon_font_image     	= $instance['show_icon_font_image'];
	        $class_icon_font   	  	  	= $instance['class_icon_font'];
	        $image_pricing_url   	  	= $instance['image_pricing_url'];
	        $title   	  	   		  	= $instance['title'];
	        $description   	  	   	  	= $instance['description'];
	        $price   	  	   		  	= $instance['price'];
	        $currency   	  	   		= $instance['currency'];
	        $price_period   	  	   	= $instance['price_period'];
	        $link   	  	   		  	= $instance['link'];
	        $target   	  	   		  	= $instance['target'];
	        $button_text   	  	   		= $instance['button_text'];
	        $active   	  	   		 	= $instance['active'];
	        $content   	  	   		 	= $instance['content'];
	        $class   	  	  		  	= $instance['class'];

	        if($image_pricing_url != ""){
	            $image                   = wp_get_attachment_image_src($image_pricing_url,'full');
	            $image_pricing_url       = $image[0];
	        }	        
		    $html = ""; 
		        
	        if($target == ""){
	                $target = "_self";
	        }
	        
	        echo $before_widget;
	        ?>
				<div class='wd_price_table price_<?php echo esc_attr($style); ?> <?php echo esc_attr($class); ?>'>
		            <div class="price_table_inner <?php if($active == "yes") echo 'acitve_price'; ?>">
		            <?php if($style == "style-3") : ?>
		                <div class="wd-feature-icon "><a class="feature_icon fa fa-4x fa <?php echo esc_attr($class_icon_font) ?>"></a></div> 
		            <?php endif; ?>             
		                <ul>
		                    <?php if($style == "style-1" || $style == "style-2" || $style == "style-4" || $style == "style-6") : ?>
		                        <li class='prices'>
		                            <span class='price_in_table'>
		                                <span class='value'><?php echo esc_attr($currency); ?></span>
		                                <span class='pricing'><?php echo esc_attr($price); ?></span>
		                                <span class='mark'><?php echo esc_attr($price_period); ?></span>
		                            </span>
		                        </li> <!-- close price li wrapper -->
		                        <?php if($style == "style-4" && $description != "") : ?>
		                            <li class='description'><?php echo esc_attr($description); ?></li> 
		                        <?php endif; ?>
		                        <li class='cell table_title'><h1><?php echo esc_attr($title); ?></h1></li> 
		                	<?php endif; ?>

		                    <?php if($style == "style-3" || $style == "style-5" || $style == "style-7" || $style == "style-8") : ?>
		                        <li class='cell table_title'><h1><?php echo esc_attr($title); ?></h1></li>
		                        <?php if($style == "style-7" && $description != "") : ?>
		                            <li class='description'><?php echo esc_attr($description); ?></li> 
		                        <?php endif; ?> 
		                        <li class='prices'>
		                            <?php if($style == "style-8") : ?>
		                                <img src='<?php echo esc_url($image_pricing_url); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name') ); ?>' title="<?php echo esc_attr(bloginfo('name')) ?>">
		                            <?php endif; ?>
		                            <span class='price_in_table'>
		                                <span class='value'><?php echo esc_attr($currency); ?></span>
		                                <span class='pricing'><?php echo esc_attr($price); ?></span>
		                                <span class='mark'><?php echo esc_attr($price_period); ?></span>
		                            </span>
		                        </li> <!-- close price li wrapper --> 
		                    <?php endif; ?>        	    
		                	<li><?php echo ($content); ?></li> <!-- append pricing table content -->

		                	<li class='price_button'>
		                	   <a class='button normal' href='<?php echo esc_url($link); ?>' target='<?php echo esc_attr($target); ?>'><?php echo esc_attr($button_text); ?></a>
		                	</li> <!-- close button li wrapper -->
		            	    
		            	</ul>
		            </div>
		        </div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['style']      		= strip_tags( $new_instance['style'] );
	        $instance['show_icon_font_image']           = strip_tags( $new_instance['show_icon_font_image'] );
	        $instance['class_icon_font']            	= strip_tags( $new_instance['class_icon_font'] );
	        $instance['image_pricing_url']  = strip_tags( $new_instance['image_pricing_url'] );
	        $instance['title']            	= strip_tags( $new_instance['title'] );
	        $instance['description']        = strip_tags( $new_instance['description'] );
	        $instance['price']            	= strip_tags( $new_instance['price'] );
	        $instance['currency']           = strip_tags( $new_instance['currency'] );
	        $instance['price_period']       = strip_tags( $new_instance['price_period'] );
	        $instance['link']            	= strip_tags( $new_instance['link'] );
	        $instance['target']            	= strip_tags( $new_instance['target'] );
	        $instance['button_text']        = strip_tags( $new_instance['button_text'] );
	        $instance['active']            	= strip_tags( $new_instance['active'] );
	        $instance['content']            = strip_tags( $new_instance['content'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_pricing_table() {
		register_widget( 'tvlgiao_wpdance_widget_pricing_table' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_pricing_table' );
}
?>