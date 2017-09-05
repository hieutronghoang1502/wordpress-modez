<?php
/*tvlgiao_wpdance_special_products_slider*/
if( class_exists('WooCommerce') ){
	$product_category = tvlgiao_wpdance_vc_get_list_category();
	vc_map(array(
			"name"				=> esc_html__("WD - Products Special Slider", 'wpdancelaparis'),
			"base"				=> 'tvlgiao_wpdance_special_products_slider',
			'description' 		=> esc_html__("Custom product thumbnail size...", 'wpdancelaparis'),
			"category"			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
			'icon'       	 	=> 'icon-wpb-woocommerce',
			"params"			=>array(
				/*-----------------------------------------------------------------------------------
					Title & DESC
				-------------------------------------------------------------------------------------*/
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__("Title", 'wpdancelaparis'),
					'description'	=> esc_html__("", 'wpdancelaparis'),
					'admin_label' 	=> true,
					'param_name' 	=> 'title',
					'value' 		=> ''
				),
				array(
					'type' 			=> 'textarea',
					'class' 		=> '',
					'heading' 		=> esc_html__("Description", 'wpdancelaparis'),
					'description'	=> esc_html__("", 'wpdancelaparis'),
					'admin_label' 	=> true,
					'param_name' 	=> 'description',
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Text Align', 'wpdancelaparis' ),
					'param_name' 	=> 'text_align',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_vc_get_list_text_align_bootstrap(),
					'std'			=> 'text-center',
					'description' 	=> esc_html__('Title & Desc Align', 'wpdancelaparis'),
				),
				array(
					'type'        	=> 'dropdown',
					'heading'     	=> __( 'Display View All Button', 'wpdancelaparis' ),
					'description' 	=> __( '', 'wpdancelaparis' ),
					'param_name'  	=> 'view_all_link_display',
					'value'       	=> array(
						'Yes' 	=> '1',
						'No' 	=> '0',
					),
					'std'			=> '0',	
					'save_always' 	=> true,
				),
				array(
					"type" 			=> "textfield",
					"class" 		=> "",
					"heading" 		=> __( "View All Text", 'wpdancelaparis' ),
					"param_name" 	=> "view_all_text",
					"value" 		=> 'View All', 
					"description" 	=> __( "", 'wpdancelaparis' ),
					'dependency'  	=> Array('element' => "view_all_link_display", 'value' => array('1'))
				),
				array(
					"type" 			=> "textfield",
					"class" 		=> "",
					"heading" 		=> __( "View All URL", 'wpdancelaparis' ),
					"param_name" 	=> "view_all_url",
					"value" 		=> '#', 
					"description" 	=> __( "", 'wpdancelaparis' ),
					'dependency'  	=> Array('element' => "view_all_link_display", 'value' => array('1'))
				),
				/*-----------------------------------------------------------------------------------
					SETTING
				-------------------------------------------------------------------------------------*/
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
					'description' 	=> ''
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
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Order By', 'wpdancelaparis' ),
					'param_name' 	=> 'order_by',
					'admin_label' 	=> true ,
					'value' 		=> tvlgiao_wpdance_get_order_by_values('product'),
					'std'			=> 'date',
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Product Style', 'wpdancelaparis' ),
					'param_name' 	=> 'product_style',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Grid'					=> 'grid',
							'List'					=> 'list',
							'Image Thumb Only'		=> 'image_thumb_only'
						),
					'description' 	=> ''
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__("Image Padding", 'wpdancelaparis'),
					'description' 	=> esc_html__("Padding between images. Only fill in whole numbers or real numbers. Example: 2.5 (Unit: pixels)", 'wpdancelaparis'),
					'admin_label' 	=> true,
					'param_name' 	=> 'image_padding',
					'value' 		=> '0',
					'dependency'  	=> Array('element' => "product_style", 'value' => array('image_thumb_only'))
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Thumbnail Size', 'wpdancelaparis' ),
					'param_name' 	=> 'image_size',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_vc_get_list_image_size(),
					'description' 	=> '',
					'std'			=> 'shop_catalog',
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Columns', 'wpdancelaparis' ),
					'param_name' 	=> 'columns',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_vc_get_list_tvgiao_columns(),
					'description' 	=> ''
				),
				/*-----------------------------------------------------------------------------------
					SLIDER SETTING
				-------------------------------------------------------------------------------------*/
				array(
					"type" 			=> "dropdown",
					"class" 		=> "",
					"heading" 		=> esc_html__("Is Slider", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "is_slider",
					"value" 		=> array(
							'Yes' 		=> '1',
							'No' 		=> '0'
						),
					"description" 	=> "",
				),
				array(
					"type" 			=> "dropdown",
					"class" 		=> "",
					"heading" 		=> esc_html__("Slider Type", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "slider_type",
					"value" 		=> tvlgiao_wpdance_vc_get_list_slider_type(),
					"description" 	=> "",
					"std"			=> 'owl',
					"group"			=> esc_html__("Slider Setting", 'wpdancelaparis'),
					'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
				),
				array(
					"type" 			=> "dropdown",
					"class" 		=> "",
					"heading" 		=> esc_html__("Center Mode", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "center_mode",
					"value" 		=> array(
							'Yes' 		=> '1',
							'No' 		=> '0'
						),
					'std'			=> '0',
					"description" 	=> esc_html__("Create highlighter for item at between", 'wpdancelaparis'),
					"group"			=> esc_html__("Slider Setting", 'wpdancelaparis'),
					'dependency'  	=> Array('element' => "slider_type", 'value' => array('slick'))
				),
				array(
					"type" 			=> "dropdown",
					"class" 		=> "",
					"heading" 		=> esc_html__("Show Nav", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "show_nav",
					"value" 		=> array(
							'Yes' 		=> '1',
							'No' 		=> '0'
						),
					"description" 	=> "",
					"group"			=> esc_html__("Slider Setting", 'wpdancelaparis'),
					'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
				),
				array(
					"type" 			=> "dropdown",
					"class" 		=> "",
					"heading" 		=> esc_html__("Auto Play", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "auto_play",
					"value" 		=> array(
							'Yes' 		=> '1',
							'No' 		=> '0'
						),
					"description" 	=> "",
					"group"			=> esc_html__("Slider Setting", 'wpdancelaparis'),
					'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__("Number Rows Of Slider", 'wpdancelaparis'),
					'description' 	=> esc_html__("Number Rows Of Slider", 'wpdancelaparis'),
					'admin_label' 	=> true,
					'param_name' 	=> 'per_slide',
					'value' 		=> '3',
					"group"			=> esc_html__("Slider Setting", 'wpdancelaparis'),
					'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Load More', 'wpdancelaparis' ),
					'param_name' 	=> 'pagination_loadmore',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Hide'	=> '0',
							'Show'	=> '1'
					),
					'description' 	=> '',
					'dependency'  	=> Array('element' => "is_slider", 'value' => array('0'))
				),
				array(
					"type" 			=> "textfield",
					"class" 		=> "",
					"heading" 		=> esc_html__("Number Products Load More", 'wpdancelaparis'),
					"admin_label" 	=> true,
					"param_name" 	=> "number_loadmore",
					"value" 		=> '8',
					"description" 	=> "",
					'dependency'  	=> Array('element' => "pagination_loadmore", 'value' => array('1'))
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