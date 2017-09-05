<?php 
if(!function_exists ('tvlgiao_wpdance_theme_option_get_default_data')){
	function tvlgiao_wpdance_theme_option_get_default_data(){
		return array(
		    'general'       => array(
		        'default'       => array(
	                'logo'      	=> array( 'url' => TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png' ),
	                'favicon'   	=> array( 'url' => TVLGIAO_WPDANCE_THEME_IMAGES.'/favicon.ico' ),
		        )
		    ),
		    'sidebar'       => array(
		        'default'       => array(
		            'blog_default_left'     => 'sidebar',
		            'blog_default_right'    => 'right_sidebar',
		            'blog_archive_left'     => 'sidebar',
		            'blog_archive_right'    => 'right_sidebar',
		            'blog_single_left'      => 'sidebar',
		            'blog_single_right'     => 'right_sidebar',
		            'page_default_left'     => 'sidebar',
		            'page_default_right'    => 'right_sidebar',
		            'woo_template_left'     => 'left_sidebar_shop',
		            'woo_template_right'   => 'right_sidebar_shop',
		            'archive_product_left'  => 'left_sidebar_shop',
		            'archive_product_right' => 'right_sidebar_shop',
		            'single_product_left'   => 'left_sidebar_product',
		            'single_product_right'  => 'right_sidebar_product',
		        ),
		    ),
		    'layout'       	=> array(
		    	'choose'        => array(
		    		'layout'        => array(
	                    '0-0-0' => array(
	                        'alt' => '1 Column',
	                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
	                    ),
	                    '1-0-0' => array(
	                        'alt' => '2 Column Left',
	                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
	                    ),
	                    '0-0-1' => array(
	                        'alt' => '2 Column Right',
	                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
	                    ),
	                    '1-0-1' => array(
	                        'alt' => '3 Column Middle',
	                        'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
	                    ),
	                ),
		            'columns'        => array(
				        '1' => esc_html__( '1 Columns', 'wpdancelaparis' ),
				        '2' => esc_html__( '2 Columns', 'wpdancelaparis' ),
				        '3' => esc_html__( '3 Columns', 'wpdancelaparis' ),
				        '4' => esc_html__( '4 Columns', 'wpdancelaparis' ),
				    ),
		        ),
		        'default'       => array(
		            'layout'        => '0-0-0',
		            'columns'       => '3',
		        )
	    	),
		    'breadcrumb'    => array(
		        'choose'         => array(
		            'type'              => array(
		                'breadcrumb_default'=> __( 'Background Color', 'wpdancelaparis' ),
		                'breadcrumb_banner' => __( 'Background Image', 'wpdancelaparis' ),
		                'no_breadcrumb'     => __( 'No Breadcrumb', 'wpdancelaparis' )
		            ),
		            'text_style'        => array(
		                'inline'            => __( 'Inline', 'wpdancelaparis' ),
		                'block'             => __( 'Block', 'wpdancelaparis' ),
		            ),
		            'text_align'        => array(
		                'text-center'       => __( 'Center aligned text', 'wpdancelaparis' ),
		                'text-left'         => __( 'Left aligned text', 'wpdancelaparis' ),
		                'text-right'        => __( 'Right aligned text', 'wpdancelaparis' ),
		                'text-justify'      => __( 'Justified text', 'wpdancelaparis' ),
		            ),
		        ),
		        'default'               => array(
		            'type'              => 'breadcrumb_default',
		            'bg_color'          => '#f2f2f2',
		            'background'        => array('url'  => TVLGIAO_WPDANCE_THEME_IMAGES.'/banner_breadcrumb.jpg'),
		            'height'            => array('height' => 100),
		            'text_color'        => '#212121',
		            'text_style'        => 'inline',
		            'text_align'        => 'text-center',
		        ),
		    ),
		    'back_to_top'   => array(
		        'choose'        => array(
		            'style'         => array(
		                '1'             => __( 'Icon Only', 'wpdancelaparis' ),
		                '0'             => __( 'Icon & Background', 'wpdancelaparis' ),
		            ),
		            'bg_shape'      => array(
		                '1'             => __( 'Rounded', 'wpdancelaparis' ),
		                '0'             => __( 'Square', 'wpdancelaparis' ),
		            ),
		        ),
		        'default'       => array(
		            'style'         => '1',
		            'bg_color'      => '#fff',
		            'border_color'  => '#ccc',
		            'bg_shape'      => '1',
		            'icon'          => 'el el-chevron-up',
		            'icon_color'    => '#000',
		        )
		    ),
		    'social_share'  => array(),
		    'comment'       => array(
		    	'choose'        => array(
		            'sorter'        => array(
	                    'wordpress' 	=> __( 'Wordpress Comment', 'wpdancelaparis' ),
	                    'facebook'  	=> __( 'Facebook Comment', 'wpdancelaparis' ),
	                ),
	                'mode'         	=> array(
                        '1'    			=> __( 'Multi Domain', 'wpdancelaparis' ),
                        '0'    			=> __( 'Single Domain', 'wpdancelaparis' ),
                    ),
		        ),
		        'default'       => array(
		            'sorter'        => array(
	                    'wordpress' 	=> true,
	                    'facebook'  	=> false,
	                ),
	                'single_product' 	=> false,
	                'user_id'    		=> '100013941973162',
	                'app_id'    		=> '325713691192544',
	                'number_comment' 	=> 10,
	                'mode'		 		=> '1',
		        )
	    	),
		);
	}
} ?>