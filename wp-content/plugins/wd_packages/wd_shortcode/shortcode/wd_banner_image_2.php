<?php
/**
 * Shortcode: tvlgiao_wpdance_banner_image_2
 */

if (!function_exists('tvlgiao_wpdance_banner_image_2_function')) {
	function tvlgiao_wpdance_banner_image_2_function($atts) {
		extract(shortcode_atts(array(
			'type'				=> 'image',
			'banner_image'		=> '',
			'slider_image'		=> '',
			'slider_columns'	=> '1',
			'image_size'		=> 'full',
			'video_id'			=> '',
			'video_width'		=> 570,
			'video_height'		=> 400,
			'video_autoplay'	=> 0,
			'heading_line_1'	=> '',
			'heading_line_2'	=> "",
			'show_line'			=> '1',
			'description'		=> '',
			'position_content'	=> 'center',
			'border_content'	=> '1',
			'show_button'		=> '1',
			'button_style'		=> 'style-1',
			'link_type'			=> 'category_link',
			'url'				=> '#',
			'id_category' 		=> '',
			'button_text' 		=> 'View Category',
			'button_class' 		=> '',
			'class' 			=> ''
		), $atts));
		
		$type_class = ($type == 'video') ? 'wd-banner-plus-video' : 'wd-banner-plus-image';
		if ($link_type == 'category_link') {
			$link_url = ($id_category != '') ? ($id_category == -1) ? get_permalink( wc_get_page_id( 'shop' ) ) : get_term_link( get_term_by( 'id', $id_category, 'product_cat' ), 'product_cat' ) : '#';
		}else{
			$link_url = $url;
		}
		$position_content_class = 'wd-banner-image-position-content-'.$position_content;
		$button_style_class 	= 'wd-banner-image-button-'.$button_style;
		$border_content_class   = ($border_content == 1) ? 'wd-banner-plus-with-border_content' : '';
		$title_image			= get_bloginfo('name');

		$slider_random_id = 'wd_slider_plus_content_'.mt_rand();
		ob_start(); ?>
			<div class="wd-shortcode-banner-plus <?php echo esc_attr($class); ?> <?php echo esc_attr($position_content_class); ?>">
				<?php if ($position_content == 'outside-right' || $position_content == 'inside-right'): ?>
					<div class="<?php echo esc_attr($type_class); ?>">
						<?php if ($type == 'image'): ?>
							<?php 
							if ($banner_image) {
								$image_url 	= wp_get_attachment_image_src($banner_image, $image_size);
								$imgSrc 	= $image_url[0];
							} else  {
								$imgSrc = '';
							} ?>
							<?php if ($imgSrc != ''): ?>
								<img alt="<?php echo esc_attr($title_image); ?>" title="<?php echo esc_attr($title_image); ?>" class="img" src="<?php echo esc_url($imgSrc); ?>" />
							<?php endif ?>
						<?php elseif ($type == 'video'): ?>
							<?php if ($video_id != ''): ?>
								<iframe width="<?php echo esc_html($video_width); ?>px" height="<?php echo esc_html($video_height); ?>px" src="https://www.youtube.com/embed/<?php echo esc_html($video_id); ?>?autoplay=<?php echo esc_html($video_autoplay); ?>&showinfo=0&controls=0&rel=0" frameborder="0" allowfullscreen></iframe>
							<?php endif ?>	
						<?php elseif ($type == 'slider'): ?>
							<div id="<?php echo esc_attr($slider_random_id); ?>" >
								<?php 
								$banner_image = array();
								if ($slider_image) {
									$slider_image = explode(',', $slider_image);
									foreach ($slider_image as $image) {
										$image_url 	= wp_get_attachment_image_src($image, $image_size);
										$imgSrc 	= $image_url[0]; ?>
										<img alt="<?php echo esc_attr($title_image); ?>" title="<?php echo esc_attr($title_image); ?>" class="img" src="<?php echo esc_url($imgSrc); ?>" />
									<?php
									}
								}
								?>
							</div>
						<?php endif ?>
					</div>			
				<?php endif ?>
				
				<div class="wd-banner-plus-body <?php echo esc_attr($border_content_class); ?>">
					<?php if ($position_content == 'center' && ($banner_image != '' || $slider_image != '' || $video_id)): ?>
						<!-- Show banner image -->
						<div class="wd-banner-plus-image">
							<?php if ($type == 'image'): ?>
								<?php 
								if ($banner_image) {
									$image_url 	= wp_get_attachment_image_src($banner_image, $image_size);
									$imgSrc 	= $image_url[0];
								} else  {
									$imgSrc = '';
								} ?>
								<?php if ($imgSrc != ''): ?>
									<img alt="<?php echo esc_attr($title_image); ?>" title="<?php echo esc_attr($title_image); ?>" class="img" src="<?php echo esc_url($imgSrc); ?>" />
								<?php endif ?>
							<?php elseif ($type == 'video'): ?>
								<?php if ($video_id != ''): ?>
									<iframe width="<?php echo esc_html($video_width); ?>px" height="<?php echo esc_html($video_height); ?>px" src="https://www.youtube.com/embed/<?php echo esc_html($video_id); ?>?autoplay=<?php echo esc_html($video_autoplay); ?>&showinfo=0&controls=0&rel=0" frameborder="0" allowfullscreen></iframe>
								<?php endif ?>	
							<?php elseif ($type == 'slider'): ?>
								<div id="<?php echo esc_attr($slider_random_id); ?>" >
									<?php 
									$banner_image = array();
									if ($slider_image) {
										$slider_image = explode(',', $slider_image);
										foreach ($slider_image as $image) {
											$image_url 	= wp_get_attachment_image_src($image, $image_size);
											$imgSrc 	= $image_url[0]; ?>
											<img alt="<?php echo esc_attr($title_image); ?>" title="<?php echo esc_attr($title_image); ?>" class="img" src="<?php echo esc_url($imgSrc); ?>" />
										<?php
										}
									}
									?>
								</div>
							<?php endif ?>
						</div>			
					<?php endif ?>
					
					<!-- Content heading... -->
					<?php if( $heading_line_1 != '' || $heading_line_2 != '' || $description != '' || $show_button == '1' ):?>
						<div class="wd-banner-plus-text">
							<?php if ($heading_line_1 != ''): ?>
								<h2 class="wd-banner-plus-heading-1"><?php echo esc_html($heading_line_1); ?></h2>
							<?php endif ?>
							
							<?php if ($heading_line_2 != ''): ?>
								<h3 class="wd-banner-plus-heading-2"><?php echo esc_html($heading_line_2); ?></h3>
							<?php endif ?>
							
							<?php if ($show_line == '1'): ?>
								<hr class="wd-banner-plus-line" />
							<?php endif ?>
							
							<?php if ($description != ''): ?>
								<h3 class="wd-banner-plus-description"><?php echo esc_html($description); ?></h3>
							<?php endif ?>

							<?php if($show_button == '1'):?>
								<div class="wd-banner-plus-button">
									<a class="<?php echo esc_attr($button_style_class); ?> <?php echo esc_attr($button_class); ?>" href="<?php echo esc_url($link_url); ?>" title="<?php echo esc_attr($title_image); ?>"><?php echo esc_attr($button_text); ?></a>
								</div>
							<?php endif;?>
						</div>
					<?php endif ?>
				</div>
				
				<?php if ( $position_content == 'outside-left' || $position_content == 'inside-left' ): ?>
					<div class="<?php echo esc_attr($type_class); ?>">
						<?php if ($type == 'image'): ?>
							<?php 
							if ($banner_image) {
								$image_url 	= wp_get_attachment_image_src($banner_image, $image_size);
								$imgSrc 	= $image_url[0];
							} else  {
								$imgSrc = '';
							} ?>
							<?php if ($imgSrc != ''): ?>
								<img alt="<?php echo esc_attr($title_image); ?>" title="<?php echo esc_attr($title_image); ?>" class="img" src="<?php echo esc_url($imgSrc); ?>" />
							<?php endif ?>
						<?php elseif ($type == 'video'): ?>
							<?php if ($video_id != ''): ?>
								<iframe width="<?php echo esc_html($video_width); ?>px" height="<?php echo esc_html($video_height); ?>px" src="https://www.youtube.com/embed/<?php echo esc_html($video_id); ?>?autoplay=<?php echo esc_html($video_autoplay); ?>&showinfo=0&controls=0&rel=0" frameborder="0" allowfullscreen></iframe>
							<?php endif ?>	
						<?php elseif ($type == 'slider'): ?>
							<div id="<?php echo esc_attr($slider_random_id); ?>" >
								<?php 
								$banner_image = array();
								if ($slider_image) {
									$slider_image = explode(',', $slider_image);
									foreach ($slider_image as $image) {
										$image_url 	= wp_get_attachment_image_src($image, $image_size);
										$imgSrc 	= $image_url[0]; ?>
										<img alt="<?php echo esc_attr($title_image); ?>" title="<?php echo esc_attr($title_image); ?>" class="img" src="<?php echo esc_url($imgSrc); ?>" />
									<?php
									}
								}
								?>
							</div>
						<?php endif ?>
					</div>				
				<?php endif ?>		
			</div>
			<?php if ($type == 'slider'): ?>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						"use strict";	
						var $_this = jQuery('#<?php echo esc_attr( $slider_random_id ); ?>');
						var owl = $_this.owlCarousel({
							item : 3,
							responsive		:{
								0:{
									items: 1
								},
								480:{
									items: <?php echo esc_attr( $slider_columns ); ?>
								},
								768:{
									items: <?php echo esc_attr( $slider_columns ); ?>
								},
								992:{
									items: <?php echo esc_attr( $slider_columns ); ?>
								},
								1200:{
									items: <?php echo esc_attr( $slider_columns ); ?>
								}
							},
							nav 			: true,
							navText			: [ '<', '>' ],
							autoplay 		: true,
							autoplayTimeout : 3000,
							dots			: false,
							loop			: true,
							lazyload		: true,
							onInitialized: function(){
								$_this.addClass('loaded').removeClass('loading');
							}
						});
					});	
				</script>
			<?php endif ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_banner_image_2', 'tvlgiao_wpdance_banner_image_2_function');
?>