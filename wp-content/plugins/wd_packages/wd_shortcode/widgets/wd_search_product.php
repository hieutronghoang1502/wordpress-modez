<?php
if( !class_exists( 'tvlgiao_wpdance_widget_search_product' ) ) {
	class tvlgiao_wpdance_widget_search_product extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_search_product', 'description' => esc_html__('Search Product Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('search_product', esc_html__('WD - Search Product','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $class      			= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );
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
	        $class    	 	= isset( $instance['class'] ) ? $instance['class'] : '';
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
						<div class="wrap-select">
					 		<select class="wd_search_product" name="term"><?php echo balanceTags($categories_show); ?></select>
				 		</div>
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
	function wp_widget_register_widget_search_product() {
		register_widget( 'tvlgiao_wpdance_widget_search_product' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_search_product' );
}
?>