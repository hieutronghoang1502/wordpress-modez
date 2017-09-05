<?php
	// Banner Image
	vc_map(array(
		'name' 				=> esc_html__("WD - Instagram", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_instagram',
		'description' 		=> esc_html__("WD Instagram", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'vc_icon-vc-gitem-image',
		"params" 			=> array(
			/*-----------------------------------------------------------------------------------
				Title & DESC
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title Instagram", 'wpdancelaparis'),
				"param_name" 	=> "insta_title",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description", 'wpdancelaparis'),
				"param_name" 	=> "insta_desc",
				"description" 	=> '',
			),
			array(
				"type" 			=> "dropdown",
				"class"			=> "",
				"heading" 		=> esc_html__("Show Follow Me", 'wpdancelaparis'),
				"param_name" 	=> "insta_follow",
				"value" 		=> array(
					'Yes' 	=> '1',
					'No' 	=> '0',
				),
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Follow Text", 'wpdancelaparis'),
				"param_name" 	=> "insta_follow_text",
				'value'			=> 'Follow Me',
				"description" 	=> '',
				'dependency'  	=> array(
					'element' => 'insta_follow',
					'value'   => array( '1' ),
				)
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title & Desc Position", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "insta_style",
				"value" 		=> array(
						'Center + Inner Content' => 'style-insta-1',
						'Before Content' 		 => 'style-insta-2'
					),
				"description" 	=> "",
			),
			/*-----------------------------------------------------------------------------------
				SETTING
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Username", 'wpdancelaparis'),
				"param_name" 	=> "insta_user",
				"description" 	=> '',
				"group"			=> esc_html__('Instagram Setting', 'wpdancelaparis'),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Columns', 'wpdancelaparis' ),
				'param_name' 	=> 'insta_columns',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_tvgiao_columns(),
				"std"			=> 4,
				'description' 	=> '',
				"group"			=> esc_html__('Instagram Setting', 'wpdancelaparis'),
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Number of photos", 'wpdancelaparis'),
				"param_name" 	=> "insta_number",
				"value"			=> 4,
				"description" 	=> esc_html__('Max 12 photos', 'wpdancelaparis'),
				"group"			=> esc_html__('Instagram Setting', 'wpdancelaparis'),
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Padding", 'wpdancelaparis'),
				"param_name" 	=> "insta_padding",
				"value"			=> 0,
				"description" 	=> esc_html__('Padding between images. Only fill in whole numbers or real numbers. Example: 2.5 (Unit: pixels)', 'wpdancelaparis'),
				"group"			=> esc_html__('Instagram Setting', 'wpdancelaparis'),
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Photo Size", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "insta_size",
				"value" 		=> array(
						'Thumbnail' => 'thumbnail',
						'Small' 	=> 'small',
						'Large'		=> 'large',
						'Original'	=> 'original'
					),
				"description" 	=> "",
				"group"			=> esc_html__('Instagram Setting', 'wpdancelaparis'),
			),
			array(
				"type" 			=> "dropdown",
				"class"			=> "",
				"heading" 		=> esc_html__("Open links in:", 'wpdancelaparis'),
				"param_name" 	=> "insta_open_win",
				"value" 		=> tvlgiao_wpdance_vc_get_list_link_target(),
				"group"			=> esc_html__('Instagram Setting', 'wpdancelaparis'),
			),
			/*-----------------------------------------------------------------------------------
				SLIDER SETTING
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Is Slider", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "is_slider",
				"value" 		=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				'std'			=> '0',
				"description" 	=> esc_html__('Set "Number of photos" larger than ("Columns" * "Number Rows Of Slider") to be able to activate Slider mode.', 'wpdancelaparis'),
				"group"			=> esc_html__('Slider Setting', 'wpdancelaparis'),
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Nav", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_nav",
				"value" 		=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				"group"			=> esc_html__('Slider Setting', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1')),
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Auto Play", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "auto_play",
				"value" 		=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				"group"			=> esc_html__('Slider Setting', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1')),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Rows Of Slider", 'wpdancelaparis'),
				'description' 	=> esc_html__("Number Rows Of Slider", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'per_slide',
				'value' 		=> '1',
				"group"			=> esc_html__('Slider Setting', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1')),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Extra class name", 'wpdancelaparis'),
				'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'class',
				'value' 		=> '',
				"group"			=> esc_html__('Slider Setting', 'wpdancelaparis'),
			)
		)
	));
?>