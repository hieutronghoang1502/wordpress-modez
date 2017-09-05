<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @package Wordpress
 * @since   wpdance
 */
?>
<?php get_header(); ?>
<?php
/*CUSTOM DEFAULT*/
$layout        = get_theme_mod( 'wd_blog_layout_archive', '0-0-0' );
$sidebar_left  = get_theme_mod( 'wd_blog_layout_archive_left_sidebar', 'sidebar' );
$sidebar_right = get_theme_mod( 'wd_blog_layout_archive_right_sidebar', 'sidebar' );
if ( ( $layout == '1-0-0' ) || ( $layout == '0-0-1' ) ) {
	$content_class = "col-sm-18";
} elseif ( $layout == '1-0-1' ) {
	$content_class = "col-sm-12";
} else {
	$content_class = "col-sm-24";
}
?>
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
	<div id="main-content" class="main-content">
		<div class="container">
			<div class="row">
				<!-- Left Content -->
				<?php if ( ( $layout == '1-0-0' ) || ( $layout == '1-0-1' ) ) : ?>
					<div class="col-sm-6">
						<?php if ( is_active_sidebar( $sidebar_left ) ) : ?>
							<?php dynamic_sidebar( $sidebar_left ); ?>
						<?php endif; ?>
					</div>
				<?php endif; // Endif Left?>

				<!-- Content Index -->
				<div class="<?php echo esc_attr( $content_class ); ?>">
					<?php if ( have_posts() ) : ?>
						<!-- Start the Loop -->
						<?php while ( have_posts() ) : the_post(); ?>
							<?php
							get_template_part( 'template-parts/content', get_post_type() );
							?>
						<?php endwhile; ?>
						<!-- End the Loop -->
						<div class="wd-pagination">
							<?php tvlgiao_wpdance_pagination(); ?>
						</div>
					<?php else: ?>
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; // End If Have Post ?>
				</div>

				<!-- Right Content -->
				<?php if ( ( $layout == '0-0-1' ) || ( $layout == '1-0-1' ) ) : ?>
					<div class="col-sm-6">
						<?php if ( is_active_sidebar( $sidebar_right ) ) : ?>
							<?php dynamic_sidebar( $sidebar_right ); ?>
						<?php endif; ?>
					</div>
				<?php endif; // Endif Right?>
			</div>
		</div>
	</div><!-- END CONTAINER  -->
<?php get_footer(); ?>