<?php
	$blog_category 	= tvlgiao_wpdance_vc_get_list_category('category');
	$image_size 	= tvlgiao_wpdance_vc_get_list_image_size();
	vc_map(array(
			"name"				=> esc_html__("WD - Blog Recent Slider",'wpdancelaparis'),
			"base"				=> 'tvlgiao_wpdance_special_recent_post_slider',
			'description' 		=> esc_html__("Recent Post Slider", 'wpdancelaparis'),
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
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Image size', 'wpdancelaparis' ),
					'param_name' 	=> 'image_size',
					'admin_label' 	=> true,
					'value' 		=> $image_size,
					'description'  => ''
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
					'admin_label' 	=> true,
					'value' 		=> tvlgiao_wpdance_get_order_by_values(),
					'std'			=> 'date',
					'description' 	=> ''
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