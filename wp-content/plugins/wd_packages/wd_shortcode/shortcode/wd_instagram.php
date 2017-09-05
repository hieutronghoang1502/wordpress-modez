<?php
/**
 * Shortcode: tvlgiao_wpdance_instagram
 */

if (!function_exists('tvlgiao_wpdance_instagram_function')) {
	function tvlgiao_wpdance_instagram_function($atts) {
		extract(shortcode_atts(array(
			'insta_title'			=> '',
			'insta_desc'			=> '',
			'insta_follow'			=> '1',
			'insta_follow_text'		=> 'Follow Me',
			'insta_user'			=> '',
			'insta_style'			=> "style-insta-1",
			'insta_columns'			=> "4",
			'insta_number'			=> '4',
			'insta_padding'			=> '0',
			'insta_size'			=> 'large',
			'insta_open_win'		=> '_blank',
			'is_slider'				=> '0',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'per_slide'				=> '1',
			'class' 				=> '',
		), $atts));
		$media_array = tvlgiao_wpdance_scrape_instagram($insta_user);
		ob_start(); ?>
			<?php 
			if ( is_wp_error( $media_array ) ) {
				echo esc_html( "error_log", 'wpdancelaparis' );
			} else {
				// filter for images only?
				if ( $images_only = apply_filters( 'wpiw_images_only', FALSE ) ) {
					$media_array = array_filter( $media_array, array( $this, 'images_only' ) );
				}
				// slice list down to required limit
				$media_array = array_slice( $media_array, 0, $insta_number );
				
				//count number of image (max 12)
				$num_post =  count($media_array);
				if( $num_post < 2 || $num_post <= ($per_slide * $insta_columns) ){
					$is_slider = 0;
				}
				if( $num_post <= $insta_number ){
					$insta_number = $num_post;
				}

				$size = $insta_size;
				$style_padding_item = ($insta_padding) ? 'padding:'.$insta_padding.'px;' : '' ;
				$style_wrap_item 	= ($insta_padding) ? 'margin-left:-'.$insta_padding.'px; margin-right:-'.$insta_padding.'px;' : '' ;
				$class_column 		= ( $is_slider == '0') ? 'wd-columns-'.$insta_columns : '';
				$random_id 			= ( $is_slider == '1') ? 'wd_insta_slider_'.mt_rand() : 'wd_insta_image_'.mt_rand(); ?>
				
				<div class="wd-instagram-wrapper <?php echo esc_attr($insta_style); ?> <?php echo esc_attr($class); ?>">
					<?php if ($insta_title != "" || $insta_desc != '' || $insta_follow): ?>
						<div class="wd-insta-header">
						
							<?php if($insta_title != ""): ?>
								<h2><?php echo esc_attr($insta_title); ?></h2>
							<?php endif; ?>

							<?php if($insta_desc != '' || $insta_follow) : ?> 
								<p class="wd-insta-follow">
									<?php if($insta_desc != '') : ?>
										<?php echo esc_html($insta_desc); ?>
									<?php endif; ?>
									<?php if($insta_desc != '' && $insta_follow) : ?>
										<?php _e(' | ','wpdancelaparis') ?>
									<?php endif; ?>
									<?php if($insta_follow) : ?>
										<a target="_blank" href="https://www.instagram.com/<?php echo esc_attr($insta_user);?>"><?php echo esc_html($insta_follow_text); ?></a>
									<?php endif; ?>
								</p>
							<?php endif; ?>

						</div>
					<?php endif ?>
					
					<div id="<?php echo esc_attr( $random_id ); ?>" class="wd-insta-content <?php echo esc_attr($class_column); ?>">
						<div class="wd-insta-content-wrapper">	
							<ul style="<?php echo esc_attr( $style_wrap_item ); ?>" class="wd-insta-content-item">

								<?php $count = 0; ?>
								<?php foreach ( $media_array as $item ) { ?>

									<?php if (($count == 0 || $count % $per_slide == 0) && $is_slider == '1') : ?>
										<div class="widget_per_slide">
									<?php endif; // Endif ?>

										<li style="<?php echo esc_attr( $style_padding_item ); ?>">
											<a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr($insta_open_win); ?>" >
												<img src="<?php echo esc_url( $item[$size] ); ?>" alt="<?php echo esc_attr( $item['description'] ); ?>"  title="<?php echo esc_attr( $item['description'] ); ?>"/>
											</a>
										</li>

									<?php $count++; ?>
									<?php if( ($count % $per_slide == 0 || $count == $insta_number) && $is_slider == '1' ): ?>
										</div>
									<?php endif; // Endif ?>

								<?php } // End For?>

							</ul>
						</div>

						<?php if( $show_nav && $is_slider ){ ?>
							<div class="slider_control">
								<a href="#" class="prev">&lt;</a>
								<a href="#" class="next">&gt;</a>
							</div>
						<?php } ?>
						<?php if ( $is_slider == '1') : ?>
							<script type="text/javascript">
								jQuery(document).ready(function(){
									"use strict";						
									var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
									var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
									var owl = $_this.find('.wd-insta-content-wrapper .wd-insta-content-item').owlCarousel({
										loop : true,
										items : 1,
										nav : false,
										dots : false,
										navSpeed : 1000,
										slideBy: 1,
										rtl:jQuery('body').hasClass('rtl'),
										navRewind: false,
										autoplay: _auto_play,
										autoplayTimeout: 5000,
										autoplayHoverPause: true,
										autoplaySpeed: false,
										mouseDrag: true,
										touchDrag: true,
										responsiveBaseElement: $_this,
										responsiveRefreshRate: 1000,
										responsive:{
											0:{
												items : 1
											},
											300:{
												items : 1
											},
											579:{
												items : <?php if($insta_columns > 5){echo 3;}elseif($insta_columns == 4){echo $insta_columns;}elseif($insta_columns==3){echo $insta_columns - 1;}else{echo $insta_columns;}  ?>
											},
											767:{
												items : <?php if($insta_columns > 5){echo 4;}elseif($insta_columns == 4){echo $insta_columns;}elseif($insta_columns==3){echo $insta_columns;}else{echo $insta_columns;}  ?>
											},
											1100:{
												items : <?php echo $insta_columns ?>
											}
										}
										,
										onInitialized: function(){
										}
									});
									$_this.on('click', '.next', function(e){
										e.preventDefault();
										owl.trigger('next.owl.carousel');
									});

									$_this.on('click', '.prev', function(e){
										e.preventDefault();
										owl.trigger('prev.owl.carousel');
									});
								});
							</script>
						<?php endif; // Endif Slider?>
					</div>
				</div>	

			<?php } // End if; ?>
			
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_instagram', 'tvlgiao_wpdance_instagram_function');
?>