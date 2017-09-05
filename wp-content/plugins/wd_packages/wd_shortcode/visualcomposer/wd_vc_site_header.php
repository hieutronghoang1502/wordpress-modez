<?php
	# Add shortcode Site Header
	vc_map(array(
		'name' 				=> esc_html__("WD - Site Header", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_site_header',
		'description' 		=> esc_html__("Display site info (title, tagline, logo...) on the header", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'vc_icon-vc-gitem-post-categories',
		'params' => array(
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Logo Image", 'wpdancelaparis'),
				"description" 	=> esc_html__("If you do not want the default logo, you add another logo here", 'wpdancelaparis'),
				"param_name" 	=> "custom_logo_url",
				"value" 		=> get_template_directory_uri().'/assets/images/wpdance_logo.png',
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Hide Site Title", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "hide_site_title",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
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