<?php
/**
 * @package 
 * @subpackage 
 * @since 
 */
	
/*
/*	Woocommerce Hook Config
*/

add_action('after_setup_theme','tvlgiao_wpdance_woo_hook_action', 250);
add_action( 'after_setup_theme','tvlgiao_wpdance_archive_number_perpage', 200);
if(!function_exists ('tvlgiao_wpdance_woo_hook_action')){
	function tvlgiao_wpdance_woo_hook_action(){
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'woo_hook' ));

		add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
		/******************************** WOO BREADCRUMB ***********************************/
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		
		/******************************** SHOP LOOP ***********************************/
		remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10); //remove add to cart button
		remove_action('woocommerce_after_shop_loop_item_title','add_star_rating',5);	
		remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);

		add_action('tvlgiao_wpdance_button_add_to_cart','woocommerce_template_loop_add_to_cart',5); //add add to cart button
		add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',5);
		add_action('woocommerce_after_shop_loop_item_title','add_star_rating',10);
		add_action('tvlgiao_wpdance_after_shop_loop_price','tvlgiao_wpdance_shop_loop_product_attribute_color',5); //add attribute color
		add_action('woocommerce_after_shop_loop_item','tvlgiao_wpdance_short_description_product', 15);

		if(!$show_title){
	    	remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
	    }
	    if(!$show_description){
	    	//remove_action( 'woocommerce_after_shop_loop_item', 'tvlgiao_wpdance_short_description_product', 15 );
	    }
	    if(!$show_rating){
	    	remove_action('woocommerce_after_shop_loop_item_title','add_star_rating',10);
	    }
	    if(!$show_price){
	    	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',5);
	    	remove_action('tvlgiao_wpdance_after_shop_loop_price','tvlgiao_wpdance_shop_loop_product_attribute_color',5); //remove attribute color
	    }
	    if(!$show_meta){
	    	remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
	    }
	    /* Hook: tvlgiao_wpdance_shop_loop_custom_image_size (shop loop with custom image size) */
		add_action('tvlgiao_wpdance_sale_featured_flash','woocommerce_show_product_loop_sale_flash', 5 );
	    add_action('tvlgiao_wpdance_flash_featured','tvlgiao_wpdance_flash_featured',5); //add feature flash after sale flash

		/******************************** SHOP / ARCHIVE ***********************************/
		add_action('woocommerce_archive_description', 'tvlgiao_wpdance_woocommerce_category_image', 2 );

		/******************************** SINGLE PRODUCT ***********************************/
		/* Hook: woocommerce_before_single_product_summary */
		remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10); //remove sale flash default

		/* Hook: tvlgiao_after_product_thumbnails */
		add_action('tvlgiao_after_product_thumbnails', 'woocommerce_show_product_sale_flash', 5); //remove sale & feature flash
		add_action('tvlgiao_after_product_thumbnails', 'tvlgiao_wpdance_get_product_share', 10); //Share


		/* Hook: woocommerce_single_product_summary */
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30); //remove add to cart
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40 ); //remove default meta (tag, category)

		//Reorder the product summary layout
		$product_summary_layout_reorder = wd_get_data_theme_option('tvlgiao_wpdance_layout_single_product_summary_layout');
		$list_action_single_product_summary_default = array( //hook function name => display
			'woocommerce_template_single_price' 			=> '1',
			'tvlgiao_wpdance_template_single_review' 		=> '1',
			'tvlgiao_wpdance_template_single_sku' 			=> '1',
			'tvlgiao_wpdance_template_single_availability' 	=> '1',
			'woocommerce_template_single_add_to_cart' 		=> '1',
			/*'tvlgiao_wpdance_get_product_tags' 			=> '1',*/
			'tvlgiao_wpdance_get_product_categories' 		=> '1',
		);

		//Product tag tab
		add_filter( 'woocommerce_product_tabs', 'tvlgiao_wpdance_single_product_tag_tab' );

		$list_action_single_product_summary = (!empty($product_summary_layout_reorder)) ? $product_summary_layout_reorder : $list_action_single_product_summary_default;
		$i = 5;
		foreach ($list_action_single_product_summary as $action_function => $value) {
			if ($value) {
				add_action('woocommerce_single_product_summary', $action_function, $i);
				$i += 5;
			}
		}

		/* Hook: woocommerce_after_single_product_summary */
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 ); //remove upsell default
		remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20); //remove related default

		add_action( 'woocommerce_after_single_product', 'comments_template', 50 );
		add_action('woocommerce_after_single_product_summary', 'tvlgiao_wpdance_product_facebook_comment_form', 15 ); //facebook comment
		if ($show_recently_product) { //Show/hide recent product
			add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
		}
		if ($show_upsell_product) { //Show/hide upsell product
			add_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 25 );
		}

		/******************************** BUTTON ***********************************/

		add_action('tab_desc','tvlgiao_wpdance_template_single_sku' );
		//Gris/List Toggle
		add_action( 'woocommerce_before_shop_loop', 'tvlgiao_wpdance_grid_list_toggle_button', 50);

		//Compare Button
		if( class_exists( 'YITH_Woocompare_Frontend' ) && class_exists( 'YITH_Woocompare' ) ) {
			global $yith_woocompare;
			$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
			if( $yith_woocompare->is_frontend() || $is_ajax ) {
				if( $is_ajax ){
					$yith_woocompare->obj = new YITH_Woocompare_Frontend();
				}
				add_action( 'tvlgiao_wpdance_button_shop_loop', array( $yith_woocompare->obj, 'add_compare_link' ), 15 ); //shop loop
				add_action( 'woocommerce_after_add_to_cart_button', array( $yith_woocompare->obj, 'add_compare_link' ), 30 ); //single product		
			}

			if (!$compare_default) { //Remove compare button default
				update_option('yith_woocompare_compare_button_in_product_page', 'no'); 
			}	
		}

		//Wishlist Button
		if( class_exists('YITH_WCWL_UI') && class_exists('YITH_WCWL') ){
			add_action( 'tvlgiao_wpdance_button_shop_loop', 'tvlgiao_wpdance_wishlist_button_shop_loop', 20 );
			add_action( 'woocommerce_after_add_to_cart_button' , 'tvlgiao_wpdance_wishlist_button_shop_loop', 50 );
			if (!$wishlist_default) { //Remove wishlist button default
				update_option( 'yith_wcwl_button_position', 'shortcode' );
			}	
		}
		
	    if(!$catalog_mod){ //Product config
	        remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',60);
			remove_action('tvlgiao_wpdance_button_shop_loop','woocommerce_template_loop_add_to_cart',10);
			if( class_exists( 'WD_Quickshop' ) ) {
				//Remove add to cart button on Quickshop view
				remove_action( 'wd_quickshop_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			}
	    }
	}
}
?>