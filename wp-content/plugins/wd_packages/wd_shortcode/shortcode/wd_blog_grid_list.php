<?php
/**
 * Shortcode: tvlgiao_wpdance_special_gird_list_blog
 */

if (!function_exists('tvlgiao_wpdance_special_gird_list_blog_function')) {
	function tvlgiao_wpdance_special_gird_list_blog_function($atts) {
		extract(shortcode_atts(array(
			'id_category'				=> '-1',
			'data_show'					=> 'recent_blog',
			'number_blogs'				=> '12',
			'show_data_image_slider'	=> '1',
			'grid_list_layout'			=> 'grid',
			'sort'						=> 'DESC',
			'order_by'					=> 'date',
			'columns'					=> '1',
			'excerpt_words'				=> '20',
			'pagination_loadmore'		=> '1',
			'number_loadmore'			=> '8',
			'class'						=> ''

		), $atts));
		wp_reset_query();
		// New blog
		$args = array(  
			'post_type' 		=> 'post',  
			'posts_per_page' 	=> $number_blogs,
			'order'				=> $sort,
			'orderby' 			=> $order_by,
			'paged' 			=> get_query_var('paged')
		);
		//Category
		if( $id_category != -1 ){
			$args['tax_query']= array(
		    	array(
			    	'taxonomy' 		=> 'category',
					'terms' 		=> $id_category,
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
   			);
		}
		//Most View Products
		if($data_show == 'mostview_blog'){
			$args['meta_key'] 	= '_wd_post_views_count';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'DESC';
		}
		//Most Comment
		if($data_show == 'comment_blog'){
			$args['orderby']		= 'comment_count';
		}	
		$special_blogs 		= new WP_Query( $args );

		$grid_list_class 	= "wd-blog-grid-style";
		if($grid_list_layout == 'list'){
			$grid_list_class = "wd-blog-list-style";
		}
		$span_class 		= "col-sm-".(24/$columns); 

		$random_id = 'wd-blog-grid-list-'.rand(0,1000).time();
		ob_start(); ?>
		<?php if( $special_blogs->have_posts() ) :?> 
			<?php 
				$class_masonry 		= ($grid_list_layout == 'grid-masonry') ? 'post_mansory' : '';
				$class_masonry_item = ($grid_list_layout == 'grid-masonry') ? 'gallery_item' : '';
				$image_size 		= ($columns == 1 || $grid_list_layout == 'grid-masonry') ? 'full' : 'post-thumbnail';
			?>
			<div id="<?php echo esc_html($random_id); ?>" class='wd-shortcode-special-blog wd-related-wrapper content_blog <?php echo esc_html($class); ?> <?php echo esc_html($grid_list_class); ?> <?php echo esc_attr($class_masonry);?>'>
				<?php while( $special_blogs->have_posts() ) : $special_blogs->the_post(); global $post; ?>
					<div class="wd-load-more-content-blog <?php echo esc_attr($span_class);?> <?php echo esc_attr($class_masonry_item);?>">
						<?php if ($show_data_image_slider == "1"): ?>
							<?php echo tvlgiao_wpdance_get_content_blog($image_size); ?>
						<?php else: ?>
							<?php echo tvlgiao_wpdance_get_content_blog($image_size, get_post_format()); ?>
						<?php endif ?>
					</div>					
				<?php endwhile; ?>			
			</div>
			<div class="clear"></div>
			<?php if($pagination_loadmore == "1") : ?>
				<div class="wd-pagination">
					<?php tvlgiao_wpdance_pagination(3, $special_blogs) ?>
				</div>
			<?php endif; ?>
			<?php if($pagination_loadmore == "0") : ?>
				<div class="wd-loadmore">
					<div class="show_image_loading" id="show_image_loading_<?php echo esc_html($random_id); ?>">
						<img src="<?php echo SC_IMAGE.'/ajax-loader_image.gif';?>" alt="HTML5 Icon" style="height:15px;">
					</div>

					<div id="loadmore">
						<a 	data-random_id="<?php echo esc_html($random_id); ?>" 
							data-posts_per_page="<?php echo esc_html($number_loadmore); ?>" 
							data-id_category="<?php echo esc_html($id_category); ?>" 
							data-data_show="<?php echo esc_html($data_show); ?>" 
							data-columns="<?php echo esc_html($columns); ?>" 
							data-show_data_image_slider="<?php echo esc_html($show_data_image_slider); ?>" 
							data-grid_list_layout="<?php echo esc_html($grid_list_layout); ?>" 
							data-sort="<?php echo esc_html($sort); ?>" 
							data-order_by="<?php echo esc_html($order_by); ?>" 
							href="#" class="button btn_loadmore_blog"><?php _e('LOAD MORE','wpdancelaparis') ?></a>
					</div>
				</div>				
			<?php endif; ?>
		<?php endif;// End have post ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_special_gird_list_blog', 'tvlgiao_wpdance_special_gird_list_blog_function');
?>