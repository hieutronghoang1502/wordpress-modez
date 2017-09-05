<?php
/**
 * Shortcode: tvlgiao_wpdance_products_simple_slider
 */

if (!function_exists('tvlgiao_wpdance_products_single_detail_function')) {
	function tvlgiao_wpdance_products_single_detail_function($atts) {
		extract(shortcode_atts(array(
			'product_id'			=> '-1',
			'thumbnail'				=> '1',
			'image_size'		    => 'shop_catalog',
			'layout_style'			=> '1',
			'title'					=> '1',
			'add_to_cart'			=> '1',
			'description'			=> '1',
			'price'					=> '1',
			'class'					=> ''

		), $atts));
		wp_reset_query();	

		if ($product_id) {
			$args = array(  
				'post_type' 		=> 'product',  
				'post__in'			=> array($product_id),
			);
		} else {
			$args = '';
		}
		
		$products 		= new WP_Query( $args );
		$product_classes[] = 'product';
		$product_classes[] = 'wd-product-single-detail';
		$product_classes[] = ($layout_style == '1') ? 'wd-product-single-style-sync-with-shop' : 'wd-product-single-style-custom-layout';
		ob_start(); ?>
		<?php if ( $products->have_posts() ) : ?>
			<div class="wd-product-single-detail-shortcode <?php echo esc_html($class); ?>">
				<div class="wd-products-wrapper">				
					<?php while ( $products->have_posts() ) : $products->the_post(); global $post; ?>
						<?php if ($layout_style == '1'): ?>
							<?php woocommerce_product_loop_start(); ?>						
						<?php else: ?>
							<ul class="wd-products">
						<?php endif ?>
							<li <?php post_class($product_classes); ?>>
								<?php if ($thumbnail && has_post_thumbnail()): ?>
									<div class="wd-thumbnail-product">
										<a class="pro-thumbnail" href="<?php the_permalink(); ?>">
											<?php
												the_post_thumbnail($image_size, array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ));
											?>
										</a>
									</div>
								<?php endif ?>
								<div class="wd-content-detail">
									<?php if ($title): ?>
										<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
									<?php endif ?>
									<?php if ($price): ?>
										<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
									<?php endif ?>
									<?php if ($description): ?>
										<?php tvlgiao_wpdance_short_description_product(); ?>
									<?php endif ?>
									<?php if ($add_to_cart): ?>
										<div class="wd-button-shop wd-button-shop-before-content">
											<div class="wd-button-add-to-cart">
												<?php
												/**
												 * woocommerce_button_shop
												 *
												 * @hooked woocommerce_template_loop_add_to_cart 5
												 */
												do_action( 'tvlgiao_wpdance_button_add_to_cart' );			
											?>
											</div>
											<?php
												/**
												 * woocommerce_button_shop
												 *
												 * @hooked add_quickshop_button - 5
												 * @hooked add_compare_link - 15
												 * @hooked tvlgiao_wpdance_wishlist_button_shop_loop 20
												 */
												do_action( 'tvlgiao_wpdance_button_shop_loop' );			
											?>
										</div>
									<?php endif ?>
								</div>
							</li>
						<?php woocommerce_product_loop_end(); ?>				
					<?php endwhile; //End While ?>
				</div>
			</div>
		<?php endif; // Have Product?>	
		<?php
		$content = ob_get_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_products_single_detail', 'tvlgiao_wpdance_products_single_detail_function');
?>