<?php
/**
 * Shortcode: tvlgiao_wpdance_social_profiles
 */
if(!function_exists('tvlgiao_wpdance_social_profiles_function')){
	function tvlgiao_wpdance_social_profiles_function($atts,$content){
		extract(shortcode_atts(array(
			'title'						=> '',
			'style'						=> 'style-1',
			'show_title'				=> '1',
			'show_rss'					=> '1',
			'rss_id'					=> '#',
			'show_twitter'				=> '1',
			'twitter_id'				=> '#',
			'show_facebook'				=> '1',
			'facebook_id'				=> '#',
			'show_google'				=> '1',
			'google_id'					=> '#',
			'show_pin'					=> '1',
			'pin_id'					=> '#',
			'show_youtube'				=> '1',
			'youtube_id'				=> '#',
			'show_instagram'			=> '1',
			'instagram_id'				=> '#',
			'class'						=> ''
		),$atts));
		

		ob_start();
		?>
		<div class="wd-social-icons <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $style ); ?>">
			<?php if($title != "") : ?>
				<div class="wd-title">
					<h2><?php echo esc_attr( $title ); ?></h2>
				</div>
			<?php endif; ?>
			<div class="wd-content <?php if($show_title) echo ("wd-has-title") ?>">
				<ul>
					<?php if($show_facebook == 1){?>
						<li class="icon-facebook">
							<a href="http://www.facebook.com/<?php echo esc_attr($facebook_id); ?>" target="_blank" title="<?php esc_html_e('Become our fan', 'wpdancelaparis'); ?>" >
								<i class="fa fa-facebook"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Facebook', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>				
					<?php } ?>
					<?php if($show_rss == 1){?>
						<li class="icon-rss">
							<a href="https://www.rss.com/<?php echo esc_attr($rss_id); ?>" target="_blank" title="<?php esc_html_e('Rss', 'wpdancelaparis'); ?>" >
								<i class="fa fa-rss"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Rss', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>				
					<?php } ?>
					<?php if($show_twitter == 1){?>
						<li class="icon-twitter">
							<a href="http://twitter.com/<?php echo esc_attr($twitter_id); ?>" target="_blank" title="<?php esc_html_e('Twitter', 'wpdancelaparis'); ?>" >
								<i class="fa fa-twitter"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Twitter', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>				
					<?php } ?>
					<?php if($show_google == 1){?>
						<li class="icon-google">
							<a href="https://plus.google.com/u/0/<?php echo esc_attr($google_id); ?>" target="_blank" title="<?php esc_html_e('Google', 'wpdancelaparis'); ?>" >
								<i class="fa fa-google-plus"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Google', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>				
					<?php } ?>
					<?php if($show_pin == 1){?>
						<li class="icon-pin">
							<a href="http://www.pinterest.com/<?php echo esc_attr($pin_id); ?>" target="_blank" title="<?php esc_html_e('Pin', 'wpdancelaparis'); ?>" >
								<i class="fa fa-pinterest"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Pin', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>			
					<?php } ?>
					<?php if($show_youtube == 1){?>
						<li class="icon-youtube">
							<a href="http://youtube.com/<?php echo esc_attr($youtube_id); ?>" target="_blank" title="<?php esc_html_e('Youtube', 'wpdancelaparis'); ?>" >
								<i class="fa fa-youtube"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Youtube', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>			
					<?php } ?>
					<?php if($show_instagram == 1){?>
						<li class="icon-instagram">
							<a href="http://www.instagram.com/<?php echo esc_attr($instagram_id); ?>" target="_blank" title="<?php esc_html_e('Instagram', 'wpdancelaparis'); ?>" >
								<i class="fa fa-instagram"></i>
								<?php if($show_title): ?>
									<span><?php esc_html_e('Instagram', 'wpdancelaparis'); ?></span>
								<?php endif; ?>
							</a>
						</li>				
					<?php } ?>
				</ul>
			</div>
		</div>

		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_social_profiles','tvlgiao_wpdance_social_profiles_function');
?>