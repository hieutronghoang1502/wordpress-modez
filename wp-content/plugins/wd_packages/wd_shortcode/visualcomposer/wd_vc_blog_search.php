<?php
	# Add shortcode search
	vc_map(array(
		'name' 				=> esc_html__("WD - Blog Search", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_search_blog',
		'description' 		=> esc_html__("Search post", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-toggle-small-expand',
		'params' => array(
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Style", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "style",
				"value" => array(
						'Style 1' => 'style-1',
						'Style 2' => 'style-2'
					),
				"description" 	=> ""
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