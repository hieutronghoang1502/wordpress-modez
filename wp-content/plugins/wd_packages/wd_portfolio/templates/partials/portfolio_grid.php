<?php
$thumbnail_id = get_post_thumbnail_id( get_the_ID() );

if ( ! empty( $thumbnail_id ) ) {
	$thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, 'portfolio_image' );

	$light_box_url = trim( WD_Portfolio::wd_portfolio_get_meta( 'wd-portfolio' ) );
	if ( strlen( $light_box_url ) <= 0 ) {
		$light_box_url = $thumbnail_src[0];
	}

	$thumbnail_img = get_the_post_thumbnail( null, 'portfolio_image' );
} else {
	$light_box_url = WDP_IMAGE . '/600x364.png';
	$thumbnail_img = '<img width="600" height="364" src="' . $light_box_url . '" class="attachment-portfolio_image size-portfolio_image wp-post-image" alt="">';
}

$light_box_class = WD_Portfolio::wd_portfolio_get_filetype( $light_box_url );

?>
<div class="wd-wrap-content-item grid-item <?php echo esc_attr( $span_class ); ?>">
	<div class="wd-wrap-content-inner">
		<div class="wd-thumbnail-post">
			<a class="thumbnail" href="<?php the_permalink(); ?>">
				<?php echo $thumbnail_img; ?>
			</a>
			<?php if ( $style == 'portfolio-style-2' ) : ?>
				<div class="hover-default thumb-image-hover">
					<div class="icons">
						<a class="zoom-gallery wd-fancybox-thumbs <?php echo esc_attr( $light_box_class ); ?>"
						   data-toggle="tooltip"
						   data-fancybox-group="<?php echo $tab_rand; ?>"
						   title="<?php _e( 'Quick View', 'wpdanceelectronics' ) ?>"
						   data-caption="<?php the_title(); ?>"
						   href="<?php echo esc_url( $light_box_url ); ?>">
							<?php esc_html_e( 'Quick view', 'wpdance' ); ?>
							<?php if ( esc_attr( $light_box_class ) === 'wd-fancybox-video' ): ?>
								<?php the_post_thumbnail( 'portfolio_image', array( 'class' => 'hidden' ) ); ?>
							<?php endif; ?>
						</a>
						<a class="link-gallery"
						   data-toggle="tooltip"
						   title="<?php _e( "View Details", "wpdance" ); ?>"
						   href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read', 'wpdance' ); ?></a>
					</div><!-- .icons -->
				</div><!-- .hover-default -->
			<?php endif; ?>
		</div><!-- .wd-thumbnail-post -->
		<?php if ( $style == 'portfolio-style-1' ) : ?>
			<div class="wd-content-portfolio">
				<div class="wd-title-portfolio">
					<h2 class="wd-heading-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
				</div>
				<div class="wd-category-portfolio">
					<?php $post_categories = get_the_term_list( get_the_ID(), 'wd-portfolio-category', '', ' , ', '' ); ?>
					<?php echo( $post_categories ); ?>
				</div><!-- .wd-category-portfolio -->
				<div class="hover-default thumb-image-hover">
					<div class="icons">
						<a class="zoom-gallery wd-fancybox-thumbs <?php echo esc_attr( $light_box_class ); ?>"
						   data-toggle="tooltip"
						   data-fancybox-group="<?php echo $tab_rand; ?>"
						   title="<?php _e( 'Quick View', 'wpdanceelectronics' ) ?>"
						   data-caption="<?php the_title(); ?>"
						   href="<?php echo esc_url( $light_box_url ); ?>">
							<?php esc_html_e( 'Quick view', 'wpdance' ); ?>
							<?php if ( esc_attr( $light_box_class ) === 'wd-fancybox-video' ): ?>
								<?php the_post_thumbnail( 'portfolio_image', array( 'class' => 'hidden' ) ); ?>
							<?php endif; ?>
						</a>
						<a class="link-gallery"
						   data-toggle="tooltip"
						   title="<?php _e( "View Details", "wpdance" ); ?>"
						   href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read', 'wpdance' ); ?></a>
					</div><!-- .icons -->
				</div><!-- .hover-default -->
			</div><!-- .wd-content-portfolio -->
		<?php endif; ?>
		<?php if ( $style == 'portfolio-style-2' ) : ?>
			<div class="wd-content-portfolio">
				<div class="wd-title-portfolio">
					<h2 class="wd-heading-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
				</div><!-- .wd-title-portfolio -->
				<div class="wd-category-portfolio">
					<?php $post_categories = get_the_term_list( get_the_ID(), 'wd-portfolio-category', '', ' , ', '' ); ?>
					<?php echo( $post_categories ); ?>
				</div><!-- .wd-category-portfolio -->
			</div>
		<?php endif; ?>
	</div><!-- .wd-wrap-content-inner -->
</div><!-- .wd-wrap-content-item -->