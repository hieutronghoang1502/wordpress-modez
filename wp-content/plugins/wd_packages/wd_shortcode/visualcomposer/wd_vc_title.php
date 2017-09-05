<?php
	vc_map(array(
		'name' 				=> esc_html__("WD - Title/Heading", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_title',
		'description' 		=> esc_html__("Custom title for everywhere", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-ui-custom_heading',
		"params" => array(
			/*-----------------------------------------------------------------------------------
				Title & DESC
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title", 'wpdancelaparis'),
				"param_name" 	=> "title",
				"description" 	=> '',
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description", 'wpdancelaparis'),
				"param_name" 	=> "description",
				"description" 	=> '',
			),
			/*array(
				'type' 			=> 'checkbox',
				'heading' 		=> __( 'Use theme default font family?', 'wpdancelaparis' ),
				'param_name' 	=> 'use_theme_fonts',
				'value' 		=> array( __( 'Yes', 'wpdancelaparis' ) => 'yes' ),
				'description' 	=> __( 'Use font family from the theme.', 'wpdancelaparis' ),
				'group' 		=> __( 'Title Font Setting', 'wpdancelaparis' ),
				'dependency' 	=> array(
					'element' 	=> 'title',
					'not_empty' => true,
				),
			),
			array(
				'type' 			=> 'google_fonts',
				'param_name' 	=> 'google_fonts',
				'value' 		=> 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings' 		=> array(
					'fields' 	=> array(
						'font_family_description' 	=> __( 'Select font family.', 'wpdancelaparis' ),
						'font_style_description' 	=> __( 'Select font styling.', 'wpdancelaparis' ),
					),
				),
				'group' => __( 'Title Font Setting', 'wpdancelaparis' ),
				'dependency' 	=> array(
					'element' => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),*/
			
			/*-----------------------------------------------------------------------------------
				SETTING
			-------------------------------------------------------------------------------------*/
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Heading Type', 'wpdancelaparis' ),
				'param_name' 	=> 'heading_type',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Title Section Style 1'			=> 'wd-title-section-style-1',
					'Title Section Style 2'			=> 'wd-title-section-style-2',
					'Title For Special Page'		=> 'wd-title-for-special-page',
				), 
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Heading Element', 'wpdancelaparis' ),
				'param_name' 	=> 'heading_element',
				'admin_label' 	=> true,
				'value' 		=> array(
					'H1'		=> 'h1',
					'H2'		=> 'h2',
					'H3'		=> 'h3',
					'H4'		=> 'h4',
					'H5'		=> 'h5',
					'H6'		=> 'h6',
				),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Text Align', 'wpdancelaparis' ),
				'param_name' 	=> 'text_align',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_text_align_bootstrap(),
				'description' 	=> ''
			),
			array(
				'type'        	=> 'dropdown',
				'heading'     	=> __( 'Display Button', 'wpdancelaparis' ),
				'description' 	=> __( 'The button with custom link will display after the description', 'wpdancelaparis' ),
				'param_name'  	=> 'display_button',
				'value'       	=> array(
					'Yes' 	=> '1',
					'No' 	=> '0',
				),
				'std'			=> '0',	
				'save_always' 	=> true,
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> __( "Button Text", 'wpdancelaparis' ),
				"param_name" 	=> "button_text",
				"value" 		=> 'View All', 
				"description" 	=> __( "", 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "display_button", 'value' => array('1'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> __( "Button URL", 'wpdancelaparis' ),
				"param_name" 	=> "button_url",
				"value" 		=> '#', 
				"description" 	=> __( "", 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "display_button", 'value' => array('1'))
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