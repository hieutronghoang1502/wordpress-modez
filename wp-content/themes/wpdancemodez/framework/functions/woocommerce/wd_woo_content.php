<?php 
//Display Product with custom image size
if(!function_exists ('tvlgiao_wpdance_display_product_by_custom_thumbnail_size')){
	function tvlgiao_wpdance_display_product_by_custom_thumbnail_size($image_size = 'shop_catalog'){ 
		global $product;

		// Ensure visibility
		if ( empty( $product ) || ! $product->is_visible() ) {
			return;
		}
		$classes[] = 'product';
		$classes[] = 'wd-product-mansonry-item';
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'content-product' )); 
		?>
		<li <?php post_class($classes); ?>>
			<div class="wd-content-product <?php echo esc_attr($style_hover_product); ?>">
				<?php
					/**
					 * woocommerce_before_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_open - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item' );
				?>
				<div class="wd-thumbnail-product">
					<?php
						/**
						 * tvlgiao_wpdance_sale_featured_flash hook.
						 *
						 * @hooked woocommerce_show_product_loop_sale_flash - 5
						 */
						do_action( 'tvlgiao_wpdance_sale_featured_flash' );
						//Display thumbnail
						echo woocommerce_get_product_thumbnail( $image_size );
					?>
				</div>
				<div class="wd-content-detail">
					<?php if( $button_group_position == 'before-content' && $catalog_mod) : ?>
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
					<?php endif; ?>	
					<?php
						/**
						 * woocommerce_before_shop_loop_item hook.
						 *
						 * @hooked woocommerce_template_loop_product_link_open - 10
						 */
						do_action( 'woocommerce_before_shop_loop_item' );
					?>
					<?php
						/**
						 * woocommerce_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_product_title - 10
						 */
						do_action( 'woocommerce_shop_loop_item_title' );

						/**
						 * woocommerce_after_shop_loop_item_title hook.
						 *
						 * @hooked woocommerce_template_loop_price - 5
						 * @hooked woocommerce_template_loop_rating - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					<?php
						/**
						 * woocommerce_after_shop_loop_item hook.
						 *
						 * @hooked woocommerce_template_loop_product_link_close - 5
						 * @hooked tvlgiao_wpdance_short_description_product 15
						 */
						do_action( 'woocommerce_after_shop_loop_item' );
					?>
				
					<?php if( $button_group_position == 'after-content' && $catalog_mod) : ?>
						<div class="wd-button-shop wd-button-shop-after-content">
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
					<?php endif; ?>	
				</div>
			</div>
		</li>
	<?php
	}
} ?>