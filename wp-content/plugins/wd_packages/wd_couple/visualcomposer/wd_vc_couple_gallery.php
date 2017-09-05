<?php
	$data_couple	= array();
	$data_couple[esc_html__('Select Couple','wpdance')] = -1;
	if( class_exists('WD_Couple') ){
		$args 	= array( 
				'post_type' 		=> 'wd_couple',
				'post_status' 		=> 'publish',
			);
		$wd_couples 	= new WP_Query( $args );
		while( $wd_couples->have_posts() ){ $wd_couples->the_post(); global $post;
			$data_couple[get_the_title()] = get_the_ID();
		}// End While
		wp_reset_postdata();
	}

	$args = array(
		'sort_order' 	=> 'asc',
		'sort_column'	=> 'post_title',
		'hierarchical' 	=> 1,
		'child_of' 		=> 0,
		'parent' 		=> -1,
		'post_type' 	=> 'page',
		'post_status' 	=> 'publish'
	); 
	$pages = get_pages($args); 
	$select_page = array();
	foreach ($pages as $page) {
		$select_page[$page->post_title.' ('.$page->post_name.')'] = $page->post_name; 
	}
	// Couple Infomation
	vc_map(array(
		'name' 				=> esc_html__("WD Couple Gallery Image", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_couple_gallery_image',
		'description' 		=> esc_html__("WD Couple Gallery Image", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Select Couple', 'wdoutline' )
				,'param_name' 	=> 'id_couple'
				,'admin_label' 	=> true
				,'value' 		=> $data_couple
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Image", 'woocommerce'),
				'description'	=> esc_html__("Number Image", 'woocommerce'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number_image',
				'value' 		=> ''
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__("Column Image", 'woocommerce'),
				'description'	=> esc_html__("Column Image", 'woocommerce'),
				'admin_label' 	=> true,
				'param_name' 	=> 'column_image',
				'value' 		=> array(
						'02 Columns'		=> '2',
						'03 Columns'		=> '3',
						'04 Columns'		=> '4',
						'06 Columns'		=> '6',
					)
				,'description' => ''
			),
			array( 
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Show', 'wpdance' )
				,'param_name' 	=> 'data_show'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'Style Grid'		=> 'style_grid',
						'Style masonry'		=> 'style_masonry',
					)
				,'description' => ''
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show View More", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_more",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "view_more_link",
				"value" 		=> $select_page,
				"description" 	=> "",
				'dependency'=>array('element'=>'show_more','value'=>array('1')),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Extra class name", 'wpdance'),
				'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'class',
				'value' 		=> ''
			)
		)
	));
?>