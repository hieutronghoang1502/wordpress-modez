<?php
/**
 * Shortcode: tvlgiao_wpdance_special_products_slider
 */

if (!function_exists('tvlgiao_wpdance_special_products_slider_function')) {
	function tvlgiao_wpdance_special_products_slider_function($atts) {
		extract(shortcode_atts(array(
			'title'					=> '',
			'description'			=> '',
			'text_align'			=> 'text-center',
			'view_all_link_display'	=> '0',
			'view_all_text'			=> 'View All',
			'view_all_url'			=> '#',
			'id_category'			=> '-1',
			'data_show'				=> 'recent_product',
			'number_products'		=> '12',
			'product_style'			=> 'grid',
			'image_padding'			=> '0',
			'image_size'			=> 'shop_catalog',
			'sort'					=> 'DESC',
			'order_by'				=> 'date',
			'columns'				=> '1',
			'pagination_loadmore'	=> '0',
			'number_loadmore'		=> '8',
			'is_slider'				=> '1',
			'slider_type'			=> 'owl',
			'center_mode'			=> '0',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'per_slide'				=> '3',
			'class'					=> ''

		), $atts));
		
		$class_slider		= '';
		if($is_slider == '1'){
			$columns_product = "";
			$class_slider	 = "wd-style-slider-product";
		}
		//padding between image item
		if ($product_style == 'image_thumb_only' && $image_padding) {
			$style_wrapper 	= "margin-left:-{$image_padding}px;margin-right:-{$image_padding}px;";
			$style_item 	= "padding:{$image_padding}px;";
		}else{
			$style_wrapper 	= '';
			$style_item 	= '';
		}

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

		$products 			= new WP_Query( $args );
		$count_products 	= $products->found_posts;
		if ($count_products <= $columns) {
			$is_slider = '0';
		}
		$columns_product 	= ($is_slider == '0') ? 'wd-columns-'.$columns : '';
		$random_id 			= 'wd_special_product_slider_'.mt_rand();	
		ob_start(); ?>
		<?php if ( $products->have_posts() ) : ?>
			<div class="wd-shortcode-product-slider-wrapper <?php echo esc_attr($class); ?>">
				<?php if($title != "" || $description != "" || $view_all_link_display) : ?>
					<div class="wd-product-special-slider-header <?php echo esc_html($text_align); ?>">
						<?php if($title != "") : ?>
							<h2 class="wd-title-shortcode"><?php echo esc_html($title); ?></h2>
						<?php endif; ?>
						<?php if($description != "" || $view_all_link_display) : ?>
							<div class="wd-description-shortcode">
							<?php if($description != "") : ?>
								<?php echo esc_html($description); ?>
							<?php endif; ?>
							<?php if($description != "" && $view_all_link_display) : ?>
								<?php _e(' | ','wpdancelaparis') ?>
							<?php endif; ?>
							<?php if($view_all_link_display) : ?>
								<a target="_blank" href="<?php echo esc_url($view_all_url);?>"><?php echo esc_html($view_all_text); ?></a>
							<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div id="<?php echo esc_attr( $random_id ); ?>" class='wd-shortcode-product-slider <?php echo esc_html($class_slider); ?> wd-wrapper-parents-value'>
					<div class="wd-products-wrapper <?php echo esc_html($columns_product); ?>">
						<ul class="products <?php echo esc_attr( $product_style ); ?>" style="<?php //echo esc_attr($style_wrapper); ?>">
						<!-- Begin while -->
						<?php $count = 0; ?>
						<?php while ( $products->have_posts() ) : $products->the_post();  ?>
							<?php global $product; ?>
							<?php if (($count == 0 || $count % $per_slide == 0) && $is_slider == '1') : ?>
								<div class="widget_per_slide">
							<?php endif; // Endif ?>
								<?php if ($product_style == 'image_thumb_only'): ?>
									<?php $image_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id()), $image_size ); ?>
	                                <a href="<?php the_permalink(); ?>">
	                                	<div class="wd-product-slider-image-thumb-only-item" style="<?php echo esc_attr($style_item); ?>">
	                                		<img src="<?php echo esc_url($image_thumbnail['0']); ?>" class="img img-thumbnail img-responsive">
                                		</div>
                                	</a>
								<?php else: ?>
									<?php tvlgiao_wpdance_display_product_by_custom_thumbnail_size($image_size); ?>
								<?php endif ?>
							<?php $count++; ?>
							<?php if( ($count % $per_slide == 0 || $count == $count_products) && $is_slider == '1' ): ?>
								</div>
							<?php endif; // Endif ?>
						<?php endwhile;	?>
						<!-- End While -->
						
						</ul>
					</div>
					<?php if( $show_nav && $is_slider && $slider_type == 'owl' ){ ?>
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
									data-sort="<?php echo esc_html($sort); ?>" 
									data-order_by="<?php echo esc_html($order_by); ?>" 
									href="#" class="button btn_loadmore_product"><?php _e('LOAD MORE','wpdancelaparis') ?></a>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<?php if ( $is_slider == '1') : ?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						"use strict";						
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
						<?php if ( $slider_type == 'owl' ) : ?>
							var owl = $_this.find('.wd-products-wrapper .products').owlCarousel({
								loop : true,
								items : 1,
								nav : false,
								dots : false,
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
								}
								,
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
						<?php else: ?>
							$_this.find('.wd-products-wrapper .products').slick({
								centerMode		: <?php echo ($center_mode == '1') ? 'true' : 'false'; ?>,
								autoplay 		: <?php echo ($auto_play == '1') ? 'true' : 'false'; ?>,
							  	autoplaySpeed	: 2000,
								centerPadding	: '60px',
								slidesToShow	: <?php echo $columns ?>,
								responsive		: [
								    {
								      	breakpoint			: 768,
								      	settings 			: {
									        arrows			: false,
									        centerMode		: true,
									        centerPadding	: '40px',
									        slidesToShow	: <?php echo $columns ?>
									     }
								    },
								    {
								      	breakpoint			: 480,
								      	settings			: {
									        arrows			: false,
									        centerMode		: true,
									        centerPadding	: '40px',
									        slidesToShow	: 1
								      	}
								    }
								]
							});
						<?php endif; ?>
					});
				</script>
			<?php endif; // Endif Slider?>
		<?php endif; // Have Product?>	
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_special_products_slider', 'tvlgiao_wpdance_special_products_slider_function');
?>