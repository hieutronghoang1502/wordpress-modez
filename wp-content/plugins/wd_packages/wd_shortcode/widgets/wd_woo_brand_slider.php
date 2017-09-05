<?php
if( !class_exists( 'tvlgiao_wpdance_widget_brand_slider' ) ) {
	class tvlgiao_wpdance_widget_brand_slider extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_brand_slider', 'description' => esc_html__('Brand Slider Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('brand_slider', esc_html__('WD - Brand Slider','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
	        ?>

	        	<p>
	                <label><?php esc_html_e( 'Brand Images:', 'wpdancelaparis' ); ?></label>
	                <div class="wd_banner_image_widget_img">
	                	<img class="wd_banner_image_view_image" src="<?php echo $image_url; ?>" alt="" width="100px">
	                </div>
	                <input type="hidden" class="widefat wd_banner_image_image_url" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $image_url; ?>">

	                <a href="#" id="wd_banner_image_select_image" data-view="wd_banner_image_view_image" data-field="wd_banner_image_image_url">Select Image</a>
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
					            title: 'Select Image',
					            multiple: true,
					            priority:  20
					        })];
								 
					        file_frame = wp.media.frames.file_frame = wp.media({
					            states: _states,
					            button: {
					                text: 'Insert URL'
					            }
					        });

					        file_frame.on( 'select', function() {
					            var attachment = file_frame.state().get('selection').toJSON();
								console.log(attachment);
					            $.each( attachment, function( key, value ) {
								  	console.log( value );
								});
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
	        $class   	  	  		  	= $instance['class'];
	        wp_reset_query();
			$args = array(
				'number'     => '',
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => true,
				'include'    => array()
			);

			$product_categories = get_terms( 'product_cat', $args ); 
			$categories_show = '<option value="">'.esc_html__( 'All Categories', 'wpdancelaparis' ).'</option>';
			$check = '';
			if(is_search()){
				if(isset($_GET['term']) && $_GET['term']!=''){
					$check = $_GET['term'];	
				}
			}
			$checked = '';
			foreach($product_categories as $category){
				if(isset($category->slug)){
					if(trim($category->slug) == trim($check)){
						$checked = 'selected="selected"';
					}
					$categories_show  .= '<option '.$checked.' value="'.$category->slug.'">'.$category->name.'</option>';
					$checked = '';
				}
			}
	        echo $before_widget;
	        ?>
				<div class="wd-search-pro-by-cat <?php echo esc_attr($class); ?>">
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
					 	<select class="wd_search_product" name="term"><?php echo balanceTags($categories_show); ?></select>
					 	<div class="wd_search_form">
						 	<input type="text" class="search-field" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_html_e( 'Search for products', 'wpdancelaparis' ); ?> " />
						 	<input type="submit" title="Search" id="searchsubmit" class="search-submit" value="<?php echo esc_attr__( 'Search', 'wpdancelaparis' ); ?>" />
						 	<input type="hidden" name="post_type" value="product" />
						 	<input type="hidden" name="taxonomy" value="product_cat" />
					 	</div>
					</form>
				</div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['class']            	= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_brand_slider() {
		register_widget( 'tvlgiao_wpdance_widget_brand_slider' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_brand_slider' );
}
?>