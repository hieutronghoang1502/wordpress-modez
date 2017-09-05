<?php
	// Count Icon
	vc_map(array(
		'name' 				=> esc_html__("WD - Count Icon", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_count_icon',
		'description' 		=> esc_html__("Count Icon", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-vc_icon',
		"params" => array(
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Icon", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_icon",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Icon', 'wpdancelaparis' ),
				'param_name' 	=> 'icon_fontawesome',
				'value' 		=> 'fa fa-adjust',
				'settings' 		=> array(
					'emptyIcon' 		=> false,
					'iconsPerPage' 		=> 4000,
				),
				'description' 	=> esc_html__( 'Select icon from library.', 'wpdancelaparis' ),
			),
			array(
				"type" 			=> "colorpicker",
				"class" 		=> "",
				"heading" 		=> esc_html__("Color Icon", 'wpdancelaparis'),
				"param_name" 	=> "color_icon",
				"value" 		=> "#cccccc",
				"description" 	=> '',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Start", 'wpdancelaparis'),
				'description'	=> esc_html__("", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'start',
				'value' 		=> ''
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Finish", 'wpdancelaparis'),
				'description'	=> esc_html__("", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'finish',
				'value' 		=> ''
			),
			array(
				"type" 			=> "colorpicker",
				"class" 		=> "",
				"heading" 		=> esc_html__("Color Number", 'wpdancelaparis'),
				"param_name" 	=> "color_number",
				"value" 		=> "#cccccc",
				"description" 	=> '',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Text Infomation", 'wpdancelaparis'),
				'description'	=> esc_html__("", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'text_infomation',
				'value' 		=> ''
			),
			array(
				"type" 			=> "colorpicker",
				"class" 		=> "",
				"heading" 		=> esc_html__("Color Text", 'wpdancelaparis'),
				"param_name" 	=> "color_text",
				"value" 		=> "#cccccc",
				"description" 	=> '',
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