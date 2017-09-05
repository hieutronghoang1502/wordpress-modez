<?php
	// Couple Infomation
	vc_map(array(
		'name' 				=> esc_html__("WD Couple Impression", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_couple_impression',
		'description' 		=> esc_html__("WD Couple Impression", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Avata Groom/Bridal", 'wpdance'),
				"param_name" 	=> "impression_avata",
				"value" 		=> "",
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Full Name", 'wpdance'),
				"param_name" 	=> "impression_name",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description", 'wpdance'),
				"param_name" 	=> "impression_desc",
				"description" 	=> '',
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