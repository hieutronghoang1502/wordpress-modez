<?php
	# Add Quote
	vc_map(array(
		'name' 				=> esc_html__("WD - Process Bar", 'wpdancelaparis'),
		'base' 				=> 'tvlgiao_wpdance_process_bar',
		'description' 		=> esc_html__("Process Bar", 'wpdancelaparis'),
		'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
		'icon'        		=> 'icon-wpb-graph',
		"params" 			=> array(
			array(
                'type' => 'param_group',
                'value' => '',
                'param_name' => 'process',
                // Note params is mapped inside param-group:
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => 'Label',
                        'param_name' => 'label',
                    ),
					array(
                        'type' => 'textfield',
                        'value' => '',
                        'heading' => 'Value',
                        'param_name' => 'value',
                    )
                )
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