<?php
	//Pricing Table
	vc_map( array(
		'name' 				=> esc_html__("WD - Pricing Table", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_pricing_table',
		'description' 		=> esc_html__("Pricing Table", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-vc_carousel',
		"params" 			=> array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Style', 'wpdancelaparis' ),
				'param_name' 	=> 'style',
				'admin_label' 	=> true,
				'value' 		=> array(
						'Style 1'	=> 'style-1',
						'Style 2'	=> 'style-2',
						'Style 3'	=> 'style-3',
						'Style 4'	=> 'style-4',
						'Style 5'	=> 'style-5',
						'Style 6'	=> 'style-6',
						'Style 7'	=> 'style-7',
						'Style 8'	=> 'style-8'
				),
				'description' 	=> ''
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show image or icon font', 'wpdancelaparis' ),
				'param_name' 	=> 'show_icon_font_image',
				'admin_label' 	=> true,
				'value' 		=> array(
						'Show icon font'	=> '1',
						'Show Image'		=> '0'
						
					),
				'description' 	=> ''
			),
			array(
				'type' 			=> 'iconpicker',
				'heading' 		=> esc_html__( 'Icon font', 'wpdancelaparis' ),
				'param_name' 	=> 'class_icon_font',
				'value' 		=> 'fa fa-adjust', 
				'settings' 		=> array(
					'emptyIcon' 	=> false,
					'iconsPerPage' 	=> 4000,
					),
				'description' 	=> esc_html__( 'Select icon from library.', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_icon_font_image", 'value' => array('1'))
			),
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Image Pricing", 'wpdancelaparis'),
				"description" 	=> esc_html__("Image pricing", 'wpdancelaparis'),
				"param_name" 	=> "image_pricing_url",
				"value" 		=> "",
				'dependency'  	=> Array('element' => "show_icon_font_image", 'value' => array('0'))
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Title", 'wpdancelaparis'),
				"param_name" 	=> "title",
				"value" 		=> esc_html__("Basic Plan", 'wpdancelaparis'),
				"description" 	=> ""
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description", 'wpdancelaparis'),
				"param_name" 	=> "description",
				"value" 		=> "",
				"description" 	=> ""
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Price", 'wpdancelaparis'),
				"param_name" 	=> "price",
				"description" 	=> ""
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Currency", 'wpdancelaparis'),
				"param_name" 	=> "currency",
				"description" 	=> ""
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Price Period", 'wpdancelaparis'),
				"param_name" 	=> "price_period",
				"description" 	=> ""
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link", 'wpdancelaparis'),
				"param_name" 	=> "link",
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Target", 'wpdancelaparis'),
				"param_name" 	=> "target",
				"value" 		=> tvlgiao_wpdance_vc_get_list_link_target(),
				"description" 	=> ""
			),
			array(
				"type" 			=> "textfield",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button Text", 'wpdancelaparis'),
				"param_name" 	=> "button_text",
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Active", 'wpdancelaparis'),
				"param_name" 	=> "active",
				"value" 		=> array(
					"No" 			=> "no",
					"Yes" 			=> "yes"	
				),
				"description" 	=> ""
			),
			array(
				"type" 			=> "textarea_html",
				"holder" 		=> "div",
				"class" 		=> "",
				"heading" 		=> esc_html__("Content", 'wpdancelaparis'),
				"param_name" 	=> "content",
				"value" 		=> "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
				"description" 	=> ""
			)
		)
	));
?>