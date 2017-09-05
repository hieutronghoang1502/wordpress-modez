<?php
/*tvlgiao_wpdance_special_products_slider*/
if( class_exists('WooCommerce') ){
	$product_ids = tvlgiao_wpdance_vc_get_data_by_post_type('product');
	vc_map(array(
			"name"				=> esc_html__("WD - Products Single Detail",'wpdancelaparis'),
			"base"				=> 'tvlgiao_wpdance_products_single_detail',
			'description' 		=> esc_html__("Display single product with custom content...", 'wpdancelaparis'),
			"category"			=> esc_html__("WPDance Shortcode",'wpdancelaparis'),
			'icon'        		=> 'icon-wpb-woocommerce',
			"params"=>array(
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Product ID', 'wpdancelaparis' ),
					'param_name' 	=> 'product_id',
					'admin_label' 	=> true,
					'value' 		=> $product_ids,
					'description' 	=> ''
				), 
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Thumbnail', 'wpdancelaparis' ),
					'param_name' 	=> 'thumbnail',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Image size', 'wpdancelaparis' ),
					'param_name' 	=> 'image_size',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_vc_get_list_image_size(),
					'description' 	=> '',
					'std'			=> 'shop_catalog',
					'dependency'  	=> Array('element' => "thumbnail", 'value' => array('1'))
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Layout Style', 'wpdancelaparis' ),
					'param_name' 	=> 'layout_style',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Sync With Product In Shop'		=> '1',
							'Build Custom Layout'			=> '2'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Title', 'wpdancelaparis' ),
					'param_name' 	=> 'title',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Add To Cart', 'wpdancelaparis' ),
					'param_name' 	=> 'add_to_cart',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Description', 'wpdancelaparis' ),
					'param_name' 	=> 'description',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Price', 'wpdancelaparis' ),
					'param_name' 	=> 'price',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__("Extra class name", 'wpdancelaparis'),
					'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis'),
					'admin_label' 	=> true,
					'param_name' 	=> 'class',
					'value' 		=> ''
				)
			)
		)
	);
}
?>