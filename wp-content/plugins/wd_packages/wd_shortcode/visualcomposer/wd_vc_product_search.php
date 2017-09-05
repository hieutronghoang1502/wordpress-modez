<?php
	if( class_exists('WooCommerce') ){
		vc_map(array(
				"name"				=> esc_html__("WD - Product Search",'wpdancelaparis'),
				"base"				=> 'tvlgiao_wpdance_product_by_category',
				'description' 		=> esc_html__("WD Search Product By Category", 'wpdancelaparis'),
				"category"			=> esc_html__("WPDance Shortcode",'wpdancelaparis'),
				'icon'        		=> 'icon-wpb-woocommerce',
				"params"=>array(	
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
			)
		);
	}
?>