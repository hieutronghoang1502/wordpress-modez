<?php
/**
 * Shortcode: tvlgiao_wpdance_feature
 */
if(!function_exists('tvlgiao_wpdance_features_function')){
	function tvlgiao_wpdance_features_function($atts){
		extract(shortcode_atts(array(
			'id'						=>	0,
			'show_icon_font_thumbnail'	=>	'1',
			'icon_fontawesome' 			=>	'fa fa-adjust',
			'icon_size'					=>  'fa-1x',
			'style_font'				=> 	'sync-with-title',
			'image_or_thumbnail'		=>	'1',
			'custom_image'				=>	'',
			'image_size'				=>  'full',
			'style_thumbnail'			=> 	'above-the-content',
			'text_align'				=>  'wd-text-align-default',
			'title'						=>	'1',
			'excerpt'					=>	'1',
			'readmore'					=> 	'0',
			'active'					=> 	'0',
			'class'						=> 	'',
		),$atts));
		
		$active_class = "";
		if($active == "1"){
			$active_class = "feature_active";
		}
		
		if( absint($id) > 0 ){
			$args = array(
				'post_type'				=> 'wpdance_feature',
				'post__in' 				=> array($id),
				'post_status'			=> 'publish'
			);
			wp_reset_query();
			$_feature = new WP_Query($args);
		}else{
			return;
		}
		
		$style = 'style-font-sync-with-title';
		if($show_icon_font_thumbnail == 1){
			$style = 'style-font-'.$style_font;
		}elseif ($show_icon_font_thumbnail == 2){
			$style = 'style-thumbnail-'.$style_thumbnail;
		}
		$classes[] = 'shortcode-features';
		$classes[] = $class;
		
		ob_start();
		if ( $_feature->have_posts() ) {
			while( $_feature->have_posts() ) {
				$_feature->the_post();
				global $post;
				$post_id = $post->ID;
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
					if ($image_or_thumbnail == "1") { //use thumbnail
						if (has_post_thumbnail()) {
							$content_display_position_1 .= '<div class="thumbnail_image">';
							$content_display_position_1 .=  get_the_post_thumbnail($post_id, $image_size, array( 'alt' => esc_attr(get_the_title()), 'title' => esc_attr(get_the_title()) ) );
							$content_display_position_1 .= '</div>';
						}
					}elseif($image_or_thumbnail == "2") { //use custom image
						if ($custom_image) {
							$image_url 		= wp_get_attachment_image_src($custom_image, $image_size);
							$content_display_position_1 .= '<div class="thumbnail_image">';
							$content_display_position_1 .=  '<img alt="'.esc_attr($title_image).'" title="'.esc_attr($title_image).'" class="img" src="'.esc_url($image_url[0]).'" />';
							$content_display_position_1 .= '</div>';
						} 
					}
				}

				$url = (get_post_meta($post_id, 'wd_feature_url', true)) ? get_post_meta($post_id, 'wd_feature_url', true) : '#'; 
				$readmore_text = (get_post_meta($post->ID,'wd_readmore_text',true)) ? get_post_meta($post->ID,'wd_readmore_text',true) : esc_html('Read More','wpdancelaparis'); 
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> >	
					<div class="feature_content_wrapper <?php echo esc_attr($style); ?> <?php echo esc_attr($active_class); ?> <?php echo esc_attr($text_align); ?>">
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
					</div>
				</div>
			<?php
			}
		}
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_feature','tvlgiao_wpdance_features_function');
?>