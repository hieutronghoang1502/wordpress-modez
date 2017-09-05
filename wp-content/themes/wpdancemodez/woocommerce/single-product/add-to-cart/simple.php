<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$post_id = tvlgiao_wpdance_get_post_by_global();

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	$catalog_mod 	= tvlgiao_wpdance_get_custom_data_by_keyname( 'tvlgiao_wpdance_genneral_catalog_mode', 'tvlgiao_wpdance_layout_product_config_catalog_mode', '0');
	
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
	
?>

<?php if ( $product->is_in_stock() ) : ?>

	<div class="wd_group_button_single_product">
		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
		
		<form class="variations_form cart" method="post" enctype='multipart/form-data'>
		 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		 	
		 	<div class="variations_button <?php if(!$catalog_mod) echo esc_attr("hidden"); ?>">
		 		<div class="label_quantity"><span><?php esc_html_e("QUANTITY: ",'wpdancelaparis'); ?></span></div>
			 	<?php
			 		if ( ! $product->is_sold_individually() ) {
			 			woocommerce_quantity_input( array(
			 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
			 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
			 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
			 			) );
			 		}
			 	?> 
		 	</div>
		
		 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
		
			<div class="button_single_product_wpdance">
				<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
			</div>
		</form>
		
		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
	</div>

<?php endif; ?>
