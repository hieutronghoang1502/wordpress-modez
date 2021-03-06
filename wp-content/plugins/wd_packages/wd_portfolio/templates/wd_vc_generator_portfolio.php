<?php
# Visual Composer installed?
if ( function_exists( 'visual_composer' ) && ! function_exists( 'wd_portfolio_vc_shortcodes' ) ) {
	/**
	 * Add theme's custom shortcodes to Visual Composer
	 */
	function wd_portfolio_vc_shortcodes() {
		vc_map( array(
			'name'        => __( 'WD - Portfolio Grid', 'wpdance' ),
			'base'        => 'tvlgiao_wpdance_portfolio_gird',
			'description' => __( 'Special Grid portfolio', 'wpdance' ),
			'category'    =>esc_html__("WPDance Shortcode", 'wpdance'),
			'icon'        => 'vc_icon-vc-media-grid',
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Categories', 'wpdance' ),
					'description' => __( 'Select the category. If you want get category by ID', 'wpdance' ),
					'param_name'  => 'id_category',
					'admin_label' => true,
					'value'       => WD_Portfolio::wd_portfolio_list_categories(),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Number Of portfolio', 'wpdance' ),
					'param_name'  => 'number_blogs',
					'admin_label' => true,
					'value'       => '12',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Style', 'wpdance' ),
					'param_name'  => 'style',
					'admin_label' => true,
					'value'       => array(
						__( 'Style 1', 'wpdance' ) => 'portfolio-style-1',
						__( 'Style 2', 'wpdance' ) => 'portfolio-style-2',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Image Size', 'wpdance' ),
					'param_name'  => 'image_size',
					'admin_label' => true,
					'value'       => array(
						'Full' 			  => 'full',
						'Portfolio Image' => 'portfolio_image',
					),
					'std'		  => 'full',
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort By', 'wpdance' ),
					'param_name'  => 'sort',
					'admin_label' => true,
					'value'       => array(
						__( 'Date', 'wpdance' ) => 'date',
						__( 'Name', 'wpdance' ) => 'name',
						__( 'Slug', 'wpdance' ) => 'slug',
					),
					'std'		  => 'date',
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Order By', 'wpdance' ),
					'param_name'  => 'order_by',
					'admin_label' => true,
					'value'       => array(
						'DESC' => 'DESC',
						'ASC'  => 'ASC',
					),
					'std'		  => 'DESC',
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Columns', 'wpdance' ),
					'param_name'  => 'columns',
					'admin_label' => true,
					'value'       => array(
						__( '1 Columns', 'wpdance' ) => '1',
						__( '2 Columns', 'wpdance' ) => '2',
						__( '3 Columns', 'wpdance' ) => '3',
						__( '4 Columns', 'wpdance' ) => '4',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Gap', 'wpdance' ),
					'param_name'  => 'gap',
					'description' => __( 'Select gap between grid elements', 'wpdance' ),
					'admin_label' => true,
					'value'       => array(
						'0 px'  => '0px',
						'1 px'  => '1px',
						'2 px'  => '2px',
						'3 px'  => '3px',
						'4 px'  => '4px',
						'5 px'  => '5px',
						'10 px' => '10px',
						'15 px' => '15px',
						'20 px' => '20px',
						'25 px' => '25px',
						'30 px' => '30px',
						'35 px' => '35px',
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Number of excerpt words', 'wpdance' ),
					'param_name'  => 'excerpt_words',
					'admin_label' => true,
					'value'       => '20',
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Show Pagination Or Load More', 'wpdance' ),
					'param_name'  => 'pagination_loadmore',
					'admin_label' => true,
					'value'       => array(
						__( 'Pagination', 'wpdance' ) => '1',
						__( 'Load More', 'wpdance' )  => '0',
						__( 'No Show', 'wpdance' )    => '2',
					),
					'description' => '',
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number blogs Load More', 'wpdance' ),
					'admin_label' => true,
					'param_name'  => 'number_loadmore',
					'value'       => '8',
					'description' => '',
					'dependency'  => Array( 'element' => 'pagination_loadmore', 'value' => array( '0' ) ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra class name', 'woocommerce' ),
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'woocommerce' ),
					'admin_label' => true,
					'param_name'  => 'class',
					'value'       => '',
				),
			),
		) );

		vc_map( array(
			'name'        => __( 'WD - Portfolio Masonry', 'wpdance' ),
			'base'        => 'tvlgiao_wpdance_portfolio_masonry',
			'description' => __( 'Style masonry of portfolio', 'wpdance' ),
			'category'    => esc_html__("WPDance Shortcode", 'wpdance'),
			'icon'        => 'vc_icon-vc-masonry-grid',
			'params'      => array(
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Categories', 'wpdance' ),
					'description' => __( 'Select the category. If you want get category by ID', 'wpdance' ),
					'param_name'  => 'id_category',
					'admin_label' => true,
					'value'       => WD_Portfolio::wd_portfolio_list_categories(),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Style', 'wpdance' ),
					'param_name'  => 'style',
					'admin_label' => true,
					'value'       => array(
						__( 'Style 1', 'wpdance' ) => 'portfolio-style-1',
						__( 'Style 2', 'wpdance' ) => 'portfolio-style-2',
					),
					'description' => '',
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number Portfolio', 'wpdance' ),
					'description' => __( 'number', 'wpdance' ),
					'admin_label' => true,
					'param_name'  => 'number',
					'value'       => '6',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Sort By', 'wpdance' ),
					'param_name'  => 'sort',
					'admin_label' => true,
					'value'       => array(
						__( 'Date', 'wpdance' ) => 'date',
						__( 'Name', 'wpdance' ) => 'name',
						__( 'Slug', 'wpdance' ) => 'slug',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Order By', 'wpdance' ),
					'param_name'  => 'order_by',
					'admin_label' => true,
					'value'       => array(
						'DESC' => 'DESC',
						'ASC'  => 'ASC',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Layout Mode', 'wpdance' ),
					'param_name'  => 'layout_mode',
					'admin_label' => true,
					'value'       => array(
						__( 'Masonry', 'wpdance' ) => 'masonry',
						__( 'Packery', 'wpdance' ) => 'packery',
					),
					'description' => '',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Random Width Image', 'wpdance' ),
					'param_name'  => 'random_width',
					'admin_label' => true,
					'value'       => array(
						__( 'Yes', 'wpdance' ) => '1',
						__( 'No', 'wpdance' )  => '0',
					),
					'description' => '',
					'dependency'  => Array( 'element' => 'layout_mode', 'value' => array( 'packery' ) ),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Columns', 'wpdance' ),
					'param_name'  => 'columns',
					'admin_label' => true,
					'value'       => array(
						__( '1 Columns', 'wpdance' ) => '1',
						__( '2 Columns', 'wpdance' ) => '2',
						__( '3 Columns', 'wpdance' ) => '3',
						__( '4 Columns', 'wpdance' ) => '4',
						__( '6 Columns', 'wpdance' ) => '6',
					),
					'description' => '',
					'dependency'  => Array(
						'element' => 'layout_mode',
						'value'   => array( 'masonry' ),
					),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Gap', 'wpdance' ),
					'param_name'  => 'gap',
					'description' => __( 'Select gap between grid elements', 'wpdance' ),
					'admin_label' => true,
					'value'       => array(
						'0 px'  => '0px',
						'1 px'  => '1px',
						'2 px'  => '2px',
						'3 px'  => '3px',
						'4 px'  => '4px',
						'5 px'  => '5px',
						'10 px' => '10px',
						'15 px' => '15px',
						'20 px' => '20px',
						'25 px' => '25px',
						'30 px' => '30px',
						'35 px' => '35px',
					),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Show Pagination Or Load More', 'wpdance' ),
					'param_name'  => 'pagination_loadmore',
					'admin_label' => true,
					'value'       => array(
						__( 'Load More', 'wpdance' )  => '0',
						__( 'Pagination', 'wpdance' ) => '1',
						__( 'No Show', 'wpdance' )    => '2',
					),
					'description' => '',
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number Post Load More', 'wpdance' ),
					'admin_label' => true,
					'param_name'  => 'number_loadmore',
					'value'       => '6',
					'description' => '',
					'dependency'  => Array( 'element' => 'pagination_loadmore', 'value' => array( '0' ) ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Extra class name', 'wpdance' ),
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wpdance' ),
					'admin_label' => true,
					'param_name'  => 'class',
					'value'       => '',
				),
			),
		) );
	}
}

# add theme's custom shortcodes to Visual Composer
add_action( 'vc_before_init', 'wd_portfolio_vc_shortcodes' );
