<?php
/**
 * Shortcode: tvlgiao_wpdance_masonry_guestbook
 */
if(!function_exists('tvlgiao_wpdance_masonry_guestbook_function')){
	function tvlgiao_wpdance_masonry_guestbook_function($atts,$content){
		extract(shortcode_atts(array(
			'number' 				=> '6',
			'columns'				=> '3',
			'pagination_loadmore'	=> '0',
			'number_loadmore'		=> '6',
			'class'					=> ''
		),$atts));
		wp_reset_postdata();
		$args = array(		
			'post_type' 				=> 'wd_guestbook'
			,'posts_per_page' 			=> $number
			,'ignore_sticky_posts' 		=> 1
			,'paged' 					=> get_query_var('paged')
		);
		$posts = new WP_Query($args);
		$span_class = "col-sm-".(24/$columns);
		ob_start();

		if( $posts->have_posts() ) : ?>
			<div class='wd-masonry-guestbook <?php echo esc_attr($class); ?>'>
				
				<div class="grid masonry-content">
					<?php while ( $posts->have_posts() ) : $posts->the_post(); global $post;  ?>
						<div class="wd-content-guestbook grid-item <?php echo esc_attr($span_class); ?>">	
							<div class="wd-content-sub">
								<h2 class="wd-heading-title">
									<a><?php the_title(); ?></a>
								</h2>							
								<div class="wd-content-detail-post">
									<?php $excerpt 	= get_the_excerpt(); echo esc_attr($excerpt); ?>
								</div>
								<p><?php echo get_the_date('M d,Y'); ?></p>
							</div>
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
						<div style="display: none;" id="show_image_loading">
							<img src="<?php echo SC_IMAGE.'/ajax-loader_image.gif';?>" alt="HTML5 Icon" style="height:15px;">
						</div>
						<div class="load_more_masonry">
							<a class="button btn_loadmore_masonry"><?php _e('LOAD MORE','wpdance') ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<script type='text/javascript'>
			<?php if($pagination_loadmore == '0') : ?> 
				var ajaxUrl = "<?php echo admin_url('admin-ajax.php', null); ?>";
				jQuery( document ).ready( function($) {
					"use strict";
					$('#show_image_loading').css( "display", "none" );
					$(document).on ( 'click', '.btn_loadmore_masonry', function( event ) {
						var page = 1; // What page we are on.
						var offset_begin = $('.grid .grid-item').length;
						var offset = offset_begin;
						var posts_per_page 	= <?php echo esc_attr($number_loadmore); ?> ;
						var columns			= <?php echo esc_attr($columns); ?> ;	 
						$('#show_image_loading').css( "display", "block" );
						$( '.grid' ).find( '#wd_status' ).remove();
						jQuery.post(ajaxUrl , {
							action:"more_post_ajax_guestbook",
							offset: offset,
							posts_per_page: posts_per_page,
							columns: columns
						}).success(function(posts){
							$("#show_image_loading").css( "display", "none" );
							var $newItems = jQuery(posts);
							jQuery('.grid').append( $newItems ).isotope( 'addItems', $newItems );

							tvlgiao_wpdance_load_isotope();
						
							var $item = $('<div class="grid-item" id="remove-grid-item"></div>');
							jQuery('.grid').append( $item ).isotope( 'addItems', $item );
							tvlgiao_wpdance_load_isotope();
							$( '.grid' ).find( '#remove-grid-item' ).remove();

							var wd_status = document.getElementById('wp_outline_have_post').value;				
							if(wd_status == 0){
								$(".load_more_masonry a").removeClass('btn_loadmore_masonry').addClass('btn_end_load_more_masonry').html('END OF POSTS');
							}
							setTimeout(
							function(){
							    tvlgiao_wpdance_load_isotope();
							}, 1000);						
						});
					});
				});

			<?php endif; ?>		
			jQuery(document).ready(function() {
				"use strict";
				tvlgiao_wpdance_load_isotope();
				setTimeout(
				function(){
				    tvlgiao_wpdance_load_isotope();
				}, 2000);
			});

			function tvlgiao_wpdance_load_isotope(){
				jQuery('.grid').isotope({
					itemSelector: '.grid-item',
					layoutMode: 'masonry'			
				});
					
				jQuery('img').load(function(){
					jQuery('.grid').isotope({
						itemSelector: '.grid-item',
						layoutMode: 'masonry'			
					});
				});
			}					
		</script>			
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}

add_shortcode('tvlgiao_wpdance_masonry_guestbook','tvlgiao_wpdance_masonry_guestbook_function');

?>