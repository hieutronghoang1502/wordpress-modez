<?php
/**
 * Shortcode: tvlgiao_wpdance_site_header
 */
if (!function_exists('tvlgiao_wpdance_site_header_function')) {
	function tvlgiao_wpdance_site_header_function($atts) {
		extract(shortcode_atts(array(
			'custom_logo_url'		=> '',
			'hide_site_title'		=> '1',
			'class' 				=> '',
		), $atts));
		
		$default_logo 		= get_template_directory_uri().'/assets/images/wpdance_logo.png';
		$logo_url 			= '';
		if($custom_logo_url != ""){
			$image	  		= wp_get_attachment_image_src($custom_logo_url,'full');
			$logo_url 		= $image[0];
		}
		if (is_wp_error($logo_url) || $logo_url == '') {
			$logo_url	  	= $default_logo; 
		}
		ob_start();
		$id_logo = 'site-logo-'.mt_rand();
		?>
		<div class="wd-shortcode-site-header header-main <?php echo esc_attr($class) ?>">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img id="<?php echo esc_attr($id_logo); ?>" class="site-logo" src='<?php echo esc_url($logo_url); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name') ); ?>' title="<?php echo esc_attr(bloginfo('name')) ?>">
			
				<?php if (!$hide_site_title): ?>
					<?php if (is_front_page() && is_home()): ?>
						<h1 class="site-title" rel="home"><?php bloginfo( 'name' ); ?></h1>
					<?php else: ?>
						<p class="site-title" rel="home"><?php bloginfo( 'name' ); ?></p>
					<?php endif ?>
				<?php endif ?>
			</a>
		</div>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_site_header', 'tvlgiao_wpdance_site_header_function');
?>