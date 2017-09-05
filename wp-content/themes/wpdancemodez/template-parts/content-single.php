<?php
/**
*
* @package Wordpress
*
**/
?>
<?php
	global $post;
	$tag = get_the_tags( get_the_id() );
 ?>

<!-- 	VC_single_post -->
	<section class="wdp-blog-detail vc_section section-content"><div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"><div class="vc_row wpb_row vc_inner vc_row-fluid wdp-blog-left"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner vc_custom_1502353765214"><div class="wpb_wrapper"><h2 style="text-align: left;font-family:Abril Fatface;font-weight:400;font-style:normal" class="vc_custom_heading h3-title-line-bot">Recent Articles</h2>		
		<?php echo do_shortcode('[recent_article]' ); ?>
		</div></div></div></div><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="post-tags wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner vc_custom_1502355433203"><div class="wpb_wrapper"><h2 style="text-align: left;font-family:Abril Fatface;font-weight:400;font-style:normal" class="vc_custom_heading h3-title-line-bot">Tags</h2>		
		<?php echo do_shortcode('[get_tags]' ); ?>
		</div></div></div></div><div class="vc_row wpb_row vc_inner vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner vc_custom_1502353109808"><div class="wpb_wrapper">
		<?php echo do_shortcode('[vc_single_image image="445" img_size="medium" alignment="center" css_animation="fadeInUp" el_class="eff-asknew"]' ); ?>
</div></div></div></div></div></div></div><div class="content-single-post-right wpb_column vc_column_container vc_col-sm-9"><div class="vc_column-inner "><div class="wpb_wrapper"><!-- single-image-singlepost -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="single-post-image">
							<?php if (has_post_thumbnail( $post->ID ) ): ?>
					  		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
							<?php  the_post_thumbnail('full' );?>
					 		 <div class="single-post-tag"><a href="<?php echo get_tag_link( $tag[0]->id ); ?>"><?php echo str_replace('#', '', $tag[0]->name) ?></a></div>
					 		 </div>
					<?php endif; ?>
						</div><!-- post-image -->
						<div class="entry-content">
							<h1><?php the_title( ); ?></h1>
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wpdancelaparis' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
							?>
						</div><!-- .entry-content -->
						<div class="date-actor">
							 <?php echo single_month_title(); ?> 


							<span><?php the_time('F' ); echo " " ;the_time('j' );?></span> | <span><?php the_author( ); ?></span>
						</div>
						<?php if (has_tag()): ?>
							<div class="wd-tag-post">
								<span><?php esc_html_e('Tags: ','wpdancelaparis'); ?></span>
								<?php the_tags(esc_html__('', 'wpdancelaparis'),esc_html__(', ', 'wpdancelaparis')); ?>
							</div>
						<?php endif ?>
						
						<?php do_action('tvlgiao_wpdance_single_social_sharing'); ?>
					</article><!-- End Article -->

</div></div></div></div></section>


<!-- end VC_single_post -->
