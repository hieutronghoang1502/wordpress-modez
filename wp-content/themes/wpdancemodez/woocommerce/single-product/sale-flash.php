<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<div class="wd-sale-featured-flash">
	<?php if ( $product->is_on_sale() ) : ?>
		<?php 
		$content = tvlgiao_wpdance_get_flash_sale_content();
		if ($content) {
			echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html($content) . '</span>', $post, $product ); 
		}
		?>
		<?php 
		/**
		 * tvlgiao_wpdance_flash_featured hook.
		 *
		 * @hooked tvlgiao_wpdance_flash_featured - 5
		 */
	endif; 
	do_action('tvlgiao_wpdance_flash_featured'); ?>
</div>