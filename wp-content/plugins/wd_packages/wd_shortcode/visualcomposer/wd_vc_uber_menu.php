<?php
if( class_exists('UberMenu') ){
	$integrate_specific_menu = tvlgiao_wpdance_vc_get_list_category('nav_menu', false);
	$menu_theme_location     = tvlgiao_wpdance_get_list_menu_registed();
	vc_map(array(
		'name' 				=> esc_html__("WD - Uber Menu", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_uber_menu',
		'description' 		=> esc_html__("Display Uber Menu", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'vc_icon-vc-gitem-post-categories',
		'params' => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Type', 'wpdancelaparis' ),
				'param_name' 	=> 'type',
				'admin_label' 	=> true,
				'value' 		=> array(
					'Menu Theme Location'				=> '1',
					'Integrate Specific Menu'			=> '2',
				),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Menu Theme Location', 'wpdancelaparis' ),
				'param_name' 	=> 'menu_theme_location',
				'admin_label' 	=> true,
				'value' 		=> $menu_theme_location,
				'dependency'  	=> Array('element' => "type", 'value' => array('1'))
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Integrate Specific Menu', 'wpdancelaparis' ),
				'param_name' 	=> 'integrate_specific_menu',
				'admin_label' 	=> true,
				'value' 		=> $integrate_specific_menu,
				'dependency'  	=> Array('element' => "type", 'value' => array('2'))
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
}
?>