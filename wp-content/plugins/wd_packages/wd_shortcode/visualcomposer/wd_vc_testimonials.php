<?php
	/****************************************************************************/
	/*						TESTIMONIAL	PLUGIN 									*/
	/****************************************************************************/
	if( post_type_exists('testimonial') || class_exists('Woothemes_Testimonials') ){
		$testimonials_options = tvlgiao_wpdance_vc_get_data_by_post_type('testimonial');		
		vc_map( array(
			'name' 			=> esc_html__( 'WD - Testimonials', 'wpdancelaparis' ),
			'base' 		=> 'tvlgiao_wpdance_testimonials',
			'category' 	=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
			'icon'        		=> 'icon-wpb-call-to-action',
			'params' 	=> array(
				array(
					'type' 				=> 'dropdown',
					'heading' 			=> esc_html__( 'Slider Or One Testimonials', 'wpdancelaparis' ),
					'param_name' 		=> 'slider_or_one',
					'admin_label' 		=> true,
					'value' => array(
							'One Testimonials'	=> '1',
							'Slider'			=> '0'
							
						),
					'description' 		=> ''
				),
				array(
					'type' 				=> 'dropdown',
					'heading' 			=> esc_html__( 'Select Testimonials', 'wpdancelaparis' ),
					'param_name' 		=> 'id_testimonial',
					'admin_label' 		=> true,
					'value' 			=> $testimonials_options,
					'description' 		=> '',
					'dependency'		=> Array('element' => "slider_or_one", 'value' => array('1'))
				 ),
				array(
					'type' 				=> 'dropdown',
					'heading' 			=> esc_html__( 'Style', 'wpdancelaparis' ),
					'param_name' 		=> 'style_testimonial',
					'admin_label' 		=> true,
					'value' => array(
							 'Style 1'			=> 'style-1',
							'Style 2'			=> 'style-2',
							'Style 3'			=> 'style-3',
							'Style 4'			=> 'style-4',
							'Style 5'			=> 'style-5'
						),
					'description' 		=> '',
					'dependency'		=> Array('element' => "slider_or_one", 'value' => array('1'))
				),
				array(
					'type' 				=> 'dropdown',
					'heading' 			=> esc_html__( 'Show Avatar', 'wpdancelaparis' ),
					'param_name' 		=> 'show_avatar',
					'admin_label' 		=> true,
					'value' => array(
							'Yes'	=> '1',
							'No'	=> '0'
						),
					'description' 		=> ''
				),
				array(
					'type' 				=> 'dropdown',
					'heading' 			=> esc_html__( 'Show Author', 'wpdancelaparis' ),
					'param_name' 		=> 'show_author',
					'admin_label' 		=> true,
					'value' => array(
							'Yes'	=> '1',
							'No'	=> '0'
						),
					'description' => ''
				),
				array(
					'type' 				=> 'textfield',
					'heading' 			=> esc_html__( 'Number of excerpt words', 'wpdancelaparis' ),
					'param_name' 		=> 'number_testimonial',
					'admin_label' 		=> true,
					'value' 			=> '20',
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
				)
			)
		));
	}// End Testimonials By WooCommerce
?>