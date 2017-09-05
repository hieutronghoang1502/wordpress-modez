<?php
if( class_exists('WooCommerce') ){
	$categories       = tvlgiao_wpdance_vc_get_list_category('product_cat', false, 'sorted_list');
	vc_map( array(
		'name'        => __( "WD - Products List Categories", 'wpdancelaparis' ),
		'description' => __( "Display product categories in a list format.", 'wpdancelaparis' ),
		'base'        => 'tvlgiao_wpdance_product_categories_list',
		"category"    => esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        => 'icon-wpb-woocommerce',
		'params'      => array(
			
			array(
				'type'        	=> 'textfield',
				'class'       	=> '',
				'heading'     	=> __( "Title", 'wpdancelaparis' ),
				'description' 	=> __( "Leave blank to hide title", 'wpdancelaparis' ),
				'admin_label' 	=> true,
				'param_name'  	=> 'title',
				'value'       	=> __( 'Categories', 'wpdancelaparis' ),
			),
			array(
				'type' 			=> 'sorted_list',
				'heading' 		=> __( 'Categories', 'wpdancelaparis' ),
				'param_name' 	=> 'ids_category',
				'description' 	=> __( 'Select and sort product categories. Leave blank if you want to display all product category', 'wpdancelaparis' ),
				'value' 		=> '-1',
				'options' 		=> $categories,
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Text Align', 'wpdancelaparis' ),
				'param_name' 	=> 'text_align',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_text_align_bootstrap(),
				'std'			=> 'text-center',
				'description' 	=> ''
			),
			array(
				'type'        	=> 'dropdown',
				'heading'     	=> __( 'View All', 'wpdancelaparis' ),
				'description' 	=> __( 'Show item "View All" redirects to shop page.', 'wpdancelaparis' ),
				'param_name'  	=> 'view_all',
				'value'       	=> array(
					'Show' 	=> '1',
					'Hide' 	=> '0',
				),
				'save_always' 	=> true,
			),
			array(
				'type'        	=> 'textfield',
				'heading'     	=> __( "Extra class name", 'wpdancelaparis' ),
				'description' 	=> __( "Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis' ),
				'admin_label' 	=> true,
				'param_name'  	=> 'class',
				'value'       	=> '',
			),
		)
	) );
}