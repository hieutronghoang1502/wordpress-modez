<?php

	if(!function_exists ('tvlgiao_wpdance_customize_header')){
		function tvlgiao_wpdance_customize_header($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM HEADER 							*/
			/*--------------------------------------------------------------*/
		    $wp_customize->add_section( 'tvlgiao_wpdance_header_config' , array(
 				'title'       		=> esc_html__( 'WPDANCE - Header', 'wpdancelaparis' ),
 				'description' 		=> esc_html__( 'Custom header site.' , 'wpdancelaparis' ),
 				'priority'    		=> 505,
 			));
 			//---------------------------------------------------------------//

 			//Content Config Header


        	$wp_customize->add_setting('tvlgiao_wpdance_header_layout', array(
        		'default' 			=> -1,
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_header_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_header_config',
            	'settings'       	=> 'tvlgiao_wpdance_header_layout',
            	'choices'			=> tvlgiao_wpdance_get_html_block_layout_choices('wpdance_header',TVLGIAO_WPDANCE_THEME_IMAGES . '/headers/wd_header_default.jpg','url_image')
        	)));

        	// Show Logo / Title
			$wp_customize->add_setting('tvlgiao_wpdance_header_show_logo_title', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_header_show_logo_title_control', array(
				'label'   			=> 'Logo/Title',
				'section'  			=> 'tvlgiao_wpdance_header_config',
				'settings' 			=> 'tvlgiao_wpdance_header_show_logo_title',
				'description'   	=> esc_html__( 'This setting is only visible to the default header template.', 'wpdancelaparis' ),
				'type'    			=> 'select',
				'choices' 			=> array(
					'0'				=> "Show Logo",
					'1'				=> "Show Site Title",
				)
			));


 			$wp_customize->add_setting('tvlgiao_wpdance_header_logo_url', array(
				'default'        	=> TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png',
				'sanitize_callback' => 'esc_url_raw',
				'type' 				=> 'theme_mod'
			));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_header_logo_url', array(
		        'label'    			=> esc_html__( 'Logo', 'wpdancelaparis' ),
		        'section'  			=> 'tvlgiao_wpdance_header_config',
		        'settings' 			=> 'tvlgiao_wpdance_header_logo_url',
		        'description'   	=> esc_html__( 'Footer logo is only visible to the default header template.', 'wpdancelaparis' ),
		    )));

		    // Show Logo / Title
			$wp_customize->add_setting('tvlgiao_wpdance_header_menu_location', array(
				'default'        	=> 'primary',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_header_menu_location_control', array(
				'label'   			=> 'Select Menu Locations',
				'section'  			=> 'tvlgiao_wpdance_header_config',
				'settings' 			=> 'tvlgiao_wpdance_header_menu_location',
				'description'   	=> esc_html__( 'This setting is only visible to the default header template.', 'wpdancelaparis' ),
				'type'    			=> 'select',
				'choices' 			=> array(
					'primary' 			=> esc_html__('Primary Menu', 'wpdancelaparis'),
			        'primary_right' 	=> esc_html__('Secondary Menu', 'wpdancelaparis'),
			        'primary_mobile' 	=> esc_html__('Mobile Menu', 'wpdancelaparis'),
				)
			));

			
		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_header' );
?>