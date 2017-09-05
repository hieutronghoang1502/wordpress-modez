<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
 * @version     3.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );
	comments_open( get_the_id() ); 

	if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	}
	$post_ID				= tvlgiao_wpdance_get_post_by_global();
	$_product_config 		= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_product_config' , true);
	$_product_config 		= unserialize($_product_config);

	//Customize Config
	extract(tvlgiao_wpdance_get_custom_data_special_template( 'single-product' )); 

	$layout 				= ($_product_config['layout'] != '0') ? $_product_config['layout'] : $layout;
?>

<div itemscope itemtype="" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if($full_width_detail && $layout == '0-0-0'){ ?>
		<div class="wd-full-width-single-product">
	<?php } ?>
	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10 - removed
		 * @hooked woocommerce_show_product_images - 20 
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<div class="wd-description-single-pro">
		<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked tvlgiao_wpdance_template_single_review - 12
			 * @hooked woocommerce_template_single_price - 14
			 * @hooked tvlgiao_wpdance_template_single_availability 16
			 * @hooked tvlgiao_wpdance_template_single_sku - 18
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' ); 
		?>
		</div>
		<?php if($content_after_summary != '' ): ?> 
			<?php $content_after_summary = stripslashes($content_after_summary); ?>
			<div class="wd-single-product-summary-custom-content">
				<?php echo do_shortcode( "{$content_after_summary}" ); 	?>
			</div>
		<?php endif; ?>
	</div><!-- .summary -->

	

	
	<?php if($full_width_detail && $layout == '0-0-0'){ ?>
		</div>
	<div class="container">
		<div class="row">
	<?php } ?>
		<div class="clearfix"></div>

	<div class="tab_info">
		  <!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#DESCRIPTION" aria-controls="DESCRIPTION" role="tab" data-toggle="tab">DESCRIPTION</a></li>
		    <li role="presentation"><a href="#REVIEW" aria-controls="REVIEW" role="tab" data-toggle="tab">CUSTOMER REVIEW</a></li>
		    <li role="presentation"><a href="#DELIVERY" aria-controls="DELIVERY" role="tab" data-toggle="tab">DELIVERY</a></li>
		    <li role="presentation"><a href="#WARRANTY" aria-controls="WARRANTY" role="tab" data-toggle="tab">WARRANTY</a></li>
		    <li role="presentation"><a href="#PAYMENT" aria-controls="PAYMENT" role="tab" data-toggle="tab">PAYMENT</a></li>
  		</ul>
		

		 <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="DESCRIPTION"><?php do_action('tab-desc'); ?></div>
		    <div role="tabpanel" class="tab-pane" id="REVIEW">
		    	<div class="row">
				<?php			
    				do_action( 'woocommerce_after_single_product' ); 
				?>	
				<div class="display-form col-sm-12">Write review</div>
				</div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="DELIVERY">
		    	PURCHASING & DELIVERY

BEFORE YOU BUY

To avoid delivery day disappointments, measure the area you plan to place your new furniture in, as well as the furniture you have selected to purchase, before placing your order. Also measure any doorways (height and width) through which the furniture must pass to get to its final position in your home. Identify any delivery obstacles – is there enough ceiling clearance? Will the furniture clear the stairway or elevator? Can the piece be maneuvered around any right angles? Because of our commitment to providing you with outstanding customer service.

DELIVERY

Always free shipping

		    </div>
		    <div role="tabpanel" class="tab-pane" id="WARRANTY">
		    	WARRANTY INFORMATION

LIMITED WARRANTIES
Limited Warranties are non-transferable. The following Limited Warranties are given to the original retail purchaser of the following Ashley Furniture Industries, Inc.Products:

Frames Used In Upholstered and Leather Products
Limited Lifetime Warranty
A Limited Lifetime Warranty applies to all frames used in sofas, couches, love seats, upholstered chairs, ottomans, sectionals, and sleepers. Ashley Furniture Industries,Inc. warrants these components to you, the original retail purchaser, to be free from material manufacturing defects.
		    </div>
		    <div role="tabpanel" class="tab-pane" id="PAYMENT">
		    	PAYMENT INFORMATION

Dust or wipe clean with a cloth dampened with water once a week. Be sure not to leave water spots on the surface. These water spots will dry and could possibly leave permanent marks.

Clean stains/spots using the following steps: Dampen a soft cloth with a mixture of hot water and liquid dishwashing detergent. Wring the cloth as much as possible to remove excess liquid. Rub the surface lightly in a circular motion. Dry the surface immediately with a clean, soft towel.


		    </div>
		  </div>
	  		
	</div>

		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_output_related_products - 20
			 * @hooked woocommerce_upsell_display - 25
			 */
			


			do_action( 'woocommerce_after_single_product_summary' );
		?>


	<?php if($full_width_detail && $layout == '0-0-0'){ ?>	
		</div>
	</div>

	<?php } ?>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->


