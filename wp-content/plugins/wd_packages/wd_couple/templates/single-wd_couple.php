<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Wordpress
 */
?>
<?php get_header(); ?>

<?php
	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	//Set Post View
	tvlgiao_wpdance_set_post_views($post_ID);
	//Post Config
	$_post_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_post_config', true);
	$_post_config 	= unserialize($_post_config);
	$post_layout 	= $_post_config['layout'];
	//Customize Config
	$layout 		= get_theme_mod('tvlgiao_wpdance_single_blog_layout','0-1-0');
	if($post_layout != "0"){
		$layout 	= $post_layout;
	}
	$sidebar_left 	= get_theme_mod('tvlgiao_wpdance_single_blog_sidebar_left','sidebar');
	$sidebar_right 	= get_theme_mod('tvlgiao_wpdance_single_blog_sidebar_right','sidebar');
	$row_class 		= '';
	$row_class_1 	= '';
	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_class = "col-sm-18";
		$row_class_1 ="row";
	}elseif($layout == '1-0-1'){
		$content_class = "col-sm-12";
		$row_class_1 ="row";
	}else{
		$content_class = "col-sm-24";
		$row_class ="row";
	}
?>
<?php
	$image_1 = get_theme_mod( 'tvlgiao_wpdance_custom_couple_image1', WDC_IMAGE.'/icon_flower_couple.png' );
	$image_2 = get_theme_mod( 'tvlgiao_wpdance_custom_couple_image2', WDC_IMAGE.'/Store_h3_1.png' );
?>
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="<?php echo esc_attr($row_class_1); ?>">
			<!-- Left Content -->
			<?php if( ($layout == '1-0-0') || ($layout == '1-0-1') ) : ?> 
				<div class="col-sm-6">							
					<?php if (is_active_sidebar($sidebar_left) ) : ?>
						<?php dynamic_sidebar( $sidebar_left ); ?>
					<?php endif; ?>
				</div>
			<?php endif; // Endif Left?>
			
			<!-- Content Single Post -->
				<div class="<?php echo esc_attr($content_class); ?>">
					<div class="<?php echo esc_attr($row_class); ?>">
						<div class="wd-content-single">
							<!-- Couple Info -->
							<section id="couple-info-single">
								<div class="wpb_single_image wpb_content_element vc_align_center  wpb_animate_when_almost_visible wpb_appear appear wpb_start_animation animated">
									<div class="vc_single_image-wrapper">
										<img width="249" height="75" src="<?php echo esc_url($image_1); ?>" class="vc_single_image-img attachment-large" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
									</div>
								</div>
								<h2  class="vc_custom_heading wp_title wpb_animate_when_almost_visible wpb_appear appear wpb_start_animation animated text-center"><?php esc_html_e('Mr &amp; Mrs', 'wpdancebrial') ?></h2>
								
								<div class="wd-couple-info style-01">
									<?php
										$data_couple = get_post($post_ID);
										$meta_couple = get_post_meta($post_ID,'_tvlgiao_wpdance_custom_couple',true);
										$meta_couple = unserialize(base64_decode($meta_couple));
										if (!$image_2 && has_post_thumbnail($post_ID)) {
											$image_url = wp_get_attachment_image_src(get_post_thumbnail_id( $id_couple ), "full");
											$image_2 	= $image_url[0];
										}
										
									?>
									<div class="wd-couple-content">
										<div class="wd-couple-bridal">
											<?php $image = wp_get_attachment_image_src( $meta_couple['wd_bridal_file_url'], 'full' ); ?>
											<img alt="<?php echo esc_attr(get_the_title());?>" title="<?php echo esc_attr(get_the_title());?>" class="img" src="<?php echo esc_url($image[0]) ?>" />
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
											<img alt="<?php echo esc_attr(get_the_title());?>" title="<?php echo esc_attr(get_the_title());?>" class="img" src="<?php echo esc_url($image_2)?>" />
										</div>
										<div class="wd-couple-groom">

											<?php $image = wp_get_attachment_image_src( $meta_couple['wd_groom_file_url'], 'full' ); ?>
											<img alt="<?php echo esc_attr(get_the_title());?>" title="<?php echo esc_attr(get_the_title());?>" class="img" src="<?php echo esc_url($image[0])?>" />
											
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
								</div>
							</section>
							<!-- End Couple Info -->
							
							<!-- Couple Gallery -->
							<section id="couple-gallery-single">
								<?php
									$data_couple    = get_post($post_ID);
									$image_gallery 	= get_post_meta( $post_ID, '_wd_couple_image_gallery', true );
									$attachments 	= array_filter( explode( ',', $image_gallery ) );
									$span_class 	= "col-sm-6";
									$number_image   = 8
								?>
								<?php if ($attachments): ?>
									<div class="wpb_single_image wpb_content_element vc_align_center  wpb_animate_when_almost_visible wpb_appear appear wpb_start_animation animated">
										<div class="vc_single_image-wrapper">
											<img width="249" height="75" src="<?php echo esc_url($image_1); ?>" class="vc_single_image-img attachment-large" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
										</div>
									</div>
									<h2  class="vc_custom_heading wp_title wpb_animate_when_almost_visible wpb_appear appear wpb_start_animation animated text-center"><?php esc_html_e('Our life in pictures', 'wpdancebrial') ?></h2>

									<div class="wd-couple-gallery style_grid">
										<div class="wd-content-image <?php if($data_show == "style_masonry") echo 'grid'; ?>">
											<?php if ( $attachments ) : ?>
												<?php $count = 0; foreach ( $attachments as $attachment_id ) { ?>
													<div class="wd-content-image-item <?php echo esc_attr($span_class); ?> <?php if($data_show == "style_masonry") echo 'grid-item'; ?>">
														<?php 
															$img_gallery_url = wp_get_attachment_image_src($attachment_id, "couple_image_size_thumnail");
															$img_gallery_url_full = wp_get_attachment_image_src($attachment_id, "full");
														?>
														<div>
															<a href="<?php echo esc_url($img_gallery_url_full[0]); ?>"  rel="prettyPhoto[gallery_couple]" title="<?php the_title(); ?>" >  
																<img src="<?php echo esc_url($img_gallery_url[0]); ?>" class="attachment-couple_image_size_thumnail size-couple_image_size_thumnail" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
															</a>
														</div>
													</div>
												<?php $count++; }; ?>
											<?php endif; ?>
										</div>
									</div>
								<?php endif ?>
							</section>
							<!-- End Couple Gallery -->

							<!-- Couple Story -->
							<section id="couple-story-single">
								<?php if (get_the_content()): ?>
									<div class="wpb_single_image wpb_content_element vc_align_center  wpb_animate_when_almost_visible wpb_appear appear wpb_start_animation animated">
											<div class="vc_single_image-wrapper">
												<img width="249" height="75" src="<?php echo esc_url($image_1); ?>" class="vc_single_image-img attachment-large" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
											</div>
									</div>
									<h2  class="vc_custom_heading wp_title wpb_animate_when_almost_visible wpb_appear appear wpb_start_animation animated text-center"><?php esc_html_e('Our Story', 'wpdancebrial') ?></h2>
									<div class="wp_story">
										<?php the_content(); ?>
									</div>
								<?php endif ?>
							</section>
							<!-- End Couple Story -->

						</div>
					</div>
				</div>
			<!-- Right Content -->
			<?php if( ($layout == '0-0-1') || ($layout == '1-0-1') ) : ?> 
				<div class="col-sm-6">
					<?php if (is_active_sidebar($sidebar_right) ) : ?>
							<?php dynamic_sidebar( $sidebar_right ); ?>
					<?php endif; ?>
				</div>
			<?php endif; // Endif Right?>	
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>