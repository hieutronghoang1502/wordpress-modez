<?php
	// Couple Infomation
	vc_map(array(
		'name' 				=> esc_html__("WD Timeline Couple", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_couple_timeline',
		'description' 		=> esc_html__("WD Timeline Couple", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),

		"params" => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Number Event', 'wpdance' ),
				'param_name' 	=> 'number_event',
				'admin_label' 	=> true,
				'value' 		=> array(
						'1'			=> '1',
						'2'			=> '2',
						'3'			=> '3',
						'4'			=> '4',
						'5'			=> '5',
						'6'			=> '6',
						'7'			=> '7',
						'8'			=> '8',
						'9'			=> '9',
						'10'		=> '10',
					),
				'description' => '',
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Style Show', 'wpdance' ),
				'param_name' 	=> 'timeline_style',
				'admin_label' 	=> true,
				'value' 		=> array(
						'Style 1'			=> 'wd-style-event-1',
						'Style 2'			=> 'wd-style-event-2',
					),
				'description' => '',
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show Description', 'wpdance' ),
				'param_name' 	=> 'timeline_des_show',
				'admin_label' 	=> true,
				'value' 		=> array(
						'No'			=> '0',
						'Yes'			=> '1',
					),
				'description' => '',
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
			/*-------------------------------------------------------------------*/
			// 									Event 01						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_1",
				"value" 		=> "",
				"group"			=> esc_html__("Event 1", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('1','2','3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_1",
				"group"			=> esc_html__("Event 1", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('1','2','3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_1",
				"group"			=> esc_html__("Event 1", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('1','2','3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_1",
				"group"			=> esc_html__("Event 1", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('1','2','3','4','5','6','7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 02						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_2",
				"value" 		=> "",
				"group"			=> esc_html__("Event 2", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('2','3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_2",
				"group"			=> esc_html__("Event 2", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('2','3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_2",
				"group"			=> esc_html__("Event 2", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('2','3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_2",
				"group"			=> esc_html__("Event 2", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('2','3','4','5','6','7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 03						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_3",
				"value" 		=> "",
				"group"			=> esc_html__("Event 3", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_3",
				"group"			=> esc_html__("Event 3", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_3",
				"group"			=> esc_html__("Event 3", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('3','4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_3",
				"group"			=> esc_html__("Event 3", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('3','4','5','6','7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 04						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_4",
				"value" 		=> "",
				"group"			=> esc_html__("Event 4", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_4",
				"group"			=> esc_html__("Event 4", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_4",
				"group"			=> esc_html__("Event 4", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('4','5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_4",
				"group"			=> esc_html__("Event 4", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('4','5','6','7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 05						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_5",
				"value" 		=> "",
				"group"			=> esc_html__("Event 5", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_5",
				"group"			=> esc_html__("Event 5", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_5",
				"group"			=> esc_html__("Event 5", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('5','6','7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_5",
				"group"			=> esc_html__("Event 5", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('5','6','7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 06						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_6",
				"value" 		=> "",
				"group"			=> esc_html__("Event 6", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_6",
				"group"			=> esc_html__("Event 6", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('6','7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_6",
				"group"			=> esc_html__("Event 6", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('6','7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_6",
				"group"			=> esc_html__("Event 6", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('6','7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 07						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_7",
				"value" 		=> "",
				"group"			=> esc_html__("Event 7", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_7",
				"group"			=> esc_html__("Event 7", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('7','8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_7",
				"group"			=> esc_html__("Event 7", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('7','8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_7",
				"group"			=> esc_html__("Event 7", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('7','8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 08						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_8",
				"value" 		=> "",
				"group"			=> esc_html__("Event 8", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_8",
				"group"			=> esc_html__("Event 8", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('8','9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_8",
				"group"			=> esc_html__("Event 8", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('8','9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_8",
				"group"			=> esc_html__("Event 8", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('8','9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 09						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_9",
				"value" 		=> "",
				"group"			=> esc_html__("Event 9", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_9",
				"group"			=> esc_html__("Event 9", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('9','10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_9",
				"group"			=> esc_html__("Event 9", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('9','10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_9",
				"group"			=> esc_html__("Event 9", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('9','10'))
			),
			/*-------------------------------------------------------------------*/
			// 									Event 10						*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon", 'wpdance'),
				"param_name" 	=> "event_icon_10",
				"value" 		=> "",
				"group"			=> esc_html__("Event 10", 'wpdance'),
				'dependency'  	=> Array('element' => "number_event", 'value' => array('10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Event", 'wpdance'),
				"param_name" 	=> "event_title_10",
				"group"			=> esc_html__("Event 10", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('10'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Time Event", 'wpdance'),
				"param_name" 	=> "event_time_10",
				"group"			=> esc_html__("Event 10", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('10'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description Event", 'wpdance'),
				"param_name" 	=> "event_description_10",
				"group"			=> esc_html__("Event 10", 'wpdance'),
				"description" 	=> '',
				'dependency'  	=> Array('element' => "number_event", 'value' => array('10'))
			),
		)
	));
?>