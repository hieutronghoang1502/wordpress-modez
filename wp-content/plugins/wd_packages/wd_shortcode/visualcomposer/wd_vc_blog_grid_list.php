<?php
	$blog_category = tvlgiao_wpdance_vc_get_list_category('category');
	vc_map(array(
			"name"				=> esc_html__("WD - Blog Grid/List",'wpdancelaparis'),
			"base"				=> 'tvlgiao_wpdance_special_gird_list_blog',
			'description' 		=> esc_html__("Special Gird/List Blog", 'wpdancelaparis'),
			"category"			=> esc_html__("WPDance Shortcode",'wpdancelaparis'),
			'icon'        		=> 'icon-wpb-toggle-small-expand',
			"params"=>array(	
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Select Category', 'wpdancelaparis' ),
					'param_name' 	=> 'id_category',
					'admin_label' 	=> true,
					'value' 		=> $blog_category,
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Data Show', 'wpdancelaparis' ),
					'param_name' 	=> 'data_show',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Recent Blog'		=> 'recent_blog',
							'Most View Blog'	=> 'mostview_blog',
							'Most Comment'		=> 'comment_blog'
						),
					'description' => ''
				),
				array(
					'type'			=> 'textfield',
					'heading' 		=> esc_html__( 'Number of blogs', 'wpdancelaparis' ),
					'param_name' 	=> 'number_blogs',
					'admin_label' 	=> true,
					'value' 		=> '12'
				),
				array( 
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Thumbnail Style', 'wpdancelaparis' ),
					'param_name' 	=> 'show_data_image_slider',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Show Thumbnail Style For All Post'		=> '1',
							'Show Post Format Style (Video, Audio...)'	=> '0'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Grid/List Layout', 'wpdancelaparis' ),
					'param_name' 	=> 'grid_list_layout',
					'admin_label' 	=> true,
					'value' 		=> array(
							'Grid'			=> 'grid',
							'Grid Masonry' => 'grid-masonry',
							'List'			=> 'list'
						),
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Sort By', 'wpdancelaparis' ),
					'param_name' 	=> 'sort',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_get_sort_by_values(),
					'std'			=> 'DESC',
					'description'	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Order By', 'wpdancelaparis' ),
					'param_name' 	=> 'order_by',
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_get_order_by_values(),
					'std'			=> 'date',
					'description' 	=> ''
				),
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Columns', 'wpdancelaparis' ),
					'param_name' 	=> 'columns',
					'admin_label' 	=> true,
					'value' 		=> array(
							'1 Columns'		=> '1',
							'2 Columns'		=> '2',
							'3 Columns'		=> '3',
							'4 Columns'		=> '4'
						),
					'description' => ''
				),
				array(
					'type' 			=> 'textfield',
					'heading' 		=> esc_html__( 'Number of excerpt words', 'wpdancelaparis' ),
					'param_name' 	=> 'excerpt_words',
					'admin_label' 	=> true,
					'value' 		=> '20',
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
					"heading" 		=> esc_html__("Number blogs Load More", 'wpdancelaparis'),
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
?>