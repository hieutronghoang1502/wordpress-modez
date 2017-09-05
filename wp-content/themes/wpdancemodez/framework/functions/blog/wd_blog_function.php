<?php
// Return html of thumbnail post or gallery
if(!function_exists ('tvlgiao_wpdance_get_attachment_html')){
	function tvlgiao_wpdance_get_attachment_html( $thumbnail_size = 'full', $show_thumbnail = false, $num = 1, $placeholder = false, $custom_class = '' ) {
		$output = '';
		$slider = ( 1 < $num ) ? 'owl-carousel' : '';
		if ( $show_thumbnail ) {
			if ( has_post_thumbnail() && 1 == $num ) {
				$output .= '<div class="wd-thumbnail-post ' . $slider . ' '  . esc_attr($custom_class) . '">';
				$output .= '<a class="thumbnail" href="' . get_permalink() . '">' . get_the_post_thumbnail( null, $thumbnail_size ) . '</a>';
				$output .= '</div><!-- .wd-thumbnail-post -->';
			} else {
				$attachments = get_posts( array(
					'post_type'      => 'attachment',
					'posts_per_page' => $num,
					'post_parent'    => get_the_ID(),
					) );
				if ( $attachments && 1 == $num ) {
					$output .= '<div class="wd-thumbnail-post ' . $slider . ' '  . esc_attr($custom_class) . '">';
					$output .= '<a class="thumbnail" href="' . get_permalink() . '">' . wp_get_attachment_image( $attachments[0]->ID, $thumbnail_size ) . '</a>';
					$output .= '</div><!-- .wd-thumbnail-post -->';
				} elseif ( $attachments && 1 < $num ) {
					$output .= '<div class="wd-thumbnail-post ' . $slider . ' '  . esc_attr($custom_class) . '">';
					foreach ( $attachments as $attachment ) {
						$output .= '<div class="thumbnail">' . wp_get_attachment_image( $attachment->ID, $thumbnail_size ) . '</div>';
					}
					$output .= '</div><!-- .wd-thumbnail-post -->';
				} else {
					if ($placeholder) {
						$output = tvlgiao_wpdance_get_thumb_placeholder_image('html');
					} 
				}
			}
		}
		return $output;
	}
}

// Return url of attachment images
if(!function_exists ('tvlgiao_wpdance_get_attachment')){
	function tvlgiao_wpdance_get_attachment($image_size = 'full', $num = 1, $placeholder = false){
		$output = '';
	    if (has_post_thumbnail() && $num == 1){
	    	$image_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $image_size );
	        $output = $image_thumb[0]; 
	    } else {
	        $attachments = get_posts(array(
	            'post_type' => 'attachment',
	            'posts_per_page' => $num,
	            'post_parent' => get_the_ID(),
	        ));
		    if ($attachments && $num == 1){
	            foreach ($attachments as $attachment){
	            	$image_thumb = wp_get_attachment_image_src( $attachment->ID, $image_size );
        			$output = $image_thumb[0]; 
	            }
		    } elseif ($attachments && $num > 1){
		            $output = $attachments;
		    } elseif ($placeholder) {
		    	$output.= tvlgiao_wpdance_get_thumb_placeholder_image('url');
		    }
	   	}
	    return $output;
	}
}

//Return placeholder image to display when post no thumbnail
if(!function_exists ('tvlgiao_wpdance_get_thumbnail_placeholder_image')){
	function tvlgiao_wpdance_get_thumb_placeholder_image($type = 'html', $image_size = 'post-thumbnail', $custom_class = ''){
		$output = '';
		$post_thumb_size = tvlgiao_wpdance_get_width_height_image_size($image_size);
		if ($type == 'html') {
			$image_placeholder = 'http://via.placeholder.com/'.$post_thumb_size['width'].'x'.$post_thumb_size['height'];
			$output .= '<div class="wd-thumbnail-post ' . esc_attr($custom_class) . '">';
			$output .= '<a class="thumbnail" href="' . get_permalink() . '"><img src="' . esc_url($image_placeholder) . '" alt="'.get_the_title().'" title="'.get_the_title().'" /></a>';
			$output .= '</div><!-- .wd-thumbnail-post -->';
		}elseif ($type == 'url') {
			$output = 'http://via.placeholder.com/'.$post_thumb_size['width'].'x'.$post_thumb_size['height'];
		}
		return $output;
	}
}

// Return array width/height of image size
if(!function_exists ('tvlgiao_wpdance_get_width_height_image_size')){
	function tvlgiao_wpdance_get_width_height_image_size($image_size = 'post-thumbnail'){
		$image_size = ($image_size == 'full' || $image_size == '') ? 'post-thumbnail' : $image_size; 
		global $_wp_additional_image_sizes;
		$image_size_arr = array();
		$post_thumb_width_default 	= $_wp_additional_image_sizes[$image_size]['width'];
		$post_thumb_height_default 	= $_wp_additional_image_sizes[$image_size]['height'];
		$image_size_arr['width'] 	= $post_thumb_width_default;
		$image_size_arr['height'] 	= $post_thumb_height_default;
	    return $image_size_arr;
	}
}


if(!function_exists ('tvlgiao_wpdance_get_bs_slides')){
	function tvlgiao_wpdance_get_bs_slides($attachments, $image_size = 'full'){
	    $output = array();
	    $count = count($attachments) - 1;

	    for ($i = 0; $i <= $count; ++$i):

	        $active = ($i == 0 ? ' active' : '');

	    $n = ($i == $count ? 0 : $i + 1);
	    $nextImg_array = wp_get_attachment_image_src($attachments[$n]->ID, $image_size);
	    $nextImg = $nextImg_array[0];
	    $p = ($i == 0 ? $count : $i - 1);
	    $prevImg_array = wp_get_attachment_image_src($attachments[$p]->ID, $image_size);
	    $prevImg = $prevImg_array[0];

	    $url = wp_get_attachment_image_src($attachments[$i]->ID, $image_size);
	    $output[$i] = array(
	            'class' => $active,
	            'url' => $url[0],
	            'next_img' => $nextImg,
	            'prev_img' => $prevImg,
	            'caption' => $attachments[$i]->post_excerpt,
	        );

	    endfor;

	    return $output;
	}
}

if(!function_exists ('tvlgiao_wpdance_get_embedded_media')){
	function tvlgiao_wpdance_get_embedded_media($type = array(), $height = '50%'){
	    $content = do_shortcode(apply_filters('the_content', get_the_content()));
	    $embed = get_media_embedded_in_content($content, $type);

	    if (in_array('audio', $type)){
	        $output = str_replace('?visual=true', '?visual=false', $embed[0]);
	        $output = str_replace('height="400"', 'height="'.$height.'"', $output);
	    } else {
	        $output = $embed[0];
	    }
	    return $output;
	}
}


if(!function_exists ('tvlgiao_wpdance_grab_url')){
	function tvlgiao_wpdance_grab_url(){
	    if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)) {
	        return false;
	    }
	    return esc_url_raw($links[1]);
	}
}

if(!function_exists ('tvlgiao_wpdance_grab_current_uri')){
	function tvlgiao_wpdance_grab_current_uri(){
	    $http = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://');
	    $referer = $http.$_SERVER['HTTP_HOST'];
	    $archive_url = $referer.$_SERVER['REQUEST_URI'];

	    return $archive_url;
	}
}

/****************** CONTENT OF BLOG *******************/
if(!function_exists ('tvlgiao_wpdance_display_post_thumbnail')){
	function tvlgiao_wpdance_display_post_thumbnail($image_size = 'full', $display = '1', $custom_class = ''){ 
		ob_start(); ?>
		<?php if( $display == '1' && has_post_thumbnail()): ?>
			<div class="wd-thumbnail-post <?php echo esc_attr($custom_class); ?>">
				<a class="thumbnail" href="<?php the_permalink(); ?>">
					<?php
						the_post_thumbnail($image_size);
					?>
				</a>
			</div>
		<?php endif; // End If ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_author_information')){
	function tvlgiao_wpdance_display_author_information($display = '1', $custom_class = ''){ 
		ob_start(); ?>
		<?php if( $display == '1'): ?>
			<div class="wd-infomation-author">
				<div class="avatar-user">
					<a href="<?php get_the_author_link(); ?>">
						<?php echo get_avatar(get_the_author_meta( 'ID' ), 120  ); ?>
					</a>
				</div>
				<span class="author">	
					<?php esc_html_e('by ','wpdancelaparis'); ?>
					<?php
						echo the_author_posts_link();
					?> 
				</span>
			</div>		
		<?php endif; // End If ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_title')){
	function tvlgiao_wpdance_display_post_title($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1'): ?>
			<div class="wd-title-post <?php echo esc_attr($custom_class); ?>">
				<h2 class="wd-heading-title">
					<a href="<?php the_permalink() ; ?>"><?php echo (get_the_title() != '') ? esc_html(get_the_title()) : esc_html('View detail (No title)','wpdancelaparis'); ?></a>
				</h2>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_sticky')){
	function tvlgiao_wpdance_display_post_sticky($custom_class = ''){ 
		ob_start();
		?>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post <?php echo esc_attr($custom_class); ?>">
				<?php esc_html_e( 'Sticky', 'wpdancelaparis' ); ?>
			</span>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_author')){
	function tvlgiao_wpdance_display_post_author($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1'): ?>
			<div class="wd-author-post <?php echo esc_attr($custom_class); ?>">
				<?php esc_html_e('by ','wpdancelaparis'); ?>
				<?php the_author_posts_link(); ?>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_category')){
	function tvlgiao_wpdance_display_post_category($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1' && has_category()): ?>
			<div class="wd-category-post <?php echo esc_attr($custom_class); ?>">
				<?php esc_html_e('in ','wpdancelaparis'); ?>
				<?php the_category(esc_html__(', ', 'wpdancelaparis')); ?>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_date')){
	function tvlgiao_wpdance_display_post_date($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1'): ?>
			<div class="wd-date-post <?php echo esc_attr($custom_class); ?>">
				<div class="wd-date-post-day"><?php the_time('j') ?></div>
				<div class="wd-date-post-my">
					<span><?php the_time('M'); ?></span>
					<span><?php the_time('Y'); ?></span>
				</div>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_number_comment')){
	function tvlgiao_wpdance_display_post_number_comment($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1'): ?>
			<div class="wd-number-comment-post <?php echo esc_attr($custom_class); ?>">
				<?php echo get_comments_number(); ?>
				<?php esc_html_e(' Comments', 'wpdancelaparis'); ?>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_excerpt')){
	function tvlgiao_wpdance_display_post_excerpt($display = '1', $number_excerpt = 20, $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1' && get_the_excerpt()): ?>
			<div class="wd-content-detail-post <?php echo esc_attr($custom_class); ?>">
				<?php 
				$excerpt = tvlgiao_wpdance_string_limit_words(get_the_excerpt() , $number_excerpt ).' [...]';
				echo esc_attr($excerpt); 
				?>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}

if(!function_exists ('tvlgiao_wpdance_display_post_readmore')){
	function tvlgiao_wpdance_display_post_readmore($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		<?php if ($display == '1'): ?>
			<div class="readmore <?php echo esc_attr($custom_class); ?>">
				<a class="readmore_link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','wpdancelaparis') ?></a>
			</div>
		<?php endif ?>
		<?php 
		echo ob_get_clean();
	}
}


// bỏ function này
if(!function_exists ('tvlgiao_wpdance_display_post_previous_next_btn')){
	function tvlgiao_wpdance_display_post_previous_next_btn($display = '1', $custom_class = ''){ 
		ob_start();
		?>
		
		<?php 
		echo ob_get_clean();
	}
}