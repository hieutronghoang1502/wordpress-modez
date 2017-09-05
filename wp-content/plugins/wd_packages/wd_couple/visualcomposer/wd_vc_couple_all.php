<?php
	// Couple Infomation
	vc_map(array(
		'name' 				=> esc_html__("WD All Couple", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_couple_all_data',
		'description' 		=> esc_html__("WD All Couple", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Couple", 'woocommerce'),
				'description'	=> esc_html__("Number Couple", 'woocommerce'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number_couple',
				'value' 		=> '6'
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__("Column Couple", 'woocommerce'),
				'description'	=> esc_html__("Column Couple", 'woocommerce'),
				'admin_label' 	=> true,
				'param_name' 	=> 'column_couple',
				'value' 		=> array(
						'02 Columns'		=> '2',
						'03 Columns'		=> '3',
						'04 Columns'		=> '4',
						'06 Columns'		=> '6',
					)
				,'description' => ''
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Extra class name", 'wpdance'),
				'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'class',
				'value' 		=> ''
			)
		)
	));
?>