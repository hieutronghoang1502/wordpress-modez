<?php
	if(!function_exists ('tvlgiao_wpdance_customize_blog')){
		function tvlgiao_wpdance_customize_blog($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM BLOG 	 						*/
			/*--------------------------------------------------------------*/
			$wp_customize->add_panel( 'tvlgiao_wpdance_layout_config', array(
		        'title' 			=> esc_html__( 'WPDANCE - Layout Setting', 'wpdancelaparis' ),
		        'description' 		=> esc_html__( 'Theme Sidebar Layout', 'wpdancelaparis'),
		        'priority' 			=> 515,
		    ));
 			
 			$wp_customize->add_section( 'tvlgiao_wpdance_genneral_blog' , array(
 				'title'       		=> esc_html__( 'Blog Config', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('', 'wpdancelaparis') ,
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 5,
 			));
 			
 			$wp_customize->add_section( 'tvlgiao_wpdance_default_blog' , array(
 				'title'       		=> esc_html__( 'Blog Default', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('Set properties for the default blog...', 'wpdancelaparis'),
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 10,
 			));


 			$wp_customize->add_section( 'tvlgiao_wpdance_archive_blog' , array(
 				'title'       		=> esc_html__( 'Archive Blog', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('', 'wpdancelaparis'),
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 20,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_single_blog' , array(
 				'title'       		=> esc_html__( 'Single Blog', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('', 'wpdancelaparis') ,
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 25,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_default_page' , array(
 				'title'       		=> esc_html__( 'Page Default', 'wpdancelaparis' ),
 				'description' 		=> esc_html__('Set properties for the default page template...', 'wpdancelaparis'),
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 30,
 			));


 			$wp_customize->add_section( 'tvlgiao_wpdance_page_404' , array(
 				'title'       		=> esc_html__( 'Page 404 Config', 'wpdancelaparis' ),
 				'description' 		=> esc_html__( '', 'wpdancelaparis'),
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 40,
 			));

 			$wp_customize->add_section( 'tvlgiao_wpdance_page_search' , array(
 				'title'       		=> esc_html__( 'Page Search Config', 'wpdancelaparis' ),
 				'description' 		=> esc_html__( '', 'wpdancelaparis'),
 				'panel'	 			=> 'tvlgiao_wpdance_layout_config',
 				'priority'    		=> 45,
 			));

 			//---------------------------------------------------------------//
 			//						Genneral Blog Config 					 //
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_title', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_title_control', array(
				'label'   			=> esc_html__( 'Show Title Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide title blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_title',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_thumbnail', array(
				'default'        	=> '0',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_thumbnail_control', array(
				'label'   			=> esc_html__( 'Placeholder Image', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Placeholder image display when post no thumbnail', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_thumbnail',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_by_post_format', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_by_post_format_control', array(
				'label'   			=> esc_html__( 'Show By Post Format', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Enable to display posts by post format (video, audio, quote, gallery ...)', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_by_post_format',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Enable",	
					'0'		=> "Disable"
				)
			));
			
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_placeholder_image', array(
				'default'        	=> '0',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_placeholder_image_control', array(
				'label'   			=> esc_html__( 'Show placeholder_image Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide placeholder_image blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_placeholder_image',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Enable",	
					'0'		=> "Disable"
				)
			));
			
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_date', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_date_control', array(
				'label'   			=> esc_html__( 'Show Date Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide date blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_date',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_author', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_author_control', array(
				'label'   			=> esc_html__( 'Show Author Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide author blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_author',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_number_comment', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_number_comment_control', array(
				'label'   			=> esc_html__( 'Show Number Comment', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide Number Comment', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_number_comment',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 


			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_category', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_category_control', array(
				'label'   			=> esc_html__( 'Show Category Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide category blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_category',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));   
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_excerpt', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_excerpt_control', array(
				'label'   			=> esc_html__( 'Show Excerpt Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide excerpt blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_excerpt',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_read_more', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_read_more_control', array(
				'label'   			=> esc_html__( 'Show Read More Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide read more blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_read_more',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));   			

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_number_excerpt',array(
		    	'default'           => '20',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_genneral_blog_number_excerpt_control',array(
            	'label'         	=> esc_html__( 'Number Excerpt Word', 'wpdancelaparis' ),
            	'settings'      	=> 'tvlgiao_wpdance_genneral_blog_number_excerpt',
            	'section'       	=> 'tvlgiao_wpdance_genneral_blog',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( '', 'wpdancelaparis' )
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
 			//Content Custom Single Blog
 			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_single_blog_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_single_blog',
            	'settings'       	=> 'tvlgiao_wpdance_single_blog_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));

			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_author_information', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_blog_author_information_control', array(
				'label'   			=> esc_html__( 'Author Information', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide Author Information', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_author_information',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 

			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_previous_next_button', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_blog_previous_next_button_control', array(
				'label'   			=> esc_html__( 'Previous/Next Button', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide Previous/Next Button', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_previous_next_button',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 

			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_recent_post', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_blog_recent_post_control', array(
				'label'   			=> esc_html__( 'Recent Blog', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide Recent Blog', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_recent_post',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));

			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_recent_post_style', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_blog_recent_post_style_control', array(
				'label'   			=> esc_html__( 'Recent Blog Style', 'wpdancelaparis' ),
				'description' 		=> esc_html__( '', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_recent_post_style',
				'type'    			=> 'select',
				'choices' 			=> array(
					'list'		=> "List",	
					'grid'		=> "Grid"
				)
			));  

			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_recent_post_is_slider', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_blog_recent_post_is_slider_control', array(
				'label'   			=> esc_html__( 'Is Slider?', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Recent Blog Is Slider?', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_recent_post_is_slider',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Yes",	
					'0'		=> "No"
				)
			)); 	

			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_recent_post_columns',array(
		    	'default'           => '2',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_single_blog_recent_post_columns_control',array(
            	'label'         	=> esc_html__( 'Columns', 'wpdancelaparis' ),
            	'settings'      	=> 'tvlgiao_wpdance_single_blog_recent_post_columns',
            	'section'       	=> 'tvlgiao_wpdance_genneral_blog',
            	'type'          	=> 'text',
            	'description'   	=> esc_html__( 'The number of columns displayed with the slider', 'wpdancelaparis' )
        	));

        	//Content Custom Archive Blog
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_blog_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_archive_blog_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_archive_blog',
            	'settings'       	=> 'tvlgiao_wpdance_archive_blog_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_blog_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_blog',
				'settings' 			=> 'tvlgiao_wpdance_archive_blog_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_archive_blog_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_blog',
				'settings' 			=> 'tvlgiao_wpdance_archive_blog_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
        	//Content Custom Default Blog
        	$wp_customize->add_setting('tvlgiao_wpdance_default_blog_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_default_blog_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_default_blog',
            	'settings'       	=> 'tvlgiao_wpdance_default_blog_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_default_blog_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_slidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_blog',
				'settings' 			=> 'tvlgiao_wpdance_default_blog_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_default_blog_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_slidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_blog',
				'settings' 			=> 'tvlgiao_wpdance_default_blog_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
        	//Content Custom Page Default
        	$wp_customize->add_setting('tvlgiao_wpdance_default_page_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_default_page_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdancelaparis' ),
            	'section'        	=> 'tvlgiao_wpdance_default_page',
            	'settings'       	=> 'tvlgiao_wpdance_default_page_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_default_page_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_page_left_sidebar_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_page',
				'settings' 			=> 'tvlgiao_wpdance_default_page_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_default_page_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_page_right_sidebar_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_page',
				'settings' 			=> 'tvlgiao_wpdance_default_page_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));

			


			/*Page 404*/
			$wp_customize->add_setting('tvlgiao_wpdance_page_404_select_style', array(
				'default'        	=> 'bg_color',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_page_404_select_style_control', array(
				'label'   			=> esc_html__( 'Background Image Or Color', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_page_404',
				'settings' 			=> 'tvlgiao_wpdance_page_404_select_style',
				'type'    			=> 'select',
				'choices' 			=> array(
					'bg_image'			=> esc_html__( 'Background Image', 'wpdancelaparis' ),
					'bg_color'			=> esc_html__( 'Background Color', 'wpdancelaparis' ),
				)
			));
			$wp_customize->add_setting( 'tvlgiao_wpdance_page_404_bg_color' , array(
				'default'           =>  "#fff",
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tvlgiao_wpdance_page_404_bg_color' , array(
				'label'      		=>  esc_html__( 'Select Color Background', 'wpdancelaparis' ),
		        'section'  			=> 'tvlgiao_wpdance_page_404',
		        'settings' 			=> 'tvlgiao_wpdance_page_404_bg_color',
			)));
 			$wp_customize->add_setting('tvlgiao_wpdance_page_404_bg_image', array(
				'default'        	=> TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg',
				'sanitize_callback' => 'esc_url_raw',
				'type' 				=> 'theme_mod'
			));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_page_404_bg_image', array(
		        'label'    			=> esc_html__('Select Background Image', 'wpdancelaparis' ),
		        'section'  			=> 'tvlgiao_wpdance_page_404',
		        'settings' 			=> 'tvlgiao_wpdance_page_404_bg_image',
		    )));

		    $wp_customize->add_setting('tvlgiao_wpdance_page_404_show_header_footer', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_page_404_show_header_footer_control', array(
				'label'   			=> esc_html__( 'Header & Footer', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_page_404',
				'settings' 			=> 'tvlgiao_wpdance_page_404_show_header_footer',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'			=> esc_html__( 'Show', 'wpdancelaparis' ),
					'0'			=> esc_html__( 'Hide', 'wpdancelaparis' ),
				)
			));

		    $wp_customize->add_setting('tvlgiao_wpdance_page_404_show_search_form', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_page_404_show_search_form_control', array(
				'label'   			=> esc_html__( 'Search Form', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide Search Form', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_page_404',
				'settings' 			=> 'tvlgiao_wpdance_page_404_show_search_form',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 

			$wp_customize->add_setting('tvlgiao_wpdance_page_404_show_back_to_home_button', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));

			$wp_customize->add_control( 'tvlgiao_wpdance_page_404_show_back_to_home_button_control', array(
				'label'   			=> esc_html__( 'Back To Home Button', 'wpdancelaparis' ),
				'description' 		=> esc_html__( 'Show/Hide Back To Home Button', 'wpdancelaparis'),
				'section'  			=> 'tvlgiao_wpdance_page_404',
				'settings' 			=> 'tvlgiao_wpdance_page_404_show_back_to_home_button',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 

			$wp_customize->add_setting('tvlgiao_wpdance_page_404_back_to_home_button_text',array(
		    	'default'           =>  esc_html__( 'Back To Homepage', 'wpdancelaparis' ),
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_page_404_back_to_home_button_text_control',array(
            	'label'         	=> esc_html__( 'Text Button', 'wpdancelaparis' ),
            	'section'       	=> 'tvlgiao_wpdance_page_404',
            	'settings'      	=> 'tvlgiao_wpdance_page_404_back_to_home_button_text',
            	'type'          	=> 'text',
            	'description'   	=> esc_html__( '', 'wpdancelaparis' )
        	));

        	$wp_customize->add_setting('tvlgiao_wpdance_page_404_back_to_home_button_class',array(
		    	'default'           =>  esc_html__( '', 'wpdancelaparis' ),
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_page_404_back_to_home_button_class_control',array(
            	'label'         	=> esc_html__( 'Class Button', 'wpdancelaparis' ),
            	'section'       	=> 'tvlgiao_wpdance_page_404',
            	'settings'      	=> 'tvlgiao_wpdance_page_404_back_to_home_button_class',
            	'type'          	=> 'text',
            	'description'   	=> esc_html__( '', 'wpdancelaparis' )
        	));

    		/*Page Search*/
			$wp_customize->add_setting('tvlgiao_wpdance_page_search_select_style', array(
				'default'        	=> 'bg_color',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_page_search_select_style_control', array(
				'label'   			=> esc_html__( 'Background Image Or Color', 'wpdancelaparis' ),
				'section'  			=> 'tvlgiao_wpdance_page_search',
				'settings' 			=> 'tvlgiao_wpdance_page_search_select_style',
				'type'    			=> 'select',
				'choices' 			=> array(
					'bg_image'			=> esc_html__( 'Background Image', 'wpdancelaparis' ),
					'bg_color'			=> esc_html__( 'Background Color', 'wpdancelaparis' ),
				)
			));
			$wp_customize->add_setting( 'tvlgiao_wpdance_page_search_bg_color' , array(
				'default'           =>  "#fff",
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tvlgiao_wpdance_page_search_bg_color' , array(
				'label'      		=>  esc_html__( 'Select Color Background', 'wpdancelaparis' ),
		        'section'  			=> 'tvlgiao_wpdance_page_search',
		        'settings' 			=> 'tvlgiao_wpdance_page_search_bg_color',
			)));
 			$wp_customize->add_setting('tvlgiao_wpdance_page_search_bg_image', array(
				'default'        	=> TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg',
				'sanitize_callback' => 'esc_url_raw',
				'type' 				=> 'theme_mod'
			));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_page_search_bg_image', array(
		        'label'    			=> esc_html__('Select Background Image', 'wpdancelaparis' ),
		        'section'  			=> 'tvlgiao_wpdance_page_search',
		        'settings' 			=> 'tvlgiao_wpdance_page_search_bg_image',
		    )));
		    
		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_blog' );
?>