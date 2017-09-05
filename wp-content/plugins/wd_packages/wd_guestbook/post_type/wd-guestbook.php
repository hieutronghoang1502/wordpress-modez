<?php
function wd_guestbook_register(){
	register_taxonomy( 'wd_guestbook_category', array( 'wd_guestbook' ), array(
		'hierarchical'      	=> true,
		'labels'           		 => array(
			'menu_name'         => esc_html__('Categories Guest Book' , 'wpdance' ),
			'name' 				=> esc_html__('Categories Guest Book', 'wpdance'),
			'singular_name' 	=> esc_html__('Categories Guest Book', 'wpdance'),
			'search_items'      => esc_html__('Search Guest Book', 'wpdance' ),
    		'all_items'         => esc_html__('All Guest Book', 'wpdance' ),            	
        	'new_item'          => esc_html__('Add New', 'wpdance' ),
        	'edit_item'         => esc_html__('Edit Post', 'wpdance' ),
        	'view_item'   		=> esc_html__('View Post', 'wpdance' ),
        	'add_new_item'      => esc_html__('Add New Category Guest Book', 'wpdance' ),
			'new_item_name'     => esc_html__( 'New Guest Book Name', 'wpdance' ),
		),
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true,
		'rewrite'           	=> array( 'slug' => 'wd_guestbook_category' ),				
		'public'				=> true,
	));
	register_post_type('wd_guestbook', array(
		'labels' => array(
                'name' 					=> _x('WD Guest Book', 'post type general name','wpdance'),
                'singular_name' 		=> _x('WD Guest Book', 'post type singular name','wpdance'),
                'add_new' 				=> _x('Add Guest Book','wpdance'),
                'add_new_item' 			=> __('Add Guest Book','wpdance'),
                'edit_item'				=> __('Edit Guest Book','wpdance'),
                'new_item' 				=> __('New Guest Book','wpdance'),
                'view_item' 			=> __('View Guest Book','wpdance'),
                'search_items' 			=> __('Search Guest Book','wpdance'),
                'not_found' 			=>  __('No Guest Book found','wpdance'),
                'not_found_in_trash' 	=> __('No Guest Book found in Trash','wpdance'),
                'parent_item_colon' 	=> '',
                'menu_name' 			=> __('Guest Book','wpdance'),
		),
		'singular_label' 		=> __('Guest Book','wpdance'),
		'public' 				=> false,
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'capability_type' 		=> 'page',
		'hierarchical' 			=> false,
		'supports'  			=>  array('title','thumbnail','excerpt'),
		'has_archive' 			=> false,
		'rewrite' 				=>  array('slug'  =>  'wd_guestbook', 'with_front' =>  true),
		'query_var' 			=> false,
		'can_export' 			=> true,
		'show_in_nav_menus' 	=> false,
		'menu_position'			=> 23,
	));
	
}
add_action('init','wd_guestbook_register', 0);
?>