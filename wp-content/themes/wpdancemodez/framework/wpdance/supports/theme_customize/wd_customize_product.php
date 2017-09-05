<?php
	if(!function_exists ('tvlgiao_wpdance_customize_product')){
		function tvlgiao_wpdance_customize_product($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM PRODUCT  						*/
			/*--------------------------------------------------------------*/
			$wp_customize->add_panel( 'tvlgiao_wpdance_product_config', array(
		        'title' 			=> esc_html__( 'WPDANCE - Product Config', 'wpdancelaparis' ),
		        'description' 		=> esc_html__( 'Theme Sidebar Layout', 'wpdancelaparis'),
		        'priority' 			=> 520,
		    ));
 			$wp_customize->add_section( 'tvlgiao_wpdance_genneral_product' , array(
 				'title'       		=> esc_html__( 'General Product Config', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('General Product Config', 'wpdancelaparis') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 5,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_archive_product' , array(
 				'title'       		=> esc_html__( 'Archive Product', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('Custom archive product page', 'wpdancelaparis'),
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 10,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_single_product' , array(
 				'title'       		=> esc_html__( 'Single Product', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('Custom single product page', 'wpdancelaparis') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 15,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_page_woocommerce' , array(
 				'title'       		=> esc_html__( 'Woocommerce Template', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('', 'wpdancelaparis') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 20,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_cart_product' , array(
 				'title'       		=> esc_html__( 'Page Cart', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('Custom page cart product', 'wpdancelaparis') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 25,
 			));

 			//---------------------------------------------------------------//
 			/*Get list sidebar*/
 			global $wp_registered_sidebars;
	  		$arr_sidebar = array();
	  		$i = 0;
	  		foreach ( $wp_registered_sidebars as $sidebar ){
	  			if($i==0){
					$default = $sidebar['id'];
					$i++;
				}
	  			$arr_sidebar[$sidebar['id']] = $sidebar['name'];
	  		}
	  		//Genneral Product Config
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_catalog_mode', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_catalog_mode_control', array(
				'label'   			=> esc_html__( 'Add To Cart Button', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Enable/Disable "Add To Cart" button on your site', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_catalog_mode',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",
					'0'		=> "Hide",	
				)
			));	

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_button_group_position', array(
				'default'        	=> 'after-content',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_button_group_position_control', array(
				'label'   			=> esc_html__( 'Button Position', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Position of the buttons: add to cart, compare, wishlist on shop loop', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_button_group_position',
				'type'    			=> 'select',
				'choices' 			=> array(
                    'after-content'    => "After Content Detail",
					'before-content'   => "Before Content Detail",
				)
			));

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_wishlist_default', array(
				'default'        	=> '0',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_disable_wishlist_default_control', array(
				'label'   			=> esc_html__( 'Wishlist Button Default', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'In some cases, the layout will have surplus wishlist buttons on single product page. Disable them to avoid errors.', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_disable_wishlist_default',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Enable",	
					'0'		=> "Disabled"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_compare_default', array(
				'default'        	=> '0',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_disable_compare_default_control', array(
				'label'   			=> esc_html__( 'Compare Button Default', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'In some cases, the layout will have surplus compare buttons on single product page. Disable them to avoid errors.', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_disable_compare_default',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Enable",	
					'0'		=> "Disabled"
				)
			));
			
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_title', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_title_control', array(
				'label'   			=> esc_html__( 'Show Title Product', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide title product', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_title',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_description', array(
				'default'        	=> '0',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_description_control', array(
				'label'   			=> esc_html__( 'Show Description Product', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Hide Product Description may not work with some cases: list view mode in the shop page, shortcode single product detail...', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_description',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_number_description_word',array(
		    	'default'           => '40',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_genneral_number_description_word_control',array(
            	'label'         	=> esc_html__( 'Number Description Word', 'wpdancelaparis' ),
            	'settings'      	=> 'tvlgiao_wpdance_genneral_number_description_word',
            	'section'       	=> 'tvlgiao_wpdance_genneral_product',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( '', 'wpdancelaparis' )
        	));

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_rating', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_rating_control', array(
				'label'   			=> esc_html__( 'Show Rating Product', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide rating product', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_rating',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_price', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_price_control', array(
				'label'   			=> esc_html__( 'Show Price Product', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide price product', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_price',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_meta', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_meta_control', array(
				'label'   			=> esc_html__( 'Show Meta Product', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide sale/featured product', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_meta',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));	 
 			$wp_customize->add_setting('tvlgiao_wpdance_genneral_product_hover_button', array(
        		'default' 			=> 'wd-hover-style-1',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_genneral_product_hover_button',array(
            	'label'          	=> esc_html__( 'Select Style Hover Product', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_genneral_product',
            	'settings'       	=> 'tvlgiao_wpdance_genneral_product_hover_button',
            	'choices'			=> array(
					'wd-hover-style-1' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/products/wd-hover-style-1.png',
				)
        	)));

 			//Content Custom Single Product
 			$wp_customize->add_setting('tvlgiao_wpdance_single_product_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_single_product_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_single_product',
            	'settings'       	=> 'tvlgiao_wpdance_single_product_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
			$wp_customize->add_setting('tvlgiao_wpdance_single_product_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_product_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_product_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_single_product_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_product_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_product_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
        	$wp_customize->add_setting('tvlgiao_wpdance_single_product_additional_image', array(
        		'default' 			=> 'bottom',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	)); 
			$wp_customize->add_control( 'tvlgiao_wpdance_single_product_additional_image_control', array(
				'label'   			=> esc_html__( 'Select the position', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_additional_image',
				'type'    			=> 'select',
				'choices' 			=> array(
					'bottom'	=> "Bottom Thumbnail Image",
					'left'		=> "Left Thumbnail Image"
				)
			));	
			$wp_customize->add_setting('tvlgiao_wpdance_single_product_thumbnail_number',array(
		    	'default'           => '3',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_single_product_thumbnail_number_control',array(
            	'label'         	=> esc_html__( 'Thumbnail Number', 'wpdancelaparis' ),
            	'settings'      	=> 'tvlgiao_wpdance_single_product_thumbnail_number',
            	'section'       	=> 'tvlgiao_wpdance_single_product',
            	'type'          	=> 'text',
            	'description'   	=> esc_html__( 'The maximum number of thumbnails appears on the slider thumbnail single product.', 'wpdancelaparis' )
        	));
        	
        	$wp_customize->add_setting('tvlgiao_wpdance_single_recently_product', array(
        		'default' 			=> '1',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_recently_product_control', array(
				'label'   			=> esc_html__( 'Show Recent Product', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_recently_product',
				'type'    			=> 'select',
				'choices' 			=> array(
					'0'	=> "Hide",
					'1'	=> "Show"
				)
			));	
			$wp_customize->add_setting('tvlgiao_wpdance_single_upsell_product', array(
        		'default' 			=> '0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_upsell_product_control', array(
				'label'   			=> esc_html__( 'Upsell Product', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_upsell_product',
				'type'    			=> 'select',
				'choices' 			=> array(
					'0'	=> "Hide",
					'1'	=> "Show"
				)
			));	
        	$wp_customize->add_setting('tvlgiao_wpdance_single_product_full_width', array(
        		'default' 			=> '0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_product_full_width_control', array(
				'label'   			=> esc_html__( 'Full Content Detail', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_product_full_width',
				'type'    			=> 'select',
				'description'   	=> esc_html__( 'If you want full width detail, you must select layout the full width', 'wpdancelaparis' ),
				'choices' 			=> array(
					'0'	=> "NOT FULL",
					'1'	=> "FULL"
				)
			));						
        	//Content Custom Archive Product
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_product_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_archive_product_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_archive_product',
            	'settings'       	=> 'tvlgiao_wpdance_archive_product_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_product_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_single_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_product',
				'settings' 			=> 'tvlgiao_wpdance_archive_product_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_archive_product_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_single_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_product',
				'settings' 			=> 'tvlgiao_wpdance_archive_product_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
	  		// Text Copyright 
			$wp_customize->add_setting('tvlgiao_wpdance_archive_number_perpage',array(
		    	'default'           => '15',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_archive_number_perpage_control',array(
            	'label'         	=> esc_html__( 'Number Product Of Page', 'wpdancelaparis' ),
            	'settings'      	=> 'tvlgiao_wpdance_archive_number_perpage',
            	'section'       	=> 'tvlgiao_wpdance_archive_product',
            	'description'   	=> esc_html__( '', 'wpdancelaparis' )
        	));
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_columns_product', array(
        		'default' 			=> '3',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_columns_product', array(
				'label'   			=> esc_html__( 'Columns Product', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_archive_product',
				'settings' 			=> 'tvlgiao_wpdance_archive_columns_product',
				'type'    			=> 'select',
				'choices' 			=> array(
					'2'	=> esc_html__( '2 Columns', 'wpdancelaparis' ),
					'3'	=> esc_html__( '3 Columns', 'wpdancelaparis' ),
					'4'	=> esc_html__( '4 Columns', 'wpdancelaparis' ),
				)
			));


			/*Page Woocommerce*/
			$wp_customize->add_setting('tvlgiao_wpdance_page_woocommerce_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_page_woocommerce_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_page_woocommerce',
            	'settings'       	=> 'tvlgiao_wpdance_page_woocommerce_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_page_woocommerce_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_woocommerce_page_left_sidebar_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_page_woocommerce',
				'settings' 			=> 'tvlgiao_wpdance_page_woocommerce_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_page_woocommerce_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_woocommerce_page_right_sidebar_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_page_woocommerce',
				'settings' 			=> 'tvlgiao_wpdance_page_woocommerce_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));

			//Page Cart
			$wp_customize->add_setting('tvlgiao_wpdance_cart_shortcode',array(
		    	'default'           => '',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_cart_shortcode_control',array(
            	'label'         	=> esc_html__( 'Shortcode Cart', 'wpdancelaparis' ),
            	'settings'      	=> 'tvlgiao_wpdance_cart_shortcode',
            	'section'       	=> 'tvlgiao_wpdance_cart_product',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( '', 'wpdancelaparis' )
        	));	
		}
	}
	$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
	if ( in_array( "woocommerce/woocommerce.php", $_actived ) ) {
		add_action('customize_register','tvlgiao_wpdance_customize_product' );
	}
?>