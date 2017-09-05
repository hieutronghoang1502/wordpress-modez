<?php
if ( ! function_exists( 'tvlgiao_wpdance_products_by_category_tabs_function' ) ) {
	function tvlgiao_wpdance_products_by_category_tabs_function( $atts ) {
		extract(shortcode_atts( array(
			'title'      			=> 'Categories',
			'type'       			=> 'special',
			'id_event'   			=> '',
			'id_single'  			=> '',
			'ids'     	   			=> '',
			'style_tab'				=> 'tab-on-top-content',
			'view_all_tab'  		=> '1',
			'show_event' 			=> 'bestselling',
			'columns' 				=> '4',
			'posts_per_page'		=> '8',
			'sort'      			=> 'DESC',
			'order_by'    			=> 'date',
			'is_slider'				=> '0',
			'show_category_thumb'	=> '0',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'per_slide'				=> '1',
			'class'      			=> 'heading-1',
		), $atts ));

		$tab_style_class 	= ($type == 'categories') ? 'wd-tab-style-'.$style_tab : '';
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $posts_per_page,
			'order'               => $sort,
			'meta_query'          => WC()->query->get_meta_query(),
			'tax_query'           => WC()->query->get_tax_query(),
		);

		switch ( $order_by ) {
			case 'price':
				$args['meta_key'] 	= '_price';
				$args['orderby']  	= 'meta_value_num';
				break;
			case 'sales':
				$args['meta_key'] 	= 'total_sales';
				$args['orderby']  	= 'meta_value_num';
				break;
			default:
				$args['orderby'] 	= $order_by;
				break;
		}

		$tab = array();
		switch ( $type ) {
			case 'special':
				$tab['id']  = $id_event;
				$show_event = array_filter( explode( ',', $show_event ) );
				foreach ( $show_event as $key => $show ) {
					switch ( $show ) {
						case 'bestselling':
							if ( 0 == $key ) {
								$args['meta_key'] = 'total_sales';
								$args['orderby']  = 'meta_value_num';
							}

							$item_name = __( 'Bestselling', 'wpdancelaparis' );
							break;
						case 'featured':
							if ( 0 == $key ) {
								$args['tax_query'][] = array(
									'taxonomy' => 'product_visibility',
									'field'    => 'id',
									'terms'    => 'featured',
									'operator' => 'IN',
								);
							}
							$item_name = __( 'Featured', 'wpdancelaparis' );
							break;
						case 'new_arrivals':
							if ( 0 == $key ) {
							}
							$item_name = __( 'New Arrivals', 'wpdancelaparis' );
							break;
						case 'top_reviewed':
							if ( 0 == $key ) {
								$args['meta_key'] = '_wc_average_rating';
								$args['orderby']  = 'meta_value_num';
							}
							$item_name = __( 'Top Reviewed', 'wpdancelaparis' );
							break;
					}
					/** @var string $item_name */
					$tab['items'][] = array(
						'name' => $item_name,
						'id'   => $tab['id'],
						'slug' => str_replace( '_', '-', $show ),
						'link' => 'products-by-category-tabs-' . str_replace( '_', '-', $show ) . '-' . $tab['id'],
					);
				}
				break;
			case 'single_category':
				$tab['id'] = $id_single;
				// Get list id subcategory + name subcategory => array
				$subcategory = tvlgiao_wpdance_get_subcategory( $tab['id'] );
				if ( isset( $subcategory[0]['id'] ) ) {
					$tab['id'] = $subcategory[0]['id'];
				}
				foreach ( $subcategory as $category ) {
					$tab['items'][] = array(
						'name' => $category['name'],
						'id'   => $category['id'],
						'slug' => $category['slug'],
						'link' => 'products-by-category-tabs-' . $category['slug'] . '-' . rand(),
					);
				}
				break;
			case 'categories':
				foreach ( tvlgiao_wpdance_get_category_name_by_ids( explode( ',', $ids ) ) as $category ) {
					$tab['items'][] = array(
						'name' => $category['name'],
						'id'   => $category['id'],
						'slug' => $category['slug'],
						'link' => 'products-by-category-tabs-' . $category['slug'],
					);
				}
				$tab['id'] = $tab['items'][0]['id'];
				break;
		}

		$args['tax_query'][] = array(
			'terms'    => $tab['id'],
			'taxonomy' => 'product_cat', 
		);

		if ( $type === 'categories' ) {
			$tab['heading'] = '<span>' . $title . '</span>';
			$tab['link']    = '<span><a href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" role="tab">' . __( 'View All Products', 'wpdancelaparis' ) . '</a></span>';
		} else {
			$term           = get_term_by( 'id', $tab['id'], 'product_cat' );
			$tab['heading'] = '<a href="' . get_term_link( $term->slug, $term->taxonomy ) . '">' . $term->name . '</a>';
			$tab['link']    = '<span><a href="' . get_term_link( $term->slug, $term->taxonomy ) . '" role="tab">' . __( 'View All Products', 'wpdancelaparis' ) . '</a></span>';
		}

		$tab['img'] = wp_get_attachment_image( get_term_meta( $tab['id'], 'thumbnail_id', true ), 'full' );

		$products = new WP_Query( $args );

		$num_post =  $products->found_posts;
		if( $num_post < 2 || $num_post <= ($per_slide * $columns) ){
			$is_slider = '0';
		}
		if( $num_post <= $posts_per_page ){
			$posts_per_page = $num_post;
		}
		$columns_product 	= ($is_slider == '0') ? 'wd-columns-'.$columns : '';

		ob_start();
		if ( $products->have_posts() ) :
			// Show control_tab
			?>
			<div class="products-by-category-tabs <?php echo esc_html($tab_style_class); ?> ">
				<div class="tab-control <?php echo esc_attr( $class ) ?>">
					<ul class="tabs" role="tablist">
						<?php if ($title): ?>
							<li class="heading">
								<h2 class="wd-heading">
									<?php echo $tab['heading'] ?>
								</h2><!-- .wd-heading -->
							</li><!-- .heading -->
						<?php endif ?>
						<?php foreach ( $tab['items'] as $key => $item ) : ?>
							<li class="tab <?php echo ( 0 == $key ) ? 'active' : '' ?>" role="presentation">
								<a href="#<?php echo $item['link']; ?>"
								   role="tab" data-toggle="tab"
								   data-type="<?php echo $type; ?>"
								   data-slug="<?php echo $item['slug']; ?>"
								   data-sort="<?php echo $sort; ?>"
								   data-order_by="<?php echo $order_by; ?>"
								   data-id="<?php echo $item['id']; ?>"
								   data-columns="<?php echo $columns; ?>"
								   data-posts_per_page="<?php echo $posts_per_page; ?>"
								   data-is_slider="<?php echo $is_slider; ?>"
								   data-show_category_thumb="<?php echo $show_category_thumb; ?>"
								   data-show_nav="<?php echo $show_nav; ?>"
								   data-auto_play="<?php echo $auto_play; ?>"
								   data-per_slide="<?php echo $per_slide; ?>"
								   ><?php echo $item['name'] ?></a>
							</li>
						<?php endforeach; ?>
						<?php if ($type !== 'categories' || ($type === 'categories' && $view_all_tab)): ?>
							<li class="tab tab-link" role="presentation"><?php echo $tab['link'] ?></li>
						<?php endif ?>
						
					</ul>
				</div><!-- .tabs-control -->
				<div class="tab-content">
					<?php foreach ( $tab['items'] as $key => $item ) : ?>
						<section role="tabpanel" class="tab-pane <?php echo ( 0 == $key ) ? 'active' : '' ?>"
						         id="<?php echo $item['link'] ?>"
						         data-load="<?php echo ( 0 == $key ) ? 'loaded' : 'loading' ?>">
							
							<?php $random_id = 'wd-product-by-category-tab-'.mt_rand(); ?>
							<div id="<?php echo esc_attr( $random_id ); ?>" >
								<div class="wd-products-wrapper <?php echo esc_html($columns_product); ?> <?php echo ( 0 == $key ) ? 'products-by-category-tabs-products' : 'products-by-category-tabs-loading' ?>">
									<?php if ( 0 == $key ): ?>

										<?php woocommerce_product_loop_start(); ?>

											<?php if ($is_slider == 0 && $show_category_thumb): ?>
												<?php echo '<li class="wd-product-by-category-thumbnail">' . $tab['img'] . '</li>'; //category thumbnail ?> 
											<?php endif ?>

											<?php $count = 0; ?>

											<?php while ( $products->have_posts() ) : $products->the_post(); ?> 
												<?php if (($count == 0 || $count % $per_slide == 0) && $is_slider == '1') : ?>
													<div class="widget_per_slide">
												<?php endif; // Endif ?>

													<?php wc_get_template( 'content-product.php' ); ?>

												<?php $count++; ?>

												<?php if( ($count % $per_slide == 0 || $count == $num_post) && $is_slider == '1' ): ?>
													</div>
												<?php endif; // Endif ?> 
											<?php endwhile; ?> 

										<?php woocommerce_product_loop_end(); ?>

									<?php else: ?>
										<?php $number_loading_icon = ($is_slider == 0) ? $posts_per_page : ($columns * $per_slide); ?>
										<ul class="text-center">
											<?php for ( $i = 0; $i < $number_loading_icon; $i ++ ): ?>
												<li><img alt="<?php __( 'loading', 'wpdancelaparis' ) ?>" src="<?php echo SC_IMAGE.'/ajax-loader_image_2.gif';?>"></li>
											<?php endfor; ?>
										</ul>
									<?php endif; ?>
								</div>
								<?php if( $show_nav && $is_slider ){ ?>
									<div class="slider_control">
										<a href="#" class="prev">&lt;</a>
										<a href="#" class="next">&gt;</a>
									</div>
								<?php } ?>
								
								<?php if ( $is_slider == '1') : ?>
									<script type="text/javascript">
										jQuery(document).ready(function(){
											"use strict";						
											var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
											var _auto_play = <?php echo esc_attr( $auto_play ); ?> == 1;
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
								<?php endif; // Endif Slider?>
							</div>
						</section>
					<?php endforeach; ?>
				</div><!-- .tabs-contents -->
			</div><!-- .products-by-category-tabs -->
			<?php

			wp_reset_postdata();
		endif;

		return ob_get_clean();
	}
}
add_shortcode( 'tvlgiao_wpdance_products_by_category_tabs', 'tvlgiao_wpdance_products_by_category_tabs_function' );