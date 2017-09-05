<?php
	$size_arr = array(
		'2x'			=> 'fa-2x',
		'1x'			=> 'fa-1x',
		'3x'			=> 'fa-3x',
		'4x'			=> 'fa-4x',
		'5x'			=> 'fa-5x',
		'6x'			=> 'fa-6x',
	);
	vc_map(array(
		'name' 				=> esc_html__("WD - Payment Icon", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_payment_icon',
		'description' 		=> esc_html__("Payment Icon", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-vc_icon',
		"params" => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("List Icon Awesome (Separated by commas)", 'wpdancelaparis'),
				'description'	=> esc_html__("Exam: fa-cc-amex, fa-cc-discover, fa-cc-mastercard, fa-cc-paypal, fa-cc-visa", 'wpdancelaparis'),
				'admin_label' 	=> true,
				'param_name' 	=> 'list_icon_payment',
				'value' 		=> ''
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Icon Size", 'wpdancelaparis'),
				"admin_label" 	=> true,
				"param_name" 	=> "size",
				"value" 		=> $size_arr,
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