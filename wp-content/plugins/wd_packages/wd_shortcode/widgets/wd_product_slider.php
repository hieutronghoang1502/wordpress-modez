<?php
if( !class_exists( 'tvlgiao_wpdance_widget_product_slider' ) ) {
	class tvlgiao_wpdance_widget_product_slider extends WP_Widget{
	    function __construct() {
			$widget_ops 		= array('classname' => 'widget_product_slider', 'description' => esc_html__('Product Slider Widget','wpdancelaparis'));
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct('product_slider', esc_html__('WD - Product Slider','wpdancelaparis'), $widget_ops);
		}
	    function form( $instance )
	    {
	        $title   					= esc_attr( isset( $instance['title'] ) ? $instance['title'] : '' );
	        $id_category   				= esc_attr( isset( $instance['id_category'] ) ? $instance['id_category'] : '' );
	        $data_show      			= esc_attr( isset( $instance['data_show'] ) ? $instance['data_show'] : '' );
	        $number_products			= esc_attr( isset( $instance['number_products'] ) ? $instance['number_products'] : '12' );
	        $sort      					= esc_attr( isset( $instance['sort'] ) ? $instance['sort'] : '' );
	        $order_by      				= esc_attr( isset( $instance['order_by'] ) ? $instance['order_by'] : '' );
	        $columns      				= esc_attr( isset( $instance['columns'] ) ? $instance['columns'] : '' );
	        $is_slider      			= esc_attr( isset( $instance['is_slider'] ) ? $instance['is_slider'] : '' );
	        $show_nav       			= esc_attr( isset( $instance['show_nav'] ) ? $instance['show_nav'] : '' );
	        $auto_play      			= esc_attr( isset( $instance['auto_play'] ) ? $instance['auto_play'] : '' );
	        $per_slide      			= esc_attr( isset( $instance['per_slide'] ) ? $instance['per_slide'] : '3' );
	        $pagination_loadmore      	= esc_attr( isset( $instance['pagination_loadmore'] ) ? $instance['pagination_loadmore'] : '0' );
	        $number_loadmore      = esc_attr( isset( $instance['number_loadmore'] ) ? $instance['number_loadmore'] : '8' );
	        $class      	= esc_attr( isset( $instance['class'] ) ? $instance['class'] : '' );


			$product_category = array();
			$product_category[-1] = esc_html__('All Category','wpdancelaparis');
			if( class_exists('WooCommerce') ){
				$categories = 	get_terms( 'product_cat', 
											array('hide_empty' 	=> 0)
										 );
				foreach ($categories as $category ) {
					$product_category[$category->term_id] = $category->slug;
				}
				wp_reset_postdata();
			} 

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
			$yes_no = array(
				'1' 		=> 'Yes',
				'0' 		=> 'No'
			);
			$hide_show = array(
				'0'		=> 'Hide',
				'1'		=> 'Show'
			);
	        ?>
	            <p>
	                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	                </label>
	            </p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('id_category')); ?>"><?php esc_html_e('Select Category:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('id_category')); ?>" id="<?php echo esc_attr($this->get_field_id('id_category')); ?>">
						<?php foreach( $product_category as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($id_category==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
	                <label for="<?php echo $this->get_field_id( 'number_products' ); ?>"><?php esc_html_e( 'Number Products:', 'wpdancelaparis' ); ?>
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
					<label for="<?php echo esc_attr( $this->get_field_id('is_slider')); ?>"><?php esc_html_e('Is slider:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('is_slider')); ?>" id="<?php echo esc_attr($this->get_field_id('is_slider')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($is_slider==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('show_nav')); ?>"><?php esc_html_e('Show nav:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_nav')); ?>" id="<?php echo esc_attr($this->get_field_id('show_nav')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($show_nav==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
					<label for="<?php echo esc_attr( $this->get_field_id('auto_play')); ?>"><?php esc_html_e('Auto Play:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('auto_play')); ?>" id="<?php echo esc_attr($this->get_field_id('auto_play')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($auto_play==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

				<p>
	                <label for="<?php echo $this->get_field_id( 'per_slide' ); ?>"><?php esc_html_e( 'Per Slider:', 'wpdancelaparis' ); ?>
	                <input class="widefat" id="<?php echo $this->get_field_id( 'per_slide' ); ?>" name="<?php echo $this->get_field_name( 'per_slide' ); ?>" type="text" value="<?php echo $per_slide; ?>" />
	                </label>
	            </p>

	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('pagination_loadmore')); ?>"><?php esc_html_e('Show Loadmore:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('pagination_loadmore')); ?>" id="<?php echo esc_attr($this->get_field_id('pagination_loadmore')); ?>">
						<?php foreach( $yes_no as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($pagination_loadmore==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
						<?php } ?>
					</select>
				</p>

	            <p>
					<label for="<?php echo esc_attr( $this->get_field_id('number_loadmore')); ?>"><?php esc_html_e('Number Products Load More:','wpdancelaparis'); ?></label>
					<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('number_loadmore')); ?>" id="<?php echo esc_attr($this->get_field_id('number_loadmore')); ?>">
						<?php foreach( $hide_show as $key => $value ){ ?>
						<option value="<?php echo esc_attr($key); ?>" <?php echo ($number_loadmore==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
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
	        $title   	  	= $instance['title'];
	        $id_category  	= ($instance['id_category']) ? $instance['id_category'] : '';
	        $data_show    	= ($instance['data_show']) ? $instance['data_show'] : 'recent_product';
	        $number_products= ($instance['number_products']) ? $instance['number_products'] : '12';
	        $sort    		= ($instance['sort']) ? $instance['sort'] : 'term_id';
	        $order_by    	= ($instance['order_by']) ? $instance['order_by'] : 'DESC';
	        $columns    	= ($instance['columns']) ? $instance['columns'] : '2';
	        $pagination_loadmore    = ($instance['pagination_loadmore']) ? $instance['pagination_loadmore'] : '0';
	        $number_loadmore    	= ($instance['number_loadmore']) ? $instance['number_loadmore'] : '8';
	        $is_slider    	= ($instance['is_slider']) ? $instance['is_slider'] : '1';
	        $show_nav    	= ($instance['show_nav']) ? $instance['show_nav'] : '1';
	        $auto_play    	= ($instance['auto_play']) ? $instance['auto_play'] : '1';
	        $per_slide    	= ($instance['per_slide']) ? $instance['per_slide'] : '3';
	        $class   	  	= $instance['class'];


			$class_slider		= '';
			if($is_slider == '1'){
				$columns_product = "";
				$class_slider	 = "wd-style-slider-product";
			}
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
			$products 		= new WP_Query( $args );
			$count_products = $products->found_posts;
			$count 			= 0;
        	$columns_product 	= ($is_slider == '0') ? 'wd-columns-'.$columns : '';
			$random_id 		= 'wd-special-product-slider'.mt_rand();	
	        echo $before_widget;
	        ?>
	            <div class="wd-shortcode-product-slider-wrapper <?php echo esc_html($class); ?>">
					<?php if($title != "") : ?>
						<?php 			
						echo wp_kses_post($before_title . $title . $after_title); 
						?>
					<?php endif; ?>
					<div id="<?php echo esc_attr( $random_id ); ?>" class='wd-shortcode-product-slider <?php echo esc_html($class_slider); ?> wd-wrapper-parents-value'>
					<?php if ( $products->have_posts() ) : ?>
						<div class="wd-products-wrapper <?php echo esc_html($columns_product); ?>">
							<?php if ( $is_slider == '0') : ?>
								<ul class="products grid_default">
							<?php endif; ?>
							
							<!-- Begin while -->
							<?php while ( $products->have_posts() ) : $products->the_post();  ?>
								<?php if (($count == 0 || $count % $per_slide == 0) && $is_slider == '1') : ?>
									<div class="widget_per_slide">
										<ul class="products grid_default">
								<?php endif; // Endif ?>
								
										<?php wc_get_template_part( 'content', 'product' ); ?>
								
								<?php $count++; if( ($count % $per_slide == 0 || $count == $count_products) && $is_slider == '1' ): ?>
										</ul>
									</div>
								<?php endif; // Endif ?>
							<?php endwhile;	?>
							<!-- End While -->
							
							<?php if ( $is_slider == '0') : ?>
								</ul>
							<?php endif; ?>
						</div>
						<?php if( $show_nav && $is_slider ){ ?>
							<div class="slider_control">
								<a href="#" class="prev">&lt;</a>
								<a href="#" class="next">&gt;</a>
							</div>
						<?php } ?>
						<?php if($pagination_loadmore == '1') : ?> 
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
				</div>
				<?php if ( $is_slider == '1') : ?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";						
							var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
							var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
							var owl = $_this.find('.wd-products-wrapper').owlCarousel({
								loop : true
								,items : 1
								,nav : false
								,dots : false
								,navSpeed : 1000
								,slideBy: 1
								,rtl:jQuery('body').hasClass('rtl')
								,navRewind: false
								,autoplay: _auto_play
								,autoplayTimeout: 5000
								,autoplayHoverPause: true
								,autoplaySpeed: false
								,mouseDrag: true
								,touchDrag: true
								,responsiveBaseElement: $_this
								,responsiveRefreshRate: 1000
								,responsive:{
									0:{
										items : 1
									},
									300:{
										items : 1
									},
									579:{
										items : <?php if($columns == 5){echo $columns - 2;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns - 1;}else{echo $columns;}  ?>
									},
									767:{
										items : <?php if($columns == 5){echo $columns - 1;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns;}else{echo $columns;}  ?>
									},
									1100:{
										items : <?php echo $columns ?>
									}
								}
								
								,onInitialized: function(){
								}
							});
							$_this.on('click', '.next', function(e){
								e.preventDefault();
								owl.trigger('next.owl.carousel');
							});

							$_this.on('click', '.prev', function(e){
								e.preventDefault();
								owl.trigger('prev.owl.carousel');
							});
						});
					</script>
				<?php endif; // Endif Slider?>
	        <?php
	        echo $after_widget;
	    }
	    function update( $new_instance, $old_instance )
	    {
	        $instance = $old_instance;
	        $instance['title']            		= strip_tags( $new_instance['title'] );
	        $instance['id_category']          	= strip_tags( $new_instance['id_category'] );
	        $instance['data_show']        	 	= strip_tags( $new_instance['data_show'] );
	        $instance['number_products']        = strip_tags( $new_instance['number_products'] );
	        $instance['sort']        			= strip_tags( $new_instance['sort'] );
	        $instance['order_by']            	= strip_tags( $new_instance['order_by'] );
	        $instance['columns']            	= strip_tags( $new_instance['columns'] );
	        $instance['pagination_loadmore']    = strip_tags( $new_instance['pagination_loadmore'] );
	        $instance['number_loadmore']        = strip_tags( $new_instance['number_loadmore'] );
	        $instance['is_slider']            	= strip_tags( $new_instance['is_slider'] );
	        $instance['show_nav']            	= strip_tags( $new_instance['show_nav'] );
	        $instance['auto_play']            	= strip_tags( $new_instance['auto_play'] );
	        $instance['per_slide']            	= strip_tags( $new_instance['per_slide'] );
	        $instance['class']            		= strip_tags( $new_instance['class'] );
	        return $instance;
	    }
	}
	function wp_widget_register_widget_product_slider() {
		register_widget( 'tvlgiao_wpdance_widget_product_slider' );
	}
	add_action( 'widgets_init', 'wp_widget_register_widget_product_slider' );
}
?>