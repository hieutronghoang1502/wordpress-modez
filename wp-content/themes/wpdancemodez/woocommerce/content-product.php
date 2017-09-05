<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

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

		<div class="wd-wish-zoom-compare-button">
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
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
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
					
				</div>	
			<?php endif; ?>	
				
		</div>
	</div>
</li>
