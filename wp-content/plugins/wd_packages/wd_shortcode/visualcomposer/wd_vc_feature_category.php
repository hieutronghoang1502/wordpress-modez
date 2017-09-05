<?php
	$feature_options = tvlgiao_wpdance_vc_get_list_category('wpdance_feature_categories');
	vc_map( array(
		'name' 			=> esc_html__( 'WD - Feature Category Slider', 'wpdancelaparis' ),
		'base' 			=> 'tvlgiao_wpdance_feature_category',
		'description' 	=> __( "Display feature by category and slider...", 'wpdancelaparis' ),
		'category' 		=> esc_html__("WPDance Shortcode", 'wpdancelaparis'), 
		'icon'        	=> 'vc_icon-vc-gitem-post-meta',
		'params' 		=> array(
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Select Feature Category', 'wpdancelaparis' ),
				'param_name' 		=> 'id',
				'admin_label' 		=> true,
				'value' 			=> $feature_options,
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Columns', 'wpdancelaparis' ),
				'param_name' 		=> 'columns',
				'admin_label' 		=> true,
				'value' 			=> tvlgiao_wpdance_vc_get_list_tvgiao_columns(),
				'std'				=> 4,
				'description' 		=> esc_html__( '', 'wpdancelaparis' )
			),
			array(
				'type'				=> 'textfield',
				'heading' 			=> esc_html__( 'Number Of Feature', 'wpdancelaparis' ),
				'param_name' 		=> 'number_feature',
				'admin_label' 		=> true,
				'value' 			=> '4'
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Sort By', 'wpdancelaparis' ),
				'param_name' 		=> 'sort',
				'admin_label' 		=> true,
				'value' 			=> tvlgiao_wpdance_get_sort_by_values(),
				'std' 				=> 'ASC',
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Order By', 'wpdancelaparis' ),
				'param_name' 		=> 'order_by',
				'admin_label' 		=> true,
				'value' 			=> tvlgiao_wpdance_get_order_by_values(),
				'std' 				=> 'date',
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Text Align', 'wpdancelaparis' ),
				'param_name' 		=> 'text_align',
				'admin_label' 		=> true,
				'value' 			=> tvlgiao_wpdance_vc_get_list_text_align_bootstrap(),
				'std' 				=> 'wd-text-align-default',
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Show Thumbnail Or Icon Font', 'wpdancelaparis' ),
				'param_name' 		=> 'show_icon_font_thumbnail',
				'admin_label' 		=> true,
				'value' 			=> array( 
					'Show Icon Font'		=> '1',
					'Show Thumbnail'		=> '2',
					'Hide Icon & Thumbnail'	=> '0'
				),
				'description' 		=> esc_html__( 'In Category shortcode, you can only customize font classes and thumbnails in the feature edit page.', 'wpdancelaparis' )
			),
			//Show Icon Font Setting
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Icon Size', 'wpdancelaparis' ),
				'param_name' 		=> 'icon_size',
				'admin_label' 		=> true,
				'value' 			=> array( 
						'1X'	=> 'fa-1x',
						'2X'	=> 'fa-2x',
						'3X'	=> 'fa-3x',
						'4X'	=> 'fa-4x',
						'5X'	=> 'fa-5x',
					),
				'description' 		=> '',
				'dependency'		=> Array('element' => "show_icon_font_thumbnail", 'value' => array('1'))
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Style Font Icon', 'wpdancelaparis' ),
				'param_name' 		=> 'style_font',
				'admin_label' 		=> true,
				'value' 			=> array(
						'Style Icon 1 (Sync with title)'			=> 'sync-with-title',
						'Style Icon 2 (Separate from title)'		=> 'separate-from-title'
					),
				'description' 		=> '',
				'dependency'		=> Array('element' => "show_icon_font_thumbnail", 'value' => array('1'))
			),
			//Show Thumbnail Setting
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Style Thumbnail', 'wpdancelaparis' ),
				'param_name' 		=> 'style_thumbnail',
				'admin_label' 		=> true,
				'value' 			=> array(
						'Above the content'			=> 'above-the-content',
						'Left of the content'		=> 'left-of-the-content'
					),
				'description' 		=> '',
				'dependency'		=> Array('element' => "show_icon_font_thumbnail", 'value' => array('2'))
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Thumbnail Size', 'wpdancelaparis' ),
				'param_name' 		=> 'image_size',
				'admin_label' 		=> true,
				'value' 			=> tvlgiao_wpdance_vc_get_list_image_size(),
				'description' 		=> '',
				'dependency'  		=> Array('element' => "show_icon_font_thumbnail", 'value' => array('2'))
			),
			//Content Display
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Show Title', 'wpdancelaparis' ),
				'param_name' 		=> 'title',
				'admin_label' 		=> true,
				'value' 			=> array(
						'Yes'	=> '1',
						'No'	=> '0'
					),
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Show Excerpt', 'wpdancelaparis' ),
				'param_name' 		=> 'excerpt',
				'admin_label' 		=> true,
				'value' 			=> array(
						'Yes'	=> '1',
						'No'	=> '0'
					),
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Show Readmore', 'wpdancelaparis' ),
				'param_name' 		=> 'readmore',
				'admin_label' 		=> true,
				'value' 			=> array(
						'Yes'	=> '1',
						'No'	=> '0'
					),
				'description' 		=> ''
			),
			/*-----------------------------------------------------------------------------------
				SLIDER SETTING
			-------------------------------------------------------------------------------------*/
			array(
				"type" 				=> "dropdown",
				"class" 			=> "",
				"heading" 			=> esc_html__("Is Slider", 'wpdancelaparis'),
				"admin_label" 		=> true,
				"param_name" 		=> "is_slider",
				"value" 			=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				'std'				=> '0',
				"description" 		=> esc_html__('', 'wpdancelaparis'),
				"group"				=> esc_html__('Slider Setting', 'wpdancelaparis'),
			),
			array(
				"type" 				=> "dropdown",
				"class" 			=> "",
				"heading" 			=> esc_html__("Show Nav", 'wpdancelaparis'),
				"admin_label" 		=> true,
				"param_name" 		=> "show_nav",
				"value" 			=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 		=> "",
				"group"				=> esc_html__('Slider Setting', 'wpdancelaparis'),
				'dependency'  		=> Array('element' => "is_slider", 'value' => array('1')),
			),
			array(
				"type" 				=> "dropdown",
				"class" 			=> "",
				"heading" 			=> esc_html__("Auto Play", 'wpdancelaparis'),
				"admin_label" 		=> true,
				"param_name" 		=> "auto_play",
				"value" 			=> array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 		=> "",
				"group"				=> esc_html__('Slider Setting', 'wpdancelaparis'),
				'dependency'  		=> Array('element' => "is_slider", 'value' => array('1')),
			),
			array(
				'type' 				=> 'textfield',
				'class' 			=> '',
				'heading' 			=> esc_html__("Extra class name", 'wpdancelaparis'),
				'description'		=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis'),
				'admin_label' 		=> true,
				'param_name' 		=> 'class',
				'value' 			=> ''
			),
		)
	));
?>