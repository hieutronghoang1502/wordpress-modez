<?php
/*
Template Name: Page Template
*/
get_header(); 
	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	/*PAGE CONFIG*/
	$_page_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_page_config', true);
	$_page_config 	= unserialize($_page_config);

	extract(tvlgiao_wpdance_get_custom_data_special_template( 'default-page' )); 

	$layout 		= ($_page_config['layout'] != '0') ? $_page_config['layout'] : $layout;

	$layout;
	/*CUSTOM DEFAULT*/
	
	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_class = "col-sm-18";
	}elseif($layout == '1-0-1'){
		$content_class = "col-sm-12";
	}else{
		$content_class = "col-sm-24";
	}
?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<div class="row">
				<!-- Left Content -->
				<?php if( ($layout == '1-0-0') || ($layout == '1-0-1') ) : ?> 
					<?php tvlgiao_wpdance_display_left_sidebar($sidebar_left); ?>
				<?php endif; // Endif Left?>
				
				<!-- Content Index -->
				<div class="<?php echo esc_attr($content_class); ?>">
					<div class="wd-content-page">
						<div id="primary" class="content-area">
							<main id="main" class="site-main">
								<?php while ( have_posts() ) : the_post(); ?>
									<?php the_content(); ?>	
								<?php endwhile; ?>
							</main><!-- #main -->
						</div><!-- #primary -->
					</div>
				</div>
			
				<!-- Right Content -->
				<?php if( ($layout == '0-0-1') || ($layout == '1-0-1') ) : ?> 
					<?php tvlgiao_wpdance_display_right_sidebar($sidebar_right); ?>
				<?php endif; // Endif Right?>	
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>