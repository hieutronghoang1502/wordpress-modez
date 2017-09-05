<?php
$categories       = tvlgiao_wpdance_vc_get_list_category('wpdance_faq_categories', false, 'sorted_list');
vc_map( array(
	'name'        => __( "WD - FAQs", 'wpdancelaparis' ),
	'description' => __( "Show Tabs-style FAQs...", 'wpdancelaparis' ),
	'base'        => 'tvlgiao_wpdance_faq',
	"category"    => esc_html__("WPDance Shortcode", 'wpdancelaparis'),
	'icon'        => 'icon-wpb-woocommerce',
	'params'      => array(
		/*-----------------------------------------------------------------------------------
			Categories
		-------------------------------------------------------------------------------------*/
		array(
				'type' 			=> 'sorted_list',
				'heading' 		=> __( 'Categories', 'wpdancelaparis' ),
				'param_name' 	=> 'ids',
				'description' 	=> __( 'Select and sort product categories. Leave blank if you want to display all product category', 'wpdancelaparis' ),
				'value' 		=> '-1',
				'options' 		=> $categories,
			),
		array(
			'type'        => 'textfield',
			'class'       => '',
			'heading'     => __( "Posts Per Page", 'wpdancelaparis' ),
			'description' => __( "Set -1 to display all faqs", 'wpdancelaparis' ),
			'admin_label' => true,
			'param_name'  => 'posts_per_page',
			'value'       => -1,
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
			'value' 		=> tvlgiao_wpdance_get_order_by_values(),
			'std'			=> 'date',
			'description' 	=> ''
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