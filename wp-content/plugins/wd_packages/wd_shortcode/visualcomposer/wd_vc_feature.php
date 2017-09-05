<?php
	$feature_options = tvlgiao_wpdance_vc_get_data_by_post_type('wpdance_feature');
	vc_map( array(
		'name' 			=> esc_html__( 'WD - Feature Single', 'wpdancelaparis' ),
		'base' 			=> 'tvlgiao_wpdance_feature',
		'description' 	=> __( "Display detail of single feature...", 'wpdancelaparis' ),
		'category' 		=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        	=> 'vc_icon-vc-gitem-post-meta',
		'params' 		=> array(
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Feature ID', 'wpdancelaparis' ),
				'param_name' 		=> 'id',
				'admin_label' 		=> true,
				'value' 			=> $feature_options,
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Show Thumbnail Or Icon Font', 'wpdancelaparis' ),
				'param_name' 		=> 'show_icon_font_thumbnail',
				'admin_label' 		=> true,
				'value' 			=> array( 
					'Show Icon Font'		=> '1',
					'Show Image/Thumbnail'	=> '2',
					'Hide Icon & Thumbnail'	=> '0'
				),
				'description' 		=> ''
			),
			//Show Icon Setting
			array(
				'type' 				=> 'iconpicker',
				'heading' 			=> esc_html__( 'Icon', 'wpdancelaparis' ),
				'param_name' 		=> 'icon_fontawesome',
				'value' 			=> 'fa fa-adjust',
				'settings' 			=> array(
					'emptyIcon' 		=> false,
					'iconsPerPage' 		=> 4000,
				),
				'description' 		=> esc_html__( 'Select icon from library.', 'wpdancelaparis' ),
				'dependency'  		=> Array('element' => "show_icon_font_thumbnail", 'value' => array('1'))
			),
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
			//Show Image/thumbnail Setting
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Image Or Thumbnail', 'wpdancelaparis' ),
				'param_name' 		=> 'image_or_thumbnail',
				'admin_label' 		=> true,
				'value' 			=> array( 
					'Show Thumbnail'		=> '1',
					'Show Custom Image'		=> '2',
				),
				'description' 		=> '',
				'dependency'  		=> Array('element' => "show_icon_font_thumbnail", 'value' => array('2'))
			),
			array(
				"type" 				=> "attach_image",
				"class" 			=> "",
				"heading" 			=> esc_html__("Select Image", 'wpdancelaparis'),
				"param_name" 		=> "custom_image",
				"value" 			=> "",
				"description" 		=> esc_html__('', 'wpdancelaparis'),
				'dependency'  		=> Array('element' => "image_or_thumbnail", 'value' => array('2'))
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
			//Global Setting
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
				'heading' 			=> esc_html__( 'Show feature title', 'wpdancelaparis' ),
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
				'heading' 			=> esc_html__( 'Show excerpt', 'wpdancelaparis' ),
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
						'No'	=> '0',
						'Yes'	=> '1'
						
					),
				'description' 		=> ''
			),
			array(
				'type' 				=> 'dropdown',
				'heading' 			=> esc_html__( 'Active', 'wpdancelaparis' ),
				'param_name' 		=> 'active',
				'admin_label' 		=> true,
				'value' 			=> array(
						'No'	=> '0',
						'Yes'	=> '1'
					),
				'description' 		=> ''
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