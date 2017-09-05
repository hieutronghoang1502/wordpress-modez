<?php 
/*--------------------------------------------------------------*/
/*						 BLOG CONTENT	 						*/
/*--------------------------------------------------------------*/

/**
 * Show article content with customization in the Theme Option
 * $post_format : 'gallery', 'image', 'video', 'audio', 'quote', 'link'
 * $custom_placeholder_set (true or false) : If you do not adjust this parameter, the blog will get the default settings in the Blog Config
 */  
function tvlgiao_wpdance_get_content_blog( $thumbnail_size = 'full', $post_format = '', $custom_placeholder_set = '', $custom_class = '' ) {
	extract(tvlgiao_wpdance_get_custom_data_special_template( 'content-blog' ));
	$placeholder_image = (is_bool($custom_placeholder_set)) ? $custom_placeholder_set : $placeholder_image;
	ob_start();
	global $post;
	if ($post_format == 'aside') { ?>
		<div class="wd-content-post-format-aside <?php echo esc_attr($custom_class); ?>">
			<div class="col-xs-24 col-sm-6 col-md-4 text-center">
				<?php if( tvlgiao_wpdance_get_attachment() ): ?>
					<div class="aside-featured background-image" style="background-image: url(<?php echo tvlgiao_wpdance_get_attachment('full', 1, $placeholder_image); ?>);"></div>
				<?php endif; ?>
			</div>
			<div class="col-xs-24 col-sm-18 col-md-20">
				<header class="wd-post-entry-header">	
					<div class="wd-info-post">
						<!-- Show Post Title -->
						<?php tvlgiao_wpdance_display_post_title($show_title); ?>
					</div>
				</header>
				<div class="wd-post-entry-content">
					<!-- Show Post Excerpt -->
					<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt); ?>
					<!-- Show Readmore Button -->
					<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
				</div><!-- .entry-content -->
			</div>
		</div>
	<?php
	} elseif ($post_format == 'audio') { ?>
		<div class="wd-content-post-format-audio <?php echo esc_attr($custom_class); ?>">
			<?php echo tvlgiao_wpdance_get_embedded_media( array('audio','iframe'), '50%' ); ?>
			<div class="wd-info-post">
				<!-- Show Post Title -->
				<?php tvlgiao_wpdance_display_post_title($show_title); ?>
				<div class="wd-meta-post">
					<!-- Sticky Post -->
					<?php tvlgiao_wpdance_display_post_sticky(); ?>
					<!-- Show Post Author -->
					<?php tvlgiao_wpdance_display_post_author($show_author); ?>
					<!-- Show Post Category -->
					<?php tvlgiao_wpdance_display_post_category($show_category); ?>
					<!-- Show Post Date -->
					<?php tvlgiao_wpdance_display_post_date($show_date); ?>
					<!-- Show Number Comment -->
					<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
				</div>
				<!-- Show Post Excerpt -->
				<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt); ?>
				<!-- Show Readmore Button -->
				<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
			</div>
		</div>
	<?php
	} elseif ($post_format == 'gallery') { ?>
		<div class="wd-content-post-format-gallery <?php echo esc_attr($custom_class); ?>">
			<?php if( tvlgiao_wpdance_get_attachment() ): ?>
				<div id="post-gallery-<?php the_ID(); ?>" class="carousel slide wd-carousel-thumb" data-ride="carousel">
					<div class="carousel-inner" role="listbox">
						<?php 
							$attachments = tvlgiao_wpdance_get_bs_slides( tvlgiao_wpdance_get_attachment($thumbnail_size, 5), $thumbnail_size );
							foreach( $attachments as $attachment ):
						?>
							<div class="item<?php echo $attachment['class']; ?> background-image standard-featured" style="background-image: url( <?php echo $attachment['url']; ?> );">
								
								<div class="hide next-image-preview" data-image="<?php echo $attachment['next_img']; ?>"></div>
								<div class="hide prev-image-preview" data-image="<?php echo $attachment['prev_img']; ?>"></div>
								
								<div class="entry-excerpt image-caption">
									<p><?php echo $attachment['caption']; ?></p>
								</div>
								
							</div>
						
						<?php endforeach; ?>
						
					</div><!-- .carousel-inner -->
					
					<a class="left carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="prev">
						<div class="table">
							<div class="table-cell">
								
								<div class="preview-container">
									<span class="thumbnail-container background-image"></span>
									<i class="fa fa-angle-left" aria-hidden="true"></i>
									<span class="sr-only">Previous</span>
								</div><!-- .preview-container -->
								
							</div><!-- .table-cell -->
						</div><!-- .table -->
					</a>
					<a class="right carousel-control" href="#post-gallery-<?php the_ID(); ?>" role="button" data-slide="next">
						<div class="table">
							<div class="table-cell">
								
								<div class="preview-container">
									<span class="thumbnail-container background-image"></span>
									<i class="fa fa-angle-right" aria-hidden="true"></i>
									<span class="sr-only">Next</span>
								</div><!-- .preview-container -->
								
							</div><!-- .table-cell -->
						</div><!-- .table -->
					</a>
					
				</div><!-- .carousel -->
			<?php endif; ?>
			<div class="wd-info-post">
				<!-- Show Post Title -->
				<?php tvlgiao_wpdance_display_post_title($show_title); ?>
				<div class="wd-meta-post">
					<!-- Sticky Post -->
					<?php tvlgiao_wpdance_display_post_sticky(); ?>
					<!-- Show Post Author -->
					<?php tvlgiao_wpdance_display_post_author($show_author); ?>
					<!-- Show Post Category -->
					<?php tvlgiao_wpdance_display_post_category($show_category); ?>
					<!-- Show Post Date -->
					<?php tvlgiao_wpdance_display_post_date($show_date); ?>
					<!-- Show Number Comment -->
					<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
				</div>
				<!-- Show Post Excerpt -->
				<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt); ?>
				<!-- Show Readmore Button -->
				<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
			</div>
		</div>
	<?php
	} elseif ($post_format == 'image') { ?>
		<div class="wd-content-post-format-image <?php echo esc_attr($custom_class); ?>" style="background-image: url(<?php echo tvlgiao_wpdance_get_attachment(); ?>);">
			<div class="wd-info-post">
				<!-- Show Post Title -->
				<?php tvlgiao_wpdance_display_post_title($show_title); ?>
				<div class="wd-meta-post">
					<!-- Sticky Post -->
					<?php tvlgiao_wpdance_display_post_sticky(); ?>
					<!-- Show Post Author -->
					<?php tvlgiao_wpdance_display_post_author($show_author); ?>
					<!-- Show Post Category -->
					<?php tvlgiao_wpdance_display_post_category($show_category); ?>
					<!-- Show Post Date -->
					<?php tvlgiao_wpdance_display_post_date($show_date); ?>
					<!-- Show Number Comment -->
					<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
				</div>
				<!-- Show Post Excerpt -->
				<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt); ?>
				<!-- Show Readmore Button -->
				<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
			</div>
		</div>
	<?php
	} elseif ($post_format == 'link') { ?>
		<div class="wd-content-post-format-link <?php echo esc_attr($custom_class); ?>">
			<?php 
			$link = tvlgiao_wpdance_grab_url();
			the_title( '<h1 class="entry-title"><a href="' . $link . '" target="_blank">', '<div class="wd-link-icon"><span class="wd-post-icon wd-post-link"></span></div></a></h1>');  ?>
		</div>
	<?php
	} elseif ($post_format == 'quote') { ?>
		<div class="wd-content-post-format-quote <?php echo esc_attr($custom_class); ?>">
			<div class="wd-content_item_quote">		
				<div class="content">
					<div class="content_infor">
						<?php the_excerpt() ?>
					</div>
					<div class="content_author">
						<?php the_author_posts_link(); ?>
					</div>
					<div class="readmore">
						<a class="readmore_link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','wpdancelaparis') ?></a>
					</div>
				</div>
			</div>
		</div>
	<?php
	} elseif ($post_format == 'video') { ?>
		<div class="wd-content-post-format-video <?php echo esc_attr($custom_class); ?>">
			<div class="embed-responsive embed-responsive-16by9">
				<?php echo tvlgiao_wpdance_get_embedded_media( array('video','iframe') ); ?>
			</div>
			<div class="wd-info-post">
				<!-- Show Post Title -->
				<?php tvlgiao_wpdance_display_post_title($show_title); ?>
				<div class="wd-meta-post">
					<!-- Sticky Post -->
					<?php tvlgiao_wpdance_display_post_sticky(); ?>
					<!-- Show Post Author -->
					<?php tvlgiao_wpdance_display_post_author($show_author); ?>
					<!-- Show Post Category -->
					<?php tvlgiao_wpdance_display_post_category($show_category); ?>
					<!-- Show Post Date -->
					<?php tvlgiao_wpdance_display_post_date($show_date); ?>
					<!-- Show Number Comment -->
					<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
				</div>
				<!-- Show Post Excerpt -->
				<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt); ?>
				<!-- Show Readmore Button -->
				<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
			</div>
		</div>
	<?php
	} else { ?>
		<div class="wd-content-post-format-none <?php echo esc_attr($custom_class); ?>">
			<!-- Show Post Thumbnail -->
			<?php echo tvlgiao_wpdance_get_attachment_html($thumbnail_size, $show_thumbnail, 1, $placeholder_image); ?>
			<div class="wd-info-post">
				<!-- Show Post Title -->
				<?php tvlgiao_wpdance_display_post_title($show_title); ?>
				<div class="wd-meta-post">
					<!-- Sticky Post -->
					<?php tvlgiao_wpdance_display_post_sticky(); ?>
					<!-- Show Post Author -->
					<?php tvlgiao_wpdance_display_post_author($show_author); ?>
					<!-- Show Post Category -->
					<?php tvlgiao_wpdance_display_post_category($show_category); ?>
					<!-- Show Post Date -->
					<?php tvlgiao_wpdance_display_post_date($show_date); ?>
					<!-- Show Number Comment -->
					<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
				</div>
				<!-- Show Post Excerpt -->
				<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt); ?>
				<!-- Show Readmore Button -->
				<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
			</div>
		</div>
	<?php
	}
	return ob_get_clean();
}
?>