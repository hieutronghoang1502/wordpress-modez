<?php
	// Banner Image
	vc_map(array(
		'name' 				=> esc_html__("WD - Banner Image", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_banner_image',
		'description' 		=> esc_html__("Banner Image", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-single-image',
		"params" => array(
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Background Image", 'wpdancelaparis'),
				"param_name" 	=> "bg_image",
				"value" 		=> "",
				"description" 	=> 'Background image banner',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button text", 'wpdancelaparis'),
				"param_name" 	=> "button_text",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Button", 'wpdancelaparis'),
				"param_name" 	=> "link_url",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button class", 'wpdancelaparis'),
				"param_name" 	=> "button_class",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Top", 'wpdancelaparis'),
				"param_name" 	=> "top",
				"description" 	=> esc_html__("ex: 5%", 'wpdancelaparis')
			),
			array(
				"type" 			=> "textfield",
				"class"			=> "",
				"heading" 		=> esc_html__("Right", 'wpdancelaparis'),
				"param_name" 	=> "right",
				"description" 	=> esc_html__("ex: 5%", 'wpdancelaparis')
			),
			array(
				"type" 			=> "textfield",
				"class"			=> "",
				"heading" 		=> esc_html__("Bottom", 'wpdancelaparis'),
				"param_name" 	=> "bottom",
				"description" 	=> esc_html__("ex: 5%", 'wpdancelaparis')
			),
			array(
				"type" 			=> "textfield",
				"class"			=> "",
				"heading" 		=> esc_html__("Left", 'wpdancelaparis'),
				"param_name" 	=> "left",
				"description" 	=> esc_html__("ex: 5%", 'wpdancelaparis')
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
	));
?>