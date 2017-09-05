<?php
	// Brand Slider
	vc_map(array(
		'name' 				=> esc_html__("WD - Banner Slider", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_banner_slider',
		'description' 		=> esc_html__("Custom Image, Link, Slick slider style...", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-images-carousel',
		"params" 			=> array(
			array(
                'type' 			=> 'param_group',
                'value' 		=> '',
                'param_name' 	=> 'slider',
                // Note params is mapped inside param-group:
                'params' 		=> array(
                	array(
						"type" 			=> "attach_image",
						"class" 		=> "",
						"heading" 		=> esc_html__("Image", 'wpdancelaparis'),
						"param_name" 	=> "image",
						"value" 		=> "",
						"description" 	=> '',
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> esc_html__("URL", 'wpdancelaparis'),
						'description'	=> esc_html__("Add link to image slider.", 'wpdancelaparis'),
						'admin_label' 	=> true,
						'param_name' 	=> 'link',
						'value' 		=> '#'
					)
                )
            ),
            array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Image Size', 'wpdancelaparis' ),
				'param_name' 	=> 'image_size',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_image_size(),
				'std'			=> 'full',
				'description' 	=> '',
			),
			array(
				"type" 			=> "dropdown",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Target", 'wpdancelaparis'),
				"param_name" 	=> "target",
				"value" 		=> tvlgiao_wpdance_vc_get_list_link_target(),
				"std" 			=> '_blank',
				"description" 	=> ""
			),
            array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Columns', 'wpdancelaparis' ),
				'param_name' 	=> 'columns',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_tvgiao_columns(),
				'std'			=> '1',
				'description' 	=> '',
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Center Mode", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "center_mode",
				"value" 		=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				'std'			=> '0',
				"description" 	=> esc_html__("Create highlighter for item at between", 'wpdancelaparis'),
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
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Dot", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_dot",
				"value" 		=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
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