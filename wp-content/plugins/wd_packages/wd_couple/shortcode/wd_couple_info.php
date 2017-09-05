<?php
/**
 * Shortcode: tvlgiao_wpdance_couple_info
 */
if (!function_exists('tvlgiao_wpdance_couple_info_function')) {
	function tvlgiao_wpdance_couple_info_function($atts) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'id_couple'		=> -1,
			'data_show'		=> 'style-01',
			'image_couple'	=> '',
			'show_detail'	=> '1',
			'url_type'		=> '1',
			'story_page'	=> '#',
			'show_social'	=> '1',
			'show_date'		=> '1',
			'class' 		=> '',
		), $atts));
		//
		$image_url 	= wp_get_attachment_image_src($image_couple, "couple_image_size_2");
		
		if (!$image_url && has_post_thumbnail($id_couple)) {
			$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $id_couple ), "couple_image_size_2");
		}
		$imgSrc 	= $image_url[0];

		//
		ob_start(); ?>
			<?php if($id_couple != -1) : ?>
				<?php
					$data_couple = get_post($id_couple);
					$meta_couple = get_post_meta($id_couple,'_tvlgiao_wpdance_custom_couple',true);
					$meta_couple = unserialize(base64_decode($meta_couple));
				?>
				<div class="wd-couple-info <?php echo esc_attr($class); ?> <?php echo esc_attr($data_show); ?>">
					<?php if ($title): ?>
						<div class="wd-couple-tile">
							<h2><?php echo esc_attr($title); ?></h2>
						</div>
					<?php endif ?>
					
					<div class="wd-couple-content">
						<div class="wd-couple-bridal">
							<?php $image = wp_get_attachment_image_src( $meta_couple['wd_bridal_file_url'], 'full' ); ?>
							<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($image[0]) ?>" />
							<div class="wd-couple-info">
								<h3><?php echo esc_attr($meta_couple['wd_bridal_name']); ?></h3>
								
								<span class="wd-couple-description"><?php echo esc_attr($meta_couple['wd_bridal_description']); ?></span>
								
								<div class="wd-couple-social">
									<ul>
										<li class="icon-facebook">
											<a href="<?php echo esc_url($meta_couple['wd_bridal_facebook'])?>" target="_blank" title="<?php echo esc_attr($meta_couple['wd_bridal_name']); ?>" >
												<i class="fa fa-facebook"></i><span><?php esc_html_e('Facebook', 'wpdance'); ?></span>
											</a>
											<a href="<?php echo esc_url($meta_couple['wd_bridal_twitter'])?>" target="_blank" title="<?php echo esc_attr($meta_couple['wd_bridal_name']); ?>" >
												<i class="fa fa-twitter"></i><span><?php esc_html_e('Twitter', 'wpdance'); ?></span>
											</a>
											<a href="<?php echo esc_url($meta_couple['wd_bridal_pinterest'])?>" target="_blank" title="<?php echo esc_attr($meta_couple['wd_bridal_name']); ?>" >
												<i class="fa fa-pinterest"></i><span><?php esc_html_e('Pinterest', 'wpdance'); ?></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="wd-couple-img">
							<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
						</div>
						<div class="wd-couple-groom">

							<?php $image = wp_get_attachment_image_src( $meta_couple['wd_groom_file_url'], 'full' ); ?>
							<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($image[0])?>" />
							
							<div class="wd-couple-info">
								<h3><?php echo esc_attr($meta_couple['wd_groom_name']); ?></h3>	
								
								<span class="wd-couple-description"><?php echo esc_attr($meta_couple['wd_groom_description']); ?></span>
								
								<div class="wd-couple-social">
									<ul>
										<li class="icon-facebook">
											<a href="<?php echo esc_url($meta_couple['wd_groom_facebook'])?>" target="_blank" title="<?php echo esc_attr($meta_couple['wd_groom_name']); ?>" >
												<i class="fa fa-facebook"></i><span><?php esc_html_e('Facebook', 'wpdance'); ?></span>
											</a>
											<a href="<?php echo esc_url($meta_couple['wd_groom_twitter'])?>" target="_blank" title="<?php echo esc_attr($meta_couple['wd_groom_name']); ?>" >
												<i class="fa fa-twitter"></i><span><?php esc_html_e('Twitter', 'wpdance'); ?></span>
											</a>
											<a href="<?php echo esc_url($meta_couple['wd_groom_pinterest'])?>" target="_blank" title="<?php echo esc_attr($meta_couple['wd_groom_name']); ?>" >
												<i class="fa fa-pinterest"></i><span><?php esc_html_e('Pinterest', 'wpdance'); ?></span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="wd-couple-button">
						<?php if($show_detail) : ?>
							<?php if ( $url_type == 1 ): ?>
								<?php $url = get_the_permalink( $id_couple ); ?>
							<?php else: ?>
								<?php $url = get_permalink( get_page_by_path( $story_page ) ); ?>
							<?php endif ?>
							<a href="<?php echo esc_url($url) ; ?>"><span><?php esc_html_e('READ FULL STORE','wpdance');?></span></a>
						<?php endif; ?>
						<?php if($show_date) : ?>
							<span class="wd-couple-date"><?php echo esc_attr($meta_couple['wd_groom_wedding_day']); ?></span>
						<?php endif; ?>
					</div>
				</div>
			<?php else: ?>
				<p class="note"><?php esc_html_e('Please select couple!','wpdance'); ?></p>
			<?php endif; ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_couple_info', 'tvlgiao_wpdance_couple_info_function');
?>