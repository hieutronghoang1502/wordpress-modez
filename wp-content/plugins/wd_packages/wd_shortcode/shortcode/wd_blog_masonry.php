<?php
/**
 * Shortcode: tvlgiao_wpdance_masonry_blog
 */
if(!function_exists('tvlgiao_wpdance_masonry_blog_function')){
	function tvlgiao_wpdance_masonry_blog_function($atts,$content){
		extract(shortcode_atts(array(
			'number' 				=> '6',
			'columns'				=> '3',
			'pagination_loadmore'	=> '0',
			'number_loadmore'		=> '6',
			'class'					=> ''
		),$atts));
		wp_reset_postdata();
		$args = array(		
			'post_type' 				=> 'post',
			'posts_per_page' 			=> $number,
			'ignore_sticky_posts' 		=> 1,
			'paged' 					=> get_query_var('paged')
		);
		$posts = new WP_Query($args);
		$span_class = "col-sm-".(24/$columns);
		$random_id = 'wd-blog-masonry-'.rand(0,1000).time();

		ob_start();
		if( $posts->have_posts() ) : ?>
			<div id="<?php echo esc_html($random_id); ?>" class='wd-shortcode-masonry-blog <?php echo esc_attr($class); ?>'>
				<div class="grid masonry-content">
					<?php while ( $posts->have_posts() ) : $posts->the_post(); global $post; ?>
						<div class="wd-wrap-content-blog grid-item <?php echo esc_attr($span_class); ?>">
							<?php echo tvlgiao_wpdance_get_content_blog('full'); ?>
						</div>
					<?php endwhile;   ?>	
				</div>
				<?php if($pagination_loadmore == '1') : ?> 
					<div class="wd-pagination">
						<?php tvlgiao_wpdance_pagination(3, $posts); ?>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
				<?php if($pagination_loadmore == '0') : ?> 
					<div class="wd-loadmore">
						<div class="show_image_loading" id="show_image_loading_<?php echo esc_html($random_id); ?>">
							<img src="<?php echo SC_IMAGE.'/ajax-loader_image.gif';?>" alt="HTML5 Icon" style="height:15px;">
						</div>
						<div class="load_more_masonry">
							<a 	data-random_id="<?php echo esc_html($random_id); ?>" 
								data-posts_per_page="<?php echo esc_html($number_loadmore); ?>" 
								data-columns="<?php echo esc_html($columns); ?>" 
								class="button btn_loadmore_masonry"><?php _e('LOAD MORE','wpdancelaparis') ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<script type='text/javascript'>		
			jQuery(document).ready(function() {
				"use strict";
				tvlgiao_wpdance_load_isotope();
				setTimeout(
				function(){
				    tvlgiao_wpdance_load_isotope();
				}, 2000);
			});
		</script>			
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}

add_shortcode('tvlgiao_wpdance_masonry_blog','tvlgiao_wpdance_masonry_blog_function');

?>