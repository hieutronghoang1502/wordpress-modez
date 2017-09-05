<?php
if( class_exists('WooCommerce') ){
	$product_category = tvlgiao_wpdance_vc_get_list_category();
	vc_map(array(
			"name"				=> esc_html__("WD - Product Grid/List",'wpdancelaparis'),
			"base"				=> 'tvlgiao_wpdance_special_gird_list_product',
			'description' 		=> esc_html__("Special Gird/List Product", 'wpdancelaparis'),
			"category"			=> esc_html__("WPDance Shortcode",'wpdancelaparis'),
			'icon'        		=> 'icon-wpb-woocommerce',
			"params"			=>array(	
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Select Category', 'wpdancelaparis' ),
					'param_name' 	=> 'id_category',
					'admin_label' 	=> true,
					'value' 		=> $product_category,
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Data Show', 'wpdancelaparis' ),
					'param_name' 	=> 'data_show',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Recent Product'		=> 'recent_product',
							'Most View Product'		=> 'mostview_product',
							'On Sale Product'		=> 'onsale_product',
							'Featured Product'		=> 'featured_product'
						),
					'description' 	=> esc_html__( '', 'wpdancelaparis' )
				),
				array(
					'type'			=> 'textfield',
					'heading' 		=> esc_html__( 'Number of products', 'wpdancelaparis' ),
					'param_name' 	=> 'number_products',
					'admin_label' 	=> true,
					'value' 		=> '12'
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Sort By', 'wpdancelaparis' ),
					'param_name' 	=> 'sort',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_get_sort_by_values(),
					'std'			=> 'DESC',
					'description' 	=> esc_html__( '', 'wpdancelaparis' )
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Order By', 'wpdancelaparis' ),
					'param_name' 	=> 'order_by',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_get_order_by_values('product'),
					'std'			=> 'date',
					'description' 	=> esc_html__( '', 'wpdancelaparis' )
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Columns', 'wpdancelaparis' ),
					'param_name' 	=> 'columns',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_vc_get_list_tvgiao_columns(),
					'description' 	=> esc_html__( '', 'wpdancelaparis' )
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Allows To Switch Mode Grid/List', 'wpdancelaparis' ),
					'param_name' 	=> 'allow_switch_mode',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' 	=> esc_html__( 'If you select Yes, the product layout will be changed by the grid/list mode in the shop.', 'wpdancelaparis' )
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Grid/List', 'wpdancelaparis' ),
					'param_name' 	=> 'grid_list',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Grid Only'		=> 'grid',
							'List Only'		=> 'list'
						),
					'description' => esc_html__( '', 'wpdancelaparis' ),
					'dependency'  	=> Array('element' => "allow_switch_mode", 'value' => array('0'))
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Grid/List Button', 'wpdancelaparis' ),
					'param_name' 	=> 'grid_list_button',
					'admin_label' 	=> true,
					'value' => array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' 	=> '',
					'dependency'  	=> Array('element' => "allow_switch_mode", 'value' => array('1'))
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Filter Product', 'wpdancelaparis' ),
					'param_name' 	=> 'filter_product',
					'admin_label' 	=> true,
					'value' => array(
							'Yes'		=> '1',
							'No'		=> '0'
						),
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Pagination Or Load More', 'wpdancelaparis' ),
					'param_name' 	=> 'pagination_loadmore',
					'admin_label' 	=> true,
					'value' 	=> array(
							'Pagination'	=> '1',
							'Load More'	=> '0',
							'No Show'		=> '2'
						),
					'description' 	=> ''
				),
				array(
					"type" 			=> "textfield",
					"class" 		=> "",
					"heading" 		=> esc_html__("Number Products Load More", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "number_loadmore",
					"value" 		=> '8',
					"description" 	=> "",
					'dependency'  	=> Array('element' => "pagination_loadmore", 'value' => array('0'))
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