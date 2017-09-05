<?php
/**
 * Shortcode: tvlgiao_wpdance_products_simple_slider
 */

if (!function_exists('tvlgiao_wpdance_products_simple_slider_function')) {
	function tvlgiao_wpdance_products_simple_slider_function($atts) {
		extract(shortcode_atts(array(
			'id_category'			=> '-1',
			'data_show'				=> 'recent_product',
			'number_products'		=> '12',
			'image_size'		    => 'shop_catalog',
			'sort'					=> 'DESC',
			'order_by'				=> 'date',
			'columns'				=> '1',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'class'					=> ''

		), $atts));
		wp_reset_query();	

		// New Product
		$args = array(  
			'post_type' 		=> 'product',  
			'posts_per_page' 	=> $number_products,
			'order' 			=> $sort,
			'paged' 			=> get_query_var('paged')
		);
		//Category
		if( $id_category != -1 ){
			$args['tax_query']['relation'] = 'AND';
			$args['tax_query'][] = array(
		    	'taxonomy' 		=> 'product_cat',
				'terms' 		=> $id_category,
				'field' 		=> 'term_id',
				'operator' 		=> 'IN'
   			);
		}
		switch ( $order_by ) {
			case 'price':
				$args['meta_key'] = '_price';
				$args['orderby']  = 'meta_value_num';
				break;
			case 'sales':
				$args['meta_key'] = 'total_sales';
				$args['orderby']  = 'meta_value_num';
				break;
			default:
				$args['orderby'] 	= $order_by;
				break;
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
			$args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            );
		}
		$is_slider 		= 1;
		$products 		= new WP_Query( $args );
		$count 			= 0;
		$random_id 		= 'wd_special_product_slider'.mt_rand();	
		ob_start(); ?>
		<?php if ( $products->have_posts() ) : ?>
			<div class="wd-scpro-single-slider <?php echo esc_html($class); ?>">
				<div id="<?php echo esc_attr( $random_id ); ?>" class='wd-shortcode-product-slider wd-wrapper-parents-value'>
				
					<?php woocommerce_product_loop_start(); ?>
					<div class="wd-products-wrapper">				
						<?php while ( $products->have_posts() ) : $products->the_post(); global $post; ?>
							<div class="widget_per_slide">
								<?php tvlgiao_wpdance_display_product_by_custom_thumbnail_size($image_size); ?>
							</div>
						<?php endwhile; //End While ?>
					</div>
					<?php woocommerce_product_loop_end(); ?>
					<?php if( $show_nav && $is_slider == '1'){ ?>
						<div class="slider_control">
							<a href="#" class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
							<a href="#" class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
						</div>
					<?php } ?>
				</div>
				<?php if ( $is_slider == '1') : ?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							"use strict";						
							var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
							var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
							var owl = $_this.find('.wd-products-wrapper').owlCarousel({
								loop : true,
								items : 1,
								nav : false,
								dots : true,
								navSpeed : 1000,
								slideBy: 1,
								rtl:jQuery('body').hasClass('rtl'),
								navRewind: false,
								autoplay: _auto_play,
								autoplayTimeout: 5000,
								autoplayHoverPause: true,
								autoplaySpeed: false,
								mouseDrag: true,
								touchDrag: true,
								responsiveBaseElement: $_this,
								responsiveRefreshRate: 1000,
								responsive:{
									0:{
										items : 1
									},
									300:{
										items : 1
									},
									579:{
										items : <?php if($columns > 5){echo 3;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns - 1;}else{echo $columns;}  ?>
									},
									767:{
										items : <?php if($columns > 5){echo 4;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns;}else{echo $columns;}  ?>
									},
									1100:{
										items : <?php echo $columns ?>
									}
								},
								onInitialized: function(){
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
				<?php endif; // Endif Slider ?>
			</div>
		<?php endif; // Have Product ?>	
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_products_simple_slider', 'tvlgiao_wpdance_products_simple_slider_function');
?>