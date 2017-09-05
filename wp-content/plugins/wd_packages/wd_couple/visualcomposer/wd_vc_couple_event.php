<?php
	// Couple Infomation
	vc_map(array(
		'name' 				=> esc_html__("WD Couple Event", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_couple_event',
		'description' 		=> esc_html__("WD Couple Event", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Style Event', 'wpdance' ),
				'param_name' 	=> 'event_style',
				'admin_label' 	=> true,
				'value' 		=> array(
						'Style 1'		=> 'wd-event-style-1',
						'Style 2'		=> 'wd-event-style-2',
					),
				'description' 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Event Title", 'wpdance'),
				"param_name" 	=> "event_title",
				"description" 	=> '',
			),
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Event Icon", 'wpdance'),
				"param_name" 	=> "event_icon",
				"value" 		=> "",
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Event Location", 'wpdance'),
				"param_name" 	=> "event_location",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Event Date", 'wpdance'),
				"param_name" 	=> "event_date",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Event Time", 'wpdance'),
				"param_name" 	=> "event_time",
				"description" 	=> '',
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show Description', 'wpdance' ),
				'param_name' 	=> 'event_show_des',
				'value' 		=> array(
						'No'		=> '0',
						'Yes'		=> '1',
					),
				'description' 	=> '',
			),			
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Timeline", 'wpdance'),
				"param_name" 	=> "event_description",
				"description" 	=> '',
				'dependency'  	=> Array('element' => "event_show_des", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show View Map', 'wpdance' ),
				'param_name' 	=> 'event_show_map',
				'value' 		=> array(
						'No'		=> '0',
						'Yes'		=> '1',
					),
				'description' 	=> '',
			),	
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("URL MAP", 'wpdance'),
				"param_name" 	=> "event_url_map",
				"description" 	=> '',
				'dependency'  	=> Array('element' => "event_show_map", 'value' => array('1'))
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Extra class name", 'wpdance'),
				'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'class',
				'value' 		=> '',
			),
		)
	));
?>