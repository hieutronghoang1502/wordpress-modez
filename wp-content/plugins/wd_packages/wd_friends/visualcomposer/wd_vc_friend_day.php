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
	'name' 				=> esc_html__("WD Friend Day", 'wpdancebootstrap'),
	'base' 				=> 'wd_friend_day',
	'description' 		=> esc_html__("Display Info Friend Day", 'wpdancebootstrap'),
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
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Style', 'wdoutline' ),
			'param_name' 	=> 'style',
			'admin_label' 	=> true,
			'value' => array(
					'Style 1'	=> 'style-1',
					'Style 2'	=> 'style-2',
					'Style 3'	=> 'style-3',
			),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Columns', 'wdoutline' ),
			'param_name' 	=> 'friend_columns',
			'admin_label' 	=> true,
			'value' => array(
				'10 Columns'	=> 'wd-colums-10',
				'15 Columns'	=> 'wd-colums-15',
			),
			'description' 	=> '',
			'dependency'	=> Array('element' => "style", 'value' => array('style-2'))
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Number Friend", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'number_friend',
			'value' 		=> '5',
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
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Auto Loop', 'wdoutline' ),
			'param_name' 	=> 'auto_loop',
			'admin_label' 	=> true,
			'value' => array(
					'No'	=> '0',
					'Yes'	=> '1',
			),
			'description' 	=> '',
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__("Time Loop", 'woocommerce'),
			'description'	=> esc_html__("", 'woocommerce'),
			'admin_label' 	=> true,
			'param_name' 	=> 'time_loop',
			'value' 		=> '3000',
			'dependency'	=> Array('element' => "auto_loop", 'value' => array('1'))
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