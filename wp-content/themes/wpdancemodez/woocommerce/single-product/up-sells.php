<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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
	exit;
}
if ( $upsells ) : ?>
	<div class="wd-ralated-product">
		<div class="wd-title wd-title-section-style-1">
			<h2 class="wd-title-heading text-center"><?php esc_html_e('YOU MAY ALSO LIKE...','wpdancelaparis'); ?></h2>
		</div>
		<div class="wd-ralated-content row">
			<div class="related products grid">
				<?php $_random_id = 'wd_upsell_product_wrapper_'.rand(); ?>
				<div class="related_wrapper loading" id="<?php echo esc_attr($_random_id); ?>">

					<ul class="products owl-carousel owl-theme owl-loaded grid">
							<?php foreach ( $upsells as $upsell ) : ?>

								<?php
								 	$post_object = get_post( $upsell->get_id() );

									setup_postdata( $GLOBALS['post'] =& $post_object );

									wc_get_template_part( 'content', 'product' ); ?>

							<?php endforeach; ?>
					</ul>

					<div class="related_control">
							<a id="product_related_prev" title="<?php esc_html_e('Previous','wpdancelaparis');?>" class="prev" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i>;</a>
							<a id="product_related_next" title="<?php esc_html_e('Next','wpdancelaparis');?>" class="next" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
			    	</div>
				</div>
				<script type="text/javascript">
					(function($) {
						"use strict";			
						jQuery(document).ready(function() {
							var $_this = jQuery('#<?php echo esc_attr($_random_id); ?>');
							var slide_speed = <?php echo (wp_is_mobile())?200:800; ?>;
							var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
							if( navigator.platform === 'iPod' ){
								slide_speed = 0;
								responsive_refresh_rate = 1000;
							}
							var owl = $_this.find('.products').owlCarousel({
								loop : true
								,nav : false
								,dots : false
								,navSpeed : slide_speed
								,slideBy: 1
								,rtl:jQuery('body').hasClass('rtl')
								,margin:0
								,navRewind: false
								,autoplay: false
								,autoplayTimeout: 5000
								,autoplayHoverPause: false
								,autoplaySpeed: false
								,mouseDrag: true
								,touchDrag: true
								,responsiveBaseElement: $_this
								,responsiveRefreshRate: responsive_refresh_rate
								,responsive:{
									0:{
										items : 1
									},
									361:{
										items : 2
									},
									579:{
										items : 2
									},
									767:{
										items : 3
									},
									1100:{
										items : 4
									}
								}
								,onInitialized: function(){
									$_this.addClass('loaded').removeClass('loading');
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
					})(jQuery);		
				</script>	
			</div>	
		</div> 
	</div>	

<?php endif;

wp_reset_postdata();
