<?php
/**
 * Shortcode: tvlgiao_special_post
 */
if(!function_exists('tvlgiao_wpdance_special_blog_function')){
	function tvlgiao_wpdance_special_blog_function($atts,$content){
		extract(shortcode_atts(array(
			'title'					=> '',
			'number'				=> 6,
			'data_post'				=> 'recent-post',
			'columns'				=> 3,
			'style'					=> 'grid',
			'show_title' 			=> '1',
			'show_thumbnail' 		=> '1',
			'show_placeholder_image'  => '0',
			'show_author'			=> '1',
			'show_category'			=> '1',
			'show_date'				=> '1',
			'show_number_comments'	=> '1',
			'show_excerpt'			=> '1',
			'number_excerpt'		=> '20',
			'show_readmore'			=> '0',
			'is_slider'				=> '1',
			'show_nav'				=> '1',
			'auto_play'				=> '1',
			'per_slide'				=> 3,
			'class'					=> ''
		),$atts));

		$grid_list_class 	= "wd-blog-grid-style";
		if($style == 'list'){
			$grid_list_class = "wd-blog-list-style";
		}
		$show_detail = 0;
		$args = array(
			'post_type'				=> 'post',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page'		=> $number,
			'post_status'			=> 'publish'
		);
		if($data_post == 'most-view'){
			$args['meta_key'] 		= '_wd_post_views_count';
			$args['orderby'] 		= 'meta_value_num';
			$args['order'] 			= 'DESC';
		}
		wp_reset_query();
		$recent_posts = new WP_Query($args);
		ob_start();

		if ( $recent_posts->have_posts() ) {
			$num_post =  $recent_posts->post_count;
			if( $num_post < 2 || $num_post <= $per_slide ){
				$is_slider = 0;
			}
			$random_id = 'wd-special-post'.mt_rand();
			?>
			<div id="<?php echo esc_attr( $random_id ); ?>" class="wd-special-post-wrapper <?php echo ($show_nav)?'has_navi':''; ?> <?php echo esc_attr( $grid_list_class ); ?> <?php echo esc_attr( $class ); ?>">
				<?php if($title != "") : ?>
					<div class="wd-title wd-special-post-title">
						<h2><?php echo esc_attr( $title ); ?></h2>
					</div>
				<?php endif; ?>
				<div class="widget-list-post-inner">
					<?php
					$count = 0;	
					while( $recent_posts->have_posts() ) {
						$recent_posts->the_post();
						global $post;
						if ($count == 0 || $count % $per_slide == 0 ){ ?>
							<div class="widget-per-slide">
								<ul>
						<?php } ?>
								<li> 
									<div class="wd-wrap-content-blog"> 
										<!-- Post type: Show Thumbnail -->
										<?php if( has_post_thumbnail() && $show_thumbnail ): ?>
											<div class="wd-thumbnail-post">
												<a class="thumbnail" href="<?php the_permalink(); ?>">
													<?php
														the_post_thumbnail('post-thumbnail', array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title())));
													?>
												</a>
											</div>
										<?php elseif( $show_placeholder_image && $show_thumbnail ): ?>
											<?php echo tvlgiao_wpdance_get_thumb_placeholder_image(); ?>
										<?php endif; // End If ?> 

										<div class="wd-info-post">
											<!-- Show Post Title -->
											<?php tvlgiao_wpdance_display_post_title($show_title); ?>
											<div class="wd-meta-post">
												<!-- Sticky Post -->
												<?php tvlgiao_wpdance_display_post_sticky(); ?>
												<!-- Show Post Author -->
												<?php tvlgiao_wpdance_display_post_author($show_author); ?>
												<!-- Show Post Category -->
												<?php tvlgiao_wpdance_display_post_category($show_category); ?>
												<!-- Show Post Date -->
												<?php tvlgiao_wpdance_display_post_date($show_date); ?>
												<!-- Show Number Comment -->
												<?php tvlgiao_wpdance_display_post_number_comment($show_number_comments); ?>
											</div>
											<!-- Show Post Excerpt -->
											<?php tvlgiao_wpdance_display_post_excerpt($show_excerpt, $number_excerpt); ?>
											<!-- Show Readmore Button -->
											<?php tvlgiao_wpdance_display_post_readmore($show_readmore); ?>
										</div>
									</div>
								</li>
						<?php $count++; if( $count % $per_slide == 0 || $count == $num_post){ ?>
								</ul>
							</div>
						<?php
						}
					} ?>
				</div>
				<?php if( $show_nav && $is_slider ){ ?>
					<div class="slider_control">
						<a href="#" class="prev">&lt;</a>
						<a href="#" class="next">&gt;</a>
					</div>
				<?php } ?>
			</div>

			<?php if( $is_slider ) : ?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						"use strict";						
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
						var owl = $_this.find('.widget-list-post-inner').owlCarousel({
							loop : true,
							items : 1,
							nav : false,
							dots : false,
							navSpeed : 1000,
							slideBy: 1,
							rtl:jQuery('body').hasClass('rtl'),
							navRewind: false,
							autoplay: _auto_play,
							autoplayTimeout: 5000,
							autoplayHoverPause: true,
							autoplaySpeed: false,
							mouseDrag: true,
							touchDrag: true,
							responsiveBaseElement: $_this,
							responsiveRefreshRate: 1000,
							responsive:{
								0:{
									items : 1
								},
								300:{
									items : 1
								},
								579:{
									items : <?php if($columns > 5){echo 3;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns - 1;}else{echo $columns;}  ?>
								},
								767:{
									items : <?php if($columns > 5){echo 4;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns;}else{echo $columns;}  ?>
								},
								1100:{
									items : <?php echo $columns ?>
								}
							},
							onInitialized: function(){
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
add_shortcode('tvlgiao_wpdance_special_blog','tvlgiao_wpdance_special_blog_function');
?>