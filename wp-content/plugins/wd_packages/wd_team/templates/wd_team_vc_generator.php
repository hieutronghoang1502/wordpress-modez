<?php
# Visual Composer installed?
if (function_exists('visual_composer')) {
	if (!function_exists('wd_team_vc_shortcodes')) {
		/**
		 * Add theme's custom shortcodes to Visual Composer
		 */
		function wd_team_vc_shortcodes() {
			/****************************************************************************/
			/*							Team Member 									*/
			/****************************************************************************/
			global $post;
			$team_member_array = array();
			$team_member_array[esc_html__('Select Teammember','wpdancelaparis')] = -1;
			$args = array(
					'post_type'			=> 'team',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1
				);
			$members = new WP_Query($args);		
			if( $members->have_posts() ){
				while( $members->have_posts() ){
					$members->the_post();
					$team_member_array[$post->post_title] = $post->ID;
				}
			}
			wp_reset_postdata();
			# Add shortcode Site Header
			vc_map(array(
				'name' 				=> esc_html__("WD - Team Memmber", 'wpdancelaparis'),
				'base' 				=> 'wd_team_member',
				'description' 		=> esc_html__("Display Info Team Member", 'wpdancelaparis'),
				'category' 			=> esc_html__("WPDance Shortcode", 'wpdancelaparis'),
				'icon'        		=> 'icon-wpb-ninjaforms',
				'params' => array(
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> esc_html__( 'Slider Or One Teammember', 'wpdancelaparis' ),
						'param_name' 		=> 'slider_or_one',
						'admin_label' 		=> true,
						'value' => array(
								'One Teammeber'		=> '1',
								'Slider'			=> '0'
								
							),
						'description' 		=> ''
					),
					array(
						'type' 				=> 'dropdown',
						'heading' 			=> esc_html__('Select Team', 'wpdancelaparis' ),
						'param_name' 		=> 'id_team',
						'admin_label' 		=> true,
						'value' 			=> $team_member_array,
						'description' 		=> '',
						'dependency'		=> Array('element' => "slider_or_one", 'value' => array('1'))
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Style', 'wpdancelaparis' ),
						'param_name' 	=> 'style',
						'admin_label' 	=> true,
						'value' => array(
								'Style 1'	=> 'style-1',
								'Style 2'	=> 'style-2',
								'Style 3'	=> 'style-3',
								'Style 4'	=> 'style-4',
								'Style 5'	=> 'style-5',
								'Style 6'	=> 'style-6',
								'Style 7'	=> 'style-7'
						),
						'description' 	=> '',
						'dependency'		=> Array('element' => "slider_or_one", 'value' => array('1'))
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> esc_html__("Number Teammember", 'wpdancelaparis'),
						'description'	=> esc_html__("", 'wpdancelaparis'),
						'admin_label' 	=> true,
						'param_name' 	=> 'number_teammember',
						'value' 		=> '5',
						'dependency'	=> Array('element' => "slider_or_one", 'value' => array('0'))
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> esc_html__("Number word content", 'wpdancelaparis'),
						'description'	=> esc_html__("", 'wpdancelaparis'),
						'admin_label' 	=> true,
						'param_name' 	=> 'number',
						'value' 		=> '100'
					),
					array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> esc_html__("Extra class name", 'wpdancelaparis'),
						'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdancelaparis'),
						'admin_label' 	=> true,
						'param_name' 	=> 'class',
						'value' 		=> ''
					)
				)
			));

		} // End Function Shortcode
	}
}
# add theme's custom shortcodes to Visual Composer
add_action('vc_before_init', 'wd_team_vc_shortcodes');
?>