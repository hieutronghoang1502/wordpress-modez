<?php 
/* Favicon */
add_action('tvlgiao_wpdance_header_meta_data', 'tvlgiao_wpdance_accessibility_display_favicon');
if(!function_exists ('tvlgiao_wpdance_accessibility_display_favicon')){
	function tvlgiao_wpdance_accessibility_display_favicon(){ 
		if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
			global $tvlgiao_wpdance_theme_options;
			$icon = $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_favicon']['url'];
			if( strlen(trim($icon)) > 0 ) :?>
				<link rel="shortcut icon" href="<?php echo esc_url($icon);?>" />
			<?php endif;
		}
	}
}

/* Facebook Comment Meta */
add_action('tvlgiao_wpdance_header_meta_data', 'tvlgiao_wpdance_accessibility_facebook_comment_setting_meta');
if(!function_exists ('tvlgiao_wpdance_accessibility_facebook_comment_setting_meta')){
	function tvlgiao_wpdance_accessibility_facebook_comment_setting_meta(){ 
		$content = '';
		if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
			global $tvlgiao_wpdance_theme_options;
			$status 	= $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_comment_sorter']['facebook'];
			$user_id 	= wd_get_data_theme_option( 'tvlgiao_wpdance_comment_facebook_user_id', '100013941973162' ); 
			$app_id 	= wd_get_data_theme_option( 'tvlgiao_wpdance_comment_facebook_app_id', '325713691192544' );
			if ($status) {
				ob_start(); 
				?>
					<meta property="fb:admins" content="<?php echo esc_attr($user_id); ?>"/>
					<meta property="fb:app_id" content="<?php echo esc_attr($app_id); ?>" />
				<?php
				$content = ob_get_clean();
			}
		}
		echo $content;
	}
}

/* Facebook Comment API */
add_action('tvlgiao_wpdance_after_opening_body_tag', 'tvlgiao_wpdance_accessibility_facebook_comment_api', 5);
if(!function_exists ('tvlgiao_wpdance_accessibility_facebook_comment_api')){
	function tvlgiao_wpdance_accessibility_facebook_comment_api(){ 
		$content = '';
		if ( TVLGIAO_WPDANCE_USE_CONTROL == 'theme_option' ) {
			global $tvlgiao_wpdance_theme_options;
			$status 	= $tvlgiao_wpdance_theme_options['tvlgiao_wpdance_comment_sorter']['facebook'];
			$app_id 	= wd_get_data_theme_option( 'tvlgiao_wpdance_comment_facebook_app_id', '325713691192544' );
			if ($status) {
				ob_start(); ?>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				  	var js, fjs = d.getElementsByTagName(s)[0];
				  	if (d.getElementById(id)) return;
				  	js = d.createElement(s); js.id = id;
				  	js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=<?php echo esc_attr($app_id); ?>";
				  	fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<?php
				$content = ob_get_clean();
			}
		}
		echo $content;
	}
}

/* Loading Page Effect */
add_action('tvlgiao_wpdance_after_opening_body_tag','tvlgiao_wpdance_accessibility_loading_page_effect', 10);
if(!function_exists ('tvlgiao_wpdance_accessibility_loading_page_effect')){
	function tvlgiao_wpdance_accessibility_loading_page_effect(){ ?>
	    <div id="loader-wrapper">
			<div id="loader">
				<div id="circularG">
					<div id="circularG_1" class="circularG"></div>
					<div id="circularG_2" class="circularG"></div>
					<div id="circularG_3" class="circularG"></div>
					<div id="circularG_4" class="circularG"></div>
					<div id="circularG_5" class="circularG"></div>
					<div id="circularG_6" class="circularG"></div>
					<div id="circularG_7" class="circularG"></div>
					<div id="circularG_8" class="circularG"></div>
				</div>
			</div>
		</div>
	    <?php 
	}
}

/* Add Social Share */
add_action('wp_enqueue_scripts', 'tvlgiao_wpdance_accessibility_addthis_script', 999);
if(!function_exists ('tvlgiao_wpdance_accessibility_addthis_script')){
	function tvlgiao_wpdance_accessibility_addthis_script(){
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'social_share' ));
		if ($display_social) {
			if( is_single() || is_page_template('page-templates/template-blog.php') || ( is_category()) || is_tag() ){ 
				wp_enqueue_script( 'addthis-script', '//s7.addthis.com/js/300/addthis_widget.js#pubid='.esc_html($pubid));
			} 
		}
	}
}

/* Social Share HTML */
add_action('tvlgiao_wpdance_single_social_sharing', 'tvlgiao_wpdance_accessibility_template_single_social_sharing');
if(!function_exists ('tvlgiao_wpdance_accessibility_template_single_social_sharing')){
	function tvlgiao_wpdance_accessibility_template_single_social_sharing(){
		?>
			<div class="wd-social-share">
				<span><?php esc_html_e('Share ','wpdancelaparis'); ?></span>
				<div class="addthis_sharing_toolbox"></div>
			</div>
		<?php
	}
}

/* Back To Top Button */
add_action('tvlgiao_wpdance_footer_init_action','tvlgiao_wpdance_accessibility_scroll_button_site_function');
if(!function_exists ('tvlgiao_wpdance_accessibility_scroll_button_site_function')){
	function tvlgiao_wpdance_accessibility_scroll_button_site_function(){
		extract(tvlgiao_wpdance_get_custom_data_special_template( 'backtotop' ));
	    if($scroll_button){
	        if(!wp_is_mobile()): ?>
	            <div id="tvlgiao-back-to-top" class="scroll-button">
	                <a class="scroll-button" href="javascript:void(0)" title="<?php esc_html_e('Back to Top','wpdancelaparis');?>">
	                	<i class="<?php echo esc_attr($class_icon); ?>"></i>
	                </a>
	            </div>
	        <?php endif;
	    }
	}
}
?>