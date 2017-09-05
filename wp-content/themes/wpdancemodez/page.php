<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @since wpdance
 *
 **/
?>
<?php get_header(); ?>
<?php
	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	/*PAGE CONFIG*/
	$_page_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_page_config', true);
	$_page_config 	= unserialize($_page_config);

	extract(tvlgiao_wpdance_get_custom_data_special_template( 'default-page' )); 

	$layout 		= ($_page_config['layout'] != '0') ? $_page_config['layout'] : $layout;
	
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
						<?php if ( have_posts() ) : ?>
							<!-- Start the Loop --> 
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'template-parts/content', 'page' ); ?>
								<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() ) :
										tvlgiao_wpdance_display_comment_form();
									endif;
								?>
							<?php endwhile; ?>
							<!-- End the Loop -->
						<?php else: ?>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						<?php endif; // End If Have Post ?>
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