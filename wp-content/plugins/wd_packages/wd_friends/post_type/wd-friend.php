<?php
function wd_friend_day_register(){
	register_taxonomy( 'wd_friend_category', array( 'wd_friend' ), array(
		'hierarchical'      	=> true,
		'labels'           		 => array(
			'menu_name'         => esc_html__('Categories Friend' , 'wpdance' ),
			'name' 				=> esc_html__('Categories Friend', 'wpdance'),
			'singular_name' 	=> esc_html__('Categories Friend', 'wpdance'),
			'search_items'      => esc_html__( 'Search Friend', 'wpdance' ),
    		'all_items'         => esc_html__( 'All Friend', 'wpdance' ),            	
        	'new_item'          => esc_html__('Add New', 'wpdance' ),
        	'edit_item'         => esc_html__('Edit Post', 'wpdance' ),
        	'view_item'   		=> esc_html__('View Post', 'wpdance' ),
        	'add_new_item'      => esc_html__('Add New Category Friend', 'wpdance' ),
			'new_item_name'     => esc_html__( 'New Friend Name', 'wpdance' ),
		),
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true,
		'rewrite'           	=> array( 'slug' => 'wd_friend_category' ),				
		'public'				=> true,
	));
	register_post_type('wd_friend', array(
		'labels' => array(
                'name' 					=> _x('WD Friends Say', 'post type general name','wpdance'),
                'singular_name' 		=> _x('WD Friends Say', 'post type singular name','wpdance'),
                'add_new' 				=> _x('Add Friend','wpdance'),
                'add_new_item' 			=> __('Add Friend','wpdance'),
                'edit_item'				=> __('Edit Friend','wpdance'),
                'new_item' 				=> __('New Friend','wpdance'),
                'view_item' 			=> __('View Friend','wpdance'),
                'search_items' 			=> __('Search Friend','wpdance'),
                'not_found' 			=>  __('No Friend found','wpdance'),
                'not_found_in_trash' 	=> __('No Friend found in Trash','wpdance'),
                'parent_item_colon' 	=> '',
                'menu_name' 			=> __('Friends Say','wpdance'),
		),
		'singular_label' 		=> __('Friend','wpdance'),
		'public' 				=> false,
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'capability_type' 		=> 'page',
		'hierarchical' 			=> false,
		'supports' 			 	=>  array('title','thumbnail','excerpt'),
		'has_archive' 			=> false,
		'rewrite' 				=>  array('slug'  =>  'wd_friend', 'with_front' =>  true),
		'query_var' 			=> false,
		'can_export' 			=> true,
		'show_in_nav_menus' 	=> false,
		'menu_position'			=> 23,
	));
	
}
add_action('init','wd_friend_day_register', 0);
?>