<?php
	$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
	if ( in_array( "woocommerce/woocommerce.php", $_actived ) ) {
		# Add shortcode User Links
		vc_map(array(
			'name' 				=> esc_html__("WD - User Links", 'wpdancelaparis'),
			'base' 				=> 'tvlgiao_wpdance_user_links',
			'description' 		=> esc_html__("Display user's links (login, logout, register...)", 'wpdancelaparis'),
			'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
			'icon'        		=> 'vc_icon-vc-gitem-post-author',
			'params' => array(
				array(
					'type' 			=> 'dropdown',
					'heading' 		=> esc_html__( 'Show Title', 'wpdancelaparis' ),
					'param_name' 	=> 'show_title',
					'admin_label' 	=> true,
					'value' => array(
						'Show Text Sign Up / Login'		=> '1',
						'Show Icon User'				=> '0'
					),
					'description' => esc_html__('Show text or icon', 'wpdancelaparis')
				),
				array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__("Extra class name", 'wpdancelaparis'),
					'description' 	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis'),
					'admin_label' 	=> true,
					'param_name' 	=> 'class',
					'value' 		=> ''
				)
			)
		));
	}
?>