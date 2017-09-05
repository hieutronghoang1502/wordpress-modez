<?php
	//Social Profiles
	vc_map(array(
		'name' 				=> esc_html__("WD - Social Profiles", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_social_profiles',
		'description' 		=> esc_html__("Social Profiles", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-balloon-facebook-left',
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Title", 'wpdancelaparis'),
				'description' 	=> esc_html__("Title", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'title',
				'value' 		=> ''
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Style Show", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "style",
				"value" => array(
						'Style 1' 		=> 'style-1',
						'Style 2' 		=> 'style-2'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Title Social", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_title",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show RSS", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_rss",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("RSS ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("res id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'rss_id',
				'value' 		=> '#'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Twitter", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_twitter",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Twitter ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("twitter id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'twitter_id',
				'value' 		=> '#'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Facebook", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_facebook",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Facebook ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("facebook id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'facebook_id',
				'value' 		=> '#'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Google", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_google",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Google ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("google id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'google_id',
				'value' 		=> '#'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Pin", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_pin",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Pin ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("pin id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'pin_id',
				'value' 		=> '#'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Youtube", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_youtube",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Youtube ID", 'wpdancelaparis'),
				'description' 	=> esc_html__("youtube id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'youtube_id',
				'value' 		=> '#'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Instagram", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_instagram",
				"value" => array(
						'Show' 		=> '1',
						'Hide' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("RSS Instagram", 'wpdancelaparis'),
				'description' 	=> esc_html__("instagram id", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'instagram_id',
				'value' 		=> '#'
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