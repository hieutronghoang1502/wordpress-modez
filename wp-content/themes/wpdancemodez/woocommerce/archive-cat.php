<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php
	/*CUSTOM DEFAULT*/
	extract(tvlgiao_wpdance_get_custom_data_special_template( 'archive-cat' )); 
	
	
?>
<div id="main-content" class="main-content">
	<div class="row">
		<div class="col-sm-5 product-by-cat-sideleft">
			<div class="sideleft_categories">
				<h3><i>Categories</i></h3>
				<hr width="100%" size="3px" >
				<?php echo do_shortcode('[category_menu]' ); ?>
			</div>
			<div class="sideleft_filter">
				<h3><i>Filter</i></h3>
				<hr width="100%" size="3px" >
			</div>
			<div class="sideleft_toprated_product">
				<h3><i>Top Rated Products</i></h3>
				<hr width="100%" size="3px" >
				<?php echo do_shortcode('[top_rated_products per_page="3"]' ); ?>
			</div>



		</div>
		<div class="col-sm-12 product-by-cat-content">
		<?php 	do_action( 'woocommerce_before_shop_loop' ); ?>
			<div class="row">
				<?php if(have_posts()): while(have_posts()):the_post(); ?>
				<div class="col-sm-8 product-brief">
					<?php wc_get_template_part( 'content', 'product_brief' ); ?>
				</div>
			<?php endwhile;endif; ?>
			
			</div>
		</div>
	</div>
</div><!-- END CONTAINER  -->


<?php get_footer( 'shop' ); ?>

