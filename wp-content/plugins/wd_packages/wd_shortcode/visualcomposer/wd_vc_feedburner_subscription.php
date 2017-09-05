<?php
	//Feedburner Subscription
	vc_map(array(
		'name' 				=> esc_html__("WD - Feedburner Subscriptions", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_feedburner_subscription',
		'description' 		=> esc_html__("Feedburner Subscriptions", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'vc_icon-vc-gitem-post-title',
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Title", 'wpdancelaparis'),
				'description' 	=> esc_html__("Title", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'title',
				'value' 		=> esc_html__("Sign up for Our Newsletter", 'wpdancelaparis'),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Intro Text", 'wpdancelaparis'),
				'description' 	=> esc_html__("Intro text", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'intro_text',
				'value' 		=> esc_html__("A newsletter is a regularly distributed publication generally", 'wpdancelaparis'),
			),

			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Placeholder Text", 'wpdancelaparis'),
				'description' 	=> esc_html__("Placeholder text", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'placeholder_text',
				'value' 		=> esc_html__("Enter your email address", 'wpdancelaparis'),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Button", 'wpdancelaparis'),
				'description' 	=> esc_html__("Button Text", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'button_text',
				'value' 		=> esc_html__("Subscribe", 'wpdancelaparis'),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Feedburner ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'feedburner_id',
				'value' 		=> esc_html__("WpComic-Manga", 'wpdancelaparis'),
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