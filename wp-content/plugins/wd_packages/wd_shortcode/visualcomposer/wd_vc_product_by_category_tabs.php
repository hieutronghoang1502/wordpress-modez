<?php
if( class_exists('WooCommerce') ){
	$categories       = tvlgiao_wpdance_vc_get_list_category('product_cat', false, 'sorted_list');

	vc_map( array(
		'name'        => __( "WD - Products by Category Tabs", 'wpdancelaparis' ),
		'description' => __( "Products by Category Tabs", 'wpdancelaparis' ),
		'base'        => 'tvlgiao_wpdance_products_by_category_tabs',
		"category"    => esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        => 'icon-wpb-woocommerce',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Select Type', 'wpdancelaparis' ),
				'param_name'  => 'type',
				'admin_label' => true,
				'value'       => array(
					__( 'Special Product', 'wpdancelaparis' )       => 'special',
					__( 'Single Category', 'wpdancelaparis' ) 		=> 'single_category',
					__( 'Categories', 'wpdancelaparis' )      		=> 'categories',
				),
				'description' => __( 'Select Type and customize attributes in tab Category Settings', 'wpdancelaparis' ),
			),
			/*-----------------------------------------------------------------------------------
			    Event
			-------------------------------------------------------------------------------------*/
			// Select a Category
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Category', 'wpdancelaparis' ),
				'description' => __( 'Product category list', 'wpdancelaparis' ),
				'param_name'  => 'id_event',
				'admin_label' => true,
				'value'       => $categories,
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'special' ),
				),
				'group'       => __( 'Category Settings', 'wpdancelaparis' ),
			),
			// Show Event
			array(
				'type'       => 'checkbox',
				'heading'    => __( 'Show Event', 'wpdancelaparis' ),
				'param_name' => 'show_event',
				'value'      => array(
					__( 'Bestselling', 'wpdancelaparis' )  => 'bestselling',
					__( 'Featured', 'wpdancelaparis' )     => 'featured',
					__( 'New Arrivals', 'wpdancelaparis' ) => 'new_arrivals',
					__( 'Top Reviewed', 'wpdancelaparis' ) => 'top_reviewed',
				),
				'std'        => 'bestselling',
				'dependency' => array(
					'element' => 'type',
					'value'   => array( 'special' ),
				),
				'group'       => __( 'Category Settings', 'wpdancelaparis' ),
			),
			/*-----------------------------------------------------------------------------------
				Single Category
			-------------------------------------------------------------------------------------*/
			// Select a Category
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Category', 'wpdancelaparis' ),
				'description' => __( 'Select a category', 'wpdancelaparis' ),
				'param_name'  => 'id_single',
				'admin_label' => true,
				'value'       => $categories,
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'single_category' ),
				),
				'group'       => __( 'Category Settings', 'wpdancelaparis' ),
			),
			/*-----------------------------------------------------------------------------------
				Categories
			-------------------------------------------------------------------------------------*/
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => __( "Title", 'wpdancelaparis' ),
				'description' => __( "Leave blank to hide title", 'wpdancelaparis' ),
				'admin_label' => true,
				'param_name'  => 'title',
				'value'       => __( 'Categories', 'wpdancelaparis' ),
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'categories' ),
				),
				'group'       => __( 'Category Settings', 'wpdancelaparis' ),
			),
			array(
				'type' 			=> 'sorted_list',
				'heading' 		=> __( 'Categories', 'wpdancelaparis' ),
				'param_name' 	=> 'ids',
				'description' 	=> __( 'Select and sort product categories. Leave blank if you want to display all product category', 'wpdancelaparis' ),
				'value' 		=> '-1',
				'options' 		=> $categories,
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Style Tabs', 'wpdancelaparis' ),
				'description' => __( 'Style of product categories tabs', 'wpdancelaparis' ),
				'param_name'  => 'style_tab',
				'value'       => array(
					'Tabs Menu On Top Content' 	=> 'tab-on-top-content',
					'Tabs Menu On Left Content' => 'tab-on-left-content',
				),
				'save_always' => true,
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'categories' ),
				),
				'group'       => __( 'Category Settings', 'wpdancelaparis' ),
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'View All Products Tab', 'wpdancelaparis' ),
				'description' => __( 'Enable this option to display the "View All Products" tab redirecting to the shop page.', 'wpdancelaparis' ),
				'param_name'  => 'view_all_tab',
				'value'       => array(
					'Show' 	=> '1',
					'Hide' 	=> '0',
				),
				'save_always' => true,
				'dependency'  => array(
					'element' => 'type',
					'value'   => array( 'categories' ),
				),
				'group'       => __( 'Category Settings', 'wpdancelaparis' ),
			),
			/*-----------------------------------------------------------------------------------
				Global
			-------------------------------------------------------------------------------------*/
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Columns', 'wpdancelaparis' ),
				'param_name' 	=> 'columns',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_tvgiao_columns(),
				'std' 			=> 4,
				'save_always' 	=> true,
				'description' 	=> esc_html__( '', 'wpdancelaparis' )
			),
			array(
				'type'        => 'textfield',
				'class'       => '',
				'heading'     => __( "Posts Per Page", 'wpdancelaparis' ),
				'description' => __( "Number products on one tab...", 'wpdancelaparis' ),
				'admin_label' => true,
				'param_name'  => 'posts_per_page',
				'value'       => 8,
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
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Is Slider", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "is_slider",
				"value" => array(
						'No' 		=> '0',
						'Yes' 		=> '1',
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Category Thumbnail", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_category_thumb",
				"value" => array(
					'No' 		=> '0',
					'Yes' 		=> '1',
				),
				"description" 	=> "",
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('0'))
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Nav", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_nav",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Auto Play", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "auto_play",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Rows Of Slider", 'wpdancelaparis'),
				'description' 	=> esc_html__("Number Rows Of Slider", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'per_slide',
				'value' 		=> '1',
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
			),

			array(
				'type'        => 'textfield',
				'heading'     => __( "Extra class name", 'wpdancelaparis' ),
				'description' => __( "Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis' ),
				'admin_label' => true,
				'param_name'  => 'class',
				'value'       => '',
			),
		)
	) );
}