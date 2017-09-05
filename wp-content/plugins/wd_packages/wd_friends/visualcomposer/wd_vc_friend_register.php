<?php
# Visual Composer installed?

/****************************************************************************/
/*							Team Member 									*/
/****************************************************************************/
global $post;
$friend_category = array();
$friend_category[esc_html__('Select Couple','wdoutline')] = -1;
if( class_exists('WD_Friend') ){
	$categories = 	get_terms( 'wd_friend_category', 
								array('hide_empty' 	=> 1)
							 );
	foreach ($categories as $category ) {
		$friend_category[$category->slug] = $category->term_id;
	}
	wp_reset_postdata();
}
wp_reset_postdata();
# Add shortcode Site Header
vc_map(array(
	'name' 				=> esc_html__("WD Friend Form Register", 'wpdancebootstrap'),
	'base' 				=> 'wd_friend_day_form_register',
	'description' 		=> esc_html__("Friend Form Register", 'wpdancebootstrap'),
	'category' 			=> esc_html__("WPDance", 'wpdancebootstrap'),
	'params' => array(
		array(
			'type' 				=> 'dropdown',
			'heading' 			=> esc_html__('Select Couple', 'wdoutline' ),
			'param_name' 		=> 'id_cate_couple',
			'admin_label' 		=> true,
			'value' 			=> $friend_category,
			'description' 		=> ''
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Title Wedding", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'title_wedding',
			'value' 		=> ''
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Time Wedding", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'time_wedding',
			'value' 		=> ''
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Bridal Name", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'bridal_wedding',
			'value' 		=> ''
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Groom Name", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'groom_wedding',
			'value' 		=> ''
		),
		array(
			'type' 			=> "attach_image",
			'class' 		=> "",
			'heading' 		=> esc_html__("Background Image", 'wdoutline'),
			'param_name' 	=> "image_url",
			'value' 		=> "",
			'description' 	=> esc_html__("", 'woocommerce'),
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Extra class name", 'woocommerce'),
			'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'class',
			'value' 		=> ''
		)
	)
));

		
?>