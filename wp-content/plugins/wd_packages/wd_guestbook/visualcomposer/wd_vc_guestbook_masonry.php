<?php
	// Masonry Guestbook
	vc_map(array(
		'name' 				=> esc_html__("WD Guestbook", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_masonry_guestbook',
		'description' 		=> esc_html__("Template masonry", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Post", 'wpdance'),
				'description' 	=> esc_html__("number", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number',
				'value' 		=> '6'
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Columns', 'wpdance' )
				,'param_name' 	=> 'columns'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1 Columns'		=> '1'
						,'2 Columns'	=> '2'
						,'3 Columns'	=> '3'
						,'4 Columns'	=> '4'
						,'6 Columns'	=> '6'
					)
				,'description' => ''
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Show Pagination Or Load More', 'wdoutline' )
				,'param_name' 	=> 'pagination_loadmore'
				,'admin_label' 	=> true
				,'value' 	=> array(
						'Load More'		=> '0',
						'Pagination'	=> '1',
						'No Show'		=> '2'
					)
				,'description' 	=> ''
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Number Post Load More", 'wdoutline'),
				"admin_label" 	=> true,
				"param_name" 	=> "number_loadmore",
				"value" 		=> '6',
				"description" 	=> "",
				'dependency'  	=> Array('element' => "pagination_loadmore", 'value' => array('0'))
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