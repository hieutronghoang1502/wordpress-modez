<?php
	//Recent Comment
	vc_map( array(
		'name' 				=> esc_html__( 'WD - Recent Comment', 'wpdancelaparis' ),
		'base' 			=> 'tvlgiao_wpdance_recent_comment',
		'category' 		=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-call-to-action',
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Title', 'wpdancelaparis' ),
				'param_name' 	=> 'title',
				'admin_label' 	=> true,
				'value' 		=> esc_html__("", 'wpdancelaparis'),
				'description' 	=> ''
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Limit Word", 'wpdancelaparis'),
				'description' 	=> esc_html__("Limit Word", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number_limit',
				'value' 		=> '20'
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Comment", 'wpdancelaparis'),
				'description' 	=> esc_html__("number", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number',
				'value' 		=> '4'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Avata", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_avatar",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Name Author", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_author",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Is Slider", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "is_slider",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
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
				'value' 		=> '2',
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Extra class name", 'wpdancelaparis'),
				'description' 	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'class',
				'value' 		=> ''
			)
		)
	));
?>