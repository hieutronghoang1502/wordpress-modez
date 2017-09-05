<?php
	# Add shortcode Site Header
	vc_map(array(
		'name' 				=> esc_html__("WD - Do Shortcode", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_do_shortcode',
		'description' 		=> esc_html__("Executes shortcode...", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-atm',
		'params' => array(
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Shortcode", 'wpdancelaparis'),
				"description" 	=> esc_html__("Paste your shortcode here", 'wpdancelaparis'),
				"param_name" 	=> "shortcode",
				"value" 		=> "",
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