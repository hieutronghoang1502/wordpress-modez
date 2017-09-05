<?php
if( !class_exists( 'tvlgiao_wpdance_widget_category_list_child' ) ) {
	class tvlgiao_wpdance_widget_category_list_child extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_category_list_child', 'description' => esc_html__('Category List Child Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('category_list_child', esc_html__('WD - Category List Child','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $banner_image   	= esc_attr( isset( $instance['banner_image'] ) ? $instance['banner_image'] : '' );
	        $image_url  	= '';
	        if ($banner_image) {
	        	$image 		= wp_get_attachment_image_src( $banner_image, 'full' );
	        	$image_url 	= $image[0];
	        }
	        $banner_size   	= esc_attr( isset( $instance['banner_size'] ) ? $instance['banner_size'] : 'full' );
	        $category_parent= esc_attr( isset( $instance['category_parent'] ) ? $instance['category_parent'] : '-1' );
	        $number_category= esc_attr( isset( $instance['number_category'] ) ? $instance['number_category'] : '6' );
	        $title      	= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $description  	= esc_attr( isset( $instance['description'] ) ? $instance['description'] : '' );
	        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			global $_wp_additional_banner_sizes;
			$list_banner_size = array('full' => 'Full size');
			foreach ($_wp_additional_banner_sizes as $key => $value) {
				$list_banner_size[$key] = $key.' - '.$value['width'].'x'.$value['height'];
			} 

			$category_parent_arr = array();
			$category_parent_arr[-1] = esc_html__('All Category','wpdancelaparis');
			if( class_exists('WooCommerce') ){
				$categories = 	get_terms( 'product_cat', 
											array(
												'hide_empty' 	=> 0,
												'parent' => 0
											)
										 );
				foreach ($categories as $category ) {
					$category_parent_arr[$category->term_id] = $category->slug;
				}
				wp_reset_postdata();
			} 
	        ?>
	            <p>
	                <label><?php esc_html_e( 'Banner:', 'wpdancelaparis' ); ?></label>
	                <div class="wd_banner_image_widget_img">
	                	<img class="wd_banner_image_view_image" src="<?php echo $image_url; ?>" alt="" width="400px">
	                </div>
	                <input type="hidden" class="widefat wd_banner_image_banner_image" id="<?php echo $this->get_field_id( 'banner_image' ); ?>" name="<?php echo $this->get_field_name( 'banner_image' ); ?>" value="<?php echo $banner_image; ?>">

	                <a href="#" id="wd_banner_image_select_image" data-view="wd_banner_image_view_image" data-field="wd_banner_image_banner_image">Select Image</a>
	            </p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('banner_size')); ?>"><?php esc_html_e('Banner Size:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('banner_size')); ?>" id="<?php echo esc_attr($this->get_field_id('banner_size')); ?>">
						<?php foreach( $list_banner_size as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($banner_size==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('category_parent')); ?>"><?php esc_html_e('Category Parent:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('category_parent')); ?>" id="<?php echo esc_attr($this->get_field_id('category_parent')); ?>">
						<?php foreach( $category_parent_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($category_parent==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>
				<p>
	                <label for="<?php echo $this->get_field_id( 'number_category' ); ?>"><?php esc_html_e( 'Number Category:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_category' ); ?>" name="<?php echo $this->get_field_name( 'number_category' ); ?>" type="text" value="<?php echo $number_category; ?>" />
	                </label>
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
	        $banner_image   	= $instance['banner_image'];
	        $banner_size   	  	= $instance['banner_size'];
	        $category_parent    = $instance['category_parent'];
	        $number_category    = $instance['number_category'];
	        $title      	  	= $instance['title'];
	        $description     	= $instance['description'];
	        $class      	  	= $instance['class'];

	        if ($banner_image) {
	        	$image_url 		  	= wp_get_attachment_image_src($banner_image, $banner_size);
				$imgSrc 		  	= $image_url[0];
	        }

			$args = array(
			    'number'     => $number_category,
			    'orderby'    => 'name',
			    'order'      => 'ASC',
			    'hide_empty' => true,
			    
			);
			if ($category_parent != -1) {
				$args['parent'] = $category_parent;
			}
			$product_categories = get_terms( 'product_cat', $args );
			
			$count = count($product_categories);
			
	        echo $before_widget;
	        if ( $count > 0 ){ ?>
				<div class="category-items-inner <?php echo esc_attr($class); ?>">
					<?php if ($banner_image): ?>
						<div class="category-image">
	                      <img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
	                    </div>
					<?php endif ?>
                    
                    <div class="category-caption">
                    	<?php if ($title): ?>
                    		<span class="category_header1"><?php echo esc_html($title);?></span>
                    	<?php endif ?>
                      	<?php if ($description): ?>
                      		 <span class="category_header2"><?php echo esc_html($description);?></span>
                      	<?php endif ?>
                     
	                      <ul class="category_linklist">
	                        <?php foreach ( $product_categories as $product_category ) { ?>
						        <li>
		                          <a href="<?php echo get_term_link( $product_category ); ?>"><?php echo esc_html($product_category->name); ?></a>
		                        </li>
						    <?php } ?>
	                      </ul>
                    </div>
	            </div>
			<?php
			}
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['banner_image']       = strip_tags( $new_instance['banner_image'] );
	        $instance['banner_size']        = strip_tags( $new_instance['banner_size'] );
	        $instance['category_parent']    = strip_tags( $new_instance['category_parent'] );
	        $instance['number_category']    = strip_tags( $new_instance['number_category'] );
	        $instance['title']            	= strip_tags( $new_instance['title'] );
	        $instance['description']        = strip_tags( $new_instance['description'] );
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_category_list_child() {
		register_widget( 'tvlgiao_wpdance_widget_category_list_child' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_category_list_child' );
}
?>