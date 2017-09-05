<?php
	if(!function_exists ('tvlgiao_wpdance_register_sidebar')){
		function tvlgiao_wpdance_register_sidebar(){
			register_sidebar(array(
		        'name' 				=> esc_html__('Left Sidebar', 'wpdancelaparis'),
		        'id' 				=> 'sidebar',
		        'description'   	=> esc_html__( 'Main sidebar that appears on the left.', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Right Sidebar', 'wpdancelaparis'),
		        'id' 				=> 'right_sidebar',
		        'description'   	=> esc_html__( 'Main sidebar that appears on the right.', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Left Sidebar Product', 'wpdancelaparis'),
		        'id' 				=> 'left_sidebar_product',
		        'description'   	=> esc_html__( 'Left Sidebar for single product', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Right Sidebar Product', 'wpdancelaparis'),
		        'id' 				=> 'right_sidebar_product',
		        'description'   	=> esc_html__( 'Right Sidebar for single product', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Left Sidebar Shop', 'wpdancelaparis'),
		        'id' 				=> 'left_sidebar_shop',
		        'description'   	=> esc_html__( 'Left Sidebar for shop page', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Right Sidebar Shop', 'wpdancelaparis'),
		        'id' 				=> 'right_sidebar_shop',
		        'description'   	=> esc_html__( 'Right Sidebar for shop page', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		   
		    register_sidebar(array(
		        'name' 				=> esc_html__('Header Information', 'wpdancelaparis'),
		        'id' 				=> 'header_info',
		        'description'   	=> esc_html__( 'Display only on header menu mobile', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Footer Social', 'wpdancelaparis'),
		        'id' 				=> 'footer_social',
		        'description'   	=> esc_html__( 'Display widgets on footer default template', 'wpdancelaparis' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));

		}
	}
	//Register Sidebar
	add_action('widgets_init', 'tvlgiao_wpdance_register_sidebar');
?>