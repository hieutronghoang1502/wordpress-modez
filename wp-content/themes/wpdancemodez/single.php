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
	
	//Customize Config
	extract(tvlgiao_wpdance_get_custom_data_special_template( 'single-blog' )); 

	$layout 		= ($_post_config['layout'] != '0') ? $_post_config['layout'] : $layout;
	
	$wrap_content_class 		= '';
	$wrap_parent_class 			= '';
	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_col_class 		= "col-sm-18";
		$wrap_parent_class 		= "row";
		if (($layout == '1-0-0')) {
			$wrap_content_class = "wd-blog-left-sidebar";
		}elseif($layout == '0-0-1'){
			$wrap_content_class = "wd-blog-right-sidebar";
		}
	}elseif($layout == '1-0-1'){
		$content_col_class 		= "col-sm-12";
		$wrap_parent_class 		= "row";
		$wrap_content_class 	= "wd-blog-left-right-sidebar";
	}else{
		$content_col_class 		= "col-sm-24";
		$wrap_content_class 	= "row wd-blog-full-width";
	}

	//Count Post view
	do_action('wd_set_post_views');
?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<div class="wd-single-post-wrap <?php echo esc_attr($wrap_parent_class); ?>">
				<!-- Left Content -->
				<?php if( ($layout == '1-0-0') || ($layout == '1-0-1') ) : ?> 
					<?php tvlgiao_wpdance_display_left_sidebar($sidebar_left); ?>
				<?php endif; // Endif Left?>

				<!-- Content Single Post -->
				<div class="wd-single-post-content <?php echo esc_attr($content_col_class); ?>">
					<div class="<?php echo esc_attr($wrap_content_class); ?>">
						<?php while ( have_posts() ) : the_post();  ?>
							<div>
								
								
									
									<div class="wd-content-detail-post">
										<!-- Content Post -->
										<?php get_template_part( 'template-parts/content', 'single' ); ?>
										<!-- Related Post -->
									</div>
									<?php tvlgiao_wpdance_display_post_previous_next_btn($show_previous_next_btn); ?>
									
								
							</div>
						<?php endwhile; // End of the loop. ?>
						<?php if ($show_recent_blog): ?>
							<div class="wd-related_posts">
								<?php get_template_part( 'template-parts/related'); ?>	
							</div>
						<?php endif ?>
						<?php while ( have_posts() ) : the_post();  ?>
							<div class="wd-comment-form">
								<!-- Comment-post -->
								<?php		
									//If comments are open or we have at least one comment, load up the comment template
									if ( ! post_password_required() && (comments_open() || '0' != get_comments_number()) ) :
										tvlgiao_wpdance_display_comment_form();
									endif;
								?>		
							</div>
						<?php endwhile; // End of the loop. ?>
					</div>
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