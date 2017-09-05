<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      https://docs.woocommerce.com/document/template-structure/
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version     3.1.0
 */
?>
	<div class="thumbnails ">
		<div class="product_thumbnails">
 				<?php

global $post, $product;
 $attachment_ids = $product->get_gallery_image_ids();
 if (has_post_thumbnail()) {
	if( is_array($attachment_ids) ) {
		array_unshift($attachment_ids, get_post_thumbnail_id());
	}else{
		$attachment_ids[] = get_post_thumbnail_id();
	}
}
?>
			<div class="thumbnail-gallery-image">
					<ul class="bxslider">
				<?php
					foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );

					?>
					<li><img src="<?php echo $image_link ?>"></li>
					<?php
				}?>
					</ul>
			</div>

	 
		</div>
	</div><!-- end thumbnail -->





