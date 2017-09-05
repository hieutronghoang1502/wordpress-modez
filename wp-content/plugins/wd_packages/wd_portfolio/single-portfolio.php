<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Wordpress
 */

get_header();

global $post;

$layout_config = trim( WD_Portfolio::wd_portfolio_get_meta( 'single_portfolio_layout' ) );
$project_por   = trim( WD_Portfolio::wd_portfolio_get_meta( 'wd_portfolio_url' ) );
if ( $project_por == "" ) {
	$project_por = "#";
}
$class_full    = "col-sm-12";
$class_default = "col-sm-12";
if ( $layout_config == 'fullwidth' ) {
	$class_default = "";
} else {
	$class_full = "";
}

if ( ! has_post_thumbnail( get_the_ID() ) ) {
	$light_box_url = WDP_IMAGE . '/600x364.png';
	$thumbnail_img = '<img width="600" height="364" src="' . $light_box_url . '" class="attachment-portfolio_image size-portfolio_image wp-post-image" alt="">';
} else {
	$thumbnail_img = get_the_post_thumbnail( null, 'full' );
}

?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<div class="wd-thumbnail-portfolio <?php echo esc_attr( $class_default ); ?>">
				<a class="thumbnail" href="<?php the_permalink(); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php echo $thumbnail_img; ?>
					<?php endwhile; // End of the loop. ?>
				</a>
			</div>
			<div class="wd-content-portfolio <?php echo esc_attr( $class_default ); ?>">
				<div class="wd-por-content <?php echo esc_attr( $class_full ); ?>">
					<div class="wd-title-post">
						<h2 class="wd-heading-title">
							<a href="<?php the_permalink(); ?>" class="wd-title-post"><?php the_title(); ?></a>
						</h2>
					</div>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article><!-- End Article -->
				</div><!-- .entry-content -->
				<div class="wd-info-portfolio <?php echo esc_attr( $class_full ); ?>">
					<div class="wd-por-customer">
						<span><?php echo esc_html__( 'CUSTOMER', 'wpdance' ); ?></span>
						<span><?php the_author_posts_link(); ?></span>
					</div>
					<div class="wd-por-date">
						<span><?php echo esc_html__( 'DATE POST', 'wpdance' ); ?></span>
						<span><?php the_time( 'j F, Y' ); ?></span>
					</div><!-- .wd-por-date -->
					<div class="wd-por-category">
						<span><?php echo esc_html__( 'CATEGORY', 'wpdance' ); ?></span>
						<span><?php WD_Portfolio::wdp_the_category( esc_html__( ', ', 'wpdance' ) ); ?></span>
					</div><!-- .wd-por-category -->
					<div class="wd-share_list">
						<span><?php echo esc_html__( 'SHARE', 'wpdance' ); ?></span>
						<div class="addthis_sharing_toolbox"></div>
					</div><!-- .wd-share_list -->
					<div class="wd-project-portfolio">
						<a href="<?php echo esc_url( $project_por ); ?>" class="wd-project-por">
							<?php echo esc_html__( 'LAUNCH PROJECT', 'wpdance' ); ?>
						</a>
					</div><!-- .wd-project-portfolio -->
				</div><!-- .wd-info-portfolio -->
			</div><!-- .wd-content-portfolio -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #main-content -->
<?php get_footer(); ?>