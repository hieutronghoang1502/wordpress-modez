<?php
# Visual Composer installed?

/****************************************************************************/
/*							Team Member 									*/
/****************************************************************************/
global $post;
$all_friend = array();
$all_friend[esc_html__('Select Friend','wdoutline')] = -1;
if( class_exists('WD_Friend') ){
	$args = array( 'post_type' 	=> 'wd_friend','posts_per_page' => -1, );
	$friends = get_posts( $args );
	foreach ($friends as $post ) { 
		setup_postdata( $post );
		$all_friend[get_the_title()] = $post->ID;
	}
	wp_reset_postdata();
}
wp_reset_postdata();
# Add shortcode Site Header
vc_map(array(
	'name' 				=> esc_html__("WD Friend Say", 'wpdancebootstrap'),
	'base' 				=> 'wd_friend_say',
	'description' 		=> esc_html__("Display Info Friend Say", 'wpdancebootstrap'),
	'category' 			=> esc_html__("WPDance", 'wpdancebootstrap'),
	'params' => array(
		array(
			'type' 				=> 'dropdown',
			'heading' 			=> esc_html__('Select Friend', 'wdoutline' ),
			'param_name' 		=> 'id_friend_day',
			'admin_label' 		=> true,
			'value' 			=> $all_friend,
			'description' 		=> ''
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Style', 'wdoutline' ),
			'param_name' 	=> 'style',
			'admin_label' 	=> true,
			'value' => array(
					'Style 1'	=> 'style-1',
					'Style 2'	=> 'style-2',
			),
			'description' 	=> '',
		),

		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Number word content", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'number',
			'value' 		=> '100'
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