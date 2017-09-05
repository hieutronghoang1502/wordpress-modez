<?php
if( class_exists('GTranslate') ){
	vc_map(array(
		'name' 				=> esc_html__("WD - GTranslate", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_gtranslate',
		'description' 		=> esc_html__("Display GTranslate Shortcode", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-vc_gravityform',
		'params' => array(
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