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
		'name' 				=> esc_html__("WD Couple Info", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_couple_info',
		'description' 		=> esc_html__("WD Couple Info", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Title", 'woocommerce'),
				'description'	=> esc_html__("title", 'woocommerce'),
				'admin_label' 	=> true,
				'param_name' 	=> 'title',
				'value' 		=> ''
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Select Couple', 'wdoutline' )
				,'param_name' 	=> 'id_couple'
				,'admin_label' 	=> true
				,'value' 		=> $data_couple
				,'description' 	=> ''
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Show', 'wpdance' )
				,'param_name' 	=> 'data_show'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'Style 01'		=> 'style-01',
						'Style 02'		=> 'style-02',
					)
				,'description' => ''
			),
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Image Couple", 'wpdance'),
				"param_name" 	=> "image_couple",
				"value" 		=> "",
				"description" 	=> 'Image Couple',
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Read Story", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_detail",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("URL Type", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "url_type",
				"value" => array(
						'Couple Detail' => '1',
						'Static Page' => '0'
					),
				"description" 	=> "",
				'dependency'=>array('element'=>'show_detail','value'=>array('1')),
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Select Static Page", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "story_page",
				"value" 		=> $select_page,
				"description" 	=> "",
				'dependency'=>array('element'=>'url_type','value'=>array('0')),
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Social", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_social",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Date Weeding", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_date",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
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