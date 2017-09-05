<?php
	// Infomation
	vc_map(array(
		'name' 				=> esc_html__("WD - Information", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_information',
		'description' 		=> esc_html__("Display info contact, email, telephone", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-information-white',
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
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Icon', 'wpdancelaparis' ),
				'param_name' 	=> 'icon_fontawesome',
				'value' 		=> 'fa fa-adjust', 	
				'settings' 		=> array(
					'emptyIcon' 	=> false,
					'iconsPerPage' 	=> 4000,
					),
				'description' 	=> esc_html__( 'Select icon from library.', 'wpdancelaparis' )
			),
	        array(
	            "type" 			=> "textarea_html",
	            "holder" 		=> "div",
	            "class" 		=> "",
	            "heading" 		=> esc_html__( "Content", 'wpdancelaparis' ),
	            "param_name" 	=> "content",
	            "value" 		=> esc_html__( "I am test text block. Click edit button to change this text.", 'wpdancelaparis' ),
	            "description" 	=> esc_html__( "Enter your content.", 'wpdancelaparis' )
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