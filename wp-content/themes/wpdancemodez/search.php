<?php
/**
 * The template for displaying search results pages
 *
 * @package Wordpress
 * @since wpdance
 */
?>
<?php get_header(); ?>
<?php
	/*CUSTOM DEFAULT*/
	extract(tvlgiao_wpdance_get_custom_data_special_template( 'default-page' )); 
	
	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_class = "col-sm-18";
	}elseif($layout == '1-0-1'){
		$content_class = "col-sm-12";
	}else{
		$content_class = "col-sm-24";
	}

?>
<div id="main-content" class="main-content wd-search-result-page">
	<div class="container">
		<div class="row">
			<div class="row">
				<!-- Left Content -->
				<?php if( ($layout == '1-0-0') || ($layout == '1-0-1') ) : ?> 
					<?php tvlgiao_wpdance_display_left_sidebar($sidebar_left); ?>
				<?php endif; // Endif Left?>
				
				<!-- Content Index -->
					<div class="wd-default-blog-archive <?php echo esc_attr($content_class); ?>">
						<?php if ( have_posts() ) : ?>
							<!-- Start the Loop --> 
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
									get_template_part( 'template-parts/content', get_post_format() );
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
				<?php if( ($layout == '0-0-1') || ($layout == '1-0-1') ) : ?> 
					<?php tvlgiao_wpdance_display_right_sidebar($sidebar_right); ?>
				<?php endif; // Endif Right?>	
			</div>
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>
