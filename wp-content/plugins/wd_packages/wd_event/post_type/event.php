<?php
function register_event(){
	register_post_type('event', array(
		'labels' => array(
            'name' 				=> _x('WD Events', 'post type general name','wpdance'),
            'singular_name' 	=> _x('WD Events', 'post type singular name','wpdance'),
            'add_new' 			=> _x('Add Event', 'Event','wpdance'),
            'add_new_item' 		=> __('Add Event','wpdance'),
            'edit_item' 		=> __('Edit Event','wpdance'),
            'new_item' 			=> __('New Event','wpdance'),
            'view_item' 		=> __('View Event','wpdance'),
            'search_items' 		=> __('Search Event','wpdance'),
            'not_found' 		=>  __('No Event found','wpdance'),
            'not_found_in_trash' => __('No Event found in Trash','wpdance'),
            'parent_item_colon' => '',
            'menu_name' 		=> __('Events','wpdance'),
		),
		'singular_label' 		=> __('Event','wpdance'),
		'public' 				=> false,
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'capability_type' 		=> 'page',
		'hierarchical' 			=> false,
		'supports'  			=>  array('title','custom-fields','editor','thumbnail'),
		'has_archive' 			=> false,
		'rewrite' 				=>  array('slug'  =>  'event', 'with_front' =>  true),
		'query_var' 			=> false,
		'can_export' 			=> true,
		'show_in_nav_menus' 	=> false,
		'menu_position'			=> 23,
	));	
}
add_action('init','register_event');
?>