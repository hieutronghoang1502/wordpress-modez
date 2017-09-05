<?php
/*
Template Name: Home Template (Header Left)
*/
?>
<!DOCTYPE html>
<html itemscope <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php do_action('tvlgiao_wpdance_header_meta_data'); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php do_action('tvlgiao_wpdance_after_opening_body_tag'); ?>
	<div class="body-wrapper">
		<header id="header" class="header col-md-3">
			<div class="hidden-xs hidden-sm">
				<?php do_action('tvlgiao_wpdance_header_init_action'); ?>
			</div>
			<div class="header-mobile visible-xs visible-sm">
				<?php do_action('tvlgiao_wpdance_menu_mobile') ?>
			</div>
			<?php do_action('tvlgiao_wpdance_init_breadcrumbs') ?>
		</header> <!-- END HEADER  -->
		<div class="col-md-21">
			<div id="main-content" class="main-content woocommerce">
				<div class="container">
					<div class="row">
						<!-- Content Index -->
						<div class="wd-content-home">
							<div id="primary" class="content-area container">
								<main id="main" class="site-main row">
									<?php while ( have_posts() ) : the_post(); ?>
										<?php the_content(); ?>	
									<?php endwhile; ?>
								</main><!-- #main -->
							</div><!-- #primary -->
						</div>
					</div>
				</div>
			</div>
			<footer id="footer" class="footer">
				<?php do_action('tvlgiao_wpdance_footer_init_action'); ?>
			</footer> <!-- END FOOOTER  -->
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>