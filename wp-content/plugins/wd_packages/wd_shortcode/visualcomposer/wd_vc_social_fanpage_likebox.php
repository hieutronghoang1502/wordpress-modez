<?php
	//Social Profiles
	vc_map(array(
		'name' 				=> esc_html__("WD - Fanpage Likebox", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_social_fanpage_likebox',
		'description' 		=> esc_html__("Social Profiles", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-balloon-facebook-left',
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Fanpage URL", 'wpdancelaparis'),
				'description' 	=> esc_html__("URL of facebook fanpage", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'fanpage_url',
				'value' 		=> ''
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Width", 'wpdancelaparis'),
				'description' 	=> esc_html__("Unit: pixel", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'width',
				'value' 		=> '320'
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Height", 'wpdancelaparis'),
				'description' 	=> esc_html__("Unit: pixel", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'height',
				'value' 		=> '230'
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