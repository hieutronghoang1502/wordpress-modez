<?php
if( !class_exists( 'tvlgiao_wpdance_widget_product_grid_list' ) ) {
	class tvlgiao_wpdance_widget_product_grid_list extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_product_grid_list', 'description' => esc_html__('Product Grid/List Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('product_grid_list', esc_html__('WD - Product Grid/List','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $id_category   				= esc_attr( isset( $instance['id_category'] ) ? $instance['id_category'] : '-1' );
	        $style   					= esc_attr( isset( $instance['style'] ) ? $instance['style'] : 'style-default' );
	        $data_show      			= esc_attr( isset( $instance['data_show'] ) ? $instance['data_show'] : 'recent_product' );
	        $number_products				= esc_attr( isset( $instance['number_products'] ) ? $instance['number_products'] : '12' );
	        $sort      					= esc_attr( isset( $instance['sort'] ) ? $instance['sort'] : '' );
	        $order_by      				= esc_attr( isset( $instance['order_by'] ) ? $instance['order_by'] : '' );
	        $columns      				= esc_attr( isset( $instance['columns'] ) ? $instance['columns'] : '1' );
	        $filter_product      		= esc_attr( isset( $instance['filter_product'] ) ? $instance['filter_product'] : '1' );
	        $pagination_loadmore       	= esc_attr( isset( $instance['pagination_loadmore'] ) ? $instance['pagination_loadmore'] : '1' );
	        $number_loadmore      		= esc_attr( isset( $instance['number_loadmore'] ) ? $instance['number_loadmore'] : '8' );
	        $wd_show_grid      			= esc_attr( isset( $instance['wd_show_grid'] ) ? 'true' : 'false' );
	        $class      				= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			$product_category = array();
			$product_category[-1] = esc_html__('All Category','wpdancelaparis');
			$categories = 	get_terms( 'product_cat', 
										array('hide_empty' 	=> 0)
									 );
			foreach ($categories as $category ) {
				$product_category[$category->term_id] = $category->slug;
			}
			wp_reset_postdata();

			$style_arr = array(
				'style-default'		=> 'Style Default',
				'style-home'		=> 'Style Home'
			);


			$data_show_arr = array(
				'recent_product'		=> 'Recent Product',
				'mostview_product'		=> 'Most View Product',
				'onsale_product'		=> 'On Sale Product',
				'featured_product'		=> 'Featured Product'
			);

			$sort_by_arr = array(
				'date'		=> 'Date',
				'name'		=> 'Name',
				'slug'		=> 'Slug'
			);
			$order_by_arr = array(
				'DESC'		=> 'DESC',
				'ASC'		=> 'ASC'
			);
			$columns_arr = array(
				'2'	=> '2 Columns',
				'3'	=> '3 Columns',
				'4'	=> '4 Columns'
			);

			$pagination_loadmore_arr = array(
				'1'	=> 'Pagination',
				'0'	=> 'Load More',
				'2'	=> 'No Show',
			);
			$yes_no = array(
				'1' 		=> 'Yes',
				'0' 		=> 'No'
			);

	        ?>
				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('id_category')); ?>"><?php esc_html_e('Select Category:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id_category')); ?>" id="<?php echo esc_attr($this->get_field_id('id_category')); ?>">
						<?php foreach( $product_category as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($id_category==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('style')); ?>"><?php esc_html_e('Style:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style')); ?>" id="<?php echo esc_attr($this->get_field_id('style')); ?>">
						<?php foreach( $style_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($style==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>
			
	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('data_show')); ?>"><?php esc_html_e('Data Show:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('data_show')); ?>" id="<?php echo esc_attr($this->get_field_id('data_show')); ?>">
						<?php foreach( $data_show_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($data_show==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'number_products' ); ?>"><?php esc_html_e( 'Number of products:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_products' ); ?>" name="<?php echo $this->get_field_name( 'number_products' ); ?>" type="text" value="<?php echo $number_products; ?>" />
	                </label>
	            </p>


	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('sort')); ?>"><?php esc_html_e('Sort by:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('sort')); ?>" id="<?php echo esc_attr($this->get_field_id('sort')); ?>">
						<?php foreach( $sort_by_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($sort==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('order_by')); ?>"><?php esc_html_e('Order by:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('order_by')); ?>" id="<?php echo esc_attr($this->get_field_id('order_by')); ?>">
						<?php foreach( $order_by_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($order_by==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('columns')); ?>"><?php esc_html_e('Columns:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('columns')); ?>" id="<?php echo esc_attr($this->get_field_id('columns')); ?>">
						<?php foreach( $columns_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($columns==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('filter_product')); ?>"><?php esc_html_e('Show Filter Product:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('filter_product')); ?>" id="<?php echo esc_attr($this->get_field_id('filter_product')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($filter_product==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('pagination_loadmore')); ?>"><?php esc_html_e('Show Pagination Or Load More:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('pagination_loadmore')); ?>" id="<?php echo esc_attr($this->get_field_id('pagination_loadmore')); ?>">
						<?php foreach( $pagination_loadmore_arr as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($pagination_loadmore==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'number_loadmore' ); ?>"><?php esc_html_e( 'Number blogs Load More:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'number_loadmore' ); ?>" name="<?php echo $this->get_field_name( 'number_loadmore' ); ?>" type="text" value="<?php echo $number_loadmore; ?>" />
	                </label>
	            </p>

	            <p>
	                <label for="<?php echo $this->get_field_id( 'wd_show_grid' ); ?>"><?php esc_html_e( 'Current Grid Only:', 'wpdancelaparis' ); ?>
    				<input class="checkbox" type="checkbox" <?php checked( $instance[ 'wd_show_grid' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'wd_show_grid' ); ?>" name="<?php echo $this->get_field_name( 'wd_show_grid' ); ?>" /> 
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
	        $id_category  	= ($instance['id_category']) ? $instance['id_category'] : '-1';
	        $style  		= ($instance['style']) ? $instance['style'] : '-1';
	        $data_show    	= ($instance['data_show']) ? $instance['data_show'] : 'recent_product';
	        $number_products	= ($instance['number_products']) ? $instance['number_products'] : '12';
	        $sort    		= ($instance['sort']) ? $instance['sort'] : 'term_id';
	        $order_by    	= ($instance['order_by']) ? $instance['order_by'] : 'DESC';
	        $columns    	= ($instance['columns']) ? $instance['columns'] : '1';
	        $filter_product  = ($instance['filter_product']) ? $instance['filter_product'] : '1';
	        $pagination_loadmore    = ($instance['pagination_loadmore']) ? $instance['pagination_loadmore'] : '0';
	        $number_loadmore    	= ($instance['number_loadmore']) ? $instance['number_loadmore'] : '8';
	        $wd_show_grid    		= ($instance['wd_show_grid']) ? $instance['wd_show_grid'] : 'false';
	        $class   	  	= $instance['class'];

			wp_reset_query();	

			// New Product
			$args = array(  
				'post_type' 		=> 'product',  
				'posts_per_page' 	=> $number_products,
				'orderby' 			=> $sort,
				'order'				=> $order_by,
				'paged' 			=> get_query_var('paged')
			);
			//Category
			if( $id_category != -1 ){
				$args['tax_query']= array(
			    	array(
				    	'taxonomy' 		=> 'product_cat',
						'terms' 		=> $id_category,
						'field' 		=> 'term_id',
						'operator' 		=> 'IN'
					)
	   			);
			}
			//Most View Products
			if($data_show == 'mostview_product'){
				$args['meta_key'] 	= '_wd_product_views_count';
				$args['orderby'] 	= 'meta_value_num';
				$args['order'] 		= 'DESC';
			}

			//On Sale Product
			if($data_show == 'onsale_product'){
				$args['meta_query'] = array(
                    'relation' => 'OR',
                    array( // Simple products type
                        'key'           => '_sale_price',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    ),
                    array( // Variable products type
                        'key'           => '_min_variation_sale_price',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
				);
			}
			//Featured Product
			if($data_show == 'featured_product'){
				$args['meta_key'] 	= '_featured';
				$args['meta_value'] = 'yes';
			}

			$products 			= new WP_Query( $args );
			$count_products 	= $products->found_posts;
			$columns_product 	= 'wd-columns-'.$columns;
			$random_id 			= 'wd-special-product-'.rand(0,1000).time();
	        echo $before_widget;
	        ?>
            <div id="<?php echo esc_html($random_id); ?>" class='wd-shortcode-special-product <?php echo esc_html($class); ?> <?php echo esc_html($style); ?> wd-wrapper-parents-value'>
				<?php if ( $products->have_posts() ) : ?>
					<?php if($filter_product): ?>
						<div class="wrap_filter_button">
							<p class="woocommerce-result-count">
								<?php printf( __('Showing %s - %s of %s results','wpdancelaparis'), get_query_var('paged'), $number_products, $count_products); ?>
							</p>
							<form action="shop" class="woocommerce-ordering" method="get">
								<select name="orderby" class="orderby">
									<option value="menu_order" selected="selected"><?php _e('Default sorting','wpdancelaparis'); ?></option>
									<option value="popularity"><?php _e('Sort by popularity','wpdancelaparis'); ?></option>
									<option value="rating"><?php _e('Sort by average rating','wpdancelaparis'); ?></option>
									<option value="date"><?php _e('Sort by newnes','wpdancelaparis'); ?></option>
									<option value="price"><?php _e('Sort by price: low to high','wpdancelaparis'); ?></option>
									<option value="price-desc"><?php _e('Sort by price: high to low','wpdancelaparis'); ?></option>
								</select>
							</form>
							<?php
								/**
								* Grid/ List Product
								*/  
								do_action( 'woocommerce_before_shop_loop' );
							?>
						</div>
					<?php endif; // Filter Product?>
					<?php if( $wd_show_grid == "true" ) { ?>
						<div class="wd-products-wrapper <?php echo esc_html($columns_product); ?>">
							<ul class="products grid-only">
								<?php while ( $products->have_posts() ) : $products->the_post();  ?>
									
									<?php wc_get_template_part( 'content', 'product' ); ?>
								
								<?php endwhile;	?>
							</ul>
						</div>			
					<?php }else{ ?>
						<div class="wd-products-wrapper grid-list-action <?php echo esc_html($columns_product); ?>">
							<?php woocommerce_product_loop_start(); ?>
							<?php while ( $products->have_posts() ) : $products->the_post();  ?>
								
								<?php wc_get_template_part( 'content', 'product' ); ?>
							
							<?php endwhile;	?>
							<?php woocommerce_product_loop_end(); ?>
						</div>
					<?php }; // Endif ?>

					<?php if($pagination_loadmore == '1') : ?> 
						<div class="wd-pagination">
							<?php tvlgiao_wpdance_pagination(3, $products); ?>
						</div>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
					<?php if($pagination_loadmore == '0') : ?> 
						<div class="wd-loadmore">
							<div class="show_image_loading" id="show_image_loading_<?php echo esc_html($random_id); ?>">
								<img src="<?php echo SC_IMAGE.'/ajax-loader_image.gif';?>" alt="HTML5 Icon" style="height:15px;">
							</div>
							<div id="loadmore">
								<a 	data-random_id="<?php echo esc_html($random_id); ?>" 
									data-posts_per_page="<?php echo esc_html($number_loadmore); ?>" 
									data-id_category="<?php echo esc_html($id_category); ?>" 
									data-data_show="<?php echo esc_html($data_show); ?>" 
									data-sort="<?php echo esc_html($order_by); ?>" 
									data-order_by="<?php echo esc_html($sort); ?>" 
									href="#" class="button btn_loadmore_product"><?php _e('LOAD MORE','wpdancelaparis') ?></a>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; // Have Product?>	
				</div>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['id_category']          	= strip_tags( $new_instance['id_category'] );
	        $instance['data_show']        	 	= strip_tags( $new_instance['data_show'] );
	        $instance['number_products']        	= strip_tags( $new_instance['number_products'] );
	        $instance['sort']        			= strip_tags( $new_instance['sort'] );
	        $instance['order_by']            	= strip_tags( $new_instance['order_by'] );
	        $instance['columns']            	= strip_tags( $new_instance['columns'] );
	        $instance['filter_product']          = strip_tags( $new_instance['filter_product'] );
	        $instance['pagination_loadmore']    = strip_tags( $new_instance['pagination_loadmore'] );
	        $instance['number_loadmore']        = strip_tags( $new_instance['number_loadmore'] );
	        $instance['wd_show_grid']        = strip_tags( $new_instance['wd_show_grid'] );
	        $instance['class']            		= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_product_grid_list() {
		register_widget( 'tvlgiao_wpdance_widget_product_grid_list' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_product_grid_list' );
}
?>