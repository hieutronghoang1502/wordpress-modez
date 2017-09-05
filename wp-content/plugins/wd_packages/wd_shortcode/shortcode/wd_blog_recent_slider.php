<?php
/**
 * Shortcode: tvlgiao_wpdance_special_recent_post_slider
 */
if(!function_exists('tvlgiao_wpdance_special_recent_post_slider_function')){
	function tvlgiao_wpdance_special_recent_post_slider_function($atts,$content){
		extract(shortcode_atts(array(
			'id_category'			=> '-1',
			'data_show'				=> 'recent_blog',
			'number_blogs'			=> '12',
			'image_size'			=> 'full',
			'sort'					=> 'DESC',
			'order_by'				=> 'date',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'class'					=> '',
		),$atts));
		$show_detail 	= 0;
		$is_slider 		= 1;
		$show_readmore 	= 1;
		$excerpt 		= 1;
		$number_excerpt	= 20;
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
		$recent_posts 		= new WP_Query( $args );
		ob_start();
		if ( $recent_posts->have_posts() ) {
			$random_id = 'wd_special_post'.mt_rand();
			?>
			<div class="wd_blog_slider_posst <?php echo ($show_nav)?'has_navi':''; ?> <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $random_id ); ?>">
				<div class="wd-content-slider">
					<?php while( $recent_posts->have_posts() ) { $recent_posts->the_post();	global $post;?>
						<div class="wd-content-post">
							<div class="wd-blog-info-top">
								<div class="wd-entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdancelaparis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
										<?php echo esc_attr(get_the_title()); ?>
									</a>
								</div>							
								<div class="author_post">	
									<i><?php esc_html_e('Post by','wpdancelaparis'); ?></i><?php the_author_posts_link(); ?> 
								</div>
							</div>
							<div class="wd-thumbnail-post">
								<?php if(has_post_thumbnail()){ ?> 
									<div class="post_thumbnail image">
										<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail($image_size,array('class' => 'thumbnail-effect-1', 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()))); ?>
										</a>
									</div>
								<?php } ?>
							</div>
							<div class="wd-blog-info-bottom">
								<?php if($excerpt): ?>
									<div class="excerpt"><?php tvlgiao_wpdance_the_excerpt_max_words($number_excerpt); ?></div>
								<?php endif; ?>
								<?php if($show_readmore) : ?>
									<div class="readmore">
										<a class="readmore_link" href="<?php the_permalink(); ?>"><?php esc_html_e('read more','wpdancelaparis') ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php } // End While ?>
				</div>
				<?php if( $show_nav && $is_slider ){ ?>
					<div class="slider_control">
						<a href="#" class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
						<a href="#" class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i>
</a>
					</div>
				<?php } ?>
			</div>

			<?php if( $is_slider ) : ?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						"use strict";						
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
						var owl = $_this.find('.wd-content-slider').owlCarousel({
							loop : true
							,items : 1
							,nav : false
							,dots : true
							,navSpeed : 1000
							,slideBy: 1
							,rtl:jQuery('body').hasClass('rtl')
							,navRewind: false
							,autoplay: _auto_play
							,autoplayTimeout: 5000
							,autoplayHoverPause: true
							,autoplaySpeed: false
							,mouseDrag: true
							,touchDrag: true
							,responsiveBaseElement: $_this
							,responsiveRefreshRate: 1000
							,stagePadding: 150
							,responsive		:{
								0:{
									stagePadding: 0
								},
								480:{
									stagePadding: 0
								},
								768:{
									stagePadding: 100
								},
								992:{
									stagePadding: 130
								},
								1200:{
									stagePadding: 150
								}
							}	
							,onInitialized: function(){
							}
						});
						$_this.on('click', '.next', function(e){
							e.preventDefault();
							owl.trigger('next.owl.carousel');
						});

						$_this.on('click', '.prev', function(e){
							e.preventDefault();
							owl.trigger('prev.owl.carousel');
						});
					});
				</script>
			<?php endif; // End if			
		}
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_special_recent_post_slider','tvlgiao_wpdance_special_recent_post_slider_function');
?>