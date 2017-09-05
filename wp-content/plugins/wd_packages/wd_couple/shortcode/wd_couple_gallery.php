<?php
/**
 * Shortcode: tvlgiao_wpdance_couple_gallery_image
 */
if (!function_exists('tvlgiao_wpdance_couple_gallery_image_function')) {
	function tvlgiao_wpdance_couple_gallery_image_function($atts) {
		extract(shortcode_atts(array(
			'id_couple'		=> -1,
			'data_show'		=> 'style_grid',
			'number_image'	=> '8',
			'column_image'	=> '2',
			'show_more'		=> '1',
			'view_more_link'=> '',
			'class' 		=> '',
		), $atts));
		//
		ob_start(); ?>
			<?php if($id_couple != -1) : ?>
				<?php
					$data_couple = get_post($id_couple);
					$image_gallery 	= get_post_meta( $id_couple, '_wd_couple_image_gallery', true );
					$attachments 	= array_filter( explode( ',', $image_gallery ) );
					$span_class 	= "col-sm-".(24/$column_image);
					$image_size = ($data_show == "style_masonry") ? 'full' : "couple_image_size_thumnail";
				?>
				<div class="wd-couple-gallery <?php echo esc_attr($class); ?> <?php echo esc_attr($data_show); ?>">

					<div class="wd-content-image <?php if($data_show == "style_masonry") echo 'grid'; ?>">
						<?php if ( $attachments ) : ?>
							<?php $count = 0; foreach ( $attachments as $attachment_id ) { ?>
								<?php if($count == $number_image) break; ?>
								<div class="wd-content-image-item <?php echo esc_attr($span_class); ?> <?php if($data_show == "style_masonry") echo 'grid-item'; ?>"><div>
									<?php 
										$img_gallery_url = wp_get_attachment_image_src($attachment_id, $image_size);
										$img_gallery_url_full = wp_get_attachment_image_src($attachment_id, "full"); ?>
									<a href="<?php echo esc_url($img_gallery_url_full[0]); ?>"  rel="prettyPhoto[gallery_couple]"="prettyPhoto" title="<?php the_title(); ?>" >  
										<img src="<?php echo esc_url($img_gallery_url[0]); ?>" class="attachment-couple_image_size_thumnail size-couple_image_size_thumnail" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									</a>
								</div></div>
							<?php $count++; }; ?>
						<?php endif; ?>
					</div>
					<?php if ($show_more == 1): ?>
						<div class="wd-couple-button">
							<a href="<?php echo ($view_more_link) ? get_permalink( get_page_by_path( $view_more_link ) ) : '#' ; ?>" class="button">
								<?php echo esc_html_e('View More','wpdance'); ?>
							</a>   
						</div>
					<?php endif ?>
				</div>
			<?php else: ?>
				<p class="note"><?php esc_html_e('Please select couple!','wpdance'); ?></p>
			<?php endif; ?>
			<?php if($data_show = "style_masonry") : ?>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						"use strict";
						tvlgiao_wpdance_load_isotope();
						setTimeout(
						function(){
						    tvlgiao_wpdance_load_isotope();
						}, 2000);
					});

					function tvlgiao_wpdance_load_isotope(){
						jQuery('.grid').isotope({
							itemSelector: '.grid-item',
							<?php //if($layoutmode == 'packery') : ?>
								//layoutMode: 'packery',			
							<?php //endif; ?>
							<?php //if($layoutmode == 'masonry') : ?>
								layoutMode: 'masonry',			
							<?php //endif; ?>
						});
							
						jQuery('img').load(function(){
							jQuery('.grid').isotope({
								itemSelector: '.grid-item',
								<?php //if($layoutmode == 'packery') : ?>
									//layoutMode: 'packery',			
								<?php //endif; ?>
								<?php //if($layoutmode == 'masonry') : ?>
									layoutMode: 'masonry',			
								<?php //endif; ?>		
							});
						});
					}
				</script>
			<?php endif; ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_couple_gallery_image', 'tvlgiao_wpdance_couple_gallery_image_function');
?>