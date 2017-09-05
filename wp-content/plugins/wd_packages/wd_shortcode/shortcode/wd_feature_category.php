<?php
/**
 * Shortcode: tvlgiao_wpdance_feature_category
 */
if(!function_exists('tvlgiao_wpdance_feature_category_function')){
	function tvlgiao_wpdance_feature_category_function($atts){
		extract(shortcode_atts(array(
			'id'						=> 0,
			'columns'					=> 4,
			'number_feature'			=> 4,
			'sort'						=> 'ASC',
			'order_by'					=> 'date', 
			'text_align'				=> 'wd-text-align-default', 
			'show_icon_font_thumbnail'	=> '1',
			'icon_size'					=> 'fa-1x',
			'style_font'				=> 'sync-with-title',
			'style_thumbnail'			=> 'above-the-content',
			'image_size'				=> 'full',
			'title'						=> '1',
			'excerpt'					=> '1',
			'readmore'					=> '1',
			'is_slider'					=> '0',
			'show_nav'					=> '1',
			'auto_play'					=> '1',
			'class'						=> '',
		),$atts));
		$args = array(
			'post_type'				=> 'wpdance_feature',
			'post_status'			=> 'publish',
			'posts_per_page' 		=> $number_feature,
			'order' 				=> $sort,
			'orderby'				=> $order_by,
		);

		if( $id != 0 ){
			$args['tax_query']= array(
		    	array(
			    	'taxonomy' 		=> 'wpdance_feature_categories',
					'terms' 		=> $id,
					'field' 		=> 'term_id',
					'operator' 		=> 'IN'
				)
   			);
		}
		$_feature = new WP_Query($args);

		$style = 'style-font-sync-with-title';
		if($show_icon_font_thumbnail == 1){
			$style = 'style-font-'.$style_font;
		}elseif ($show_icon_font_thumbnail == 2){
			$style = 'style-thumbnail-'.$style_thumbnail;
		}
		$classes[] = 'shortcode-features';
		$classes[] = $class;

		
		if ($_feature->found_posts <= $columns) {
			$is_slider = '0';
		}
		$columns_feature 	= ($is_slider == '0') ? 'wd-columns-'.$columns : '';

		$random_id = 'wd_feature_category_'.mt_rand();
		ob_start();
		if ( $_feature->have_posts() ) { ?>
			<div id="<?php echo esc_attr($random_id); ?>" class="wd-feature-category-wrapper <?php echo esc_attr($style); ?> <?php echo esc_attr($columns_feature); ?>">
				<ul class="wd-feature-content-list">
					<?php
					while( $_feature->have_posts() ) {
						$_feature->the_post();
						global $post;
						$post_id = $post->ID;
						$icon_fontawesome = (get_post_meta($post_id,'wd_feature_icon',true)) ? get_post_meta($post_id,'wd_feature_icon',true) : 'fa-heartbeat';
						$content_display_position_1 = '';
						$content_display_title 		= ($title) ? '<h3 class="feature_title heading_title">' .get_the_title().'</h3>' : '';
						if ($show_icon_font_thumbnail == '1') { //display icon font class
							if ($style_font == 'separate-from-title') { //icon Separate from title
								$content_display_position_1 .= '<div class="feature_icon">';
								$content_display_position_1 .= '<span class="fa '. esc_attr($icon_size) .' '. esc_attr($icon_fontawesome).'"></span>';
								$content_display_position_1 .= '</div>';
							}elseif ($style_font == 'sync-with-title'){ //icon Sync with title
								$content_display_title 		= '<h3 class="feature_title heading_title">';
								$content_display_title 		.= '<i class="fa '. esc_attr($icon_size) .' '. esc_attr($icon_fontawesome).'"></i> ';
								if ($title) {
									$content_display_title 	.= get_the_title();
								}
								$content_display_title 		.= '</h3>';
							}
						}elseif($show_icon_font_thumbnail == '2'){ //display thumbnail
							$title_image			= get_bloginfo('name');
							if (has_post_thumbnail()) {
								$content_display_position_1 .= '<div class="thumbnail_image">';
								$content_display_position_1 .=  get_the_post_thumbnail($post_id, $image_size, array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ) );
								$content_display_position_1 .= '</div>';
							}
						}

						$url = (get_post_meta($post_id, 'wd_feature_url', true)) ? get_post_meta($post_id, 'wd_feature_url', true) : '#'; 
						$readmore_text = (get_post_meta($post->ID,'wd_readmore_text',true)) ? get_post_meta($post->ID,'wd_readmore_text',true) : esc_html('Read More','wpdancelaparis');
						?>
						<div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> >	
							<li class="wd-feature-content-list-item <?php echo esc_attr($text_align); ?>">
								<?php if ($readmore == 0): ?>
									<a class='wd-feature-readmore' href="<?php echo esc_url($url);?>">
								<?php endif ?>
									<?php if ($show_icon_font_thumbnail != 0 && $content_display_position_1 != ''): ?>
										<div class="feature_thumbnail_image">
											<?php echo $content_display_position_1; ?>
										</div>
									<?php endif ?>	
									
									<div class="feature_information">
										<?php echo $content_display_title; ?>
											
										<?php if( $excerpt ) :?>
											<div class="feature_excerpt">
												<?php the_content(); ?>
											</div>
										<?php endif;?>
										<?php if( $readmore ) :?>
											<a class='wd-feature-readmore' href="<?php echo esc_url($url);?>"><?php echo esc_html($readmore_text); ?></a>
										<?php endif;?>
									</div>	
								<?php if ($readmore == 0): ?>
									</a>
								<?php endif ?>
							</li>	
						</div>
					<?php
					} ?> <!-- end while -->
				</ul>
				<?php if( $show_nav && $is_slider == '1'){ ?>
					<div class="slider_control">
						<a href="#" class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
						<a href="#" class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
					</div>
				<?php } ?>
			</div>
			<?php if ( $is_slider == '1') : ?>
				<script type="text/javascript">
					jQuery(document).ready(function(){
						"use strict";						
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var _auto_play = <?php echo esc_attr( $auto_play ); ?>;
						var owl = $_this.find('.wd-feature-content-list').owlCarousel({
							loop : true,
							items : 1,
							nav : false,
							dots : true,
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
			<?php endif; // Endif Slider ?>
			<?php
		}
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_feature_category','tvlgiao_wpdance_feature_category_function');
?>