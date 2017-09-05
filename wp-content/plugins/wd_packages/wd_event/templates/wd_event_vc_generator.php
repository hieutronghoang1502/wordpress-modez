<?php
# Visual Composer installed?
if (function_exists('visual_composer')) {
	if (!function_exists('wd_event_vc_shortcodes')) {
		/**
		 * Add theme's custom shortcodes to Visual Composer
		 */
		function wd_event_vc_shortcodes() {
			/****************************************************************************/
			/*							Event Member 									*/
			/****************************************************************************/
			global $post;
			$event_array = array();
			$event_array[esc_html__('Select Event','wdoutline')] = -1;
			$args = array(
					'post_type'			=> 'event'
					,'post_status'		=> 'publish'
					,'posts_per_page'	=> -1
				);
			$events = new WP_Query($args);		
			if( $events->have_posts() ){
				while( $events->have_posts() ){
					$events->the_post();
					$event_array[$post->post_title] = $post->ID;
				}
			}
			wp_reset_postdata();
			# Add shortcode Site Header
			vc_map(array(
				'name' 				=> esc_html__("Event", 'wpdancebootstrap'),
				'base' 				=> 'wd_event',
				'description' 		=> esc_html__("Display Info Event", 'wpdancebootstrap'),
				'category' 			=> esc_html__("WPDance", 'wpdancebootstrap'),
				'params' => array(
					array(
						'type' 				=> 'textfield'
						,'heading' 			=> esc_html__('Number Event', 'wdoutline' )
						,'param_name' 		=> 'number_event'
						,'admin_label' 		=> true
						,'value' 			=> ''
						,'description' 		=> ''
					)
					,array(
						'type' 			=> 'textfield',
						'class' 		=> '',
						'heading' 		=> esc_html__("Number word content", 'woocommerce'),
						'description'	=> esc_html__("", 'woocommerce'),
						'admin_label' 	=> true,
						'param_name' 	=> 'number',
						'value' 		=> '100'
					)
					,array(
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

		} // End Function Shortcode
	}
	if (!function_exists('wd_eventcountdown_vc_shortcodes')) {
		/**
		 * Add theme's custom shortcodes to Visual Composer
		 */
		function wd_eventcountdown_vc_shortcodes() {
			# Add shortcode Site Header
			global $post;
			$event_array = array();
			$event_array[esc_html__('Select Event','wdoutline')] = -1;
			$args = array(
					'post_type'			=> 'event'
					,'post_status'		=> 'publish'
					,'posts_per_page'	=> -1
				);
			$events = new WP_Query($args);		
			if( $events->have_posts() ){
				while( $events->have_posts() ){
					$events->the_post();
					$event_array[$post->post_title] = $post->ID;
				}
			}
			wp_reset_postdata();
			vc_map(array(
				'name' 				=> esc_html__("Event Countdown", 'wpdancebootstrap'),
				'base' 				=> 'wd_eventcountdown',
				'description' 		=> esc_html__("Display Countdown Event", 'wpdancebootstrap'),
				'category' 			=> esc_html__("WPDance", 'wpdancebootstrap'),
				'params' => array(
					array(
						'type' 				=> 'dropdown'
						,'heading' 			=> esc_html__( 'Select Event', 'wpdance' )
						,'param_name' 		=> 'event_id'
						,'admin_label' 		=> true
						,'value' 			=> $event_array
						,'description' 		=> ''
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

		} // End Function Shortcode
	}
}
# add theme's custom shortcodes to Visual Composer
add_action('vc_before_init', 'wd_event_vc_shortcodes');
add_action('vc_before_init', 'wd_eventcountdown_vc_shortcodes');
?>