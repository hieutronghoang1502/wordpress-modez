<?php
	$product_category = tvlgiao_wpdance_vc_get_list_category();
	$position_content = array(
		'Center' 			=> 'center',
		'Outside - Left' 	=> 'outside-left',
		'Outside - Right' 	=> 'outside-right',
		'Inside - Left' 	=> 'inside-left',
		'Inside - Right' 	=> 'inside-right',
	);

	$button_style = array(
		'Style 1' 	=> 'style-1',
		'Style 2' 	=> 'style-2',
		'Style 3' 	=> 'style-3',
		'Style 4' 	=> 'style-4',
	);

	vc_map(array(
		'name' 				=> esc_html__("WD - Banner Image Plus", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_banner_image_2',
		'description' 		=> esc_html__("Banner/Slider/Video youtube...", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-images-stack',
		"params" => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Type', 'wpdancelaparis' ),
				'param_name' 	=> 'type',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Image'				=> 'image',
					'Video Youtube'		=> 'video',
					'Slider Image'		=> 'slider',
				),
			),
			/*-----------------------------------------------------------------------------------
				IMAGE SETTING
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Banner Image", 'wpdancelaparis'),
				"param_name" 	=> "banner_image",
				"value" 		=> "",
				"description" 	=> esc_html__('', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "type", 'value' => array('image'))
			),
			/*-----------------------------------------------------------------------------------
				SLIDER SETTING
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "attach_images",
				"class" 		=> "",
				"heading" 		=> esc_html__("Slider Images", 'wpdancelaparis'),
				"param_name" 	=> "slider_image",
				"value" 		=> "",
				"description" 	=> esc_html__('Select multi banner for slider', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "type", 'value' => array('slider'))
			),
			array(
				"type" 			=> "textfield",
          		"holder" 		=> "div",
          		"class" 		=> "",
				"heading" 		=> esc_html__("Slider Columns", 'wpdancelaparis'),
				"param_name" 	=> "slider_columns",
				"value" 		=> "1",
				"description" 	=> esc_html__('', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "type", 'value' => array('slider'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Image Size', 'wpdancelaparis' ),
				'param_name' 	=> 'image_size',
				'admin_label' 	=> true,
				'value' 		=> tvlgiao_wpdance_vc_get_list_image_size(),
				'dependency'  	=> Array('element' => "type", 'value' => array('image', 'slider'))
			),
			/*-----------------------------------------------------------------------------------
				VIDEO SETTING
			-------------------------------------------------------------------------------------*/
			array(
				"type" 			=> "textfield",
          		"holder" 		=> "div",
          		"class" 		=> "",
				"heading" 		=> esc_html__("Video ID", 'wpdancelaparis'),
				"param_name" 	=> "video_id",
				"description" 	=> esc_html__('Your Youtube Video ID...', 'wpdancelaparis'),
				'dependency'  	=> Array('element' => "type", 'value' => array('video'))
			),
			array(
				"type" 			=> "textfield",
          		"holder" 		=> "div",
          		"class" 		=> "",
				"heading" 		=> esc_html__("Video Width (Px)", 'wpdancelaparis'),
				"param_name" 	=> "video_width",
				"description" 	=> esc_html__('', 'wpdancelaparis'),
				'value'			=> 570,
				'dependency'  	=> Array('element' => "type", 'value' => array('video'))
			),
			array(
				"type" 			=> "textfield",
          		"holder" 		=> "div",
          		"class" 		=> "",
				"heading" 		=> esc_html__("Video height (Px)", 'wpdancelaparis'),
				"param_name" 	=> "video_height",
				"description" 	=> esc_html__('', 'wpdancelaparis'),
				'value'			=> 400,
				'dependency'  	=> Array('element' => "type", 'value' => array('video'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Video Autoplay', 'wpdancelaparis' ),
				'param_name' 	=> 'video_autoplay',
				'admin_label' 	=> true,
				'value' 		=> array(
					'No'		=> '0',
					'Yes'		=> '1',
				),
				'dependency'  	=> Array('element' => "type", 'value' => array('video'))
			),

			/*-----------------------------------------------------------------------------------
				CONTENT SETTING
			-------------------------------------------------------------------------------------*/
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show Content', 'wpdancelaparis' ),
				'param_name' 	=> 'show_content',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Yes'		=> '1',
					'No'		=> '0',
				),
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'description' 	=> esc_html__('Display title, description, line, button...', 'wpdancelaparis'),
			),
			array(
				"type" 			=> "textfield",
          		"holder" 		=> "div",
          		"class" 		=> "",
				"heading" 		=> esc_html__("Heading Line 1", 'wpdancelaparis'),
				"param_name" 	=> "heading_line_1",
				"description" 	=> esc_html__('Leave blank to hide...', 'wpdancelaparis'),
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			array(
				"type" 			=> "textfield",
          		"holder"		=> "div",
          		"class" 		=> "",
				"heading" 		=> esc_html__("Heading Line 2", 'wpdancelaparis'),
				"param_name" 	=> "heading_line_2",
				"description" 	=> esc_html__('Leave blank to hide...', 'wpdancelaparis'),
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show Line', 'wpdancelaparis' ),
				'param_name' 	=> 'show_line',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Yes'		=> '1',
					'No'		=> '0',
				),
				'description' 	=> esc_html__('Line separates heading and desc', 'wpdancelaparis'),
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			array(
				"type" 			=> "textarea",
				"class" 		=> "",
				"heading" 		=> esc_html__("Description", 'wpdancelaparis'),
				"param_name" 	=> "description",
				"description" 	=> esc_html__('Leave blank to hide...', 'wpdancelaparis'),
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Position Content', 'wpdancelaparis' ),
				'param_name' 	=> 'position_content',
				'admin_label' 	=> true,
				'value' 		=> $position_content,
				'description' 	=> '',
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Border Content', 'wpdancelaparis' ),
				'param_name' 	=> 'border_content',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Yes'		=> '1',
					'No'		=> '0',
				),
				'description' 	=> '',
				'group'			=> esc_html__( 'Content Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			/*-----------------------------------------------------------------------------------
				BUTTON SETTING
			-------------------------------------------------------------------------------------*/
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Show Button', 'wpdancelaparis' ),
				'param_name' 	=> 'show_button',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Yes'		=> '1',
					'No'		=> '0',
				),
				'description' 	=> '',
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_content", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Button Style', 'wpdancelaparis' ),
				'param_name' 	=> 'button_style',
				'admin_label' 	=> true,
				'value' 		=> $button_style,
				'description' 	=> '',
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_button", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Link type', 'wpdancelaparis' ),
				'param_name' 	=> 'link_type',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Category Link'	=> 'category_link',
					'Another Url'	=> 'url',
				),
				'description' 	=> '',
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_button", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Select Category', 'wpdancelaparis' ),
				'param_name' 	=> 'id_category',
				'admin_label' 	=> true,
				'value' 		=> $product_category,
				'description' 	=> '',
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "link_type", 'value' => array('category_link'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("URL", 'wpdancelaparis'),
				"param_name" 	=> "url",
				"description" 	=> esc_html__('', 'wpdancelaparis'),
				'value' 		=> esc_html__('#', 'wpdancelaparis'),
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "link_type", 'value' => array('url'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button text", 'wpdancelaparis'),
				"param_name" 	=> "button_text",
				"description" 	=> esc_html__('', 'wpdancelaparis'),
				'value' 		=> esc_html__('View Category', 'wpdancelaparis'),
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_button", 'value' => array('1'))
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button class", 'wpdancelaparis'),
				"param_name" 	=> "button_class",
				"description" 	=> '',
				'group'			=> esc_html__( 'Button Setting', 'wpdancelaparis' ),
				'dependency'  	=> Array('element' => "show_button", 'value' => array('1'))
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